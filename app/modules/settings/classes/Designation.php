<?php

namespace app\modules\settings\classes;

use app\database\DBController;

class Designation
{
    public function getDesignations()
    {
        $query = "SELECT * FROM `Setting_Designation`";

        $res = DBController::getDataSet($query);
        if ($res)
            return array("return_code" => true, "return_data" => $res);

        return array("return_code" => false, "return_data" => "unable to get");
    }

}