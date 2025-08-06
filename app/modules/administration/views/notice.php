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
</style>

<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <strong>News</strong>
                            </div>
                            <span class="float-right">
                                <button class="btn btn-xs btn-success" onclick="resetForm();" data-toggle="modal" data-target="#mdlAdd"><i class="fa fa-plus"></i>&nbsp;<strong>ADD</strong></button>
                                <a href="administration-archeivenotice" class="btn"> <i class="fa fa-archive" aria-hidden="true"></i></a>
                            </span>

                            <div class="modal fade" id="mdlAdd">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title d-flex justify-content-center">Add Notice</h4>
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
                                                                <label class="required" for="title">Title</label>
                                                                <input id="title" name="title" class="form-control" type="text" maxlength="999" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <div class="form-group">
                                                                <label class="required" for="Description">Description</label>
                                                                <input id="Description" name="Description" class="form-control" type="text" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-4 col-lg-4">
                                                            <div class="form-group">
                                                                <label class="required" for="sdate">Start Date</label>
                                                                <input type="text" id="sdate" class="form-control" autocomplete="off" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 col-lg-4">
                                                            <div class="form-group">
                                                                <label class="required" for="edate">End Date</label>
                                                                <input type="text" id="edate" class="form-control" autocomplete="off" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 col-lg-4">
                                                            <label>Applicable For</label>
                                                            <select class="form-control select2" id="applicable" data-placeholder="-Select-" style="width: 100%;">
                                                                <option selected value='1'>Staff</option>
                                                                <option value='2'>Intern</option>
                                                                <option value='3'>Both Staff & Intern</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-sm-12 col-md-4 col-lg-4" id='div_notify'>
                                                            <label>Notify To</label>
                                                            <input class="bootstrapToggle" type="checkbox" id="isAll" checked data-toggle="toggle" data-on="All" data-off="Selected" data-onstyle="success" data-offstyle="light" data-width="100%">
                                                        </div>
                                                        <!-- ispublic Notice -->
                                                        <div class="col-sm-12 col-md-4 col-lg-4" id='div_notify'>
                                                            <label>isPublic</label>
                                                            <input class="bootstrapToggle" type="checkbox" id="isPublic" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="light" data-width="100%">
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 col-lg-4" id="div_staff" style="display:none;">
                                                            <label>Staff</label>
                                                            <select class="form-control select2" id="staff" multiple="multiple" data-placeholder="All Staffs" style="width: 100%;"></select>
                                                        </div>
                                                        <!-- intern -->
                                                        <div class="col-sm-12 col-md-4 col-lg-4" id="div_class" style="display:none;">
                                                            <label>Intern</label>
                                                            <select class="form-control select2" id="intern" multiple="multiple" data-placeholder="All Interns" style="width: 100%;"></select>
                                                        </div>

                                                        <!-- <div class="col-sm-12 col-md-4 col-lg-4" id="div_class" style="display:none;">
                                                            <label>Class</label>
                                                            <select class="form-control select2" id="cls" multiple="multiple" data-placeholder="All Classes" style="width: 100%;"></select>
                                                        </div> -->
                                                        <!-- <div class="col-sm-12 col-md-4 col-lg-4" id="div_student" style="display:none;">
                                                            <label>Student</label>
                                                            <select class="form-control select2" id="student" multiple="multiple" data-placeholder="All Students" style="width: 100%;"></select>
                                                        </div> -->
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-6 col-lg-6 pr-4">
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
                                                                                    <td style="vertical-align:middle; width:40%;"><input type="text" id="file_title1" class="form-control file_title" placeholder="Eg. ACADEMIC CALENDAR" maxlength="99" autocomplete="off" /></td>
                                                                                    <td style="vertical-align:middle; width:50%; text-align:center;"><input type="file" id="file1" accept="image/*,.pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx" class="dropify file" data-height="100" /></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br />
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                                            <div class="row">
                                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                                    <div class="form-group">
                                                                        <label>Add Link(s)</label>
                                                                        <input class="form-control bootstrapToggle" id="add_links" type="checkbox" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="light" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row" id="div_links" style="display:none;">
                                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                                    <div class="row">
                                                                        <div class="col-sm-12" style="text-align:right">
                                                                            <a class="text-warning" onclick="deleteRowLinks()" title="Delete Selected Link(s)" style="font-size:25px; cursor:pointer"><i class="fas fa-minus-hexagon"></i></a>
                                                                            <a class="text-teal" onclick="addRowLinks()" title="Add New Link" style="font-size:25px; cursor:pointer"><i class="fas fa-plus-hexagon"></i></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row" style="height:auto; overflow:auto">
                                                                        <table id="tblLinks" class="table table-hover" style="width:100%; text-align:left;">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th style="vertical-align:middle; width:10%; text-align:center;"></th>
                                                                                    <th style="vertical-align:middle; width:40%;">Link Title<b style="color:red;">*</b></th>
                                                                                    <th style="vertical-align:middle; width:50%; text-align:center;">Link<b style="color:red;">*</b></th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="vertical-align:middle; width:10%; text-align:center;"><input type="checkbox" /></td>
                                                                                    <td style="vertical-align:middle; width:40%;"><input type="text" id="link_title1" class="form-control link_title" placeholder="Eg. SCHOOL WEBSITE" maxlength="99" autocomplete="off" /></td>
                                                                                    <td style="vertical-align:middle; width:50%; text-align:center;"><input type="text" id="link1" class="form-control link" placeholder="Eg. http://www.anthonianshillong.org/" maxlength="99" autocomplete="off" /></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="mdlView">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title d-flex justify-content-center">News Details</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form id="frmEdit">
                                            <div class="modal-body">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-4 col-lg-4">
                                                            <div class="form-group">
                                                                <label for="title1">Title</label>
                                                                <input id="title1" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 col-lg-4">
                                                            <div class="form-group">
                                                                <label for="sdate1">Start Date</label>
                                                                <input id="sdate1" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 col-lg-4">
                                                            <div class="form-group">
                                                                <label for="edate1">End Date</label>
                                                                <input id="edate1" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style="overflow:auto; width:100%">
                                                        <table id="tblNewsDetails" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Type</th>
                                                                    <th scope="col">Title</th>
                                                                    <th scope="col">Access</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="row" id="div_notices" style="display:none;">
                                <div class="col-6">
                                    <div class="info-box" style="background-color:#edfbfd;">
                                        <div class="info-box-content">
                                            <span class="info-box-number text-left text-muted mb-2">Independence Day Celeration in the School Campus</span>
                                            <!-- <span class="info-box-text text-left text-muted mb-2">Added By - Mr. Khanna</span> -->
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
                            </div>
                            <div style="overflow:auto; width:100%">
                                <table id="tblData" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Title</th>
                                            <th scope="col">Start Date</th>
                                            <th scope="col">End Date</th>
                                            <th scope="col">File(s)/ Link(s)</th>
                                            <th scope="col">isPublic</th>
                                            <!-- <th scope="col">IsActive</th> -->
                                            <th scope="col">Action</th>
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

<!-- modal for seen -->
<div class="modal fade" id="seenlist">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title d-flex justify-content-center">User who has Seen Notice</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div style="overflow:auto; width:100%">
                        <table id="userwhohasseenNotice" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Sl No</th>
                                    <th scope="col">UserName</th>
                                    <th scope="col">User Type</th>
                                    <th scope="col">Read Date and Time</th>
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
<!-- modal for not seen -->
<div class="modal fade" id="Notseenlist">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title d-flex justify-content-center">User who have Not Seen Notice</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div style="overflow:auto; width:100%">
                        <table id="notseenUser" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Sl#</th>
                                    <th scope="col">UserName</th>
                                    <th scope="col">Notify Date</th>
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


<!-- Summernote -->
<script src="assets/admin/plugins/summernote/summernote-bs4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.js"></script>
<script src="assets/admin/plugins/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="assets/js/commonfunctions.js"></script>
<script>
    var  notice_details, notice_id, title, sdate, edate, type;

    var add_files = add_links = 0;

    var applicable = 2,
        is_all = 1,
        cls = [];

    // $("#datepicker").datepicker({ minDate: "-3M -15D", maxDate: "+3M +15D",changeMonth:true,changeYear:true });
    $("#sdate, #sdate1, #edate, #edate1").datepicker({
        minDate: "-0D",
        maxDate: "+1Y",
        changeMonth: true,
        changeYear: true
    });
    $('.dropify').dropify();
    $('.bootstrapToggle').bootstrapToggle();

    $(function() {
        getAllNotice();
        getStaff();
        getIntern();
    });

    function getAllNotice() {
        let obj = {};
        obj.Module = "Administration";
        obj.Page_key = "getNotices";
        obj.JSON = {};
        TransportCall(obj);
    }

    function getStaff() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getStaff";
        obj.JSON = {};
        TransportCall(obj);
    }

   function getIntern() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getInternList";
        obj.JSON = {};
        TransportCall(obj);
    }

    $("#sdate").on('change', function() {
        $('#edate').datepicker('option', 'minDate', new Date($("#sdate").val()));
    });
    $("#sdate1").on('change', function() {
        $('#edate1').datepicker('option', 'minDate', new Date($("#sdate1").val()));
    });
    $('#applicable').on('change', function() {
        applicable = $('#applicable').val();
        if (applicable == '3') {
            $('#div_notify').hide();
            $('#isAll').prop('checked', 'true').change();
        } else {
            $('#div_notify').show();
            $('#isAll').prop('checked', 'true').change();
        }
    });

    //ispublic
    $('#isPublic').on('change', function() {
        $('#isPublic').prop('checked') ? '1' : '0';
    });

    $('#isAll').on('change', function() {
        $('#isAll').prop('checked') ? is_all = '1' : is_all = '0';
        $('#staff option:selected').prop("selected", false).trigger('change');
        $('#intern option:selected').prop("selected", false).trigger('change');
        if (is_all == '1') {
            $('#div_staff').hide();
            $('#div_class').hide(); 
            
        } else {
            if (applicable == '1') {
                $('#div_staff').show();
                $('#div_class').hide();
                
            } else {
                $('#div_staff').hide();
                $('#div_class').show();
            }
        }
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

    $('#add_links').on('change', function() {
        if ($('#add_links').prop('checked')) {
            add_links = 1;
            $('.link_title').val('');
            $('.link').val('');
            $('#div_links').show();
        } else {
            add_links = 0;
            $('#div_links').hide();
        }
    });

    $('#frmAdd').submit(function() {
        saveAddFormData();
        return false;
    });

    $('#frmEdit').submit(function() {
        saveEditFormData();
        return false;
    });
    $('#mdlAdd, #mdlEdit').on('hidden.bs.modal', async function() {
        $("input").val("");
        $('.select2').val(null).trigger('change');
        $('.dropify-clear').click();
    });


    //show description when click on  a link
    $('#tblData').on('click', 'a', function() {
        $("#detail").show();
    });

    $('#tblData').on('click', '#detail', function() {
        $("#detail").hide();
    });


    //onclick of view notices Icon
    $('#tblData').on('click', 'tbody tr td button', function() {
        notice_id = $(this).attr('data-notice_id');
        title = $(this).attr('data-title');
        sdate = $(this).attr('data-sdate');
        edate = $(this).attr('data-edate');

        $("#title1").val(title);
        $("#sdate1").val(sdate);
        $("#edate1").val(edate);

        let obj = {};
        let json = {};

        obj.Module = "Administration";
        obj.Page_key = "getNoticeDetails";

        json.NoticeID = notice_id;

        obj.JSON = json;

        TransportCall(obj);

        $("#mdlView").modal("show");
    });

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
            notify('warning',e);
        }
    }

    function addRowLinks() {
        if ($('#tblLinks tbody tr').length < 5) {
            $("#tblLinks").append($('#tblLinks tbody tr:last').clone());
            $('#tblLinks tbody tr:last').each(function(row, tr) {
                $(tr).find('td').eq(1).prop('innerHTML', '');
                $(tr).find('td').eq(1).append('<input type="text" id="link_title' + $('#tblLinks tbody tr').length + '" class="form-control link_title" placeholder="Eg. SCHOOL WEBSITE" maxlength="99" autocomplete="off"/>');
                $(tr).find('td').eq(2).prop('innerHTML', '');
                $(tr).find('td').eq(2).append('<input type="text" id="link' + $('#tblLinks tbody tr').length + '" class="form-control link" placeholder="Eg. http://www.anthonianshillong.org/" maxlength="99" autocomplete="off"/>');
                $('.dropify').dropify();
            });
        } else {
            toastr.info('Only 5 Links can be attached !!');
        }
    }

    function deleteRowLinks() {
        try {
            var table = document.getElementById('tblLinks');
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
            notify('warning',e);
        }
    }

    //add notice
    async function saveAddFormData() 
    {
        debugger;
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

        var linkData = {};
        if ($('#add_links').prop('checked')) {
            for (var j = 1; j <= $('#tblLinks tbody tr').length; j++) {
                var link_title = $('#link_title' + j).val();
                var link = $('#link' + j).val();
                linkData[j] = {
                    link_title: link_title,
                    link: link
                }
            }
        }
        obj.Module = "Administration";
        obj.Page_key = "addNotice";

        if (($("#intern").val()).length == 0) {
            $('#intern option').prop("selected", true).trigger('change');
            $("#intern").select2();
        }

        if (($("#staff").val()).length == 0) {
            $('#staff option').prop("selected", true).trigger('change');
            $("#staff").select2();
        }

        json.Staff = [];
        json.Intern = [];

        ApplicableFor=$("#applicable").val()
        if(ApplicableFor==1){
            json.Staff = $("#staff").val();
        }
        else if(ApplicableFor==2){
            json.Intern = $("#intern").val();
        }
        else if(ApplicableFor==3){
            json.Intern = $("#intern").val();
            json.Staff = $("#staff").val();
        }
        else{
            notify("warning","Please Select Applicable for");
            return;
        }
      
        //Staff
        for (let i = 0; i < (json.Staff).length - 1; i++) {
            if ((json.Staff)[i] === "-1") {
                (json.Staff).shift();
            }
        }

        //Intern 
        for (let i = 0; i < (json.Intern).length - 1; i++) {
            if ((json.Intern)[i] === "-1") {
                (json.Intern).shift();
            }
        }

        json.Title = $("#title").val();
        json.Description = $("#Description").val();
        json.SDate = $("#sdate").val();
        json.EDate = $("#edate").val();
        json.ApplicableFor = $("#applicable").val();
        json.isAll = $('#isAll').prop('checked') ? '1' : '0';
        json.isPublic = $('#isPublic').prop('checked') ? 1 : 0; //bit
        json.File = fileData;
        json.Link = linkData;
        obj.JSON = json;
        console.log(obj);
        TransportCall(obj);
    }

    function getBase64(file) 
    {
        return new Promise(function(resolve) {
        var reader = new FileReader();
        reader.onloadend = function() {
            resolve(reader.result)
        }
        reader.readAsDataURL(file);
        });
    }

    // edit data TODO
    function saveEditFormData() {
        let obj = {};
        let json = {};

        obj.Module = "Administration";
        obj.Page_key = "editURLLink";

        json.URLCategoryID = url_category_id;
        json.ModuleID = $("#module1").val();
        json.Category = $("#category1").val();

        obj.JSON = json;
        // TransportCall(obj);
    }

    function resetForm() {
        
    }

    function onSuccess(rc) {


        if (rc.return_code) {
            switch (rc.Page_key) {
                case "getNotices":
                    notice_details = rc.return_data.notice_details;
                    loaddata(rc.return_data.notices);
                    break;
                case "getNoticeDetails":
                    if (rc.return_data.length > 0)
                        loaddata1(rc.return_data);
                    else
                        $('#tblNewsDetails').hide();
                    break;
                case "getStaff":
                    loadSelect("#staff", rc.return_data);
                    break;
                case "getInternList":
                    loadSelect("#intern", rc.return_data);
                    break;

                case "addNotice":
                    notify("success",rc.return_data);
                    $("#mdlAdd").modal("hide");
                    getAllNotice();
                    break;
                // case "editURLLink":
                //     toastr.success('Edited Successfully');
                //     $("#mdlEdit").modal("hide");
                //     // loadData(); //getAllNotice
                //     break;
                case "deleteNotice":
                    notify("success", rc.return_data);
                    getAllNotice();
                    break;
                case "onNotifyUsers":
                    notify("success", rc.return_data);
                    // loadData();  //getAllNotice
                    break;

                case "getseenNotice":
                    if (rc.return_data['data'] == 1) 
                    {   
                        //for seen user 
                        loadSeendata(rc.return_data);
                    }
                    else
                    {
                        // not seen user
                        loadNotSeendata(rc.return_data);
                    }
                    break;

                default:
                    notify('warning',rc.Page_key);
            }
        } else {
            toastr.error(rc.return_data);
        }
    }


    $("#ShowDiv").click(function() {
        alert();
    });

    function loaddata(data) 
    {
        var table = $("#tblData");
        var div_notices = '';

        try {
            if ($.fn.DataTable.isDataTable($(table))) {
                $(table).DataTable().destroy();
            }
        } catch (ex) {}

        var text = "";
        var hasLinksFiles = false;
        if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
                hasLinksFiles = false;
                div_notices += '<div class="col-6">';
                div_notices += '<div class="info-box" style="background-color:#edfbfd;">';
                div_notices += '<div class="info-box-content">';
                div_notices += '<span class="info-box-number text-left text-muted mb-2">' + data[i].Title + '</span>';
                if (data[i].hasFiles == 1) {
                    hasLinksFiles = true;
                    div_notices += '<p class="mb-2">';
                    for (let j = 0; j < notice_details.length; j++) {
                        if (notice_details[j].NoticeID == data[i].NoticeID && notice_details[j].TypeID == '1') {
                            div_notices += '<a href=' + notice_details[j].FileLink + ' target="_blank" title="VIEW DOCUMENT" class="link-black text-sm mr-4"><i class="fas fa-paperclip mr-1"></i>' + notice_details[j].Title + '</a>';
                        }
                    }
                    div_notices += '</p>';
                }
                if (data[i].hasLinks == 1) {
                    hasLinksFiles = true;
                    div_notices += '<p class="mb-0">';
                    for (let j = 0; j < notice_details.length; j++) {
                        if (notice_details[j].NoticeID == data[i].NoticeID && notice_details[j].TypeID == '2') {
                            var lnk = url = '';
                            if (notice_details[j].FileLink.substring(0, 8) == 'https://') {
                                lnk = notice_details[j].FileLink.split('https://');
                                url = lnk[1];
                            } else if (notice_details[j].FileLink.substring(0, 7) == 'http://') {
                                lnk = notice_details[j].FileLink.split('http://');
                                url = lnk[1];
                            } else {
                                url = notice_details[j].FileLink;
                            }

                            div_notices += '<a href="//' + url + '" target="_blank" title="VIEW DOCUMENT" class="link-black text-sm mr-4"><i class="fas fa-external-link mr-1"></i>' + notice_details[j].Title + '</a>';
                        }
                    }
                    div_notices += '</p>';
                }
                div_notices += '<span class="info-box-text text-right text-muted text-sm"><i>Added By - ' + data[i].Name + '</i></span>';
                div_notices += '<span class="info-box-text text-right text-muted text-sm"><i>Added On - ' + data[i].StartDate + '</i></span>';
                div_notices += '</div>';
                div_notices += '</div>';
                div_notices += '</div>';
                text += '<tr>';
                text += '<td>' + data[i].Title;
                if ((new String(data[i].Description)).length == 0 || data[i].Description == null || data[i].Description.trim() == '') 
                {

                } else 
                {
                    text += '  <br /> <i style="font-size:10px;">' + data[i].Description + ' </i>';
                }
                text += '</td>';
                text += '<td>' + data[i].StartDate;
                text += '</td>';
                text += '<td>' + data[i].EndDate + '</td>';
                text += '<td>';
                //seen user
                text += '<a title="Users who has seen Notice" onclick="seenNotice(' + data[i].NoticeID + ')"  class="btn btn-sm btn-success"> <span class="">' + data[i].isRead + ' </span>  </a>';
                //not seen
                text += ' &nbsp; <a  title="Users who has Not seen Notice" onclick="NotseenNotice(' + data[i].NoticeID + ')" class="btn btn-sm btn-danger"> <span class="">' + data[i].notRead + '</span>  </a>';
                if (hasLinksFiles)
                    // view
                    text += ' &nbsp; <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#mdlView" data-notice_id="' + data[i].NoticeID + '" data-title="' + data[i].Title + '" data-sdate="' + data[i].StartDate + '" data-edate="' + data[i].EndDate + '"><i class="fa fa-eye"></i>&nbsp;<strong>VIEW</strong></button>';
                text += '</td>';
                text += '<td>' + (data[i].isPublic == 1 ? "<span class='badge badge-success'>Yes</span>" : " <span class='badge badge-danger'>No </span>") + '</td>';
                text += '<td class="btn-group btn-group-sm">';
                text += '   <a class="btn btn-primary btn-sm text-white" title="Notify Users"  onclick="onNotifyUsers(' + data[i].NoticeID + ')"> <i class="fas fa-bell"> </i> </a>';
                text += '   <a class="btn btn-danger btn-sm text-white ml-1" title="Delete Notice" onclick="onDeleteNotice(' + data[i].NoticeID + ')"> <i class="fas fa-trash"> </i> </a>';
                text += '</td>';
                text += '</tr >';
            }
        }
        $("#tblData tbody").html(text);
        $("#div_notices").html(div_notices);

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
                    title: document.title,
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

    function loaddata1(data) {
        $('#tblNewsDetails').show();
        var table = $("#tblNewsDetails");

        try {
            if ($.fn.DataTable.isDataTable($(table))) {
                $(table).DataTable().destroy();
            }
        } catch (ex) {}

        var text = ""
        if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
                var url;
                var lnk;

                text += '<tr>';

                if (data[i].TypeID == "1") {
                    text += '<td><strong>File</strong></td>';
                    text += '<td>' + data[i].Title + '</td>';
                    text += '<td><a href=' + data[i].FileLink + ' target="_blank">View/Download</a></td>';
                } else {
                    if (data[i].FileLink.substring(0, 8) == 'https://') {
                        lnk = data[i].FileLink.split('https://');
                        url = lnk[1];
                    } else if (data[i].FileLink.substring(0, 7) == 'http://') {
                        lnk = data[i].FileLink.split('http://');
                        url = lnk[1];
                    } else {
                        url = data[i].FileLink;
                    }
                    text += '<td><strong>Link</strong></td>';
                    text += '<td>' + data[i].Title + '</td>';
                    text += '<td><a href="//' + url + '" target="_blank">Open Link</a></td>';
                }

                text += '</tr >';
            }
        }
        $("#tblNewsDetails tbody").html(text);
    }

    function onDeleteNotice(NoticeID) {
        debugger;
        if (confirm("Are you sure you want to delete")) {
            let obj = {};
            obj.Module = "Administration";
            let json = {};
            obj.Page_key = "deleteNotice";
            json.NoticeID = NoticeID;
            obj.JSON = json;
            console.log(obj);
             SilentTransportCall(obj);
        }
    }

    function onNotifyUsers(NoticeID) {
        if (confirm("Are you sure you want re-send Notification to All")) {
            let obj = {};
            obj.Module = "Administration";
            let json = {};
            obj.Page_key = "onNotifyUsers";
            json.NoticeID = NoticeID;
            obj.JSON = json;
            alert("TODO");
            // TransportCall(obj);
        }
    }

    function seenNotice(NoticeID) {
        let obj = {};
        obj.Module = "Administration";
        let json = {};
        obj.Page_key = "getseenNotice";
        json.isRead = 1;
        json.NoticeID = NoticeID;
        obj.JSON = json;
        console.log(obj);
        // TransportCall(obj);
        $("#seenlist").modal('show');
    }

    function NotseenNotice(NoticeID) {
        let obj = {};
        obj.Module = "Administration";
        let json = {};
        obj.Page_key = "getseenNotice";
        json.NoticeID = NoticeID;
        json.isRead = 0;
        obj.JSON = json;
        TransportCall(obj);
        $("#Notseenlist").modal('show');
    }

    function loadSeendata(data) {
        IsReadData = data['isReadData'];
        var table = $("#userwhohasseenNotice");
        try {
            if ($.fn.DataTable.isDataTable($(table))) {
                $(table).DataTable().destroy();
            }
        } catch (ex) {}
        var text = "";
        if (IsReadData.length > 0) {
            for (let i = 0; i < IsReadData.length; i++) {
                text += '<tr>';
                text += '<td>' + (i + 1) + ' </td>';
                text += '<td> ' + IsReadData[i].Name + ' </td>';
                text += '<td>' + IsReadData[i].UserType + '</td>';
                text += '<td>' + IsReadData[i].ReadDateTime + '</td>';
                text += '</tr>';
            }
        }
        $("#userwhohasseenNotice tbody").html(text);
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
                    title: document.title,
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
    //for not seen data
    function loadNotSeendata(data) {
        // notice data is read not not
        IsReadData = data['isReadData'];
        var table = $("#notseenUser");
        try {
            if ($.fn.DataTable.isDataTable($(table))) {
                $(table).DataTable().destroy();
            }
        } catch (ex) {}
        var text = "";
        if (IsReadData.length > 0) {
            for (let i = 0; i < IsReadData.length; i++) {
                text += '<tr>';
                text += '<td>' + (i + 1) + ' </td>';
                text += '<td> ' + IsReadData[i].Name + ' </td>';
                text += '<td>' + IsReadData[i].NotificationDateTime + '</td>';
                // text += '<td>'+IsReadData[i].ReadDateTime +'</td>';
                text += '</tr>';
            }
        }
        $("#notseenUser tbody").html(text);
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
                    title: document.title,
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