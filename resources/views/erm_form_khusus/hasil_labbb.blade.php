 @foreach ($hasil_lab as $c)
     <iframe src="//192.168.2.74/smartlab_waled/his/his_report?hisno={{ $c->kode_layanan_header }}" width="100%"
         height="1000px"></iframe>
 @endforeach
