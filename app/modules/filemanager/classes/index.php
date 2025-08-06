
<?php
ob_start();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../app/data/session'));
// session_id(md5(getenv('HTTP_CLIENT_IP') ?: getenv('HTTP_X_FORWARDED_FOR') ?: getenv('HTTP_X_FORWARDED') ?: getenv('HTTP_FORWARDED_FOR') ?: getenv('HTTP_FORWARDED') ?: getenv('REMOTE_ADDR')));
session_start();
header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Origin:  https://salps.prayagedu.com:443');

header("Accept: text/html; charset=UTF-8");
header("Content-type: text/html; charset=UTF-8");

header('Cache-Control: max-age=86400');
header('HTTP/2 200 Success');
header("Status: 200");
header("Server: Windows Server 19");
header("X-Powered-By: Python");
header("Company: NIC HRPrivate LImited");
date_default_timezone_set('Asia/Kolkata');

// set to the user defined error handler
$old_error_handler = set_error_handler("myErrorHandler");

if (isset($_SERVER["HTTP_COOKIE"])) {
    header("HTTP_COOKIE: " . $_SERVER["HTTP_COOKIE"]);
}
if (isset($_SERVER["Cookie"])) {
    header("Cookie: " . $_SERVER["Cookie"]);
}

if (isset($_SESSION["UserType"]) && $_SESSION["UserType"] == 1) {
    define("VIEWPATH", "../app/views/admin");
}elseif (isset($_SESSION["UserType"]) && $_SESSION["UserType"] == 2) {
    define("VIEWPATH", "../app/views/staff");
}elseif (isset($_SESSION["UserType"]) && $_SESSION["UserType"] == 3) {
    define("VIEWPATH", "../app/views/parent");
}elseif (isset($_SESSION["UserType"]) && $_SESSION["UserType"] == 4) {
    define("VIEWPATH", "../app/views/admission");
} else {
    define("VIEWPATH", "../app/views");
}

$data = json_decode(file_get_contents("php://input"), true);
parse_str($_SERVER["QUERY_STRING"], $query_array);

require_once("../vendor/autoload.php");

use app\modules\academics\AcademicsController;
use app\modules\admission\AdmissionController;
use app\modules\assessment\AssessmentController;
use app\modules\attendance\AttendanceController;
use app\modules\auth\AuthenticationController;
use app\misc\MSC;
use app\misc\IPLogger;
use app\database\DBController;
use app\modules\auth\classes\Password;
use app\modules\auth\classes\Session;
use app\modules\elearning\ELearningController;
use app\modules\examination\classes\ExaminationAllotment;
use app\modules\examination\ExaminationController;
use app\modules\filemanager\FileController;
use app\modules\grievance\GrievanceController;
use app\modules\notice\NoticeController;
use app\modules\settings\SettingController;
use app\modules\student\StudentController;
use app\modules\staff\StaffController;
use app\modules\fee\FeeController;
use app\modules\payment\PaymentController;
use app\modules\meeting\MeetingController;
use app\modules\notification\NotificationController;
use app\modules\report\ReportController;
use app\modules\administration\AdministrationController;
use app\modules\administration\PublicAccessController; 
use app\modules\attendance\classes\Attendance;
use app\database\MDBController;

if (!isset($data["JSON"])) {
    $data["JSON"] = [];
} 
 if (!isset($data["Page_key"])) {
    $data["Page_key"] = "";
}


//IPLogger::logIP($data);

 if (isset($data["Module"]) && isset($data["Page_key"]) && isset($data["JSON"]) ) {  //&& isset($data["MSC"])
     // foreach (getallheaders() as $name => $value) { 
    //     DBController::logs( "$name: $value\n"); 
    // }

//    header('HTTP/1.1 200 Success');
//    header("Status: 200");

    if (!isset($_SERVER["HTTP_MSC"]) && !isset($data["MSC"])) {
        DBController::logs("Secret Key Missing.");
        echo json_encode(  array("return_code" => false, "return_data" => "Secret Key missing"));
        exit();
    }
    $msctoken= isset($_SERVER["HTTP_MSC"]) ?  $_SERVER["HTTP_MSC"]  : $data["MSC"];

    $result = array("return_code" => false);
       $msc = MSC::getMSC();
    if (!(MSC::isValidMSC( $msctoken))) {
        $result = array("return_code" => false, "return_data" => array("Invalid Request MSC"));
        header('HTTP/1.1 403 Forbidden');
        header("Status: 403");
        echo json_encode($result);
        exit();
    }

    if (AuthenticationController::isValidSession($data)) {
        switch ($data["Module"]) {
            case "Settings":
                $result = (new SettingController())->Route($data);
                break;
            case "Auth":
                $result = (new AuthenticationController())->Route($data);
                break;
            case "Academics":
                $result = (new AcademicsController())->Route($data);
                break;

            case "Attendance":
                $result = (new AttendanceController())->Route($data);
                break;

            case "Notice":
                $result = (new NoticeController())->Route($data);
                break;

            case "Student":
                $result = (new StudentController())->Route($data);
                break;

            case "Staff":
                $result = (new StaffController())->Route($data);
                break;

            case "Assessment":
                $result = (new AssessmentController())->Route($data);
                break;

            case "ELearning":
                $result = (new ELearningController())->Route($data);
                break;

            case "Examination":
                $result = (new ExaminationController())->Route($data);
                break;

            case "Grievance":
                $result = (new GrievanceController())->Route($data);
                break;

            case "Admission":
                $result = (new AdmissionController())->Route($data);
                break;

            case "Auth":
                $result = (new AuthenticationController())->Route($data);
                break;
            case "Payment":
                $result = (new PaymentController())->Route($data);
                break;
            case "Fee":
                $result = (new FeeController())->Route($data);
                break;
            case "Meeting":
                $result = (new MeetingController())->Route($data);
                break;

            case "Notification":
                $result = (new NotificationController())->Route($data);
                break;

            case "Report":
                $result = (new ReportController())->Route($data);
                break;
          case "Administration":
                $result = (new AdministrationController())->Route($data);
                break;
                
            default:
                $result = array("return_code" => false, "return_data" => "Module key not found");
                session_destroy();
                header('HTTP/1.1 401  Unauthorized Access');
                header("Status: 401 ");
                break;
        }

        $result['Module'] = $data["Module"];
        $result['Page_key'] = $data["Page_key"];
    } else { //not a valid session

        //for public APIs 
        switch ($data["Module"]) {

            case "Auth":
                $result = (new AuthenticationController())->Route($data);
                break;
            case "PublicAccess":
                $result = (new PublicAccessController())->Route($data);
                break; 
            case "Admission":
                $result = (new AdmissionController())->Route($data);
                break;
            case "Attendance":
                $result = (new AttendanceController())->Route($data);
                break;
            case "getPublicUploadQuestion":
                $result = (new ExaminationAllotment())->getPublicUploadQuestion($data["JSON"]);
                break;
            case "submitAnswerDoc":
                $result = (new ExaminationAllotment())->submitAnswerDoc($data["JSON"]);
                break; 
            case "Attendance":
                $result = (new AttendanceController())->route($data);
                break;     
            default:
                $result =   array("return_code" => false, "return_data" => "Unauthorized Access for the requested data","isLoginRequired"=>true);
                break;
        }

        $result['Module'] = $data["Module"];
        $result['Page_key'] = $data["Page_key"];
    }

    DBController::CloseDB(); 
      echo json_encode($result);
    exit();
} else if (isset($query_array['path']) && AuthenticationController::isValidSession($data)) {
    // pages 
    $page = explode("-", $query_array["path"]);
    MDBController::save_history($query_array["path"], null, 2);

    // to work out with the reports.
    if(count($page)>=3 && $page[2]=="rpt" ){
        echo "{{content}}";
    }else
    {
        load(VIEWPATH . "/template.php");

    }
  

     $template = ob_get_clean();

    # Replacement
    ob_start();

    switch ($page[0]) {
            //check if he access or not
        case "":

            if(isset($_SESSION["UserTypeID"])  && $_SESSION["UserTypeID"]==1)
                load(VIEWPATH . "/dashboard.php");
            else
                load(VIEWPATH . "/home.php");
            break;
        case "dashboard":
            load(VIEWPATH . "/dashboard.php");
        break;

        case "home":
             load(VIEWPATH . "/home.php");
             //load("../app/modules/student/views/userprofile.php");
             break;

        //even if valid session but requested login : clear all sessions and forward to login page
        case "login":
            session_destroy();
            header("location: login",  true,  301 );
            echo "<script type='text/javascript'>window.top.location='login';</script>"; exit;
            ob_end_flush();
            break;
        case "student":
            StudentController::Views($page);
            break;

        case "staff":
            StaffController::Views($page);
            break;

        case "notice":
            NoticeController::Views($page);
            break;

        case "assessment":
            AssessmentController::Views($page);
            break;

        case "admission":
            AdmissionController::Views($page);
            break;

        case "attendance":
            AttendanceController::Views($page);
            break;

        case "academics":
            AcademicsController::Views($page);
            break;

        case "elearning":
            ELearningController::Views($page);
            break;

        case "examination":
            ExaminationController::Views($page);
            break;

        case "file":
            FileController::File();
            break;

        case "grievance":
            GrievanceController::Views($page);
            break;

            //For Fees
        case "fee":
            FeeController::Views($page);
            break;

        case "payment":
            PaymentController::Views($page);
            break;
        case "settings":
            SettingController::Views($page);
            break;
        case "meeting":
            MeetingController::Views($page);
            break;
        case "changepassword":
            load("../app/views/admin/changepassword.php");
            break;
        case "report":
                ReportController::Views($page);
                break;
        case "notification":
                NotificationController::Views($page);
                break;
        case "administration":
            AdministrationController::Views($page);
             break;
        case "logout":
            @(new Session())->revoke([]);
            session_destroy();
            header('Location: login');
            echo "<script type='text/javascript'>window.top.location='login';</script>";
             ob_end_flush();
            exit;
            break;

        default:
            //load the default page
            if( isset($_SESSION["UserTypeID"]) && $_SESSION["UserTypeID"]==1)
                load(VIEWPATH . "/dashboard.php");
            else
                load(VIEWPATH . "/home.php");

//            if ($_SESSION["UserType"] == 1) {
//                header('Location: dashboard',  true,  301);
//                 echo "<script type='text/javascript'>window.top.location='dashboard';</script>";
//                ob_end_flush();
//                /* Make sure that code below does not get executed when we redirect. */
//                exit;
//            } else {
//               // header('Location: home',  true,  301);
//               // echo "<script type='text/javascript'>window.top.location='home';</script>";
//                exit;
//            }
//            header("Content-type: */*;");
//            header('HTTP/2 404 Not Found'); //This may be put inside 404.php instead
//            $_GET['e'] = 404; //Set the variable for the error code (you cannot have a querystring in an include directive).
//            include '404.php';
    }

    $replacement = ob_get_clean();
    $res = str_replace('{{content}}', $replacement, $template);
    echo $res;
} else if (AuthenticationController::isValidSession($data)) {
     if ($_SESSION["UserType"] == 1) {
        header('Location: dashboard',  true,  301);
        echo "<script type='text/javascript'>window.top.location='dashboard';</script>";
        ob_end_flush();
        /* Make sure that code below does not get executed when we redirect. */
        exit;
    } else {
        header('Location: home',  true,  301);
        echo "<script type='text/javascript'>window.top.location='home';</script>";
        exit;
    }
} else if (isset($query_array['path'])) {
    publicRequest($query_array);
} else {

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

        header("Content-type: */*;");
        header('HTTP/1.1 404 Not Found'); //This may be put inside 404.php instead
        echo json_encode(array("ERROR" => 404));
    } else {
    	ob_get_clean();
   //     ob_end_flush();
        header("Content-type: text/html;");
        header('Location: login');
    	echo "<script>window.location.href = '/login'</script>";
        exit;
    }
} //Do not do any more work in this script.

function publicRequest($query_array)
{
    try {
        $link = pathinfo((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
        $pathsvalues="";
        if(strpos($query_array['path'],"-")>0){
            $pathsvalues=explode("-",$query_array['path']); 
            $query_array['path']= $pathsvalues[0];
        }
        switch ($query_array['path']) {
            case "applogin":
                load("../app/views/applogin.php");
                exit;
            case "passwordreset":
                load("../app/views/passwordreset.php");
                exit;

            case "":
                load(VIEWPATH . "/login.php");
                exit;
            case "login":
                load(VIEWPATH . "/login.php");
                break;
            case "admissionfee":
                load(VIEWPATH . "/admissionfee.php");
                break;

            case "admission":
                load(VIEWPATH . "/admission.php");
                break;
            case "file":
                FileController::File();
                break;
            case "GetOTP": //TO check its mistake TODO
                $result = (new AuthenticationController())->Route([["Page_key","GetOTP"],["JSON","{}"]]);
                break;
            case 'uploadanswer':
                load("../app/modules/examination/views/uploadanswer.php");
                break;
            case 'viewnotice':
                $_SESSION["PublicNoticeID"]= base64_encode($pathsvalues[1]);
                load(VIEWPATH . "/viewnotice.php");
            case 'idcard':
                $_SESSION["IDCardClassSectionID"]= base64_encode($pathsvalues[1]);
                load(VIEWPATH . "/idcard.php");
                break;
            case "logout":
                session_destroy();
                header('Location: login');
                echo "<script type='text/javascript'>window.top.location='login';</script>";
                exit;
//            case "jgjg/ghfhgf/login":
//                 print_r("Hello Work");
//                exit;
            default:
              
               $path=$link["dirname"]."/login";
              // header('Location: login');
               echo "<script type='text/javascript'>window.top.location='$path';</script>";
               header("Content-type: text/html;");
               header('HTTP/2 404 Not Found'); //This may be put inside 404.php instead
              // include '404.php';
        }
    } catch (Exception $e) {
        include '../500.php';
        exit;
    }
}

function load($path)
{
    try {
        if (!@include_once($path)) // @ - to suppress warnings, 
            // you can also use error_reporting function for the same purpose which may be a better option
            throw new Exception($path . ' does not exist');
        // or 
        if (!file_exists($path))
            throw new Exception($path . ' does not exist');
        else
            require_once($path);
    } catch (Exception $e) {
        // echo "Message : " . $e->getMessage();
        // echo "Code : " . $e->getCode();
        include '404.php';
    }
}

// error handler function
function myErrorHandler($errno, $errstr, $errfile, $errline)
{
    if (!(error_reporting() & $errno)) {
        // This error code is not included in error_reporting, so let it fall
        // through to the standard PHP error handler
        return false;
    }

    // $errstr may need to be escaped:
    $errstr = htmlspecialchars($errstr);

    $errormessage="";

    switch ($errno) {
        case E_USER_ERROR:
            $errormessage .= "<b>My ERROR</b> [$errno] $errstr\n";
            $errormessage .=  "  Fatal error on line $errline in file $errfile\n";
            $errormessage .=  "Aborting...<br />\n";
            DBController::logs($errormessage);
            exit(1);

        case E_USER_WARNING:
            $errormessage .=  "<b>My WARNING</b> [$errno] $errstr<br />\n";
            $errormessage .=  "  Fatal error on line $errline in file $errfile\n";
            $errormessage .=  "Aborting...<br />\n";
            break;

        case E_USER_NOTICE:
            $errormessage .=  "<b>My NOTICE</b> [$errno] $errstr<br />\n";
            $errormessage .=  "  Fatal error on line $errline in file $errfile\n";
            $errormessage .=  "Aborting...<br />\n";
            break;
        case E_ERROR:
            $errormessage .=  "<b>File missing</b> [$errno] $errstr<br />\n";
            $errormessage .=  "  Fatal error on line $errline in file $errfile\n";
            $errormessage .=  "Aborting...<br />\n";
            break;

        default:
            $errormessage .=  "Unknown error type: [$errno] $errstr<br />\n";
            $errormessage .=  "  Fatal error on line $errline in file $errfile\n";
            $errormessage .=  "Aborting...<br />\n";
            DBController::logs($errormessage);
            exit(1);
            break;
    }

    DBController::logs($errormessage);
    /* Don't execute PHP internal error handler */
    return true;
}

