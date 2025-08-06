<?php

namespace app\modules\settings\classes;

use app\database\DBController;

class Warning
{
    /**
     *  Description:  Get All Designation
     *  Createdby : Devkanta (16/04/2024)
     *  Updates:

     * 
     */
  
    function addWarningTypes($data)
    {
        $param = array(
            array(":WarningType", strip_tags($data['WarningType'])),
        );

        $query = "SELECT count(*) as SameWarningType FROM  `Settings_WarningType` WHERE  `WarningType` =:WarningType ";
        $res = DBController::sendData($query, $param);
        if ($res['SameWarningType'] > 0) {
            return array("return_code" => false, "return_data" => "Same Warning Type already exists");
        } else {
            $query = "INSERT INTO `Settings_WarningType` (`WarningType`,`isActive`,`CreatedByID`) VALUES (:WarningType,:isActive,:CreatedByID)";
            $params = array(
                array(':WarningType', $data['WarningType']),
                array(':isActive', 1),
                array(':CreatedByID', $_SESSION['UserID']), // Corrected parameter name
            );
            $res = DBController::ExecuteSQL($query, $params);
            if ($res) {
                return array("return_code" => true, "return_data" => "Warning Type added successfully");
            } else {
                return array("return_code" => false, "return_data" => "Error while saving the Warning Type");
            }
        }
    }


    function getAllWarningTypes()
    {
        $query = "SELECT * FROM `Settings_WarningType` WHERE  `isActive` = 1 ";
        $res = DBController::getDataSet($query);
        if ($res)
            return array("return_code" => true, "return_data" => $res);
    }

    function editWarningType($data)
    {



        $param = array(
            array(":WarningTypeID", strip_tags($data['WarningTypeID'])),
            array(":WarningType", strip_tags($data['WarningType'])),
        );
        $query = " UPDATE Settings_WarningType SET WarningType=:WarningType,LastUpdatedDateTime = NOW()  WHERE WarningTypeID=:WarningTypeID";
        $res = DBController::ExecuteSQL($query, $param);
        if ($res) {
            return array("return_code" => true, "return_data" => "Warning Type updated successfully");
        } else {
            return array("return_code" => false, "return_data" => "Error while updating the Warning Type");
        }
    }
}
