<?php

namespace app\modules\marketings\classes;

use app\database\DBController;

class Marketing
{

    //adding new Marketing clients
    function AddMarketingClients($data)
    {
        //update
        if (isset($data['ClientID'])) {
            $param = array(
                array(":ClientID", (int)$data['ClientID']),
                array(":Name", (string)strip_tags($data['Name'])),
                array(":PhoneNumbers", $data['PhoneNumbers']),
                array(":lat", strip_tags($data['lat'])),
                array(":long", strip_tags($data['long'])),
                array(":Address", (string)strip_tags($data['Address'])),
                array(":pincode", strip_tags($data['pincode'])),
                array(":CountryID", strip_tags($data['CountryID'])),
                array(":city", strip_tags($data['city'])),
                array(":stateID", strip_tags($data['stateID'])),
                array(":EmailIDs", $data['EmailIDs']),
                array(":ContactpersonName", strip_tags($data['ContactpersonName'])),
                array(":ContactPersonNumber", strip_tags($data['ContactPersonNumber'])),
                array(":ContactPersonDesignation", strip_tags($data['ContactPersonDesignation'])),
                array(":LandlineNo", strip_tags($data['LandlineNo'])),
                array(":website", strip_tags($data['website'])),
                array(":Landmark", strip_tags($data['Landmark'])),
                array(":enrollment", strip_tags($data['enrollment'])),
                array(":InterestedProductIDs", strip_tags($data['InterestedProductIDs'])),
                array(":UpdatedBy", $_SESSION['UserID']),
                array(":discussion", strip_tags($data['discussion']))
            );

            $query = "UPDATE `Marketing_Clients` SET `ClientName`=:Name,`MobileNos`=:PhoneNumbers,`Lat`=:lat,`Longitute`=:long,
            `Address`=:Address,`Pincode`=:pincode,`CountryID`=:CountryID,`CityID`=:city,`StateID`=:stateID,`EmailIDs`=:EmailIDs,
            `ContactPersons`=:ContactpersonName,`ContactPersonNumber`=:ContactPersonNumber,`ContactPersonDesignation`=:ContactPersonDesignation,
            `LandLineNo`=:LandlineNo,`Website`=:website,`LandMark`=:Landmark,`Enrollments`=:enrollment,`InterestedProjectIDs`=:InterestedProductIDs,
            `UpdatedBy`=:UpdatedBy,`Description`=:discussion WHERE `ClientID`=:ClientID";
            $res = DBController::ExecuteSQL($query, $param);
            return array("return_code" => true, "return_data" => "Successfully Updated");
        }

        //add new one
        else {
            $param = array(
                array(":Name", (string)strip_tags($data['Name'])),
                array(":PhoneNumbers", $data['PhoneNumbers']),
                array(":lat", strip_tags($data['lat'])),
                array(":long", strip_tags($data['long'])),
                array(":Address", (string)strip_tags($data['Address'])),
                array(":pincode", strip_tags($data['pincode'])),
                array(":CountryID", strip_tags($data['CountryID'])),
                array(":city", strip_tags($data['city'])),
                array(":stateID", strip_tags($data['stateID'])),
                array(":EmailIDs", $data['EmailIDs']),
                array(":ContactpersonName", strip_tags($data['ContactpersonName'])),
                array(":ContactPersonNumber", strip_tags($data['ContactPersonNumber'])),
                array(":ContactPersonDesignation", strip_tags($data['ContactPersonDesignation'])),
                array(":LandlineNo", strip_tags($data['LandlineNo'])),
                array(":website", strip_tags($data['website'])),
                array(":Landmark", strip_tags($data['Landmark'])),
                array(":enrollment", strip_tags($data['enrollment'])),
                array(":InterestedProductIDs", strip_tags($data['InterestedProductIDs'])),
                array(":CreatedBy", $_SESSION['UserID']),
                array(":discussion", strip_tags($data['discussion']))
            );
            $query = "INSERT INTO `Marketing_Clients`(`ClientName`, `MobileNos`, `Lat`, `Longitute`, `Address`, `Pincode`,
                `CountryID`, `CityID`, `StateID`, `EmailIDs`, `ContactPersons`, `ContactPersonNumber`, `ContactPersonDesignation`,
                `LandLineNo`, `Website`, `LandMark`, `Enrollments`, `InterestedProjectIDs`, 
                `CreatedBy`, `Description`)
                VALUES (:Name,:PhoneNumbers,:lat,:long,:Address,:pincode,:CountryID,:city,:stateID,:EmailIDs,:ContactpersonName,:ContactPersonNumber,
                :ContactPersonDesignation,:LandlineNo,:website,:Landmark,:enrollment,:InterestedProductIDs,:CreatedBy,:discussion)";
            $res = DBController::ExecuteSQLID($query, $param);

            if ($res) {
                //add to status too
                $param1 = array(
                    array(":ClientID", $res),
                    array(":CreatedBy", $_SESSION['UserID']),
                );
                $query1 = "INSERT INTO `Marketing_Response`(`ClientID`,`EntryByID`) VALUES (:ClientID,:CreatedBy)";
                $marketingStatus = DBController::ExecuteSQL($query1, $param1);
                if ($marketingStatus) {
                    return array("return_code" => true, "return_data" => "Successfully Uploaded");
                }
            } else {
                return array("return_code" => false, "return_data" => "An Error occurs while Submitting.Please try again.");
            }
        }
    }

    /*  Info:
       
    
        Description: To get All Clients By Joining multiple tables
            13-02-2024 (Devkanta) : Updated  the function
    */

    function getAllMarketingClients()
    {
        // check if Admin then view all
        // if(isset($_SESSION['UserType']) && $_SESSION['UserType']==1)
        // {

        // $query="SELECT DISTINCT `ClientID`, `ClientName`, `MobileNos`, `Lat`, `Longitute`, `Address`, `Pincode`,sn.NationalityName,sc.CityName,Marketing_Clients.`StateID` , IFNULL(ss.StateName, 'N/A') as StateName, `EmailIDs`, `ContactPersons`, `ContactPersonNumber`, `ContactPersonDesignation`, `LandLineNo`,Marketing_Clients.`Website`, `LandMark`, `Enrollments`, `InterestedProjectIDs`, GROUP_CONCAT(p.Name) as productName, `UpdatedBy`,Marketing_Clients.`Description`,Marketing_Clients.CountryID as countryid,Marketing_Clients.CityID
        // FROM `Marketing_Clients` 
        // LEFT JOIN Settings_State ss on ss.StateID=Marketing_Clients.StateID
        // LEFT JOIN Settings_City sc on sc.CityId=Marketing_Clients.CityID
        // LEFT JOIN Settings_Nationality sn on sn.NationalityID=Marketing_Clients.CountryID
        // left JOIN Products p on find_in_set(p.ProductID,Marketing_Clients.InterestedProjectIDs)
        // GROUP BY Marketing_Clients.ClientID;";  old query 
        $query = "SELECT 
                `ClientID`, 
                GROUP_CONCAT(DISTINCT `ClientName`) AS `ClientName`, 
                GROUP_CONCAT(DISTINCT `MobileNos`) AS `MobileNos`, 
                GROUP_CONCAT(DISTINCT `Lat`) AS `Lat`, 
                GROUP_CONCAT(DISTINCT `Longitute`) AS `Longitute`, 
                GROUP_CONCAT(DISTINCT `Address`) AS `Address`, 
                GROUP_CONCAT(DISTINCT `Pincode`) AS `Pincode`,
                GROUP_CONCAT(DISTINCT sn.NationalityName) AS `NationalityName`, 
                GROUP_CONCAT(DISTINCT sc.CityName) AS `CityName`,
                GROUP_CONCAT(DISTINCT Marketing_Clients.`StateID`) AS `StateID`, 
                GROUP_CONCAT(DISTINCT IFNULL(ss.StateName, 'N/A')) AS `StateName`, 
                GROUP_CONCAT(DISTINCT `EmailIDs`) AS `EmailIDs`, 
                GROUP_CONCAT(DISTINCT `ContactPersons`) AS `ContactPersons`, 
                GROUP_CONCAT(DISTINCT `ContactPersonNumber`) AS `ContactPersonNumber`, 
                GROUP_CONCAT(DISTINCT `ContactPersonDesignation`) AS `ContactPersonDesignation`, 
                GROUP_CONCAT(DISTINCT `LandLineNo`) AS `LandLineNo`,
                GROUP_CONCAT(DISTINCT Marketing_Clients.`Website`) AS `Website`, 
                GROUP_CONCAT(DISTINCT `LandMark`) AS `LandMark`, 
                GROUP_CONCAT(DISTINCT `Enrollments`) AS `Enrollment`, 
                GROUP_CONCAT(DISTINCT `InterestedProjectIDs`) AS `InterestedProjectID`, 
                GROUP_CONCAT(DISTINCT p.Name) AS `productName`, 
                GROUP_CONCAT(DISTINCT `UpdatedBy`) AS `UpdatedBy`,
                GROUP_CONCAT(DISTINCT Marketing_Clients.`Description`) AS `Description`,
                GROUP_CONCAT(DISTINCT Marketing_Clients.CountryID) AS `CountryID`,
                GROUP_CONCAT(DISTINCT Marketing_Clients.CityID) AS `CityID`
            FROM `Marketing_Clients` 
            LEFT JOIN Settings_State ss ON ss.StateID = Marketing_Clients.StateID
            LEFT JOIN Settings_City sc ON sc.CityId = Marketing_Clients.CityID
            LEFT JOIN Settings_Nationality sn ON sn.NationalityID = Marketing_Clients.CountryID
            LEFT JOIN Products p ON FIND_IN_SET(p.ProductID, Marketing_Clients.InterestedProjectIDs)
            GROUP BY `ClientID`;"; //new query 
        $allMarketingClients = DBController::getDataSet($query);
        if ($allMarketingClients) {
            return array("return_code" => true, "return_data" => $allMarketingClients);
        } else {
            return array("return_code" => false, "return_data" => "Data Not Available for now");
        }

        // }
        // else{
        //     return array("return_code" => false, "return_data" => "Permision Denied");
        // }
    }

    function getMarketingClientStatusbyID($data)
    {
        $param = array(
            array(":ClientID", (int)strip_tags($data['MarketingClientID']))
        );
        $query = "SELECT  im.ClientID,im.ClientName,ipr.EntryDateTime,ipr.UpdatedDateTime,ims.Status,ipr.CurrentStatus,ipr.ProjectResponseID
        FROM Marketing_Response ipr
        INNER JOIN Marketing_Clients im on im.ClientID=ipr.ClientID
        INNER JOIN Marketing_Status ims on ims.StatusID=ipr.CurrentStatus
        where im.ClientID=:ClientID;";
        $Marketingresponse = DBController::sendData($query, $param);
        if ($Marketingresponse) {
            return array("return_code" => true, "return_data" => $Marketingresponse);
        }
    }

    //add feedback
    function addMarketingFeedback($data)
    {
        $flag = isset($data['flag']) ? $data['flag'] : null;

        switch ($flag) {  //Flag 1 for RawLeads and 2 for Leads

            case 1:
                $param = array(
                    array(":ClientID", strip_tags($data['ClientID'])),
                    array(":ProjectResponseID", strip_tags($data['ProjectResponseID']))
                );
                $query = "SELECT CurrentStatus FROM `Marketing_Response` where ClientID=:ClientID and ProjectResponseID=:ProjectResponseID";
                $CurrentStatus = DBController::sendData($query, $param);
                if ($CurrentStatus['CurrentStatus'] == 4) //lead close
                {
                    //do not allow other to edit only admin
                    if (isset($_SESSION['UserType']) && $_SESSION['UserType'] != 1) {
                        //not admin (Do NOT ALLOW TO EDIT)
                        return array("return_code" => false, "return_data" => "This Lead is close. You cannot perform any Operation on this.");
                    }
                }


                //status cannot be set to initial (Initial is for Stating only)
                if ($data['StatusID'] == 7) {
                    return array("return_code" => false, "return_data" => "Status Cannnot be set to initial");
                }

                // array(":Price",strip_tags($data['Question1']))
                // array(":Price",strip_tags($data['Question2']))
                // array(":Price",strip_tags($data['Question3']))
                $param = array(
                    array(":Price", strip_tags($data['Price'])),
                    array(":RawLeadID", strip_tags($data['ClientID'])),
                    array(":ProjectResponseID", strip_tags($data['ProjectResponseID'])),
                    array(":Remarks", strip_tags($data['Remarks'])),
                    array(":isPositive", $data['isPositive']),
                    array(":StatusID", strip_tags($data['StatusID'])),
                    // array(":FollowUpDateTime", strip_tags($data['FollowUpDateTime'])),
                    array(":AppointmentDate", strip_tags($data['AppointmentDate'])),
                    array(":NextFollowUp_Discussion", strip_tags($data['NextFollowUp_Discussion'])),
                    array(":CreatedBy", $_SESSION['UserID']),
                );
                $query = "INSERT INTO `Marketing_Feedback`(`RawLeadID`, `ProjectResponseID`, `Remarks`, `isPositive`, `StatusID`, `Price`,`AppointmentDate`, `NextFollowUp_Discussion`,CreatedBy)
            VALUES (:RawLeadID,:ProjectResponseID,:Remarks,:isPositive,:StatusID,:Price,:AppointmentDate,:NextFollowUp_Discussion,:CreatedBy)";
                $MarketingFeedbackResult = DBController::ExecuteSQL($query, $param);
                if ($MarketingFeedbackResult) {
                    $param1 = array(
                        array(":CurrentStatus", strip_tags($data['StatusID'])),
                        array(":Price", strip_tags($data['Price'])),
                        array(":ProjectResponseID", strip_tags($data['ProjectResponseID']))
                    );
                    $query1 = "UPDATE `Marketing_Response` SET `CurrentStatus`=:CurrentStatus,CurrentPrice=:Price WHERE ProjectResponseID=:ProjectResponseID";
                    $UpdateResponseRes = DBController::ExecuteSQL($query1, $param1);
                    return array("return_code" => true, "return_data" => "Feedback Added Sucessfully");
                } else {
                    return array("return_code" => false, "return_data" => "Some error while adding the Feedback");
                }

                break;

            case 2:

                // check last StatusID
                $param1 = array(
                    array(":ClientID", strip_tags($data['ClientID'])),
                    array(":ProjectResponseID", strip_tags($data['ProjectResponseID']))
                );
                $query1 = "SELECT CurrentStatus FROM `Marketing_Response` where ClientID=:ClientID and ProjectResponseID=:ProjectResponseID";
                $CurrentStatus = DBController::sendData($query1, $param1);
                if ($CurrentStatus['CurrentStatus'] == 4) //lead close
                {
                    //do not allow other to edit only admin
                    if (isset($_SESSION['UserType']) && $_SESSION['UserType'] != 1) {
                        //not admin (Do NOT ALLOW TO EDIT)
                        return array("return_code" => false, "return_data" => "This Lead is close. You cannot perform any Operation on this.");
                    }
                }


                //status cannot be set to initial (Initial is for Stating only)
                if ($data['StatusID'] == 7) {
                    return array("return_code" => false, "return_data" => "Status Cannnot be set to initial");
                }

                // array(":Price",strip_tags($data['Question1']))
                // array(":Price",strip_tags($data['Question2']))
                // array(":Price",strip_tags($data['Question3']))
                $param = array(
                    array(":Price", strip_tags($data['Price'])),
                    array(":LeadID", strip_tags($data['ClientID'])),
                    array(":ProjectResponseID", strip_tags($data['ProjectResponseID'])),
                    array(":Remarks", strip_tags($data['Remarks'])),
                    array(":isPositive", $data['isPositive']),
                    array(":StatusID", strip_tags($data['StatusID'])),
                    array(":FollowUpDateTime", strip_tags($data['FollowUpDateTime'])),
                    array(":AppointmentDate", strip_tags($data['AppointmentDate'])),
                    array(":NextFollowUp_Discussion", strip_tags($data['NextFollowUp_Discussion'])),
                    array(":CreatedBy", $_SESSION['UserID']),
                );
                $query = "INSERT INTO `Marketing_Feedback`(`LeadID`, `ProjectResponseID`, `Remarks`, `isPositive`, `StatusID`, `Price`, `FollowUpDateTime`,`AppointmentDate`,`NextFollowUp_Discussion`,CreatedBy)
            VALUES (:LeadID,:ProjectResponseID,:Remarks,:isPositive,:StatusID,:Price,:FollowUpDateTime,:AppointmentDate,:NextFollowUp_Discussion,:CreatedBy)";
                $MarketingFeedbackResult = DBController::ExecuteSQL($query, $param);
                if ($MarketingFeedbackResult) {
                    $param1 = array(
                        array(":CurrentStatus", strip_tags($data['StatusID'])),
                        array(":Price", strip_tags($data['Price'])),
                        array(":ProjectResponseID", strip_tags($data['ProjectResponseID']))
                    );
                    $query1 = "UPDATE `Marketing_Response` SET `CurrentStatus`=:CurrentStatus,CurrentPrice=:Price WHERE ProjectResponseID=:ProjectResponseID";
                    $UpdateResponseRes = DBController::ExecuteSQL($query1, $param1);
                    return array("return_code" => true, "return_data" => "Feedback Added Sucessfully");
                } else {
                    return array("return_code" => false, "return_data" => "Some error while adding the Feedback");
                }
                break;
            default:
                return array("return_code" => false, "return_data" => "Invalid Flag Type");
        }
    }

    //get all the status
    function getAllMarketingStatus()
    {
        $query = "SELECT * FROM `Marketing_Status` WHERE  StatusID !=6 AND StatusID !=7";
        $statusResult = DBController::getDataSet($query);
        return array("return_code" => true, "return_data" => $statusResult);
    }

    // get  feedback By clientID
    function getMarketingStatusFeedbackByID($data)
    {
        $flag = isset($data['flag']) ? $data['flag'] : null;


        switch ($flag) {
            case 1: //for RawLeads Feedback flag
                $param = array(
                    array(":RawLeadID", (int)strip_tags($data['ClientID']))
                );
                $query = " SELECT mf.Price,mf.isPositive,mf.FeedbackID,msa.ClientID, mf.FollowUpDateTime,mf.CreatedBy,mf.NextFollowUp_Discussion,mf.Remarks,ms.Status, msa.ClientName,mf.CreatedDateTime,u.Name as Createdby
                FROM `Marketing_Feedback` mf
                INNER JOIN Marketing_Status ms on ms.StatusID=mf.StatusID
                INNER JOIN Marketing_Sales_Activity msa on msa.ClientID=mf.RawLeadID
                INNER JOIN Users u on u.UserID=mf.CreatedBy
                where mf.RawLeadID=:RawLeadID ORDER BY FeedbackID DESC;";
                $ProjectResponseFeedback = DBController::getDataSet($query, $param);
                if ($ProjectResponseFeedback) {
                    return array("return_code" => true, "return_data" => $ProjectResponseFeedback);
                } else {
                    return array("return_code" => false, "return_data" => "Feedback not available for this Clients");
                }
                break;

            case 2: //for Leads Feedback flag

                $param = array(
                    array(":LeadID", (int)strip_tags($data['ClientID']))
                );
                $query = "SELECT mf.Price,mf.isPositive,mf.FeedbackID,mc.ClientID, mf.FollowUpDateTime,mf.CreatedBy,mf.NextFollowUp_Discussion,mf.Remarks,ms.Status, mc.ClientName,mf.CreatedDateTime,u.Name as Createdby
                FROM `Marketing_Feedback` mf
                INNER JOIN Marketing_Status ms on ms.StatusID=mf.StatusID
                INNER JOIN Marketing_Clients mc on mc.ClientID=mf.LeadID
                INNER JOIN Users u on u.UserID=mf.CreatedBy
                where mf.LeadID=:LeadID  ORDER BY FeedbackID DESC;";
                $ProjectResponseFeedback = DBController::getDataSet($query, $param);
                if ($ProjectResponseFeedback) {
                    return array("return_code" => true, "return_data" => $ProjectResponseFeedback);
                } else {
                    return array("return_code" => false, "return_data" => "Feedback not available for this Clients");
                }
                break;
            default:
                return array("return_code" => false, "return_data" => "Invalid flags");
        }
    }

    //get marketing client info
    function getMarketingClientInfo($data)
    {
        $flag = isset($data['flag']) ? $data['flag'] : null;
        $param = array(
            array(":ClientID", $data['MarketingClientID'])
        );

        switch ($flag) {
            case 1:
                // Code to execute when flag is 1
                $query = "SELECT msa.ClientID,msa.Logo,`ClientName`, `MobileNos`, `Lat`, `Longitute`, `Address`, `Pincode`,sn.NationalityName,ss.StateName, `EmailIDs`, `ContactPersons`, `ContactPersonNumber`,sc.CityName, `ContactPersonDesignation`, `LandLineNo`,msa.`Website`, `LandMark`, `Enrollments`, `InterestedProjectIDs`, GROUP_CONCAT(p.Name) as Interestedproducts, msa.`CreatedDateTime`,  msa.`Description`,mr.ProjectResponseID,ms.Status
            FROM Marketing_Sales_Activity msa
            left JOIN Settings_State ss on ss.StateID= msa.StateID
            left JOIN Settings_City sc on sc.CityId=msa.CityID
            left JOIN Products p on find_in_set(p.ProductID,msa.InterestedProjectIDs)
            left JOIN Settings_Nationality sn on sn.NationalityID=msa.CountryID
            left JOIN Marketing_Response mr on mr.ClientID=msa.ClientID
            left JOIN Marketing_Status ms on ms.StatusID=mr.CurrentStatus
            WHERE msa.`ClientID`=:ClientID  GROUP BY msa.ClientID,msa.Logo,`ClientName`, `MobileNos`, `Lat`, `Longitute`, `Address`, `Pincode`,sn.NationalityName,ss.StateName, `EmailIDs`, `ContactPersons`, `ContactPersonNumber`,sc.CityName, `ContactPersonDesignation`, `LandLineNo`,msa.`Website`, `LandMark`, `Enrollments`, `InterestedProjectIDs`, msa.`CreatedDateTime`,  msa.`Description`,mr.ProjectResponseID,ms.Status";
                $ClientInfo = DBController::sendData($query, $param);
                return array("return_code" => true, "return_data" => $ClientInfo);
                break;
            case 2:
                // Code to execute when flag is 2
                $query = "SELECT Marketing_Clients.ClientID,Marketing_Clients.Logo,`ClientName`, `MobileNos`, `Lat`, `Longitute`, `Address`, `Pincode`,sn.NationalityName,ss.StateName, `EmailIDs`, `ContactPersons`, `ContactPersonNumber`,sc.CityName, `ContactPersonDesignation`, `LandLineNo`,Marketing_Clients.`Website`, `LandMark`, `Enrollments`, `InterestedProjectIDs`, GROUP_CONCAT(p.Name) as Interestedproducts, Marketing_Clients.`CreatedDateTime`,  Marketing_Clients.`Description`,mr.ProjectResponseID,ms.Status
            FROM Marketing_Clients
            left JOIN Settings_State ss on ss.StateID= Marketing_Clients.StateID
            left JOIN Settings_City sc on sc.CityId=Marketing_Clients.CityID
            left JOIN Products p on find_in_set(p.ProductID,Marketing_Clients.InterestedProjectIDs)
            left JOIN Settings_Nationality sn on sn.NationalityID=Marketing_Clients.CountryID
            left JOIN Marketing_Response mr on mr.ClientID=Marketing_Clients.ClientID
            left JOIN Marketing_Status ms on ms.StatusID=mr.CurrentStatus
            WHERE Marketing_Clients.`ClientID`=:ClientID  GROUP BY Marketing_Clients.ClientID,Marketing_Clients.Logo,`ClientName`, `MobileNos`, `Lat`, `Longitute`, `Address`, `Pincode`,sn.NationalityName,ss.StateName, `EmailIDs`, `ContactPersons`, `ContactPersonNumber`,sc.CityName, `ContactPersonDesignation`, `LandLineNo`,Marketing_Clients.`Website`, `LandMark`, `Enrollments`, `InterestedProjectIDs`, Marketing_Clients.`CreatedDateTime`,  Marketing_Clients.`Description`,mr.ProjectResponseID,ms.Status";
                $ClientInfo = DBController::sendData($query, $param);
                return array("return_code" => true, "return_data" => $ClientInfo);
                break;
                // Add more cases as needed
            default:
                // Code to execute when flag doesn't match any case
        }
    }

    //to be disable/deleted after done
    function AddAllMarketingClients($data)
    {
        //check for available data
        if (isset($data['Clientdata'])) {
            //for shillong school only(For now)
            $shillongSchools = $data['Clientdata']['shillongSchool'];
            foreach ($shillongSchools as $shillongDetail) {

                //check if school is already there in DBs
                $param1 = array(
                    array(":ClientName", ucwords(trim($shillongDetail['Company Name']))),
                    array(":Address", ucwords(trim($shillongDetail['Address'])))
                );
                $query1 = "SELECT * FROM `Marketing_Clients` mc where mc.ClientName=:ClientName and mc.Address=:Address";
                $AvailableSchool = DBController::sendData($query1, $param1);
                if (!$AvailableSchool) {
                    //check phone number
                    if (isset($shillongDetail['Mobile1'])) {
                        $Mobile1 = str_ireplace(array(' ', '-', '(', ')', '+'), '', $shillongDetail['Mobile1']);
                        $phone1 = $Mobile1 . ',';
                    } else {
                        $phone1 = "";
                    }

                    if (isset($shillongDetail['Mobile2'])) {
                        $Mobile2 = str_ireplace(array(' ', '-', '(', ')', '+'), '', $shillongDetail['Mobile2']);
                        $phone2 = $Mobile2;
                    } else {
                        $phone2 = "";
                    }

                    $phoneNos = $phone1 . $phone2;

                    //for email
                    if (isset($shillongDetail['Email'])) {
                        $mail = ucwords(trim($shillongDetail['Email']));
                    } else {
                        $mail = "-";
                    }

                    //for landline
                    if (isset($shillongDetail['Landline'])) {
                        $landlineNumber = ucwords(trim($shillongDetail['Landline']));
                        $Landline = str_ireplace(array(' ', '-', '(', ')'), '', $landlineNumber);
                    } else {
                        $Landline = "0";
                    }

                    //pincode
                    if (isset($shillongDetail['Pincode'])) {
                        $pincode = ucwords(trim($shillongDetail['Pincode']));
                    } else {
                        $pincode = "-";
                        // ucwords(trim($shillongDetail['Pincode']))
                    }

                    // description
                    if (isset($shillongDetail['Review'])) {
                        $description = ucwords(trim($shillongDetail['Review']));
                    } else {
                        $description = "-";
                    }

                    //address
                    if (isset($shillongDetail['Address'])) {
                        $Address = ucwords(trim($shillongDetail['Address']));
                    } else {

                        $Address = ' ';
                        // ucwords(trim($shillongDetail['Address']))
                    }


                    //Contacted person
                    if (isset($shillongDetail['Firstname'])) {
                        $fName = ucwords(trim($shillongDetail['Firstname']));
                    } else {
                        $fName = '';
                    }
                    if (isset($shillongDetail['LastName'])) {
                        $lName = ucwords(trim($shillongDetail['LastName']));
                    } else {
                        $lName = '';
                    }
                    $contactedPersonname = $fName . ' ' . $lName;

                    //designation
                    if (isset($shillongDetail['Designation'])) {
                        $Designation = ucwords(trim($shillongDetail['Designation']));
                    } else {
                        $Designation = 'NA';
                    }

                    //landmark
                    if (isset($shillongDetail['landmark'])) {
                        $landmark = ucwords(trim($shillongDetail['landmark']));
                    } else {
                        $landmark = 'NA';
                    }

                    //State
                    if (isset($shillongDetail['State'])) {
                        //check if state is available or not
                        // $State=ucwords(trim($shillongDetail['State']));
                        $param3 = array(
                            array(":State", ucwords(trim($shillongDetail['State'])))
                        );
                        $query3 = "SELECT * FROM `Settings_State` where StateName=:State";
                        $StateInfo = DBController::sendData($query3, $param3);
                        if ($StateInfo) {
                            $StateID = $StateInfo['StateID'];
                        } else {
                            //add the state
                            $param4 = array(
                                array(":StateName", ucwords(trim($shillongDetail['State'])))
                            );
                            $query4 = "INSERT INTO `Settings_State`(`StateName`) VALUES (:StateName)";
                            $StateID = DBController::ExecuteSQLID($query4, $param4);
                        }
                    }

                    //city
                    if (isset($shillongDetail['city'])) {
                        $param5 = array(
                            array(":StateID", $StateID),
                            array(":CityName", ucwords(trim($shillongDetail['city'])))
                        );
                        $query5 = " SELECT * FROM `Settings_City` where StateID=:StateID and CityName=:CityName";
                        $cityInfo = DBController::sendData($query5, $param5);
                        if ($cityInfo) {
                            $cityID = $cityInfo['CityId'];
                        } else {
                            //add new
                            $param6 = array(
                                array(":Cityname", ucwords(trim($shillongDetail['city']))),
                                array(":StateID", $StateID),
                                array(":CountryID", 1), //india for now
                            );
                            $query6 = "INSERT INTO `settings_citys`(`CityName`, `StateID`, `CountryID`) VALUES (:Cityname,:StateID,:CountryID)";
                            $cityID = DBController::ExecuteSQLID($query6, $param6);
                        }
                    }

                    //website
                    if (isset($shillongDetail['Website'])) {
                        $website = ucwords(trim($shillongDetail['Website']));
                    } else {
                        $website = '';
                    }











                    // for now state-meghalaya,city-Shillong school only,country-India
                    //check for country (TODO)
                    // check for state (TODO)
                    // check for city(TODO)


                    // $MobileNo=ucwords(trim($shillongDetail['Mobile1'])).','.ucwords(trim($shillongDetail['Mobile2']));
                    $param = array(
                        array(":Client", ucwords(trim($shillongDetail['Company Name']))),
                        array(":MobileNo", $phoneNos),
                        array(":Lat", 0),
                        array(":Long", 0),
                        array(":Address", $Address),
                        array(":Pincode", $pincode),
                        array(":CountryId", 1),
                        array(":CityID", $cityID),
                        array(":StateID", $StateID),
                        array(":EmailIDs", $mail),
                        array(":ContactPersonName", $contactedPersonname),
                        array(":ContactPersonNumber", "0"),
                        array(":Designation", $Designation),
                        array(":Landline", $Landline),
                        array(":Website", $website),
                        array(":LandMark", $landmark),
                        array(":Enrollments", 0),
                        array(":ProductIDs", "1"), //prayagedu
                        array(":CreatedBy", $_SESSION['UserID']),
                        array(":Description", $description)
                    );

                    //add to DB
                    $query = "INSERT INTO `Marketing_Clients`(`ClientName`, `MobileNos`, `Lat`, `Longitute`, `Address`, `Pincode`,
                    `CountryID`, `CityID`, `StateID`, `EmailIDs`, `ContactPersons`, `ContactPersonNumber`, `ContactPersonDesignation`,
                    `LandLineNo`, `Website`, `LandMark`, `Enrollments`, `InterestedProjectIDs`, 
                    `CreatedBy`, `Description`)
                    VALUES (:Client,:MobileNo,:Lat,:Long,:Address,:Pincode,:CountryId,:CityID,:StateID,:EmailIDs,:ContactPersonName,:ContactPersonNumber,
                    :Designation,:Landline,:Website,:LandMark,:Enrollments,:ProductIDs,:CreatedBy,:Description)";
                    $SchoolDataRes = DBController::ExecuteSQLID($query, $param);
                    if ($SchoolDataRes) {
                        //add to status too
                        $param1 = array(
                            array(":ClientID", (int)$SchoolDataRes),
                            array(":CreatedBy", $_SESSION['UserID'])
                        );
                        $query1 = "INSERT INTO `Marketing_Response`(`ClientID`, `EntryByID`) VALUES (:ClientID,:CreatedBy)";
                        $marketingStatus = DBController::ExecuteSQL($query1, $param1);
                        if ($marketingStatus) {
                            DBController::logs("success");
                        }
                    } else {
                        DBController::logs("Error SChool : ", ucwords(trim($shillongDetail['Company Name'])));
                    }
                } else {

                    DBController::logs("Already Exist : ", ucwords(trim($shillongDetail['Company Name'])));

                    //add to feedback
                }
            }
        }
    }



    //let everyone update for now (Later   we can let only Admin Update the detail)
    function UpdateMarketingClient($data)
    {
        $param = array(
            array(":ClientID", $data['ID']),
            array(":Data", $data['Value'])
        );
        // $param = array(
        //     array(":ClientID", $data['ID'] ?? null),
        //     array(":Data", $data['Value'] ?? null)
        // );

        switch ($data['Field']) {
            case "ClientName":
                $query = "UPDATE `Marketing_Clients` set  ClientName=:Data where  ClientID=:ClientID";
                break;
            case "MobileNos":
                $query = "UPDATE `Marketing_Clients` set  MobileNos=:Data where  ClientID=:ClientID";
                break;
            case "EmailIDs":
                $query = "UPDATE `Marketing_Clients` set  EmailIDs=:Data where  ClientID=:ClientID";
                break;
            case "LandLineNo":
                $query = "UPDATE `Marketing_Clients` set  LandLineNo=:Data where  ClientID=:ClientID";
                break;
            case "Address":
                $query = "UPDATE `Marketing_Clients` set  Address=:Data where  ClientID=:ClientID";
                break;
            case "CountryID":
                $query = "UPDATE `Marketing_Clients` set  CountryID=:Data where  ClientID=:ClientID";
                break;
            case "StateID":
                $query = "UPDATE `Marketing_Clients` set  StateID=:Data where  ClientID=:ClientID";
                break;
            case "CityID":
                $query = "UPDATE `Marketing_Clients` set  CityID=:Data where  ClientID=:ClientID";
                break;
            case "LandMark":
                $query = "UPDATE `Marketing_Clients` set  LandMark=:Data where  ClientID=:ClientID";
                break;
            case "Pincode":
                $query = "UPDATE `Marketing_Clients` set  Pincode=:Data where  ClientID=:ClientID";
                break;
            case "Enrollments":
                $query = "UPDATE `Marketing_Clients` set  Enrollments=:Data where  ClientID=:ClientID";
                break;
            case "Website":
                $query = "UPDATE `Marketing_Clients` set  Website=:Data where  ClientID=:ClientID";
                break;
            case "ContactPersons":
                $query = "UPDATE `Marketing_Clients` set  ContactPersons=:Data where  ClientID=:ClientID";
                break;
            case "ContactPersonDesignation":
                $query = "UPDATE `Marketing_Clients` set  ContactPersonDesignation=:Data where  ClientID=:ClientID";
                break;
            case "ContactPersonNumber":
                $query = "UPDATE `Marketing_Clients` set  ContactPersonNumber=:Data where  ClientID=:ClientID";
                break;
                //need to check first before update
                // case "InterestedProjectIDs":
                //     $query="UPDATE `Marketing_Clients` set  InterestedProjectIDs=:Data where  ClientID=:ClientID";
                //     break;
            case "Lat":
                $query = "UPDATE `Marketing_Clients` set  Lat=:Data where  ClientID=:ClientID";
                break;
            case "Longitute":
                $query = "UPDATE `Marketing_Clients` set  Longitute=:Data where  ClientID=:ClientID";
                break;
            case "Description":
                $query = "UPDATE `Marketing_Clients` set  Description=:Data where  ClientID=:ClientID";
                break;

            default:
                return array("return_code" => false, "return_data" => "Please check the data before Update");
        }

        $res = DBController::ExecuteSQL($query, $param);
        if ($res) {
            return array("return_code" => true, "return_data" => "Sucessfully updated");
        } else {
            return array("return_code" => false, "return_data" => "error in updating..please check the data before update");
        }
    }

    function uploadLogo($data)
    {
        if (isset($data["Logo"])) {

            $image_info = getimagesize($data["Logo"]);
            $schoollogo = uniqid("LOGO") . "." . (isset($image_info["mime"]) ? explode('/', $image_info["mime"])[1] : "");
            file_put_contents("../app/data/temp/" . $schoollogo, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data["Logo"])));

            //get the old photo
            $param = array(
                array(":ClientID", strip_tags($data['ClientID']))
            );
            $query = "SELECT `Logo` FROM `Marketing_Clients` WHERE `ClientID`=:ClientID LIMIT 1";
            $photo = DBController::sendData($query,  $param);

            //update the new photo
            $params = array(
                array(":ClientID", strip_tags($data['ClientID'])),
                array(":Photo", $schoollogo)
            );

            $query = " UPDATE `Marketing_Clients` SET `Logo`=:Photo WHERE `ClientID` =:ClientID ";
            $res = DBController::ExecuteSQL($query, $params);

            if ($res) {
                $directory = "../app/data/marketing/";
                //create directory if does not exists
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }

                rename("../app/data/temp/" . $schoollogo, $directory . pathinfo($schoollogo, PATHINFO_BASENAME));

                if ($photo) {
                    $photo = "../app/data/marketing/" . pathinfo($photo["Logo"], PATHINFO_BASENAME);
                    if (file_exists($photo))
                        unlink($photo);
                }
                return array("return_code" => true, "return_data" => "sucessfully submitted");
            }
        }
        return array("return_code" => false, "return_data" => "Could Not Update!!!");
    }


    //adding new Marketing clients
    function AddRawLeads($data)
    {
        //update
        if (isset($data['ClientID'])) {
            $param = array(
                array(":Name", (string)strip_tags($data['Name'])),
                array(":PhoneNumbers", $data['PhoneNumbers']),
                // array(":lat", strip_tags($data['lat'])),
                // array(":long", strip_tags($data['long'])),
                array(":Address", (string)strip_tags($data['Address'])),
                array(":pincode", strip_tags($data['pincode'])),
                array(":CountryID", strip_tags($data['CountryID'])),
                array(":city", strip_tags($data['city'])),
                array(":stateID", strip_tags($data['stateID'])),
                array(":EmailIDs", $data['EmailIDs']),
                array(":ContactpersonName", strip_tags($data['ContactpersonName'])),
                array(":ContactPersonNumber", strip_tags($data['ContactPersonNumber'])),
                array(":ContactPersonDesignation", strip_tags($data['ContactPersonDesignation'])),
                array(":LandlineNo", strip_tags($data['LandlineNo'])),
                array(":website", strip_tags($data['website'])),
                array(":Landmark", strip_tags($data['Landmark'])),
                array(":enrollment", strip_tags($data['enrollment'])),
                array(":InterestedProductIDs", strip_tags($data['InterestedProductIDs'])),
                array(":CreatedBy", $_SESSION['UserID']),
                //array(":discussion", strip_tags($data['discussion']))
            );

            $query = "INSERT INTO `Marketing_Clients`(`ClientName`, `MobileNos`, `Address`, `Pincode`,
            `CountryID`, `CityID`, `StateID`, `EmailIDs`, `ContactPersons`, `ContactPersonNumber`, `ContactPersonDesignation`,
            `LandLineNo`, `Website`, `LandMark`, `Enrollments`, `InterestedProjectIDs`, 
            `CreatedBy`)
            VALUES (:Name,:PhoneNumbers,:Address,:pincode,:CountryID,:city,:stateID,:EmailIDs,:ContactpersonName,:ContactPersonNumber,
            :ContactPersonDesignation,:LandlineNo,:website,:Landmark,:enrollment,:InterestedProductIDs,:CreatedBy)";
            $res = DBController::ExecuteSQLID($query, $param);
            if ($res) {
                $param1 = array(
                    array(":ClientID", $data['ClientID'])
                );
                $query1 = "DELETE FROM  `Marketing_Sales_Activity` WHERE ClientID =:ClientID;";
                $movetoleads = DBController::ExecuteSQL($query1, $param1);
                if ($movetoleads) {
                    return array("return_code" => true, "return_data" => "Successfully Moved to Leads");
                }
            }
            return array("return_code" => false, "return_data" => "Error Occurred");
        }

        //add new one
        else {
            $param = array(
                array(":Name", (string)strip_tags($data['Name'])),
                array(":PhoneNumbers", $data['PhoneNumbers']),
                // array(":lat", strip_tags($data['lat'])),
                // array(":long", strip_tags($data['long'])),
                array(":Address", (string)strip_tags($data['Address'])),
                array(":pincode", strip_tags($data['pincode'])),
                array(":CountryID", strip_tags($data['CountryID'])),
                array(":city", strip_tags($data['city'])),
                array(":stateID", strip_tags($data['stateID'])),
                array(":EmailIDs", $data['EmailIDs']),
                array(":ContactpersonName", strip_tags($data['ContactpersonName'])),
                array(":ContactPersonNumber", strip_tags($data['ContactPersonNumber'])),
                array(":ContactPersonDesignation", strip_tags($data['ContactPersonDesignation'])),
                array(":LandlineNo", strip_tags($data['LandlineNo'])),
                array(":website", strip_tags($data['website'])),
                array(":Landmark", strip_tags($data['Landmark'])),
                array(":enrollment", strip_tags($data['enrollment'])),
                array(":AppointmentDate", strip_tags($data['AppointmentDate'])),
                array(":ColdCallDate", strip_tags($data['ColdCallDate'])),
                array(":InterestedProductIDs", strip_tags($data['InterestedProductIDs'])),
                array(":CreatedBy", $_SESSION['UserID']),
                // array(":discussion", strip_tags($data['discussion']))
            );
            $query = "INSERT INTO `Marketing_Sales_Activity`(`ClientName`, `MobileNos`, `Address`, `Pincode`,
                  `CountryID`, `CityID`, `StateID`, `EmailIDs`, `ContactPersons`, `ContactPersonNumber`, `ContactPersonDesignation`,
                  `LandLineNo`, `Website`, `LandMark`, `Enrollments`, `AppointmentDate`, `ColdCallDate`,`InterestedProjectIDs`, 
                  `CreatedBy`)
                  VALUES (:Name,:PhoneNumbers,:Address,:pincode,:CountryID,:city,:stateID,:EmailIDs,:ContactpersonName,:ContactPersonNumber,
                  :ContactPersonDesignation,:LandlineNo,:website,:Landmark,:enrollment,:AppointmentDate,:ColdCallDate,:InterestedProductIDs,:CreatedBy)";
            $res = DBController::ExecuteSQLID($query, $param);

            if ($res) {
                //add to status too
                $param1 = array(
                    array(":ClientID", $res),
                    array(":CreatedBy", $_SESSION['UserID']),
                );
                $query1 = "INSERT INTO `Marketing_Response`(`ClientID`,`EntryByID`) VALUES (:ClientID,:CreatedBy)";
                $marketingStatus = DBController::ExecuteSQL($query1, $param1);
                if ($marketingStatus) {
                    return array("return_code" => true, "return_data" => "Successfully Added");
                }
            } else {
                return array("return_code" => false, "return_data" => "An Error occurs while Submitting.Please try again.");
            }
        }
    }

    /*  Info:
       
    
        Description: To get All Marketing Raw Leads By Joining multiple tables
            27-02-2024 (Devkanta) : Added the Function
    */

    function getAllMarketingRawLeads()
    {
        // check if Admin then view all
        // if(isset($_SESSION['UserType']) && $_SESSION['UserType']==1)
        // {

        // $query="SELECT DISTINCT `ClientID`, `ClientName`, `MobileNos`, `Lat`, `Longitute`, `Address`, `Pincode`,sn.NationalityName,sc.CityName,Marketing_Clients.`StateID` , IFNULL(ss.StateName, 'N/A') as StateName, `EmailIDs`, `ContactPersons`, `ContactPersonNumber`, `ContactPersonDesignation`, `LandLineNo`,Marketing_Clients.`Website`, `LandMark`, `Enrollments`, `InterestedProjectIDs`, GROUP_CONCAT(p.Name) as productName, `UpdatedBy`,Marketing_Clients.`Description`,Marketing_Clients.CountryID as countryid,Marketing_Clients.CityID
        // FROM `Marketing_Clients` 
        // LEFT JOIN Settings_State ss on ss.StateID=Marketing_Clients.StateID
        // LEFT JOIN Settings_City sc on sc.CityId=Marketing_Clients.CityID
        // LEFT JOIN Settings_Nationality sn on sn.NationalityID=Marketing_Clients.CountryID
        // left JOIN Products p on find_in_set(p.ProductID,Marketing_Clients.InterestedProjectIDs)
        // GROUP BY Marketing_Clients.ClientID;";  old query 
        $query = "SELECT 
                `ClientID`,
                GROUP_CONCAT(DISTINCT `ClientName`) AS `ClientName`, 
                GROUP_CONCAT(DISTINCT `MobileNos`) AS `MobileNos`, 
                GROUP_CONCAT(DISTINCT `Lat`) AS `Lat`, 
                GROUP_CONCAT(DISTINCT `Longitute`) AS `Longitute`, 
                GROUP_CONCAT(DISTINCT `Address`) AS `Address`, 
                GROUP_CONCAT(DISTINCT `Pincode`) AS `Pincode`,
                GROUP_CONCAT(DISTINCT sn.NationalityName) AS `NationalityName`, 
                GROUP_CONCAT(DISTINCT sc.CityName) AS `CityName`,
                GROUP_CONCAT(DISTINCT msa.`StateID`) AS `StateID`, 
                GROUP_CONCAT(DISTINCT IFNULL(ss.StateName, 'N/A')) AS `StateName`, 
                GROUP_CONCAT(DISTINCT `EmailIDs`) AS `EmailIDs`, 
                GROUP_CONCAT(DISTINCT `ContactPersons`) AS `ContactPersons`, 
                GROUP_CONCAT(DISTINCT `ContactPersonNumber`) AS `ContactPersonNumber`, 
                GROUP_CONCAT(DISTINCT `ContactPersonDesignation`) AS `ContactPersonDesignation`, 
                GROUP_CONCAT(DISTINCT `LandLineNo`) AS `LandLineNo`,
                GROUP_CONCAT(DISTINCT msa.`Website`) AS `Website`, 
                GROUP_CONCAT(DISTINCT `LandMark`) AS `LandMark`, 
                GROUP_CONCAT(DISTINCT `Enrollments`) AS `Enrollment`, 
                GROUP_CONCAT(DISTINCT `InterestedProjectIDs`) AS `InterestedProjectIDs`, 
                GROUP_CONCAT(DISTINCT `AppointmentDate`) AS `AppointmentDate`, 
                GROUP_CONCAT(DISTINCT `ColdCallDate`) AS `ColdCallDate`, 
                GROUP_CONCAT(DISTINCT p.Name) AS `productName`, 
                GROUP_CONCAT(DISTINCT `UpdatedBy`) AS `UpdatedBy`,
                GROUP_CONCAT(DISTINCT msa.`Description`) AS `Description`,
                GROUP_CONCAT(DISTINCT msa.CountryID) AS `CountryID`,
                GROUP_CONCAT(DISTINCT msa.CityID) AS `CityID`
            FROM `Marketing_Sales_Activity`  msa
            LEFT JOIN Settings_State ss ON ss.StateID = msa.StateID
            LEFT JOIN Settings_City sc ON sc.CityId = msa.CityID
            LEFT JOIN Settings_Nationality sn ON sn.NationalityID = msa.CountryID
            LEFT JOIN Products p ON FIND_IN_SET(p.ProductID, msa.InterestedProjectIDs)
            GROUP BY `ClientID`;"; //new query 
        $allMarketingClients = DBController::getDataSet($query);
        if ($allMarketingClients) {
            return array("return_code" => true, "return_data" => $allMarketingClients);
        } else {
            return array("return_code" => false, "return_data" => "Data Not Available for now");
        }

        // }
        // else{
        //     return array("return_code" => false, "return_data" => "Permision Denied");
        // }
    }

    // function addWhatsappCampaign($data)
    // {


    //     $params = array(
    //         array(":CampaignName", $data['CampaignName']),
    //         array(":CampaignMessage", $data['CampaignMessage']),
    //         array(":CreatedByID", $_SESSION['UserID']),
    //     );

    //     $query = "INSERT INTO `Marketing_WhatsApp_Campaign`(`CampaignName`,`CampaignMessage`,`CreatedByID`) VALUES (:CampaignName,:CampaignMessage,:CreatedByID)";
    //     $res = DBController::ExecuteSQLID($query, $params);
    //     if ($res) {

    //         $Contactdata = $data["ContactsData"];
    //         for ($i = 0; $i < count($data); $i++) {
    //             $param = array(
    //                 array(":ContactsNo", $Contactdata[$i]["Contact"]),
    //                 array(":CreatedBy", $_SESSION['UserID']),
    //             );
    //             $q = "INSERT INTO  Marketing_WhatsAppCampaign_Details(CampaignID,ContactNo,CreatedByID) VALUES (:$res,:ContactsNo,:CreatedByID)";
    //             $result = DBController::ExecuteSQLID($q, $param);
    //             if ($result) {
    //                 return array("return_code" => true, "return_data" => "Successfully Added");
    //             } else {
    //                 return array("return_code" => false, "return_data" => "An Error occurs while Submitting.Please try again.");
    //             }
    //         }
    //     } else {
    //         return array("return_code" => false, "return_data" => "An Error occurs while Submitting.Please try again.");
    //     }
    // }
    function addWhatsappCampaign($data)
    {
        $params = array(
            array(":CampaignName", $data['CampaignName']),
            array(":CampaignMessage", $data['CampaignMessage']),
            array(":CreatedByID", $_SESSION['UserID']),
        );

        $query = "INSERT INTO `Marketing_WhatsApp_Campaign`(`CampaignName`,`CampaignMessage`,`CreatedByID`) VALUES (:CampaignName,:CampaignMessage,:CreatedByID)";
        $res = DBController::ExecuteSQLID($query, $params);

        if ($res) {
            $Contactdata = $data["ContactsData"];
            foreach ($Contactdata as $contact) {
                $param = array(
                    array(":CampaignID", $res),
                    array(":ContactsNo", $contact["Contact"]),
                    array(":CreatedByID", $_SESSION['UserID']),
                );

                $q = "INSERT INTO  Marketing_WhatsAppCampaign_Details(CampaignID,ContactNo,CreatedByID) VALUES (:CampaignID,:ContactsNo,:CreatedByID)";
                $result = DBController::ExecuteSQLID($q, $param);
                if (!$result) {
                    return array("return_code" => false, "return_data" => "An Error occurs while Submitting.Please try again.");
                }
            }

            return array("return_code" => true, "return_data" => "Successfully Added");
        } else {
            return array("return_code" => false, "return_data" => "An Error occurs while Submitting.Please try again.");
        }
    }

    function getAllWhatsappCampaign()
    {
        $query = "SELECT * FROM `Marketing_WhatsApp_Campaign`";
        $allMarketingClients = DBController::getDataSet($query);
        if ($allMarketingClients) {
            return array("return_code" => true, "return_data" => $allMarketingClients);
        } else {
            return array("return_code" => false, "return_data" => "Data Not Available for now");
        }
    }

    function changeactivestatus($data)
    {
        $params = array(
            array(":CampaignID", strip_tags($data["CampaignID"])),
            array(":isActive", (bool)(strip_tags($data["isActive"]))),
        );

        $update = "UPDATE `Marketing_WhatsApp_Campaign` SET `isActive`=:isActive WHERE `CampaignID`=:CampaignID";
        $res3 = DBController::ExecuteSQL($update, $params);
        if ($res3) {
            return array("return_code" => true, "return_data" => "Sucessfully Updated");
        } else {
            return array("return_code" => false, "return_data" => "Unable to update at this point of time.");
        }
    }

    function getAllActiveWhatsappCampaign()
    { //API call
        $query = "SELECT * FROM `Marketing_WhatsApp_Campaign` WHERE `isActive`=1";
        $allMarketingClients = DBController::getDataSet($query);
        if ($allMarketingClients) {
            return array("return_code" => true, "return_data" => $allMarketingClients);
        } else {
            return array("return_code" => false, "return_data" => "Data Not Available for now");
        }
    }

    function getAllContactsByCampaignID($data)
    {

        $params = array(
            array(":CampaignID", strip_tags($data["CampaignID"])),
        );
        $query = "SELECT ContactNo FROM `Marketing_WhatsAppCampaign_Details` WHERE `CampaignID`=:CampaignID";
        $allMarketingClientsNo = DBController::getDataSet($query, $params);
        if ($allMarketingClientsNo) {
            return array("return_code" => true, "return_data" => $allMarketingClientsNo);
        } else {
            return array("return_code" => false, "return_data" => "Data Not Available for now");
        }
    }
}
