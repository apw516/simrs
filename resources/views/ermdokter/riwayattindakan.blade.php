<table class="table table-sm table-bordered">
    <thead>
        <th>Kode Header</th>
        <th>Kode Detail</th>
        <th>Nama Layanan</th>
        <th>Jumlah</th>
    </thead>
    <tbody>
        @foreach ($riwayat_tindakan as $r )
        <tr>
            <td>{{ $r->kode_layanan_header }}</td>
            <td>{{ $r->id_detail }}</td>
            <td>{{ $r->NAMA_TARIF }}</td>
            <td>{{ $r->jumlah_layanan  }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
