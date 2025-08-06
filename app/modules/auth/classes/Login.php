<?php
namespace app\modules\auth\classes;
use \app\database\DBController;
use \app\modules\delivery\classes\Delivery;
use \app\modules\vendor\classes\Vendor;
use \app\modules\customer\classes\Customer;

class Login
{
    /**
     * parameters{Username,Password,FCMToken}
     *  Description: request for login
     *  Createdby : 
     *  Updates:
     *    07-02-2024 (Angelbert):  Adding the commenting format   
     * 
     */
    function requestLogin($data)
    {

        DBController::logs("Reached request Login");
        $params = array(
            array(":Username", strip_tags($data["Username"])),
            array(":Password", hash("sha256", substr($data["Username"], 0, 1) . strip_tags($data["Password"])))
        );

        $query = "SELECT * FROM Users WHERE Username = :Username AND Password = :Password";

        $res = DBController::sendData($query, $params);

        if ($res && $res['UserID']) {

            $sessionkey = substr(md5(mt_rand()), 0, 32);

            $sessionkeyexpirydatetime = new \DateTime();
            $sessionkeyexpirydatetime->modify('next month');

            $params = array(
                array(":userid", $res['UserID']),
                array(":sessionkey", $sessionkey),
                array(":sessionkeyexpirydatetime", $sessionkeyexpirydatetime->format('Y-m-d H:i:s')),
                array(":ipaddress", $_SERVER['REMOTE_ADDR']),
                array(":isSuccessfull", 1),
                array(":isActive", 1)
            );

            $query = "INSERT INTO LoginDetails(UserID, SessionKey, SessionExpiryDateTime, IPAddress, isSuccessfull, isActive) 
                VALUES (:userid,:sessionkey,:sessionkeyexpirydatetime,:ipaddress,:isSuccessfull,:isActive)";
            if (DBController::ExecuteSQL($query, $params)) {
                $_SESSION['UserID'] = $res['UserID'];
                $_SESSION['SessionKey'] = $sessionkey;
                $_SESSION['Username'] = $data['Username'];
                $_SESSION['UserType'] = $res['UserType'];

                if ($_SESSION['UserType'] == 1) {
                    $nextpage = "dashboard";
                } else if ($_SESSION['UserType'] == 4) { 
                    $nextpage="deodash";
                    // $vendor = new Vendor();
                    // $res = $vendor->getVendorInfo($data);
                    // if ($res) {
                    //     return array("return_code" => true, "return_data" => $res);
                    // } else {
                    //     return array("return_code" => false, "return_data" => "Failed to get vendor info");
                    // }
                } else if ($_SESSION['UserType'] == 3) {//delivery
                    //$nextpage = "user";
                    $delivery = new Delivery();
                    $res = $delivery->getDeliveryInfo($data);
                    if ($res) {
                        return array("return_code" => true, "return_data" =>$res);
                    } else {
                        return array("return_code" => false, "return_data" => "Failed to get delivery info");
                    }
                    
                }
                else if(($_SESSION['UserType'] == 4)) //customer account
                {
                    $customer = new Customer();
                    $res = $customer->getCustomerInfo($data);
                    if ($res) {
                        return array("return_code" => true, "return_data" => $res);
                    } else {
                        return array("return_code" => false, "return_data" => "Failed to get customer info");
                    }
                }
                

                if (isset($data['FCMToken'])) {
                    $params = array(
                        array(":FCMToken", strip_tags($data['FCMToken'])),
                        array(":UserID", $res['UserID'])
                    );
                    $query = "UPDATE Users SET FCMToken=:FCMToken WHERE UserID=:UserID";
                    DBController::ExecuteSQL($query, $params);
                }

                return array("return_code" => true, "return_data" => array("Name" => $res['Name'], "Username" => $data['Username'], "EmailID" => $res['EmailID'], "SessionKey" => $sessionkey, "SessionExpiryDate" => $sessionkeyexpirydatetime->format('Y-m-d H:i:s'), "UserType" => $res['UserType'], "nextPage" => $nextpage));
            }
        }
        return array("return_code" => false, "return_data" =>  "Username or Password does not match");
    }
}
