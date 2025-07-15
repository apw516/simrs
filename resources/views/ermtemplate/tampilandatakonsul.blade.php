  @if (count($konsul) > 0)
      <div class="card">
          <div class="card-header">Konsul dari : <br> {{ $konsul[0]->dokter_konsul }} | {{ $konsul[0]->unit_kirim }} <br>
              Tanggal Konsul : {{ date('d-M-Y', strtotime($konsul[0]->tgl_konsul)) }}
          </div>
          <div class="card-body">
              <input hidden type="text" value="{{ $konsul[0]->id }}" id="idkonsul">
              <p> Catatan : {{ $konsul[0]->catatan }} </p>
              <div class="card mt-2">
                  <div class="card-header">Jawaban Konsul</div>
                  <div class="card-body">
                      <textarea cols="30" rows="10" class="form-control" id="jawabankonsul"></textarea>
                  </div>
              </div>
          </div>
          <div class="card-footer">
              <button class="btn btn-warning" onclick="simpanjawabankonsul()">Simpan Jawaban Konsul</button>
          </div>
      </div>
      @elseif(count($konsul2) > 0)
      <h5 class="text-danger mb-5">Terima kasih sudah menjawab konsul dari {{ $konsul2[0]->unit_kirim }} | {{ $konsul2[0]->dokter_konsul }}</h5>
  @endif
  <script>
      function simpanjawabankonsul() {
          id = $('#idkonsul').val()
          jawabankonsul = $('#jawabankonsul').val()
          kodekunjungan = $('#kodekunjungan').val()
          spinner = $('#loader')
          spinner.show();
          $.ajax({
              async: true,
              type: 'post',
              dataType: 'json',
              data: {
                  _token: "{{ csrf_token() }}",
                  id,
                  jawabankonsul,
                  kodekunjungan
              },
              url: '<?= route('simpanjawabankonsul') ?>',
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
                    ambildatakonsul()
                  }
              }
          });

      }
  </script>
