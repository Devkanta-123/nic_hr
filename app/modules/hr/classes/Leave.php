<?php
/* 
    Current Version: 1.0.0
    Created By: Devkanta,     dev1@techz.in
    Created On: 07/03/2024
    Modified By:
    Modified On:  
*/

namespace app\modules\HR\classes;

use app\database\DBController;
use \app\database\Helper;

class Leave
{
    /*  Info:
        Description: Get the type of leave only the active one
            07-03-2024 (Devkanta) : Addd the function
    */


    function getAllLeaves()
    {

        if ($_SESSION['UserType'] == 1) {
            $query = "SELECT hl.LeaveID,hl.FromDate,hl.ToDate,hl.LeaveTypeID,hl.NoOfDays,hl.Description,hl.isApproved,hl2.LeaveType,hl2.NoOfDays as NoOfDaysByLeaveType,s.StaffName
            FROM HR_Leaves hl
            INNER JOIN Staff s on s.StaffID=hl.StaffID
            INNER JOIN HR_LeaveTypes hl2 ON hl.LeaveTypeID = hl2.LeaveTypeID";
            $res = DBController::getDataSet($query);
            if ($res) {
                return array("return_code" => true, "return_data" => $res);
            } else {
                return array("return_code" => false, "return_data" => "No Data Found ");
            }
        }
        if ($_SESSION['UserType'] == 2) {
            DBController::logs('USertype = 2');
            $params = array(
                array(":StaffID", $_SESSION['StaffID'])
            ); //

            $query = "SELECT s.StaffName,hl.LeaveID,hl.FromDate,hl.ToDate,hl.LeaveTypeID,hl.NoOfDays,hl.Description,hl.isApproved, hl2.LeaveType,hl2.NoOfDays as NoOfDaysByLeaveType,s.StaffName
            FROM HR_Leaves hl
            INNER JOIN Staff s on s.StaffID=hl.StaffID
            INNER JOIN HR_LeaveTypes hl2 ON hl.LeaveTypeID = hl2.LeaveTypeID WHERE hl.StaffID=:StaffID;";
            $res = DBController::getDataSet($query, $params);
            if ($res) {
                return array("return_code" => true, "return_data" => $res);
            } else {
                return array("return_code" => false, "return_data" => "No Data Found ");
            }
        } else {
            return array("return_code" => false, "return_data" => "No Data Found ");
        

        }
    }


    function leaverequest($data)
    {
        // Extracting data from $data
        $fromDate = strip_tags($data['FromDate']);
        $toDate = strip_tags($data['ToDate']);
        $startDate =  strtotime($fromDate);
        $endDate =  strtotime($toDate);
        $numberOfDays = round(($endDate - $startDate) / (60 * 60 * 24));


        $param = array(
            array(":FromDate", strip_tags($data['FromDate'])),
            array(":ToDate", strip_tags($data['ToDate'])),
            array(":LeaveTypeID", strip_tags($data['LeaveTypeID'])),
            array(":StaffID", strip_tags($data['StaffID'])),
            array(":Description", strip_tags($data['Description'])),
            array(":NoOfDays", $numberOfDays),
            array(":CreatedByID", $_SESSION['UserID'])
        );
        $query = "INSERT INTO `HR_Leaves`(`FromDate`, `ToDate`, `LeaveTypeID`, `StaffID`,`NoOfDays`,`Description`, `CreatedByID`)
        VALUES (:FromDate,:ToDate,:LeaveTypeID,:StaffID,:NoOfDays,:Description,:CreatedByID)";
        $res = DBController::ExecuteSQL($query, $param);
        if ($res) {
            return array("return_code" => true, "return_data" => "Created Leave Request");
        } else {
            return array("return_code" => false, "return_data" => "Failed to create Leave Request");
        }
    }


    function getAllLeaveRequest()
    {

        //check if the login is admin or staff
        if ($_SESSION['UserType'] == 1) {
            //ADMIN
            $query = "SELECT s.StaffName, hl.LeaveID, hl.FromDate, hl.ToDate, hl.LeaveTypeID, hl.NoOfDays, hl.Description, hl.isApproved, hl2.LeaveType, hl2.NoOfDays as NoOfDaysByLeaveType, s.StaffName
            FROM HR_Leaves hl
            INNER JOIN Staff s ON s.StaffID = hl.StaffID
            INNER JOIN HR_LeaveTypes hl2 ON hl.LeaveTypeID = hl2.LeaveTypeID
            WHERE hl.isApproved IS NULL;
            ;";
            $res = DBController::getDataSet($query);
            if ($res) {
                return array("return_code" => true, "return_data" => $res);
            } else {
                return array("return_code" => false, "return_data" => "No Data Found ");
            }
        } else if ($_SESSION["UserType"] == 2) {
            $params = array(
                array(":StaffID", $_SESSION['StaffID'])
            ); //

            $query = "SELECT s.StaffName, hl.LeaveID, hl.FromDate, hl.ToDate, hl.LeaveTypeID, hl.NoOfDays, hl.Description, hl.isApproved, hl2.LeaveType, hl2.NoOfDays as NoOfDaysByLeaveType, s.StaffName
            FROM HR_Leaves hl
            INNER JOIN Staff s ON s.StaffID = hl.StaffID
            INNER JOIN HR_LeaveTypes hl2 ON hl.LeaveTypeID = hl2.LeaveTypeID
            WHERE  hl.isApproved IS NULL AND hl.StaffID=:StaffID;";
            $res = DBController::getDataSet($query, $params);
            if ($res) {
                return array("return_code" => true, "return_data" => $res);
            } else {
                return array("return_code" => false, "return_data" => "No Data Found ");
            }
        } else {
            return array("return_code" => false, "return_data" => "No Data Found ");
        }
    }






    function getAllHRLeaveTypes()
    {

        $query = "SELECT * FROM HR_LeaveTypes hl";
        $res = DBController::getDataSet($query);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        } else {
            return array("return_code" => false, "return_data" => "No Data Found ");
        }
    }



    function leaveApproval($data)
    {

        $ApprovedFromDate = strip_tags($data['ApprovedFromDate']);
        $ApprovedToDate = strip_tags($data['ApprovedToDate']);
        $startDate =  strtotime($ApprovedFromDate);
        $endDate =  strtotime($ApprovedToDate);
        $numberOfDays = round(($endDate - $startDate) / (60 * 60 * 24));
        $Entitled =  strip_tags($data['NoOfDaysByLeaveType']); // Add this line
        $Balanced = $Entitled - $numberOfDays;

        $param = array(
            array(":LeaveID", strip_tags($data['LeaveID'])),
            array(":LeaveTypeID", strip_tags($data['LeaveTypeID'])),
            array(":ApprovedFromDate", strip_tags($data['ApprovedFromDate'])),
            array(":ApprovedToDate", strip_tags($data['ApprovedToDate'])), // Add this line
            array(":NoOfDays", $numberOfDays),
            array(":ApprovedByID", $_SESSION['UserID']),
            array(":CreatedByID", $_SESSION['UserID']),
        );

        $query = "INSERT INTO `HR_Leaves_Approved`(`LeaveID`,`LeaveTypeID`,`FromDate`,`ToDate`,`NoOfDays`,`ApprovedByID`,`CreatedByID`)
   VALUES (:LeaveID,:LeaveTypeID,:ApprovedFromDate,:ApprovedToDate,:NoOfDays,:ApprovedByID,:CreatedByID)";
        $res = DBController::ExecuteSQL($query, $param);
        if ($res) {
            $param1 = array(
                array(":LeaveID", strip_tags($data['LeaveID'])),
                array(":LeaveTypeID", strip_tags($data['LeaveTypeID'])),
                array(":Entitled", $Entitled),
                array(":Utilized", $numberOfDays),
                array(":Balanced", $Balanced),
                array(":CreatedByID", $_SESSION['UserID']),
            );

            $LeaveBalance = "INSERT INTO `HR_Leaves_Balance`(`LeaveID`, `LeaveTypeID`, `Entitled`, `Utilized`, `Balanced`, `CreatedByID`)
                            VALUES (:LeaveID, :LeaveTypeID, :Entitled, :Utilized, :Balanced, :CreatedByID)";

            $res1 = DBController::ExecuteSQL($LeaveBalance, $param1);
            if ($res1) {
                $param2 = array(
                    array(":LeaveID", strip_tags($data['LeaveID'])),
                    array(":ApprovedFromDate", strip_tags($data['ApprovedFromDate'])),
                    array(":ApprovedToDate", strip_tags($data['ApprovedToDate'])), // Add this line
                    array(":ApprovedByID", $_SESSION['UserID']),
                );
                $query = "UPDATE  `HR_Leaves` SET isApproved=1,ApprovedFromDate=:ApprovedFromDate,ApprovedToDate=:ApprovedToDate,ApprovedByID=:ApprovedByID,ApprovedDateTime = NOW()  WHERE `LeaveID` = :LeaveID";
                $updateLeaveAPproved = DBController::ExecuteSQL($query, $param2);
                if ($updateLeaveAPproved) {
                    return array("return_code" => true, "return_data" => "Leave Approved");
                } else {
                    return array("return_code" => false, "return_data" => "Failed to Approve Leave");
                }
            }
        } else {
            return array("return_code" => false, "return_data" => "Failed !");
        }
    }


    function leaveReject($data)
    {

        $param = array(
            array(":LeaveID", strip_tags($data['LeaveID'])),
            array(":RejectedReason", strip_tags($data['rejectionReason'])),
            array(":RejectedByID", $_SESSION['UserID']),

        );

        $query = "UPDATE `HR_Leaves` SET isApproved=0,isRejected=1,RejectedByID=:RejectedByID,RejectedDateTime = NOW(),RejectedRemarks=:RejectedReason  WHERE `LeaveID` = :LeaveID";
        $updateLeaveAPproved = DBController::ExecuteSQL($query, $param);
        if ($updateLeaveAPproved) {
            return array("return_code" => true, "return_data" => "Leave Rejected");
        } else {
            return array("return_code" => false, "return_data" => "Failed to Rejected Leave");
        }
    }


    function getAllApprovedLeave()
    {

        $query = "SELECT s.StaffName,hl.Description , hla.FromDate,hla.ToDate, hl2.LeaveType,hla.NoOfDays
        FROM HR_Leaves_Approved hla
        INNER JOIN HR_LeaveTypes hl2 ON hla.LeaveTypeID=hl2.LeaveTypeID
        INNER JOIN HR_Leaves hl on hl.LeaveID=hla.LeaveID
        INNER JOIN Staff s on s.StaffID = hl.StaffID";
        $res = DBController::getDataSet($query);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        } else {
            return array("return_code" => false, "return_data" => "No Data Found ");
        }
    }

    function getLeaveBalance()
    {
        $query = "SELECT s.StaffName,hl2.LeaveType,hla.CreatedDateTime,hlb.Entitled,hlb.Utilized,hlb.Balanced  from HR_Leaves_Approved hla 
        INNER JOIN HR_Leaves_Balance hlb  on hlb.LeaveID = hla.LeaveID 
        INNER JOIN HR_LeaveTypes hl2 on  hl2.LeaveTypeID = hlb.LeaveTypeID 
        INNER JOIN HR_Leaves hl on hl.LeaveID = hlb.LeaveID 
        INNER JOIN Staff s on s.StaffID = hl.StaffID";
        $res = DBController::getDataSet($query);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        } else {
            return array("return_code" => false, "return_data" => "No Data Found ");
        }
    }
}
