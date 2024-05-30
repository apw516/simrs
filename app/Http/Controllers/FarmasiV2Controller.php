<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FarmasiV2Controller extends Controller
{
    public function indexlayanan()
    {
        $title = 'SIMRS - Farmasi';
        $menu = 'layananfarmasi';
        $sidebar = 'layananfarmasi';
        $sidebar_m = '2';
        return view('v2_farmasi.indexlayanan',compact([
            'title','menu','sidebar','sidebar_m'
        ]));
    }
    public function ambilantrianreguler()
    {

    }
}
