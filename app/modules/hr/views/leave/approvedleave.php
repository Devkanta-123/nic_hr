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
</style>


<a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Open first modal</a>
<div class="content-wrapper" style="min-height: 1302.12px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Leave</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">HR</a></li>
                        <li class="breadcrumb-item active">All Approved Leave</li>
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
                            <h3 class="card-title">All Approved Leave</h3>
                            <div class="card-tools">
                                <!-- <div class="float-right">
                                    <button class="btn-custom" data-toggle="modal" data-target="#addLeave-modal">New Request</button>
                                </div> -->
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
                                        <table id="ApprovedLeave" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                                            <thead>
                                                <tr>
                                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Staff Name</th>
                                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Description</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">From Date</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">To Date</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Leave Type</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">No of Days</th>
                                                    <!-- <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Status</th> -->
                                                    <!-- <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th> -->
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
        getAllApprovedLeave();
    });


    function getAllHRLeaveTypes() {
        debugger;
        let obj = {};
        obj.Module = "HR";
        obj.Page_key = "getAllHRLeaveTypes";
        obj.JSON = {};
        SilentTransportCall(obj);
    }

    function getStaff() {
        debugger;
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getStaff";
        obj.JSON = {};
        SilentTransportCall(obj);
    }

    function getAllApprovedLeave() {
        debugger;
        let obj = {};
        obj.Module = "HR";
        obj.Page_key = "getAllApprovedLeave";
        obj.JSON = {};
        SilentTransportCall(obj);
    }



    function onSuccess(rc) {
        if (rc.return_code) {
            switch (rc.Page_key) {
                case "leaverequest":
                    notify("success", rc.return_data);
                    $("#addLeave-modal").modal("hide");
                    getAllApprovedLeave();
                    break;

                case "getAllHRLeaveTypes":
                    loadSelect("#leavetypes", rc.return_data);
                    break;

                    case "getAllApprovedLeave":
                    loaddata(rc.return_data);
                    break;
                    
                    case "getStaff":
                case "getStaff":
                    loadSelect("#getStaffs", rc.return_data);
                    break;

            

                case "leaveApproval":
                    getAllApprovedLeave();
                    notify("success", rc.return_data);
                  
                    break;

                

                default:
                    notify('warning', rc.Page_key);
            }
        } else {
            toastr.error(rc.return_data);
        }
    }


    function loaddata(data) {
        var table = $("#ApprovedLeave");
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
                // text += '<td> ' + (data[i].isApproved == null ? "<span class=' badge badge-warning'>Request</span>" : "<span class=' badge badge-info'>Request</span>") + ' <br>'
                // text += '<td><span class="badge badge-extra" title="Approve Leave" onClick="ApprovedLeave(\'' + escape(JSON.stringify(data[i])) + '\')">Approved</span></td>';
                text += '</td>';
                // if (data[i].LeaveDocumentIDs != null || data[i].LeaveDocumentIDs != "") {
                //     if (data[i].DocumentPath != null) {
                //         leaverequestPath = data[i].DocumentPath.split(',');
                //         for (k = 0; k < leaverequestPath.length; k++) {
                //             if (leaverequestPath[k])
                //                 text += ' <br><a href=file?type=document&name=' + leaverequestPath[k] + ' target="_blank" title="VIEW DOCUMENT" class="link-black text-sm mr-4"><i class="fas fa-paperclip mr-1"></i>View Document</a>';
                //         }
                //     }

                // }

                // text += '</td>';
                // text += '<td class="btn-group btn-group-sm">';
                // text += ' <a class="btn btn-info btn-sm text-white" onclick="onApproved(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fa fa-check" aria-hidden="true"></i> </a>';
                // text += ' <a class="btn btn-danger btn-sm text-white" onclick="onDecline(' + data[i].LeaveID + ')"> <i class="fa fa-times" aria-hidden="true"></i> </a>';
                // text += '</td>';
                text += '</tr >';
            }
        }
        $("#ApprovedLeave tbody").html("");
        $("#ApprovedLeave tbody").append(text);

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