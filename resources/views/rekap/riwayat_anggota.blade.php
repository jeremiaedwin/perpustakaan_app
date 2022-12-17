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
            <td>{{$peminjaman->count()}} Peminjaman</td>
        </tr>
        <tr>
            <td>Peminjaman Telah Selesai</td>
            <td>:</td>
            <td>{{$peminjamanTelahSelesai->count()}} Peminjaman</td>
        </tr>
        <tr>
            <td>Peminjaman Belum Selesai</td>
            <td>:</td>
            <td>{{$peminjamanBelumSelesai->count()}} Peminjaman</td>
        </tr>
    </table>
    <br>
    <table class="center">
        <thead>
            <tr>
                <th>No.</th>
                <th>Judul Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
            </tr>
        </thead>
        <tbody>
            @php $no=1 @endphp
            @foreach($peminjaman as $pm)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$pm->buku->judul_buku}}</td>
                <td>{{$pm->tanggal_peminjaman}}</td>
                @if($pm->tanggal_pengembalian != null)
                <td>{{date('j F, Y', strtotime($pm->pengembalian->tanggal_pengembalian))}}</td>
                @else
                <td>{{''}}</td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>