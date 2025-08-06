<?php

/*
    Current Version: 1.0.0
    Created By: Angelbert,     prayagedu@techz.in
    Created On: 24-01-2024
    Modified By:
    Modified On:
*/

namespace app\modules\staff\classes;

use app\database\DBController;
use app\misc\Sodium;

class StaffAttendance
{

    /*  Info:
        Param : {AttendanceDate,StaffDesignationID}
        Description: get the Active staff based on designation and date  for attendance
            24-01-2024 (Angelbert Riahtam) : Adding the function
    */
    public function getStaffForAttendance($data)
    {
        $day = date_format(date_create($data["AttendanceDate"]), 'D');
        if ($day == "Sun") {
            return array("return_code" => false, "return_data" => "It is sunday");
        }

        $params = array(
            array(":StaffDesignationID", strip_tags($data["StaffDesignationID"])),
            array(":AttendanceDate", strip_tags($data["AttendanceDate"])),
        );

        $query = "SELECT s.StaffID,s.StaffName,IFNULL(sat.StaffAttendanceID,-1) as StaffAttendanceID,IFNULL(sat.Status,-1) as Status, IFNULL(sat.StaffOut,-1) as StaffOut , IFNULL(sat.isBreakInOut,-1) as BreakInOut, IFNULL(sat.StaffIn,-1) as SatffIn,so.OfficeTimIN ,so.OfficeTimeOut 
        FROM Staff s
        LEFT JOIN Staff_Attendance  sat on sat.StaffID=s.StaffID and DATE_FORMAT(sat.AttendanceDate,'%Y/%m/%d') = DATE_FORMAT(:AttendanceDate,'%Y/%m/%d') and s.isRemoved=0
        LEFT  JOIN Settings_Office so on so.OfficeID =s.OfficeID 
        where s.DesignationID=:StaffDesignationID and s.isRemoved =0;";

        $res = DBController::getDataSet($query, $params);
        return array("return_code" => true, "return_data" => $res);
    }

    /*  Info:
        Param : {AttendanceDate,Designation,staffId,Status}
        Description: To Update/Add the staff attendance status
            24-01-2024 (Angelbert Riahtam) : Adding the function
    */
    public function updateIndividualAttendance($data)
    {

        //check if already  mark attendance
        $params = array(
            array(":AttendanceDate", strip_tags($data["AttendanceDate"])),
            array(":staffId", strip_tags($data["staffId"]))
        );
        $query = "SELECT StaffAttendanceID from Staff_Attendance where 
        StaffID=:staffId and AttendanceDate=:AttendanceDate";
        $attendncedetails = DBController::sendData($query, $params);


        if (!$attendncedetails) //if not available then insert 
        {
            //get IN time and out time of the staff and add here LAT IN and LAT out of the school, SessionID , AttendanceModeId
            $params = array(
                array(":AttendanceDate", strip_tags($data["AttendanceDate"])),
                array(":EntryBy", $_SESSION["UserID"]),
                array(":staffId", strip_tags($data["staffId"])),
                array(":Status", strip_tags($data["Status"])),
                array(":SessionID", 1), //we usually do not use this

            );
            $query = "INSERT INTO `Staff_Attendance`(`AttendanceDate`, `StaffID`, `Status`, `EntryBy`,SessionID )
            VALUES (:AttendanceDate,:staffId,:Status,:EntryBy,:SessionID)";
            $res = DBController::ExecuteSQL($query, $params);
            return array("return_code" => true, "return_data" => "Successfully Marked !!");
        } else {  //otherwise update the status 
            $params = array(
                array(":AttendanceID", $attendncedetails["StaffAttendanceID"]),
                array(":staffId", $data["staffId"]),
                array(":Status", $data["Status"])
            );
            $query = "UPDATE Staff_Attendance SET Status=:Status WHERE StaffAttendanceID=:AttendanceID and `StaffID`=:staffId;";
            $res = DBController::executeSQL($query, $params);
            return array("return_code" => true, "return_data" => "Successfully updated !!");
        }
    }

    /*  Info:
        Param : {AttendanceDate,Designation,AttendanceData[StaffID->integer,Status->Boolean]}
        Description: To Update/Add the staff attendance status
            24-01-2024 (Angelbert Riahtam) : Adding the function
    */
    public function giveManualAttendance($data)
    {
        date_default_timezone_set('Asia/Kolkata');
        $data["AttendanceDate"] = date('Y-m-d', strtotime($data["AttendanceDate"]));
        $status = 0;
        for ($i = 0; $i < count($data["AttendanceData"]); $i++) {
            if ($data["AttendanceData"][$i]["Status"] == 0) {
                $EntryTime = null;
            } else {
                $EntryTime = date("H:i:s");
            }
            $params = array(
                array(":AttendanceDate", $data["AttendanceDate"]),
                array(":EntryTime", $EntryTime),
                array(":EntryBy", $_SESSION["UserID"]),
                array(":StaffID", $data["AttendanceData"][$i]["StaffID"]),
                array(":Status", $data["AttendanceData"][$i]["Status"]),
                array(":SessionID", 1), //we do not use this one for now

            );
            $query = "INSERT INTO Staff_Attendance(AttendanceDate,StaffIn,EntryBy,StaffID,Status,SessionID) 
                    VALUES (:AttendanceDate,:EntryTime,:EntryBy,:StaffID,:Status,:SessionID);";
            $res = DBController::ExecuteSQL($query, $params);
            if ($res) {
                $status = $data["AttendanceData"][$i]["Status"];
            }
        }
        return array("return_code" => true, "return_data" => "Successfully Added");
    }


    /*  Info:
        Param : {StaffAttendanceID,StaffID}
        Description: To Logout the attendance for Today Attendance
            26-01-2024 (Angelbert Riahtam) : Adding the function
    */
    function SignOutUserForToday($data)
    {
        //check that staff should only logout in that day only
        $param1 = array(
            array(":StaffAttendanceID", strip_tags($data['StaffAttendanceID'])),
            array(":StaffID", strip_tags($data['StaffID']))
        );
        $query1 = "SELECT sa.AttendanceDate  FROM Staff_Attendance sa  
        WHERE sa.StaffAttendanceID =:StaffAttendanceID and sa.StaffID =:StaffID and DATE()";
        $AttendanceDate = DBController::sendData($query1, $param1);
        // if($AttendanceDate==)


        //check if already marked
        if (isset($data['StaffAttendanceID'])) {
            //logout user for today
            $param = array(
                array(":StaffID", strip_tags($data['StaffID'])),
                array(":StaffAttendanceID", strip_tags($data['StaffAttendanceID']))
            );
            $query = "UPDATE `Staff_Attendance` SET `StaffOut`=NOW() WHERE `StaffAttendanceID`=:StaffAttendanceID and `StaffID`=:StaffID";
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


    /*  Info:
        BreakIn Param : {BreakOption,StaffAttendanceID,StaffID} 
        BreakOut Param : { StaffAttendanceID,StaffID,BreakInOut}
        Description: To Keep track of staff Breakin  and out
            27-01-2024 (Angelbert Riahtam) : Adding the function
    */
    function StaffBreakInOut($data)
    {
        date_default_timezone_set('Asia/Kolkata');


        //update break in 
        if (isset($data['BreakInOut']) && $data['BreakInOut'] == 1) {
            $BreakOutTime = date("H:i:s");
            //update the break in for that staff
            //get the break in time first
            $param4 = array(
                array(":StaffId", strip_tags($data['StaffID'])),
                array(":StaffAttendanceID", strip_tags($data['StaffAttendanceID']))
            );
            $query4 = "SELECT  `BreakInTime` FROM `Staff_Attendance_BreakInOut`
            WHERE `StaffID`=:StaffId  and `StaffAttendanceID`=:StaffAttendanceID  and `BreakOutTime` is NULL";

            $BreakinTime = DBController::sendData($query4, $param4);
            $inTime = $BreakinTime['BreakInTime'];
            $time1 = strtotime($inTime);
            $time2 = strtotime($BreakOutTime);
            $Duration = ($time2 - $time1) / 60;
            // echo 'Minutes:'.$Duration;

            // $Duration=($BreakOutTime-$inTime);

            $param = array(
                array(":StaffId", strip_tags($data['StaffID'])),
                array(":StaffAttendanceID", strip_tags($data['StaffAttendanceID'])),
                array(":BreakOutTime", $BreakOutTime),
                array(":Duration", $Duration),
                array(":UpdatedBy", $_SESSION["UserID"])
            );
            $query = "UPDATE `Staff_Attendance_BreakInOut` SET `BreakOutTime`=:BreakOutTime,`Duration`=:Duration,`UpdatedByID`=:UpdatedBy
            WHERE `StaffAttendanceID`=:StaffAttendanceID and `StaffID`=:StaffId";
            $StaffBreakInoutUpdateRes = DBController::ExecuteSQL($query, $param);
            if ($StaffBreakInoutUpdateRes) {
                //set the isBreakInOut to 0 (Staff back to work)
                $param3 = array(
                    array(":StaffAttendanceID", strip_tags($data['StaffAttendanceID'])),
                    array(":StaffId", strip_tags($data['StaffID']))
                );
                //update in staff attendance also
                $query3 = "UPDATE `Staff_Attendance` SET `isBreakInOut`=0
                WHERE `StaffAttendanceID`=:StaffAttendanceID and `StaffID`=:StaffId;";
                $res = DBController::ExecuteSQL($query3, $param3);
                if ($res) {
                    return array("return_code" => true, "return_data" => "End of Break");
                }
            }
        }
        //add new Break in 
        else {
            $EntryTime = date("H:i:s");
            $param = array(
                array(":BreakOption", strip_tags($data['BreakOption'])),
                array(":StaffId", strip_tags($data['StaffID'])),
                array(":StaffAttendanceID", strip_tags($data['StaffAttendanceID'])),
                array(":BreakInTime", $EntryTime),
                array(":CreatedBy", $_SESSION["UserID"])
            );
            $query = "INSERT INTO `Staff_Attendance_BreakInOut`(`BreakOptionID`, `StaffID`, `StaffAttendanceID`, `BreakInTime`,  `CreatedByID`)
            VALUES (:BreakOption,:StaffId,:StaffAttendanceID,:BreakInTime,:CreatedBy)";
            $BreakinOutRes = DBController::ExecuteSQL($query, $param);
            if ($BreakinOutRes) {
                //update in staff attendance also so that we will know that staff on that day is on break
                $param1 = array(
                    array(":StaffAttendanceID", strip_tags($data['StaffAttendanceID'])),
                    array(":StaffID", strip_tags($data['StaffID']))
                );
                $query1 = "UPDATE `Staff_Attendance` SET `isBreakInOut`=1  WHERE `StaffAttendanceID`=:StaffAttendanceID and `StaffID`=:StaffID";
                $updateStaffBreakinOutTime = DBController::ExecuteSQL($query1, $param1);
                if ($updateStaffBreakinOutTime) {
                    return array("return_code" => true, "return_data" => "Taking a break");
                }
            }
        }
    }
    /**
     * 
     * 
     * 
     * 
     */

    // function breakInForApp($data)
    // {
    //     //insert a new entry for break in 
    //     $EntryTime = date("H:i:s");
    //     $param = array(
    //         array(":BreakOption", strip_tags($data['BreakOption'])),
    //         array(":StaffId", strip_tags($data['StaffID'])),
    //         array(":BreakInTime", $EntryTime),
    //         array(":CreatedBy", $_SESSION["UserID"])
    //     );

    //     $query = "INSERT INTO `Staff_Attendance_BreakInOut`(`BreakOptionID`, `StaffID`, `BreakInTime`,  `CreatedByID`)
    //     VALUES (:BreakOption,:StaffId,:BreakInTime,:CreatedBy)";
    //     $BreakinOutRes = DBController::ExecuteSQL($query, $param);
    //     if ($BreakinOutRes) {
    //         return array("return_code" => true, "return_data" => "Taking break");
    //     } else {
    //         //if any break-In open update with current time

    //         $param = array(
    //             array(":StaffID", $_SESSION["UserID"]),
    //         );
    //         $checkstaffbreak = "SELECT  *  FROM `Staff_Attendance_BreakInOut`
    //         WHERE `StaffID` =:StaffID  and DATE(CreatedDateTime)=CURDATE() AND  `BreakOutTime` is NULL";
    //         $checkBreakOutExists = DBController::getDataSet($checkstaffbreak, $param);
    //         if ($checkBreakOutExists) {
    //             $BreakOutTime = date("H:i:s");
    //             $param1 = array(
    //                 array(":StaffID", strip_tags($data['StaffID'])),
    //                 array(":BreakOutTime", $BreakOutTime),
    //             );
    //             $query1 = "UPDATE `Staff_Attendance_BreakInOut` SET `BreakOutTime`=:BreakOutTime WHERE `StaffID`=:StaffID";
    //             $updateStaffBreakinOutTime = DBController::ExecuteSQL($query1, $param1);

    //             if ($updateStaffBreakinOutTime) {
    //                 return array("return_code" => true, "return_data" => "End of the break");
    //             }
    //         } else {
    //             return array("return_code" => false, "return_data" => "Error.");
    //         }
    //     }

    //     // Check if there is an open break for the user
    //     $param1 = array(
    //         array(":StaffID", strip_tags($data['StaffID'])),
    //     );

    //     $checkOpenBreakQuery = "SELECT * FROM `Staff_Attendance_BreakInOut`
    //                         WHERE `StaffID` = :StaffID
    //                         AND DATE(CreatedDateTime) = CURDATE()
    //                         AND `BreakOutTime` IS NULL";
    //     $openBreakResult = DBController::getDataSet($checkOpenBreakQuery, $param1);

    //     if ($openBreakResult) {
    //         // If there is an open break, do not allow checkout
    //         return array("return_code" => false, "return_data" => "Cannot check out with an open break.");
    //     } else {
    //         // Proceed with the checkout logic
    //         return array("return_code" => true, "return_data" => "Checkout successful.");
    //     }
    // }

    // function breakInForApp($data)
    // {
    //     // Check if the staff is already on a break
    //     $paramCheck = array(
    //         array(":StaffID", strip_tags($data['StaffID'])),
    //     );

    //     $checkOpenBreakQuery = "SELECT * FROM `Staff_Attendance_BreakInOut`
    //                         WHERE `StaffID` = :StaffID
    //                         AND DATE(CreatedDateTime) = CURDATE()
    //                         AND `BreakOutTime` IS NULL";

    //     $openBreakResult = DBController::getDataSet($checkOpenBreakQuery, $paramCheck);

    //     // If the staff is on a break, update the existing entry
    //     if ($openBreakResult) {
    //         $BreakOutTime = date("H:i:s");
    //         $paramUpdate = array(
    //             array(":StaffID", strip_tags($data['StaffID'])),
    //             array(":StaffAttendanceBreakInOutID", strip_tags($data['StaffAttendanceBreakInOutID'])),
    //             array(":BreakOutTime", $BreakOutTime),
    //         );
    //         $queryUpdate = "UPDATE `Staff_Attendance_BreakInOut` SET `BreakOutTime`=:BreakOutTime WHERE `StaffID` =:StaffID AND `StaffAttendanceBreakInOutID` =:StaffAttendanceBreakInOutID";
    //         $updateStaffBreakoutTime = DBController::ExecuteSQL($queryUpdate, $paramUpdate);
    //         if ($updateStaffBreakoutTime) {
    //             return array("return_code" => true, "return_data" => "End of the break");
    //         } else {
    //             return array("return_code" => false, "return_data" => "Error updating break-out time.");
    //         }
    //     } else {
    //         // If the staff is not on a break, insert a new entry
    //         $EntryTime = date("H:i:s");
    //         $paramInsert = array(
    //             array(":BreakOption", strip_tags($data['BreakOption'])),
    //             array(":StaffId", strip_tags($data['StaffID'])),
    //             array(":BreakInTime", $EntryTime),
    //             array(":CreatedBy", $_SESSION["UserID"])
    //         );

    //         $queryInsert = "INSERT INTO `Staff_Attendance_BreakInOut`(`BreakOptionID`, `StaffID`, `BreakInTime`,  `CreatedByID`)
    //     VALUES (:BreakOption,:StaffId,:BreakInTime,:CreatedBy)";
    //         $breakInOutRes = DBController::ExecuteSQL($queryInsert, $paramInsert);

    //         if ($breakInOutRes) {
    //             return array("return_code" => true, "return_data" => "Taking break");
    //         } else {
    //             return array("return_code" => false, "return_data" => "Error inserting break-in entry.");
    //         }
    //     }
    // }

    function breakInForApp()
    {
        // Check if the staff is already on a break
        if (!isset($_SESSION['UserID']) && $_SESSION['UserType'] !== 2) {

            return array("return_code" => false, "return_data" => "Invalid user type");
        }
        $paramCheck = array(
            array(":StaffID", $_SESSION['StaffID']),
        );

        $checkOpenBreakQuery = "SELECT * FROM `Staff_Attendance_BreakInOut`
                            WHERE `StaffID` = :StaffID
                            AND DATE(CreatedDateTime) = CURDATE()
                            AND `BreakOutTime` IS NULL";

        $openBreakResult = DBController::getDataSet($checkOpenBreakQuery, $paramCheck);

        // If the staff is on a break, update the existing entry
        if ($openBreakResult) {
            $BreakOutTime = date("H:i:s");
            $paramUpdate = array(
                array(":StaffID", ($_SESSION['StaffID'])),
                array(":BreakOutTime", $BreakOutTime),
            );

            $queryUpdate = "UPDATE `Staff_Attendance_BreakInOut` SET `BreakOutTime`=:BreakOutTime WHERE `StaffID`=:StaffID;";
            $updateStaffBreakoutTime = DBController::ExecuteSQL($queryUpdate, $paramUpdate);

            if ($updateStaffBreakoutTime) {
                return array("return_code" => true, "return_data" => "End of the break");
            } else {
                return array("return_code" => false, "return_data" => "Error updating break-out time.");
            }
        } else {
            // If the staff is not on a break, insert a new entry
            $EntryTime = date("H:i:s");
            $paramInsert = array(
                array(":StaffId", $_SESSION['StaffID']),
                array(":BreakInTime", $EntryTime),
                array(":CreatedBy", $_SESSION["UserID"])
            );

            $queryInsert = "INSERT INTO `Staff_Attendance_BreakInOut`(`StaffID`,`BreakInTime`,`CreatedByID`)
        VALUES (:StaffId,:BreakInTime,:CreatedBy)";
            $breakInOutRes = DBController::ExecuteSQL($queryInsert, $paramInsert);

            if ($breakInOutRes) {
                return array("return_code" => true, "return_data" => "Taking break");
            } else {
                return array("return_code" => false, "return_data" => "Error inserting break-in entry.");
            }
        }
    }


    // function breakOutForApp($data)
    // {
    //     $param = array(
    //         array(":StaffID", $_SESSION["UserID"]),
    //     );



    // }

    //update the breakout time of the last BreakIN

    function breakOutForApp()
    {
        $param = array(
            array(":StaffID", $_SESSION["StaffID"],),
        );

        // Update the breakout time of the last break-in
        $updateBreakOutQuery = "UPDATE `Staff_Attendance_BreakInOut`
                            SET `BreakOutTime` = NOW() 
                            WHERE `StaffID` = :StaffID
                            AND DATE(CreatedDateTime) = CURDATE()
                            AND `BreakOutTime` IS NULL
                            ORDER BY CreatedDateTime DESC
                            LIMIT 1";
        $updateBreakOutResult = DBController::ExecuteSQL($updateBreakOutQuery, $param);
        if ($updateBreakOutResult) {
            return array("return_code" => true, "return_data" => "Break-out successful.");
        } else {
            return array("return_code" => false, "return_data" => "Error updating break-out time.");
        }
    }


    //Testing function to check the staff Break
    function checkstaffbreak($data)
    {
        //date_default_timezone_set('Asia/Kolkata');
        $param = array(
            array(":StaffID", $_SESSION["UserID"]),
        );
        $checkstaffbreak = "SELECT  *  FROM `Staff_Attendance_BreakInOut`
        WHERE `StaffID` =:StaffID  and DATE(CreatedDateTime)=CURDATE()";
        $checkstaffbreak = DBController::getDataSet($checkstaffbreak, $param);
        if ($checkstaffbreak) {
            $checkBreakOutExists = "SELECT  *  FROM `Staff_Attendance_BreakInOut`
            WHERE `StaffID` =:StaffID  and DATE(CreatedDateTime)=CURDATE() AND `BreakOutTime` is NULL";
            if ($checkBreakOutExists) {
                $BreakOutTime = date("H:i:s");
                $param1 = array(
                    array(":StaffID", strip_tags($data['StaffID'])),
                    array(":BreakOutTime", $BreakOutTime),
                );
                $query1 = "UPDATE `Staff_Attendance` SET `BreakOutTime`=BreakOutTime  WHERE  `StaffID`=:StaffID";
                $updateStaffBreakinOutTime = DBController::ExecuteSQL($query1, $param1);
                if ($updateStaffBreakinOutTime) {
                    return array("return_code" => true, "return_data" => "End of the break");
                }
            } else {
                return array("return_code" => false, "return_data" => "Error.");
            }
        } else { //if particular user not taking a single break on particular date
            $EntryTime = date("H:i:s");
            $param = array(
                array(":BreakOption", strip_tags($data['BreakOption'])),
                array(":StaffId", strip_tags($data['StaffID'])),
                array(":StaffAttendanceID", strip_tags($data['StaffAttendanceID'])),
                array(":BreakInTime", $EntryTime),
                array(":CreatedBy", $_SESSION["UserID"])
            );
            $query = "INSERT INTO `Staff_Attendance_BreakInOut`(`BreakOptionID`, `StaffID`, `StaffAttendanceID`, `BreakInTime`,  `CreatedByID`)
            VALUES (:BreakOption,:StaffId,:StaffAttendanceID,:BreakInTime,:CreatedBy)";
            $BreakinOutRes = DBController::ExecuteSQL($query, $param);
            if ($BreakinOutRes) {
                return array("return_code" => true, "return_data" => "Taking break");
            }

            // return array("return_code" => false, "return_data" => "No Break Data Found for " . date("Y-m-d"));

        }
    }


    /*  Info:
        this function will be active only if user is login
        param : {lat,long,mode,OfficeID,UserType, DATA}
        Description: Mark Attendance QR Code 
            27-01-2024 (Angelbert Riahtam) : Copy function fromold one
            15-02-2024 (Omprakash Yadav) : Addion of OfficeID and DATA and Validating Data
    */
    public function markQRattendanceStaff($data)
    {
        //if Session UserID is not set then exit
        if (!isset($_SESSION['UserID'])) {
            return array("return_code" => false, "return_data" => "In-valid User. Contact your administrator");
        }
        // ------------------- check valid officeID ---------------------

        if (!isset($data["DATA"]) || !isset($data["lat"]) || !isset($data["long"]) || !isset($data["OfficeID"]) || !isset($data["UserType"])) {
            return array("return_code" => false, "return_data" => "Parameters are missing");
        }
        //get the staffID/InternID Active One
        $param1 = array(
            array(":UserID", $_SESSION['UserID'])
        );
        $query1 = "SELECT `UserType`, `StaffID` FROM `Users` WHERE `UserID`=:UserID and `isActive`=1";
        $ActiveUser = DBController::sendData($query1, $param1);
        if (!$ActiveUser) {
            return array("return_code" => false, "return_data" => "Invalid user. Contact your administrator");
        } else {
            /* 
                this code will check for active staff/intern and active office ID only
                --  after getting we will check if staff/intern
                -- Usertype : 2-staff
                -- Usertype : 3- intern
           */

            $decryptedData = Sodium::safeDecrypt($data["DATA"]);

            //For Staff 
            // if($ActiveUser['UserType']==2 || $ActiveUser['UserType']==1 )
            if ($ActiveUser['UserType'] == 2) {
                $param3 = array(
                    array(":StaffID", $ActiveUser['StaffID'])
                );
                //get the Active Staff and office ID for that staff
                $query3 = "SELECT  so.OfficeID,so.OfficeName,so.Latitude,so.Longitude,so.isActive,so.`OfficeTimIN`, so.`OfficeTimeOut` FROM `Staff` s
                INNER JOIN Settings_Office so on so.OfficeID=s.OfficeID
                WHERE s.`StaffID`=:StaffID and s.`isRemoved`=0;";
                $res3 = DBController::sendData($query3, $param3);
                if ($res3) {
                    //NOt active Office
                    //TODO Needs to check if the supplied Office ID is matched for the staff or not and the office is active

                    if ($res3['isActive'] == 0) {
                        return array("return_code" => false, "return_data" => "Your Office location is not a valid . Please Contact Office. ");
                    }
                } else {
                    return array("return_code" => false, "return_data" => "Office is not define for staff");
                }
            }

            //For Intern  
            else if ($ActiveUser['UserType'] == 3) {
                $param3 = array(
                    array(":StaffID", $ActiveUser['StaffID']),
                );
                //get Active Intern and the office ID
                $query3 = "SELECT  so.OfficeID,so.OfficeName,so.Latitude,so.Longitude,so.isActive,so.`OfficeTimIN`, so.`OfficeTimeOut`  FROM `Staff_Intern` si
                INNER JOIN Settings_Office so on so.OfficeID=si.OfficeID
                WHERE si.StaffInternID=:StaffID and si.`isRemoved`=0;";
                $res3 = DBController::sendData($query3, $param3);
                if ($res3) {
                    //NOt active Office
                    if ($res3['isActive'] == 0) {
                        return array("return_code" => false, "return_data" => "Your Office location is not a valid. Please Contact Office. ");
                    }
                } else {
                    return array("return_code" => false, "return_data" => "Invalid User");
                }
            } else if ($ActiveUser['UserType'] == 1)  //Admin request
            {
                return array("return_code" => false, "return_data" => "Not a valid user. Contact your administrator.");
            } else {

                //log who use this TODO
                return array("return_code" => false, "return_data" => "Not A valid User.. Please Contact Support Team if you think it is a mistake.");
            }
        }

        //---------------------- done checking  staff / intern for that office --------------------- 


        // $params1=array(
        //     array(":Code",$data["schoolcode"]),
        //     array(":Data",$data["OfficeID"])
        // );
        // if(!isset($_SESSION['UserID']) || $_SESSION['UserType']!=2)
        // {
        //     return array("retrun_code" => false, "return_data" => "Invalid user");
        // }


        // ############################# mark the attendance here  ######################

        /*
            marking of attendance will have to check for staff/Intern/Admin
            UserType 
            1 - Admin
            2 - Staff
            3 - Intern
        */


        // if($ActiveUser['UserType']==2 || $ActiveUser['UserType']==1) //staff and admin(admin also will beb staff)
        if ($ActiveUser['UserType'] == 2)  //Staff
        {
            //check if attendance is mark or not for Staff
            $params3 = array(
                array(":StaffID", $ActiveUser['StaffID'])
            );
            //check if attendance exist for this staff
            $query3 = "SELECT * FROM `Staff_Attendance` WHERE `StaffID`=:StaffID and AttendanceDate=CURDATE()";
            $TodayStaffAttendance = DBController::sendData($query3, $params3);
            if ($TodayStaffAttendance) {
                //mark time out
                if (!isset($TodayStaffAttendance["StaffOut"]) || $TodayStaffAttendance["StaffOut"] == null || $TodayStaffAttendance["StaffOut"] == "") {
                    //not existed till now 
                    //nned to check with office timing // TODO
                    $isHalfDay = 0;
                    $isEarlyOut = 0; //TODO
                    $params5 = array(
                        array(":StaffAttendanceID", $TodayStaffAttendance['StaffAttendanceID']),
                        array(":LatitudeOut", strip_tags($data['lat'])),
                        array(":LongtitudeOut", strip_tags($data['long'])),
                        array(":isHalfDay", $isHalfDay),
                        array(":isEarlyOut", $isEarlyOut),
                        array(":StaffID", $ActiveUser['StaffID'])
                    );
                    //is half_day and is early_out need to be update later
                    //update entry out
                    $query5 = "UPDATE `Staff_Attendance` SET `LatitudeOut`=:LatitudeOut,`LongtitudeOut`=:LongtitudeOut,`StaffOut`=CURRENT_TIME(),`isHalfDay`=:isHalfDay,`isEarlyOut`=:isEarlyOut WHERE `StaffAttendanceID`=:StaffAttendanceID and `StaffID`=:StaffID";
                    // $query5="UPDATE `Staff_Attendance` SET `LatitudeOut`=:LatitudeOut,`LongtitudeOut`=:LongtitudeOut,`StaffOut`=CURRENT_TIME(), `isHalfDay`=0,`isEarlyOut`=0 WHERE `StaffID`=:StaffID and StaffAttendanceID=:StaffAttendanceID";
                    $res5 = DBController::ExecuteSQL($query5, $params5);
                    if ($res5) {
                        return array("return_code" => true, "return_data" => "You have completed your day");
                    } else {
                        return array("return_code" => false, "return_data" => "Error while exit entry");
                    }
                } else {
                    //done for today
                    return array("return_code" => true, "return_data" => "You have already marked your attendance for today");
                }
            }

            //Marking of  Staff Attendance for Mornig
            else {

                //islate  need to check from the office timing

                // $res3['OfficeTimIN'];
                // $res3['OfficeTimeOut'];

                // if()

                $isLatein = 0; //set 0 for now //TODO
                $params5 = array(
                    array(":StaffID", $ActiveUser['StaffID']),
                    array(":AttendanceModeID", strip_tags($data['mode'])),  //1 QR, 2 Remote, 3 RFID 4 Admin Office
                    array(":LatitudeIN", strip_tags($data['lat'])),
                    array(":LongtitudeIN", strip_tags($data['long'])),
                    array(":RIFDCardno", ''),
                    array(":LocationID", strip_tags($data['OfficeID'])),
                    array(":EntryBy", $_SESSION['UserID']),
                    array(":isLateIn", $isLatein)
                );
                $query5 = "INSERT INTO `Staff_Attendance`(`AttendanceDate`, `StaffID`, `Status`,`AttendanceModeId`, `LatitudeIN`, `LongtitudeIN`, `StaffIn`, `RFIDCardNo`, `LocationID`,`EntryBy`,`IsLateIn`) 
                VALUES(CURDATE(),:StaffID,1,:AttendanceModeID,:LatitudeIN,:LongtitudeIN,CURRENT_TIME(),:RIFDCardno,:LocationID,:EntryBy,:isLateIn)";
                $markAttendanceRes = DBController::ExecuteSQL($query5, $params5);
                if ($markAttendanceRes) {
                    return array("return_code" => true, "return_data" => "Attendance Marked.");
                } else {
                    return array("return_code" => false, "return_data" => "Error occured while registring attendance");
                }
            }
        } else if ($ActiveUser['UserType'] == 1) //Admin
        {
            //Admin
            return array("return_code" => true, "return_data" => "Invalid UserType");
        }

        /**
         * TODO ::: 
         * need to check for in tern 
         */
        else if ($ActiveUser['UserType'] == 3)  //Intern
        {
            //check is intern has Mark the Attendance or not
            $params3 = array(
                array(":StaffID", $ActiveUser['StaffID'])
            );
            //check if attendance exist for this Intern
            $query3 = "SELECT * FROM `Intern_Attendance` WHERE `AttendanceDate`=CURDATE() and `InternID`=:StaffID";
            $TodayInternAttendance = DBController::sendData($query3, $params3);
            if (!isset($TodayInternAttendance["StaffOut"]) || $TodayInternAttendance["StaffOut"] == null) {

                //not existed till now 
                //nned to check with office timing // TODO
                $isHalfDay = 0;
                $isEarlyOut = 0; //TODO
                $params5 = array(
                    array(":StaffAttendanceID", $TodayInternAttendance['StaffAttendanceID']),
                    array(":LatitudeOut", strip_tags($data['lat'])),
                    array(":LongtitudeOut", strip_tags($data['long'])),
                    array(":isHalfDay", $isHalfDay),
                    array(":isEarlyOut", $isEarlyOut),
                    array(":StaffID", $ActiveUser['StaffID'])
                );
                //is half_day and is early_out need to be update later
                //update entry out
                $query5 = "UPDATE `Intern_Attendance` SET `LatitudeOut`=:LatitudeOut,`LongtitudeOut`=:LongtitudeOut,`StaffOut`=CURRENT_TIME(),`isHalfDay`=:isHalfDay,`isEarlyOut`=:isEarlyOut WHERE `StaffAttendanceID`=:StaffAttendanceID and `InternID`=:StaffID";
                $res5 = DBController::ExecuteSQL($query5, $params5);
                if ($res5) {
                    return array("return_code" => true, "return_data" => "Sucessfully Logged out");
                }
                return array("return_code" => false, "return_data" => "Error while exit entry");
            } else {

                //islate  need to check from the office timing
                $isLatein = 0; //set 0 for now //TODO
                $params5 = array(
                    array(":InternID", $ActiveUser['StaffID']),
                    array(":AttendanceModeID", strip_tags($data['mode'])), //1 manual, 2 QR, 3 RFID
                    array(":LatitudeIN", strip_tags($data['lat'])),
                    array(":LongtitudeIN", strip_tags($data['long'])),
                    array(":RIFDCardno", ''),
                    array(":LocationID", strip_tags($data['OfficeID'])),
                    array(":EntryBy", $_SESSION['UserID']),
                    array(":isLateIn", $isLatein)
                );
                $query5 = "INSERT INTO `Intern_Attendance`(`AttendanceDate`, `InternID`, `Status`,`AttendanceModeId`, `LatitudeIN`, `LongtitudeIN`,`StaffIn`,`RFIDCardNo`,`LocationID`, `EntryBy`, `IsLateIn`)
                VALUES (CURDATE(),:InternID,1,:AttendanceModeID,:LatitudeIN,:LongtitudeIN,CURRENT_TIME(),:RIFDCardno,:LocationID,:EntryBy,:isLateIn)";
                $markAttendanceRes = DBController::ExecuteSQL($query5, $params5);
                if ($markAttendanceRes) {
                    return array("return_code" => true, "return_data" => "Attendance Marked.");
                } else {
                    return array("return_code" => false, "return_data" => "Error occured while registring attendance");
                }
            }
        } else {
            return array("return_code" => false, "return_data" => "Invalid User for Attendance marking. ");
        }
    }

    public function markQRattendanceStaffV2($data)
    {
        //if Session UserID is not set then exit
        if (!isset($_SESSION['UserID'])) {
            return array("return_code" => false, "return_data" => "In-valid User. Contact your administrator");
        }

        // ------------------- check valid officeID ---------------------
        if (!isset($data["DATA"]) || !isset($data["lat"]) || !isset($data["long"]) || !isset($data["OfficeID"]) || !isset($data["UserType"])) {
            return array("return_code" => false, "return_data" => "Parameters are missing");
        }

        // check if staff
        if (isset($_SESSION['UserType']) && $_SESSION['UserType'] == 2) //staff
        {
            $param1 = array(
                array(":UserID", $_SESSION['UserID'])
            );
            $query1 = "SELECT UserType, `StaffID` FROM `Users` WHERE `UserID`=:UserID and `isActive`=1 and UserType=2;";
            $ActiveUser = DBController::sendData($query1, $param1);
            if ($ActiveUser) {
                //decrypt data
                $decryptedData = Sodium::safeDecrypt($data["DATA"]);

                //get the office detail of that staff
                $param3 = array(
                    array(":StaffID", $ActiveUser['StaffID'])
                );
                $query3 = "SELECT  so.OfficeID,so.OfficeName,so.Latitude,so.Longitude,so.isActive,so.`OfficeTimIN`, so.`OfficeTimeOut` FROM `Staff` s
                INNER JOIN Settings_Office so on so.OfficeID=s.OfficeID
                WHERE s.`StaffID`=:StaffID and s.`isRemoved`=0;";
                $res3 = DBController::sendData($query3, $param3);
                if ($res3) {
                    //check if attendance is already there for today
                    $params3 = array(
                        array(":StaffID", $ActiveUser['StaffID'])
                    );
                    //check if attendance exist for this staff
                    $query3 = "SELECT * FROM `Staff_Attendance` WHERE `StaffID`=:StaffID and AttendanceDate=CURDATE()";
                    $TodayStaffAttendance = DBController::sendData($query3, $params3);
                    if ($TodayStaffAttendance) {
                        // Check if Time out exist 
                        if (isset($TodayStaffAttendance["StaffOut"]) || $TodayStaffAttendance["StaffOut"] != null || $TodayStaffAttendance["StaffOut"] != "") {
                            //Already marked  for today
                            return array("return_code" => true, "return_data" => "You have already marked your attendance for today");
                        } else {
                            // staffout time is not there (Update timeout) 
                            $isHalfDay = 0;
                            $isEarlyOut = 0; //TODO
                            $params5 = array(
                                array(":StaffAttendanceID", $TodayStaffAttendance['StaffAttendanceID']),
                                array(":LatitudeOut", strip_tags($data['lat'])),
                                array(":LongtitudeOut", strip_tags($data['long'])),
                                array(":isHalfDay", $isHalfDay),
                                array(":isEarlyOut", $isEarlyOut),
                                array(":StaffID", $ActiveUser['StaffID'])
                            );
                            //is half_day and is early_out need to be update later
                            //update entry out
                            $query5 = "UPDATE `Staff_Attendance` SET `LatitudeOut`=:LatitudeOut,`LongtitudeOut`=:LongtitudeOut,`StaffOut`=CURRENT_TIME(),`isHalfDay`=:isHalfDay,`isEarlyOut`=:isEarlyOut 
                            WHERE `StaffAttendanceID`=:StaffAttendanceID and `StaffID`=:StaffID";
                            $res5 = DBController::ExecuteSQL($query5, $params5);
                            if ($res5) {
                                return array("return_code" => true, "return_data" => "You have completed your day");
                            } else {
                                return array("return_code" => false, "return_data" => "Error while exit entry");
                            }
                        }
                    } else {
                        //mark attendance For Today
                        $isLatein = 0; //set 0 for now //TODO
                        $params5 = array(
                            array(":StaffID", $ActiveUser['StaffID']),
                            array(":AttendanceModeID", strip_tags($data['mode'])), //1 manual, 2 QR, 3 RFID
                            array(":LatitudeIN", strip_tags($data['lat'])),
                            array(":LongtitudeIN", strip_tags($data['long'])),
                            array(":RIFDCardno", ''),
                            array(":LocationID", strip_tags($data['OfficeID'])),
                            array(":EntryBy", $_SESSION['UserID']),
                            array(":isLateIn", $isLatein)
                        );
                        $query5 = "INSERT INTO `Staff_Attendance`(`AttendanceDate`, `StaffID`, `Status`,`AttendanceModeId`, `LatitudeIN`, `LongtitudeIN`, `StaffIn`, `RFIDCardNo`, `LocationID`,`EntryBy`,`IsLateIn`) 
                        VALUES(CURDATE(),:StaffID,1,:AttendanceModeID,:LatitudeIN,:LongtitudeIN,CURRENT_TIME(),:RIFDCardno,:LocationID,:EntryBy,:isLateIn)";
                        $markAttendanceRes = DBController::ExecuteSQL($query5, $params5);
                        if ($markAttendanceRes) {
                            return array("return_code" => true, "return_data" => "Attendance Marked.");
                        } else {
                            return array("return_code" => false, "return_data" => " Some Error occured while marking the attendance");
                        }
                    }
                } else {
                    //return invalid office
                    return array("return_code" => false, "return_data" => "Invalid Office for User. Please Contact Admin For  Office Update");
                }
            } else {
                return array("return_code" => false, "return_data" => "Invalid user. Contact your administrator");
            }
        } else if (isset($_SESSION['UserType']) && $_SESSION['UserType'] == 3) //intern 
        {
            return array("return_code" => false, "return_data" => "Invalid user. Contact your administrator");
        } else {
            return array("return_code" => false, "return_data" => "Invalid user. Contact your administrator");
        }
    }

    /*  Info:
        Description: this function will get all the attendance based on selected date 
        param {Month}
            12-02-2024 (Devkanta) : Added the function
    */


    /*  Info:
        Description: this function will get all the attendance based on month and for the particular staff 
        param {Month,StaffID}
            01-02-2024 (Angelbert Riahtam) : Added the function
    */
    function getIndividualStaffAttendancebyMonth($data)
    {
        $param = array(
            array(":Month", isset($data['Month']) ? strip_tags($data['Month']) : null),
            array(":StaffID", strip_tags($data['StaffID']))
        );

        $query = "SELECT sa.AttendanceDate,sa.Status,sa.StaffIn,sa.StaffOut,sa.LatitudeIN ,sa.LatitudeOut ,sa.LongtitudeIN ,sa.LongtitudeOut  FROM `Staff_Attendance` sa where sa.StaffID=:StaffID and Month(sa.AttendanceDate)=:Month";
        $res = DBController::getDataSet($query, $param);
        return array("return_code" => true, "return_data" => $res);
    }

    /*  Info:
       
        Description: this function will get all the attendance report of that staff in a particular year
        param {StaffID,Year}
            01-02-2024 (Angelbert Riahtam) : Added the function
    */
    function getIndividualStaffAttendancebyYear($data)
    {
        $param = array(
            array(":Year", strip_tags(trim($data['Year']))),
            array(":StaffID", strip_tags($data['StaffID']))
        );

        $query = "SELECT s.`StaffID`,sum(case when Staff_Attendance.Status=1 then 1 else 0 END) AS Present,sum(case when Staff_Attendance.Status=0 then 1 else 0 END) AS 'Absent' ,sum(case when Staff_Attendance.Status=2 then 1 else 0 END) AS 'Onleave',count(Staff_Attendance.Status) AS 'All',
         MONTH(Staff_Attendance.AttendanceDate) AS Month
         FROM `Staff_Attendance`
         INNER JOIN Staff s on Staff_Attendance.StaffID=s.StaffID
         INNER JOIN Setting_Designation d on d.DesignationID=s.DesignationID
         where Year(Staff_Attendance.AttendanceDate)=:Year and  Staff_Attendance.StaffID=:StaffID
         GROUP BY s.StaffID,MONTH(Staff_Attendance.AttendanceDate);";

        $res = DBController::getDataSet($query, $param);

        return array("return_code" => true, "return_data" => $res);
    }

    /*  Info:
        this function will get all distinct year from the attendance
        Description: Mark Attendance QR Code 
            01-02-2024 (Angelbert Riahtam) : Added the function
    */
    function getAttendanceYear()
    {
        $query = "SELECT DISTINCT EXTRACT(YEAR FROM  Date(sa.AttendanceDate)) AS Year FROM Staff_Attendance sa;";
        $res = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $res);
    }

    /*  Info:
        this function will get all Staff Attendace Report By Selected  Date 
            12-02-2024 (Devkanta Singh) : Added the function
    */
    function getStaffAttendancebyDate($data)
    {
        $param = array(
            array(":Date", strip_tags($data['DATE'])),
        );

        $query = "SELECT s.`StaffID`, s.`StaffName`,sa.AttendanceDate,sa.LatitudeIN,sa.LatitudeOut,sa.StaffIn,sa.StaffOut,s.isRemoved,sa.Status  FROM Staff s
        INNER JOIN Staff_Attendance sa on s.StaffID  = sa.StaffID 
        WHERE s.isRemoved=0 and DATE(sa.AttendanceDate)=:Date";
        $res = DBController::getDataSet($query, $param);
        return array("return_code" => true, "return_data" => $res);
    }



    /*  Info:
        this function will get all Staff Attendace Report By Selected  Year 
            12-02-2024 (Devkanta Singh) : Added the function
    */
    function getStaffReportByYear($data)
    {
        $param = array(

            array(":AttendanceYear", strip_tags($data['attendanceYear'])),
        );

        $query = " SELECT 
        s.StaffID,
        s.StaffName,
        COUNT(CASE WHEN sa.Status = 1 THEN 1 END) AS TotalPresent,
        COUNT(CASE WHEN sa.Status = 0 THEN 1 END) AS TotalAbsent
    FROM Staff_Attendance sa
    INNER JOIN Staff s ON  sa.StaffID = s.StaffID 
    WHERE YEAR(sa.AttendanceDate)=:AttendanceYear
    GROUP BY s.StaffID, s.StaffName;AttendanceYear";
        $res = DBController::getDataSet($query, $param);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        } else {
            return array("return_code" => false, "return_data" => "No Data Found for  Year " . $data['attendanceYear']);
        }
    }

    function getReportByYearMonthStaffID($data)
    {
        //year, month, InternID
        $param = array(

            array(":AttendanceYear", strip_tags($data['Year'])),
            array(":AttendanceMonth", strip_tags($data['Month'])),
            array(":StaffID", strip_tags($data['StaffID'])),
        );

        $query = "SELECT 
        s.StaffID,
        s.StaffName,
        COUNT(CASE WHEN sa.Status = 1 THEN 1 END) AS TotalPresent,
        COUNT(CASE WHEN sa.Status = 0 THEN 1 END) AS TotalAbsent
    FROM Staff_Attendance sa
    INNER JOIN Staff s ON sa.StaffID = s.StaffID 
    WHERE YEAR(sa.AttendanceDate)=:AttendanceYear AND MONTH(sa.AttendanceDate)=:AttendanceMonth AND s.StaffID=:StaffID
        GROUP BY s.StaffID, s.StaffName
        ;";
        $res = DBController::getDataSet($query, $param);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        } else {
            return array("return_code" => false, "return_data" => "No Data Found ");
        }
    }


    function getAllStaffCountAttendanceReport()
    {

        // totalpresenttoday
        $query = "SELECT  COUNT(CASE WHEN sa.Status = 1 THEN 1 END) AS totalpresenttoday  FROM Staff_Attendance sa  WHERE   DATE(sa.AttendanceDate) = CURDATE();";
        $TotalPresentToday = DBController::sendData($query);

        // totalabsenttoday
        $query1 = "SELECT  COUNT(CASE WHEN sa.Status = 0 THEN 1 END) AS totalabsenttoday  FROM Staff_Attendance sa  WHERE   DATE(sa.AttendanceDate) = CURDATE();";
        $TotalAbsentToday = DBController::sendData($query1);


        // totalpresentyesterday
        $query2 = "SELECT  COUNT(CASE WHEN sa.Status = 1 THEN 1 END) AS totalpresentyesterday  FROM Staff_Attendance sa  WHERE   DATE(sa.AttendanceDate) = CURDATE() - INTERVAL 1 DAY;";
        $TotalPresentYesterday = DBController::sendData($query2);


        // totalabsentyesterday
        $query3 = "SELECT  COUNT(CASE WHEN sa.Status = 0 THEN 1 END) AS totalabsentyesterday  FROM Staff_Attendance sa  WHERE   DATE(sa.AttendanceDate) = CURDATE() - INTERVAL 1 DAY;";
        $TotalAbsentYesterday = DBController::sendData($query3);

        return array("return_code" => true, "TotalPresentToday" => $TotalPresentToday, "TotalAbsentToday" => $TotalAbsentToday, "TotalPresentYesterday" => $TotalPresentYesterday, "TotalAbsentYesterday" => $TotalAbsentYesterday);
    }


    function getStaffAttendanceChart()
    {

        $query = "SELECT
        s.StaffName,sa.AttendanceDate,
        DATE_FORMAT(sa.AttendanceDate, '%b') AS AttendanceMonth,
         IFNULL(COUNT(CASE WHEN sa.Status = 1 THEN 1 END),0) AS TotalPresent,
        IFNULL(COUNT(CASE WHEN sa.Status = 0 THEN 1 END),0) AS TotalAbsent
    FROM
        Staff s
    INNER JOIN
        Staff_Attendance sa ON sa.StaffID  = s.StaffID 
    GROUP BY
        s.StaffName, AttendanceMonth, sa.AttendanceDate ORDER BY  AttendanceMonth DESC;";
        $res = DBController::getDataSet($query);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        }
        return array("return_code" => false, "return_data" => "No data Found.");
    }


    function getStaffBreakTimeList($data)
    {
        $param = array(
            array(":StaffID", strip_tags($data['StaffID'])),
        );
        $returnDate = date("Y-m-d");
        $returnMessage = "No Break Data for " . $returnDate;
        $query = "SELECT sab.StaffID ,sab.BreakInTime,sab.BreakOutTime,sab.CreatedDateTime ,sab2.BreakOption,sab2.BreakIcon,s.StaffName  from Staff_Attendance_Breakinout sab
        INNER JOIN Staff_Attendance_Breakoption sab2  on sab.BreakOptionID  = sab2.BreakOptionID 
        inner join Staff s on s.StaffID = sab.StaffID where sab.StaffID =:StaffID AND  DATE(sab.CreatedDateTime) = CURDATE();";
        $res = DBController::getDataSet($query, $param);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        } else {
            return array("return_code" => false, "return_data" => $returnMessage);
        }
    }

    function getTodayAttendanceReport()
    {
        $query = "SELECT s.StaffID,s.StaffName,sa.Status,sa.isBreakInOut  FROM  Staff_Attendance sa
        INNER JOIN Staff s ON sa.StaffID = s.StaffID
        WHERE DATE(sa.AttendanceDate) = CURDATE();";
        $res = DBController::getDataSet($query);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        } else {
            return array("return_code" => false, "return_data" => "No Data Found ");
        }
    }



    /**
     * this function will get Today's Staff Attendace Report 
     *  22-02-2024 (Devkanta Singh) : Added the function
     */

    function getTodaysAttendanceForApp($data)
    {

        // DBController::logs("UserID - " . $_SESSION['UserID']);
        $param = array(
            array(":UserID", $_SESSION['UserID']),
        );
        $TodayDate = date("Y-m-d");
        $query = "SELECT am.AttendanceModeID, am.AttendanceMode,sat.EntryDateTime  as CheckInTime,ifnull((select (case when BreakOutTime is null then True else False END) as isActiveBreak from Staff_Attendance_BreakInOut where StaffID=Staff.StaffID and Date(CreatedDateTime) = Date(now()) ORDER BY StaffAttendanceBreakInOutID desc LIMIT 1 ),0) as isOnBreak, IFNULL((select  BreakInTime   from Staff_Attendance_BreakInOut where StaffID=Staff.StaffID and  Date(CreatedDateTime) = Date(now())  and BreakOutTime is null ORDER by StaffAttendanceBreakInOutID DESC LIMIT 1), CURRENT_TIME()) as BreakInTime,ifnull(sat.StaffOut,0) as isCheckOut 
         FROM   Staff 
        inner join Users on Users.StaffID=Staff.StaffID 
        left join Staff_Attendance sat on Staff.StaffID = sat.StaffID AND DATE(sat.EntryDateTime)= DATE(CURDATE())
        inner join Staff_Attendance_Timing sas on sas.staffID=Staff.StaffID
        Inner JOIN Attendance_Mode am ON sas.AttendanceModeID = am.AttendanceModeID
        where  Users.UserID=:UserID";
        $res = DBController::sendData($query, $param);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        }
        return array("return_code" => false, "return_data" => "No data available for " . $TodayDate);
    }

    /**
     * this function will get  Staff Attendace Report Based On the Selected MonthID
     *  22-02-2024 (Devkanta Singh) : Added the function
     * Mofied on 22-07-2024 by  (Devkanta Singh)
     */

    function getAttendanceOverViewForApp($data)
    {
        $param = array(
            array(":StaffID", $_SESSION['StaffID']),
            array(":MonthID", $data['MonthID']),
        );

        $datas = array(
            'TotalPresent' => [],
            'TotalAbsent' => [],
            'TotalLeave' => [],
            'TotalHalfDay' => [],
            'PresentDate' => [],
            'AbsentDate' => [],
            'HalfDays' => [],
            'LeaveDays' => [],

        );
        $query = "SELECT  IFNULL(SUM(CASE WHEN sa.Status = 1 THEN 1 END),0) AS TotalPresent FROM   Staff_Attendance sa WHERE 
         MONTH(sa.AttendanceDate)=:MonthID AND sa.StaffID=:StaffID";
        $totalpresentcount = DBController::sendData($query, $param);

        $query = "SELECT  IFNULL(SUM(CASE WHEN sa.Status = 0 THEN 1 END),0) AS TotalAbsent FROM   Staff_Attendance sa WHERE 
         MONTH(sa.AttendanceDate)=:MonthID AND sa.StaffID=:StaffID";
        $totalabsentcount = DBController::sendData($query, $param);

        $query = "SELECT IFNULL(SUM(CASE WHEN sl.isHalfDay = 1 THEN 1 END),0) AS TotalHalfDayLeave FROM   Staff_Leave sl WHERE 
         MONTH(sl.ApprovedDateFrom)=:MonthID AND sl.StaffID=:StaffID";
        $totalhalfdaycount = DBController::sendData($query, $param);

        $query = "SELECT IFNULL(SUM(CASE WHEN sl.isApproved = 2 THEN 1 END),0) AS TotalLeave FROM   Staff_Leave sl WHERE 
         MONTH(sl.ApprovedDateFrom)=:MonthID AND sl.StaffID=:StaffID";
        $totalleavecount = DBController::sendData($query, $param);

        $query = "SELECT Status,AttendanceDate FROM  Staff_Attendance  sa WHERE   MONTH(sa.AttendanceDate)=:MonthID AND sa.StaffID=:StaffID AND sa.Status=1";
        $presentwithdate = DBController::getDataSet($query, $param);


        $query = "SELECT Status,AttendanceDate FROM  Staff_Attendance  sa WHERE   MONTH(sa.AttendanceDate)=:MonthID AND sa.StaffID=:StaffID AND sa.Status=0";
        $absentwithdate = DBController::getDataSet($query, $param);


        $query = "SELECT isHalfDay, ApprovedDateFrom FROM   Staff_Leave sl WHERE 
         MONTH(sl.ApprovedDateFrom)=:MonthID AND sl.StaffID=:StaffID AND isHalfDay=1";
        $halfDaywithdate = DBController::getDataSet($query, $param);

        $query = "SELECT ApprovedDateFrom,ApprovedDateTo,NoOfDays,isHalfDay FROM   Staff_Leave sl WHERE 
         MONTH(sl.ApprovedDateFrom)=:MonthID AND sl.StaffID=:StaffID AND isApproved=2";
        $leaveDaywithdate = DBController::getDataSet($query, $param);

        $datas = array(
            'TotalPresent' => $totalpresentcount,
            'TotalAbsent' => $totalabsentcount,
            'TotalLeave' => $totalleavecount,
            'TotalHalfDay' => $totalhalfdaycount,
            'PresentDate' => $presentwithdate,
            'AbsentDate' => $absentwithdate,
            'HalfDays' => $halfDaywithdate,
            'LeaveDays' => $leaveDaywithdate,
        );
        return array("return_code" => true, "return_data" => $datas);
    }






    //     //     return array("return_code" => true, "return_data" => $res);
    //     // } else {
    //     //     $monthName = date('F', mktime(0, 0, 0, $data['MonthID'], 1)); // Convert numeric month to month name
    //     //     $errorMessage = "No Data Found for the month of $monthName";
    //     //     return array("return_code" => false, "return_data" => $errorMessage);
    //     // }
    // }

    // function getAttendanceOverViewForApp($data)
    // {
    //     $param = array(
    //         array(":StaffID", $_SESSION['StaffID']),
    //         array(":MonthID", $data['MonthID']),
    //     );

    //     $datas = array(
    //         'TotalCount' => [],
    //         'PresentDate' => [],
    //         'AbsentDate' => [],
    //         'HalfDays' => [],
    //         'LeaveDays' => [],

    //     );
    //     $query = "SELECT 
    //         IFNULL(SUM(CASE WHEN mergedData.Status = 1 THEN 1 END), 0) AS TotalPresent,
    //         IFNULL(SUM(CASE WHEN mergedData.Status = 0 THEN 1 END), 0) AS TotalAbsent,
    //         IFNULL(SUM(CASE WHEN mergedData.isHalfDay = 1 THEN 1 END), 0) AS TotalHalfDayLeave,
    //         IFNULL(SUM(CASE WHEN mergedData.isApproved = 2 THEN 1 END), 0) AS TotalLeave
    //     FROM 
    //         (SELECT 
    //             sa.Status, 
    //             NULL AS isHalfDay, 
    //             NULL AS isApproved
    //          FROM 
    //             Staff_Attendance sa
    //          WHERE 
    //             MONTH(sa.AttendanceDate) = :MonthID 
    //             AND sa.StaffID = :StaffID
    //          UNION ALL
    //          SELECT 
    //             NULL AS Status, 
    //             sl.isHalfDay, 
    //             sl.isApproved
    //          FROM 
    //             Staff_Leave sl
    //          WHERE 
    //             MONTH(sl.ApprovedDateFrom) = :MonthID 
    //             AND sl.StaffID = :StaffID
    //         ) AS mergedData
    // ";
    //     $totalCounts = DBController::sendData($query, $param);


    //     $query = "SELECT Status,AttendanceDate FROM  Staff_Attendance  sa WHERE   MONTH(sa.AttendanceDate)=:MonthID AND sa.StaffID=:StaffID AND sa.Status=1";
    //     $presentwithdate = DBController::getDataSet($query, $param);


    //     $query = "SELECT Status,AttendanceDate FROM  Staff_Attendance  sa WHERE   MONTH(sa.AttendanceDate)=:MonthID AND sa.StaffID=:StaffID AND sa.Status=0";
    //     $absentwithdate = DBController::getDataSet($query, $param);


    //     $query = "SELECT isHalfDay, ApprovedDateFrom FROM   Staff_Leave sl WHERE 
    //     MONTH(sl.ApprovedDateFrom)=:MonthID AND sl.StaffID=:StaffID AND isHalfDay=1";
    //     $halfDaywithdate = DBController::getDataSet($query, $param);

    //     $query = "SELECT ApprovedDateFrom,ApprovedDateTo,NoOfDays,isHalfDay FROM   Staff_Leave sl WHERE 
    //     MONTH(sl.ApprovedDateFrom)=:MonthID AND sl.StaffID=:StaffID AND isApproved=2";
    //     $leaveDaywithdate = DBController::getDataSet($query, $param);

    //     $datas = array(
    //         'TotalCount' => $totalCounts,
    //         'PresentDate' =>  $presentwithdate,
    //         'AbsentDate' =>  $absentwithdate,
    //         'HalfDays' =>  $halfDaywithdate,
    //         'LeaveDays' =>  $leaveDaywithdate,
    //     );
    //     return array("return_code" => true, "return_data" => $datas);






    //     //     return array("return_code" => true, "return_data" => $res);
    //     // } else {
    //     //     $monthName = date('F', mktime(0, 0, 0, $data['MonthID'], 1)); // Convert numeric month to month name
    //     //     $errorMessage = "No Data Found for the month of $monthName";
    //     //     return array("return_code" => false, "return_data" => $errorMessage);
    //     // }
    // }




    /**
     * this function will get  Staff Leave Report Based On the Selected MonthID
     *  22-02-2024 (Devkanta Singh) : Added the function
     */

    function getLeaveOverViewForAapp($data)
    {



        $param = array(
            // array(":StaffID", $_SESSION['UserID']),
            array(":MonthID", $data['MonthID']),
        );

        $query = "SELECT 
                  IFNULL(SUM(CASE WHEN sl.LeaveTypeID = 1 THEN 1 END),0) AS TotalSickDayLeave,
                  IFNULL(SUM(CASE WHEN sl.LeaveTypeID = 2 THEN 1 END),0) AS TotalMaternityLeave
         FROM Staff_Leave sl 
         INNER JOIN Staff s ON s.StaffID = sl.StaffID 
         WHERE sl.isApproved = 1 AND MONTH(sl.CreatedDateTime) = :MonthID AND s.StaffID = 5
         GROUP BY s.StaffID";
        $res = DBController::getDataSet($query, $param);

        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        } else {
            $monthName = date('F', mktime(0, 0, 0, $data['MonthID'], 1)); // Convert numeric month to month name
            $errorMessage = "No Data Found for the month of $monthName";
            return array("return_code" => false, "return_data" => $errorMessage);
        }
    }







    function getUserAllLeaveOverview()
    {
        if (isset($_SESSION['UserType']) && $_SESSION['UserType'] == 2) {

            $param = array(
                // array(":StaffID", $_SESSION['UserID']),
                array(":StaffID", $_SESSION['StaffID']),
            );
            $query = "SELECT 
            SUM(CASE WHEN sl.LeaveTypeID = 1 THEN 1 END) AS SickLeave,
            SUM(CASE WHEN sl.LeaveTypeID = 2 THEN 1 END) AS MaternityLeave,
            SUM(CASE WHEN sl.LeaveTypeID = 3 THEN 1 END) AS LeaveWithoutPay,
            SUM(CASE WHEN sl.LeaveTypeID = 4 THEN 1 END) AS EarnLeave,
            SUM(CASE WHEN sl.LeaveTypeID = 5 THEN 1 END) AS CasualLeave
        FROM Staff_Leave sl 
        INNER JOIN Staff s ON s.StaffID = sl.StaffID 
        WHERE sl.isApproved = 2 AND s.StaffID =:StaffID  
        -- AND  MONTH(sl.CreatedDateTime) = MONTH(CURDATE())
        GROUP BY s.StaffID";

            $res = DBController::getDataSet($query, $param);
            if ($res) {
                // Extract the first row as it contains the aggregated data
                $data = $res[0];
                // Return data in the expected format
                return array("return_code" => true, "return_data" => $data);
            } else {
                $errorMessage = "No Leave Data Found for the month";
                return array("return_code" => false, "return_data" => $errorMessage);
            }
        }
    }

    //added by Angel
    public function markRemoteattendance($data)
    {
        //if Session UserID is not set then exit
        if (!isset($_SESSION['UserID'])) {
            return array("return_code" => false, "return_data" => "In-valid User. Contact your administrator");
        }
        // ------------------- check valid officeID ---------------------
        if (!isset($data["DATA"]) || !isset($data["lat"]) || !isset($data["long"]) || !isset($data["OfficeID"]) || !isset($data["UserType"]) || !isset($data['mode'])) {
            return array("return_code" => false, "return_data" => "Error!! Invalid  Parameters.");
        }
        //check that the attendance  should came only from mode 2
        if ($data['mode'] != 2) {
            return array("return_code" => false, "return_data" => "You are not eligible to mark the attendance using this mode.Please contact Administration if you think that it is a Mistake");
        }
        // for image
        if (isset($data["Photo"])) {
            $image_info = getimagesize($data["Photo"]);
            //att
            $Photo = uniqid("ATT") . "." . (isset($image_info["mime"]) ? explode('/', $image_info["mime"])[1] : "");
            file_put_contents("../app/data/temp/" . $Photo, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data["Photo"])));
        } else {
            return array("return_code" => false, "return_data" => "Please upload photo also");
        }
        // check if came from a valid User (Staff)
        if (isset($_SESSION['UserType']) && $_SESSION['UserType'] == 2) //staff
        {
            //check if Active staff
            $param1 = array(
                array(":UserID", $_SESSION['UserID'])
            );
            $query1 = "SELECT UserType, `StaffID` FROM `Users` WHERE `UserID`=:UserID and `isActive`=1 and UserType=2;";
            $ActiveUser = DBController::sendData($query1, $param1);
            if ($ActiveUser) {
                //decrypt data
                $decryptedData = Sodium::safeDecrypt($data["DATA"]);
                //get the office detail of that staff
                //no need t get the officeID because it is field work
                // $param3 = array(
                //     array(":StaffID", $ActiveUser['StaffID'])
                // );
                // $query3 = "SELECT  so.OfficeID,so.OfficeName,so.Latitude,so.Longitude,so.isActive,so.`OfficeTimIN`, so.`OfficeTimeOut` FROM `Staff` s
                // INNER JOIN Settings_Office so on so.OfficeID=s.OfficeID
                // WHERE s.`StaffID`=:StaffID and s.`isRemoved`=0;";
                // $res3 = DBController::sendData($query3, $param3);
                // if ($res3) {
                //check if attendance is already there for today
                $params3 = array(
                    array(":StaffID", $ActiveUser['StaffID'])
                );
                //check if attendance exist for this staff
                $query3 = "SELECT * FROM `Staff_Attendance` WHERE `StaffID`=:StaffID and AttendanceDate=CURDATE()";
                $TodayStaffAttendance = DBController::sendData($query3, $params3);
                if ($TodayStaffAttendance) {
                    // Check if Time out exist
                    if (isset($TodayStaffAttendance["StaffOut"]) || $TodayStaffAttendance["StaffOut"] != null || $TodayStaffAttendance["StaffOut"] != "") {
                        //Already marked  for today
                        return array("return_code" => true, "return_data" => "You have already marked your attendance for today");
                    } else {
                        // staffout time is not there (Update timeout)
                        $isHalfDay = 0;
                        $isEarlyOut = 0; //TODO
                        $params5 = array(
                            array(":StaffAttendanceID", $TodayStaffAttendance['StaffAttendanceID']),
                            array(":LatitudeOut", strip_tags($data['lat'])),
                            array(":LongtitudeOut", strip_tags($data['long'])),
                            array(":isHalfDay", $isHalfDay),
                            array(":AttendancePhoto", $Photo),
                            array(":isEarlyOut", $isEarlyOut),
                            array(":StaffID", $ActiveUser['StaffID'])
                        );
                        //is half_day and is early_out need to be update later
                        //update entry out
                        $query5 = "UPDATE `Staff_Attendance` SET `LatitudeOut`=:LatitudeOut,`LongtitudeOut`=:LongtitudeOut,`StaffOut`=CURRENT_TIME(),AttendancePhotoOut=:AttendancePhoto,`isHalfDay`=:isHalfDay,`isEarlyOut`=:isEarlyOut
                            WHERE `StaffAttendanceID`=:StaffAttendanceID and `StaffID`=:StaffID";
                        $res5 = DBController::ExecuteSQL($query5, $params5);
                        if ($res5) {
                            // put photo in folder
                            rename("../app/data/temp/" . $Photo, "../app/data/attendancephoto/" . pathinfo($Photo, PATHINFO_BASENAME));
                            return array("return_code" => true, "return_data" => "You have completed your day");
                        } else {
                            return array("return_code" => false, "return_data" => "Error while exit entry");
                        }
                    }
                } else {
                    //mark attendance For Today
                    $isLatein = 0; //set 0 for now //TODO
                    $params5 = array(
                        array(":StaffID", $ActiveUser['StaffID']),
                        array(":AttendanceModeID", strip_tags($data['mode'])), //1 manual, 2 QR, 3 RFID
                        array(":LatitudeIN", strip_tags($data['lat'])),
                        array(":LongtitudeIN", strip_tags($data['long'])),
                        array(":RIFDCardno", ''),
                        array(":LocationID", strip_tags($data['OfficeID'])),
                        array(":AttendancePhoto", $Photo),
                        array(":EntryBy", $_SESSION['UserID']),
                        array(":isLateIn", $isLatein)
                    );
                    $query5 = "INSERT INTO `Staff_Attendance`(`AttendanceDate`, `StaffID`, `Status`,`AttendanceModeId`, `LatitudeIN`, `LongtitudeIN`, `StaffIn`, `RFIDCardNo`, `LocationID`,`AttendancePhotoIN`,`EntryBy`,`IsLateIn`)
                        VALUES(CURDATE(),:StaffID,1,:AttendanceModeID,:LatitudeIN,:LongtitudeIN,CURRENT_TIME(),:RIFDCardno,:LocationID,:AttendancePhoto,:EntryBy,:isLateIn)";
                    $markAttendanceRes = DBController::ExecuteSQL($query5, $params5);
                    if ($markAttendanceRes) {
                        // put photo in folder
                        rename("../app/data/temp/" . $Photo, "../app/data/attendancephoto/" . pathinfo($Photo, PATHINFO_BASENAME));
                        return array("return_code" => true, "return_data" => "Attendance Marked.");
                    } else {
                        return array("return_code" => false, "return_data" => " Some Error occured while marking the attendance");
                    }
                }
                // } else {
                //     //return invalid office
                //     return array("return_code" => false, "return_data" => "Invalid Office for User. Please Contact Admin For  Office Update");
                // }
            } else {
                return array("return_code" => false, "return_data" => "Invalid user. Contact your administrator");
            }
        } else if (isset($_SESSION['UserType']) && $_SESSION['UserType'] == 3) //intern
        {
            return array("return_code" => false, "return_data" => "Invalid user. Contact your administrator");
        } else {
            return array("return_code" => false, "return_data" => "Invalid user. Contact your administrator");
        }
    }

    function getTodaysAttendanceReport()
    {

        // $query = "SELECT UserType, `StaffID` FROM `Users` WHERE `UserID`=:UserID and `isActive`=1 and UserType=2;";
        $query = "SELECT sa.AttendanceDate ,sa.Status,sa.EntryDateTime,sa.StaffOut, s.StaffName,sa.LatitudeIN ,sa.LatitudeOut ,sa.LongtitudeIN ,am.AttendanceModeID,am.AttendanceMode,sa.LongtitudeOut,sa.AttendancePhotoIN,sa.AttendancePhotoOut  from Staff_Attendance sa  
        INNER JOIN Staff s on s.StaffID = sa.StaffID 
        LEFT JOIN Attendance_Mode am  on am.AttendanceModeID  = sa.AttendanceModeId 
        WHERE sa.AttendanceDate  = DATE(CURDATE()) AND s.StaffID!=6";
        $res = DBController::getDataSet($query);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        } else {
            return array("return_code" => false, "return_data" => "No Records Found for today");
        }
    }

    function getStaffAttendanceOverview()
    {
        if (isset($_SESSION['StaffID'])) {
            $param = array(
                array(":StaffID", $_SESSION['StaffID']),
            );
            $sql = "SELECT sa.AttendanceDate,sa.Status,sa.StaffIn,sa.StaffOut,sa.LatitudeIN ,sa.LatitudeOut ,sa.LongtitudeIN ,sa.LongtitudeOut,so.OfficeTimIN,sat.EndTime  as OfficeTimeOut  FROM `Staff_Attendance` sa  inner join Staff s  on s.StaffID  = sa.StaffID left join Settings_Office so  on so.OfficeID  =s.OfficeID  inner join Staff_Attendance_Timing sat on sat.StaffID = sa.StaffID  
            where sa.StaffID=:StaffID and MONTH(sa.AttendanceDate) = MONTH(current_timestamp)";
            $res = (DBController::getDataSet($sql, $param));
            return array("return_code" => true, "return_data" => $res);
        }
    }
}
