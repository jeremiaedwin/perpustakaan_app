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
                    
                    <a href="/rekap" class="btn btn-primary mb-2">
                        <i class="fa fa-file" aria-hidden="true"></i> LAPORAN
                    </a>

                    <table class="table table-hover table-bordered table-stripped anggota_datatable" id="example2">
                        <thead>
                        <tr>
                            <th>NIS</th>
                            <th>Nama Lengkap</th>
                            <th>Alamat</th>
                            <th>No Telepon</th>
                            <th>Email</th>
                            <th>Angkatan</th>
                            <th>Status</th>
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
            {data: 'nis_anggota', name: 'nis_anggota'},
            {data: 'nama_anggota', name: 'nama_anggota'},
            {data: 'alamat_anggota', name: 'alamat_anggota'},
            {data: 'nomor_telepon_anggota', name: 'nomor_telepon_anggota'},
            {data: 'email_anggota', name: 'email_anggota'},
            {data: 'tahun_ajaran', name: 'tahun_ajaran'},
            {data: 'status_anggota', name: 'status_anggota'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });
</script>
@endpush
