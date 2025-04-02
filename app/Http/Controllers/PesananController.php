<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\PesananModel;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function lihatPesanan()
    {
        $pesanan = PesananModel::where('id_user', Auth::id())->get();
        return view('user.pesanan', compact('pesanan'));
    }

    public function store(Request $request, $id)
    {
        $keranjang = session()->get('keranjang');
        if (isset($keranjang[$id])) {
            PesananModel::create([
                'id_user' => Auth::id(),
                'produk_id' => $id,
                'jumlah' => $keranjang[$id]['jumlah'],
                'total_harga' => $keranjang[$id]['harga'] * $keranjang[$id]['jumlah'],
                'status' => 'Menunggu Pembayaran'
            ]);

            unset($keranjang[$id]);
            session()->put('keranjang', $keranjang);
        }

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibuat!');
    }
}