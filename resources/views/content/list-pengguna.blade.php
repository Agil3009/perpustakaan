@extends('index')

@section('content')

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Manajemen Pengguna</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">List Pengguna</li>
        </ol>
        <div class="row">

        </div>
        <div class="row">

        </div>
        <div class="card mb-4">
            <div class="card-header">
                <div class="col">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahpengguna1">Tambah Pengguna</button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-stripad table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Tanggal Dibuat</th>
                            <th>Tanggal Diedit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i=1)
                        @foreach($data as $val)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$val->nama}}</td>
                            <td>{{$val->nip}}</td>
                            <td>{{$val->email}}</td>
                            <td>{{$val->role}}</td>
                            <td>{{$val->created_at}}</td>
                            <td>{{$val->updated_at}}</td>
                            <th>
                                <a href="{{route('pengguna.detail',[$val->id])}}" class="btn btn-success">Detail</a>
                                <a href="{{route('pengguna.edit',[$val->id])}}" class="btn btn-secondary">Edit</a>
                                <a href="{{route('pengguna.hapus',[$val->id])}}" onclick="deleteData(this)" class="btn btn-danger">Hapus</a>
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
<div class="modal fade" id="tambahpengguna1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Katagori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('pengguna.tambah')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <label for="">Nama</label>
                            <input type="text" name="nama" class="form-control" required value="{{old('nama')}}">
                            @if($errors->has("nama"))
                            <span class="taxt-danger">{{$errors->first("nama")}}</span>
                            @endif
                        </div>
                        <div class="row">
                            <label for="">NIP</label>
                            <input type="text" name="nip" class="form-control" required value="{{old('nip')}}">
                            @if($errors->has("nip"))
                            <span class="taxt-danger">{{$errors->first("nip")}}</span>
                            @endif
                        </div>
                        <div class="row">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" required value="{{old('email')}}">
                            @if($errors->has("email"))
                            <span class="taxt-danger">{{$errors->first("email")}}</span>
                            @endif
                        </div>
                        <div class="row">
                            <label for="">Role</label>
                            <select name="role" id="role" class="form-select" required>
                                <option value="">Pilih...</option>
                                <option value="Admin" {{old('role')=='Admin'?'selected':''}}>Admin</option>
                                <option value="Pustakawan" {{old('role')=='Pustakawanx'?'selected':''}}>Pustakawan</option>
                            </select>
                            @if($errors->has("role"))
                            <span class="taxt-danger">{{$errors->first("role")}}</span>
                            @endif
                        </div>
                        <div class="row">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control" required value="{{old('password')}}">
                            @if($errors->has("password"))
                            <span class="text-danger">{{$errors->first("password")}}</span>
                            @endif
                        </div>
                        <div class="row">
                            <label for="">Retype Password</label>
                            <input type="password" name="retype_password" class="form-control" required value="{{old('retype_password')}}">
                            @if($errors->has("retype_password"))
                            <span class="text-danger">{{$errors->first("retype_password")}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection