<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mpdf\Mpdf as PDF;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Storage;

class RekapController extends Controller
{
    public function makeRekap(){
        $documentFileName = "rekap.pdf";
        $peminjaman = Peminjaman::all();
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

        $document->WriteHTML($peminjaman);

        Storage::disk('public')->put($documentFileName, $document->Output($documentFileName, "S"));
        return Storage::disk('public')->download($documentFileName, 'Request', $header); 
    }
}
