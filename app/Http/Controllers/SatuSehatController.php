<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SatuSehatController extends Controller
{
    public function index()
    {
        $title = 'SIMRS - PENDAFTARAN';
        $sidebar = '2';
        $sidebar_m = '2';

        return view('satusehat.index', [
            'title' => $title,
            'sidebar' => $sidebar,
            'unit' => '9999'
        ]);
    }
}
