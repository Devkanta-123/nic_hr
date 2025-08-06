<?php

namespace app\modules\location\classes;

use app\database\DBController;
use app\modules\auth\classes\Signup;

class Location
{

    /* 
    Current Version: 0.0.0
    Created By: Devkanta
    Created On: 15/11/2024
    Modified By:
    Modified On: 

    */
    function addLocation($data)
    {
        // Validate input
        if (empty($data["loc_name"])) {
            return array("return_code" => false, "return_data" => "Location name is required.");
        }

        // Check if location already exists
        $checkQuery = "SELECT * FROM location WHERE loc_name = :loc_name";
        $checkParams = [
            [":loc_name", strip_tags($data["loc_name"])]
        ];
        $existing = DBController::sendData($checkQuery, $checkParams);

        if ($existing) {
            return array("return_code" => false, "return_data" => "Location already exists.");
        }

        // Insert new location
        $insertQuery = "INSERT INTO location (loc_name) VALUES (:loc_name)";
        $insertParams = [
            [":loc_name", strip_tags($data["loc_name"])]
        ];

        $result = DBController::ExecuteSQLID($insertQuery, $insertParams);

        if ($result) {
            return array("return_code" => true, "return_data" => "Location added successfully.");
        } else {
            return array("return_code" => false, "return_data" => "Failed to add location.");
        }
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
