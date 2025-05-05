@extends('user.layouts')

@section('title', 'Keranjang - UMKM Store')

@section('content')

<div class="container my-4" style="min-height: 80vh;"> <!-- Menambahkan min-height untuk menghindari footer naik -->
    <div class="container my-4">
        <h2 class="text-center">Keranjang Belanja</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(empty($keranjang))
            <p class="text-center">Keranjang masih kosong.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th colspan="2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $totalSemua = 0; @endphp
                    @foreach($keranjang as $item)
                    @php
                        $totalItem = $item['harga'] * $item['jumlah'];
                        $totalSemua += $totalItem;
                    @endphp
                    <tr>
                        <td><img src="{{ asset('storage/produk/' . $item['gambar']) }}" width="50"></td>
                        <td>{{ $item['nama'] }}</td>
                        <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                        <td>{{ $item['jumlah'] }}</td>
                        <td>Rp {{ number_format($totalItem, 0, ',', '.') }}</td>
                        <td>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $item['id'] }}">
                                <i class="fa-solid fa-trash"></i> Hapus
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#checkoutModal{{ $item['id'] }}">
                                <i class="fa-solid fa-cart-shopping"></i> Checkout
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Tombol untuk buka Modal Checkout Semua -->
            <button type="button" class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#checkoutSemuaModal">
                <i class="fa-solid fa-cart-plus"></i> Checkout Semua
            </button>

            <!-- Semua Modal Hapus & Checkout per Produk -->
            @foreach($keranjang as $item)
                <!-- Modal Hapus -->
                <div class="modal fade" id="hapusModal{{ $item['id'] }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p>Yakin ingin menghapus produk ini dari keranjang?</p>
                                <form action="{{ route('keranjang.hapus', $item['id']) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="jumlah_hapus" value="1">
                                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Checkout Per Produk -->
                <div class="modal fade" id="checkoutModal{{ $item['id'] }}" tabindex="-1">
                    <div class="modal-dialog">
                        <form action="{{ route('keranjang.beli', $item['id']) }}" method="POST" class="modal-content">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Checkout Produk Ini</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>{{ $item['nama'] }}</strong></p>
                                <div class="mb-3">
                                    <label for="jumlah{{ $item['id'] }}" class="form-label">Jumlah</label>
                                    <input type="number" name="jumlah" id="jumlah{{ $item['id'] }}" class="form-control" value="{{ $item['jumlah'] }}" min="1" max="{{ $item['stok'] }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat{{ $item['id'] }}" class="form-label">Alamat Pengiriman</label>
                                    <textarea name="alamat" id="alamat{{ $item['id'] }}" class="form-control" rows="2" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="metode_bayar{{ $item['id'] }}" class="form-label">Metode Pembayaran</label>
                                    <select name="metode_bayar" id="metode_bayar{{ $item['id'] }}" class="form-select" required>
                                        <option value="COD">Bayar di Tempat (COD)</option>
                                        <option value="transfer">Transfer Bank</option>
                                        <option value="qris">QRIS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Checkout</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach

            <!-- Modal Checkout Semua -->
            <div class="modal fade" id="checkoutSemuaModal" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{ route('pesanan.store') }}" method="POST" class="modal-content">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Checkout Semua Produk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Rincian Produk:</strong></p>
                            <ul class="list-group mb-3">
                                @foreach($keranjang as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $item['nama'] }} (x{{ $item['jumlah'] }})
                                        <span>Rp {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <p class="fw-bold">Total Semua: Rp {{ number_format($totalSemua, 0, ',', '.') }}</p>

                            <div class="mb-3 mt-3">
                                <label for="alamat" class="form-label">Alamat Pengiriman</label>
                                <textarea name="alamat" id="alamat" class="form-control" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="metode_bayar" class="form-label">Metode Pembayaran</label>
                                <select name="metode_bayar" id="metode_bayar" class="form-select" required>
                                    <option value="COD">Bayar di Tempat (COD)</option>
                                    <option value="transfer">Transfer Bank</option>
                                    <option value="qris">QRIS</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Checkout Sekarang</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>  

@endsection
