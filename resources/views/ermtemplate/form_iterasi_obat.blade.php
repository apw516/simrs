  <div class="card">
      <div class="card-header text-bold bg-warning">Iterasi BPJS</div>
      <div class="card-body">
        <input hidden type="text" value="{{ $kodekunjungan }}" id="kodekunjunganiterasi" name="kodekunjunganiterasi">
          <p class='text-danger text-bold font-italic'>*Iterasi BPJS adalah program layanan peresepan obat
              kronis yang memungkinkan peserta JKN (Jaminan Kesehatan Nasional) untuk mendapatkan
              obat secara berulang tanpa harus berkonsultasi dengan dokter setiap bulan.</p>
          <br>
          <div class="form-group row">
              <label for="staticEmail" class="col-sm-4 col-form-label">Apakah pasien termasuk
                  kedalam iterasi BPJS ?</label>
              <div class="col-sm-10">
                  <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="iterasipilih" id="iterasipilih"
                          value="1" @if(count($cek)> 0) checked @endif>
                      <label class="form-check-label" for="inlineRadio1">YA</label>
                  </div>
                  <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="iterasipilih" id="iterasipilih"
                          value="0" @if(count($cek)== 0) checked @endif>
                      <label class="form-check-label" for="inlineRadio2">Tidak</label>
                  </div>
              </div>
          </div>
          <div class="form-group">
              <label for="formGroupExampleInput">Masukan Jumlah Iterasi obat</label>
              <input type="text" class="form-control col-md-6" id="jumlahiterasi" name="jumlahiterasi"
                  placeholder="Iterasi obat diberikan maksimal 2 kali atau selama 2 bulan ..." value="@if(count($cek)> 0) {{ $cek[0]->jumlah }} @endif">
          </div>
      </div>
  </div>
