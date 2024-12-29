@extends('UserLayout.main')

@push('plugin-styles')
@endpush

@section('content')
<div class="pagetitle">
    <h1>Penyewaan Barang dan Jasa</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg">
        <div class="row">

          <!-- Sales Card -->
          @foreach($products as $product)
            <div class="col-xxl-4 col-md-6">
                <div class="card">
                    <!-- Tampilkan gambar produk -->
                    <img src="{{ asset('storage/products/' . $product->gambar) }}" class="card-img-top" alt="Gambar Barang">

                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Nama Barang -->
                            <h5 class="card-title">{{ $product->nama_barang }}</h5>
                            <!-- Status Tersedia (di sebelah kanan) -->
                            <span class="badge bg-success">Tersedia</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <!-- Button Sewa Sekarang (di sebelah kanan) -->
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#orderModal" data-productid="{{ $product->id }}" data-productname="{{ $product->nama_barang }}">
                                Sewa Sekarang
                            </button>
                            <!-- Harga (di sebelah kiri) -->
                            <p class="card-text"><strong>Harga:</strong> Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

      </div><!-- End Left side columns -->
      <!-- Modal Order -->
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Pesan Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="form-group">
                        <label for="name">Nama:</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Telepon:</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="address">Alamat:</label>
                        <input type="text" name="address" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_ambil">Tanggal Ambil:</label>
                        <input type="date" name="tanggal_ambil" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_kembali">Tanggal Kembali:</label>
                        <input type="date" name="tanggal_kembali" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select name="status" class="form-control" required>
                            <option value="pending">Pending</option>
                            <option value="verified">Verified</option>
                            <option value="failed">Failed</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Pesan</button>
                </div>
            </div>
        </form>
    </div>
</div>

    </div>
  </section>

  <script>
    // JavaScript untuk mengatur product_id di modal
    $('#orderModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang diklik
        var productId = button.data('productid'); // Ambil data product_id dari tombol

        var modal = $(this);
        modal.find('input[name="product_id"]').val(productId); // Set nilai input product_id
    });
</script>
  @endsection
