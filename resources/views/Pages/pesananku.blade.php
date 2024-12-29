@extends('UserLayout.main')

@push('plugin-styles')
@endpush

@section('content')
    <div class="pagetitle">
        <h1>Manajemen Pesanan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Manajemen Pesanan</li>
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

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Barang</th>
                                    <th>Tanggal Pesan</th>
                                    <th>Tanggal Ambil</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order->product->nama_barang }}</td>
                                        <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                        <!-- Tanggal ambil -->
                                        <td>{{ $order->tanggal_ambil }}</td>
                                        <!-- Tanggal kembali -->
                                        <td>{{ $order->tanggal_kembali }}</td>
                                        <td>
                                            <span class="badge
                                                {{ $order->status == 'pending' ? 'bg-warning' :
                                                ($order->status == 'berhasil' ? 'bg-success' :
                                                ($order->status == 'gagal' ? 'bg-danger' : '')) }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
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
@endsection
