<table id="tabel_riwayat_obat" class="table table-sm table-bordered table-hover text-sm">
    <thead>
        <th>Tanggal Entry</th>
        {{-- <th>Kode Layanan Header</th> --}}
        <th>NO RM</th>
        <th>Nama Pasien</th>
        <th>Alamat</th>
        <th>Unit</th>
        <th>Unit Pengirim</th>
        <th>Dokter Pengirim</th>
        <th>--</th>
    </thead>
    <tbody>
        @foreach ($cari_order as $o )
            <tr>
                <td>{{ $o->tgl_entry }}</td>
                {{-- <td>{{ $o->kode_layanan_header }}</td> --}}
                <td>{{ $o->no_rm }}</td>
                <td>{{ $o->nama_pasien }}</td>
                <td>{{ $o->alamat }}</td>
                <td>{{ $o->nama_unit }}</td>
                <td>{{ $o->unit_pengirim }}</td>
                <td>{{ $o->nama_dokter }}</td>
                <td width="10%">
                    <button rm="{{ $o->no_rm }}" nama="{{ $o->nama_pasien }}" alamat="{{ $o->alamat }}" idheader="{{ $o->id }}" kodekunjungan="{{ $o->kode_kunjungan}}" class="btn btn-success btn-sm cetaketiket" data-placement="top" title="Cetak etiket"><i class="bi bi-printer-fill"></i></button>
                    <button class="btn btn-primary btn-sm" data-placement="top" title="Cetak Nota"><i class="bi bi-printer-fill"></i></button>
                    <button class="btn btn-info btn-sm" data-placement="top" title="Lihat Rincian Resep"><i class="bi bi-ticket-detailed-fill"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabel_riwayat_obat").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 6,
            "searching": true,
            "ordering": false,
        })
    });
    $('#tabel_riwayat_obat').on('click', '.cetaketiket', function() {
        rm = $(this).attr('rm')
        nama = $(this).attr('nama')
        alamat = $(this).attr('alamat')
        idheader = $(this).attr('idheader')
        kodekunjungan = $(this).attr('kodekunjungan')
        window.open('cetaketiket/' + idheader);
     });
</script>
