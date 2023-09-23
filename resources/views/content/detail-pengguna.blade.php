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
                    <label for="">Nama</label>
                    <input type="text" name="nama" class="form-control" value="{{$data->nama}}" disabled>
                </div>
                <div class="row">
                    <label for="">NIP</label>
                    <input type="text" name="nip" class="form-control" value="{{$data->nip}}" disabled>
                </div>
                <div class="row">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control" value="{{$data->email}}" disabled>
                </div>
                <div class="row">
                    <label for="">Role</label>
                    <input type="text" name="role" class="form-control" value="{{$data->role}}" disabled>
                </div>
                <div class="row">
                    <label for="">Tanggal Dibuat</label>
                    <input type="text" name="created_at" class="form-control" value="{{$data->created_at}}" disabled>
                </div>
                <div class="row">
                    <label for="">Tanggal Diedit</label>
                    <input type="text" name="updated_at" class="form-control" value="{{$data->updated_at}}" disabled>
                </div>
            </div>
        </div>
</main>
</div>

@endsection