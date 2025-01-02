<table id="tabelunitkonsul" class="table table-sm table-bordered table-hover text-xs">
    <thead>
        <th>Nama Unit</th>
        <th>Action</th>
    </thead>
    <tbody>
        @foreach ($unit as $u)
            <tr>
                <td>{{ $u->nama_unit }}</td>
                <td>
                    <button class="btn btn-success btn-sm pilihunit" namaunit="{{ $u->nama_unit }}"
                        kodeunit="{{ $u->kode_unit }}"><i class="bi bi-plus-lg"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<input hidden type="text" value="{{ $kodekunjungan }}" id="refkunjungan">
<div class="card">
    <div class="card-header">List Poli yang dipilih ...</div>
    <div class="card-body">
        <form action="" method="post" class="formkonsulan">
            <div class="draft_poli_konsul">
                <div>
                </div>
            </div>
        </form>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Diagnosa Kerja</label>
            <textarea class="form-control" id="diagnosakerja" rows="3">@foreach ($assdok as $as ){{ $as->diagnosakerja }}
            @endforeach</textarea>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Keterangan Tindak Lanjut</label>
            <textarea class="form-control" id="keterangantindaklanjut" rows="3">@foreach ($assdok as $as ){{ $as->keterangan_tindak_lanjut }}
                @endforeach</textarea>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("#tabelunitkonsul").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 5,
            "searching": true,
            "ordering": false,
        })
    });
    $(".pilihunit").on('click', function(event) {
        namaunit = $(this).attr('namaunit')
        kodeunit = $(this).attr('kodeunit')
        var wrapper = $(".draft_poli_konsul");
        $(wrapper).append(
            '<div class="form-row text-xs"><div class="form-group col-md-3"><label for="">Nama Unit</label><input readonly type="" class="form-control form-control-sm text-xs edit_field" id="" name="namaunit" value="' +
            namaunit +
            '"><input  hidden readonly type="" class="form-control form-control-sm" id="" name="kodeunit" value="' +
            kodeunit +
            '"></div><i class="bi bi-x-square remove_field form-group col-md-1 text-danger" kode2=""></i></div>'
        );
        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
