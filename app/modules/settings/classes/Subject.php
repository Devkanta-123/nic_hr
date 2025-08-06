<?php
namespace app\modules\settings\classes;
use app\database\DBController;

class Subject
{
    function addSubject($data) {

        $params = array(
            array(":SubjectAlias",$data["SubjectAlias"]),
            array(":SubjectName",$data["SubjectName"])
        );

        $query = "INSERT INTO Settings_Subjects(SubjectAlias, SubjectName) VALUES (:SubjectAlias, :SubjectName);";

        $res = DBController::ExecuteSQL($query,$params);

        if ($res)
            return array("return_code" => true, "return_data" => $res);
        return array("return_code" => false, "return_data" => "Unable to add Subject!!");
    }

    function getSubjects($data) {
        $query = "SELECT * FROM Settings_Subjects;";

        $res = DBController::getDataSet($query);

        return array("return_code" => true, "return_data" => $res);
    }
}