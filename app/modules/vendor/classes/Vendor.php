<?php

namespace app\modules\vendor\classes;

use app\database\DBController;
use app\modules\documents\classes\Documents;
use app\modules\auth\classes\Signup;

class Vendor
{

    /* 
    Current Version: 2.0.0
    Created By: Devkanta,     dev1@techz.in
    Created On: 04/09/2024
    Modified By:
    Modified On: 

*/

    function saveEmployee($data)
    {
        // Prepare your INSERT query for employee table
        $query = "INSERT INTO `employee` (`emp_name`, `emp_contact`, `emp_address`, `emp_email`, `sector_id`) 
              VALUES (:emp_name, :emp_contact, :emp_address, :emp_email, :sector_id)";

        // Bind parameters from $data array (sanitize inputs as needed)
        $param = [
            [":emp_name", strip_tags($data["emp_name"])],
            [":emp_contact", strip_tags($data["emp_contact"])],
            [":emp_address", strip_tags($data["emp_address"])],
            [":emp_email", strip_tags($data["emp_email"])],
            [":sector_id", isset($data["sector_id"]) ? intval($data["sector_id"]) : null],
        ];

        // Execute the query - Assuming DBController::ExecuteSQLID returns inserted ID on success
        $employeeID = DBController::ExecuteSQLID($query, $param);

        if ($employeeID) {
            return array("return_code" => true, "return_data" => "Employee registered successfully");
        }

        return array("return_code" => false, "return_data" => "Unable to add Employee registration");
    }

    function getEmployeeList()
    {
        $query = "SELECT em.*,s.sector_name as sector FROM `Employee` as em
        LEFT JOIN sector s on s.sector_id = em.sector_id";
        $res = DBController::getDataSet($query);
        if ($res)
            return array("return_code" => true, "return_data" => $res);
        return array("return_code" => false, "return_data" => "No data Available");
    }


    function getActiveEmployeeList()
    {   
        $query = "SELECT em.*,s.sector_name as sector FROM `Employee` as em
        LEFT JOIN sector s on s.sector_id = em.sector_id WHERE em.status='active';";
        $res = DBController::getDataSet($query);
        if ($res)
            return array("return_code" => true, "return_data" => $res);
        return array("return_code" => false, "return_data" => "No data Available");
    }

 function getActiveEmployeesForAttendance()
    {   
        $query = "SELECT em.*,s.sector_name as sector,a.attendance_date,a.status as attendance_status,a.shift FROM `Employee` as em
        LEFT JOIN Sector s on s.sector_id = em.sector_id 
        LEFT JOIN Attendance a on a.emp_id = em.emp_id
        WHERE em.status='active';";
        $res = DBController::getDataSet($query);
        if ($res)
            return array("return_code" => true, "return_data" => $res);
        return array("return_code" => false, "return_data" => "No data Available");
    }

    
    



    function getSectors()
    {
        $query = "SELECT * FROM Sector;";
        $res = DBController::getDataSet($query);
        if ($res)
            return array("return_code" => true, "return_data" => $res);
        return array("return_code" => false, "return_data" => "No data Available");
    }
    function changeStatus($data)
    {
        // Validate required fields
        if (empty($data["emp_id"]) || empty($data["status"])) {
            return array("return_code" => false, "return_data" => "Missing required parameters.");
        }

        // Update status in Employee table
        $query = "UPDATE Employee SET `status` = :status WHERE `emp_id` = :emp_id";
        $param = [
            [":status", strip_tags($data["status"])],
            [":emp_id", strip_tags($data["emp_id"])]
        ];
        $res = DBController::ExecuteSQL($query, $param);

        if ($res) {
            return array("return_code" => true, "return_data" => "Status updated successfully");
        } else {
            return array("return_code" => false, "return_data" => "Failed to update status.");
        }
    }

    function getVendorInfo($data)
    {
        $query = "SELECT v.* FROM Vendors v inner join Users u  on u.VendorID  = v.VendorID  WHERE u.`Username` = :Username AND u.Password = :Password ";
        $params = array(
            array(":Username", strip_tags($data["Username"])),
            array(":Password", hash("sha256", substr($data["Username"], 0, 1) . strip_tags($data["Password"])))
        );
        $res = DBController::sendData($query, $params);
        if ($res)
            return array("return_code" => true, "return_data" => $res);
        return array("return_code" => false, "return_data" => "No Vendor Data Available");
    }
    function addFood($data)
    {
        if (!isset($_SESSION['UserID'])) {
            return array("return_code" => false, "return_data" => "Session Expired, Please Login Again");
        }
        //make sure that food id added by Delivery Person
        $delivery = "SELECT u.VendorID FROM `Users` u  INNER JOIN Vendors v  on v.VendorID = u.VendorID
                    WHERE u.UserID=:UserID;";
        $params = array(
            array(":UserID", $_SESSION['UserID'])
        );
        $vendorData = DBController::sendData($delivery, $params);
        // DBController::logs(json_encode(value: $vendorData));
        //add to document first 
        if ($vendorData) {
            $Image_URL = 0;
            if (!empty($data['FoodData'])) {
                $files = $data['FoodData'];
                // Extract file data
                $fileData = isset($files['filedata']) ? $files['filedata'] : '';
                $fileName = isset($files['filename']) ? $files['filename'] : '';
                $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
                // Check if file data and filename are available
                if ($fileData && $fileName) {
                    // Prepare document parameters
                    $docParam = array(
                        "file" => $fileData,
                        "ext" => $fileExt,
                        "DocumentsCategory" => "Food",
                        "DocumentsCategoryID" => null,
                        "DocumentSettingID" => null,
                        "DocumentTitle" => $fileName,
                        "DocumentAccessLevel" => "111",
                        "DocumentDisplayName" => $fileName,
                        "AddedByID" => 1,
                    );

                    // Call method to add document
                    $documentRes = (new Documents())->addDocument($docParam);
                    $Image_URL = $documentRes['DocumentEncryptedID'];
                }
            }
            $query = "INSERT INTO `Foods`(Name,Price,Description, Image_URL, AddedBy) VALUES (:Name,:Price,:Description,:Image_URL,:AddedBy)";
            $param = [
                [":Name", $data['Name']],
                [":Price", $data['Price']],
                [":Description", $data['Description']],
                [":AddedBy", $vendorData['VendorID']],
                [":Image_URL", $Image_URL],
            ];
            $food = DBController::ExecuteSQL($query, $param);
            if ($food) {
                return array("return_code" => true, "return_data" => "Food added successfully");
            }
            return array("return_code" => false, "return_data" => "Unable to add food");
        }
        return array("return_code" => false, "return_data" => "You are not a Vendor person");
    }
    function getFoods()
    {
        $query = "SELECT f.Name as FoodName,f.Description,f.Price,d.DocumentEncryptedID as FoodImage FROM `Foods` f 
                INNER JOIN Documents d on d.DocumentEncryptedID = f.Image_URL WHERE f.isActive =1;";
        $res = DBController::getDataSet($query);
        if ($res)
            return array("return_code" => true, "return_data" => $res);
        return array("return_code" => false, "return_data" => "No Food Data Available");
    }
}
