<?php
/*
    Current Version: 2.0.0
    Created By: Angelbert,     prayagedu@techz.in
    Created On: 24-01-2024
    Modified By:
    Modified On:
*/

namespace app\modules\staff\classes;

use app\database\DBController;
use app\misc\Sodium;
use app\misc\GenerateQR;

class StaffAttendanceSettings
{

    /*  Info:
        Description: to get the mode for attendance (QR, etc)
            24-01-2024 (Angelbert) : Adding the function
    */
    function getAttendanceMode()
    {
        $query = "SELECT `AttendanceModeID`, `AttendanceMode` FROM `Attendance_Mode`;";
        $res = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $res);
    }

    /*  Info:
        Description: Getting the timing of  all staff designation wise
            24-01-2024 (Angelbert) : Adding the function 
    */
    function getSettingTiming()
    {
        $query = "SELECT sat.StaffAttendanceSettingID,sat.StartTime,sat.EndTime,Designation.DesignationID,Designation.DesignationName as DesignationName
            FROM `Staff_Attendance_Settings` sat
            RIGHT JOIN Setting_Designation Designation on Designation.DesignationID=sat.DesignationID;";
        $res = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $res);
    }

    /*  Info:
        Description: Getting the timing of  all staff based on staff wise
                    -- get only the active staff
            24-01-2024 (Angelbert) : Adding the function 
    */
    function getStaffTiming()
    {    //old query
        // $query = "SELECT sat.StaffAttendanceTimingID,sat.DesignationID,sat.StartTime,sat.EndTime,sat.AttendanceModeID,sat.Supervisor1 ,sat.Supervisor2 ,Staff.StaffID,Staff.StaffName,Attendance_Mode.AttendanceMode FROM `Staff_Attendance_Timing` sat 
        // LEFT JOIN Attendance_Mode on Attendance_Mode.AttendanceModeID=sat.AttendanceModeID 
        // RIGHT JOIN Staff on Staff.StaffID=sat.StaffID where Staff.isRemoved=0 order by sat.StaffAttendanceTimingID desc
        // ;";
        $query="SELECT 
        sat.StaffAttendanceTimingID,
        sat.DesignationID,
        sat.StartTime,
        sat.EndTime,
        sat.AttendanceModeID,
        sat.Supervisor1 as Supervisor1ID,
        sat.Supervisor2 as Supervisor2ID,
        Staff.StaffID,
        Staff.StaffName,
        Attendance_Mode.AttendanceMode,
        Supervisor1.StaffName AS Supervisor1Name,
        Supervisor2.StaffName AS Supervisor2Name
    FROM 
        Staff_Attendance_Timing sat
    LEFT JOIN 
        Attendance_Mode ON Attendance_Mode.AttendanceModeID = sat.AttendanceModeID
    RIGHT JOIN 
        Staff ON Staff.StaffID = sat.StaffID
    LEFT JOIN 
        Staff AS Supervisor1 ON Supervisor1.StaffID = sat.Supervisor1

        LEFT JOIN 
        Staff AS Supervisor2 ON Supervisor2.StaffID = sat.Supervisor2
    WHERE 
        Staff.isRemoved = 0 AND Staff.StaffID !=6  
    ORDER BY 
        sat.StaffAttendanceTimingID DESC;";
        $res = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $res);
    }

    /*  Info:
        Description: Adding / Updating the setting for timing     
            24-01-2024 (Angelbert) : Adding the function 
    */
    function UpdatesettingTiming($data)
    {
        //first it will update uin setting then 
        //update setting  
        for ($i = 0; $i < count($data["AttendanceData"]); $i++) {
            //find out if the timing is null or not if null add a new one 
            if ($data["AttendanceData"][$i]["StaffAttendanceTiming"] == "null") {
                //insert the ID for this designaiton 
                $params1 = array(
                    array(":AttendanceModeID", 1),
                    array(":StartTime", $data["AttendanceData"][$i]["StartTime"]),
                    array(":EndTime", $data["AttendanceData"][$i]["EndTime"]),
                    array(":DesignationID", $data["AttendanceData"][$i]["DesignationID"])
                );
                $sq = "INSERT INTO Staff_Attendance_Settings(AttendanceModeID,StartTime,EndTime,DesignationID) 
                     VALUES(:AttendanceModeID,:StartTime,:EndTime,:DesignationID )";
                $data["AttendanceData"][$i]["StaffAttendanceTiming"] =  DBController::ExecuteSQLID($sq, $params1);
            }

            //update timing setting
            $params1 = array(
                array(":StartTime", $data["AttendanceData"][$i]["StartTime"]),
                array(":EndTime", $data["AttendanceData"][$i]["EndTime"]),
                array(":StaffAttendanceSettingID", $data["AttendanceData"][$i]["StaffAttendanceTiming"]),
            );

            $query1 = "UPDATE `Staff_Attendance_Settings` SET `StartTime`=:StartTime,`EndTime`=:EndTime WHERE `StaffAttendanceSettingID`=:StaffAttendanceSettingID";
            $res1 = DBController::executeSQL($query1, $params1);

            // update the staff Timing
            if ($res1) {

                //check if entryies of that desigation is present or not 
                $params = array(
                    array(":DesignationID", $data["AttendanceData"][$i]["DesignationID"]),
                );
                $query = "SELECT DesignationID from  `Staff_Attendance_Timing`  WHERE `DesignationID`=:DesignationID";
                $dt = DBController::sendData($query, $params);

                if (!$dt) {
                    //insert all the staff with this designation id
                    $params = array(
                        array(":DesignationID", $data["AttendanceData"][$i]["DesignationID"])
                    );
                    $query = " INSERT INTO `Staff_Attendance_Timing`(StaffID,DesignationID) 
                                    SELECT StaffID,DesignationID FROM Staff WHERE isRemoved=0 AND DesignationID = :DesignationID  ";
                    $res = DBController::executeSQL($query, $params);
                }
                $params = array(
                    array(":StartTime", $data["AttendanceData"][$i]["StartTime"]),
                    array(":EndTime", $data["AttendanceData"][$i]["EndTime"]),
                    array(":DesignationID", $data["AttendanceData"][$i]["DesignationID"]),
                );

                $query = "UPDATE `Staff_Attendance_Timing` SET `StartTime`=:StartTime,`EndTime`=:EndTime WHERE `DesignationID`=:DesignationID";
                $res = DBController::executeSQL($query, $params);
            }
        }
        return array("return_code" => true, "return_data" => "Sucessfully Update Timing");
    }

    /*  Info:
        Description:  Adding / Updating the timing for that staff   
            24-01-2024 (Angelbert) : Adding the function 
    */
    function saveStaffAttendanceTiming($data)
    {
        if (isset($data['StaffAttendanceTimingID']) && $data['StaffAttendanceTimingID'] != '') {
            //check first for Designation
            if (isset($data['DesignationID']) &&  $data['DesignationID'] != '') {
                $param8 = array(
                    array(":DesignationID", $data['DesignationID']),
                    array(":StartTime", $data['startTime']),
                    array(":EndTime", $data['EndTime']),
                    array(":StaffID", $data['StaffId']),
                    array(":AttendanceMode", $data['attendanceMode']),
                    array(":StaffAttendanceTimingID", $data['StaffAttendanceTimingID']),
                    array(":Supervisor1", $data['Supervisor1']),
                    array(":Supervisor2", $data['Supervisor2']),
                );
                $query8 = "UPDATE `Staff_Attendance_Timing` SET `DesignationID`=:DesignationID,`StartTime`=:StartTime,
                `EndTime`=:EndTime,`StaffID`=:StaffID,`AttendanceModeID`=:AttendanceMode,`Supervisor1`=:Supervisor1,`Supervisor2`=:Supervisor2 WHERE StaffAttendanceTimingID=:StaffAttendanceTimingID";
                $res8 = DBController::ExecuteSQL($query8, $param8);
                return array("return_code" => true, "return_data" => "Sucessfully Update Time");
            }
            //add new 

            else {

                $param1 = array(
                    array(":StaffID", $data['StaffId'])
                );

                $query3 = "SELECT `DesignationID` FROM `Staff` WHERE `StaffID`=:StaffID";
                $res3 = DBController::sendData($query3, $param1);

                $param9 = array(
                    array(":DesignationID", $res3['DesignationID']),
                    array(":StartTime", strip_tags($data['startTime'])),
                    array(":EndTime", strip_tags($data['EndTime'])),
                    array(":StaffID", strip_tags($data['StaffId'])),
                    array(":AttendanceMode", strip_tags($data['attendanceMode'])),
                    array(":StaffAttendanceTimingID",  strip_tags($data['StaffAttendanceTimingID']))
                );
                $query9 = "UPDATE `Staff_Attendance_Timing` SET `DesignationID`=:DesignationID,`StartTime`=:StartTime,
                `EndTime`=:EndTime,`StaffID`=:StaffID,`AttendanceModeID`=:AttendanceMode WHERE StaffAttendanceTimingID=:StaffAttendanceTimingID";
                $res9 = DBController::ExecuteSQL($query9, $param9);

                return array("return_code" => true, "return_data" => "Sucessfully Update Time");
            }
        } else {
            //get the designatin First
            //add new data in staff Timing

            //get deisignation from staff

            $param1 = array(
                array(":StaffID", strip_tags($data['StaffId']))
            );

            $query3 = "SELECT `DesignationID` FROM `Staff` WHERE `StaffID`=:StaffID";
            $res3 = DBController::sendData($query3, $param1);

            $param = array(
                array(":DesignationID", $res3['DesignationID']),
                array(":StartTime", strip_tags($data['startTime'])),
                array(":EndTime", strip_tags($data['EndTime'])),
                array(":StaffID", strip_tags($data['StaffId'])),
                array(":AttendanceMode", strip_tags($data['attendanceMode'])),
                array(":Supervisor1", $data['Supervisor1']),
                array(":Supervisor2", $data['Supervisor2']),
            );

            $query = "INSERT INTO `Staff_Attendance_Timing`(`DesignationID`, `StartTime`, `EndTime`, `StaffID`, `AttendanceModeID`,`Supervisor1`,`Supervisor2`) 
            VALUES (:DesignationID,:StartTime,:EndTime,:StaffID,:AttendanceMode,:Supervisor1,:Supervisor2)";
            $res = DBController::ExecuteSQL($query, $param);

            if ($res) {
                return array("return_code" => true, "return_data" => "Sucessfully Update Time");
            }
        }
    }

    /*  Info: NOt final (need to work out more)
        Description: for getting the QR code for the particular office
                    -- Only admin will have access   
            24-01-2024 (Angelbert) : Adding the function 
    */
    function getAttendanceQRSheet()
    {
        if ($_SESSION["UserType"] != 1) {
            return array("return_code" => false, "return_data" => "Unable to access the requested data or you don't have access.");
        }

        $query = "SELECT * FROM Settings_School Limit 1";
        $school = DBController::sendData($query);
        if ($school && $school["QRCode"]) {
            return array("return_code" => true, "return_data" => "file?type=qr&name=" . $school["QRCode"]);
        } else
            return array("return_code" => false, "return_data" => "Unable to find the QR");
    }


    /*  Info:
        Description: for getting all the breakInOut option 
            29-01-2024 (Angelbert) : Adding the function 
    */
    function getAllBreakOption()
    {
        $query = "SELECT * from `Staff_Attendance_BreakOption` where isActive=1";
        $BreakOption = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $BreakOption);
    }


    /*  Info:
        param : {OfficeID,UserType(Usertype 1=staff, 2=intern)}
        Description: for Generating the QR code for that particular OfficeID 
            29-01-2024 (Angelbert) : Adding the function 
    */
    function generateAttendanceQRSheet($paramdata)
    {
        //get the office based on id
        // $query = "SELECT * FROM Settings_School Limit 1";
        $param = array(
            array(":OfficeID", strip_tags($paramdata['OfficeID']))
        );
        $query = "SELECT * FROM `Settings_Office` WHERE OfficeID =:OfficeID and isActive=1";
        $Office = DBController::sendData($query, $param);
        // $school = DBController::sendData($query);
        $name = uniqid("s", true);
        $qrdata = json_encode(array("OfficeID" =>  $Office["OfficeID"], "OfficeName" => $Office["OfficeName"], "Latitude" => $Office["Latitude"], "Longitude" => $Office["Longitude"], "QRCODE" => $name, "CreationDate" => md5(date("Y-m-d H:i:s"))));
        $data = Sodium::safeEncrypt($qrdata);

        $data = json_encode(array("OfficeID" => $Office["OfficeID"], "UserType" => $paramdata['UserType'],  "Latitude" => $Office['Latitude'], "Longitude" => $Office['Longitude'],  "DATA" => $data));
        //for local
        $logo = "http://$_SERVER[HTTP_HOST]/itplapp/public/" . "file?type=OfficeLogo&name=" . $Office["Logo"]; //to be changed for live site
        //for live
        //$logo = "https://$_SERVER[HTTP_HOST]/" . "file?type=SchoolLogo&name=" . $Office["Logo"]; //to be changed for live site

        $output =  "../app/data/qr"; //to be changed for live site
        if (!file_exists($output)) {
            mkdir($output, 0755, true);
        }
        GenerateQR::generate($name, $data, 500, $output, $logo);

        $params = array(
            array(":qrname", $name . ".png"),
            array(":qrdata", $qrdata),
            array(":OfficeID",  $Office["OfficeID"])
        );

        //to update based on userType and OfficeID

        if ($paramdata['UserType'] == 1) //for staff
        {
            $query = "UPDATE `Settings_Office` SET `StaffQRCode`=:qrname,`StaffQRData`=:qrdata
            where `OfficeID`=:OfficeID";
            $array = DBController::ExecuteSQL($query, $params);
            unlink($output . "/" . $Office["StaffQRCode"]);
        }
        //intern
        else {
            $query = "UPDATE `Settings_Office` SET  `InternQRCode`=:qrname,`InternQRData`=:qrdata
            WHERE OfficeID=:OfficeID";
            $array = DBController::ExecuteSQL($query, $params);
            unlink($output . "/" . $Office["InternQRCode"]);
        }

        $res['OfficeID'] = $paramdata['OfficeID'];
        $res['mode'] = $paramdata['UserType'];

        // try {
        // unlink($output . "/" . $Office["QRCode"]);
        // } catch (Exception $e) {
        //throw $th;
        // }
        return array("return_code" => true, "return_data" => "Successfull Created. Loading...", "data" => $res);
    }


    /*  Info:
        param : {officeLatitude,officeLongitude,targetLatitude,targetLongitude}
        Description: For Checking The Coordinates of the office location While Staff Login  From API
            21-02-2024 (Devkanta) : Adding the function 
    */
    function isWithinRadius($data)
    {
        $query= "SELECT * FROM Settings_Office WHERE OfficeID = 1";
        $office = DBController::sendData($query);
        $Latitude = $office['Latitude'];
        $Longitude = $office['Longitude'];
        $officeLatitude =  $Latitude;
        $officeLongitude =  $Longitude;
        $targetLatitude = $data['targetLatitude']; // Assuming the key in $data for latitude is 'latitude'
        $targetLongitude = $data['targetLongitude']; // Assuming the key in $data for longitude is 'longitude'

        // Convert latitude and longitude from degrees to radians
        $radius =  50;
        $lat1Rad = deg2rad($officeLatitude);
        $lon1Rad = deg2rad($officeLongitude);
        $lat2Rad = deg2rad($targetLatitude);
        $lon2Rad = deg2rad($targetLongitude);

        // Calculate the differences between coordinates
        $latDiff = $lat2Rad - $lat1Rad;
        $lonDiff = $lon2Rad - $lon1Rad;

        // Haversine formula
        $a = sin($latDiff / 2) ** 2 + cos($lat1Rad) * cos($lat2Rad) * sin($lonDiff / 2) ** 2;
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        // Radius of the Earth in meters (mean value)
        $earthRadius = 6371000;

        // Calculate the distance in meters
        $distance = $earthRadius * $c;
        // return $distance <= $radius; 
        $result = $distance <= $radius;

        // Output the result
        if ($result) {
            return array("return_code" => "true", "return_data" => "Within " .$radius. " meters radius");
        } else {
            return array("return_code" => "false", "return_data" => "Outside " .$radius. " meters  radius");
        }
    }

    function getSupervisorForStaffLeaves($data)
    {

        $params = array(
            array(":StaffID", $_SESSION['StaffID'])
        );
        $query = "SELECT
        sat.Supervisor1 as Supervisor1ID,
        sat.Supervisor2 as Supervisor2ID, 
        Supervisor1.StaffName AS Supervisor1Name,
        Supervisor2.StaffName AS Supervisor2Name
    FROM 
        Staff_Attendance_Timing sat

    RIGHT JOIN 
        Staff ON Staff.StaffID = sat.StaffID
    LEFT JOIN 
        Staff AS Supervisor1 ON Supervisor1.StaffID = sat.Supervisor1

        LEFT JOIN 
        Staff AS Supervisor2 ON Supervisor2.StaffID = sat.Supervisor2
    WHERE 
        Staff.isRemoved = 0 and sat.StaffID=:StaffID
    ORDER BY 
        sat.StaffAttendanceTimingID DESC ";
        $res = DBController::getDataSet($query, $params);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        } else {
            return array("return_code" => false, "return_data" => "No Supervisors found");

        }

    }

    



    // Example usage:

}
