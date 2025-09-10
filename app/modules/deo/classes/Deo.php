<?php

namespace app\modules\deo\classes;

use app\database\DBController;
use app\modules\auth\classes\Signup;

class Deo
{


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
        $attendance_date = $data['attendance_date']; // Today by default
        $location_id = isset($data['location_id']) ? $data['location_id'] : null;

        // Optional: Validate shift if Present
        // if ($status === "Present" && empty($shift)) {
        //     return [
        //         "return_code" => false,
        //         "return_data" => "Shift must be provided for Present status."
        //     ];
        // }

        // Insert or update attendance for the current date
        $query = "
       INSERT INTO Attendance (emp_id, attendance_date, status, shift, location_id, in_time)
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
        $query = "INSERT INTO Ledger_Entries 
                (entry_date, ledger_head, particulars, debit, credit, account_nameID)
              VALUES 
                (:entry_date, :ledger_head, :particulars, :debit, :credit, :account_nameID)";

        $allSuccess = true;

        foreach ($entries as $entry) {
            $ledgerHead = ($entry['type'] === 'Dr') ? 'To' : 'By';

            $params = [
                [":entry_date", $entry['date']],
                [":ledger_head", $ledgerHead],
                [":particulars", $entry['particulars']],
                [":debit", $entry['type'] === 'Dr' ? $entry['amount'] : 0],
                [":credit", $entry['type'] === 'Cr' ? $entry['amount'] : 0],
                [":account_nameID", $entry['account_id']], // ✅ from UI data
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






    public function savePaySlipEntry($data)
    {
        // 1. Check if payslip already exists for same employee & date range
        $existsQuery = "SELECT PaySlipID FROM PaySlip 
                    WHERE EmployeeID = :EmployeeID 
                      AND FromDate = :FromDate 
                      AND ToDate   = :ToDate";
        $existsParams = [
            [":EmployeeID", $data['emp_id']],
            [":FromDate",   $data['from_date']],
            [":ToDate",     $data['to_date']]
        ];
        $existData = DBController::sendData($existsQuery, $existsParams);

        if ($existData && count($existData) > 0) {
            return [
                "return_code" => false,
                "return_data" => "Payslip is already generated for this date range."
            ];
        }

        // 2. Fetch last payslip for this employee
        $lastQuery = "SELECT NewOpeningBalance, NewCurrentAdvance 
                  FROM PaySlip 
                  WHERE EmployeeID = :EmployeeID
                  ORDER BY PaySlipID DESC LIMIT 1";

        $lastParams = [
            [":EmployeeID", $data['emp_id']]
        ];
        $lastData = DBController::sendData($lastQuery, $lastParams);

        // 3. Determine Opening Balance & Current Advance
        if ($lastData && count($lastData) > 0) {
            $OB = $lastData['NewOpeningBalance'];
            $CA = $lastData['NewCurrentAdvance'];
        } else {
            // First time entry → set both to 0
            $OB = 0;
            $CA = 0;
        }

        // 4. Values from request
        $days    = $data['present_days'];
        $Adv     = $data['advance'];
        $amtPaid = $data['amount_paid'];

        // 5. Salary calculations
        $totalPay    = $days * 500;
        $grossAmount = $totalPay + $OB - $CA;
        $netPay      = $grossAmount - $Adv;
        $amountDue   = $netPay - $amtPaid;

        // 6. New balances
        if ($amountDue < 0) {
            $newOpeningBalance = 0;
            $newCurrentAdvance = $CA + abs($amountDue);
        } else {
            $newOpeningBalance = $amountDue;
            $newCurrentAdvance = $CA;
        }

        // 7. Insert new payslip
        $query = "INSERT INTO PaySlip 
    (EmployeeID, FromDate, ToDate, PresentDays, OpeningBalance, Advance, CurrentAdvance, AmountPaid, TotalPay, IsGenerated,
     GrossAmount, NetPay, AmountDue, NewOpeningBalance, NewCurrentAdvance, NewBalance)
    VALUES 
    (:EmployeeID, :FromDate, :ToDate, :PresentDays, :OpeningBalance, :Advance, :CurrentAdvance, :AmountPaid, :TotalPay, :IsGenerated,
     :GrossAmount, :NetPay, :AmountDue, :NewOpeningBalance, :NewCurrentAdvance, :NewBalance)";

        $params = [
            [":EmployeeID", $data['emp_id']],
            [":FromDate", $data['from_date']],
            [":ToDate", $data['to_date']],
            [":PresentDays", $days],
            [":OpeningBalance", $OB],
            [":Advance", $Adv],
            [":CurrentAdvance", $CA],
            [":AmountPaid", $amtPaid],
            [":TotalPay", $totalPay],
            [":IsGenerated", 0],
            [":GrossAmount", $grossAmount],
            [":NetPay", $netPay],
            [":AmountDue", $amountDue],
            [":NewOpeningBalance", $newOpeningBalance],
            [":NewCurrentAdvance", $newCurrentAdvance],
            [":NewBalance", $amountDue]
        ];

        $result = DBController::ExecuteSQL($query, $params);

        // Update related status
        $this->updatePaySlipStatus($data);

        if ($result) {
            return [
                "return_code" => true,
                "return_data" => "Payslip entry saved successfully."
            ];
        } else {
            return [
                "return_code" => false,
                "return_data" => "Failed to save payslip entry."
            ];
        }
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





    function savePaymentData($data)
    {
        // Check if any row exists for this employee
        $checkQuery = "SELECT COUNT(*) AS total FROM Master_AdvancePayment WHERE EmpID = :EmpID";
        $checkParams = [[":EmpID", $data['emp_id']]];
        $countResult = DBController::sendData($checkQuery, $checkParams);

        if ($countResult['total'] > 0) {
            // Update existing record for this employee
            $query = "UPDATE Master_AdvancePayment 
                  SET TypesOfPayment = :TypesOfPayment, Amount = :Amount 
                  WHERE EmpID = :EmpID";
        } else {
            // Insert new record
            $query = "INSERT INTO Master_AdvancePayment (EmpID, TypesOfPayment, Amount) 
                  VALUES (:EmpID, :TypesOfPayment, :Amount)";
        }

        $params = [
            [":EmpID", $data['emp_id']],
            [":TypesOfPayment", $data['typesofpayment']],
            [":Amount", $data['amount']]
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


    function saveAccountName($data)
    {

        $query = "INSERT INTO Master_AccountName  (Account_Name) VALUES (:Account_Name)";
        $params = [
            [":Account_Name", $data['account_name']]
        ];
        $result = DBController::ExecuteSQL($query, $params);

        return [
            "return_code" => $result,
            "return_data" => $result
                ? "Data saved successfully."
                : "Failed to save data."
        ];
    }


    function getAccountName()
    {
        $query = "SELECT * FROM Master_AccountName;";
        $work = DBController::getDataSet($query);
        if ($work)
            return array("return_code" => true, "return_data" => $work);
        return array("return_code" => false, "return_data" => "No  data  found");
    }


    function getPaymentsData()
    {
        $query = "SELECT map.*,e.emp_name FROM `Master_AdvancePayment` map
        INNER JOIN Employee e on e.emp_id=map.EmpID;;";
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

    function getMasterItems()
    {
        $query = "SELECT * FROM Master_Item;";
        $work = DBController::getDataSet($query);
        if ($work)
            return array("return_code" => true, "return_data" => $work);
        return array("return_code" => false, "return_data" => "No  data  found");
    }


    function saveJournalEntries($data)
    {
        if (!isset($data['entries']) || !is_array($data['entries'])) {
            return [
                "return_code" => false,
                "return_data" => "Invalid entry format."
            ];
        }

        $entries = $data['entries'];
        $query = "INSERT INTO JournalEntries 
                (EntryDate, EntryType, AccountName, Particulars, Quantity, Rate, Amount, Description)
              VALUES 
                (:EntryDate, :EntryType, :AccountName, :Particulars, :Quantity, :Rate, :Amount, :Description)";

        $allSuccess = true;

        foreach ($entries as $entry) {
            $params = [
                [":EntryDate", $entry['date']],
                [":EntryType", $entry['type']], // Payment / Receipt
                [":AccountName", $entry['account']],
                [":Particulars", $entry['particulars']],
                [":Quantity", isset($entry['qty']) ? $entry['qty'] : 0],
                [":Rate", isset($entry['rate']) ? $entry['rate'] : 0],
                [":Amount", $entry['amount']],
                [":Description", isset($entry['description']) ? $entry['description'] : null],
            ];

            $result = DBController::ExecuteSQL($query, $params);

            if (!$result) {
                $allSuccess = false;
            }
        }

        return [
            "return_code" => $allSuccess,
            "return_data" => $allSuccess
                ? "Journal entries saved successfully."
                : "Some journal entries failed to save."
        ];
    }
}
