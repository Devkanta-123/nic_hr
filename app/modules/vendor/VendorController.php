<?php

namespace app\modules\vendor;

use app\core\Controller;
use app\modules\vendor\classes\Vendor;

class VendorController implements Controller
{
    /* 
    Current Version: 2.0.0
    Created By: Devkanta,     dev1@techz.in
    Created On: 05/12/2023
    Modified By:
    Modified On: 
*/

    public function Route($data)
    {
        $jsondata = $data["JSON"];

        switch ($data["Page_key"]) {

            case 'saveEmployee':
                return (new Vendor())->saveEmployee($jsondata);

            case 'getEmployeeList':
                return (new Vendor())->getEmployeeList();

            case 'getActiveEmployeeList':
                return (new Vendor())->getActiveEmployeeList();
            case 'getActiveEmployeesForAttendance':
                return (new Vendor())->getActiveEmployeesForAttendance();
                
            case 'getAttendanceReport':
                return (new Vendor())->getAttendanceReport();






            case 'getSectors':
                return (new Vendor())->getSectors();
            case 'changeStatus':
                return (new Vendor())->changeStatus($jsondata);




            case 'addFood':
                return (new Vendor())->addFood($jsondata);

            case 'getFoods':
                return (new Vendor())->getFoods();



            default:
                header('HTTP/1.1 401  Unauthorized Access');
                header("Status: 401 ");
                session_destroy();
                return array("return_code" => false, "return_data" => array("Page Key not found"));
        }
    }


    static function Views($page)
    {

        $viewpath = "../app/modules/vendor/views/";

        switch ($page[1]) {
            case 'list':
                load($viewpath . "request.php");
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
