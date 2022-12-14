@extends('adminlte::page')

@section('title', 'List Pengembalian')

@section('content_header')
    <h1 class="m-0 text-dark">List Pengembalian</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <a href="/rekap" class="btn btn-primary mb-2">
                        PDF
                    </a>

                    <table class="table table-hover table-bordered table-stripped pengembalian_datatable" id="example2">
                        <thead>
                        <tr>
                            <th>Kode Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
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
    var table = $('.pengembalian_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('pengembalian.index') }}",
        columns: [
            {data: 'kode_peminjaman', name: 'kode_peminjaman'},
            {data: 'tanggal_pengembalian', name: 'tanggal_pengembalian'}
        ]
    });
  });
</script>
@endpush
