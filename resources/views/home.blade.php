@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Hello {{Auth::user()->name}}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @can('get riwayat')
                        <div class="row">
                            <div class="col">
                                <center><h2>Your Profile</h2></center>
                                <table class="table table-borderless">
                                    <tr>
                                        <th width="30%">Nama</th>
                                        <th width="10%">:</th>
                                        <td width="60%">{{$profil->nama_anggota}}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">NIS</th>
                                        <th width="10%">:</th>
                                        <td width="60%">{{$profil->nis_anggota}}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">No Telepon</th>
                                        <th width="10%">:</th>
                                        <td width="60%">{{$profil->nomor_telepon_anggota}}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Email</th>
                                        <th width="10%">:</th>
                                        <td width="60%">{{Auth::user()->email}}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Tahun Masuk</th>
                                        <th width="10%">:</th>
                                        <td width="60%">{{$profil->tahun_ajaran}}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Alamat</th>
                                        <th width="10%">:</th>
                                        <td width="60%">{{$profil->alamat_anggota}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col">
                                <center><h2>Riwayat</h2></center>
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                                            <div class="card-body">
                                                <h3>{{$peminjaman->count()}}</h3>
                                                <p class="card-text">Total Peminjaman</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                                            <div class="card-body">
                                                <h3>{{$peminjamanTelahSelesai->count()}}</h3>
                                                <p class="card-text">Buku Telah Dikembalikan</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="card  bg-warning mb-3" style="max-width: 18rem;">
                                            <div class="card-body">
                                                <h3 class="text-white">{{$peminjamanBelumSelesai->count()}}</h3>
                                                <p class="card-text text-white">Belum Dikembalikan</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="accordion">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-success" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Peminjaman Telah Selesai
                                            </button>
                                        </h5>
                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                            <table class="table">
                                                <thead>
                                                    <th>Judul Buku</th>
                                                    <th>Tanggal Peminjaman</th>
                                                    <th>Tanggal Pengembalian</th>
                                                </thead>
                                                <tbody>
                                                    @foreach($peminjaman as $peminjaman)
                                                    <tr>
                                                        @if($peminjaman->tanggal_pengembalian != null)
                                                        <td>{{$peminjaman->buku->judul_buku}}</td>
                                                        <td>{{date('j F, Y', strtotime($peminjaman->tanggal_peminjaman))}}</td>
                                                            <td>{{date('j F, Y', strtotime($peminjaman->pengembalian->tanggal_pengembalian))}}</td>
                                                            <td>{{''}}</td>
                                                        @endif
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0">
                                            <button class="btn btn-primary" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                            Peminjaman Belum Selesai
                                            </button>
                                        </h5>
                                        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
                                            <table class="table">
                                                <thead>
                                                    <th>Judul Buku</th>
                                                    <th>Tanggal Peminjaman</th>
                                                    <th>Tenggat Waktu</th>
                                                </thead>
                                                <tbody>
                                                    @foreach($peminjamanBelumSelesai as $peminjaman)
                                                    <tr>
                                                        <td>{{$peminjaman->buku->judul_buku}}</td>
                                                        <td>{{date('j F, Y', strtotime($peminjaman->tanggal_peminjaman))}}</td>
                                                        <td>{{date('j F, Y', strtotime($peminjaman->tanggal_peminjaman. ' + '.$peminjaman->durasi_peminjaman.' days'))}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <a class="btn btn-info" href="/riwayat-peminjaman">
                                    Unduh PDF
                                </a>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@stop
