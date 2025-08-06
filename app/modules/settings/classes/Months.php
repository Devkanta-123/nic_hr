<?php
namespace app\modules\settings\classes;
use \app\database\DBController;

class Months{
   
    function getMonths($data)
    {
   
        $query="select  sm.MonthID ,sm.MonthName  from Settings_Months sm;";
        $res = DBController::getDataSet($query);
        if ($res)
            return array("return_code" => true, "return_data" => $res);

        return array("return_code" => false, "return_data" => array());
    }
}