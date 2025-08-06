<?php
namespace app\modules\settings\classes;
use \app\database\DBController;

class Office{

    function getAllOffice() {
        $query = "SELECT * FROM `Settings_Office`;";
        $res = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $res);
    }

    // function getOfficeByID($data)
    // {

    //     $param=array(
    //         array(":OfficeID",$data['OfficeID'])
    //     );
    //     //for staff QR Code
    //     if($data['Mode']==1)
    //     {
    //         $query = "SELECT so.`OfficeID`, so.`OfficeName`, so.`Latitude`, so.`Longitude`, so.`isActive`, so.`ContactNo`, so.`ContactPerson`, so.`OfficeTiming`, so.`StaffQRCode` as QRCode, so.`PinCode`, so.`Landmark`, so.`EmailID`,st.StateName,sd.DistrictName,sc.CityName FROM `Settings_Office` so
    //         INNER JOIN Settings_State  st on st.StateID=so.StateID
    //         INNER JOIN Settings_District sd on sd.DistrictID=so.DistrictID
    //         INNER JOIN Settings_City sc on sc.CityId=so.CityID
    //         WHERE OfficeID = :OfficeID;";
    //     }
    //      //for Intern QR Code
    //     else if($data['Mode']==2){
           
    //         $query = "SELECT so.`OfficeID`, so.`OfficeName`, so.`latitude`, so.`longitude`, so.`isActive`, so.`ContactNo`, so.`ContactPerson`, so.`OfficeTiming`, so.`InternQRCode` as QRCode, so.`PinCode`, so.`Landmark`, so.`EmailID`,st.StateName,sd.DistrictName,sc.CityName FROM `Settings_Office` so
    //         INNER JOIN Settings_State  st on st.StateID=so.StateID
    //         INNER JOIN Settings_District sd on sd.DistrictID=so.DistrictID
    //         INNER JOIN Settings_City sc on sc.CityId=so.CityID
    //         WHERE OfficeID = :OfficeID;";
    //     }
    //     else{
    //         return array("return_code" => false, "return_data" => "Invalid request");
    //     }
    //     $res = DBController::sendData($query,$param);
    //     return array("return_code" => true, "return_data" => $res);
    // }

    function getOfficeByID($data)
    {

        $param=array(
            array(":OfficeID",$data['OfficeID'])
        );
        //for staff QR Code
        if($data['Mode']==1)
        {
            $query = "SELECT so.`OfficeID`, so.`OfficeName`, so.`Latitude`, so.`Longitude`, so.`isActive`, so.`ContactNo`, so.`ContactPerson`, so.OfficeTimIN,so.OfficeTimeOut, so.`StaffQRCode` as QRCode, so.`PinCode`, so.`Landmark`, so.`EmailID`,st.StateName,sd.DistrictName,sc.CityName FROM `Settings_Office` so
            INNER JOIN Settings_State  st on st.StateID=so.StateID
            INNER JOIN Settings_District sd on sd.DistrictID=so.DistrictID
            INNER JOIN Settings_City sc on sc.CityId=so.CityID
            WHERE OfficeID = :OfficeID;";
        }
         //for Intern QR Code
        else if($data['Mode']==2){
           
            $query = "SELECT so.`OfficeID`, so.`OfficeName`, so.`Latitude`, so.`Longitude`, so.`isActive`, so.`ContactNo`, so.`ContactPerson`, so.OfficeTimIN,so.OfficeTimeOut, so.`StaffQRCode` as QRCode, so.`PinCode`, so.`Landmark`, so.`EmailID`,st.StateName,sd.DistrictName,sc.CityName FROM `Settings_Office` so
            INNER JOIN Settings_State  st on st.StateID=so.StateID
            INNER JOIN Settings_District sd on sd.DistrictID=so.DistrictID
            INNER JOIN Settings_City sc on sc.CityId=so.CityID
            WHERE OfficeID = :OfficeID;";
        }
        else{
            return array("return_code" => false, "return_data" => "Invalid request");
        }
        $res = DBController::sendData($query,$param);
        return array("return_code" => true, "return_data" => $res);
    }
}


