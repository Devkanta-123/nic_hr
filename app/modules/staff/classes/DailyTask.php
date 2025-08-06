<?php
/* 
    Current Version: 1.0.0
    Created By: Devkanta,     dev1@techz.in
    Created On: 06/02/2024
    Modified By:
    Modified On:  
*/

namespace app\modules\staff\classes;

use app\database\DBController;
use \app\database\Helper;

class DailyTask
{
    /*  Info:
        Description: Get the type of leave only the active one
            3-02-2024 (Devkanta) : Addd the function
    */
    function createdailytask($data) //TaskName  Duration Description
    {
        $param = array(
            array(":TaskName", strip_tags($data['TaskName'])),
            array(":Duration", strip_tags($data['Duration'])),
            array(":isCompleted", 0),
            array(":Description", strip_tags($data["Description"])),
            array(":CompletedById", $_SESSION['UserID']),
            array(":StaffID", $_SESSION['StaffID']),
            array(":CreatedById", $_SESSION['UserID']),
        );

        $query = "INSERT INTO `Staff_Daily_Update`(`TaskName`, `Duration`, `isCompleted`,`Description`, `CompletedById`, `StaffID`, `CreatedById`)
        VALUES (:TaskName,:Duration,:isCompleted,:Description,:CompletedById,:StaffID,:CreatedById);";
        $res = DBController::ExecuteSQL($query, $param);
        if ($res) {
            return array("return_code" => true, "return_data" => "Created Task");
        } else {
            return array("return_code" => false, "return_data" => "Some error occur while adding. Please try again.");
        }
    }



    /*  Info:
        Description: Get all the Pending Tasks and Task Which is  Created on today 
            06-02-2024 (Devkanta) : Addd the function
    */
    function getDailyTask()
    {
        $param = array(
            array(":StaffID", $_SESSION['StaffID']),
        );

        // Fetch tasks created today or before today but not completed
        $query = "SELECT `Id`, `TaskName`, `Duration`, `Description`, `isCompleted`, `CompletedUpDatedTime`,`CreatedDateTime`
              FROM `Staff_Daily_Update` sdu 
              WHERE StaffID=:StaffID 
                    AND (DATE(sdu.CreatedDateTime) = CURDATE() OR (DATE(sdu.CreatedDateTime) < CURDATE() AND isCompleted != 2));";
        $res = DBController::getDataSet($query, $param);
        return array("return_code" => true, "return_data" => $res);
    }

    /*  Info:
        Description: Update the tasks status
            06-02-2024 (Devkanta) : Addd the function
    */

    function updatedailytaskstatus($data)
    {
        $param = array(
            array(":Id", $data['TaskID']),
            array(":isCompleted", $data['Status']),
            array(":StaffID", $_SESSION['StaffID']),
        );

        $query = "UPDATE `Staff_Daily_Update` SET `isCompleted` = :isCompleted WHERE `Id`=:Id AND StaffID=:StaffID;";
        $res = DBController::ExecuteSQL($query, $param);
        if ($res) {
            return array("return_code" => true, "return_data" => "Updated Task");
        } else {
            return array("return_code" => false, "return_data" => "Some error occur.");
        }
    }
    function getTaskStatus()
    {

        $param = array(
            array(":StaffID", $_SESSION['StaffID']),
        );

        $query = "SELECT sdu.TaskName,sdu.Duration,sdu.Description, (CASE WHEN sdu.isCompleted  = 1 THEN 1 END) AS Progress,
        (CASE WHEN sdu.isCompleted = 0 THEN 1 END) AS TODO , (CASE WHEN sdu.isCompleted  = 2 THEN 1 END) AS Completed  
        from Staff_Daily_Update sdu WHERE StaffID=:StaffID AND DATE(sdu.CreatedDateTime)=CURDATE();";
        $res = DBController::getDataSet($query, $param);
        return array("return_code" => true, "return_data" => $res);
    }

    function getUserTaskBetweenTwoDates($data)
    {
        $fromDate = isset($data['FromDate']) ? $data['FromDate'] : date('Y-m-d');
        $toDate = isset($data['ToDate']) ? $data['ToDate'] : date('Y-m-d');

        $param = array(
            array(":FromDate", $fromDate),
            array(":ToDate", $toDate),
            array(":StaffID", $_SESSION['StaffID']),
        );
        $query = "SELECT sdu.TaskName,sdu.Duration,sdu.CreatedDateTime,sdu.Description, sdu.isCompleted, DATE(sdu.CreatedDateTime) as CreatedDate,sdu.CompletedUpDatedTime FROM `Staff_Daily_Update` sdu
        WHERE DATE(sdu.CreatedDateTime) BETWEEN :FromDate AND  :ToDate AND StaffID=:StaffID;";
        $res = DBController::getDataSet($query, $param);
        return array("return_code" => true, "return_data" => $res);
    }

    // function getUserTaskBasedOnDate($data)
    // {
    //     $param = array(
    //         array(":FromDate", $data['FromDate']),
    //         array(":ToDate", $data['ToDate']),
    //         array(":StaffID", $data['StaffID']),
    //     );
    //     $query = "SELECT sdu.TaskName,sdu.Duration,sdu.CreatedDateTime, sdu.Description, sdu.isCompleted, DATE(sdu.CreatedDateTime) as CreatedDate,sdu.CompletedUpDatedTime FROM `Staff_Daily_Update` sdu
    //     WHERE DATE(sdu.CreatedDateTime) BETWEEN :FromDate AND :ToDate AND StaffID=:StaffID;";
    //     $res = DBController::getDataSet($query, $param);
    //     return array("return_code" => true, "return_data" => $res);
    // }
    function getUserTaskBasedOnDate($data)
    {
        // Set default values for FromDate and ToDate if not provided in $data
        $fromDate = isset($data['FromDate']) ? $data['FromDate'] : date('Y-m-d');
        $toDate = isset($data['ToDate']) ? $data['ToDate'] : date('Y-m-d');

        $param = array(
            array(":FromDate", $fromDate),
            array(":ToDate", $toDate),
            array(":StaffID", $data['StaffID']),
        );

        $query = "SELECT sdu.TaskName, sdu.Duration, sdu.CreatedDateTime, sdu.Description, sdu.isCompleted, DATE(sdu.CreatedDateTime) as CreatedDate, sdu.CompletedUpDatedTime FROM `Staff_Daily_Update` sdu
    WHERE DATE(sdu.CreatedDateTime) BETWEEN :FromDate AND :ToDate AND StaffID=:StaffID;";
        $res = DBController::getDataSet($query, $param);
        return array("return_code" => true, "return_data" => $res);
    }
}
