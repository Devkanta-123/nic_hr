<?php

namespace app\modules\settings\classes;

use app\database\DBController;
use app\misc\FCM;
use app\misc\SMS;

class Server
{


    function createDomain($data)  //added by dev on 25/10/23
    {
        $params = array(
            array(":ProductID", $data["ProductID"])
        );
        $query = "SELECT  `DBBasedSource`,FileSourceURL from `Products_Basedfiles`  WHERE `ProductID`=:ProductID AND isActive=1";
        $res = DBController::sendData($query, $params);
        if ($res) {
            $basedDBource = $res['DBBasedSource'];
            $basedURL = $res['FileSourceURL'];
        } else {
            return array("return_code" => false, "return_data" => "Could not  find base paths of DB and Source");
        }


        //get the domain name 
        $domain = $data["domain_name"];
        $post_data = array(
            'domain_name' =>  $domain,
            'db_base_url' =>  $basedDBource,
            'source_url' =>   $basedURL
        );
        // //prepare the url by appending /domainAction/createdomain.php
        $json = json_encode($post_data);
        $api_url = "https://" . $data["server"] . "/domainAction/createdomain.php";


        //make curl request and provide the data which is handled on the createdomain.php 
        // Data to send in the POST request



        // Initialize cURL session
        $ch = curl_init($api_url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($json)
        ));

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        } else {
            echo $response;
        }
        curl_close($ch);
    }



    function getServer($data)
    {
        $query = "SELECT ServerName,ServerDomainName,ServerID,IPAddress,Descriptions from `Settings_Server`;";
        $res = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $res);
    }

    function getAllServer($data)
    {
        $query = "SELECT `ServerDomainName`, `ServerName`,`ServerID`,`Descriptions`  FROM `Settings_Server`;";
        $res = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $res);
    }




    function addserver($data)
    {
        // Prepare array
        $params = array(
            array(":ServerName", $data["server_name"])
        );

        // Check if a server with the same ServerName exists
        $checkServerName = "SELECT count(*) as TotalServers FROM `Settings_Server` WHERE `ServerName` = :ServerName;";
        $count = DBController::sendData($checkServerName, $params);

        if ($count["TotalServers"] > 0) {
            return array("return_code" => false, "return_data" => "Server with the same name already exists");
        } else if (isset($data["ServerID"])) {
            // Prepare array
            $params = array(
                array(":ServerID", $data["ServerID"]),
                array(":ServerName", $data["server_name"]),
                array(":IPAddress", $data["ip_address"]),
                array(":ServerDomainName", $data["server_domain_name"]),
                array(":Descriptions", $data["descriptions"]),
            );
            $query = "UPDATE `Settings_Server` SET `ServerName`=:ServerName,`IPAddress`=:IPAddress,`ServerDomainName`=:ServerDomainName,`Descriptions`=:Descriptions  WHERE `ServerID`=:ServerID;";
            //$query = "UPDATE `settings_serv er` (`ServerName`, `IPAddress`, `ServerDomainName`, `Descriptions`, `EntryByID`) VALUES (:ServerName, :IPAddress, :ServerDomainName, :Descriptions, :UserID)";
            $res = DBController::ExecuteSQL($query, $params);
            if ($res) {
                return array("return_code" => true, "return_data" => "Updated  successfully");
            }
            return array("return_code" => false, "return_data" => "Error while updating");
        } else {

            $params = array(
                array(":ServerName", $data["server_name"]),
                array(":IPAddress", $data["ip_address"]),
                array(":ServerDomainName", $data["server_domain_name"]),
                array(":Descriptions", $data["descriptions"]),
                array(":UserID", $_SESSION['UserID']),
            );
            $query = "INSERT INTO `Settings_Server` (`ServerName`, `IPAddress`, `ServerDomainName`, `Descriptions`, `EntryByID`) VALUES (:ServerName, :IPAddress, :ServerDomainName, :Descriptions, :UserID)";
            $res = DBController::ExecuteSQL($query, $params);
        }


        if ($res) {
            return array("return_code" => true, "return_data" => "Server added successfully");
        }
        return array("return_code" => false, "return_data" => "Error while saving the Server");
    }

    function deleteServer($data)
    {
        $params = array(
            array(":ServerID", $data["ServerID"]),
        );
        $query = "DELETE FROM `Settings_Server` WHERE `ServerID`=:ServerID;";
        $res = DBController::ExecuteSQL($query, $params);
        return array("retrun_code" => true, "return_data" => "Sucessfully Removed the Server");
    }
}
