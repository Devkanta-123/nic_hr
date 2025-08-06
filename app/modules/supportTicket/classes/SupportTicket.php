<?php

namespace app\modules\supportTicket\classes;

use app\database\DBController;
use app\misc\FCM;
use app\misc\SMS;
use app\modules\settings\classes\Session;

class SupportTicket
{

    /* 
    Current Version: 2.0.0
    Created By: Devkanta,     dev1@techz.in
    Created On: 04/12/2023
    Modified By:
    Modified On: 

*/

    function getAllCategoryLevel($data)
    {
        $query = "SELECT DISTINCT (IFNULL(CategoryLevel, -1)+1) AS `Level`,   (IFNULL(CategoryLevel, -1)+1) AS CategoryLevels FROM   Grievance_Category 
                 union all  
                 select 0 as Level, 0 as CategoryLevels; ";
        $res = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $res);
    }

    /*  Info: 
        Description: getAllCategoryLevel function will get all grievances category levels
            05-12-2023 (Devkanta) : 
            12-01-2024 (Om) : 
        

    */

    function addGrievanceCategory($data)
    {

        if (isset($data["GrievanceCategoryID"])) { // Update
            $params = array(
                array(":DepartmentID", $data["DepartmentID"]),
                array(":StaffIDs", implode(',', $data['StaffIDs'])), //comma seperator
                array(":GrievanceCategoryID", $data["GrievanceCategoryID"])
            );

            $query = "UPDATE `Grievance_Category` SET `DepartmentID`=:DepartmentID, `StaffIDs`=:StaffIDs WHERE `GrievanceCategoryID`=:GrievanceCategoryID;";
            $res = DBController::ExecuteSQL($query, $params);

            if ($res) {
                return array("return_code" => true, "return_data" => "Assigned successfully");
            } else {
                return array("return_code" => false, "return_data" => "Error");
            }
        } else {
            //prepare array
            $undercategory = -1;
            if ((int) strip_tags($data["CategoryLevel"]) > 0) {
                $undercategory = (string) strip_tags($data["UnderCategoryID"]);
            }
            $params = array(
                array(":GrievanceCategory", (string) strip_tags($data["GrievanceCategory"])),
                array(":CategoryLevel", (int) strip_tags($data["CategoryLevel"])),
                array(":UnderCategoryID",  $undercategory),
                array(":ResolutionLevel1", (string) strip_tags($data["ResolutionLevel1"])),
                array(":ResolutionLevel2", (string) strip_tags($data["ResolutionLevel2"])),
                array(":ResolutionLevel3", (string) strip_tags($data["ResolutionLevel3"])),
                array(":CreatedByID", $_SESSION["UserID"])
            );
            //save the product
            $query = "INSERT INTO `Grievance_Category` ( `GrievanceCategory`, `CategoryLevel`, `UnderCategoryID`, `ResolutionLevel1`,`ResolutionLevel2`, `ResolutionLevel3`, `CreatedByID`)   VALUES (:GrievanceCategory,:CategoryLevel,:UnderCategoryID,:ResolutionLevel1,:ResolutionLevel2,:ResolutionLevel3, :CreatedByID)";
            $res = DBController::ExecuteSQLID($query, $params);
            if ($res) {
                return array("return_code" => true, "return_data" => "Category added successfully");
            }
            return array("return_code" => false, "return_data" => " Error while saving the Category");
        }
        return array("return_code" => false, "return_data" => " Error while saving the Data");
    }

    /*  Info: 
        Description: addGrievanceCategory function will added new  grievances category 
            05-12-2023 (Devkanta) : 
            12-01-2024 (Om) : 
        

    */

    function getCategoryList($data)
    {
        //     $query = "SELECT
        //     gc.GrievanceCategoryID,
        //     gc.GrievanceCategory as MainCategory,
        //     gc2.GrievanceCategory as SubCategory,
        //     gc.CategoryLevel as SubCategoryLevelID,
        //     gc.ResolutionLevel1,
        //     gc.ResolutionLevel2,
        //     gc.ResolutionLevel3,
        //     gc.DepartmentID,
        //     gc.StaffIDs,
        //     GROUP_CONCAT(DISTINCT s.StaffName) as StaffName
        // FROM
        //     grievance_category gc
        // LEFT JOIN
        //     staff s ON FIND_IN_SET(s.StaffID, gc.StaffIDs)
        // LEFT JOIN
        //     Grievance_Category gc2 ON gc.GrievanceCategoryID = gc2.UnderCategoryID
        // GROUP BY
        //     gc.GrievanceCategoryID, gc.GrievanceCategory, gc2.GrievanceCategory, gc.CategoryLevel, gc.ResolutionLevel1, gc.ResolutionLevel2, gc.ResolutionLevel3
        // ";
        $query = "SELECT
    gc.GrievanceCategoryID,
    gc.GrievanceCategory AS MainCategory,
    gc.GrievanceCategory AS CategoryName,
    gc2.GrievanceCategory AS SubCategory,
    gc.CategoryLevel AS SubCategoryLevelID,
    gc.ResolutionLevel1,
    gc.ResolutionLevel2,
    gc.ResolutionLevel3,
    gc.StaffIDResolutionLevel1,
    gc.StaffIDResolutionLevel2,
    gc.StaffIDResolutionLevel3,
    GROUP_CONCAT(DISTINCT s1.StaffName) AS StaffNameResolutionLevel1,
    GROUP_CONCAT(DISTINCT s2.StaffName) AS StaffNameResolutionLevel2,
    GROUP_CONCAT(DISTINCT s3.StaffName) AS StaffNameResolutionLevel3
FROM
    Grievance_Category gc
LEFT JOIN
    Staff s1 ON FIND_IN_SET(s1.StaffID, gc.StaffIDResolutionLevel1)
LEFT JOIN
Staff s2 ON FIND_IN_SET(s2.StaffID, gc.StaffIDResolutionLevel2)
LEFT JOIN
Staff s3 ON FIND_IN_SET(s3.StaffID, gc.StaffIDResolutionLevel3)
LEFT JOIN
    Grievance_Category gc2 ON gc.GrievanceCategoryID = gc2.UnderCategoryID
GROUP BY
    gc.GrievanceCategoryID, gc.GrievanceCategory, gc2.GrievanceCategory, gc.CategoryLevel, gc.ResolutionLevel1, gc.ResolutionLevel2, gc.ResolutionLevel3";
        //$query = "SELECT `GrievanceCategoryID`,`GrievanceCategory` as MainCategory, CategoryLevel as SubCategoryLevel,`ResolutionLevel1`,`ResolutionLevel2`,`ResolutionLevel3`  FROM `Grievance_Category`";

        $res = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $res);
    }

    /*  Info: 
        Description: getCategoryList function will get all grievances category List
            05-12-2023 (Devkanta) : 
            12-01-2024 (Om) : 
        

    */




    function getZeroLevelCategory($data)
    {

        if ($data['CategoryLevels'] == 0) {
            return array("return_code" => true, "return_data" => []);
        } else {
            $params = array(
                array(":CategoryLevels", $data["CategoryLevels"]),
            );

            $query = "SELECT DISTINCT   GrievanceCategoryID ,GrievanceCategory,CategoryLevel  FROM `Grievance_Category` WHERE CategoryLevel  < :CategoryLevels;";
            $result = DBController::getDataSet($query, $params);
            return array("return_code" => true, "return_data" => $result);
        }
    }



    function getNextLevelCategory($data)
    {
        $params = array(
            array(":UnderCategoryID", $data["UnderCategoryID"]),
        );
        $query = "SELECT DISTINCT   GrievanceCategoryID ,GrievanceCategory,CategoryLevel  FROM `Grievance_Category` WHERE UnderCategoryID=:UnderCategoryID;";
        $result = DBController::getDataSet($query, $params);
        return array("return_code" => true, "return_data" => $result);
    }

    function getMainCategories($data)
    {
        $query = "SELECT  DISTINCT `GrievanceCategoryID` as MainCategoryID, `GrievanceCategory` ,`CategoryLevel` as ID  FROM `Grievance_Category` WHERE `CategoryLevel` = 0 "; //GrievanceCategoryID
        $res = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $res);
    }

    function getSubCategories($data)
    {
        $params = array(
            array(":GrievanceMainCategory", $data["GrievanceMainCategory"]),
        );

        $query = "SELECT DISTINCT CategoryLevel  as  CategoryLevelIDs,GrievanceCategory as CategoryLevelName  FROM `Grievance_Category` WHERE `UnderCategoryID`  = :GrievanceMainCategory;";
        $res = DBController::getDataSet($query, $params);
        return array("return_code" => true, "return_data" => $res);
    }


    function getNextLevelCategories($data)
    {
        $params = array(
            array(":GrievanceNextLevel", $data["GrievanceNextLevel"]),
        );

        $query = "SELECT  `Level` as NextLevelIDs, `Name` as CategoryNextLevelName FROM `Grievance_Category_Level`  WHERE `Level`  < :GrievanceNextLevel";
        $res = DBController::getDataSet($query, $params);
        return array("return_code" => true, "return_data" => $res);
    }


    function LodgeGrievances($data)
    {

        $categoryID = isset($data["CategoryID"]) ? (int) strip_tags($data["CategoryID"]) : 1; // Default category ID

        if (isset($data["LodgeID"])) { //update  
            $params = array(
                array(":LodgeID", $data["LodgeID"]),
                array(":Description", $data["Description"]),
            );
            $query = "UPDATE `Grievance_Lodge_Grievance` SET `Description`= :Description  WHERE `LodgeID`=:LodgeID;";
            $res = DBController::ExecuteSQL($query, $params);
        } else {
            //prepare array 
            $params = array(
                array(":CategoryID", $categoryID),
                array(":Remarks", (string) strip_tags($data["Remarks"])),
                array(":Priority", (int) strip_tags($data["Priority"])),
                array(":Document", (string) strip_tags($data["Document"])),
                array(":CreatedBy", $_SESSION["UserID"])
            );
            //save the product
            $query = "INSERT INTO `Grievance_Lodge_Grievance`( `CategoryID`, `Remarks`, `Priority`, `Document`,`CreatedBy`)   VALUES (:CategoryID,:Remarks,:Priority,:Document,:CreatedBy)";
            $res = DBController::ExecuteSQLID($query, $params);
            if ($res) {
                return array("return_code" => true, "return_data" => "Lodge Grievance Register successfully");
            }
            return array("return_code" => false, "return_data" => " Error while saving the Data");
        }
    }

    /*  Info: 
        Description: LodgeGrievances function will lodge/added new grievances 
            05-12-2023 (Devkanta) : 
            12-01-2024 (Om) : 
        

    */



    function getLodgeGrievancesList()
    {
        //$query = "SELECT  glg.`LodgeID`,glg.`Remarks`,glg.`CreatedDateTime`,glg.`Priority`,glg.`Status` , gcd.DepartmentName as 'Concern_Department' ,gcds.StaffName as 'Concern_Staff' FROM `grievance_lodge_grievance` as glg INNER JOIN `grievance_category` as gc ON glg.CategoryID = gc.CategoryLevel INNER JOIN `grievance_category_department` as gcd  ON gc.DepartmentID  = gcd.DepartmentID INNER JOIN  `grievance_category_department_staff` gcds ON gc.StaffIDs = gcds.StaffID;";
        $query = "SELECT * from Grievance_Lodge_Grievance glg 
        INNER JOIN Grievance_Category gc on glg.CategoryID = gc.GrievanceCategoryID";
        $res = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $res);
    }


    /*  Info: 
        Description: getLodgeGrievancesList function will  get all  register lodge grievances along with assigned particular departments and staffs 
            05-12-2023 (Devkanta) : 
            12-01-2024 (Om) : 
        

    */


    function onView($data)
    {

        $flag = $data['flag']; // 'flag' denotes which field to update 

        $query = "";
        switch ($flag) {
            case 1:
                $params1 = array(
                    array(":LodgeID", $data["LodgeID"]),
                );
                $query = "UPDATE `Grievance_Lodge_Grievance` SET `Status`= 2 WHERE `LodgeID`=:LodgeID;"; //Status 2 indicates the seen and No Response Grievances
                $res = DBController::ExecuteSQL($query, $params1);
                return array("return_code" => true, "return_data" => $res);
                break;
            case 2:
                $params2 = array(
                    array(":LodgeID", $data["LodgeID"]),
                    array(":Description", $data["Description"]),
                );
                $query = "UPDATE `Grievance_Lodge_Grievance` SET  `Status`= 3, `Description` = :Description WHERE `LodgeID`=:LodgeID;"; //Status 3 indicates  Response And  UnderProcess But Not Closed Grievances
                $res = DBController::ExecuteSQL($query, $params2);
                return array("return_code" => true, "return_data" => $res);
                break;

            case 4:
                $params4 = array(
                    array(":LodgeID", $data["LodgeID"]),
                );
                $query = "UPDATE `Grievance_Lodge_Grievance` SET  `Status`= 4 WHERE `LodgeID`=:LodgeID;"; //Status 4 indicates  Closed Grievances
                $res = DBController::ExecuteSQL($query, $params4);
                return array("return_code" => true, "return_data" => $res);
                break;

            default:
                return array("return_code" => false, "error_message" => "Invalid flag value");
                break;
        }
    }

    /*  Info: 
        Description: onView function will  update the status and description of grievances on the basis of the flag id
            05-12-2023 (Devkanta) : 
            12-01-2024 (Om) : 
        

    */

    function getTotalGrievances()
    {
        //get all Grievances
        $query = "SELECT COUNT(*)  as totalgrievances FROM  `Grievance_Lodge_Grievance`;";
        $TotalGrievances = DBController::sendData($query);

        //get all No Response Grievances
        $query1 = "SELECT count(*) as underprocessgrievance FROM  `Grievance_Lodge_Grievance` where status = 3";
        $UnderProcessGrievance = DBController::sendData($query1);

        //get all Closed Grievances
        $query2 = "SELECT COUNT(*)  as closedgrievances FROM  `Grievance_Lodge_Grievance` where status = 4;";
        $ClosedGrievance = DBController::sendData($query2);

        //get all Unseen Grievances
        $query3 = "SELECT COUNT(*)  as noresponsegrievance FROM  `Grievance_Lodge_Grievance` where status = 2;";
        $NoresponseGrievance = DBController::sendData($query3);
        return array("return_code" => true, "TotalGrievances" => $TotalGrievances, "ClosedGrievance" => $ClosedGrievance, "UnderProcessGrievance" => $UnderProcessGrievance, "NoresponseGrievance" => $NoresponseGrievance);
    }

    /*  Info: 
        Description: getTotalGrievances function will  count the numbers  of grievances on the basis of the status
            05-12-2023 (Devkanta) : 
            12-01-2024 (Om) : 
        

    */


    function getRecentLodgeGrievances()
    {

        $query = "SELECT LodgeID,CreatedDateTime,Status,Remarks FROM `Grievance_Lodge_Grievance`
        ORDER BY CreatedDateTime DESC
        LIMIT 5"; //reason for changing this 

        $res = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $res);
    }

    /*  Info: 
        Description: getRecentLodgeGrievances function will  get  at least five 5 recently added grievances
            06-12-2023 (Devkanta) : 
            12-01-2024 (Om) : 
    
    */


    function loadPieChart()
    {

        $query = "SELECT status, COUNT(*) as count FROM `Grievance_Lodge_Grievance` GROUP BY Status";
        $res = DBController::getDataSet($query);
        $chartData = array();

        foreach ($res as $row) {
            $statusLabel = '';
            $Status = $row['status'];
            switch ($Status) {
                case 1:
                    $statusLabel = 'Unseen';
                    break;
                case 2:
                    $statusLabel = 'Seen';
                    break;
                case 3:
                    $statusLabel = 'Response';
                    break;
                case 4:
                    $statusLabel = 'Closed';
                    break;
                    // Add more cases if there are other status types
                default:
                    $statusLabel = 'Invalid';
                    break;
            }

            // Add data to the chart array
            $chartData[] = array(
                'status' => $statusLabel,
                'count' => intval($row['count'])
            );
        }
        return array("return_code" => true, "return_data" => $chartData);
    }
    /*  Info: 
        Description: loadPieChart function will  count and load piechart of the total grievances on basis of the status 
            06-12-2023 (Devkanta) : 
            12-01-2024 (Om) : 
    
    */
    function LodgeGrievancesAPI($data)
    {


        //get  API (based on ID)
        //Lodge Grievanaces

        // send to API



        // Prepare array
        //  array(":Contact", strip_tags($data["PhoneNumber"]));
        //  $params=array(
        //     array(":ClientSubscriptionID", (int)strip_tags($data["ClientSubscriptionID"]))
        // ); 
        //     $query="SELECT `ClientSubscriptionID`,`API`
        //     FROM `ClientSubscriptions` 
        //     WHERE `ClientSubscriptionID`=:ClientSubscriptionID;";   
        //     $notices = DBController::sendData($query,$params);
        //     if ($notices) {
        //         $API = $notices['API'];
        //         $data= array(
        //             "Module" => "publics",
        //             "Page_key" => "getUserInfoBasedOnContact",
        //             "JSON" => array(
        //                 "Contact" => strip_tags($data['PhoneNumber']),
        //                 "Key" => "Test123"
        //             ),
        //             "MSC" => "751d31dd6b56b26b29dac2c0e1839e34"
        //         );
        //         //Key,Contact
        //         // Convert the array to JSON format
        //         $json = json_encode($data);
        //         $api_url = $API; //static for testing
        //         $ch = curl_init($api_url);
        //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        //         curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        //         curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        //             'Content-Type: application/json',
        //             'Content-Length: ' . strlen($json)
        //         ));

        //         $response = curl_exec($ch);
        //         if (curl_errno($ch)) {
        //             // echo 'Error: ' . curl_error($ch);
        //         } else {
        //             // echo $response;
        //         }
        //         curl_close($ch);
        //         $response = json_decode($response);

        //         if($response->return_code == true)
        //             return array("return_code" => true, "return_data" =>  $response->return_data);
        //         else
        //             return array("return_code" => false, "return_data" =>  "Not associated with this number.");

        //     }
        //     return array("return_code" => false, "return_data" => "No Data for Client Subscription!");
    }

    function getDepartment() // added by dev on 05/12/23
    {
        //     $query = "SELECT 
        //     Grievance_Category_Department.DepartmentID,DepartmentCode,DepartmentName,
        //     GROUP_CONCAT(Grievance_Category_Department_Staff.StaffName) as StaffName,
        //     GROUP_CONCAT(Grievance_Category_Department_Staff.StaffID) as StaffID
        // FROM 
        //     Grievance_Category_Department
        // INNER JOIN 
        //     Grievance_Category_Department_Staff ON FIND_IN_SET(Grievance_Category_Department.DepartmentID, Grievance_Category_Department_Staff.DepartmentID)
        // WHERE 
        //     FIND_IN_SET(Grievance_Category_Department.DepartmentID, Grievance_Category_Department_Staff.DepartmentID)
        //     AND Grievance_Category_Department.isActive = 1
        //     AND Grievance_Category_Department_Staff.isRemoved = 0
        // GROUP BY 
        //     Grievance_Category_Department.DepartmentID,DepartmentCode,
        //     DepartmentName";

        $query = "SELECT 
    DISTINCT Grievance_Category_Department.DepartmentID,Grievance_Category_Department.DepartmentCode,Grievance_Category_Department.DepartmentName,
    GROUP_CONCAT(s.StaffName) as StaffName,
    GROUP_CONCAT(s.StaffID) as StaffID
FROM 
    Grievance_Category_Department 
    INNER  JOIN Staff s on s.DepartmentID = Grievance_Category_Department.DepartmentID 
    INNER  JOIN Settings_Department sd on sd.DepartmentID = Grievance_Category_Department.DepartmentID 
INNER JOIN 
    Grievance_Category_Department_Staff ON FIND_IN_SET(Grievance_Category_Department.DepartmentID, s.DepartmentID)
WHERE 
    FIND_IN_SET(Grievance_Category_Department.DepartmentID, s.DepartmentID)
    AND Grievance_Category_Department.isActive = 1
    AND s.isRemoved = 0
GROUP BY 
    Grievance_Category_Department.DepartmentID,DepartmentCode,
    DepartmentName, Grievance_Category_Department_Staff.StaffID,sd.DepartmentID ";
        $res = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $res);
    }


    function addDepartment($data)  // added by dev on 05/12/23
    {
        // Prepare array

        $params = array(
            array(":DepartmentCode", $data["DeptCode"]),
            array(":DepartmentName", $data["DeptName"]),
        );
        $query = "INSERT INTO `Grievance_Category_Department` (`DepartmentCode`, `DepartmentName`,`isActive`) VALUES (:DepartmentCode, :DepartmentName,1)";
        $res = DBController::ExecuteSQL($query, $params);
        if ($res) {
            return array("return_code" => true, "return_data" => "Department added successfully");
        }
        return array("return_code" => false, "return_data" => "Error while saving the Department");
    }


    function onDepartmentDelete($data) // added by dev on 05/12/23
    {
        $params = array(
            array(":DepartmentID", $data["DepartmentID"]),
        );
        $query = "UPDATE  `grievance_category_department`  SET isActive = 0 WHERE `DepartmentID`=:DepartmentID;";
        $res = DBController::ExecuteSQL($query, $params);
        if ($res) {
            return array("return_code" => true, "return_data" => "Sucessfully Removed the Department");
        }
        return array("return_code" => false, "return_data" => "Error while removing the  Department");
    }

    function onUserDelete($data) // added by dev on 05/12/23
    {
        $params = array(
            array(":StaffID", $data["StaffID"]),
        );
        $query = "UPDATE  `grievance_category_department_staff` 
        SET isRemoved = 1 WHERE `StaffID`=:StaffID;";
        $res = DBController::ExecuteSQL($query, $params);
        if ($res) {
            return array("return_code" => true, "return_data" => "Sucessfully Removed the User");
        }
        return array("return_code" => false, "return_data" => "Error while removing the  User");
    }

    function getDepartmentForAssignGrievanceCategory()
    {
        $query = "SELECT `DepartmentID`, `DepartmentName` FROM `Grievance_Category_Department` WHERE `isActive` = 1 ";
        $res = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $res);
    }

    function getEmployeeByDepartmentID($data)
    {
        $params = array(
            array(":DepartmentID", $data['DepartmentID']),
        );

        $params = $params ?? array();

        // Add the DepartmentID parameter to $params array
        $params[] = array(":DepartmentID", $data['DepartmentID']);
        $query = "SELECT s.StaffID,s.StaffName FROM `Grievance_Category_Department_Staff` gcds INNER JOIN Staff s ON gcds.StaffID = s.StaffID 
        INNER JOIN  Grievance_Category_Department gcd ON gcd.DepartmentID = s.DepartmentID
          WHERE s.`DepartmentID`=:DepartmentID";
        $res = DBController::getDataSet($query, $params);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        } else {
            return array("return_code" => false, "return_data" => "No staff found for this department");
        }
    }

    function AssignCategory($data)
    {
        $allowedColumns = array(
            "StaffIDResolutionLevel1",
            "StaffIDResolutionLevel2",
            "StaffIDResolutionLevel3"
        );

        // Check if the provided column is allowed
        if (!in_array($data['Column'], $allowedColumns)) {
            return array("return_code" => false, "return_data" => "Invalid data to update");
        }
        $param = array(
            array(":EditInput", implode(',', $data['EditInput'])),
            array(":GrievanceCategoryID", strip_tags($data['GrievanceCategoryID'])),
        );
        // Dynamically construct the query
        $query = "UPDATE `Grievance_Category` SET `{$data['Column']}`=:EditInput  WHERE `GrievanceCategoryID` =:GrievanceCategoryID";
        // Execute the query
        $updateResult = DBController::ExecuteSQL($query, $param);
        if ($updateResult) {
            return array("return_code" => true, "return_data" => "Successfully Updated");
        } else {
            return array("return_code" => false, "return_data" => "Unable to update the data");
        }
    }
}
