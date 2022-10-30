<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anggota = Anggota::all();
        return view('anggota.index', [
            'anggota' => $anggota
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("anggota.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_anggota = $request->id_anggota;
        $nama_anggota = $request->nama_anggota;
        $nis_anggota = $request->nis_anggota;
        $alamat_anggota = $request->alamat_anggota;
        $nomor_telepon_anggota = $request->nomor_telepon_anggota;

        try {
            $anggota = Anggota::create([
                'id_anggota'=> $id_anggota,
                'nama_anggota'=> $nama_anggota,
                'nis_anggota'=> $nis_anggota,
                'alamat_anggota' => $alamat_anggota,
                'nomor_telepon_anggota' => $nomor_telepon_anggota
            ]);
            return redirect('/anggota');
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
            $anggota->nama_anggota = $request->nama_anggota;
            $anggota->alamat_anggota = $request->alamat_anggota;
            $anggota->nomor_telepon_anggota = $request->nomor_telepon_anggota;
            $anggota->save();
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
            $anggota->delete();
            return redirect('/anggota');
        } catch (Extection $th) {
            return response()->json([
                'message' => $th
            ], 400);
        }
    }
}
