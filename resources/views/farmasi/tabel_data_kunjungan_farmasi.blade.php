<table id="tabelkunjungan" class="table table-sm table-bordered table-striped table-hover">
    <thead class="bg-info">
        <th>Tanggal Kunjungan</th>
        <th>No SEP</th>
        <th>No RM</th>
        <th>Nama</th>
        <th>Nama Unit</th>
        <th>Penjamin</th>
        <th>Catatan</th>
        <th></th>
    </thead>
    <tbody>
        @foreach ($data as $d)
            <tr>
                <td>{{ $d->tgl_masuk }}</td>
                <td>{{ $d->no_sep }}</td>
                <td>{{ $d->no_rm }}</td>
                <td>{{ $d->nama_pasien }}</td>
                <td>{{ $d->nama_unit }}</td>
                <td>{{ $d->nama_penjamin }}</td>
                <td>{{ $d->catatan }}</td>
                <td>
                    <button class="btn btn-success lihatberkas" kodekunjungan="{{ $d->kode_kunjungan }}"><i
                            class="bi bi-box-arrow-down"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabelkunjungan").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 15,
            "searching": true,
            "ordering": false,
        })
    });
    $(".lihatberkas").on('click', function(event) {
        kodekunjungan = $(this).attr('kodekunjungan')
        window.open('cetakresumerajalbykunjungan2/' + kodekunjungan);

    });
