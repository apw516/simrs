<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index',[
            'title' => 'Register'
        ]);
    }
    public function store(Request $request)
    {
        $validateData = $request -> validate([
            'nama_user' => 'required|max:255',
            'username' => ['required','min:3','max:255','unique:dd_user'],
            'kode_unit' =>'required',
            'password' => 'required|min:5|max:255'
        ]);

        $validateData['password'] = Hash::make($validateData['password']); 
        User::create($validateData);
        // $request->session()->flash('success','Registration successful, Please Login');
        return redirect('/login')->with('success','Registration successful, Please Login');
    }
}
