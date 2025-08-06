<?php

namespace app\modules\marketings;

use app\modules\marketings\classes\Marketing;
use app\modules\marketings\classes\Report;
use app\core\Controller;

class MarketingController implements Controller
{

    public function Route($data)
    {
        $jsondata = $data["JSON"];

        switch ($data["Page_key"]) {
            case 'AddMarketingClients':
                return (new Marketing())->AddMarketingClients($jsondata);

            case 'AddRawLeads':
                return (new Marketing())->AddRawLeads($jsondata);  //added by Devkanta on 27/02/2024

            case 'getAllMarketingClients':
                return (new Marketing())->getAllMarketingClients();

            case 'getAllMarketingRawLeads':
                return (new Marketing())->getAllMarketingRawLeads(); //added by Devkanta on 27/02/2024

            case "getMarketingClientStatusbyID":
                return (new Marketing())->getMarketingClientStatusbyID($jsondata);

            case "getAllMarketingStatus":
                return (new Marketing())->getAllMarketingStatus($jsondata);

            case "addMarketingFeedback":
                return (new Marketing())->addMarketingFeedback($jsondata);

            case "getMarketingStatusFeedbackByID":
                return (new Marketing())->getMarketingStatusFeedbackByID($jsondata);

            case "getMarketingClientInfo":
                return (new Marketing())->getMarketingClientInfo($jsondata);

            case "AddAllMarketingClients":
                return (new Marketing())->AddAllMarketingClients($jsondata);

            case "getMarketingStatusandTotalNumber":
                return (new Report())->getMarketingStatusandTotalNumber();

            case "getClientBasedOnStatusID":
                return (new Report())->getClientBasedOnStatusID($jsondata);

            case "getAllMarketingStatusesForChart":
                return (new Report())->getAllMarketingStatusesForChart($jsondata);

            case "getAllTodaystask":
                return (new Report())->getAllTodaystask($jsondata);

            case "getTaskFor7daybefore":
                return (new Report())->getTaskFor7daybefore($jsondata);

            case "UpdateMarketingClient":
                return (new Marketing())->UpdateMarketingClient($jsondata);

            case "uploadLogo":
                return (new Marketing())->uploadLogo($jsondata);



            case "getallCloseDeal":
                return (new Report())->getallCloseDeal();


            case "addWhatsappCampaign":
                return (new Marketing())->addWhatsappCampaign($jsondata);


            case "getAllWhatsappCampaign":
                return (new Marketing())->getAllWhatsappCampaign();

            case "changeactivestatus":
                return (new Marketing())->changeactivestatus($jsondata);


                case "getAllContactsByCampaignID":
                    return (new Marketing())->getAllContactsByCampaignID($jsondata);

            // case "getAllActiveWhatsappCampaign":
            //     return (new Marketing())->getAllActiveWhatsappCampaign(); //API call 

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

            case 'clients':
                load($viewpath . "clients.php");
                break;

            case 'leads':
                load($viewpath . "leads.php");
                break;

            case "status":
                load($viewpath . "status.php");
                break;
            case "report":
                load($viewpath . "report.php");
                break;

            case "temp":
                load($viewpath . "temp.php");
                break;

            case "whatappscampaign":
                load($viewpath . "whatappscampaign.php");
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
