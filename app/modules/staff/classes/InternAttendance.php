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

class InternAttendance
{

    /*  Info:
        Param : {AttendanceDate,InternCategoryID}
        Description: get the Active Intern  based on Category and date  for attendance
            25-01-2024 (Devkanta) : Adding the function
    */
    public function getInternForAttendance($data)
    {
        $day = date_format(date_create($data["AttendanceDate"]), 'D');
        if ($day == "Sun") {
            return array("return_code" => false, "return_data" => "It is sunday");
        }

        $params = array(
            array(":InternCategoriesID", strip_tags($data["InternCategoriesID"])),
            array(":AttendanceDate", strip_tags($data["AttendanceDate"])),
        );
        $query = "SELECT si.StaffInternID,si.StaffInternName,ic.CategoryName,IFNULL(ia.StaffAttendanceID,-1) as InternAttendanceID,IFNULL(ia.Status,-1) as Status , IFNULL(ia.isBreakInOut,-1) as BreakInOut, IFNULL(ia.isCheckOut,-1) as CheckOut,  IFNULL(ia.AttendanceModeId,-1) as AttendanceModeId  FROM `staff_intern` si 
        INNER JOIN `intern_category` ic ON si.CategoryID = ic.InternCategoryID
        LEFT JOIN   `intern_attendance` ia ON si.StaffInternID = ia.InternID  and DATE_FORMAT(ia.AttendanceDate,'%Y/%m/%d') = DATE_FORMAT(:AttendanceDate,'%Y/%m/%d')
         where si.CategoryID=:InternCategoriesID and si.isRemoved=0;";
        $res = DBController::getDataSet($query, $params);
        return array("return_code" => true, "return_data" => $res);
    }

    /*  Info:
        Param : {AttendanceDate,staffInternId,Status}
        Description: To Update/Add the intern attendance status
            25-01-2024 (Devkanta) : Adding the function
    */
    public function updateInternIndividualAttendance($data)
    {

        //check if already  mark attendance
        $params = array(
            array(":AttendanceDate", strip_tags($data["AttendanceDate"])),
            array(":internId", strip_tags($data["internId"]))
        );
        $query = "SELECT StaffAttendanceID from `Intern_Attendance` where 
        InternID=:internId and AttendanceDate=:AttendanceDate";
        $attendncedetails  = DBController::sendData($query, $params);


        if (!$attendncedetails) //if not available then insert 
        {
            //get IN time and out time of the staff and add here LAT IN and LAT out of the school, SessionID , AttendanceModeId
            $params = array(
                array(":AttendanceDate", strip_tags($data["AttendanceDate"])),
                array(":EntryBy", $_SESSION["UserID"]),
                array(":internId", strip_tags($data["internId"])),
                array(":Status", strip_tags($data["Status"])),
                array(":SessionID", 1), //we usually do not use this

            );
            $query = "INSERT INTO `Intern_Attendance`(`AttendanceDate`, `StaffID`, `Status`, `EntryBy`,SessionID )
            VALUES (:AttendanceDate,:staffId,:Status,:EntryBy,:SessionID)";
            $res = DBController::ExecuteSQL($query, $params);
            return array("return_code" => true, "return_data" => "Successfully Marked !!");
        } else {  //otherwise update the status 
            $params = array(
                array(":AttendanceID", $attendncedetails["StaffAttendanceID"]),
                array(":internId", $data["internId"]),
                array(":Status", $data["Status"])
            );
            $query = "UPDATE `Intern_Attendance` SET Status=:Status WHERE StaffAttendanceID=:AttendanceID and `InternID`=:internId;";
            $res = DBController::executeSQL($query, $params);
            return array("return_code" => true, "return_data" => "Successfully updated !!");
        }
    }

    /*  Info:
        Param : {AttendanceDate,Designation,AttendanceData[StaffID->integer,Status->Boolean]}
        Description: To Update/Add the staff attendance status
            25-01-2024 (Devkanta) : Adding the function
    */
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
            $query = "INSERT INTO `Intern_Attendance`(AttendanceDate,StaffIn,EntryBy,InternID,Status,SessionID) 
                    VALUES (:AttendanceDate,CURTIME(),:EntryBy,:InternID,:Status,:SessionID);";
            $res = DBController::ExecuteSQL($query, $params);
            if ($res) {
                $status = $data["AttendanceData"][$i]["Status"];
            }
        }
        return array("return_code" => true, "return_data" => "Successfully Added");
    }

    function InternBreakInOut($data)
    {
        date_default_timezone_set('Asia/Kolkata');


        //update break in 
        if (isset($data['BreakInOut']) && $data['BreakInOut'] == 1) {
            $BreakOutTime = date("h:i:sa");
            //update the break in for that staff
            //get the break in time first
            $param4 = array(
                array(":StaffInternID", strip_tags($data['StaffInternID'])),
                array(":InternAttendanceID", strip_tags($data['InternAttendanceID']))
            );
            $query4 = "SELECT   InternAttendanceBreakInOutID ,`BreakInTime` FROM `Intern_Attendance_BreakInOut`
            WHERE `StaffInternID`=:StaffInternID  and `StaffAttendanceID`=:InternAttendanceID  and `BreakOutTime` is NULL";

            $BreakinTime = DBController::sendData($query4, $param4);
            $inTime = $BreakinTime['BreakInTime'];
            $InternAttendanceBreakInOutID = $BreakinTime['InternAttendanceBreakInOutID'];


            $time1 = strtotime($inTime);
            $time2 = strtotime($BreakOutTime);
            // $Duration = ($time2 - $time1) / 60;
            $Duration = round(($time2 - $time1) / 60);
            // $durationIn12HourFormat = date('h:i A', mktime(0, $Duration));

            $param = array(
                array(":StaffInternID", strip_tags($data['StaffInternID'])),
                array(":StaffAttendanceID", strip_tags($data['InternAttendanceID'])),
                array(":BreakOutTime", $BreakOutTime),
                array(":Duration", $Duration),
                array(":InternAttendanceBreakInOutID", $InternAttendanceBreakInOutID), //get the id for update
                array(":UpdatedBy", $_SESSION["UserID"])
            );
            $query = "UPDATE `Intern_Attendance_BreakInOut` SET `BreakOutTime`=:BreakOutTime,`Duration`=:Duration,`UpdatedByID`=:UpdatedBy
            WHERE `StaffAttendanceID`=:StaffAttendanceID and `StaffInternID`=:StaffInternID and InternAttendanceBreakInOutID=:InternAttendanceBreakInOutID;";
            $StaffBreakInoutUpdateRes = DBController::ExecuteSQL($query, $param);
            if ($StaffBreakInoutUpdateRes) {
                //set the isBreakInOut to 0 (Staff back to work)
                $param3 = array(
                    array(":StaffAttendanceID", strip_tags($data['InternAttendanceID'])),
                    array(":StaffInternID", strip_tags($data['StaffInternID']))
                );
                //update in intern attendance also
                $query3 = "UPDATE `Intern_Attendance` SET `isBreakInOut`=0
                WHERE `StaffAttendanceID`=:StaffAttendanceID and `InternID`=:StaffInternID;";
                $res = DBController::ExecuteSQL($query3, $param3);
                if ($res) {
                    return array("return_code" => true, "return_data" => "End of Break");
                }
            }
        }
        //add new Break in 
        else {
            $EntryTime = date("h:i:sa");
            $param = array(
                array(":BreakOption", strip_tags($data['BreakOption'])),
                array(":StaffInternID", strip_tags($data['StaffInternID'])),
                array(":StaffAttendanceID", strip_tags($data['InternAttendanceID'])),
                array(":BreakInTime", $EntryTime),
                array(":CreatedBy", $_SESSION["UserID"])
            );
            $query = "INSERT INTO `Intern_Attendance_BreakInOut`(`BreakOptionID`, `StaffInternID`, `StaffAttendanceID`, `BreakInTime`,  `CreatedByID`)
            VALUES (:BreakOption,:StaffInternID,:StaffAttendanceID,:BreakInTime,:CreatedBy)";
            $BreakinOutRes = DBController::ExecuteSQL($query, $param);
            if ($BreakinOutRes) {
                //update in staff attendance also so that we will know that staff on that day is on break
                $param1 = array(
                    array(":StaffAttendanceID", strip_tags($data['InternAttendanceID'])),
                    array(":InternID", strip_tags($data['StaffInternID']))
                );
                $query1 = "UPDATE `Intern_Attendance` SET `isBreakInOut`=1  WHERE `StaffAttendanceID`=:StaffAttendanceID and `InternID`=:InternID";
                $updateStaffBreakinOutTime = DBController::ExecuteSQL($query1, $param1);
                if ($updateStaffBreakinOutTime) {
                    return array("return_code" => true, "return_data" => "Taking a Break");
                }
            }
        }
    }

    /*  Info:
        Param : {StaffInternID,InternAttendanceID}
        Description: To Logout the attendance for Intern Today Attendance
            30-01-2024 (Devkanta) : Adding the function
    */
    function  SignOutInternForToday($data)
    {
        //check if already marked
        if (isset($data['StaffInternID'])) {
            //logout user for today
            $param = array(
                array(":StaffInternID", strip_tags($data['StaffInternID'])),
                array(":InternAttendanceID", strip_tags($data['InternAttendanceID']))
            );
            $query = "UPDATE `Intern_Attendance` SET `StaffOut`=CURTIME(), isCheckOut = 1 WHERE `StaffAttendanceID`=:InternAttendanceID and `InternID`=:StaffInternID";
            $checkOutUser = DBController::ExecuteSQL($query, $param);
            if ($checkOutUser) {
                return array("return_code" => true, "return_data" => "Successfully Checkout");
            } else {
                return array("return_code" => false, "return_data" => "An Error occur while checking out");
            }
        } else {
            return array("return_code" => false, "return_data" => "Invalid User data");
        }
    }


    function getInternReportByDate($data)
    {
        $param = array(

            array(":AttendanceDate", strip_tags($data['attendanceDate'])),
        );

        $query = "SELECT  ia.StaffAttendanceID ,ia.AttendanceDate,ia.Status,ia.StaffIn,ia.StaffOut,si.StaffInternName  from  Intern_Attendance ia 
        INNER JOIN	Staff_Intern si on ia.InternID = si.StaffInternID WHERE DATE(ia.AttendanceDate) =:AttendanceDate;";
        $res = DBController::getDataSet($query, $param);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        } else {
            return array("return_code" => false, "return_data" => "No data Found for " . $data['attendanceDate']);
        }
    }


    function getInternReportByYear($data)
    {
        $param = array(

            array(":AttendanceYear", strip_tags($data['attendanceYear'])),
        );

        $query = "SELECT 
        si.StaffInternID,
        si.StaffInternName,
        COUNT(CASE WHEN ia.Status = 1 THEN 1 END) AS TotalPresent,
        COUNT(CASE WHEN ia.Status = 0 THEN 1 END) AS TotalAbsent
    FROM Intern_Attendance ia
    INNER JOIN Staff_Intern si ON ia.InternID = si.StaffInternID
    WHERE YEAR(ia.AttendanceDate)=:AttendanceYear
    GROUP BY si.StaffInternID, si.StaffInternName;";
        $res = DBController::getDataSet($query, $param);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        } else {
            return array("return_code" => false, "return_data" => "No Data Found for  Year " . $data['attendanceYear']);
        }
    }

    function getReportByYearMonthInternID($data)
    {
        //year, month, InternID
        $param = array(

            array(":AttendanceYear", strip_tags($data['Year'])),
            array(":AttendanceMonth", strip_tags($data['Month'])),
            array(":StaffInternID", strip_tags($data['InternID'])),
        );

        $query = "SELECT 
        si.StaffInternID,
        si.StaffInternName,
        COUNT(CASE WHEN ia.Status = 1 THEN 1 END) AS TotalPresent,
        COUNT(CASE WHEN ia.Status = 0 THEN 1 END) AS TotalAbsent
    FROM Intern_Attendance ia
    INNER JOIN Staff_Intern si ON ia.InternID = si.StaffInternID
    WHERE YEAR(ia.AttendanceDate)=:AttendanceYear AND MONTH(ia.AttendanceDate)=:AttendanceMonth AND StaffInternID=:StaffInternID
    GROUP BY si.StaffInternID, si.StaffInternName;";
        $res = DBController::getDataSet($query, $param);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        } else {
            return array("return_code" => false, "return_data" => "No Data Found ");
        }
    }


 


    /*  Info:
        Param : {}
        Description:  this function will  get the Total Present,Absent for Intern Attendance and use for counting the total number of Present and Absent
            03-02-2024 (Devkanta) : Adding the function
    */
    function getAllCountAttendanceReport()
    {

        // totalpresenttoday
        $query = "SELECT  COUNT(CASE WHEN ia.Status = 1 THEN 1 END) AS totalpresenttoday  FROM Intern_Attendance ia  WHERE   DATE(ia.AttendanceDate) = CURDATE();";
        $TotalPresentToday = DBController::sendData($query);

        // totalabsenttoday
        $query1 = "SELECT  COUNT(CASE WHEN ia.Status = 0 THEN 1 END) AS totalabsenttoday  FROM Intern_Attendance ia  WHERE   DATE(ia.AttendanceDate) = CURDATE();";
        $TotalAbsentToday = DBController::sendData($query1);


        // totalpresentyesterday
        $query2 = "SELECT  COUNT(CASE WHEN ia.Status = 1 THEN 1 END) AS totalpresentyesterday  FROM Intern_Attendance ia  WHERE   DATE(ia.AttendanceDate) = CURDATE() - INTERVAL 1 DAY;";
        $TotalPresentYesterday = DBController::sendData($query2);


        // totalabsentyesterday
        $query3 = "SELECT  COUNT(CASE WHEN ia.Status = 0 THEN 1 END) AS totalabsentyesterday  FROM Intern_Attendance ia  WHERE   DATE(ia.AttendanceDate) = CURDATE() - INTERVAL 1 DAY;";
        $TotalAbsentYesterday = DBController::sendData($query3);

        return array("return_code" => true, "TotalPresentToday" => $TotalPresentToday, "TotalAbsentToday" => $TotalAbsentToday, "TotalPresentYesterday" => $TotalPresentYesterday, "TotalAbsentYesterday" => $TotalAbsentYesterday);
    }

    /*  Info:
        Description: this function will get the basic details of  Intern BreakInTime and BreakOutTime information Which accepts two parameters i,e UserId and Attendance Date
        param {UserID,AttendanceDate}
            05-02-2024 (Devkanta) : Added the function
    */

    function getUserBreakTimeList($data)
    {
        $param = array(
            array(":UserID", strip_tags($data['UserID'])),
            array(":AttendanceDate", strip_tags($data['AttendanceDate'])),
        );
        $returnDate = date("Y-m-d");
        $returnMessage = "No Break Data for " . $returnDate;

        $query = "SELECT iab.StaffInternID ,iab.BreakInTime,iab.BreakOutTime,iab.CreatedDateTime,sab.BreakOption,sab.BreakIcon,si.StaffInternName  from  Intern_Attendance_Breakinout iab 
        inner join Staff_Attendance_breakoption sab  on iab.BreakOptionID = sab.BreakOptionID 
        inner join Staff_Intern si on si.StaffInternID = iab.StaffInternID  WHERE iab.StaffInternID=:UserID AND  DATE(iab.CreatedDateTime) = :AttendanceDate;";
        $res = DBController::getDataSet($query, $param);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        } else {
            return array("return_code" => false, "return_data" =>  $returnMessage);
        }
    }

    /*  Info:
        Description: this function will get the basic details of  all the  interns like Total Presents and Total Absent and Load The Charts
        param {}
            05-02-2024 (Devkanta) : Added the function
    */
    function getAttendanceChart()
    {

        $query = "SELECT
            si.StaffInternName,ia.AttendanceDate,
            DATE_FORMAT(ia.AttendanceDate, '%b') AS AttendanceMonth,
            COUNT(CASE WHEN ia.Status = 1 THEN 1 END) AS TotalPresent,
            COUNT(CASE WHEN ia.Status = 0 THEN 1 END) AS TotalAbsent
        FROM
            Staff_Intern si
        INNER JOIN
            Intern_Attendance ia ON ia.InternID = si.StaffInternID
        GROUP BY
            si.StaffInternName, AttendanceMonth  ORDER BY  AttendanceMonth DESC;";

        $res = DBController::getDataSet($query);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        }
        return array("return_code" => false, "return_data" => "No data Found.");
    }

    /*  Info:
        Description: this function will get all the attendance based on month and for the particular Interns 
        param {Month,StaffInternID}
            06-02-2024 (Devkanta) : Added the function
    */
    function getInternAttendancebyMonth($data)
    {
        $param = array(
            array(":Month", strip_tags($data['Month'])),
            array(":StaffInternID", strip_tags($data['StaffInternID']))
        );

        $query = "SELECT ia.AttendanceDate ,ia.Status ,ia.StaffIn ,ia.StaffOut,ia.LatitudeIN ,ia.LatitudeOut    FROM Intern_Attendance ia  where ia.InternID=:StaffInternID and Month(ia.AttendanceDate)=:Month";
        $res = DBController::getDataSet($query, $param);
        return array("return_code" => true, "return_data" => $res);
    }

    /*  Info:
       
        Description: this function will get all the attendance report of that Particluar Intern in a particular year
        param {StaffInternID,Year}
            06-02-2024 (Devkanta) : Added the function
    */
    function getInternAttendancebyYear($data)
    {
        $param = array(
            array(":Year", strip_tags(trim($data['Year']))),
            array(":StaffInternID", strip_tags($data['StaffInternID']))
        );

        $query = "SELECT ia.`InternID`,SUM(CASE WHEN ia.Status=1 then 1 else 0 END) AS Present,SUM(CASE WHEN ia.Status=0 then 1 else 0 END) AS 'Absent' ,SUM(CASE WHEN ia.Status=2 then 1 else 0 END) AS 'Onleave',count(ia.Status) AS 'All',
        MONTH(ia.AttendanceDate) AS Month
         FROM `Intern_Attendance` ia
         INNER JOIN Staff_Intern si on ia.InternID =si.StaffInternID
         WHERE year(ia.AttendanceDate)=:Year AND  si.StaffInternID =:StaffInternID
         GROUP BY si.StaffInternID,month(ia.AttendanceDate);";
        $res = DBController::getDataSet($query, $param);

        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        } else {
            return array("return_code" => false, "return_data" => "No data available for " . $data['Year']);
        }
    }

    /*  Info:
       Info:
        Description:  this function will get all distinct year from the attendance
            06-02-2024 (Devkanta) : Added the function
    */
    function getInternAttendanceYear()
    {
        $query = "SELECT DISTINCT EXTRACT(YEAR FROM  Date(sa.AttendanceDate)) AS Year FROM Intern_Attendance sa;";
        $res = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $res);
    }
}
