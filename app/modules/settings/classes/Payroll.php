<?php

namespace app\modules\settings\classes;

use app\database\DBController;

class Payroll
{




    function getSalaryHeadType()
    {
        $query = "SELECT * FROM `Settings_Payroll_Salary_Headtype` ";
        $res = DBController::getDataSet($query);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        }
        return array("return_code" => false, "return_data" => "No Salary Head  Type Available");
    }
}
