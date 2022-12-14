@extends('adminlte::page')

@section('title', 'Tambah Data Buku')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Data Buku</h1>
@stop

@section('content')

    <form action="/data_buku" method="post" enctype="multipart/form-data">

        @csrf

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                    @php
                        $kategori = ['Kelas 1', 'Kelas 2', 'Kelas 3', 'Kelas 4', 'Kelas 5', 'Kelas 6', 'Umum'];
                        $topik = ['Matematika', 'Seni Budaya', 'IPA', 'IPS', 'PJOK', 'Bahasa Inggris', 'Bahasa Indonesia', 'Novel', 'Sains', 'Sejarah'];    
                    @endphp

                        <div class="form-group">
                            <label for="">Judul Buku</label>
                            <input type="text" name="judul_buku" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="">Penerbit</label>
                            <input type="text" name="penerbit_buku" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="">Penulis/Penyusun</label>
                            <input type="text" name="penulis_buku" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="">Kategori</label>
                            <select class="form-control" name="kategori" id="kategori" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategori as $i)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Topik</label>
                            <select class="form-control" name="topik" id="topik" required>
                                <option value="">-- Pilih Topik Buku --</option>
                                @foreach ($topik as $j)
                                    <option value="{{$j}}">{{$j}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Jumlah Stok</label>
                            <input type="number" name="jumlah_stok" class="form-control" required>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="/data_buku" class="btn btn-default" required>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
@stop
