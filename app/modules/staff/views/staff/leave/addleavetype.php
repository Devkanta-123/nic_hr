<!-- summernote -->
<link rel="stylesheet" href="assets/admin/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.css">
<link rel="stylesheet" href="assets/admin/plugins/bootstrap-toggle-master/css/bootstrap-toggle.min.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">


<style>
    .input-validation-error~.select2 {
        border: 1px solid red;
        border-radius: 5px;
    }

    .badge-warning {
        background-color: #007F73;
        /* Change to your desired background color */
        color: #fff;
        /* Change to your desired text color */
        border-radius: 20px;
        /* Adjust the border-radius for rounding */
        padding: 10px 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
        /* Add shadow */
        border: 2px solid #fff;
        /* Add white boundary */
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    #mdDecline .modal-dialog {
        animation: fadeIn 0.4s ease-int;
    }

    .fas.fa-pen {
        color: #58A399;
        /* Color of the icon */
        font-size: 10px;
        /* Adjust the size of the icon */
        border-radius: 50%;
        /* Rounded shape */
        background-color: #58A399;
        /* Background color behind the icon */
        padding: 5px;
        /* Adjust padding for spacing */
        cursor: pointer;
    }

    .fas.fa-pen::before {
        color: white;
        /* Color of the pen inside */
    }

    .custom-badge {
        padding: 5px 8px;
        line-height: 10px;
        border: 1px solid;
        font-weight: 300;
        font-size: 13px;
        border-radius: 10px;
    }

    .col-orange {
        color: #ff9800 !important;
    }
    .col-green{
        color: #4CCD99 !important;
    }
</style>

<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <strong>Leave Types</strong>
                            </div>
                            <div class="float-right">
                                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalAddLeaveTypes">Add New Leave Types</button>
                            </div>
                            <!-- modal Request Leave -->
                            <div class="modal fade" id="modalAddLeaveTypes">
                                <div class="modal-dialog modal-xs">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title d-flex justify-content-center">Leave Types</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                                        <div class="form-group">
                                                            <label class="required" for="leavetypename">Leave Type Name<span class="text-danger">*</span></label>
                                                            <input type="text" name="leavetypename" id="leavetypename" class="form-control" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                                        <div class="form-group">
                                                            <label class="required" for="noofdays">No of Days<span class="text-danger">*</span></label>
                                                            <input type="number" name="noofdays" id="noofdays" class="form-control" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button class="btn btn-success btn-xs" id="btn-addLeaveTypes">Submit</button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- modal approved -->
                            <div class="modal fade" id="Edit-Leave-Type">
                                <div class="modal-dialog modal-xs"> <!-- Changed modal size to small -->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title d-flex justify-content-center">Edit Leave Types</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                            <div class="modal-body">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                                            <div class="form-group">
                                                                <label class="required" for="LeaveTypeName">Leave Type Name</label>
                                                                <input type="text" id="LeaveTypeName" class="form-control" autocomplete="off" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                                            <div class="form-group">
                                                                <label class="required" for="editnoofdays">No of Days</label>
                                                                <input type="number" id="editnoofdays" class="form-control" autocomplete="off" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="submit" id="btn-edit-leavetype" class="badge badge-warning">Save Changes</button>
                                            </div>
                                    </div>
                                </div>
                            </div>

                            <!-- modal decline -->
                            <div class="modal fade" id="mdDecline">
                                <div class="modal-dialog modal-xs"> <!-- Changed modal size to small -->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title d-flex justify-content-center">Decline Leave</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <!-- <form id="frmdecline"> -->
                                        <div class="modal-body">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                                        <div class="form-group">
                                                            <label class="required" for="declineRemarks">Remarks <span class="text-danger">*</span></label>
                                                            <input id="declineRemarks" name="declineRemarks" class="form-control" type="text" maxlength="" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button id="Declinerequest" class="btn btn-success">Submit</button>
                                        </div>
                                        <!-- </form> -->
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card-body">

                            <!-- <div class="row" id="div_notices" style="display:none;">
                                <div class="col-6">
                                    <div class="info-box" style="background-color:#edfbfd;">
                                        <div class="info-box-content">
                                            <span class="info-box-number text-left text-muted mb-2">Independence Day Celeration in the School Campus</span>
                                            <p class="mb-2">
                                                <a href="#" class="link-black text-sm mr-4"><i class="fas fa-paperclip mr-1"></i>File 1</a>
                                                <a href="#" class="link-black text-sm mr-4"><i class="fas fa-paperclip mr-1"></i>File 2</a>
                                            </p>
                                            <p class="mb-0">
                                                <a href="#" class="link-black text-sm mr-4"><i class="fas fa-external-link mr-1"></i>Link</a>
                                            </p>
                                            <span class="info-box-text text-right text-muted text-sm"><i>Added By - Mr. Khanna</i></span>
                                            <span class="info-box-text text-right text-muted text-sm"><i>Added On - 05/08/2022</i></span>
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                            <!-- <div style="overflow:auto; width:100%">
                                <table id="tblData" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sl#</th>
                                            <th scope="col">Requested By</th>
                                            <th scope="col">Requested Date</th>
                                            <th scope="col">Requested Remarks</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div> -->
                            <div style="overflow:auto; width:100%">
                                <table id="leavetypetable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sl#</th>
                                            <th scope="col">Leave Type Name</th>
                                            <th scope="col">No of Days</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Actions</th>
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
    </section>
</div>

<!-- Summernote -->
<script src="assets/admin/plugins/summernote/summernote-bs4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.js"></script>
<script src="assets/admin/plugins/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="assets/js/commonfunctions.js"></script>
<script>
    $(function() {
        getAllLeaveTypes();
    });

    function getAllLeaveTypes() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getAllLeaveTypes";
        obj.JSON = {};
        SilentTransportCall(obj);
    }


    $("#btn-addLeaveTypes").click(function() {
        debugger;
        let obj = {};
        let json = {};
        obj.Module = "Staff";
        obj.Page_key = "addLeaveTypes";
        json.LeaveTypeName = $("#leavetypename").val();
        json.NoOfDays = $("#noofdays").val();
        obj.JSON = json;
        if ($("#leavetypename").val() == '' || $("#noofdays").val() == '') {
            notify("error", 'Fills all the required fields');
        } else {
            SilentTransportCall(obj);
        }

    });

    function onSuccess(rc) {
        if (rc.return_code) {
            switch (rc.Page_key) {
                case "addLeaveTypes":
                    notify("success", rc.return_data);
                    $("#modalAddLeaveTypes").modal("hide");
                    $("#Edit-Leave-Type").modal("hide");
                    getAllLeaveTypes();
                    break;
                case "getStaffByDepartment":
                    loadSelect("#staffID", rc.return_data);
                    break;
                case "getAllLeaveTypes":
                    loadAllLeaveTypes(rc.return_data);
                    break;
                case "getLeaveTypeByDepartmentID":
                    loadSelect("#leavetype", rc.return_data);
                    break;
                    // case "":
                    //     loaddata(rc.return_data);
                    //     break;
                case "declineleaveRequest":
                    notify('success', rc.return_data);
                    $("#mdDecline").modal('hide');
                    break;
                case "onLeaveApproved":
                    notify('success', rc.return_data);
                    $("#Edit-Leave-Type").modal('hide');
                    break;
                default:
                    notify('warning', rc.Page_key);
            }
        } else {
            toastr.error(rc.return_data);
        }
    }

    // function loaddata(data) {
    //     var table = $("#tblData");
    //     try {
    //         if ($.fn.DataTable.isDataTable($(table))) {
    //             $(table).DataTable().destroy();
    //         }
    //     } catch (ex) {}
    //     var text = "";
    //     if (data.length == 0) {
    //         text += "No Data Found";
    //     } else {
    //         for (let i = 0; i < data.length; i++) {
    //             text += '<tr> ';
    //             text += '<td> ' + (i + 1) + '</td>';
    //             text += '<td> ' + data[i].StaffName + ' <br> <span class="badge badge-info">' + data[i].CreatedDateTime + ' </span> </td>';
    //             text += '<td> From : <b>' + data[i].RequestedDateFrom + ' </b> To : <b>' + data[i].RequestedDateTo + '</b></td>';
    //             text += '<td> ' + (data[i].isUrgent == 1 ? "<span class=' badge badge-danger'>Urgent</span>" : "<span class=' badge badge-info'>Not Urgent</span>") + ' <br>' + data[i].LeaveRemarks;
    //             // text += '<td>';
    //             if (data[i].LeaveDocumentIDs != null || data[i].LeaveDocumentIDs != "") {
    //                 if (data[i].DocumentPath != null) {
    //                     leaverequestPath = data[i].DocumentPath.split(',');
    //                     for (k = 0; k < leaverequestPath.length; k++) {
    //                         if (leaverequestPath[k])
    //                             text += ' <br><a href=file?type=document&name=' + leaverequestPath[k] + ' target="_blank" title="VIEW DOCUMENT" class="link-black text-sm mr-4"><i class="fas fa-paperclip mr-1"></i>View Document</a>';
    //                     }
    //                 }

    //             }

    //             text += '</td>';
    //             text += '<td class="btn-group btn-group-sm">';
    //             text += ' <a class="btn btn-info btn-sm text-white" onclick="onEdit(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fa fa-check" aria-hidden="true"></i> </a>';
    //             text += ' <a class="btn btn-danger btn-sm text-white" onclick="onDecline(' + data[i].LeaveID + ')"> <i class="fa fa-times" aria-hidden="true"></i> </a>';
    //             text += '</td>';
    //             text += '</tr >';
    //         }
    //     }
    //     $("#tblData tbody").html("");
    //     $("#tblData tbody").append(text);

    //     $(table).DataTable({
    //         responsive: true,
    //         "order": [],
    //         dom: 'Bfrtip',
    //         "bInfo": true,
    //         exportOptions: {
    //             columns: ':not(.hidden-col)'
    //         },
    //         "deferRender": true,
    //         "pageLength": 10,
    //         buttons: [{
    //                 exportOptions: {
    //                     columns: ':not(.hidden-col)'
    //                 },
    //                 extend: 'excel',
    //                 orientation: 'landscape',
    //                 pageSize: 'A4'
    //             },
    //             {
    //                 exportOptions: {
    //                     columns: ':not(.hidden-col)'
    //                 },
    //                 extend: 'pdfHtml5',
    //                 orientation: 'landscape',
    //                 pageSize: 'A4'
    //             },
    //             {
    //                 exportOptions: {
    //                     columns: ':not(.hidden-col)'
    //                 },
    //                 extend: 'print',
    //                 orientation: 'landscape',
    //                 pageSize: 'A4'
    //             }
    //         ]
    //     });
    // }

    function loadAllLeaveTypes(data) {
        var table = $("#leavetypetable");
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
                text += '<td> ' + (i + 1) + '</td>';
                text += '<td> ' + data[i].LeaveType + '</td>';
                text += '<td> ' + data[i].NoOfDays + '</td>';
                if (data[i].isActive == 1) {
                    text += '<td><span class="custom-badge col-green">Active</span></td>';
                } else if (data[i].isActive == 0) {
                    text += '<td><span class="custom-badge col-orange" >Not Active</span></td>';

                }
                text += '<td class="btn-group btn-group-sm">';
                text += ' <a  onclick="onEdit(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fas fa-pen"></i></a>';
                // text += ' <a class="btn btn-danger btn-sm text-white" onclick="onDecline(' + data[i].LeaveID + ')"> <i class="fa fa-times" aria-hidden="true"></i> </a>';
                text += '</td>';
                text += '</tr >';
            }
        }

        $("#leavetypetable tbody").html("");
        $("#leavetypetable tbody").append(text);

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


    function onEdit(data) {
        debugger;
        data = JSON.parse(unescape(data));
        $("#LeaveTypeName").val(data.LeaveType);
        $("#editnoofdays").val(data.NoOfDays);
        LeaveTypeID = data.LeaveTypeID;
        $("#Edit-Leave-Type").modal('show');
    }

    $("#btn-edit-leavetype").click(function () {
        debugger;
        var obj = {};
        obj.Module = "Staff";
        obj.Page_key = "addLeaveTypes";
        var json = {};
        json.LeaveType = $("#LeaveTypeName").val();
        json.NoOfDays = $("#editnoofdays").val();
        json. LeaveTypeID =LeaveTypeID;
        obj.JSON = json;
        SilentTransportCall(obj);
    });

   
</script>