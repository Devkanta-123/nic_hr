<?php
namespace app\modules\supports;
use app\core\Controller;
use app\modules\supports\classes\Support;

class SupportController implements Controller
{

    public function Route($data)
    {
        $jsondata = $data["JSON"];

        switch ($data["Page_key"]) {
          
            case 'sendotp':
                return (new Support())->sentotp($jsondata);

            // case "getDataFromAPI":
            //      return (new Support())->getDataFromAPI($jsondata);


            default:
                header('HTTP/1.1 401  Unauthorized Access');
                header("Status: 401 ");
                session_destroy();
                return array("return_code" => false, "return_data" => array("Page Key not found"));
        }
    }

   
    static function Views($page)
    {

        $viewpath = "../app/modules/supports/views/";

        switch ($page[1]) {

            case 'support':
                load($viewpath . "sendlinkforpassswordreset.php");
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
