@foreach ($data_file as $d)
    @php
        $ext = strtolower(pathinfo($d->gambar, PATHINFO_EXTENSION));
        $fileUrl = 'https://192.168.2.45/files/' . $d->gambar;
    @endphp

    <!-- Header Info File -->
    <tr class="bg-light">
        <td colspan="2" class="align-middle">
            <span class="text-bold"><i class="fas fa-paperclip mr-1"></i> {{ $d->gambar }}</span>
        </td>
        <td class="text-right align-middle">
            <a href="{{ $fileUrl }}" target="_blank" class="btn btn-xs btn-outline-primary mr-1"
                title="Buka di Tab Baru">
                <i class="fas fa-external-link-alt"></i> Tab Baru
            </a>
            <button class="btn btn-xs btn-danger hapus" id="{{ $d->id }}" title="Hapus File">
                <i class="fas fa-trash-alt"></i> Hapus
            </button>
        </td>
    </tr>

    <!-- Isi Berkas Langsung Tampil -->
    <tr>
        <td colspan="3" class="text-center bg-white p-3">
            @if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                <img src="{{ $fileUrl }}" alt="{{ $d->gambar }}" class="img-fluid rounded border shadow-sm"
                    style="max-height: 600px;">
            @elseif ($ext == 'pdf')
                <iframe src="{{ $fileUrl }}" width="200%" height="600px" style="border: 1px solid #ddd;"
                    class="rounded shadow-sm">
                    <p>Browser tidak mendukung PDF. <a href="{{ $fileUrl }}">Download PDF</a></p>
                </iframe>
            @else
                <div class="alert alert-warning mb-0 text-left">
                    <i class="fas fa-exclamation-triangle mr-1"></i> File ini (<b>{{ $d->gambar }}</b>) tidak dapat
                    ditampilkan secara otomatis.
                    <a href="{{ $fileUrl }}" target="_blank" class="alert-link">Klik di sini untuk mengunduh</a>.
                </div>
            @endif
        </td>
    </tr>
@endforeach
