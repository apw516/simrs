<table id="tabel_riwayat_obat" class="table table-sm table-bordered table-hover text-xs">
    <thead>
        <th>Tanggal Entry</th>
        <th>NO RM</th>
        <th>Nama Pasien</th>
        <th>Alamat</th>
        <th>Unit Pengirim</th>
        <th>Dokter Pengirim</th>
        <th>Status</th>
        <th>--</th>
    </thead>
    <tbody>
        @foreach ($cari_order as $o )
            <tr class="@if($o->status_order == 1) bg-warning @endif">
                <td>{{ $o->tgl_entry }}</td>
                <td>{{ $o->no_rm }}</td>
                <td>{{ $o->nama_pasien }}</td>
                <td>{{ $o->alamat }}</td>
                <td>{{ $o->nama_unit_pengirim }}</td>
                <td>{{ $o->nama_dokter }}</td>
                <td>
                    @if($o->status_order == 2) Sudah Tracer
                    @elseif($o->status_order == 1) Belum Tracer
                    @elseif($o->status_order == 0) Belum Validasi
                    @endif</td>
                <td>
                    {{-- <a href="#timeline" data-toggle="tab" rm="{{ $o->no_rm }}" nama="{{ $o->nama_pasien }}" alamat="{{ $o->alamat }}" idheader="{{ $o->id }}" kodekunjungan="{{ $o->kode_kunjungan}}" class="btn btn-info btn-sm" data-placement="top" title="Lihat Detail"><i class="bi bi-eye-fill"></i></a> --}}
                    <button class="btn btn-success btn-sm pilihpasien_order" unit="{{ $o->kode_unit_pengirim }}"
                        rm="{{ $o->no_rm }}" kodekunjungan="{{ $o->kode_kunjungan }}"><i class="bi bi-box-arrow-down"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabel_riwayat_obat").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 6,
            "searching": true,
            "ordering": false,
        })
    });
    $(".pilihpasien_order").on('click', function(event) {
        $('.v_awal').attr('hidden',true)
        $('.v_kedua').removeAttr('hidden',true)
         rm = $(this).attr('rm')
         kodeunit = $(this).attr('unit')
         kodekunjungan = $(this).attr('kodekunjungan')
         spinner = $('#loader')
         spinner.show();
         $.ajax({
             type: 'post',
             data: {
                 _token: "{{ csrf_token() }}",
                 rm,
                 kodeunit,
                 kodekunjungan
             },
             url: '<?= route('ambil_detail_pasien') ?>',
             success: function(response) {
                 $('.v_select').html(response);
                 spinner.hide()
             }
         });
     });
    // $('#tabel_riwayat_obat').on('click', '.cetaketiket', function() {
    //     rm = $(this).attr('rm')
    //     nama = $(this).attr('nama')
    //     alamat = $(this).attr('alamat')
    //     idheader = $(this).attr('idheader')
    //     kodekunjungan = $(this).attr('kodekunjungan')
    //     window.open('cetaketiket/' + idheader);
    //  });
</script>
