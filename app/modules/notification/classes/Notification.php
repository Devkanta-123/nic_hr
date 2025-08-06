<?php


namespace app\modules\notification\classes;

use app\database\DBController;
use app\misc\FCM;
 
class Notification
{
    public static function send($data)
    {
        DBController::logs("Entered Wrong Send Notification");
        if (!isset($data['UserIDs'])) {
            return array("return_code" => false, "return_data" => "User ID not found !!");
        } else {
            if (count($data['UserIDs']) > 0) {
                if (!isset($data['NotificationTitle']) || $data['NotificationTitle'] == '') {
                    return array("return_code" => false, "return_data" => "Notification Title missing !!");
                }
                if (!isset($data['NotificationContent']) || $data['NotificationContent'] == '') {
                    return array("return_code" => false, "return_data" => "Notification Content missing !!");
                }

                $query = "INSERT INTO `Notification` (`NotificationType`, `UserID`, `NotificationDateTime`, `Message`) VALUES(:NotificationType, :UserID, :NotificationDateTime, :Message)";
                $tokens = array();
                foreach ($data['UserIDs'] as $users) {
                    $param = [
                        [':NotificationType', $data['NotificationType']],
                        [':UserID', $users],
                        [':NotificationDateTime', date('Y-m-d H:i:s')],
                        [':Message', $data['NotificationContent']]
                    ];
                    $res = DBController::ExecuteSQLID($query, $param);
                }

                $q = "SELECT `si`.`StudentName`, `us`.`ContactNo`, `us`.`EmailID`, `us`.`FCMToken` 
                     FROM `Users` `us` 
                     INNER JOIN `Student_Info` `si` ON `us`.`StudentID`=`si`.`StudentID` 
                     WHERE FIND_IN_SET(`us`.`UserID`, :UserID);";
                $p = [[":UserID", implode(',', $data['UserIDs'])]];
                $r = DBController::getDataSet($q, $p);
                if (count($r) > 0) {
                    $fcm_tokens = array();
                    foreach ($r as $user) {
                        if ($user['FCMToken']) {
                            array_push($fcm_tokens, $user['FCMToken']);
                        }
                    }

                    if (count($fcm_tokens) > 0) {
                        FCM::pushNotification($fcm_tokens, $data['NotificationTitle'], $data['NotificationContent']);
                        return array("return_code" => true, "return_data" => "Notified successfully !!");
                    } else {
                        return array("return_code" => false, "return_data" => "User Data not found !!");
                    }
                } else {
                    return array("return_code" => false, "return_data" => "User Data not found !");
                }
            } else {
                return array("return_code" => false, "return_data" => "User ID not found !");
            }
        }
    }

    function saveNotification($data)
    {
        $query = "INSERT INTO Notification(NotificationType, UserID, NotificationDateTime, Message,ReferenceID)
        VALUES(:NotificationType, :UserID, :NotificationDateTime, :Message,:ReferenceID)";
        $tokens = array();
        foreach ($data['Users'] as $users) {
            $param = [
                [':NotificationType', $data['NotificationType']],
                [':UserID', $users],
                [':NotificationDateTime', date('Y-m-d H:i:s')],
                [':Message', $data['Message']],
                [':ReferenceID', isset($data['RefID']) ? $data['RefID'] : -1],
            ];
            $res = DBController::ExecuteSQLID($query, $param);
        }

        $query = "SELECT DISTINCT FCMToken FROM Users where UserID in (" . implode(",", $data["Users"]) . ")";
         $res = DBController::getDataSet($query);

        if ($res) {
            foreach ($res  as $fcmtokens) {
                array_push($tokens, $fcmtokens["FCMToken"]);
            }
            //push notification to the users   
            $result= FCM::pushNotification($tokens,$data['NotificationType'],$data['Message']);
        }
    }

    function getUserNotifications()
    {
        $param = [
            [':UserID', $_SESSION['UserID']]
        ];
        $query = "SELECT NotificationID, Message, NotificationDateTime, NotificationType,IFNULL(isRead,0) as isRead FROM Notification 
        WHERE UserID = :UserID AND IFNULL(isRemoved,0) = 0 ORDER BY NotificationDateTime ASC";

        $res = DBController::getDataSet($query, $param);
        return array("return_code" => true, "return_data" => $res);
    }

    function getUserUnreadNotifications()
    {
        $param = [
            [':UserID', $_SESSION['UserID']]
        ];
        $query = "SELECT NotificationID, Message, NotificationDateTime, NotificationType FROM Notification 
        WHERE UserID = :UserID AND IFNULL(isRead,0) = 0 AND isRemoved = 0 ORDER BY NotificationDateTime ASC";

        $res = DBController::getDataSet($query, $param);
        return array("return_code" => true, "return_data" => $res);
    }


    function getUserReadNotifications()
    {
        $param = [
            [':UserID', $_SESSION['UserID']]
        ];
        $query = "SELECT NotificationID, Message, NotificationDateTime, NotificationType FROM Notification 
        WHERE UserID = :UserID AND isRead = 1 AND isRemoved = 0 ORDER BY NotificationDateTime Desc";

        $res = DBController::getDataSet($query, $param);
        return array("return_code" => true, "return_data" => $res);
    }

    function markNotificationRead($data)
    {
        $param = [
            [':NotificationID', $data['NotificationID']],
            [':UserID', $_SESSION['UserID']],
            [':ReadDateTime', date('Y-m-d H:i:s')],
        ];

        $query = "UPDATE Notification SET isRead = 1, ReadDateTime = :ReadDateTime WHERE NotificationID = :NotificationID AND UserID = :UserID";
        $res = DBController::ExecuteSQL($query, $param);
        if ($res)
            return array("return_code" => true, "return_data" => "Notification Read updated");
        return array("return_code" => true, "return_data" => "Cannot mark notification as read");
    }

    function removeNotification($data)
    {
        $param = [
            [':NotificationID', $data['NotificationID']],
            [':UserID', $_SESSION['UserID']],
            [':RemovedDateTime', date('Y-m-d H:i:s')],
        ];

        $query = "UPDATE Notification SET isRemoved = 1, RemovedDateTime = :RemovedDateTime WHERE NotificationID = :NotificationID AND UserID = :UserID";
        $res = DBController::ExecuteSQL($query, $param);
        if ($res)
            return array("return_code" => true, "return_data" => "Notification Removed");
        return array("return_code" => true, "return_data" => "Cannot remove notification");
    }

    //updating the status of the notification read
    function updateNotificationRead($data)
    {
        switch ($data['Category']) {
            case "NOTICE":
                $query = "UPDATE SchoolNotice
                SET ReadBy = CONCAT((SELECT CASE WHEN ReadBy IS NULL THEN '' ELSE ReadBy END AS ReadBy WHERE NoticeID = :NoticeID), CONCAT(:UserID, ','))
                WHERE NoticeID = :NoticeID";
                foreach ($data['NoticeIDs'] as $id) {
                    $param = [
                        [':NoticeID', $id],
                        [':UserID', $_SESSION['UserID']]
                    ];
                    $res = DBController::ExecuteSQL($query, $param);
                }
                break;

            case "MEETING":
                $query = "UPDATE Meeting_VirtualSession
                SET ReadBy = CONCAT((SELECT CASE WHEN ReadBy IS NULL THEN '' ELSE ReadBy END AS ReadBy WHERE VirtualSessionID = :VirtualSessionID),  CONCAT(:UserID, ','))
                WHERE VirtualSessionID = :VirtualSessionID";
                foreach ($data['VirtualSessionIDs'] as $id) {
                    $param = [
                        [':VirtualSessionID', $id],
                        [':UserID', $_SESSION['UserID']]
                    ];
                    $res = DBController::ExecuteSQL($query, $param);
                }
                break;
        }
    }
}
