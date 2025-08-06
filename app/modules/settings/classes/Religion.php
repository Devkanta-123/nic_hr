<?php
namespace app\modules\settings\classes;
use \app\database\DBController;

class Religion{
    function getReligion($data) {
        $query = "SELECT * FROM Settings_Religion;";

        $res = DBController::getDataSet($query);

        return array("return_code" => true, "return_data" => $res);
    }
}