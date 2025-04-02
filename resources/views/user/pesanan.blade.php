@extends('user.layouts')

@section('title', 'Lihat Pesanan - UMKM Store')

@section('content')
<div class="container my-4">
    <h2 class="text-center">Daftar Pesanan</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($pesanan->isEmpty())
        <p class="text-center">Anda belum memiliki pesanan.</p>
    @else
        <div class="row">
            @foreach($pesanan as $item)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('produk/' . $item->produk->gambar) }}" class="card-img-top" alt="{{ $item->produk->nama_produk }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->produk->nama_produk }}</h5>
                        <p class="card-text">{{ Str::limit($item->produk->deskripsi, 100) }}</p>
                        <p><strong>Jumlah:</strong> {{ $item->jumlah }}</p>
                        <p><strong>Total Harga:</strong> Rp {{ number_format($item->total_harga, 0, ',', '.') }}</p>
                        <p><strong>Status:</strong> {{ $item->status }}</p>
                        <p><strong>Tanggal Pesan:</strong> {{ $item->created_at->format('d-m-Y') }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
