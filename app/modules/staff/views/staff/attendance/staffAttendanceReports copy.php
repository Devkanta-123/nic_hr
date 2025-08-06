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

            <div class="row">
                <div class="col-md-12 p-2">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-info elevation-1"><i class="fa fa-user-check"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Today Present</span>
                                    <!-- <span class="info-box-number">
                                        10
                                        <small>%</small>
                                    </span> -->
                                </div>

                            </div>

                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-alt-slash"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Today Absent</span>
                                    <!-- <span class="info-box-number">41,410</span> -->
                                </div>

                            </div>

                        </div>


                        <div class="clearfix hidden-md-up"></div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Staff</span>
                                    <!-- <span class="info-box-number">760</span> -->
                                </div>

                            </div>

                        </div>

                       

                    </div>
                </div>
            </div>

        <!-- overall report -->
            <div class="row">
                <div class=" mt-3 col-md-12">
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Attendance Report</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" fdprocessedid="knu7jp">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body p-0" style="display: block;">
                            <div class="row p-2">
                                <div class="col-md-6">
                                    <label for="SearchBy">SearchBy</label>
                                    <select name="" id="SearchBy" class="form-control">
                                        <option value="-1">Select here</option>
                                        <option value="1">Present</option>
                                        <option value="2">Absent</option>
                                        <option value="3">Designation</option>
                                    </select>
                                </div>

                                <div class="col-md-6" id="DesignationSelectbox">
                                    <label for="Designationdata">Designation</label>
                                    <select name="" id="Designationdata" class="form-control">
                                    </select>
                                </div>

                            </div>
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Contact</th>
                                            <th>Desigantion</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Angelbert Riahtam</td>
                                            <td>7897897894</td>
                                            <td>Dev</td>
                                            <td>P</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer clearfix" style="display: block;">
                        </div>

                    </div>

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
    $("#DesignationSelectbox").hide();
    $("#SearchBy").change(function() {
        if ($("#SearchBy").val() == -1) {
            notify("warning", "Invalid option selected");
            return false;
        } else if ($("#SearchBy").val() == 1) {
            alert("TODO: get today Present Staff")
        } else if ($("#SearchBy").val() == 2) {
            alert("TODO : get today Absent Staff")
        } else if ($("#SearchBy").val() == 3) {
            $("#DesignationSelectbox").show();
        }
    });

    $("#Designationdata").change(function() {
        getTodayReportBasedonDesignation($("#Designationdata").val());
    });


    $(function() {
        getAllStaffDesignation();
    });


    function getTodayReportBasedonDesignation(data) {
        alert("TODO : get the attendance for Today based on Designation");
    }

    function getAllStaffDesignation() {
        let obj = {};
        obj.Module = "Settings";
        obj.Page_key = "getDesignations";
        obj.JSON = {};
        TransportCall(obj);
    }



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
    //     console.log(obj);
    //     TransportCall(obj); 
    // }

    function getreportByMonthDesigantion(month, Designation) {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getreportByMonthDesignation";
        let json = {};
        json.Designation = Designation;
        json.Month = month;
        obj.JSON = json;
        console.log(obj);
        TransportCall(obj);
    }

    function getMonths() {
        let obj = {};
        obj.Module = "Settings";
        obj.Page_key = "getMonths";
        obj.JSON = {};
        TransportCall(obj);
    }

    function getDesignation() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getDesignation";
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

    function getreportByYear(year, searchby) {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getreportByYear";
        let json = {};
        json.attendanceYear = year;
        json.Searchby = searchby;
        obj.JSON = json;
        TransportCall(obj);
    }

    function getreportBydate(date, searchby) {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getreportBydate";
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

    function onSuccess(rc) {
        if (rc.return_code) {
            switch (rc.Page_key) {

                case "getDesignations":
                    loadSelect("#Designationdata", rc.return_data);
                    break;


                    //need to seee the below one


                case "getMonths":
                    loadSelect("#loadMOnth", rc.return_data);
                    break;

                case "getDesignation":
                    loadSelect("#staff", rc.return_data);
                    loadSelect("#loadDesignation", rc.return_data);
                    break;

                case "getTodayAttendanceReport":
                    loaddata(rc.return_data);
                    break;

                case "getYesterdayAttendanceReport":
                    loadYesterdayReport(rc.return_data);
                    break;

                case "getTodayPresentStaff":
                    loadTodayPresentReport(rc.return_data);
                    break;

                case "getreportBydate":
                    loadstaffReport(rc.return_data);
                    break;

                case "getTodayAbsentStaff":
                    loadTodayAbsentReport(rc.return_data);
                    $("#staffReportsbyyear").hide();
                    break;

                case "getreportByYear":
                    loadstaffbyyear(rc.return_data);
                    $("#staffReports").hide();
                    break;

                case "getreportByDesignation":
                    $("#staffReportsbyyear").hide();
                    $("#staffReports").show();
                    loadstaffReport(rc.return_data);
                    break;

                case "getreportByMonthDesignation":
                    loadstaffbyyear(rc.return_data);
                    // loadDataMonthDesignation(rc.return_data);
                    // console.log(rc.return_data);
                    break;


                default:
                    notify("error", rc.Page_key);
            }
        } else {
            notify("error", rc.return_data);

        }
    }

    function loaddata(data) {
        var table = $("#todayReport");

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
                    text += '<td> <span class="badge badge-danger"> Absent </span> </td>';
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




        $("#todayReport tbody").html("");
        $("#todayReport tbody").append(text);

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

    function loadstaffReport(data) {
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
                text += '<td> ' + data[i].StaffName + '</td>';
                text += '<td> ' + data[i].ContactNo + '</td>';
                text += '<td> ' + data[i].DesignationName + '</td>';
                text += '<td> ' + data[i].AttendanceDate + '</td>';
                if (data[i].Status == '0') {
                    text += '<td > <span class="badge badge-danger"> Absent </span> </td>';
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


    // function loadDataMonthDesignation(data)
    // {
    //     console.log(data);
    // }

    function loadstaffbyyear(data) //(data) 
    {
        console.log(data);
        var table = $("#staffReportsbyyear");

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
                text += '<td> ' + data[i].Present + '</td>';
                text += '<td> ' + data[i].Absent + '</td>';
                text += '<td> ' + data[i].Onleave + '</td>';
                text += '<td> ' + data[i].All + '</td>';
                text += '<td class="btn-group btn-group-sm">';
                text += '   <a class="btn btn-info btn-sm text-white"> <i class="fas fa-pencil-alt"> </i> </a>';
                text += '   <a class="btn btn-danger btn-sm text-white"> <i class="fas fa-trash"> </i> </a>';
                text += '</td>';
                text += '</tr >';
            }
        }

        $("#staffReportsbyyear tbody").html("");
        $("#staffReportsbyyear tbody").append(text);

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