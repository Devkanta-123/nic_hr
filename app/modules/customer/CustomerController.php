<?php

namespace app\modules\customer;

use app\core\Controller;
use app\modules\customer\classes\Customer;

class CustomerController implements Controller
{
    /* 
    Current Version: 0.0.0
    Created By: Devkanta
    Created On: 15/11/2024
    Modified By:
    Modified On: 
*/

    public function Route($data)
    {
        $jsondata = $data["JSON"];

        switch ($data["Page_key"]) {

            case 'saveCustomer':
                return (new Customer())->saveCustomer($jsondata);


            case 'addFoodToCards':
                return (new Customer())->addFoodToCards($jsondata);

            default:
                header('HTTP/1.1 401  Unauthorized Access');
                header("Status: 401 ");
                session_destroy();
                return array("return_code" => false, "return_data" => array("Page Key not found"));
        }
    }


    static function Views($page)
    {

        $viewpath = "../app/modules/customer/views/";

        switch ($page[1]) {

            case 'request':
                load($viewpath . "requested.php");
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
