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
                            <label for="">Anggota : </label>
                            <select name="kode_anggota" id="" class="form-control js-example-basic-single" id="select2">
                                <option value="">Pilih Anggota</option>
                                @foreach($anggota as $anggota)
                                <option value="{{$anggota->nis_anggota}}">{{$anggota->nama_anggota}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Buku : </label>
                            <select name="kode_buku" id="" class="form-control">
                                <option value="">Pilih Buku</option>
                                @foreach($buku as $buku)
                                <option value="{{$buku->id_buku}}">{{$buku->judul_buku}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Durasi Peminjaman</label>
                            <select name="durasi_peminjaman" id="" class="form-control">
                                <option value="">Pilih Opsi Peminjaman</option>
                                <option value="7">1 Minggu</option>
                                <option value="30">1 Bulan</option>
                                <option value="180">1 Semester</option>
                                <option value="365">1 Tahun</option>
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
@push('js')
    
    
@endpush