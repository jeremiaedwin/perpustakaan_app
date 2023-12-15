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

                    <a href="{{route('peminjaman.create')}}" class="btn btn-success mb-2">
                        <i class="fa fa-plus" aria-hidden="true"></i> TAMBAH
                    </a>
                    <a href="/rekap" class="btn btn-primary mb-2">
                        <i class="fa fa-file" aria-hidden="true"></i> LAPORAN
                    </a>

                    <table class="table table-hover table-bordered table-stripped peminjaman_datatable" id="example2">
                        <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Peminjam</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tenggat Waktu</th>
                            <th>Action</th>
                            <th></th>
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
    var table = $('.peminjaman_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('peminjaman.index') }}",
        columns: [
            {data: 'kode_peminjaman', name: 'kode_peminjaman'},
            {data: 'nama_anggota', name: 'nama_anggota'},
            {data: 'judul_buku', name: 'judul_buku'},
            {data: 'tanggal_peminjaman', name: 'tanggal_peminjaman'},
            {data: 'tenggat_waktu', name: 'tenggat_waktu'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            {data: 'detail_button', name: 'detail_button', orderable: false, searchable: false},
        ]
    });
  });
</script>
@endpush
