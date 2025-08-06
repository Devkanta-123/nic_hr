<?php

namespace app\modules\filemanager;

use app\database\DBController;
use app\misc\AES;
use app\misc\GenerateQR;
use app\misc\Sodium;
use app\misc\VideoStream;

class FileController
{

    static function File()
    {
        // $imagetypes = array("asdfe2esd","jpeg", "jpg", "png", "svg", "tiff");
        // $documenttypes=array("asfasdfdd","doc","docx","pdf","html","xls","xlsx","txt"); 

        $path = "../app/data/";
        $filetype = strtolower($_GET['type']);

      //  DBController::logs("File name in the controller".$_GET['name']);
        switch ($filetype) {

            case 'OfficeLogo':
                $file = $path . "OfficeLogo/" . $_GET['name'];
                if (file_exists($file)) {
                    header('HTTP/1.0 200 OK');
                    header('Content-Description: Image Transfer');
                    header('Content-Type: application/octet-stream');
                    header('Content-Disposition: attachment; filename="' . preg_replace("/\.[^.]+$/", "", basename($file)) . '"');
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
             
            case 'schoollogo':
            case 'SchoolLogo':
                $file = $path . "schoollogo/" . $_GET['name'];
                if (file_exists($file)) {
                    header('HTTP/1.0 200 OK');
                    header('Content-Description: Image Transfer');
                    header('Content-Type: application/octet-stream');
                    header('Content-Disposition: attachment; filename="' . preg_replace("/\.[^.]+$/", "", basename($file)) . '"');
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


         
                
            default:
                // session_destroy();
                include '404.php';
                header('HTTP/1.1 401  Unauthorized Access');
                header("Status: 401 ");
                break;
        }
    }
}
