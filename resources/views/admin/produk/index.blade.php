@extends('admin.layouts')

@section('title', 'Produk - UMKM Store')

@section('content')

<div class="container my-4">
    <div class="text-center mb-3">
        <h2>Daftar Produk</h2>
    </div>

    <div class="d-flex justify-content-end text-end mb-3">
        <button class="btn btn-success" id="btnTambah">Tambah Produk</button>
    </div>
    
    <div class="row">
        @foreach($produk as $item)
        <div class="col-md-3 mb-4">
            <div class="card shadow produk-card">
                <div class="image-container">
                    <img src="{{ Storage::url($item->gambar) }}" class="card-img-top img-produk" alt="{{ $item->nama_produk }}">
                </div>
                <div class="card-body text-center p-3"> <!-- Tambahkan padding di sini -->
                    <h5 class="card-title">{{ $item->nama_produk }}</h5>
                    <p class="card-text">{{ Str::limit($item->deskripsi, 50) }}</p>
                    <p class="text-success fw-bold">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                    <div class="d-flex justify-content-center gap-2">
                        <button class="btn btn-primary btn-sm btnEdit"
                            data-id="{{ $item->id }}" 
                            data-nama="{{ $item->nama_produk }}" 
                            data-kategori="{{ $item->id_kategori }}" 
                            data-deskripsi="{{ $item->deskripsi }}" 
                            data-harga="{{ $item->harga }}" 
                            data-stok="{{ $item->stok }}">
                            Edit
                        </button>
                        <form action="{{ route('admin.produk.destroy', $item->id) }}" method="POST" class="d-inline formHapus">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm btnHapus">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Modal Tambah Produk -->
@include('admin.produk.modal_tambah')

<!-- Modal Edit Produk -->
@include('admin.produk.modal_edit')

<!-- CSS untuk mengatur ukuran gambar & card -->
<style>
    .produk-card {
        height: 100%; /* Semua card sama tinggi */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 15px; /* Tambahkan padding di dalam card */
        border-radius: 10px; /* Bikin sudut card lebih halus */
    }

    .image-container {
        width: 100%;
        height: 200px; /* Ukuran gambar tetap */
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        border-radius: 8px; /* Agar gambar tidak mepet ke ujung */
    }

    .img-produk {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain; /* Resize otomatis tanpa crop */
    }

    .card-body {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('btnTambah').addEventListener('click', function() {
            document.getElementById('modalTambah').style.display = 'flex';
        });

        document.getElementById('btnTutup').addEventListener('click', function() {
            document.getElementById('modalTambah').style.display = 'none';
        });

        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('btnEdit')) {
                let button = event.target;
                document.getElementById('editNama').value = button.dataset.nama;
                document.getElementById('editKategori').value = button.dataset.kategori;
                document.getElementById('editDeskripsi').value = button.dataset.deskripsi;
                document.getElementById('editHarga').value = button.dataset.harga;
                document.getElementById('editStok').value = button.dataset.stok;
                document.getElementById('formEdit').action = '/admin/produk/' + button.dataset.id;
                document.getElementById('modalEdit').style.display = 'flex';
            }
        });

        document.getElementById('btnTutupEdit').addEventListener('click', function() {
            document.getElementById('modalEdit').style.display = 'none';
        });

        document.querySelectorAll('.formHapus').forEach(form => {
            form.addEventListener('submit', function(event) {
                if (!confirm("Apakah Anda yakin ingin menghapus produk ini?")) {
                    event.preventDefault();
                }
            });
        });
    });
</script>
@endsection