<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Anggota</title>
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
    <center><h1>Laporan Anggota</h1></center>
    <table>
        <tr>
            <td>NIS</td>
            <td>:</td>
            <td>{{$nis_anggota}}</td>
        </tr>

        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{$nama_anggota}}</td>
        </tr>
    </table>
    
    <br>
    <table class="center">
        <thead>
            <tr>
                <th>No.</th>
                <th>NIS</th>
                <th>Nama</th>
            </tr>
        </thead>

        <tbody>
            @foreach($anggota as $a)
            <tr>
                <td>{{$a->nis_anggota}}</td>
                <td>{{$a->nama_anggota}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>