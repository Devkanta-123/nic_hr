<?php

/*
    Current Version: 2.0.0
    Created By: Devkanta dev1@techz.in
    Created On: 13-02-2024
    Modified By:
    Modified On:
*/
namespace app\modules\settings\classes;

use \app\database\DBController;

class City
{
     /*  Info:
        Description: Getting all the Cities from Settings_City table
            23-01-2024 (Angelbert Riahtam) : Adding the function      
    */
    function getallCity()
    {

        $query = "SELECT `CityId`,`CityName` FROM `Settings_City`;";
        $res = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $res);
    }
}
