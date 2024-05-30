@if (count($assdok) > 0)
    <div class="card">
        <div class="card-header"> <i class="bi bi-bookmark-plus mr-1"></i> Hasil Assesment Medis</div>
        <div class="card-body">
            <table class="table">
                @foreach ($assdok as $a)
                    <tr>
                        <td width="15%" class="text-bold">Diagnosa Kerja</td>
                        <td class="font-italic">: {{ $a->diagnosakerja }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Diagnosa Banding</td>
                        <td class="font-italic">: {{ $a->diagnosabanding }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Pemeriksaan Fisik</td>
                        <td class="font-italic">: @if ($a->versi == 1)
                                {{ $a->keadaanumum }}, {{ $a->kesadaran }}, {{ $a->pemeriksaan_fisik }}
                            @else
                                {{ $a->pemeriksaan_fisik }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold">Rencana Terapi</td>
                        <td class="font-italic">: {{ $a->rencanakerja }}</td>
                    </tr>
                @endforeach
            </table>
            <div class="card mt-2">
                <div class="card-header bg-light">Order Farmasi @if(count($antrian) > 0) <p class="float-right text-bold font-lg">Nomor Antrian Farmasi : {{ $antrian[0]->nomor_antrian }} </p>@endif</div>
                <div class="card-body">
                    <table class="table table-sm table-bordered table-hover text-sm">
                        <thead class="bg-dark">
                            <th>Unit Tujuan</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Aturan Pakai</th>
                            <th>status header</th>
                            {{-- <th>status detail</th> --}}
                        </thead>
                        <tbody>
                            @foreach ($of as $f)
                                <tr>
                                    <td>{{ $f->unit_tujuan }}</td>
                                    <td>{{ $f->kode_tarif_detail }}</td>
                                    <td>{{ $f->jumlah_layanan }}</td>
                                    <td>{{ $f->keterangan }}</td>
                                    <td>{{ $f->aturan_pakai }}</td>
                                    <td>
                                        @if ($f->status_order == '99')
                                            Belum dikirim
                                        @elseif($f->status_order == '0')
                                            Terkirim ke farmasi
                                        @elseif($f->status_order == 1)
                                            Dalam antrian farmasi
                                        @elseif($f->status_order == 2)
                                            Sudah dilayani farmasi
                                        @endif
                                    </td>
                                    {{-- <td>{{ $f->status_layanan_detail}}</td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-light">
                    <button @if(count($of) == 0) disabled @endif  class="btn btn-success float-right kirimfarmasi" kodekunjungan="{{ $kodekunjungan }}"><i
                            class="bi bi-send-check mr-1"></i> Kirim Ke Farmasi</button>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Order Laboratorium</div>
                <div class="card-body">
                    <table class="table table-sm table-bordered table-hover text-sm">
                        <thead class="bg-dark">
                            <th>Unit Tujuan</th>
                            <th>Nama Layanan</th>
                            <th>Jumlah</th>
                            <th>===</th>
                        </thead>
                        <tbody>
                            @foreach ($oL as $f)
                                <tr>
                                    <td>{{ $f->nama_unit }}</td>
                                    <td>{{ $f->NAMA_TARIF }}</td>
                                    <td>{{ $f->jumlah_layanan }}</td>
                                    <td>
                                        @if ($f->status_order == '99')
                                            Belum dikirim
                                        @elseif($f->status_order == '0')
                                            Terkirim ke Laboratorium
                                        @elseif($f->status_order == 1)
                                            Dalam antrian Laboratorium
                                        @endif
                                    </td>
                                    {{-- <td>{{ $f->status_layanan_detail}}</td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-light">
                    <button @if(count($oL) == 0) disabled @endif  class="btn btn-success float-right kirimlab" kodekunjungan="{{ $kodekunjungan }}"><i
                            class="bi bi-send-check mr-1"></i> Kirim Ke Laboratorium</button>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Order Radiologi</div>
                <div class="card-body">
                    <table class="table table-sm table-bordered table-hover text-sm">
                        <thead class="bg-dark">
                            <th>Unit Tujuan</th>
                            <th>Nama Layanan</th>
                            <th>Jumlah</th>
                            <th>===</th>
                        </thead>
                        <tbody>
                            @foreach ($oR as $f)
                                <tr>
                                    <td>{{ $f->nama_unit }}</td>
                                    <td>{{ $f->NAMA_TARIF }}</td>
                                    <td>{{ $f->jumlah_layanan }}</td>
                                    <td>
                                        @if ($f->status_order == '99')
                                            Belum dikirim
                                        @elseif($f->status_order == '0')
                                            Terkirim ke Radiologi
                                        @elseif($f->status_order == 1)
                                            Dalam antrian Radiologi
                                        @endif
                                    </td>
                                    {{-- <td>{{ $f->status_layanan_detail}}</td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-light">
                    <button @if(count($oR) == 0) disabled @endif class="btn btn-success float-right kirimrad" kodekunjungan="{{ $kodekunjungan }}"><i
                            class="bi bi-send-check mr-1"></i> Kirim Ke Radiologi</button>
                </div>
            </div>
        </div>
    </div>
@endif
<script>
    $(".kirimfarmasi").on('click', function(event) {
        Swal.fire({
            title: "Anda yakin ?",
            text: "Resep akan dikirim ke farmasi",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, kirim resep"
        }).then((result) => {
            if (result.isConfirmed) {
                kodekunjungan = $(this).attr('kodekunjungan')
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    async: true,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        kodekunjungan
                    },
                    url: '<?= route('kirimorderfarmasi') ?>',
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
                            ambilhasilassesmentmedis()
                        }
                    }
                });
            }
        });
    });
    $(".kirimlab").on('click', function(event) {
        Swal.fire({
            title: "Anda yakin ?",
            text: "Order akan dikirim ke Laboratorium",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, kirim order"
        }).then((result) => {
            if (result.isConfirmed) {
                kodekunjungan = $(this).attr('kodekunjungan')
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    async: true,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        kodekunjungan
                    },
                    url: '<?= route('kirimorderlab') ?>',
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
                            ambilhasilassesmentmedis()
                        }
                    }
                });
            }
        });
    });
    $(".kirimrad").on('click', function(event) {
        Swal.fire({
            title: "Anda yakin ?",
            text: "Order akan dikirim ke Radiologi",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, kirim order"
        }).then((result) => {
            if (result.isConfirmed) {
                kodekunjungan = $(this).attr('kodekunjungan')
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    async: true,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        kodekunjungan
                    },
                    url: '<?= route('kirimorderrad') ?>',
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
                            ambilhasilassesmentmedis()
                        }
                    }
                });
            }
        });
    });
</script>
