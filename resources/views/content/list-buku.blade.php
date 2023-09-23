@extends('index')

@section('content')

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Manajemen Buku</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">List Buku</li>
        </ol>
        <div class="row">

        </div>
        <div class="row">

        </div>
        <div class="card mb-4">
            <div class="card-header">
                <div class="col">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahbuku1">Tambah Buku</button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-stripad table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Katagori</th>
                            <th>Penulis</th>
                            <th>Deskripsi</th>
                            <th>Tanggal Dibuat</th>
                            <th>Tanggal Diedit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i=1)
                        @foreach($data as $val)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$val->judul}}</td>
                            <td>{{$val->data_katagori->nama}}</td>
                            <td>{{$val->penulis}}</td>
                            <td>{{$val->deskripsi}}</td>
                            <td>{{$val->created_user}}</td>
                            <td>{{$val->created_at}}</td>
                            <td>{{$val->updated_user}}</td>
                            <td>{{$val->updated_at}}</td>
                            <th>
                                <a href="{{route('buku.detail',[$val->id])}}" class="btn btn-success">Detail</a>
                                <a href="{{route('buku.edit',[$val->id])}}" class="btn btn-secondary">Edit</a>
                                <a href="{{route('buku.hapus',[$val->id])}}" onclick="deleteData(this)" class="btn btn-danger">Hapus</a>
                                <!-- <a href="#" onclick="deleteData(this)" class="btn btn-danger">Hapus</a> -->
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<div class="modal fade" id="tambahbuku1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('buku.tambah')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <label for="">Judul</label>
                            <input type="text" name="judul" class="form-control" required>
                            @if ($errors->has('judul'))
                            <span class="text-danger">{{ $errors->first('judul') }}</span>
                            @endif
                        </div>
                        <div class="row">
                            <label for="">Kategori</label>
                            <select name="kategori_id" class="form-select" required>
                                <option value="">Pilih Kategori</option>
                                @foreach(\App\Models\Kategori::all() as $val)
                                <option value="{{$val->id}}">{{$val->nama}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('kategori_id'))
                            <span class="text-danger">{{ $errors->first('kategori_id') }}</span>
                            @endif
                        </div>
                        <div class="row">
                            <label for="">Penulis</label>
                            <input type="text" name="penulis" class="form-control" required>
                            @if ($errors->has('Penulis'))
                            <span class="text-danger">{{ $errors->first('Penulis') }}</span>
                            @endif
                        </div>
                        <div class="row">
                            <label for="">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control"></textarea>
                            @if ($errors->has('deskripsi'))
                            <span class="text-danger">{{ $errors->first('deskripsi') }}</span>
                            @endif
                        </div>
                        <div class="row">
                            <label for="">Foto</label>
                            <input type="file" name="foto" class="form-control" accept=".jpg,.jpeg,.png">
                            @if ($errors->has('foto'))
                            <span class="text-danger">{{ $errors->first('foto') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection