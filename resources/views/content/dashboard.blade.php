@extends('index')

@section('content')

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-header">
                        <h6>Stok Peminjam</h6>
                    </div>
                    <div class="card-body">
                        {{\App\Models\Transaksi::where(['status' => 'pinjam'])->count('buku_id');}}
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-header">
                        <h6>Buku Kembali</h6>
                    </div>
                    <div class="card-body">
                        {{\App\Models\Transaksi::where(['status' => 'kembali'])->count('buku_id');}}
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-header">
                        <h6>Terlambat Kembali</h6>
                    </div>
                    <div class="card-body">
                        {{\App\Models\Transaksi::where(['status' => 'kembali', 'st_kembali' => 'telat'])->count('buku_id');}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Buku Pinjam
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-stripad table-hover">
                            <thead>
                                <tr>
                                    <th>Nama </th>
                                    <th>Judul Buku</th>
                                    <th>Tanggal Pinjam</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($bukuPinjam as $item)
                                <tr>
                                    <td>{{$item->nama??''}}</td>
                                    <td>{{$item->data_buku->judul??''}}</td>
                                    <td>{{$item->tanggal??''}}</td>
                                </tr>
                                @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Buku Kembali
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-stripad table-hover">
                            <thead>
                                <tr>
                                    <th>Nama </th>
                                    <th>Judul Buku</th>
                                    <th>Tanggal kembali</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bukuKembali as $item)
                                <tr>
                                    <td>{{$item->nama??''}}</td>
                                    <td>{{$item->data_buku->judul??''}}</td>
                                    <td>{{$item->tanggal??''}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Buku Telat Kembali
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-stripad table-hover">
                            <thead>
                                <tr>
                                    <th>Nama </th>
                                    <th>Judul Buku</th>
                                    <th>Tanggal kembali</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bukuKembaliTelat as $item)
                                <tr>
                                    <td>{{$item->nama??''}}</td>
                                    <td>{{$item->data_buku->judul??''}}</td>
                                    <td>{{$item->tanggal??''}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

@endsection