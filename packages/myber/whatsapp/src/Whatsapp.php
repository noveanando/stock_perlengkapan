<?php

namespace Myber\Whatsapp;

use GuzzleHttp\Client;

class Whatsapp
{
    public $token; //token generate dari menu Administrasi -> Token
	public $url='http://wa.magiclaundryindonesia.com:11011/actions/aaa_api_kirim.php'; //sesuikan dengan host / alamat IP dari WApiKu 3
    
    public function __construct()
    {
        $this->token = env('WHATSAPP_TOKEN');
    }

    public function sendText($phoneNumber, $text, $media = '')
    {
        if(preg_match("/^0/i", $phoneNumber)){
            $phoneNumber = preg_replace("/^0/i", '', $phoneNumber);
        }
        
        $phoneNumber = (string)'62'.(int)$phoneNumber;
        $data = [
            "id_jenis_kirim"		=> 4, //4=PESAN SAJA, 5=GAMBAR & PESAN, 6=BERKAS SAJA
            "nomor_pengirim_kirim"	=> '6281382333082', //*=NOMOR BERAPA SAJA YG KIRIM, KALO MAU SET NO. PENGIRIM TERTENTU, AWALI 62
            "nomor_tujuan_kirim"	=> $phoneNumber,
            "token_pengguna"		=> $this->token,
            "pesan_kirim"			=> $text,
            "gambar_kirim"			=> '',
            "file_kirim"			=> '',
            "base64_string"			=> ''
        ];
        
        if($media){
            $data['gambar_kirim'] = 'media.jpg';
            $data["base64_string"] = $media;
            $data["id_jenis_kirim"] = 5;
        }

        $res = $this->send($data);
        return $res;
    }

    public function send($body)
    {
        if(env('WHATSAPP_STATUS',false) == true){
            $client = new Client();
            try {
                $req = $client->request('POST',$this->url,[
                    'form_params' => $body
                ]);
                
                return json_decode($req->getBody()->getContents());
            } catch (\Throwable $th) {
                return [
                    'status' => 'error',
                    'message' => 'Terdapat masalah dalam pengiriman'
                ];
            }
        } else {
            return [
                'status' => 'error',
                'message' => 'kirim whatsapp tidak aktif'
            ];
        }
    }
}