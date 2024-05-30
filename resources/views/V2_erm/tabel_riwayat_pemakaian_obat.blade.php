@foreach ($ts_kunjungan_list as $kl)
    <div class="card">
        <div class="card-header bg-info">{{ $kl->unit }} | {{ $kl->tgl_masuk }} | {{ $kl->nama_dokter }} <button class="btn btn-warning float-right text-bold"><i class="bi bi-plus mr-2"></i> Pilih</button></div>
        <div class="card-body">
            <table id="tb_r_pemakaian_obat" class="table table-sm table-bordered table-hover table-stripped">
                <thead class="bg-light">
                    <th>Tgl entry</th>
                    <th>Dokter Pengirim</th>
                    <th>Unit Pengirim</th>
                    <th>Nama Obat</th>
                    <th>Jumlah</th>
                    <th>Aturan Pakai</th>
                </thead>
                <tbody>
                        @foreach ($riwayat_pemakaian as $k)
                            @if ($kl->kode_kunjungan == $k->kode_kunjungan)
                                <tr>
                                    <td>{{ $k->tgl_masuk }}</td>
                                    <td>{{ $k->nama_dokter }}</td>
                                    <td>{{ $k->unit_asal }}</td>
                                    <td>{{ $k->nama_barang }}</td>
                                    <td class="text-center">{{ $k->jumlah_layanan }}</td>
                                    <td>{{ $k->aturan_pakai }}</td>
                                </tr>
                            @endif
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endforeach
