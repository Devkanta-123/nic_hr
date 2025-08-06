<?php
 /* 
    Current Version: 1.0.0
    Created By: Angelbert,     prayagedu@techz.in
    Created On: 31/01/2024
    Modified By:
    Modified On:  
*/
namespace app\modules\staff\classes; 
use app\database\DBController;

class CronJob
{

     /*  Info:
         -- this function will be Called from cron job STAFF Attendance
    
        Description: To update the attendance for the staff/intern in a current  day 
            31-01-2024 (Angelbert Riahtam) : Addd the function
    */
    public function UpdatePendingStaffAttendance()
    {
        DBController::logs('Reached');
        /* 
            TASK 1 
                -- get all the present/ absent Staff in a day
                for absent
                -- Mark Absent on attendance only

                for Present Staff
                -- check if Timeout in there or not
                    -- if not there Add Timeout=Timein+60minute 
                    -- update the islate (if Timein is more than 10 minute after office hour)
                    -- ishalfday (if the timeout is more than 4 hour based on timein then considered half day)
                    -- isEarlyOut ( out 1 hour before the office time) 
                
                -- if Timeout is there then Update onlyy the 
                    -- islate
                    -- ishalfday
                    -- isearlyout       
        */ 

        //for staff
        //get all the staff both present/Absent in the current day an the office timing for that staff
        $query="SELECT s.StaffName,s.StaffID,IFNULL(sat.StaffAttendanceID,-1) as StaffAttendanceID,IFNULL(sat.Status,-1) as Status, IFNULL(sat.StaffOut,-1) as StaffOut ,  IFNULL(sat.StaffIn,-1) as SatffIn,so.OfficeTimIN ,so.OfficeTimeOut 
        FROM Staff s
        LEFT JOIN Staff_Attendance  sat on sat.StaffID=s.StaffID and DATE(sat.AttendanceDate) = CURDATE() and s.isRemoved=0
        LEFT  JOIN Settings_Office so on so.OfficeID =s.OfficeID 
        where s.isRemoved = 0";
    
        $allStaff=DBController::getDataSet($query);
        foreach($allStaff as $staff)
        {
            if($staff['StaffAttendanceID']==-1) //absent staff
            {
                //check if staff is on leave  
                $param6=array(
                    array(":StaffID",$staff['StaffID'])
                );

                $query6="SELECT * FROM 
                `Staff_Leave`
                WHERE StaffID=:StaffID and isApproved=1 and DATE(ApprovedDateFrom)<=CURDATE() and  DATE(ApprovedDateTo)>=Curdate();";
                $Staffonleave=DBController::sendData($query6,$param6);
                if($Staffonleave)
                {
                    //mark as on leave
                    $param1=array(
                        array(":StaffID",$staff['StaffID'])
                    );
                    $query1="INSERT INTO `Staff_Attendance`(`AttendanceDate`, `StaffID`, `Status`)
                    VALUES (CURDATE(),:StaffID,2)";
                    $UpdateStaffAttendance=DBController::ExecuteSQL($query1,$param1);
                }
                else
                {
                    //if staff is not on leave then mark as absent
                    $param1=array(
                        array(":StaffID",$staff['StaffID'])
                    );
                    //TODO check if their is any entry for this staff if yes then update that to Absent
                    $query1="INSERT INTO `Staff_Attendance`(`AttendanceDate`, `StaffID`, `Status`)
                    VALUES (CURDATE(),:StaffID,0)";
                    $UpdateStaffAttendance=DBController::ExecuteSQL($query1,$param1);
                }  
            }

            //for present staff
            else
            {
                // check for staffOUt time
                // if time out is there
                if(isset($staff['StaffOut']))
                {
                    $StaffTimeIn=strtotime($staff['SatffIn']);
                    $officeTimeIn=strtotime($staff['OfficeTimIN']);
                   
                    $lateTime=$officeTimeIn + (60 * 10); //add 10 miinute to office timein
                    //check is late
                    if($StaffTimeIn >  $lateTime)
                    {
                        $islate=1;
                    }
                    else{
                        $islate=0;
                    }

                    // check is halfday

                    if($StaffTimeIn < ($staff['StaffOut']+(60*60*4)))
                    {
                        $ishalfday=1;
                    }
                    else{
                        $ishalfday=0;
                    }
                   
                    // check is EarlyOut  $staff['OfficeTimeOut']

                    $officeTimeOut=strtotime($staff['OfficeTimeOut']);
                    $StaffTimeOut=strtotime($staff['StaffOut']);

                    $EarlyOutTime=($StaffTimeOut-$officeTimeOut)/60;

                        // $time_def = ($time2-$time1)/60;
                    if($EarlyOutTime > 10 )
                    {
                        $isEarlyout=1;
                    }
                    else{
                        $isEarlyout=0;
                    }
                    
                    // need to update the islate,earlyout,ishalfday
                    $param4=array(
                        array(":isLate",$islate),
                        array(":isHalfDay",$ishalfday),
                        array(":isEarlyOut",$isEarlyout),
                        array(":StaffAttendanceID",$staff['StaffAttendanceID']),
                        array(":StaffID",$staff['StaffID'])
                    );
                    $query4="UPDATE `Staff_Attendance` SET `IsLateIn`=:isLate,`isHalfDay`=:isHalfDay,`isEarlyOut`=:isEarlyOut
                    WHERE `StaffAttendanceID`=:StaffAttendanceID and `StaffID`=:StaffID";
                    $res4=DBController::ExecuteSQL($query4,$param4);

                }
                else{

                    //add staff out time and islate,earlyout,ishalfday
                    $StaffTimeIn=strtotime($staff['SatffIn']);
                    $staffOut=($StaffTimeIn+(60*60)); //add 60 minute to staffin Time and put in staff  out
                    $staffOut=date('H:i:s', $staffOut);

                    if($StaffTimeIn > $StaffTimeIn+10)
                    {
                        $islate=1;
                    }
                    else{
                        $islate=0;
                    }
                    
                   
                    $param4=array(
                        array(":StaffOut",$staffOut),
                        array(":isLate",$islate),
                        array(":isHalfDay",1),
                        array(":isEarlyOut",1),
                        array(":StaffAttendanceID",$staff['StaffAttendanceID']),
                        array(":StaffID",$staff['StaffID'])
                    );
                    $query4="UPDATE `Staff_Attendance` SET `StaffOut`=:StaffOut,`IsLateIn`=:isLate,`isHalfDay`=:isHalfDay,`isEarlyOut`=:isEarlyOut
                    WHERE `StaffAttendanceID`=:StaffAttendanceID and `StaffID`=:StaffID";
                    $res4=DBController::ExecuteSQL($query4,$param4);

                }
                
            }
        }
        return array("return_code" => true, "return_data" => "Task Completed Sucessfully");
    }

    public function UpdatePendingInternAttendance()
    {
        //for staff
        //get all the staff both present/Absent in the current day an the office timing for that staff
        $query="SELECT si.StaffInternName,si.StaffInternID ,IFNULL(sat.StaffAttendanceID,-1) as StaffAttendanceID,IFNULL(sat.Status,-1) as Status,
        IFNULL(sat.StaffOut,-1) as StaffOut ,  IFNULL(sat.StaffIn,-1) as SatffIn, IFNULL(so.OfficeID ,-1) as OfficeID,so.OfficeTimIN ,so.OfficeTimeOut 
        FROM Staff_Intern si
        LEFT JOIN Intern_Attendance  sat on sat.InternID =si.StaffInternID  and DATE(sat.AttendanceDate) = CURDATE() and si.isRemoved=0
        LEFT  JOIN Settings_Office so on so.OfficeID =si.OfficeID 
        where si.isRemoved = 0";
    
        $allIntern=DBController::getDataSet($query);
        foreach($allIntern as $staff)
        {
            //office ID Notset  
            if($staff['OfficeID']==-1)
            {
                    //TODO if office is not there MAYbe WFH option
            }
            
            else 
            {

                if($staff['StaffAttendanceID']==-1) //absent staff
                {

                    //no leave for intern  (MARK As ABSENT ONLY)

                    $param1=array(
                        array(":StaffID",$staff['StaffInternID'])
                    );
                    $query1="INSERT INTO `Intern_Attendance`(`AttendanceDate`, `InternID`, `Status`)
                    VALUES (CURDATE(),:StaffID,0)";
                    $UpdateStaffAttendance=DBController::ExecuteSQL($query1,$param1);

                    // #######################    NOT REQUIRED (TO REMOVE) ######################

                    //check if Intern  is on leave  
                    //store in same table for Intern also
                    // $param6=array(
                    //     array(":StaffID",$staff['StaffInternID'])
                    // );
                    // $query6="SELECT * FROM 
                    // `Staff_Leave`
                    // WHERE StaffID=:StaffID and isApproved=1 and DATE(ApprovedDateFrom)<=CURDATE() or DATE(ApprovedDateTo)  >=Curdate();";

                    // $Staffonleave=DBController::sendData($query6,$param6);
                    // if($Staffonleave)
                    // {
                    //     $param1=array(
                    //         array(":StaffID",$staff['StaffInternID'])
                    //     );
                    //     $query1="INSERT INTO `Intern_Attendance`(`AttendanceDate`, `InternID`, `Status`)
                    //     VALUES (CURDATE(),:StaffID,2)";
                    //     $UpdateStaffAttendance=DBController::ExecuteSQL($query1,$param1);
                    // }
                    // else
                    // {
                    //     $param1=array(
                    //         array(":StaffID",$staff['StaffInternID'])
                    //     );
                    //     $query1="INSERT INTO `Intern_Attendance`(`AttendanceDate`, `InternID`, `Status`)
                    //     VALUES (CURDATE(),:StaffID,0)";
                    //     $UpdateStaffAttendance=DBController::ExecuteSQL($query1,$param1);
                    // }  
                }

                //for present Intern
                else
                {
                    // check for staffOUt time
                    // if time out is there
                    if(isset($staff['StaffOut']))
                    {
                        $StaffTimeIn=strtotime($staff['SatffIn']);
                        $officeTimeIn=strtotime($staff['OfficeTimIN']);
                    
                        $lateTime=$officeTimeIn + (60 * 10); //add 10 miinute to office timein
                        //
                        if($StaffTimeIn <  $lateTime)
                        {
                            $islate=1;
                        }
                        else{
                            $islate=0;
                        }

                        // check is halfday
                        if($StaffTimeIn < ($staff['StaffOut']+(60*60*4)))
                        {
                            $ishalfday=1;
                        }
                        else{
                            $ishalfday=0;
                        }
                    
                        // check is EarlyOut  $staff['OfficeTimeOut']

                        $officeTimeOut=strtotime($staff['OfficeTimeOut']);
                        $StaffTimeOut=strtotime($staff['StaffOut']);

                        $EarlyOutTime=($StaffTimeOut-$officeTimeOut)/60;

                        // $time_def = ($time2-$time1)/60;
                        if($EarlyOutTime > 10 )
                        {
                            $isEarlyout=1;
                        }
                        else{
                            $isEarlyout=0;
                        }
                        
                        // need to update the islate,earlyout,ishalfday
                        $param4=array(
                            array(":isLate",$islate),
                            array(":isHalfDay",$ishalfday),
                            array(":isEarlyOut",$isEarlyout),
                            array(":StaffAttendanceID",$staff['StaffAttendanceID']),
                            array(":StaffID",$staff['StaffInternID'])  
                        );
                        $query4="UPDATE `Intern_Attendance` SET `IsLateIn`=:isLate,`isHalfDay`=:isHalfDay,`isEarlyOut`=:isEarlyOut 
                        WHERE `StaffAttendanceID`=:StaffAttendanceID and `InternID`=:StaffID";
                        $res4=DBController::ExecuteSQL($query4,$param4);

                    }
                    else{

                        //add staff out time and islate,earlyout,ishalfday
                        $StaffTimeIn=strtotime($staff['SatffIn']);
                        $staffOut=($StaffTimeIn+(60*60)); //add 60 minute to staffin Time and put in staff  out
                        $staffOut=date('H:i:s', $staffOut);

                        //is late
                        if($StaffTimeIn > $StaffTimeIn+10)
                        {
                            $islate=0;
                        }
                        else{
                            $islate=1;
                        }
                        
                        $param4=array(
                            array(":StaffOut",$staffOut),
                            array(":isLate",$islate),
                            array(":isHalfDay",1),  //set as 1 because staff out timme is not there 
                            array(":isEarlyOut",1), // same for this one also
                            array(":StaffAttendanceID",$staff['StaffAttendanceID']),
                            array(":StaffID",$staff['StaffInternID'])
                        );
                        $query4="UPDATE `Intern_Attendance` SET `StaffOut`=:StaffOut,`IsLateIn`=:isLate,`isHalfDay`=:isHalfDay,`isEarlyOut`=:isEarlyOut
                        WHERE `StaffAttendanceID`=:StaffAttendanceID and `InternID`=:StaffID";
                        $res4=DBController::ExecuteSQL($query4,$param4);

                    }
                    
                }

            }
        }
        return array("return_code" => true, "return_data" => "Task Completed Sucessfully");
    }


}