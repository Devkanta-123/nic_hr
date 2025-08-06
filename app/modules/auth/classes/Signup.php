<?php

/**  Current Version: 1.0.0
 *  Createdby : Angelbert (01/02/2024)
 *  Created On:
 *  Modified By: 
 *  Modified On:
 */

namespace app\modules\auth\classes;

use app\database\DBController;
use app\misc\SMS;

class Signup
{
    /**
     * parameters{Username,Name,ContactNo,EmailID,StaffID(used both for Staff and Intern),UserType,ValidateUsernameOnly}
     *  Description: request for SignUp
     *  Createdby : Angelbert (01/02/2024)
     *  Updates:
     *    07-02-2024 (Angelbert):  Adding the commenting format   
     * 
     */
    function request($data)
    {
        //check only based on UserName
        if (isset($data["ValidateUsernameOnly"]) &&  $data["ValidateUsernameOnly"] == true) {
            $user = (new Users())->isUsernameExists($data);
            if ($user["return_code"] == true) {
                return array("return_code" => false, "return_data" => "UserExists");
            }
        } else {
            // check based on {EmailID and ContactNo}
            $user = (new Users())->exists($data);
            $user = $user['return_data'];

            if ($user) {
                if ((isset($user["EmailID"]) && ($user["EmailID"] == $data["EmailID"])) && (isset($user["ContactNo"]) && ($user["EmailID"] == $data["EmailID"]))) {
                    return array("return_code" => false, "return_data" =>  "EmailID and Contact No Already Exists!!", "ExistsType" => 3);
                } elseif (isset($user["EmailID"]) && ($user["EmailID"] == $data["EmailID"])) {
                    return array("return_code" => false, "return_data" =>  "EmailID Already Exists!!", "ExistsType" => 2);
                } elseif (isset($user["ContactNo"]) && ($user["ContactNo"] == $data["ContactNo"])) {
                    return array("return_code" => false, "return_data" =>  "Contact No Already Exists!!", "ExistsType" => 1);
                }
            }
        }

        $password = rand(100000, 999999);
        $isActive = false;
        if (!isset($data["UserType"])) {
            $data["UserType"] = 3;
            $isActive = true;
        }
        if (isset($data['VendorID'])) {
            $params = array(
                array(":Name", strip_tags($data["Name"])),
                array(":Username",  strip_tags($data["Username"])),
                array(":Password", hash("sha256", substr($data["Username"], 0, 1) . $password)),
                array(":EmailID", strip_tags($data["EmailID"])),
                array(":ContactNo", strip_tags($data["ContactNo"])),
                array(":UserType", strip_tags($data["UserType"])),
                array(":VendorID", strip_tags($data["VendorID"])),
                array(":isActive", 1),
                array(":SessionID", 1),
            );
            $query = "INSERT INTO `Users`(`Name`, `Username`, `Password`, `EmailID`, `ContactNo`, `UserType`, VendorID, `isActive`, `SessionID`)
    VALUES (:Name,:Username,:Password,:EmailID,:ContactNo,:UserType,:VendorID,:isActive,:SessionID)";
        } else if (isset($data['PersonalID'])) {
            $params = array(
                array(":Name", strip_tags($data["Name"])),
                array(":Username",  strip_tags($data["Username"])),
                array(":Password", hash("sha256", substr($data["Username"], 0, 1) . $password)),
                array(":EmailID", strip_tags($data["EmailID"])),
                array(":ContactNo", strip_tags($data["ContactNo"])),
                array(":UserType", strip_tags($data["UserType"])),
                array(":DeliveryPersonalID", strip_tags($data["PersonalID"])),
                array(":isActive", 1),
                array(":SessionID", 1),
            );
            $query = "INSERT INTO `Users`(`Name`, `Username`, `Password`, `EmailID`, `ContactNo`, `UserType`, DeliveryPersonalID, `isActive`, `SessionID`)
    VALUES (:Name,:Username,:Password,:EmailID,:ContactNo,:UserType,:DeliveryPersonalID,:isActive,:SessionID)";
        }
        //customer
        else if (isset($data['CustomerID'])) {
            $params = array(
                array(":Name", strip_tags($data["Name"])),
                array(":Username",  strip_tags($data["Username"])),
                array(":Password", hash("sha256", substr($data["Username"], 0, 1) . $password)),
                array(":EmailID", strip_tags($data["EmailID"])),
                array(":ContactNo", strip_tags($data["ContactNo"])),
                array(":UserType", strip_tags($data["UserType"])),
                array(":CustomerID", strip_tags($data["CustomerID"])),
                array(":isActive", 1),
                array(":SessionID", 1),
            );
            $query = "INSERT INTO `Users`(`Name`, `Username`, `Password`, `EmailID`, `ContactNo`, `UserType`, CustomerID, `isActive`, `SessionID`)
    VALUES (:Name,:Username,:Password,:EmailID,:ContactNo,:UserType,:CustomerID,:isActive,:SessionID)";
        }



        $array = DBController::ExecuteSQLID($query, $params);
        if ($array) {
            // DBController::logs("New user created :" . $data["Name"]);
            DBController::logs("New User Created UserName ::: " . $data["Username"] . " Password :::" . $password);
            //DISABLE
            //check if SMS is enable (USER SMS) 

            //     SMS::SendSms("Signup", $data["ContactNo"],
            //     [
            //         "personname" => $data["Name"],
            //         "applicationname" => "NIC HR/Portal",
            //         "username" =>   $data["Username"]  ,
            //         "password" =>   $password,
            //         "regards" =>  "NIC HR"
            //     ]
            // );

            return array("return_code" => true, "return_data" => "User Successfully Created","message" =>"Username :"  . $data['Username'] . " Password  :"  .  $password);
        }
    }

    function  createUser($data)
    {
        //$usernameparam =   array(":Username" => $data["Username"]);
        $user = (new Users())->isUsernameExists($data);
        $user = $user['return_data'];
        if ($user) {
            return array("return_code" => false, "return_data" => "UserExists");
        }
    }
}
