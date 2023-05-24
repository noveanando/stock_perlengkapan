<?php

namespace Myber\MidtransCustom;

use GuzzleHttp\Client;

class MidtransCustom{

    public $headers = [];
    public $urlPayment;
    public $urlStatus;
    public $urlCancel;
    
    public function __construct()
    {
        $key = env('MIDTRANS_SERVER_KEY_SANDBOX').':';
        $base = 'https://api.sandbox.midtrans.com/v2';
        if(env('MIDTRANS_PRODUCTION',false) == true){
            $base = 'https://api.midtrans.com/v2';
            $key = env('MIDTRANS_SERVER_KEY').':';
        }

        $this->urlPayment = $base.'/charge';
        $this->urlStatus = $base.'/{order_id}/status';
        $this->urlCancel = $base.'/{order_id}/cancel';

        $this->headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Basic '.base64_encode($key),
            'Content-Type' => 'application/json'
        ];
    }

    public function transferPayment($user,$transaction,$bank)
    {
        $customer = [
            "email" => $user->email,
            "first_name" => $user->name,
            "last_name" => $user->address,
            "phone" => $user->phone
        ];
        
        $bankTransfer = [];
        if(in_array($bank, ['bca','bri','bni'])){
            $bankTransfer = [
                "bank_transfer" => [
                    "bank" => $bank
                ]
            ];
        } else {
            $bankTransfer = [
                "echannel" => [
                    "bill_info1" => "Payment For:",
                    "bill_info2" => "Transaction"
                ]
            ];
        }
        
        $body = [
            "payment_type" => $bank == 'mandiri' ? 'echannel' : "bank_transfer",
            "transaction_details" => [
                "order_id" => $transaction->code,
                "gross_amount" => (int)$transaction->price
            ],
            "customer_details" => $customer
        ];
        
        $merge = array_merge($body,$bankTransfer);

        $res = $this->post($merge, $this->urlPayment);
        return $res;
    }
    
    public function statusTransaction($orderId)
    {
        $newUrl = str_replace('{order_id}',$orderId,$this->urlStatus);
        $res = $this->get($newUrl);
        return (object)$res;
    }
    
    public function cancelTransaction($orderId)
    {
        $newUrl = str_replace('{order_id}',$orderId,$this->urlCancel);
        $res = $this->post([],$newUrl);
        return (object)$res;
    }
    
    public function post($body,$url)
    {
        if(env('MIDTRANS_STATUS',false) == true){
            $client = new Client();
            try {
                $req = $client->request('POST',$url,[
                    'headers' => $this->headers,
                    'body' => json_encode($body)
                ]);
                
                return json_decode($req->getBody()->getContents());
            } catch (\Throwable $th) {
                return [
                    'status' => 'error',
                    'message' => 'Terdapat masalah dalam pengiriman'
                ];
            }
        }

        return [
            'status' => 'error',
            'message' => 'Midtrans tidak aktif'
        ];
    }

    public function get($url)
    {
        if(env('MIDTRANS_STATUS',false) == true){
            $client = new Client();
            try {
                $req = $client->request('GET',$url,[
                    'headers' => $this->headers,
                ]);
                
                return json_decode($req->getBody()->getContents());
            } catch (\Throwable $th) {
                return [
                    'status' => 'error',
                    'message' => 'Terdapat masalah dalam pengiriman'
                ];
            }
        }

        return [
            'status' => 'error',
            'message' => 'Midtrans tidak aktif'
        ];
    }
}