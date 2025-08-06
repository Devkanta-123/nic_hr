<?php
/* 
    Current Version: 1.0.0
    Created By: Devkanta,     dev1@techz.in
    Created On: 19/01/2024
    Modified By:
    Modified On: 

*/

namespace app\modules\staff\classes;

use app\database\DBController;
use app\modules\auth\classes\Signup;

class Intern
{

    function addIntern($data)
    {
        if (isset($data["StaffInternID"])) { //update  
            $image_info = getimagesize($data["Photo"]);
            $Photo = uniqid("PP") . "." . (isset($image_info["mime"]) ? explode('/', $image_info["mime"])[1] : "");
            file_put_contents("../app/data/temp/" . $Photo, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data["Photo"])));
            $params = array(
                array(":StaffInternID", $data["StaffInternID"]),
                array(":StaffInternName", $data["StaffInternName"]),
                array(":Contact", $data["Contact"]),
                array(":Email", $data["Email"]),
                array(":Gender", $data["Gender"]),
                array(":DOB", $data["Dob"]),
                array(":Address", $data["Address"]),
                array(":ReligionID", $data["ReligionID"]),
                array(":CasteCode", $data["CasteCode"]),
                array(":CommunityID", $data["CommunityID"]),
                array(":NationalityID", $data["NationalityID"]),
                array(":CategoryID", $data["CategoryID"]),
                array(":Photo", $Photo ?? NULL),
                array(":StartDate", $data["JoiningDate"]),
                array(":BloodGroup", $data["BloodGroup"]),
                array(":RFIDcardNo", $data["RfidNo"]),
            );

            $query = "UPDATE `Staff_Intern` SET `StaffInternName`=:StaffInternName, `ContactNo`=:Contact, `EmailID`=:Email, `GenderCode`=:Gender, `DOB`=:DOB, `Address`=:Address,  ReligionID=:ReligionID, CasteCode=:CasteCode, CommunityID=:CommunityID, NationalityID=:NationalityID, `Photo`=:Photo,`CategoryID`=:CategoryID, `StartDate`=:StartDate,`BloodGroup`=:BloodGroup, `RFIDcardNo`=:RFIDcardNo WHERE `StaffInternID`=:StaffInternID";

            $res = DBController::ExecuteSQL($query, $params);

            if ($res) {
                return array("return_code" => true, "return_data" => "Record Updated successfully");
            } else {
                return array("return_code" => false, "return_data" => " Error while Updating  the data");
            }
        } else {

            if (isset($data["Photo"])) {
                $image_info = getimagesize($data["Photo"]);
                $Photo = uniqid("PP") . "." . (isset($image_info["mime"]) ? explode('/', $image_info["mime"])[1] : "");

                file_put_contents("../app/data/temp/" . $Photo, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data["Photo"])));
            }

            //prepare array 
            $params = array(
                array(":StaffInternName", $data["StaffInternName"]),
                array(":Contact", $data["Contact"]),
                array(":Email", $data["Email"]),
                array(":Gender", $data["Gender"]),
                array(":DOB", $data["Dob"]),  // Changed to ":DOB"
                array(":Address", $data["Address"]),
                array(":ReligionID", $data["ReligionID"]),
                array(":CasteCode", $data["CasteCode"]),
                array(":CommunityID", $data["CommunityID"]),
                array(":CategoryID", $data["CategoryID"]),
                array(":NationalityID", $data["NationalityID"]),
                array(":Photo", $Photo ?? NULL),
                array(":StartDate", $data["JoiningDate"]),  // Changed to ":StartDate"
                array(":BloodGroup", $data["BloodGroup"]),
                array(":RfidNo", $data["RfidNo"]),


            );

            $query = "INSERT INTO `Staff_Intern`(`StaffInternName`, `ContactNo`, `EmailID`, `GenderCode`, `DOB`, `Address`,  ReligionID, CasteCode, CommunityID, NationalityID,`Photo`, `CategoryID`, `StartDate`, `BloodGroup`, `RFIDcardNo`)   
                      VALUES (:StaffInternName, :Contact, :Email, :Gender, :DOB, :Address,:ReligionID, :CasteCode, :CommunityID, 
         :NationalityID,:Photo,:CategoryID, :StartDate, :BloodGroup, :RfidNo)";
            $InternID = DBController::ExecuteSQLID($query, $params);
            $user   =   array(
                "Username" => $data["Contact"],
                "Name" => $data["StaffInternName"],
                "ContactNo" => $data["Contact"],
                "EmailID" => $data["Email"],
                "StaffID" =>  $InternID,
                "UserType" => 3,
                "ValidateUsernameOnly" =>  True
            );
            //create user
            $userdata = (new Signup())->request($user);
            $isCreated = false;
            $giveup = 0;
            if ($userdata["return_code"] == false) {

                while ($isCreated == false) {
                    $user["Username"] = $data["ContactNo"] . rand(0, 100);
                    $userdata = (new Signup())->request($user);
                    if ($userdata["return_code"] == true) {
                        $isCreated = true;
                    }
                    $giveup += 1;
                    if ($giveup == 20) break;
                }
            } // end of creation of username

            //DBController::logs("sucessFully added Staff");
            return array("return_code" => true, "return_data" => "Successfully Created");
        }

        return array("return_code" => false, "return_data" => " Error while saving the data");
    }


    /*  Info:
        Description: get the basic detail of   all Active intern 
            01-01-24 (Added By Dev)
           Last Update 2-02-2024  : Update the Query (Angelbert)
    */
    function getInternList()
    {
        $query = "SELECT si.StaffInternID,si.StaffInternName,si.ContactNo,si.DOB,si.EmailID,si.StartDate,si.Address,si.ReligionID,si.CasteCode,si.CommunityID,si.NationalityID,si.Photo,si.RFIDcardNo,sr.Religion,sn.NationalityName,ic.InternCategoryID,ic.CategoryName
        FROM `Staff_Intern` as si 
        INNER JOIN Settings_Religion  sr ON   si.ReligionID = sr.ReligionID
        INNER JOIN Settings_Nationality sn ON si.NationalityID = sn.NationalityID
        INNER JOIN Intern_Category ic   ON ic.InternCategoryID = si.CategoryID
        WHERE si.isRemoved=0;";
        $res = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $res);
    }



    /*  Info:
        Description: Delete the Intern Records Based On selected ID
            15-01-24 (Added By Dev)
         
    */

    function deleteStaffIntern($data)
    {
        $params = array(
            array(":StaffInternID", $data["StaffInternID"]),
        );
        $query = "  DELETE FROM `Staff_Intern` where `StaffInternID`=:StaffInternID;";
        $res = DBController::ExecuteSQL($query, $params);
        return array("return_code" => true, "return_data" => "Sucessfully Removed the  Record");
    }

    /*  Info:
        Description: get all the Intern Categories like App and Web Dev.
            15-01-24 (Added By Dev)
         
    */

    function getInternCategories()
    {
        $query = "SELECT `InternCategoryID`,`CategoryName` FROM `Intern_Category`;";
        $res = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $res);
    }


    /*  Info:
        Description: Update the Interns Records on change of partiluar fields
            30-01-24 (Added By Dev)
         
    */

    function updateInternInfo($data)
    {

        // if (!isset($data['Id'])) {
        //     return array("return_code" => false, "return_data" => "Unable to update Data");
        // }

        // array(":Field",$data['Field']),
        $param = array(
            array(":Data", strip_tags($data['Data'])),
            array(":StaffInternID", strip_tags($data['StaffInternID']))
        );

        switch ($data['Field']) {
            case "StaffInternName":

                $query = "UPDATE `Staff_Intern` SET `StaffInternName`=:Data WHERE `StaffInternID` =:StaffInternID";
                break;

            case "DOB":
                $query = "UPDATE `Staff_Intern` SET DOB=:Data WHERE `StaffInternID`=:StaffInternID";
                break;

            case "Photo":
                $image_info = getimagesize($data["Data"]);
                $Photo = uniqid("PP") . "." . (isset($image_info["mime"]) ? explode('/', $image_info["mime"])[1] : "");
                file_put_contents("../app/data/temp/" . $Photo, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data["Photo"])));
                $query = "UPDATE `Staff_Intern` SET Photo=:Photo WHERE `StaffInternID`=:StaffInternID";
                break;


            case "StartDate":
                $query = "UPDATE `Staff_Intern` SET StartDate=:Data WHERE `StaffInternID`=:StaffInternID";
                break;

            case "ContactNo":
                $query = "UPDATE `Staff_Intern` SET ContactNo=:Data WHERE `StaffInternID`=:StaffInternID";
                break;

            case "EmailID":
                $query = "UPDATE `Staff_Intern` SET EmailID=:Data WHERE `StaffInternID`=:StaffInternID";
                break;

            case "GenderCode":
                $query = "UPDATE `Staff_Intern` SET GenderCode=:Data WHERE `StaffInternID`=:StaffInternID";
                break;
            case "ReligionID":
                $query = "UPDATE `Staff_Intern` SET ReligionID=:Data WHERE `StaffInternID`=:StaffInternID";
                break;

            case "CasteCode":
                $query = "UPDATE `Staff_Intern` SET CasteCode=:Data WHERE `StaffInternID`=:StaffInternID";
                break;

            case "CommunityID":
                $query = "UPDATE `Staff_Intern` SET CommunityID=:Data WHERE `StaffInternID`=:StaffInternID";
                break;

            case "NationalityID":
                $query = "UPDATE `Staff_Intern` SET NationalityID=:Data WHERE `StaffInternID`=:StaffInternID";
                break;

            case "RFIDcardNo":
                $query = "UPDATE `Staff_Intern` SET RFIDcardNo=:Data WHERE `StaffInternID`=:StaffInternID";
                break;

            case "Address":
                $query = "UPDATE `Staff_Intern` SET Address=:Data WHERE `StaffInternID`=:StaffInternID";
                break;

            case "CategoryID":
                $query = "UPDATE `Staff_Intern` SET CategoryID=:Data WHERE `StaffInternID`=:StaffInternID";
                break;


            default:
                return array("return_code" => false, "return_data" => "Invalid data to update ");
        }

        $updateName = DBController::ExecuteSQL($query, $param);
        if ($updateName) {
            return array("return_code" => true, "return_data" => "Sucessfully Updated");
        } else {
            return array("return_code" => false, "return_data" => "Unable to update the data");
        }
    }
}
