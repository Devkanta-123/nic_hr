<?php

namespace app\misc;
use app\database\DBController;
use PHPMailer\PHPMailer\Exception;
class SMS
{

    /*
     * $SMSChannel = Channel on which SMS will be send
     * $Message = Message to be sent
     * $MobileNumber= Mobile number of target
     */
	// public static function send($SMSChannel, $Message, $MobileNumber)
	// {
	// 	$messagecount = strlen($Message);
	// 	$mesc = 1;

	// 	while ($messagecount > 154) {
	// 		$mesc = $mesc + 1;
	// 		$messagecount = $messagecount - 154;
	// 	}

	// 	if (is_array($MobileNumber)){

    //         for($i=0;$i<count($MobileNumber);$i++){
    //             $param = array(
    //                 array(":SMS", $Message),
    //                 array(":ContactNo", $MobileNumber[$i]),
    //                 array(":SMSCount", $mesc)
    //             );

    //             $query = "INSERT INTO SMSDetails(SMS, ContactNo, SMSCount) VALUES (:SMS,:ContactNo,:SMSCount);";

    //             $result = DBController::ExecuteSQL( $query, $param);
    //         }
    //         $numbers = $MobileNumber;
    //     }else{
    //         $param = array(
    //             array(":SMS", $Message),
    //             array(":ContactNo", $MobileNumber),
    //             array(":SMSCount", $mesc)
    //         );

    //         $query = "INSERT INTO SMSDetails(SMS, ContactNo, SMSCount) VALUES (:SMS,:ContactNo,:SMSCount);";

    //         $result = DBController::ExecuteSQL( $query, $param);

    //         $numbers=array($MobileNumber);
    //     }

    //     if ($result) {
    //         $postDataJson = json_encode(
    //             array(
    //                 'sender' => $SMSChannel,
    //                 'campaign' => "Test",
    //                 'country' => "91",
    //                 'route' => "4",
    //                 'sms' => array(
    //                     array(
    //                         'message' => $Message,
    //                         'to' => is_array($numbers) ? $numbers : array($numbers)
    //                     )
    //                 )
    //             )
    //         );

    //         $curl = curl_init();
    //         curl_setopt_array($curl, array(
	// 			CURLOPT_URL => "https://api.msg91.com/api/v2/sendsms",
	// 			CURLOPT_RETURNTRANSFER => true,
	// 			CURLOPT_ENCODING => "",
	// 			CURLOPT_MAXREDIRS => 10,
	// 			CURLOPT_TIMEOUT => 30,
	// 			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	// 			CURLOPT_CUSTOMREQUEST => "POST",
	// 			CURLOPT_POSTFIELDS => $postDataJson,
	// 			CURLOPT_SSL_VERIFYHOST => 0,
	// 			CURLOPT_SSL_VERIFYPEER => 0,
	// 			CURLOPT_HTTPHEADER => array(
	// 				"authkey: 154485AI3Y0WVke5b3b12aa",
	// 				"content-type: application/json"
	// 			),
	// 		));

	// 		$response = curl_exec($curl);
	// 		$err = curl_error($curl);

	// 		$response = json_decode($response, true);
	// 		curl_close($curl);

	// 		if ($err == "" && $response['type'] == "success") {
	// 			return true;
	// 		} else {
	// 			return false;
	// 		}
	// 	}else {
	// 		return false;
	// 	}
	// }

    public static function SendSms($flowname, $mobiles,$variables)
    {
        //check if the flow
        //    return true;
        //setup parameter
        $params = array(
            array(":FlowName", $flowname)
        );
        $query= "SELECT SMSID, TemplateID, FlowID, SMSText, SMSVariables, CreatedOn, ModifiedOn FROM SMSTemplate WHERE FlowName=:FlowName ";
        $data =DBController::sendData($query, $params);;
        if ($data){
            $message = $data['SMSText'];
            $param = [
                "flow_id" => $data['FlowID'],
                "recipients" => []
            ];

            foreach($variables as $x => $val)
            {
                $message = str_replace("##".$x."##",$val,$message);
            }

            foreach(explode(",",$mobiles) as $m)
            {
                //check if the Mobile phone number is valid or not  
                $pattern = "/^[0-9]{10}$/";
                if(preg_match($pattern, $m))
                {
                    $recp = [
                        "mobiles"=> "91".substr($m, -10)
                    ];
                    $recp = array_merge($recp, $variables);
                    array_push($param["recipients"],$recp);
                } 
            }

            //check the lenght of $recp 
            if( sizeof($recp)<=0){
                return false; //size of the sms contact numbers is equal to  0
            } 
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.msg91.com/api/v5/flow/',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($param),
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'authkey: 154485AU8JnX9cnIBs61fcf373P1'
                ),
            ));

            $response="";
            //TODO to Change TESTING ONLY
            $response = curl_exec($curl);
            return true;  //only for testing purpose needs to remove this line 
            //end of test
             $smsres = json_decode($response,true);
             $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
                //save message to DB
                DBController::logs($err);
                $emessage= $err;
                return $emessage;
            } else {
                //UPDAYE TO THE DATABASE
            try{

                    $messagecount = strlen($message);
                    $mesc = 1;

                    while ($messagecount > 154) {
                        $mesc = $mesc + 1;
                        $messagecount = $messagecount - 154;
                    }
                    $mobiles=explode(",",$mobiles);
                    for($i=0;$i<count($mobiles);$i++){
                        $param = array(
                            array(":SMS", $message),
                            array(":ContactNo", $mobiles[$i]),
                            array(":SMSCount", $mesc),
                            array(":SessionID",1),
                            array(":UserID",isset($_SESSION['UserID'])? $_SESSION['UserID']:-1),

                        );

                        $query = "INSERT INTO SMSDetails(SMS, ContactNo, SMSCount,SessionID,UserID  ) 
                                VALUES (:SMS,:ContactNo,:SMSCount,:SessionID,:UserID);";
                        $result = DBController::ExecuteSQL( $query, $param);
                    }


            }catch(Exception $e){
                DBController::logs("Unable to save the SMS details to the database");
            }

                return $response;
            }
        }

        return $data;
         $certificate = "C:\cacert\cacert.pem";
    }
}
