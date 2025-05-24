@extends('user.layouts')

@section('title', 'Keranjang - UMKM Store')

@section('content')
<div class="container my-4" style="min-height: 80vh;">
    <h2 class="text-center mb-4">Keranjang Belanja</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(empty($keranjang) || count($keranjang) === 0)
        <p class="text-center fs-5">Keranjang masih kosong.</p>
    @else
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Gambar</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Total</th>
                        <th colspan="2" scope="col">Aksi</th>
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
                            <td class="text-start">
                                <img src="{{ asset('storage/' . $item['gambar']) }}" alt="{{ $item['nama'] }}" width="60" class="img-thumbnail">
                            </td>
                            <td class="text-start">{{ $item['nama'] }}</td>
                            <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                            <td>{{ $item['jumlah'] }}</td>
                            <td class="fw-bold">Rp {{ number_format($totalItem, 0, ',', '.') }}</td>
                            <td>
                                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $item['id'] }}" aria-label="Hapus {{ $item['nama'] }}">
                                    <i class="fa-solid fa-trash"></i> Hapus
                                </button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#checkoutModal{{ $item['id'] }}" aria-label="Checkout {{ $item['nama'] }}">
                                    <i class="fa-solid fa-cart-shopping"></i> Checkout
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tombol Checkout Semua -->
        <div class="text-end mt-3">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#checkoutSemuaModal">
                <i class="fa-solid fa-cart-plus"></i> Checkout Semua
            </button>
        </div>

        <!-- Modal Hapus & Checkout per Produk -->
        @foreach($keranjang as $item)
            <!-- Modal Hapus -->
            <div class="modal fade" id="hapusModal{{ $item['id'] }}" tabindex="-1" aria-labelledby="hapusModalLabel{{ $item['id'] }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="hapusModalLabel{{ $item['id'] }}">Konfirmasi Hapus</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            <p>Yakin ingin menghapus <strong>{{ $item['nama'] }}</strong> dari keranjang?</p>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('keranjang.hapus', $item['id']) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="jumlah_hapus" value="1">
                                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Checkout Per Produk -->
            <div class="modal fade" id="checkoutModal{{ $item['id'] }}" tabindex="-1" aria-labelledby="checkoutModalLabel{{ $item['id'] }}" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('keranjang.beli', $item['id']) }}" method="POST" class="modal-content needs-validation" novalidate>
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="checkoutModalLabel{{ $item['id'] }}">Checkout Produk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>{{ $item['nama'] }}</strong></p>
                            <div class="mb-3">
                                <label for="jumlah{{ $item['id'] }}" class="form-label">Jumlah</label>
                                <input type="number" name="jumlah" id="jumlah{{ $item['id'] }}" class="form-control" value="{{ $item['jumlah'] }}" min="1" max="{{ $item['stok'] }}" required>
                                <div class="invalid-feedback">
                                    Mohon masukkan jumlah antara 1 dan {{ $item['stok'] }}.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="alamat{{ $item['id'] }}" class="form-label">Alamat Pengiriman</label>
                                <textarea name="alamat" id="alamat{{ $item['id'] }}" class="form-control" rows="3" required></textarea>
                                <div class="invalid-feedback">
                                    Alamat pengiriman wajib diisi.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="metode_bayar{{ $item['id'] }}" class="form-label">Metode Pembayaran</label>
                                <select name="metode_bayar" id="metode_bayar{{ $item['id'] }}" class="form-select" required>
                                    <option value="" disabled selected>Pilih metode pembayaran</option>
                                    <option value="COD">Bayar di Tempat (COD)</option>
                                    <option value="transfer">Transfer Bank</option>
                                    <option value="qris">QRIS</option>
                                </select>
                                <div class="invalid-feedback">
                                    Silakan pilih metode pembayaran.
                                </div>
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
        <div class="modal fade" id="checkoutSemuaModal" tabindex="-1" aria-labelledby="checkoutSemuaModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="{{ route('pesanan.store') }}" method="POST" class="modal-content needs-validation" novalidate>
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="checkoutSemuaModalLabel">Checkout Semua Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
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
                        <p class="fw-bold fs-5">Total Semua: Rp {{ number_format($totalSemua, 0, ',', '.') }}</p>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat Pengiriman</label>
                            <textarea name="alamat" id="alamat" class="form-control" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
                            <div class="invalid-feedback">
                                Alamat pengiriman wajib diisi.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="metode_bayar" class="form-label">Metode Pembayaran</label>
                            <select name="metode_bayar" id="metode_bayar" class="form-select" required>
                                <option value="" disabled selected>Pilih metode pembayaran</option>
                                <option value="COD">Bayar di Tempat (COD)</option>
                                <option value="transfer">Transfer Bank</option>
                                <option value="qris">QRIS</option>
                            </select>
                            <div class="invalid-feedback">
                                Silakan pilih metode pembayaran.
                            </div>
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

<script>
    // Bootstrap form validation example
    (() => {
      'use strict'

      const forms = document.querySelectorAll('.needs-validation')

      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }

          form.classList.add('was-validated')
        }, false)
      })
    })()
</script>

@endsection
