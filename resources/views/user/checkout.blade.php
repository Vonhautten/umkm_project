@extends('user.layouts')

@section('title', 'Checkout')

@section('content')
<div class="container my-4">
    <h2>Checkout</h2>
    <form action="{{ route('pesanan.store', $keranjang->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat Pengiriman</label>
            <textarea name="alamat" id="alamat" class="form-control" required>{{ old('alamat') }}</textarea>
        </div>

        <p><strong>Produk:</strong> {{ $keranjang->produk->nama_produk }}</p>
        <p><strong>Jumlah:</strong> {{ $keranjang->jumlah }}</p>
        <p><strong>Total Harga:</strong> Rp {{ number_format($keranjang->jumlah * $keranjang->produk->harga, 0, ',', '.') }}</p>

        <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
    </form>
</div>
@endsection
