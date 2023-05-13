<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'login'
        ]);
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (auth()->user()->hak_akses == 4) {
                return redirect()->intended('indexperawat');
            } else if (auth()->user()->hak_akses == 5) {
                return redirect()->intended('indexdokter');
            } else if (auth()->user()->hak_akses == 99) {
                return redirect()->intended('antrianigd');
            } else {
                return redirect()->intended('dashboard');
            }
        }
        return back()->with('loginError', 'Login gagal !');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
    public function register(Request $request)
    {
        dd('ok');
    }
    public function gantipassword(Request $request)
    {
        $credentials = $request->validate([
            'passwordbaru' => ['required'],
        ]);
        $datauser = DB::select('select * from user where id = ?', [$request->id]);
        $passbaru = Hash::make($request->passwordbaru);
        // if($datauser[0]->password == $passlama){
        $pass = [
            'password' => $passbaru
        ];
        User::whereRaw('id = ?', array($request->id))->update($pass);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
        // }
    }
}
