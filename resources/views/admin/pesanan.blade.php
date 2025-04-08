@extends('admin.layouts')

@section('title', 'Pesanan - UMKM Store')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Daftar Pesanan User</h2>

    <form method="GET" action="{{ route('admin.pesanan') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Cari nama user" value="{{ request('search') }}">
        </div>
        <div class="col-md-4">
            <select name="status" class="form-select">
                <option value="">-- Semua Status --</option>
                <option value="Menunggu Pembayaran" {{ request('status') == 'Menunggu Pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="Dikirim" {{ request('status') == 'Dikirim' ? 'selected' : '' }}>Dikirim</option>
                <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="Dibatalkan" {{ request('status') == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Terapkan</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>User</th>
                    <th>Alamat</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Ubah Status</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pesanan as $p)
                <tr>
                    <td>{{ $p->user->nama ?? 'Tidak Diketahui' }}</td>
                    <td>{{ $p->alamat }}</td>
                    <td>Rp{{ number_format($p->total_harga, 0, ',', '.') }}</td>
                    <td><span class="badge bg-secondary">{{ $p->status }}</span></td>
                    <td>
                        <form action="{{ route('admin.pesanan.ubahStatus', $p->id) }}" method="POST" class="d-flex">
                            @csrf
                            <select name="status" class="form-select me-2">
                                <option {{ $p->status == 'Menunggu Pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                                <option {{ $p->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                <option {{ $p->status == 'Dikirim' ? 'selected' : '' }}>Dikirim</option>
                                <option {{ $p->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                <option {{ $p->status == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-success">Ubah</button>
                        </form>
                    </td>
                    <td>
                        <ul class="mb-0">
                            @foreach($p->details as $detail)
                            <li>{{ $detail->produk->nama }} (x{{ $detail->jumlah }})</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada pesanan ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
