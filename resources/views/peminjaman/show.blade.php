@extends('adminlte::page')

@section('title', 'Detail Peminjaman')

@section('content_header')
    <h1 class="m-0 text-dark">Detail Peminjaman</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th>Informasi Peminjam</th>
                        </tr>
                        <tr>
                            <td>NIS</td>
                            <td>:</td>
                            <td>{{$peminjaman->kode_peminjam}}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{$peminjaman->anggota->nama_anggota}}</td>
                        </tr>
                        <tr>
                            <th>Informasi Buku</th>
                        </tr>
                        <tr>
                            <td>Kode</td>
                            <td>:</td>
                            <td>{{$peminjaman->kode_buku}}</td>
                        </tr>
                        <tr>
                            <td>Judul</td>
                            <td>:</td>
                            <td>{{$peminjaman->buku->judul_buku}}</td>
                        </tr>
                        <tr>
                            <th>Informasi Peminjaman</th>
                        </tr>
                        <tr>
                            <td>Kode Peminjaman</td>
                            <td>:</td>
                            <td>{{$peminjaman->kode_peminjaman}}</td>
                        </tr>
                        <tr>
                            <td>Durasi Peminjaman</td>
                            <td>:</td>
                            <td>{{$peminjaman->durasi_peminjaman}} Hari</td>
                        </tr>
                        <tr>
                            <td>Tanggal Peminjaman</td>
                            <td>:</td>
                            <td>{{date('j F, Y', strtotime($peminjaman->tanggal_peminjaman))}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Tenggat</td>
                            <td>:</td>
                            <td>{{date('j F, Y', strtotime($hari))}}</td>
                        </tr>
                        <tr>
                            <td>Status Peminjaman</td>
                            <td>:</td>
                            @if($telah_kembali)
                            <td>Selesai</td>
                            @else
                            <td>Belum Selesai</td>
                            @endif
                        </tr>
                        <tr>
                            <td>Tanggal Pengembalian</td>
                            <td>:</td>
                            @if($telah_kembali)
                            <td>{{date('j F, Y', strtotime($peminjaman->pengembalian->tanggal_pengembalian))}}</td>
                            @endif
                        </tr>
                    </table>
                    <a href="/peminjaman" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
@endpush
