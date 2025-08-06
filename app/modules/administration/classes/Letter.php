<?php

/**  Current Version: 1.0.0
 *  Createdby : Angelbert (01/02/2024)
 *  Created On:
 *  Modified By: 
 *  Modified On:
 */

namespace app\modules\administration\classes;

use app\database\DBController;
use \app\database\Helper;
use app\misc\URL;
use app\modules\notification\classes\Notification;
use app\modules\documents\classes\Documents;

class Letter
{
    /**
     * parameters{Title,Description,SDate,EDate,ApplicableFor,isAll,isPublic,File,Link,Staff[],Intern[]}
     *  Description: Add the Notice
     *  Createdby : Angelbert (01/02/2024)
     *  Updates:
     *    07-02-2024 (Angelbert):  Adding param in info so that it will be easy for future used   
     * 
     */
    function addLetter($data)
    {

        $query = "INSERT INTO `Administration_Letter`(`LetterTypeID`, `LetterNo`, `LetterDate`, `From`, `Place`, `ForWhom`, `Remarks`, `AddedBy`)
        VALUES (:LetterTypeID,:LetterNo,:LetterDate,:From,:Place,:ForWhom,:Remarks,:AddedBy)";
        $params = array(
            array(":LetterTypeID", $data["LetterTypeID"]),
            array(":LetterNo", $data["LetterNo"]),
            array(":LetterDate", $data["LetterDate"]),
            array(":From", $data["From"]),
            array(":Place", $data["Place"]),
            array(":ForWhom", $data["ForWhom"]),
            array(":Remarks", $data["Remarks"]),
            array(":AddedBy", $_SESSION['UserID'])
        );


        $Letters = DBController::ExecuteSQL($query, $params);

        $extractLatestID = "SELECT LetterID FROM Administration_Letter ORDER BY CreatedDateTime DESC LIMIT 1";
        $extractLatestIDResult = DBController::sendData($extractLatestID);

        // Check if $extractLatestIDResult is an array and contains "LetterID" key
        if (is_array($extractLatestIDResult) && isset($extractLatestIDResult['LetterID'])) {
            // Extract the value of "LetterID" and convert it to an integer
            $LetterID = intval($extractLatestIDResult['LetterID']);
        } else {
            // Handle the case where "LetterID" is not found or $extractLatestIDResult is not an array
            $LetterID = null; // or any other fallback value
        }



        if (!$Letters) {
            return array("return_code" => false, "return_data" => "Letter could not be inserted to the table");
        } else {
            if (!empty($data['File'])) {
                $documentHandlingResult = $this->handleDocuments($data, $LetterID);
                if ($documentHandlingResult) {
                    return array("return_code" => true, "return_data" => "Letters Saved");
                } else {
                    return array("return_code" => false, "return_data" => "Letters could not be saved");
                }
            }
        }
    }
    function handleDocuments($data, $LetterID)
    {
        // Handle documents
        if (!file_exists("../app/data/letters/")) {
            mkdir("../app/data/letters/", 0777, TRUE);
        }

        // DBController::logs("Reached handleDocuments ");
        ini_set('memory_limit', '-1');
        $documentsIDs = '';
        $files = $data['File'];
        $f1 = array();
        array_push($f1, $files);
        foreach ($f1 as $file) {
            $parts = explode(',',  $file["filedata"], 2);
            if (count($parts) === 2) {
                $header = $parts[0];
                $data = $parts[1];
                $header_parts = explode(';', $header);
                $mime_type = $header_parts[0];
                $ext = explode('/', $mime_type)[1];
                $filearray = array(
                    'ext' => $ext,
                    'file' => $data
                );
                // Now you can use $filearray as needed
            } else {
                // Handle the case where explode didn't return expected parts
                echo "Invalid data format: " . $file["filedata"];
            }
            // $urlFileData=$path;
            // new Documents = new Documents();
            $path = (new Documents())::storeDocuments("DOCUMENT", $filearray);
            // DBController::logs("Reached Documents");
            $ext = pathinfo($file['filename'], PATHINFO_EXTENSION);
            $filedata = file_get_contents($file['filedata']);

            do {
                $newfilename = "n_" . Helper::generate_string(10) . "." . $ext;
            } while (file_exists("../app/data/letters/" . $newfilename));

            $fp = fopen("../app/data/letters/" . $newfilename, "w+");
            if (fwrite($fp, ($filedata))) {
                $q2 = "INSERT INTO `Documents` (`DocumentsCategoryID`, `DocumentSettingID`, `DocumentPath`, `DocumentTitle`, `DocumentAccess`, `DocumentDisplayName`, `AddedByID`) VALUES (:DocumentsCategoryID, :DocumentSettingID, :DocumentPath, :DocumentTitle, :DocumentAccess, :DocumentDisplayName, :AddedByID);";
                $p2 = [
                    [":DocumentsCategoryID", "12"],
                    [":DocumentSettingID", "10"],
                    [":DocumentPath", $newfilename],
                    [":DocumentTitle", $file['filename']],
                    [":DocumentAccess", "111"],
                    [":DocumentDisplayName", "LETTER"],
                    [":AddedByID", $_SESSION['UserID']]
                ];
                $r2 = DBController::ExecuteSQLID($q2, $p2);
                $documentsIDs = $r2 . ',' . $documentsIDs;
                if ($documentsIDs) {
                    // Update LeaveDocumentIDs in Administration_Letter
                    $param2 = array(
                        array(":DocumentId", rtrim($documentsIDs, ",")),
                        array(":LetterID", $LetterID)
                    );
                    $query2 = "UPDATE `Administration_Letter` SET `LetterDocumentID`=:DocumentId WHERE `LetterID`=:LetterID";
                    $updateLeaveDoc = DBController::ExecuteSQL($query2, $param2);
                    if ($updateLeaveDoc) {
                        return array("return_code" => true, "return_data" => "Documents added successfully");
                    } else {
                        return array("return_code" => false, "return_data" => "Error updating leave documents");
                    }
                }
            } else {
                return array("return_code" => false, "return_data" => "File not saved !!");
            }
            fclose($fp);
        }
    }

    function addLetterType($data)
    {
        $query = "INSERT INTO `Administration_LetterType`(`LetterType`, `CreatedByID`) VALUES (:LetterType,:CreatedByID)";
        $params = array(
            array(":LetterType", $data['LetterTypeName']),
            array(":CreatedByID", $_SESSION['UserID']),
        );
        $LetterTypes = DBController::ExecuteSQL($query, $params);
        if (!$LetterTypes) {
            return array("return_code" => false, "return_data" => "Letter Type could not be inserted to the table");
        } else {
            return array("return_code" => true, "return_data" => "Letter Type Saved");
        }
    }
    function getAllLetterType()
    {
        $query = "SELECT * FROM `Administration_LetterType`";
        $LetterTypes = DBController::getDataSet($query);
        if ($LetterTypes) {
            return array("return_code" => true, "return_data" => $LetterTypes);
        } else {
            return array("return_code" => false, "return_data" => "No data available");
        }
    }
    function getAllActiveLetters()
    {
        $query = "SELECT al.*, alt.LetterType,GROUP_CONCAT(DISTINCT d.DocumentPath) as DocumentPath
        FROM Administration_Letter al INNER JOIN Administration_LetterType alt  on alt.LetterTypeID  =  al.LetterTypeID  
        LEFT JOIN Documents d on FIND_IN_SET(d.DocumentsID,al.LetterDocumentID)  WHERE DATE(al.CreatedDateTime) = CURDATE() and isActive  = 1  GROUP BY al.LetterID ;";
        $Letters = DBController::getDataSet($query);
        if ($Letters) {
            return array("return_code" => true, "return_data" => $Letters);
        } else {
            return array("return_code" => false, "return_data" => "No data available");
        }
    }
    function archieveLetter($data)
    {
        $query = "UPDATE `Administration_Letter` SET `isActive` = 0 WHERE `LetterID` = :LetterID";
        $params = array(
            array(":LetterID", $data['LetterID']),
        );
        $Letter = DBController::ExecuteSQL($query, $params);
        if ($Letter) {
            return array("return_code" => true, "return_data" => "Letter Archived Successfully");
        } else {
            return array("return_code" => false, "return_data" => "Letter could not be archived");
        }
    }

    function getAllArchivedLetters()
    {
        $query = "SELECT al.*, alt.LetterType 
        FROM Administration_Letter al INNER JOIN Administration_LetterType alt  on alt.LetterTypeID  =  al.LetterTypeID  
        WHERE  isActive  = 0;";
        $Letters = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $Letters);
    }

    function getAllLetters()
    {
        $query = "SELECT al.*, alt.LetterType,GROUP_CONCAT(DISTINCT d.DocumentPath) as DocumentPath
        FROM Administration_Letter al INNER JOIN Administration_LetterType alt  on alt.LetterTypeID = al.LetterTypeID      
        LEFT JOIN Documents d on FIND_IN_SET(d.DocumentsID,al.LetterDocumentID) GROUP BY al.LetterID ;";
        $Letters = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $Letters);
    }
}
