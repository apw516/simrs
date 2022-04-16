<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'SIMRS - DASHBOARD SIMRS';
        $sidebar = '1';
        $sidebar_m = '1.1';
        return view('dashboard.index', [
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m
        ]);
    }
}
