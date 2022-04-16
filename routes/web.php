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
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'Store']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::group(['middleware' => ['auth', 'hak_akses1:1,2']], function () {
    Route::get('/pendaftaran', [SimrsController::class, 'Pendaftaran']);
    Route::post('/pendaftaran/formbpjs', [SimrsController::class, 'Formbpjs']);
    Route::post('/pendaftaran/caripasien', [SimrsController::class, 'Caripasien']);
    Route::get('/pendaftaran/caripoli', [SimrsController::class, 'Caripoli']);
    Route::get('/pendaftaran/caridokter', [SimrsController::class, 'Caridokter']);
    Route::get('Pendaftaran/caridiagnosa', [SimrsController::class, 'Caridiagnosa']);
    Route::post('Pendaftaran/simpansep', [SimrsController::class, 'Simpansep']);
    Route::post('Pendaftaran/cariruanganranap', [SimrsController::class, 'Cariruangranap']);
    Route::post('Pendaftaran/caribedranap', [SimrsController::class, 'Caribedranap']);
    Route::post('Pendaftaran/caripolikontrol', [SimrsController::class, 'Caripolikontrol']);
    Route::post('Pendaftaran/caridokterkontrol', [SimrsController::class, 'Caridokterkontrol']);
    Route::post('Pendaftaran/buatsuratkontrol', [SimrsController::class, 'Buatsuratkontrol']);
    Route::post('Pendaftaran/updatesuratkontrol', [SimrsController::class, 'updatesuratkontrol']);
    Route::post('Pendaftaran/carisuratkontrol', [SimrsController::class, 'Carisuratkontrol']);
    Route::post('Pendaftaran/carirujukan', [SimrsController::class, 'Carirujukan']);
    Route::post('Pendaftaran/carikabupaten', [SimrsController::class, 'Carikabupaten']);
    Route::post('Pendaftaran/carikecamatan', [SimrsController::class, 'Carikecamatan']);
    Route::post('Pendaftaran/carikab_local', [SimrsController::class, 'carikab_local']);
    Route::post('Pendaftaran/carikec_local', [SimrsController::class, 'carikec_local']);
    Route::post('Pendaftaran/caridesa_local', [SimrsController::class, 'caridesa_local']);
    Route::post('Pendaftaran/updatepulang', [SimrsController::class, 'updatepulang']);
    Route::get('/datakunjungan/riwayatpelayanan_user', [SimrsController::class, 'riwayatpelayanan_user']);
    Route::get('/datakunjungan', [SimrsController::class, 'datakunjungan']);
    Route::post('/datakunjungan/cari', [SimrsController::class, 'caridatakunjungan']);
    Route::post('/datakunjungan/caririwayatpelayanan_user', [SimrsController::class, 'caririwayatpelayanan_user']);
    Route::post('datakunjungan/detailkunjungan', [SimrsController::class, 'detailkunjungan']);
    Route::post('datakunjungan/batalperiksa', [SimrsController::class, 'batalperiksa']);
    Route::get('/cetaksep/{kodekunjungan}', [SimrsController::class, 'Cetaksep']);

    Route::get('simrsvclaim/sep', [VclaimController::class, 'index'])->middleware('auth');
    Route::get('simrsvclaim/surakontrol', [VclaimController::class, 'Suratkontrol']);
    Route::post('simrsvclaim/carikunjungansep', [VclaimController::class, 'datakunjungansep']);
    Route::post('simrsvclaim/carikunjungansep_peserta', [VclaimController::class, 'datakunjungansep_peserta']);
    Route::post('simrsvclaim/listtanggalpulang', [VclaimController::class, 'datalisttanggalpulang']);
    Route::post('simrsvclaim/detailsep', [VclaimController::class, 'detailsep']);
    Route::post('simrsvclaim/hapussep', [VclaimController::class, 'hapussep']);
    Route::post('simrsvclaim/update', [VclaimController::class, 'updatesep']);
    Route::post('simrsvclaim/updatepulang', [VclaimController::class, 'updatepulang']);
    Route::post('simrsvclaim/updatesep', [VclaimController::class, 'simpanupdatesep']);
    Route::post('simrsvclaim/pengajuansep', [VclaimController::class, 'pengajuansep']);
    Route::post('simrsvclaim/carilistfinger', [VclaimController::class, 'carilistfinger']);
    Route::post('simrsvclaim/listsuratkontrol_peserta', [VclaimController::class, 'listsuratkontrol_peserta']);
    Route::post('simrsvclaim/hapussurkon', [VclaimController::class, 'hapus_suratkontrol']);
    Route::post('simrsvclaim/listsuratkontrol_rs', [VclaimController::class, 'listsuratkontrol_rs']);
});









// Route::get('/pendaftaran', [SimrsController::class, 'Pendaftaran'])->middleware('auth');
