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

class Notice
{
    /**
     * parameters{Title,Description,SDate,EDate,ApplicableFor,isAll,isPublic,File,Link,Staff[],Intern[]}
     *  Description: Add the Notice
     *  Createdby : Angelbert (01/02/2024)
     *  Updates:
     *    07-02-2024 (Angelbert):  Adding param in info so that it will be easy for future used   
     * 
     */
    function addNotice($data)
    {
        $sdate = explode("/", $data["SDate"]);
        $sdate = $sdate[2] . "-" . $sdate[0] . "-" . $sdate[1];
        $edate = explode("/", $data["EDate"]);
        $edate = $edate[2] . "-" . $edate[0] . "-" . $edate[1];

        $internsIds = $staff_ids = null;
        if ($data["ApplicableFor"] == '1') {
            $staff_ids = implode(',', $data["Staff"]);
        } elseif ($data["ApplicableFor"] == '2') {
            $internsIds = implode(',', $data["Intern"]);
        } else {
            $internsIds = implode(',', $data["Intern"]);
            $staff_ids = implode(',', $data["Staff"]);
        }
        $query = "INSERT INTO `Administration_Notice`(`Title`, `Description`, `StartDate`, `EndDate`, `isActive`, `AddedBy`, `ApplicableFor`, `isAll`, `isPublic`, `StaffIDs`, `InternIDs`)
        VALUES (:Title,:Description,:SDate,:EDate,1,:AddedBy,:ApplicableFor,:isAll,:isPublic,:StaffIDs,:InternIDs)";
        $param = [
            [":Title", $data["Title"]],
            [":Description", $data["Description"]],
            [":SDate", $sdate],
            [":EDate", $edate],
            [":AddedBy", $_SESSION['UserID']],
            [":ApplicableFor", $data["ApplicableFor"]],
            [":isAll", $data["isAll"]],
            [":isPublic", $data['isPublic']],
            [":StaffIDs", $staff_ids],
            [":InternIDs", $internsIds]
        ];
        $NoticeID = DBController::ExecuteSQLID($query, $param);
        $shortlink = "";
        if ($NoticeID) {
            DBController::logs("After Success Administration_Notice ");
            if (!file_exists("../app/data/documents/"))
                mkdir("../app/data/documents/", 0777, TRUE);
            ini_set('memory_limit', '-1');
            $errorInfo = '';
            // if File exist
            foreach ($data["File"] as $file) {
                $ext = pathinfo($file['filename'], PATHINFO_EXTENSION);
                $filedata = file_get_contents($file['filedata']);
                do {
                    $newfilename = "n_" . Helper::generate_string(10) . "." . $ext;
                } while (file_exists("../app/data/documents/" . $newfilename));
                $fp = fopen("../app/data/documents/" . $newfilename, "w+");
                DBController::logs("Before Adding  docs ");

                //if(file_put_contents(("../app/data/documents/".$newfilename), $filedata))
                if (fwrite($fp, ($filedata))) {
                    $q2 = "INSERT INTO `Documents` (`DocumentsCategoryID`, `DocumentSettingID`, `DocumentPath`, `DocumentTitle`, `DocumentAccess`, `DocumentDisplayName`, `AddedByID`) VALUES (:DocumentsCategoryID, :DocumentSettingID, :DocumentPath, :DocumentTitle, :DocumentAccess, :DocumentDisplayName, :AddedByID);";
                    $p2 = [
                        [":DocumentsCategoryID", "11"],
                        [":DocumentSettingID", "9"],
                        [":DocumentPath", "../app/data/documents/" . $newfilename],
                        [":DocumentTitle", $file['filename']],
                        [":DocumentAccess", "111"],
                        [":DocumentDisplayName", "Notice"], //to be given the file uploaded name 
                        [":AddedByID", $_SESSION['UserID']]
                    ];
                    $r2 = DBController::ExecuteSQLID($q2, $p2);
                    DBController::logs("Reached Stage 5");

                    $url = "file?type=document&name=" . $newfilename;
                    $query = "INSERT INTO `Administration_NoticeDetails` (`NoticeID`, `TypeID`, `Title`, `FileLink`, `DocumentID`) VALUES (:NoticeID, :TypeID, :Title, :FileLink, :DocumentID);";
                    $param = [
                        [":NoticeID", $NoticeID],
                        [":TypeID", "1"],
                        [":Title", $file['file_title']],
                        [":FileLink", $url],
                        [":DocumentID", $r2]
                    ];
                    $res = DBController::ExecuteSQL($query, $param);

                    if (!$res) {
                        $errorInfo = $errorInfo . " Document " . $file['filename'] . "could not be inserted to the table";
                        //return array("return_code" => false, "return_data" => "Unable to update the file details ");
                    }
                } else {
                    return array("return_code" => false, "return_data" => "File not saved !!");
                }
                fclose($fp);
            }

            //check for link
            foreach ($data["Link"] as $link) {
                $query = "INSERT INTO `Administration_NoticeDetails` (`NoticeID`, `TypeID`, `Title`, `FileLink`) VALUES (:NoticeID, :TypeID, :Title, :FileLink);";
                $param = [
                    [":NoticeID", $NoticeID],
                    [":TypeID", "2"],
                    [":Title", $link['link_title']],
                    [":FileLink", $link['link']]
                ];
                $res = DBController::ExecuteSQL($query, $param);
                if (!$res) {
                    $errorInfo = $errorInfo . " Link " . $link['link_title'] . "could not be inserted to the table";
                    //return array("return_code" => false, "return_data" => "Something went wrong..");
                }
            }
            $q1 = "";
            $r1 = false;
            //for Valid staff Data
            if ($data["ApplicableFor"] == '1') {
                if ($data["isAll"] == '1') {
                    // get all the active staffs 
                    $q1 = "SELECT u.Name,u.UserID,u.EmailID,u.ContactNo,u.FCMToken FROM Users u 
                    INNER JOIN Staff on Staff.StaffID=u.StaffID 
                    WHERE u.isActive=1 and ifnull(Staff.isRemoved,0) =0 and u.UserType=2;";
                } else {
                    if (count($data['Staff']) > 0) {
                        $temp = "";
                        foreach ($data['Staff'] as $item) {
                            $temp .= "`u`.`StaffID`=" . $item . " OR ";
                        }
                        $temp = substr($temp, 0, -4);
                        $q1 = "SELECT u.Name,u.UserID,u.EmailID,u.ContactNo,u.FCMToken FROM `Users` `u`
                        WHERE `u`.`isActive`='1' and u.UserType=2 AND (" . $temp . ");"; // TO CHECK AS THE SESSION IS NOT MENTIONED
                    }
                }
                $r1 = DBController::getDataSet($q1);  //return the staff

            }
            //for for valid Intern (need to check for Usertype)
            elseif ($data["ApplicableFor"] == '2') {

                if ($data["isAll"] == '1') {
                    $q1 = "SELECT  si.StaffInternName,si.EmailID,si.ContactNo,u.UserID,u.FCMToken FROM Users u 
                    INNER JOIN Staff_Intern si on si.StaffInternID = u.StaffID 
                    WHERE si.isRemoved =0 and u.isActive =1 and u.UserType=3;";
                } else {
                    if (count($data['Intern']) > 0) {
                        $temp = "";
                        foreach ($data['Intern'] as $item) {
                            $temp .= "`u`.`StaffID`=" . $item . " OR ";
                        }
                        $temp = substr($temp, 0, -3);
                        $q1 = "SELECT  si.StaffInternName,si.EmailID,si.ContactNo,u.UserID,u.FCMToken FROM Users u 
                        INNER JOIN Staff_Intern si on si.StaffInternID = u.StaffID 
                        WHERE si.isRemoved =0 and u.isActive =1 and u.UserType=3 AND (" . $temp . ");";
                    }
                }
                $r1 = DBController::getDataSet($q1);
            }

            //get both staff and intern only the valid one
            else {
                $q1 = "SELECT u.UserID,u.Name,u.EmailID,u.ContactNo,u.FCMToken FROM Users u
                inner join Staff on Staff.StaffID=u.StaffID  where ifnull(u.isActive,0)=1 and ifnull(Staff.isRemoved,0) =0  and u.UserType =2
                UNION ALL
                SELECT u.UserID,u.Name,u.EmailID,u.ContactNo,u.FCMToken FROM Users u 
                inner join Staff_Intern si on si.StaffInternID=u.StaffID and ifnull(si.isRemoved,0) =0 and u.UserType =3
                WHERE ifnull(u.isActive,0) =1;";
                $r1 = DBController::getDataSet($q1);
            }

            //creating shortlink  and update to the notice 
            $url = $_SERVER['HTTP_HOST'] . "/viewnotices-" . (base64_encode($NoticeID));
            $shortlinkdata =  "test";
            // $this->createShortLink($url); // TODO // commented because currently we do not have the table Url 

            if ($shortlinkdata) {
                $shortlink =  $shortlinkdata;

                $qu = "UPDATE `Administration_Notice` SET `ShortLink`=:ShortLink WHERE `NoticeID`=:NoticeID;";
                $pu = [
                    [":ShortLink", $shortlink],
                    [":NoticeID", $NoticeID]
                ];
                DBController::ExecuteSQL($qu, $pu);
            }
            //end of shortlink
            if ($r1) {
                $tokens = array();
                $mobilenos = array();
                $NotificationUsers = array();
                for ($i = 0; $i < count($r1); $i++) {
                    if (isset($r1[$i]["FCMToken"]) && $r1[$i]["FCMToken"] != NULL && strlen($r1[$i]["FCMToken"]) > 10) {
                        array_push($tokens, $r1[$i]["FCMToken"]);
                        array_push($NotificationUsers, $r1[$i]["UserID"]);
                    } else {
                        array_push($mobilenos, $r1[$i]["ContactNo"]);
                    }
                }

                // TODO NOTIFICATION
                if (count($NotificationUsers) > 0) {
                    $param = [
                        'NotificationType' => "NOTICE",
                        'Users' => $NotificationUsers,
                        'FCMToken' => $tokens,
                        'Message' => $data["Title"] . ': ' . $data["Description"],
                        'RefID' => $NoticeID,
                    ];
                    (new Notification())->saveNotification($param);
                }


                //sending SMS whose FCM is not registered. 
                //parse distinct numbers only 
                $mobilenos = array_unique($mobilenos);
                // $schooldata = (new School())->getSchoolDetails([])["return_data"];


                if (count($mobilenos) > 0) {
                    // TODO SMS
                    // if (Administration::isSMSNoticeEnabled()) {
                    //     foreach ($mobilenos as $mobileno) {
                    //         //send SMS
                    //         SMS::SendSms(
                    //             "PrayagEduNotice",
                    //             $mobileno,
                    //             [
                    //                 "name" => "Parent/Guardian",
                    //                 "title" =>  substr($data['Title'], 0, 30),
                    //                 "description" => $shortlink,
                    //                 "organization" =>  substr($schooldata["SchoolName"], 0, 30),
                    //             ]
                    //         );
                    //     }

                    //     $pnr = "Notified Successfully !!";
                    //     return array("return_code" => true, "return_data" => "Notice created successfully and notified..");
                    // }
                }


                // $pnr = "Notified Successfully !!";
            }
            return array("return_code" => true, "return_data" => "Notice created successfully but  Notified since SMS was disable..");
        } else
            return array("return_code" => false, "return_data" => "Unable to save the notice");
    }

    /**
     *  Description:  Create short link (Not using for now)
     *  Createdby : Angelbert (01/02/2024)
     *  Updates:
     *    07-02-2024 (Angelbert):  Adding param in info so that it will be easy for future used   
     * 
     */
    function createShortLink($url)
    {
        //inserting to the shortURL directly 
        $shorturl = URL::ShortenURL(array("LongURL" => $url));
        if ($shorturl["return_code"])
            return  $shorturl["return_data"];
        else
            return "";
        //END OF DIRECT SHORT URL

        //this is using curl method
        $v = parse_url($url);
        if (!isset($v["scheme"])) {
            $url = "https://" . $url;
        }
        return URL::requestShortenURL($url);
    }

    /**
     *  Description:  Get all the Active Notice
     *  Createdby : Angelbert (01/02/2024)
     *  Updates:
     *    07-02-2024 (Angelbert):  Adding param in info so that it will be easy for future used   
     * 
     */
    function getNotices($d)
    {
        $query = "SELECT `n`.`NoticeID`,`n`.`isPublic`, `n`.`Title`,`n`.`Description`, DATE_FORMAT(`n`.`StartDate`, '%d/%m/%Y') AS 'StartDate', DATE_FORMAT(`n`.`EndDate`, '%d/%m/%Y') AS 'EndDate', DATE_FORMAT(`n`.`AddedOn`, '%d/%m/%Y') AS 'AddedOn', `n`.`isActive`, `n`.`AddedBy`, `u`.`Name`, (CASE WHEN (SELECT COUNT(`d`.`NoticeDetailID`) FROM `Administration_NoticeDetails` `d` 
        WHERE `d`.`NoticeID`=`n`.`NoticeID` AND `d`.`TypeID`='1')>0 THEN '1' ELSE '0' END) AS 'hasFiles', (CASE WHEN (SELECT COUNT(`d`.`NoticeDetailID`) FROM `Administration_NoticeDetails` `d` WHERE `d`.`NoticeID`=`n`.`NoticeID` AND `d`.`TypeID`='2')>0 THEN '1' ELSE '0' END) AS 'hasLinks',
        SUM(CASE WHEN Notification.isRead = 1 THEN 1 ELSE 0 END) AS isRead,SUM(CASE WHEN Notification.isRead = 0 THEN 1 ELSE 0 END) AS notRead
        FROM `Administration_Notice` `n` 
        LEFT JOIN `Users` `u` ON `n`.`AddedBy`=`u`.`UserID`
        LEFT JOIN Notification on Notification.ReferenceID=n.NoticeID
        WHERE  n.isActive=1 GROUP BY n.NoticeID ORDER BY n.NoticeID desc;";

        $res = DBController::getDataSet($query);

        $query1 = "SELECT * FROM `Administration_NoticeDetails` ";
        $res1 = DBController::getDataSet($query1);

        // Assign fetched data directly to the respective keys in $data
        $data['notices'] = $res;
        $data['notice_details'] = $res1;
        return array("return_code" => true, "return_data" => $data);
    }

    /**
     *  parameters{NoticeID}
     *  Description:  Delete the Notice
     *  Createdby : Angelbert (01/02/2024)
     *  Updates:
     *    07-02-2024 (Angelbert):  Adding param in info so that it will be easy for future used   
     * 
     */
    function deleteNotice($data)
    {
        //check that only admin can do the job
        if (isset($_SESSION['UserType']) &&  $_SESSION['UserType'] == 1) {
            $params3 = array(
                array(":NoticeID", $data["NoticeID"]),
            );
            $deletequery = "UPDATE `Administration_Notice` SET `isActive`=0 WHERE `NoticeID`=:NoticeID";
            $res3 = DBController::ExecuteSQL($deletequery, $params3);
            if ($res3) {
                return array("return_code" => true, "return_data" => "Sucessfully Archived");
            } else {
                return array("return_code" => false, "return_data" => "Unable to delete at this point of time.");
            }
        } else {
            return array("return_code" => false, "return_data" => "Access denied.");
        }
    }

    /**
     *  parameters{NoticeID}
     *  Description: get  the Notice detail by NoticeID
     *  Createdby : Angelbert (01/02/2024)
     *  Updates:
     *    07-02-2024 (Angelbert):  Adding param in info so that it will be easy for future used   
     * 
     */
    function getNoticeDetails($data)
    {
        $query = "SELECT * FROM `Administration_NoticeDetails` WHERE `NoticeID`=:NoticeID;";
        $prm = array(array(":NoticeID", strip_tags($data["NoticeID"])));
        $res = DBController::getDataSet($query, $prm);
        return array("return_code" => true, "return_data" => $res);
    }

    /**
     *  parameters{NoticeID}
     *  Description: get  all the user who has seen the Notice
     *  Createdby : Angelbert (01/02/2024)
     *  Updates:
     *         07-02-2024 (Angelbert):  Adding param in info so that it will be easy for future used 
     * 
     */
    function getseenNotice($data)
    {
        //get the notice based on id
        $param = array(
            array(":NoticeID", strip_tags($data['NoticeID'])),
        );
        $query = "SELECT `n`.`NoticeID`, `n`.`Title`,`n`.`Description`, DATE_FORMAT(`n`.`StartDate`, '%d/%m/%Y') AS 'StartDate', DATE_FORMAT(`n`.`EndDate`, '%d/%m/%Y') AS 'EndDate', DATE_FORMAT(`n`.`AddedOn`, '%d/%m/%Y') AS 'AddedOn', `n`.`isActive`, `n`.`AddedBy`, `u`.`Name`, (CASE WHEN (SELECT COUNT(`d`.`NoticeDetailID`) FROM `Administration_NoticeDetails` `d` WHERE `d`.`NoticeID`=`n`.`NoticeID` AND `d`.`TypeID`='1')>0 THEN '1' ELSE '0' END) AS 'hasFiles', (CASE WHEN (SELECT COUNT(`d`.`NoticeDetailID`)
            FROM `Administration_NoticeDetails` `d`
            WHERE `d`.`NoticeID`=`n`.`NoticeID` AND `d`.`TypeID`='2')>0 THEN '1' ELSE '0' END) AS 'hasLinks', SUM(CASE WHEN Notification.isRead = 1 THEN 1 ELSE 0 END) AS isRead,SUM(CASE WHEN Notification.isRead = 0 THEN 1 ELSE 0 END) AS notRead,IFNULL(n.InternIDs,'') as InternIDs,  IFNULL(n.`StaffIDs`,'') as StaffIDs
            FROM `Administration_Notice` `n`
            LEFT JOIN `Users` `u` ON `n`.`AddedBy`=`u`.`UserID`
            LEFT JOIN Notification on Notification.ReferenceID=n.NoticeID
            WHERE n.NoticeID=:NoticeID  
            GROUP BY n.NoticeID;";
        $res = DBController::sendData($query, $param);
        if ($res) {
            //get the userID based on the IDs we get
            if (isset($res['InternIDs'])) {
                $query1 = "  SELECT Users.`UserID`, Users.`Name`, Users.`Username`, Users.`EmailID`, Users.`ContactNo`,Users.UserType,Users.`StaffID`
                FROM `Users` 
                INNER JOIN Staff_Intern si on si.StaffInternID = Users.StaffID
                WHERE Users.UserType=3 and  si.StaffInternID in (" . $res['InternIDs'] . ")";
                $res1 = DBController::getDataSet($query1);
            } else {
                $query1 = "SELECT Users.`UserID`, Users.`Name`, Users.`Username`, Users.`EmailID`, Users.`ContactNo`, Users.`UserType`,Users.`StaffID`
                FROM `Users`
                INNER JOIN Staff s on s.StaffID=Users.StaffID
                WHERE Users.UserType=2 and  s.`StaffID` in (" . $res['StaffIDs'] . "))";
                $res1 = DBController::getDataSet($query1);
            }
            //get if they read or not
            // put the userID in array
            //   $UserID = implode(',',$res1['UserID']);
            $UserID = array();
            foreach ($res1 as $userdata) {
                array_push($UserID, $userdata['UserID']);
            }
            $da = implode(", ", $UserID);
            $param3 = array(
                array(":NoticeID", strip_tags($data['NoticeID'])),
                array(":isRead", strip_tags($data['isRead']))
            );
            $res3 = "SELECT `NotificationID`, `NotificationType`, `ReferenceID`, Notification.`UserID`, `NotificationDateTime`, `Message`, `isRead`, `ReadDateTime`, `isRemoved`, `RemovedDateTime`,Users.Name,uu.UserType
            FROM `Notification`
            INNER JOIN Users on Users.UserID=Notification.UserID
            INNER JOIN Users_UserType uu on uu.UserTypeID=Users.UserType
            WHERE Notification.`UserID` in (" . implode(',', explode(',', $da)) . ") and isRead=:isRead and ReferenceID=:NoticeID;";

            $res3 = DBController::getDataSet($res3, $param3);
            $returndata['NoticeData'] = $res;
            // $returndata['StudentStaffData'] = $res1;
            $returndata['isReadData'] = $res3;
            $returndata['data'] = $data['isRead'];
            return array("return_code" => true, "return_data" => $returndata);
        }
        return array("return_code" => false, "return_data" => "Data Not Available");
    }

    /**
     *  Description: get  all the Notice which has been deleted
     *  Createdby : Angelbert (01/02/2024)
     *  Updates:
     *         07-02-2024 (Angelbert):  Adding param in info so that it will be easy for future used 
     * 
     */
    function getArcheiveNotice()
    {
        $query = "SELECT `n`.`NoticeID`, `n`.`Title`,`n`.`Description`, DATE_FORMAT(`n`.`StartDate`, '%d/%m/%Y') AS 'StartDate', DATE_FORMAT(`n`.`EndDate`, '%d/%m/%Y') AS 'EndDate', DATE_FORMAT(`n`.`AddedOn`, '%d/%m/%Y') AS 'AddedOn', `n`.`isActive`, `n`.`AddedBy`, `u`.`Name`, (CASE WHEN (SELECT COUNT(`d`.`NoticeDetailID`) FROM `Administration_NoticeDetails` `d` WHERE `d`.`NoticeID`=`n`.`NoticeID` AND `d`.`TypeID`='1')>0 THEN '1' ELSE '0' END) AS 'hasFiles', (CASE WHEN (SELECT COUNT(`d`.`NoticeDetailID`) FROM `Administration_NoticeDetails` `d` WHERE `d`.`NoticeID`=`n`.`NoticeID` AND `d`.`TypeID`='2')>0 THEN '1' ELSE '0' END) AS 'hasLinks',
        SUM(CASE WHEN Notification.isRead = 1 THEN 1 ELSE 0 END) AS isRead,SUM(CASE WHEN Notification.isRead = 0 THEN 1 ELSE 0 END) AS notRead
        FROM `Administration_Notice` `n` 
        LEFT JOIN `Users` `u` ON `n`.`AddedBy`=`u`.`UserID`
        LEFT JOIN Notification on Notification.ReferenceID=n.NoticeID
        WHERE  n.isActive=0 GROUP BY n.NoticeID;";

        $res = DBController::getDataSet($query);

        $query1 = "SELECT * FROM `Administration_NoticeDetails`;";
        $res1 = DBController::getDataSet($query1);

        $data['notices'] = $res;
        $data['notice_details'] = $res1;
        return array("return_code" => true, "return_data" => $data);
    }
    /**
     *  Description: get  all the active Notice for the app 
     *  Createdby : Dev (21/03/2024)
     *  Updates:
     * 
      * */
    function getNoticesForApp(){
        $params = array(
            array(":StaffID", $_SESSION['StaffID']),
        );
        $sq='
        SELECT IFNULL(JSON_ARRAYAGG(
			JSON_OBJECT("NoticeID",NoticeID, "Name",Users.Name,"Title", n.Title, "Description",Description,"CreatedDateTime",StartDate, "ValidDate",EndDate ,"Weblink",ShortLink, "NoticeDetails",
            IFNULL( (SELECT
	        	JSON_ARRAYAGG(
			    JSON_OBJECT("NoticeDetailID",nd.NoticeDetailID,"TypeID",nd.TypeID, "DetailsTitle",nd.Title, "FileLink",FileLink)
                )
               FROM Administration_NoticeDetails nd
		      where nd.NoticeID=n.NoticeID
            ),JSON_ARRAY())
        )
        ),JSON_ARRAY()) as "Notices"
        FROM Administration_Notice n inner join Users on Users.UserID =n.AddedBy  where  IFNULL(n.isActive,0)=1 AND   n.EndDate >= CURDATE() AND ( n.isAll = 1 OR :StaffID in (n.StaffIDs)) ';
        $res = DBController::sendData($sq,$params);
        if ($res){
          return array("return_code" => true, "return_data" => json_decode($res["Notices"],true));
        }
        return array("return_code" => false, "return_data" => "No Notice available for you.");

    }
}
