<div class="container">
    <div class="row">
        <div class="col-md-2">
            Nomor RM
        </div>
        <div class="col-md-2">
            {{-- @dd($datakunjungan) --}}
            :   {{ $datakunjungan[0]->no_rm }}
        </div>
        <div class="col-md-2">
            Penjamin
        </div>
        <div class="col-md-2">
            :   {{ $datakunjungan[0]->nama_penjamin }}
        </div>
        @if($datakunjungan[0]->nama_penjamin != 'PRIBADI')
        <div class="col-md-1">
        </div>
        <div class="col-md-3">
            <a href="cetaksep/{{ $datakunjungan[0]->kode_kunjungan}}" target="_blank"><i class="bi bi-printer-fill"></i> SEP  </a> | 
            <a href="http://192.168.2.45/printlabel/cetaklabel.php?rm={{ $datakunjungan[0]->no_rm }}&nama={{ $datakunjungan[0]->nama_px }}" target="_blank"><i class="bi bi-printer-fill"></i> label</a> 
        </div>
        @else
        <div class="col-md-1">
        </div>
        <div class="col-md-3">
              {{ $datakunjungan[0]->no_sep }} <a href="cetakstruk/{{ $datakunjungan[0]->kode_kunjungan}}" target="_blank"><i class="bi bi-printer-fill"></i> Nota</a> | 
              
              <a href="http://192.168.2.45/printlabel/cetaklabel.php?rm={{ $datakunjungan[0]->no_rm }}&nama={{ $datakunjungan[0]->nama_px }}" target="_blank"><i class="bi bi-printer-fill"></i> label</a>
        </div>
        @endif       
    </div>
    <div class="row">
        {{-- <div class="col-md-2">
            Nomor KTP
        </div>
        <div class="col-md-2">
            :   {{ $datakunjungan[0]->nik_bpjs }}
        </div> --}}
        <div class="col-md-2">
            Unit
        </div>
        <div class="col-md-2">
            :   {{ $datakunjungan[0]->nama_unit }}
        </div>
        
    </div>
    <div class="row">
        {{-- <div class="col-md-2">
            Nomor BPJS
        </div>
        <div class="col-md-2">
            :   {{ $datakunjungan[0]->no_bpjs }}
        </div> --}}
        <div class="col-md-2">
            Nama Dokter
        </div>
        <div class="col-md-5">
            :   {{ $datakunjungan[0]->dokter }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            Nama
        </div>
        <div class="col-md-5">
            :   {{ $datakunjungan[0]->nama_px }}
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-md-2">
            Alamat
        </div>
        <div class="col-md-5">
            :   {{ $datakunjungan[0]->alamat }}
        </div>
    </div> --}}
    {{-- <div class="row">
        <div class="col-md-2">
            Status
        </div>
        <div class="col-md-5">
            :   {{ $datakunjungan[0]->status }}
        </div>
    </div> --}}
    <div class="row">
        <div class="col-md-2">
            Tanggal Masuk
        </div>
        <div class="col-md-5">
            :   {{ $datakunjungan[0]->tgl_masuk }}
        </div>
    </div>
</div>
    <div class="container mt-3">
        <h4>Detail layanan</h4>
        <table class="table table-sm table-bordered">
            <thead>
                <th>kode kunjungan</th>
                <th>kode layanan header</th>
                <th>nama tarif</th>
                <th>tarif</th>
            </thead>
            <tbody>
                <?php $total = 0 ;?>
                @foreach ($data_layanan as $d)
                <Tr>
                <td>{{ $d->kode_kunjungan }}</td>
                <td>{{ $d->kode_layanan_header }}</td>
                <td>{{ $d->NAMA_TARIF }}</td>
                <td>{{ $d->TOTAL_TARIF_NEW }}</td>
                </tr>
                <?php $tariftotal = $total + $d->TOTAL_TARIF_NEW;
                    $total = $tariftotal;
                ?>
                @endforeach
                <tr>
                    <td colspan="3" class="text-center">Total layanan</td>
                    <td>{{ $total }}</td>
                </tr>
            </tbody>
        </table>
    </div>