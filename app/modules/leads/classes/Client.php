<?php

namespace app\modules\clients\classes;
use app\database\DBController;
use app\misc\FCM;
use app\misc\SMS;
use app\modules\settings\classes\Session;

class Client{
    

    function clientAboutToExpired()
    {
        $query="SELECT c.ClientName,p.Name,ps.SubscriptionName,cs.Enddate,cs.Amount,cs.Installment,cs.NextDueDate, DATEDIFF(EndDate,CURDATE()) AS daysleft 
        FROM `clientsubscriptions` cs 
        INNER JOIN clients c on cs.ClientID=c.ClientID
        INNER JOIN products p on cs.ProductID=p.ProductID
        INNER JOIN ProductSubscriptions ps on cs.ProductSubscriptionID=ps.ProductSubscriptionID
        where EndDate > CURDATE();";
        $notices = DBController::getDataSet($query);
        if ($notices) {
            return array("return_code" => true, "return_data" =>  $notices);
        }
        return array("return_code" => false, "return_data" => "No Data found!");
    }


    function getMostSubscribeClients()
    {
        $query="SELECT
        c.ClientName,c.MobileNo,sts.StateName,std.DistrictName, count(cs.clientID) as numberofsubscribe
        FROM clients c 
        inner join clientsubscriptions cs on c.ClientID=cs.ClientID
        inner join Settings_State sts on c.StateID=sts.StateID
        inner JOIN settings_districts std on c.DistrictID=std.DistrictID
        GROUP BY
        cs.ClientID
        ORDER BY
        SUM(cs.ClientID) DESC;";
        $notices = DBController::getDataSet($query);
        if ($notices) {
            return array("return_code" => true, "return_data" =>  $notices);
        }
        return array("return_code" => false, "return_data" => "No Data found!");
    }

    function getMostSubscribeProduct()
    {
        $query="SELECT
                p.Name,p.Code,p.isActive,p.Website, count(c.productID) as numberofsubscribe
                FROM
                clientsubscriptions c inner join products p on c.ProductID=p.ProductID
                GROUP BY
                c.productID
                ORDER BY
                SUM(c.productID) DESC;";
        $notices = DBController::getDataSet($query);
        if ($notices) {
            return array("return_code" => true, "return_data" =>  $notices);
        }
        return array("return_code" => false, "return_data" => "No Data found!");
    }

    function getUnsubscribeClients()
    {
        $query="SELECT c.`ClientName`,p.`Name`,ps.`SubscriptionName`,cs.`MaxUsers`,cs.`Remarks`,cs.`Installment`,cs.`Amount`,cs.`NextDueAmount`,cs.`NextDueDate`,cs.`SubscriptionEndReason`,cs.`SubscriptionEndedDateTime`
                from clientsubscriptions cs inner join clients c on cs.ClientID=c.ClientID 
                inner JOIN products p on cs.ProductID=p.ProductID
                inner join ProductSubscriptions ps on cs.ProductSubscriptionID=ps.ProductSubscriptionID
                where `isSubscriptionEnded`=1;";
        $notices = DBController::getDataSet($query);
        if ($notices) {
            return array("return_code" => true, "return_data" =>  $notices);
        }
        return array("return_code" => false, "return_data" => "No Data found!");
    }

    function getActiveClients()
    {
        $query="select c.`clientName`,c.`MobileNo`,cs.`ProductSubscriptionID`,cs.`NextDueDate`,cs.`amount`
        from clients as c
        inner join clientsubscriptions as cs on c.`ClientID`=cs.`ClientID`
        where EndDate >= CURDATE()";
                $notices = DBController::getDataSet($query);
        if ($notices) {
            return array("return_code" => true, "return_data" =>  $notices);
        }
        return array("return_code" => false, "return_data" => "No Data found!");
    }

    function getExpiredClients()
    {
        // $query="select c.`clientName`,c.`MobileNo`,cs.`ProductSubscriptionID`,cs.`EndDate` 
        // from clients as c
        // inner join clientsubscriptions as cs on c.`ClientID`=cs.`ClientID`
        // where EndDate < CURDATE();";

        $query="select concat(c.`clientName`,' , ',p.`Name`,' ,  ',ps.SubscriptionName) as clientdescription ,c.`MobileNo`,cs.`ProductSubscriptionID`,cs.`EndDate` 
        from clients as c
        inner join clientsubscriptions as cs on c.`ClientID`=cs.`ClientID`
        INNER JOIN products p on cs.ProductID=p.ProductID
        INNER JOIN ProductSubscriptions ps on cs.ProductSubscriptionID=ps.ProductSubscriptionID
        where EndDate < CURDATE();";
                $notices = DBController::getDataSet($query);
        if ($notices) {
            return array("return_code" => true, "return_data" =>  $notices);
        }
        return array("return_code" => false, "return_data" => "No Data found!");
    }
    function Unsubscribe($data)
    {
        $params=array(
            array(":ClientSubscriptionID",$data["ClientSubscriptionID"]),
            array(":unsubscribereason",$data["unsubscribereason"]), 
        );
             $query="UPDATE `clientsubscriptions` SET `SubscriptionEndReason`=:unsubscribereason,`isSubscriptionEnded`=1 WHERE `ClientSubscriptionID`=:ClientSubscriptionID;";
             $res=DBController::ExecuteSQL($query,$params); 
            if($res)
            {
                return array("return_code" => true, "return_data"=>"Added Subscription");  
            }
            return array("return_code" => false, "return_data" => " Error while saving");  

    }
    function deleteClientSubscription($data)
    {
        $params=array(
            array(":subscriptionID",$data["subscriptionId"]),
        );
        $query="DELETE FROM `clientsubscriptions` where `ClientSubscriptionID`=:subscriptionID;";
        $res=DBController::ExecuteSQL($query,$params);
        return array("retrun_code" => true, "return_data" => "Sucessfully Removed subscription");
    }
    
    function getClient_subscription()
    {
        $query="SELECT cs.`ClientSubscriptionID`, c.`ClientID`,c.`ClientName`, p.`ProductID`,p.`Name`, ps.`ProductSubscriptionID`,ps.`SubscriptionName`,ps.`Amount` as productAmount, cs.`StartDate`, cs.`EndDate`, cs.`Amount`, cs.`MaxUsers`, cs.`TransectionID`, cs.`Remarks`, cs.`Installment`, cs.`NextDueDate`, cs.`NextDueAmount`, cs.`API`, cs.`ProductLogoPath`, cs.`TermsPath` 
        FROM `ClientSubscriptions` as cs  
        inner JOIN Clients  as c on cs.ClientID=c.ClientID
        inner JOIN Products as p on p.ProductID=cs.ProductID
        INNER JOIN ProductSubscriptions as ps on ps.ProductSubscriptionID=cs.`ProductSubscriptionID`
        where cs.`isSubscriptionEnded`=0;";   
        $notices = DBController::getDataSet($query);
        if ($notices) {
            return array("return_code" => true, "return_data" =>  $notices);
        }
        return array("return_code" => false, "return_data" => "No Data found!");
    }

    function addClientSubscription($data)
    {
        //update
        if(isset($data["ClientSubscriptionID"])){ //update  
            $params=array(
                array(":clientId",$data["clientId"]),
                array(":ProductId",$data["ProductId"]),
                array(":productSubscriptionId",$data["SubscriptionId"]),
                array(":StartDate",$data["StartDate"]),
                array(":Enddate",$data["Enddate"]),
                array(":Amount",$data["Amount"]),
                array(":MaxUser",$data["MaxUser"]),
                array(":Remarks",$data["Remarks"]),
                array(":Installment",$data["Installment"]), 
                array(":NextDueDate",$data["NextDueDate"]),
                array(":nextDueAmount",$data["nextDueAmount"]),
                array(":aPi",$data["aPi"]),
                array(":Terms",$data["Terms"]),
                array(":Logo",$data["Logo"]),
                array(":UserID",$_SESSION['UserID']),
                array(":ClientSubscriptionID",$data['ClientSubscriptionID'])
            );
            
                $query="UPDATE `clientsubscriptions` SET `ClientID`=:clientId,`ProductID`=:ProductId,`ProductSubscriptionID`=:productSubscriptionId,`StartDate`=:StartDate,`EndDate`=:Enddate,
                `Amount`=:Amount,`MaxUsers`=:MaxUser,`Remarks`=:Remarks,`CreatedBy`=:UserID,`Installment`=:Installment,`NextDueDate`=:NextDueDate,
                `NextDueAmount`=:nextDueAmount,`API`=:aPi,`ProductLogoPath`=:Logo,`TermsPath`=:Terms WHERE `ClientSubscriptionID`=:ClientSubscriptionID;";
                $res=DBController::ExecuteSQL($query,$params); 
          }
          //add new
          else
            {
                $params=array(
                    array(":clientId",$data["clientId"]),
                    array(":ProductId",$data["ProductId"]),
                    array(":SubscriptionId",$data["SubscriptionId"]),
                    array(":StartDate",$data["StartDate"]),
                    array(":Enddate",$data["Enddate"]),
                    array(":Amount",$data["Amount"]),
                    array(":MaxUser",$data["MaxUser"]),
                    array(":Remarks",$data["Remarks"]),
                    array(":Installment",$data["Installment"]), 
                    array(":NextDueDate",$data["NextDueDate"]),
                    array(":nextDueAmount",$data["nextDueAmount"]),
                    array(":aPi",$data["aPi"]),
                    array(":Terms",$data["Terms"]),
                    array(":Logo",$data["Logo"]),
                    array(":UserID",$_SESSION['UserID']),
                );
            
                $query="INSERT INTO `ClientSubscriptions`( `ClientID`, `ProductID`, `ProductSubscriptionID`, `StartDate`, `EndDate`, `Amount`, `MaxUsers`,`Remarks`, `CreatedBy`, `Installment`, `NextDueDate`, `NextDueAmount`, `API`, `ProductLogoPath`, `TermsPath`)
                VALUES (:clientId,:ProductId,:SubscriptionId,:StartDate,:Enddate,:Amount,:MaxUser,:Remarks,:UserID,:Installment,:NextDueDate,:nextDueAmount,:aPi,:Logo,:Terms)";
                $res=DBController::ExecuteSQLID($query,$params);
            }
       
        if($res)
            {
                return array("return_code" => true, "return_data"=>"Added Subscription");  
            }
        return array("return_code" => false, "return_data" => " Error while saving");  
    }

    function deleteClient($data)
    {
    
        $params=array(
            array(":ClientID", $data["ClientID"])
        );  
        $query="SELECT ClientID  FROM `clientsubscriptions` WHERE `ClientID`=:ClientID;";
        $resultss = DBController::sendData($query,$params);
        if ($resultss) {
            return array("return_code" => false, "return_data" => "Client cannot be deleted. As Subscription Exists. ");   
        }
        
        $query="update  `Clients` set isActive=0 WHERE `ClientID`=:ClientID";
        $res = DBController::ExecuteSQL($query,$params); 
        return array("return_code" => true, "return_data" => "Successfully Removed & Disabled !!!");
    }


    function getClients($data)
    {
        $query="SELECT  `ClientID`,`ClientName`, `TelephoneNo`, `MobileNo`, `Fax`, `ContactPersonName`, `ContactPersonMobileNo`, 
        `ContactPersonDesignation`,Clients.DistrictID, `DistrictName`,Clients.StateID,  `StateName`, `CityName`, `PinCode`, `Landmark`, `Logo`, `MaxUsers`  
        FROM `Clients` inner join Settings_State on Clients.StateID=Settings_State.StateID 
        inner join Settings_Districts on Clients.DistrictID=Settings_Districts.DistrictID where  ifnull(isActive,0)=1 ;";
                $notices = DBController::getDataSet($query);
        if ($notices) {
            return array("return_code" => true, "return_data" =>  $notices);
        }
        return array("return_code" => false, "return_data" => "No Data found!");
    }

    function addClient($data)
    { 
    if(isset($data["ClientID"])){ //update  
    $params=array(
        array(":ClientName",$data["ClientName"]),
        array(":telephoneNumber",$data["telephoneName"]),
        array(":MobileNo",$data["MobileNo"]),
        array(":Fax",$data["Fax"]),
        array(":ContactName",$data["ContactName"]),
        array(":ContactPersonMobile",$data["ContactNumber"]),
        array(":PersonDesignation",$data["PersonDesignation"]),
        array(":State",$data["State"]),
        array(":District",$data["District"]),
        array(":City",$data["City"]), 
        array(":Pincode",$data["Pincode"]),
        array(":Landmark",$data["Landmark"]),
        array(":Maxuser",$data["Maxuser"]),
        array(":Logo",$data["Logo"]),  
        array(":ClientID",$data['ClientID'])
    );

       $query="UPDATE `Clients` SET `ClientName`=:ClientName,`TelephoneNo`=:telephoneNumber,`MobileNo`=:MobileNo,`Fax`=:Fax,`ContactPersonName`=:ContactName,`ContactPersonMobileNo`=:ContactPersonMobile,`ContactPersonDesignation`=:PersonDesignation,`StateID`=:State,`DistrictID`=:District,`CityName`=:City,`PinCode`=:Pincode,`Landmark`=:Landmark,`Logo`=:Logo,`MaxUsers`=:Maxuser WHERE `ClientID`=:ClientID;";
        $res=DBController::ExecuteSQL($query,$params); 
  }
  else
  {
    $params=array(
        array(":ClientName",$data["ClientName"]),
        array(":telephoneName",$data["telephoneName"]),
        array(":MobileNo",$data["MobileNo"]),
        array(":Fax",$data["Fax"]),
        array(":ContactName",$data["ContactName"]),
        array(":ContactNumber",$data["ContactNumber"]),
        array(":PersonDesignation",$data["PersonDesignation"]),
        array(":State",$data["State"]),
        array(":District",$data["District"]),
        array(":City",$data["City"]), 
        array(":Pincode",$data["Pincode"]),
        array(":Landmark",$data["Landmark"]),
        array(":Maxuser",$data["Maxuser"]),
        array(":Logo",$data["Logo"]),
        array(":UserID",$_SESSION['UserID']),
    );
   
    
    $query="INSERT INTO `Clients`( `ClientName`, `TelephoneNo`, `MobileNo`, `Fax`, `ContactPersonName`, `ContactPersonMobileNo`, `ContactPersonDesignation`, `StateID`, `DistrictID`, `CityName`, `PinCode`, `Landmark`, `Logo`, `MaxUsers`,`CreatedBy`)
    VALUES (:ClientName,:telephoneName,:MobileNo,:Fax,:ContactName,:ContactNumber,:PersonDesignation,:State,:District,:City,:Pincode,:Landmark,:Logo,:Maxuser,:UserID);";
    $res=DBController::ExecuteSQLID($query,$params);

  }
         if($res){
            return array("return_code" => true, "return_data"=>"Client added successfully");  
         }
         return array("return_code" => false, "return_data" => " Error while saving");  

    }

}


