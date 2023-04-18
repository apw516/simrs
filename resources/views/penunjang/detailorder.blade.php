<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Main content -->
                <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <i class="fas fa-globe"></i> RSUD WALED
                                <small class="float-right">Tanggal Order : {{ $detail[0]->tgl_entry }}</small>
                            </h4>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            From
                            <address>
                                <strong>{{ $detail[0]->unit_asal }}</strong><br>
                                <strong>{{ $detail[0]->dok_kirim }}</strong><br>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                                <strong>{{ $detail[0]->unit_tujuan }}</strong><br>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <b>Invoice #{{ $detail[0]->kode_layanan_header }}</b><br>
                            <br>Nomor RM:</b> {{ $detail[0]->no_rm }}<br>
                            <b>Penjamin:</b> {{ $detail[0]->nama_penjamin }}<br>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row mt-2">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Qty</th>
                                        <th>Nama Layanan</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detail as $d)
                                        <tr>
                                            <td>{{ $d->jlh_layanan }}</td>
                                            <td>{{ $d->nama_tarif }}</td>
                                            <td>{{ $d->total }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-6">
                            {{-- <p class="lead">Payment Methods:</p>
                            <img src="../../dist/img/credit/visa.png" alt="Visa">
                            <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                            <img src="../../dist/img/credit/american-express.png" alt="American Express">
                            <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                            <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya
                                handango imeem
                                plugg
                                dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                            </p> --}}
                        </div>
                        <!-- /.col -->
                        <div class="col-6">
                            <p class="lead">Tanggal Periksa {{ $detail[0]->tgl_periksa }}</p>

                            <div class="table-responsive">
                                <table class="table">
                                    {{-- <tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <td>$250.30</td>
                                    </tr>
                                    <tr>
                                        <th>Tax (9.3%)</th>
                                        <td>$10.34</td>
                                    </tr>
                                    <tr>
                                        <th>Shipping:</th>
                                        <td>$5.80</td>
                                    </tr> --}}
                                    <tr>
                                        <th>Total:</th>
                                        <td>
                                            @if ($detail[0]->kode_penjaminx == 'P01')
                                                {{ $detail[0]->tagihan_pribadi_header }}
                                            @else
                                                {{ $detail[0]->tagihan_penjamin_header }}
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <input hidden type="text" id="idorder" value="{{ $detail[0]->id_heaeder }}">
                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-12">
                            {{-- <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i
                                    class="fas fa-print"></i> Print</a> --}}
                            <button type="button" class="btn btn-success float-right" onclick="terimaorder()"><i
                                    class="far fa-credit-card"></i> Terima Order
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /.invoice -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<script>
    function terimaorder() {
        idorder = $('#idorder').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                idorder,
            },
            dataType: 'Json',
            Async: true,
            url: '<?= route('terimaordernya') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops,silahkan coba lagi',
                })
            },
            success: function(data) {
                spinner.hide()
                if (data.code == 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Order berhasil diterima ...',
                    })
                    ambildataorderan()
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: data.message,
                    })
                }
            }
        });
    }
</script>
