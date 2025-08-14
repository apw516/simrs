<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf; // If you added the facade alias
use Illuminate\Http\Request;

class PdfController extends Controller
{
    Public function generatePDF()
    {
        // Example data to pass to the view
        $data = ['title' => 'My PDF Document', 'content' => 'This is some content for the PDF.'];

        // Load a Blade view to be converted to PDF
        $pdf = Pdf::loadView('pdf.document', $data);

        // Stream the PDF to the browser
        return $pdf->stream('document.pdf');

        // Or download the PDF
        // return $pdf->download('document.pdf');

        // Or save the PDF to a file
        // $pdf->save(storage_path('app/public/document.pdf'));
    }
}
