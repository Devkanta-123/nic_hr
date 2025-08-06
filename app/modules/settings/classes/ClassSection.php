<?php
namespace app\modules\settings\classes;
use \app\database\DBController;

class ClassSection{
    function getClassSection($data) {
        $query = "SELECT * FROM Academics_ClassSection;";

        $res = DBController::getDataSet($query);

        return array("return_code" => true, "return_data" => $res);
    }
}