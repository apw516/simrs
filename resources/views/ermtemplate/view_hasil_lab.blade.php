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
<iframe src ="//192.168.2.74/smartlab_waled/his/his_report?hisno=LAB230518000147" width="1000px" height="600px"></iframe>