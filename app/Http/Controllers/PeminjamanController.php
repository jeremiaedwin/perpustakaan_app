<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\LogPeminjamanSuccess;
use App\Models\Anggota;
use App\Models\DataBuku;
use Auth;
use DataTables;
use Exception;
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
                    ->rawColumns(['action'])
                    ->make(true);
            }
            $logging = LogPeminjamanSuccess::create([
                'kode_peminjaman'=> 'ALL',
                'user_id' => Auth::id(),
                'activity' => 'Get All Data'
            ]);
            return view('peminjaman.index');
        } catch (Exception $e) {
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
        $anggota = Anggota::all();
        $buku = DataBuku::all();
        try {
            return view('peminjaman.create', compact('anggota', 'buku'));
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Page Not Found'
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = IdGenerator::generate(['table' => 'peminjaman', 'field'=> 'kode_peminjaman','length' => 6, 'prefix' => 'PM']);
        
        $kode_peminjaman = $id;
        $kode_buku = $request->kode_buku;
        $kode_anggota = $request->kode_peminjam;
        $currentDate = Carbon\Carbon::now();
        try {
            $buku = DataBuku::find($kode_buku);
            if($buku->jumlah_tersedia > 0){
                $peminjaman = Peminjaman::create([
                    'kode_peminjaman'=> $kode_peminjaman,
                    'id_buku'=> $kode_buku,
                    'id_anggota'=> $kode_anggota,
                    'tanggal_peminjaman' => $currentDate
                ]);
                $buku->jumlah_tersedia = $buku->jumlah_tersedia - 1;
                $buku->save();
                $logging = LogPeminjamanSuccess::create([
                    'kode_peminjaman'=> $kode_peminjaman,
                    'user_id' => Auth::id(),
                    'activity' => 'Create Data'
                ]);
                return redirect('/peminjaman'); 
            }
            
        } catch (Exception $th) {
            return response()->json([
                'message' => $th
            ], 400);
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
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Page Not Found'
            ], 404);
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
            $logging = LogPeminjamanSuccess::create([
                'kode_peminjaman'=> $kode_peminjaman,
                'user_id' => Auth::id(),
                'activity' => 'Update Data'
            ]);
            return redirect('/peminjaman');
        } catch (Exception $th) {
            return response()->json([
                'message' => $th
            ], 400);
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
            return redirect('/peminjaman');
        } catch (Exception $th) {
            return response()->json([
                'message' => $th
            ], 400);
        }
    }
}
