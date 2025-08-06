<?php

namespace app\modules\staff\classes;

include '../../app/database/DBController.php';
include '../../app/misc/SMS.php'; 

use app\database\DBController;
use app\misc\SMS;

// Query to get active schools
$query = "SELECT c.isActive, cs.API FROM `Clients` c 
INNER JOIN ClientSubscriptions cs ON cs.ClientID = c.ClientID WHERE IFNULL(c.isActive,0) =1";
$res = DBController::getDataSet($query);

$activeSchools = [];
foreach ($res as $row) {
    $parsedUrl = parse_url($row['API']);
     $baseUrl = 'https://' . $parsedUrl['host'] . '/api/birthdaywishes.php';
    array_push($activeSchools, $baseUrl);
}
 

foreach ($activeSchools as $apiUrl) {
    $ch = curl_init($apiUrl);

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return response as a string
    curl_setopt($ch, CURLOPT_HEADER, true); // Include headers in the output
    curl_setopt($ch, CURLOPT_NOBODY, true); // Exclude the body of the response 
    // Execute cURL request
    $response = curl_exec($ch); 
    // Close cURL session
    curl_close($ch);
}

 // send Birthday reminder message to our staff
 $sq=" SELECT s.ContactNo  FROM `Staff` s  INNER JOIN Users u ON u.StaffID = s.StaffID WHERE IFNULL(u.isActive,0) = 1 AND  Date_Format(s.DOB,'%m-%d')=Date_Format(CURDATE(),'%m-%d');";
 $res = DBController::getDataSet($sq);

 if($res){
        foreach($res as $staff){
            $sms_return = SMS::SendSms("PrayagEduBirthdayWishOne",$staff['ContactNo'],  
              ["organizaton" => "Iewduh Techz"]
      );  
    }
 }

 echo true; 

?>
