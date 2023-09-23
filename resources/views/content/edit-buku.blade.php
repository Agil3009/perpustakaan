@extends('index')

@section('content')
<main>
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                Edit Pengguna
            </div>
            <div class="card-body m-2">
                <form action="{{route('buku.update',[$data->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <label for="">Judul</label>
                        <input type="text" name="judul" class="form-control" value="{{$data->judul}}" required>
                        @if ($errors->has('judul'))
                        <span class="text-danger">{{ $errors->first('judul') }}</span>
                        @endif
                    </div>
                    <div class="row">
                        <label for="">Kategori</label>
                        <select name="kategori_id" class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            @foreach(\App\Models\Kategori::all() as $val)
                            <option value="{{$val->id}}" {{$data->data_katagori->nama == $val->nama ?'selected':''}}>{{$val->nama}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('kategori_id'))
                        <span class="text-danger">{{ $errors->first('kategori_id') }}</span>
                        @endif
                    </div>
                    <div class="row">
                        <label for="">Penulis</label>
                        <input type="text" name="penulis" class="form-control" value="{{$data->penulis}}" required>
                        @if ($errors->has('Penulis'))
                        <span class="text-danger">{{ $errors->first('Penulis') }}</span>
                        @endif
                    </div>
                    <div class="row">
                        <label for="">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control">{{$data->deskripsi}}</textarea>
                        @if ($errors->has('deskripsi'))
                        <span class="text-danger">{{ $errors->first('deskripsi') }}</span>
                        @endif
                    </div>
                    <div class="row">
                        <label for="">Foto</label>
                        <input type="file" name="foto" class="form-control" value="{{old('foto')}}" accept=".jpg,.jpeg,.png">
                        @if ($errors->has('foto'))
                        <span class="text-danger">{{ $errors->first('foto') }}</span>
                        @endif
                    </div>
                    <div class="row d-flex justify-content-center mt-2">
                        <img src="/storage/images/{{$data->foto}}" class="img-fluid col-6" alt="">
                    </div>
                    <div class="row pt-2">
                        <button type="submit" class="btn btn-success">Ubah Data</button>
                    </div>
                </form>
            </div>
        </div>
</main>
</div>

@endsection