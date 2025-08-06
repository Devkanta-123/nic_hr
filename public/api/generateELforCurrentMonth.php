<?php
/* 
    Current Version: 1.0.0
    Created By: Devkanta,     dev1@techz.in
    Created On: 06/04/2024
    Modified By:
    Modified On:  
*/

namespace api\generateELforCurrentMonth;

use app\database\DBController;

include '../../app/database/DBController.php';
class LeaveCalculateEL
{
    static function CalculateELByEndofMonth()
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
        $query = "SELECT StaffID FROM Staff WHERE isRemoved = 0 AND isDeparted = 0";
        $staffIDs = DBController::getDataSet($query);
        // Return the number of days in the specified month
        $numDays = $daysInMonth[$month];
        // Check if it's the last day of the month
        $today = date('2024-04-30'); //testing manual giving date
        // $today = date('Y-m-d');
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
                        array(":Credit", 'cr'),
                        array(":CreatedByID", 1)
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
}

if (isset($_GET['id'])) {
    if ($_GET['id'] == 2) {
        $obj = new LeaveCalculateEL();

        $obj->CalculateELByEndofMonth();
    }
} else {
    DBController::logs('Invalid Key: ');
}
