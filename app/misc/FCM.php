<?php

namespace app\misc;
class FCM
{
    private static $ServerKey ='AAAAqGlAh8M:APA91bEANUM5GMoqes1wULpTit_l3JRVOXVd1rccvwNgoIQA3NZZ3Ewq9QrFd-MGih8sWuCC1MXKlFYghIxetVnEtc_ni1A96zlbYnByMF64bfmd8De9pzVm6sOyv1r49jmj2NEVkFlG';

    public static function pushNotification($target, $title, $body, $vibrate=1, $sound=1)
    {
        $fields = array();

        // prepare the message
        $fields['data'] = array(
            'title'     => $title,
            'body'      => $body,
            'vibrate'   => $vibrate,
            'sound'      => $sound
        );

        if(is_array($target)){
            $NumOfTimes = array_chunk($target,999);
            $result = true;
            for ($i=0; $i<count($NumOfTimes); $i++){
                $fields['registration_ids'] = $NumOfTimes[$i];

                $result = self::send($fields);
            }
        }else{
            $fields['to'] = $target;

            $result = self::send($fields);
        }
        return $result;
    }

    private static function send($fields){
        //FCM api URL
        $url = 'https://fcm.googleapis.com/fcm/send';
        //header with content_type api key
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key='.self::$ServerKey
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);

        if ($result === FALSE) {
            return FALSE;
        }

        return $result;
    }
}
