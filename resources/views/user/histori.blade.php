@extends('user.layouts')

@section('title', 'Histori Pesanan - UMKM Store')

@section('content')
<div class="container my-4">
    <h2 class="text-center">Histori Pesanan</h2>

    @if($pesananSelesai->isEmpty())
        <p class="text-center">Belum ada pesanan yang selesai.</p>
    @else
        <div class="row">
            @foreach($pesananSelesai as $order)
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
                            <p><strong>Metode Bayar:</strong> {{ $order->metode_bayar }}</p>
                            <p><strong>Tanggal Selesai:</strong> {{ $order->updated_at->format('d-m-Y') }}</p>
                            <span class="badge bg-primary">Selesai</span>
                            <form action="{{ route('pesanan.histori.hapus', $order->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus histori ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm mt-2">Hapus</button>
                            </form>                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
