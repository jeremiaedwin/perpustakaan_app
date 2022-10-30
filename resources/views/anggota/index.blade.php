@extends('adminlte::page')

@section('title', 'List Anggota')

@section('content_header')
        <h1 class="m-0 text-dark">List Anggota</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <a href="{{route('anggota.create')}}" class="btn btn-primary mb-2">
                        Tambah
                    </a>

                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>ID Anggota</th>
                            <th>Nama Anggota</th>
                            <th>NIS Anggota</th>
                            <th>Alamat Anggota</th>
                            <th>Nomor Telepon Anggota</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $no =0  @endphp
                        @foreach($anggota as $a)
                            <tr>
                                <td>{{$no+1}}</td>
                                <td>{{$a->id_anggota}}</td>
                                <td>{{$a->nama_anggota}}</td>
                                <td>{{$a->nis_anggota}}</td>
                                <td>{{$a->alamat_anggota}}</td>
                                <td>{{$a->nomor_telepon_anggota}}</td>
                                <td>
                                <a href="/anggota/{{$a->id_anggota}}/edit" class="btn btn-primary btn-xs">
                                        Edit
                                    </a>
                                    <form action="anggota/{{$a->id_anggota}}" id="delete-form" method="post">
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
