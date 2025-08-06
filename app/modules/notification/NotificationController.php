<?php


namespace app\modules\notification;


use app\core\Controller;
use app\modules\notification\classes\Notification;

class NotificationController implements Controller
{

    public function Route($data)
    {
        $jsondata = $data["JSON"];

        switch ($data["Page_key"]) {
            case 'getUserNotifications':
                return (new Notification())->getUserNotifications($jsondata);
            case 'getUserUnreadNotifications':
                return (new Notification())->getUserUnreadNotifications($jsondata);
            case 'getUserReadNotifications':
                return (new Notification())->getUserReadNotifications($jsondata);
            case 'markNotificationRead':
                return (new Notification())->markNotificationRead($jsondata);
            case 'removeNotification':
                return (new Notification())->removeNotification($jsondata);
            default:
                $result = array("return_code" => false, "return_data" => array("Page Key not found"));
               // session_destroy();
                header('HTTP/1.1 401  Unauthorized Access');
                header("Status: 401");
                break;
        }
        return $result;
    }

    public static function Views($page)
    {

        $viewpath = "../app/modules/notification/views/";
        switch ($page[1]) {
            case 'viewnotification':
                load($viewpath . "notification.php");
                break;
            default:
                // session_destroy();
                include '404.php';
                header('HTTP/1.1 401  Unauthorized Access');
                header("Status: 401 ");
                break;
        }
    }
}
