<?php
include '../app/database/DBController.php'; 
include '../app/modules/documents/classes/Documents.php'; 

use app\database\DBController;
use app\modules\documents\classes\Documents;
if(isset($_GET['id'])){
  DBController::logs($id);
  $id = $_GET['id'];
  DBController::logs($id);
     Documents::viewDocuments(array( 'DocumentEncryptedID' => $id ));
} 
else
{
    header("HTTP/1.0 404 Not Found"); 
    exit();
} 
?>