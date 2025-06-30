<div class="card">
    <div class="card-body">
        <table id="tabeljasa" class="table table-sm table-bordered">
            <thead>
                <th>Bulan</th>
                <th>No Sep</th>
                <th>No RM</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Total klaim</th>
                <th>Status Klaim</th>
                <th>
                    detail
                </th>
            </thead>
            <tbody>
                @foreach ($header as $h)
                    <tr>
                        <td>{{ $h->bulan_tahun }}</td>
                        <td>{{ $h->no_sep }}</td>
                        <td>{{ $h->rm }}</td>
                        <td>{{ $h->nama_px }}</td>
                        <td>{{ $h->jenis }}</td>
                        <td>RP. {{ number_format($h->Total_klaim, 2) }}</td>
                        <td>{{ $h->status_klaim }}</td>
                        <td>
                            <button class="btn btn-info detail" nosep="{{ $h->no_sep }}"><i
                                    class="bi bi-search"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $(function() {
        $("#tabeljasa").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "pageLength": 12,
            "searching": true,
            "ordering": false,
        })
    });
    $(".detail").on('click', function(event) {
        sep = $(this).attr('nosep')
        $('.v_utama').attr('hidden', true)
        $('.v_kedua').removeAttr('hidden', true)
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                sep
            },
            url: '<?= route('ambildetailsep') ?>',
            success: function(response) {
                spinner.hide();
                $('.v_kedua').html(response);
            }
        });
    });
