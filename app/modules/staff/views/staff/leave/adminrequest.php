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
        padding :5px 5px;
        /* Adjust padding as needed */
        cursor: pointer;
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

    #selectOptions {
        margin-left: 250px;
        /* Add some margin to separate the checkbox and the dropdown */
        margin-top: -30px;
    }

    #halfDayOptions {
        border: none;
        /* Remove the border */
        border-radius: 5px;
        /* Rounded corners */
        box-shadow: 0 2px 5px;
        /* Box shadow */
        padding: 5px;
        /* Add padding to give space around options */
        padding: 3px;
        /* Add padding to give space around options */
    }

    /* Style for individual options */
    #halfDayOptions option[value="0"] {
        background-color: lightblue;
        /* Set background color for PreLunch option */
        /* Set background color for PreLunch option */
    }

    #halfDayOptions option[value="1"] {
        background-color: lightgreen;
        /* Set background color for PostLunch option */
        /* Set background color for PostLunch option */
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
                                <strong>Leave request</strong>
                            </div>
                            <div class="float-right">
                                <button class="btn btn-primary btn-xs   " data-toggle="modal" data-target="#modalAddLeaveRequest">Request Leave </button>
                            </div>

                            <!-- modal Request Leave -->
                            <div class="modal fade" id="modalAddLeaveRequest">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title d-flex justify-content-center">Request Leave</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form id="frmLeaveRequest">
                                            <div class="modal-body">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-4 col-md-4 col-lg-4">
                                                            <div class="form-group">
                                                                <label class="required" for="department">Department<span class="text-danger">*</span></label>
                                                                <select name="department" id="department" class="form-control"></select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 col-md-4 col-lg-4">
                                                            <div class="form-group">
                                                                <label class="required" for="leavetype">Leave Type<span class="text-danger">*</span></label>
                                                                <select name="leavetype" id="leavetype" class="form-control"></select>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4 col-md-4 col-lg-4">
                                                            <div class="form-group">
                                                                <label class="required" for="staffID">Staff Name<span class="text-danger">*</span></label>
                                                                <select name="staffID" id="staffID" class="form-control"></select>
                                                            </div>
                                                        </div>
                                                        <div class="row">

                                                            <div class="col-sm-4 col-md-4 col-lg-4">
                                                                <div class="form-group">
                                                                    <label class="required" for="fromDate">From Date<span class="text-danger">*</span></label>
                                                                    <input type="text" id="fromDate" class="form-control" autocomplete="off" required>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4 col-md-4 col-lg-4">
                                                                <div class="form-group">
                                                                    <label class="required" for="toDate">To Date<span class="text-danger">*</span></label>
                                                                    <input type="text" id="toDate" class="form-control" autocomplete="off" required>
                                                                    <!-- <select name="toDate" id="toDate" class="form-control"></select> -->
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4 col-md-4 col-lg-4">
                                                                <label>isUrgent</label>
                                                                <input class="bootstrapToggle" type="checkbox" id="isUrgent" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="light" data-width="100%">

                                                            </div>

                                                            <div class="col-md-5">
                                                                <label>isHalfDay</label> &nbsp;
                                                                <input class="bootstrapToggle" type="checkbox" id="isHalfDayLeave" data-toggle="toggle" data-on="Y" data-off="N" data-onstyle="success" data-offstyle="light" data-width="30%" data-height="10%">
                                                                <div id="selectOptions" style="display: none;">
                                                                    <select id="halfDayOptions">
                                                                        <option value="0">PreLunch</option>
                                                                        <option value="1">PostLunch</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <div class="form-group">
                                                                <label class="required" for="remarks">Remarks <span class="text-danger">*</span></label>
                                                                <input id="remarks" name="remarks" class="form-control" type="text" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-12 col-lg-12 pr-4">
                                                            <div class="row">
                                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                                    <div class="form-group">
                                                                        <label>Add File(s)</label>
                                                                        <input class="form-control bootstrapToggle" id="add_files" type="checkbox" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="light" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row" id="div_files" style="display:none;">
                                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                                    <div class="row">
                                                                        <div class="col-sm-12" style="text-align:right">
                                                                            <a class="text-warning" onclick="deleteRowFilesLeaveRequest()" title="Delete Selected File(s)" style="font-size:25px; cursor:pointer"><i class="fas fa-minus-hexagon"></i></a>
                                                                            <a class="text-teal" onclick="addRowFilesLeaveRequest()" title="Add New File" style="font-size:25px; cursor:pointer"><i class="fas fa-plus-hexagon"></i></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row" style="height:auto; overflow:auto">
                                                                        <table id="tblFilesLeaveRequest" class="table table-hover" style="width:100%; text-align:left;">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th style="vertical-align:middle; width:10%; text-align:center;"></th>
                                                                                    <th style="vertical-align:middle; width:40%;">Title<b style="color:red;">*</b></th>
                                                                                    <th style="vertical-align:middle; width:50%; text-align:center;">File<b style="color:red;">*</b></th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="vertical-align:middle; width:10%; text-align:center;"><input type="checkbox" /></td>
                                                                                    <td style="vertical-align:middle; width:40%;"><input type="text" id="file_titleq1" class="form-control file_title" placeholder="Eg. LEAVE REPORT" maxlength="99" autocomplete="off" /></td>
                                                                                    <td style="vertical-align:middle; width:50%; text-align:center;"><input type="file" id="fileq1" accept="image/*,.pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx" class="dropify file" data-height="100" /></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br />
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- modal approved -->
                            <div class="modal fade" id="mdlAdd">
                                <div class="modal-dialog modal-xs"> <!-- Changed modal size to small -->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title d-flex justify-content-center">Approved Leave</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form id="frmAdd">
                                            <div class="modal-body">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                                            <div class="form-group">
                                                                <label class="required" for="sdate">From Date</label>
                                                                <input type="text" id="sdate" class="form-control" autocomplete="off" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                                            <div class="form-group">
                                                                <label class="required" for="edate">To Date</label>
                                                                <input type="text" id="edate" class="form-control" autocomplete="off" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <div class="form-group">
                                                                <label class="required" for="title">Remarks <span class="text-danger">*</span></label>
                                                                <input id="title" name="title" class="form-control" type="text" maxlength="999" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-12 col-lg-12 pr-4">
                                                            <div class="row">
                                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                                    <div class="form-group">
                                                                        <label>Add File(s)</label>
                                                                        <input class="form-control bootstrapToggle" id="add_files" type="checkbox" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="light" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- File section remains unchanged for small modal -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="submit" class="badge badge-warning">Approved</button>
                                            </div>
                                        </form>
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

                            <div style="overflow:auto; width:100%">
                                <table id="tblData" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sl#</th>
                                            <th scope="col">Requested By</th>
                                            <th scope="col">Requested Date</th>
                                            <th scope="col">Requested Remarks</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Supervisor 1 Name </th>
                                            <th scope="col">Supervisor 2 Name </th>
                                            <!-- <th scope="col">Requested Remarks</th>
                                            <th scope="col"></th> -->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.1/moment.min.js"></script>

<script>
    var notice_details, notice_id, title, sdate, edate, type;
    var add_files = 0;

    var StaffID, LeaveID, DepartmentID, LeaveTypeID, NoOfDaysByLeaveTypeID; //edate1,sdate1 removedata

    $("#sdate, #fromDate, #edate, #toDate").datepicker({
        minDate: "-0D",
        maxDate: "+1Y",
        changeMonth: true,
        changeYear: true
    });

    $('.dropify').dropify();
    $('.bootstrapToggle').bootstrapToggle();

    $(function() {
        getallPendingLeaveRequest();
        getDepartment();
    });

    function getDepartment() {
        let obj = {};
        obj.Module = "Settings";
        obj.Page_key = "getAllDepartment";
        obj.JSON = {};
        SilentTransportCall(obj);
    }

    $("#department").change(function() {
        getStaffDeptWise($("#department").val());
        var obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getLeaveTypeByDepartmentID";
        var json = {};
        json.DepartmentID = $("#department").val();
        obj.JSON = json;
        SilentTransportCall(obj);
    });


    $('#isUrgent').on('change', function() {
        $('#isUrgent').prop('checked') ? '1' : '0';
    });


    $('#leavetype').on('change', function() {
        var selectedLeaveTypesID = $(this).val();
        getNoofDaysByLeaveTypeID(selectedLeaveTypesID);
    });


    function getStaffDeptWise(data) {
        var obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getStaffByDepartment";
        var json = {};
        json.DepartmentID = data;
        obj.JSON = json;
        SilentTransportCall(obj);
    }

    function getallPendingLeaveRequest() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getallPendingLeaveRequest";
        obj.JSON = {};
        SilentTransportCall(obj);
    }

    function getNoofDaysByLeaveTypeID(selectedLeaveTypesID) {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getNoofDaysByLeaveTypeID";
        var json = {};
        json.LeaveTypeID = selectedLeaveTypesID;
        obj.JSON = json;
        SilentTransportCall(obj);
    }


    $("#sdate").on('change', function() {
        $('#edate').datepicker('option', 'minDate', new Date($("#sdate").val()));
    });
    $("#fromDate").on('change', function() {
        $('#toDate').datepicker('option', 'minDate', new Date($("#fromDate").val()));
    });

    $('#add_files').on('change', function() {
        if ($('#add_files').prop('checked')) {
            add_files = 1;
            $('.file_title').val('');
            $('.dropify-clear').click();
            $('#div_files').show();
        } else {
            add_files = 0;
            $('#div_files').hide();
        }
    });

    $('#frmAdd').submit(function() {
        saveAddFormData();
        return false;
    });

    $("#frmLeaveRequest").submit(function() {
        requestLeave();
        return false;
    });

    async function requestLeave() {
        let obj = {};
        let json = {};
        var fileData = {};
        var totalFileSize = 0;
        for (var j = 1; j <= $('#tblFilesLeaveRequest tbody tr').length; j++) {
            var files = $('#fileq' + j)[0].files;
            var file_title = $('#file_titleq' + j).val();

            for (var i = 0; i < files.length; i++) {
                const fsize = files[i].size;
                const file = Math.round((fsize / 1024));
                totalFileSize += file;
                if (file > (1024 * 20)) {
                    toastr.error("Attached Document at Row-" + j + " is more than 20 MB !!");
                    return false;
                }
                await getBase64(files[i]).then(
                    data => fileData[j] = {
                        filedata: data,
                        filename: files[i]['name'],
                        file_title: file_title
                    });
            }
        }

        obj.Module = "Staff";
        obj.Page_key = "requestLeave";
        json.LeaveTypeID = $("#leavetype").val();
        json.StaffID = $("#staffID").val();
        json.isUrgent = $("#isUrgent").prop('checked') ? 1 : 0; //bit
        json.File = fileData;
        debugger;
        json.LeaveRemarks = $("#remarks").val();
        var FromDate = $("#fromDate").val();
        var ToDate = $("#toDate").val();
        var from, to, druation;
        from = moment(FromDate, 'MM-DD-YYYY');
        to = moment(ToDate, 'MM-DD-YYYY');
        duration = to.diff(from, 'days') + 1;
        json.isHalfDay = $("#isHalfDayLeave").prop('checked') ? 1 : 0; //bit
        json.isPostLunch = $("#halfDayOptions").val();
        json.NumberOfDays = duration;
        json.FromDate = FromDate;
        json.ToDate = ToDate;
        obj.JSON = json;
        if (duration > NumberOfDaysByLeaveTypeID) {
            notify("error", "Requested days must be less than equal to " + NumberOfDaysByLeaveTypeID + " Days");
        } else {
            TransportCall(obj);
        }
    }


    // $('#mdlAdd').on('hidden.bs.modal', async function() {
    //     $("input").val("");
    //     $('.select2').val(null).trigger('change');
    //     $('.dropify-clear').click();
    // });


    //show description when click on  a link
    // $('#tblData').on('click', 'a', function() {
    //     $("#detail").show();
    // });

    // $('#tblData').on('click', '#detail', function() {
    //     $("#detail").hide();
    // });


    // for leave request
    function addRowFilesLeaveRequest() {
        if ($('#tblFilesLeaveRequest tbody tr').length < 5) {
            $("#tblFilesLeaveRequest").append($('#tblFilesLeaveRequest tbody tr:last').clone());
            $('#tblFilesLeaveRequest tbody tr:last').each(function(row, tr) {
                $(tr).find('td').eq(1).prop('innerHTML', '');
                $(tr).find('td').eq(1).append('<input type="text" id="file_title' + $('#tblFiles tbody tr').length + '" class="form-control file_title" placeholder="Eg. ACADEMIC CALENDAR" maxlength="99" autocomplete="off"/>');
                $(tr).find('td').eq(2).prop('innerHTML', '');
                $(tr).find('td').eq(2).append('<input type="file" id="file' + $('#tblFiles tbody tr').length + '" accept="image/*,.pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx" class="dropify file" data-height="100"/>');
                $('.dropify').dropify();
            });
        } else {
            toastr.info('Only 5 Files can be attached !!');
        }
    }

    function deleteRowFilesLeaveRequest() {
        try {
            var table = document.getElementById('tblFilesLeaveRequest');
            var rowCount = table.rows.length;
            for (var i = 0; i < rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if (null != chkbox && true == chkbox.checked) {
                    if (rowCount <= 2) {
                        break;
                    }
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }
            }
        } catch (e) {
            notify('warning', e);
        }
    }



    var selectOptions = document.getElementById('selectOptions');

    $('#isHalfDayLeave').on('change', function() {
        if (this.checked) {
            // Show the container for select options
            selectOptions.style.display = 'block';
        } else {
            // Hide the container for select options
            selectOptions.style.display = 'none';
        }
        $('#isHalfDayLeave').prop('checked') ? '1' : '0';
    });


    //for leave approved
    function addRowFiles() {
        if ($('#tblFiles tbody tr').length < 5) {
            $("#tblFiles").append($('#tblFiles tbody tr:last').clone());
            $('#tblFiles tbody tr:last').each(function(row, tr) {
                $(tr).find('td').eq(1).prop('innerHTML', '');
                $(tr).find('td').eq(1).append('<input type="text" id="file_title' + $('#tblFiles tbody tr').length + '" class="form-control file_title" placeholder="Eg. ACADEMIC CALENDAR" maxlength="99" autocomplete="off"/>');
                $(tr).find('td').eq(2).prop('innerHTML', '');
                $(tr).find('td').eq(2).append('<input type="file" id="file' + $('#tblFiles tbody tr').length + '" accept="image/*,.pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx" class="dropify file" data-height="100"/>');
                $('.dropify').dropify();
            });
        } else {
            toastr.info('Only 5 Files can be attached !!');
        }
    }
    //leave approved
    function deleteRowFiles() {
        try {
            var table = document.getElementById('tblFiles');
            var rowCount = table.rows.length;
            for (var i = 0; i < rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if (null != chkbox && true == chkbox.checked) {
                    if (rowCount <= 2) {
                        break;
                    }
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }
            }
        } catch (e) {
            notify('warning', e);
        }
    }

    //add notice
    async function saveAddFormData() {
        let obj = {};
        let json = {};
        var fileData = {};
        var totalFileSize = 0;
        for (var j = 1; j <= $('#tblFiles tbody tr').length; j++) {
            var files = $('#file' + j)[0].files;
            var file_title = $('#file_title' + j).val();

            for (var i = 0; i < files.length; i++) {
                const fsize = files[i].size;
                const file = Math.round((fsize / 1024));
                totalFileSize += file;
                if (file > (1024 * 20)) {
                    toastr.error("Attached Document at Row-" + j + " is more than 20 MB !!");
                    return false;
                }
                await getBase64(files[i]).then(
                    data => fileData[j] = {
                        filedata: data,
                        filename: files[i]['name'],
                        file_title: file_title
                    });
            }
        }



        obj.Module = "Staff";
        obj.Page_key = "onLeaveApproved";
        json.Remarks = $("#title").val();
        json.FromDate = $("#sdate").val();
        json.ToDate = $("#edate").val();
        json.LeaveID = LeaveID;
        json.StaffID = StaffID;
        json.DepartmentID = DepartmentID;
        json.File = fileData;
        json.LeaveTypeID = LeaveTypeID;
        json.NoOfDaysByLeaveTypeID = NoOfDaysByLeaveTypeID;
        obj.JSON = json;
        console.log(JSON.stringify(obj));
        SilentTransportCall(obj);
    }

    function getBase64(file) {
        return new Promise(function(resolve) {
            var reader = new FileReader();
            reader.onloadend = function() {
                resolve(reader.result)
            }
            reader.readAsDataURL(file);
        });
    }


    function onSuccess(rc) {
        if (rc.return_code) {
            switch (rc.Page_key) {
                case "requestLeave":
                    notify("success", rc.return_data);
                    getallPendingLeaveRequest();
                    $("#modalAddLeaveRequest").hide();
                    break;
                case "getStaffByDepartment":
                    loadSelect("#staffID", rc.return_data);
                    break;
                case "getAllDepartment":
                    loadSelect("#department", rc.return_data);
                    break;
                case "getLeaveTypeByDepartmentID":
                    loadSelect("#leavetype", rc.return_data);
                    break;
                case "getallPendingLeaveRequest":
                    console.log(rc.return_data);
                    loaddata(rc.return_data);
                    break;
                case "declineleaveRequest":
                    notify('success', rc.return_data);
                    $("#mdDecline").modal('hide');
                    getallPendingLeaveRequest();
                    break;
                case "onLeaveApproved":
                    notify('success', rc.return_data);
                    $("#mdlAdd").modal('hide');
                    getallPendingLeaveRequest();
                    break;

                case "getNoofDaysByLeaveTypeID":
                    loadNoOfDaysByLeaveTypeID(rc.return_data);
                    break;

                default:
                    notify('warning', rc.Page_key);
            }
        } else {
            toastr.error(rc.return_data);
        }
    }
    //Extract No of Days From Staff_leaveTypes Table according to the LeaveTypeID
    var NumberOfDaysByLeaveTypeID;

    function loadNoOfDaysByLeaveTypeID(data) {
        NumberOfDaysByLeaveTypeID = data;
    }

    function loaddata(data) {
        var table = $("#tblData");
        debugger;
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
                text += '<td> ' + data[i].StaffName + ' <br></td>';
                if (data[i].isHalfday == 1) {
                    text += '<td> Requested On : ' + data[i].RequestedDateFrom + '<br><span class="badge badge-success">Half Day</span></td>';
                } else {
                    text += '<td> From : <b>' + data[i].RequestedDateFrom + ' </b> To : <b>' + data[i].RequestedDateTo + '</b></td>';

                }
                text += '<td> ' + (data[i].isUrgent == 1 ? "<span class=' badge badge-danger'>Urgent</span>" : "<span class=' badge badge-info'>Not Urgent</span>") + ' <br>' + data[i].LeaveRemarks;
                // text += '<td> ' + (data[i].isApproved == 1 ? "<span class=' badge badge-danger'>Under Process</span>" : "<span class=' badge badge-info'>Not Urgent</span>") + ' <br>' + data[i].LeaveRemarks;
                text += '<td>';
                if (data[i].isApproved == null) {
                    text += '<span class="badge badge-warning">Pending</span>';
                } else if (data[i].isApproved == 1) {
                    text += '<span class="badge badge-info">Under Process</span>';
                } else if (data[i].isApproved == 2) {
                    text += '<span class="badge badge-success">Final Approved</span>';
                } else if (data[i].isApproved == 0) {
                    text += '<span class="badge badge-danger">Rejected</span>';
                }
                text += '</td>';


                // text += '<td>';
                if (data[i].LeaveDocumentIDs != null || data[i].LeaveDocumentIDs != "") {
                    if (data[i].DocumentPath != null) {
                        leaverequestPath = data[i].DocumentPath.split(',');
                        for (k = 0; k < leaverequestPath.length; k++) {
                            if (leaverequestPath[k])
                                text += ' <br><a href=file?type=document&name=' + leaverequestPath[k] + ' target="_blank" title="VIEW DOCUMENT" class="link-black text-sm mr-4"><i class="fas fa-paperclip mr-1"></i>View Document</a>';
                        }
                    }

                }
                if (data[i].Supervisor1Remarks === null) {
                    text += '<td>' + (data[i].Supervisor1Name ? data[i].Supervisor1Name : 'N/A') + '<br> Remarks : N/A</td>';
                } else {
                    text += '<td>' + data[i].Supervisor1Name + '<br> Remarks : ' + data[i].Supervisor1Remarks + '</td>';
                }

                if (data[i].Supervisor2Remarks === null) {
                    text += '<td>' + (data[i].Supervisor2Name ? data[i].Supervisor2Name : 'N/A') + '<br> Remarks : N/A</td>';
                } else {
                    text += '<td>' + data[i].Supervisor2Name + '<br> Remarks : ' + data[i].Supervisor2Remarks + '</td>';
                }



                // text += '</td>';
                // text += '<td class="btn-group btn-group-sm">';
                // text += ' <a class="btn btn-info btn-sm text-white" onclick="onApproved(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fa fa-check" aria-hidden="true"></i> </a>';
                // text += ' <a class="btn btn-danger btn-sm text-white" onclick="onDecline(' + data[i].LeaveID + ')"> <i class="fa fa-times" aria-hidden="true"></i> </a>';
                // text += '</td>';
                text += '</tr >';
            }
        }
        $("#tblData tbody").html("");
        $("#tblData tbody").append(text);

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
        LeaveTypeID = data.LeaveTypeID;
        DepartmentID = data.DepartmentID;
        NoOfDaysByLeaveTypeID = data.NoOfDaysByLeaveTypeID;
        $("#mdlAdd").modal('show');
    }

    function onDecline(data) {
        LeaveID = data;
        $("#mdDecline").modal('show');
    }

    $("#Declinerequest").click(function() {
        var obj = {};
        obj.Module = "Staff";
        obj.Page_key = "declineleaveRequest";
        var json = {};
        json.Remarks = $("#declineRemarks").val();
        json.LeaveID = LeaveID;
        obj.JSON = json;
        SilentTransportCall(obj);
    });
</script>