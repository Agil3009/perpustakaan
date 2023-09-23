@extends('index')

@section('content')
<main>
    <div class="container-fluid px-4 mt-4">
        <div class="card">
            <div class="card-header">
                Detail Kategori
            </div>
            <div class="card-body m-2">
                <div class="row">
                    <label for="">Nama</label>
                    <input type="text" name="nama" class="form-control" value="{{$data->nama}}" disabled>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection