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
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="modal fade" id="modal-lg">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form method="post">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Intern timing</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body text-center">

                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="StaffName">Intern Name</label>
                                                            <input type="text" id="InternID" style="display:none;" class="form-control" autocomplete="off">
                                                            <input type="text" id="StaffAttendanceSettingID" style="display:none;" class="form-control" autocomplete="off">
                                                            <input type="text" id="StaffName" class="form-control" maxlength="30" placeholder="Staff Name" autocomplete="off" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="attendanceMode">Attendance Mode</label>
                                                            <select name="" class="form-control" id="attendanceMode"></select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="startTime">Start Time</label>
                                                            <input type="time" id="startTime" class="form-control" autocomplete="off">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="endTime">End Time</label>
                                                            <input type="time" id="endTime" class="form-control" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer ">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="btnsaveInternSetting">Save </button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <div class="card-header">
                            <div class="card-title">
                                <!-- <select class="form-control" id="AttendanceMode"></select> -->
                                Setting(s)

                                <div class="btn btn-warning text-white" id="qrsheet">QR Sheet</div>
                                <div class="btn btn-info" id="qrsheetgenerate">Re-generate</div>


                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- <div class="card-body">
                        <table id="SettingTiming1" class="table table-bordered">
                                <thead>
                                    <tr>  
                                      
                                        <th scope="col" style="display: none;" class="hidden-col">StaffAttendanceTimingID</th>
                                        <th scope="col">Designation </th>
                                        <th scope="col">Start Time</th>
                                        <th scope="col">End Time</th>
                                        <th scope="col" style="display: none;">DesignationID</th>
                                       
                                    </tr>

                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div> -->
                        <!-- <div class="card-footer">
                        <button class="btn btn-primary" id="saveSettingTiming">Save</button>
                            
                        </div> -->
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <!-- 
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Intern Timing
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="table1" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" style="display: none;" class="hidden-col">StaffSEttingID</th>
                                        <th scope="col">Intern Name </th>
                                        <th scope="col"> Attendance Mode </th>
                                        <th scope="col">Start Time</th>
                                        <th scope="col">End Time</th>
                                        <th scope="col" style="display: none;" class="hidden-col">InternID</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                        </div>
        
                    </div>
                </div>
            </div> -->
            <div class="col-12 mt-6">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Intern Timing</h3>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered" id="table1">
                                <thead>
                                    <tr>
                                        <th scope="col" style="display: none;" class="hidden-col">StaffSEttingID</th>
                                        <th scope="col">Sl.No</th>
                                        <th scope="col">Intern Name </th>
                                        <th scope="col"> Attendance Mode </th>
                                        <th scope="col">Start Time</th>
                                        <th scope="col">End Time</th>
                                        <th scope="col" style="display: none;" class="hidden-col">InternID</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Your table data goes here -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>

        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<script src="assets/admin/plugins/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>
<script src="assets/admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>

<script>
    $(function() {
        getAttendanceMode();
        getSettingTiming();
        getInternTiming();
    });

    function getAttendanceMode() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getAttendanceMode";
        obj.JSON = {};
        TransportCall(obj);
    }


    // setting timing
    function getSettingTiming() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getSettingTiming";
        obj.JSON = {};
        TransportCall(obj);
    }

    function getInternTiming() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getInternTiming";
        obj.JSON = {};
        TransportCall(obj);
    }

    $('#qrsheet').click(function() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getAttendanceQRSheet";
        obj.JSON = {};
        TransportCall(obj);
    });
    $('#qrsheetgenerate').click(function() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "generateAttendanceQRSheet";
        obj.JSON = {};
        TransportCall(obj);
    });

    function getStaffStartTimeEndtime() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getStaffStartTimeEndtime";
        obj.JSON = {};
        TransportCall(obj);

    }

    function getStaffDesignationStartTimeEndtime() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getStaffDesignationStartTimeEndtime";
        obj.JSON = {};
        TransportCall(obj);
    }

    function onSuccess(rc) {
        if (rc.return_code) {
            switch (rc.Page_key) {


                case "getAttendanceMode":
                    loadSelect('#attendanceMode', rc.return_data);
                    break;

                case "getInternTiming":
                    loaddata(rc.return_data);
                    break;

                case "saveInternAttendanceTiming":
                    notify("success", rc.return_data);
                    getInternTiming();
                    break;

                case "getSettingTiming":
                    settingTiming(rc.return_data);
                    break;

                case "UpdatesettingTiming":
                    notify("success", rc.return_data);
                    break;

                case "generateAttendanceQRSheet":
                    notify("success", rc.return_data);
                    window.open("staff-printqr", "_self");
                    break;

                case "getAttendanceQRSheet":
                    notify("success", "Loading...");
                    window.open("staff-printqr", "_self");
                    break;

                default:
                    notify("error", rc.Page_key);
            }
        } else {
            notify("warning", rc.return_data);
        }
    }

    //laod data  based on staff and their timing 
    function loaddata(data) {
        console.log(data);
        var table = $("#table1");
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
                text += '<tr>';
                text += '<td style="display:none;"> ' + data[i].InternAttendanceTimingID + '</td>';
                text += '<td> # ' + (i + 1) + '</td>';
                text += '<td> ' + data[i].StaffInternName + '</td>';
                text += '<td> ' + (data[i].AttendanceMode == null ? "<span class='badge badge-danger'> NA </span>" : data[i].AttendanceMode) + '</td>';
                text += '<td> ' + (data[i].StartTime == null ? "<span class='badge badge-danger'> NA </span>" : data[i].StartTime) + '</td>';
                text += '<td> ' + (data[i].EndTime == null ? "<span class='badge badge-danger'> NA </span>" : data[i].EndTime) + '</td>';
                text += '<td style="display:none;"> ' + data[i].StaffInternID + '</td>';
                text += '<td class="btn-group btn-group-sm">';
                text += '<a class="btn btn-info btn-sm text-white" onclick="onEdit(\'' + escape(JSON.stringify(data[i])) + '\')">';
                text += '<i class="fas fa-pencil-alt"></i>';
                text += '</a>';
                text += '</td>';
                text += '</tr>';
            }

        }

        $("#table1 tbody").html("");
        $("#table1 tbody").append(text);

    }

    // load the main setting designation wise
    // function settingTiming(data) 
    // {
    //     var table = $("#SettingTiming1");
    //     try {
    //         if ($.fn.DataTable.isDataTable($(table))) {
    //             $(table).DataTable().destroy();
    //         }
    //     } catch (ex) {}

    //     var text = ""

    //     if (data.length == 0) {
    //         text += "No Data Found";
    //     } else {
    //         for (let i = 0; i < data.length; i++) {
    //             text += '<tr> ';
    //             text += '<td  style="display: none;">' + data[i].StaffAttendanceSettingID + '</td>';
    //             text += '<td> ' +data[i].DesignationName  + '</td>';
    //             text += '<td> <input type="time" class="form-control" value='+ data[i].StartTime+'> </td>';
    //             text += '<td> <input type="time" class="form-control" value='+ data[i].EndTime+'> </td>';
    //             text += '<td  style="display: none;">' + data[i].DesignationID + '</td>';
    //             text += '</tr >';
    //         }
    //     }
    //    // StartTime,EndTime
    //     $("#SettingTiming1 tbody").html("");
    //     $("#SettingTiming1 tbody").append(text);

    // }

    //save staff Setting
    $("#saveSettingTiming").click(function() {
        var AttendanceData = [];
        $("#SettingTiming1 tbody tr").each(function() {
            AttendanceData.push({
                StaffAttendanceTiming: $(this).find("td:nth-child(1)").text(),
                Designation: $(this).find("td:nth-child(2)").text(),
                StartTime: $(this).find("td:nth-child(3)").find("input[type='time']").val(),
                EndTime: $(this).find("td:nth-child(4)").find("input[type='time']").val(),
                DesignationID: $(this).find("td:nth-child(5)").text(),
            });
        });
        var data = {
            Module: "Staff",
            Page_key: "UpdatesettingTiming",
            JSON: {
                AttendanceData: AttendanceData,
            }
        }

        TransportCall(data);
    });

    $("#saveStaffAttendanceSetting").click(function() {
        var StaffSetting = [];
        $("#table1 tbody tr").each(function() {
            StaffSetting.push({
                StaffSettingID: $(this).find("td:nth-child(1)").text(),
                AttendanceMode: $(this).find("td:nth-child(3)").find("select").val(),
                StartTime: $(this).find("td:nth-child(4)").text(),
                EndTime: $(this).find("td:nth-child(5)").text(),
                StafInternfId: $(this).find("td:nth-child(6)").text(),
            });
        });
        var data = {
            Module: "Staff",
            Page_key: "SaveStaffSetting",
            JSON: {
                StaffSetting: StaffSetting,
            }
        }

        TransportCall(data);
    });
    let StaffInternID;
    var code = null;

    function onEdit(data) {
        data = JSON.parse(unescape(data));
        $("#StaffAttendanceTimingID").val(data.InternAttendanceTimingID);
        $("#StafInternfId").val(data.StaffInternID);
        $("#StaffName").val(data.StaffInternName);
        $("#attendanceMode").val(data.AttendanceModeID).trigger("change");
        $("#startTime").val(data.StartTime);
        $("#endTime").val(data.EndTime);
        $("#modal-lg").modal("show");
        StaffInternID = data.StaffInternID;
        code = data.InternAttendanceTimingID;
    }

    //save staffTiming
    $("#btnsaveInternSetting").click(function() {
        debugger;
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "saveInternAttendanceTiming"; //setting
        let json = {};
        json.StaffInternId = StaffInternID;
        json.attendanceMode = $("#attendanceMode").val();
        json.startTime = $("#startTime").val();
        json.EndTime = $("#endTime").val();


        if ($("#attendanceMode").val() == '' || $("#startTime").val() == '' || $("#endTime").val() == '') {
            notify("error", "All fields  are required..");
            return; // Exit the function if validation fails

        }
        if ($("#startTime").val() === $("#endTime").val()) {
            // Display a warning message
            notify("error", "Start Time and End Time cannot be the same");
            return; // Exit the function if validation fails
        }

        if (code != null) {
            json.InternAttendanceTimingID = code;
        }

        obj.JSON = json;
        console.log(obj);
        TransportCall(obj);
        $("#modal-lg").modal("hide");

    });
</script>