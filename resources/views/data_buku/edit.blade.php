@extends('adminlte::page')

@section('title', 'Update Data Buku')

@section('content_header')
    <h1 class="m-0 text-dark">Update Data Buku</h1>
@stop

@section('content')
    <form action="/data_buku/{{$data_buku->id_buku}}" method="post">
    @method('PUT')
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                    <div class="form-group">
                            <label for="exampleInputName">id_buku</label>
                            <input disabled type="text" class="form-control @error('id_buku') is-invalid @enderror" id="exampleInputName" placeholder="id buku" name="id_buku" value="{{$data_buku->id_buku}}">
                            @error('id_buku') <span class="text-danger">{{$message}}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="">judul_buku</label>
                            <input type="text" name="judul_buku" id="" value="{{$data_buku->judul_buku}}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputName">penerbit_buku</label>
                            <input type="text" name="penerbit_buku" id="" value="{{$data_buku->penerbit_buku}}" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="">penulis_buku</label>
                            <input type="text" name="penulis_buku" id="" value="{{$data_buku->penulis_buku}}" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="">jumlah_stok</label>
                            <input type="text" name="jumlah_stok" id="" value="{{$data_buku->jumlah_stok}}" class="form-control">
                        </div> 
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="/data_buku" class="btn btn-default">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
@stop