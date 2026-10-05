<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table id="tbr" class="table table-hover table-striped align-middle mb-0">
                <thead class="table-dark text-nowrap">
                    <tr>
                        <th class="text-center" scope="col">NO</th>
                        <th scope="col">NO RESEP</th>
                        <th scope="col">NO APOTIK</th>
                        <th scope="col">NO SEP KUNJUNGAN</th>
                        <th scope="col">NO KARTU</th>
                        <th scope="col">NAMA PASIEN</th>
                        <th scope="col">TGL ENTRY</th>
                        <th scope="col">TGL RESEP</th>
                        <th scope="col">TGL PELAYANAN RESEP</th>
                        {{-- <th class="text-end" scope="col">BYTAGRSP</th>
                        <th class="text-end" scope="col">BYVERRSP</th> --}}
                        <th class="text-center" scope="col">KDJNSOBAT</th>
                        <th scope="col" hidden>FASKESASAL</th>
                        <th class="text-center" scope="col">FLAGITER</th>
                        <th>detail</th>
                    </tr>
                </thead>
                <tbody class="text-nowrap">
                    @forelse($detail->response as $d)
                        <tr>
                            <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                            <td><span class="badge bg-light text-dark border">{{ $d->NORESEP }}</span></td>
                            <td>{{ $d->NOAPOTIK }}</td>
                            <td>{{ $d->NOSEP_KUNJUNGAN }}</td>
                            <td>{{ $d->NOKARTU }}</td>
                            <td class="fw-semibold">{{ $d->NAMA }}</td>
                            <td>{{ $d->TGLENTRY }}</td>
                            <td>{{ $d->TGLRESEP }}</td>
                            <td>{{ $d->TGLPELRSP }}</td>
                            {{-- <td class="text-end font-monospace">{{ number_format($d->BYTAGRSP ?? 0, 0, ',', '.') }}</td>
                            <td class="text-end font-monospace">{{ number_format($d->BYVERRSP ?? 0, 0, ',', '.') }}</td> --}}
                            <td class="text-center"><span class="badge bg-info text-dark">{{ $d->KDJNSOBAT }}</span>
                            </td>
                            <td hidden>{{ $d->FASKESASAL }}</td>
                            <td class="text-center">
                                <span class="badge {{ $d->FLAGITER ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $d->FLAGITER }}
                                </span>
                            </td>
                            <td>
                                <button nosep="{{ $d->NOAPOTIK }}" nosjp="{{ $d->NOSEP_KUNJUNGAN }}" noresep="{{ $d->NORESEP }}"  class="btn btn-danger hapussep">hapus</button>
                                <button nosep="{{ $d->NOAPOTIK }}" class="btn btn-info detailsep" data-toggle="modal"
                                    data-target="#modaldetail">detail</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="13" class="text-center py-4 text-muted">
                                <em>Data resep tidak ditemukan.</em>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modaldetail" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Detail Layanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_detail_layanan">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("#tbr").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "pageLength": 12,
            "searching": true,
            "ordering": false,
        })
    });
    $('.detailsep').on('click', function() {
        nosep = $(this).attr('nosep')
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nosep
            },
            url: '<?= route('ambildetailsep_apotik') ?>',
            error: function(response) {
                alert('error!')
                spinner.hide()
            },
            success: function(response) {
                $('.v_detail_layanan').html(response);
                spinner.hide()
            }
        });
    });
    $(".hapussep").on('click', function(event) {
        nosep = $(this).attr('nosep')
        nosjp = $(this).attr('nosjp')
        noresep = $(this).attr('noresep')
        Swal.fire({
            title: "Anda yakin ?",
            text: "Data Resep" + nosep + "akan dibatalkan ...",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, batalkan"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Pastikan data resep yang dibatalkan sudah dipilih dengan benar",
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: "Ya, hapus data sep ...",
                    denyButtonText: `Batal`
                }).then((result) => {
                    if (result.isConfirmed) {
                        hapussepbpjs(nosep,nosjp,noresep)
                    }
                });
            }
        });
    });

    function hapussepbpjs(nosep,nosjp,noresep) {
        spinner_on()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nosep,nosjp,noresep
            },
            url: '<?= route('batalsepbpjs') ?>',
            error: function(response) {
                spinner_off()
                Swal.fire({
                    icon: 'error',
                    title: 'Ups!',
                    text: response.message,
                });
            },
            success: function(response) {
                spinner_off()
                if (response.kode == '500') {
                    // Kondisi jika validasi gagal atau ada error sistem
                    Swal.fire({
                        icon: 'error',
                        title: 'Ups!',
                        text: response.message,
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'OK!',
                        text: response.message,
                    });
                    location.reload()
                }
            }
        });
    }
</script>
