@extends('adminlte::page')

@section('title', 'Tambah Data Buku')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Data Buku</h1>
@stop

@section('content')
    <form action="/data_buku" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">ID Buku</label>
                            <input type="text" name="id_buku" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Judul Buku</label>
                            <input type="text" name="judul_buku" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Penerbit</label>
                            <input type="text" name="penerbit_buku" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Penulis/Penyusun</label>
                            <input type="text" name="penulis_buku" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Jumlah Stok</label>
                            <input type="number" name="jumlah_stok" class="form-control">
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
