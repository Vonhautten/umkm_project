@extends('user.layouts')

@section('title', 'Produk - UMKM Store')

@section('content')
<div class="container my-4">
    <h2 class="text-center">Daftar Produk</h2>
    <div class="row">
        @foreach($produk as $item)
        <div class="col-md-3 mb-4">
            <div class="card shadow">
                <img src="{{ asset('img/' . $item->gambar) }}" class="card-img-top" alt="{{ $item->nama_produk }}">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $item->nama_produk }}</h5>
                    <p class="card-text">{{ Str::limit($item->deskripsi, 50) }}</p>
                    <p class="text-success fw-bold">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                    <a href="#" class="btn btn-success">Beli Sekarang</a>
                    <a href="#" class="btn btn-primary"><i class="fa-solid fa-cart-shopping"></i></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
