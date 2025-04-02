<?php

namespace App\Http\Controllers;

use App\Models\PesananModel;
use App\Models\ProdukModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    public function tambahKeKeranjang($id)
    {
        $produk = ProdukModel::findOrFail($id);

        // Ambil keranjang dari session atau buat array baru jika belum ada
        $keranjang = Session::get('keranjang', []);

        // Jika produk sudah ada di keranjang, tambahkan jumlahnya
        if (isset($keranjang[$id])) {
            $keranjang[$id]['jumlah'] += 1;
        } else {
            // Jika belum ada, tambahkan produk ke keranjang
            $keranjang[$id] = [
                'id' => $produk->id,
                'nama' => $produk->nama_produk,
                'harga' => $produk->harga,
                'gambar' => $produk->gambar,
                'jumlah' => 1
            ];
        }

        // Simpan kembali ke session
        Session::put('keranjang', $keranjang);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function lihatKeranjang()
    {
        $keranjang = Session::get('keranjang', []);
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
            return redirect()->back()->with('error', 'Produk tidak ditemukan di keranjang!');
        }

        PesananModel::create([
            'id_user' => Auth::id(),
            'produk_id' => $id,
            'jumlah' => $keranjang[$id]['jumlah'],
            'total_harga' => $keranjang[$id]['harga'] * $keranjang[$id]['jumlah'],
            'status' => 'Menunggu Pembayaran'
        ]);

        unset($keranjang[$id]);
        session()->put('keranjang', $keranjang);

        return redirect()->route('pesanan.lihat')->with('success', 'Produk berhasil dibeli!');
    }
}