@extends('Layouts.main')

@push('plugin-styles')
@endpush

@section('content')
    <div class="pagetitle">
        <h1>Manajemen Barang</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item">Manajemen Product</a></li>
                <li class="breadcrumb-item active">Pesanan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Pesanan</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Pemesan</th>
                                        <th>Produk</th>
                                        <th>Status</th>
                                        <th>Tanggal Ambil</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $key => $order)
                                        <tr id="order-row-{{ $order->id }}">
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $order->name }}</td>
                                            <td>{{ $order->product->nama_barang }}</td>
                                            <td>{{ ucfirst($order->status) }}</td>
                                            <td>{{ $order->tanggal_ambil }}</td>
                                            <td>{{ $order->tanggal_kembali }}</td>
                                            <td>
                                                <div class="d-flex" id="action-buttons-{{ $order->id }}">
                                                    <form action="{{ route('orders.update', $order->id) }}" method="POST" class="me-2">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="hideButtons({{ $order->id }}, 'Terima')">Terima</button>
                                                    </form>
                                                    <form action="{{ route('orders.reject', $order->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="hideButtons({{ $order->id }}, 'Tolak')">Tolak</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function hideButtons(orderId, action) {
            // Temukan elemen tombol berdasarkan ID baris
            const actionButtons = document.getElementById(`action-buttons-${orderId}`);

            // Jika aksi adalah "Terima", hapus tombol "Tolak"
            if (action === 'Terima') {
                actionButtons.querySelector('.btn-danger').remove();
            }
            // Jika aksi adalah "Tolak", hapus tombol "Terima"
            if (action === 'Tolak') {
                actionButtons.querySelector('.btn-success').remove();
            }
        }
    </script>

@endsection
