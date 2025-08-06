<?php
namespace app\modules\settings\classes;
use app\database\DBController;
 
class User
{ 
     /**
     * Description: get all the data of user both active and in active  based on Given  UserType
     * Created By: Angelbert
     * Creted On: 019/02/2024
     * Update:
     *    
     */
    function getUsersList($data)
    {
        if(!isset($data['Usertype']))
        {
            return array("return_code" => false, "return_data" => "Error invalid request");
        }

        $param=array(
            array(":UserType",$data['Usertype'])
        );
        $query="SELECT `UserID`, `Name`, `Username`, `EmailID`, `ContactNo`, `UserType`, `StaffID`, `isActive`, `CreatedDateTime`, `FCMToken`, `SessionID`
        FROM `Users`  WHERE `UserType`=:UserType;";
        $Userlist=DBController::getDataSet($query,$param);
        return array("return_code" => true, "return_data" => $Userlist);
    } 
    
    /**
     * 
     * Description: Update the password of user based on usertype,id and username
     * Created By: Angelbert
     * Creted On: 19/02/2024
     * Update:
     *    
     */
    public function onUserResetPassword($data)
    {
        //check only admin can reset
        if(!isset($_SESSION['UserType']) && $_SESSION['UserType'] !=1 )
        {
            return array("return_code" => false, "return_data" => "Access Denied.Please contact Admin if you think it is a mistake");
        }
        $pwd = rand(100000, 999999);
        $password = hash("sha256", substr($data["u"], 0, 1) . $pwd);
        $params = array(
            array(":UserID", strip_tags($data["id"])),
            array(":Password", $password),
            array(":UserType", strip_tags($data['UserType'])),
            array(":Username", strip_tags($data['u']))
        );

        $query="UPDATE `Users` SET  `Password`=:Password  WHERE `UserID`=:UserID and `UserType`=:UserType and `Username`=:Username";
        $res = DBController::ExecuteSQL($query, $params);
        if($res)
        {
            DBController::logs("New Pasword is - " . $pwd);

            return array("return_code" => true, "return_data" => "New Pasword is - " . $pwd);
        }
        else{
            return array("return_code" => false, "return_data" => " Could not generate New password.Please check and try again.");
        } 
    }

    /**
     * 
     * param :{UserType,UserID,status}
     * Description: changeisActiveStatus based on 
     * Created By: Angelbert
     * Creted On: 19/02/2024
     * Update:
     *    
     */
    public function changeActiveStatus($data)
    {
        if(!isset($_SESSION['UserType']) && $_SESSION['UserType'] !=1 )
        {
            return array("return_code" => false, "return_data" => "Access Denied.Please contact Admin if you think it is a mistake");
        }

        $params = array(
            array(":UserType", strip_tags($data["UserType"])),
            array(":UserID",strip_tags($data["UserID"])),
            array(":status", $data["status"])
        );
        $query="UPDATE `Users` SET `isActive`=:status WHERE `UserID`=:UserID and `UserType`=:UserType";
        $res = DBController::ExecuteSQL($query, $params);
        if($res)
        {
            return array("return_code" => true, "return_data" => "Status updated");
        }
        else
        {
            return array("return_code" => false, "return_data" => "Failed to update status");
        }
       
    }

}



?>

