<?php
ob_start();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
//error_reporting(E_ALL);
ini_set('session.save_path', realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '../app/data/session'));

//ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/www/app.techz.in/app/data/session'));
//session_id(md5(getenv('HTTP_CLIENT_IP') ?: getenv('HTTP_X_FORWARDED_FOR') ?: getenv('HTTP_X_FORWARDED') ?: getenv('HTTP_FORWARDED_FOR') ?: getenv('HTTP_FORWARDED') ?: getenv('REMOTE_ADDR')));
session_start();
header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Origin:  https://vta.techz.in:443');

header("Accept: text/html; charset=UTF-8");
header("Content-type: text/html; charset=UTF-8");
header('Cache-Control: max-age=86400');
header('HTTP/2 200 Success');
header("Status: 200");
header("Server: MAC_OS_X");
header("Developer: NIC HRPrivate Limited");
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
} elseif (isset($_SESSION["UserType"]) && $_SESSION["UserType"] == 4) {
    define("VIEWPATH", "../app/views/deo");
} elseif (isset($_SESSION["UserType"]) && $_SESSION["UserType"] == 2) {
    define("VIEWPATH", "../app/views/staff");
} else {
    define("VIEWPATH", "../app/views");
}

$data = json_decode(file_get_contents("php://input"), true);
parse_str($_SERVER["QUERY_STRING"], $query_array);

require_once("../vendor/autoload.php");

use app\modules\auth\AuthenticationController;
use app\misc\MSC;
use app\database\DBController;
use app\modules\filemanager\FileController;
use app\modules\vendor\VendorController;
use app\modules\delivery\DeliveryController;
use app\modules\customer\CustomerController;
use app\modules\deo\DeoController;
use app\modules\location\LocationController;

if (!isset($data["JSON"])) {
    $data["JSON"] = "";
}
if (!isset($data["Page_key"])) {
    $data["Page_key"] = "";
}

// DBController::logs(json_encode($_SERVER));

// IPLogger::logIP($data);

if (isset($data["Module"]) && isset($data["Page_key"]) && isset($data["JSON"])) {

    header('HTTP/1.1 200 Success');
    header("Status: 200");

    $result = array("return_code" => false);

    $msc = MSC::getMSC();

    if (AuthenticationController::isValidSession($data)) {
        switch ($data["Module"]) {

            case "file":
                FileController::File();
                break;
            case "Auth":
                $result = (new AuthenticationController())->Route($data);
                break;

            case "Employee":
                $result = (new VendorController())->Route($data);
                break;

            case "Work":
                $result = (new DeliveryController())->Route($data);
                break;

            case "Customer":
                $result = (new CustomerController())->Route($data);
                break;

            case "Deo":
                $result = (new DeoController())->Route($data);
                break;


            case "Location":
                $result = (new LocationController())->Route($data);
                break;


            default:
                $result = array("return_code" => false, "return_data" => array("Module key not found"));
                session_destroy();
                header('HTTP/1.1 401  Unauthorized Access');
                header("Status: 401 ");
                break;
        }

        $result['Module'] = $data["Module"];
        $result['Page_key'] = $data["Page_key"];
    } else {

        switch ($data["Module"]) {

            case "file":
                FileController::File();
                break;

            case "Auth":
                $result = (new AuthenticationController())->Route($data);
                break;

            case "Employee":
                $result = (new VendorController())->Route($data);
                break;

            case "Work":
                $result = (new DeliveryController())->Route($data);
                break;

            case "Customer":
                $result = (new CustomerController())->Route($data);
                break;


            case "Deo":
                $result = (new DeoController())->Route($data);
                break;



            case "Location":
                $result = (new LocationController())->Route($data);
                break;



            default:
                //$result = (new ProductsController())->Route($data);
                $result = array("return_code" => false, "return_data" => array("Key not found"));

                // $result = (new AuthenticationController)->Route($data);
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

    load(VIEWPATH . "/template.php");

    $template = ob_get_clean();
    # Replacement
    ob_start();


    switch ($page[0]) {

        case "":
        case "dashboard":
            load(VIEWPATH . "/dashboard.php");
            break;
        case "deodash":
            load(VIEWPATH . "/deo.php");
            break;

        case "changepassword":
            load(VIEWPATH . "/changepassword.php");
            break;

        case "auth":
            AuthenticationController::Views($page);
            break;


        case "employee":
            VendorController::Views($page);
            break;

        case "work":
            DeliveryController::Views($page);
            break;
        case "customer":
            CustomerController::Views($page);
            break;

        case "deo":
            DeoController::Views($page);
            break;
        case "location":
            LocationController::Views($page);
            break;



        case "file":
            FileController::File();
            break;

        case "logout":
            session_destroy();
            header('Location: login');
            ob_end_flush();
            exit;
            break;

        default:
            header("Content-type: */*;");
            header('HTTP/2 404 Not Found'); //This may be put inside 404.php instead
            $_GET['e'] = 404; //Set the variable for the error code (you cannot have a querystring in an include directive).
            include '404.php';
    }

    $replacement = ob_get_clean();
    $res = str_replace('{{content}}', $replacement, $template);
    echo $res;
} else if (AuthenticationController::isValidSession($data)) {

    if ($_SESSION["UserType"] == 1) {
        header('Location: dashboard');
        ob_end_flush();
        /* Make sure that code below does not get executed when we redirect. */
        exit;
    } else if ($_SESSION["UserType"] == 4) { //DEO
        header('Location: deo');
        ob_end_flush();
        /* Make sure that code below does not get executed when we redirect. */
        exit;
    } else {
        header('Location: home');
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

        switch ($query_array['path']) {

            case "":
                header('Location: test.php');
                exit;
            case "login":
                load(VIEWPATH . "/login.php");
                break;

            case "vendor":
                load(VIEWPATH . "/vendorregister.php");
                break;


            case "work":
                load(VIEWPATH . "/deliveryregister.php");
                break;
            case "test123":
                load(VIEWPATH . "/test.php");
                break;

            case "file":
                FileController::File();
                break;



            case "website-home":
                load(VIEWPATH . "/website/home/home.php");
                break;

            case "logout":
                session_destroy();
                header('Location: login');
                exit;

            default:
                header("Content-type: text/html;");
                header('HTTP/2 404 Not Found'); //This may be put inside 404.php instead
                include '404.php';
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
        echo "Message : " . $e->getMessage();
        echo "Code : " . $e->getCode();
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

    $errormessage = "";

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
