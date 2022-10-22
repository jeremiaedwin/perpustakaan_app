<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Carbon;
class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $peminjaman = Peminjaman::all();
            return view('peminjaman.index', compact('peminjaman'));
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
            $peminjaman->tanggal_pengembalian = $request->tanggal_pengembalian;
            $peminjaman->save();
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
            $peminjaman->delete();
            return redirect('/peminjaman');
        } catch (Exception $th) {
            return response()->json([
                'message' => $th
            ], 400);
        }
    }
}
