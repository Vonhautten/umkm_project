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
                    <td><img src="{{ asset('produk/' . $item['gambar']) }}" width="50"></td>
                    <td>{{ $item['nama'] }}</td>
                    <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                    <td>{{ $item['jumlah'] }}</td>
                    <td>Rp {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</td>
                    <td>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $item['id'] }}">
                            <i class="fa-solid fa-trash"></i> Hapus
                        </button>
                    </td>
                </tr>

                <!-- Modal Konfirmasi -->
                <div class="modal fade" id="hapusModal{{ $item['id'] }}" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Konfirmasi Penghapusan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @if($item['jumlah'] > 1)
                                    <p>Masukkan jumlah produk yang ingin dihapus:</p>
                                    <form action="{{ route('keranjang.hapus', $item['id']) }}" method="POST">
                                        @csrf
                                        <input type="number" name="jumlah_hapus" class="form-control" min="1" max="{{ $item['jumlah'] }}" required>
                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </form>
                                @else
                                    <p>Apakah Anda yakin ingin menghapus produk ini?</p>
                                    <form action="{{ route('keranjang.hapus', $item['id']) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="jumlah_hapus" value="1">
                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </form>
                                @endif
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
