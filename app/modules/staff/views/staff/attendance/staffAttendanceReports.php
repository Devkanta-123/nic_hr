<style>
    /* .content,.card{
        background-color: black;
        color:white;
    } */
    .attendance-summary-float {
        z-index: 9999;
        position: fixed;
        top: 18%;
        right: 10px;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
    }

    .attendance-summary-float a {
        display: block;
        padding: 4px;
        color: white;
        text-align: center;
        font-size: 18px;
        transition: all 0.5s ease;

    }

    .attendance-summary-float a:hover {
        background-color: #000;
    }

    .summaryTotal {
        color: #FFF;
        background: #55ACEE;
    }

    .summaryP {
        color: #FFF;
        background: #28a745;
    }

    .summaryA {
        color: #FFF;
        background: #dd4b39;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-50px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .slide-in {
        animation: slideIn 0.5s ease-in-out;
    }

    .custombadge-info {
        background-color: #7469B6;
        /* Change to your desired background color */
        color: #fff;
        /* Change to your desired text color */
        border-radius: 10px;
        /* Adjust the border-radius for rounding */
        padding: 5px 10px;
    }

    .custombadge-success {
        background-color: #65B741;
        /* Change to your desired background color */
        color: #fff;
        /* Change to your desired text color */
        border-radius: 10px;
        /* Adjust the border-radius for rounding */
        padding: 5px 10px;
    }

    .custombadge-danger {
        background-color: #BF3131;
        /* Change to your desired background color */
        color: #fff;
        /* Change to your desired text color */
        border-radius: 10px;
        /* Adjust the border-radius for rounding */
        padding: 5px 10px;
    }

    .custombadge-warning {
        background-color: #B0C5A4;
        /* Change to your desired background color */
        color: #fff;
        /* Change to your desired text color */
        border-radius: 10px;
        /* Adjust the border-radius for rounding */
        padding: 5px 10px;
    }

    .custom-img {
        border-radius: 50%;
        /* This makes the image perfectly round */
        width: 50px;
        /* Adjust width as needed */
        height: 50px;
        /* Adjust height as needed */
    }
</style>

<!-- summernote -->
<link rel="stylesheet" href="assets/admin/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.css">
<link rel="stylesheet" href="assets/admin/plugins/bootstrap-toggle-master/css/bootstrap-toggle.min.css">
<link rel="stylesheet" href="assets/admin/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css">

<!-- DataTables -->
<link rel="stylesheet" href="assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css" rel="stylesheet" />

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="modal" id="viewBreaklist-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">

                            <h5 class="modal-title" id="FetchStaffName"></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <div class="timeline" id="timelineContainer">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /.row -->
            </div>
            <div class="row p-3">
                <div class="col-md-4">
                    <div class="card card-widget widget-user-2">
                        <div class="widget-user-header" style="color: white; background-color: #37B5B6; font-family: Arial, sans-serif; font-size: small;">
                            <div class="widget-user-image">
                                <!-- <img class="img-circle elevation-2" src="../dist/img/user7-128x128.jpg" alt="User Avatar"> -->
                            </div>
                            <h3 style="font-family: 'Roboto', sans-serif; font-size: 20px;">Today Report</h3>
                        </div>
                        <div class="card-footer p-0">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Total Present <span class="float-right badge bg-primary" id="TotalPresentToday"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Total Absent <span class="float-right badge bg-danger" id="TotalAbsentToday"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>


                <!-- Load Modal for Today Report -->
                <!-- <div class="modal fade show" aria-modal="true" id="loadtodayLeave-Modal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title"> Today's Leave Report</h3>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- Modal Ends here -->

                <!-- Yesterday Report -->
                <div class="col-md-4">

                    <div class="card card-widget widget-user-2">
                        <div class="widget-user-header" style="color: white; background-color: #D24545;font-size: 25px;font-weight: 30;">
                            <div class="widget-user-image">
                                <!-- <img class="img-circle elevation-2" src="../dist/img/user7-128x128.jpg" alt="User Avatar"> -->
                            </div>

                            <h3 style="font-family: 'Roboto', sans-serif; font-size: 20px;">Yesterday Report</h3>

                        </div>
                        <div class="card-footer p-0">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Total Present <span class="float-right badge bg-primary" id="TotalPresentYesterday"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Total Absent <span class="float-right badge bg-danger" id="TotalAbsentYesterday"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>

                <div class="col-md-4">

                    <div class="card card-widget widget-user-2">
                        <div class="widget-user-header" style="color: white; background-color: #294B29;font-size: 25px;font-weight: 30;">
                            <div class="widget-user-image">
                                <!-- <img class="img-circle elevation-2" src="../dist/img/user7-128x128.jpg" alt="User Avatar"> -->
                            </div>

                            <h3 style="font-family: 'Roboto', sans-serif; font-size: 20px;cursor:pointer;" data-target="#loadtodayLeave-Modal" data-toggle="modal">Leave Report</h3>

                        </div>
                        <div class="card-footer p-0">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        -<span class="float-right badge bg-primary"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        - <span class="float-right badge bg-info"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <!-- Intern Attendance -->
                <!-- <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-list"></i></span>

                        <div class="info-box-content AttendanceReport" title="Attendance Report">
                            <span class="info-box-text"> Attendance Report </span>
                            <span class="info-box-number" id="AttendanceReport"></span>
                        </div>
                    </div>
                </div> -->
                <!-- /.col -->
            </div>
            <div class="row">

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-header">Today Attendance Report
                        </div>
                        <div class="table-responsive">
                            <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="TodaysAttendance">
                                <thead>
                                    <tr>
                                        <th>Staff Name</th>
                                        <th>Entry Time</th>
                                        <th>In Time</th>
                                        <th>OutTime</th>
                                        <th>Out Location</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>


                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-header">Today's Leave Report
                        </div>
                        <div class="table-responsive">
                            <div class="card-body">
                                <table class="table table-bordered" id="TodayLeaveReport" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Staff Name</th>
                                            <th>Approved From / To </th>
                                            <th>Status </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Populate this tbody dynamically with attendance records -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>




            <!-- Intern Attendance report div -->
            <div class="row" id="AttendanceReportdiv">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-success btn-xs" data-card-widget="collapse" style="float:right; margin-right: 5px;">
                                <i class="fas fa-minus"></i>
                            </button>

                            <button type="button" class="btn btn-danger btn-xs" onclick="Refresh()" style="float:right; margin-left: 5px;">
                                <i class="fas fa-sync-alt"></i>
                            </button>

                            <div class="card-title">
                                Staff Attendance
                            </div>
                        </div>


                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5" data-select2-id="11">
                                    <div class="form-group" data-select2-id="10">
                                        <label>Search Data By:</label>
                                        <select id="searchby" class="select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="3" tabindex="-1" aria-hidden="true">
                                            <option value="">Select here</option>
                                            <!-- <option value="date">Date</option> -->
                                            <option value="year">Year</option>
                                            <option value="staff">Staff</option>
                                            <!-- <option value="month">Month</option> -->

                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <label for="searchby">Search by</label>
                                    <select name="" id="searchby" class="form-control mb-3">
                                        <option value="">Select here</option>
                                        <option value="date">Date</option>
                                        <option value="year">Year</option>
                                        <option value="staff">Intern</option>
                                        <option value="month">Month</option>
                                    </select>
                                </div> -->

                                <div class="col-md-5" id="div1"> <br>
                                    <input type="date" class="form-control mt-2 " id="date1" value="<?php echo date("Y-m-d"); ?>" style="display:none;" max=<?php echo date("Y-m-d"); ?>>
                                    <input type="text" id="year" placeholder="Year" onkeypress="javascript:return isNum(event)" maxlength="4" class="form-control mt-2" style="display:none;">
                                    <select name="" id="Intern" class="form-control mt-2" style="display:none;"></select>
                                </div>

                                <div class="col-6" id="selectMonthDesignation" style="display:none;">
                                    <div class="row">
                                        <div class="col-md-4" id="ViewYear">
                                            <label for="getYearInput">Year</label>
                                            <input type="text" id="getYearInput" placeholder="Year" onkeypress="javascript:return isNum(event)" maxlength="4" class="form-control mt-2" value="<?php echo date("Y"); ?>" style="display:none;" max=<?php echo date("Y"); ?>>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="loadMonth">Month</label>
                                            <select name="" class="form-control" id="loadMonth"> </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="loadStaffs">Staff</label>
                                            <select name="" class="form-control" id="loadStaffs"> </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <table id="staffReports" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Attendance Date</th>
                                        <th scope="col">Staff Name</th>
                                        <th scope="col">Entry Time <i class="far fa-clock"></i></th>
                                        <th scope="col">Check Out <i class="fas fa-share"></i></th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Working Hours</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>

                            <!-- by year -->
                            <table id="internReportsbyyear" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Staff Name</th>
                                        <th scope="col">Total Present</th>
                                        <th scope="col">Total Absent</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>

                            <!-- by Year, Month and InternID -->
                            <table id="StaffReportsbyYearMonthStaffID" class="table table-bordered" style="display: none;">
                                <thead>
                                    <tr>
                                        <th scope="col">Staff Name</th>
                                        <th scope="col">Total Present</th>
                                        <th scope="col">Total Absent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>

            <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Summernote -->
<script src="assets/admin/plugins/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>
<script src="assets/admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>


<script>
    function isNum(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        } else {
            return true;
        }
    }

    // close/open  div
    $("#closeStaffAttendance").click(function() {
        $("#AttendanceReportdiv").hide();
    });

    $(".TodayReport").click(function() {
        $("#todayReportdiv").show();
        $("#todayReportdiv1").show();
    });

    $(".AttendanceReport").click(function() {
        $("#AttendanceReportdiv").show();
    });

    $("#closeTodayReport1").click(function() {
        $("#todayReportdiv").hide();
        $("#todayReportdiv1").hide();
    });

    $("#YesterdayReport").click(function() {
        $("#yesterdayReportDiv").show();
    });
    $("#closeYesterdayReport").click(function() {
        $("#yesterdayReportDiv").hide();
    });
</script>
<script>
    $("#searchby").change(function() {
        if ($("#searchby option:selected").val() == 'date') {
            $('#date1').show();
            getStaffAttendancebyDate($("#date1").val(), $("#searchby").val())
            $('#staff').hide();
            $('#year').hide();
            $('#div1').show();
            $('#selectMonthDesignation').hide();
        } else if ($("#searchby option:selected").val() == 'year') {
            $('#year').show();
            $('#staffReports').hide();
            $('#internReportsbyyear').show();
            $('#date1').hide();
            $('#staff').hide();
            $('#div1').show();
            $('#selectMonthDesignation').hide();
        } else if ($("#searchby option:selected").val() == 'staff') {
            $('#staff').show();
            $('#getYearInput').show();
            getStaff();
            getMonths();
            $('#year').hide();
            $('#date1').hide();
            $('#div1').hide();
            $('#selectMonthDesignation').show();
        } else if ($("#searchby option:selected").val() == 'month') //month
        {
            $('#staffReports').hide();
            $('#internReportsbyyear').show();
            getMonths();
            $('#div1').hide();
            $('#selectMonthDesignation').show();
            $('#internReportsbyyear').show();
        } else {
            notify("warning", "You have not selected any option");
        }

    });

    $("#date1").change(function() {
        getStaffAttendancebyDate($("#date1").val(), $("#searchby").val())
    });

    $("#loadMonth").change(function() {
        if ($("#loadMonth").val() == -1) {
            notify("warning", "Please select an Option");
            return false;
        } else {
            getStaff();
        }
    });
    //GetInputYear
    $("#getYearInput").change(function() {
        if ($("#getYearInput").val() == -1) {
            notify("warning", "Please Enter Valid Year");
            return false;
        } else {
            getMonths();
        }
    });


    $("#loadStaffs").change(function() {
        debugger;
        // check if both is selected
        if ($("#loadMonth").val() == -1 || $("#loadStaffs").val() == -1) {
            notify("warning", "All field cannot be empty");
            return false;
        }
        getReportByYearMonthStaffID($("#getYearInput").val(), $("#loadMonth").val(), $("#loadStaffs").val()); //Year,month,Interns
        // alert($("#loadStaffs").val());
    });



    $("#year").change(function() {
        var re = /^[0-9]+$/;
        if ($("#year").val().match(re)) {
            getStaffReportByYear($("#year").val(), $("#searchby").val())
        } else {
            notify("warning", "Invalid Year");
        }
    });

    $("#staff").change(function() {
        getreportByDesignation($("#staff").val(), $("#searchby").val())
    });

    $(function() {
        $('#date1').hide();
        $('#staff').hide();
        $('#year').hide();
        $('#internReportsbyyear').hide();

        // getStaffListNotMarkedAttendanceByPercent(); // testing
        getTodayStaffLeaveReport();
        getAllStaffCountAttendanceReport();
        // getYesterdayAttendanceReport(); 
        // getTodayPresentStaff();
        // getTodayAbsentStaff();
        getStaffAttendanceChart();
        getStaff();
        getTodaysAttendanceReport();

    });


    function getReportByYearMonthStaffID(year, month, StaffID) {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getReportByYearMonthStaffID";
        let json = {};
        json.StaffID = StaffID;
        json.Year = year;
        json.Month = month;
        obj.JSON = json;
        SilentTransportCall(obj);
    }

    function getMonths() {
        debugger;
        let obj = {};
        obj.Module = "Settings";
        obj.Page_key = "getMonths";
        obj.JSON = {};
        SilentTransportCall(obj);
    }

    function getStaff() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getStaff";
        obj.JSON = {};
        SilentTransportCall(obj);
    }


    function getStaffReportByYear(year, searchby) {

        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getStaffReportByYear";
        let json = {};
        json.attendanceYear = year;
        json.Searchby = searchby;
        obj.JSON = json;
        SilentTransportCall(obj);
    }

    function getStaffAttendancebyDate(date, searchby) {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getStaffAttendancebyDate";
        let json = {};
        json.DATE = date;
        json.Searchby = searchby;
        obj.JSON = json;
        SilentTransportCall(obj);
    }

    function getTodayAbsentStaff() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getTodayAbsentStaff";
        obj.JSON = {};
        TransportCall(obj);
    }

    function getTodayPresentStaff() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getTodayPresentStaff";
        obj.JSON = {};
        TransportCall(obj);
    }

    function getTodayStaffLeaveReport() {
        debugger;
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getTodayStaffLeaveReport";
        obj.JSON = {};
        SilentTransportCall(obj);
    }

    function getYesterdayAttendanceReport() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getYesterdayAttendanceReport";
        obj.JSON = {};
        TransportCall(obj);
    }

    function getAllStaffCountAttendanceReport() {
        debugger;
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getAllStaffCountAttendanceReport";
        obj.JSON = {};
        TransportCall(obj);

    }

    function getStaffAttendanceChart() {
        debugger;
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getStaffAttendanceChart";
        obj.JSON = {};
        SilentTransportCall(obj);
    }

    function getTodaysAttendanceReport() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getTodaysAttendanceReport";
        obj.JSON = {};
        SilentTransportCall(obj);


    }





    function onSuccess(rc) {
        if (rc.return_code) {
            switch (rc.Page_key) {

                case "getMonths":
                    loadSelect("#loadMonth", rc.return_data);
                    break;
                case "getStaff":
                    loadSelect("#loadStaffs", rc.return_data);
                    break;



                case "getYesterdayAttendanceReport":
                    loadYesterdayReport(rc.return_data);
                    break;

                case "getTodayPresentStaff":
                    loadTodayPresentReport(rc.return_data);
                    break;

                case "getStaffAttendancebyDate":
                    loadStaffReportByDate(rc.return_data);
                    break;

                case "getTodayAbsentStaff":
                    loadTodayAbsentReport(rc.return_data);
                    $("#internReportsbyyear").hide();
                    break;

                case "getStaffReportByYear":
                    loadstaffbyyear(rc.return_data);
                    $("#staffReports").hide();
                    $("#StaffReportsbyYearMonthStaffID").hide();
                    break;

                case "getreportByDesignation":
                    $("#internReportsbyyear").hide();
                    $("#staffReports").show();
                    loadStaffReportByDate(rc.return_data);
                    break;

                case "getReportByYearMonthStaffID":
                    $("#staffReports").hide();
                    $("#internReportsbyyear").hide();
                    $("#StaffReportsbyYearMonthStaffID").show();
                    loadStaffReportByDateByYearMonthStaffID(rc.return_data);
                    break;


                case "getAllStaffCountAttendanceReport":
                    $("#TotalPresentToday").text(rc.TotalPresentToday['totalpresenttoday']);
                    $("#TotalAbsentToday").text(rc.TotalAbsentToday['totalabsenttoday']);
                    $("#TotalPresentYesterday").text(rc.TotalPresentYesterday['totalpresentyesterday']);
                    $("#TotalAbsentYesterday").text(rc.TotalAbsentYesterday['totalabsentyesterday']);
                    break;

                case "getTodayStaffLeaveReport":
                    console.log(rc.return_data);
                    loadTodayLeaveReport(rc.return_data);
                    break;


                case "getStaffAttendanceChart":
                    loadAttendanceChart(rc.return_data);
                    break;

                case "getStaffBreakTimeList":
                    $("#loadtodayLeave-Modal").modal("hide");
                    loadBreakTimeList(rc.return_data);
                    break;

                case "getTodaysAttendanceReport":
                    console.log(rc.return_data);
                    loadTodaysAttendance(rc.return_data);
                    break;


                default:
                    notify("error", rc.Page_key);
            }
        } else {
            notify("error", rc.return_data);

        }
    }


    function loadTodaysAttendance(data) {
        var table = $("#TodaysAttendance");

        try {
            if ($.fn.DataTable.isDataTable($(table))) {
                $(table).DataTable().destroy();
            }
        } catch (ex) {}

        var text = ""

        if (data.length == 0) {
            text += "No Data Found";
        } else {
            for (let i = 0; i < data.length; i++) {
                text += '<tr> ';
                text += '<td> ' + data[i].StaffName + '<br><p style="font-size: 12px; color: grey;">(' + data[i].AttendanceMode + ')<p/></td>';
                text += '<td> ' + data[i].EntryDateTime + '</td>';
                text += '<td> <a title="Latitude IN" href="https://www.google.com/maps/search/' + data[i].LatitudeIN + ',' + data[i].LongtitudeIN + '/" target="_blank"><i class="fas fa-map-marker-alt"></i></a>';
                if (data[i].AttendanceModeID == 2) {
                    text += ' <a target="_blank" href="file?type=attendancephoto&name=' + data[i].AttendancePhotoIN + '" class="custom-img" alt="I"><i  class="fa fa-image text-green" aria-hidden="true"></i> </a>';
                } else {}
                text += '</td>';
                // text += '<td> ' + (data[i].StaffOut==null ? "<span class='badge badge-sm badge-danger'>NA</span>" : data[i].StaffOut ) + '</td>';
                // <img src="file?type=attendancephoto&name='+data[i].AttendancePhotoIN + '" class="custom-img" alt="Not found">
                // AttendanceModeID
                if (data[i].StaffOut == null) {
                    text += '<td> <span class="badge custombadge-danger"> No Time Found </span> </td>';
                } else if (data[i].StaffOut !== null || data[i].data[i].AttendanceMode == 2) { //remote attendance mode
                    text += '<td > <span class="badge custombadge-success"> ' + data[i].StaffOut + ' </span>&nbsp;<a target="_blank" href="file?type=attendancephoto&name=' + data[i].AttendancePhotoOut + '" class="custom-img" alt="I"><i  class="fa fa-image text-green" aria-hidden="true"></i></td>';
                }

                if (data[i].LatitudeOut == null || data[i].LongtitudeOut == null) {
                    text += '<td> <span class="badge custombadge-warning"> No GPS found</span> </td>';
                } else {
                    text += '<td><a  title ="Out" href="https://www.google.com/maps/search/' + data[i].LatitudeOut + ',' + data[i].LongtitudeOut + ' /" target="_blank"><i class="fas fa-location-arrow"></i></a></td>';
                }
                text += '</tr >';
            }
        }

        $("#TodaysAttendance tbody").html("");
        $("#TodaysAttendance tbody").append(text);




    }

    function loadTodayLeaveReport(data) {
        var table = $("#TodayLeaveReport");
        try {
            if ($.fn.DataTable.isDataTable($(table))) {
                $(table).DataTable().destroy();
            }
        } catch (ex) {}

        var text = ""

        if (data.length == 0) {
            text += "No Data Found";
        } else {
            for (let i = 0; i < data.length; i++) {
                text += '<tr> ';
                text += '<td> ' + (i + 1) + '</td>';
                text += '<td> ' + data[i].StaffName + '</td>';
                if (data[i].isHalfDay == 1) {
                    text += '<td>';
                    text += data[i].RequestedDateFrom + '&nbsp;<span class="badge badge-success">Half Day</span><br>';
                    if (data[i].isPostLunch == 1) {
                        text += '<span class="badge custombadge-success">Post Lunch</span><br>';
                    } else {
                        text += '<span class="badge badge-info">Pre Lunch</span><br>';
                    }
                    text += '</td>';
                } else {
                    text += '<td>';
                    text += +data[i].RequestedDateFrom + ' <br>' + data[i].RequestedDateTo + ''
                    text += '</td>';
                }
                text += '<td>';
                if (data[i].isApproved == 1) {
                    text += '<span class="badge custombadge-success"> Supervisor 1 Approved</span><br>';
                } else if (data[i].isApproved == 2) {
                    text += '<span class="badge custombadge-warning"> Approved</span><br>';
                } else if (data[i].isApproved == null) {
                    text += '<span class="badge custombadge-danger">Pending</span><br>';
                }
                text += '</td>';
                text += '</tr >';
            }
        }

        $("#TodayLeaveReport tbody").html("");
        $("#TodayLeaveReport tbody").append(text);

        $(table).DataTable({
            responsive: true,
            "order": [],
            dom: 'Bfrtip',
            "bInfo": true,
            exportOptions: {
                columns: ':not(.hidden-col)'
            },
            "deferRender": true,
            "pageLength": 10,
            buttons: [{
                    exportOptions: {
                        columns: ':not(.hidden-col)'
                    },
                    extend: 'excel',
                    orientation: 'landscape',
                    pageSize: 'A4'
                },
                {
                    exportOptions: {
                        columns: ':not(.hidden-col)'
                    },
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'A4'
                },
                {
                    exportOptions: {
                        columns: ':not(.hidden-col)'
                    },
                    extend: 'print',
                    orientation: 'landscape',
                    pageSize: 'A4'
                }
            ]
        });
    }

    function loadYesterdayReport(data) {
        var table = $("#yesterdayReport");

        try {
            if ($.fn.DataTable.isDataTable($(table))) {
                $(table).DataTable().destroy();
            }
        } catch (ex) {}

        var text = ""

        if (data.length == 0) {
            text += "No Data Found";
        } else {
            for (let i = 0; i < data.length; i++) {
                text += '<tr> ';
                text += '<td> ' + data[i].StaffName + '</td>';
                text += '<td> ' + data[i].ContactNo + '</td>';
                text += '<td> ' + data[i].DesignationName + '</td>';
                if (data[i].Status == '0') {
                    text += '<td > <span class="badge badge-danger">Absent </span></td>';
                } else {
                    text += '<td > <span class="badge badge-success"> Present </span> </td>';
                }
                text += '<td class="btn-group btn-group-sm">';
                text += '   <a class="btn btn-info btn-sm text-white"> <i class="fas fa-pencil-alt"> </i> </a>';
                text += '   <a class="btn btn-danger btn-sm text-white"> <i class="fas fa-trash"> </i> </a>';
                text += '</td>';
                text += '</tr >';
            }
        }

        $("#yesterdayReport tbody").html("");
        $("#yesterdayReport tbody").append(text);

        $(table).DataTable({
            responsive: true,
            "order": [],
            dom: 'Bfrtip',
            "bInfo": true,
            exportOptions: {
                columns: ':not(.hidden-col)'
            },
            "deferRender": true,
            "pageLength": 10,
            buttons: [{
                    exportOptions: {
                        columns: ':not(.hidden-col)'
                    },
                    extend: 'excel',
                    orientation: 'landscape',
                    pageSize: 'A4'
                },
                {
                    exportOptions: {
                        columns: ':not(.hidden-col)'
                    },
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'A4'
                },
                {
                    exportOptions: {
                        columns: ':not(.hidden-col)'
                    },
                    extend: 'print',
                    orientation: 'landscape',
                    pageSize: 'A4'
                }
            ]
        });
    }

    function loadTodayPresentReport(data) {

        var table = $("#todayPresentReport");

        try {
            if ($.fn.DataTable.isDataTable($(table))) {
                $(table).DataTable().destroy();
            }
        } catch (ex) {}

        var text = ""

        if (data.length == 0) {
            text += "No Data Found";
        } else {
            for (let i = 0; i < data.length; i++) {
                text += '<tr> ';
                text += '<td> ' + data[i].StaffName + '</td>';
                text += '<td> ' + data[i].ContactNo + '</td>';
                text += '<td> ' + data[i].DesignationName + '</td>';
                // text += '<td> ' + data[i].DepartmentID + '</td>';
                if (data[i].Status == '0') {
                    text += '<td> <span class="badge bagde-danger">Absent</span> </td>';
                } else {
                    text += '<td>  <span class="badge badge-danger">Present </span> </td>';
                }
                text += '<td> ' + data[i].Status + '</td>';
                text += '<td class="btn-group btn-group-sm">';
                text += '   <a class="btn btn-info btn-sm text-white"> <i class="fas fa-pencil-alt"> </i> </a>';
                text += '   <a class="btn btn-danger btn-sm text-white"> <i class="fas fa-trash"> </i> </a>';
                text += '</td>';
                text += '</tr >';
            }
        }

        $("#todayPresentReport tbody").html("");
        $("#todayPresentReport tbody").append(text);

        $(table).DataTable({
            responsive: true,
            "order": [],
            dom: 'Bfrtip',
            "bInfo": true,
            exportOptions: {
                columns: ':not(.hidden-col)'
            },
            "deferRender": true,
            "pageLength": 10,
            buttons: [{
                    exportOptions: {
                        columns: ':not(.hidden-col)'
                    },
                    extend: 'excel',
                    orientation: 'landscape',
                    pageSize: 'A4'
                },
                {
                    exportOptions: {
                        columns: ':not(.hidden-col)'
                    },
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'A4'
                },
                {
                    exportOptions: {
                        columns: ':not(.hidden-col)'
                    },
                    extend: 'print',
                    orientation: 'landscape',
                    pageSize: 'A4'
                }
            ]
        });
    }

    function loadTodayAbsentReport(data) {
        var table = $("#absentReport");

        try {
            if ($.fn.DataTable.isDataTable($(table))) {
                $(table).DataTable().destroy();
            }
        } catch (ex) {}

        var text = ""

        if (data.length == 0) {
            text += "No Data Found";
        } else {
            for (let i = 0; i < data.length; i++) {
                text += '<tr> ';
                text += '<td> ' + data[i].StaffName + '</td>';
                text += '<td> ' + data[i].ContactNo + '</td>';
                text += '<td> ' + data[i].DesignationName + '</td>';
                if (data[i].Status == '0') {
                    text += '<td>  <span class="badge badge-danger">Absent </span> </td>';
                } else {
                    text += '<td>  <span class="bagde badge-success">Present</span> </td>';
                }
                text += '<td class="btn-group btn-group-sm">';
                text += '   <a class="btn btn-info btn-sm text-white"> <i class="fas fa-pencil-alt"> </i> </a>';
                text += '   <a class="btn btn-danger btn-sm text-white"> <i class="fas fa-trash"> </i> </a>';
                text += '</td>';
                text += '</tr >';
            }
        }

        $("#absentReport tbody").html("");
        $("#absentReport tbody").append(text);

        $(table).DataTable({
            responsive: true,
            "order": [],
            dom: 'Bfrtip',
            "bInfo": true,
            exportOptions: {
                columns: ':not(.hidden-col)'
            },
            "deferRender": true,
            "pageLength": 10,
            buttons: [{
                    exportOptions: {
                        columns: ':not(.hidden-col)'
                    },
                    extend: 'excel',
                    orientation: 'landscape',
                    pageSize: 'A4'
                },
                {
                    exportOptions: {
                        columns: ':not(.hidden-col)'
                    },
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'A4'
                },
                {
                    exportOptions: {
                        columns: ':not(.hidden-col)'
                    },
                    extend: 'print',
                    orientation: 'landscape',
                    pageSize: 'A4'
                }
            ]
        });
    }

    function loadStaffReportByDate(data) {
        debugger;
        var table = $("#staffReports");

        try {
            if ($.fn.DataTable.isDataTable($(table))) {
                $(table).DataTable().destroy();
            }
        } catch (ex) {}

        var text = ""

        if (data.length == 0) {
            text += "No Data Found";
        } else {
            for (let i = 0; i < data.length; i++) {
                text += '<tr> ';
                text += '<td> ' + data[i].AttendanceDate + '</td>';
                text += '<td> ' + data[i].StaffName + '</td>';
                text += '<td> <span class="badge badge-info">' + data[i].StaffIn + '</td>';
                if (data[i].StaffOut == null) {
                    text += '<td > <span class="badge badge-danger">No Time found</span> </td>';
                } else {
                    text += '<td><span class="badge badge-success">' + data[i].StaffOut + '</span></td>';
                }

                if (data[i].Status == '0') {
                    text += '<td > <span class="badge badge-danger"> Absent </span> </td>';
                } else {
                    text += '<td > <span class="badge badge-success"> Present </span> </td>';
                }

                // Calculate Working Hours
                var entryTime = new Date(data[i].AttendanceDate + ' ' + data[i].StaffIn);
                var exitTime = data[i].StaffOut ? new Date(data[i].AttendanceDate + ' ' + data[i].StaffOut) : null;
                var workingHours = calculateWorkingHours(entryTime, exitTime);

                text += '<td><span class="badge badge-info" style="background-color: #7ED7C1; color: white;">' + workingHours + '</span></td>';
                // text += '<td class="btn-group btn-group-sm">';
                // text += '   <a class="btn btn-info btn-sm text-white"> <i class="fas fa-pencil-alt"> </i> </a>';
                // text += '   <a class="btn btn-danger btn-sm text-white"> <i class="fas fa-trash"> </i> </a>';
                // text += '</td>';
                text += '</tr >';
            }
        }

        $("#staffReports tbody").html("");
        $("#staffReports tbody").append(text);

        $(table).DataTable({

            responsive: true,
            "order": [],
            dom: 'Bfrtip',
            "bInfo": true,
            exportOptions: {
                columns: ':not(.hidden-col)'
            },
            "deferRender": true,
            "pageLength": 10,
            buttons: [{
                    exportOptions: {
                        columns: ':not(.hidden-col)'
                    },
                    extend: 'excel',
                    orientation: 'landscape',
                    pageSize: 'A4'
                },
                {
                    exportOptions: {
                        columns: ':not(.hidden-col)'
                    },
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'A4'
                },
                {
                    exportOptions: {
                        columns: ':not(.hidden-col)'
                    },
                    extend: 'print',
                    orientation: 'landscape',
                    pageSize: 'A4'
                }
            ]
        });
    }

    function loadStaffReportByDateByYearMonthStaffID(data) {
        var table = $("#StaffReportsbyYearMonthStaffID");

        try {
            if ($.fn.DataTable.isDataTable($(table))) {
                $(table).DataTable().destroy();
            }
        } catch (ex) {}

        var text = "";
        if (data.length == 0) {
            text += "<tr><td colspan='6'>No Data Found</td></tr>";
        } else {
            for (let i = 0; i < data.length; i++) {
                text += '<tr> ';
                text += '<td> ' + data[i].StaffName + '</td>';
                text += '<td> <span class="badge badge-success">' + data[i].TotalPresent + '</td>';
                text += '<td> <span class="badge badge-danger">' + data[i].TotalAbsent + '</td>';

                // // Calculate Working Hours
                // var entryTime = new Date(data[i].AttendanceDate + ' ' + data[i].StaffIn);
                // var exitTime = data[i].StaffOut ? new Date(data[i].AttendanceDate + ' ' + data[i].StaffOut) : null;
                // var workingHours = calculateWorkingHours(entryTime, exitTime);

                // text += '<td>' + workingHours + '</td>';
                text += '</tr>';
            }
        }

        $("#StaffReportsbyYearMonthStaffID tbody").html("");
        $("#StaffReportsbyYearMonthStaffID tbody").append(text);

        $(table).DataTable({
            responsive: true,
            "order": [],
            dom: 'Bfrtip',
            "bInfo": true,
            exportOptions: {
                columns: ':not(.hidden-col)'
            },
            "deferRender": true,
            "pageLength": 10,
            buttons: [{
                    exportOptions: {
                        columns: ':not(.hidden-col)'
                    },
                    extend: 'excel',
                    orientation: 'landscape',
                    pageSize: 'A4'
                },
                {
                    exportOptions: {
                        columns: ':not(.hidden-col)'
                    },
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'A4'
                },
                {
                    exportOptions: {
                        columns: ':not(.hidden-col)'
                    },
                    extend: 'print',
                    orientation: 'landscape',
                    pageSize: 'A4'
                }
            ]
        });
    }

    function loadBreakTimeList(dataList) {
        debugger;
        var timelineContainer = $("#timelineContainer");
        timelineContainer.empty();
        $("#viewBreaklist-modal").modal("show");
        dataList.forEach(function(data) {
            var NameValue = data.StaffName;
            var outputElement = document.getElementById("FetchStaffName");
            outputElement.innerHTML = NameValue + " Break Time History";
            var timelineItem = $('<div class="timeline-item">');
            timelineItem.append('<i class="' + data.BreakIcon + ' bg-green"></i> ');
            var timeContainer = $('<div class="time-container" style="display: flex; justify-content: flex-end;font-size: 12px;padding: 10px;">');
            timeContainer.append('<span style="color:#0D9276;"><i class="fas fa-clock"></i>' + data.BreakInTime + '</span>');
            timeContainer.append('&nbsp;&nbsp;');

            if (data.BreakOutTime !== null) {

                timeContainer.append('<span style="color:#FF8080;"><i class="fas fa-clock"></i>' + data.BreakOutTime + '</span>');
            } else {

                timeContainer.append('<span class="badge badge-danger">Not Break Out</span>');
            }

            timelineItem.append(timeContainer);

            timelineItem.append('<p class="timeline-header" style="font-weight:600;"><a href="#">' + data.BreakOption + '  Break </a> </p>');

            if (data.body) {
                var timelineBody = $('<div class="timeline-body">');
                timelineBody.html(data.body);
                timelineItem.append(timelineBody);
            }

            timelineContainer.append(timelineItem);
        });
    }

    function viewTodayReport(data) {
        debugger;
        data = JSON.parse(unescape(data));
        var StaffID = data.StaffID;
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getStaffBreakTimeList";
        let json = {};
        json.StaffID = StaffID;
        obj.JSON = json;
        SilentTransportCall(obj);
    };


    function loadAttendanceChart(data) {
        const canvasElement = $('#AttendanceChart');

        if (!canvasElement || !canvasElement[0].getContext) {
            console.error('Canvas element or getContext method is not available.');
            return;
        }

        const ctx = canvasElement[0].getContext('2d');

        // Process data and create datasets
        // const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        const uniqueMonths = Array.from(new Set(data.map(item => item.AttendanceMonth)));

        const staffNames = Array.from(new Set(data.map(item => item.StaffName)));
        const datasets = staffNames.map(staffName => ({
            label: staffName,
            data: data.filter(item => item.StaffName === staffName).map(item => item.TotalPresent),
            backgroundColor: getRandomColor(),
        }));

        // Create a bar chart
        const attendanceChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: uniqueMonths,
                datasets: datasets,
            },
            options: {
                scales: {
                    x: {
                        stacked: true,
                        ticks: {
                            font: {
                                size: 20, // Adjust the font size for X-axis labels
                            },
                        },
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true,
                    },
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Staff Attendance Overview by Month With Tol.Present Days',
                        font: {
                            size: 15,
                        },
                    },
                },
            },
        });
    }



    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }


    function calculateWorkingHours(entryTime, exitTime) {
        if (!exitTime) {
            return "Not Available";
        }

        var timeDiff = exitTime - entryTime;
        var hours = Math.floor(timeDiff / 3600000);
        var minutes = Math.floor((timeDiff % 3600000) / 60000);
        var seconds = Math.floor((timeDiff % 60000) / 1000);

        return hours + 'h ' + minutes + 'm ' + seconds + 's';
    }

    function Refresh() {
        location.reload();
    }

    $('#loadtodayLeave-Modal').on('show.bs.modal', function() {
        $(this).find('.modal-dialog').addClass('slide-in');
    });

    $('#loadtodayLeave-Modal').on('hidden.bs.modal', function() {
        // Reset the modal animation class when the modal is hidden
        $(this).find('.modal-dialog').removeClass('slide-in');
    });


    function loadstaffbyyear(data) //(data) 
    {
        var table = $("#internReportsbyyear");

        try {
            if ($.fn.DataTable.isDataTable($(table))) {
                $(table).DataTable().destroy();
            }
        } catch (ex) {}

        var text = ""

        if (data.length == 0) {
            text += "No Data Found";
        } else {
            for (let i = 0; i < data.length; i++) {
                text += '<tr> ';
                text += '<td> ' + data[i].StaffName + '</td>';
                text += '<td> ' + data[i].TotalPresent + '</td>';
                text += '<td> ' + data[i].TotalAbsent + '</td>';
                text += '</tr >';
            }
        }

        $("#internReportsbyyear tbody").html("");
        $("#internReportsbyyear tbody").append(text);

        $(table).DataTable({

            responsive: true,
            "order": [],
            dom: 'Bfrtip',
            "bInfo": true,
            exportOptions: {
                columns: ':not(.hidden-col)'
            },
            "deferRender": true,
            "pageLength": 10,
            buttons: [{
                    exportOptions: {
                        columns: ':not(.hidden-col)'
                    },
                    extend: 'excel',
                    orientation: 'landscape',
                    pageSize: 'A4'
                },
                {
                    exportOptions: {
                        columns: ':not(.hidden-col)'
                    },
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'A4'
                },
                {
                    exportOptions: {
                        columns: ':not(.hidden-col)'
                    },
                    extend: 'print',
                    orientation: 'landscape',
                    pageSize: 'A4'
                }
            ]
        });
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>