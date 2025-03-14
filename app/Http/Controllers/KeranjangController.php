<?php

namespace App\Http\Controllers;

use App\Models\ProdukModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

        // Tambahkan notifikasi sukses
        session()->flash('success', 'Produk berhasil ditambahkan ke keranjang!');

        return redirect()->back();
    }

    public function lihatKeranjang()
    {
        $keranjang = Session::get('keranjang', []);
        return view('user.keranjang', compact('keranjang'));
    }

    public function hapus(Request $request, $id)
    {
        $keranjang = session()->get('keranjang');

        // Cek apakah produk ada di keranjang
        if (isset($keranjang[$id])) {
            $jumlahHapus = (int) $request->input('jumlah_hapus');

            // Jika jumlah dihapus lebih kecil dari jumlah yang ada, cukup kurangi
            if ($keranjang[$id]['jumlah'] > $jumlahHapus) {
                $keranjang[$id]['jumlah'] -= $jumlahHapus;
            } else {
                // Jika jumlah yang dihapus sama atau lebih besar, hapus item dari keranjang
                unset($keranjang[$id]);
            }

            // Simpan kembali session keranjang
            session()->put('keranjang', $keranjang);
        }

        return redirect()->back()->with('success', 'Produk berhasil diperbarui di keranjang!');
    }
}