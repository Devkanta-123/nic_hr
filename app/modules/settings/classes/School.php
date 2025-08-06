<?php
namespace app\modules\settings\classes;
use \app\database\DBController;

class School{
    function getSchoolDetails($data) {
        $query = "SELECT Settings_School.*,Settings_Board.*,Settings_State.*,Settings_District.*,GROUP_CONCAT(Academics_Class.ClassName) AS AvailableClasses FROM `Settings_School` INNER JOIN Settings_Board ON Settings_School.BoardID=Settings_Board.BoardID INNER JOIN Settings_State ON Settings_State.StateID=Settings_School.StateID INNER JOIN Settings_District ON Settings_District.DistrictID=Settings_School.DistrictID INNER JOIN Academics_Class ON FIND_IN_SET(Academics_Class.ClassID,Settings_School.AvailableClasses);";

        $res = DBController::sendData($query);

        return array("return_code" => true, "return_data" => $res);
    }
}