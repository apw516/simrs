@foreach ($header as $h )
    <div class="card">
        <div class="card-header bg-info">{{ $h->nama_racikan}} | {{ $h->tgl_entry }}</div>
        <div class="card-body">
            {{-- Jumlah Racikan : {{ $h->jumlah_racikan }}
            Aturan Pakai : {{ $h->aturan_pakai }} --}}
            <form>
                <div class="form-group row">
                  <label for="staticEmail" class="col-sm-2 col-form-label">Jumlah Racikan</label>
                  <div class="col-sm-10">
                    <input type="text" disabled class="form-control form-control-plaintext" id="inputPassword" value="{{ $h->jumlah_racikan }}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Aturan pakai</label>
                  <div class="col-sm-10">
                    <textarea disabled type="password" class="form-control form-control-plaintext" id="inputPassword">{{ $h->aturan_pakai }}</textarea>
                  </div>
                </div>
              </form>

            <table id="tb_r_pemakaian_obat" class="table table-sm table-bordered table-hover table-stripped">
                <thead class="bg-light">
                    <th>Nama Obat</th>
                    <th>Qty</th>
                    <th>Dosis Awal</th>
                    <th>Dosis Racik</th>
                </thead>
                <tbody>
                        @foreach ($detail as $k)
                            @if ($h->id == $k->id_header)
                                <tr>
                                    <td>{{ $k->nama_barang }}</td>
                                    <td>{{ $k->qty }}</td>
                                    <td>{{ $k->dosis_awal }}</td>
                                    <td>{{ $k->dosis_racik }}</td>
                                </tr>
                            @endif
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endforeach
