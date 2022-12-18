<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Anggota;
use App\Models\Peminjaman;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $profil = Anggota::where('id_user', '=', Auth::id())->first();
        if($profil){
            $kode_anggota = $profil->nis_anggota;
            $peminjaman = Peminjaman::leftJoin('pengembalian', 'peminjaman.kode_peminjaman', '=', 'pengembalian.kode_peminjaman')
                            ->where('peminjaman.kode_anggota', '=', $kode_anggota)->get();
            $peminjamanTelahSelesai = Peminjaman::join('pengembalian', 'peminjaman.kode_peminjaman', '=', 'pengembalian.kode_peminjaman')->where('peminjaman.kode_anggota', '=', $kode_anggota)->get();
            $peminjamanBelumSelesai = Peminjaman::leftJoin('pengembalian', 'peminjaman.kode_peminjaman', '=', 'pengembalian.kode_peminjaman')
                                        ->where('pengembalian.tanggal_pengembalian', '=' , null)
                                        ->where('peminjaman.kode_anggota', '=', $kode_anggota)
                                        ->get();
            return view('home', compact('profil', 'peminjaman', 'peminjamanTelahSelesai', 'peminjamanBelumSelesai'));
        } else{
            return view('home');
        }
    }
}
