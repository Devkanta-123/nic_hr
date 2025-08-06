<?php
namespace app\modules\settings\classes;
use \app\database\DBController;

class Caste{
    function getCaste($data) {
        $query = "SELECT * FROM Settings_Caste;";

        $res = DBController::getDataSet($query);

        return array("return_code" => true, "return_data" => $res);
    }
}