<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeminjamanStoreRequest;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\LogPeminjamanSuccess;
use App\Models\LogPeminjamanError;
use App\Models\Anggota;
use App\Models\DataBuku;
use Auth;
use DataTables;
use Exception;
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
            $peminjaman = Anggota::join('transaksi','transaksi.id_anggota', '=', 'anggotas.id_anggota')
                                    ->join('data_buku', 'transaksi.id_buku', '=', 'data_buku.id_buku')
                                    ->get();
            if ($request->ajax()){
                
                return Datatables::of($peminjaman)->addIndexColumn()
                    ->addColumn('tenggat_waktu', function($peminjaman){
                        $hari = (string)$peminjaman->durasi_peminjaman;
                        return date('Y-m-d', strtotime($peminjaman->tanggal_peminjaman. ' + '.$hari.' days'));
                    })
                    ->addColumn('status', function($peminjaman){
                        if($peminjaman->tanggal_pengembalian == null){
                            return 'Belum Kembali';
                        }else{
                            return 'Telah Kembali';
                        }
                    })
                    ->addColumn('action', function($peminjaman){
                        
                        $updateButton = '<form action="peminjaman/'.$peminjaman->kode_peminjaman.'" id="update-form" method="post">
                                        '. method_field('put') . csrf_field() .'
                                        <button type="submit" class="btn btn-primary btn-xs">Kembali</button>
                                        </form>';
                        $deleteButton = '<form action="peminjaman/'.$peminjaman->kode_peminjaman.'" id="delete-form" method="post">
                                        '. method_field('delete') . csrf_field() .'
                                        <button type="submit" class="btn btn-danger btn-xs">Hapus</button>
                                        </form>';
                        return $updateButton." ".$deleteButton;
                    })
                    ->rawColumns(['action', 'status', 'tenggat_waktu', 'telat'])
                    ->make(true);
                    
            }
            \LogPeminjamanSuccessActivity::addToLog('Berhasil Menampilkan Seluruh Data.', '200', 'Get All', ' ');
            return view('peminjaman.index');
        } catch (Exception $e) {
            \LogPeminjamanErrorsActivity::addToLog(json_encode($e->getMessage()), '500', 'Get All', ' ');
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        try {
            $anggota = Anggota::all();
            $buku = DataBuku::all();
            return view('peminjaman.create', compact('anggota', 'buku'));
        } catch (Exception $e) {
            $logging = new LogPeminjamanError;
            $logging->kode_peminjaman = $kode_peminjaman;
            $logging->user_id = Auth::id();
            $logging->activity = 'Create Data';
            $logging->error_message = $e->getMessage();
            $logging->save(); 
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PeminjamanStoreRequest $request)
    {
        $validated = $request->validated();
        $id = IdGenerator::generate(['table' => 'transaksi', 'field'=> 'kode_peminjaman','length' => 6, 'prefix' => 'PM']);
        
        $kode_peminjaman = $id;
        $kode_buku = $request->kode_buku;
        $kode_anggota = $request->kode_peminjam;
        $durasi_peminjaman = $request->durasi_peminjaman;
        $currentDate = Carbon\Carbon::now();
        try {
            $buku = DataBuku::find($kode_buku);
            if($buku->jumlah_tersedia > 0){
                $peminjaman = Peminjaman::create([
                    'kode_peminjaman'=> $kode_peminjaman,
                    'id_buku'=> $kode_buku,
                    'id_anggota'=> $kode_anggota,
                    'durasi_peminjaman'=> $durasi_peminjaman,
                    'tanggal_peminjaman' => $currentDate
                ]);
                $buku->jumlah_tersedia = $buku->jumlah_tersedia - 1;
                $buku->save();
                \LogPeminjamanSuccessActivity::addToLog('Data Berhasil Ditambahkan.', '200', 'Insert', $kode_peminjaman);
                Alert::success('Success', 'Data Ditambahkan');
                return redirect('/peminjaman'); 
            }else{
                return redirect('/peminjaman'); 
            }
            
        } catch (Exception $e) {
            \LogPeminjamanErrorsActivity::addToLog(json_encode($e->getMessage()), '500', 'Insert', $kode_peminjaman);
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $peminjaman = Peminjaman::find($id);
            $kode_peminjaman = $id;
            $peminjaman->tanggal_pengembalian = Carbon\Carbon::now();;
            $peminjaman->save();
            $buku = DataBuku::find($peminjaman->id_buku);
            $buku->jumlah_tersedia = $buku->jumlah_tersedia + 1;
            $buku->save();
            \LogPeminjamanSuccessActivity::addToLog('Berhasil Update Data.', '200', 'Update', $kode_peminjaman);
            Alert::success('Success', 'Data Berhasil Diupdate');
            return redirect('/peminjaman');
        } catch (Exception $e) {
            \LogPeminjamanErrorsActivity::addToLog(json_encode($e->getMessage()), '500', 'Update', $kode_peminjaman);
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $peminjaman = Peminjaman::find($id);
            $kode_peminjaman = $peminjaman->kode_peminjaman;
            $peminjaman->delete();
            $logging = LogPeminjamanSuccess::create([
                'kode_peminjaman'=> $kode_peminjaman,
                'user_id' => Auth::id(),
                'activity' => 'Delete Data'
            ]);
            Alert::success('Success', 'Data Berhasil Dihapus');
            return redirect('/peminjaman');
        } catch (Exception $e) {
            $logging = new LogPeminjamanError;
            $logging->kode_peminjaman = $kode_peminjaman;
            $logging->user_id = Auth::id();
            $logging->activity = 'Delete Data';
            $logging->error_message = $e->getMessage();
            $logging->save(); 
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
