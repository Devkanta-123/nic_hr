<?php


namespace app\modules\documents\classes;
use app\database\DBController;
use app\database\Helper;
use app\modules\settings\classes\Session;

class Documents
{

    //view documents
    static function viewDocuments($data)
    {

        $root = '../app/data/';
        $documentdata = array();
        //get the extension from the documents database
        $param = array(
            array(':DocumentEncryptedID', $data['DocumentEncryptedID'])
        );
        $sq = "select DocumentPath,DocumentTitle,DocumentAccess,DocumentDisplayName  from Documents 
               where DocumentEncryptedID =:DocumentEncryptedID;";
        $res = DBController::sendData($sq, $param);
        if ($res) {
            //check if the document exists or not from the DocumentPath
            $path = $root . $res['DocumentPath'];

            if (file_exists($path)) {
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $documentdata['ext'] = $ext;
                $documentdata['DocumentPath'] = $path;
                Documents::loadDocument($documentdata['DocumentPath']);
            } else {
                header("HTTP/1.0 404 Not Found");
                exit();
            }
        }
        header("HTTP/1.0 404 Not Found");
        exit();
    }
    static function loadDocument($file)
    {

        $imagetypes = array("zeroindex", "jpeg", "jpg", "png", "svg", "tiff");
        $documenttypes = array("zeroindexdoc", "doc", "docx", "pdf", "html", "xls", "xlsx", "txt");
        if (file_exists($file)) {
            header('HTTP/1.0 200 OK');
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            if (array_search($extension, $imagetypes) != false && array_search($extension, $imagetypes) >= 0) {
                header('Content-Type: image/' . strtolower(substr(strrchr(basename($file), "."), 1)));
            } else if (array_search($extension, $documenttypes) != false && array_search($extension, $documenttypes) >= 0) {
                if ($extension == "xlsx") {
                    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                } else if ($extension == "xls") {
                    header('Content-Type: application/vnd.ms-excel');
                } else header('Content-Type: application/' . strtolower(substr(strrchr(basename($file), "."), 1)));
            } else {
                header('Content-Type: ' . mime_content_type($file));
            }
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }
    }

    //save the document 
    static function storeDocuments($category, $data)
    {
        //NOTE : Create a thumbnail of the image only 
        $filepath = '';
        $document = $data["file"];
        $root = '../app/data/';
        switch ($data["ext"]) {
            case "pdf":
                $Filename = uniqid("DOC_") . "." . $data["ext"];
                $document = preg_replace('#^data:application/\w+;base64,#i', '', $document);
                break;
            case "jpeg" || "png" || "jpg":
                $Filename = uniqid("IMG_") . "." . $data["ext"];
                $document = preg_replace('#^data:image/\w+;base64,#i', '', $document);
                break;
        }
        switch ($category) {

            case "ADMISSION_FEE_RECEIPT":
                $folder = 'admissionfeereceipt/';
                $filepath = '';
                if (!file_exists($root . $folder . $filepath)) {
                    mkdir($root . $folder . $filepath, 0755, true);
                }
                $filepath .= $Filename;
                $fp = fopen($root . $folder . $filepath, "w+");
                fwrite($fp, ($document));
                fclose($fp);
                return $filepath;


            case "ADMISSION":
                $folder = 'admissions/';
                $filepath =  date('y') . "/";
                if (!file_exists($root . $folder . $filepath)) {
                    mkdir($root . $folder . $filepath, 0755, true);
                }
                $filepath .=  $Filename;
                break;

            case "PASSPORTPHOTO":
                $folder = 'passportphoto/';
                $filepath = '';
                if (!file_exists($root . $folder . $filepath)) {
                    mkdir($root . $folder . $filepath, 0755, true);
                }
                $filepath .= $Filename;
                break;

            case "FEEVERIFICATION":
                $folder = 'fee/';
                $filepath = '';
                if (!file_exists($root . $folder . $filepath)) {
                    mkdir($root . $folder . $filepath, 0755, true);
                }
                $filepath .= $Filename;
                break;

            case "FEE_RECEIPT":
                $folder = 'feereceipt/';
                $filepath = '';
                if (!file_exists($root . $folder . $filepath)) {
                    mkdir($root . $folder . $filepath, 0755, true);
                }
                $filepath .= $Filename;
                $fp = fopen($root . $folder . $filepath, "w+");
                fwrite($fp, ($document));
                fclose($fp);
                return $filepath;

            case "HOMEWORK_ASSIGNMENT":
                $folder = 'elearning/HomeworkAssignment/session-' . Session::getCurrentSessionID() . '/';
                $filepath = '';
                if (!file_exists($root . $folder . $filepath)) {
                    mkdir($root . $folder . $filepath, 0755, true);
                }
                $filepath .= $Filename;
                break;

            case "ELEARNING":
                $folder = 'courses/';
                $filepath = '';
                if (!file_exists($root . $folder . $filepath)) {
                    mkdir($root . $folder . $filepath, 0755, true);
                }
                $filepath .= $Filename;
                break;
            case "MEETING":
                $folder = 'meeting/';
                $filepath = '';
                if (!file_exists($root . $folder . $filepath)) {
                    mkdir($root . $folder . $filepath, 0755, true);
                }
                $filepath .= $Filename;
                break;

            case "EXAMINATION":
                $folder = 'examination/';
                $filepath = '';
                if (!file_exists($root . $folder . $filepath)) {
                    mkdir($root . $folder . $filepath, 0755, true);
                }
                $filepath .= $Filename;
                break;
            case "NOTICE":
                $folder = 'notice/';
                $filepath = '';
                if (!file_exists($root . $folder . $filepath)) {
                    mkdir($root . $folder . $filepath, 0755, true);
                }
                $filepath .= $Filename;
                break;

            case "FATHERPHOTO":
                $folder = 'fatherphoto/';
                $filepath = '';
                if (!file_exists($root . $folder . $filepath)) {
                    mkdir($root . $folder . $filepath, 0755, true);
                }
                $filepath .= $Filename;
                break;

            case "MOTHERPHOTO":
                $folder = 'motherphoto/';
                $filepath = '';
                if (!file_exists($root . $folder . $filepath)) {
                    mkdir($root . $folder . $filepath, 0755, true);
                }
                $filepath .= $Filename;
                break;

            case "GUARDIANPHOTO":
                $folder = 'guardianphoto/';
                $filepath = '';
                if (!file_exists($root . $folder . $filepath)) {
                    mkdir($root . $folder . $filepath, 0755, true);
                }
                $filepath .= $Filename;
                break;

            case "STUDENT":
                $folder = 'student/';
                $filepath = '';
                if (!file_exists($root . $folder . $filepath)) {
                    mkdir($root . $folder . $filepath, 0755, true);
                }
                $filepath .= $Filename;
                break;


            case "OTHERS":
                $folder = 'others/';
                $filepath = '';
                if (!file_exists($root . $folder . $filepath)) {
                    mkdir($root . $folder . $filepath, 0755, true);
                }
                $filepath .= $Filename;
                break;
            case "NOTES":
                $folder = 'notes/' . Session::getCurrentSessionID() . '/';
                $filepath = '';
                if (!file_exists($root . $folder . $filepath)) {
                    mkdir($root . $folder . $filepath, 0755, true);
                }
                $filepath .= $Filename;
                break;

            default:
                $folder = strtolower($category) . '/';
                if (!file_exists($root . $folder . $filepath)) {
                    mkdir($root . $folder . $filepath, 0755, true);
                }
                $filepath .=  $Filename;
        }
        $fp = fopen($root . $folder . $filepath, "w+");
        fwrite($fp, base64_decode($document));
        fclose($fp);
        return  $folder . $filepath;
    }

    function addDocument($data)
    {

        //work out to get the Document Category if not create one



        //save to the location specified
        $filearray = array(
            'ext' => $data['ext'],
            'file' => $data['file']
        );
        $id = $this->getDocumentCategoryID($data["DocumentsCategory"]);

        $path = self::storeDocuments($data["DocumentsCategory"], $filearray);
        if (strlen($path) > 1) {
            //add it to the database 
            $documentEncryptedID = Helper::generate_string(50);
            $param = array(
                array(':DocumentsCategoryID',   $id),
                array(':DocumentEncryptedID',  $documentEncryptedID),
                array(':DocumentSettingID', $data['DocumentSettingID']),
                array(':DocumentPath',   $path),
                array(':ThumbnailPath', null),
                array(':DocumentTitle', $data['DocumentTitle']),
                array(':DocumentAccess', $data["DocumentAccessLevel"]),
                array(':DocumentDisplayName', $data['DocumentDisplayName']),
                array(':AddedByID', 1),
                array(':UpdatedOn', null),
                array(':UpdatedByID', null),
            );

            $documentQuery = "INSERT INTO Documents(DocumentsCategoryID, DocumentEncryptedID, DocumentSettingID, DocumentPath, 
            ThumbnailPath, DocumentTitle, DocumentAccess, DocumentDisplayName, AddedByID, UpdatedOn, UpdatedByID) 
             VALUES (:DocumentsCategoryID,:DocumentEncryptedID, :DocumentSettingID, :DocumentPath, :ThumbnailPath, :DocumentTitle, :DocumentAccess,
             :DocumentDisplayName, :AddedByID, :UpdatedOn, :UpdatedByID)";
            $DocumentsID = DBController::ExecuteSQLID($documentQuery, $param);
            if ($DocumentsID) {
                return array("return_code" => true, "return_data" => $DocumentsID , "DocumentEncryptedID" =>  $documentEncryptedID);
            }

            //log this 
            DBController::logs("Module = Doucments \n Document Path :" .  $path . "Remarks= If document path is available then the file is saved but it is not added in the document table.");
            return array("return_code" => false, "return_data" => "Couldnot add the document");
        }
        return array("return_code" => false, "return_data" => "Couldnot add the document");
    }

    //for admission
    function addDocumentForAdmission($data)
    {

        $filearray = array(
            'ext' => $data['ext'],
            'file' => $data['file']
        );

        $id = $this->getDocumentCategoryID($data["DocumentsCategory"]);
        if ($id == 0)   return array("return_code" => false, "return_data" => "Could not find the category");

        $path = self::storeDocuments($data["DocumentsCategory"], $filearray);
        if (strlen($path) > 1) {
            //add it to the database 
            $param = array(
                array(':DocumentsCategoryID',  $id),
                array(':DocumentSettingID', $data['DocumentSettingID']),
                array(':DocumentPath',   $path),
                array(':ThumbnailPath', null),
                array(':DocumentTitle', $data['DocumentTitle']),
                array(':DocumentAccess', $data["DocumentAccessLevel"]),
                array(':DocumentDisplayName', $data['DocumentDisplayName']),
                array(':AddedByID',  isset($_SESSION["UserID"]) ? $_SESSION["UserID"] : -1),
                array(':UpdatedOn', null),
                array(':UpdatedByID', null),
            );

            $documentQuery = "INSERT INTO `Admission_Document`( `DocumentsCategoryID`, `DocumentSettingID`, `DocumentPath`,
            `ThumbnailPath`, `DocumentTitle`, `DocumentAccess`, `DocumentDisplayName`, `AddedByID`, `UpdatedOn`, `UpdatedByID`)
            VALUES (:DocumentsCategoryID, :DocumentSettingID, :DocumentPath, :ThumbnailPath, :DocumentTitle, :DocumentAccess,
            :DocumentDisplayName, :AddedByID, :UpdatedOn, :UpdatedByID)";
            $DocumentsID = DBController::ExecuteSQLID($documentQuery, $param);

            if ($DocumentsID) {
                return array("return_code" => true, "return_data" => $DocumentsID);
            }

            //log this 
            DBController::logs("Module = Doucments \n Document Path :" .  $path . "Remarks= If document path is available then the file is saved but it is not added in the document table.");
            return array("return_code" => false, "return_data" => "Couldnot add the document");
        }
    }

    function getDocumentCategoryID($category)
    {

        $param = array(
            array(":categoryName", trim($category))
        );
        $query = "SELECT * FROM `Settings_Documents_Category` where DocumentsCategory=:categoryName";
        $res = DBController::sendData($query, $param);
        if ($res)
            return $res['DocumentsCategoryID'];
        else {
            //  add new category
            $param3 = array(
                array(":CategoryName", trim($category))
            );
            $query3 = "INSERT INTO `Settings_Documents_Category`(`DocumentsCategory`)
            VALUES (:CategoryName)";
            $res4 = DBController::ExecuteSQLID($query3, $param3);
            if ($res4)
                return $res4;
            return 0;
        }
    }

    static function deleteDocument($data)
    {

        if (!isset($data["DocumentEncryptedID"]))
            return array("return_code" => false, "return_data" =>  "Document Ref No is missing");

        $docParam = array(
            array("DocumentEncryptedID", strip_tags($data["DocumentEncryptedID"])),
        );

        $sq = "SELECT * FROM Documents WHERE DocumentEncryptedID=:DocumentEncryptedID; ";
        $document = DBController::sendData($sq, $docParam);
        if ($document) {
            $sq = "DELETE FROM Documents WHERE DocumentEncryptedID=:DocumentEncryptedID; ";
            $res = DBController::ExecuteSQL($sq, $docParam);
            if ($res) {
                //remove the file from machine
                $root = '../app/data/';
                $docPath =  $root . $document["DocumentPath"];

                if (file_exists($docPath))
                    unlink($docPath);
                return array("return_code" => true, "return_data" => $document["DocumentsID"]);
            } else {
                return array("return_code" => false, "return_data" => "Failed to delete document");
            }
        }
        return array("return_code" => false, "return_data" => "Failed to delete document");

    }
}
