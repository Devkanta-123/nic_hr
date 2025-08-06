<?php

/*
    Current Version: 2.0.0
    Created By: Angelbert Riahtam prayagedu@techz.in
    Created On: 23-01-2023
    Modified By:
    Modified On:
*/
namespace app\modules\settings\classes;
use \app\database\DBController;

class Calendar{

    /*  Info:
        Description: Getting all the type of calendar(Holiday/Work, etc)
            23-01-2024 (Angelbert Riahtam) : Adding the function      
    */
    function getCalendarTextType($data)
    {

        $query="SELECT CalendarTextTypeID,CalendarTextType,CalendarTextColour,isHoliday FROM `Academics_CalendarTextType`;";
        $res = DBController::getDataSet($query);
        if ($res)
            return array("return_code" => true, "return_data" => $res);

        return array("return_code" => false, "return_data" => array());
    }

    /*  Info:
        Description: Getting all the data based on the particular year
            23-01-2024 (Angelbert Riahtam) : Adding the function      
    */
    public function getCompanyCalendar($data)
    {
        $query="SELECT ac.AcademicsCalendarID,ac.CalendarDate,ac.CalendarText,ac.CalendarTextTypeID, actyp.CalendarTextType from Academics_Calendar ac INNER JOIN Academics_CalendarTextType actyp on actyp.CalendarTextTypeID=ac.CalendarTextTypeID where year(ac.CalendarDate)=year(CURDATE())  ORDER BY ac.CalendarDate ASC;";
        $res = DBController::getDataSet($query);
        if ($res)
        {
            return array("return_code" => true, "return_data" => $res);
        }
        else{
            return array("return_code" => false, "return_data" => array());
        }
    }

    /*  Info:
        Description: Adding and updating of the Calendar
            23-01-2024 (Angelbert Riahtam) : Adding the function      
    */
    function addCalendar($data)
    {
        //for updating the calendar
        if(isset($data["AcademicsCalendarID"]))
        { 
            $params=array(
                array(":CalendarText",strip_tags($data["CalendarText"])),
                array(":CalendarDate",$data["CalendarDate"]),
                array(":calendarTextType",strip_tags($data["calendarTextType"])),
                array(":AcademicsCalendarID",strip_tags($data["AcademicsCalendarID"])),
            );
                $query="UPDATE `Academics_Calendar` SET `AcademicsCalendarID`=:AcademicsCalendarID,`CalendarDate`=:CalendarDate,`CalendarText`=:CalendarText,`CalendarTextTypeID`=:calendarTextType WHERE `AcademicsCalendarID`=:AcademicsCalendarID;";
                $res=DBController::ExecuteSQL($query,$params);
                if($res) 
                {
                    return array("return_code" => true, "return_data" => "Data Updated");
                } 
                else
                {
                    return array("return_code" => false, "return_data" => "Data Could Not be Updated");
                }
        }
        else
        {
            //first check if already Exist
            $params=array(
                array(":CalendarText",strip_tags($data["CalendarText"])),
                array(":CalendarDate",$data["CalendarDate"]),
            );

            $query = "SELECT CalendarDate FROM Academics_Calendar WHERE CalendarDate=:CalendarDate AND CalendarText=:CalendarText;";
            $res = DBController::sendData($query, $params); 
            if ($res) 
                {
                    return array("return_code" => false, "return_data" => "Data Already Exist");
                }

            else{
                //if not exist add new one
                $params=array(
                        array(":CalendarText", strip_tags($data["CalendarText"])),
                        array(":CalendarDate",$data["CalendarDate"]),
                        array(":calendarTextType",strip_tags($data["calendarTextType"])),
                    );
                
                    $query="INSERT INTO `Academics_Calendar`( `CalendarDate`, `CalendarText`, `CalendarTextTypeID`) VALUES (:CalendarDate,:CalendarText,:calendarTextType);";
                    $res=DBController::ExecuteSQLID($query,$params);
                if($res)
                    {
                        return array("return_code" => true, "return_data"=>"Added Sucessfully");  
                    }
                return array("return_code" => false, "return_data" => " An Error while saving the data"); 
            }
        }
    }


    /*  Info:
        Description: Deleting the Calendar based on ID
            23-01-2024 (Angelbert Riahtam) : Adding the function      
    */
    function deleteCalendar($data)
    {
        $params=array(
            array(":AcademicsCalendarID",strip_tags($data["AcademicsCalendarID"])),
        );

        $query="DELETE FROM `Academics_Calendar` where `AcademicsCalendarID`=:AcademicsCalendarID;";
        $res=DBController::ExecuteSQL($query,$params);
        if($res)
        {
            return array("retrun_code" => true, "return_data" => "Sucessfully Removed");
        }
        else{
            return array("retrun_code" => false, "return_data" => "An Error occur while deleting.");
        }
    }

}