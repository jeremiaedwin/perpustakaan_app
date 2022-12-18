<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mpdf\Mpdf as PDF;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Anggota;
use App\Models\DataBuku;
use Illuminate\Support\Facades\Storage;
use Auth;

class RekapController extends Controller
{
    public function makeRekap(){
        $documentFileName = "rekap.pdf";
        $peminjaman = Peminjaman::leftJoin('pengembalian', 'peminjaman.kode_peminjaman', '=', 'pengembalian.kode_peminjaman')
                        ->whereYear('tanggal_peminjaman', date('Y'))->get();
        $peminjamanTelahSelesai = Peminjaman::join('pengembalian', 'peminjaman.kode_peminjaman', '=', 'pengembalian.kode_peminjaman')->whereYear('tanggal_peminjaman', date('Y'))->count();
        $peminjamanBelumSelesai = Peminjaman::leftJoin('pengembalian', 'peminjaman.kode_peminjaman', '=', 'pengembalian.kode_peminjaman')
                                    ->where('pengembalian.tanggal_pengembalian', '=' , null)
                                    ->whereYear('tanggal_peminjaman', date('Y'))
                                    ->count();
        $judulBukuTerpinjam = Peminjaman::whereYear('tanggal_peminjaman', date('Y'))->groupBy('kode_buku')->count();
        $jumlahPeminjam = Peminjaman::whereYear('tanggal_peminjaman', date('Y'))->groupBy('kode_anggota')->count();
        $document = new PDF( [
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_header' => '3',
            'margin_top' => '20',
            'margin_bottom' => '20',
            'margin_footer' => '2',
        ]); 

        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$documentFileName.'"'
        ];

        // $document->WriteHTML("Total Peminjaman : $peminjamanTotal");
        // $document->WriteHTML("Peminjaman telah selesai : $peminjamanTelahSelesai");
        // $document->WriteHTML("Peminjaman belum selesai : $peminjamanBelumSelesai");

        	
        $document->WriteHTML(view('rekap.index', compact('peminjaman', 'peminjamanTelahSelesai', 'peminjamanBelumSelesai', 'judulBukuTerpinjam', 'jumlahPeminjam')));

        Storage::disk('public')->put($documentFileName, $document->Output($documentFileName, "S"));
        return Storage::disk('public')->download($documentFileName, 'Request', $header); 
        // return view('rekap.index', compact('peminjaman', 'peminjamanTelahSelesai', 'peminjamanBelumSelesai', 'judulBukuTerpinjam', 'jumlahPeminjam'));
    }

    public function rekapAnggota() {

        $documentFileName = "LaporanAnggota.pdf";
        $peminjaman = Anggota::join('transaksi','transaksi.id_anggota', '=', 'anggotas.id_anggota')
        ->join('data_buku', 'transaksi.id_buku', '=', 'data_buku.id_buku')
        ->get();
        $peminjamanTotal = Peminjaman::all()->count();
        $peminjamanTelahSelesai = Peminjaman::where('tanggal_pengembalian', '!=','')->count();
        $peminjamanBelumSelesai = Peminjaman::where('tanggal_pengembalian', '=',null)->count();
        $document = new PDF( [
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_header' => '3',
            'margin_top' => '20',
            'margin_bottom' => '20',
            'margin_footer' => '2',
        ]); 

        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$documentFileName.'"'
        ];
        	
        $document->WriteHTML(view('rekapAnggota.index', compact('peminjaman', 'peminjamanTotal', 'peminjamanTelahSelesai', 'peminjamanBelumSelesai')));

        Storage::disk('public')->put($documentFileName, $document->Output($documentFileName, "S"));
        return Storage::disk('public')->download($documentFileName, 'Request', $header);
    }

    public function RekapRiwayatPeminjaman(){
        $documentFileName = "rekap.pdf";
        $anggota = Anggota::where('id_user', '=', Auth::user()->id)->first();
        $kode_anggota = $anggota->nis_anggota;
        $peminjaman = Peminjaman::leftJoin('pengembalian', 'peminjaman.kode_peminjaman', '=', 'pengembalian.kode_peminjaman')
                        ->where('peminjaman.kode_anggota', '=', $kode_anggota)->get();
        $peminjamanTelahSelesai = Peminjaman::join('pengembalian', 'peminjaman.kode_peminjaman', '=', 'pengembalian.kode_peminjaman')->where('peminjaman.kode_anggota', '=', $kode_anggota)->get();
        $peminjamanBelumSelesai = Peminjaman::leftJoin('pengembalian', 'peminjaman.kode_peminjaman', '=', 'pengembalian.kode_peminjaman')
                                    ->where('pengembalian.tanggal_pengembalian', '=' , null)
                                    ->where('peminjaman.kode_anggota', '=', $kode_anggota)
                                    ->get();
        $document = new PDF( [
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_header' => '3',
            'margin_top' => '20',
            'margin_bottom' => '20',
            'margin_footer' => '2',
        ]); 

        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$documentFileName.'"'
        ];

        	
        $document->WriteHTML( view('rekap.riwayat_anggota', compact('peminjaman', 'peminjamanTelahSelesai', 'peminjamanBelumSelesai')) );

        Storage::disk('public')->put($documentFileName, $document->Output($documentFileName, "S"));
        return Storage::disk('public')->download($documentFileName, 'Request', $header); 
        
    }
}
