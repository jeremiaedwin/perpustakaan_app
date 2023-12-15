<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\DataBuku;
use Carbon;
use DataTables;
use Alert;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $pengembalian = Pengembalian::all();
            if ($request->ajax()){
                
                return Datatables::of($pengembalian)->addIndexColumn()
                    ->rawColumns([])
                    ->make(true);
                    
            }
            \LogPengembalianSuccessActivity::addToLog('Berhasil Menampilkan Seluruh Data.', '200', 'Get All', ' ');
            return view('pengembalian.index');
        } catch (\Throwable $e) {
            \LogPengembalianErrorsActivity::addToLog(json_encode($e->getMessage()), '500', 'Get All', ' ');
            dd($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $pengembalian = new Pengembalian;
            $pengembalian->kode_peminjaman = $request->kode_peminjaman;
            $pengembalian->tanggal_pengembalian = Carbon\Carbon::now();
            $peminjaman = Peminjaman::find($request->kode_peminjaman);
            $buku = DataBuku::find($peminjaman->kode_buku);
            
            if($peminjaman->tanggal_peminjaman > Carbon\Carbon::now()){
                Alert::success('Gagal', 'Tidak Dapat Membuat Pengembalian');
                return redirect('/peminjaman');
            }
            $pengembalian->save();
            $this->updateStokBuku($buku->id_buku);
            
            \LogPengembalianSuccessActivity::addToLog('Berhasil Menambahkan Data.', '200', 'Create Data', $request->kode_peminjaman);
            Alert::success('Success', 'Data Berhasil Dibuat');
            return redirect('/pengembalian');
        } catch (Throwable $e) {
            \LogPengembalianErrorsActivity::addToLog(json_encode($e->getMessage()), 'Create Data', $request->kode_peminjaman);
            dd($e->getMessage());
        }
    }

    public function updateStokBuku($id){
        try {
            // Pengurangan stok buku
            $buku = DataBuku::find($id);
            $buku->jumlah_tersedia = $buku->jumlah_tersedia + 1;
            $buku->save();
        } catch (\Throwable $th) {
            \LogPeminjamanErrorsActivity::addToLog(json_encode($e->getMessage()), '500', 'Insert', '-');
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
