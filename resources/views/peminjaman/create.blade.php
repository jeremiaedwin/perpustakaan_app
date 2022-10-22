@extends('adminlte::page')

@section('title', 'Tambah Peminjaman')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Peminjaman</h1>
@stop

@section('content')
    <form action="{{route('peminjaman.store')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                    <div class="form-group">
                            <label for="exampleInputName">Kode Peminjaman</label>
                            <input type="text" class="form-control @error('kode_peminjaman') is-invalid @enderror" id="exampleInputName" placeholder="kode peminjaman" name="kode_peminjaman" value="{{old('kode_peminjaman')}}">
                            @error('kode_peminjaman') <span class="text-danger">{{$message}}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Anggota : </label>
                            <select name="kode_peminjam" id="" class="form-control">
                                <option value="">Pilih Anggota</option>
                                <option value="US01">Asep</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Buku : </label>
                            <select name="kode_buku" id="" class="form-control">
                                <option value="">Pilih Buku</option>
                                <option value="BK01">Atomic Habbit</option>
                            </select>
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
