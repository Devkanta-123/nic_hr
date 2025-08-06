<?php
/* 
    Current Version: 1.0.0
    Created By: Devkanta,     dev1@techz.in
    Created On: 25/04/2024
    Modified By:
    Modified On:  
*/

namespace app\modules\staff\classes;

use app\database\DBController;
use \app\database\Helper;
use \app\misc\Sodium;

class Payroll
{

    function addSalaryHead($data)
    {
        // Check parameters array
        $Checkparam = array(
            array(":SalaryHead", $data['SalaryHead']),
            array(":SalaryHeadAlias", $data['SalaryHeadAlias']),
        );

        // Insert parameters array
        $params = array(
            array(":SalaryHead", $data['SalaryHead']),
            array(":SalaryHeadAlias", $data['SalaryHeadAlias']),
            array(":SalaryHeadType", $data['SalaryHeadType']),
            array(":isActive", 1),
        );

        // Check if parameters already exist in the table
        $checkQuery = "SELECT COUNT(*) AS count FROM Payroll_Salary_Head WHERE Salary_Head = :SalaryHead AND Salary_HeadAlias = :SalaryHeadAlias";
        $checkResult = DBController::sendData($checkQuery, $Checkparam);

        if ($checkResult['count'] > 0) {
            return array("return_code" => false, "return_data" => "Same Salary Head Already exists");
        } else {
            // If parameters don't exist, proceed with insertion
            $insertQuery = "INSERT INTO Payroll_Salary_Head (Salary_Head, Salary_HeadAlias, SalaryHeadType, isActive) VALUES (:SalaryHead, :SalaryHeadAlias, :SalaryHeadType, :isActive)";
            $insertResult = DBController::ExecuteSQL($insertQuery, $params);

            if ($insertResult) {
                return array("return_code" => true, "return_data" => "Successfully Added");
            } else {
                return array("return_code" => false, "return_data" => "Failed to add");
            }
        }
    }

    function getAllSalaryHeads()
    {

        $query = "SELECT * from Payroll_Salary_Head  psh  INNER  JOIN Settings_Payroll_Salary_Headtype spsh  on spsh.HeadTypeID  = psh.SalaryHeadType where psh.isActive  = 1 ";
        $res = DBController::getDataSet($query);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        } else {
            return array("return_code" => false, "return_data" => "Data not available");
        }
    }
    function editSalaryHead($data)
    {
        // Check parameters array
        $Checkparam = array(
            array(":SalaryHead", $data['SalaryHead']),
            array(":SalaryHeadAlias", $data['SalaryHeadAlias']),
        );
        $params = array(
            array(":SalaryHead", $data['SalaryHead']),
            array(":SalaryHeadAlias", $data['SalaryHeadAlias']),
            array(":isActive", 1),
            array(":Salary_HeadID", $data['SalaryHeadID']),
        );
        // Check if parameters already exist in the table
        $checkQuery = "SELECT COUNT(*) AS count FROM Payroll_Salary_Head WHERE Salary_Head = :SalaryHead AND Salary_HeadAlias = :SalaryHeadAlias";
        $checkResult = DBController::sendData($checkQuery, $Checkparam);
        if ($checkResult['count'] > 0) {
            return array("return_code" => false, "return_data" => "Same Salary Head Already exists");
        } else {
            // If parameters don't exist, proceed with insertion
            $insertQuery = "UPDATE Payroll_Salary_Head SET Salary_Head = :SalaryHead, Salary_HeadAlias = :SalaryHeadAlias, isActive = :isActive WHERE Salary_HeadID = :Salary_HeadID";
            $insertResult = DBController::ExecuteSQL($insertQuery, $params);
            if ($insertResult) {
                return array("return_code" => true, "return_data" => "Successfully Updated");
            } else {
                return array("return_code" => false, "return_data" => "Failed to update");
            }
        }
    }


    function addStaffSalarySettings($data)
    {
        // Check parameters array
        $Checkparam = array(
            array(":StaffID", $data['StaffID']),
        );
        // Insert parameters array

        $checkQuery = "SELECT COUNT(*) AS count FROM Payroll_Settings_StaffSalary WHERE StaffID = :StaffID ";
        $checkResult = DBController::sendData($checkQuery, $Checkparam);

        if ($checkResult['count'] > 0) {
            return array("return_code" => false, "return_data" => "Data for this StaffID  Already exists");
        } else {
            $params = array(
                array(":StaffID", $data['StaffID']),
                array(":NetAmount", $data['NetAmount']),
                array(":Earning", $data['Earning']),
                array(":Deduction", $data['Deduction']),
                array(":isActive", 1),
            );

            $query = "INSERT INTO  Payroll_Settings_StaffSalary (StaffID,NetAmount,Earning,Deduction,isActive) VALUES (:StaffID,:NetAmount,:Earning,:Deduction,:isActive)";
            $res = DBController::ExecuteSQL($query, $params);
            if ($res) {
                return array("return_code" => true, "return_data" => "Successfully Added");
            } else {
                return array("return_code" => false, "return_data" => "Failed to add");
            }
        }
    }

    function getAllStaffSalary()
    {
        $query = "SELECT pss.*,s.StaffName  from Payroll_StaffSalary  pss  INNER JOIN Staff s ON s.StaffID = pss.StaffID  WHERE  pss.isActive = 1";
        $res = DBController::getDataSet($query);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        } else {
            return array("return_code" => false, "return_data" => "Data not available");
        }
    }

    // function addStaffSalary($data)
    // {
    //     // Check parameters array
    //     $Checkparam = array(
    //         array(":StaffID", $data['StaffID']),
    //         array(":SalaryDate", $data['SalaryDate']),

    //     );

    //     // Insert parameters array
    //     $params = array(
    //         array(":StaffID", $data['StaffID']),
    //         array(":NetSalary", $data['NetSalary']),
    //         array(":Earning", $data['Earning']),
    //         array(":Deduction", $data['Deduction']),
    //         array(":SalaryDate", $data['SalaryDate']),
    //     );
    //     // Check if parameters already exist in the table

    //     $checkQuery = "SELECT COUNT(*) AS count FROM Payroll_StaffSalary WHERE StaffID = :StaffID AND SalaryDate = :SalaryDate";
    //     $checkResult = DBController::sendData($checkQuery, $Checkparam);
    //     if ($checkResult['count'] > 0) {
    //         return array("return_code" => false, "return_data" => "Salary Already Credited For this Month");
    //     } else {
    //         // If parameters don't exist, proceed with insertion
    //         $insertQuery = "INSERT INTO Payroll_StaffSalary (StaffID, NetSalary, Earning, Deduction, SalaryDate) VALUES (:StaffID, :NetSalary, :Earning, :Deduction, :SalaryDate)";
    //         $insertResult = DBController::ExecuteSQL($insertQuery, $params);
    //         if ($insertResult) {
    //             return array("return_code" => true, "return_data" => "Salary Successfully Added");
    //         } else {
    //             return array("return_code" => false, "return_data" => "Failed to add");
    //         }
    //     }
    // }


    function updateSalarySettings($data)
    {
        if (!isset($data['StaffID'])) {
            return array("return_code" => false, "return_data" => "Unable to update Data");
        }

        // Define an array mapping field names to column names in the database
        $fieldColumnMap = array(
            "NetAmount" => "NetAmount",
            "Earning" => "Earning",
            "Deduction" => "Deduction",
        );

        // Check if the provided field is valid
        if (!isset($fieldColumnMap[$data['Column']])) {
            return array("return_code" => false, "return_data" => "Invalid data column name  to update");
        }

        $columnName = $fieldColumnMap[$data['Column']];
        $param = array(
            array(":Data", strip_tags($data['Data'])),
            array(":StaffID", strip_tags($data['StaffID'])),
            array(":Payroll_Settings_StaffSalaryID", strip_tags($data['Payroll_Settings_StaffSalaryID'])),
        );


        // Construct the update query
        $updateQuery = "UPDATE `Payroll_Settings_StaffSalary` SET $columnName=:Data WHERE `StaffID`=:StaffID AND Payroll_Settings_StaffSalaryID=:Payroll_Settings_StaffSalaryID";
        // Execute the update query
        $updateResult = DBController::ExecuteSQL($updateQuery, $param);
        if ($updateResult) {
            return array("return_code" => true, "return_data" => "Successfully Updated");
        } else {
            return array("return_code" => false, "return_data" => "Unable to update the data");
        }
    }

    function getAllSalaryHead()
    {
        $query = "SELECT * from Payroll_Salary_Head  psh   where psh.isActive  = 1 ";
        $res = DBController::getDataSet($query);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        } else {
            return array("return_code" => false, "return_data" => "Data not available");
        }
    }


    function getAllEarningSalaryHead()
    {

        $query = "SELECT * from Payroll_Salary_Head  psh  INNER  JOIN Settings_Payroll_Salary_Headtype spsh  on spsh.HeadTypeID  = psh.SalaryHeadType where psh.isActive  = 1 AND psh.SalaryHeadType = 1";
        $res = DBController::getDataSet($query);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        } else {
            return array("return_code" => false, "return_data" => "Data not available");
        }
    }


    function getAllDeductionSalaryHead()
    {
        $query = "SELECT * from Payroll_Salary_Head  psh  INNER  JOIN Settings_Payroll_Salary_Headtype spsh  on spsh.HeadTypeID  = psh.SalaryHeadType where psh.isActive  = 1 AND psh.SalaryHeadType = 2";
        $res = DBController::getDataSet($query);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        } else {
            return array("return_code" => false, "return_data" => "Data not available");
        }
    }


    function addStaffSalary($data)
    {

        // StaffID: $("#staffs").val(),
        // SalaryData: salaryData,
        // TotalEarningAmount: totalEarningAmount, // Initialize total earning amount to zero
        // TotalDeductionAmount: totalDeductionAmount,
        // NetAmount: netAmount,
        $today = date("Y-m-d");
        $params = array(
            array(":StaffID", $data['StaffID']),
            array(":Earning", $data['TotalEarningAmount']),
            array(":Deduction", $data['TotalDeductionAmount']),
            array(":NetAmount", $data['NetAmount']),
            array(":isActive", 1),
            array(":SalaryDate", $today),
        );

        $query = "INSERT INTO `Payroll_StaffSalary`(`StaffID`,`NetAmount`,`Earning`,`Deduction`,`SalaryDate`,`isActive`) VALUES (:StaffID,:NetAmount,:Earning,:Deduction,:SalaryDate,:isActive)";
        $res = DBController::ExecuteSQLID($query, $params);
        if ($res) {
            $SalaryData = $data["SalaryData"];
            // Insert earning data
            $earningData = $SalaryData['earning'];
            foreach ($earningData as $earning) {
                $param = array(
                    array(":Payroll_StaffSalaryID", $res),
                    array(":SalaryHeadID", $earning['SalaryHeadID']),
                    array(":Earning", $earning["Value"]),
                    array(":Deduction", 0) // Set deduction value to 0 for earning data
                );

                $q = "INSERT INTO Payroll_StaffSalary_Details(Payroll_StaffSalaryID,SalaryHeadID, Earning, Deduction) VALUES (:Payroll_StaffSalaryID,:SalaryHeadID, :Earning, :Deduction)";
                $result = DBController::ExecuteSQLID($q, $param);
                if (!$result) {
                    return array("return_code" => false, "return_data" => "An error occurred while submitting. Please try again.");
                }
            }

            // Insert deduction data
            $deductionData = $SalaryData['deduction'];
            foreach ($deductionData as $deduction) {
                $param = array(
                    array(":Payroll_StaffSalaryID", $res),
                    array(":SalaryHeadID", $deduction['SalaryHeadID']),
                    array(":Earning", 0), // Set earning value to 0 for deduction data
                    array(":Deduction", $deduction["Value"])
                );

                $q = "INSERT INTO Payroll_StaffSalary_Details(Payroll_StaffSalaryID,SalaryHeadID, Earning, Deduction) VALUES (:Payroll_StaffSalaryID,:SalaryHeadID, :Earning, :Deduction)";
                $result = DBController::ExecuteSQLID($q, $param);
                if (!$result) {
                    return array("return_code" => false, "return_data" => "An error occurred while submitting. Please try again.");
                }
            }

            return array("return_code" => true, "return_data" => "Successfully added");
        } else {
            return array("return_code" => false, "return_data" => "An Error occurs while Submitting.Please try again.");
        }
    }



    function getStaffEarningSalarySlip($data)
    {
        $params = array(
            array(":StaffID", strip_tags($data['StaffID'])),
            array(":Payroll_StaffSalaryID", strip_tags($data['Payroll_StaffSalaryID'])),
        );

        $dataFlag = $data['Flag'];
        // Initialize the query variable
        $query = "";

        // Switch query based on data flag
        switch ($dataFlag) {
            case 'earnings':
                $query = "SELECT pssd.Earning,d.DesignationName,pssd.Deduction ,pss.Earning  as EarningAmount,pss.Deduction  as DeductionAmount,psh.Salary_Head,s.StaffName,pss.NetAmount,s.ContactNo,s.JoinedDate from Payroll_StaffSalary_Details pssd 
            INNER JOIN Payroll_StaffSalary pss ON pss.Payroll_StaffSalaryID = pssd.Payroll_StaffSalaryID  
            INNER JOIN Staff s ON s.StaffID = pss.StaffID 
            INNER JOIN Setting_Designation d on d.DesignationID = s.DesignationID
            INNER JOIN Payroll_Salary_Head psh on psh.Salary_HeadID  = pssd.SalaryHeadID 
            WHERE pss.StaffID = :StaffID AND pssd.Payroll_StaffSalaryID = :Payroll_StaffSalaryID AND pssd.Earning !=0";
                break;
            case 'deductions':
                $query = "SELECT pssd.Earning,pssd.Deduction ,pss.Earning  as EarningAmount,pss.Deduction  as DeductionAmount,psh.Salary_Head,s.StaffName,pss.NetAmount from Payroll_StaffSalary_Details pssd 
            INNER JOIN Payroll_StaffSalary pss ON pss.Payroll_StaffSalaryID = pssd.Payroll_StaffSalaryID  
            INNER JOIN Staff s ON s.StaffID = pss.StaffID 
            INNER JOIN Payroll_Salary_Head psh on psh.Salary_HeadID  = pssd.SalaryHeadID 
            WHERE pss.StaffID = :StaffID AND pssd.Payroll_StaffSalaryID = :Payroll_StaffSalaryID AND pssd.Deduction !=0";
                break;
            default:
                return array("return_code" => false, "return_data" => "Invalid data flag");
        }

        // Execute the query
        $res = DBController::getDataSet($query, $params);

        // Check if the query returned any results
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        } else {
            return array("return_code" => false, "return_data" => "Data not available");
        }
    }
}
