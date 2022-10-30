<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\LogPeminjamanSuccess;
use Auth;
use Carbon;
use DataTables;

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
            if ($request->ajax()){
                $peminjaman = Peminjaman::all();
                return Datatables::of($peminjaman)->addIndexColumn()
                    ->addColumn('action', function($peminjaman){
                        
                        $updateButton = '<a href="/peminjaman/'.$peminjaman->kode_peminjaman.'/edit" class="edit btn btn-primary btn-sm">Edit</a>'  ;
                        $deleteButton = '<form action="peminjaman/'.$peminjaman->kode_peminjaman.'" id="delete-form" method="post">
                                        <input type="hidden" name="_method" value="DELETE">
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
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Server Error'
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
            return view('peminjaman.create');
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
        $kode_peminjaman = $request->kode_peminjaman;
        $kode_buku = $request->kode_buku;
        $kode_peminjam = $request->kode_peminjam;
        $currentDate = Carbon\Carbon::now();
        try {
            $peminjaman = Peminjaman::create([
                'kode_peminjaman'=> $kode_peminjaman,
                'kode_buku'=> $kode_buku,
                'kode_peminjam'=> $kode_peminjam,
                'tanggal_peminjaman' => $currentDate
            ]);
            $logging = LogPeminjamanSuccess::create([
                'kode_peminjaman'=> $kode_peminjaman,
                'user_id' => Auth::id(),
                'activity' => 'Create Data'
            ]);
            return view('peminjaman.create');
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
            $kode_peminjaman = $peminjaman->kode_peminjaman;
            $peminjaman->tanggal_pengembalian = $request->tanggal_pengembalian;
            $peminjaman->save();
            $logging = LogPeminjamanSuccess::create([
                'kode_peminjaman'=> $kode_peminjaman,
                'user_id' => Auth::id(),
                'activity' => 'Update Data'
            ]);
            return view('peminjaman.edit', compact('peminjaman'));
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
