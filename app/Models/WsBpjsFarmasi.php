<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;

class WsBpjsFarmasi extends Model
{
    // public $baseUrl = 'https://apijkn.bpjs-kesehatan.go.id/apotek-rest/';
    public $baseUrl = 'https://apijkn-dev.bpjs-kesehatan.go.id/apotek-rest-dev/';
    public static function signature()
    {
        $cons_id =  '25561';
        $secretKey = '1pDB298D7E';
        $userkey = '7e6cc1796caf45f017d2f8626e3539de';

        // $cons_id =  env('CONS_ID');
        // $secretKey = env('SECRET_KEY');
        // $userkey = env('USER_KEY');
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
    public function dpho()
    {
        $client = new Client();
        $url = $this->baseUrl . "referensi/dpho";
        $signature = $this->signature();
        // dd($signature);
        $response = $client->request('GET', $url, [
            'headers' => $signature,
            'allow_redirects' => true,
            'timeout' => 5
        ]);
        $response = json_decode($response->getBody());
        if ($response->metaData->code == 200) {
            $decrypt = $this->stringDecrypt($signature['decrypt_key'], $response->response);
            $response->response = json_decode($decrypt);
        }
        return $response;
    }
}
