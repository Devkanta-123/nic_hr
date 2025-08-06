<?php
namespace app\modules\settings\classes;

use \app\database\DBController;
class Community{
    function getCommunity($data) {
        $query = "SELECT * FROM Settings_Community;";

        $res = DBController::getDataSet($query);

        return array("return_code" => true, "return_data" => $res);
    }
}