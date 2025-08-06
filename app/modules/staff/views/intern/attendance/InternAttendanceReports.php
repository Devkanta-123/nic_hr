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

            <div class="row p-3">
                <!-- Today Report -->
                <!-- <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box" title="Today Report">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-list"></i></span>
                        <div class="info-box-content TodayReport ">
                            <span class="info-box-text">Today Report</span>
                            <span class="info-box-text">Total Present</span>
                            <span class="info-box-text">Today Report</span>
                            <span class="info-box-number" id="TodayReport"></span>
                        </div>
                    </div>

                </div> -->
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
                <div class="modal fade" id="loadtoday-modal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-body">

                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Today Record's</h3>
                                    </div>

                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-6">
                                                <div class="info-box">
                                                    <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Total Present</span>
                                                        <span class="info-box-number" id="TodayPresent"></span>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="col-md-6 col-sm-6 col-12">
                                                <div class="info-box">
                                                    <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Total Absent</span>
                                                        <span class="info-box-number">410</span>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                        <table class="table table-bordered" id="TodayAttendanceReport">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10px">#</th>
                                                    <th>Name</th>
                                                    <th>Status</th>
                                                    <th style="display:none;">Label</th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
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

                            <h3 style="font-family: 'Roboto', sans-serif; font-size: 20px;">Monthly Report</h3>

                        </div>
                        <div class="card-footer p-0">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Total Present <span class="float-right badge bg-primary"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Total Absent <span class="float-right badge bg-info"></span>
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
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="far fa-chart-bar"></i>
                                Attendance Chart
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <!-- <canvas id="AttendanceChart" width="500" height="300"></canvas> -->
                            <div style="height: 400px; width:1000px; padding: 0px; position: relative;" class="full-width-chart"><canvas id="AttendanceChart" class="flot-base" width="700" height="304" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 599.444px; height: 337.986px;"></canvas></div>
                            <!-- <canvas id="studentChart" width="400" height="200"></canvas> -->

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
                                Intern Attendance
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
                                            <option value="date">Date</option>
                                            <option value="year">Year</option>
                                            <option value="staff">Intern</option>
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
                                            <label for="loadInterns">Interns</label>
                                            <select name="" class="form-control" id="loadInterns"> </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <table id="staffReports" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Attendance Date</th>
                                        <th scope="col">Intern Name </th>
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
                                        <th scope="col">Intern Name </th>
                                        <th scope="col">Total Present</th>
                                        <th scope="col">Total Absent</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>

                            <!-- by Year, Month and InternID -->
                            <table id="InternReportsbyYearMonthInternID" class="table table-bordered" style="display: none;">
                                <thead>
                                    <tr>
                                        <th scope="col">Intern Name </th>
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




            <!-- /.row -->
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
            getInternReportByDate($("#date1").val(), $("#searchby").val())
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
            getInternList();
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
        getInternReportByDate($("#date1").val(), $("#searchby").val())
    });

    $("#loadMonth").change(function() {
        if ($("#loadMonth").val() == -1) {
            notify("warning", "Please select an Option");
            return false;
        } else {
            getInternList();
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


    $("#loadInterns").change(function() {
        debugger;
        // check if both is selected
        if ($("#loadMonth").val() == -1 || $("#loadInterns").val() == -1) {
            notify("warning", "All field cannot be empty");
            return false;
        }
        getReportByYearMonthInternID($("#getYearInput").val(), $("#loadMonth").val(), $("#loadInterns").val()); //Year,month,Interns
        // alert($("#loadInterns").val());
    });



    $("#year").change(function() {
        var re = /^[0-9]+$/;
        if ($("#year").val().match(re)) {
            getInternReportByYear($("#year").val(), $("#searchby").val())
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
        getTodayAttendanceReport();
        getAllCountAttendanceReport();
        // getYesterdayAttendanceReport(); 
        // getTodayPresentStaff();
        // getTodayAbsentStaff();
        getAttendanceChart();

    });


    //just for testing
    // function getStaffListNotMarkedAttendanceByPercent()
    // {
    //     let obj = {};
    //     obj.Module = "Staff";
    //     obj.Page_key = "getStaffListNotMarkedAttendanceByPercent";
    //     let json = {};
    //     json.Designation=3; 
    //     json.Date='2023-01-14';
    //     obj.JSON = json;
    //     
    //     TransportCall(obj); 
    // }

    function getReportByYearMonthInternID(year, month, InternID) {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getReportByYearMonthInternID";
        let json = {};
        json.InternID = InternID;
        json.Year = year;
        json.Month = month;
        obj.JSON = json;
        TransportCall(obj);
    }

    function getMonths() {
        debugger;
        let obj = {};
        obj.Module = "Settings";
        obj.Page_key = "getMonths";
        obj.JSON = {};
        TransportCall(obj);
    }

    function getInternList() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getInternList";
        obj.JSON = {};
        TransportCall(obj);
    }

    function getreportByDesignation(designation, searchby) {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getreportByDesignation";
        let json = {};
        json.designation = designation;
        json.Searchby = searchby;
        obj.JSON = json;
        TransportCall(obj);
    }

    function getInternReportByYear(year, searchby) {

        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getInternReportByYear";
        let json = {};
        json.attendanceYear = year;
        json.Searchby = searchby;
        obj.JSON = json;
        TransportCall(obj);
    }

    function getInternReportByDate(date, searchby) {

        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getInternReportByDate";
        let json = {};
        json.attendanceDate = date;
        json.Searchby = searchby;
        obj.JSON = json;
        TransportCall(obj);
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

    function getTodayAttendanceReport() {
        debugger;
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getTodayAttendanceReport";
        obj.JSON = {};
        TransportCall(obj);
    }

    function getYesterdayAttendanceReport() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getYesterdayAttendanceReport";
        obj.JSON = {};
        TransportCall(obj);
    }

    function getAllCountAttendanceReport() {
        debugger;
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getAllCountAttendanceReport";
        obj.JSON = {};
        TransportCall(obj);

    }

    function getAttendanceChart() {
        debugger;
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getAttendanceChart";
        obj.JSON = {};
        TransportCall(obj);

    }





    function onSuccess(rc) {
        if (rc.return_code) {
            switch (rc.Page_key) {

                case "getMonths":
                    debugger;
                    // console.log(rc.return_data)
                    loadSelect("#loadMonth", rc.return_data);
                    break;

                case "getInternList":

                    loadSelect("#loadInterns", rc.return_data);
                    //loadSelect("#loadInterns", rc.return_data);
                    break;

                case "getTodayAttendanceReport":
                    debugger;
                    loadTodayReport(rc.return_data);
                    break;

                case "getYesterdayAttendanceReport":
                    loadYesterdayReport(rc.return_data);
                    break;

                case "getTodayPresentStaff":
                    loadTodayPresentReport(rc.return_data);
                    break;

                case "getInternReportByDate":
                    loadInternReport(rc.return_data);
                    break;

                case "getTodayAbsentStaff":
                    loadTodayAbsentReport(rc.return_data);
                    $("#internReportsbyyear").hide();
                    break;

                case "getInternReportByYear":
                    loadinternbyyear(rc.return_data);
                    $("#staffReports").hide();
                    $("#InternReportsbyYearMonthInternID").hide();
                    break;

                case "getreportByDesignation":
                    $("#internReportsbyyear").hide();
                    $("#staffReports").show();
                    loadInternReport(rc.return_data);
                    break;

                case "getReportByYearMonthInternID":
                    debugger;
                    $("#staffReports").hide();
                    $("#internReportsbyyear").hide();
                    $("#InternReportsbyYearMonthInternID").show();
                    loadInternReportByYearMonthInternID(rc.return_data);
                    break;


                case "getAllCountAttendanceReport":
                    debugger;
                    $("#TotalPresentToday").text(rc.TotalPresentToday['totalpresenttoday']);
                    $("#TotalAbsentToday").text(rc.TotalAbsentToday['totalabsenttoday']);
                    $("#TotalPresentYesterday").text(rc.TotalPresentYesterday['totalpresentyesterday']);
                    $("#TotalAbsentYesterday").text(rc.TotalAbsentYesterday['totalabsentyesterday']);
                    break;


                case "getAttendanceChart":
                    debugger;
                    console.log(rc.return_data);
                    loadAttendanceChart(rc.return_data);
                    break;

                default:
                    notify("error", rc.Page_key);
            }
        } else {
            notify("error", rc.return_data);

        }
    }

    function loadTodayReport(data) {
        debugger;
        var table = $("#TodayAttendanceReport");

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
                text += '<td> ' + data[i].StaffInternName + '</td>';
                if (data[i].Status == '0') {
                    text += '<td> <span class="badge badge-danger"> Absent </span> </td>';
                } else {
                    text += '<td > <span class="badge badge-success"> Present </span> </td>';
                }
                text += '</tr >';
            }
        }

        $("#TodayAttendanceReport tbody").html("");
        $("#TodayAttendanceReport tbody").append(text);

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

    function loadInternReport(data) {
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
                text += '<td> ' + data[i].StaffInternName + '</td>';
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

    function loadInternReportByYearMonthInternID(data) {
        var table = $("#InternReportsbyYearMonthInternID");

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
                text += '<td> ' + data[i].StaffInternName + '</td>';
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

        $("#InternReportsbyYearMonthInternID tbody").html("");
        $("#InternReportsbyYearMonthInternID tbody").append(text);

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

        const staffNames = Array.from(new Set(data.map(item => item.StaffInternName)));
        const datasets = staffNames.map(staffName => ({
            label: staffName,
            data: data.filter(item => item.StaffInternName === staffName).map(item => item.TotalPresent),
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
                        text: 'Intern Attendance Overview by Month With Tol.Present Days',
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

    $('#loadtoday-modal').on('show.bs.modal', function() {
        $(this).find('.modal-dialog').addClass('slide-in');
    });

    $('#loadtoday-modal').on('hidden.bs.modal', function() {
        // Reset the modal animation class when the modal is hidden
        $(this).find('.modal-dialog').removeClass('slide-in');
    });


    function loadinternbyyear(data) //(data) 
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
                text += '<td> ' + data[i].StaffInternName + '</td>';
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