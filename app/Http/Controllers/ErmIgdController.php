<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class ErmIgdController extends Controller
{
    public function indexigd()
    {
        $title = 'SIMRS - ERM';
        $sidebar = 'ermperawat';
        $sidebar_m = '2';
        $now = $this->get_date();
        return view('ermigd.index', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'now'
        ]));
    }
    public function get_date()
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $now = $date;
        return $now;
    }
}
