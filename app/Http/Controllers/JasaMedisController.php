<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JasaMedisController extends ErmController
{
    Public function indexjasamedis()
    {
        $title = 'SIMRS - Jasa Medis';
        $sidebar = 'indexjasamedis';
        $sidebar_m = '2';
        $now = $this->get_date();

        return view('jasamedis.index', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'now'
        ]));
    }
    public function ambildatatotalklaim(Request $request)
    {
        $tglawal = $request->tglawal;
        $tglakhir = $request->tglakhir;
        $header = db::connection('mysql6')->select('SELECT DISTINCT no_sep
        ,a.`status_klaim`
        ,a.`jenis`
        ,a.`rm`
        ,a.nama_px
        ,a.Total_klaim
        ,a.`bulan_tahun` FROM 04_data03_ranap a');
        return view('jasamedis.table_jasa_header',compact([
            'header'
        ]));
    }
    public function ambildetailsep(Request $request)
    {
        $sep = $request->sep;
        $data = db::connection('mysql6')->select('select * from 04_data03_ranap  where no_sep = ?',[$sep]);
        $dpjputama = $data[0]->dpjp;
        $arr = '(Visite Dokter Spesialis,Visite Dokter Umum,Visite Dokter Subspesialis,Konsultasi Dokter Antar Subspesialis,Konsultasi Dokter Spesialis (On Call))';

        $datadokter = db::connection('mysql6')->select('select distinct lay_det_dokter1 from 04_data03_ranap  where no_sep = ?',[$sep]);
        $mt_pasien = db::connection('mysql')->select('select *,fc_alamat(no_rm) as alamatpx from mt_pasien where no_rm = ?',[$data[0]->rm]);
        $status_sep = db::connection('mysql6')->select('SELECT DISTINCT b.`No_SEp`,b.`Prosedur` FROM 04_data03_ranap a INNER JOIN `master_dataklaim_keu` b ON a.`no_sep` = b.`No_SEp` where a.no_sep = ?',[$sep]);


        $datadokterlain = db::connection('mysql6')->select("select distinct lay_det_dokter1 from 04_data03_ranap where no_sep = ? and lay_det_dokter1 != ? AND lay_det_nm_tindakan IN ('Visite Dokter Spesialis','Visite Dokter Umum','Visite Dokter Subspesialis','Konsultasi Dokter Antar Subspesialis','Konsultasi Dokter Spesialis (On Call)')",[$sep,$dpjputama]);
        $datadokterlain2 = db::connection('mysql6')->select("select * from 04_data03_ranap where no_sep = ? and lay_det_dokter1 != ? AND lay_det_nm_tindakan IN ('Visite Dokter Spesialis','Visite Dokter Umum','Visite Dokter Subspesialis','Konsultasi Dokter Antar Subspesialis','Konsultasi Dokter Spesialis (On Call)')",[$sep,$dpjputama]);

        // $ts_kunjungan = db::connection('mysql')->select('select * from ts_kunjungan where no_sep = ?',[$sep]);
        // foreach($ts_kunjungan as $td){
        //     $lyhd = db::connection('mysql')->select('select * from ts_layanan_header where kode_kunjungan = ?',[$td->kode_kunjungan]);
        //     foreach($lyhd as $l){
        //         $lydt = db::connection('mysql')->select('select * from ts_layanan_detail a left outer join mt_tarif_header b on substr(a.kode_tarif_detail,1,6)= b.KODE_TARIF_HEADER where a.row_id_header = ?',[$l->id]);
        //         foreach($lydt as $ll){
        //             $index = $ll->NAMA_TARIF;
        //             $value = $l->kode_unit;
        //             $dataSet1[$index] = $value;
        //         }
        //     }
        // }
        // dd($dataSet1);
        $jlhdokterlain= count($datadokterlain);
        if($jlhdokterlain > 0){
            foreach($datadokterlain as $d){
                $index = $d->lay_det_dokter1;
                $jlh = 0;
                foreach($datadokterlain2 as $dd){
                    if($dd->lay_det_dokter1 == $d->lay_det_dokter1){
                        $index2 = $dd->lay_det_dokter1;
                        $jlh = $jlh + 1;
                        $dataSet[$index2] = $jlh;
                    }
                }
            }
        }else{
            $dataSet[] = '';
        }
        return view('jasamedis.detailsep',compact([
            'data','mt_pasien','datadokter','status_sep','datadokterlain','jlhdokterlain','dataSet'
        ]));
    }
}
