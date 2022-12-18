@extends('adminlte::page')

@section('title', 'Data Pembendaharaan Buku')

@section('content_header')
        <h1 class="m-0 text-dark">Data Pembendaharaan Buku</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <a href="/data_buku/create" class="btn btn-primary mb-2">
                        Tambah
                    </a>

                    <table class="table table-hover table-bordered table-stripped" id="data_buku">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>ID Buku</th>
                            <th>Judul Buku</th>
                            <th>Penerbit</th>
                            <th>Penulis/Penyusun</th>
                            <th>Kategori</th>
                            <th>Topik</th>
                            <th>Jumlah Stok</th>
                            <th>Jumlah Tersedia</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php 
                        $no =1  
                        @endphp
                        @foreach($data_buku as $a)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$a->id_buku}}</td>
                                <td>{{$a->judul_buku}}</td>
                                <td>{{$a->penerbit_buku}}</td>
                                <td>{{$a->penulis_buku}}</td>
                                <td>{{$a->kategori}}</td>
                                <td>{{$a->topik}}</td>
                                <td>{{$a->jumlah_stok}}</td>
                                <td>{{$a->jumlah_tersedia}}</td>
                                <td>
                                <a href="/data_buku/{{$a->id_buku}}/edit" class="btn btn-primary btn-xs">
                                        Edit
                                    </a>
                                    <form action="data_buku/{{$a->id_buku}}" id="delete-form" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-xs">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    
    <script>
        $('#data_buku').DataTable({
            "responsive": true,
        });

        function notificationBeforeDelete(event, el) {
            event.preventDefault();
            if (confirm('Apakah anda yakin akan menghapus data ? ')) {
                $("#delete-form").attr('action', $(el).attr('href'));
                $("#delete-form").submit();
            }
        }

    </script>
@endpush
