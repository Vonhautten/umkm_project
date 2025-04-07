@extends('user.layouts')

@section('title', 'Lihat Pesanan - UMKM Store')

@section('content')
<div class="container my-4">
    <h2 class="text-center">Daftar Pesanan</h2>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Filter Status --}}
    <form method="GET" action="{{ route('pesanan.lihat') }}" class="mb-4 text-center">
        <label for="status" class="me-2">Filter Status:</label>
        <select name="status" id="status" onchange="this.form.submit()" class="form-select w-auto d-inline-block">
            <option value="">Semua</option>
            <option value="Menunggu Pembayaran" {{ request('status') == 'Menunggu Pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
            <option value="Dibayar" {{ request('status') == 'Dibayar' ? 'selected' : '' }}>Dibayar</option>
            <option value="Dibatalkan" {{ request('status') == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
        </select>
    </form>

    {{-- Cek apakah ada pesanan --}}
    @if($pesanan->isEmpty())
        <p class="text-center">Anda belum memiliki pesanan.</p>
    @else
        <div class="row">
            @foreach($pesanan as $order)
                {{-- Sembunyikan pesanan dibatalkan kecuali kalau sedang difilter --}}
                @if(request('status') !== 'Dibatalkan' && $order->status === 'Dibatalkan')
                    @continue
                @endif

                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Pesanan #{{ $order->id }}</h5>

                            {{-- Detail Produk --}}
                            @foreach($order->details as $detail)
                                <div class="d-flex mb-3">
                                    <img src="{{ asset('produk/' . $detail->produk->gambar) }}" width="60" height="60" class="me-3 rounded" style="object-fit: cover;">
                                    <div>
                                        <strong>{{ $detail->produk->nama_produk }}</strong><br>
                                        Jumlah: {{ $detail->jumlah }}<br>
                                        Harga Satuan: Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}<br>
                                        Subtotal: Rp {{ number_format($detail->jumlah * $detail->harga_satuan, 0, ',', '.') }}
                                    </div>
                                </div>
                            @endforeach

                            <hr>
                            <p><strong>Total Harga:</strong> Rp {{ number_format($order->total_harga, 0, ',', '.') }}</p>
                            <p><strong>Alamat:</strong> {{ $order->alamat }}</p>
                            <p><strong>Metode Pembayaran:</strong> {{ ucfirst($order->metode_bayar) }}</p>
                            <p><strong>Tanggal Pesan:</strong> {{ $order->created_at->format('d-m-Y') }}</p>
                            <p><strong>Status:</strong>
                                @if($order->status === 'Menunggu Pembayaran')
                                    <span class="badge bg-warning text-dark">{{ $order->status }}</span>
                                @elseif($order->status === 'Dibayar')
                                    <span class="badge bg-success">{{ $order->status }}</span>
                                @elseif($order->status === 'Dibatalkan')
                                    <span class="badge bg-danger">{{ $order->status }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ $order->status }}</span>
                                @endif
                            </p>

                            {{-- Tombol Batalkan --}}
                            @if($order->status === 'Menunggu Pembayaran')
                                <form action="{{ route('pesanan.batalkan', $order->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Batalkan</button>
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
