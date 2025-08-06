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

    .hide_me {
        display: none;
    }


    li[data-dtr-index="4"] {
        display: none;
    }

    li[data-dtr-index="5"] {
        display: none;
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

    /* .form-check-input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .form-check-label {
        cursor: pointer;
    }  */
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

<!-- Attendance Summary -->
<div class="attendance-summary-float" id="summary">
    <a href="#" class="summaryP"><i class="fa-solid fa-p text-sm"></i> <span id="countP">P:0</span></a>
    <a href="#" class="summaryA"><i class="fa-solid fa-a text-sm"></i> <span id="countA">A:0</span></a>
    <a href="#" class="summaryTotal"><i class="fa-solid fa-t text-sm"></i> <span id="countTotal">T:0</span></a>
</div>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row" id="myDiv">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Intern Attendance
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group input-group-lg">
                                        <select class="form-control" id="InternCategories"></select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-lg">
                                        <input type="date" class="form-control form-control-lg" id="AttendanceDate" value="<?php echo date("Y-m-d"); ?>" max=<?php echo date("Y-m-d"); ?>>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-lg btn-primary" id="onGetAttendance">
                                                <i class="fa fa-search"></i>
                                            </button>
                                            <button type="button" class="btn btn-default btn-sm" onclick="Refresh()">
                                                <i class="fas fa-sync-alt"></i>
                                            </button>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="table" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="hide_me" style="display:none;">StaffID</th>
                                                <th scope="col" class="hide_me" style="display:none;">AttendanceID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Present/Absent</th>
                                                <th scope="col">Break In <i class="far fa-clock"></i></th>
                                                <th scope="col">Check Out</th>
                                                <th scope="col" style="font-size: small;">Break Time History</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="4" style="text-align: right">
                                                    <button class="btn  bg-gradient-success btn-xs" id="SaveAttendance">Save</button>
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- Button trigger modal -->


                    <!-- Modal -->
                    <div class="modal fade" id="LoadInternBreakListModal" tabindex="-1" role="dialog" aria-labelledby="LoadInternBreakListModalTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="FetchInternName"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="time-label">
                                                <span class="badge bg-danger" id="getDateForBreakList"></span>
                                            </div>
                                            <div class="timeline" id="timelineContainer">
                                                <!-- <div class="timeline-item">
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- load BreakOption Data -->
<!-- modal for break -->
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <p>Select break options:</p>
                <div class="row" id="breakData">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn  bg-info btn-sm" id="btnAddBreak"><i class="fas fa-arrow-circle-right"></i></button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- end modal -->


<!-- Modal -->
<div class="modal fade" id="checkout-modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center" id="output"></p>
                <p class="text-center">Click Yes If You Are Sure.</p>
                <input type="text" id="InternAttendanceID" class="hide_me">
                <input type="text" id="StaffInternID" class="hide_me">
            </div>
            <div class="modal-footer justify-content-between border-0">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info btn-sm" onclick="CheckOutNow()">Yes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- /.content-wrapper -->


<!-- Summernote -->
<script src="assets/admin/plugins/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>
<script src="assets/admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<!--<script src="assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>-->
<!--<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>-->
<!--<script src="assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>-->
<!--<script src="assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>-->
<script>
    $(function() {
        getInternCategories();
        $('#SaveAttendance').hide();
        //$('#staffid').hide(); 
        getAllBreakOption();

    });


    function getInternCategories() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getInternCategories";
        obj.JSON = {};
        SilentTransportCall(obj);
    }

    function getAllBreakOption() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getAllBreakOption";
        obj.JSON = {};
        SilentTransportCall(obj);
    }

    function BreakTimeLine(data) {
        debugger;
        data = JSON.parse(unescape(data));
        var UserID = data.StaffInternID;
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getUserBreakTimeList";
        let json = {};
        json.UserID = UserID;
        json.AttendanceDate = $("#AttendanceDate").val();
        obj.JSON = json;
        SilentTransportCall(obj);


    }


    //get the Intern data based on Categories and  attendance date
    function getInterns(InternCategoriesID, AttendanceDate) {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getInternForAttendance"; 
        let json = {};
        json.InternCategoriesID = InternCategoriesID;
        json.AttendanceDate = AttendanceDate;
        obj.JSON = json;
        SilentTransportCall(obj);
        //console.log(obj);
    }

    function onSuccess(rc) {
        if (rc.return_code) {
            switch (rc.Page_key) {
                case "getInternCategories":
                    loadSelect("#InternCategories", rc.return_data);
                    break;

                case "getInternForAttendance":
                    loaddata(rc.return_data);
                    break;

                case "getAllBreakOption":
                    loadBreakOption(rc.return_data);
                    break;


                case "getUserBreakTimeList":
                    loadBreakTimeList(rc.return_data);
                    break;

                case "giveInternManualAttendance":
                    notify("success", rc.return_data);
                    location.reload();
                    $('#SaveAttendance').hide();
                    break;

                case "updateInternIndividualAttendance":
                    notify("success", rc.return_data);
                    recalculateattendance();
                    break;

                case "InternBreakInOut":
                    notify("success", rc.return_data);
                    //getInterns();
                    location.reload();
                    // Timer(duration);
                    $("#modal-lg").modal('hide');
                    // $('#myDiv').load(location.href + ' #myDiv');
                    break;

                case "SignOutInternForToday":
                    notify("success", rc.return_data);
                    location.reload();
                    break;


                default:
                    notify("error", rc.Page_key);
            }
        } else {
            notify("error", rc.return_data);
            //clear table
            var table = $("#table");
            try {
                if ($.fn.DataTable.isDataTable($(table))) {
                    $(table).DataTable().destroy();
                }
            } catch (ex) {}
            $("#table tbody").html("");
            $('#SaveAttendance').hide();
        }
    }

    //to load BreakOptions from DB
    var BreakOptionLength = null;
    var duration = null;

    function loadBreakOption(data) {
        var table = $("#breakData");

        try {
            if ($.fn.DataTable.isDataTable($(table))) {
                $(table).DataTable().destroy();
            }
        } catch (ex) {}

        var text = "";

        if (data.length === 0) {
            text += "No Data Found";
        } else {
            BreakOptionLength = data.length;

            for (let i = 0; i < data.length; i++) {
                text += '<div class="col-md-3 mb-2">';
                text += ' <div class="form-check">';
                text += ' <input type="checkbox" class="form-check-input breakOption"  value="' + data[i].BreakOptionID + '" id="breakOption' + i + '">';
                text += '<label class="form-check-label" for="breakOption">';
                text += '<i class="' + data[i].BreakIcon + '"></i>';
                text += '</label>';
                text += '</div>';
                text += '</div>';
            }
        }

        $("#breakData").html("");
        $("#breakData").append(text);

        // Add event listener to checkboxes
        $(".breakOption").change(function() {
            if ($(this).prop("checked")) {
                // If checkbox is checked, disable all checkboxes and enable only the selected one
                $(".breakOption").not(this).prop("disabled", true);
            } else {
                // If checkbox is unchecked, enable all checkboxes
                $(".breakOption").prop("disabled", false);
            }
        });

        $(document).on('change', '.breakOption', function() {
            if ($(this).is(':checked')) {
                debugger;
                // Checkbox is checked, extract and alert the duration
                var index = $(this).attr('id').replace('breakOption', '');
                duration = data[index].Duration;
            }
        });
    }
    //Timer function

    // function Timer(durationInMinutes) { //durationInMinutes get the time in minutes format from database
    //     var currentTime = new Date().getTime();
    //     var targetTime = currentTime + durationInMinutes * 60 * 1000; // Convert duration to milliseconds

    //     var timerInterval = setInterval(function() {
    //         var currentTime = new Date().getTime();
    //         var timeDifference = targetTime - currentTime;
    //         var hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    //         var minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
    //         var seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

    //         var timerElement = $("#timer");
    //         timerElement.html(hours + "h " + minutes + "m " + seconds + "s ");

    //         if (timeDifference <= 0) {
    //             clearInterval(timerInterval);
    //             timerElement.html("Break Time expired!");
    //         }
    //     }, 1000);
    // }


    var timerInterval;

    function Timer(durationInMinutes) {
        var startTime = new Date().getTime();
        timerInterval = setInterval(function() {
            var currentTime = new Date().getTime();
            var elapsedTime = currentTime - startTime;

            var hours = Math.floor(elapsedTime / (1000 * 60 * 60));
            var minutes = Math.floor((elapsedTime % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((elapsedTime % (1000 * 60)) / 1000);

            var timerElement = $("#timer");
            timerElement.html(hours + "h " + minutes + "m " + seconds + "s ");
        }, 1000);
    }

    // function breakButton() {
    //     clearInterval(timerInterval);
    //     $("#timer").html("Break time stopped!");
    // }

    function loadBreakTimeList(dataList) {
        var timelineContainer = $("#timelineContainer");
        timelineContainer.empty();
        $("#LoadInternBreakListModal").modal("show");
        dataList.forEach(function(data) {
            var InternNameValue = data.StaffInternName;
            var outputElement = document.getElementById("FetchInternName");
            outputElement.innerHTML = InternNameValue + " Break Time History";
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


    var StaffInternID;
    var InternAttendanceID;
    var StaffInternName;

    function takeaBreak(data) {
        // $('#buttonAndTimerContainer button').hide();

        // // Show the timer
        // $('#buttonAndTimerContainer #timer').show();
        // $('#buttonAndTimerContainer #breakend').show();

        // Start your timer logic here
        var timerElement = $('#buttonAndTimerContainer #timer');
        data = JSON.parse(unescape(data));
        StaffInternID = data.StaffInternID;
        InternAttendanceID = data.InternAttendanceID;
        $("#modal-lg").modal('show');
    }

    function CheckOut(data) {
        data = JSON.parse(unescape(data));
        StaffInternID = data.StaffInternID;
        InternAttendanceID = data.InternAttendanceID;
        StaffInternName = data.StaffInternName;
        $("#StaffInternID").val(data.StaffInternID);
        $("#InternAttendanceID").val(data.InternAttendanceID);
        $("#StaffInternName").val(data.StaffInternName);
        $("#checkout-modal").modal('show');
        var staffInternNameValue = data.StaffInternName;
        // Print the Ready message with Name
        var outputElement = document.getElementById("output");
        outputElement.innerHTML = "Is " + staffInternNameValue + " Ready to Leave?";
    }



    //Get Particular Selected Date for Fetching BreakTimeList History
    $("#AttendanceDate").change(function() {
        // Get the new value when the input changes
        var attendanceDateValue = $(this).val();
        $("#getDateForBreakList").text(attendanceDateValue);
    });

    //For CheckOut Button
    function CheckOutNow() {
        var internAttendanceID = $("#InternAttendanceID").val();
        var staffInternID = $("#StaffInternID").val();
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "SignOutInternForToday";
        let json = {};
        json.InternAttendanceID = InternAttendanceID;
        json.StaffInternID = StaffInternID;
        obj.JSON = json;
        SilentTransportCall(obj);
        console.log(obj);

    }

    //Button for Break
    $("#btnAddBreak").click(function() {
        for (var i = 0; i <= BreakOptionLength; i++) {
            if ($('#breakOption' + i).prop('checked') == true) {
                //take a break in 
                let obj = {};
                obj.Module = "Staff";
                obj.Page_key = "InternBreakInOut";
                let json = {};
                json.BreakOption = $("#breakOption" + i).val();
                json.InternAttendanceID = InternAttendanceID;
                json.StaffInternID = StaffInternID;
                obj.JSON = json;
                SilentTransportCall(obj);
            }

        }
    });

    //End of the Break Button
    function EndBreak(data) {
        debugger;
        clearInterval(timerInterval);
        $("#timer").html("Break time stopped!");
        data = JSON.parse(unescape(data));
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "InternBreakInOut";
        let json = {};
        json.InternAttendanceID = data.InternAttendanceID;
        json.StaffInternID = data.StaffInternID;
        json.BreakInOut = data.BreakInOut;
        obj.JSON = json;
        console.log(obj);
        SilentTransportCall(obj);
    }



    //on click of load button get the intern detail
    $('#onGetAttendance').click(function() {
        getInterns($('#InternCategories').val(), $('#AttendanceDate').val());
    });

    // on click of savaAttendance button
    $("#SaveAttendance").click(function() {
        var AttendanceData = [];
        $("#table tbody tr").each(function() {
            AttendanceData.push({
                InternID: $(this).find("td:nth-child(1)").text(),
                Status: $(this).find("td:nth-child(4)").find("input[type='checkbox']").bootstrapSwitch('state')
            });
        });

        if ($("#AttendanceDate").val() == "") {
            notify("warning", "Please Select date!");
            return;
        }
        var data = {
            Module: "Staff",
            Page_key: "giveInternManualAttendance",
            JSON: {
                AttendanceData: AttendanceData,
                InternCategoriesID: $("#InternCategories").val(),
                AttendanceDate: $("#AttendanceDate").val()
            }
        }
        SilentTransportCall(data);
    });

    /*  Info:
        Description: for updating the status of the Intern
            24-01-2024 (Devkanta) : Adding the function     
    */
    function onStatusChange(Attendanceid, internId) {
        if (updateOnChange) {
            var id = "#s" + internId + "-" + Attendanceid;
            var status = 0;
            if ($(id).bootstrapSwitch('state') == true)
                status = 1;
            var data = {
                Module: "Staff",
                Page_key: "updateInternIndividualAttendance",
                JSON: {
                    AttendanceID: Attendanceid,
                    internId: internId,
                    Status: status,
                    AttendanceDate: $("#AttendanceDate").val()
                }
            }
            SilentTransportCall(data);
        }
        recalculateattendance();
    }

    /*  Info:
        Description: for showing the data  we get  from the database for attendance marking and update
            14-01-2024 (Devkanta) : Adding the function 
    */
    var updateOnChange = false;

    function loaddata(data) {
        updateOnChange = false;
        var table = $("#table");
        try {
            if ($.fn.DataTable.isDataTable($(table))) {
                $(table).DataTable().destroy();
            }
        } catch (ex) {}

        var text = ""

        if (data.length === 0) {
            text += "No Data Found";
        } else {

            $('#SaveAttendance').show();
            updateOnChange = false;
            for (let i = 0; i < data.length; i++) {
                text += '<tr> ';
                text += '<td    class="hide_me">' + data[i].StaffInternID + '</td>';
                text += '<td   class="hide_me">' + data[i].InternAttendanceID + '</td>';
                text += '<td>' + data[i].StaffInternName + '</td>';
                if (data[i].InternAttendanceID != -1) {
                    $('#SaveAttendance').hide();
                    updateOnChange = true;
                    if (data[i].Status == 0) {
                        text += '<td><input class="isPresent" ' + ((data[i].AttendanceModeId == 2) ? " disabled " : " ") + ' type="checkbox" onchange="onStatusChange(' + data[i].InternAttendanceID + ', ' + data[i].StaffInternID + ');" id="s' + data[i].StaffInternID + '-' + data[i].InternAttendanceID + '" style="width: 100%"  data-bootstrap-switch data-on-text="Present" data-off-text="Absent" data-off-color="danger" data-on-color="success"   ></td>';
                    } else if (data[i].Status == 1) {
                        text += '<td><input class="isPresent" type="checkbox" ' + ((data[i].AttendanceModeId == 2) ? " disabled " : " ") + ' onchange="onStatusChange(' + data[i].InternAttendanceID + ', ' + data[i].StaffInternID + ');" id="s' + data[i].StaffInternID + '-' + data[i].InternAttendanceID + '" style="width: 100%"  data-bootstrap-switch data-on-text="Present" checked data-off-text="Absent" data-off-color="danger" data-on-color="success"  ></td>';
                    } else if (data[i].Status == 2) {
                        text += '<td> On Leave</td>';
                    }
                } else
                    text += '<td><input class="isPresent" type="checkbox" id="' + data[i].StaffInternID + '::' + data[i].InternAttendanceID + '" style="width: 100%" checked data-bootstrap-switch data-on-text="Present" data-off-text="Absent" data-off-color="danger" data-on-color="success"   onchange="onStatusChange(' + data[i].InternAttendanceID + ', ' + data[i].StaffInternID + ');";">  <i style="color:red;" class="fa fa-exclamation-circle" aria-hidden="true"></i></td>';

                if (data[i].BreakInOut == 1) { //Check if the partucluar staff is absent then disable the BreakIn Button
                    text += '<td>&nbsp; <button class="btn  bg-gradient-info btn-xs" onclick="EndBreak(\'' + escape(JSON.stringify(data[i])) + '\')">End Break</button></td>';
                } else {
                    text += '<td id="buttonAndTimerContainer"> <button class="btn bg-gradient-info btn-xs" data-toggle="modal" data-target="#modal-lg" onClick="takeaBreak(\' ' + escape(JSON.stringify(data[i])) + '\')" ' + (data[i].CheckOut == 1 ? 'disabled' : ' ' + (data[i].Status == 0 ? 'disabled' : '') + '') + '>' + " Break In" + '</button> <small class="badge badge-danger" id="timer" style="display: none;"></small> &nbsp<button  style="display: none;" class="btn  bg-gradient-info btn-xs" id="breakend"  onclick="EndBreak(\'' + escape(JSON.stringify(data[i])) + '\')">End Break</button></td></td>';
                }
                text += '<td><button type="button" class="btn btn-warning btn-sm" title="Checkout" onclick="CheckOut(\'' + escape(JSON.stringify(data[i])) + '\')" ' + (data[i].CheckOut == 1 ? 'disabled' : '') + ' ' + (data[i].Status == 0 ? 'disabled' : '') + '><i class="fas fa-share"></i></button>' + (data[i].CheckOut == 1 ? '<p style="color: red; font-size: small;">Already Checked Out</p>' : '') + '</td>';
                text += '<td> <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"  onclick="BreakTimeLine(\'' + escape(JSON.stringify(data[i])) + '\')"><i class="fas fa-eye"></i></button></td>';
                text += '</tr >';
            }
        }

        $("#table tbody").html("");
        $("#table tbody").append(text);
        $(".isPresent").bootstrapSwitch({
            size: "small",
            onColor: "success",
            offColor: "danger",
        });
        recalculateattendance();
        $(table).DataTable({

            aoColumnDefs: [{
                "sClass": "hide_me",
                "aTargets": [1, 2]
            }],

            responsive: true,
            "order": [],
            dom: 'Bfrtip',
            "bInfo": true,
            exportOptions: {
                columns: ':not(.hidden-col)'
            },
            columnDefs: [{
                    target: 1,
                    visible: false,
                    searchable: false,
                },
                {
                    target: 2,
                    visible: false,
                    searchable: false,
                }
            ],
            "deferRender": true,
            "pageLength": 70,
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


    var totalP, totalA, totalcount;

    function recalculateattendance() {
        totalA = 0;
        totalP = 0;
        $("#table tbody tr").each(function() {
            var status = $(this).find("td:nth-child(4)").find("input[type='checkbox']").bootstrapSwitch('state');
            if (status == true) {
                totalP = totalP + 1;
            } else {
                totalA = totalA + 1;
            }
        });

        totalcount = totalA + totalP;
        $('#countP').text("P:" + totalP);
        $('#countA').text("A:" + totalA);
        $('#countTotal').text("T:" + totalcount);
    }

    $('#table_filter').find('input[type="search"]').on('change', function() {
        // alert(); 
    });


    function Refresh() {
        location.reload();
    }


        //Modal Animation
    $('#checkout-modal').on('show.bs.modal', function() {
        $(this).find('.modal-dialog').addClass('slide-in');
    });

    $('#checkout-modal').on('hidden.bs.modal', function() {
        // Reset the modal animation class when the modal is hidden
        $(this).find('.modal-dialog').removeClass('slide-in');
    });

    $('#LoadInternBreakListModal').on('show.bs.modal', function() {
        $(this).find('.modal-dialog').addClass('slide-in');
    });

    $('#LoadInternBreakListModal').on('hidden.bs.modal', function() {
        // Reset the modal animation class when the modal is hidden
        $(this).find('.modal-dialog').removeClass('slide-in');
    });
</script>