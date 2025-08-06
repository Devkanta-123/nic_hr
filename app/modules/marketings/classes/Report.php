<?php

namespace app\modules\marketings\classes;

use app\database\DBController;
use app\misc\SMS;

class Report
{

    function getMarketingStatusandTotalNumber()
    {
        //all clients
        $query = "SELECT Count(*) as allclients FROM `Marketing_Clients`";
        $allclients = DBController::sendData($query);

        //initial
        $query1 = "SELECT count(*) as JustAdded FROM  Marketing_Clients mc
        inner join `Marketing_Response` mr on mr.ClientID=mc.ClientID
        where mr.CurrentStatus=8;";
        $justAddedRes = DBController::sendData($query1);

        //lead
        $query2 = "SELECT count(*) as Leads FROM  Marketing_Clients mc
        inner join `Marketing_Response` mr on mr.ClientID=mc.ClientID
        where mr.CurrentStatus=6;";
        $LeadRes = DBController::sendData($query2);

        //canceled
        $query3 = "SELECT count(*) as Canceled FROM  Marketing_Clients mc
        inner join `Marketing_Response` mr on mr.ClientID=mc.ClientID
        where mr.CurrentStatus=5;";
        $CancelRes = DBController::sendData($query3);

        //leadclose
        $query4 = "SELECT count(*) as LeadClose FROM  Marketing_Clients mc
        inner join `Marketing_Response` mr on mr.ClientID=mc.ClientID
        where mr.CurrentStatus=4;";
        $LeadcloseRes = DBController::sendData($query4);

        //followUp
        $query5 = "SELECT count(*) as FollowUp FROM  Marketing_Clients mc
        inner join `Marketing_Response` mr on mr.ClientID=mc.ClientID
        where mr.CurrentStatus=3;";
        $FollowUpRes = DBController::sendData($query5);

        //appointment
        $query6 = "SELECT count(*) as Appointment FROM  Marketing_Clients mc
        inner join `Marketing_Response` mr on mr.ClientID=mc.ClientID
        where mr.CurrentStatus=2;";
        $AppointmentRes = DBController::sendData($query6);

        //called
        $query7 = "SELECT count(*) as called FROM  Marketing_Clients mc
        inner join `Marketing_Response` mr on mr.ClientID=mc.ClientID
        where mr.CurrentStatus=1;";
        $CalledRes = DBController::sendData($query7);


        //totoalclientbasedonProductID
        $query8 = "select count(*) as total,Products.Name from Marketing_Clients
        INNER JOIN Products on Products.ProductID in (Marketing_Clients.InterestedProjectIDs)
        GROUP BY Products.ProductID;";
        $totalProductandProductres = DBController::getDataSet($query8);

        //today visit
        // check if staff
        if ($_SESSION['UserType'] == 2) // staff
        {
            $param9 = array(
                array("UserID", $_SESSION['UserID'])
            );

            $query9 = "SELECT mf.Price, mf.NextFollowUp_Discussion, mf.FeedbackID, date(mf.FollowUpDateTime) as FollowUpDateTime , date(mf.CreatedDateTime) as addedOn,mf.Remarks,mc.ClientName,mc.MobileNos,mc.EmailIDs,ms.Status
            FROM `Marketing_Feedback` mf
            INNER JOIN Marketing_Clients mc on mc.ClientID=mf.LeadID
            INNER JOIN Marketing_Status ms on ms.StatusID=mf.StatusID
            where date(mf.CreatedDateTime)=CURRENT_DATE()  and mf.CreatedBy=:UserID;";
            $Todayvisited = DBController::getDataSet($query9, $param9);
        }

        // for admin
        else {
            $query9 = "SELECT  mf.Price, mf.NextFollowUp_Discussion, mf.FeedbackID, date(mf.FollowUpDateTime) as FollowUpDateTime , date(mf.CreatedDateTime) as addedOn,mf.Remarks,mc.ClientName,mc.MobileNos,mc.EmailIDs,ms.Status
            FROM `Marketing_Feedback` mf
            INNER JOIN Marketing_Clients mc on mc.ClientID=mf.LeadID
            INNER JOIN Marketing_Status ms on ms.StatusID=mf.StatusID
            where date(mf.CreatedDateTime)=CURRENT_DATE();";
            $Todayvisited = DBController::getDataSet($query9);
        }


        // lead close
        $closedealquery = "SELECT count(*) as closellead FROM `Marketing_Response` where CurrentStatus=4;";
        $closelead = DBController::sendData($closedealquery);
        $res['Called'] = $CalledRes['called'];
        $res['Appointment'] = $AppointmentRes['Appointment'];
        $res['FollowUp'] = $FollowUpRes['FollowUp'];
        $res['LeadClose'] = $LeadcloseRes['LeadClose'];
        $res['Canceled'] = $CancelRes['Canceled'];
        $res['Lead'] = $LeadRes['Leads'];
        $res['JustAdded'] = $justAddedRes['JustAdded'];
        $res['allclients'] = $allclients['allclients'];
        $res['TotalClientandProductName'] = $totalProductandProductres;
        $res['TodayVisited'] = $Todayvisited;
        $res['CloseDeal'] = $closelead;

        return array("return_code" => true, "return_data" => $res);
    }

    function getClientBasedOnStatusID($data)
    {
        if (isset($data['Status'])) {
            //parameter
            $param = array(
                array(":CurrentStatus", $data['Status'])
            );

            if ($data['Status'] == 1) {
                // $query="SELECT mc.ClientID,mc.`ClientName`, mc.`MobileNos`, mc.`Address`, mc.`Pincode`, mc.`EmailIDs`, mc.`ContactPersons`, mc.`ContactPersonNumber`, mc.`ContactPersonDesignation`, mc.`LandLineNo`, mc.`Website`, mc.`LandMark`, mc.`Enrollments`
                // FROM `Marketing_Clients` mc
                // INNER JOIN Marketing_Response mr on mr.ClientID=mc.ClientID
                // INNER JOIN Setting_State ss on ss.StateID=mc.StateID
                // INNER JOIN Settings_City  sc on sc.CityId=mc.CityID
                // WHERE mr.CurrentStatus=:CurrentStatus;";

                $query = "SELECT mr.CurrentPrice, mc.ClientID,mc.`ClientName`, mc.`MobileNos`, mc.`Address`, mc.`Pincode`, mc.`EmailIDs`, mc.`ContactPersons`, mc.`ContactPersonNumber`, mc.`ContactPersonDesignation`, mc.`LandLineNo`, mc.`Website`, mc.`LandMark`, mc.`Enrollments`,ss.StateName,sc.CityName
                FROM `Marketing_Clients` mc
                INNER JOIN Marketing_Response mr on mr.ClientID=mc.ClientID
                INNER JOIN Settings_State ss on ss.StateID=mc.StateID
                INNER JOIN Settings_City  sc on sc.CityId=mc.CityID
                WHERE mr.CurrentStatus=:CurrentStatus;";
            } else {
                $query = "SELECT mr.CurrentPrice, mc.ClientID,mc.`ClientName`, mc.`MobileNos`, mc.`Address`, mc.`Pincode`, mc.`EmailIDs`, mc.`ContactPersons`, mc.`ContactPersonNumber`, mc.`ContactPersonDesignation`, mc.`LandLineNo`, mc.`Website`, mc.`LandMark`, mc.`Enrollments`,ss.StateName,sc.CityName
                FROM `Marketing_Clients` mc
                INNER JOIN Marketing_Response mr on mr.ClientID=mc.ClientID
                INNER JOIN Settings_State ss on ss.StateID=mc.StateID
                INNER JOIN Settings_City  sc on sc.CityId=mc.CityID
                WHERE mr.CurrentStatus=:CurrentStatus;";
            }
            $Clientdata = DBController::getDataSet($query, $param);
            return array("return_code" => true, "return_data" => $Clientdata);
        } else {
            return array("return_code" => false, "return_data" => "Data not Available");
        }
    }

    //today task
    function getAllTodaystask()
    {
        // get the task that need to do today based on the one he added
        if ($_SESSION['UserType'] == 2) //staff
        {
            // get the data of that user only
            $param = array(
                array(":UserID", $_SESSION['UserID']),
            );
            $query = "SELECT mf.NextFollowUp_Discussion, mf.Remarks,mf.FollowUpDateTime,mf.StatusID,mc.ClientName,mc.MobileNos,mc.EmailIDs,mc.ClientID,ms.Status
            FROM `Marketing_Feedback` mf 
            INNER JOIN Marketing_Clients mc on mc.ClientID=mf.ClientID
            INNER JOIN Marketing_Status ms on ms.StatusID=mf.StatusID
            where date(mf.FollowUpDateTime)=CURDATE() and mf.CreatedBy=:UserID;";
            $TodayTask = DBController::getDataSet($query, $param);
        }

        //admin
        else {
            $query = "SELECT mf.NextFollowUp_Discussion, mf.Remarks,mf.FollowUpDateTime,mf.StatusID,mc.ClientName,mc.MobileNos,mc.EmailIDs,mc.ClientID,ms.Status
                FROM `Marketing_Feedback` mf 
                INNER JOIN Marketing_Clients mc on mc.ClientID=mf.LeadID
                INNER JOIN Marketing_Status ms on ms.StatusID=mf.StatusID
                where date(mf.FollowUpDateTime)=CURDATE();";
            $TodayTask = DBController::getDataSet($query);
        }
        return array("return_code" => true, "return_data" => $TodayTask);
    }

    //reminder for >7 days before
    //get the data for marketing between the currendate and currendate +7 days
    function getTaskFor7daybefore()
    {

        $this->sendSMS();

        //staff
        if ($_SESSION['UserType'] == 2) {
            $param = array(
                array(":UserID", $_SESSION['UserID']),
            );
            $query = "SELECT mf.FeedbackID, date(mf.FollowUpDateTime) as FollowUpDateTime , date(mf.CreatedDateTime) as addedOn,mf.Remarks,mc.ClientName,mc.MobileNos,mc.EmailIDs,ms.Status
            FROM `Marketing_Feedback` mf
            INNER JOIN Marketing_Clients mc on mc.ClientID=mf.ClientID
            INNER JOIN Marketing_Status ms on ms.StatusID=mf.StatusID
            where mf.CreatedBy=:UserID and  Date(mf.FollowUpDateTime) BETWEEN CURDATE() and DATE_ADD(CURDATE(), INTERVAL 7 DAY);";
            $res = DBController::getDataSet($query, $param);
        } else {
            // admin
            $query = "SELECT mf.FeedbackID, date(mf.FollowUpDateTime) as FollowUpDateTime , date(mf.CreatedDateTime) as addedOn,mf.Remarks,mc.ClientName,mc.MobileNos,mc.EmailIDs,ms.Status
        FROM `Marketing_Feedback` mf
        INNER JOIN Marketing_Clients mc on mc.ClientID=mf.LeadID
        INNER JOIN Marketing_Status ms on ms.StatusID=mf.StatusID
        where Date(mf.FollowUpDateTime) BETWEEN CURDATE() and DATE_ADD(CURDATE(), INTERVAL 7 DAY);";
            $res = DBController::getDataSet($query);
        }

        return array("return_code" => true, "return_data" => $res);
    }

    //reminder 1 day before
    function sendSMS()
    {
        //get the client that need to folowup tomorrow
        $query = "SELECT mf.CreatedBy,mf.FeedbackID, date(mf.FollowUpDateTime) as FollowUpDateTime , date(mf.CreatedDateTime) as addedOn,mf.Remarks,mc.ClientName,mc.MobileNos,mc.EmailIDs,ms.Status
        FROM `Marketing_Feedback` mf
        INNER JOIN Marketing_Clients mc on mc.ClientID=mf.LeadID
        INNER JOIN Marketing_Status ms on ms.StatusID=mf.StatusID
        where Date(mf.FollowUpDateTime) = DATE_ADD(CURDATE(), INTERVAL 1 DAY);";
        $res = DBController::getDataSet($query);
        if ($res) {
            foreach ($res as $clientData) {
                $param1 = array(
                    array(":UserID", $clientData['CreatedBy'])
                );
                $query1 = "SELECT `Name`,`EmailID`, `ContactNo`, `isActive` FROM `Users` WHERE `UserID`=:UserID";
                $StaffData = DBController::sendData($query1, $param1);
                if ($StaffData['isActive'] == 1) {
                    // send sms
                    // SMS::SendSms("Signup", $StaffData['ContactNo'],
                    //     [
                    //         "personname" => $StaffData['Name'],
                    //         "applicationname" => "PrayagEdu App/Portal",
                    //         "username" =>   "test" ,
                    //         "password" =>   "123",
                    //         "regards" =>  'ITPL'
                    //     ]
                    // );
                    // $message="You have ".$clientData['Status']." on ".$clientData['FollowUpDateTime']. " with " . $clientData['ClientName'].". Thank you";
                    // $message="test";

                    // "name" => $StaffData['Name'],
                    // "title" =>  "Marketing Reminder",
                    // "description" => $message,
                    // "organization" =>  "ITPL",
                    // SMS::SendSms("PrayagEduBirthdayWishOneT", $StaffData['ContactNo'],
                    //     [  
                    //         "status"=> $clientData['Status'],
                    //         "Client" => $clientData['ClientName'],
                    //         "dte" => $clientData['FollowUpDateTime']
                    //     ]
                    // );
                }
            }
        }
    }


    // get all the close deal
    function getallCloseDeal()
    {
        // check if admin
        if (isset($_SESSION['Usertype']) && $_SESSION['Usertype'] == 1) {
            $query = "SELECT `ProjectResponseID`, Marketing_Response.`ClientID`, `CurrentStatus`,  `EntryDateTime`, `EntryByID`,mc.ClientName,mc.MobileNos,mc.Address,mc.Pincode,sn.NationalityName,sc.CityName,ss.StateName, mc.CityID,mc.StateID,mc.EmailIDs,mc.Website,mc.InterestedProjectIDs,mc.LandLineNo,p.Name
                FROM `Marketing_Response`
                INNER JOIN Marketing_Clients mc on mc.ClientID=Marketing_Response.ClientID
                INNER JOIN Settings_Nationality sn on sn.NationalityID=mc.CountryID
                INNER JOIN Settings_City sc on sc.CityId=mc.CityID
                INNER JOIN Settings_State ss on ss.StateID=mc.StateID 
                INNER JOIN Products p on p.ProductID=mc.InterestedProjectIDs
                WHERE `CurrentStatus`= 4;";
            $CloseDeal = DBController::getDataSet($query);
            return array("return_code" => true, "return_data" => $CloseDeal);
        } else {
            return array("return_code" => true, "return_data" => []);
        }
    }

    function getAllMarketingStatusesForChart()
    {
        // SELECT count(*) as JustAdded FROM  Marketing_Clients mc
        // inner join `Marketing_Response` mr on mr.ClientID=mc.ClientID
        // where mr.CurrentStatus=8

        $query = "SELECT 
        SUM(COALESCE(CASE WHEN mr.CurrentStatus = 1 THEN 1 ELSE 0 END, 0)) AS Called,
        SUM(COALESCE(CASE WHEN mr.CurrentStatus = 2 THEN 1 ELSE 0  END,0)) AS Appointment,
        SUM(COALESCE(CASE WHEN mr.CurrentStatus = 3 THEN 1 ELSE 0 END,0)) AS FollowUp,
        SUM(COALESCE(CASE WHEN mr.CurrentStatus = 4 THEN 1 ELSE 0 END,0)) AS LeadClose,
        SUM(COALESCE(CASE WHEN mr.CurrentStatus = 5 THEN 1 ELSE 0 END,0)) AS Canceled,
        SUM(COALESCE(CASE WHEN mr.CurrentStatus = 6 THEN 1 ELSE 0 END,0)) AS Leads,
        SUM(COALESCE(CASE WHEN mr.CurrentStatus = 7 THEN 1 ELSE 0 END,0)) AS Initially
        
        -- add more types of Leave later 
    FROM Marketing_Clients mc
    INNER JOIN `Marketing_Response` mr ON mr.ClientID=mc.ClientID
    GROUP BY mc.ClientID";

        $res = DBController::getDataSet($query);

        if ($res) {
            // Extract the first row as it contains the aggregated data
            $data = $res[0];
            // Return data in the expected format
            return array("return_code" => true, "return_data" => $data);
        } else {
            $errorMessage = "No Data Found for the month";
            return array("return_code" => false, "return_data" => $errorMessage);
        }
    }
}
