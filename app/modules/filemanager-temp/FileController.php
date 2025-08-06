<?php
namespace app\modules\filemanager;

use app\misc\AES;
use app\misc\GenerateQR;
use app\misc\Sodium;
use app\misc\VideoStream;

class FileController
{

    static function File()
    {

        $path = "../app/data/";

        switch ($_GET['type']) {

            case 'image':
                $file = $path . "images/" . $_GET['name'];

                if (file_exists($file)) {
                    header('HTTP/1.0 200 OK');
                    header('Content-Description: Image Transfer');
                    header('Content-Type: image/'.strtolower(substr(strrchr(basename($file),"."),1)));
                    // header('Content-Disposition: attachment; filename="' . preg_replace("/\.[^.]+$/", "", basename($file)) . '"');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($file));
                    readfile($file);
                    exit;
                } else {
                    header("HTTP/1.0 404 Not Found");
                    exit;
                }
                break;
            case 'video':
                
                $file = $path ."videos/" . $_GET['name'];

                if (file_exists($file)) {
                    header('HTTP/1.0 200 OK');
                    $stream = new VideoStream($file);
                    $stream->start();
                    exit;
                } else {
                    header("HTTP/1.0 404 Not Found");
                    // include '404.html';
                }
                break;
            case 'document':
                
                $file = $path . "documents/" . $_GET['name'];

                if (file_exists($file)) {
                    header('HTTP/1.0 200 OK');
                    header('Content-Description: Image Transfer');
                    header('Content-Type: application/'.strtolower(substr(strrchr(basename($file),"."),1)));
                    // header('Content-Disposition: attachment; filename="' . preg_replace("/\.[^.]+$/", "", basename($file)) . '"');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($file));
                    readfile($file);
                    exit;
                } else {
                    header("HTTP/1.0 404 Not Found");
                }
                break;
                
            case 'html':
                
                $file = $path . "pages/" . $_GET['name'];

                if (file_exists($file)) {
                    header('HTTP/1.0 200 OK');
                    header('Content-Type: text/'.strtolower(substr(strrchr(basename($file),"."),1)));
                    // header('Content-Disposition: attachment; filename="' . preg_replace("/\.[^.]+$/", "", basename($file)) . '"');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($file));
                    readfile($file);
                    exit;
                } else {
                    header("HTTP/1.0 404 Not Found");
                }
                break;
            case 'certificate':
                $file = $path . "certificate/" . $_GET['name'];

                if (file_exists($file)) {
                    header('HTTP/1.0 200 OK');
                    header('Content-Description: Image Transfer');
                    header('Content-Type: application/'.strtolower(substr(strrchr(basename($file),"."),1)));
                    // header('Content-Disposition: attachment; filename="' . preg_replace("/\.[^.]+$/", "", basename($file)) . '"');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($file));
                    readfile($file);
                    exit;
                } else {
                    header("HTTP/1.0 404 Not Found");
                }
                break;
            case 'answerqr':

//                $qrdata = json_decode(Sodium::safeDecrypt("CyOMPwKsPQuReqaGKM7cJrlcbcH3uGfBBXADTUINEgON1BHrGkgvRN82cHmXzU9t5aiMQfsUdj87O3UkpoWIeHqCA1QBwgUiHOiE1zLIV8N9/GB1aLnTrjmKWw01yLto7Qy2j73FnWi3HEM5haRb1SGDy5fdatOEShs5ieIKHtpCkR/FTeoy xpjVLsZmOuFf0985CrZPOgIm40vNRgr N5rLgyO5YZpcVofZOb3UDGyKnUDrwrJ5gecfYN54txR0R7WInqCSLGDuuZK2430V4RSISAI 2SrRRXz5gs98IcNaGN6JhSBCQES/RyJdd10aFRh6 YmDgg7d/L D3OLlKhfJOwueGUdWi0067xilBsy98fAiCw="));

                header('Content-Type: image/png');

                $qrdata = json_encode(
                    [
                        "ExaminationAllotmentID"=>$_GET['ExaminationAllotmentID'],
                        "AssessmentDetailsID"=>$_GET['AssessmentDetailsID'],
                        "UserID"=>$_SESSION['UserID'],
                        "SessionKey"=>$_SESSION['SessionKey'],
                        "CreationDate"=>AES::encrypt(date("Y-m-d H:i:s"))
                    ]
                );
                $qrdata=AES::encrypt($qrdata);

                $link = pathinfo((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);

                $qrdata=urlencode($qrdata);

                $url= $link["dirname"]."/uploadanswer?question=".$qrdata;

//                $qrdata=AES::decrypt(urldecode($qrdata));


                GenerateQR::get($url, 500);
                exit;
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
