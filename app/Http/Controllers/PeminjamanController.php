<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeminjamanStoreRequest;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\LogPeminjamanSuccess;
use App\Models\LogPeminjamanError;
use App\Models\Anggota;
use App\Models\DataBuku;
use App\Models\Pengembalian;
use Auth;
use DataTables;
use Exception;
use Throwable;
use Error;
use Alert;
use Carbon;
// Import ID generator
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        try {
            $peminjaman = Anggota::join('peminjaman','peminjaman.kode_anggota', '=', 'anggotas.nis_anggota')
                                    ->join('data_buku', 'peminjaman.kode_buku', '=', 'data_buku.id_buku')
                                    ->get();
            if ($request->ajax()){
                return Datatables::of($peminjaman)->addIndexColumn()
                    ->addColumn('tenggat_waktu', function($peminjaman){
                        $hari = (string)$peminjaman->durasi_peminjaman;
                        return date('Y-m-d', strtotime($peminjaman->tanggal_peminjaman. ' + '.$hari.' days'));
                    })
                    // Button pengembalian
                    ->addColumn('action', function($peminjaman){
                        if(Pengembalian::where('kode_peminjaman', '=', $peminjaman->kode_peminjaman)->first() != null){
                            $updateButton = '<button  type="disable" class="btn btn-success btn-xs" style="pointer-events: none">Telah Kembali</button>';
                        }else{
                            $updateButton = '<form action="/pengembalian" id="update-form" method="post">
                                        '. csrf_field() .'
                                        <input type="hidden" name="kode_peminjaman" value="'.$peminjaman->kode_peminjaman.'">
                                        <button type="submit" class="btn btn-warning btn-xs">Pengembalian</button>
                                        </form>';
                        }
                        
                        return $updateButton;
                    })
                    ->addColumn('detail_button', function($peminjaman){
                        $detail = '<a href="peminjaman/'.$peminjaman->kode_peminjaman.'" class="btn btn-xs btn-primary">Detail</a>';
                        return $detail;
                    })
                    ->rawColumns(['action', 'tenggat_waktu', 'telat', 'detail_button'])
                    ->make(true);
                    
            }
            \LogPeminjamanSuccessActivity::addToLog('Berhasil Menampilkan Seluruh Data.', '200', 'Get All', ' ');
            
        } catch (\Throwable $ex) {
            \LogPeminjamanErrorsActivity::addToLog(json_encode($ex->getMessage()), '500', 'Get All', ' ');
            dd('message : '. $ex->getMessage());
        }
        return view('peminjaman.index');
    }

    public function create()
    {
        
        try {
            $anggota = Anggota::all();
            $buku = DataBuku::all();
            return view('peminjaman.create', compact('anggota', 'buku'));
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            // Validasi Form Input
            $validated = $request->validate([
                'kode_buku' => 'required',
                'kode_anggota' => 'required',
                'durasi_peminjaman' => 'required'
            ]);
            // generate new id peminjaman
            $id = IdGenerator::generate([
                'table' => 'peminjaman', 
                'field'=> 'kode_peminjaman',
                'length' => 6, 
                'prefix' => 'PM'
            ]);
            $kode_peminjaman = $id;
            
            // Cek keberadaan data anggota
            if(!Anggota::find($request->kode_anggota)){
                Alert::success('Danger', 'Anggota Tidak Ditemukan');
                return back(); 
            }

            // Mencari Data Buku
            $buku = DataBuku::find($request->kode_buku);
           
            // Cek keberadaan buku
            if($buku){
                // Pengecekan ketersediaan buku
                if($buku->jumlah_tersedia > 0){
                    // Simpan data peminjaman
                    $peminjaman = Peminjaman::create([
                        'kode_peminjaman'=> $kode_peminjaman,
                        'kode_buku'=> $request->kode_buku,
                        'kode_anggota'=> $request->kode_anggota,
                        'durasi_peminjaman'=> (int)$request->durasi_peminjaman,
                        'tanggal_peminjaman' => Carbon\Carbon::now()
                    ]);

                    // update stok buku
                    $this->updateStokBuku($buku->id_buku);

                    // Save log activity
                    \LogPeminjamanSuccessActivity::addToLog('Data Berhasil Ditambahkan.', '200', 'Insert', $kode_peminjaman);
                }else{
                    // Alert gagal dan kembali ke halaman input buku
                    Alert::success('Failed', 'Buku Tidak Tersedia');
                    return back(); 
                }
            }else{
                Alert::success('Failed', 'Buku Tidak Ditemukan');
                return back(); 
            }

            // Status message success dan kembali ke halaman index peminjaman
            Alert::success('Success', 'Data Ditambahkan');
            return redirect('/peminjaman'); 
            
        } catch (Exception $e) {
            \LogPeminjamanErrorsActivity::addToLog(json_encode($e->getMessage()), '500', 'Insert', '-');
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function updateStokBuku($id){
        try {
            // Pengurangan stok buku
            $buku = DataBuku::find($id);
            $buku->jumlah_tersedia = $buku->jumlah_tersedia - 1;
            $buku->save();
        } catch (\Throwable $th) {
            \LogPeminjamanErrorsActivity::addToLog(json_encode($e->getMessage()), '500', 'Insert', '-');
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $peminjaman = Peminjaman::find($id);
            $hari = (string)$peminjaman->durasi_peminjaman;
            $hari = date('Y-m-d', strtotime($peminjaman->tanggal_peminjaman. ' + '.$hari.' days'));
            $telah_kembali = false;
            if(Pengembalian::where('kode_peminjaman', '=', $id)->first()){
                $telah_kembali = true;
            }
            \LogPeminjamanSuccessActivity::addToLog('Data Berhasil Didapatkan.', '200', 'Show', $peminjaman->kode_peminjaman);
            return view('peminjaman.show', compact('peminjaman', 'hari', 'telah_kembali'));
        }catch (Exception $e) {
            \LogPeminjamanErrorsActivity::addToLog(json_encode($e->getMessage()), '500', 'Show', $id);
            return abort(500);
        }
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::find($id);
        try {
            
            return view('peminjaman.edit', compact('peminjaman'));
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
       
    }
}
