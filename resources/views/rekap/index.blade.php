<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table.center {
            border: 1px solid black;
            margin-left: auto;
            margin-right: auto;
        }
        table.center th{
            border: 1px solid black;
        }
        table.center td{
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <center><h1>Laporan Peminjaman</h1></center>
    <table>
        <tr>
            <td>Total Peminjaman</td>
            <td>:</td>
            <td>{{$peminjamanTotal}}</td>
        </tr>
        <tr>
            <td>Peminjaman Telah Selesai</td>
            <td>:</td>
            <td>{{$peminjamanTelahSelesai}}</td>
        </tr>
        <tr>
            <td>Peminjaman Belum Selesai</td>
            <td>:</td>
            <td>{{$peminjamanBelumSelesai}}</td>
        </tr>
    </table>
    <br>
    <table class="center">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Peminjam</th>
                <th>Judul Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjaman as $pm)
            <tr>
                <td>{{$pm->kode_peminjaman}}</td>
                <td>{{$pm->kode_peminjam}}</td>
                <td>{{$pm->kode_buku}}</td>
                <td>{{$pm->tanggal_peminjaman}}</td>
                <td>{{$pm->tanggal_pengembalian}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>