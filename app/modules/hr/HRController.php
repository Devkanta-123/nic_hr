<?php


/* 
    Current Version: 1.0.0
    Created By: Devkanta,     dev1@techz.in
    Created On: 19/01/2024
    Modified By:
    Modified On: 

*/

namespace app\modules\hr;

use app\core\Controller;
use app\modules\hr\classes\Leave;

class HRController implements Controller
{
    public function Route($data)
    {
        $jsondata = $data["JSON"];

        switch ($data["Page_key"]) {

                //Leave
            case "getAllLeaves":
                return (new Leave())->getAllLeaves($jsondata);

            case "leaverequest":
                return (new Leave())->leaverequest($jsondata);

            case "leaveReject":
                return (new Leave())->leaveReject($jsondata);

            case "getAllHRLeaveTypes":
                return (new Leave())->getAllHRLeaveTypes($jsondata);

            case "getAllLeaveRequest":
                return (new Leave())->getAllLeaveRequest($jsondata);

            case "leaveApproval":
                return (new Leave())->leaveApproval($jsondata);

            case "getAllApprovedLeave":
                return (new Leave())->getAllApprovedLeave($jsondata);

            case "getLeaveBalance":
                return (new Leave())->getLeaveBalance();
        }
    }

    static function Views($page)
    {

        $viewpath = "../app/modules/hr/views/";

        switch ($page[1]) {
            case 'allleaverequest':
                load($viewpath . "leave/allleaverequest.php");
                break;


            case 'addleaves':
                load($viewpath . "leave/addleaves.php");
                break;

            case 'approvedleave':
                load($viewpath . "leave/approvedleave.php");
                break;

            case 'settings':
                load($viewpath . "leave/settings.php");
                break;

            case 'leavebalance':
                load($viewpath . "leave/leavebalance.php");
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
