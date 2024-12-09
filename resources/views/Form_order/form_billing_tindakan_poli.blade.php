<style>
    .ui-autocomplete {
        border: none;
        font-size: 14px;
        width: 300px;
        height: 50px;
        margin-bottom: 5px;
        padding-top: 2px;
        border: 1px solid #DDD !important;
        background: white;
        padding-top: 0px !important;
        z-index: 1511;
        position: relative;
    }
</style>
<div class="form-group">
    <label for="exampleFormControlInput1">Tanggal Periksa</label>
    <input type="date" class="form-control" id="tanggalperiksa" placeholder="name@example.com"
        value="{{ $datakunjungan[0]->tgl_masuk_d }}">
</div>
<div class="form-group">
    <label for="exampleFormControlInput1">Dokter Pemeriksa</label>
    <input type="text" class="form-control" id="dokterpemeriksa" placeholder="name@example.com"
        value="{{ $datakunjungan[0]->nama_dokter }}">
    <input readonly type="text" class="form-control" id="kodedokterpemeriksa" placeholder="name@example.com"
        value="{{ $datakunjungan[0]->kode_paramedis }}">
</div>
<div class="form-group">
    <label for="exampleFormControlInput1">Unit</label>
    <input @if(auth()->user()->unit != '1028') disabled @endif type="text" class="form-control" id="unitipnut" placeholder="name@example.com"
        value="{{ $datakunjungan[0]->nama_unit }}">
    <input readonly type="text" class="form-control" id="kodeunitipnut" placeholder="name@example.com"
        value="{{ $datakunjungan[0]->kode_unit }}">
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Silahkan pilih tindakan</div>
            <div class="card-body">
                <table id="tabeltindakanpoliklinik" class="table table-sm table-bordered table-hover text-xs">
                    <thead>
                        <th>Nama Tarif / Tindakan</th>
                        <th>Tarif</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($layanan as $l)
                            <tr>
                                <td>{{ $l->Tindakan }}</td>
                                <td>Rp. {{ number_format($l->tarif, 2) }}</td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm text-xs pilihtindakan"
                                        nama="{{ $l->Tindakan }}" idtarif={{ $l->kode }} tarif={{ $l->tarif }}
                                        dtarif = "Rp. {{ number_format($l->tarif, 2) }}"><i
                                            class="bi bi-plus"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">List tindakan yang dipilih</div>
            <div class="card-body">
                <form action="" method="post" class="form_draft_billing_tindakan">
                    <div class="draft_tindakan">
                        <div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer"><button class="btn btn-success btn-sm float-right" onclick="simpanbilling()">Simpan</button></div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#dokterpemeriksa').autocomplete({
            source: "<?= route('caridokter') ?>",
            select: function(event, ui) {
                $('[id="dokterpemeriksa"]').val(ui.item.label);
                $('[id="kodedokterpemeriksa"]').val(ui.item.kode);
            }
        });
        $('#unitipnut').autocomplete({
            source: "<?= route('cariunit') ?>",
            select: function(event, ui) {
                $('[id="unitipnut"]').val(ui.item.label);
                $('[id="kodeunitipnut"]').val(ui.item.kode);
            }
        });
    })
    $(function() {
        $("#tabeltindakanpoliklinik").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 5,
            "searching": true,
            "ordering": false,
        })
    });
    $(".pilihtindakan").on('click', function(event) {
        nama = $(this).attr('nama')
        kodetarif = $(this).attr('idtarif')
        tarif = $(this).attr('tarif')
        dtarif = $(this).attr('dtarif')
        var wrapper = $(".draft_tindakan");
        $(wrapper).append(
            '<div class="form-row text-xs"><div class="form-group col-md-4"><label for="">Nama Tindakan/Tarif</label><input readonly type="" class="form-control form-control-sm text-xs edit_field" id="" name="namatarif" value="' +
            nama +
            '"><input  hidden readonly type="" class="form-control form-control-sm" id="" name="kodetarif" value="' +
            kodetarif +
            '"><input  hidden readonly type="" class="form-control form-control-sm" id="" name="tarif" value="' +
            tarif +
            '"></div><div class="form-group col-md-3"><label for="inputPassword4">Tarif</label><input readonly type="" class="form-control form-control-sm" id="" name="displaytarif" value="' +
            dtarif +
            '"></div><div class="form-group col-md-2"><label for="inputPassword4">Qty</label><input type="" class="form-control form-control-sm" id="" name="qty" value="1"></div><i class="bi bi-x-square remove_field form-group col-md-1 text-danger" kode2=""></i></div>'
        );
        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
    function simpanbilling()
    {
        tgl = $('#tanggalperiksa').val()
        namadokter = $('#dokterpemeriksa').val()
        kodedokter = $('#kodedokterpemeriksa').val()
        kodekunjungan = $('#kodekunjungan').val()
        namaunit = $('#unitipnut').val()
        kodeunitkirim = $('#kodeunitipnut').val()
        var data_billing_tindakan = $('.form_draft_billing_tindakan').serializeArray();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data_billing_tindakan: JSON.stringify(data_billing_tindakan),
                tgl,namadokter,kodedokter,kodekunjungan,namaunit,
                kodeunitkirim
            },
            url: '<?= route('simpanbillingpoliklinik_byperawat') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(data) {
                spinner.hide()
                if (data.kode == 500) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: data.message,
                        footer: ''
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'OK',
                        text: data.message,
                        footer: ''
                    })
                    ambilriwayattindakan()
                    $('#modalinputantindakan').modal('toggle');
                }
            }
        });
    }
</script>
