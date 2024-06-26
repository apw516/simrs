 <div class="tab-pane" id="timeline">
     <!-- The timeline -->
     @foreach ($kunjungan as $k)
         @foreach ($assesment as $a)
             @if ($k->kode_kunjungan == $a->kode_kunjungan)
                 <div class="timeline timeline-inverse">
                     <!-- timeline time label -->
                     <div class="time-label">
                         <span class="bg-success text-lg">
                             @php echo date('d-M-Y',strtotime($k->tgl_masuk)) @endphp | {{ $k->nama_unit }}
                         </span>
                     </div>
                     <!-- /.timeline-label -->
                     <!-- timeline item -->
                     <div>
                         <i class="fas fa-envelope bg-primary"></i>

                         <div class="timeline-item">
                             <span class="time text-dark text-lg text-bold"> @php echo date('d-M-Y',strtotime($k->tgl_masuk)) @endphp / {{ $a->namapemeriksa }}
                                 / {{ $k->nama_unit }}</span>

                             <h3 class="timeline-header"><a href="#" class="text-dark">Assesment keperawatan /
                                     kebidanan </h3>
                             <div class="timeline-body">
                                 @if ($k->kode_unit == '1028')
                                     <table class="table table-sm">
                                         <tbody>
                                             <tr>
                                                 <td>Keterangan</td>
                                                 <td>{{ $a->keterangan_cppt }}</td>
                                             </tr>
                                             <tr>
                                                 <td>Hasil Pemeriksaan</td>
                                                 <td>{{ $a->tindakankeperawatan }}</td>
                                             </tr>
                                         </tbody>
                                     </table>
                                 @else
                                     <table class="table table-sm">
                                         <tr>
                                             <td width="15%" class="text-bold">Tekanan Darah</td>
                                             <td width="15%" class="font-italic">: {{ $a->tekanan_darah }} mmHg</td>
                                             <td width="15%" class="text-bold">Frekuensi Nadi</td>
                                             <td class="font-italic">: {{ $a->frekuensi_nadi }} x/menit </td>
                                             <td width="15%" class="text-bold">Frekuensi Nafas</td>
                                             <td class="font-italic">: {{ $a->frekuensi_nafas }} x/menit </td>
                                         </tr>
                                         <tr>
                                             <td width="15%" class="text-bold">Suhu</td>
                                             <td class="font-italic">: {{ $a->suhu_tubuh }} °C </td>
                                             <td width="15%" class="text-bold">BB/TB/IMT</td>
                                             <td class="font-italic">: {{ $a->beratbadan }}</td>
                                             <td width="15%" class="text-bold">Usia</td>
                                             <td class="font-italic">: {{ $a->umur }}</td>
                                         </tr>
                                         <tr>
                                             <td class="text-bold">Diagnosa Keperawatan</td>
                                             <td class="font-italic" colspan="5">: {{ $a->diagnosakeperawatan }}
                                             </td>
                                         </tr>
                                         <tr>
                                             <td class="text-bold">Rencana Keperawatan</td>
                                             <td class="font-italic" colspan="5">: {{ $a->rencanakeperawatan }}</td>
                                         </tr>
                                         <tr>
                                             <td class="text-bold">Tindakan Keperawatan</td>
                                             <td class="font-italic" colspan="5">: {{ $a->tindakankeperawatan }}
                                             </td>
                                         </tr>
                                         <tr>
                                             <td class="text-bold">Evaluasi Keperawatan</td>
                                             <td class="font-italic" colspan="5">: {{ $a->evaluasikeperawatan }}
                                             </td>
                                         </tr>
                                     </table>
                                 @endif
                             </div>
                             <div class="timeline-footer">
                                 <a href="#" class="btn btn-primary btn-sm btncetakasskep"
                                     kodekunjungan="{{ $k->kode_kunjungan }}" data-toggle="modal"
                                     data-target="#modalcetakanasskep"><i class="bi bi-printer"></i>
                                     Cetak</a>
                             </div>
                         </div>
                     </div>
                     <!-- END timeline item -->
                     <!-- timeline item -->
                     <div>
                         <i class="fas fa-comments bg-warning"></i>
                         <div class="timeline-item">
                             <span class="time text-dark text-lg text-bold"> @php echo date('d-M-Y',strtotime($k->tgl_masuk)) @endphp / {{ $a->nama_dokter }}
                                 / {{ $k->nama_unit }}</span>

                             <h3 class="timeline-header "><a href="#" class="text-dark">Assesment Medis</h3>
                             <div class="timeline-body">
                                 @if ($k->kode_unit == '1028')
                                     <table class="table table-sm table-bordered">
                                         <tbody>
                                             <tr>
                                                 <td colspan="6" class="text-bold text-center">Tanda tanda vital</td>
                                             </tr>
                                             <tr>
                                                 <td width="15%" class="text-bold">Tekanan Darah</td>
                                                 <td width="15%" class="font-italic">: {{ $a->tekanan_darah }} mmHg
                                                 </td>
                                                 <td width="15%" class="text-bold">Frekuensi Nadi</td>
                                                 <td class="font-italic">: {{ $a->frekuensi_nadi }} x/menit </td>
                                                 <td width="15%" class="text-bold">Frekuensi Nafas</td>
                                                 <td class="font-italic">: {{ $a->frekuensi_nafas }} x/menit </td>
                                             </tr>
                                             <tr>
                                                 <td width="15%" class="text-bold">Suhu</td>
                                                 <td class="font-italic">: {{ $a->suhu_tubuh }} °C </td>
                                                 <td width="15%" class="text-bold">BB/TB/IMT</td>
                                                 <td class="font-italic">: {{ $a->beratbadan }} </td>
                                                 <td width="15%" class="text-bold">Usia</td>
                                                 <td class="font-italic">: {{ $a->umur }}</td>
                                             </tr>
                                             <tr>
                                                 <td colspan="6" class="text-bold text-center">Layanan fisik dan
                                                     rehabilitasi</td>
                                             </tr>
                                             <tr>
                                                 <td>Anamanesa</td>
                                                 <td colspan="5">{{ $a->anamnesa }}</td>
                                             </tr>
                                             <tr>
                                                 <td> Pemeriksaan fungsi dan uji fungsi</td>
                                                 <td colspan="5">{{ $a->pemeriksaan_fisik }}</td>
                                             </tr>
                                             <tr>
                                                 <td> Diagnosis Medis ( ICD 10) i</td>
                                                 <td colspan="5">{{ $a->diagnosakerja }}</td>
                                             </tr>
                                             <tr>
                                                 <td> Diagnosis Fungsi ( ICD 10) </td>
                                                 <td colspan="5">{{ $a->diagnosabanding }}</td>
                                             </tr>
                                         </tbody>
                                     </table>
                                 @elseif($k->kode_unit == '1026')
                                     <table class="table table-sm">
                                        <tr>
                                            <td>Sumber Data</td>
                                            <td>{{ $a->sumber_data}}</td>
                                        </tr>
                                        <tr>
                                            <td>Keluhan utama</td>
                                            <td>{{ $a->keluhan_pasien}}</td>
                                        </tr>
                                        <tr>
                                            <td>Riwayat penyakit dahulu</td>
                                            <td>{{ $a->ket_riwayatlain}}</td>
                                        </tr>
                                        <tr>
                                            <td>Diagnosa WD & DD</td>
                                            <td>{{ $a->diagnosakerja}}</td>
                                        </tr>
                                        <tr>
                                            <td>Dasar diagnosa</td>
                                            <td>{{ $a->diagnosabanding}}</td>
                                        </tr>
                                        <tr>
                                            <td>Assesmen</td>
                                            <td>@if($a->tindak_lanjut == 1)Setuju dijadwalkan operasi @else Saat ini keadaan pasien dalam kondisi belum untuk dilakukan tindakan anestesi @endif</td>
                                        </tr>
                                        <tr>
                                            <td>Jawaban konsul</td>
                                            <td>{{ $a->keterangan_tindak_lanjut_2}}</td>
                                        </tr>
                                     </table>
                                 @else
                                     <table class="table">
                                         <tr>
                                             <td width="15%" class="text-bold">Sumber Data</td>
                                             <td class="font-italic">: {{ $a->sumber_data }}</td>
                                         </tr>
                                         <tr>
                                             <td width="15%" class="text-bold">Keluhan utama</td>
                                             <td class="font-italic">: {{ $a->keluhan_pasien }}</td>
                                         </tr>
                                         <tr>
                                             <td width="15%" class="text-bold">Riwayat penyakit dahulu</td>
                                             <td class="font-italic">: {{ $a->ket_riwayatlain }}</td>
                                         </tr>
                                         <tr>
                                             <td width="15%" class="text-bold">Riwayat Alergi</td>
                                             <td class="font-italic">: {{ $a->riwayat_alergi }}
                                                 {{ $a->keterangan_alergi }}</td>
                                         </tr>
                                         <tr>
                                             <td class="text-bold">Pemeriksaan Fisik</td>
                                             <td class="font-italic">: @if ($a->versi == 1)
                                                     {{ $a->keadaanumum }}, {{ $a->kesadaran }},
                                                     {{ $a->pemeriksaan_fisik }}
                                                 @else
                                                     {{ $a->pemeriksaan_fisik }}
                                                 @endif
                                             </td>
                                         </tr>
                                         <tr>
                                             <td width="15%" class="text-bold">Diagnosa Primer</td>
                                             <td class="font-italic">: {{ $a->diagnosakerja }}</td>
                                         </tr>
                                         <tr>
                                             <td class="text-bold">Diagnosa Sekunder</td>
                                             <td class="font-italic">: {{ $a->diagnosabanding }}</td>
                                         </tr>
                                         <tr>
                                             <td class="text-bold">Rencana Terapi</td>
                                             <td class="font-italic">: {{ $a->rencanakerja }}</td>
                                         </tr>
                                         <tr>
                                             <td class="text-bold">Tindak Lanjut</td>
                                             <td class="font-italic">: {{ $a->tindak_lanjut }}</td>
                                         </tr>
                                         <tr>
                                             <td class="text-bold">Riwayat pemakaian obat</td>
                                             <td class="font-italic">
                                                 <table class="table table-sm table-bordered table-striped">
                                                     <thead class="bg-secondary">
                                                         <th>Nama Obat</th>
                                                         <th>Jumlah</th>
                                                         <th>Aturan pakai</th>
                                                         <th>Keterangan</th>
                                                     </thead>
                                                     <tbody>
                                                         @foreach ($data_h as $h)
                                                             {{-- @if ($h->kode_kunjungan == $a->kode_kunjungan) --}}
                                                             @foreach ($h as $d)
                                                                 @if ($d->kode_kunjungan == $a->kode_kunjungan)
                                                                     <tr>
                                                                         <td> {{ $d->nama_barang }}</td>
                                                                         <td> {{ $d->jumlah_layanan }}</td>
                                                                         <td> {{ $d->aturan_pakai }}</td>
                                                                         <td> {{ $d->keterangan01 }}</td>
                                                                     </tr>
                                                                 @endif
                                                             @endforeach
                                                             {{-- @endif --}}
                                                         @endforeach
                                                     </tbody>
                                                 </table>
                                             </td>
                                         </tr>
                                     </table>
                                 @endif
                             </div>
                             <div class="timeline-footer">
                                 <a class="btn btn-primary btn-flat btn-sm btncetakassdok"
                                     kodekunjungan="{{ $k->kode_kunjungan }}" data-toggle="modal"
                                     data-target="#modalcetakanassdok"><i class="bi bi-printer"></i> Cetak</a>
                             </div>
                         </div>
                     </div>
                 </div>
             @endif
         @endforeach
     @endforeach
 </div>
 <!-- Modal -->
 <style>
     .modal-xxl {
         max-width: 80%;
     }
 </style>
 <div class="modal fade" id="modalcetakanasskep" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog modal-xxl">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Cetak Assesmen Keperawatan Rawat Jalan</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <div class="v_cetakan_asskep">

                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             </div>
         </div>
     </div>
 </div>
 <div class="modal fade" id="modalcetakanassdok" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog modal-xxl">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Cetak Assesmen Medis Rawat Jalan</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <div class="v_cetakan_assdok">

                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             </div>
         </div>
     </div>
 </div>
 <script>
     $(".btncetakasskep").on('click', function(event) {
         kodekunjungan = $(this).attr('kodekunjungan')
         spinner = $('#loader')
         spinner.show();
         $.ajax({
             type: 'post',
             data: {
                 _token: "{{ csrf_token() }}",
                 kodekunjungan
             },
             url: '<?= route('cetakanasskep') ?>',
             success: function(response) {
                 $('.v_cetakan_asskep').html(response);
                 spinner.hide()
             }
         });
     })
     $(".btncetakassdok").on('click', function(event) {
         kodekunjungan = $(this).attr('kodekunjungan')
         spinner = $('#loader')
         spinner.show();
         $.ajax({
             type: 'post',
             data: {
                 _token: "{{ csrf_token() }}",
                 kodekunjungan
             },
             url: '<?= route('cetakanassdok') ?>',
             success: function(response) {
                 $('.v_cetakan_assdok').html(response);
                 spinner.hide()
             }
         });
     })
 </script>
