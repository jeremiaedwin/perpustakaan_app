@extends('adminlte::page')

@section('title', 'Tambah Peminjaman')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Peminjaman</h1>
@endsection

@section('content')
    <form action="{{route('peminjaman.store')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="">Anggota : </label>
                            <input type="text" class="form-control" id="searchAnggota" name="search" placeholder="Masukkan Kode Peminjam"></input>
                            <table class="table" >
                                <tbody id="dataAnggota">

                                </tbody>
                            </table>
                        </div>

                        <div class="form-group">
                            <label for="">Buku : </label>
                            <input type="text" class="form-control" id="searchBuku" name="search" placeholder="Masukkan Kode Buku"></input>
                            <table class="table" >
                                <tbody id="dataBuku">

                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <label for="">Durasi Peminjaman</label>
                            <select name="durasi_peminjaman" id="" class="form-control">
                                <option value="">Pilih Opsi Peminjaman</option>
                                <option value="7">1 Minggu</option>
                                <option value="30">1 Bulan</option>
                                <option value="180">1 Semester</option>
                                <option value="365">1 Tahun</option>
                            </select>
                        </div>
                    </div>

                    

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{route('peminjaman.index')}}" class="btn btn-default">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
$(document).ready(function(){

 fetch_anggota_data();

 function fetch_anggota_data(query = '')
 {
    console.log(query);
  $.ajax({
   url:"/anggota/search/"+query,
   method:'GET',
   data:{query:query},
   success:function(data)
   {
    if(data){
        $('#dataAnggota').html(data.table_data);
    }else if (data===null){
        $('#dataAnggota').html("Data Not Found");
    }
   },
   error: function(xhr, status, error) {
      console.log(status, error);
      if(status == "error"){

          $('#dataAnggota').html("Anggota Tidak Ditemukan");
      }
   },
  })
 }

 $(document).on('keyup', '#searchAnggota', function(){
  var query = $(this).val();
  fetch_anggota_data(query);
 });
});
</script>

<script>
$(document).ready(function(){

 fetch_buku_data();

 function fetch_buku_data(query = '')
 {
    console.log(query);
  $.ajax({
   url:"/buku/search/"+query,
   method:'GET',
   data:{query:query},
   success:function(data)
   {
    $('#dataBuku').html(data.table_data);
   },
   error: function(xhr, status, error) {
      console.log(status, error);
   },
  })
 }

 $(document).on('keyup', '#searchBuku', function(){
  var query = $(this).val();
  fetch_buku_data(query);
 });
});
</script>
@push('js')
    
@endpush