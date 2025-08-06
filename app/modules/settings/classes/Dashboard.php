<?php

namespace app\modules\settings\classes;

use app\database\DBController;

class Dashboard
{
    function getDashboard($data)
    {
        $query ="call p_Dashboard()";
        $res = DBController::sendData($query);

//        $query ="call p_MonthlyFilesDownloaded()";
        $query ="SELECT MONTHNAME(Attendance.AttendanceDate) As Months, SUM(CASE WHEN Attendance.Status=1 THEN 1 ELSE 0 END) AS Present, SUM(CASE WHEN Attendance.Status=2 THEN 1 ELSE 0 END) AS Absent, SUM(CASE WHEN Attendance.Status=3 THEN 1 ELSE 0 END) AS Leaves FROM Attendance INNER JOIN Academics_Info ON Academics_Info.AcademicID= Attendance.AcademicID GROUP BY MONTHNAME(Attendance.AttendanceDate)";
        $monthlyAttendance = DBController::getDataSet($query);

        return array("return_code" => true, "return_data" => $res, "monthlyAttendance" => $monthlyAttendance );
    }

    //get user visited in a day
    function getAllvisitedUserInaDay()
    {

        //Today Visit
        $query="SELECT Count(*) as TotalVisitInADay FROM `IPLogging` where date(AccessTime)=Curdate();";
        $res=DBController::sendData($query);

        //OverAll Visit
        $query1="SELECT Count(*) as TotalVisit FROM `IPLogging`;";
        $res1=DBController::sendData($query1);

        //get all Active applicants
        $applicants="SELECT count(*) as totalApplicants FROM `Prayagedu_Applicants` where isActive=1";
        $TotalApplicants=DBController::sendData($applicants);

        //Active Job
        $Activejob="SELECT count(*)  as totalActive FROM `Prayagedu_Careers` where isActive=1;";
        $TotalactiveJob=DBController::sendData($Activejob);


        $ActiveDepartment = "SELECT count(*) as totaldept  FROM `Settings_Department`  ";
        $TotalactiveDepartment=DBController::sendData($ActiveDepartment);

        $ActiveStaff = "SELECT count(*) as totalstaff  FROM `Staff` WHERE isRemoved  = 0 ";
        $TotalactiveStaff=DBController::sendData($ActiveStaff); 
        



        return array("return_code" => true, "return_data" => $res,"TotalVisit" => $res1, "TotalActiveJob" => $TotalactiveJob , "TotalApplicants" => $TotalApplicants , "TotalactiveDepartment" => $TotalactiveDepartment , "TotalactiveStaff" => $TotalactiveStaff); 
      
    }

}