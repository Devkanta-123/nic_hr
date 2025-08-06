<?php

namespace app\modules\settings\classes;

use app\modules\auth\classes\Users;
use \app\database\DBController;
use \app\misc\FCM;
use \app\modules\notification\classes\Notification;


class Log
{
    function clearLog($data)
    {
        $file = "../log.txt";
        if (file_exists($file)) {
            $fh = fopen($file, 'w');
            fclose($fh);
            return array("return_code" => true, "return_data" => "Logs cleared!");
        } else {
            return array("return_code" => false, "return_data" => "No file found"); 
        }
    }
    function testFunction(){ 
  
        $tokens=array(); 
        $NotificationUsers=array();

       
        array_push($tokens, 'ee2AsiMEC0E0k1NSewuZeD:APA91bFQD5xDymdJdCaar3koSpKHGoImmvDQq6zRKv01CQJpEB7fYRz9wFvp3sRIwxuISfwiaYOA5gyqxvkvNUhZUX7rHkUCss-SYAEzC_XNKA3piW0YtXi4dsmRf8PmG9nv-UUsVdrr');
        array_push($NotificationUsers,599); 
        array_push($tokens, 'fo7cMrsgSwOWaZOhNjIKax:APA91bEYE3odabl7C455JVok-IHkcbA2aYNWl0e40deoqyJ9CSZYnRxSCULXDNeLvnngWxySwFIxZv3V7rkD16oZCSTZt7901g-cxGNZwcvz5yrDN4YLGfWzKD1wMtgFiMf6ca-_XqCK');
        array_push($NotificationUsers,600); 

            $param = [
            'NotificationType' => "NOTICE",
            'Users' => $NotificationUsers,
            'FCMToken' => $tokens, 
            'Message' => 'Testing Notification for Multiple Users ',
            'RefID' =>  -1,
        ];
       //(new Notification())->saveNotification($param);  

         return ["return_code" => false, "return_data" => "processed"]; 

    }

    //staffID,StudentsID,userID
    static function UserEvent($data)
    {
        // //there is no UserID pass as parameter
        // if(!isset($data["UserID"])){
        //     $data["UserID"]= $_SESSION['UserID'];  //not by the admin   
        //     $user = (new Users())->getUser(); 
        //     $user=$user['return_data'];

        // }else{
        //     $user = (new Users())->getUser();
        //     $user=$user['return_data'];
        // }

        // $param=array(
        //     array(":Module",$data["Module"]),
        //     array(":Details",$data["Details"]),  //.$user['Name']
        //     array(":UserID",$data["UserID"]),
        //     array(":SessionID", Session::getCurrentSession()["return_data"]["AcademicsSessionID"])
        // );

        // $query="INSERT INTO `Users_Events`(`Module`,`Details`,`UserID`,`SessionID`) VALUES (:Module,:Details,:UserID,:SessionID)";
        // $res=DBController::ExecuteSQL($query,$param);

    }

}
