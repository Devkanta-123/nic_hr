<?php
namespace app\modules\settings\classes;
use \app\database\DBController;

class Nationality{
    function getNationality() {
        $query = "SELECT * FROM `Settings_Nationality`;";
        $res = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $res);
    }

    function getCalendarTextType($data)
    {
        //need to rename the table
        $query="SELECT CalendarTextTypeID,CalendarTextType,CalendarTextColour,isHoliday FROM `Academics_CalendarTextType`;";
        $res = DBController::getDataSet($query);
        if ($res)
            return array("return_code" => true, "return_data" => $res);

        return array("return_code" => false, "return_data" => array());
    }
}