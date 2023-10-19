<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SimrsController;
use App\Http\Controllers\VclaimController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\BedmonitoringController;
use App\Http\Controllers\RanapController;
use App\Http\Controllers\ErmController;
use App\Http\Controllers\PenunjangController;
use App\Http\Controllers\AntrianIgd;
use App\Http\Controllers\ErmIgdController;
use App\Http\Controllers\FarmasiController;


Route::get('/', [LoginController::class, 'index']);
Route::get('datauser', [LoginController::class, 'datauser'])->middleware('auth')->name('datauser');
// Route::get('/register', [LoginController::class, 'register'])->name('/register');
Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/gantipassword', [LoginController::class, 'gantipassword'])->name('gantipassword');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('bedmonitoring', [BedmonitoringController::class, 'index'])->name('bedmonitoring');
Route::post('/ambilcatatanmedis_pasien', [ErmController::class, 'ambilcatatanmedis_pasien'])
    ->name('ambilcatatanmedis_pasien'); //sidebar
Route::get('cetakresume/{kodekunjungan}', [ErmController::class, 'cetakresume']); //formpasien_bpjs
Route::get('cetakresumeperawat/{rm}/{counter}', [ErmController::class, 'cetakresumeperawat']); //formpasien_bpjs
Route::get('cetakresumedokter/{rm}/{counter}', [ErmController::class, 'cetakresumedokter']); //formpasien_bpjs
Route::post('ambilicd10', [ErmController::class, 'ambilicd10'])->name('ambilicd10'); //formpasien_bpjs
Route::post('ambilicd10_banding', [ErmController::class, 'ambilicd10_banding'])->name('ambilicd10_banding'); //formpasien_bpjs
Route::post('cariicd10', [ErmController::class, 'cariicd10'])->name('cariicd10'); //formpasien_bpjs
Route::post('cariicd10_banding', [ErmController::class, 'cariicd10_banding'])->name('cariicd10_banding'); //formpasien_bpjs
Route::post('ambilicd9', [ErmController::class, 'ambilicd9'])->name('ambilicd9'); //formpasien_bpjs
Route::post('ambilicd9_banding', [ErmController::class, 'ambilicd9_banding'])->name('ambilicd9_banding'); //formpasien_bpjs
Route::post('cariicd9', [ErmController::class, 'cariicd9'])->name('cariicd9'); //formpasien_bpjs
Route::post('cariicd9_banding', [ErmController::class, 'cariicd9_banding'])->name('cariicd9_banding'); //formpasien_bpjs
Route::post('/pemeriksaankhususon', [ErmController::class, 'pemeriksaankhususon'])
    ->name('pemeriksaankhususon'); //sidebar
Route::post('/riwayattindakan', [ErmController::class, 'riwayattindakan'])
    ->name('riwayattindakan'); //sidebar
Route::post('/riwayattindakan2', [ErmController::class, 'riwayattindakan2'])
    ->name('riwayattindakan2'); //sidebar
Route::post('/riwayatorder2', [ErmController::class, 'riwayatorder2'])
    ->name('riwayatorder2'); //sidebar
Route::post('/riwayatorderfarmasi2', [ErmController::class, 'riwayatorderfarmasi2'])
    ->name('riwayatorderfarmasi2'); //sidebar
Route::post('/riwayatupload', [ErmController::class, 'riwayatupload'])
    ->name('riwayatupload'); //sidebar
Route::post('/ambilresep', [ErmController::class, 'ambilresep'])
    ->name('ambilresep'); //sidebar
Route::post('/ambilresep_detail', [ErmController::class, 'ambilresep_detail'])
    ->name('ambilresep_detail'); //sidebar
Route::post('/lihathasillab', [ErmController::class, 'lihathasillab'])
    ->name('lihathasillab'); //sidebar
Route::post('/lihathasilex', [ErmController::class, 'lihathasilex'])
    ->name('lihathasilex'); //sidebar
Route::post('/lihathasil_scanrm', [ErmController::class, 'lihathasil_scanrm'])
    ->name('lihathasil_scanrm'); //sidebar
Route::post('/vberkasluar', [ErmController::class, 'vberkasluar'])
    ->name('vberkasluar'); //sidebar
Route::post('ambilsaran', [ErmController::class, 'ambilsaran'])
    ->name('ambilsaran'); //sidebar
Route::post('showfile', [ErmController::class, 'showfile'])
    ->name('showfile'); //sidebar

Route::get('kunjungan_pasien', [ErmController::class, 'kunjungan_pasien'])
    ->name('kunjungan_pasien'); //sidebar
Route::get('berkas_erm', [ErmController::class, 'berkas_erm'])
    ->name('berkas_erm'); //sidebar
Route::get('monitoring_erm', [ErmController::class, 'monitoring_erm'])
    ->name('monitoring_erm'); //sidebar
Route::post('ambil_kunjungan_hari_ini', [ErmController::class, 'ambil_kunjungan_hari_ini'])
    ->name('ambil_kunjungan_hari_ini'); //sidebar
Route::post('monitoring_berkas_erm', [ErmController::class, 'monitoring_berkas_erm'])
    ->name('monitoring_berkas_erm'); //sidebar
Route::post('ambil_berkas_erm', [ErmController::class, 'ambil_berkas_erm'])
    ->name('ambil_berkas_erm'); //sidebar
Route::post('ambilriwayatobat', [ErmController::class, 'ambilriwayatobat'])
    ->name('ambilriwayatobat'); //sidebar
Route::post('ambil_berkas_erm_pasien', [ErmController::class, 'ambil_berkas_erm_pasien'])
    ->name('ambil_berkas_erm_pasien'); //sidebar
Route::post('ambil_berkas_erm_pasien_scan', [ErmController::class, 'lihathasil_scanrm'])
    ->name('ambil_berkas_erm_pasien_scan'); //sidebar
Route::post('lihathasilpenunjang_lab', [ErmController::class, 'lihathasilpenunjang_lab'])
    ->name('lihathasilpenunjang_lab'); //sidebar
Route::post('lihathasilpenunjang_rad', [ErmController::class, 'lihathasilpenunjang_rad'])
    ->name('lihathasilpenunjang_rad'); //sidebar
Route::post('lihathasilpenunjang_pa', [ErmController::class, 'lihathasilpenunjang_pa'])
    ->name('lihathasilpenunjang_pa'); //sidebar

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest')->name('register');
Route::get('/profil', [RegisterController::class, 'profil'])->name('profil');
Route::post('/ambiltabeldatauser', [LoginController::class, 'ambiltabeldatauser'])->name('ambiltabeldatauser');
Route::post('/ambildatauser_edit', [LoginController::class, 'ambildatauser_edit'])->name('ambildatauser_edit');
Route::post('/simpanedit_user', [LoginController::class, 'simpanedit_user'])->name('simpanedit_user');
Route::post('/register', [RegisterController::class, 'Store']);

Route::post('/formpemeriksaan_khusus', [ErmController::class, 'formpemeriksaan_khusus'])
    ->name('formpemeriksaan_khusus'); //sidebar
Route::post('/ambilriwayat_pasien', [ErmController::class, 'ambilriwayat_pasien'])
    ->name('ambilriwayat_pasien'); //sidebar
Route::post('/ambilriwayat_pasien_cari', [ErmController::class, 'ambilriwayat_pasien_cari'])
    ->name('ambilriwayat_pasien_cari'); //sidebar
Route::get('/indexpelayanandokter', [ErmController::class, 'indexpelayanandokter'])
    ->name('indexpelayanandokter'); //sidebar
Route::get('/riwayatpemeriksaan_byrm', [ErmController::class, 'riwayatpemeriksaan_byrm'])
    ->name('riwayatpemeriksaan_byrm'); //sidebar
Route::post('/ambilriwayat_pasien_byrm', [ErmController::class, 'ambilriwayat_pasien_byrm'])
    ->name('ambilriwayat_pasien_byrm'); //sidebar
Route::post('/simpangambar_igd', [ErmController::class, 'simpangambarbebas'])
    ->name('simpangambar_igd'); //sidebar
Route::post('/gambarcatatan', [ErmController::class, 'gambarcatatan'])
    ->name('gambarcatatan'); //sidebar
Route::get('/kontakkami', [SimrsController::class, 'kontakkami'])
    ->name('kontakkami'); //sidebar


//reloadorder
Route::post('/reloadorder', [PenunjangController::class, 'reloadorder'])
    ->name('reloadorder'); //sidebar
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::post('/ambil_grafik_all_poli', [DashboardController::class, 'ambil_grafik_all_poli'])->middleware('auth')->name('ambil_grafik_all_poli');
Route::post('/ambil_grafik_by_poli', [DashboardController::class, 'ambil_grafik_by_poli'])->middleware('auth')->name('ambil_grafik_by_poli');
Route::group(['middleware' => ['auth', 'hak_akses1:1,2,9']], function () {
    Route::get('/pendaftaran', [SimrsController::class, 'Pendaftaran'])
        ->name('pendaftaran'); //sidebar
    Route::get('/pendaftaran2', [SimrsController::class, 'Pendaftaran2'])
        ->name('pendaftaran2'); //sidebar
    Route::get('/menusepvalidasi', [SimrsController::class, 'menusepvalidasi'])
        ->name('menusepvalidasi'); //sidebar
    Route::get('/berkaserm', [RanapController::class, 'indexberkaserm'])
        ->name('berkaserm'); //sidebar
    Route::post('/cariberkasnya_pasien', [RanapController::class, 'cariberkasnya_pasien'])
        ->name('cariberkasnya_pasien'); //sidebar
    Route::post('/carisuratkontrol_ranap', [RanapController::class, 'carisuratkontrol_ranap'])
        ->name('carisuratkontrol_ranap'); //sidebar

    Route::post('/detailpasienranap', [RanapController::class, 'detailpasienranap'])
        ->name('detailpasienranap'); //sidebar
    Route::get('/datapasienranap', [SimrsController::class, 'datapasienranap'])
        ->name('datapasienranap'); //sidebar
    Route::post('/lihatcatatanpasien', [SimrsController::class, 'lihatcatatanpasien'])
        ->name('lihatcatatanpasien'); //sidebar
    Route::get('/menucarisep', [SimrsController::class, 'Menucarisep'])
        ->name('menucarisep'); //sidebar
    Route::get('/menulisttglpulang', [SimrsController::class, 'menulisttglpulang'])
        ->name('menulisttglpulang'); //sidebar
    Route::get('/menulistfinger', [SimrsController::class, 'menulistfinger'])
        ->name('menulistfinger'); //sidebar
    Route::get('/menucarirujukan', [SimrsController::class, 'menucarirujukan'])
        ->name('menucarirujukan'); //sidebar
    Route::get('/menuinsertrujukan', [SimrsController::class, 'menuinsertrujukan'])
        ->name('menuinsertrujukan'); //sidebar
    Route::get('/menulistrujukankeluar', [SimrsController::class, 'menulistrujukankeluar'])
        ->name('menulistrujukankeluar'); //sidebar
    Route::get('/menuinsertrujukankhusus', [SimrsController::class, 'menuinsertrujukankhusus'])
        ->name('menuinsertrujukankhusus'); //sidebar
    Route::get('/menulistrujukankhusus', [SimrsController::class, 'menulistrujukankhusus'])
        ->name('menulistrujukankhusus'); //sidebar
    Route::get('/menucarisuratkontrol', [SimrsController::class, 'menucarisuratkontrol'])
        ->name('menucarisuratkontrol'); //sidebar
    Route::get('/menuinsertrencanakontrol', [SimrsController::class, 'menuinsertrencanakontrol'])
        ->name('menuinsertrencanakontrol'); //sidebar
    Route::get('/menuinsertspri', [SimrsController::class, 'menuinsertspri'])
        ->name('menuinsertspri'); //sidebar
    Route::get('/menuinsertprb', [SimrsController::class, 'menuinsertprb'])
        ->name('menuinsertprb'); //sidebar
    Route::get('/menucariprb', [SimrsController::class, 'menucariprb'])
        ->name('menucariprb'); //sidebar
    Route::get('/menudatakunjungan', [SimrsController::class, 'menudatakunjungan'])
        ->name('menudatakunjungan'); //sidebar
    Route::get('/menuhispelpes', [SimrsController::class, 'menuhispelpes'])
        ->name('menuhispelpes'); //sidebar
    Route::get('/menudataklaimjr', [SimrsController::class, 'menudataklaimjr'])
        ->name('menudataklaimjr'); //sidebar
    Route::get('/menuriwayatpasien', [SimrsController::class, 'menuriwayatpasien'])
        ->name('menuriwayatpasien'); //sidebar
    Route::get('/validasiranap', [SimrsController::class, 'ValidasiRanap'])
        ->name('Validasiranap'); //sidebar
    Route::post('/formvalidasi', [SimrsController::class, 'formvalidasi'])
        ->name('formvalidasi'); //sidebar
    Route::get('/datakunjungan/riwayatpelayanan_user', [SimrsController::class, 'riwayatpelayanan_user'])->name('riwayatpelayanan_user'); //sidebar
    Route::get('/datakunjungan', [SimrsController::class, 'datakunjungan'])
        ->name('datakunjungan'); //sidebar
    Route::post('/pendaftaran/formranap', [SimrsController::class, 'Formranap'])
        ->name('formranap'); //footer,pencarianpasien
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
    Route::get('/cetaksurkon/{nomorsurat}', [VclaimController::class, 'Cetaksurkon']); //formpasien_bpjs
    Route::get('/cetakrujukan/{nomorrujukan}', [SimrsController::class, 'cetakrujukan']); //formpasien_bpjs
    Route::get('datakunjungan/cetaksep/{kodekunjungan}', [SimrsController::class, 'Cetaksep']); //formpasien_bpjs
    Route::get('/cetaksep_v/{sep}', [SimrsController::class, 'Cetaksep_v']); //formpasien_bpjs
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
    Route::get('Pendaftaran/cariobat', [SimrsController::class, 'cariobat'])
        ->name('cariobat'); //form[asien_bpjs
    Route::get('Pendaftaran/cariprocedure', [SimrsController::class, 'cariprocedure'])
        ->name('cariprocedure'); //form[asien_bpjs
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
    Route::post('/pendaftaran/updatenpasien', [SimrsController::class, 'updatenpasien'])
        ->name('updatenpasien');
    Route::post('/pendaftaran/daftarpasien_umum', [SimrsController::class, 'daftarpasien_umum'])
        ->name('daftarpasien_umum');
    Route::post('/pendaftaran/daftarpasien_ranap', [SimrsController::class, 'daftarpasien_ranap'])
        ->name('daftarpasien_ranap');
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
    Route::post('/pendaftaran/cariinfopasienbpjs', [SimrsController::class, 'infopasienbpjs'])
        ->name('cariinfopasienbpjs');
    Route::post('/pendaftaran/cariinfopasienbpjs2', [SimrsController::class, 'infopasienbpjs2'])
        ->name('cariinfopasienbpjs2');
    Route::post('/pendaftaran/cariinfoseppasien', [SimrsController::class, 'infosep'])
        ->name('cariinfoseppasien');
    Route::post('/pendaftaran/cariinforujukanpasien', [SimrsController::class, 'inforujukan'])
        ->name('cariinforujukanpasien');
    Route::post('/pendaftaran/cariunit_kelas', [SimrsController::class, 'cariunit_kelas'])
        ->name('cariunit_kelas');
    Route::post('/pendaftaran/formedit_kunjungan', [SimrsController::class, 'formedit_kunjungan'])
        ->name('formedit_kunjungan');
    Route::post('/pendaftaran/savedit_kunjungan', [SimrsController::class, 'savedit_kunjungan'])
        ->name('savedit_kunjungan');


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
        ->name('vclaimcarilistfinger'); //simrsindex
    Route::post('simrsvclaim/carikunjungansep_peserta', [VclaimController::class, 'datakunjungansep_peserta'])->name('vclaimcarikunjungansep_peserta'); //simrsindex
    Route::post('simrsvclaim/carikunjungansep', [VclaimController::class, 'datakunjungansep'])
        ->name('vclaimcarikunjungansep'); //simrsindex
    Route::post('simrsvclaim/detailsep', [VclaimController::class, 'detailsep'])
        ->name('vclaimdetailsep'); //simrsindex
    Route::post('simrsvclaim/hapussep', [VclaimController::class, 'hapussep'])
        ->name('vclaimhapussep'); //simrsindex
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

    Route::post('simrsvclaim/vclaimcarisep', [VclaimController::class, 'vclaimcarisep'])
        ->name('vclaimcarisep');
    Route::post('simrsvclaim/vclaimcarisepinternal', [VclaimController::class, 'sepinternal'])
        ->name('vclaimcarisepinternal');
    Route::post('simrsvclaim/vclaimlistfinger', [VclaimController::class, 'vclaimlistfinger'])
        ->name('vclaimlistfinger');
    Route::post('simrsvclaim/vclaimcarirujukanpeserta', [VclaimController::class, 'vclaimcarirujukanpeserta'])
        ->name('vclaimcarirujukanpeserta');
    Route::post('simrsvclaim/vclaimcarirujukankhusus', [VclaimController::class, 'vclaimcarirujukankhusus'])
        ->name('vclaimcarirujukankhusus');
    Route::post('simrsvclaim/vclaimcarirujukankeluar', [VclaimController::class, 'vclaimcarirujukankeluar'])
        ->name('vclaimcarirujukankeluar');
    Route::post('simrsvclaim/detailrujukankeluar', [VclaimController::class, 'detailrujukankeluar'])
        ->name('detailrujukankeluar');
    Route::post('simrsvclaim/updaterujukankeluar', [VclaimController::class, 'updaterujukankeluar'])
        ->name('updaterujukankeluar');
    Route::post('simrsvclaim/vclaimsimpanupdate_rujukan', [VclaimController::class, 'vclaimsimpanupdate_rujukan'])
        ->name('vclaimsimpanupdate_rujukan');
    Route::post('simrsvclaim/caripolirujukan', [VclaimController::class, 'caripolirujukan'])
        ->name('caripolirujukan');
    Route::post('simrsvclaim/vclaimsimpan_rujukan', [VclaimController::class, 'vclaimsimpan_rujukan'])
        ->name('vclaimsimpan_rujukan');
    Route::post('simrsvclaim/deleterujukan', [VclaimController::class, 'deleterujukan'])
        ->name('deleterujukan');
    Route::post('simrsvclaim/vclaimambil_formdiagnosa', [VclaimController::class, 'vclaimambil_formdiagnosa'])
        ->name('vclaimambil_formdiagnosa');
    Route::post('simrsvclaim/vclaimambil_formprocedure', [VclaimController::class, 'vclaimambil_formprocedure'])
        ->name('vclaimambil_formprocedure');
    Route::post('simrsvclaim/vclaimambil_formjenisobat', [VclaimController::class, 'vclaimambil_formjenisobat'])
        ->name('vclaimambil_formjenisobat');
    Route::post('simrsvclaim/vclaimsimpan_rujukankhusus', [VclaimController::class, 'vclaimsimpan_rujukankhusus'])
        ->name('vclaimsimpan_rujukankhusus');
    Route::post('simrsvclaim/vclaimsimpan_prb', [VclaimController::class, 'vclaimsimpan_prb'])
        ->name('vclaimsimpan_prb');
    Route::post('simrsvclaim/vclaimcarisuratkontrolpeserta', [VclaimController::class, 'vclaimcarisuratkontrolpeserta'])
        ->name('vclaimcarisuratkontrolpeserta');
    Route::post('simrsvclaim/vclaimcarisuratkontrolpeserta_bycard', [VclaimController::class, 'vclaimcarisuratkontrolpeserta_bycard'])
        ->name('vclaimcarisuratkontrolpeserta_bycard');
    Route::post('simrsvclaim/vclaimcarisuratkontrol_byrs', [VclaimController::class, 'vclaimcarisuratkontrol_byrs'])
        ->name('vclaimcarisuratkontrol_byrs');
    Route::post('simrsvclaim/vclaimcarisrb', [VclaimController::class, 'vclaimcarisrb'])
        ->name('vclaimcarisrb');
    Route::post('simrsvclaim/vclaimcarisrb_date', [VclaimController::class, 'vclaimcarisrb_date'])
        ->name('vclaimcarisrb_date');
    Route::post('simrsvclaim/vclaimcaridatakunjungan', [VclaimController::class, 'vclaimcaridatakunjungan'])
        ->name('vclaimcaridatakunjungan');
    Route::post('simrsvclaim/vclaimcaririwayatpeserta', [VclaimController::class, 'vclaimcaririwayatpeserta'])
        ->name('vclaimcaririwayatpeserta');
    Route::post('simrsvclaim/vclaimcaridataklaimjr', [VclaimController::class, 'vclaimcaridataklaimjr'])
        ->name('vclaimcaridataklaimjr');
    Route::post('simrsvclaim/caririwayatkunjungan', [VclaimController::class, 'caririwayatkunjungan'])
        ->name('caririwayatkunjungan');
    Route::post('simrsvclaim/caririwayatkunjungan2', [VclaimController::class, 'caririwayatkunjungan2'])
        ->name('caririwayatkunjungan2');
    Route::post('simrsvclaim/formbuatsep_manual', [VclaimController::class, 'formbuatsep_manual'])
        ->name('formbuatsep_manual');
    Route::post('simrsvclaim/buatsep_manual', [VclaimController::class, 'buatsep_manual'])
        ->name('buatsep_manual');
});
Route::group(['middleware' => ['auth', 'hak_akses1:1']], function () {
    Route::get('/menudataklaim', [SimrsController::class, 'menudataklaim'])
        ->name('menudataklaim'); //sidebar
    Route::post('simrsvclaim/vclaimcaridataklaim', [VclaimController::class, 'vclaimcaridataklaim'])
        ->name('vclaimcaridataklaim');
});
Route::group(['middleware' => ['auth', 'hak_akses1:3']], function () {
    Route::get('/ordermasuk', [PenunjangController::class, 'index'])
        ->name('ordermasuk'); //sidebar
    Route::post('/ambildetailorder', [PenunjangController::class, 'ambildetailorder'])
        ->name('ambildetailorder'); //sidebar
    Route::post('/terimaordernya', [PenunjangController::class, 'terimaordernya'])
        ->name('terimaordernya'); //sidebar

    Route::post('/ambildataorderan', [PenunjangController::class, 'ambildataorderan'])
        ->name('ambildataorderan'); //sidebar


    Route::get('/Billing', [BillingController::class, 'Billing'])
        ->name('Billing'); //sidebar
    Route::post('/Formlayanan', [BillingController::class, 'Formlayanan'])
        ->name('formlayanan'); //sidebar
    Route::post('/billingformlayanan', [BillingController::class, 'billingformlayanan'])
        ->name('billingformlayanan'); //sidebar
    Route::get('/carilayanan_penunjang', [BillingController::class, 'carilayanan_penunjang'])
        ->name('carilayanan_penunjang'); //sidebar
    Route::post('/caripasienrajal', [BillingController::class, 'caripasienrajal'])
        ->name('caripasienrajal'); //sidebar
    Route::post('/caripasienrajal', [BillingController::class, 'caripasienrajal'])
        ->name('caripasienrajal'); //sidebar
    Route::get('/caripoli_rs_bil', [SimrsController::class, 'Caripoli_rs'])
        ->name('caripoli_rs_bil'); //formpasien_bpjs
    Route::get('/simpanlayanan', [SimrsController::class, 'simpanlayanan'])
        ->name('simpanlayanan'); //formpasien_bpjs
});
Route::group(['middleware' => ['auth', 'hak_akses1:9']], function () {
    Route::get('/menucaripasien', [RanapController::class, 'menucaripasien'])
        ->name('menucaripasien'); //sidebar
    Route::get('/datasepranap', [RanapController::class, 'Index'])
        ->name('datasepranap'); //sidebar
    Route::post('/ranapupdatesep', [RanapController::class, 'UpdateSEP'])
        ->name('ranapupdatesep'); //sidebar
    Route::post('/detailsepranap', [RanapController::class, 'detailsepranap'])
        ->name('detailsepranap'); //sidebar
    Route::post('/infopasienranap', [RanapController::class, 'Infopasien'])
        ->name('infopasienranap'); //sidebar
    Route::post('/carisurkonranap', [RanapController::class, 'Carisurkonranap'])
        ->name('carisurkonranap'); //sidebar
    Route::post('/editkunjungan', [RanapController::class, 'editkunjungan'])
        ->name('editkunjungan'); //sidebar
    Route::post('/simpanajuan', [RanapController::class, 'simpanajuan'])
        ->name('simpanajuan'); //sidebar
});
//erm
Route::group(['middleware' => ['auth', 'hak_akses1:4']], function () {
    Route::get('/indexperawat', [ErmController::class, 'indexPerawat'])
        ->name('indexperawat'); //sidebar
    Route::get('/indexigd', [ErmIgdController::class, 'indexigd'])
        ->name('indexigd'); //sidebar
    Route::post('/ambildatapasienpoli', [ErmController::class, 'ambildatapasienpoli'])
        ->name('ambildatapasienpoli'); //sidebar
    Route::post('/ambil_form_igd', [ErmController::class, 'ambil_form_igd'])
        ->name('ambil_form_igd'); //sidebar
    Route::post('/formpemeriksaan_igd', [ErmController::class, 'formpemeriksaan_igd'])
        ->name('formpemeriksaan_igd'); //sidebar
    Route::post('/ambildatapasienpoli_cari', [ErmController::class, 'ambildatapasienpoli_cari'])
        ->name('ambildatapasienpoli_cari'); //sidebar
    Route::post('/ambildetailpasien', [ErmController::class, 'ambildetailpasien'])
        ->name('ambildetailpasien'); //sidebar
    Route::post('/formpemeriksaan_', [ErmController::class, 'formpemeriksaan_perawat'])
        ->name('formpemeriksaan_'); //sidebar
    Route::post('/formpemeriksaan_fisio', [ErmController::class, 'formpemeriksaan_perawat_fisio'])
        ->name('formpemeriksaan_fisio'); //sidebar
    Route::post('/formtindaklanjut', [ErmController::class, 'formtindaklanjut'])
        ->name('formtindaklanjut'); //sidebar
    Route::post('/formpemeriksaan_wicara', [ErmController::class, 'formpemeriksaan_perawat_wicara'])
        ->name('formpemeriksaan_wicara'); //sidebar
    Route::post('/simpanpemeriksaanperawat', [ErmController::class, 'simpanpemeriksaanperawat'])
        ->name('simpanpemeriksaanperawat'); //sidebar
    Route::post('/simpanpemeriksaanperawat_igd', [ErmController::class, 'simpanpemeriksaanperawat_igd'])
        ->name('simpanpemeriksaanperawat_igd'); //sidebar
    Route::post('/resumepasien', [ErmController::class, 'resumepasien'])
        ->name('resumepasien'); //sidebar
    Route::post('/simpanttdperawat', [ErmController::class, 'simpanttdperawat'])
        ->name('simpanttdperawat'); //sidebar
    Route::post('/gambarnyeri', [ErmController::class, 'gambarnyeri'])
        ->name('gambarnyeri'); //sidebar
    Route::post('/gambarcatatan_igd', [ErmController::class, 'gambarcatatan_igd'])
        ->name('gambarcatatan_igd'); //sidebar
    Route::post('/tindakanhariini_terapi', [ErmController::class, 'terapi_tindakanhariini'])
        ->name('tindakanhariini_terapi'); //sidebar
    Route::post('/ambilformasskep', [ErmController::class, 'ambilformasskep'])
        ->name('ambilformasskep'); //sidebar
    Route::post('/generatekode_igd', [ErmController::class, 'generatekode_igd'])
        ->name('generatekode_igd'); //sidebar
    Route::post('/formupload', [ErmController::class, 'formupload'])
        ->name('formupload'); //sidebar
    Route::post('/formsumarilis', [ErmController::class, 'formsumarilis'])
        ->name('formsumarilis'); //sidebar
    Route::post('/form_monitoring_darah', [ErmController::class, 'form_monitoring_darah'])
        ->name('form_monitoring_darah'); //sidebar
    Route::post('/ambilform_editmonitoring', [ErmController::class, 'ambilform_editmonitoring'])
        ->name('ambilform_editmonitoring'); //sidebar
    Route::post('/simpanmonitoring_darah', [ErmController::class, 'simpanmonitoring_darah'])
        ->name('simpanmonitoring_darah'); //sidebar
    Route::post('/simpaneditmonitoring_darah', [ErmController::class, 'simpaneditmonitoring_darah'])
        ->name('simpaneditmonitoring_darah'); //sidebar
    Route::post('/simpanhasil_reaksi', [ErmController::class, 'simpanhasil_reaksi'])
        ->name('simpanhasil_reaksi'); //sidebar
    Route::post('/ambilform_monitoring', [ErmController::class, 'ambilform_monitoring'])
        ->name('ambilform_monitoring'); //sidebar
    Route::post('/ambilform_edit_transfusi', [ErmController::class, 'ambilform_edit_transfusi'])
        ->name('ambilform_edit_transfusi'); //sidebar
    Route::post('/ambilform_input_reaksi', [ErmController::class, 'ambilform_input_reaksi'])
        ->name('ambilform_input_reaksi'); //sidebar
    Route::post('/uploadgambarnya', [ErmController::class, 'uploadgambarnya'])
        ->name('uploadgambarnya'); //sidebar
    Route::post('/hapusgambarupload', [ErmController::class, 'hapusgambarupload'])
        ->name('hapusgambarupload'); //sidebar
    Route::post('/batalheaderlayanan_terapi', [ErmController::class, 'batalheaderlayanan'])
        ->name('batalheaderlayanan_terapi'); //sidebar
    Route::post('/formsurkon', [ErmController::class, 'formsurkon'])
        ->name('formsurkon'); //sidebar
    Route::post('simpankonsul', [ErmController::class, 'simpankonsul'])
        ->name('simpankonsul'); //sidebar
    Route::post('simpansumarilis', [ErmController::class, 'simpansumarilis'])
        ->name('simpansumarilis'); //sidebar
    Route::post('simpandarah', [ErmController::class, 'simpandarah'])
        ->name('simpandarah'); //sidebar
    Route::post('hapusdarah', [ErmController::class, 'hapusdarah'])
        ->name('hapusdarah'); //sidebar
    Route::post('hapusmonitoring', [ErmController::class, 'hapusmonitoring'])
        ->name('hapusmonitoring'); //sidebar
    Route::post('simpaneditdarah', [ErmController::class, 'simpaneditdarah'])
        ->name('simpaneditdarah'); //sidebar
    Route::post('detailsumarilis', [ErmController::class, 'detailsumarilis'])
        ->name('detailsumarilis'); //sidebar
    Route::post('batalkonsul', [ErmController::class, 'batalkonsul'])
        ->name('batalkonsul'); //sidebar
    Route::get('caripoli_konsul', [SimrsController::class, 'Caripoli_rs'])
        ->name('caripoli_konsul'); //formpasien_bpjs
});
Route::group(['middleware' => ['auth', 'hak_akses1:5,7']], function () {
    Route::get('/cariobat', [ErmController::class, 'cariobat_form'])
        ->name('cariobat'); //formpasien_bpjs
    Route::get('/indexdokter', [ErmController::class, 'indexdokter'])
        ->name('indexdokter'); //sidebar
    Route::get('/indexdokter_igd', [ErmController::class, 'indexdokter_igd'])
        ->name('indexdokter_igd'); //sidebar
    Route::get('/indexdokter_ro', [ErmController::class, 'indexdokter_ro'])
        ->name('indexdokter_ro'); //sidebar
    Route::post('/form_pemeriksaan_ro', [ErmController::class, 'form_pemeriksaan_ro'])
        ->name('form_pemeriksaan_ro'); //sidebar
    Route::post('/simpanpemeriksaan_ro', [ErmController::class, 'simpanpemeriksaan_ro'])
        ->name('simpanpemeriksaan_ro'); //sidebar
    Route::post('/simpanpemeriksaan_ro_2', [ErmController::class, 'simpanpemeriksaan_ro_2'])
        ->name('simpanpemeriksaan_ro_2'); //sidebar
    Route::post('/ambildatapasiendokter_igd', [ErmController::class, 'ambildatapasiendokter_igd'])
        ->name('ambildatapasiendokter_igd'); //sidebar
    Route::post('/ambildatapasienpoli_dokter', [ErmController::class, 'ambildatapasienpoli_dokter'])
        ->name('ambildatapasienpoli_dokter'); //sidebar
    Route::post('/ambildatapasienpoli_dokter_cari', [ErmController::class, 'ambildatapasienpoli_dokter_cari'])
        ->name('ambildatapasienpoli_dokter_cari'); //sidebar
    Route::post('/ambildetailpasien_dokter', [ErmController::class, 'ambildetailpasien_dokter'])
        ->name('ambildetailpasien_dokter'); //sidebar
    Route::post('/formpemeriksaan_dokter', [ErmController::class, 'formpemeriksaan_dokter'])
        ->name('formpemeriksaan_dokter'); //sidebar
    Route::post('/ambil_form_igd_dokter', [ErmController::class, 'ambil_form_igd_dokter'])
        ->name('ambil_form_igd_dokter'); //sidebar
    Route::post('/simpanpemeriksaandokter', [ErmController::class, 'simpanpemeriksaandokter'])
        ->name('simpanpemeriksaandokter'); //sidebar
    Route::post('/simpanpemeriksaandokter_2', [ErmController::class, 'simpanpemeriksaandokter_2'])
        ->name('simpanpemeriksaandokter_2'); //sidebar
    Route::post('/simpanpemeriksaandokter_mata', [ErmController::class, 'simpanpemeriksaandokter_mata'])
        ->name('simpanpemeriksaandokter_mata'); //sidebar
    Route::post('/simpanpemeriksaandokter_fisio', [ErmController::class, 'simpanpemeriksaandokter_fisio'])
        ->name('simpanpemeriksaandokter_fisio'); //sidebar
    Route::post('/simpanpemeriksaandokter_anesetesi', [ErmController::class, 'simpanpemeriksaandokter_anesetesi'])
        ->name('simpanpemeriksaandokter_anesetesi'); //sidebar
    Route::post('/resumepasien_dokter', [ErmController::class, 'resumepasien_dokter'])
        ->name('resumepasien_dokter'); //sidebar
    Route::post('/simpanttddokter', [ErmController::class, 'simpanttddokter'])
        ->name('simpanttddokter'); //sidebar
    Route::post('/formtindakan', [ErmController::class, 'formtindakan'])
        ->name('formtindakan'); //sidebar
    Route::post('/gambartht1', [ErmController::class, 'gambartht1'])
        ->name('gambartht1'); //sidebar
    Route::post('/gambartht2', [ErmController::class, 'gambartht2'])
        ->name('gambartht2'); //sidebar
    Route::post('/simpantht_telinga', [ErmController::class, 'simpantht_telinga'])
        ->name('simpantht_telinga'); //sidebar
    Route::post('/simpantht_hidung', [ErmController::class, 'simpantht_hidung'])
        ->name('simpantht_hidung'); //sidebar
    Route::post('/simpanlayanan', [ErmController::class, 'simpanlayanan'])
        ->name('simpanlayanan'); //sidebar
    Route::post('/tindakanhariini', [ErmController::class, 'tindakanhariini'])
        ->name('tindakanhariini'); //sidebar
    Route::post('/tindakanhariini_lab', [ErmController::class, 'tindakanhariini_lab'])
        ->name('tindakanhariini_lab'); //sidebar
    Route::post('/tindakanhariini_rad', [ErmController::class, 'tindakanhariini_rad'])
        ->name('tindakanhariini_rad'); //sidebar
    Route::post('/orderobathariini', [ErmController::class, 'orderobathariini'])
        ->name('orderobathariini'); //sidebar
    Route::post('/gambarmatakanan', [ErmController::class, 'gambarmatakanan'])
        ->name('gambarmatakanan'); //sidebar
    Route::post('/gambarmatakiri', [ErmController::class, 'gambarmatakiri'])
        ->name('gambarmatakiri'); //sidebar
    Route::post('/simpanformmata', [ErmController::class, 'simpanformmata'])
        ->name('simpanformmata'); //sidebar
    Route::post('/simpanformgigi', [ErmController::class, 'simpanformgigi'])
        ->name('simpanformgigi'); //sidebar
    Route::post('/simpangambarbebas', [ErmController::class, 'simpangambarbebas'])
        ->name('simpangambarbebas'); //sidebar
    Route::post('/gambargigi', [ErmController::class, 'gambargigi'])
        ->name('gambargigi'); //sidebar
    Route::post('/formorderpenunjang', [ErmController::class, 'formorderpenunjang'])
        ->name('formorderpenunjang'); //sidebar
    Route::post('/batalheaderlayanan', [ErmController::class, 'batalheaderlayanan'])
        ->name('batalheaderlayanan'); //sidebar
    Route::post('/batalheaderlayanan_order', [ErmController::class, 'batalheaderlayanan_order'])
        ->name('batalheaderlayanan_order'); //sidebar
    Route::post('/ambilform', [ErmController::class, 'ambilform'])
        ->name('ambilform'); //sidebar
    Route::post('/simpanorder', [ErmController::class, 'simpanorder'])
        ->name('simpanorder'); //sidebar
    Route::post('/simpanorderfarmasi', [ErmController::class, 'simpanorderfarmasi'])
        ->name('simpanorderfarmasi'); //sidebar
    Route::post('/orderhari_ini', [ErmController::class, 'orderhari_ini'])
        ->name('orderhari_ini'); //sidebar
    Route::post('/formorderfarmasi', [ErmController::class, 'formorderfarmasi'])
        ->name('formorderfarmasi'); //sidebar
    Route::post('/cariobat', [ErmController::class, 'cariobat'])
        ->name('cariobat'); //sidebar
    Route::post('/tindaklanjut_dokter', [ErmController::class, 'tindaklanjut_dokter'])
        ->name('tindaklanjut_dokter'); //sidebar
    Route::post('/form_konsul_poli', [ErmController::class, 'form_konsul_poli'])
        ->name('form_konsul_poli'); //sidebar
    Route::post('/simpantindaklanjut', [ErmController::class, 'simpantindaklanjut'])
        ->name('simpantindaklanjut'); //sidebar
    Route::post('hapustemplateresep', [ErmController::class, 'hapustemplateresep'])
        ->name('hapustemplateresep'); //sidebar
    Route::post('ambilgambarpemeriksaan', [ErmController::class, 'ambilgambarpemeriksaan'])
        ->name('ambilgambarpemeriksaan'); //sidebar
    Route::post('ambilgambarmatakiri', [ErmController::class, 'ambilgambarpemeriksaan_matakiri'])
        ->name('ambilgambarmatakiri'); //sidebar

    Route::post('ambilgambarmatakanan', [ErmController::class, 'ambilgambarpemeriksaan_matakanan'])
        ->name('ambilgambarmatakanan'); //sidebar

    Route::post('ambilgambarpemeriksaan_reset', [ErmController::class, 'ambilgambarpemeriksaan_reset'])
        ->name('ambilgambarpemeriksaan_reset'); //sidebar
    Route::post('matakiri_reset', [ErmController::class, 'matakiri_reset'])
        ->name('matakiri_reset'); //sidebar
    Route::post('matakanan_reset', [ErmController::class, 'matakanan_reset'])
        ->name('matakanan_reset'); //sidebar
    Route::post('riwayatkonsul', [ErmController::class, 'riwayatkonsul'])
        ->name('riwayatkonsul'); //sidebar
    Route::post('hasilsumarilis', [ErmController::class, 'hasilsumarilis'])
        ->name('hasilsumarilis'); //sidebar
});


//farmasi
Route::group(['middleware' => ['auth', 'hak_akses1:6']], function () {
    // index_layanan_resep
    Route::get('/index_layanan_resep', [FarmasiController::class, 'index_layanan_resep'])->middleware('auth')->name('index_layanan_resep');
    Route::get('/cari_resep', [FarmasiController::class, 'index_cari_resep'])->middleware('auth')->name('cari_resep');
    Route::get('/kartu_stok', [FarmasiController::class, 'index_kartu_stok'])->middleware('auth')->name('kartu_stok');
    Route::post('/ambil_kartu_stok', [FarmasiController::class, 'ambil_kartu_stok'])->middleware('auth')->name('ambil_kartu_stok');
    Route::post('/ambil_data_order', [FarmasiController::class, 'ambil_data_order'])->middleware('auth')->name('ambil_data_order');
    Route::post('/ambil_data_pasien_far', [FarmasiController::class, 'ambil_data_pasien_far'])->middleware('auth')->name('ambil_data_pasien_far');
    Route::post('/ambil_detail_pasien', [FarmasiController::class, 'ambil_detail_pasien'])->middleware('auth')->name('ambil_detail_pasien');
    Route::post('/cari_obat_farmasi', [FarmasiController::class, 'cari_obat_farmasi'])->middleware('auth')->name('cari_obat_farmasi');
    Route::post('/hitunganracikan', [FarmasiController::class, 'hitungan_racikan'])->middleware('auth')->name('hitunganracikan');
    Route::post('/cari_obat_farmasi_racik', [FarmasiController::class, 'cari_obat_farmasi_racik'])->middleware('auth')->name('cari_obat_farmasi_racik');
    Route::post('/cari_riwayat_resep', [FarmasiController::class, 'cari_riwayat_resep'])->middleware('auth')->name('cari_riwayat_resep');
    Route::post('/cari_detail_resep', [FarmasiController::class, 'cari_detail_resep'])->middleware('auth')->name('cari_detail_resep');
    Route::post('/simpanorderan_far', [FarmasiController::class, 'simpanorderan_far'])->middleware('auth')->name('simpanorderan_far');
    Route::post('/jumlah_grand_total', [FarmasiController::class, 'jumlah_grand_total'])->middleware('auth')->name('jumlah_grand_total');
    Route::post('/minus_grand_total', [FarmasiController::class, 'minus_grand_total'])->middleware('auth')->name('minus_grand_total');
    Route::post('/minus_grand_total_retur', [FarmasiController::class, 'minus_grand_total_retur'])->middleware('auth')->name('minus_grand_total_retur');
    Route::post('/ambil_data_obat_retur', [FarmasiController::class, 'ambil_data_obat_retur'])->middleware('auth')->name('ambil_data_obat_retur');
    Route::post('/simpanretur', [FarmasiController::class, 'simpanretur'])->middleware('auth')->name('simpanretur');
    Route::get('/cetaketiket/{kodekunjungan}', [FarmasiController::class, 'CetakEtiket'])->middleware('auth')->name('CetakEtiket');
    Route::get('/cetaknotafarmasi/{kodekunjungan}', [FarmasiController::class, 'cetaknotafarmasi'])->middleware('auth')->name('CetakNotaFarmasi');
    Route::post('/jumlah_grand_total_racikan}', [FarmasiController::class, 'jumlahGrandtotalracikan'])->middleware('auth')->name('jumlah_grand_total_racikan');
    // Route::get('/test_print', [FarmasiController::class, 'test_print'])->middleware('auth')->name('test_print');
});


Route::group(['middleware' => ['auth', 'hak_akses1:99']], function () {
    Route::get('/antrianigd', [AntrianIgd::class, 'index']);
    Route::post('/ambildatapasien_igd', [AntrianIgd::class, 'datapasien_igd'])->name('ambildatapasien_igd');
    // Route::post('/simpanpemeriksaanperawat_igd', [AntrianIgd::class, 'simpanpasien'])->name('simpanpemeriksaanperawat_igd');
});








// Route::get('/pendaftaran', [SimrsController::class, 'Pendaftaran'])->middleware('auth');
