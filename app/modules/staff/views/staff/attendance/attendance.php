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
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Attendance
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <!-- modal for break -->
                            <div class="modal fade" id="modal-lg">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Select break options:</p>
                                            <div class="row" id="breakData">
                                                <!-- <div class="col-md-3 mb-2">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="teaBreak">
                                                        <label class="form-check-label" for="teaBreak">
                                                            <i class="fas fa-coffee"></i>
                                                        </label>
                                                    </div>
                                                </div> -->

                                                <!-- <div class="col-md-3 mb-2">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="lunchBreak">
                                                        <label class="form-check-label" for="lunchBreak">
                                                            <i class="fas fa-utensils"></i>
                                                        </label>
                                                    </div>
                                                </div> -->

                                                <!-- <div class="col-md-3 mb-2">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="meetingBreak">
                                                        <label class="form-check-label" for="meetingBreak">
                                                            <i class="fas fa-users"></i>
                                                        </label>
                                                    </div>
                                                </div> -->
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
                                            <input type="text" id="StaffAttendanceID" class="hide_me">
                                            <input type="text" id="StaffID" class="hide_me">
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




                            <div class="row">
                                <div class="col-md-6">
                                    <select class="form-control" id="Designation"></select>
                                </div>

                                <div class="col-md-4">
                                    <input type="date" class="form-control " id="AttendanceDate" value="<?php echo date("Y-m-d"); ?>" max=<?php echo date("Y-m-d"); ?>>
                                </div>
                                <div class="col-md-3" style="display:none">
                                    <select class="form-control" id="Students"></select>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary" id="onGetAttendance">Load</button>
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
                                                <!-- <th scope="col">Break</th>
                                                <th scope="col">CheckOut</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="4" style="text-align: right">
                                                    <button class="btn btn-success" id="SaveAttendance"><i class="bx bx-upload p-2"> </i>Save</button>
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
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
    $(function() {
        getDesignations();
        $('#SaveAttendance').hide();
        getAllBreakOption();

    });


    function getAllBreakOption() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getAllBreakOption";
        obj.JSON = {};
        TransportCall(obj);
    }

    function getDesignations() {
        let obj = {};
        obj.Module = "Settings";
        obj.Page_key = "getDesignations";
        obj.JSON = {};
        TransportCall(obj);
    }

    //get the staff data based on designation and  attendance date
    function getStaffs(StaffDesignationID, AttendanceDate) {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getStaffForAttendance";
        let json = {};
        json.StaffDesignationID = StaffDesignationID;
        json.AttendanceDate = AttendanceDate;
        obj.JSON = json;
        SilentTransportCall(obj);
    }

    function onSuccess(rc) {
        if (rc.return_code) {
            switch (rc.Page_key) {
                case "getDesignations":
                    loadSelect("#Designation", rc.return_data);
                    break;

                case "getStaffForAttendance":
                    console.log(rc.return_data);
                    loaddata(rc.return_data);
                    break;

                case "giveManualAttendance":
                    notify("success", rc.return_data);
                    location.reload();
                    $('#SaveAttendance').hide();
                    break;

                case "updateIndividualAttendance":
                    notify("success", rc.return_data);
                    recalculateattendance();
                    break;
                case "SignOutUserForToday":
                    notify("success", rc.return_data);
                    break;
                case "StaffBreakInOut":
                    $("#modal-lg").modal('hide');
                    notify("success", rc.return_data);
                    break;

                case "getAllBreakOption":
                    loadBreakOption(rc.return_data);
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

    //on change of input designation and date  get staff info
    // $('#Designation,#AttendanceDate').change(function (){
    //   getStaffs($('#Designation').val(),$('#AttendanceDate').val()); 
    // });

    //on click of load button get the staff detail
    $('#onGetAttendance').click(function() {
        getStaffs($('#Designation').val(), $('#AttendanceDate').val());
    });

    // on click of savaAttendance button
    $("#SaveAttendance").click(function() {
        var AttendanceData = [];
        $("#table tbody tr").each(function() {
            AttendanceData.push({
                StaffID: $(this).find("td:nth-child(1)").text(),
                Status: $(this).find("td:nth-child(4)").find("input[type='checkbox']").bootstrapSwitch('state')
            });
        });

        if ($("#AttendanceDate").val() == "") {
            notify("warning", "Please Select date!");
            return;
        }
        var data = {
            Module: "Staff",
            Page_key: "giveManualAttendance",
            JSON: {
                AttendanceData: AttendanceData,
                Designation: $("#Designation").val(),
                AttendanceDate: $("#AttendanceDate").val()
            }
        }
        TransportCall(data);
    });

    /*  Info:
        Description: for upadting the status of the attendance
            24-01-2024 (Angelbert) : Adding the function     
    */
    function onStatusChange(Attendanceid, staffId) {
        if (updateOnChange) {
            var id = "#s" + staffId + "-" + Attendanceid;
            var status = 0;
            if ($(id).bootstrapSwitch('state') == true)
                status = 1;
            var data = {
                Module: "Staff",
                Page_key: "updateIndividualAttendance",
                JSON: {
                    AttendanceID: Attendanceid,
                    staffId: staffId,
                    Status: status,
                    Designation: $("#Designation").val(),
                    AttendanceDate: $("#AttendanceDate").val()
                }
            }
            TransportCall(data);
        }
        recalculateattendance();
    }

    /*  Info:
        Description: for showing the data  we get  from the server for attendance marking and update
            14-01-2024 (Angelbert) : Adding the function 
    */
    var updateOnChange = false;

    function loaddata(data) {
        console.log(data);
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
                text += '<td    class="hide_me">' + data[i].StaffID + '</td>';
                text += '<td   class="hide_me">' + data[i].StaffAttendanceID + '</td>';
                text += '<td>' + data[i].StaffName + '</td>';
                if (data[i].StaffAttendanceID != -1) {
                    $('#SaveAttendance').hide();
                    updateOnChange = true;
                    if (data[i].Status == 0) {
                        text += '<td><input class="isPresent" ' + ((data[i].AttendanceModeId == 2) ? " disabled " : " ") + ' type="checkbox" onchange="onStatusChange(' + data[i].StaffAttendanceID + ', ' + data[i].StaffID + ');" id="s' + data[i].StaffID + '-' + data[i].StaffAttendanceID + '" style="width: 100%"  data-bootstrap-switch data-on-text="Present" data-off-text="Absent" data-off-color="danger" data-on-color="success">';
                        text += '</td>'
                    } else if (data[i].Status == 1) {
                        text += '<td><input class="isPresent" type="checkbox" ' + ((data[i].AttendanceModeId == 2) ? " disabled " : " ") + ' onchange="onStatusChange(' + data[i].StaffAttendanceID + ', ' + data[i].StaffID + ');" id="s' + data[i].StaffID + '-' + data[i].StaffAttendanceID + '" style="width: 100%"  data-bootstrap-switch data-on-text="Present" checked data-off-text="Absent" data-off-color="danger" data-on-color="success">';

                        //take a brreak
                        if (data[i].BreakInOut == 1) //staff on break
                        {
                            // text +=" &nbsp; <span class='badge badge-danger'>On Break</span>";
                            text += '&nbsp; <a class="badge badge-danger" onclick="EndBreak(\'' + escape(JSON.stringify(data[i])) + '\')">On Break</a>';

                        } else {
                            text += '&nbsp; <a class="badge badge-info" title="Break" onclick="takeaBreak(\'' + escape(JSON.stringify(data[i])) + '\')"> Take A Break</a>';
                        }
                        // text +='<span class="badge badge-info"> Take A break </span>';
                        // if (data[i].BreakInOut == 0) {
                        //     //break IN
                        //     text += '<input class="takeABreak" type="checkbox" ' + ((data[i].AttendanceModeId == 2) ? " disabled " : " ") + ' onchange="breakInOut(' + data[i].StaffAttendanceID + ', ' + data[i].StaffID + ');" id="break' + data[i].StaffID + '-' + data[i].StaffAttendanceID + '" style="width: 100%"  data-bootstrap-switch data-on-text="BreakIN" checked data-off-text="BreakOut" data-off-color="danger" data-on-color="success"  >';
                        // } else {
                        //     //break OUT
                        //     text += '<input class="takeABreak" ' + ((data[i].AttendanceModeId == 2) ? " disabled " : " ") + ' type="checkbox" onchange="breakInOut(' + data[i].StaffAttendanceID + ', ' + data[i].StaffID + ');" id="break' + data[i].StaffID + '-' + data[i].StaffAttendanceID + '" style="width: 100%"  data-bootstrap-switch data-on-text="BreakIN" data-off-text="BreakOut" data-off-color="danger" data-on-color="success"   >';
                        // }

                        // STAFF CHECK OUT FOR TODAY
                        if (data[i].StaffOut == -1) {
                            //staff is still in work
                            text += ' <a class="btn btn-info btn-sm text-white" title="Checkout" onclick="CheckOut(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fas fa-sign-out"> </i> </a>';

                        } else {
                            text += '<span class="badge badge-danger"> Already CheckOut </span>';
                        }
                        text += '</td>'
                    } else if (data[i].Status == 2) {
                        text += '<td> On Leave</td>';
                    }
                } else
                    text += '<td><input class="isPresent" type="checkbox" id="' + data[i].StaffID + '::' + data[i].StaffAttendanceID + '" style="width: 100%" checked data-bootstrap-switch data-on-text="Present" data-off-text="Absent" data-off-color="danger" data-on-color="success"   onchange="onStatusChange(' + data[i].StaffAttendanceID + ', ' + data[i].StaffID + ');";">  <i style="color:red;" class="fa fa-exclamation-circle" aria-hidden="true"></i></td>';
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

    var StaffAttendanceID, StaffID, StaffName;

    function CheckOut(data) {
        debugger;
        data = JSON.parse(unescape(data));
        // json.StaffAttendanceID = data.StaffAttendanceID;
        // json.StaffName = data.StaffName;
        // json.StaffID = data.StaffID;
        $("#StaffID").val(data.StaffID);
        $("#StaffAttendanceID").val(data.StaffAttendanceID);
        $("#StaffName").val(data.StaffName);
        $("#checkout-modal").modal('show');
        var staffName = data.StaffName;
        var outputElement = document.getElementById("output");
        outputElement.innerHTML = "Is " + staffName + " Ready to Leave?";
    }



    //For CheckOutNow Button
    function CheckOutNow() {
        debugger;
        var StaffAttendanceID = $("#StaffAttendanceID").val();
        var StaffID = $("#StaffID").val();
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "SignOutUserForToday";
        let json = {};
        json.StaffAttendanceID = StaffAttendanceID;
        json.StaffID = StaffID;
        obj.JSON = json;
        SilentTransportCall(obj);
    }

    //staff break in out
    // function breakInOut(Attendanceid, staffId) {
    //     if (updateOnChange) {
    //         var id = "#break" + staffId + "-" + Attendanceid;
    //         var status = 0;
    //         if ($(id).bootstrapSwitch('state') == true) {
    //             status = 0;
    //         } else {
    //             status = 1;
    //         }
    //         var data = {
    //             Module: "Staff",
    //             Page_key: "StaffBreakInOut",
    //             JSON: {
    //                 AttendanceID: Attendanceid,
    //                 staffId: staffId,
    //                 Status: status,
    //                 AttendanceDate: $("#AttendanceDate").val()
    //             }
    //         }
    //         // console.log(data);
    //         TransportCall(data);
    //     }

    // }

    var BreakOptionLength = null;

    function loadBreakOption(data) {
        var table = $("#breakData");
        try {
            if ($.fn.DataTable.isDataTable($(table))) {
                $(table).DataTable().destroy();
            }
        } catch (ex) {}

        var text = ""

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


    $("#btnAddBreak").click(function() {
        debugger;
        for (var i = 0; i <= BreakOptionLength; i++) {
            if ($('#breakOption' + i).prop('checked') == true) {
                //take a break in 
                let obj = {};
                obj.Module = "Staff";
                obj.Page_key = "StaffBreakInOut";
                let json = {};
                json.BreakOption = $("#breakOption" + i).val();
                json.StaffAttendanceID = StaffAttendanceID;
                json.StaffID = StaffID;
                obj.JSON = json;
                SilentTransportCall(obj);
                // console.log(obj);
            }

        }
    });

    var StaffID;
    var StaffAttendanceID;

    function takeaBreak(data) {
        data = JSON.parse(unescape(data));
        StaffID = data.StaffID;
        StaffAttendanceID = data.StaffAttendanceID;
        $("#modal-lg").modal('show');
    }

    //update the break for that staff in that particular day
    function EndBreak(data) {
        data = JSON.parse(unescape(data));
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "StaffBreakInOut";
        let json = {};
        json.StaffAttendanceID = data.StaffAttendanceID;
        json.StaffID = data.StaffID;
        json.BreakInOut = data.BreakInOut;
        obj.JSON = json;
        console.log(obj);
        TransportCall(obj);
    }
    $('#checkout-modal').on('show.bs.modal', function() {
        $(this).find('.modal-dialog').addClass('slide-in');
    });

    $('#checkout-modal').on('hidden.bs.modal', function() {
        // Reset the modal animation class when the modal is hidden
        $(this).find('.modal-dialog').removeClass('slide-in');
    });
</script>