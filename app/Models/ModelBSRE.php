<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Storage;

class ModelBSRE extends Model
{
    use HasFactory;
    // public $baseUrl = 'https://dev.esign-service.cirebonkab.go.id/api/sign/'; dev

    public $baseUrl = 'https://esign-service.cirebonkab.go.id/api/sign/';

    public static function header()
    {
        $response = array(
            'Accept' => '*/*',
            'Accept-Encoding' => 'gzip, deflate, br',
            'Connection' => 'keep-alive',
        );
        return $response;
    }
    public  function cek_status_user($nik)
    {
        $url = 'https://esign-service.cirebonkab.go.id/api/user/status/' . $nik;
        $username = 'rsudwaled';
        $client = new Client();
        $username = 'siramah';
        $password = '$uiS7^hMA%2w';
        try {
            $response = $client->get($url, [
                'auth' => [$username, $password],
                'headers' => [
                    'Accept' => 'application/json',
                    'X-Custom-Header' => 'MyValue',
                ]
            ]);
            // $response = json_decode($response->getBody());
            $code = $response->getStatusCode();
            if ($code == 200) {
                $message = json_decode($response->getBody());
            } else {
                $message = json_decode($response->getBody());
            }
            $data =
                [
                    'code' => $code,
                    'messagee' => $message
                ];
            return $data;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            if ($e->hasResponse()) {
                $errorBody = $e->getResponse()->getBody()->getContents();
                $code = $e->getCode();
                $message = $errorBody;
                $data =
                    [
                        'code' => $code,
                        'messagee' => $message
                    ];
                return $data;
            }
        }
    }
    public function send_pdf_kosong($data2, $kodekunjungan)
    {
        $url = 'https://esign-service.cirebonkab.go.id/api/sign/pdf';
        $url_ttd = auth()->user()->image_ttd;
        $client = new Client();
        // $file1 = fopen(storage_path('app/downloaded_pdfs/' . $kodekunjungan . '.pdf'), 'r');
        $urlfile = '\\\\192.168.2.14\\erm\\resume_medis_rawat_jalan/';
        $file1 = fopen(($urlfile . $kodekunjungan . '.pdf'), 'r');
        // dd($file1);
        $file2 = fopen($url_ttd, 'r');
        $multipart = [
            [
                'name'     => 'file', // Name of the form field for the first file
                // 'contents' => fopen(storage_path('app/downloaded_pdfs/' . $kodekunjungan . '.pdf'), 'r'),
                'contents' => fopen(($urlfile . $kodekunjungan . '.pdf'), 'r'),
                'filename' => 'TST.pdf', // Optional: original filename
            ],
            [
                'name'     => 'imageTTD', // Name of the form field for the second file
                'contents' => fopen($url_ttd, 'r'),
                'filename' => 'ttd.png', // Optional: original filename
            ],
        ];
        // dd($multipart);
        foreach ($data2 as $key => $value) {
            $multipart[] = [
                'name'     => $key,
                'contents' => $value,
            ];
        }
        $username = 'siramah';
        $password = '$uiS7^hMA%2w';
        // $username = 'rsudwaled';
        // $password = 'uwP*aHN2';
        try {
            $response = $client->post($url, [
                'multipart' => $multipart,
                'auth'      => [$username, $password], // Basic Auth
                'headers'   => [
                    'Authorization' => 'Basic cnN1ZHdhbGVkOnV3UCphSE4y',
                    'Cache-Control' => 'no-cache',
                    'Postman-Token' => '<calculated when request is sent>',
                ],
            ]);

            $code = $response->getStatusCode();
            if ($code == 200) {
                $id = $response->getHeader('id_dokumen');
                $message = $id[0];
            } else {
                $message = $response->getBody();
            }
            $data =
                [
                    'code' => $code,
                    'messagee' => $message
                ];
            return $data;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            if ($e->hasResponse()) {
                $errorBody = $e->getResponse()->getBody()->getContents();
                $code = $e->getCode();
                $message = $errorBody;
                $data =
                    [
                        'code' => $code,
                        'messagee' => $message
                    ];
                return $data;
            }
        }
    }
    public function downloadpdf($id_dokumen, $kodekunjungan)
    {
        $url = 'https://esign-service.cirebonkab.go.id/api/sign/download/' . $id_dokumen;
        $client = new Client();
        $pdfPath = Storage::disk('shared')->path($id_dokumen . '.pdf'); // Define the local path
        // $username = 'rsudwaled';
        // $password = 'uwP*aHN2';
        $username = 'siramah';
        $password = '$uiS7^hMA%2w';
        try {
            $response = $client->get($url, [
                'auth'      => [$username, $password], // Basic Auth
                'headers'   => [
                    'Authorization' => 'Basic cnN1ZHdhbGVkOnV3UCphSE4y',
                    'Cache-Control' => 'no-cache',
                    'Postman-Token' => '<calculated when request is sent>',
                ],
                'sink' => $pdfPath,
            ]);
            if ($response->getStatusCode() === 200) {
                $message = "Sukses";
                $code = $response->getStatusCode();
                $data = [
                    'code' => $code,
                    'message' => $message
                ];
                return $data;
            } else {
                $message = "Gagal";
                $code = $response->getStatusCode();
                $data = [
                    'code' => $code,
                    'message' => $message
                ];
                return $data;
            }
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            echo "Error: " . $e->getMessage();
            $message = "Gagal";
            $code = $e->getCode();
            $data = [
                'code' => $code,
                'message' => $message
            ];
            return $data;
        }
    }
    public function send_verifikasi($file, $id)
    {
        $url = 'https://esign-service.cirebonkab.go.id/api/sign/verify';
        $client = new Client();
        // $file1 = fopen(storage_path('app/downloaded_pdfs/' . $kodekunjungan . '.pdf'), 'r');
        $urlfile = '\\\\193.193.193.203\\erm\\resume_medis_rawat_jalan/';
        $file1 = fopen(($file), 'r');
        // dd($file1);
        $multipart = [
            [
                'name'     => 'signed_file', // Name of the form field for the first file
                // 'contents' => fopen(storage_path('app/downloaded_pdfs/' . $kodekunjungan . '.pdf'), 'r'),
                'contents' => fopen(($file), 'r'),
                'filename' => 'TST.pdf', // Optional: original filename
            ]
        ];
        // dd($multipart);
        // $data = db::select('select * from log_ttd_elektronik where id = ?',[$request->id_table]);
        // foreach ($data2 as $key => $value) {
        //     $multipart[] = [
        //         'name'     => $key,
        //         'contents' => $value,
        //     ];
        // }
        // $username = 'rsudwaled';
        // $password = 'uwP*aHN2';
        $username = 'siramah';
        $password = '$uiS7^hMA%2w';
        try {
            $response = $client->post($url, [
                'multipart' => $multipart,
                'auth'      => [$username, $password], // Basic Auth
                'headers'   => [
                    'Authorization' => 'Basic cnN1ZHdhbGVkOnV3UCphSE4y',
                    'Cache-Control' => 'no-cache',
                    'Postman-Token' => '<calculated when request is sent>',
                ],
            ]);

            $code = $response->getStatusCode();
            $body = json_decode($response->getBody());
            if ($code == 200) {
                $code = 200;
                $message = json_decode($response->getBody());
            } else {
                $code = 550;
                $message = $response->getBody();
            }
            $data =
                [
                    'code' => $code,
                    'messagee' => $message
                ];
            return $data;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            if ($e->hasResponse()) {
                $errorBody = $e->getResponse()->getBody()->getContents();
                $code = $e->getCode();
                $message = $errorBody;
                $data =
                    [
                        'code' => $code,
                        'messagee' => $message
                    ];
                return $data;
            }
        }
    }
}
