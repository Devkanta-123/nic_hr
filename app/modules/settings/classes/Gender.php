<?php
namespace app\modules\settings\classes;


use app\database\DBController;

class Gender
{

    /**
     * Gender constructor.
     */
    public function __construct()
    {
    }

    function getGender() {
        $query = "SELECT * FROM Settings_Gender;";

        $res = DBController::getDataSet($query);

        return array("return_code" => true, "return_data" => $res);
    }
}