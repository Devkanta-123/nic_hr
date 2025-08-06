<?php

namespace app\modules\Products\classes;

use app\database\DBController;
use app\misc\FCM;
use app\misc\SMS;

class Products
{
    // function getMostSubscribeProduct()
    // {
    //     $query="SELECT c.`ClientName`,p.`Name`,ps.`SubscriptionName`,cs.`MaxUsers`,cs.`Remarks`,cs.`Installment`,cs.`Amount`,cs.`NextDueAmount`,cs.`NextDueDate`,cs.`SubscriptionEndReason`,cs.`SubscriptionEndedDateTime`
    //             from clientsubscriptions cs inner join clients c on cs.ClientID=c.ClientID 
    //             inner JOIN Products p on cs.ProductID=p.ProductID
    //             inner join ProductSubscriptions ps on cs.ProductSubscriptionID=ps.ProductSubscriptionID
    //             where `isSubscriptionEnded`=1;";
    //     $notices = DBController::getDataSet($query);
    //     if ($notices) {
    //         return array("return_code" => true, "return_data" =>  $notices);
    //     }
    //     return array("return_code" => false, "return_data" => "No Data found!");
    // }
    function deleteProductSubscription($data)
    {
        $params = array(
            array(":ProductSubscriptionID", $data["ProductSubscriptionID"]),
        );
        $query = "  DELETE FROM `ProductSubscriptions` where `ProductSubscriptionID`=:ProductSubscriptionID;";
        $res = DBController::ExecuteSQL($query, $params);
        return array("retrun_code" => true, "return_data" => "Sucessfully Removed subscription");
    }

    function getProductModule()
    {
        $query = "SELECT `ProductModuleID`,  `ModuleName`FROM `ProductModules`;";
        $ds = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $ds);
    }

    function deleteProduct($data)
    {
        $params = array(
            array(":ProductID", $data["ProductID"]),
        );
        $query = "DELETE FROM `Products` WHERE `ProductID`=:ProductID;";
        //$query="DELETE FROM `clientsubscriptions` where `ClientSubscriptionID`=:subscriptionID;";
        $res = DBController::ExecuteSQL($query, $params);
        return array("retrun_code" => true, "return_data" => "Sucessfully Removed subscription");
    }

    function getActiveProductSubscription()
    {
        $query = "SELECT ProductSubscriptionID,SubscriptionName,ProductID from ProductSubscriptions where isActive=1;";
        $res = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $res);
    }



    function getProductsubscription($data)
    {
        //prepare array 
        $params = array(
            array(":ProductID", $data["ProductID"])
        );
        $query = "SELECT ProductSubscriptionID,SubscriptionName from ProductSubscriptions where ProductID=:ProductID ;";
        $ds = DBController::getDataSet($query, $params);
        return array("return_code" => true, "return_data" => $ds);
    }


    function getProducts()
    {
        $query = "SELECT  `ProductID`,`Code`,`Name`,`CreatedDateTime`,`Description`,`Website` FROM `Products` ";
        $ds = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $ds);
    }
 

    function getProductBasedURL()
    {
        $query = "SELECT DBBasedSource ,FileSourceURL,Name,Products_Basedfiles.ProductID FROM `Products_Basedfiles` INNER JOIN  `Products` ON  Products_Basedfiles.ProductID = Products.ProductID; ";
        $ds = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $ds);
    }

    function getProducts_subscription()
    {
        $query = "SELECT ps.`ProductSubscriptionID`, p.`ProductID`,p.`Name`, ps.`SubscriptionName`, ps.`Description`, ps.`MinUsers`, ps.`MaxUsers`,
            ps.`ProductModuleIDs`,GROUP_CONCAT(ifnull(pm.ProductModuleID,'')) AS ProductModule, 
            IFNULL( GROUP_CONCAT(pm.ModuleName),'') as Modulename,
            ps.`isPayPerUser`, ps.`Amount`, ps.`CreatedDateTime`, ps.`CreatedBy`, ps.`ValidityDate`, ps.`isActive`
            FROM `ProductSubscriptions`as ps 
            inner join Products as p on ps.ProductID=p.ProductID
            left JOIN ProductModules pm on find_in_set(pm.ProductModuleID,ps.ProductModuleIDs)
            GROUP BY ps.ProductSubscriptionID;";

        // $query="SELECT ps.`ProductSubscriptionID`, p.`ProductID`,p.`Name`, ps.`SubscriptionName`, ps.`Description`, ps.`MinUsers`, ps.`MaxUsers`, ps.`ProductModuleIDs`, ps.`isPayPerUser`, ps.`Amount`, ps.`CreatedDateTime`, ps.`CreatedBy`, ps.`ValidityDate`, ps.`isActive`
        //  FROM `ProductSubscriptions`as ps inner join Products as p on ps.ProductID=p.ProductID;"; 
        $ds = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $ds);
    }

    function addProductSubscription($data)
    {
        if (isset($data["ProductSubscriptionID"])) {
            //update  
            $params = array(
                array(":Productname", $data["Productname"]),
                array(":SubscriptionName", $data["SubscriptionName"]),
                array(":Description", $data["Description"]),
                array(":minuser", $data["min_user"]),
                array(":maxUser", $data["maxUser"]),
                array(":Productmodule", $data["module"]),
                array(":amount", $data["amount"]),
                array(":validity", $data["validity"]),
                array(":ProductSubscriptionID", $data["ProductSubscriptionID"]),
                array(":CreatedBy", $_SESSION["UserID"]),
            );
            //foreach :Productmodule as

            $query = "UPDATE `ProductSubscriptions` SET `ProductID`=:Productname,`SubscriptionName`=:SubscriptionName,`Description`=:Description,`MinUsers`=:minuser,
                 `MaxUsers`=:maxUser,`ProductModuleIDs`=:Productmodule,`Amount`=:amount,`CreatedBy`=:CreatedBy,`ValidityDate`=:validity WHERE `ProductSubscriptionID`=:ProductSubscriptionID";
            $res = DBController::ExecuteSQL($query, $params);
        } else {
            //prepare array 
            $params = array(
                array(":Productname", $data["Productname"]),
                array(":SubscriptionName", $data["SubscriptionName"]),
                array(":Description", $data["Description"]),
                array(":minuser", $data["min_user"]),
                array(":maxUser", $data["maxUser"]),
                array(":module", $data["module"]),
                array(":amount", $data["amount"]),
                array(":CreatedBy", $_SESSION["UserID"]),
                array(":validity", $data["validity"]),
                //array(":isActive",$data["isActive"]),

            );
            //save the product
            $query = "INSERT INTO `ProductSubscriptions`( `ProductID`, `SubscriptionName`, `Description`, `MinUsers`, `MaxUsers`, `ProductModuleIDs`, `Amount`,`CreatedBy`,`ValidityDate`) VALUES (:Productname,:SubscriptionName,:Description,:minuser,:maxUser,:module,:amount,:CreatedBy,:validity);";
            $res = DBController::ExecuteSQLID($query, $params);
        }

        if ($res) {
            return array("return_code" => true, "return_data" => "Products Subscribed");
        }
        return array("return_code" => false, "return_data" => " Error while saving the product");
    }


    function addProduct($data)
    {
        if (isset($data["ProductID"])) { //update  
            $params = array(
                array(":Code", $data["ProductCoode"]),
                array(":Name", $data["ProductName"]),
                array(":Website", $data["Website"]),
                array(":Description", $data["Description"]),
                array(":ProductID", $data["ProductID"]),
                array(":CreatedBy", $_SESSION["UserID"]),

            );
            $query = "UPDATE `Products` SET `Name`=:Name,`Code`=:Code,`CreatedBy`=:CreatedBy,`Description`=:Description,`Website`=:Website WHERE `ProductID`=:ProductID;";
            $res = DBController::ExecuteSQL($query, $params);
        } else {
            //prepare array 
            $params = array(
                array(":Code", $data["ProductCoode"]),
                array(":Name", $data["ProductName"]),
                array(":Description", $data["Description"]),
                array(":Website", $data["Website"]),
                array(":CreatedBy", $_SESSION["UserID"])
            );
            //save the product
            $query = "INSERT INTO `Products`( `Name`, `Code`,   `CreatedBy`,   `Description`, `Website`)   VALUES (:Name,:Code, :CreatedBy,  :Description,:Website)";
            $res = DBController::ExecuteSQLID($query, $params);
        }
        if ($res) {
            return array("return_code" => true, "return_data" => "Products added successfully");
        }
        return array("return_code" => false, "return_data" => " Error while saving the product");
    }

    function getProductVersion()
    {
        $query = "SELECT pv.`VersionControlID`, pv.`ProductID`,p.Name, pv.`AndroidVersionCode`, pv.`iOSVersionCode`, pv.`Title`, pv.`Description`, pv.`isForced`, pv.`UpdatedDate` FROM `Products_VersionControl` pv
            inner join Products p on pv.ProductID=p.ProductID;";
        $res = DBController::getDataSet($query);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        }
    }
    function getAllProduct()
    {
        $query = "SELECT ProductID,Name FROM `Products`;";
        $res = DBController::getDataSet($query);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        } else {
            return array("return_code" => false, "return_data" => "Data not available");
        }
    }
    function getProductVersionBasedonProductID($data)
    {
        $params = array(
            array(":ProductID", $data["ProductID"]),
        );
        $query = "SELECT pv.`VersionControlID`, pv.`ProductID`,p.Name, pv.`AndroidVersionCode`, pv.`iOSVersionCode`, pv.`Title`, pv.`Description`, pv.`isForced`, pv.`UpdatedDate` FROM `Products_VersionControl` pv
            inner join Products p on pv.ProductID=p.ProductID where pv.ProductID=:ProductID;";
        $res = DBController::getDataSet($query, $params);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        } else {
            return array("return_code" => false, "return_data" => "Data not available");
        }
    }

    function  updateProductVersion($data)
    {

        if ($data["ProductID"] >= 1) {
            $params1 = array(
                array(":ProductID", $data["ProductID"])
            );
            $query1 = "SELECT  `ProductID` FROM `Products_VersionControl` WHERE `ProductID`=:ProductID";
            $res1 = DBController::getDataSet($query1, $params1);
            if ($res1) {
                $params = array(
                    array(":ProductID", $data["ProductID"]),
                    array(":AndroidVersion", $data["AndroidVersion"]),
                    array(":IosVersion", $data["IosVersion"]),
                    array(":Title", $data["Title"]),
                    array(":Description", $data["Description"]),
                    array(":ForceUpdate", $data["ForceUpdate"]),
                    array(":UserID", $_SESSION["UserID"])
                );
                $query = "UPDATE `Products_VersionControl` SET `AndroidVersionCode`=:AndroidVersion,`iOSVersionCode`=:IosVersion,`Title`=:Title,`Description`=:Description,`isForced`=:ForceUpdate,`UpdateBy`=:UserID WHERE `ProductID`=:ProductID";
                $res = DBController::ExecuteSQL($query, $params);
                if ($res) {
                    return array("return_code" => true, "return_data" => "Sucessfully Update");
                } else {
                    return array("return_code" => false, "return_data" => "Fail to Update Product version ");
                }
            } else {
                return array("return_code" => false, "return_data" => "There is no product in version control");
            }
        } else {
            return array("return_code" => false, "return_data" => "Product Name  cannot be Empty");
        }
    }

    function getProductVersionBasedonProductCode($data)
    {
        $params = array(
            array(":ProductCode", $data["ProductCode"]),
        );
        $query = " SELECT  p.Name, pv.`AndroidVersionCode`, pv.`iOSVersionCode`, pv.`Title`, pv.`Description`, pv.`isForced`, pv.`UpdatedDate` FROM ITPL_Clients.`Products_VersionControl` pv
            inner join ITPL_Clients.Products p on pv.ProductID=p.ProductID where p.Code=:ProductCode ;";
        $res = DBController::getDataSet($query, $params);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        } else {
            return array("return_code" => false, "return_data" => "Data not available");
        }
    }

    function addproductbasedfiles($data)
    {
        if (isset($data["ProductID"])) { //update product base URL , added by dev on 06/11/23
            $params = array(
                array(":ProductID", $data["product_id"]),
                array(":DBBasedSource", $data["db_base_source"]),
                array(":FileSourceURL", $data["file_source_url"]),
            );
            $query = "UPDATE `Products_Basedfiles` SET `ProductID`=:ProductID,`DBBasedSource`=:DBBasedSource,`FileSourceURL`=:FileSourceURL  WHERE `ProductID`=:ProductID;";
            //$query = "INSERT INTO `Products_Basedfiles`( `ProductID`, `DBBasedSource`,`FileSourceURL`,`CreatedById`) VALUES (:ProductID, :DBBasedSource,:FileSourceURL,:UserID)";
            $res = DBController::ExecuteSQL($query, $params);
        } else {

            $params = array(

                array(":ProductID", $data["product_id"]),
                array(":DBBasedSource", $data["db_base_source"]),
                array(":FileSourceURL", $data["file_source_url"]),
                array(":UserID", $_SESSION['UserID']),
            );
            $query = "INSERT INTO `Products_Basedfiles`( `ProductID`, `DBBasedSource`,`FileSourceURL`,`CreatedById`) VALUES (:ProductID,:DBBasedSource,:FileSourceURL,:UserID)";
            $res = DBController::ExecuteSQL($query, $params);
        }
        if ($res) {
            return array("return_code" => true, "return_data" => "Added Product URL");
        }
        return array("return_code" => false, "return_data" => "Error while saving the Data");
    }

    function deleteProductURL($data) //added by dev on 06/11/23 
    {
        $params = array(
            array(":ProductID", $data["ProductID"]),
        );
        $query = "DELETE FROM `Products_Basedfiles` WHERE `ProductID`=:ProductID;";
        $res = DBController::ExecuteSQL($query, $params);
        return array("retrun_code" => true, "return_data" => "Sucessfully Removed Product URL");
    }
    // getProductViewLeads

 



    function updateViewLeads($data)
    {
        if (isset($data["LeadsID"])) { //update  
            $params = array(
                array(":LeadsID", $data["LeadsID"]),
                array(":Name", $data["Name"]),
                array(":SchoolGroupName", $data["SchoolGroupName"]),
                array(":ContactNo", $data["ContactNo"]),
                array(":Email", $data["Email"]),
                array(":Role", $data["Role"]),
                array(":IPAddress", $data["IPAddress"]),
            );
            $query = "UPDATE `prayagedu_leads` SET `Name`=:Name,`SchoolGroupName`=:SchoolGroupName,`ContactNo`=:ContactNo,`Email`=:Email,`Role`=:Role,`IPAddress`=:IPAddress WHERE `LeadsID`=:LeadsID;";
            $res = DBController::ExecuteSQL($query, $params);
            if ($res) {
                return array("return_code" => true, "return_data" => "Updated  successfully");
            }
            return array("return_code" => false, "return_data" => " Error while saving the product");
        } 
    }

    function deleteProducViewLeads($data) //added by dev on 07/11/23
    {
        $params = array(
            array(":LeadsID", $data["LeadsID"]),
        );
        $query = "DELETE FROM `prayagedu_leads` WHERE `LeadsID`=:LeadsID;";
        $res = DBController::ExecuteSQL($query, $params);
        if ($res) {
            return array("retrun_code" => true, "return_data" => "Sucessfully Removed");
        }
        return array("return_code" => false, "return_data" => " Error while delete the Leads");

    }

    function getProductViewLeads($data)  //added by dev on 06/11/23
    {

        $query = " SELECT `LeadsID`,`Name`,`SchoolGroupName`,`ContactNo`,`Email`,`Role`,`IPAddress`,`DeviceInfo` FROM `prayagedu_leads` ";
        $res = DBController::getDataSet($query);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        } else {
            return array("return_code" => false, "return_data" => "Data not available");
        }
    }


    function getProductItplViewLeads($data)  //added by dev on 29/11/23
    {

        $query = " SELECT `Name`,`Contact`,`EmailID`,`TitleName`,`Description` FROM `ITPL_Leads` ";
        $res = DBController::getDataSet($query);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        } else {
            return array("return_code" => false, "return_data" => "Data not available");
        }
    }
     function getviewirequestquotes($data)  //added by dev on 29/11/23
    {

        $query = " SELECT `Name`,`Contact`,`EmailID`,`BusinessName`,`Description`,`RequiredService`,`CreatedDateTime` FROM  `ITPL_Requirements` ";
        $res = DBController::getDataSet($query);
        if ($res) {
            return array("return_code" => true, "return_data" => $res);
        } else {
            return array("return_code" => false, "return_data" => "Data not available");
        }
    }
    



    

    
}
