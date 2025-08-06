<?php
/*
    Current Version: 2.0.0
    Created By: Devkanta,     dev1@techz.in
    Created On: 25-01-2024
    Modified By:
    Modified On:
*/

namespace app\modules\staff\classes;

use app\database\DBController;

class InternAttendanceSettings
{

    /*  Info:
        Description: to get the mode for attendance (QR, etc)
            25-01-2024 (Devkanta) : Adding the function
    */
    function getAttendanceMode()
    {
        $query = "SELECT `AttendanceModeID`, `AttendanceMode` FROM `Attendance_Mode`;";
        $res = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $res);
    }

    /*  Info:
        Description: Getting the timing of  all intern designation wise
             25-01-2024 (Devkanta) : Adding the function 
    */
    function getSettingTiming()
    {
        // $query = "SELECT sat.StaffAttendanceSettingID,sat.StartTime,sat.EndTime,Designation.DesignationID,Designation.DesignationName FROM `Staff_Attendance_Settings` sat
        //     RIGHT JOIN Designation on Designation.DesignationID=sat.DesignationID;";
        
        $query="SELECT sat.StaffAttendanceSettingID,sat.StartTime,sat.EndTime,Designation.DesignationID,Designation.DesignatonName as DesignationName
        FROM `Staff_Attendance_Settings` sat
        RIGHT JOIN Setting_Designation Designation on Designation.DesignationID=sat.DesignationID;";
        $res = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $res);
    }

    /*  Info:
        Description: Getting the timing of  all Intern based on Intern wise
                    -- get only the active Intern
            25-01-2024 (Devkanta) : Adding the function 
    */
    function getInternTiming()
    {
        $query = "SELECT iat.InternAttendanceTimingID, iat.StartTime,iat.EndTime,iat.AttendanceModeID,am.AttendanceMode,si.StaffInternID,si.StaffInternName FROM `Intern_Attendance_Timing` iat 
            LEFT JOIN Attendance_Mode  am on am.AttendanceModeID=iat.AttendanceModeID 
             RIGHT JOIN staff_intern si  on si.StaffInternID=iat.InternID where si.isRemoved=0 order by iat.InternAttendanceTimingID desc;";
        $res = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $res);
    }

    function saveInternAttendanceTiming($data)
    {

        if (isset($data["InternAttendanceTimingID"])) { //update Intern Attendance Seetings
            $params = array(
                array(":StaffInternId", $data["StaffInternId"]),
                array(":AttendanceMode", $data["attendanceMode"]),
                array(":StartTime", $data["startTime"]),
                array(":EndTime", $data["EndTime"]),
                array(":InternAttendanceTimingID", $data["InternAttendanceTimingID"]),
            );

            $query = "UPDATE `Intern_Attendance_Timing` SET `InternID`=:StaffInternId,`AttendanceModeID`=:AttendanceMode,`StartTime`=:StartTime,`EndTime`=:EndTime WHERE `InternAttendanceTimingID`=:InternAttendanceTimingID;";
            $res = DBController::ExecuteSQL($query, $params);
            return array("return_code" => true, "return_data" => "Successfully Updated");
        } else {
            $params = array(
                array(":StaffInternId", $data["StaffInternId"]),
                array(":AttendanceMode", $data["attendanceMode"]),
                array(":StartTime", $data["startTime"]),
                array(":EndTime", $data["EndTime"])
            );

            $query = "INSERT INTO `Intern_Attendance_Timing` (`InternID`, `AttendanceModeID`, `StartTime`, `EndTime`)  
                      VALUES (:StaffInternId, :AttendanceMode, :StartTime, :EndTime);";

            $res = DBController::ExecuteSQL($query, $params);

            if ($res) {
                return array("return_code" => true, "return_data" => "Successfully Added");
            }
        }

        return array("return_code" => false, "return_data" => " Error while saving the Data");
    }



    public function giveInternManualAttendance($data)
    {
        $data["AttendanceDate"] = date('Y-m-d', strtotime($data["AttendanceDate"]));
        $status = 0;
        for ($i = 0; $i < count($data["AttendanceData"]); $i++) {
            $params = array(
                array(":AttendanceDate", $data["AttendanceDate"]),
                array(":EntryBy", $_SESSION["UserID"]),
                array(":InternID", $data["AttendanceData"][$i]["InternID"]),
                array(":Status", $data["AttendanceData"][$i]["Status"]),
                array(":SessionID", 1), //we do not use this one for now

            );
            $query = "INSERT INTO `Intern_Attendance`(AttendanceDate,EntryBy,InternID,Status,SessionID) 
                        VALUES (:AttendanceDate,:EntryBy,:InternID,:Status,:SessionID);";
            $res = DBController::ExecuteSQL($query, $params);
            if ($res) {
                $status = $data["AttendanceData"][$i]["Status"];
            }
        }
        return array("return_code" => true, "return_data" => "Successfully Added");
    }
}
