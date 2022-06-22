<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SimrsController;
use App\Http\Controllers\VclaimController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginController::class, 'index']);

Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'Store']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::group(['middleware' => ['auth', 'hak_akses1:1,2']], function () {
    Route::get('/pendaftaran', [SimrsController::class, 'Pendaftaran'])
        ->name('pendaftaran'); //sidebar
    Route::get('/validasiranap', [SimrsController::class, 'ValidasiRanap'])
        ->name('Validasiranap'); //sidebar
    Route::post('/formvalidasi', [SimrsController::class, 'formvalidasi'])
        ->name('formvalidasi'); //sidebar
    Route::get('/datakunjungan/riwayatpelayanan_user', [SimrsController::class, 'riwayatpelayanan_user'])->name('riwayatpelayanan_user'); //sidebar
    Route::get('/datakunjungan', [SimrsController::class, 'datakunjungan'])
        ->name('datakunjungan'); //sidebar
    Route::post('/pendaftaran/formbpjs', [SimrsController::class, 'Formbpjs'])
        ->name('formbpjs'); //footer,pencarianpasien
    Route::post('/pendaftaran/formumum', [SimrsController::class, 'Formumum'])
        ->name('formumum'); //footer,pencarianpasien
    Route::post('Pendaftaran/caripolikontrol', [SimrsController::class, 'Caripolikontrol'])
        ->name('caripolikontrol'); //footer,formpasien_bpjs
    Route::post('Pendaftaran/caridokterkontrol', [SimrsController::class, 'Caridokterkontrol'])
        ->name('caridokterkontrol'); //footer,formpasien_bpjs
    Route::post('Pendaftaran/updatesuratkontrol', [SimrsController::class, 'updatesuratkontrol'])
        ->name('updatesuratkontrol'); //footer
    Route::post('/pendaftaran/caripasien', [SimrsController::class, 'Caripasien'])
        ->name('caripasien'); //footer
    Route::post('Pendaftaran/simpansep', [SimrsController::class, 'Simpansep'])
        ->name('simpansep'); //formpasien_bpjs
    Route::post('Pendaftaran/simpanrujukan', [SimrsController::class, 'Simpanrujukan'])
        ->name('simpanrujukan'); //formpasien_bpjs
    Route::post('Pendaftaran/simpansepranap', [SimrsController::class, 'Simpansepranap'])
        ->name('simpansepranap'); //formpasien_bpjs
    Route::get('/cetaksep/{kodekunjungan}', [SimrsController::class, 'Cetaksep']); //formpasien_bpjs
    Route::get('datakunjungan/cetaksep/{kodekunjungan}', [SimrsController::class, 'Cetaksep']); //formpasien_bpjs
    Route::get('/cetaklabel/{kodekunjungan}', [SimrsController::class, 'Cetaklabel']); //formpasien_bpjs
    Route::get('cetakstruk/{kodekunjungan}', [SimrsController::class, 'Cetakstruk']); //formpasien_bpjs
    Route::get('datakunjungan/cetakstruk/{kodekunjungan}', [SimrsController::class, 'Cetakstruk']); //formpasien_bpjs
    Route::post('Pendaftaran/buatsuratkontrol', [SimrsController::class, 'Buatsuratkontrol'])
        ->name('buatsuratkontrol'); //formpasien_bpjs
    Route::post('Pendaftaran/buatsuratkontrol2', [SimrsController::class, 'Buatsuratkontrol2'])
        ->name('buatsuratkontrol2'); //formpasien_bpjs
    Route::post('Pendaftaran/carisuratkontrol', [SimrsController::class, 'Carisuratkontrol'])
        ->name('carisuratkontrol'); //formpasien_bpjs
    Route::post('Pendaftaran/carirujukan', [SimrsController::class, 'Carirujukan'])
        ->name('carirujukan'); //formpasien_bpjs
    Route::post('Pendaftaran/cariruanganranap', [SimrsController::class, 'Cariruangranap'])
        ->name('cariruangranap'); //formpasien_bpjs
    Route::post('Pendaftaran/cariruanganranap2', [SimrsController::class, 'Cariruangranap2'])
        ->name('cariruangranap2'); //formpasien_bpjs
    Route::post('Pendaftaran/caribedranap', [SimrsController::class, 'Caribedranap'])
        ->name('caribedranap'); //formpasien_bpjs
    Route::get('/pendaftaran/caripoli', [SimrsController::class, 'Caripoli'])
        ->name('caripoli'); //formpasien_bpjs
    Route::get('/pendaftaran/caripoli_rs', [SimrsController::class, 'Caripoli_rs'])
        ->name('caripoli_rs'); //formpasien_bpjs
    Route::get('/pendaftaran/caridokter', [SimrsController::class, 'Caridokter'])
        ->name('caridokter'); //formpasien_bpjs
    Route::get('/pendaftaran/carippkrujukan', [SimrsController::class, 'Carippkrujukan'])
        ->name('carippkrujukan'); //formpasien_bpjs
    Route::post('/pendaftaran/caripoli_ppk', [SimrsController::class, 'Caripoli_ppk'])
        ->name('caripoli_ppk'); //formpasien_bpjs
    Route::get('/pendaftaran/caridokter_rs', [SimrsController::class, 'Caridokter_rs'])
        ->name('caridokter_rs'); //formpasien_bpjs
    Route::get('Pendaftaran/caridiagnosa', [SimrsController::class, 'Caridiagnosa'])
        ->name('caridiagnosa'); //form[asien_bpjs
    Route::post('Pendaftaran/carikabupaten', [SimrsController::class, 'Carikabupaten'])
        ->name('carikabupaten'); //formpasien_bpjs
    Route::post('Pendaftaran/carikecamatan', [SimrsController::class, 'Carikecamatan'])
        ->name('carikecamatan'); //formpasien_bpjs
    Route::post('Pendaftaran/carikab_local', [SimrsController::class, 'carikab_local'])
        ->name('carikab_local'); //indexpendaftaran
    Route::post('Pendaftaran/carikec_local', [SimrsController::class, 'carikec_local'])
        ->name('carikec_local'); //indexpendaftaran
    Route::post('Pendaftaran/caridesa_local', [SimrsController::class, 'caridesa_local'])
        ->name('caridesa_local'); //indexpendaftaran
    Route::post('datakunjungan/detailkunjungan', [SimrsController::class, 'detailkunjungan'])
        ->name('detailkunjungan'); //caridatakunjungan,caririwayatpelayanan_user,datakunjungan
    Route::post('datakunjungan/batalperiksa', [SimrsController::class, 'batalperiksa'])
        ->name('batalperiksa'); //caridatakunjungan,caririwayatpelayanan_user,datakunjungan
    Route::post('Pendaftaran/updatepulang', [SimrsController::class, 'updatepulang'])
        ->name('updatepulang'); //caridatakunjungan,datakunjungan
    Route::post('/datakunjungan/cari', [SimrsController::class, 'caridatakunjungan'])
        ->name('datakunjungan/cari'); //datakunjungan
    Route::post('/datakunjungan/caririwayatpelayanan_user', [SimrsController::class, 'caririwayatpelayanan_user'])
        ->name('caririwayatpelayanan_user');
    Route::post('/pendaftaran/simpanpasien', [SimrsController::class, 'simpanpasien'])
        ->name('simpanpasien');
    Route::post('/pendaftaran/daftarpasien_umum', [SimrsController::class, 'daftarpasien_umum'])
        ->name('daftarpasien_umum');
    Route::post('/pendaftaran/updatepasien', [SimrsController::class, 'updatepasien'])
        ->name('updatepasien');
    Route::post('/pendaftaran/cekkunjunganrujukan', [SimrsController::class, 'cekkunjungan_rujukan'])
        ->name('cekkunjungan_rujukan');
    Route::post('/pendaftaran/detailpasien', [SimrsController::class, 'detailpasien'])
        ->name('detailpasien');
    Route::get('/pendaftaran/carifaskes', [SimrsController::class, 'carifaskes'])
        ->name('carifaskes');
    Route::post('/pendaftaran/carirujukan_nomor', [SimrsController::class, 'carirujukan_nomor'])
        ->name('carirujukan_nomor');


    //vclaim controller
    Route::get('simrsvclaim/sep', [VclaimController::class, 'index'])->middleware('auth')
        ->name('vclaimsep'); //sidebar
    Route::get('simrsvclaim/surakontrol', [VclaimController::class, 'Suratkontrol'])
        ->name('vclaimsurakontrol'); //sidebar
    Route::get('simrsvclaim/referensi', [VclaimController::class, 'Referensi'])
        ->name('vclaimreferensi'); //sidebar
    Route::post('simrsvclaim/carireferensidokter', [VclaimController::class, 'Referensidokter'])
        ->name('vclaimreferensidokter'); //sidebar
    Route::post('simrsvclaim/updatepulang', [VclaimController::class, 'updatepulang'])
        ->name('vclaimupdatepulang'); //footer
    Route::post('simrsvclaim/updatesep', [VclaimController::class, 'simpanupdatesep'])
        ->name('vclaimupdatesep'); //footer
    Route::post('simrsvclaim/update', [VclaimController::class, 'updatesep'])
        ->name('vclaimupdate'); //footer.simrsindex
    Route::post('simrsvclaim/pengajuansep', [VclaimController::class, 'pengajuansep'])
        ->name('vclaimpengajuansep'); //footer
    Route::post('simrsvclaim/listtanggalpulang', [VclaimController::class, 'datalisttanggalpulang'])
        ->name('vclaimlisttanggalpulang'); //simrsindex
    Route::post('simrsvclaim/carilistfinger', [VclaimController::class, 'carilistfinger'])
        ->name('vclaimcarilistfinger');//simrsindex
        Route::post('simrsvclaim/carikunjungansep_peserta', [VclaimController::class, 'datakunjungansep_peserta'])->name('vclaimcarikunjungansep_peserta');//simrsindex
    Route::post('simrsvclaim/carikunjungansep', [VclaimController::class, 'datakunjungansep'])
        ->name('vclaimcarikunjungansep');//simrsindex    
    Route::post('simrsvclaim/detailsep', [VclaimController::class, 'detailsep'])
        ->name('vclaimdetailsep');//simrsindex        
    Route::post('simrsvclaim/hapussep', [VclaimController::class, 'hapussep'])
        ->name('vclaimhapussep');//simrsindex
    Route::post('simrsvclaim/listsuratkontrol_peserta', [VclaimController::class, 'listsuratkontrol_peserta'])->name('vclaimlistsuratkontrol_peserta');
    
    Route::post('simrsvclaim/hapussurkon', [VclaimController::class, 'hapus_suratkontrol'])
        ->name('vclaimhapussurkon');
    Route::post('simrsvclaim/listsuratkontrol_rs', [VclaimController::class, 'listsuratkontrol_rs'])
        ->name('vclaimlistsuratkontrol_rs');
    Route::post('simrsvclaim/carirujukankartu', [VclaimController::class, 'datarujukan_bycard'])
        ->name('vclaimcarirujukankartu');

    Route::get('simrsvclaim/rujukan', [VclaimController::class, 'rujukan'])
        ->name('rujukan');

    Route::post('simrsvclaim/list_rujukan', [VclaimController::class, 'listrujukan_keluar'])
        ->name('vclaimlistrujukan_keluar');
});









// Route::get('/pendaftaran', [SimrsController::class, 'Pendaftaran'])->middleware('auth');
