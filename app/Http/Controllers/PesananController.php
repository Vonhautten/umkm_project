<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PesananModel;
use App\Models\PesananDetailModel;
use App\Models\ProdukModel;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function lihatPesanan(Request $request)
    {
        $query = PesananModel::with('details.produk')
            ->where('id_user', Auth::id())
            ->orderByDesc('created_at');

        if ($request->has('status') && $request->status !== '') {
            // Jika user memilih filter status, tampilkan sesuai
            $query->where('status', $request->status);
        } else {
            // Jika tidak difilter, sembunyikan yang sudah selesai
            $query->where('status', '!=', 'Selesai');
        }

        $pesanan = $query->get();

        return view('user.pesanan', compact('pesanan'));
    }


    public function store(Request $request)
    {
        $keranjang = session()->get('keranjang');
        if (!$keranjang || empty($keranjang)) {
            return redirect()->back()->with('error', 'Keranjang kosong!');
        }

        $request->validate([
            'alamat' => 'required|string|max:255',
            'metode_bayar' => 'required|in:COD,transfer,qris',
        ]);

        $totalHarga = collect($keranjang)->sum(function ($item) {
            return $item['harga'] * $item['jumlah'];
        });

        // Buat pesanan
        $pesanan = PesananModel::create([
            'id_user' => Auth::id(),
            'alamat' => $request->alamat,
            'status' => 'Menunggu Pembayaran',
            'total_harga' => $totalHarga,
            'metode_bayar' => $request->metode_bayar, // tambahkan di tabel kalau belum ada
        ]);

        foreach ($keranjang as $item) {
            $produk = ProdukModel::find($item['id']);
            if (!$produk || $produk->stok < $item['jumlah']) {
                return redirect()->back()->with('error', 'Stok tidak mencukupi untuk ' . $item['nama']);
            }

            // Simpan detail pesanan
            PesananDetailModel::create([
                'id_pesanan' => $pesanan->id,
                'id_produk' => $item['id'],
                'jumlah' => $item['jumlah'],
                'harga_satuan' => $item['harga'],
            ]);

            // Kurangi stok
            $produk->stok -= $item['jumlah'];
            $produk->save();
        }

        // Kosongkan keranjang
        session()->forget('keranjang');

        return redirect()->route('pesanan.lihat')->with('success', 'Pesanan berhasil dibuat!');
    }


    public function batalkan($id)
    {
        $pesanan = PesananModel::with('details')->findOrFail($id);

        if ($pesanan->status !== 'Menunggu Pembayaran') {
            return redirect()->back()->with('error', 'Pesanan tidak dapat dibatalkan.');
        }

        foreach ($pesanan->details as $detail) {
            $produk = ProdukModel::find($detail->id_produk);
            if ($produk) {
                $produk->stok += $detail->jumlah;
                $produk->save();
            }
        }

        $pesanan->status = 'Dibatalkan';
        $pesanan->save();

        return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan.');
    }

    public function beliLangsung(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
            'alamat' => 'required|string',
            'metode_bayar' => 'required|string|in:COD,transfer,qris',
        ]);

        $produk = ProdukModel::findOrFail($id);
        $jumlah = $request->jumlah;

        // Validasi stok
        if ($jumlah > $produk->stok) {
            return redirect()->back()->with('error', 'Stok produk tidak mencukupi.');
        }

        $totalHarga = $produk->harga * $jumlah;

        // Buat pesanan baru
        $pesanan = PesananModel::create([
            'id_user' => Auth::id(),
            'total_harga' => $totalHarga,
            'alamat' => $request->alamat,
            'metode_bayar' => $request->metode_bayar,
            'status' => 'Menunggu Pembayaran',
        ]);

        // Simpan detail pesanan
        PesananDetailModel::create([
            'id_pesanan' => $pesanan->id,
            'id_produk' => $produk->id,
            'jumlah' => $jumlah,
            'harga_satuan' => $produk->harga,
        ]);

        // Kurangi stok produk
        $produk->stok -= $jumlah;
        $produk->save();

        return redirect()->route('pesanan.lihat')->with('success', 'Pesanan berhasil dibuat. Silakan lakukan pembayaran.');
    }


    public function histori()
    {
        $pesananSelesai = PesananModel::where('id_user', Auth::id())
            ->where('status', 'Selesai')
            ->with('details.produk')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.histori', compact('pesananSelesai'));
    }

    public function hapusHistori($id)
    {
        $pesanan = PesananModel::where('id', $id)->where('id_user', Auth::id())->firstOrFail();

        if ($pesanan->status !== 'Selesai') {
            return redirect()->back()->with('error', 'Hanya histori selesai yang bisa dihapus.');
        }

        // Hapus detail terlebih dahulu
        $pesanan->details()->delete();
        $pesanan->delete();

        return redirect()->back()->with('success', 'Histori pesanan berhasil dihapus.');
    }

    // Menampilkan semua pesanan dari seluruh user (untuk admin)
    public function semuaPesanan(Request $request)
    {
        $query = PesananModel::with(['user', 'details.produk'])
            ->orderBy('created_at', 'desc');
    
        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
    
        // Pencarian berdasarkan nama user
        if ($request->has('search') && $request->search != '') {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            });
        }
    
        $pesanan = $query->get();
    
        return view('admin.pesanan', compact('pesanan'));
    }
    

    // Mengubah status pesanan oleh admin
    public function ubahStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu Pembayaran,Diproses,Dikirim,Selesai,Dibatalkan',
        ]);

        $pesanan = PesananModel::findOrFail($id);
        $pesanan->status = $request->status;
        $pesanan->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

}