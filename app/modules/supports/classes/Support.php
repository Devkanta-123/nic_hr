<?php

namespace app\modules\supports\classes;
use app\database\DBController;
use app\misc\FCM;
use app\misc\SMS;
use app\modules\settings\classes\Session;

class Support{
    

   
    function sentotp($data)
    {
    
    
        //get  API (based on ID)
        //generate secret key
    
        // send to API
        //return thr reult getting from API
    
    
         // Prepare array
        //  array(":Contact", strip_tags($data["PhoneNumber"]));
     $params=array(
        array(":ClientSubscriptionID", (int)strip_tags($data["ClientSubscriptionID"]))
    ); 
        $query="SELECT `ClientSubscriptionID`,`API`
        FROM `ClientSubscriptions` 
        WHERE `ClientSubscriptionID`=:ClientSubscriptionID;";   
        $notices = DBController::sendData($query,$params);
        if ($notices) {
            $API = $notices['API'];
            $data= array(
                "Module" => "publics",
                "Page_key" => "getUserInfoBasedOnContact",
                "JSON" => array(
                    "Contact" => strip_tags($data['PhoneNumber']),
                    "Key" => "Test123"
                ),
                "MSC" => "751d31dd6b56b26b29dac2c0e1839e34"
            );
            //Key,Contact
            // Convert the array to JSON format
            $json = json_encode($data);
            $api_url = $API; //static for testing
            $ch = curl_init($api_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($json)
            ));
    
            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                // echo 'Error: ' . curl_error($ch);
            } else {
                // echo $response;
            }
            curl_close($ch);
            $response = json_decode($response);
            
            if($response->return_code == true)
                return array("return_code" => true, "return_data" =>  $response->return_data);
            else
                return array("return_code" => false, "return_data" =>  "Not associated with this number.");
    
        }
        return array("return_code" => false, "return_data" => "No Data for Client Subscription!");
    }

}
