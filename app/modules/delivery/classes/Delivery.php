<?php

namespace app\modules\delivery\classes;

use app\database\DBController;
use app\misc\FCM;
use app\misc\SMS;
use app\modules\delivery\classes\Session;
use app\modules\documents\classes\Documents;
use app\modules\auth\classes\Signup;

class Delivery
{

    /* 
    Current Version: 2.0.0
    Created By: Devkanta,     dev1@techz.in
    Created On: 04/09/2024
    Modified By:
    Modified On: 

*/
    function saveWork($data)
    {
        $query = "INSERT INTO `work` (work_title, work_description, loc_id, start_date, end_date)
              VALUES (:work_title, :work_description, :loc_id, :start_date, :end_date);";

        $params = [
            [":work_title", $data["work_title"]],
            [":work_description", $data["work_description"]],
            [":loc_id", $data["loc_id"]],
            [":start_date", $data["start_date"]],
            [":end_date", $data["end_date"]],
        ];

        $WorkID = DBController::ExecuteSQLID($query, $params);

        if ($WorkID) {
            return [
                "return_code" => true,
                "return_data" => "Work Added successfully"
            ];
        }

        return [
            "return_code" => false,
            "return_data" => "Unable to register work"
        ];
    }



    function getWorks()
    {
        $query = "SELECT w.*,l.loc_name FROM `Work` as w LEFT JOIN Location l on l.loc_id = w.loc_id;";
        $work = DBController::getDataSet($query);
        if ($work)
            return array("return_code" => true, "return_data" => $work);
        return array("return_code" => false, "return_data" => "No  data  found");
    }


    function assignWork($data)
    {
        // Prepare SQL insert statement for assignment
        $query = "INSERT INTO `Work_Assign` (emp_id, work_id) VALUES (:emp_id, :work_id);";

        $params = [
            [":emp_id", $data["emp_id"]],
            [":work_id", $data["work_id"]],
        ];

        // Execute insert and get insert ID
        $assignID = DBController::ExecuteSQLID($query, $params);

        if ($assignID) {
            // After successful assignment, update the work status to 'assigned'
            $updateQuery = "UPDATE `work` SET `status` = 'assigned' WHERE `work_id` = :work_id;";
            $updateParams = [
                [":work_id", $data["work_id"]]
            ];

            $updated = DBController::ExecuteSQL($updateQuery, $updateParams);

            if ($updated) {
                return [
                    "return_code" => true,
                    "return_data" => "Work assigned  successfully"
                ];
            } else {
                return [
                    "return_code" => false,
                    "return_data" => "Work assigned but failed to update status"
                ];
            }
        }

        return [
            "return_code" => false,
            "return_data" => "Unable to assign work"
        ];
    }

    function getAssignWork()
    {
        $query = "SELECT wa.*,w.work_title,w.start_date,w.end_date,e.emp_name,l.loc_name FROM `work_assign` wa
        LEFT JOIN Work as w on w.work_id = wa.work_id
        LEFT JOIN Employee as e on e.emp_id = wa.emp_id
        LEFT JOIN Location l on l.loc_id = w.loc_id
        ;";
        $work = DBController::getDataSet($query);
        if ($work)
            return array("return_code" => true, "return_data" => $work);
        return array("return_code" => false, "return_data" => "No  data  found");
    }



    function approvedDelivery($data)
    {
        $query = "UPDATE Delivery_Partners SET `isApproved` = 1 WHERE PersonalID = :PersonalID";
        $param = [
            [":PersonalID", $data['PersonalID']]
        ];
        $approvedDelivery = DBController::ExecuteSQL($query, $param);
        if ($approvedDelivery) {
            //create a new delivery user
            $query = "SELECT * FROM Delivery_Partners WHERE `PersonalID` = :PersonalID";
            $delivery = DBController::sendData($query, $param);
            $user = array(
                "Username" => $delivery["ContactNo"],
                "Name" => $delivery["AccountHolderName"],
                "ContactNo" => $delivery["ContactNo"],
                "EmailID" => 'delivery@gmail.com',
                "UserType" => 3,
                "PersonalID" => $delivery["PersonalID"],
                "ValidateUsernameOnly" => True
            );
            $userdata = (new Signup())->request($user);
        }
        return array("return_code" => true, "return_data" => "Delivery approved successfully");
    }
    function getDeliveryInfo($data)
    {
        $query = "SELECT dp.* FROM Delivery_Partners dp  inner join Users u on  u.DeliveryPersonalID  = dp.PersonalID  WHERE u.`Username` = :Username AND u.Password = :Password";
        $params = array(
            array(":Username", strip_tags($data["Username"])),
            array(":Password", hash("sha256", substr($data["Username"], 0, 1) . strip_tags($data["Password"])))
        );

        $delivery = DBController::sendData($query, $params);
        if ($delivery) {
            return array("return_code" => true, "return_data" => $delivery);
        }
        return array("return_code" => false, "return_data" => "No delivery found");
    }

    function getLocations()
    {
        $query = "SELECT * FROM Location";
        $loc = DBController::getDataSet($query);
        if ($loc) {
            return array("return_code" => true, "return_data" => $loc);
        }
        return array("return_code" => false, "return_data" => "No Location found");
    }
}
