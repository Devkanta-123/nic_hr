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

    #container {
        display: flex;
        /* Use flexbox layout */
        align-items: center;
        /* Align items vertically in the center */
    }

    #selectOptions {
        margin-left: 160px;
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
</style>

<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <strong>Leave Approval Supervisor</strong>
                            </div>
                            <div class="float-right">
                                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#allLeaveRequest">View Your Leave</button>
                                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalAddLeaveRequest"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            </div>

                            <!-- modal Request Leave -->
                            <div class="modal fade" id="modalAddLeaveRequest">
                                <div class="modal-dialog modal-xs">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title d-flex justify-content-center">Staff Request Leave</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form id="frmLeaveRequest">
                                            <div class="modal-body">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="required" for="department">Department<span class="text-danger">*</span></label>
                                                                <select name="department" id="department" class="form-control"></select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="required" for="leavetype">Leave Type<span class="text-danger">*</span></label>
                                                                <select name="leavetype" id="leavetype" class="form-control"></select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="required" for="fromDate">From Date<span class="text-danger">*</span></label>
                                                                <input type="text" id="fromDate" class="form-control" autocomplete="off" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="required" for="toDate">To Date<span class="text-danger">*</span></label>
                                                                <input type="text" id="toDate" class="form-control" autocomplete="off" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-5">
                                                            <label>isUrgent</label> &nbsp;
                                                            <input class="bootstrapToggle" type="checkbox" id="isUrgent" data-toggle="toggle" data-on="Y" data-off="N" data-onstyle="success" data-offstyle="light" data-width="30%" data-height="10%" style="border-radius: 5px;">
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


                                                    <div id="dropdown-container" class="">
                                                    </div>


                                                    <div class="row">
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
                                                                        <label>Add File(s)</label> &nbsp;
                                                                        <input class="form-control bootstrapToggle" id="add_files" type="checkbox" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="light" data-width="10%" />
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
                            <!-- modal All Request Leave -->
                            <div class="modal fade" id="allLeaveRequest">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title d-flex justify-content-center">All Leave Request</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body">
                                                <div>
                                                    <table id="AllData" class="table table-bordered table-striped" style="overflow:auto; width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Requested On </th>
                                                                <th scope="col">Requested To/From</th>
                                                                <th scope="col">Priority & Description</th>
                                                                <th scope="col">Status</th>
                                                                <th scope="col">Supervisor 1</th>
                                                                <th scope="col">Supervisor 2</th>
                                                                <th scope="col">Remarks</th>
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

                            <!-- modal approved -->
                            <div class="modal fade" id="mdlAdd">
                                <div class="modal-dialog modal-xs">
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
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <div class="form-group">
                                                                <label class="required" for="title">Remarks <span class="text-danger">*</span></label>
                                                                <input id="title" name="title" class="form-control" type="text" maxlength="999" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-6" style="display:none;" id="HideFromDate">
                                                            <div class="form-group">
                                                                <label class="required" for="sdate">From Date</label>
                                                                <input type="text" id="sdate" class="form-control" autocomplete="off" readonly>
                                                                <!-- <input type="text" id="HalfDay" class="form-control" autocomplete="off" required> -->

                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-6" style="display:none;" id="HideToDate">
                                                            <div class="form-group">
                                                                <label class="required" for="edate">To Date</label>
                                                                <input type="text" id="edate" class="form-control" autocomplete="off" readonly>
                                                            </div>
                                                        </div>


                                                        <div class="col-sm-12 col-md-6 col-lg-6" style="display:none;" id="HideisHalfDay">
                                                            <div class="form-group">
                                                                <label class="required" for="halfdayDate">Leave Date</label>
                                                                <input type="text" id="halfdayDate" class="form-control" autocomplete="off" readonly>
                                                                <span> Half Day<span>
                                                            </div>

                                                        </div>




                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <div class="row">
                                                                <div class="col-sm-6 col-md-4 col-lg-4">
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
                                                                            <a class="text-warning" onclick="deleteRowFiles()" title="Delete Selected File(s)" style="font-size:25px; cursor:pointer"><i class="fas fa-minus-hexagon"></i></a>
                                                                            <a class="text-teal" onclick="addRowFiles()" title="Add New File" style="font-size:25px; cursor:pointer"><i class="fas fa-plus-hexagon"></i></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row" style="height:auto; overflow:auto">
                                                                        <table id="tblFiles" class="table table-hover" style="width:100%; text-align:left;">
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
                                                                                    <td style="vertical-align:middle; width:40%;"><input type="text" id="file_title1" class="form-control file_title" placeholder="Eg. LEAVE REPORT" maxlength="99" autocomplete="off" /></td>
                                                                                    <td style="vertical-align:middle; width:50%; text-align:center;"><input type="file" id="file1" accept="image/*,.pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx" class="dropify file" data-height="100" /></td>
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
                                                <button type="submit" class="btn btn-primary btn-xs">Approved</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- modal decline -->
                            <div class="modal fade" id="mdDecline">
                                <div class="modal-dialog modal-xs">
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

                                            <button id="Declinerequest" class="btn btn-success btn-xs">Decline</button>
                                        </div>
                                        <!-- </form> -->
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="LeaveStatusModal" tabindex="-1" role="dialog" aria-labelledby="LeaveStatusModalTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-body">
                                    <div class="card card-primary card-outline">
                                        <div class="card-body box-profile">
                                            <ul class="list-group list-group-unbordered mb-3">
                                                <li class="list-group-item">
                                                    <b>Approved Date From</b> <span class="badge badge-success float-right" id="ApprovedDateFrom"></span>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>Approved Date To</b> <span class="badge badge-primary float-right" id="ApprovedDateTo"></span>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>No of Day</b> <a id="NumberOfDays" class="float-right"></a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div style="overflow:auto; width:100%">
                                <table id="tblData" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Requested By</th>
                                            <th scope="col">Requested From To Date</th>
                                            <th scope="col">Leave Type </th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Remarks</th>
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
    var notice_details, notice_id, title, sdate, edate, type;
    var add_files = 0;

    var StaffID, LeaveID, DepartmentID; //edate1,sdate1 removedata

    $("#sdate, #fromDate, #edate, #toDate").datepicker({
        minDate: "-0D",
        maxDate: "+1Y",
        changeMonth: true,
        changeYear: true
    });

    $('.dropify').dropify();
    $('.bootstrapToggle').bootstrapToggle();

    $(function() {
        debugger;
        getUserCurrentMonthLeaveRequest();
        getAllUsersLeave();
        getDepartment();
        getSupervisorForStaffLeaves();
        getUserLeaveBasedOnSupervisors();
    });

    function getDepartment() {
        let obj = {};
        obj.Module = "Settings";
        obj.Page_key = "getAllDepartment";
        obj.JSON = {};
        SilentTransportCall(obj);
    }

    $("#Declinerequest").click(function() {
        debugger;
        var obj = {};
        obj.Module = "Staff";
        obj.Page_key = "declineleaveRequest";
        var json = {};
        json.Remarks = $("#declineRemarks").val();
        json.LeaveID = LeaveID;
        obj.JSON = json;
        SilentTransportCall(obj);
    });

    function getSupervisorForStaffLeaves() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getSupervisorForStaffLeaves";
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



    function getStaffDeptWise(data) {
        var obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getStaffByDepartment";
        var json = {};
        json.DepartmentID = data;
        obj.JSON = json;
        SilentTransportCall(obj);
    }

    function getUserCurrentMonthLeaveRequest() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getUserCurrentMonthLeaveRequest";
        obj.JSON = {};
        SilentTransportCall(obj);
    }



    function getUserLeaveBasedOnSupervisors() {
        debugger;
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getUserLeaveBasedOnSupervisors";
        obj.JSON = {};
        SilentTransportCall(obj);
    }

    function getAllUsersLeave() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getAllUsersLeave";
        obj.JSON = {};
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
        debugger;
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
        // json.StaffID = $("#staffID").val();
        json.isUrgent = $("#isUrgent").prop('checked') ? 1 : 0; //bit
        json.isHalfDayLeave = $("#isHalfDayLeave").prop('checked') ? 1 : 0; //bit

        json.isPostLunch = $("#halfDayOptions").val();
        json.File = fileData;
        json.LeaveRemarks = $("#remarks").val();
        json.FromDate = $("#fromDate").val();
        json.ToDate = $("#toDate").val();
        json.Supervisor1ID = $('#supervisor1').val();
        json.Supervisor2ID = $('#supervisor2').val();
        obj.JSON = json;
        console.log(obj);
        TransportCall(obj);
    }


    // $('#mdlAdd').on('hidden.bs.modal', async function() {
    //     $("input").val("");
    //     $('.select2').val(null).trigger('change');
    //     $('.dropify-clear').click();
    // });


    // Modal Animation
    $('#mdlAdd').on('show.bs.modal', function() {
        $(this).find('.modal-dialog').addClass('slide-in');
    });

    $('#mdlAdd').on('hidden.bs.modal', function() {
        // Reset the modal animation class when the modal is hidden
        $(this).find('.modal-dialog').removeClass('slide-in');
    });

    $('#mdDecline').on('show.bs.modal', function() {
        $(this).find('.modal-dialog').addClass('slide-in');
    });

    $('#mdDecline').on('hidden.bs.modal', function() {
        // Reset the modal animation class when the modal is hidden
        $(this).find('.modal-dialog').removeClass('slide-in');
    });

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


    var LeaveTypeID, isHalfDay;

    function onApproved(data) {
        debugger;
        data = JSON.parse(unescape(data));
        $("#sdate").val(data.RequestedDateFrom);
        $("#edate").val(data.RequestedDateTo);
        StaffID = data.StaffID;
        LeaveID = data.LeaveID;
        DepartmentID = data.DepartmentID;
        LeaveTypeID = data.LeaveTypeID;
        isHalfDay = data.isHalfDay
        $("#halfdayDate").val(data.RequestedDateFrom);
        getNoofDaysByLeaveTypeID(LeaveTypeID);
        if (isHalfDay == 1) {
            $("#HideisHalfDay").show();
        } else if (isHalfDay == null || isHalfDay == 0) {
            $("#HideToDate").show();
            $("#HideFromDate").show();
        }

        $("#mdlAdd").modal('show');
    }

    function onDecline(data) {
        LeaveID = data;
        $("#mdDecline").modal('show');
    }

    var NumberOfDaysByLeaveTypeID;

    function loadNoOfDaysByLeaveTypeID(data) {
        debugger;
        NumberOfDaysByLeaveTypeID = data;
    }

    function getNoofDaysByLeaveTypeID(LeaveTypeID) {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getNoofDaysByLeaveTypeID";
        var json = {};
        json.LeaveTypeID = LeaveTypeID;
        obj.JSON = json;
        SilentTransportCall(obj);
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

        var fromDateInput = $("#sdate").val();
        var toDateInput = $("#edate").val();

        // Function to convert date from "MM/DD/YYYY" to "YYYY-MM-DD" format
        function convertDateFormat(dateString) {
            var dateComponents = dateString.split("/");
            return dateComponents[2] + "-" + dateComponents[0] + "-" + dateComponents[1];
        }

        obj.Module = "Staff";
        debugger;
        obj.Page_key = "onLeaveApproved";
        json.Remarks = $("#title").val();
        json.FromDate = fromDateInput;
        json.ToDate = toDateInput;
        json.LeaveID = LeaveID;
        json.LeaveTypeID = LeaveTypeID;
        json.isHalfDayLeave = isHalfDay;
        json.StaffID = StaffID;
        json.DepartmentID = DepartmentID;
        json.File = fileData;
        json.NoOfDaysByLeaveTypeID = NumberOfDaysByLeaveTypeID;
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
                    $('#mdlAdd').modal('hide');
                    getAllUsersLeave();
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
                case "getUserCurrentMonthLeaveRequest":
                    break;

                case "getUserLeaveBasedOnSupervisors":
                    debugger;
                    loaddata(rc.return_data);

                    break;

                case "getNoofDaysByLeaveTypeID":
                    loadNoOfDaysByLeaveTypeID(rc.return_data);
                    break;

                case "getAllUsersLeave":
                    console.log(rc.return_data);
                    loadUserLeave(rc.return_data);
                    break;

                case "declineleaveRequest":
                    notify('success', rc.return_data);
                    $("#mdDecline").modal('hide');
                    getUserCurrentMonthLeaveRequest();
                    break;
                case "onLeaveApproved":
                    notify('success', rc.return_data);
                    $("#mdlAdd").modal('hide');
                    getUserLeaveBasedOnSupervisors();
                    // getUserCurrentMonthLeaveRequest();
                    break;

                case "getSupervisorForStaffLeaves":
                    loadSupervisor(rc.return_data);
                    break;

                default:
                    notify('warning', rc.Page_key);
            }
        } else {
            toastr.error(rc.return_data);
        }
    }





    function loadSupervisor(data) {
        var container = $('<div class="row"></div>'); // Create a container for both select dropdowns
        for (var i = 1; i <= 2; i++) {
            // Extract Supervisor names and IDs
            var supervisorID = 'Supervisor' + i + 'ID';
            var supervisorName = 'Supervisor' + i + 'Name';
            var supervisorIDValue = data[0][supervisorID];
            var supervisorNameValue = data[0][supervisorName];
            // Append select dropdown for Supervisor
            container.append(
                '<div class="form-group">' +
                '<div class="col-md-6">' +
                '<label class="required" style="font-size:13px;">Supervisor ' + i + '<span class="text-danger">*</span></label>' +
                '<select id="supervisor' + i + '" class="form-control supervisor-dropdown"  style="width: 200px;">' +
                '</select>' +
                '</div>' +
                '</div>');

            // Append option for Supervisor
            $('#supervisor' + i, container).append('<option value="' + supervisorIDValue + '">' + supervisorNameValue + '</option>'); // Append the option to the select inside the container
        }

        $('#dropdown-container').append(container); // Append the container to the main dropdown container

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
    //             text += '<td><span class="badge badge-info">' + data[i].CreatedDateTime + ' </span> </td>';
    //             text += '<td> From : <b>' + data[i].RequestedDateFrom + ' </b> To : <b>' + data[i].RequestedDateTo + '</b></td>';
    //             text += '<td> ' + (data[i].isUrgent == 1 ? "<span class=' badge badge-danger'>Urgent</span>" : "<span class=' badge badge-info'>Not Urgent</span>") + ' <br>' + data[i].LeaveRemarks;
    //             if (data[i].Remarks == null){
    //                 text += '</td><span class="badge badge-warning">Not yet Response</span></td>';
    //             }
    //             else{
    //                 text += '</td>' + data[i].Remarks + '</td>';
    //             }
    //             text += '</tr>';
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

    function loaddata(data) {
        debugger;
        console.log(data);
        var table = $("#tblData");
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
                text += '<td>' + data[i].RequestedBy + '</td>';
                if (data[i].isHalfDay == 1) {
                    text += '<td> On : <b>' + data[i].RequestedDateFrom + ' </b> <br> <span>Half Day</span></td>';
                } else {
                    text += '<td> From : <b>' + data[i].RequestedDateFrom + ' </b> To : <b>' + data[i].RequestedDateTo + '</b></td>';
                }
                // text += '<td>' + data[i].LeaveType + '</td>';
                text += '<td> ' + (data[i].isUrgent == 1 ? "<span class=' badge badge-danger'>Urgent</span>" : "<span class=' badge badge-info'>Not Urgent</span>") + ' <br>' + data[i].LeaveType;
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

                text += '</td>';
                text += '<td>' + (
                    data[i].isApproved == 1 ?
                    '<span style="color:green;">Supervisor 1 Approved</span>' :
                    (data[i].isApproved == null ?
                        '<span class="badge badge-danger">Pending</span>' :
                        (data[i].isApproved == 2 ?
                            '<span class="badge badge-warning">Supervisor 2 Approved</span>' :
                            (data[i].isApproved == 0 ?
                                '<span class="badge badge-warning">Rejected</span>' :
                                '<span class="badge badge-info" style="background-color:#FFFC9B;color:#B4B4B8;">Pending</span>')))
                ) + '</td>';

                // text += '<td>' + (data[i].Supervisor1Remarks == null || data[i].Supervisor2Remarks == null ? "<span class='badge badge-danger'>Not Yet Response</span>" : data[i].Supervisor1Remarks) + '</td>';
                text += '<td>' + (
                    (data[i].Supervisor1Remarks == null && data[i].Supervisor2Remarks == null) ?
                    (data[i].Remarks != null ? data[i].Remarks : "No Remarks") :
                    (data[i].Supervisor1Remarks != null ? data[i].Supervisor1Remarks : data[i].Supervisor2Remarks)
                ) + '</td>';

                if (data[i].isApproved == null) { // if not approved by both the supervisors then show actions 
                    text += '<td class="btn-group btn-group-sm">';
                    text += ' <a class="btn btn-info btn-sm text-white" onclick="onApproved(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fa fa-check" aria-hidden="true"></i> </a>';
                    text += ' <a class="btn btn-danger btn-sm text-white" onclick="onDecline(' + data[i].LeaveID + ')"> <i class="fa fa-times" aria-hidden="true"></i> </a>';
                    text += '</td>';
                } else if (data[i].Supervisor1Remarks !== null && data[i].Supervisor2Remarks === null) {
                    text += '<td class="btn-group btn-group-sm">';
                    text += ' <a class="btn btn-info btn-sm text-white" onclick="onApproved(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fa fa-check" aria-hidden="true"></i> </a>';
                    text += ' <a class="btn btn-danger btn-sm text-white" onclick="onDecline(' + data[i].LeaveID + ')"> <i class="fa fa-times" aria-hidden="true"></i> </a>';
                    text += '</td>';

                } else if (data[i].Supervisor1Remarks !== null && data[i].Supervisor2Remarks !== null) {

                } else {


                }

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




    function loadUserLeave(data) {

        var table = $("#AllData");
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
                // text += '<td>' + data[i].CreatedDateTime + '</td>';
                text += '<td>' + data[i].CreatedDateTime + '</td>';
                if (data[i].isHalfDay == 1) {
                    text += '<td><span>Half Day<span><br> <p> On: ' + data[i].CreatedDateTime + '</p></td>';
                } else if (data[i].isHalfDay == 0) {
                    text += '<td> From : <b>' + data[i].RequestedDateFrom + ' </b> To : <b>' + data[i].RequestedDateTo + '</b></td>';
                }
                // text += '<td> From : <b>' + data[i].RequestedDateFrom + ' </b> To : <b>' + data[i].RequestedDateTo + '</b></td>';
                text += '<td> ' + (data[i].isUrgent == 1 ? "<span class=' badge badge-danger'>Urgent</span>" : "<span class=' badge badge-info'>Not Urgent</span>") + ' <br>' + data[i].LeaveRemarks;
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

                text += '</td>';
                text += '<td>' + (
                    data[i].isApproved == 2 ?
                    '<span class="badge badge-success">Approved</span> <br><button class="btn btn-primary btn-xs" onclick="view(\'' + escape(JSON.stringify(data[i])) + '\')"><i class="fas fa-eye"></i></button>' :
                    data[i].isRejected == 1 ?
                    '<span class="badge badge-danger">Rejected</span>' :
                    data[i].isApproved == 0 || data[i].isRejected == 0 ?
                    '<span class="badge badge-warning">Pending</span>' :
                    '<span class="badge badge-info" style="background-color:#FFFC9B;color:#B4B4B8;">Pending</span>'
                ) + '</td>';
                text += '<td>' + (data[i].supervisor1Name == null || data[i].supervisor1Name == '' ? "<span class='badge badge-danger'>No Supervisor Found</span>" : data[i].supervisor1Name) + '</td>';
                text += '<td>' + (data[i].supervisor2Name == null || data[i].supervisor2Name == '' ? "<span class='badge badge-danger'>No Supervisor Found</span>" : data[i].supervisor2Name) + '</td>';
                text += '<td>' + (data[i].Remarks == null || data[i].Remarks == '' ? "<span class='badge badge-danger'>Not Yet Response</span>" : data[i].Remarks) + '</td>';
                text += '</tr >';
            }
        }
        $("#AllData tbody").html("");
        $("#AllData tbody").append(text);

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


    function view(data) {
        debugger
        data = JSON.parse(unescape(data));

        // Display the dates
        $("#ApprovedDateFrom").text(data.ApprovedDateFrom);
        $("#ApprovedDateTo").text(data.ApprovedDateTo);

        // Calculate the number of days
        var fromDate = new Date(data.ApprovedDateFrom);
        var toDate = new Date(data.ApprovedDateTo);
        var timeDifference = toDate - fromDate;
        var daysDifference = Math.ceil(timeDifference / (1000 * 60 * 60 * 24));

        // Display the number of days
        $("#NumberOfDays").text(daysDifference + " Days");

        // Show the modal
        $("#LeaveStatusModal").modal('show');
    }
</script>