<!-- summernote -->
<link rel="stylesheet" href="assets/admin/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.css">

<link rel="stylesheet" href="assets/admin/plugins/bootstrap-toggle-master/css/bootstrap-toggle.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                               Leave Settings
                            </div>
                            <div class="float-right">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">New <i class="fa fa-plus" aria-hidden="true"></i> </button>
                            </div>
                        </div>
                        <div class="modal fade" id="modal-lg">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add New Settings</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="department">Department <span class="text-danger">*</span> </label>
                                                        <select name="" id="department" class="form-control"></select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="staff"> Manage By <span class="text-danger">*</span> </label>
                                                        <select name="" id="staff" class="form-control"></select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="leaveType">Leave Type <span class="text-danger">*</span> </label>
                                                        <select class="form-control select2" id="leaveType" multiple="multiple" data-placeholder="Select here" style="width: 100%;"></select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="btnSave">Save </button>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Department</th>
                                        <th scope="col">LeaveType</th>
                                        <th scope="col">ManageBy</th>
                                        <th scope="col"></th>
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
    </section>
</div>

<script src="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.js"></script>
<script src="assets/admin/plugins/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>

<script>
    $(function() {
        getAllDepartment();  
        getStaff();
        getActiveleaveType();
        getAllDepartmentSettings();
    });

    function getActiveleaveType()
    {
        var obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getActiveleaveType";
        obj.JSON = {};
        TransportCall(obj);  
    }

    function getStaff() {
        var obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getStaff";
        obj.JSON = {};
        TransportCall(obj);
    }

    function getAllDepartment() {
        var obj = new Object();
        obj.Module = "Settings";
        obj.Page_key = "getAllDepartment";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    function getAllDepartmentSettings()
    {
        var obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getAllDepartmentSettings";
        obj.JSON = {};
        TransportCall(obj);  
    }



    $("#btnSave").click(function(){
        var obj = {};
        obj.Module = "Staff";
        var json = {};
        obj.Page_key = "addNewLeaveSetting";
        json.LeaveTypeIDs = $("#leaveType").val();
        json.StaffID = $("#staff").val();
        json.DepartmentID = $("#department").val();
        json.StaffSettingLeaveID=code;
        obj.JSON = json;
        TransportCall(obj);
    });

   

    function onSuccess(rc) {
        if (rc.return_code) {
            switch (rc.Page_key) {
                case "getAllDepartmentSettings":
                    loaddata(rc.return_data)
                    break;
                case "getAllDepartment":
                    loadSelect("#department", rc.return_data);
                    break;
                case "getStaff":
                    loadSelect("#staff", rc.return_data);
                    break;
                case "getActiveleaveType":
                    loadSelect("#leaveType", rc.return_data);
                    break;
                case "addNewLeaveSetting":
                    notify("success",rc.return_data);
                    getAllDepartmentSettings();
                    $("#modal-lg").modal("hide");
                    break;
                default:
                    notify("error", rc.Page_key);
            }
        } else {
            notify("error", rc.return_data);
        }

    }

    function loaddata(data) 
    {
        var table = $("#table");
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
                text += '<th> ' + data[i].DepartmentName + '</th>';
                text += '<td> ' + data[i].leavetype + '</td>';
                text += '<td> ' + data[i].StaffName + '</td>';
                text += '<td class="btn-group btn-group-sm">';
                text += ' <a class="btn btn-info btn-sm text-white" onclick="onEdit(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fas fa-pencil-alt"> </i> </a>';
               // text += ' <a class="btn btn-danger btn-sm text-white" onclick="onDelete(' + data[i].StaffSettingLeaveID + ')"> <i class="fas fa-trash"> </i> </a>';
                text += '</td>';
                text += '</tr >';
            }
        }
        $("#table tbody").html("");
        $("#table tbody").append(text);

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

    var code=null;
    function onEdit(data) {
        data = JSON.parse(unescape(data));
        if (data.LeaveTypeIDs != null)
            $("#leaveType").val((data.LeaveTypeIDs).split(",")).change();
        $("#staff").val(data.StaffID).change();
        $("#department").val(data.DepartmentID).change();
        code = data.StaffSettingLeaveID;
        $("#modal-lg").modal("show");
    }
</script>