@extends('adminlte::page')

@section('title', 'Update Peminjaman')

@section('content_header')
    <h1 class="m-0 text-dark">Update Peminjaman</h1>
@stop

@section('content')
    <form action="/peminjaman/{{$peminjaman->kode_peminjaman}}" method="post">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                    <div class="form-group">
                            <label for="exampleInputName">Kode Peminjaman</label>
                            <input disabled type="text" class="form-control @error('kode_peminjaman') is-invalid @enderror" id="exampleInputName" placeholder="kode peminjaman" name="kode_peminjaman" value="{{$peminjaman->kode_peminjaman}}">
                            @error('kode_peminjaman') <span class="text-danger">{{$message}}</span> @enderror
                        </div>


                        <div class="form-group">
                            <label for="">Tanggal Pengembalian</label>
                            <input type="date" name="tanggal_pengembalian" id="" value="{{$peminjaman->tanggal_pengembalian}}" class="form-control">
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{route('peminjaman.index')}}" class="btn btn-default">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
@stop
