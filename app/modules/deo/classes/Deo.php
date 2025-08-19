<?php

namespace app\modules\deo\classes;

use app\database\DBController;
use app\modules\auth\classes\Signup;

class Deo
{

    /* 
    Current Version: 0.0.0
    Created By: Devkanta
    Created On: 15/11/2024
    Modified By:
    Modified On: 

    */
    function markAttendance($data)
    {
        // Validate required fields
        if (!isset($data['emp_id']) || !isset($data['status'])) {
            return [
                "return_code" => false,
                "return_data" => "Invalid parameters."
            ];
        }

        $emp_id = $data['emp_id'];
        $status = $data['status']; // "Present" or "Absent"
        $shift = isset($data['shift']) ? $data['shift'] : null;
        $attendance_date = date('Y-m-d'); // Today by default
        $location_id = isset($data['location_id']) ? $data['location_id'] : null;

        // Optional: Validate shift if Present
        if ($status === "Present" && empty($shift)) {
            return [
                "return_code" => false,
                "return_data" => "Shift must be provided for Present status."
            ];
        }

        // Insert or update attendance for the current date
        $query = "
       INSERT INTO attendance (emp_id, attendance_date, status, shift, location_id, in_time)
VALUES (:emp_id, :attendance_date, :status, :shift, :location_id, NOW())
ON DUPLICATE KEY UPDATE 
    status = VALUES(status),
    shift = VALUES(shift),
    location_id = VALUES(location_id),
    in_time = NOW()
    ";
        $params = [
            [":emp_id", $emp_id],
            [":attendance_date", $attendance_date],
            [":status", $status],
            [":shift", $shift],
            [":location_id", $location_id]
        ];

        $result = DBController::ExecuteSQL($query, $params);

        if ($result) {
            return [
                "return_code" => true,
                "return_data" => "Attendance marked successfully"
            ];
        } else {
            return [
                "return_code" => false,
                "return_data" => "Failed to mark attendance."
            ];
        }
    }


    function saveLedgerEntry($data)
    {
        if (!isset($data['entries']) || !is_array($data['entries'])) {
            return [
                "return_code" => false,
                "return_data" => "Invalid entry format."
            ];
        }

        $entries = $data['entries'];
        $query = "INSERT INTO Ledger_Entries (entry_date, ledger_head, particulars, debit, credit)
              VALUES (:entry_date, :ledger_head, :particulars, :debit, :credit)";

        $allSuccess = true;

        foreach ($entries as $entry) {
            $ledgerHead = ($entry['type'] === 'Dr') ? 'To' : 'By';

            $params = [
                [":entry_date", $entry['date']],
                [":ledger_head", $ledgerHead],
                [":particulars", $entry['particulars']],
                [":debit", $entry['type'] === 'Dr' ? $entry['amount'] : 0],
                [":credit", $entry['type'] === 'Cr' ? $entry['amount'] : 0],
            ];

            $result = DBController::ExecuteSQL($query, $params);

            if (!$result) {
                $allSuccess = false;
            }
        }

        return [
            "return_code" => $allSuccess,
            "return_data" => $allSuccess
                ? "Ledger entries saved successfully."
                : "Some entries failed to save."
        ];
    }





    function savePaySlipEntry($data)
    {
        if (!isset($data['emp_id'])) {
            return [
                "return_code" => false,
                "return_data" => "Missing required payslip data"
            ];
        }

        // Extract values from $data
        $days = $data['present_days'];
        $OB = $data['opening_balance'];
        $CA = $data['current_advance'];
        $Adv = $data['advance'];
        $amtPaid = $data['amount_paid'];

        // Match JS formulas exactly
        $totalPay = $days * 500;
        $grossAmount = $totalPay + $OB - $CA;
        $netPay = $grossAmount - $Adv;
        $newOpeningBalance = $OB + ($totalPay - $amtPaid);
        $newCurrentAdvance = $CA + $Adv;
        $newBalance = $grossAmount - $amtPaid;

        // Prepare SQL & parameters
        $query = "INSERT INTO payslip 
        (EmployeeID, PresentDays, OpeningBalance, Advance, CurrentAdvance, AmountPaid, TotalPay, IsGenerated,
         GrossAmount, NetPay, NewOpeningBalance, NewCurrentAdvance, NewBalance)
        VALUES 
        (:EmployeeID, :PresentDays, :OpeningBalance, :Advance, :CurrentAdvance, :AmountPaid, :TotalPay, :IsGenerated,
         :GrossAmount, :NetPay, :NewOpeningBalance, :NewCurrentAdvance, :NewBalance)";

        $params = [
            [":EmployeeID", $data['emp_id']],
            [":PresentDays", $days],
            [":OpeningBalance", $OB],
            [":Advance", $Adv],
            [":CurrentAdvance", $CA],
            [":AmountPaid", $amtPaid],
            [":TotalPay", $totalPay],
            [":IsGenerated", 0],
            [":GrossAmount", $grossAmount],
            [":NetPay", $netPay],
            [":NewOpeningBalance", $newOpeningBalance],
            [":NewCurrentAdvance", $newCurrentAdvance],
            [":NewBalance", $newBalance]
        ];

        $result = DBController::ExecuteSQL($query, $params);

        return [
            "return_code" => $result,
            "return_data" => $result
                ? "Payslip entry saved successfully."
                : "Failed to save payslip entry."
        ];
    }




   function saveAdvanceAmount($data)
{
    // Check if any row already exists
    $checkQuery = "SELECT COUNT(*) AS total FROM Master_AdvancePayment";
    $countResult = DBController::sendData($checkQuery);

    if ($countResult['total'] > 0) {
        // There is already a record, so update
        $query = "UPDATE Master_AdvancePayment SET Amount = :Amount";
    } else {
        // No record, insert a new one
        $query = "INSERT INTO Master_AdvancePayment (Amount) VALUES (:Amount)";
    }

    $params = [
        [":Amount", $data['advancepayment']]
    ];
    $result = DBController::ExecuteSQL($query, $params);

    return [
        "return_code" => $result,
        "return_data" => $result
            ? "Data saved successfully."
            : "Failed to save data."
    ];
}

   function saveAllowanceAmount($data)
{
    // Check if any row already exists
    $checkQuery = "SELECT COUNT(*) AS total FROM Master_AllowanceAmount";
    $countResult = DBController::sendData($checkQuery);

    if ($countResult['total'] > 0) {
        // There is already a record, so update
        $query = "UPDATE Master_AllowanceAmount  SET Amount = :Amount";
    } else {
        // No record, insert a new one
        $query = "INSERT INTO Master_AllowanceAmount  (Amount) VALUES (:Amount)";
    }

    $params = [
        [":Amount", $data['allowance_amount']]
    ];
    $result = DBController::ExecuteSQL($query, $params);

    return [
        "return_code" => $result,
        "return_data" => $result
            ? "Data saved successfully."
            : "Failed to save data."
    ];
}




    function getAdvanceAmount()
    {
        $query = "SELECT * FROM Master_AdvancePayment ;";
        $work = DBController::getDataSet($query);
        if ($work)
            return array("return_code" => true, "return_data" => $work);
        return array("return_code" => false, "return_data" => "No  data  found");
    }



    function getAllowanceAmount()
    {
        $query = "SELECT * FROM Master_AllowanceAmount ;";
        $work = DBController::getDataSet($query);
        if ($work)
            return array("return_code" => true, "return_data" => $work);
        return array("return_code" => false, "return_data" => "No  data  found");
    }





    function updatePaySlipStatus($data)
    {
        if (!isset($data['emp_id'])) {
            return [
                "return_code" => false,
                "return_data" => "Missing emp_id"
            ];
        }

        $query = "UPDATE PaySlip 
              SET IsGenerated = 1 
              WHERE EmployeeID = :EmployeeID 
              ORDER BY PaySlipID DESC 
              LIMIT 1";  // ✅ Update latest payslip only

        $params = [
            [":EmployeeID", $data['emp_id']]
        ];

        $result = DBController::ExecuteSQL($query, $params);

        return [
            "return_code" => $result,
            "return_data" => $result
                ? "Payslip status updated."
                : "Failed to update status."
        ];
    }



    function getCustomerInfo($data)
    {
        $params = array(
            array(":Username", strip_tags($data["Username"])),
            array(":Password", hash("sha256", substr($data["Username"], 0, 1) . strip_tags($data["Password"])))
        );

        $query = "SELECT c.* FROM Customer c 
                inner join Users u  on u.CustomerID = c.CustomerID WHERE u.`Username` = :Username AND u.Password = :Password";
        $customerResult = DBController::sendData($query, $params);
        if ($customerResult) {
            return array("return_code" => true, "return_data" => $customerResult);
        }
        return array("return_code" => false, "return_data" => "Customer not found");
    }

    function getCustomerByUserID()
    {
        if (!isset($_SESSION['UserID'])) {
            return array("return_code" => false, "return_data" => "Session Expired  Login  Again..");
        }
        $params = array(
            array(":UserID", strip_tags($_SESSION["UserID"]))
        );
        $query = "SELECT CustomerID FROM Users WHERE UserID = :UserID";
        $customerResult = DBController::sendData($query, $params);
        if ($customerResult) {
            return array("return_code" => true, "return_data" => $customerResult);
        }
        return array("return_code" => false, "return_data" => "Customer not found");
    }
    function addFoodToCards($data)
    {
        $CustomerDetails = $this->getCustomerByUserID();
        if ($CustomerDetails) {
            $CustomerID = $CustomerDetails['return_data']['CustomerID'];
        }

        //check  same food exists for same customer  then update quantity
        $params = array(
            array(":CustomerID", strip_tags($CustomerID)),
            array(":FoodID", strip_tags($data["FoodID"])),
        );
        $Price = strip_tags($data["Price"]);
        $Quantity = strip_tags($data["Quantity"]);
        $TotalPrice = $Price * $Quantity;



        $query = "SELECT COUNT(*)  as count,TotalPrice FROM Cart WHERE CustomerID = :CustomerID AND FoodID = :FoodID";
        $checkResult = DBController::sendData($query, $params);
        if ($checkResult['count'] > 0) {
            $TotalPriceUpdate = ($Price * $Quantity) + $checkResult['TotalPrice'];
            $params2 = array(
                array(":CustomerID", strip_tags($CustomerID)),
                array(":FoodID", strip_tags($data["FoodID"])),
                array(":Quantity", strip_tags($data["Quantity"])),
                array(":TotalPrice", strip_tags($TotalPriceUpdate)),

            );
            $query = "UPDATE Cart SET Quantity = Quantity + :Quantity,TotalPrice=:TotalPrice WHERE CustomerID = :CustomerID AND FoodID = :FoodID";
            $updateResult = DBController::ExecuteSQL($query, $params2);
            if ($updateResult) {
                return array("return_code" => true, "return_data" => "Quantity updated successfully");
            }
            return array("return_code" => false, "return_data" => "Failed to update quantity");
        }

        $params = array(
            array(":CustomerID", strip_tags($CustomerID)),
            array(":FoodID", strip_tags($data["FoodID"])),
            array(":Quantity", strip_tags($data["Quantity"])),
            array(":Price", strip_tags($data["Price"])),
            array(":TotalPrice", strip_tags($TotalPrice)),
        );
        $query = "INSERT INTO Cart (CustomerID, FoodID, Quantity, Price, TotalPrice) 
          VALUES (:CustomerID, :FoodID, :Quantity, :Price, :TotalPrice)";
        $addResult = DBController::ExecuteSQL($query, $params);
        if ($addResult) {
            return array("return_code" => true, "return_data" => "Food added to cart successfully");
        }
        return array("return_code" => false, "return_data" => "Failed to add food to cart");
    }
}
