<?php

namespace app\modules\settings\classes;

use app\database\DBController;

class Departures
{
    /**
     *  Description:  Get All Designation
     *  Createdby : Devkanta (02/04/2024)
     *  Updates:
     *    02-04-2024 (Devkanta):   added the function
     * 
     */
    public function getAllDepartures()
    {
        $query = "SELECT * FROM `Settings_Departures` WHERE  `IsActive` = 1 ";
        $res = DBController::getDataSet($query);
        if ($res)
            return array("return_code" => true, "return_data" => $res);

        return array("return_code" => false, "return_data" => "unable to get");
    }
    function addDepartures($data)
    {
        // Check if the departure type already exists
        $param = array(
            array(":DepartureType", strip_tags($data['DepartureType'])),
        );
        $checkQuery = "SELECT count(*) as SameDepartureType  FROM Settings_Departures WHERE DepartureType =:DepartureType";
        $result = DBController::sendData($checkQuery, $param);
        if ($result['SameDepartureType'] > 0) {
            return array("return_code" => false, "return_data" => "Same Departure Type already exists");
        } else {

            $query = "INSERT INTO `Settings_Departures` (`DepartureType`) VALUES (:DepartureType)";
            $params = array(
                array(':DepartureType', $data['DepartureType']),

            );
            $res = DBController::ExecuteSQL($query, $params);
            if ($res) {
                return array("return_code" => true, "return_data" => "Departure Type added successfully");
            } else {
                return array("return_code" => false, "return_data" => "Error while saving the Departure Type");
            }
        }
    }
}
