@extends('index')

@section('content')

<main>
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                Ubah Kategori
            </div>
            <div class="card-body m-2">
                <form action="{{route('kategori.update',[$data->id])}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <label for="">Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{$data->nama}}" required>
                        @if($errors->has("nama"))
                        <span class="text-danger">{{$errors->first("nama")}}</span>
                        @endif
                    </div>
                    <div class="row pt-2">
                        <button type="submit" class="btn btn-success">Ubah Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

@endsection