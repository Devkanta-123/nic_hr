<?php
namespace app\modules\staff\classes;
include '../../app/database/DBController.php';
include "../../app/modules/staff/classes/CronJob.php";


(new CronJob())->UpdatePendingStaffAttendance(); 