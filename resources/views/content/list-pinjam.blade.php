@extends('index')

@section('content')

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Pinjam Buku</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">List Peminjam Buku</li>
        </ol>
        <div class="row">

        </div>
        <div class="row">

        </div>
        <div class="card mb-4">
            <div class="card-header">
                <h5>Tambah Peminjam</h5>
            </div>
            <div class="card-body">
                <form action="{{route('pinjam.simpan')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" name="nama" value="{{old('nama')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="">Alamat</label>
                            <input type="text" class="form-control" name="alamat" value="{{old('alamat')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="">Buku</label>
                            <select name="buku_id" class="form-select" required>
                                <option value="">Pilih Buku</option>
                                @foreach (\App\Models\buku::all() as $item)
                                <option value="{{$item->id}}" {{old('buku_id')==$item->id?'selected':''}}>{{$item->judul}}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="">Pilih Status</option>
                                <option value="pinjam" {{old('status')=='pinjam'?'selected':''}}>Pinjam</option>
                                <option value="kembali" {{old('status')=='kembali'?'selected':''}}>Kembali</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" value="{{old('Tanggal')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-2">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <h5>List Peminjam</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-stripad table-hover">
                    <thead>
                        <tr>
                            <th>Nama Peminjam</th>
                            <th>Alamat</th>
                            <th>Buku</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Status Kembali</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->alamat}}</td>
                            <td>{{$item->data_buku->judul}}</td>
                            <td>{{$item->status}}</td>
                            <td>{{$item->tanggal}}</td>
                            <td>{{$item->st_kembali}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<div class="modal fade" id="pinjambuku" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Katagori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
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
                                <option value="Pustakawan" {{old('role')=='Pustakawanx'?'selected':''}}>Staff</option>
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