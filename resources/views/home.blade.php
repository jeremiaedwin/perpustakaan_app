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
                                <table class="table">
                                    <tr>
                                        <th width="30%">Nama</th>
                                        <th width="10%">:</th>
                                        <td width="60%">Agus</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">NIS</th>
                                        <th width="10%">:</th>
                                        <td width="60%">211511039</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">No Telepon</th>
                                        <th width="10%">:</th>
                                        <td width="60%">081322528480</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Email</th>
                                        <th width="10%">:</th>
                                        <td width="60%">agus@mail.com</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Tahun Masuk</th>
                                        <th width="10%">:</th>
                                        <td width="60%">2018</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col">
                                <center><h2>Riwayat</h2></center>
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                                            <div class="card-body">
                                                <h3>4</h3>
                                                <p class="card-text">Total Peminjaman</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                                            <div class="card-body">
                                                <h3>3</h3>
                                                <p class="card-text">Buku Telah Dikembalikan</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="card  bg-warning mb-3" style="max-width: 18rem;">
                                            <div class="card-body">
                                                <h3 class="text-white">1</h3>
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
                                                <tr>
                                                    <th>Judul</th>
                                                    <th>Tanggal Peminjaman</th>
                                                    <th>Tanggal Pengembalian</th>
                                                </tr>
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
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                            <table class="table">
                                                <tr>
                                                    <th>Judul</th>
                                                    <th>Tanggal Peminjaman</th>
                                                    <th>Tanggal Tenggat</th>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header" id="headingThree">
                                        <h5 class="mb-0">
                                            <button class="btn btn-danger" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                            Peminjaman Telah Melebihi Tenggat Waktu
                                            </button>
                                        </h5>
                                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                            <table class="table">
                                                <tr>
                                                    <th>Judul</th>
                                                    <th>Tanggal Peminjaman</th>
                                                    <th>Tanggal Tenggat</th>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@stop
