<?php

namespace app\modules\settings\classes;

use app\database\DBController;
use app\misc\FCM;
use app\misc\SMS;
 
class State
{ 
    function getState($data) {
        $query = "SELECT StateID,StateName from Settings_State;"; 
        $res = DBController::getDataSet($query); 
        return array("return_code" => true, "return_data" => $res);
    }

    function getDistrict($data) {
        
        $params=array(
            array(":StateID",$data["StateID"])
         );

        $query = "SELECT DistrictID, DistrictName FROM Settings_Districts where StateID=:StateID ;"; 
        $res = DBController::getDataSet($query,$params); 
        return array("return_code" => true, "return_data" => $res);
    }
    
    function addstate($data){

        //prepare array 
        $params=array(
            //array(":StateID",$data["StateID"]),
            array(":StateName",$data["StateName"]),
        );
        //save the product
        $query="INSERT INTO `Settings_State`( `StateName`) VALUES (:StateName); ";
        $res=DBController::ExecuteSQL($query,$params);
         if($res){
            return array("return_code" => true, "return_data"=>"States added successfully");  
         }
         return array("return_code" => false, "return_data" => " Error while saving the product");  

    }  
    
    //generate links for prayagedu
    
    function generatePrayageduLinks()
    {
        $filename = '../app/data/city_state.json';
        $data = file_get_contents($filename); //data read from json file
        // print_r($data);
        $states = json_decode($data,true);
        //    foreach($states as $state)
       foreach($states as $key => $val)
       {
       
            $stateName=$key;
            //check if StateName is Available
        
            foreach($val as $cityName)
            {
                //check if that state & city is there or not if yes do not add if no then add
                $param=array(
                    array(":Statename",trim($stateName)),
                    array(":CityName",trim($cityName)),
                );

                $sq="SELECT * FROM `Prayagedu_Links` WHERE  lower(StateName)=lower(:StateName)  and lower(CityName)=lower(:CityName) LIMIT 1;";
                $res=DBController::sendData($sq,$param);
                if(!$res)
                {
                        //add new 
                        $param1=array(
                            array(":CityName",trim($cityName)),
                            array(":StateName",trim($stateName)),
                            array(":Link","https://prayagedu.com/")
                        );
                        $query="INSERT INTO `Prayagedu_Links`(`CityName`, `StateName`, `Link`) VALUES (:CityName,:StateName,:Link)";
                        $res1=DBController::ExecuteSQL($query,$param1);
                }  
            }     
        }
        return array("return_code" => true, "return_data"=>" Sucessfully Generated ");     
    }
      
    //get the Prayagedu link
    function getPrayageduLinks()
    {
        $query=" SELECT * FROM `Prayagedu_Links`";
        $res=DBController::getDataSet($query);
        return array("return_code" => true, "return_data"=> $res);  
    }

    function getTodayVisit()
    {
        $query="SELECT * FROM `IPLogging` where date(AccessTime)=CURDATE();";
        $res=DBController::getDataSet($query);
        return array("return_code" => true, "return_data"=> $res); 
    }

}



?>