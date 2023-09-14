<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\PDF;

use Illuminate\Http\Request;


class PdfGeneratorController extends Controller
{
    public function index() 
    {


        
        
        $pdf = app('dompdf.wrapper'); 
        $pdf->loadView('receipt_pdf');
        // return $pdf->download('receipt.pdf');
        return $pdf->stream('resume.pdf');
    }
}
