<?php

namespace app\modules\filemanager;

class FileController
{
    static function File()
    {
        $imagetypes = array("zeroindex", "jpeg", "jpg", "png", "svg", "tiff");
        $documenttypes = array("zeroindexdoc", "doc", "docx", "pdf", "html", "xls", "xlsx", "txt");

        $path = "../app/data/";
        $filetype = strtolower($_GET['type']);

        switch ($filetype) {


            case 'vendorrccfile':
                $file = $path . "vendorrccfile" . "/" . $_GET['name'];
                self::loadDocument($file);
                exit;

            case 'vendordriverlicence':
                $file = $path . "vendordriverlicence" . "/" . $_GET['name'];
                self::loadDocument($file);
                exit;


            case 'deliveryvehiclefile':
                $file = $path . "deliveryvehiclefile" . "/" . $_GET['name'];
                self::loadDocument($file);
                exit;

            case 'deliveryrccfile':
                $file = $path . "deliveryrccfile" . "/" . $_GET['name'];
                self::loadDocument($file);
                exit;

            case 'deliverydriverlicence':
                $file = $path . "deliverydriverlicence" . "/" . $_GET['name'];
                self::loadDocument($file);
                exit;


            case 'log':
                $file = "../log.txt";
                if (file_exists($file)) {
                    header('HTTP/1.0 200 OK');
                    header('Content-Type: text/plain');
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
            default:
                // session_destroy();
                include '404.php';
                header('HTTP/1.1 401  Unauthorized Access');
                header("Status: 401 ");
                break;
        }
    }

    static function loadDocument($file)
    {

        $imagetypes = array("zeroindex", "jpeg", "jpg", "png", "svg", "tiff");
        $documenttypes = array("zeroindexdoc", "doc", "docx", "pdf", "html", "xls", "xlsx", "txt");

        $path = "../app/data/";
        if (file_exists($file)) {
            header('HTTP/1.0 200 OK');
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            if (array_search($extension, $imagetypes) != false && array_search($extension, $imagetypes) >= 0) {
                header('Content-Type: image/' . strtolower(substr(strrchr(basename($file), "."), 1)));
            } else if (array_search($extension, $documenttypes) != false && array_search($extension, $documenttypes) >= 0) {
                if ($extension == "xlsx") {
                    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                } else if ($extension == "xls") {
                    header('Content-Type: application/vnd.ms-excel');
                } else header('Content-Type: application/' . strtolower(substr(strrchr(basename($file), "."), 1)));
            } else {
                header('Content-Type: ' . mime_content_type($file));
            }
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }
    }
}
