<div class="accordion" id="accordionExampleSatu">
    <div class="card">
        <div class="card-header" style="background-color: rgb(254, 199, 193)" id="headingSatu">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left text-dark" type="button" data-toggle="collapse"
                    data-target="#collapseOneSatu" aria-expanded="true" aria-controls="collapseOneSatu">
                    Layanan Order Farmasi
                </button>
            </h2>
        </div>
        <div id="collapseOneSatu" class="collapse" aria-labelledby="headingSatu" data-parent="#accordionExampleSatu">
            <div class="card-body">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-secondary riwayatreseppasien" norm="{{ $no_rm }}"
                        data-toggle="modal" data-target="#modalriwayatreseppasien"><i class="bi bi-plus"></i> Riwayat
                        Resep
                        Pasien</button>
                    <button type="button" class="btn btn-secondary riwayatresepdokter" data-toggle="modal"
                        data-target="#modalriwayatresepdokter"><i class="bi bi-plus"></i>Riwayat Resep Dokter</button>
                    <button type="button" class="btn btn-info riwayatorderhariini" data-toggle="modal"
                        data-target="#modalriwayatorderhariini"><i class="bi bi-plus"></i>Riwayat Order Resep hari
                        ini</button>
                    <button type="button" class="btn btn-secondary float-right templateresepdokter" data-toggle="modal"
                        data-target="#modaltemplateresepdokter"><i class="bi bi-plus"></i>Template Resep
                        Dokter</button>
                    <button type="button" class="btn btn-secondary float-right templateracikandokter" data-toggle="modal"
                        data-target="#modaltemplateracikandokter"><i class="bi bi-plus"></i>Template Racikan
                        Dokter</button>
                </div><br><br>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalpencarianobat"><i
                        class="bi bi-search mr-1 ml-1"></i> Pencarian Obat</button>
                <button type="button" class="btn btn-warning" data-toggle="modal"
                    data-target="#modalbuatobatracikan"><i class="bi bi-file-earmark-plus mr-1 ml-1"></i>Buat Obat
                    Racikan </button>
                <div class="card mt-3">
                    <div class="card-header bg-light">List Obat yang dipilih ....</div>
                    <div class="card-body">
                        <form action="" method="post" class="draft_obat_yang_diorder">
                            <div class="draft_obat">
                                <div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="simpantemplate" name="simpantemplate"
                                value="1">
                            <label class="form-check-label" for="exampleCheck1">Ceklis, untuk simpan resep sebagai
                                template</label>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nama Template</label>
                            <input type="text" class="form-control" name="namatemplate" id="namatemplate">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" style="background-color: rgb(123, 207, 237)" id="headingDua">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed text-dark" type="button"
                    data-toggle="collapse" data-target="#collapseTwoDua" aria-expanded="false"
                    aria-controls="collapseTwoDua">
                    Layanan Order Laboratorium
                </button>
            </h2>
        </div>
        <div id="collapseTwoDua" class="collapse" aria-labelledby="headingDua" data-parent="#accordionExampleSatu">
            <div class="card-body">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-secondary riwayathasillabpasien" norm="{{ $no_rm }}"
                        data-toggle="modal" data-target="#modalhasillab"><i class="bi bi-plus"></i> Riwayat
                        Hasil Laboratorium</button>
                    <button type="button" class="btn btn-info riwayatorderlabhariini" data-toggle="modal"
                        data-target="#modalriwayatorderpenunjanghariini"><i class="bi bi-plus"></i>Riwayat Order
                        Layanan
                        Laboratorium hari
                        ini</button>
                </div><br><br>
                <button type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#modalpencarianlayananlab"><i class="bi bi-search"></i> Pencarian Layanan</button>
                <div class="card mt-3">
                    <div class="form-group mb-3 mt-3 container-fluid">
                        <label for="exampleInputEmail1">Tanggal pemeriksaan Laboratorium</label>
                        <input type="date" class="form-control" id="tanggalpemeriksaanlab"
                            name="tanggalpemeriksaanlab" value="{{ $datenow }}" aria-describedby="emailHelp">
                    </div>
                    <div class="card-header bg-light">List Layanan yang dipilih ....
                    </div>
                    <div class="card-body">
                        <form action="" method="post" class="draft_layanan_lab_yang_diorder">
                            <div class="draft_layanan_lab">
                                <div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        *Pastikan layanan yang dipilih sudah sesuai ...
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" style="background-color: rgb(226, 171, 95)" id="headingTiga">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed text-dark" type="button"
                    data-toggle="collapse" data-target="#collapseTwoTiga" aria-expanded="false"
                    aria-controls="collapseTwoTiga">
                    Layanan Order Radiologi
                </button>
            </h2>
        </div>
        <div id="collapseTwoTiga" class="collapse" aria-labelledby="headingTiga"
            data-parent="#accordionExampleSatu">
            <div class="card-body">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-secondary riwayathasilradpasien" norm="{{ $no_rm }}"
                        data-toggle="modal" data-target="#modalhasilrad"><i class="bi bi-plus"></i> Riwayat
                        Hasil Radiologi</button>
                    <button type="button" class="btn btn-info riwayatorderradhariini" data-toggle="modal"
                        data-target="#modalriwayatorderpenunjanghariini"><i class="bi bi-plus"></i>Riwayat Order
                        Layanan
                        Radiologi hari
                        ini</button>
                </div><br><br>
                <button type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#modalpencarianlayananrad"><i class="bi bi-search"></i> Pencarian Layanan</button>
                <div class="card mt-3">
                    <div class="form-group mb-3 mt-3 container-fluid">
                        <label for="exampleInputEmail1">Tanggal pemeriksaan Radiologi</label>
                        <input type="date" class="form-control" id="tanggalpemeriksaanrad"
                            name="tanggalpemeriksaanrad" value="{{ $datenow }}" aria-describedby="emailHelp">
                    </div>
                    <div class="card-header bg-light">List Layanan yang dipilih ....</div>
                    <div class="card-body">
                        <form action="" method="post" class="draft_layanan_rad_yang_diorder">
                            <div class="draft_layanan_rad">
                                <div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        *Pastikan layanan yang dipilih sudah sesuai ...
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" style="background-color: rgb(247, 172, 219)" id="headingEmpat">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed text-dark" type="button"
                    data-toggle="collapse" data-target="#collapseTwoEmpat" aria-expanded="false"
                    aria-controls="collapseTwoEmpat">
                    Layanan Order Laboratorium Patologi Anatomi
                </button>
            </h2>
        </div>
        <div id="collapseTwoEmpat" class="collapse" aria-labelledby="headingEmpat"
            data-parent="#accordionExampleSatu">
            <div class="card-body">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-secondary riwayathasillabpapasien"
                        norm="{{ $no_rm }}" data-toggle="modal" data-target="#modalhasilrad"><i
                            class="bi bi-plus"></i> Riwayat
                        Hasil Radiologi</button>
                    <button type="button" class="btn btn-info riwayatorderpahariini" data-toggle="modal"
                        data-target="#modalriwayatorderpenunjanghariini"><i class="bi bi-plus"></i>Riwayat Order
                        Layanan
                        Radiologi hari
                        ini</button>
                </div><br><br>
                <button type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#modalpencarianlayananlabpa"><i class="bi bi-search"></i> Pencarian Layanan</button>
                <div class="card mt-3">
                    <div class="form-group mb-3 mt-3 container-fluid">
                        <label for="exampleInputEmail1">Tanggal pemeriksaan Laboratorium Patologi Anatomi</label>
                        <input type="date" class="form-control" id="tanggalpemeriksaanlabpa"
                            name="tanggalpemeriksaanlabpa" value="{{ $datenow }}" aria-describedby="emailHelp">
                    </div>
                    <div class="card-header bg-light">List Layanan yang dipilih ....</div>
                    <div class="card-body">
                        <form action="" method="post" class="draft_layanan_lab_pa_yang_diorder">
                            <div class="draft_layanan_lab_pa">
                                <div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        *Pastikan layanan yang dipilih sudah sesuai ...
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .modal-xxl {
        max-width: 90% !important;
    }
</style>
<!-- Modal -->
<div class="modal fade" id="modalhasillab" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Riwayat Hasil Pemeriksaan Laboratorium</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_riwayat_hasil_lab">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalhasilrad" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Riwayat Hasil Pemeriksaan Radiologi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_riwayat_hasil_rad">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalriwayatreseppasien" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Riwayat Resep Pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_riwayat_resep">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalriwayatresepdokter" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Riwayat Resep Pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_riwayat_resep_dokter">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modaltemplateresepdokter" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Template Resep Dokter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_riwayat_template_resep_dokter">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modaltemplateracikandokter" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Template Racikan Obat Dokter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_riwayat_racikan_obat_dokter">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalriwayatorderhariini" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Riwayat Order Hari ini ...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_r_order_tdy">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalriwayatorderpenunjanghariini" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Riwayat Order Hari ini ...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_r_order_penunjang_tdy">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalriwayatorderradhariini" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Riwayat Order Hari ini ...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_r_order_rad_tdy">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalpencarianobat" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pencarian Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Cari Nama Obat</label>
                            <input type="text" class="form-control" aria-describedby="emailHelp"
                                placeholder="Masukan nama obat ...." name="namaobatcari" id="namaobatcari">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-success" style="margin-top:32px"
                            onclick="cariobat()"><i class="bi bi-search"></i> Cari obat</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="v_tabel_obat_pencarian">

                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalpencarianlayananlab" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pencarian Layanan Laboratorium</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="tabellayananorderlab" class="table table-sm table-bordered table-hover">
                    <thead>
                        <th>Action</th>
                        <th>Nama Layanan</th>
                        <th>Tarif Layanan</th>
                    </thead>
                    <tbody>
                        @foreach ($layanan_lab as $lg)
                            <tr>
                                <td width="5%">
                                    <button type="button" class="btn btn-sm btn-success text-center pilihlayananlab"
                                        kodetarif="{{ $lg->kode }}" namatarif="{{ $lg->Tindakan }}"
                                        tarif="{{ $lg->tarif }}"
                                        displaytarif="Rp. {{ number_format($lg->tarif, 2) }}"><i
                                            class="bi bi-hand-index-thumb"></i></button>
                                </td>
                                <td>{{ $lg->kode }} | {{ $lg->Tindakan }}</td>
                                <td>Rp. {{ number_format($lg->tarif, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalpencarianlayananrad" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pencarian Layanan Radiologi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="tabellayananorderrad" class="table table-sm table-bordered table-hover">
                    <thead>
                        <th>Action</th>
                        <th>Nama Layanan</th>
                        <th>Tarif Layanan</th>
                    </thead>
                    <tbody>
                        @foreach ($layanan_rad as $lr)
                            <tr>
                                <td width="5%">
                                    <button type="button" class="btn btn-sm btn-success text-center pilihlayananrad"
                                        kodetarif="{{ $lr->kode }}" namatarif="{{ $lr->Tindakan }}"
                                        tarif="{{ $lr->tarif }}"
                                        displaytarif="Rp. {{ number_format($lr->tarif, 2) }}"><i
                                            class="bi bi-hand-index-thumb"></i></button>
                                </td>
                                <td>{{ $lr->kode }} | {{ $lr->Tindakan }}</td>
                                <td>Rp. {{ number_format($lr->tarif, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalpencarianlayananlabpa" detabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pencarian Layanan Laboratorium Patologi Anatomi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="tabellayananorderlabpa" class="table table-sm table-bordered table-hover">
                    <thead>
                        <th>Action</th>
                        <th>Nama Layanan</th>
                        <th>Tarif Layanan</th>
                    </thead>
                    <tbody>
                        @foreach ($layanan_pa as $la)
                            <tr>
                                <td width="5%">
                                    <button type="button" class="btn btn-sm btn-success text-center pilihlayananpa"
                                        kodetarif="{{ $la->kode }}" namatarif="{{ $la->Tindakan }}"
                                        tarif="{{ $la->tarif }}"
                                        displaytarif="Rp. {{ number_format($la->tarif, 2) }}"><i
                                            class="bi bi-hand-index-thumb"></i></button>
                                </td>
                                <td>{{ $la->kode }} | {{ $la->Tindakan }}</td>
                                <td>Rp. {{ number_format($la->tarif, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalbuatobatracikan" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form Obat Racik</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-heaader">Header Racikan</div>
                    <div class="card-body">
                        <form class="headerracikan">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Racikan</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                    name="namaracikan" aria-describedby="emailHelp">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Tipe Racikan</label>
                                        <select class="form-control" id="exampleFormControlSelect1"
                                            name="tiperacikan">
                                            <option value="0">Silahkan Pilih</option>
                                            <option value="1">Powder</option>
                                            <option value="2">Non - Powder</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Kemasan</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="kemasan">
                                            <option value="0">Silahkan Pilih</option>
                                            <option value="1">Kapsul</option>
                                            <option value="2">Kertas Perkamen</option>
                                            <option value="3">Pot Salep</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Jumlah Racikan</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1"
                                            name="jumlahracikan" value="0">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Aturan Pakai</label>
                                        <textarea type="password" class="form-control" id="exampleInputPassword1" name="aturanpakairacik"></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Cari Komponen Racikan</div>
                    <div class="card-body">
                        <form class="form-inline">
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="inputPassword2" class="sr-only">Password</label>
                                <input type="text" class="form-control" id="namaobatcari2"
                                    placeholder="Masukan nama obat ...">
                            </div>
                            <button type="button" class="btn btn-primary mb-2" onclick="cariobat2()"><i
                                    class="bi bi-search mr-1 ml-1"></i>Cari Obat</button>
                        </form>
                        <div class="v_tabel_obat_komponen">

                        </div>
                        <div class="card">
                            <div class="card-header">List obat yang akan diracik</div>
                            <div class="card-body">
                                <form action="" method="post" class="draft_obat_yang_diracik">
                                    <div class="draft_obat_racik">
                                        <div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="simpansebagaitemplateracik">
                                    <label class="form-check-label" for="exampleCheck1">Ceklis untuk Simpan sebagai
                                        template racikan...</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="alertracikan()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $("#tabellayananorderlabpa").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 5,
            "searching": true,
            "ordering": false,
        })
    });
    $(function() {
        $("#tabellayananorderlab").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 5,
            "searching": true,
            "ordering": false,
        })
    });
    $(function() {
        $("#tabellayananorderrad").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 5,
            "searching": true,
            "ordering": false,
        })
    });

    function cariobat() {
        nama = $('#namaobatcari').val()
        kode_kunjungan = $('#kode_kunjungan').val()
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nama,kode_kunjungan
            },
            url: '<?= route('caristokobat') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_tabel_obat_pencarian').html(response);
            }
        });
    }

    function cariobat2() {
        nama = $('#namaobatcari2').val()
        kode_kunjungan = $('#kode_kunjungan').val()
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nama,kode_kunjungan
            },
            url: '<?= route('caristokobat2') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_tabel_obat_komponen').html(response);
            }
        });
    }
    $(".riwayathasillabpasien").on('click', function(event) {
        no_rm = $(this).attr('norm')
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                no_rm
            },
            url: '<?= route('ambilriwayathasillaboratorium') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_riwayat_hasil_lab').html(response);
            }
        });
    })
    $(".riwayathasilradpasien").on('click', function(event) {
        no_rm = $(this).attr('norm')
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                no_rm
            },
            url: '<?= route('ambilriwayathasilradiologi') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_riwayat_hasil_rad').html(response);
            }
        });
    })
    $(".riwayatreseppasien").on('click', function(event) {
        no_rm = $(this).attr('norm')
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                no_rm
            },
            url: '<?= route('ambilriwayatreseppasien') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_riwayat_resep').html(response);
            }
        });
    })
    $(".riwayatresepdokter").on('click', function(event) {
        no_rm = $(this).attr('norm')
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                no_rm
            },
            url: '<?= route('ambilriwayatresepdokter') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_riwayat_resep_dokter').html(response);
            }
        });
    })
    $(".templateracikandokter").on('click', function(event) {
        no_rm = $(this).attr('norm')
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                no_rm
            },
            url: '<?= route('ambiltemplateracikan') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_riwayat_racikan_obat_dokter').html(response);
            }
        });
    })
    $(".riwayatorderhariini").on('click', function(event) {
        kode_kunjungan = $('#kode_kunjungan').val()
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kode_kunjungan
            },
            url: '<?= route('ambilriwayatorderhariini') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_r_order_tdy').html(response);
            }
        });
    })
    $(".riwayatorderlabhariini").on('click', function(event) {
        kode_kunjungan = $('#kode_kunjungan').val()
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kode_kunjungan
            },
            url: '<?= route('ambilriwayatorderlabhariini') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_r_order_penunjang_tdy').html(response);
            }
        });
    })
    $(".riwayatorderradhariini").on('click', function(event) {
        kode_kunjungan = $('#kode_kunjungan').val()
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kode_kunjungan
            },
            url: '<?= route('ambilriwayatorderradhariini') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_r_order_penunjang_tdy').html(response);
            }
        });
    })
    $(".riwayatorderpahariini").on('click', function(event) {
        kode_kunjungan = $('#kode_kunjungan').val()
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kode_kunjungan
            },
            url: '<?= route('ambilriwayatorderpadhariini') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_r_order_penunjang_tdy').html(response);
            }
        });
    })
    $(".templateresepdokter").on('click', function(event) {
        no_rm = $(this).attr('norm')
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                no_rm
            },
            url: '<?= route('ambiltemplateresep') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_riwayat_template_resep_dokter').html(response);
            }
        });
    })
    $(".pilihlayananlab").on('click', function(event) {
        kodetarif = $(this).attr('kodetarif')
        nama = $(this).attr('namatarif')
        tarif = $(this).attr('tarif')
        displaytarif = $(this).attr('displaytarif')
        var wrapper = $(".draft_layanan_lab");
        $(wrapper).append(
            '<div class="form-row text-xs"><div class="form-group col-md-3"><label for="">Nama Layanan Laboratorium</label><input readonly type="" class="form-control form-control-sm text-xs edit_field" id="" name="namatarif" value="' +
            nama +
            '"><input  hidden readonly type="" class="form-control form-control-sm" id="" name="kodatarif" value="' +
            kodetarif +
            '"><input  hidden readonly type="" class="form-control form-control-sm" id="" name="tarif" value="' +
            tarif +
            '"></div><div class="form-group col-md-2"><label for="inputPassword4">Tarif</label><input readonly type="" class="form-control form-control-sm" id="" name="displaytarif" value="' +
            displaytarif +
            '"></div><div class="form-group col-md-2"><label for="inputPassword4">Qty</label><input type="" class="form-control form-control-sm" id="" name="qty" value="1"></div><i class="bi bi-x-square remove_field form-group col-md-1 text-danger" kode2=""></i></div>'
        );
        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
    $(".pilihlayananrad").on('click', function(event) {
        kodetarif = $(this).attr('kodetarif')
        nama = $(this).attr('namatarif')
        tarif = $(this).attr('tarif')
        displaytarif = $(this).attr('displaytarif')
        var wrapper = $(".draft_layanan_rad");
        $(wrapper).append(
            '<div class="form-row text-xs"><div class="form-group col-md-3"><label for="">Nama Layanan Laboratorium</label><input readonly type="" class="form-control form-control-sm text-xs edit_field" id="" name="namatarif" value="' +
            nama +
            '"><input  hidden readonly type="" class="form-control form-control-sm" id="" name="kodatarif" value="' +
            kodetarif +
            '"><input  hidden readonly type="" class="form-control form-control-sm" id="" name="tarif" value="' +
            tarif +
            '"></div><div class="form-group col-md-2"><label for="inputPassword4">Tarif</label><input readonly type="" class="form-control form-control-sm" id="" name="displaytarif" value="' +
            displaytarif +
            '"></div><div class="form-group col-md-2"><label for="inputPassword4">Qty</label><input type="" class="form-control form-control-sm" id="" name="qty" value="1"></div><i class="bi bi-x-square remove_field form-group col-md-1 text-danger" kode2=""></i></div>'
        );
        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
    $(".pilihlayananpa").on('click', function(event) {
        kodetarif = $(this).attr('kodetarif')
        nama = $(this).attr('namatarif')
        tarif = $(this).attr('tarif')
        displaytarif = $(this).attr('displaytarif')
        var wrapper = $(".draft_layanan_lab_pa");
        $(wrapper).append(
            '<div class="form-row text-xs"><div class="form-group col-md-3"><label for="">Nama Layanan Laboratorium</label><input readonly type="" class="form-control form-control-sm text-xs edit_field" id="" name="namatarif" value="' +
            nama +
            '"><input  hidden readonly type="" class="form-control form-control-sm" id="" name="kodatarif" value="' +
            kodetarif +
            '"><input  hidden readonly type="" class="form-control form-control-sm" id="" name="tarif" value="' +
            tarif +
            '"></div><div class="form-group col-md-2"><label for="inputPassword4">Tarif</label><input readonly type="" class="form-control form-control-sm" id="" name="displaytarif" value="' +
            displaytarif +
            '"></div><div class="form-group col-md-2"><label for="inputPassword4">Qty</label><input type="" class="form-control form-control-sm" id="" name="qty" value="1"></div><i class="bi bi-x-square remove_field form-group col-md-1 text-danger" kode2=""></i></div>'
        );
        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
    function alertracikan() {
        Swal.fire({
            title: "Data racikan akan disimpan ?",
            text: "Klik OK untuk simpan racikan ...",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "OK"
        }).then((result) => {
            if (result.isConfirmed) {
                simpanracikan()
            }
        });
    }

    function simpanracikan() {
        no_rm = $('#no_rm').val()
        kode_kunjungan = $('#kode_kunjungan').val()
        spinner = $('#loader2')
        spinner.show();
        var dataheaderracikan = $('.headerracikan').serializeArray();
        var datadetailracikan = $('.draft_obat_yang_diracik').serializeArray();
        simpantemplate = $('#simpansebagaitemplateracik:checked').val()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                dataheaderracikan: JSON.stringify(dataheaderracikan),
                datadetailracikan: JSON.stringify(datadetailracikan),
                no_rm,
                kode_kunjungan,
                simpantemplate
            },
            url: '<?= route('simpanracikan') ?>',
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
                    simpanracikan2()
                    spinner.hide();
                }
            }
        });
    }

    function simpanracikan2() {
        spinner = $('#loader')
        spinner.show();
        $('#modalriwayatresep').modal('hide')
        var max_fields = 10;
        // var wrapper = $(".input_komponen_obat_racik");
        var wrapper = $(".draft_obat_yang_diorder");
        var x = 1;
        no_rm = $('#no_rm').val()
        kode_kunjungan = $('#kode_kunjungan').val()
        spinner = $('#loader2')
        spinner.show();
        var dataheaderracikan = $('.headerracikan').serializeArray();
        var datadetailracikan = $('.draft_obat_yang_diracik').serializeArray();
        simpantemplate = $('#simpansebagaitemplateracik:checked').val()
        if (x < max_fields) {
            x++; //text box increment
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    dataheaderracikan: JSON.stringify(dataheaderracikan),
                    datadetailracikan: JSON.stringify(datadetailracikan),
                    no_rm,
                    kode_kunjungan,
                    simpantemplate
                },
                url: '<?= route('simpanracikan2') ?>',
                success: function(response) {
                    // wrapper.after(html);
                    // $('#daftarpxumum').attr('disabled', true);
                    $(wrapper).append(response);
                    $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                        e.preventDefault();
                        $(this).parent('div').remove();
                        x--;
                    })
                    $('#modalbuatobatracikan').modal('toggle');
                    spinner.hide();
                }
            });
        }
    }
</script>
