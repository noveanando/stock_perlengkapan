<?php

namespace Myber\FirebaseCustom;

use GuzzleHttp\Client;
use DB;

class FirebaseCustom{
    public $tokensender = '';
    public $url = "https://fcm.googleapis.com/fcm/send";
    
    public function __construct()
    {
        $this->tokensender = env('FIREBASE_SERVER_KEY');
    }

    public function pushNotification($array)
    {
        $client = new Client();
        $fieldToken = [];
        if(isset($array['topic'])){
            if($array['topic'] != 'counter'){
                $fieldToken = ['to' => $array['topic']];
            } else {
                $tokens = DB::table('users')
                    ->whereIn('role_id',[1,2,3,10])
                    ->where('fcm_token','!=',null)
                    ->pluck('fcm_token');

                $insert = DB::table('notifications')->insert([
                    'label' => $array['label'],
                    'message' => $array['body'],
                    'status' => '1',
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                $fieldToken = $tokens->count() > 0 ? ['registration_ids' => $tokens] : [];
            }
        } else {
            $tokenTarget = DB::table('users')->select('id','fcm_token')
                ->where('id',$array['user_id'])
                ->first();

            $insert = DB::table('notifications')->insert([
                'user_id' => $array['user_id'],
                'label' => $array['label'],
                'message' => $array['body'],
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s')
            ]);

            if($tokenTarget) $fieldToken = ['to' => $tokenTarget->fcm_token];
        }
        
        if(count($fieldToken) > 0 && env('FIREBASE_STATUS',false) == true){
            $msg = [
                'body'  => $array['body'],
                'title' => $array['label'],
                'icon'=> asset('img/transparent.png')
            ];

            $arrayClick = [];
            if(isset($array['click_action'])){
                $arrayClick = [
                    'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                    'screen' => $array['click_action'],
                    'id' => isset($array['param']) ? $array['param'] : null
                ];
            }
            $dataArr = [
                'body' => $array['body'],
                'title' => $array['label'],
                'prop' => isset($array['prop']) ? $array['prop'] : null
            ];
            $fields = [
                'notification'  => $msg,
                'data' => array_merge($dataArr,$arrayClick),
                'priority'=>'high'
            ];

            try {
                $req = $client->request('POST',$this->url,[
                    'headers' => [
                        'Authorization' => 'key='.$this->tokensender,
                        'Content-Type' => 'application/json'
                    ],
                    'body' => json_encode(array_merge($fieldToken,$fields))
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Push Notification success'
                ],200);
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Push Notification failed'
                ],500);
            }
        }

        return response()->json([
            'status' => 'error',
            'message' => 'fcm token tidak ditemukan'
        ],500);
    }
}