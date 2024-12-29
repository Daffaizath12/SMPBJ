@extends('Layouts.main')

@push('plugin-styles')
@endpush

@section('content')
    <div class="pagetitle">
        <h1>Manajemen Barang</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Manajemen Product</a></li>
                <li class="breadcrumb-item active">Barang</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Barang</h5>
                        <div class="text-end mb-3">
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">
                                <i class="bi bi-plus-circle"> </i>Tambah Barang
                            </button>
                        </div>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Barang</th>
                                    <th>Stok</th>
                                    <th>Harga (Rp)</th>
                                    <th>Deskripsi</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->kode }}</td>
                                        <td>{{ $product->nama_barang }}</td>
                                        <td>{{ $product->stok }}</td>
                                        <td>{{ number_format($product->harga, 0, ',', '.') }}</td>
                                        <td>{{ $product->deskripsi }}</td>
                                        <td>
                                            @if($product->gambar)
                                                <img src="{{ asset('storage/products/' . $product->gambar) }}" alt="Gambar Barang" width="50">
                                            @else
                                                Tidak ada gambar
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-info"
                                            data-bs-toggle="modal" data-bs-target="#editModal"
                                            data-id="{{ $product->id }}"
                                            data-kode="{{ $product->kode }}"
                                            data-nama="{{ $product->nama_barang }}"
                                            data-stok="{{ $product->stok }}"
                                            data-harga="{{ $product->harga }}"
                                            data-deskripsi="{{ $product->deskripsi }}"
                                            data-gambar="{{ $product->gambar }}">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Modal Tambah -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form Tambah -->
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <input type="number" name="stok" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="number" name="harga" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" required></textarea>
                        </div>
                        <div class="form-group pb-2">
                            <label for="gambar">Gambar</label>
                            <input type="file" name="gambar" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Barang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form Edit -->
                    <form id="editBarangForm" action="{{ route('products.update', ':id') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editBarangId" name="id"> <!-- Hidden field for ID -->
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="editKode" name="kode" readonly>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="editNama" name="nama" required>
                            </div>
                            <div class="col-md-6">
                                <input type="number" class="form-control" id="editStok" name="stok" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="editHarga" name="harga" required>
                            </div>
                            <div class="col-md-12">
                                <textarea class="form-control" id="editDeskripsi" name="deskripsi" rows="3" placeholder="Deskripsi"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="gambar">Gambar Saat Ini:</label><br>
                                <img id="currentImage" src="" alt="Gambar Barang" width="100" style="display:none;"><br><br>
                            </div>

                            <div class="form-group">
                                <label for="gambar">Gambar Barang</label>
                                <input type="file" class="form-control" name="gambar" accept="image/*">
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Pesan Sukses/Gagal -->
    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="statusMessage">
                    <!-- Pesan berhasil/gagal akan ditampilkan di sini -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus barang ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang memicu modal
        var id = button.data('id');

        // Set action form dengan ID produk yang benar
        var form = $(this).find('#editBarangForm');
        var actionUrl = form.attr('action').replace(':id', id);
        form.attr('action', actionUrl);

        var kode = button.data('kode');
        var nama = button.data('nama');
        var stok = button.data('stok');
        var harga = button.data('harga');
        var deskripsi = button.data('deskripsi');
        var gambar = button.data('gambar'); // URL gambar yang sudah ada

        // Isi data ke form modal
        var modal = $(this);
        modal.find('#editBarangId').val(id);
        modal.find('#editKode').val(kode);
        modal.find('#editNama').val(nama);
        modal.find('#editStok').val(stok);
        modal.find('#editHarga').val(harga);
        modal.find('#editDeskripsi').val(deskripsi);

        // Tampilkan gambar yang ada
        if (gambar) {
            modal.find('#currentImage').attr('src', "{{ asset('storage/') }}/" + gambar).show();
        } else {
            modal.find('#currentImage').hide();
        }
    });
    </script>

@endsection
