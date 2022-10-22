@extends('adminlte::page')

@section('title', 'List Peminjaman')

@section('content_header')
    <h1 class="m-0 text-dark">List Peminjaman</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <a href="{{route('peminjaman.create')}}" class="btn btn-primary mb-2">
                        Tambah
                    </a>

                    <table class="table table-hover table-bordered table-stripped" id="example2">
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
                        @php $no =1  @endphp
                        @foreach($peminjaman as $pm)
                            <tr>
                                <td>{{$no+1}}</td>
                                <td>{{$pm->kode_peminjam}}</td>
                                <td>{{$pm->kode_buku}}</td>
                                <td>{{$pm->tanggal_peminjaman}}</td>
                                <td>{{$pm->tanggal_pengembalian}}</td>
                                <td>
                                    <a href="/peminjaman/{{$pm->kode_peminjaman}}/edit" class="btn btn-primary btn-xs">
                                        Edit
                                    </a>
                                    <form action="peminjaman/{{$pm->kode_peminjaman}}" id="delete-form" method="post">
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
        $('#example2').DataTable({
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
