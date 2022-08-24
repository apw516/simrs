 <div class="card">
     <div class="card-header bg-info">Detail Surat Kontrol / SPRI</div>
     <div class="card-body">
        @if($detail->metaData->code != 200)
          {{ $detail->metaData->message }}
          @else
          <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Nomor Surat</b>
                                    <div class="bataledit">
                                        <a class="float-right text-dark text-monospace p-2"> {{ $detail->response->noSuratKontrol }}
                                        </a>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <b>Nomor SEP</b> <a
                                        class="float-right text-dark text-monospace p-2">{{ $detail->response->sep->noSep }}</a>
                                </li>                        
                                <li class="list-group-item">
                                    <b>Tgl terbit</b> <a
                                        class="float-right text-dark text-bold text-monospace">{{ $detail->response->tglTerbit }}</a>
                                </li>                        
                                <li class="list-group-item">
                                    <b>Tgl Kontrol</b> <a
                                        class="float-right text-dark text-bold text-monospace">{{ $detail->response->tglRencanaKontrol }}</a>
                                </li>                        
                                <li class="list-group-item">
                                    <b>Poli Tujuan</b> <a
                                        class="float-right text-dark text-bold text-monospace">{{ $detail->response->namaPoliTujuan }}</a>
                                </li>                        
                                <li class="list-group-item">
                                    <b>Dokter</b> <a
                                        class="float-right text-dark text-monospace p-2">{{ $detail->response->namaDokter }}</a>
                                </li>                        
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Nomor Kartu</b>
                                    <div class="bataledit">
                                        <a class="float-right text-dark text-monospace p-2">{{ $detail->response->sep->peserta->noKartu }}
                                        </a>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <b>Nama</b> <a
                                        class="float-right text-dark text-monospace p-2">{{ $detail->response->sep->peserta->nama }}</a>
                                </li>                        
                                <li class="list-group-item">
                                    <b>Tgl Lahir</b> <a
                                        class="float-right text-dark text-bold text-monospace">{{ $detail->response->sep->peserta->tglLahir }}</a>
                                </li>                        
                                <li class="list-group-item">
                                    <b>Diagnosa</b> <a
                                        class="float-right text-dark text-bold text-monospace">{{ $detail->response->sep->diagnosa}}</a>
                                </li>                        
                                <li class="list-group-item">
                                    <b>Poli Tujuan</b> <a
                                        class="float-right text-dark text-bold text-monospace">{{ $detail->response->namaPoliTujuan }}</a>
                                </li>                        
                                <li class="list-group-item">
                                    <b>Jns Pelayanan</b> <a
                                        class="float-right text-dark text-monospace p-2">{{ $detail->response->sep->jnsPelayanan }}</a>
                                </li>                        
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Nomor Rujukan</b>
                                    <div class="bataledit">
                                        <a class="float-right text-dark text-monospace p-2">{{ $detail->response->sep->provPerujuk->noRujukan }}
                                        </a>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <b>Tgl Rujukan</b> <a
                                        class="float-right text-dark text-monospace p-2">{{ $detail->response->sep->provPerujuk->tglRujukan }}</a>
                                </li>                        
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Jenis Faskes</b>
                                    <div class="bataledit">
                                        <a class="float-right text-dark text-monospace p-2">Faskes {{ $detail->response->sep->provPerujuk->asalRujukan }}
                                        </a>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <b>Nama</b> <a
                                        class="float-right text-dark text-monospace p-2">{{ $detail->response->sep->provPerujuk->nmProviderPerujuk }}</a>
                                </li>                       
                            </ul>
                        </div>
                    </div>
                    <button id="editsurat" class="btn btn-warning float-right editsurat ml-2" data-toggle="modal" 
                    data-target="#modaleditsurkon" onclick="editsuratkontrol()" nomorkartu="{{ $detail->response->sep->peserta->noKartu }}" nama="{{ $detail->response->sep->peserta->nama }}" jenis="{{ $detail->response->jnsKontrol }}" nomor="{{ $detail->response->noSuratKontrol }}" nomorsep="{{ $detail->response->sep->noSep }}" tgl="{{ $detail->response->tglRencanaKontrol }}" namapoli="{{ $detail->response->namaPoliTujuan }}" kdpoli="{{ $detail->response->poliTujuan }}" nmdokter="{{ $detail->response->namaDokter }}" kddokter="{{ $detail->response->kodeDokter }}"><i
                        class="bi bi-pencil-square text-md mr-1"></i>Update</button>

                    <a href="cetaksurkon/{{ $detail->response->noSuratKontrol }}" target="_blank" class="btn btn-info float-right">
                        
                    <i class="bi bi-printer-fill"></i>Print</a>

                    <button class="btn btn-danger float-right mr-2" id="hapussurat" onclick="hapussurkon()" nomorsurat="{{ $detail->response->noSuratKontrol }}"><i
                        class="bi bi-trash text-md mr-1"></i>Hapus</button>
                </div>
            </div>
        </div>
        @endif
     </div>
 </div>
 <script>
    function editsuratkontrol()
    {
        jenis = $('#editsurat').attr('jenis')
        nomorkartu = $('#editsurat').attr('nomorkartu')
        nama = $('#editsurat').attr('nama')
        nomorsurat = $('#editsurat').attr('nomor')
        nomorsep = $('#editsurat').attr('nomorsep')
        tgl = $('#editsurat').attr('tgl')
        namapoli = $('#editsurat').attr('namapoli')
        kdpoli = $('#editsurat').attr('kdpoli')
        nmdokter = $('#editsurat').attr('nmdokter')
        kddokter = $('#editsurat').attr('kddokter')
        $('#nomorkartu_update').val(nomorkartu)
        $('#nama_update').val(nama)
        $('#nomorsuratkontrol_update').val(nomorsurat)
        $('#nomorsep_update').val(nomorsep)
        $('#tanggalkontrol_update').val(tgl)
        $('#polikontrol_update').val(namapoli)
        $('#kodepolikontrol_update').val(kdpoli)
        $('#dokterkontrol_update').val(nmdokter)
        $('#kodedokterkontrol_update').val(kddokter)
        $('#jenis').val(jenis)
    }
    function hapussurkon()
    {
        nomorsurat = $('#hapussurat').attr('nomorsurat')
        Swal.fire({
            title: 'surat kontrol ' + nomorsurat,
            text: "Surat kontrol akan dihapus ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                spinner = $('#loader')
                spinner.show()
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        nomorsurat,
                    },
                    dataType: 'Json',
                    Async: true,
                    url: '<?= route('vclaimhapussurkon') ?>',
                    error: function(data) {
                        spinner.hide()
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops,silahkan coba lagi',
                        })
                    },
                    success: function(data) {
                        spinner.hide()
                        if (data.metaData.code == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil dihapus ...',
                            })
                            location.reload()
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: data.metaData.message,
                            })
                        }
                    }
                });
            }
        });
    }
</script>

