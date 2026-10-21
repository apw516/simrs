@forelse($data_laporan as $item)
    <div class="iframe-container">
        <p><strong>ID Laporan:</strong> {{ $item->id }} | <strong>Tanggal Entry:</strong>
            {{ $item->created_at }}</p>

        <!-- Iframe untuk menampilkan hasil cetak per ID laporan -->
        <!-- Ganti 'id' dengan kolom primary key yang sesuai di tabel ts_laporan_tindakan_telinga jika bukan 'id' -->
        <iframe width="100%" height="100%" src="{{ route('cetak.laporanhidung', $item->kode_kunjungan) }}"></iframe>
    </div>
@empty
    <p>Tidak ada data laporan tindakan telinga ditemukan untuk Nomor RM tersebut.</p>
@endforelse
