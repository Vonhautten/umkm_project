<div id="modalEdit" class="modal" style="display: none; background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; justify-content: center; align-items: center;">
    <div class="card p-4" style="width: 400px;">
        <h5 class="text-center">Edit Produk</h5>
        <form id="formEdit" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="text" name="nama_produk" id="editNama" class="form-control mb-2" placeholder="Nama Produk" required>
            
            <select name="id_kategori" id="editKategori" class="form-control mb-2" required>
                <option value="">Pilih Kategori</option>
                @foreach($kategori as $kat)
                    <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                @endforeach
            </select>

            <textarea name="deskripsi" id="editDeskripsi" class="form-control mb-2" placeholder="Deskripsi"></textarea>

            <input type="number" name="harga" id="editHarga" class="form-control mb-2" placeholder="Harga" required>
            <input type="number" name="stok" id="editStok" class="form-control mb-2" placeholder="Stok" required>
            
            <label for="editGambar">Gambar Produk</label>
            <input type="file" name="gambar" id="editGambar" class="form-control mb-2">
            
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <button type="button" class="btn btn-secondary" id="btnTutupEdit">Tutup</button>
        </form>
    </div>
</div>
