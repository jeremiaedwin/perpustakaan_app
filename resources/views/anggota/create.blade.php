@extends('adminlte::page')

@section('title', 'Tambah Anggota')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Anggota</h1>
@stop

@section('content')
    <form action="{{route('anggota.store')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                    <div class="form-group">
                        <label for="">NIS Anggota</label>
                        <input type="text" name="nis_anggota" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Nama Anggota</label>
                        <input type="text" name="nama_anggota" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Alamat Anggota</label>
                        <input type="text" name="alamat_anggota" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Nomor Telepon Anggota</label>
                        <input type="text" name="nomor_telepon_anggota" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Email Anggota</label>
                        <input type="text" name="email_anggota" class="form-control">
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
