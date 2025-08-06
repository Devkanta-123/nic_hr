<?php

/**
 *  Current Version: 1.0.0
 *  Created By: Angelbert,  prayagedu@techz.in
 *  Created On: 2-02-2024
 *  Modified By:
 *  Modified On:
 */

namespace app\modules\administration;

use app\core\Controller;
use app\modules\administration\classes\Notice;
use app\modules\administration\classes\Letter;

class AdministrationController implements Controller
{
    function Route($data)
    {

        $jsondata = $data["JSON"];
        switch ($data["Page_key"]) {

                //notices
            case 'getNotices':
                return (new Notice())->getNotices($jsondata);
            case 'addNotice':
                return (new Notice())->addNotice($jsondata);
            case "deleteNotice":
                return (new Notice())->deleteNotice($jsondata);
            case 'getNoticeDetails':
                return (new Notice())->getNoticeDetails($jsondata);
            case "getseenNotice":
                return (new Notice())->getseenNotice($jsondata);
            case 'getArcheiveNotice':
                return (new Notice())->getArcheiveNotice($jsondata);

            case 'getNoticesForApp':
                return (new Notice())->getNoticesForApp($jsondata);
            case 'addLetter':
                return (new Letter())->addLetter($jsondata);

            case 'addLetterType':
                return (new Letter())->addLetterType($jsondata);

            case 'getAllLetterType':
                return (new Letter())->getAllLetterType();

            case 'getAllActiveLetters':
                return (new Letter())->getAllActiveLetters();

            case 'getAllArchivedLetters':
                return (new Letter())->getAllArchivedLetters();

            case 'archieveLetter':
                return (new Letter())->archieveLetter($jsondata);

            case 'getAllLetters':
                return (new Letter())->getAllLetters();





            default:
                header('HTTP/1.1 401  Unauthorized Access');
                header("Status: 401 ");
                //session_destroy();
                return array("return_code" => false, "return_data" => array("Page Key not found"));
        }
    }

    static function Views($page)
    {
        $viewpath = "../app/modules/administration/views/";

        switch ($page[1]) {

            case 'notice':
                load($viewpath . "notice.php");
                break;

            case 'archeivenotice':
                load($viewpath . "archeivenotice.php");
                break;


            case 'letter':
                load($viewpath . "letter.php");
                break;

            case 'letterlists':
                load($viewpath . "letterlists.php");
                break;


                /* Custom Reports section ends here */
            default:
                // session_destroy();
                include '404.php';
                header('HTTP/1.1 401  Unauthorized Access');
                header("Status: 401 ");
                break;
        }
    }
}
