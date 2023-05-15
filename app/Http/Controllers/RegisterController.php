<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        $unit = DB::select('SELECT * from mt_unit');
        return view('register.index',[
            'title' => 'Register',
            'unit' => $unit
        ]);
    }
    public function store(Request $request)
    {
        $validateData = $request ->
         validate([
            'nama' => 'required|max:255',
            'username' => ['required','min:3','max:255','unique:user'],
            'unit' =>'required',
            'password' => 'required|min:5|max:255'
        ]);
        // dd($validateData);
        $validateData['password'] = Hash::make($validateData['password']);
        User::create($validateData);
        // $request->session()->flash('success','Registration successful, Please Login');
        return redirect('/login')->with('success','Registration successful, Please Login');
    }
    public function profil()
    {
        $title = 'SIMRS - ERM';
        $sidebar = 'profil';
        $sidebar_m = '2';
        $id = auth()->user()->id;
        $datauser = DB::select('select * from user where id = ?', [$id]);
        return view('profil.index', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'datauser'
        ]));
    }
    public function gantipassword(Request $request)
    {

    }
}
