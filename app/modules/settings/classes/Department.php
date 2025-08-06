<?php

namespace app\modules\settings\classes;

use app\database\DBController;

class Department
{
    /*  Info:
        Description: get the all the department  
            03-02-24 : angelbert (Add the function)
    */
    function getAllDepartment()
    {
        $query = "SELECT `DepartmentID`, `DepartmentName`, `DepartmentCode` FROM `Settings_Department`";
        $dept = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $dept);
    }

    function addDepartment($data)  // added by dev on 05/12/23
    {
        // Prepare array

        $params = array(
            array(":DepartmentCode", $data["DeptCode"]),
            array(":DepartmentName", $data["DeptName"]),
        );
        $query = "INSERT INTO `grievance_category_department` (`DepartmentCode`, `DepartmentName`,`isActive`) VALUES (:DepartmentCode, :DepartmentName,1)";
        $res = DBController::ExecuteSQL($query, $params);
        if ($res) {
            return array("return_code" => true, "return_data" => "Department added successfully");
        }
        return array("return_code" => false, "return_data" => "Error while saving the Department");
    }

    //
    function getDepartment() // added by dev on 05/12/23
    {
        $query = "SELECT 
         Grievance_Category_Department.DepartmentID,DepartmentCode,DepartmentName,
         GROUP_CONCAT(Grievance_Category_Department_Staff.StaffName) as StaffName,
         GROUP_CONCAT(Grievance_Category_Department_Staff.StaffID) as StaffID
     FROM 
         Grievance_Category_Department
     INNER JOIN 
         Grievance_Category_Department_Staff ON FIND_IN_SET(Grievance_Category_Department.DepartmentID, Grievance_Category_Department_Staff.DepartmentID)
     WHERE 
         FIND_IN_SET(Grievance_Category_Department.DepartmentID, Grievance_Category_Department_Staff.DepartmentID)
         AND Grievance_Category_Department.isActive = 1
         AND Grievance_Category_Department_Staff.isRemoved = 0
     GROUP BY 
         Grievance_Category_Department.DepartmentID,DepartmentCode,
         DepartmentName";
        $res = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $res);
    }

    function onDepartmentDelete($data) // added by dev on 05/12/23
    {
        $params = array(
            array(":DepartmentID", $data["DepartmentID"]),
        );
        $query = "UPDATE  `grievance_category_department`  SET isActive = 0 WHERE `DepartmentID`=:DepartmentID;";
        $res = DBController::ExecuteSQL($query, $params);
        if ($res) {
            return array("return_code" => true, "return_data" => "Sucessfully Removed the Department");
        }
        return array("return_code" => false, "return_data" => "Error while removing the  Department");
    }

    function onUserDelete($data) // added by dev on 05/12/23
    {
        $params = array(
            array(":StaffID", $data["StaffID"]),
        );
        $query = "UPDATE  `grievance_category_department_staff` 
        SET isRemoved = 1 WHERE `StaffID`=:StaffID;";
        $res = DBController::ExecuteSQL($query, $params);
        if ($res) {
            return array("return_code" => true, "return_data" => "Sucessfully Removed the User");
        }
        return array("return_code" => false, "return_data" => "Error while removing the  User");
    }


    function getDepartmentForAssignGrievanceCategory()
    {
        $query = "SELECT `DepartmentID`, `DepartmentName` FROM `Grievance_Category_Department` WHERE `isActive` = 1 ";
        $res = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $res);
    }

    function getEmployeeByDepartmentID($data)
    {
        $params = array(
            array(":DepartmentID", $data['DepartmentID']),
        );
        $query = "SELECT `StaffID`,`StaffName` FROM `Grievance_Category_Department_Staff` WHERE `DepartmentID` = :DepartmentID";
        $res = DBController::getDataSet($query, $params);
        return array("return_code" => true, "return_data" => $res);
    }
}
