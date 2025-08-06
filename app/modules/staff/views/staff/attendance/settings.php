<style>
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
                        <!-- modal start -->
                        <div class="modal fade" id="modal-lg">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form method="post">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Staff timing</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body text-center">

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="StaffName">Staff Name</label>
                                                            <input type="text" id="StaffId" style="display:none;" class="form-control" autocomplete="off">
                                                            <input type="text" id="StaffAttendanceSettingID" style="display:none;" class="form-control" autocomplete="off">
                                                            <input type="text" id="StaffName" class="form-control" maxlength="30" placeholder="Staff Name" autocomplete="off" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="attendanceMode">Attendance Mode</label>
                                                            <select name="" class="form-control" id="attendanceMode"></select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="getSupervisor1">Supervisor 1</label>
                                                            <select name="" class="form-control" id="getSupervisor1"></select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="getSupervisor2">Supervisor 2</label>
                                                            <select name="" class="form-control" id="getSupervisor2"></select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="startTime">Start Time</label>
                                                            <input type="time" id="startTime" class="form-control" autocomplete="off">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
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
                                            <button type="button" class="btn btn-primary" id="btnsavestaffSetting">Save </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- modal end -->

                        <!-- modal to choose the office QR code -->
                        <div class="modal fade" id="QRmodal">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form method="post">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Office QR Code</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body text-center">
                                                <div class="row" id="officeLocation">

                                                </div>

                                                <div class="row" id="GenerateQRdiv">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer ">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end modal -->

                        <div class="card-header">
                            <div class="card-title"> Setting(s)
                                <div class="btn btn-warning text-white" id="qrsheet">QR Sheet</div>
                                <!-- <div class="btn btn-info" id="qrsheetgenerate">Re-generate</div> -->
                            </div>
                        </div>
                        <div class="card-body">
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
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" id="saveSettingTiming">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Staff Timing
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="table1" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" style="display: none;" class="hidden-col">StaffSEttingID</th>
                                        <th scope="col">Staff </th>
                                        <th scope="col"> Mode </th>
                                        <th scope="col">Start Time</th>
                                        <th scope="col">End Time</th>
                                        <th scope="col">Supervisor 1</th>
                                        <th scope="col">Supervisor 2</th>
                                        <th scope="col" style="display: none;" class="hidden-col">StaffID</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                        </div>
                        <!-- /.card-body -->
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
        getStaff();
        getSettingTiming();
        getStaffTiming();
    });



    function getStaff() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getStaff";
        obj.JSON = {};
        SilentTransportCall(obj);
    }





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

    function getStaffTiming() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getStaffTiming";
        obj.JSON = {};
        TransportCall(obj);
    }

    //to view all office and QR code 
    $('#qrsheet').click(function() {
        let obj = {};
        obj.Module = "Settings";
        obj.Page_key = "getAllOffice";
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

                case "getStaff":
                    loadSelect('#getSupervisor1,#getSupervisor2', rc.return_data);
                    break;

                case "getStaffTiming":
                    console.log(rc.return_data);
                    loaddata(rc.return_data);
                    break;

                case "saveStaffAttendanceTiming":
                    notify("success", rc.return_data);
                    getStaffTiming();
                    break;

                case "getSettingTiming":
                    settingTiming(rc.return_data);
                    break;

                case "UpdatesettingTiming":
                    notify("success", rc.return_data);
                    break;

                case "getAllOffice":
                    loadOfficeLocation(rc.return_data);
                    $("#QRmodal").modal('show');
                    // //check for what purpose we request
                    // if (QRTask == 1) { 
                    //     OfficeID=btoa(1);
                    //     mode=btoa(1);
                    // window.open('staff-printqr','_self');
                    // } else {
                    //     loadOfficeLocation(rc.return_data); //For printing QRCode
                    //     $("#QRmodal").modal('show');
                    // }
                    break;
                case "generateAttendanceQRSheet":
                    debugger;
                    console.log(rc.data); //OfficeID,mode
                    // staff-printqr?OfficeId=' + OfficeID + '&mode=' + mode + '

                    window.open('staff-printqr?OfficeId=' + btoa(rc.data['OfficeID']) + '&mode=' + btoa(rc.data['mode']), '_self');
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
                text += '<td style="display:none;" > ' + data[i].StaffAttendanceSettingID + '</td>';
                text += '<td> ' + data[i].StaffName + '</td>';
                text += '<td > ' + (data[i].AttendanceMode == null ? "<span class='badge badge-danger'> NA </span>" : data[i].AttendanceMode) + '</td>';
                text += '<td > ' + (data[i].StartTime == null ? "<span class='badge badge-danger'> NA </span>" : data[i].StartTime) + '</td>';
                text += '<td> ' + (data[i].EndTime == null ? "<span class='badge badge-danger'> NA </span>" : data[i].EndTime) + '</td>';
                text += '<td > ' + (data[i].Supervisor1Name == null ? "<span class='badge badge-danger'> NA </span>" : data[i].Supervisor1Name) + '</td>';
                text += '<td > ' + (data[i].Supervisor2Name == null ? "<span class='badge badge-danger'> NA </span>" : data[i].Supervisor2Name) + '</td>';
                text += '<td style="display:none;"> ' + data[i].StaffID + '</td>';
                text += '<td class="btn-group btn-group-sm">';
                text += '   <a class="btn btn-info btn-sm text-white" onclick="onEdit(\'' + escape(JSON.stringify(data[i])) + '\')" > <i class="fas fa-pencil-alt"> </i> </a>';
                text += '</td>';
                text += '</tr >';
            }
        }

        $("#table1 tbody").html("");
        $("#table1 tbody").append(text);

    }


    //for printing the qr code
    function loadOfficeLocation(data) {
        var table = $("#officeLocation");
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
                text += '<div class="col-md-12">';
                text += '<p class="text-left">' + data[i].OfficeName + '</p>';
                text += '<div class="row p-1">';

                //for staff
                text += '<div class="col-md-5 m-1 p-1 small-box bg-info">';
                text += '<div class="inner text-left">';
                text += '<p class="badge badge-info"> Staff QR</p>';
                text += '</div>';
                text += '<div class="row">';
                text += '<div class="col-md-6">';
                OfficeID = btoa(data[i].OfficeID);
                // mode=1;
                mode = btoa(1);
                //mode 1 will be Staff, 2 intern
                //view QR
                text += '<a href="staff-printqr?OfficeId=' + OfficeID + '&mode=' + mode + '" class="small-box-footer">  QR Sheet <i class="fas fa-arrow-circle-right"></i></a>';
                text += '</div>';

                text += '<div class="col-md-6">';
                OfficeID = data[i].OfficeID;
                mode = 1;

                // OfficeID = btoa(data[i].OfficeID);
                // mode = btoa(1);
                //mode 1 will be Staff, 2 intern
                //generate

                text += ' <a class=" btn btn-sm small-box-footer" title="Re-Generate QR" onclick="onGenerate(\'' + OfficeID + ',' + mode + '\')"> Re-Generate <i class="fas fa-arrow-circle-right"></i> </a>';
                // text += '<a onclick="onGenerate(' + OfficeID + ',\'' + mode + '\')" class="small-box-footer"> Re-Generate <i class="fas fa-arrow-circle-right"></i></a>';
                text += '</div>';
                text += '</div>';
                text += '</div>';


                // for intern 
                text += '<div class="col-md-5 p-1 m-1 small-box bg-info">';
                text += '<div class="inner text-left">';
                text += '<p class="badge badge-info"> Intern QR</p>';
                text += '</div>';
                text += '<div class="row">';
                text += '<div class="col-md-6">';
                OfficeID = btoa(data[i].OfficeID);
                // mode=2;
                mode = btoa(2);
                //mode 1 will be Staff, 2 intern
                text += '<a href="staff-printqr?OfficeId=' + OfficeID + '&mode=' + mode + '" class="small-box-footer">  QR Sheet <i class="fas fa-arrow-circle-right"></i></a>';
                text += '</div>';

                text += '<div class="col-md-6">';
                // OfficeID = btoa(data[i].OfficeID);
                OfficeID = data[i].OfficeID;
                mode = 2;
                // mode = btoa(2);
                //mode 1 will be Staff, 2 intern
                text += ' <a class=" btn btn-sm small-box-footer" title="Re-Generate QR" onclick="onGenerate(\'' + OfficeID + ',' + mode + '\')"> Re-Generate <i class="fas fa-arrow-circle-right"></i> </a>';

                // text += '<a href="staff-printqr?OfficeId=' + OfficeID + '&mode=' + mode + '" class="small-box-footer"> Re-Generate <i class="fas fa-arrow-circle-right"></i></a>';
                text += '</div>';
                text += '</div>';
                text += '</div>';
                //end for intern

                text += '</div>';
            }
        }

        $("#officeLocation").html("");
        $("#officeLocation").append(text);
    }


    //need to remove
    //store what task to be done (genrate/print)
    // var QRTask;
    //for generate QR Code
    // $('#qrsheetgenerate').click(function() {

    //     let obj = {};
    //     obj.Module = "Staff";
    //     obj.Page_key = "generateAttendanceQRSheet";
    //     let json = {};
    //     json.OfficeID = 1 ; 
    //     json.UserType = 1; //usertype: 1=staff,2=intern
    //     obj.JSON = json;
    //     console.log(obj); 
    //     // TransportCall(obj);
    // });
    function onGenerate(officeID) {

        let arr = officeID.split(',');

        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "generateAttendanceQRSheet";
        let json = {};
        json.OfficeID = arr[0];
        json.UserType = arr[1]; //usertype: 1=staff,2=intern
        obj.JSON = json;
        // console.log(obj); 
        TransportCall(obj);
    }

    //Load office for generating the QR Code
    function loadOfficeLocationforGenerateQR(data) {
        var table = $("#GenerateQRdiv");
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
                text += '<div class="col-md-3">';
                text += '<div class="small-box bg-info">';
                text += '<div class="inner">';
                text += '<p>' + data[i].OfficeName + '</p>';
                text += '</div>';
                text += '<div class="icon">';
                text += '<i class="fa fa-house"></i>';
                text += '</div>';
                OfficeID = btoa(data[i].OfficeID);
                mode = btoa(1);
                // mode 1 will be Staff, 2 intern
                text += '<a href="staff-printqr?OfficeId=' + OfficeID + '&mode=' + mode + '" class="small-box-footer">Get QR <i class="fas fa-arrow-circle-right"></i></a>';
                text += '</div>';
                text += '</div>';
            }
        }

        $("#GenerateQRdiv").html("");
        $("#GenerateQRdiv").append(text);
    }



    // load the main setting designation wise
    function settingTiming(data) {
        var table = $("#SettingTiming1");
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
                text += '<td  style="display: none;">' + data[i].StaffAttendanceSettingID + '</td>';
                text += '<td> ' + data[i].DesignationName + '</td>';
                text += '<td> <input type="time" class="form-control" value=' + data[i].StartTime + '> </td>';
                text += '<td> <input type="time" class="form-control" value=' + data[i].EndTime + '> </td>';
                text += '<td  style="display: none;">' + data[i].DesignationID + '</td>';
                text += '</tr >';
            }
        }
        // StartTime,EndTime
        $("#SettingTiming1 tbody").html("");
        $("#SettingTiming1 tbody").append(text);

    }

    //save  the Timing Setting for that particular designation
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
                StaffId: $(this).find("td:nth-child(6)").text(),
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

    var StaffIDForUpdating = null;
    var StaffAttendanceTimingID = null;
    var StaffDesignationID = null;

    function onEdit(data) {
        data = JSON.parse(unescape(data));
        $("#designationID").val(data.DesignationID);
        $("#StaffAttendanceTimingID").val(data.StaffAttendanceTimingID);

        StaffDesignationID = data.DesignationID;
        StaffAttendanceTimingID = data.StaffAttendanceTimingID;
        StaffIDForUpdating = data.StaffID;

        $("#StaffId").val(data.StaffID);
        $("#StaffName").val(data.StaffName);
        $("#attendanceMode").val(data.AttendanceModeID);
        $("#startTime").val(data.StartTime);
        $("#endTime").val(data.EndTime);
        $("#modal-lg").modal("show");
    }

    // from modal (staff timing,Modeofattendance,Etc)
    $("#btnsavestaffSetting").click(function() {
        debugger;
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "saveStaffAttendanceTiming";
        let json = {};
        json.DesignationID = StaffDesignationID; // $("#designationID").val();
        json.StaffId = StaffIDForUpdating; //$("#StaffId").val();
        json.StaffAttendanceTimingID = StaffAttendanceTimingID; // $("#StaffAttendanceTimingID").val();
        json.attendanceMode = $("#attendanceMode").val();
        json.startTime = $("#startTime").val();
        json.EndTime = $("#endTime").val();
        json.Supervisor1 = $("#getSupervisor1").val();
        json.Supervisor2 = $("#getSupervisor2").val();
        obj.JSON = json;
        console.log(obj);
        SilentTransportCall(obj);
        $("#modal-lg").modal("hide");

    });
</script>