<?php
namespace app\modules\clients;

use app\core\Controller;
use app\modules\clients\classes\Client;

class ClientController implements Controller {

    public function Route($data)
    {
        $jsondata = $data["JSON"];

        switch ($data["Page_key"]) {
            case 'Unsubscribe':
                return (new Client())->Unsubscribe($jsondata);

            case 'getClients':
                return (new Client())->getClients($jsondata);

            case 'addClient':
                return (new Client())->addClient($jsondata );

            case 'addClientSubscription':
                    return (new Client())->addClientSubscription($jsondata ); 

            case 'deleteClient':
                  return (new Client())->deleteClient($jsondata);

            case 'getClient_subscription':
                return (new Client())->getClient_subscription($jsondata );

            case 'deleteClientSubscription':
                return (new Client())->deleteClientSubscription($jsondata );

            case 'getExpiredClients':
                return (new Client())->getExpiredClients($jsondata );

            case 'getActiveClients':
                    return (new Client())->getActiveClients($jsondata );

            case 'getUnsubscribeClients':
                    return (new Client())->getUnsubscribeClients($jsondata );
            
            case 'getMostSubscribeProduct':
                    return (new Client())->getMostSubscribeProduct($jsondata );

            case 'getMostSubscribeClients':
                    return (new Client())->getMostSubscribeClients($jsondata );

            case 'clientAboutToExpired':
                    return (new Client())->clientAboutToExpired($jsondata );
                    
                    

            default:
                header('HTTP/1.1 401  Unauthorized Access');
                header("Status: 401 ");
                session_destroy();
                return array("return_code" => false, "return_data" => array("Page Key not found"));
        }
    }

    public static function Views($page)
    {

        $viewpath = "../app/modules/$page[0]/views/";

        switch ($page[1]) {

            case 'viewclient':
                load($viewpath . "viewclient.php");
                break;
            case 'clientsubscription':
                load($viewpath . "clientsubscription.php");
                break;
            case 'clientreport':
                load($viewpath . "clientReport.php");
                break;
            case 'invoice':
                    load($viewpath . "invoice.php");
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