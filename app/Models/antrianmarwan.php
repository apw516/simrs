<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;


class antrianmarwan extends Model
{
    public static function header()
    {
        $response = array(
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Accept' => '*/*',
            'Connection' => 'keep-alive'
        );
        return $response;
    }
    public function ambilantrean($data_antrian)
    {
        $client = new Client();
        $header = $this->header();
        $url = 'http://192.168.2.30/simrs/api/wsrs/ambil_antrian';
        try{
            $response = $client->request('POST', $url, [
                'headers' => $header,
                'form_params' => $data_antrian
                ]);
            $response = json_decode($response->getBody());
            return $response;
        }catch(ClientException){
            return 'RTO';
        }
    }
    public function batalantrian($data_batal_antrian)
    {
        $client = new Client();
        $header = $this->header();
        $url = 'http://192.168.2.30/simrs/api/wsrs/batal_antrian';
        try{
            $response = $client->request('POST', $url, [
                'headers' => $header,
                'form_params' => $data_batal_antrian
                ]);
            $response = json_decode($response->getBody());
            return $response;
        }catch(ClientException){
            return 'RTO';
        }
    }
    public function update_antrian($taskid)
    {
        $client = new Client();
        $header = $this->header();
        $url = 'http://192.168.2.30/simrs/api/wsrs/update_antrean_pendaftaran';
        try{
            $response = $client->request('POST', $url, [
                'headers' => $header,
                'form_params' => $taskid
                ]);
            $response = json_decode($response->getBody());
            return $response;
        }catch(ClientException){
            return 'RTO';
        }
    }
    // function antrian2($data_antrian)
    // {
    //     $client = new \GuzzleHttp\Client(['base_uri' =>'https://app.rsudwaled.id']);
    //     $data = json_encode($data_antrian);
    //     $detail = $client->post(
    //         '/api/ambilantrean',
    //         [/*'debug'=>'false',this is debug line*/
    //             'headers' => [
    //                 'Content-Type' => '',
    //                 'Accept' => 'application/json'
    //             ],
    //             'body' => $data,
    //         ]);
    //         $response = json_decode($detail->getBody());
    //         dd($response);
    // }
}
