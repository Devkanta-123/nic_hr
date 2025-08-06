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
use \app\database\Helper;

class Leaves
{
    /*  Info:
        Description: Get the type of leave only the active one
            3-02-2024 (Angelbert Riahtam) : Addd the function
    */
    function getActiveleaveType()
    {
        $query = "SELECT * FROM `Staff_LeaveType` WHERE isActive=1";
        $leavetype = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $leavetype);
    }

    /*  Info:
        Description: Add new Setting for the department
            3-02-2024 (Angelbert Riahtam) : Addd the function
    */
    function addNewLeaveSetting($data)
    {

        //update
        if (isset($data['StaffSettingLeaveID'])) {

            //update
            $param = array(
                array(":StaffSettingLeaveID", strip_tags($data['StaffSettingLeaveID'])),
                array(":StaffID", strip_tags($data['StaffID'])),
                array(":Department", strip_tags($data['DepartmentID'])),
                array(":LeaveTypeIDs", implode(',', $data["LeaveTypeIDs"])),
                array(":UpdatedBy", $_SESSION['UserID']),
            );
            $query = "UPDATE `Staff_Settings_Leave` SET `StaffID`=:StaffID,`DepartmentID`=:Department,`LeaveTypeIDs`=:LeaveTypeIDs,`UpdatedBy`=:UpdatedBy
            WHERE `StaffSettingLeaveID`=:StaffSettingLeaveID";
            $updatestaffSettingLeave = DBController::ExecuteSQL($query, $param);
            if ($updatestaffSettingLeave) {
                return array("return_code" => true, "return_data" => "Successfully Updated");
            } else {
                return array("return_code" => false, "return_data" => "Department Setting already Exist.");
            }
        }


        //$$$$$$$$$$$$$$$  END UPDATE

        // check so that we cannot add the same dept 2 time
        $param1 = array(
            array(":Department", strip_tags($data['DepartmentID']))
        );
        $query1 = "SELECT * FROM `Staff_Settings_Leave` where DepartmentID=:Department";
        $existdept = DBController::sendData($query1, $param1);
        if ($existdept) {
            return array("return_code" => false, "return_data" => "Department Setting already Exist.");
        }

        $param = array(
            array(":StaffID", strip_tags($data['StaffID'])),
            array(":Department", strip_tags($data['DepartmentID'])),
            array(":LeaveTypeIDs", implode(',', $data["LeaveTypeIDs"])),
            array(":CreatedBy", $_SESSION['UserID']),
        );
        //add new one
        $query = "INSERT INTO `Staff_Settings_Leave`( `StaffID`, `DepartmentID`, `LeaveTypeIDs`,`CreatedBy`)
        VALUES (:StaffID,:Department,:LeaveTypeIDs,:CreatedBy)";
        $res = DBController::ExecuteSQL($query, $param);
        if ($res) {
            return array("return_code" => true, "return_data" => "Successfully Added");
        } {
            return array("return_code" => false, "return_data" => "Some error occur while adding. Please try again.");
        }
    }

    /*  Info:
        Description: Get all the setting for the department (both active and not active)
            3-02-2024 (Angelbert Riahtam) : Addd the function
    */
    function getAllDepartmentSettings()
    {
        $query = "SELECT sl.StaffSettingLeaveID,sl.DepartmentID ,sd.DepartmentName,s.StaffID,sl.LeaveTypeIDs, s.StaffName,GROUP_CONCAT(slt.LeaveType) as leavetype FROM `Staff_Settings_Leave` sl
        INNER JOIN Settings_Department sd on sd.DepartmentID=sl.DepartmentID
        INNER JOIN Staff s on s.StaffID=sl.StaffID
        INNER JOIN Staff_LeaveType slt on find_in_set(slt.LeaveTypeID,sl.LeaveTypeIDs) GROUP BY   sl.StaffSettingLeaveID ;";
        $res = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $res);
    }


    /*  Info:
        Description: request for leave  (both admin and staff can do it)
            param{LeaveTypeID,StaffID,isUrgent,File(array),LeaveRemarks,FromDate,ToDate}
            3-02-2024 (Angelbert Riahtam) : Addd the function
    */
    // function requestLeave($data)
    // {
    //     DBController::logs("requestLeave");
    //     //check that the request should come only when someone login
    //     if (!isset($_SESSION['UserType'])) {
    //         return array("return_code" => false, "return_data" => "Access Denied. Please Login to Continue");
    //     }

    //     //intern cannot request for leave
    //     if (isset($_SESSION['UserType'])) {
    //         if ($_SESSION['UserType'] == 3) {
    //             return array("return_code" => false, "return_data" => "Invalid User for Leave request");
    //         }
    //     }

    //     // to do from admin side 
    //     if (isset($data['StaffID'])) {
    //         $staffID = strip_tags($data['StaffID']);
    //     } else {

    //         $param = array(
    //             array(":UserID", $_SESSION['UserID']),
    //         );

    //         $query = "SELECT u.StaffID  FROM Users u 
    //         INNER JOIN Staff s ON  s.StaffID = u.StaffID
    //         WHERE u.isActive = 1 AND s.isRemoved = 0 and 
    //         u.UserID=:UserID and u.UserType = 2"; //staff
    //         $res = DBController::sendData($query, $param);
    //         $res['StaffID'];
    //         $staffID = $res['StaffID'];
    //     }

    //     //check date format if not match convert to proper format
    //     if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $data['FromDate'])) {
    //         $sdate = explode("/", $data["FromDate"]);
    //         $data['FromDate'] = $sdate[2] . "-" . $sdate[0] . "-" . $sdate[1];
    //     }

    //     if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $data['ToDate'])) {
    //         $edate = explode("/", $data["ToDate"]);
    //         $data['ToDate'] = $edate[2] . "-" . $edate[0] . "-" . $edate[1];
    //     }

    //     // Extracting data from $data
    //     $fromDate = strip_tags($data['FromDate']);
    //     $toDate = strip_tags($data['ToDate']);
    //     $startDate =  strtotime($fromDate);
    //     $endDate =  strtotime($toDate);
    //     $numberOfDays = round(($endDate - $startDate) / (60 * 60 * 24));

    //     $param = array(
    //         array(":LeaveTypeID", $data['LeaveTypeID']),
    //         array(":StaffID", $data["StaffID"]),
    //     );

    //     $checkBalancedDays = "SELECT  Balanced FROM Staff_Leaves_Balance WHERE LeaveTypeID =:LeaveTypeID AND StaffID =:StaffID  ORDER BY CreatedDateTime  DESC  LIMIT 1";
    //     $res = DBController::sendData($checkBalancedDays, $param);
    //     if ($res) {
    //         $balancedDays = $res['Balanced'];
    //     } else {
    //         $balancedDays = 0;
    //     }
    //     // Convert $balancedDays to an integer
    //     $balancedDaysInt = intval($balancedDays);
    //     if ($numberOfDays > $balancedDaysInt) {
    //         return array("return_code" => false, "return_data" => "You have already exhausted for this leave type.");
    //     } else {
    //         $params = array(
    //             array(":LeaveTypeID", $data['LeaveTypeID']),
    //             array(":StaffID", $staffID),
    //             array(":isUrgent", (bool)strip_tags($data['isUrgent'])),
    //             array(":LeaveRemarks", strip_tags($data['LeaveRemarks'])),
    //             array(":FromDate", strip_tags($data['FromDate'])),
    //             array(":NoOfDays", $numberOfDays),
    //             array(":ToDate", strip_tags($data['ToDate'])),
    //             array(":CreatedBy", $_SESSION['UserID']),
    //         );
    //         $query = "INSERT INTO `Staff_Leave`(`LeaveTypeID`, `StaffID`, `isUrgent`, `LeaveRemarks`,  `RequestedDateFrom`, `RequestedDateTo`,NoOfDays,`CreatedByID`)
    //         VALUES (:LeaveTypeID,:StaffID,:isUrgent,:LeaveRemarks,:FromDate,:ToDate,:NoOfDays,:CreatedBy)";
    //         $StaffLeaveID = DBController::ExecuteSQLID($query, $params);

    //         if ($StaffLeaveID) {

    //             // check if doc available 
    //             if (empty($data['File'])) {
    //                 return array("return_code" => true, "return_data" => "Request Added Successfully");
    //             }

    //             //add the documents
    //             if (!file_exists("../app/data/documents/"))
    //                 mkdir("../app/data/documents/", 0777, TRUE);
    //             ini_set('memory_limit', '-1');
    //             $errorInfo = '';
    //             // if File exist
    //             $documentsIDs = '';
    //             foreach ($data["File"] as $file) {
    //                 $ext = pathinfo($file['filename'], PATHINFO_EXTENSION);
    //                 $filedata = file_get_contents($file['filedata']);
    //                 do {
    //                     $newfilename = "n_" . Helper::generate_string(10) . "." . $ext;
    //                 } while (file_exists("../app/data/documents/" . $newfilename));
    //                 $fp = fopen("../app/data/documents/" . $newfilename, "w+");

    //                 //if(file_put_contents(("../app/data/documents/".$newfilename), $filedata))
    //                 if (fwrite($fp, ($filedata))) {
    //                     $q2 = "INSERT INTO `Documents` (`DocumentsCategoryID`, `DocumentSettingID`, `DocumentPath`, `DocumentTitle`, `DocumentAccess`, `DocumentDisplayName`, `AddedByID`) VALUES (:DocumentsCategoryID, :DocumentSettingID, :DocumentPath, :DocumentTitle, :DocumentAccess, :DocumentDisplayName, :AddedByID);";
    //                     $p2 = [
    //                         [":DocumentsCategoryID", "11"],
    //                         [":DocumentSettingID", "9"],
    //                         [":DocumentPath", $newfilename],
    //                         [":DocumentTitle", $file['filename']],
    //                         [":DocumentAccess", "111"],
    //                         [":DocumentDisplayName", "LEAVES"], //to be given the file uploaded name 
    //                         [":AddedByID", $_SESSION['UserID']]
    //                     ];
    //                     $r2 = DBController::ExecuteSQLID($q2, $p2);
    //                     $documentsIDs = $r2 . ',' . $documentsIDs;
    //                 } else {
    //                     return array("return_code" => false, "return_data" => "File not saved !!");
    //                 }
    //                 fclose($fp);
    //             }

    //             // update  Leavedoc request  in staff Leave
    //             // echo rtrim($str1, "!");
    //             $param2 = array(
    //                 array(":DocumentIds", rtrim($documentsIDs, ",")),
    //                 array(":LeaveID", $StaffLeaveID)
    //             );
    //             $query2 = "UPDATE `Staff_Leave` SET `LeaveDocumentIDs`=:DocumentIds WHERE `LeaveID`=:LeaveID";
    //             $updateLeaveDoc = DBController::ExecuteSQL($query2, $param2);
    //             if ($updateLeaveDoc) {
    //                 return array("return_code" => true, "return_data" => "Leave Request Sucessfully");
    //             } else {
    //                 return array("return_code" => false, "return_data" => "Some error occur while requesting for a leave");
    //             }
    //         }
    //     }
    // }
    // function requestLeave($data)
    // {
    //     // Check if someone is logged in
    //     if (!isset($_SESSION['UserType'])) {
    //         return array("return_code" => false, "return_data" => "Access Denied. Please Login to Continue");
    //     }

    //     // Interns cannot request for leave
    //     if ($_SESSION['UserType'] == 3) {
    //         return array("return_code" => false, "return_data" => "Invalid User for Leave request");
    //     }

    //     // Retrieve StaffID either from provided data or session
    //     if (isset($data['StaffID'])) {
    //         $staffID = strip_tags($data['StaffID']);
    //     } else {
    //         $staffID = $_SESSION['StaffID']; // Assuming staff ID is stored in session
    //     }

    //     // Check and format date
    //     if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $data['FromDate'])) {
    //         $fromDate = date('Y-m-d', strtotime($data["FromDate"]));
    //     } else {
    //         $fromDate = strip_tags($data['FromDate']);
    //     }

    //     if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $data['ToDate'])) {
    //         $toDate = date('Y-m-d', strtotime($data["ToDate"]));
    //     } else {
    //         $toDate = strip_tags($data['ToDate']);
    //     }

    //     // Calculate number of days
    //     $numberOfDays = round((strtotime($toDate) - strtotime($fromDate)) / (60 * 60 * 24));

    //     $param3 = array(
    //         array(":StaffID", strip_tags($data['StaffID'])),
    //     );

    //     $getLastLeaveBalanceID = "SELECT LeaveBalanceID,LeaveTypeID FROM Staff_Leaves_Balance WHERE  StaffID =:StaffID ORDER BY UpdatedDateTime DESC LIMIT 1";
    //     $resultLeaveID = DBController::sendData($getLastLeaveBalanceID, $param3);
    //     if ($resultLeaveID) {
    //         $LastLeaveBalanceID = $resultLeaveID['LeaveBalanceID'];
    //         $LastLeaveTypeID = $resultLeaveID['LeaveTypeID'];

    //         $param = array(
    //             array(":LeaveTypeID", $LastLeaveTypeID),
    //             array(":StaffID", $staffID),
    //         );
    //     } else {

    //         $param = array(
    //             array(":LeaveTypeID", strip_tags($data['LeaveTypeID'])),
    //             array(":StaffID", strip_tags($data['StaffID'])),
    //         );
    //     }

    //     $checkBalancedDays = "SELECT StaffID,LeaveTypeID,Balanced FROM Staff_Leaves_Balance WHERE LeaveTypeID = :LeaveTypeID AND StaffID = :StaffID  ORDER BY CreatedDateTime DESC LIMIT 1";
    //     $res = DBController::sendData($checkBalancedDays, $param);
    //     if ($res) {
    //         $balancedDays = $res['Balanced'];
    //         $RequestStaffID = $res['StaffID'];
    //         $RequestLeaveTypeID = $res['LeaveTypeID'];
    //     } else {
    //         $balancedDays = NULL;
    //     }


    //     // Convert balanced days to an integer
    //     $balancedDaysInt = intval($balancedDays);
    //     //if leaved days already exhausted then return false , caannot insert new leave entries 
    //     // if ($balancedDaysInt == 0 ||  $staffID = $RequestStaffID  || $LeaveTypeID = $RequestLeaveTypeID) {
    //     //     return array("return_code" => false, "return_data" => "You already exhausted for this Leave Type. Cannot Proceed..");
    //     // }


    //     // Check if requested days exceed balanced days or if balance is NULL
    //     if ($balancedDaysInt >= $numberOfDays || $balancedDaysInt == NULL) {
    //         // Insert leave request
    //         $params = array(
    //             array(":LeaveTypeID", $data['LeaveTypeID']),
    //             array(":StaffID", $staffID),
    //             array(":isUrgent", (bool)strip_tags($data['isUrgent'])),
    //             array(":LeaveRemarks", strip_tags($data['LeaveRemarks'])),
    //             array(":FromDate", $fromDate),
    //             array(":NoOfDays", $numberOfDays),
    //             array(":ToDate", $toDate),
    //             array(":CreatedBy", $_SESSION['UserID']),
    //         );

    //         $query = "INSERT INTO `Staff_Leave`(`LeaveTypeID`, `StaffID`, `isUrgent`, `LeaveRemarks`,  `RequestedDateFrom`, `RequestedDateTo`,NoOfDays,`CreatedByID`)
    //             VALUES (:LeaveTypeID,:StaffID,:isUrgent,:LeaveRemarks,:FromDate,:ToDate,:NoOfDays,:CreatedBy)";
    //         $StaffLeaveID = DBController::ExecuteSQLID($query, $params);
    //         if ($StaffLeaveID) {
    //             // Check if documents are available
    //             if (empty($data['File'])) {
    //                 return array("return_code" => true, "return_data" => "Request Added Successfully");
    //             }

    //             // Add documents
    //             if (!file_exists("../app/data/documents/")) {
    //                 mkdir("../app/data/documents/", 0777, TRUE);
    //             }

    //             ini_set('memory_limit', '-1');
    //             $documentsIDs = '';

    //             foreach ($data["File"] as $file) {
    //                 $ext = pathinfo($file['filename'], PATHINFO_EXTENSION);
    //                 $filedata = file_get_contents($file['filedata']);

    //                 do {
    //                     $newfilename = "n_" . Helper::generate_string(10) . "." . $ext;
    //                 } while (file_exists("../app/data/documents/" . $newfilename));

    //                 $fp = fopen("../app/data/documents/" . $newfilename, "w+");
    //                 if (fwrite($fp, ($filedata))) {
    //                     $q2 = "INSERT INTO `Documents` (`DocumentsCategoryID`, `DocumentSettingID`, `DocumentPath`, `DocumentTitle`, `DocumentAccess`, `DocumentDisplayName`, `AddedByID`) VALUES (:DocumentsCategoryID, :DocumentSettingID, :DocumentPath, :DocumentTitle, :DocumentAccess, :DocumentDisplayName, :AddedByID);";
    //                     $p2 = [
    //                         [":DocumentsCategoryID", "11"],
    //                         [":DocumentSettingID", "9"],
    //                         [":DocumentPath", $newfilename],
    //                         [":DocumentTitle", $file['filename']],
    //                         [":DocumentAccess", "111"],
    //                         [":DocumentDisplayName", "LEAVES"],
    //                         [":AddedByID", $_SESSION['UserID']]
    //                     ];

    //                     $r2 = DBController::ExecuteSQLID($q2, $p2);
    //                     $documentsIDs = $r2 . ',' . $documentsIDs;
    //                 } else {
    //                     return array("return_code" => false, "return_data" => "File not saved !!");
    //                 }
    //                 fclose($fp);
    //             }

    //             // Update LeaveDocumentIDs in Staff_Leave
    //             $param2 = array(
    //                 array(":DocumentIds", rtrim($documentsIDs, ",")),
    //                 array(":LeaveID", $StaffLeaveID)
    //             );
    //             $query2 = "UPDATE `Staff_Leave` SET `LeaveDocumentIDs`=:DocumentIds WHERE `LeaveID`=:LeaveID";
    //             $updateLeaveDoc = DBController::ExecuteSQL($query2, $param2);

    //             if ($updateLeaveDoc) {
    //                 return array("return_code" => true, "return_data" => "Leave Request Successfully");
    //             } else {
    //                 return array("return_code" => false, "return_data" => "Some error occurred while requesting for a leave");
    //             }
    //         }
    //     } else {
    //         return array("return_code" => false, "return_data" => "You have only " . $balancedDays . " Remaining  Balance Day for this Leave Type. Cannot Proceed..");
    //     }
    // }



    /*  Info:
        Description: Get all the leave request
            5-02-2024 (Angelbert Riahtam) : Addd the function
    */
    function getallPendingLeaveRequest($data)
    {
        if ($_SESSION['UserType'] == 1) {
            $query = "SELECT `LeaveID`,s.StaffID,Supervisor1Remarks,Supervisor2Remarks,sl2.LeaveTypeID,sl2.LeaveType,Supervisor1.StaffName as Supervisor1Name,Supervisor2.StaffName as Supervisor2Name,   sl2.NoOfdays as NoOfDaysByLeaveTypeID,LeaveRemarks,s.StaffName,s.DepartmentID,`isUrgent`,isHalfday, `LeaveRemarks`, `LeaveDocumentIDs`, `RequestedDateFrom`, `RequestedDateTo`, Staff_Leave.NoOfDays, `isApproved`,  `ProcessDateTime`, `ProcessByUserID`, `Remarks`, `ProcessDocumentIDs`, `ApprovedDateFrom`, `ApprovedDateTo`,Staff_Leave.CreatedDateTime,GROUP_CONCAT(DISTINCT d.DocumentPath) as DocumentPath
            FROM `Staff_Leave`
            INNER JOIN Staff s on s.StaffID=Staff_Leave.StaffID
            LEFT JOIN Documents d on FIND_IN_SET(d.DocumentsID,Staff_Leave.LeaveDocumentIDs)
            INNER  JOIN Staff_LeaveType sl2 on sl2.LeaveTypeID = `Staff_Leave`.LeaveTypeID
            LEFT  JOIN Staff as Supervisor1 on Supervisor1.StaffID = Staff_Leave.Supervisor1ID
            LEFT  JOIN Staff as Supervisor2 on Supervisor2.StaffID = Staff_Leave.Supervisor2ID
            GROUP BY Staff_Leave.LeaveID;";

            // $query = "SELECT `LeaveID`, `LeaveTypeID`,LeaveRemarks, s.`StaffID`,s.StaffName,s.DepartmentID,`isUrgent`, `LeaveRemarks`, `LeaveDocumentIDs`, `RequestedDateFrom`, `RequestedDateTo`, `NoOfDays`, `isApproved`, `isRejected`, `ProcessDateTime`, `ProcessByUserID`, `Remarks`, `ProcessDocumentIDs`, `ApprovedDateFrom`, `ApprovedDateTo`,Staff_Leave.CreatedDateTime
            // FROM `Staff_Leave`
            // INNER JOIN Staff s on s.StaffID=Staff_Leave.StaffID
            // WHERE Staff_Leave.isApproved is null and Staff_Leave.isRejected is null;";
            $pendingLeave = DBController::getDataSet($query);
            return array("return_code" => true, "return_data" => $pendingLeave);
        }
        //Get Staff Leaves
        else if ($_SESSION['UserType'] == 2) {

            $params = array(

                array(":StaffID", $_SESSION['StaffID']),
            );

            $query = "SELECT `LeaveID`,sl2.LeaveTypeID,sl2.LeaveType,LeaveRemarks,s.StaffName,s.DepartmentID,`isUrgent`, `LeaveRemarks`, `LeaveDocumentIDs`, `RequestedDateFrom`, `RequestedDateTo`, sl2.NoOfDays, `isApproved`, `ProcessDateTime`, `ProcessByUserID`, `Remarks`, `ProcessDocumentIDs`, `ApprovedDateFrom`, `ApprovedDateTo`,Staff_Leave.CreatedDateTime,GROUP_CONCAT(DISTINCT d.DocumentPath) as DocumentPath
             FROM `Staff_Leave`
             INNER JOIN Staff s on s.StaffID=Staff_Leave.StaffID
             LEFT JOIN Documents d on FIND_IN_SET(d.DocumentsID,Staff_Leave.LeaveDocumentIDs)
             INNER  JOIN Staff_LeaveType sl2 on sl2.LeaveTypeID = `Staff_Leave`.LeaveTypeID 
             WHERE Staff_Leave.isApproved is null AND Staff_Leave.StaffID =:StaffID
             GROUP BY Staff_Leave.LeaveID
             ;";
            $StaffpendingLeave = DBController::getDataSet($query, $params);
            if ($StaffpendingLeave) {
                return array("return_code" => true, "return_data" => $StaffpendingLeave);
            }
            return array("return_code" => false, "return_data" => "No data available");
        }
    }


    function getAllUsersLeave()
    {
        if ($_SESSION['UserType'] == 1) { //admin
            $query = "SELECT `LeaveID`,sl2.LeaveType,LeaveRemarks,s.StaffName,s.DepartmentID,`isUrgent`, `LeaveRemarks`, `LeaveDocumentIDs`, `RequestedDateFrom`,isUnderProcess, `RequestedDateTo`, Staff_Leave.NoOfDays, `isApproved`,`ProcessDateTime`, `ProcessByUserID`, `Remarks`, `ProcessDocumentIDs`, `ApprovedDateFrom`, `ApprovedDateTo`,Staff_Leave.CreatedDateTime,GROUP_CONCAT(DISTINCT d.DocumentPath) as DocumentPath
        FROM `Staff_Leave`
        INNER JOIN Staff s on s.StaffID=Staff_Leave.StaffID
        LEFT JOIN Documents d on FIND_IN_SET(d.DocumentsID,Staff_Leave.LeaveDocumentIDs)
        INNER  JOIN Staff_LeaveType sl2 on sl2.LeaveTypeID = `Staff_Leave`.LeaveTypeID 
        GROUP BY Staff_Leave.LeaveID;";

            // $query = "SELECT `LeaveID`, `LeaveTypeID`,LeaveRemarks, s.`StaffID`,s.StaffName,s.DepartmentID,`isUrgent`, `LeaveRemarks`, `LeaveDocumentIDs`, `RequestedDateFrom`, `RequestedDateTo`, `NoOfDays`, `isApproved`, `isRejected`, `ProcessDateTime`, `ProcessByUserID`, `Remarks`, `ProcessDocumentIDs`, `ApprovedDateFrom`, `ApprovedDateTo`,Staff_Leave.CreatedDateTime
            // FROM `Staff_Leave`
            // INNER JOIN Staff s on s.StaffID=Staff_Leave.StaffID
            // WHERE Staff_Leave.isApproved is null and Staff_Leave.isRejected is null;";
            $pendingLeave = DBController::getDataSet($query);
            return array("return_code" => true, "return_data" => $pendingLeave);
        }
        //Get Staff Leaves
        else if ($_SESSION['UserType'] == 2) { //staff

            $params = array(

                array(":StaffID", $_SESSION['StaffID']),
            );

            $query = "SELECT `LeaveID` ,`Remarks` as ApprovedRemarks,Supervisor1.StaffName as supervisor1Name,Supervisor2.StaffName  as supervisor2Name,  Supervisor1.Photo as Supervisor1Photo,  
            Supervisor2.Photo as Supervisor2Photo,sl2.LeaveType,isUnderProcess,LeaveRemarks,s.StaffName,s.DepartmentID,`isUrgent`, `LeaveRemarks`, `LeaveDocumentIDs`, `RequestedDateFrom`, `RequestedDateTo`, Staff_Leave.NoOfDays, `isApproved`,  `ProcessDateTime`, `ProcessByUserID`, `Remarks`, `ProcessDocumentIDs`,`isHalfDay`,`isPostLunch`,`ApprovedDateFrom`, `ApprovedDateTo`,Staff_Leave.CreatedDateTime,GROUP_CONCAT(DISTINCT d.DocumentPath) as DocumentPath
            FROM `Staff_Leave`
            INNER JOIN Staff s on s.StaffID=Staff_Leave.StaffID
            INNER JOIN Staff as Supervisor1 on Supervisor1.StaffID  = Staff_Leave.Supervisor1ID
            INNER JOIN Staff as Supervisor2 on Supervisor2.StaffID  = Staff_Leave.Supervisor2ID
            LEFT JOIN Documents d on FIND_IN_SET(d.DocumentsID,Staff_Leave.LeaveDocumentIDs)
            INNER  JOIN Staff_LeaveType sl2 on sl2.LeaveTypeID = `Staff_Leave`.LeaveTypeID 
            WHERE  Staff_Leave.StaffID =:StaffID  GROUP BY Staff_Leave.LeaveID;";
            $StaffpendingLeave = DBController::getDataSet($query, $params);
            if ($StaffpendingLeave) {
                return array("return_code" => true, "return_data" => $StaffpendingLeave);
            }
            return array("return_code" => false, "return_data" => "No data available");
        }
    }





    /*  Info:
        Description:Approved the leave request
        param (Remarks,FromDate,ToDate,LeaveID,File(Array),DepartmentID)
            5-02-2024 (Angelbert Riahtam) : Addd the function
    */

    function onLeaveApproved($data)
    {
        // DBController::logs("Reached onLeaveApproved");
        //check first if the current user  have the authority or not for that staff in that particular department
        //check for admin
        if (isset($_SESSION['UserType'])) {
            if ($_SESSION['UserType'] == 3) //intern 
            {
                return array("return_code" => false, "return_data" => "Error!! Access Denied");
            }

            if ($_SESSION['UserType'] == 3) //Intern
            {
                //check if that staff has the authority
                $param2 = array(
                    array(":UserID", $_SESSION['UserID'])
                );
                $query2 = "SELECT `StaffID` FROM `Users` WHERE `UserID`=:UserID and `isActive`=1 and UserType=2";
                $StaffID = DBController::sendData($query2, $param2);
                if (!$StaffID) {
                    return array("return_code" => false, "return_data" => "Error!! Not A Valid");
                } else {
                    // DepartmentID
                    $param1 = array(
                        array(":StaffID", $StaffID),
                        array(":DepartmentID", strip_tags($data['DepartmentID']))
                    );
                    $query1 = "SELECT * FROM `Staff_Settings_Leave` where StaffID=:StaffID and DepartmentID=:DepartmentID";
                    $isUserhasAuthority = DBController::sendData($query1, $param1);
                    if (!$isUserhasAuthority) {
                        return array("return_code" => false, "return_data" => "Error!! Access Denied");
                    }
                }
            }
        }
        $checkapprovedparam = array(
            array(":LeaveID", $data['LeaveID']),
            array(":StaffID", $data['StaffID'])
        );
        $checkLeaveApprovalHistory = "SELECT  isUnderProcess,Supervisor1ID,Supervisor2ID FROM Staff_Leave WHERE LeaveID=:LeaveID AND StaffID=:StaffID";
        $checkLeaveApprovalHistoryResult = DBController::sendData($checkLeaveApprovalHistory, $checkapprovedparam);
        if ($checkLeaveApprovalHistoryResult) {
            $ApprovalStatus = $checkLeaveApprovalHistoryResult['isUnderProcess'];
            $CheckSupervisor1 = $checkLeaveApprovalHistoryResult['Supervisor1ID'];
            $CheckSupervisor2 = $checkLeaveApprovalHistoryResult['Supervisor2ID'];
            // DBController::logs("S1 " . $CheckSupervisor1);
            // DBController::logs("S2 " . $CheckSupervisor2);
            if ($ApprovalStatus === NULL &&  $CheckSupervisor1 !== $CheckSupervisor2) { //No one is Approval the leave request, 1= approved by Supervisor1, 2= Approved by Supervisor2
                DBController::logs("Reached S1 and S2 are different ");
                $startDate =  $data['FromDate'];
                $endDate =  $data['ToDate'];
                $params = array(
                    array(":LeaveID", $data['LeaveID']),
                    array(":StaffID", $data['StaffID']),
                    array(":ProcessByUserID", $_SESSION['StaffID']),
                    array(":Supervisor1Remarks", $data['Remarks']),
                );

                $ApprovedBySupervisor1 = "UPDATE Staff_Leave SET isUnderProcess = 1,ProcessByUserID=:ProcessByUserID,Supervisor1Remarks=:Supervisor1Remarks WHERE LeaveID=:LeaveID AND StaffID=:StaffID";
                $ApprovedBySupervisor1Result = DBController::ExecuteSQL($ApprovedBySupervisor1, $params);
                if ($ApprovedBySupervisor1Result) {

                    $p1 = array(
                        array(":LeaveID", $data['LeaveID']),
                        array(":StaffID", $data['StaffID']),
                    );
                    $InitialApproved = "UPDATE Staff_Leave SET isApproved = 1 WHERE leaveID =:LeaveID AND StaffID =:StaffID";
                    $InitialApprovedResult = DBController::ExecuteSQL($InitialApproved, $p1);
                    if ($InitialApprovedResult) {
                        return array("return_code" => true, "return_data" => "Leave Approved Successfully");
                    }
                } else {
                    return array("return_code" => false, "return_data" => "Error!! Approval Failed");
                }
                $CheckSupervisor1 = $checkLeaveApprovalHistoryResult['Supervisor1ID'];
            } else if (($ApprovalStatus == 1 || is_null($ApprovalStatus)) || ($CheckSupervisor1 == $CheckSupervisor2)) { //if the Leave is approved by Supervisor1 and both Supervisor1 and Supervisor2 is same person for approval   leave 
                DBController::logs("Reached S1 and S2 are same ");
                function convertDateFormat($date) //for date format conversion
                {
                    $timestamp = strtotime($date);
                    return date('Y-m-d', $timestamp);
                }
                $ApprovedFromDate = strip_tags($data['FromDate']);
                $ApprovedToDate = strip_tags($data['ToDate']);
                $startDate =  strtotime($ApprovedFromDate);
                $endDate =  strtotime($ApprovedToDate);
                $numberOfDays = round(($endDate - $startDate) / (60 * 60 * 24) + 1);
                if ($data['isHalfDayLeave'] == true) {  // if the leave is half day 
                    $numberOfDays = ($numberOfDays / 2);
                }

                //$BalancednumberOfDays = round(($endDate - $startDate) / (60 * 60 * 24));
                $Entitled = intval(strip_tags($data['NoOfDaysByLeaveTypeID'])); // Convert to integer
                //$checkLastBalance = "SELECT Balanced FROM Staff_Leaves_Balance WHERE ";
                // $Balanced = $Entitled - $numberOfDays;
                $param3 = array(
                    array(":StaffID", $data['StaffID'])
                );

                $getLastLeaveID = "SELECT LeaveID FROM Staff_Leaves_Balance WHERE  StaffID =:StaffID ORDER BY UpdatedDateTime DESC LIMIT 1";
                $resultLeaveID = DBController::sendData($getLastLeaveID, $param3);
                if ($resultLeaveID) {
                    $LastLeaveID = $resultLeaveID['LeaveID'];
                } else {
                    $LastLeaveID = strip_tags($data['LeaveID']);
                }

                $checkLastBalanceparam = array(
                    array(":LeaveID", $LastLeaveID),
                    array(":StaffID", strip_tags($data['StaffID'])),
                );

                $checkLastBalance = "SELECT Balanced FROM Staff_Leaves_Balance WHERE LeaveID = :LeaveID AND StaffID = :StaffID ORDER BY UpdatedDateTime DESC LIMIT 1";
                $result = DBController::sendData($checkLastBalance, $checkLastBalanceparam);
                if ($result) {
                    $LastbalancedDays = $result['Balanced'];
                    //$LastUtilized  = $result['Utilized'];
                    $Balanced = $LastbalancedDays - $numberOfDays;
                } else {
                    $Balanced = $Entitled - $numberOfDays;
                }


                $params = array(
                    // array(":Remarks", strip_tags($data['Remarks'])),
                    array(":LeaveID", strip_tags($data['LeaveID'])),
                    array(":LeaveTypeID", strip_tags($data['LeaveTypeID'])),
                    array(":FromDate", convertDateFormat($data['FromDate'])),
                    array(":ToDate", convertDateFormat($data['ToDate'])),
                    array(":NoOfDays", $numberOfDays),
                    array(":ApprovedByID", $_SESSION['StaffID']),
                    array(":CreatedByID", $_SESSION['StaffID']),
                );

                $query = "INSERT INTO `Staff_Leaves_Approved`(`LeaveID`,`LeaveTypeID`,`FromDate`,`ToDate`,`NoOfDays`,`ApprovedByID`,`CreatedByID`)
                  VALUES (:LeaveID,:LeaveTypeID,:FromDate,:ToDate,:NoOfDays,:ApprovedByID,:CreatedByID)";
                $res = DBController::ExecuteSQL($query, $params);
                if ($res) {
                    $param1 = array(
                        array(":LeaveID", strip_tags($data['LeaveID'])),
                        array(":LeaveTypeID", strip_tags($data['LeaveTypeID'])),
                        array(":StaffID", strip_tags($data['StaffID'])),
                        array(":Entitled", $Entitled),
                        array(":Utilized", $numberOfDays),
                        array(":Balanced", $Balanced),
                        array(":CreatedByID", $_SESSION['StaffID']),
                    );

                    $LeaveBalance = "INSERT INTO `Staff_Leaves_Balance`(`LeaveID`,`StaffID`, `LeaveTypeID`, `Entitled`, `Utilized`, `Balanced`, `CreatedByID`)
                                    VALUES (:LeaveID,:StaffID, :LeaveTypeID, :Entitled, :Utilized, :Balanced, :CreatedByID)";
                    $res1 = DBController::ExecuteSQL($LeaveBalance, $param1);
                    if ($res1) {
                        $params = array(
                            array(":Remarks", strip_tags($data['Remarks'])),
                            array(":LeaveID", strip_tags($data['LeaveID'])),
                            array(":FromDate", convertDateFormat($data['FromDate'])),
                            array(":ToDate", convertDateFormat($data['ToDate'])),
                            array(":ProcessByUserID", $_SESSION['StaffID']),
                            array(":UpdatedBy", $_SESSION['StaffID']),
                        );

                        $query1 = "UPDATE `Staff_Leave` SET `isApproved`=2,`ProcessDateTime`=CURRENT_TIMESTAMP(),`ProcessByUserID`=:ProcessByUserID,`Remarks`=:Remarks, Supervisor1Remarks=:Remarks, Supervisor2Remarks=:Remarks,`ApprovedDateFrom`=:FromDate,`ApprovedDateTo`=:ToDate,`UpdatedBy`=:UpdatedBy 
                       WHERE `LeaveID`=:LeaveID";
                        $approvedLeave = DBController::ExecuteSQL($query1, $params);
                        if ($approvedLeave) {
                            return array("return_code" => true, "return_data" => "Approved Staff Leave");
                        } else {
                            return array("return_code" => false, "return_data" => "Error!! File not saved!!");
                        }

                        // $documentIDs = ""; //to store the leave document IDs

                        // if (!file_exists("../app/data/documents/"))
                        //     mkdir("../app/data/documents/", 0777, TRUE);
                        // ini_set('memory_limit', '-1');
                        // $errorInfo = '';

                        // // if File exist
                        // foreach ($data["File"] as $file) {
                        //     $ext = pathinfo($file['filename'], PATHINFO_EXTENSION);
                        //     $filedata = file_get_contents($file['filedata']);
                        //     do {
                        //         $newfilename = "n_" . Helper::generate_string(10) . "." . $ext;
                        //     } while (file_exists("../app/data/documents/" . $newfilename));
                        //     $fp = fopen("../app/data/documents/" . $newfilename, "w+");

                        //     //if(file_put_contents(("../app/data/documents/".$newfilename), $filedata))
                        //     if (fwrite($fp, ($filedata))) {
                        //         $q2 = "INSERT INTO `Documents`(`DocumentsCategoryID`, `DocumentSettingID`, `DocumentPath`, `DocumentTitle`, `DocumentAccess`, `DocumentDisplayName`, `AddedByID`) VALUES (:DocumentsCategoryID, :DocumentSettingID, :DocumentPath, :DocumentTitle, :DocumentAccess, :DocumentDisplayName, :AddedByID);";
                        //         // [":DocumentPath", "../app/data/documents/" . $newfilename],
                        //         $p2 = [
                        //             [":DocumentsCategoryID", "11"],
                        //             [":DocumentSettingID", "9"],
                        //             [":DocumentPath", $newfilename],
                        //             [":DocumentTitle", $file['filename']],
                        //             [":DocumentAccess", "111"],
                        //             [":DocumentDisplayName", "LEAVE"], //to be given the file uploaded name 
                        //             [":AddedByID", $_SESSION['UserID']]
                        //         ];
                        //         $r2 = DBController::ExecuteSQLID($q2, $p2);

                        //         $documentIDs = $r2 . "," . $documentIDs;
                        //     } else {
                        //         return array("return_code" => false, "return_data" => " Error!! File not saved !!");
                        //     }
                        //     fclose($fp);
                        // }
                        // $param5 = array(
                        //     array(":DocumentIDs", trim($documentIDs)),
                        //     array(":LeaveID", strip_tags($data['LeaveID']))
                        // );
                        // $query5 = "UPDATE `Staff_Leave` SET `ProcessDocumentIDs`=:DocumentIDs  WHERE  `LeaveID`=:LeaveID";
                        // $updateLeaveDocRes = DBController::ExecuteSQL($query5, $param5);

                    }
                }
            }



            // SELECT Balanced FROM Staff_Leaves_Balance WHERE LeaveTypeID = :LeaveTypeID AND StaffID = :StaffID ORDER BY CreatedDateTime DESC LIMIT 1



        }
    }

    /*  Info:
        Description:For decline the leave request
        param (Remarks,LeaveID)
            5-02-2024 (Angelbert Riahtam) : Addd the function
    */
    function declineleaveRequest($data)
    {
        if ($_SESSION['UserType'] == 1) {  //admin reject request 
            $param = array(
                array(":ProcessBy", $_SESSION['UserID']),
                array(":Remarks", strip_tags($data['Remarks'])),
                array(":UpdatedBy", $_SESSION['UserID']),
                array(":LeaveID", strip_tags($data['LeaveID'])),
            );
            $query = "UPDATE `Staff_Leave` SET `isApproved`=0,`ProcessDateTime`=CURRENT_TIMESTAMP(),`ProcessByUserID`=:ProcessBy,`Remarks`=:Remarks,`UpdatedBy`=:UpdatedBy
        WHERE `LeaveID`=:LeaveID";
            $declineRes = DBController::ExecuteSQL($query, $param);
            if ($declineRes) {
                return array("return_code" => true, "return_data" => "Successfully Updated");
            } else {
                return array("return_code" => false, "return_data" => "Failed to update");
            }
        } elseif ($_SESSION['UserType'] == 2) { //staff decline leave
            $param = array(
                array(":ProcessBy", $_SESSION['StaffID']),
                array(":Remarks", strip_tags($data['Remarks'])),
                array(":UpdatedBy", $_SESSION['UserID']),
                array(":LeaveID", strip_tags($data['LeaveID'])),
            );
            $query = "UPDATE `Staff_Leave` SET `isApproved`=0,`ProcessDateTime`=CURRENT_TIMESTAMP(),`ProcessByUserID`=:ProcessBy,`Remarks`=:Remarks,`UpdatedBy`=:UpdatedBy
        WHERE `LeaveID`=:LeaveID";
            $declineRes = DBController::ExecuteSQL($query, $param);
            if ($declineRes) {
                return array("return_code" => true, "return_data" => "Successfully Updated");
            } else {
                return array("return_code" => false, "return_data" => "Failed to update");
            }
        }
    }

    /*  Info:
        Description:get all the list of leave for both Reject and Approved
            5-02-2024 (Angelbert Riahtam) : Addd the function
    */
    function getallLeaveList()
    {
        // $query="SELECT `LeaveID`, `LeaveTypeID`, Staff_Leave.`StaffID`,s.StaffName ,  `isUrgent`, `LeaveRemarks`, `LeaveDocumentIDs`, `RequestedDateFrom`, `RequestedDateTo`, `NoOfDays`, `isApproved`, `isRejected`, `ProcessDateTime`, `ProcessByUserID`,u.Name as ProcessByName, `Remarks`, `ProcessDocumentIDs`, `ApprovedDateFrom`, `ApprovedDateTo`, `CreatedByID`, Staff_Leave.`CreatedDateTime`
        // FROM `Staff_Leave`
        // INNER JOIN Staff s on s.StaffID=Staff_Leave.StaffID
        // LEFT JOIN Users u on u.UserID=Staff_Leave.ProcessByUserID
        // WHERE s.isRemoved=0 and Staff_Leave.isApproved  IS NOT NULL and Staff_Leave.isRejected IS NOT  NULL;";

        $query = 'SELECT `LeaveID`, `LeaveTypeID`, Staff_Leave.`StaffID`,s.StaffName ,  `isUrgent`, `LeaveRemarks`,`RequestedDateFrom`, `RequestedDateTo`, Staff_Leave.NoOfDays, `isApproved`,  `ProcessDateTime`, `ProcessByUserID`,u.Name as ProcessByName, `Remarks`, `ProcessDocumentIDs`, GROUP_CONCAT(d.DocumentPath) as DocumentPath, `ApprovedDateFrom`, `ApprovedDateTo`, `CreatedByID`, Staff_Leave.`CreatedDateTime`, `LeaveDocumentIDs`, GROUP_CONCAT(DISTINCT dd.DocumentPath) as LeaveRequestPath
        FROM `Staff_Leave`
        INNER JOIN Staff s on s.StaffID=Staff_Leave.StaffID
        LEFT JOIN Users u on u.UserID=Staff_Leave.ProcessByUserID
        LEFT JOIN Documents d on FIND_IN_SET(d.DocumentsID, Staff_Leave.ProcessDocumentIDs)
        LEFT JOIN Documents dd on FIND_IN_SET(dd.DocumentsID,Staff_Leave.LeaveDocumentIDs)
        WHERE s.isRemoved=0
        GROUP BY Staff_Leave.LeaveID;';
        $res = DBController::getDataSet($query);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        } else {
            return array("return_code" => false, "return_data" => "Data not Available");
        }
    }

    /*  Info:
        param : {DepartmentID}
        Description:get all the type of leave based on department
            5-02-2024 (Angelbert Riahtam) : Addd the function
    */
    function getLeaveTypeByDepartmentID($data)
    {
        //check  the leave ID  based on given dept 
        $param = array(
            array(":DepartmentID", strip_tags($data['DepartmentID']))
        );
        $query = "SELECT LeaveTypeIDs FROM `Staff_Settings_Leave` WHERE DepartmentID=:DepartmentID;";
        $LeavesIDs = DBController::sendData($query, $param);
        if ($LeavesIDs) {
            $query1 = "SELECT * FROM `Staff_LeaveType` WHERE LeaveTypeID in (" . implode(',', explode(',', $LeavesIDs['LeaveTypeIDs'])) . ") and isActive=1;";
            $leaveTypes = DBController::getDataSet($query1);
            return array("return_code" => true, "return_data" => $leaveTypes);
        } else {
            return array("return_code" => false, "return_data" => "Leave Not Available in this dept. Please Contact Administration ");
        }
    }

    /*  Info:
        Description: Get  login user based the leave request  for Current Month and Year
            14-02-2024 (Devkanta) : Addd the function
    */

    function getUserCurrentMonthLeaveRequest()
    {
        $param = array(
            array(":UserID", $_SESSION['UserID']),
        );

        $query = "SELECT `LeaveID`, `LeaveTypeID`,LeaveRemarks, s.`StaffID`,s.StaffName,s.DepartmentID,u.UserID,`isUrgent`, `LeaveRemarks`, `LeaveDocumentIDs`, `RequestedDateFrom`, `RequestedDateTo`, Staff_Leave.NoOfDays, `isApproved`,`ProcessDateTime`, `ProcessByUserID`, Staff_Leave.`Remarks`, `ProcessDocumentIDs`, `ApprovedDateFrom`, `ApprovedDateTo`,Staff_Leave.CreatedDateTime,GROUP_CONCAT(DISTINCT d.DocumentPath) as DocumentPath
                FROM `Staff_Leave`
                INNER JOIN Staff s on s.StaffID=Staff_Leave.StaffID
                INNER  JOIN Users u  on u.UserID = s.StaffID 
                LEFT JOIN Documents d on FIND_IN_SET(d.DocumentsID,Staff_Leave.LeaveDocumentIDs)
                WHERE  u.UserID =:UserID  AND  MONTH(Staff_Leave.CreatedDateTime) = MONTH(CURRENT_DATE())
                AND YEAR(Staff_Leave.CreatedDateTime) = YEAR(CURRENT_DATE()) 
                GROUP BY Staff_Leave.LeaveID LIMIT 3;";
        $pendingLeave = DBController::getDataSet($query, $param);
        return array("return_code" => true, "return_data" => $pendingLeave);
    }

    /*  Info:
        Description: Get   user All the leave request 
            15-02-2024 (Devkanta) : Addd the function
    */

    function getAllUserLeaveRequest()
    {
        $param = array(
            array(":StaffID", $_SESSION['StaffID']),
        );

        $query = "SELECT `LeaveID`, `LeaveTypeID`,LeaveRemarks, s.`StaffID`,s.StaffName,s.DepartmentID,`isUrgent`, `LeaveRemarks`, `LeaveDocumentIDs`, `RequestedDateFrom`, `RequestedDateTo`, Staff_Leave.NoOfDays, `isApproved`,  `ProcessDateTime`, `ProcessByUserID`, Staff_Leave.`Remarks`, `ProcessDocumentIDs`, `ApprovedDateFrom`, `ApprovedDateTo`,Staff_Leave.CreatedDateTime,GROUP_CONCAT(DISTINCT d.DocumentPath) as DocumentPath
        FROM `Staff_Leave`
        INNER JOIN Staff s on s.StaffID=Staff_Leave.StaffID
        LEFT JOIN Documents d on FIND_IN_SET(d.DocumentsID,Staff_Leave.LeaveDocumentIDs)
        WHERE  Staff_Leave.StaffID  =:StaffID GROUP BY Staff_Leave.LeaveID;";
        $pendingLeave = DBController::getDataSet($query, $param);
        return array("return_code" => true, "return_data" => $pendingLeave);
    }


    function getStaffLeaveBalanced($data)
    {
        if (!isset($data["StaffID"])) {
            $query = "SELECT 
            s.StaffName,
            sl2.LeaveType,
            sla.CreatedDateTime,
            slb.Entitled,
            slb.Utilized,
            sl.isHalfDay,
            SUM(slb.Balanced) AS Balanced
        FROM 
            Staff_Leaves_Approved sla
        INNER JOIN 
            Staff_Leaves_Balance slb ON slb.LeaveID = sla.LeaveID
        INNER JOIN 
            Staff_Leave sl ON sl.LeaveID = sla.LeaveID
        INNER JOIN 
            Staff s ON s.StaffID = sl.StaffID
        INNER JOIN 
            Staff_LeaveType sl2 ON sl2.LeaveTypeID = sla.LeaveTypeID
        GROUP BY 
            s.StaffName, sl2.LeaveType, sla.CreatedDateTime, slb.Entitled, slb.Utilized, sl.isHalfDay;";
            $res = DBController::getDataSet($query);
            if ($res) {
                return array("return_code" => true, "return_data" => $res);
            } else {
                return array("return_code" => false, "return_data" => "Data not Available");
            }
        } else {
            $params = array(
                array(":StaffID", strip_tags($data["StaffID"])),
            );
            $query = "SELECT 
            sl.RequestedDateFrom,
            sl.RequestedDateTo,
            sl.CreatedDateTime AS RequestedDate,
            sl.isApproved AS status,
            sl2.LeaveType,
            Supervisor1.StaffName AS Supervisor1Name,
            Supervisor2.StaffName AS Supervisor2Name,
            sl.isHalfDay,
            sl.Remarks,
            sla.CreatedDateTime AS ApprovedDate,
            slb.Entitled,
            slb.Utilized,
            SUM(slb.Balanced) AS Balanced
        FROM 
            Staff_Leave sl 
        INNER JOIN 
            Staff_LeaveType sl2 ON sl2.LeaveTypeID = sl.LeaveTypeID 
        INNER JOIN 
            Staff AS Supervisor1 ON Supervisor1.StaffID = sl.Supervisor1ID  
        INNER JOIN 
            Staff AS Supervisor2 ON Supervisor2.StaffID = sl.Supervisor2ID 
        LEFT JOIN 
            Staff_Leaves_Approved sla ON sla.LeaveID = sl.LeaveID
        LEFT JOIN 
            Staff_Leaves_Balance slb ON slb.LeaveID = sla.LeaveID  WHERE sl.StaffID =:StaffID
        GROUP BY 
            sl.RequestedDateFrom, sl.RequestedDateTo, sl.CreatedDateTime, sl.isApproved, sl2.LeaveType, Supervisor1.StaffName, Supervisor2.StaffName, sl.isHalfDay, sl.Remarks, sla.CreatedDateTime, slb.Entitled, slb.Utilized;";
            $res = DBController::getDataSet($query, $params);
            if ($res) {
                return array("return_code" => true, "return_data" => $res);
            } else {
                return array("return_code" => false, "return_data" => "Data not Available");
            }
        }
    }


    // function getDaysInMonth()
    // {
    //     $month = date('n');
    //     $year = date('Y');
    //     // Check if the given year is a leap year
    //     $isLeapYear = ($year % 4 == 0 && ($year % 100 != 0 || $year % 400 == 0));

    //     // Define an array with the number of days in each month
    //     $daysInMonth = array(
    //         1 => 31,
    //         2 => ($isLeapYear ? 29 : 28), // February has 29 days in leap years
    //         3 => 31,
    //         4 => 30,
    //         5 => 31,
    //         6 => 30,
    //         7 => 31,
    //         8 => 31,
    //         9 => 30,
    //         10 => 31,
    //         11 => 30,
    //         12 => 31
    //     );
    // // Get StaffIDs from the Staff table
    // $query = "SELECT StaffID FROM Staff";
    // $staffIDs = DBController::getDataSet($query); // Assuming DBController has a method to execute the query and get the dataset

    //     // Return the number of days in the specified month
    //     $numDays = $daysInMonth[$month];

    //     // Check if it's the last day of the month
    //     $today = date('Y-m-d');
    //     $lastDayOfMonth = date('Y-m-t', strtotime($year . '-' . $month . '-01'));
    //     if ($today == $lastDayOfMonth) {
    //         // Check if data already exists for this staff, month, and year
    //         $query = "SELECT COUNT(*) AS count FROM EL_Info WHERE StaffID = ? AND month = ? AND year = ?";            $params = array($month, $year);
    //         $result = DBController::sendData($query, $params); // Assuming DBController has a method to get a single value
    //         if ($result && $result['count'] > 0) {
    //             // Data already exists, return an error message
    //             return array("return_code" => false, "return_data" => "Data already exists for staff, month, and year combination.");
    //         } else {
    //             // Insert a record into the "EL_info" table
    //             $insertParams = array(
    //                 array(":month", $month),
    //                 array(":year", $year),
    //                 array(":numDays", $numDays),
    //             );

    //             $insertQuery = "INSERT INTO EL_Info (month, year, num_days, Credit) VALUES (:month,:year,:numDays,'cr')";
    //             // $insertQuery = array($month, $year, $numDays);
    //             DBController::ExecuteSQL($insertQuery, $insertParams); 
    //         }
    //     }

    //     return $numDays;
    // }

    function CalculateELByEndofMonth()
    {
        $month = date('n'); // Get the current month
        $year = date('Y'); // Get the current year

        // Check if the given year is a leap year
        $isLeapYear = ($year % 4 == 0 && ($year % 100 != 0 || $year % 400 == 0));
        // Define an array with the number of days in each month
        $daysInMonth = array(
            1 => 31,
            2 => ($isLeapYear ? 29 : 28), // February has 29 days in leap years
            3 => 31,
            4 => 30,
            5 => 31,
            6 => 30,
            7 => 31,
            8 => 31,
            9 => 30,
            10 => 31,
            11 => 30,
            12 => 31
        );

        // Get StaffIDs from the Staff table
        $query = "SELECT StaffID FROM Staff WHERE isRemoved = 0";
        $staffIDs = DBController::getDataSet($query);
        // Return the number of days in the specified month
        $numDays = $daysInMonth[$month];

        // Check if it's the last day of the month
        // $today = date('2024-04-30'); //testing manual giving date
        $today = date('Y-m-d');
        $lastDayOfMonth = date('Y-m-t', strtotime($year . '-' . $month . '-01'));

        if ($today == $lastDayOfMonth) {
            foreach ($staffIDs as $staff) {
                $staffID = $staff['StaffID'];
                $params = array(
                    array(":StaffID", $staffID),
                    array(":Month", $month),
                    array(":Year", $year),
                );
                // Check if data already exists for this staff, month, and year
                $query = "SELECT COUNT(*) AS count FROM EL_Info WHERE StaffID =:StaffID AND Month=:Month AND Year =:Year ORDER BY StaffID ";
                $result = DBController::sendData($query, $params);
                if ($result && $result['count'] == 0) {
                    // Prepare the insert parameters array
                    $insertParams = array(
                        array(":staffID", $staffID),
                        array(":Month", $month),
                        array(":Year", $year),
                        array(":NumDays", $numDays),
                        array(":Credit", 'cr'), //credited
                        array(":CreatedByID", $_SESSION['UserID'])
                    );

                    // Insert a record into the "EL_info" table
                    $insertQuery = "INSERT INTO EL_Info (StaffID, Month, Year, NumDays, Credit,CreatedByID) VALUES (:staffID,:Month,:Year,:NumDays,:Credit,:CreatedByID)";
                    $res = DBController::ExecuteSQL($insertQuery, $insertParams);
                    // if ($res) {
                    //     return array("return_code" => true, "return_data" => $res);
                    // } else {
                    //     return array("return_code" => false, "return_data" => "Data already exists for staff, month, and year combination.");
                    // }
                    DBController::logs("Data Entry  for staffID : $staffID, Month: $month, and year of : $year combination");
                } else {
                    DBController::logs("Data already exists for staffID : $staffID, Month: $month, and year of : $year combination");
                }
            }
        }
        if ($today !== $lastDayOfMonth) {
            DBController::logs("$today , is not the end date of the   $month  month and $year Year ");
        }
    }

    function getAllApprovedLeaves()
    {
        $query = "SELECT sla.LeaveApprovedID,sla.LeaveID,s.StaffName,sl.ApprovedDateFrom ,sl.ApprovedDateTo,sl.NoOfDays  from Staff_Leaves_Approved sla
        INNER JOIN Staff_Leave  sl  on sl.LeaveID  = sla.LeaveID 
        INNER JOIN Staff s on s.StaffID  = sl.StaffID WHERE sla.isCancel = 0";
        $res = DBController::getDataSet($query);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        } else {
            return array("return_code" => false, "return_data" => "Data not Available");
        }
    }
    // function addLeaveTypes($data)
    // {
    //     $param = array(
    //         array(":LeaveType", strip_tags($data['LeaveTypeName'])),
    //     );
    //     $check = "SELECT LeaveType FROM Staff_LeaveTypes WHERE LeaveType=:LeaveType";
    //     $result = DBController::sendData($check, $param);
    //     if ($result) {
    //         return array("return_code" => false, "return_data" => "Leave Type already exists");
    //     }
    //     $params = array(
    //         array(":LeaveType", strip_tags($data['LeaveTypeName'])),
    //         array(":NoOfDays", strip_tags($data['NoOfDays'])),
    //     );

    //     $query = "INSERT INTO Staff_LeaveType (LeaveType, NoOfDays) VALUES (:LeaveType,:NoOfDays)";
    //     $res = DBController::ExecuteSQL($query, $params);
    //     if ($res) {
    //         return array("return_code" => true, "return_data" => "New Leave Types added successfully");
    //     } else {
    //         return array("return_code" => false, "return_data" => "Data not Available");
    //     }
    // }
    function addLeaveTypes($data)
    {

        if (isset($data['LeaveTypeID'])) {
            $param = array(
                array(":LeaveType", strip_tags($data['LeaveType'])),
                array(":NoOfDays", strip_tags($data['NoOfDays'])),
            );

            $checkQuery = "SELECT count(*) as SameLeaveType  FROM Staff_LeaveType WHERE LeaveType =:LeaveType AND NoOfDays =:NoOfDays";
            $result = DBController::sendData($checkQuery, $param);
            if ($result['SameLeaveType'] > 0) {
                return array("return_code" => false, "return_data" => "Same Leave Type already exists");
            } else {
                $param = array(
                    array(":LeaveTypeID", strip_tags($data['LeaveTypeID'])),
                    array(":LeaveType", strip_tags($data['LeaveType'])),
                    array(":NoOfDays", strip_tags($data['NoOfDays'])),
                );
                $update = "UPDATE Staff_LeaveType SET LeaveType=:LeaveType, NoOfDays=:NoOfDays WHERE LeaveTypeID=:LeaveTypeID";
                $result = DBController::ExecuteSQL($update, $param);
                if ($result) {
                    return array("return_code" => true, "return_data" => "Leave Type updated successfully");
                } else {
                    return array("return_code" => false, "return_data" => "Data not Available");
                }
            }
        } else {
            // Check if the LeaveType already exists
            $param = array(
                array(":LeaveType", strip_tags($data['LeaveTypeName'])),

            );

            $checkQuery = "SELECT count(*) as SameLeaveType  FROM Staff_LeaveType WHERE LeaveType =:LeaveType";
            $result = DBController::sendData($checkQuery, $param);
            if ($result['SameLeaveType'] > 0) {
                return array("return_code" => false, "return_data" => "Same Leave Type already exists");
            } else {
                // LeaveType doesn't exist, proceed with insertion
                $params = array(
                    array(":LeaveType", strip_tags($data['LeaveTypeName'])),
                    array(":NoOfDays", strip_tags($data['NoOfDays'])),
                );

                $insertQuery = "INSERT INTO Staff_LeaveType (LeaveType, NoOfDays) VALUES (:LeaveType, :NoOfDays)";
                $res = DBController::ExecuteSQL($insertQuery, $params);

                if ($res) {
                    // Insertion successful
                    return array("return_code" => true, "return_data" => "New Leave Type added successfully");
                } else {
                    // Failed to insert
                    return array("return_code" => false, "return_data" => "Failed to add new Leave Type");
                }
            }
        }
    }
    // function requestLeave($data)
    // {
    //     // Check if someone is logged in
    //     if (!isset($_SESSION['UserType'])) {
    //         return array("return_code" => false, "return_data" => "Access Denied. Please Login to Continue");
    //     }

    //     // Interns cannot request for leave
    //     if ($_SESSION['UserType'] == 3) {
    //         return array("return_code" => false, "return_data" => "Invalid User for Leave request");
    //     }

    //     // Retrieve StaffID either from provided data or session
    //     $staffID = isset($data['StaffID']) ? strip_tags($data['StaffID']) : $_SESSION['StaffID'];

    //     // Check and format date
    //     $fromDate = isset($data['FromDate']) ? (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $data['FromDate']) ? strip_tags($data['FromDate']) : date('Y-m-d', strtotime($data["FromDate"]))) : null;
    //     $toDate = isset($data['ToDate']) ? (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $data['ToDate']) ? strip_tags($data['ToDate']) : date('Y-m-d', strtotime($data["ToDate"]))) : null;

    //     // Check if dates are provided
    //     if (!$fromDate || !$toDate) {
    //         return array("return_code" => false, "return_data" => "Invalid date format");
    //     }

    //     // Calculate number of days
    //     $numberOfDays = round((strtotime($toDate) - strtotime($fromDate)) / (60 * 60 * 24));

    //     // Check if LeaveTypeID is provided
    //     if (!isset($data['LeaveTypeID'])) {
    //         return array("return_code" => false, "return_data" => "Leave type not specified");
    //     }

    //     $leaveTypeID = strip_tags($data['LeaveTypeID']);

    //     // Check leave balance for the staff
    //     $balanceCheckResult = $this->checkLeaveBalance($staffID, $leaveTypeID, $numberOfDays);
    //     if (!$balanceCheckResult['return_code']) {
    //         return $balanceCheckResult;
    //     }

    //     // Insert leave request
    //     $params = array(
    //         array(":LeaveTypeID", $leaveTypeID),
    //         array(":StaffID", $staffID),
    //         array(":isUrgent", isset($data['isUrgent']) ? (bool)strip_tags($data['isUrgent']) : false),
    //         array(":LeaveRemarks", isset($data['LeaveRemarks']) ? strip_tags($data['LeaveRemarks']) : ''),
    //         array(":FromDate", $fromDate),
    //         array(":NoOfDays", $numberOfDays),
    //         array(":ToDate", $toDate),
    //         array(":CreatedBy", $_SESSION['UserID']),
    //     );

    //     $query = "INSERT INTO `Staff_Leave`(`LeaveTypeID`, `StaffID`, `isUrgent`, `LeaveRemarks`,  `RequestedDateFrom`, `RequestedDateTo`,NoOfDays,`CreatedByID`)
    //         VALUES (:LeaveTypeID,:StaffID,:isUrgent,:LeaveRemarks,:FromDate,:ToDate,:NoOfDays,:CreatedBy)";
    //     $StaffLeaveID = DBController::ExecuteSQLID($query, $params);

    //     if ($StaffLeaveID) {
    //         // Handle documents
    //         if (!empty($data['File'])) {
    //             $documentHandlingResult = $this->handleDocuments($data['File'], $StaffLeaveID);
    //             if (!$documentHandlingResult['return_code']) {
    //                 return $documentHandlingResult;
    //             }
    //         }

    //         return array("return_code" => true, "return_data" => "Leave Request Successfully");
    //     } else {
    //         return array("return_code" => false, "return_data" => "Some error occurred while requesting for a leave");
    //     }
    // }

    private function hasPendingLeave($StaffID)
    {
        $query = "SELECT * FROM Staff_Leave where StaffID=:StaffID and  IFNULL(isApproved,0) = 0";
        $params = array(
            array(":StaffID", $StaffID)
        );
        $result = DBController::sendData($query, $params);
        if ($result) {
            return array("return_code" => true, "return_data" => "Pending Leave Exists.");
        } else {
            return array("return_code" => false, "return_data" => "No Pending Leave Exists.");
        }
    }
    function requestLeave($data)

    {
        // Check if someone is logged in
        if (!isset($_SESSION['UserType'])) {
            return array("return_code" => false, "return_data" => "Access Denied. Please Login to Continue");
        }

        // Interns cannot request for leave
        if ($_SESSION['UserType'] == 3) {
            return array("return_code" => false, "return_data" => "Invalid User for Leave request");
        }

        //check if their is any pending leave request for that staff and return the respose Pending Leave Exists
        $pendingLeave = $this->hasPendingLeave(isset($data['StaffID']) ? $data['StaffID'] : $_SESSION['StaffID']);
        if ($pendingLeave['return_code'] == true) {
            return array("return_code" => false, "return_data" => $pendingLeave['return_data']);
        }

        if ($_SESSION['UserType'] == 1) //admin Request leave for staff
        {
            // Retrieve StaffID from data 
            $staffID = strip_tags($data['StaffID']);
            // Check and format date
            $fromDate = isset($data['FromDate']) ? (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $data['FromDate']) ? strip_tags($data['FromDate']) : date('Y-m-d', strtotime($data["FromDate"]))) : null;
            $toDate = isset($data['ToDate']) ? (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $data['ToDate']) ? strip_tags($data['ToDate']) : date('Y-m-d', strtotime($data["ToDate"]))) : null;

            // Check if dates are provided
            if (!$fromDate || !$toDate) {
                return array("return_code" => false, "return_data" => "Invalid date format");
            }

            // Calculate number of days
            $numberOfDays = round((strtotime($toDate) - strtotime($fromDate)) / (60 * 60 * 24)) + 1;
            if ($data['isHalfDay'] == true) {
                $numberOfDays = $numberOfDays / 2;
            }

            // Check if LeaveTypeID is provided
            if (!isset($data['LeaveTypeID'])) {
                return array("return_code" => false, "return_data" => "Leave type not specified");
            }

            $leaveTypeID = strip_tags($data['LeaveTypeID']);
            // Check leave balance for the staff
            $balanceCheckResult = $this->checkLeaveBalance($staffID, $leaveTypeID, $numberOfDays, $data);
            if ($balanceCheckResult && isset($balanceCheckResult['type']) && $balanceCheckResult['type'] === 'exhausted') {
                // Return the exhausted message directly
                return $balanceCheckResult;
            } elseif (!$balanceCheckResult || !$balanceCheckResult['return_code']) {
                // If leave balance check fails or no data found, proceed with inserting the record
                // Prepare parameters for the insert query
                $params = array(
                    array(":LeaveTypeID", $leaveTypeID),
                    array(":StaffID", $staffID),
                    array(":isUrgent", isset($data['isUrgent']) ? (bool)strip_tags($data['isUrgent']) : false),
                    array(":LeaveRemarks", isset($data['LeaveRemarks']) ? strip_tags($data['LeaveRemarks']) : ''),
                    array(":FromDate", $fromDate),
                    array(":NoOfDays", $numberOfDays),
                    array(":ToDate", $toDate),
                    array(":isHalfDay", $data['isHalfDay']),
                    array(":isPostLunch", $data['isPostLunch']),
                    array(":CreatedBy", $_SESSION['UserID']),
                );

                // Insert the record into the Staff_Leave table
                $query = "INSERT INTO `Staff_Leave`(`LeaveTypeID`, `StaffID`, `isUrgent`, `LeaveRemarks`,  `RequestedDateFrom`, `RequestedDateTo`,NoOfDays,isHalfDay,isPostLunch,`CreatedByID`)
                  VALUES (:LeaveTypeID,:StaffID,:isUrgent,:LeaveRemarks,:FromDate,:ToDate,:NoOfDays,:isHalfDay,:isPostLunch,:CreatedBy)";
                $StaffLeaveID = DBController::ExecuteSQLID($query, $params);
                if ($StaffLeaveID) {
                    // Handle documents
                    if (!empty($data['File'])) {
                        $documentHandlingResult = $this->handleDocuments($data['File'], $StaffLeaveID);
                        if (!$documentHandlingResult['return_code']) {
                            return $documentHandlingResult;
                        }
                    }
                }


                // Check if the insertion was successful
                if ($StaffLeaveID) {
                    return array("return_code" => true, "return_data" => "Leave request added successfully");
                } else {
                    return array("return_code" => false, "return_data" => "Failed to add leave request");
                }
            } else {
                // If leave balance check passes, return the result
                return $balanceCheckResult;
            }
        } else if ($_SESSION['UserType'] == 2) {  //Staff Request Leave


            // Retrieve StaffID from  session
            $staffID =  $_SESSION['StaffID'];
            // Check and format date
            $fromDate = isset($data['FromDate']) ? (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $data['FromDate']) ? strip_tags($data['FromDate']) : date('Y-m-d', strtotime($data["FromDate"]))) : null;
            $toDate = isset($data['ToDate']) ? (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $data['ToDate']) ? strip_tags($data['ToDate']) : date('Y-m-d', strtotime($data["ToDate"]))) : null;

            // Check if dates are provided
            if (!$fromDate || !$toDate) {
                return array("return_code" => false, "return_data" => "Invalid date format");
            }

            // Calculate number of days
            $numberOfDays = round((strtotime($toDate) - strtotime($fromDate)) / (60 * 60 * 24)) + 1;

            // Check if LeaveTypeID is provided
            if (!isset($data['LeaveTypeID'])) {
                return array("return_code" => false, "return_data" => "Leave type not specified");
            }

            if (isset($data['isHalfDayLeave']) && $data['isHalfDayLeave'] == true) {
                $numberOfDays = $numberOfDays / 2;
            }



            $leaveTypeID = strip_tags($data['LeaveTypeID']);
            // Check leave balance for the staff
            $balanceCheckResult = $this->checkLeaveBalance($staffID, $leaveTypeID, $numberOfDays, $data);
            if ($balanceCheckResult && isset($balanceCheckResult['type']) && $balanceCheckResult['type'] === 'exhausted') {
                // Return the exhausted message directly
                return $balanceCheckResult;
            } elseif (!$balanceCheckResult || !$balanceCheckResult['return_code']) {
                // If leave balance check fails or no data found, proceed with inserting the record
                // Prepare parameters for the insert query
                //Check StaffPending Leave Request , if existing cannot be request leave request
                $param = array(
                    array(":StaffID", $staffID),
                );
                $CheckStaffPendingRequest = "SELECT  isApproved FROM Staff_Leave sl  WHERE  StaffID =:StaffID   ORDER BY CreatedDateTime DESC LIMIT 1 ";
                $CheckStaffPendingRequestResult = DBController::sendData($CheckStaffPendingRequest, $param);
                if ($CheckStaffPendingRequestResult) {
                    if ($CheckStaffPendingRequestResult['isApproved'] == NULL) {
                        return array("return_code" => false, "return_data" => "You have  pending requested leave");
                    }
                }
                $isHalfDay = isset($data['isHalfDayLeave']) ? $data['isHalfDayLeave'] : 0;
                $isPostLunch = isset($data['isPostLunch']) ? (int)$data['isPostLunch'] : 0;

                // Now $isHalfDay and $isPostLunch will contain the values from $data if they are set, otherwise they will be set to 0.

                $params = array(
                    array(":LeaveTypeID", $leaveTypeID),
                    array(":StaffID", $staffID),
                    array(":isUrgent", isset($data['isUrgent']) ? (bool)strip_tags($data['isUrgent']) : false),
                    array(":LeaveRemarks", isset($data['LeaveRemarks']) ? strip_tags($data['LeaveRemarks']) : ''),
                    array(":FromDate", $fromDate),
                    array(":NoOfDays", $numberOfDays),
                    array(":ToDate", $toDate),
                    array(":isHalfDay", $isHalfDay),
                    array(":isPostLunch",  $isPostLunch),
                    array(":Supervisor1ID", strip_tags($data['Supervisor1ID'])),
                    array(":Supervisor2ID", strip_tags($data['Supervisor2ID'])),
                    array(":CreatedBy", $_SESSION['StaffID']),
                );

                // Insert the record into the Staff_Leave table
                $query = "INSERT INTO `Staff_Leave`(`LeaveTypeID`, `StaffID`, `isUrgent`, `LeaveRemarks`,  `RequestedDateFrom`, `RequestedDateTo`,NoOfDays,`CreatedByID`,isHalfDay,isPostLunch,`Supervisor1ID`,`Supervisor2ID`)
                  VALUES (:LeaveTypeID,:StaffID,:isUrgent,:LeaveRemarks,:FromDate,:ToDate,:NoOfDays,:CreatedBy,:isHalfDay,:isPostLunch,:Supervisor1ID,:Supervisor2ID)";
                $StaffLeaveID = DBController::ExecuteSQLID($query, $params);
                if ($StaffLeaveID) {
                    // Handle documents
                    if (!empty($data['File'])) {
                        $documentHandlingResult = $this->handleDocuments($data['File'], $StaffLeaveID);
                        if (!$documentHandlingResult['return_code']) {
                            return $documentHandlingResult;
                        }
                    }
                }
                // Check if the insertion was successful
                if ($StaffLeaveID) {
                    return array("return_code" => true, "return_data" => "Leave request added successfully");
                } else {
                    return array("return_code" => false, "return_data" => "Failed to add leave request");
                }
            } else {
                // If leave balance check passes, return the result
                return $balanceCheckResult;
            }
        }
    }


    function checkLeaveBalance($staffID, $leaveTypeID, $numberOfDays, $data)
    {
        // Query to retrieve leave balance
        $query = "SELECT Balanced FROM Staff_Leaves_Balance WHERE LeaveTypeID = :LeaveTypeID AND StaffID = :StaffID ORDER BY CreatedDateTime DESC LIMIT 1";
        $params = array(
            array(":LeaveTypeID", $leaveTypeID),
            array(":StaffID", $staffID)
        );

        // Retrieve leave balance data
        $result = DBController::sendData($query, $params);

        // If no data is returned, continue with leave request
        if (!$result) {
            // Return true indicating balance check successful
            return array("return_code" => false, "return_data" => "No leave balance record found");
        }

        // Retrieve balanced days from the result
        $balancedDays = intval($result['Balanced']);

        // Check if requested days exceed balanced days or if balance is NULL
        if ($balancedDays >= $numberOfDays || $balancedDays == NULL) {
            // Prepare parameters for the insert query

            if ($balancedDays == 0) {
                // Return error message directly
                return array("return_code" => false, "type" => "exhausted", "return_data" => "You already exhausted the number of days for this Leave Type");
            }
            // Check and format date
            $fromDate = isset($data['FromDate']) ? (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $data['FromDate']) ? strip_tags($data['FromDate']) : date('Y-m-d', strtotime($data["FromDate"]))) : null;
            $toDate = isset($data['ToDate']) ? (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $data['ToDate']) ? strip_tags($data['ToDate']) : date('Y-m-d', strtotime($data["ToDate"]))) : null;
            $params = array(
                array(":LeaveTypeID", $leaveTypeID),
                array(":StaffID", $staffID),
                array(":isUrgent", isset($data['isUrgent']) ? (bool)strip_tags($data['isUrgent']) : false),
                array(":LeaveRemarks", isset($data['LeaveRemarks']) ? strip_tags($data['LeaveRemarks']) : ''),
                array(":FromDate", $fromDate),
                array(":NoOfDays", $numberOfDays),
                array(":ToDate", $toDate),
                array(":CreatedBy", $_SESSION['UserID']),
            );

            // Insert new leave entry
            $insertLeaveResult = $this->requestLeave($params);
            if ($insertLeaveResult['return_code']) {
                return array("return_code" => true, "return_data" => "Leave entry added successfully");
            } else {
                return array("return_code" => false, "return_data" => "Failed to add leave entry");
            }
        } else {
            // Return false indicating insufficient leave balance
            return array("return_code" => false, "return_data" => "Insufficient leave balance");
        }
    }



    function handleDocuments($files, $staffLeaveID)
    {
        // Handle documents
        if (!file_exists("../app/data/documents/")) {
            mkdir("../app/data/documents/", 0777, TRUE);
        }

        ini_set('memory_limit', '-1');
        $documentsIDs = '';

        foreach ($files as $file) {
            $ext = pathinfo($file['filename'], PATHINFO_EXTENSION);
            $filedata = file_get_contents($file['filedata']);
            do {
                $newfilename = "n_" . Helper::generate_string(10) . "." . $ext;
            } while (file_exists("../app/data/documents/" . $newfilename));

            $fp = fopen("../app/data/documents/" . $newfilename, "w+");
            if (fwrite($fp, ($filedata))) {
                $q2 = "INSERT INTO `Documents` (`DocumentsCategoryID`, `DocumentSettingID`, `DocumentPath`, `DocumentTitle`, `DocumentAccess`, `DocumentDisplayName`, `AddedByID`) VALUES (:DocumentsCategoryID, :DocumentSettingID, :DocumentPath, :DocumentTitle, :DocumentAccess, :DocumentDisplayName, :AddedByID);";
                $p2 = [
                    [":DocumentsCategoryID", "11"],
                    [":DocumentSettingID", "9"],
                    [":DocumentPath", $newfilename],
                    [":DocumentTitle", $file['filename']],
                    [":DocumentAccess", "111"],
                    [":DocumentDisplayName", "LEAVES"],
                    [":AddedByID", $_SESSION['UserID']]
                ];

                $r2 = DBController::ExecuteSQLID($q2, $p2);
                $documentsIDs = $r2 . ',' . $documentsIDs;
            } else {
                return array("return_code" => false, "return_data" => "File not saved !!");
            }
            fclose($fp);
        }

        // Update LeaveDocumentIDs in Staff_Leave
        $param2 = array(
            array(":DocumentIds", rtrim($documentsIDs, ",")),
            array(":LeaveID", $staffLeaveID)
        );
        $query2 = "UPDATE `Staff_Leave` SET `LeaveDocumentIDs`=:DocumentIds WHERE `LeaveID`=:LeaveID";
        $updateLeaveDoc = DBController::ExecuteSQL($query2, $param2);

        if ($updateLeaveDoc) {
            return array("return_code" => true, "return_data" => "Documents added successfully");
        } else {
            return array("return_code" => false, "return_data" => "Error updating leave documents");
        }
    }
    function getNoofDaysByLeaveTypeID($data)
    {
        $param = array(
            array(":LeaveTypeID", $data['LeaveTypeID']),
        );
        $query = "SELECT `NoOfDays` FROM `Staff_LeaveType`  WHERE `LeaveTypeID`=:LeaveTypeID";
        $result = DBController::sendData($query, $param);
        if ($result) {
            return array("return_code" => true, "return_data" => $result["NoOfDays"]);
        } else {
            return array("return_code" => false, "return_data" => "No of days not found");
        }
    }

    function getAllLeaveTypes()
    {
        $query = "SELECT * FROM `Staff_LeaveType`";
        $result = DBController::getDataSet($query);
        if ($result) {
            return array("return_code" => true, "return_data" => $result);
        }
    }

    function onCancelApprovedLeave($data)
    {

        $param = array(
            array(":LeaveID", $data['LeaveID']),
            array(":LeaveApprovedID", $data['LeaveApprovedID']),
            array(":CancelByID", $_SESSION['UserID']),
        );
        $query = "UPDATE `Staff_Leaves_Approved` SET `isCancel`= 1,`CancelByID`=:CancelByID,CancelDateTime=NOW()  WHERE `LeaveID`=:LeaveID AND `LeaveApprovedID`=:LeaveApprovedID;";
        $updateLeave = DBController::ExecuteSQL($query, $param);
        if ($updateLeave) {
            $param = array(
                array(":LeaveID", $data['LeaveID']),
            );
            $query = "DELETE FROM `Staff_Leaves_Balance` WHERE `LeaveID`=:LeaveID";
            $deleteLeave = DBController::ExecuteSQL($query, $param);
            if ($deleteLeave) {
                return array("return_code" => true, "return_data" => "Leave  cancelled successfully");
            } else {
                return array("return_code" => false, "return_data" => "Failed to cancel leave ");
            }
        }
    }
    function getUserLeaveOnDate($data)
    {

        if (isset($_SESSION['StaffID']) && $_SESSION['UserType'] == 2) {
            // Set default values for FromDate and ToDate if not provided in $data
            $fromDate = isset($data['FromDate']) ? $data['FromDate'] : date('Y-m-d');
            $toDate = isset($data['ToDate']) ? $data['ToDate'] : date('Y-m-d');
            $Flag = isset($data['Flag']) ? $data['Flag'] : false;

            $param = array(
                array(":RequestedDateFrom", $fromDate),
                array(":RequestedDateTo", $toDate),
                array(":StaffID", $_SESSION['StaffID']),
            );
            if ($Flag == 1) {
                $query = "SELECT  sl2.LeaveType,Supervisor1.StaffName as Supervisor1Name,Supervisor2.StaffName as Supervisor2Name,ProcessBy.StaffName as ProcessBy  ,sl.RequestedDateFrom, sl.RequestedDateTo, sl.NoOfDays,sl.LeaveRemarks,sl.isApproved,sl.isHalfDay,sl.ProcessDateTime,sl.ProcessByUserID   
    FROM Staff_Leave sl 
    INNER JOIN Staff_LeaveType sl2 ON sl2.LeaveTypeID = sl.LeaveTypeID 
    INNER JOIN Staff s ON s.StaffID = sl.StaffID 
    INNER JOIN Staff as Supervisor1 ON Supervisor1.StaffID = sl.Supervisor1ID 
     INNER JOIN Staff as Supervisor2 ON Supervisor2.StaffID = sl.Supervisor2ID 
     LEFT JOIN Staff as ProcessBy ON ProcessBy.StaffID = sl.ProcessByUserID 
WHERE sl.RequestedDateFrom BETWEEN :RequestedDateFrom  AND :RequestedDateTo  AND sl.StaffID=:StaffID;";
            } else if ($Flag == 2) {
                $param = array(
                    array(":StaffID", $_SESSION['StaffID']),
                );

                $query = "SELECT  sl2.LeaveType,Supervisor1.StaffName as Supervisor1Name,Supervisor2.StaffName as Supervisor2Name,ProcessBy.StaffName as ProcessBy,sl.Remarks,sl.RequestedDateFrom, sl.RequestedDateTo, sl.NoOfDays,sl.LeaveRemarks,sl.isApproved,sl.isHalfDay,sl.ProcessDateTime,sl.ProcessByUserID   
                FROM Staff_Leave sl 
                INNER JOIN Staff_LeaveType sl2 ON sl2.LeaveTypeID = sl.LeaveTypeID 
                INNER JOIN Staff s ON s.StaffID = sl.StaffID 
                INNER JOIN Staff as Supervisor1 ON Supervisor1.StaffID = sl.Supervisor1ID 
                INNER JOIN Staff as Supervisor2 ON Supervisor2.StaffID = sl.Supervisor2ID 
                LEFT JOIN Staff as ProcessBy ON ProcessBy.StaffID = sl.ProcessByUserID 
                WHERE  sl.StaffID=:StaffID AND  MONTH (sl.CreatedDateTime) = MONTH(CURDATE());";
            }


            $res = DBController::getDataSet($query, $param);
            return array("return_code" => true, "return_data" => $res);
        }

        if (isset($_SESSION['UserType']) && $_SESSION['UserType'] == 1) {
            DBController::logs("reached admin session");
            // Set default values for FromDate and ToDate if not provided in $data
            $fromDate = isset($data['FromDate']) ? $data['FromDate'] : date('Y-m-d');
            $toDate = isset($data['ToDate']) ? $data['ToDate'] : date('Y-m-d');

            $param = array(
                array(":RequestedDateFrom", $fromDate),
                array(":RequestedDateTo", $toDate),
                array(":StaffID", $data['StaffID']),
            );




            $query = "SELECT s.StaffName, sl2.LeaveType, sl.RequestedDateFrom, sl.RequestedDateTo, sl.NoOfDays,sl.LeaveRemarks   
         FROM Staff_Leave sl 
         INNER JOIN Staff_LeaveType sl2 ON sl2.LeaveTypeID = sl.LeaveTypeID 
         INNER JOIN Staff s ON s.StaffID = sl.StaffID 
         WHERE sl.RequestedDateFrom BETWEEN :RequestedDateFrom  AND :RequestedDateTo  AND sl.StaffID=:StaffID;";
            $res = DBController::getDataSet($query, $param);
            return array("return_code" => true, "return_data" => $res);
        }
    }

    function getStaffLeaveReports($data)
    {
        $param = array(
            array(":StaffID", $data["StaffID"]),
        );
        $query = "SELECT sl.LeaveID, sl.LeaveType, sl.RequestedDateFrom, sl.RequestedDateTo, sl.NoOfDays  
        FROM Staff_Leave sl 
        INNER JOIN Staff_LeaveType sl2 ON sl2.LeaveTypeID = sl.LeaveTypeID 
        INNER JOIN Staff s ON s.StaffID = sl.StaffID 
        WHERE sl.StaffID=:StaffID;";
        $res = DBController::getDataSet($query, $param);
        return array("return_code" => true, "return_data" => $res);
    }

    function getUserLeaveBasedOnSupervisors()
    {
        //DBController::logs("Call getUserLeaveBasedOnSupervisors By StaffID :  " . $_SESSION['StaffID']);

        $param = array(
            array(":Supervisor1ID", $_SESSION['StaffID']),
            array(":Supervisor2ID", $_SESSION['StaffID']),
        );

        $SuperVisor1ID = $_SESSION['StaffID'];
        $SuperVisor2ID = $_SESSION['StaffID'];

        $query = "SELECT sl.LeaveID, sl.LeaveTypeID, Supervisor1.StaffID as Supervisor1ID, Supervisor2.StaffID as Supervisor2ID, Supervisor1.StaffName as Supervisor1Name, Supervisor1.Photo as Supervisor1Photo, Supervisor2.Photo as Supervisor2Photo, Supervisor2.StaffName as Supervisor2Name, sl.isHalfDay, sl.Remarks, sl.StaffID, s.StaffName as RequestedBy, sl.isApproved, sl.Supervisor1Remarks, sl.Supervisor2Remarks, sl2.LeaveType, sl.RequestedDateFrom, sl.RequestedDateTo, sl.NoOfDays, sl.CreatedDateTime 
            FROM Staff_Leave sl 
            LEFT JOIN Staff_LeaveType sl2 ON sl2.LeaveTypeID = sl.LeaveTypeID 
            INNER JOIN Staff s ON s.StaffID = sl.StaffID 
            INNER JOIN Staff as Supervisor1 ON Supervisor1.StaffID = sl.Supervisor1ID 
            INNER JOIN Staff as Supervisor2 ON Supervisor2.StaffID = sl.Supervisor2ID 
            WHERE sl.Supervisor1ID = :Supervisor1ID OR sl.Supervisor2ID = :Supervisor2ID";
        $res = DBController::getDataSet($query, $param);
        foreach ($res as $result) {
            if ($SuperVisor1ID == $result['Supervisor1ID'] && $result['Supervisor1Remarks'] === NULL) { //not yet approved by supervisor1
                // DBController::logs("Reached 1");
                return array("return_code" => true, "return_data" => $res);
            } elseif ($SuperVisor1ID == $result['Supervisor1ID'] && $result['Supervisor1Remarks'] !== NULL && $result['Supervisor2Remarks'] !== NULL) {
                // DBController::logs("Reached 2");
                return  array("return_code" => true, "return_data" => $res);
            } elseif ($SuperVisor1ID == $result['Supervisor1ID'] &&  $SuperVisor2ID == $result['Supervisor2ID'] && $result['Supervisor1Remarks'] !== NULL && $result['Supervisor2Remarks'] !== NULL) {
                // DBController::logs("Reached 2");
                return  array("return_code" => true, "return_data" => $res);
            } elseif ($SuperVisor2ID == $result['Supervisor2ID'] && $result['Supervisor1Remarks'] !== NULL && $result['isApproved'] == 1) { //approved by supervisor1 but not yet approved by supervisor2
                // DBController::logs("Reached 2");
                return  array("return_code" => true, "return_data" => $res);
            } elseif ($SuperVisor2ID == $result['Supervisor2ID'] && $result['Supervisor1Remarks'] === NULL && $result['isApproved'] === NULL) { // but not yet approved by supervisor1 then supervisor2 cannot be approved
                // DBController::logs("Reached 3");

                return  array("return_code" => false, "return_data" => "No Leave Data ");
            } elseif ($SuperVisor1ID == $SuperVisor2ID && $result['Supervisor1Remarks'] == NULL) { //if both supervisor1 and supervisor2 is the same supervisor and not yet approved then direct supervisor can be approved final leave
                // DBController::logs("Reached 4");

                return  array("return_code" => true, "return_data" => $res);
            }
        }
        return  array("return_code" => false, "return_data" => "No Leave Data ");
    }


    function getTodayStaffLeaveReport()
    {
        $query = "SELECT  s.StaffName,sl.NoOfDays,sl.ProcessByUserID ,sl.isHalfDay,sl.isPostLunch,sl.RequestedDateFrom,sl.RequestedDateTo,sl.isApproved  FROM  Staff_Leave sl LEFT JOIN Staff_Leaves_Approved sla on sla.LeaveID = sl.LeaveID 
        INNER JOIN Staff s on s.StaffID  = sl.StaffID  WHERE DATE(sl.RequestedDateFrom) = CURDATE() or DATE(sl.RequestedDateTo) = CURDATE()";
        $res = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $res);
    }

    function getSupervisorForStaffLeaves()
    {

        $params = array(
            array(":StaffID", $_SESSION['StaffID'])
        );
        $query = "SELECT
        sat.Supervisor1 as Supervisor1ID,
        sat.Supervisor2 as Supervisor2ID, 
        Supervisor1.StaffName AS Supervisor1Name,
        Supervisor2.StaffName AS Supervisor2Name,
        Supervisor1.Photo as Supervisor1Photo,  
        Supervisor2.Photo as Supervisor2Photo
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
            return array("return_code" => false, "return_data" => "No Leave Records  Found");
        }
    }
}
