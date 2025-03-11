<div id="modalTambah" class="modal" style="display: none; background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; justify-content: center; align-items: center;">
    <div class="card p-4" style="width: 400px;">
        <h5 class="text-center">Tambah Produk</h5>
        <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="nama_produk" class="form-control mb-2" placeholder="Nama Produk" required>
            <select name="id_kategori" class="form-control mb-2" required>
                <option value="">Pilih Kategori</option>
                @foreach($kategori as $kat)
                    <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                @endforeach
            </select>
            <textarea name="deskripsi" class="form-control mb-2" placeholder="Deskripsi"></textarea>
            <input type="number" name="harga" class="form-control mb-2" placeholder="Harga" required>
            <input type="number" name="stok" class="form-control mb-2" placeholder="Stok" required>
            <input type="file" name="gambar" class="form-control mb-2" required>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" id="btnTutup">Tutup</button>
            </div>
        </form>
    </div>
</div>