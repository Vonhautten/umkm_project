@extends('user.layouts')

@section('title', 'Keranjang - UMKM Store')

@section('content')

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
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($keranjang as $item)
                <tr>
                    <td><img src="{{ asset('storage/produk/' . $item['gambar']) }}" width="50"></td>
                    <td>{{ $item['nama'] }}</td>
                    <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                    <td>{{ $item['jumlah'] }}</td>
                    <td>Rp {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</td>
                    <td>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $item['id'] }}">
                            <i class="fa-solid fa-trash"></i> Hapus
                        </button>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#beliModal{{ $item['id'] }}">
                            <i class="fa-solid fa-shopping-cart"></i> Beli
                        </button>
                    </td>
                </tr>

                <!-- Modal Konfirmasi Hapus -->
                <div class="modal fade" id="hapusModal{{ $item['id'] }}" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Konfirmasi Penghapusan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Apakah Anda yakin ingin menghapus produk ini?</p>
                                <form action="{{ route('keranjang.hapus', $item['id']) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="jumlah_hapus" value="1">
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Konfirmasi Beli -->
                <div class="modal fade" id="beliModal{{ $item['id'] }}" tabindex="-1" aria-labelledby="beliModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Konfirmasi Pembelian</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Anda akan membeli <b>{{ $item['jumlah'] }}x {{ $item['nama'] }}</b> dengan total harga <b>Rp {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</b>. Lanjutkan?</p>
                                <form action="{{ route('keranjang.beli', $item['id']) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="jumlah" value="{{ $item['jumlah'] }}">
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-success">Ya, Beli</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection
