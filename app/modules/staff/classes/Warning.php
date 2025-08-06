<?php
/* 
    Current Version: 1.0.0
    Created By: Devkanta,     dev1@techz.in
    Created On: 16/04/2024
    Modified By:
    Modified On:  
*/

namespace app\modules\staff\classes;

use app\database\DBController;
use \app\database\Helper;

class Warning
{

    function addWarningStaff($data)
    {

        if (isset($_SESSION['UserID'])) {
            $StaffID =  $_SESSION['UserID'];
        } else if (isset($_SESSION['StaffID'])) {
            $StaffID = $_SESSION['StaffID'];
        }


        $params = array(
            array(":WarningForStaffID", $data['WarningForStaffID']),
            array(":WarningTypeID", $data['WarningTypeID']),
            array(":WarningDate", $data['WarningDate']),
            array(":Remarks", $data['Remarks']),
            array(":WarningByStaffID", $StaffID),
            array(":CreatedByID", $StaffID),
            array(":isActive", 1),
        );

        $query = "INSERT INTO Staff_Warning (WarningForStaffID, WarningTypeID, WarningDate, Remarks, WarningByStaffID, CreatedByID, isActive) VALUES (:WarningForStaffID, :WarningTypeID, :WarningDate, :Remarks, :WarningByStaffID, :CreatedByID, :isActive);";
        $res = DBController::ExecuteSQL($query, $params);
        if ($res) {
            return array("return_code" => true, "return_data" => "Successfully Added");
        } else {
            return array("return_code" => false, "return_data" => "Failed to add");
        }
    }
    function getAllWarnings()
    {
        $query = "SELECT sw.WarningDate ,sw.Remarks,s.StaffName  as WarningStaffName,s2.StaffName  as WarnedBy,sw2.WarningType,sw.isActive  from staff_warning sw 
        inner join Staff s on s.StaffID  = sw.WarningForStaffID 
        inner join Staff s2 on s2.StaffID  = sw.WarningByStaffID 
        inner join Settings_WarningType sw2  on sw2.WarningTypeID = sw.WarningTypeID 
        where sw.isActive =1;";
        $res = DBController::getDataSet($query);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        } else {
            return array("return_code" => false, "return_data" => " No Data ");
        }
    }

    function getStaffWarnings($data)
    {
        $flag = $data['flag'];
        $params = array(
            array(":WarningForStaffID", $_SESSION['StaffID']),
        );
        if ($flag == 1) { //allwarnings
            $query = "SELECT sw.*,s.StaffName,swt.WarningType,WarnedBy.StaffName  as WarnedByName FROM Staff_Warning  sw  inner join Staff s on s.staffID = sw.WarningForStaffID  
        INNER  JOIN  Settings_WarningType swt on swt.WarningTypeID  = sw.WarningTypeID  INNER JOIN  Staff as WarnedBy ON  WarnedBy.StaffID = sw.WarningByStaffID    WHERE sw.isActive=1 AND sw.WarningForStaffID=:WarningForStaffID;";
            $res = DBController::getDataSet($query, $params);
            return array("return_code" => true, "return_data" => $res);
        } else if ($flag == 2) { //for particular staff
            $query = "SELECT sw.*,s.StaffName,swt.WarningType,WarnedBy.StaffName  as WarnedByName FROM Staff_Warning  sw  inner join Staff s on s.staffID = sw.WarningForStaffID  
            INNER  JOIN  Settings_WarningType swt on swt.WarningTypeID  = sw.WarningTypeID  INNER JOIN  Staff as WarnedBy ON  WarnedBy.StaffID = sw.WarningByStaffID    WHERE sw.isActive=1 AND sw.WarningForStaffID=:WarningForStaffID;";
            $res = DBController::getDataSet($query, $params);
            return array("return_code" => true, "return_data" => $res);
        }
    }

    function getStaffWarningsUnderSupervisor(){
        $params = array(
            array(":UserID",  $_SESSION['UserID']),
        );
       
        $query="SELECT sw.WarningDate ,sw.Remarks,s.StaffName  as WarningStaffName,s2.StaffName  as WarnedBy,sw2.WarningType,sw.isActive  from staff_warning sw 
        inner join Staff s on s.StaffID  = sw.WarningForStaffID 
        inner join Staff s2 on s2.StaffID  = sw.WarningByStaffID 
        inner join Settings_WarningType sw2  on sw2.WarningTypeID = sw.WarningTypeID 
        where sw.isActive =1 and sw.WarningByStaffID =:UserID";
        $res =(DBController::getDataSet($query,$params));
        return array("return_code" => true, "return_data" => $res);

    }
}
