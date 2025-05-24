@extends('user.layouts')

@section('title', 'Lihat Pesanan - UMKM Store')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4">Daftar Pesanan</h2>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Filter Status --}}
    <form method="GET" action="{{ route('pesanan.lihat') }}" class="mb-4 d-flex justify-content-center align-items-center gap-2 flex-wrap">
        <label for="status" class="fw-semibold">Filter Status:</label>
        <select name="status" id="status" onchange="this.form.submit()" class="form-select w-auto">
            <option value="" {{ request('status') == '' ? 'selected' : '' }}>Semua</option>
            <option value="Menunggu Pembayaran" {{ request('status') == 'Menunggu Pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
            <option value="Dibayar" {{ request('status') == 'Dibayar' ? 'selected' : '' }}>Dibayar</option>
            <option value="Dibatalkan" {{ request('status') == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
        </select>
    </form>

    {{-- Jika tidak ada pesanan --}}
    @if($pesanan->isEmpty())
        <p class="text-center fs-5 text-muted">Anda belum memiliki pesanan.</p>
    @else
        <div class="row gy-4">
            @foreach($pesanan as $order)
                {{-- Sembunyikan pesanan dibatalkan kecuali kalau sedang difilter --}}
                @if(request('status') !== 'Dibatalkan' && $order->status === 'Dibatalkan')
                    @continue
                @endif

                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-3">Pesanan #{{ $order->id }}</h5>

                            {{-- Detail Produk --}}
                            @foreach($order->details as $detail)
                                <div class="d-flex mb-3 align-items-center">
                                    <img src="{{ asset('storage/' . $detail->produk->gambar) }}" alt="{{ $detail->produk->nama_produk }}" width="60" height="60" class="rounded me-3" style="object-fit: cover;">
                                    <div class="flex-grow-1">
                                        <strong class="d-block">{{ $detail->produk->nama_produk }}</strong>
                                        <small>Jumlah: {{ $detail->jumlah }} | Harga Satuan: Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</small><br>
                                    </div>
                                </div>
                            @endforeach

                            <hr class="my-2">

                            <p class="mb-1"><strong>Total Harga:</strong> <span class="text-success fs-5">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span></p>
                            <p class="mb-1"><strong>Alamat:</strong> {{ $order->alamat }}</p>
                            <p class="mb-1"><strong>Metode Pembayaran:</strong> {{ ucfirst($order->metode_bayar) }}</p>
                            <p class="mb-3"><strong>Tanggal Pesan:</strong> {{ $order->created_at->format('d-m-Y') }}</p>

                            <p>
                                <strong>Status:</strong>
                                @php
                                    $statusColors = [
                                        'Menunggu Pembayaran' => 'bg-warning text-dark',
                                        'Dibayar' => 'bg-success',
                                        'Dibatalkan' => 'bg-danger',
                                    ];
                                    $badgeClass = $statusColors[$order->status] ?? 'bg-secondary';
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ $order->status }}</span>
                            </p>

                            {{-- Tombol Batalkan --}}
                            @if($order->status === 'Menunggu Pembayaran')
                                <form action="{{ route('pesanan.batalkan', $order->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')" class="mt-auto">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm w-100">Batalkan Pesanan</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
