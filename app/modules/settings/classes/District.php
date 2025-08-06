<?php

namespace app\modules\settings\classes;

use \app\database\DBController;

class District
{
    function getAllDistrict($data)
    {
        $query = "SELECT sd.`DistrictID`, sd.`DistrictName`,sd.`StateID`, s.`StateName` FROM `Settings_District` sd inner join Settings_State s on sd.StateID=s.StateID;";
        $res = DBController::getDataSet($query);

        return array("return_code" => true, "return_data" => $res);
    }

    function addDistrict($data)
    {

        //prepare array 
        $params = array(
            array(":StateID", $data["StateId"]),
            array(":DistrictName", $data["DistrictName"]),
            array(":UserID", $_SESSION['UserID']),
        );
        //save the product
        $query = "INSERT INTO `Settings_District`( `DistrictName`, `StateID`,`CreatedByID`) VALUES (:DistrictName,:StateID,:UserID);";
        $res = DBController::ExecuteSQL($query, $params);
        if ($res) {
            return array("return_code" => true, "return_data" => "States added successfully");
        }
        return array("return_code" => false, "return_data" => " Error while saving the product");
    }
}
