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
        $upload_dir = "uploads/employees/";

        // Create folder if it doesn't exist
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $idProofPath = null;
        $residenceCertPath = null;

        // Handle base64-encoded ID proof card
        if (!empty($data["id_proof_card"]["content"])) {
            $idProofBase64 = $data["id_proof_card"]["content"];
            $idProofFilename = uniqid() . "_" . preg_replace('/[^a-zA-Z0-9._-]/', '_', $data["id_proof_card"]["filename"]);
            $idProofPath = $upload_dir . $idProofFilename;

            $this->saveBase64File($idProofBase64, $idProofPath);
        }

        // Handle base64-encoded Residential Certificate
        if (!empty($data["residential_certificate"]["content"])) {
            $resCertBase64 = $data["residential_certificate"]["content"];
            $resCertFilename = uniqid() . "_" . preg_replace('/[^a-zA-Z0-9._-]/', '_', $data["residential_certificate"]["filename"]);
            $residenceCertPath = $upload_dir . $resCertFilename;

            $this->saveBase64File($resCertBase64, $residenceCertPath);
        }

        $query = "INSERT INTO `employee` (
        `emp_name`, `emp_contact`, `emp_address`, `emp_email`, `sector_id`,
        `date_of_joining`, `increment_date`, `wages_amount`,
        `id_proof_file`, `residential_certificate_file`
    ) VALUES (
        :emp_name, :emp_contact, :emp_address, :emp_email, :sector_id,
        :date_of_joining, :increment_date, :wages_amount,
        :id_proof_file, :residential_certificate_file
    )";

        $param = [
            [":emp_name", strip_tags($data["emp_name"])],
            [":emp_contact", strip_tags($data["emp_contact"])],
            [":emp_address", strip_tags($data["emp_address"])],
            [":emp_email", strip_tags($data["emp_email"])],
            [":sector_id", intval($data["sector_id"])],
            [":date_of_joining", strip_tags($data["date_of_joining"])],
            [":increment_date", strip_tags($data["increment_date"])],
            [":wages_amount", floatval($data["wages_amount"])],
            [":id_proof_file", $idProofPath],
            [":residential_certificate_file", $residenceCertPath],
        ];

        $employeeID = DBController::ExecuteSQLID($query, $param);

        if ($employeeID) {
            return array("return_code" => true, "return_data" => "Employee saved successfully");
        }

        return array("return_code" => false, "return_data" => "Unable to add Employee registration");
    }


    function saveBase64File($base64String, $filePath)
    {
        // Remove the base64 header if present
        if (preg_match('/^data:.*;base64,/', $base64String)) {
            $base64String = preg_replace('/^data:.*;base64,/', '', $base64String);
        }

        $decodedData = base64_decode($base64String);
        file_put_contents($filePath, $decodedData);
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
        $query = "SELECT 
    em.*, 
    s.sector_name AS sector, 
    a.attendance_date, 
    a.status AS attendance_status, 
    a.shift,
    l.loc_id,
    l.loc_name
FROM Employee em
LEFT JOIN Sector s ON s.sector_id = em.sector_id
LEFT JOIN Attendance a ON a.emp_id = em.emp_id AND a.attendance_date = CURDATE()
LEFT JOIN Location l ON l.loc_id = a.location_id
WHERE em.status = 'active'
GROUP BY em.emp_id, a.attendance_date, a.status, a.shift, l.loc_id, l.loc_name, s.sector_name;
";

        $res = DBController::getDataSet($query);
        if ($res)
            return array("return_code" => true, "return_data" => $res);
        return array("return_code" => false, "return_data" => "No data Available");
    }




    function getAttendanceReport()
    {
        $query = "SELECT em.*,s.sector_name as sector,a.attendance_date,a.status as attendance_status,a.shift,a.in_time FROM `Employee` as em
        LEFT JOIN Sector s on s.sector_id = em.sector_id 
        LEFT JOIN Attendance a on a.emp_id = em.emp_id
        WHERE em.status='active' ORDER BY a.attendance_date DESC;";
        $res = DBController::getDataSet($query);
        if ($res)
            return array("return_code" => true, "return_data" => $res);
        return array("return_code" => false, "return_data" => "No data Available");
    }



    function getEmployeesAttendanceForPaySlip()
    {
        $query = "
      SELECT 
            e.emp_id, 
            e.emp_name, 
            ps.IsGenerated,
            COUNT(*) AS total_days,
            SUM(CASE WHEN a.status = 'Present' THEN 1 ELSE 0 END) AS present_days
        FROM attendance a 
        INNER JOIN employee e ON e.emp_id = a.emp_id
        LEFT JOIN payslip ps on ps.EmployeeID = e.emp_id
        GROUP BY e.emp_id, e.emp_name,ps.IsGenerated;
    ";

        $res = DBController::getDataSet($query);

        if ($res)
            return array("return_code" => true, "return_data" => $res);

        return array("return_code" => false, "return_data" => "No data Available");
    }
    function getPaySlipsDataByEmpID($data)
    {

        $query = "SELECT ps.*,e.emp_name,e.emp_contact,e.emp_id,e.emp_contact,e.emp_email,e.emp_address FROM `payslip` ps
INNER JOIN Employee e on e.emp_id =ps.EmployeeID 
WHERE ps.EmployeeID=:EmployeeID;
    ";
        $param = [
            [":EmployeeID", strip_tags($data["emp_id"])]
        ];

        $res = DBController::sendData($query, $param);

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
