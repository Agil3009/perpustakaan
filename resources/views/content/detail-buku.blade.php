@extends('index')

@section('content')
<main>
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                Detail Pengguna
            </div>
            <div class="card-body m-2">
                <div class="row">
                    <label for="">Judul</label>
                    <input type="text" name="judul" class="form-control" value="{{$data->judul}}" disabled>
                </div>
                <div class="row">
                    <label for="">Kategori</label>
                    <input type="text" name="kategori" class="form-control" value="{{$data->data_katagori->nama}}" disabled>
                </div>
                <div class="row">
                    <label for="">Penulis</label>
                    <input type="email" name="penulis" class="form-control" value="{{$data->penulis}}" disabled>
                </div>
                <div class="row">
                    <label for="">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" disabled>{{$data->deskripsi}}</textarea>
                </div>
                <div class="row">
                    <label for="">Tanggal Dibuat</label>
                    <input type="text" name="created_at" class="form-control" value="{{$data->created_at}}" disabled>
                </div>
                <div class="row">
                    <label for="">Tanggal Diedit</label>
                    <input type="text" name="updated_at" class="form-control" value="{{$data->updated_at}}" disabled>
                </div>
                <div class="row d-flex justify-content-center">
                    <img src="/storage/images/{{$data->foto}}" class="img-fluid col-6" alt="">
                </div>
            </div>
        </div>
</main>
</div>

@endsection