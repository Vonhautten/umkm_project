@extends('user.layouts')

@section('title', 'Produk - UMKM Store')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container my-4">
    <h2 class="text-center">Daftar Produk</h2>
    <div class="row">
        @foreach($produk as $item)
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm">
                <img src="{{ asset('img/' . $item->gambar) }}" class="card-img-top" alt="{{ $item->nama_produk }}">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $item->nama_produk }}</h5>
                    <p class="card-text">{{ Str::limit($item->deskripsi, 50) }}</p>
                    <p class="text-success fw-bold">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                    <a href="#" class="btn btn-success">Beli Sekarang</a>
                    
                    <!-- Form untuk menambahkan ke keranjang -->
                    <form action="{{ route('keranjang.tambah', $item->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </button>
                    </form>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
