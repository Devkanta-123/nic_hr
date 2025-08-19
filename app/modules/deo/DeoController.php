<?php

namespace app\modules\deo;

use app\core\Controller;
use app\modules\deo\classes\Deo;

class DeoController implements Controller
{
    /* 
    Current Version: 0.0.0
    Created By: Devkanta
    Created On: 01/08/2025
    Modified By:
    Modified On: 
*/

    public function Route($data)
    {
        $jsondata = $data["JSON"];

        switch ($data["Page_key"]) {

            case 'markAttendance':
                return (new Deo())->markAttendance($jsondata);

            case 'saveLedgerEntry':
                return (new Deo())->saveLedgerEntry($jsondata);

            case 'savePaySlipEntry':
                return (new Deo())->savePaySlipEntry($jsondata);

            case 'updatePaySlipStatus':
                return (new Deo())->updatePaySlipStatus($jsondata);


            case 'saveAdvanceAmount':
                return (new Deo())->saveAdvanceAmount($jsondata);


            case 'getAdvanceAmount':
                return (new Deo())->getAdvanceAmount();







            // case 'addFoodToCards':
            //     return (new Customer())->addFoodToCards($jsondata);

            default:
                header('HTTP/1.1 401  Unauthorized Access');
                header("Status: 401 ");
                session_destroy();
                return array("return_code" => false, "return_data" => array("Page Key not found"));
        }
    }


    static function Views($page)
    {

        $viewpath = "../app/modules/deo/views/";

        switch ($page[1]) {

            case 'attendance':
                load($viewpath . "attendance.php");
                break;

            case 'ledger':
                load($viewpath . "ledgerentry.php");
                break;

            case 'attendancereport':
                load($viewpath . "attendancereport.php");
                break;

            case 'payslipattendance':
                load($viewpath . "payslipattendance.php");
                break;


            case 'generatepayslip':
                load($viewpath . "generatepayslip.php");
                break;


            case 'advancepayment':
                load($viewpath . "advancepayment.php");
                break;

                
            case 'allowancemaster':
                load($viewpath . "allowancemaster.php");
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
