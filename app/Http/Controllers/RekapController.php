<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mpdf\Mpdf as PDF;
use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\DataBuku;
use Illuminate\Support\Facades\Storage;

class RekapController extends Controller
{
    public function makeRekap(){
        $documentFileName = "rekap.pdf";
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

        // $document->WriteHTML("Total Peminjaman : $peminjamanTotal");
        // $document->WriteHTML("Peminjaman telah selesai : $peminjamanTelahSelesai");
        // $document->WriteHTML("Peminjaman belum selesai : $peminjamanBelumSelesai");

        	
        $document->WriteHTML(view('rekap.index', compact('peminjaman', 'peminjamanTotal', 'peminjamanTelahSelesai', 'peminjamanBelumSelesai')));

        Storage::disk('public')->put($documentFileName, $document->Output($documentFileName, "S"));
        return Storage::disk('public')->download($documentFileName, 'Request', $header); 
    }
}
