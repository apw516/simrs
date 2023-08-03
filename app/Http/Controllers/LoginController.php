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
                    if(auth()->user()->unit == '1002'){
                        return redirect()->intended('indexdokter_igd');
                    }else{
                        return redirect()->intended('indexdokter');
                    }
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
    public function LoginController(Request $request){
    }
    public function datauser()
    {
        $title = 'SIMRS - ERM';
        $sidebar = 'datauser';
        $sidebar_m = '2';
        $paramedis = DB::select('select *,fc_nama_unit1(unit) as nama_unit from mt_paramedis');
        return view('profil.datauser', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'paramedis'
        ]));
    }
    public function ambiltabeldatauser()
    {
        $datauser = DB::select('select *,fc_nama_unit1(unit) as nama_unit FROM USER ORDER BY id DESC');
        return view('profil.tableuser',compact([
            'datauser'
        ]));
    }
    public function ambildatauser_edit(Request $request){
        $id = $request->id;
        $datauser = DB::select('select *,fc_nama_unit1(unit) as nama_unit from user where id = ?',[$id]);
        $unit = DB::select('select * from mt_unit');
        return view('profil.form_user_edit',compact(['datauser','unit']));
    }
    public function simpanedit_user(Request $request){
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        if($dataSet['resetpassword'] == 2){
            $datauser = [
                'id_simrs' => $dataSet['id_simrs'],
                'username' => $dataSet['username'],
                'nama' => $dataSet['nama'],
                'hak_akses' => $dataSet['hak_akses'],
                'unit' => $dataSet['unit'],
                'kode_paramedis' => $dataSet['kodeparamedis'],
            ];
        }else{
            $datauser = [
                'id_simrs' => $dataSet['id_simrs'],
                'username' => $dataSet['username'],
                'nama' => $dataSet['nama'],
                'hak_akses' => $dataSet['hak_akses'],
                'unit' => $dataSet['unit'],
                'kode_paramedis' => $dataSet['kodeparamedis'],
                'password' => '$2y$10$fu1aZuquSRGA6/Bee.LrYuvoZznjKYPweoxYEVr7vMGyNhXHxM3Ny'
            ];
        }
        User::whereRaw('id = ?', array($dataSet['id']))->update($datauser);
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
}
