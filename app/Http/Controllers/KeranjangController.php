<?php

namespace App\Http\Controllers;

use App\Models\PesananDetailModel;
use App\Models\PesananModel;
use App\Models\ProdukModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class KeranjangController extends Controller
{
    public function tambahKeKeranjang(Request $request, $id)
    {
        $produk = ProdukModel::findOrFail($id);
        $jumlah = (int) $request->input('jumlah', 1); // <-- ambil jumlah dari input, default 1

        $keranjang = Session::get('keranjang', []);

        if (isset($keranjang[$id])) {
            $keranjang[$id]['jumlah'] += $jumlah;
        } else {
            $keranjang[$id] = [
                'id' => $produk->id,
                'nama' => $produk->nama_produk,
                'harga' => $produk->harga,
                'gambar' => $produk->gambar,
                'jumlah' => $jumlah,
                'stok' => $produk->stok,
            ];
        }

        Session::put('keranjang', $keranjang);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }


    public function lihatKeranjang()
    {
        $keranjang = Session::get('keranjang', []);

        // Pastikan setiap item punya stok
        foreach ($keranjang as $id => $item) {
            if (!isset($item['stok'])) {
                $produk = ProdukModel::find($id);
                if ($produk) {
                    $keranjang[$id]['stok'] = $produk->stok;
                } else {
                    unset($keranjang[$id]); // kalau produk dihapus dari DB
                }
            }
        }

        Session::put('keranjang', $keranjang); // update session
        return view('user.keranjang', compact('keranjang'));
    }


    public function hapus(Request $request, $id)
    {
        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$id])) {
            $jumlahHapus = (int) $request->input('jumlah_hapus', 1);

            if ($keranjang[$id]['jumlah'] > $jumlahHapus) {
                $keranjang[$id]['jumlah'] -= $jumlahHapus;
            } else {
                unset($keranjang[$id]);
            }

            session()->put('keranjang', $keranjang);
        }

        return redirect()->back()->with('success', 'Produk berhasil diperbarui di keranjang!');
    }

    public function beli(Request $request, $id)
    {
        $keranjang = session()->get('keranjang', []);

        if (!isset($keranjang[$id])) {
            return back()->with('error', 'Produk tidak ditemukan di keranjang.');
        }

        $item = $keranjang[$id];

        $request->validate([
            'jumlah' => 'required|integer|min:1',
            'alamat' => 'required|string|max:255',
            'metode_bayar' => 'required|in:COD,transfer,qris',
        ]);

        $jumlahDibeli = (int) $request->jumlah;

        // Cek apakah jumlah yang dibeli melebihi jumlah yang ada di keranjang
        if ($jumlahDibeli > $item['jumlah']) {
            return back()->with('error', 'Jumlah melebihi jumlah di keranjang.');
        }

        // Cek stok dari database
        $produk = ProdukModel::find($id);

        if (!$produk || $produk->stok < $jumlahDibeli) {
            return back()->with('error', 'Stok produk tidak mencukupi.');
        }

        $totalHarga = $produk->harga * $jumlahDibeli;

        // Buat pesanan
        $pesanan = PesananModel::create([
            'id_user' => Auth::id(),
            'alamat' => $request->alamat,
            'status' => 'Menunggu Pembayaran',
            'total_harga' => $totalHarga,
            'metode_bayar' => $request->metode_bayar,
        ]);

        // Tambah detail pesanan
        PesananDetailModel::create([
            'id_pesanan' => $pesanan->id,
            'id_produk' => $produk->id,
            'jumlah' => $jumlahDibeli,
            'harga_satuan' => $produk->harga,
        ]);

        // Kurangi stok produk
        $produk->stok -= $jumlahDibeli;
        $produk->save();

        // Update keranjang
        if ($jumlahDibeli >= $item['jumlah']) {
            unset($keranjang[$id]);
        } else {
            $keranjang[$id]['jumlah'] -= $jumlahDibeli;
        }

        session()->put('keranjang', $keranjang);

        return redirect()->route('pesanan.lihat')->with('success', 'Pesanan berhasil dibuat!');
    }
}