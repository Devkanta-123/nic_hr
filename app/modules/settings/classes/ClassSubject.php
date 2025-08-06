<?php
namespace app\modules\settings\classes;
use app\database\DBController;

class ClassSubject
{
    function getClassSubjects($data) {
        $query = "SELECT Academics_Subjects.*,GROUP_CONCAT(Settings_Subjects.SubjectName) AS SubjectName,GROUP_CONCAT(Settings_Subjects.SubjectAlias) AS SubjectAlias FROM `Academics_Subjects` INNER JOIN Settings_Subjects ON find_in_set(Settings_Subjects.SubjectID,Academics_Subjects.SubjectID);";

        $res = DBController::getDataSet($query);

        return array("return_code" => true, "return_data" => $res);
    }

    function addClassSubject($data)
    {

        $SessionID = Session::getCurrentSession();
        $params = array(
            array(":ClassID",$data["ClassID"]),
            array(":SubjectID",implode(',', $data["SubjectID"])),
            array(":isCompulsory",$data["isCompulsory"]),
            array(":isPreferredSubject",$data["isPreferredSubject"]),
            array(":SessionID",$SessionID["return_data"]["AcademicsSessionID"])
        );

        $query = "INSERT INTO Academics_Subjects(ClassID, SubjectID, isCompulsory, isPreferredSubject, SessionID) VALUES (:ClassID, :SubjectID, :isCompulsory, :isPreferredSubject, :SessionID);";

        $res = DBController::ExecuteSQL($query,$params);

        if ($res)
            return array("return_code" => true, "return_data" => $res);
        return array("return_code" => false, "return_data" => "Unable to add Subject!!");
    }
}