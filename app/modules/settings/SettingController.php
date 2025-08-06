<?php

namespace app\modules\settings;

use app\core\Controller;
use app\modules\settings\classes\Calendar;
use app\modules\settings\classes\Caste;
use app\modules\settings\classes\Community;
use app\modules\settings\classes\Dashboard;
use app\modules\settings\classes\Designation;
use app\modules\settings\classes\District;
use app\modules\settings\classes\Gender;
use app\modules\settings\classes\Religion;
use app\modules\settings\classes\State;
use app\modules\settings\classes\Server;
use app\modules\settings\classes\Nationality;
use app\modules\settings\classes\Department;
use app\modules\settings\classes\Office;
use app\modules\settings\classes\Log;
use app\modules\settings\classes\Months;
use app\modules\settings\classes\City;
use app\modules\settings\classes\User;
use app\modules\settings\classes\Departures;
use app\modules\settings\classes\Warning;
use app\modules\settings\classes\Training;
use app\modules\settings\classes\Payroll;

class SettingController implements Controller
{
    /**
     * @param $data
     * @return array
     */
    function Route($data)
    {

        $jsondata = $data["JSON"];

        switch ($data["Page_key"]) {

            case "getNationality":
                return (new Nationality())->getNationality();

            case "getGender":
                return (new Gender())->getGender($jsondata);

            case "getReligion":
                return (new Religion())->getReligion($jsondata);

            case "getCaste":
                return (new Caste())->getCaste($jsondata);

            case "getCommunity":
                return (new Community())->getCommunity($jsondata);

            case "getDesignations":
                return (new Designation())->getDesignations();

            case 'getState':
                return (new State())->getState($jsondata);

            case 'addState':
                return (new State())->addstate($jsondata);

            case 'addServer':
                return (new Server())->addserver($jsondata);

            case 'createDomain':
                return (new Server())->createDomain($jsondata);

            case 'getServer':
                return (new Server())->getserver($jsondata);

            case 'getDistrict':
                return (new State())->getDistrict($jsondata);

            case 'getAllDistrict':
                return (new District())->getAllDistrict($jsondata);

            case 'getAllServer':
                return (new Server())->getAllServer($jsondata);

            case 'addDistrict':
                return (new District())->addDistrict($jsondata);

            case 'getAllvisitedUserInaDay':
                return (new Dashboard())->getAllvisitedUserInaDay($jsondata);

            case 'getPrayageduLinks':
                return (new State())->getPrayageduLinks($jsondata);

            case 'generatePrayageduLinks':
                return (new State())->generatePrayageduLinks($jsondata);

            case 'getTodayVisit':
                return (new State())->getTodayVisit();

            case 'deleteServer':
                return (new Server())->deleteServer($jsondata);

            case "getCalendarTextType":
                return (new Calendar())->getCalendarTextType($jsondata);

            case "getCompanyCalendar":
                return (new Calendar())->getCompanyCalendar($jsondata);

            case "addCalendar":
                return (new Calendar())->addCalendar($jsondata);

            case "deleteCalendar":
                return (new Calendar())->deleteCalendar($jsondata);

                //for office
            case "getAllOffice":
                return (new Office())->getAllOffice($jsondata);

            case "getOfficeByID":
                return (new Office())->getOfficeByID($jsondata);

                //for getting the lists of months
            case "getMonths":
                return (new Months())->getMonths($jsondata); //added by Devkanta on 02/02/2024

            case 'clearLog':
                return (new Log())->clearLog($jsondata);

            case "getAllDepartment":
                return (new Department())->getAllDepartment($jsondata);

            case "getallCity":
                return (new City())->getallCity($jsondata); //added by Devkanta on 13/02/2024

            case "getUsersList":
                return (new User())->getUsersList($jsondata);

            case "onUserResetPassword":
                return (new User())->onUserResetPassword($jsondata);

            case "changeActiveStatus":
                return (new User())->changeActiveStatus($jsondata);


            case "addDepartures":
                return (new Departures())->addDepartures($jsondata);


            case "getAllDepartures":
                return (new Departures())->getAllDepartures();


            case "addWarningTypes":
                return (new Warning())->addWarningTypes($jsondata); // added by Dev on 16/04/24

            case "getAllWarningTypes":
                return (new Warning())->getAllWarningTypes(); // added by Dev on 16/04/24

            case "editWarningType":
                return (new Warning())->editWarningType($jsondata); // added by Dev on 16/04/24

            case "addTrainingTypes":
                return (new Training())->addTrainingTypes($jsondata); // added by Dev on 16/04/24

            case "getAllTrainingTypes":
                return (new Training())->getAllTrainingTypes(); // added by Dev on 16/04/24


            case "editTrainingType":
                return (new Training())->editTrainingType($jsondata); // added by Dev on 16/04/24

            case "getSalaryHeadType":
                return (new  Payroll())->getSalaryHeadType(); // added by Dev on 25/04/24





            default:
                header('HTTP/1.1 401  Unauthorized Access');
                header("Status: 401 ");
                session_destroy();
                return array("return_code" => false, "return_data" => array("Page Key not found"));
        }
    }

    static function Views($page)
    {

        $viewpath = "../app/modules/settings/views/";

        switch ($page[1]) {

            case 'school':
                load($viewpath . "school.php");
                break;
            case 'state':
                load($viewpath . "state.php");
                break;
            case 'district':
                load($viewpath . "district.php");
                break;
            case 'selectserver':
                load($viewpath . "selectserver.php");
                break;
            case 'addserver':
                load($viewpath . "addserver.php");
                break;

            case 'prayagedulinks':
                load($viewpath . "prayagedulinks.php");
                break;

            case 'todayVisitList':
                load($viewpath . "todayVisitList.php");
                break;

            case 'support':
                load($viewpath . "changepassword.php");
                break;

            case 'managedepartment':
                load($viewpath . "managedepartment.php");  // added by dev on 05/11/23
                break;
            case 'calendar':
                load($viewpath . "calendar.php");
                break;

            case 'log':
                load($viewpath . "log.php");
                break;

            case "user":
                load($viewpath . "user.php");
                break;

            case "departures":
                load($viewpath . "departures.php");
                break;

            case "warning":
                load($viewpath . "warning.php");
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
