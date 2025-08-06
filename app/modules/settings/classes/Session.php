<?php


namespace app\modules\settings\classes;


use app\database\DBController;

class Session
{
    static function getCurrentSession(){
        $query = "SELECT * FROM Academics_Session WHERE isCurrent = 1 ;";

        $res = DBController::sendData($query);

        return array("return_code" => true, "return_data" => $res);
    }

    static function getSessions(){
        $query = "SELECT * FROM Academics_Session ORDER BY isCurrent DESC ;";

        $res = DBController::getDataSet($query);

        return array("return_code" => true, "return_data" => $res);
    }

    static function getCurrentSessionID(){
        $query = "SELECT AcademicsSessionID FROM Academics_Session WHERE isCurrent = 1 ;";

        $res = DBController::sendData($query);

        return  $res["AcademicsSessionID"];
    }

    static function changeSession($data){
        if (isset($data["SessionID"])){
            $_SESSION["ITPLsessionID"] = $data["SessionID"];
            return array("return_code" => true, "return_data" => true);
        }
        return array("return_code" => false, "return_data" => false);
    }

    static function nextSession($data){
        $param=[
            [":AcademicsSessionID",$_SESSION["ITPLsessionID"]]
        ];
        $query = "SELECT * FROM Academics_Session WHERE AcademicsSessionID > :AcademicsSessionID;";

        $res = DBController::sendData($query,$param);

        return array("return_code" => true, "return_data" => $res);
    }

}