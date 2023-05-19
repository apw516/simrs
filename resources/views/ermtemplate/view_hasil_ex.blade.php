{{-- <script type="text/javascript" src="{{ asset('public/pdf.js') }}"></script>
<style>
    .pdfobject-container {
        height: 30rem;
        border: 1rem solid rgba(0, 0, 0, .1);
    }
</style>
<div id="example1"></div>
<script>
    PDFObject.embed("http://192.168.2.74/smartlab_waled/his/his_report?hisno=LAB230518000147", "#example1");
</script> --}}
{{-- {{ asset('/laraview/#../folder-name/the-pdf-file.pdf') }} --}}
{{-- @foreach ($cek as $c ) --}}
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<div class="card">
    {{-- <div class="card-header">{{ $c->kode_header }}</div> --}}
    <div class="card-body">
        <iframe src ="https://192.168.2.233/expertise/cetak0.php?IDs=4741609&IDd=27024245&tgl_cetak=2023-05-19" width="1000px" height="600px"></iframe>
    </div>
</div>
{{-- @endforeach --}}
