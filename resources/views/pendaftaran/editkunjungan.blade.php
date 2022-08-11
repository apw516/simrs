{{-- {{ $data['rm'] }}
{{ $data['sep'] }}
{{ $data['rujukan'] }}
{{ $data['status'] }}
{{ $data['kronis'] }}
{{ $data['kode'] }} --}}
<form>
    <div class="form-group">
      <label for="exampleFormControlInput1">Nomor RM</label>
      <input type="" readonly class="form-control" id="nomorrm"  value="{{ $data['rm'] }}">
      <input hidden type="" readonly class="form-control" id="kodekunjungan" value="{{ $data['kode'] }}">
    </div>
    <div class="form-group">
      <label for="exampleFormControlInput1">Nomor SEP</label>
      <input type="email" class="form-control" id="nomorsep" value="{{ $data['sep'] }}">
    </div>
    <div class="form-group">
      <label for="exampleFormControlInput1">Nomor Rujukan</label>
      <input type="email" class="form-control" id="nomorrujukan" value="{{ $data['rujukan'] }}">
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Kronis</label>
        <select class="form-control" id="kronis">
          <option value="KRONIS" @if($data['kronis'] == 'KRONIS') selected @endif>YA</option>
          <option value="" @if($data['kronis'] != 'KRONIS') selected @endif>TIDAK</option>
        </select>
    </div>
    <div class="form-group">
      <label for="exampleFormControlSelect1">Status Kunjungan</label>
      <select class="form-control" id="status_kunjungan">
        <option value="">Silahkan pilih</option>
        <option value="1" @if($data['status'] == 1) selected @endif >Aktif</option>
        <option value="2" @if($data['status'] == 2) selected @endif>Selesai</option>
        <option value="8" @if($data['status'] == 8) selected @endif>Batal</option>
      </select>
    </div>
  </form>