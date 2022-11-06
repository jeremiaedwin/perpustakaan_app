<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataBuku;

class DataBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_buku = DataBuku::all();
        return view('data_buku.index', [
            'data_buku' => $data_buku
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function create()
    {
        return view("data_buku.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_buku = $request->id_buku;
        $judul_buku = $request->judul_buku;
        $penerbit_buku = $request->penerbit_buku;
        $penulis_buku = $request->penulis_buku;
        $jumlah_stok = $request->jumlah_stok;
        $jumlah_tersedia = $request->jumlah_tersedia;

        try {
            $data_buku = DataBuku::create([
                'id_buku' => $id_buku,
                'judul_buku' => $judul_buku,
                'penerbit_buku' => $penerbit_buku,
                'penulis_buku' => $penulis_buku,
                'jumlah_stok' => $jumlah_stok,
                'jumlah_tersedia' => $jumlah_tersedia
            ]);
            return redirect('/data_buku');
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
        $id_buku = DataBuku::find($id);
        try{
            
            return view('data_buku.edit', compact('data_buku'));
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
            $data_buku = DataBuku::find($id);
            $data_buku->judul_buku = $request->judul_buku;
            $data_buku->penerbit_buku = $request->penerbit_buku;
            $data_buku->penulis_buku = $request->penulis_buku;
            $data_buku->jumlah_stok = $request->jumlah_stok;
            $data_buku->jumlah_tersedia = $request->jumlah_tersedia;
            $data_buku->save();
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
            $data_buku = DataBuku::find($id);
            $data_buku->delete();
            return redirect('/data_buku');
        } catch (Extection $th) {
            return response()->json([
                'message' => $th
            ], 400);
        }
    }
}
