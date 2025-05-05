@extends('user.layouts')

@section('title', 'Produk - UMKM Store')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


<div class="container my-4" style="min-height: 80vh;"> <!-- Menambahkan min-height untuk menghindari footer naik -->
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
            
                    {{-- Tampilkan Stok --}}
                    <p class="text-muted mb-2">
                        <small>Stok: {{ $item->stok > 0 ? $item->stok : 'Habis' }}</small>
                    </p>
            
                    <div class="d-flex justify-content-center gap-2 mb-2">
                        <!-- Tombol Beli Sekarang -->
                        <button class="btn btn-success btn-sm flex-grow-1" data-bs-toggle="modal" data-bs-target="#beliModal{{ $item->id }}">
                            Beli Sekarang
                        </button>
            
                        <!-- Tambah ke Keranjang -->
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#keranjangModal{{ $item->id }}">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Beli Sekarang -->
        <div class="modal fade" id="beliModal{{ $item->id }}" tabindex="-1" aria-labelledby="beliModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('pesanan.beliLangsung', $item->id) }}" method="POST" class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="beliModalLabel{{ $item->id }}">Pembelian Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>{{ $item->nama_produk }}</strong></p>
                        <p class="text-muted">Stok tersedia: {{ $item->stok }}</p>

                        <div class="mb-3">
                            <label for="jumlah{{ $item->id }}" class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" id="jumlah{{ $item->id }}" class="form-control" value="1" min="1" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat{{ $item->id }}" class="form-label">Alamat Pengiriman</label>
                            <textarea name="alamat" id="alamat{{ $item->id }}" class="form-control" rows="2" placeholder="Masukkan alamat lengkap" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="metode_bayar{{ $item->id }}" class="form-label">Metode Pembayaran</label>
                            <select name="metode_bayar" id="metode_bayar{{ $item->id }}" class="form-select" required>
                                <option value="COD">Bayar di Tempat (COD)</option>
                                <option value="transfer">Transfer Bank</option>
                                <option value="qris">QRIS</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning">Proses Pembelian</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Tambah ke Keranjang -->
        <div class="modal fade" id="keranjangModal{{ $item->id }}" tabindex="-1" aria-labelledby="keranjangModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('keranjang.tambah', $item->id) }}" method="POST" class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="keranjangModalLabel{{ $item->id }}">Tambah ke Keranjang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>{{ $item->nama_produk }}</strong></p>
                        <p class="text-muted">Stok tersedia: {{ $item->stok }}</p>
                        <div class="mb-3">
                            <label for="jumlah_keranjang{{ $item->id }}" class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" id="jumlah_keranjang{{ $item->id }}" class="form-control" value="1" min="1" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Tambahkan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>

        @endforeach
    </div>
</div>

@endsection
