@extends('user.layouts')

@section('title', 'Histori Pesanan - UMKM Store')

@section('content')
<div class="container my-5" style="min-height: 80vh;"> <!-- Jaga footer tetap di bawah -->
    <h2 class="text-center mb-4">Histori Pesanan</h2>

    @if($pesananSelesai->isEmpty())
        <p class="text-center fs-5 text-muted">Belum ada pesanan yang selesai.</p>
    @else
        <div class="row gy-4">
            @foreach($pesananSelesai as $order)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-3">Pesanan #{{ $order->id }}</h5>

                            {{-- Detail Produk --}}
                            @foreach($order->details as $detail)
                                <div class="d-flex mb-3 align-items-center">
                                    <img src="{{ asset('storage/' . $detail->produk->gambar) }}" alt="{{ $detail->produk->nama_produk }}" width="60" height="60" class="rounded me-3" style="object-fit: cover;">
                                    <div>
                                        <strong class="d-block">{{ $detail->produk->nama_produk }}</strong>
                                        <small>Jumlah: {{ $detail->jumlah }} | Harga Satuan: Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</small><br> 
                                    </div>
                                </div>
                            @endforeach

                            <hr class="my-2">

                            <p class="mb-1"><strong>Total Harga:</strong> <span class="text-success fs-5">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span></p>
                            <p class="mb-1"><strong>Alamat:</strong> {{ $order->alamat }}</p>
                            <p class="mb-1"><strong>Metode Bayar:</strong> {{ ucfirst($order->metode_bayar) }}</p>
                            <p class="mb-3"><strong>Tanggal Selesai:</strong> {{ $order->updated_at->format('d-m-Y') }}</p>

                            <span class="badge bg-primary mb-3 align-self-start">Selesai</span>

                            <form action="{{ route('pesanan.histori.hapus', $order->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus histori ini?')" class="mt-auto">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm w-100">Hapus Histori</button>
                            </form>                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
