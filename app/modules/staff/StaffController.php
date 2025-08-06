<?php


/* 
    Current Version: 1.0.0
    Created By: Devkanta,     dev1@techz.in
    Created On: 19/01/2024
    Modified By:
    Modified On: 

*/

namespace app\modules\staff;

use app\core\Controller;
use app\database\DBController;
use app\modules\staff\classes\Intern;
use app\modules\staff\classes\Staff;
use app\modules\staff\classes\StaffAttendance;
use app\modules\staff\classes\InternAttendance;
use app\modules\staff\classes\StaffAttendanceSettings;
use app\modules\staff\classes\InternAttendanceSettings;
use app\modules\staff\classes\Cronjob;
use \app\modules\staff\classes\Leaves;
use \app\modules\staff\classes\DailyTask;
use \app\modules\staff\classes\Warning;
use \app\modules\staff\classes\Payroll;

class StaffController implements Controller
{
    public function Route($data)
    {
        $jsondata = $data["JSON"];

        switch ($data["Page_key"]) {
            case "requestLeave":
                return (new Leaves())->requestLeave($jsondata);

                //staff
            case "addStaff":
                return (new Staff())->addStaff($jsondata);

                //update all field (NOT USING FOR NOW)
            case "updateStaff":
                return (new Staff())->updateStaff($jsondata);

                //only one field
            case "updateStaffInfo":
                return (new Staff())->updateStaffInfo($jsondata);

            case 'getStaff':
                return (new Staff())->getStaff($jsondata);


            case 'getDepartureStaff':
                return (new Staff())->getDepartureStaff();


            case "getStaffProfileData":
                return (new Staff())->getStaffProfileData($jsondata);

            case "updateStaffOffice":
                return (new Staff())->updateStaffOffice($jsondata);

            case "saveStaffPhoto":
                return (new Staff())->saveStaffPhoto($jsondata);

            case "getStaffByDepartment":
                return (new Staff())->getStaffByDepartment($jsondata);

            case "getUserInfo":
                return (new Staff())->getUserInfo($jsondata); //added by Devkanta on 13/02/2024

            case "addLeftStaff":
                return (new Staff())->addLeftStaff($jsondata);
                //intern 
            case 'addIntern':
                return (new Intern())->addIntern($jsondata);

            case 'getInternList':
                return (new Intern())->getInternList($jsondata);  //added by Dev on 19/01/2024

            case 'deleteStaffIntern':
                return (new Intern())->deleteStaffIntern($jsondata);  //added by Dev on 22/01/2024 

            case 'getInternCategories':
                return (new Intern())->getInternCategories($jsondata);  //added by Dev on 23/01/2024

            case 'updateInternInfo':
                return (new Intern())->updateInternInfo($jsondata);  //added by Dev on 24/01/2024



                //Staff Attendance
            case "getStaffForAttendance":
                return (new StaffAttendance())->getStaffForAttendance($jsondata);

            case "updateIndividualAttendance":
                return (new StaffAttendance())->updateIndividualAttendance($jsondata);

            case "giveManualAttendance":
                return (new StaffAttendance())->giveManualAttendance($jsondata);

            case "SignOutUserForToday":
                return (new StaffAttendance())->SignOutUserForToday($jsondata);

            case "StaffBreakInOut":
                return (new StaffAttendance())->StaffBreakInOut($jsondata);

            case "getAttendanceYear":
                return (new StaffAttendance())->getAttendanceYear($jsondata);



            case "getIndividualStaffAttendancebyYear":
                return (new StaffAttendance())->getIndividualStaffAttendancebyYear($jsondata);

            case "getStaffAttendancebyDate":
                return (new StaffAttendance())->getStaffAttendancebyDate($jsondata); //added by Dev on 12/02/2024

            case "getIndividualStaffAttendancebyMonth":
                return (new StaffAttendance())->getIndividualStaffAttendancebyMonth($jsondata);

            case "getStaffReportByYear":
                return (new StaffAttendance())->getStaffReportByYear($jsondata); //added by Dev on 12/02/2024


            case "getReportByYearMonthStaffID":
                return (new StaffAttendance())->getReportByYearMonthStaffID($jsondata); //added by Dev on 12/02/2024


            case "getAllStaffCountAttendanceReport":
                return (new StaffAttendance())->getAllStaffCountAttendanceReport($jsondata); //added by Dev on 12/02/2024



            case "getStaffAttendanceChart":
                return (new StaffAttendance())->getStaffAttendanceChart($jsondata); //added by Dev on 12/02/2024

            case "breakInForApp":
                return (new StaffAttendance())->breakInForApp($jsondata); //added by Dev on 20/02/2024

            case "breakOutForApp":
                return (new StaffAttendance())->breakOutForApp($jsondata); //added by Dev on 20/02/2024

            case "getTodaysAttendanceForApp":
                return (new StaffAttendance())->getTodaysAttendanceForApp($jsondata); //added by Dev on 22/02/2024


            case "getAttendanceOverViewForApp":
                return (new StaffAttendance())->getAttendanceOverViewForApp($jsondata); //added by Dev on 22/02/2024

            case "getLeaveOverViewForAapp":
                return (new StaffAttendance())->getLeaveOverViewForAapp($jsondata); //added by Dev on 22/02/2024

            case "getUserAllLeaveOverview":
                return (new StaffAttendance())->getUserAllLeaveOverview(); //added by Dev on 23/02/2024


            case "markRemoteattendance":
                return (new StaffAttendance())->markRemoteattendance($jsondata); //added by Dev on 29/02/2024

            case "getTodaysAttendanceReport":
                return (new StaffAttendance())->getTodaysAttendanceReport(); //added by Dev on 29/02/2024



            case "getStaffAttendanceOverview":
                return (new StaffAttendance())->getStaffAttendanceOverview(); //added by Dev on 29/02/2024


                // staff attendance settings
            case "generateAttendanceQRSheet":
                return (new StaffAttendanceSettings())->generateAttendanceQRSheet($jsondata);
            case "getAttendanceMode":
                return (new StaffAttendanceSettings())->getAttendanceMode();

            case "getSettingTiming":
                return (new StaffAttendanceSettings())->getSettingTiming();

            case "getStaffTiming":
                return (new StaffAttendanceSettings())->getStaffTiming();

            case "saveStaffAttendanceTiming":
                return (new StaffAttendanceSettings())->saveStaffAttendanceTiming($jsondata);

            case "isWithinRadius":
                return (new StaffAttendanceSettings())->isWithinRadius($jsondata);

            case "getAllBreakOption":
                return (new StaffAttendanceSettings())->getAllBreakOption($jsondata);


            case "getSupervisorForStaffLeaves":
                return (new Leaves())->getSupervisorForStaffLeaves();

                //inter attendance
            case "getInternForAttendance":
                return (new InternAttendance())->getInternForAttendance($jsondata);

            case "giveInternManualAttendance":
                return (new InternAttendance())->giveInternManualAttendance($jsondata);

            case "InternBreakInOut":
                return (new InternAttendance())->InternBreakInOut($jsondata); //added by dev on 29/01/2024

            case "getInternAttendanceYear":
                return (new InternAttendance())->getInternAttendanceYear($jsondata); //added by dev on 06/02/2024

            case "getInternAttendancebyYear":
                return (new InternAttendance())->getInternAttendancebyYear($jsondata); //added by dev on 06/02/2024


            case "getInternAttendancebyMonth":
                return (new InternAttendance())->getInternAttendancebyMonth($jsondata); //added by dev on 06/02/2024



            case "getInternTiming":
                return (new InternAttendanceSettings())->getInternTiming($jsondata);

            case "updateInternIndividualAttendance":
                return (new InternAttendance())->updateInternIndividualAttendance($jsondata);

            case "saveInternAttendanceTiming":
                return (new InternAttendanceSettings())->saveInternAttendanceTiming($jsondata);

            case "SignOutInternForToday":
                return (new InternAttendance())->SignOutInternForToday($jsondata);

                //for getting Intern Attendance Based on Particular  Selected Date
            case "getInternReportByDate":
                return (new InternAttendance())->getInternReportByDate($jsondata); //added by Devkanta on 01/02/2024

                //for getting Intern Attendance Based on Particular Selected Year
            case "getInternReportByYear":
                return (new InternAttendance())->getInternReportByYear($jsondata); //added by Devkanta on 01/02/2024

                //for getting Intern Attendance Based on Particular Selected Year, Month and InternID
            case "getReportByYearMonthInternID":
                return (new InternAttendance())->getReportByYearMonthInternID($jsondata); //added by Devkanta on 02/02/2024

                //     //for getting Intern Attendance Today's Report
                // case "getTodayAttendanceReport":
                //     return (new InternAttendance())->getTodayAttendanceReport($jsondata); //added by Devkanta on 02/02/2024


                //for getting Intern Attendance Count for Today,Yesterday 
            case "getAllCountAttendanceReport":
                return (new InternAttendance())->getAllCountAttendanceReport($jsondata); //added by Devkanta on 03/02/2024

            case "getUserBreakTimeList":
                return (new InternAttendance())->getUserBreakTimeList($jsondata); //added by Devkanta on 03/02/2024


            case "getAttendanceChart":
                return (new InternAttendance())->getAttendanceChart($jsondata); //added by Devkanta on 05/02/2024


                // mark attendance QR from app
            case "markQRattendanceStaff":
                return (new StaffAttendance())->markQRattendanceStaff($jsondata);

                // for getting  the staff break list
            case "getStaffBreakTimeList":
                return (new StaffAttendance())->getStaffBreakTimeList($jsondata); //added by Devkanta on 17/02/2024

                //cronjob
            case "UpdatePendingStaffAttendance":
                return (new CronJob())->UpdatePendingStaffAttendance($jsondata);

                //cronjob
            case "UpdatePendingInternAttendance":
                return (new CronJob())->UpdatePendingInternAttendance($jsondata);

                /*  FOR Leaves  */
            case "getActiveleaveType":
                return (new Leaves())->getActiveleaveType($jsondata);
            case "addNewLeaveSetting":
                return (new Leaves())->addNewLeaveSetting($jsondata);
            case "getAllDepartmentSettings":
                return (new Leaves())->getAllDepartmentSettings($jsondata);

            case "getallPendingLeaveRequest":
                return (new Leaves())->getallPendingLeaveRequest($jsondata);

            case "getTodayStaffLeaveReport":
                return (new Leaves())->getTodayStaffLeaveReport();

            case "getAllUsersLeave":
                return (new Leaves())->getAllUsersLeave($jsondata);

            case "onLeaveApproved":
                return (new Leaves())->onLeaveApproved($jsondata);
            case "declineleaveRequest":
                return (new Leaves())->declineleaveRequest($jsondata);
            case "getallLeaveList":
                return (new Leaves())->getallLeaveList($jsondata);

            case "getLeaveTypeByDepartmentID":
                return (new Leaves())->getLeaveTypeByDepartmentID($jsondata);


                //for get User Based Leave Data  For Current Month and Current Year
            case "getUserCurrentMonthLeaveRequest":
                return (new Leaves())->getUserCurrentMonthLeaveRequest($jsondata);

                //for getting All  User  Leave Requests
            case "getAllUserLeaveRequest":
                return (new Leaves())->getAllUserLeaveRequest($jsondata);


            case "getStaffLeaveBalanced":
                return (new Leaves())->getStaffLeaveBalanced($jsondata);

            case "CalculateELByEndofMonth":
                return (new Leaves())->CalculateELByEndofMonth();

            case "getAllApprovedLeaves":
                return (new Leaves())->getAllApprovedLeaves();

            case "addLeaveTypes":
                return (new Leaves())->addLeaveTypes($jsondata);

            case "getNoofDaysByLeaveTypeID":
                return (new Leaves())->getNoofDaysByLeaveTypeID($jsondata);
            case "getAllLeaveTypes":
                return (new Leaves())->getAllLeaveTypes();

            case "onCancelApprovedLeave":
                return (new Leaves())->onCancelApprovedLeave($jsondata);

            case "getUserLeaveOnDate":
                return (new Leaves())->getUserLeaveOnDate($jsondata);

            case "getStaffLeaveReports":
                return (new Leaves())->getStaffLeaveReports($jsondata);

            case "getUserLeaveBasedOnSupervisors":
                return (new Leaves())->getUserLeaveBasedOnSupervisors();


                // For Daily Task
            case "createdailytask":
                return (new DailyTask())->createdailytask($jsondata); //added by Devkanta on 06/02/2024

            case "getDailyTask":
                return (new DailyTask())->getDailyTask(); //added by Devkanta on 06/02/2024

            case "updatedailytaskstatus":
                return (new DailyTask())->updatedailytaskstatus($jsondata); //added by Devkanta on 07/02/2024

            case "getTaskStatus":
                return (new DailyTask())->getTaskStatus(); //added by Devkanta on 07/02/2024

            case "getUserTaskBetweenTwoDates":
                return (new DailyTask())->getUserTaskBetweenTwoDates($jsondata); //added by Devkanta on 08/02/2024


            case "getUserTaskBasedOnDate":
                return (new DailyTask())->getUserTaskBasedOnDate($jsondata); //added by Devkanta on 16/02/2024  

            case "addWarningStaff":
                return (new Warning())->addWarningStaff($jsondata); //added by Devkanta on 16/04/2024  


            case "getAllWarnings":
                return (new Warning())->getAllWarnings(); //added by Devkanta on 16/04/2024  


            case "getStaffWarnings":
                return (new Warning())->getStaffWarnings($jsondata); //added by Devkanta on 16/04/2024
            case "getStaffWarningsUnderSupervisor":
                return (new Warning())->getStaffWarningsUnderSupervisor(); //added by Devkanta on 19/06/2024



            case "addSalaryHead":
                return (new Payroll())->addSalaryHead($jsondata); //added by Devkanta on 25/04/2024

            case "getAllEarningSalaryHead":
                return (new Payroll())->getAllEarningSalaryHead(); //added by Devkanta on 25/04/2024

            case "getAllDeductionSalaryHead":
                return (new Payroll())->getAllDeductionSalaryHead(); //added by Devkanta on 25/04/2024

            case "getAllSalaryHeads":
                return (new Payroll())->getAllSalaryHeads(); //added by Devkanta on 25/04/2024



            case "editSalaryHead":
                return (new Payroll())->editSalaryHead($jsondata); //added by Devkanta on 25/04/2024

            case "addStaffSalarySettings":
                return (new Payroll())->addStaffSalarySettings($jsondata); //added by Devkanta on 25/04/2024


            case "getAllStaffSalary":
                return (new Payroll())->getAllStaffSalary(); //added by Devkanta on 25/04/2024


            case "updateSalarySettings":
                return (new Payroll())->updateSalarySettings($jsondata); //added by Devkanta on 25/04/2024


            case "getAllSalaryHead":
                return (new Payroll())->getAllSalaryHead(); //added by Devkanta on 25/04/2024


            case "addStaffSalary":
                return (new Payroll())->addStaffSalary($jsondata); //added by Devkanta on 29/04/2024


            case "getStaffEarningSalarySlip":
                return (new Payroll())->getStaffEarningSalarySlip($jsondata); //added by Devkanta on 06/05/2024


            case "getStaffDeductionSalarySlip":
                return (new Payroll())->getStaffEarningSalarySlip($jsondata); //added by Devkanta on 06/05/2024





        }
    }

    static function Views($page)
    {

        $viewpath = "../app/modules/staff/views/";

        switch ($page[1]) {

            case 'internList':
                load($viewpath . "intern/internlist.php");
                break;
                //intern Attendance
            case 'InternAttendance':
                load($viewpath . "intern/attendance/attendance.php");
                break;

            case 'InternAttendanceSetting':
                load($viewpath . "intern/attendance/settings.php");
                break;

            case 'InternAttendanceReports':
                load($viewpath . "intern/attendance/InternAttendanceReports.php");
                break;


                //IndividualReport
            case "individualreport":
                load($viewpath . "intern/attendance/individualreport.php");
                break;

            case 'staffList':
                load($viewpath . "staff/stafflist.php");
                break;

            case 'profile':
                load($viewpath . "staff/profile.php");
                break;


            case 'departureLists':
                load($viewpath . "staff/departureLists.php");
                break;


                //staff Attendance
            case "staffAttendance":
                load($viewpath . "staff/attendance/attendance.php");
                break;

            case "staffAttendanceSetting":
                load($viewpath . "staff/attendance/settings.php");
                break;

            case "staffAttendanceReports":
                load($viewpath . "staff/attendance/staffAttendanceReports.php");
                break;

            case "attendancereport":
                load($viewpath . "staff/attendance/attendancereport.php");
                break;
                //QR code generate
            case "printqr":
                load($viewpath . "staff/attendance/printqr.php");
                break;

                //Admin leave
            case "leaverequest":
                load($viewpath . "staff/leave/adminrequest.php");
                break;
                //Staff leave
            case "staffleaverequest":
                load($viewpath . "staff/leave/staffrequest.php");
                break;
            case "leavedaterange":
                load($viewpath . "staff/leave/leavedaterange.php");
                break;

            case "leavereport":
                load($viewpath . "staff/leave/leavereport.php");
                break;

            case "userleavereport":
                load($viewpath . "staff/leave/userleavereport.php");
                break;




            case "leavelist":
                load($viewpath . "staff/leave/leavelist.php");
                break;

            case "leavesetting":
                load($viewpath . "staff/leave/setting.php");
                break;

            case "leavebalance":
                load($viewpath . "staff/leave/balance.php");
                break;

            case "approvedleave":
                load($viewpath . "staff/leave/approvedleave.php");
                break;

            case "addleavetype":
                load($viewpath . "staff/leave/addleavetype.php");
                break;





                //   For Daily Task Creation
            case "createtask":
                load($viewpath . "staff/task/createtask.php"); //added By Devkanta on 06/02/2024
                break;

            case "taskboard":
                load($viewpath . "staff/task/board.php"); //added By Devkanta on 07/02/2024
                break;
            case "viewtask":
                load($viewpath . "staff/task/viewtask.php"); //added By Devkanta on 16/02/2024
                break;

                // case "changepassword":
                //     load($viewpath . "staff/task/viewtask.php"); //added By Devkanta on 16/02/2024
                //     break;

            case "test":
                load($viewpath . "staff/test.php"); //added By Devkanta on 16/02/2024
                break;

            case "viewwarnings":
                load($viewpath . "staff/viewwarnings.php"); //added By Devkanta on 16/04/2024
                break;

            case "warnings":
                load($viewpath . "staff/warning/staffwarnings.php"); //added By Devkanta on 16/04/2024
                break;



            case "trainingtypes":
                load($viewpath . "staff/training/trainingtypes.php"); //added By Devkanta on 16/04/2024
                break;

            case "traininglist":
                load($viewpath . "staff/training/traininglist.php"); //added By Devkanta on 16/04/2024
                break;



            case "salaryhead":
                load($viewpath . "staff/payroll/salaryhead.php"); //added By Devkanta on 25/04/2024
                break;


            case "salary":
                load($viewpath . "staff/payroll/salary.php"); //added By Devkanta on 25/04/2024
                break;


            case "salarysettings":
                load($viewpath . "staff/payroll/salarysettings.php"); //added By Devkanta on 25/04/2024
                break;


            case "addsalary":
                load($viewpath . "staff/payroll/addsalary.php"); //added By Devkanta on 25/04/2024
                break;


            case "salaryslip":
                load($viewpath . "staff/payroll/salaryslip.php"); //added By Devkanta on 25/04/2024
                break;

            default:
                // session_destroy();
                include '404.php';
                header('HTTP/1.1 401  Unauthorized Access');
                header("Status: 401 ");
                break;
        }
    }
}
