<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\LogAnggotaSuccess;
use Auth;
use Carbon;
use DataTables;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $validated = $request->validate([
                'nis_anggota' => 'required|max:8'
            ]);
            $anggota = Anggota::all();
            if ($request->ajax()){
                
                return Datatables::of($anggota)->addIndexColumn()
                    ->addColumn('action', function($anggota){
                        
                        $updateButton = '<a href="/anggota/'.$anggota->nis_anggota.'/edit" class="edit btn btn-primary btn-sm">Edit</a>';
                        $deleteButton = '<form action="/anggota/'.$anggota->nis_anggota.'" id="delete-form" method="post">
                                        '. method_field('delete') . csrf_field() .'
                                        <button type="submit" class="btn btn-danger btn-xs">Hapus</button>
                                        </form>';
                        return $updateButton." ".$deleteButton;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            $logging = LogAnggotaSuccess::create([
                'nis_anggota'=> 'ALL',
                'user_id' => Auth::id(),
                'activity' => 'Get All Data'
            ]);
            return view('anggota.index');
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Server Errorr!'
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
            return  view('anggota.create');
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
        $nis_anggota = $request->nis_anggota;
        $nama_anggota = $request->nama_anggota;
        $alamat_anggota = $request->alamat_anggota;
        $nomor_telepon_anggota = $request->nomor_telepon_anggota;

        try {
            $anggota = Anggota::create([
                'nis_anggota'=> $nis_anggota,
                'nama_anggota'=> $nama_anggota,
                'alamat_anggota' => $alamat_anggota,
                'nomor_telepon_anggota' => $nomor_telepon_anggota
            ]);
            $logging = LogAnggotaSuccess::create([
                'nis_anggota'=> $nis_anggota,
                'user_id'=> Auth::id(),
                'activity' => 'Create Data'
            ]);

            return view('anggota.create');
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
        $anggota = Anggota::find($id);
        try{
            
            return view('anggota.edit', compact('anggota'));
        } catch (\Throwable $th){
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
            $anggota = Anggota::find($id);
            $anggota->nis_anggota = $request->nis_anggota;
            $anggota->nama_anggota = $request->nama_anggota;
            $anggota->alamat_anggota = $request->alamat_anggota;
            $anggota->nomor_telepon_anggota = $request->nomor_telepon_anggota;
            $anggota->save();
            $logging = LogAnggotaSuccess::create([
                'nis_anggota'=> $nis_anggota,
                'user_id' => Auth::id(),
                'activity' => 'Update Data'
            ]);
            return view('anggota.edit', compact('anggota'));
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
            $anggota = Anggota::find($id);
            $logging = LogAnggotaSuccess::create([
                'nis_anggota'=> $anggota->nis_anggota,
                'user_id' => Auth::id(),
                'activity' => 'Delete Data'
            ]);
            $anggota->delete();
            return redirect('/anggota');
        } catch (Extection $th) {
            return response()->json([
                'message' => $th
            ], 400);
        }
    }
}
