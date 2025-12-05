<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;

class Apliacares_bpjs extends Model
{
    // public $baseUrl = 'https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/';
    public $baseUrl = 'https://apijkn.bpjs-kesehatan.go.id/vclaim-rest/';
    public static function signature()
    {
        
        $cons_id =  env('CONS_ID');
        $secretKey = env('SECRET_KEY');
        $userkey = env('USER_KEY');

        date_default_timezone_set('UTC');
        $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
        $signature = hash_hmac('sha256', $cons_id . "&" . $tStamp, $secretKey, true);
        $encodedSignature = base64_encode($signature);
        $response = array(
            'user_key' => $userkey,
            'x-cons-id' => $cons_id,
            'x-timestamp' => $tStamp,
            'x-signature' => $encodedSignature,
            'decrypt_key' => $cons_id . $secretKey . $tStamp,
        );
        return $response;
    }
    public static function stringDecrypt($key, $string)
    {
        $encrypt_method = 'AES-256-CBC';
        $key_hash = hex2bin(hash('sha256', $key));
        $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);
        $output = \LZCompressor\LZString::decompressFromEncodedURIComponent($output);
        return $output;
    }
    public function deletbed($datat){
        $client = new Client();
        $data = json_encode($datat);
        $url = 'https://new-api.bpjs-kesehatan.go.id/aplicaresws/rest/bed/delete/1018R001';
        $signature = $this->signature();       
        $response = $client->request('POST', $url, [
            'headers' => $signature,
            'body' => $data
            ]);
        $response = json_decode($response->getBody());
        // if ($response->metaData->code == 200) {
        //     $decrypt = $this->stringDecrypt($signature['decrypt_key'], $response->response);
        //     $response->response = json_decode($decrypt);
        // }
        return $response; 
    }
    public function referensi_kamar()
    {
        $client = new Client();
        $url = 'https://new-api.bpjs-kesehatan.go.id/aplicaresws/rest/ref/kelas';
        $signature = $this->signature();       
        $response = $client->request('GET', $url, [
            'headers' => $signature
        ]);
        $response = json_decode($response->getBody());
        return $response;
    }
    public function ketersediaan()
    {
        $client = new Client();
        $url = 'https://new-api.bpjs-kesehatan.go.id/aplicaresws/rest/bed/read/1018R001/1/200';
        $signature = $this->signature();       
        $response = $client->request('GET', $url, [
            'headers' => $signature
        ]);
        $response = json_decode($response->getBody());
        // if ($response->metaData->code == 200) {
        //     $decrypt = $this->stringDecrypt($signature['decrypt_key'], $response->response);
        //     $response->response = json_decode($decrypt);
        // }
        return $response;
    }
    public function updatebed2($databed)
    {
        $client = new Client();
        $data = json_encode($databed);
        $url = "https://new-api.bpjs-kesehatan.go.id/aplicaresws/rest/bed/update/1018R001";
        $signature = $this->signature();       
        // try{
            $response = $client->request('POST', $url, [
                'headers' => $signature,
                'body' => $data,
                'allow_redirects' => true,
                'timeout' => 20 
                ]);
            $response = json_decode($response->getBody());
            return $response;      
    }
    public function updatebed($databed)
    {
        $client = new Client();
        $data = json_encode($databed[0]);
        $url = "https://new-api.bpjs-kesehatan.go.id/aplicaresws/rest/bed/update/1018R001";
        $signature = $this->signature();       
        // try{
            $response = $client->request('POST', $url, [
                'headers' => $signature,
                'body' => $data,
                'allow_redirects' => true,
                'timeout' => 20 
                ]);
            $response = json_decode($response->getBody());
            return $response;      
    }
    public function bedbaru($databed)
    {
        $client = new Client();
        $data = json_encode($databed[0]);
        $url = "https://new-api.bpjs-kesehatan.go.id/aplicaresws/rest/bed/create/1018R001";
        $signature = $this->signature();       
        // try{
            $response = $client->request('POST', $url, [
                'headers' => $signature,
                'body' => $data,
                'allow_redirects' => true,
                'timeout' => 20 
                ]);
        $response = json_decode($response->getBody());
        return $response;
            // dd($response);
        //     if ($response->metaData->code == 200) {
        //         $decrypt = $this->stringDecrypt($signature['decrypt_key'], $response->response);
        //         $response->response = json_decode($decrypt);
        //     }
        //     return $response;
        // }catch(ClientException){
        //     return 'RTO';
        // }          
    }
}
