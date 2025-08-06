<style>
    .btn-custom {
        /* Add rounded corners */
        border-radius: 30px;

        /* Add shadow */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);

        /* Set background color to white */
        background-color: #2D9596;

        border: none;
        color: #3498db;
        /* Change text color to a contrasting color */
        padding: 6px 12px;
        /* Adjust padding for a smaller button */
        color: white;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        /* Adjust font size for a smaller button */
        cursor: pointer;
    }


    .form-group {
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
    }

    .rounded-input {
        /* Add rounded corners to the input */
        border-radius: 30px;
        width: 100%;
        /* Make the input take the full width */
    }

    .input-group-prepend i {
        /* Adjust icon style */
        padding: 10px;
        background-color: #3498db;
        /* Set icon background color */
        color: white;
        /* Set icon color */
        border-radius: 10px 0 0 10px;
        /* Add rounded corners to the left side of the icon */
    }

    .form-label {
        /* Style for the label at the top */
        font-size: 14px;
        margin-bottom: 5px;
        color: #3498db;
    }

    .badge-success {
        background-color: #28a745;
        /* Change to your desired background color */
        color: #fff;
        /* Change to your desired text color */
        border-radius: 10px;
        /* Adjust the border-radius for rounding */
        padding: 5px 10px;
        /* Adjust padding as needed */
    }

    .badge-extra {
        background-color: #9195F6;
        /* Change to your desired background color */
        color: #fff;
        /* Change to your desired text color */
        border-radius: 10px;
        /* Adjust the border-radius for rounding */
        padding: 5px 10px;
        cursor: pointer;
        /* Adjust padding as needed */
    }

    .badge-danger {
        background-color: #FF407D;
        /* Change to your desired background color */
        color: #fff;
        /* Change to your desired text color */
        border-radius: 10px;
        /* Adjust the border-radius for rounding */
        padding: 5px 10px;
        cursor: pointer;
        /* Adjust padding as needed */
    }

    .rejectedReasonInput {
        border-radius: 15px;
        /* Adjust the value as needed */
        padding: 5px;
        /* Optional: Add padding for better appearance */
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        /* Adjust values for shadow appearance */

    }
</style>

<div class="modal fade" id="addLeave-modal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLeave-modal">Add New Leave Request</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="DOB">From Date<span class="text-danger">*</span></label>
                            <input type="date" class="form-control rounded-input" id="fromdate">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="DOB">To Date<span class="text-danger">*</span></label>
                            <input type="date" class="form-control rounded-input" id="todate">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="DOB">Leave Type<span class="text-danger">*</span></label>
                            <select id="leavetypes" class="form-control rounded-input">
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Staffs">Staffs<span class="text-danger">*</span></label>
                            <select id="getStaffs" class="form-control rounded-input">
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="decriptions">Leave Descriptions<span class="text-danger">*</span></label>
                            <textarea name="" id="description" class="form-control" autocomplete="off"></textarea>
                        </div>
                    </div>

                </div>

                <!-- <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" class="form-control " id="inputEmail4">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Password</label>
                    <input type="password" class="form-control" id="inputPassword4">
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Address</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </div>
                <div class="col-12">
                    <label for="inputAddress2" class="form-label">Address 2</label>
                    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">City</label>
                    <input type="text" class="form-control" id="inputCity">
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">State</label>
                    <select id="inputState" class="form-select">
                        <option selected>Choose...</option>
                        <option>...</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="inputZip" class="form-label">Zip</label>
                    <input type="text" class="form-control" id="inputZip">
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            Check me out
                        </label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </div> -->

            </div>
            <div class="modal-footer">
                <button class="btn-custom" id="btn-addLeaveRequest">create</button>
            </div>
        </div>
    </div>
</div>





<div class="modal fade" id="approvedLeave-modal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLeave-modal">Approved Leave Request</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="DOB">From Date<span class="text-danger">*</span></label>
                            <input type="date" class="form-control rounded-input" id="approvedfromdate">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="DOB">To Date<span class="text-danger">*</span></label>
                            <input type="date" class="form-control rounded-input" id="approvedtodate">
                        </div>
                    </div>

                </div>


            </div>
            <div class="modal-footer">
                <button class="btn-custom" id="btn-approvedLeaveRequest">Approved</button>
            </div>
        </div>
    </div>
</div>

<a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Open first modal</a>
<div class="content-wrapper" style="min-height: 1302.12px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Leave</h1>
                    <!-- <input type="text" id="rejectedReason" style="display: none;"> -->

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">HR</a></li>
                        <li class="breadcrumb-item active">Leave</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Leave Request</h3>
                            <div class="card-tools">
                                <div class="float-right">
                                    <button class="btn-custom" data-toggle="modal" data-target="#addLeave-modal">New Request</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6"></div>
                                    <div class="col-sm-12 col-md-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="leaverequest" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                                            <thead>
                                                <tr>
                                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">StaffName</th>
                                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Description</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">From Date</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">To Date</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Leave Type</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">No of Days</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Status</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>



                </div>

            </div>

        </div>

    </section>

</div>
<script>
    $(function() {
        getAllHRLeaveTypes();
        getStaff();
        getAllLeaveRequest();
    });

    //btn-addLeaveRequest



    function getAllHRLeaveTypes() {

        let obj = {};
        obj.Module = "HR";
        obj.Page_key = "getAllHRLeaveTypes";
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

    function getAllLeaveRequest() {
        let obj = {};
        obj.Module = "HR";
        obj.Page_key = "getAllLeaveRequest";
        obj.JSON = {};
        SilentTransportCall(obj);
    }

    // $("#leavetypes").on("change", function() {
    //     var selectedLeaveTypeID = $(this).val();
    //     var noOfDays = findNoOfDaysByLeaveTypeID(selectedLeaveTypeID);


    // });






    function onSuccess(rc) {
        if (rc.return_code) {
            switch (rc.Page_key) {
                case "leaverequest":
                    notify("success", rc.return_data);
                    $("#addLeave-modal").modal("hide");
                    getAllLeaveRequest();
                    break;

                case "getAllHRLeaveTypes":
                    loadSelect("#leavetypes", rc.return_data);
                    findNoOfDaysByLeaveTypeID(rc.return_data);
                    break;

                case "getAllLeaveRequest":
                    loaddata(rc.return_data);
                    break;


                case "getStaff":
                    loadSelect("#getStaffs", rc.return_data);
                    break;


                case "leaveApproval":
                    notify("success", rc.return_data);
                    location.reload();
                    break;

                case "leaveReject":
                    notify("success", rc.return_data);
                    getAllLeaveRequest();
                    break;



                default:
                    notify('warning', rc.Page_key);
            }
        } else {
            toastr.error(rc.return_data);
        }
    }

    var noOfDaysByLeaveTypeID;

    function findNoOfDaysByLeaveTypeID(data) {
        $('#leavetypes').change(function() {
            var selectedLeaveTypeID = $(this).val(); // Get the selected value from dropdown
            var selectedLeaveTypeData = data.find(function(leaveType) {
                return leaveType.LeaveTypeID === selectedLeaveTypeID;
            });
            if (selectedLeaveTypeData) {
                noOfDaysByLeaveTypeID = parseInt(selectedLeaveTypeData.NoOfDays);
            } else {
                console.log("LeaveTypeID " + selectedLeaveTypeID + " not found.");
            }
        });

    }

    $("#btn-addLeaveRequest").click(function() {
        var obj = {};
        obj.Module = "HR";
        obj.Page_key = "leaverequest";
        var json = {};
        json.FromDate = $("#fromdate").val();
        json.ToDate = $("#todate").val();
        json.LeaveTypeID = $("#leavetypes").val();
        json.StaffID = $("#getStaffs").val();
        json.Description = $("#description").val();
        obj.JSON = json;
        SilentTransportCall(obj);
    });





    function loaddata(data) {
        var table = $("#leaverequest");
        try {
            if ($.fn.DataTable.isDataTable($(table))) {
                $(table).DataTable().destroy();
            }
        } catch (ex) {}
        var text = "";
        if (data.length == 0) {
            text += "No Data Found";
        } else {
            for (let i = 0; i < data.length; i++) {
                text += '<tr> ';
                //text += '<td> ' + (i + 1) + '</td>';
                text += '<td> ' + data[i].StaffName + '</td>';
                text += '<td> ' + data[i].Description + '</td>';
                text += '<td> ' + data[i].FromDate + '</td>';
                text += '<td> ' + data[i].ToDate + '</td>';
                text += '<td><span class="badge badge-success">' + data[i].LeaveType + '</span></td>';
                text += '<td> ' + data[i].NoOfDays + '</td>';
                text += '<td> ' + (data[i].isApproved == null ? "<span class=' badge badge-warning'>Request</span>" : "<span class=' badge badge-info'>Request</span>") + ' <br>'
                // text += '<td><span class="badge badge-extra" title="Approve Leave" onClick="ApprovedLeave(\'' + escape(JSON.stringify(data[i])) + '\')">Approved</span></td>';
                // text += '<td><span class="badge badge-danger" title="Reject Leave" onClick="RejectLeave(\'' + escape(JSON.stringify(data[i])) + '\')">Rejected</span></td>';
                text += '</td>';
                text += '<td>';
                text += '<span class="badge badge-extra" title="Approve Leave" onClick="ApprovedLeave(\'' + escape(JSON.stringify(data[i])) + '\')">Approved</span>&nbsp;';
                text += '<span class="badge badge-danger" title="Reject Leave" onClick="RejectLeave(\'' + escape(JSON.stringify(data[i])) + '\')">Rejected</span>&nbsp;&nbsp;';
                text += '<br>';
                text += '<br>';
                text += '<textarea type="text" class=" rejectedReasonInput" data-leaveid="' + data[i].LeaveID + '" id="rejectedReason_' + data[i].LeaveID + '" style="display: none;" placeholder="Rejected Reason...."></textarea>';
                text += '</td>';
                text += '</tr >';
            }
        }
        $("#leaverequest tbody").html("");
        $("#leaverequest tbody").append(text);

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

    function onApproved(data) {
        data = JSON.parse(unescape(data));
        $("#sdate").val(data.RequestedDateFrom);
        $("#edate").val(data.RequestedDateTo);
        StaffID = data.StaffID;
        LeaveID = data.LeaveID;
        DepartmentID = data.DepartmentID;
        $("#mdlAdd").modal('show');
    }
    var LeaveID;
    var LeaveTypeID;
    var FromDate;
    var ToDate;
    var NoOfDays;
    var NoOfDaysByLeaveType;

    function ApprovedLeave(data) {
        data = JSON.parse(unescape(data));
        LeaveID = data.LeaveID;
        LeaveTypeID = data.LeaveTypeID;
        NoOfDays = data.NoOfDays;
        NoOfDaysByLeaveType = data.NoOfDaysByLeaveType;
        $("#approvedfromdate").val(data.FromDate);
        $("#approvedtodate").val(data.ToDate);
        $("#approvedLeave-modal").modal('show');
    }

    $("#btn-approvedLeaveRequest").click(function() {
        debugger;
        var obj = {};
        obj.Module = "HR";
        obj.Page_key = "leaveApproval";
        var json = {};
        json.LeaveID = LeaveID;
        json.LeaveTypeID = LeaveTypeID;
        json.ApprovedFromDate = $("#approvedfromdate").val();
        json.ApprovedToDate = $("#approvedtodate").val();
        json.NoOfDaysByLeaveType = NoOfDaysByLeaveType;
        obj.JSON = json;
        SilentTransportCall(obj);
    });


    //leaveReject
    function RejectLeave(data) {
        data = JSON.parse(unescape(data));
        LeaveID = data.LeaveID;
        $('#rejectedReason_' + LeaveID).show();
    }

    // Attach the event handler to a static parent element (assuming your table has an ID of 'leaveTable')
    $('#leaverequest').on('change', '.rejectedReasonInput', function() {

        var obj = {};
        obj.Module = "HR";
        obj.Page_key = "leaveReject";
        var json = {};
        var LeaveID = $(this).data("leaveid");
        var rejectionReason = $(this).val();
        json.LeaveID = LeaveID;
        json.rejectionReason = rejectionReason;
        obj.JSON = json;
        SilentTransportCall(obj);
    });
</script>