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

                    <table class="table table-hover table-bordered table-stripped anggota_datatable" id="example2">
                        <thead>
                        <tr>
                            <th>ID Anggota</th>
                            <th>NIS Anggota</th>
                            <th>Nama Anggota</th>
                            <th>Alamat Anggota</th>
                            <th>Nomor Telepon Anggota</th>
                            <th>Email Anggota</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    
<script type="text/javascript">
  $(function () {
    var table = $('.anggota_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('anggota.index') }}",
        columns: [
            {data: 'id_anggota', name: 'id_anggota'},
            {data: 'nis_anggota', name: 'nis_anggota'},
            {data: 'nama_anggota', name: 'nama_anggota'},
            {data: 'alamat_anggota', name: 'alamat_anggota'},
            {data: 'nomor_telepon_anggota', name: 'nomor_telepon_anggota'},
            {data: 'email_anggota', name: 'email_anggota'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });
</script>
@endpush
