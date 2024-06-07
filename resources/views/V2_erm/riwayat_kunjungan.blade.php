 <div class="tab-pane" id="timeline">
     <!-- The timeline -->
     @foreach ($kunjungan as $k)
         @foreach ($assesment as $a)
             @if ($k->kode_kunjungan == $a->kode_kunjungan)
                 <div class="timeline timeline-inverse">
                     <!-- timeline time label -->
                     <div class="time-label">
                         <span class="bg-warning">
                             {{ $k->tgl_masuk }} {{ $k->nama_unit }}
                         </span>
                     </div>
                     <!-- /.timeline-label -->
                     <!-- timeline item -->
                     <div>
                         <i class="fas fa-envelope bg-primary"></i>

                         <div class="timeline-item">
                             <span class="time text-dark text-lg">{{ $a->namapemeriksa }} /  {{ $k->tgl_masuk }} {{ $k->nama_unit }}</span>

                             <h3 class="timeline-header"><a href="#" class="text-dark">Assesment keperawatan /
                                     kebidanan </h3>
                             <div class="timeline-body">
                                 <table class="table table-sm">
                                    <tr>
                                        <td width="15%" class="text-bold">Tekanan Darah</td>
                                        <td  width="15%" class="font-italic">: {{ $a->tekanan_darah}} mmHg</td>
                                        <td width="15%" class="text-bold">Frekuensi Nadi</td>
                                        <td class="font-italic">: {{ $a->frekuensi_nadi}}  x/menit </td>
                                        <td width="15%" class="text-bold">Frekuensi Nafas</td>
                                        <td class="font-italic">: {{ $a->frekuensi_nafas}}  x/menit </td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-bold">Suhu</td>
                                        <td class="font-italic">: {{ $a->suhu_tubuh}}  °C </td>
                                        <td width="15%" class="text-bold">BB/TB/IMT</td>
                                        <td class="font-italic">: {{ $a->beratbadan }}</td>
                                        <td width="15%" class="text-bold">Usia</td>
                                        <td class="font-italic">: {{ $a->umur}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Diagnosa Keperawatan</td>
                                        <td  class="font-italic" colspan="5">: {{ $a->diagnosakeperawatan }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Rencana Keperawatan</td>
                                        <td  class="font-italic" colspan="5">: {{ $a->rencanakeperawatan }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Tindakan Keperawatan</td>
                                        <td  class="font-italic" colspan="5">: {{ $a->tindakankeperawatan }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Evaluasi Keperawatan</td>
                                        <td  class="font-italic" colspan="5">: {{ $a->evaluasikeperawatan }}</td>
                                    </tr>
                                 </table>
                             </div>
                             <div class="timeline-footer">
                                 <a href="#" class="btn btn-primary btn-sm"><i
                                         class="bi bi-ticket-detailed mr-1"></i> Detail</a>
                             </div>
                         </div>
                     </div>
                     <!-- END timeline item -->
                     <!-- timeline item -->
                     <div>
                         <i class="fas fa-comments bg-warning"></i>

                         <div class="timeline-item">
                             <span class="time text-dark text-lg text-bold">{{ $a->nama_dokter }} /  {{ $k->tgl_masuk }} {{ $k->nama_unit }}</span>

                             <h3 class="timeline-header "><a href="#" class="text-dark">Assesment Medis</h3>
                             <div class="timeline-body">
                                <table class="table">
                                    <tr>
                                        <td width="15%" class="text-bold">Diagnosa Kerja</td>
                                        <td class="font-italic">: {{ $a->diagnosakerja}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Diagnosa Banding</td>
                                        <td class="font-italic">: {{ $a->diagnosabanding}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Pemeriksaan Fisik</td>
                                        <td class="font-italic">: @if ($a->versi == 1){{ $a->keadaanumum }}, {{ $a->kesadaran }}, {{ $a->pemeriksaan_fisik }}
                                            @else
                                            {{ $a->pemeriksaan_fisik }} @endif</td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Rencana Terapi</td>
                                        <td class="font-italic">: {{ $a->rencanakerja}}</td>
                                    </tr>
                                </table>
                             </div>
                             <div class="timeline-footer">
                                 <a href="#" class="btn btn-primary btn-flat btn-sm"><i
                                         class="bi bi-ticket-detailed mr-1"></i> Detail</a>
                             </div>
                         </div>
                     </div>
                 </div>
             @endif
         @endforeach
     @endforeach
 </div>
