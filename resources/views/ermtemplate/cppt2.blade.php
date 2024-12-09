<table class="table table-sm table-bordered">
    <thead>
        <th>Tanggal/jam</th>
        <th>Hasil pemeriksaan, analisa, rencana penatalaksanaan pasien(ditulis dengan format SOAP,disertai target yang
            terukur,evaluasi hasil,tatalaksan dituliskan dalam assesmen )</th>
        <th>Perawat/bidan</th>
        <th>Instruksi tenaga kesehatan, termasuk pasca bedah/prosedur</th>
        <th>DPJP</th>
    </thead>
    <tbody>
        @foreach ($cppt as $c)
            <tr>
                <td colspan="5" class="text-bold bg-light">{{ $c->nama_unit }} / {{ $c->nama_dokter }}</td>
            </tr>
            <tr>
                <td class="text-bold">{{ date('d-M-Y', strtotime($c->tglisi )); }}</td>
                <td class="font-italic text-bold">
                    @if ($c->unit_asskep == '1028')
                        @if ($c->keterangan_cppt == 'FISIOTERAPI')
                            Hasil Pemerikssaan fisioterapi : <br><br>
                            {{ $c->tindakankeperawatan }}
                        @endif
                        @if ($c->keterangan_cppt == 'TERAPIWICARA')
                            Hasil Pemerikssaan terapiwicara : <br><br>
                            {{ $c->tindakankeperawatan }}
                        @endif
                    @else
                        S : <br>
                        @if ($c->versi_asskep == 2)
                            @if ($c->sumberdataperiksa == 1)
                                Sumber data : Pasien sendiri<br>
                            @else
                                Sumber data : Keluarga <br>
                            @endif
                        @else
                            {{ $c->sumberdataperiksa }}<br>
                        @endif
                        {{ $c->keluhanutama }}<br>
                        Assemsen nyeri :
                        @if ($c->versi_asskep == 2)
                            @if ($c->Keluhannyeri == 1)
                                Tidak ada <br>
                            @else
                                Ada <br>
                            @endif
                        @else
                            {{ $c->Keluhannyeri }}<br>
                        @endif
                        <br>
                        Skala : {{ $c->skalenyeripasien }}<br><br>

                        O: <br>
                        Tanda Tanda Vital
                        Tekanan Darah : {{ $c->tekanandarah }}<br>
                        Frekuensi Nadi : {{ $c->frekuensinadi }}<br>
                        Frekuensi Nafas : {{ $c->frekuensinapas }}<br>
                        Suhu : {{ $c->suhutubuh }}<br>
                        Berat badan / Tinggi Badan / IMT : {{ $c->beratbadan }} / {{ $c->tinggibadan }} /
                        {{ $c->imt }}<br>
                        Umur : {{ $c->usia }}<br>
                        Riwayat Psikologis :
                        @if ($c->versi_asskep == 2)
                            @if ($c->Riwayatpsikologi == 0)
                                Tidak Ada <br>
                            @elseif($c->Riwayatpsikologi == 1)
                                Cemas <br>
                            @elseif($c->Riwayatpsikologi == 2)
                                Takut <br>
                            @elseif($c->Riwayatpsikologi == 3)
                                Sedih <br>
                            @elseif($c->Riwayatpsikologi == 4)
                                Lainnya <br>
                            @endif
                        @else
                            {{ $c->Riwayatpsikologi }}<br>
                        @endif

                        | {{ $c->keterangan_riwayat_psikolog }}<br>
                        Penggunaan Alat bantu :
                        @if ($c->versi_asskep == 2)
                            @if ($c->penggunaanalatbantu == 1)
                                Tidak<br>
                            @elseif($c->penggunaanalatbantu == 2)
                                Tongat<br>
                            @elseif($c->penggunaanalatbantu == 3)
                                Kursi Roda<br>
                            @endif
                        @else
                            {{ $c->penggunaanalatbantu }} | {{ $c->keterangan_alat_bantu }}<br>
                        @endif

                        @if ($c->versi_asskep == 2)
                            Cacat tubuh :
                            @if ($c->cacattubuh == 1)
                                Tidak <br>
                            @elseif($c->cacattubuh == 2)
                                Ya | {{ $c->keterangancacattubuh }} <br>
                            @endif
                        @else
                            Cacat tubuh : {{ $c->cacattubuh }} | {{ $c->keterangancacattubuh }}<br>
                        @endif
                        @if ($c->versi_asskep == 2)
                            Skrinning gizi :
                            @if ($c->Skrininggizi == 1)
                                Tidak Ada Penuruan Berat Badan <br>
                            @elseif($c->Skrininggizi == 2)
                                Tidak Yakin / tidak tahu/terasa baju lebih longgar<br>
                            @elseif($c->Skrininggizi == 3)
                                jika ya berapa penurunan berat badan tersebut<br>
                            @endif
                            Skala Penurunan bb :
                            @if ($c->beratskrininggizi == 1)
                                TIDAK ADA <br>
                            @elseif($c->beratskrininggizi == 2)
                                1 - 5 KG<br>
                            @elseif($c->beratskrininggizi == 3)
                                6 - 10 KG<br>
                            @elseif($c->beratskrininggizi == 4)
                                11 - 15 KG<br>
                            @elseif($c->beratskrininggizi == 5)
                                > 15 KG<br>
                            @elseif($c->beratskrininggizi == 6)
                                TIDAK YAKIN PENURUNANNYA<br>
                            @endif
                        @else
                            Skrinning Gizi : {{ $c->Skrininggizi }} / {{ $c->beratskrininggizi }}<br>
                        @endif
                        Apakah asupan makanan berkurang karena berkurangnya nafsu makan :
                        @if ($c->versi_asskep == 2)
                            @if ($c->status_asupanmkanan == 1)
                                TIDAK ADA <br>
                            @elseif($c->status_asupanmkanan == 2)
                                YA<br>
                            @endif
                        @else
                            {{ $c->status_asupanmkanan }}<br>
                        @endif
                        Apakah Pasien dengan diagnosa khusus : Penyakit DM / Ginjal / Hati / Paru / Stroke / Kanker /
                        Penurunan imunitas geriatri, lain lain...?
                        @if ($c->versi_asskep == 2)
                            @if ($c->penyakitlainpasien == 1)
                                TIDAK ADA <br>
                            @elseif($c->penyakitlainpasien == 2)
                                YA<br>
                            @endif
                        @else
                            {{ $c->penyakitlainpasien }}
                        @endif
                        / {{ $c->diagnosakhusus }}
                        <br><br>

                        A: <br>
                        Diagnosa Keperawatan : {{ $c->diagnosakeperawatan }}<br><br>
                        P: <br>
                        Rencana Keperawatan : {{ $c->rencanakeperawatan }}<br>
                        Tindakan Keperawatan : {{ $c->tindakankeperawatan }}<br>
                        Evaluasi Keperawatan : {{ $c->evaluasikeperawatan }}<br>
                    @endif
                </td>
                <td class="font-italic text-bold">
                    {{ $c->namapemeriksa }}<br>
                </td>
                <td class="font-italic text-bold">
                    @if ($c->unit_asskep == '1028')
                        @if (trim($c->nama_dokter) != '')
                            Tekanan Darah : {{ $c->tekanan_darah }} <br>
                            Frekuensi Nadi : {{ $c->frekuensi_nadi }} <br>
                            Frekuensi Nafas : {{ $c->frekuensi_nafas }} <br>
                            Suhu : {{ $c->suhu_tubuh }} <br>
                            Berat Badan : {{ $c->beratbadan }} <br>
                            Umur : {{ $c->umur }} <br>
                            IMT : {{ $c->imt }} <br>
                            Anamnesa : {{ $c->anamnesa }}
                            Pemeriksaan Fisik dan Uji Fungsi : {{ $c->pemeriksaan_fisik }}<br><br>
                            Diagnosis Medis ( ICD 10) : {{ $c->diagnosakerja }}<br><br>
                            Diagnosis Fungsi ( ICD 10) : {{ $c->diagnosabanding }}<br><br>
                            Pemeriksaan Penunjang : {{ $c->rencanakerja }}<br><br>
                            Tata Laksana KFR ( ICD 9CM ) : {{ $c->tatalaksana_kfr }}<br><br>
                            Anjuran : {{ $c->anjuran }}<br><br>
                            Evaluasi : {{ $c->evaluasi }}<br><br>
                            Suspek penyakit akibat kerja : @if ($c->riwayatlain == 0)
                                Tidak ada
                            @else
                                Ada / {{ $c->ket_riwayatlain }}
                            @endif
                            <br><br>
                        @endif
                    @elseif ($c->unit_asskep == '1026')
                        @if (trim($c->nama_dokter) != '')
                            Tekanan Darah : {{ $c->tekanan_darah }} <br>
                            Frekuensi Nadi : {{ $c->frekuensi_nadi }} <br>
                            Frekuensi Nafas : {{ $c->frekuensi_nafas }} <br>
                            Suhu : {{ $c->suhu_tubuh }} <br>
                            Berat Badan : {{ $c->beratbadan }} <br>
                            Umur : {{ $c->umur }} <br>
                            IMT : {{ $c->imt }} <br><br>
                            DIAGNOSA WD : {{ $c->diagnosakerja }} <br><br>
                            DASAR DIAGNOSA : {{ $c->diagnosabanding }} <br><br>
                            ANAMNESA<br><br>
                            Alergi : {{ $c->alergi }}<br>
                            Medikasi : {{ $c->medikasi }}<br>
                            Postillnes : {{ $c->postillnes }}<br>
                            Lastmeal : {{ $c->lastmeal }}<br>
                            Event : {{ $c->event }}<br><br>
                            PEMERIKSAAN FISIK<br><br>
                            Cor : {{ $c->cor }}<br>
                            Pulmo : {{ $c->pulmo }}<br>
                            Gigi : {{ $c->gigi }}<br>
                            Ekstremitas : {{ $c->ekstremitas }}<br><br>

                            PENILAIAN EVALUASI JALAN NAFAS <br>
                            @php
                                $lemon = explode('|', $c->LEMON);
                            @endphp
                            @if (count($lemon) > 0)
                                L : {{ $lemon[0] }} <br>
                                E : {{ $lemon[1] }} <br>
                                M : {{ $lemon[2] }} <br>
                                O : {{ $lemon[3] }} <br>
                                N : {{ $lemon[4] }} <br><br>
                            @endif
                            Assemen : @if ($c->tindak_lanjut == 1)
                                Setuju dijadwalkan untuk operasi
                            @else
                                Saat ini keadaan pasien dalam kondisi belum untuk dilakukan tindakan anestesi
                            @endif <br><br>
                            Saran : {{ $c->keterangan_tindak_lanjut }}<br><br>
                            Jawaban Konsul : {{ $c->keterangan_tindak_lanjut_2 }}<br><br>
                        @endif
                    @else
                        Sumber data periksa :
                        @if ($c->versi_asskep == 2)
                            @if ($c->sumberdataperiksa == 1)
                                Pasien Sendiri<br><br>
                            @else
                                Keluarga<br><br>
                            @endif
                        @else
                            {{ $c->sumberdataperiksa }}<br><br>
                        @endif
                        Keluhan Utama : {{ $c->keluhan_pasien }}<br><br>
                        Riwyat penyakit : {{ $c->riwyat_penyakit_sekarang }}<br><br>
                        Riwayat alergi :
                        @if ($c->versi_asskep == 2)
                            @if ($c->riwayat_alergi == 0)
                                Tidak Ada<br><br>
                            @else
                                Ada<br><br>
                            @endif
                        @else
                            {{ $c->riwayat_alergi }}<br><br>
                        @endif
                        / {{ $c->keterangan_alergi }}<br><br>
                        Riwayat obat yang diminum : {{ $c->ket_riwayatlain }}<br><br>
                        Pemeriksaan Fisik : {{ $c->pemeriksaan_fisik }}<br><br>
                        @if ($c->kode_unit == '1014')
                            Hasil Pemeriksaan RO : <br>
                            Hasil Pemeriksaan : {{ $c->tajampenglihatandekat }} <br><br>
                            MATA KIRI | MATA KANAN <br>
                            Tekanan Intra Okular : {{ $c->tekananintraokular }} <br>
                            Catatan Pemeriksaan Lain : {{ $c->catatanpemeriksaanlain }} <br>
                            Palpebra : {{ $c->palpebra }} <br>
                            Konjungtiva : {{ $c->konjungtiva }} <br>
                            Kornea : {{ $c->kornea }} <br>
                            Bilik mata depan : {{ $c->bilikmatadepan }} <br>
                            pupil : {{ $c->pupil }} <br>
                            iris : {{ $c->iris }} <br>
                            lensa : {{ $c->lensa }} <br>
                            Funduskopi : {{ $c->funduskopi }} <br>
                            Status oftamologis khusus : {{ $c->status_oftamologis_khusus }} <br>
                            Masalah medis : {{ $c->masalahmedis }} <br>
                            Prognosis : {{ $c->prognosis }} <br><br>
                        @endif
                        Diagnosis : {{ $c->diagnosakerja }}<br><br>
                        Diagnosis Sekunder : {{ $c->diagnosabanding }}<br><br>
                        Rencana terapi : {{ $c->rencanakerja }}<br><br>
                        Rencana pemeriksaan penunjang : {{ $c->order_laboratorium }}<br><br>
                        Tindak lanjut : <br>
                        @if ($c->versi_asskep == 2)
                            @php
                                $tl = explode('|', $c->tindak_lanjut);
                            @endphp
                            @if ($c->kode_unit != '1026')
                                @if (!!!empty($tl[0]))
                                    @if ($tl[0] == 1)
                                        Pulang <br>
                                    @endif
                                    @if ($tl[1] == 1)
                                        Kontrol <br>
                                    @endif
                                    @if ($tl[2] == 1)
                                        Konsul <br>
                                    @endif
                                    @if ($tl[3] == 1)
                                        Rawat Inap <br>
                                    @endif
                                    @if ($tl[4] == 1)
                                        Rujuk Keluar <br>
                                    @endif
                                @endif
                            @endif
                        @else
                            {{ $c->tindak_lanjut }}<br><br>
                        @endif
                        Keterangan Tindak lanjut : {{ $c->keterangan_tindak_lanjut }}<br><br>
                    @endif
                    obat yang diberikan :<br>
                    @foreach ($dataSet as $od)
                        @foreach($od as $ob)
                        @if ($c->kode_kunjungan == $ob->kode_kunjungan)
                            {{ $ob->nama_barang }} | Jumlah : {{ $ob->jumlah_layanan }} | Aturan pakai :
                            {{ $ob->aturan_pakai }}<br><br>
                        @endif
                        @endforeach
                    @endforeach
                </td>
                <td class="font-italic text-bold">
                    {{ $c->nama_dokter }}<br>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
