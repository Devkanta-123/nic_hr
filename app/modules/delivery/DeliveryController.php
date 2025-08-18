<?php

namespace app\modules\delivery;

use app\core\Controller;
use app\modules\delivery\classes\Delivery;

class DeliveryController implements Controller
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

            case 'getLocations':
                return (new Delivery())->getLocations();


            case 'saveWork':
                return (new Delivery())->saveWork($jsondata);

            case 'getWorks':
                return (new Delivery())->getWorks();

                  case 'getAssignWork':
                return (new Delivery())->getAssignWork();


            case 'assignWork':
                return (new Delivery())->assignWork($jsondata);



       


            default:
                header('HTTP/1.1 401  Unauthorized Access');
                header("Status: 401 ");
                session_destroy();
                return array("return_code" => false, "return_data" => array("Page Key not found"));
        }
    }


    static function Views($page)
    {

        $viewpath = "../app/modules/delivery/views/";

        switch ($page[1]) {

            case 'assign':
                load(path: $viewpath . "requested.php");
                break;

            case 'add':
                load($viewpath . "work.php");
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
