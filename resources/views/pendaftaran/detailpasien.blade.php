<div class="container">
    <div class="row">
        <div class="col-md-4">
            Nomor RM
        </div>
        <div class="col-md-4">
            {{ $data_pasien[0]['no_rm'] }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            No KTP
        </div>
        <div class="col-md-4">
            {{ $data_pasien[0]['nik_bpjs'] }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            No BPJS
        </div>
        <div class="col-md-4">
            {{ $data_pasien[0]['no_Bpjs'] }}
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-4">
            Nama
        </div>
        <div class="col-md-4">
            {{ $data_pasien[0]['nama_px'] }}
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-4">
            Agama / Jenis Kelamin
        </div>
        <div class="col-md-4">
            @isset($data_pasien[0]['Agama']['agama'])
            {{ $data_pasien[0]['Agama']['agama'] }}
            @endisset
            @empty($data_pasien[0]['Agama'])
            -
            @endempty
            /  {{ $data_pasien[0]['jenis_kelamin'] }}
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-4">
            Tempat, Tanggal lahir
        </div>
        <div class="col-md-4">
            {{ $data_pasien[0]['tempat_lahir'] }} , {{ $data_pasien[0]['tgl_lahir'] }}
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-4">
            Pekerjaan
        </div>
        <div class="col-md-4">
            @isset($data_pasien[0]['Pekerjaan']['pekerjaan'])
                {{ $data_pasien[0]['Pekerjaan']['pekerjaan'] }}
            @endisset
            @empty($data_pasien[0]['Pekerjaan'])
                -
            @endempty
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-4">
            Pendidikan
        </div>
        <div class="col-md-4">
            @isset($data_pasien[0]['Pendidikan']['pendidikan'])
                {{ $data_pasien[0]['Pendidikan']['pendidikan'] }}
            @endisset
            @empty($data_pasien[0]['Pendidikan'])
                -
            @endempty
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-4">
            Alamat
        </div>
        <div class="col-md-6">
            {{ $data_pasien[0]['alamat']}} , Desa 
            @isset($data_pasien[0]['Desa']['name'])
                {{ $data_pasien[0]['Desa']['name'] }}
            @endisset
            @empty($data_pasien[0]['Desa'])
                -
            @endempty
            , 
            @isset($data_pasien[0]['Kecamatan']['name'])
            {{ $data_pasien[0]['Kecamatan']['name'] }}
            @endisset
            @empty($data_pasien[0]['Kecamatan'])
                -
            @endempty
            , 
            @isset($data_pasien[0]['Kabupaten']['name'])
            {{ $data_pasien[0]['Kabupaten']['name'] }}
            @endisset
            @empty($data_pasien[0]['Kabupaten'])
                -
            @endempty
            , 
            @isset($data_pasien[0]['Provinsi']['name'])
            {{ $data_pasien[0]['Provinsi']['name'] }}
            @endisset
            @empty($data_pasien[0]['Provinsi'])
                -
            @endempty
        </div>
    </div>
</div>
