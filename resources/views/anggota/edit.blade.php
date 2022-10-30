@extends('adminlte::page')

@section('title', 'Update Anggota')

@section('content_header')
    <h1 class="m-0 text-dark">Update Anggota</h1>
@stop

@section('content')
    <form action="/anggota/{{$anggota->id_anggota}}" method="post">
    @method('PUT')
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                    <div class="form-group">
                            <label for="exampleInputName">id_anggota</label>
                            <input disabled type="text" class="form-control @error('id_anggota') is-invalid @enderror" id="exampleInputName" placeholder="id anggota" name="id_anggota" value="{{$anggota->id_anggota}}">
                            @error('id_anggota') <span class="text-danger">{{$message}}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="">nama_anggota</label>
                            <input type="text" name="nama_anggota" id="" value="{{$anggota->nama_anggota}}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputName">nis_anggota</label>
                            <input disabled type="text" class="form-control @error('nis_anggota') is-invalid @enderror" id="exampleInputName" placeholder="nis anggota" name="nis_anggota" value="{{$anggota->nis_anggota}}">
                            @error('nis_anggota') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="">alamat_anggota</label>
                            <input type="text" name="alamat_anggota" id="" value="{{$anggota->alamat_anggota}}" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="">nomor_telepon_anggota</label>
                            <input type="text" name="nomor_telepon_anggota" id="" value="{{$anggota->nomor_telepon_anggota}}" class="form-control">
                        </div> 
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{route('anggota.index')}}" class="btn btn-default">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
@stop