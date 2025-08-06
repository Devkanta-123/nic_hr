<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="maincontent">
    <!-- DataTables -->
    <link rel="stylesheet" href="assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css" rel="stylesheet" />
    <!-- summernote -->
    <link rel="stylesheet" href="assets/admin/plugins/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.css">

    <link rel="stylesheet" href="assets/admin/plugins/bootstrap-toggle-master/css/bootstrap-toggle.min.css">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <!-- statisics Card -->
                        <div class="card-header">
                            <h1 class="card-title">Staff</h1>

                            <div class="float-right">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">Add</button>
                            </div>

                            <div class="modal fade" id="modal-lg">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add/Update Staff</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>

                                        <div class="modal-body p-3">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="Name">Name</label>
                                                        <input type="text" class="form-control" placeholder="Name" id="Name"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="DOB">Date Of Birth</label>
                                                        <input type="date" class="form-control" id="DOB">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="DOJ">Date Of Joining</label>
                                                        <input type="date" class="form-control" id="DOJ">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="ContactNo">Contact No</label>
                                                        <input type="number" class="form-control" id="ContactNo"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="EmailID">Email ID</label>
                                                        <input type="email" class="form-control" id="EmailID">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="Gender">Gender</label>
                                                        <select class="form-control" id="Gender"></select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="Religion">Religion</label>
                                                        <select class="form-control" id="Religion"></select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="Caste">Caste</label>
                                                        <select class="form-control" id="Caste"></select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="Community">Community</label>
                                                        <select class="form-control" id="Community"></select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="Nationality">Nationality</label>
                                                        <select class="form-control" id="Nationality">
                                                            <option value="1">Indian</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="Designation">Designation</label>
                                                        <select class="form-control" id="Designation"></select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="Address">Address</label>
                                                        <input type="text" class="form-control" id="Address"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="Photo">Photo</label>
                                                        <input type="file" class="form-control" id="Photo"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="btnAddStaff">Save </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="table" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">Sl#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Contact No</th>
                                    <th scope="col">Email ID</th>
                                    <th scope="col">Designation</th>
                                    <th scope="col">Date Of Birth</th>
                                    <th scope="col">Date Of Joining</th>
                                    <th scope="col">Religion</th>
                                    <th scope="col">Caste</th>
                                    <th scope="col">Community</th>
                                    <th scope="col">Address</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.14.3/xlsx.full.min.js"></script>

<!-- Summernote -->
<script src="assets/admin/plugins/summernote/summernote-bs4.min.js"></script>

<script src="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.js"></script>
<script src="assets/admin/plugins/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>
</div>
<!-- /.content-wrapper -->
<script>
    $(function() {
        getStaff();
        getGender();
        getReligion();
        getCaste();
        getCommunity();
        getDesignations();
    });

    function getStaff() {
        var obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getStaff";
        obj.JSON = {};
        TransportCall(obj);
    }

    function getGender() {
        let obj = {};
        obj.Module = "Settings";
        obj.Page_key = "getGender";
        obj.JSON = {};
        TransportCall(obj);
    }

    function getReligion() {
        let obj = {};
        obj.Module = "Settings";
        obj.Page_key = "getReligion";
        obj.JSON = {};
        TransportCall(obj);
    }

    function getCaste() {
        let obj = {};
        obj.Module = "Settings";
        obj.Page_key = "getCaste";
        obj.JSON = {};
        TransportCall(obj);
    }

    function getCommunity() {
        let obj = {};
        obj.Module = "Settings";
        obj.Page_key = "getCommunity";
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

    function onSuccess(rc) {

        if (rc.return_code) {
            switch (rc.Page_key) {
                case "getStaff":
                    loaddata(rc.return_data);
                    break;
                case "getGender":
                    loadSelect("#Gender", rc.return_data);
                    break;
                case "getReligion":
                    loadSelect("#Religion", rc.return_data);
                    break;
                case "getCaste":
                    loadSelect("#Caste", rc.return_data);
                    break;
                case "getCommunity":
                    loadSelect("#Community", rc.return_data);
                    break;
                case "getDesignations":
                    loadSelect("#Designation", rc.return_data);
                    break;

                case "addStaff":                
                case "updateStaff":
                    notify('Success',rc.return_data);
                    $("#modal-lg").modal("hide");
                    getStaff();
                    break;

                case "deleteStaff":
                    getStaff();
                    notify('Success',"Updated");
                    break;
                default:
                    notify('error',"Unable to process the request");
            }
        }
        else{
            // errorNotification("error", rc.return_data);
            notify('error',rc.return_data);
            try {
                if ($.fn.DataTable.isDataTable($(table))) {
                    $(table).DataTable().destroy();
                }
            } catch (ex) {}
            $("#table tbody").html("");
        }
    }

    function loaddata(data) {
        debugger;
        var table = $("#table");

        try {
            if ($.fn.DataTable.isDataTable($(table))) {
                $(table).DataTable().destroy();
            }
        } catch (ex) {}

        var text = ""

        if (data.length == 0) {
            text += "<tr><td colspan=6>No Data Found</td></tr>";
        } else {
            for (let i = 0; i < data.length; i++) {
                text += '<tr> ';

                text += '<td> ' +  (i + 1) + '</td>';
                text += '<td> ' + data[i].StaffName + '</td>';
                text += '<td> ' + data[i].ContactNo + '</td>';
                text += '<td> ' + data[i].EmailID + '</td>';
                text += '<td> ' + data[i].DesignationName + '</td>';
                text += '<td> ' + (new Date(data[i].DOB)).toLocaleDateString("en-in") + '</td>';
                text += '<td> ' + (new Date(data[i].JoinedDate)).toLocaleDateString("en-in") + '</td>';
                text += '<td> ' + data[i].Religion + '</td>';
                text += '<td> ' + data[i].Caste + '</td>';
                text += '<td> ' + data[i].CommunityName + '</td>';
                text += '<td> ' + data[i].Address + '</td>';
                text += '<td class="btn-group btn-group-sm">';
                text += '   <a class="btn btn-info btn-sm text-white" onclick="onEdit(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fas fa-pen"> </i> </a>';
                text += '   <a class="btn btn-info btn-sm text-white" onclick="openProfile(\'' + data[i].StaffID   + '\')"> <i class="fas fa-address-card"> </i> </a>';
                text += '   <a class="btn btn-info btn-sm text-white" onclick="staffAttendanceDetail('+ data[i].StaffID  +',\''+  data[i].StaffName +'\')"> <i class="fas fa-clock"> </i> </a>';

                // text += '   <a class="btn btn-danger btn-sm text-white" onclick="onDelete(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fas fa-trash-alt"> </i> </a>';
                text += '</td>';
                text += '</tr >';
            }
        }

        $("#table tbody").html(text);

        $(table).DataTable({
            responsive: true,
            "order": [],
            dom: 'Bfrtip',
            "bInfo": true,
            exportOptions: {
                columns: ':not(.hidden-col)'
            },
            "deferRender": true,
            "pageLength": 20,
            buttons: [
                {
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

    let data;
    $("#Photo").change(function() {
        debugger;
        getBase64($(this).prop('files')[0]);
    });

    function getBase64(file) {
        let reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function() {
            console.log(reader.result);
            data = reader.result;
        };
        reader.onerror = function(error) {
            console.log('Error: ', error);
        };
    }


    function onCheckChange(e, ExaminationAllotmentID) {

        var obj = {};
        obj.Module = "Staff";
        obj.Page_key = "updateAllotment";
        var json = {};
        json.ExaminationAllotmentID = ExaminationAllotmentID;
        json.Status = $(e).is(":checked");
        obj.JSON = json;
        TransportCall(obj);
    }

    $("#btnAddStaff").click(function (){
        debugger;
        var obj = {};
        obj.Module = "Staff";
        obj.Page_key = "addStaff";
        var json = {};
        if (StaffID!=undefined){
            obj.Page_key = "updateStaff";
            json.StaffID = StaffID;
        }
        json.Name = $("#Name").val();
        json.DOB = $("#DOB").val();
        json.DOJ = $("#DOJ").val();
        json.ContactNo = $("#ContactNo").val();
        json.EmailID = $("#EmailID").val();
        json.GenderCode = $("#Gender option:selected").val();
        json.ReligionID = $("#Religion option:selected").val();
        json.CasteCode = $("#Caste option:selected").val();
        json.CommunityID = $("#Community option:selected").val();
        json.NationalityID = $("#Nationality option:selected").val();
        json.DesignationID = $("#Designation option:selected").val();
        json.Address = $("#Address").val();
        json.Photo = data;
        obj.JSON = json;

        TransportCall(obj);
    });

    var StaffID;
    function onEdit(Staff){
        Staff = JSON.parse(unescape(Staff));
        StaffID = Staff.StaffID;
        $("#Name").val(Staff.StaffName);
        $("#DOB").val(Staff.DOB);
        $("#DOJ").val(Staff.JoinedDate);
        $("#ContactNo").val(Staff.ContactNo);
        $("#EmailID").val(Staff.EmailID);
        $("#Gender").val(Staff.GenderCode).trigger("change");
        $("#Religion").val(Staff.ReligionID).trigger("change");
        $("#Caste").val(Staff.CasteCode).trigger("change");
        $("#Community").val(Staff.CommunityID).trigger("change");
        $("#Nationality").val(Staff.NationalityID).trigger("change");
        $("#Designation").val(Staff.DesignationID).trigger("change");
        $("#Address").val(Staff.Address);
        $("#modal-lg").modal("show");
    }

    $("#modal-lg").on('hidden.bs.modal', function () {
        StaffID = undefined;
        $("#Name").val("");
        $("#DOB").val("");
        $("#ContactNo").val("");
        $("#EmailID").val("");
        $("#Address").val("");
    });


    function onDelete(Staff){
        Staff = JSON.parse(unescape(Staff));
        if(confirm("Are you sure?")){
            var obj = {};
            obj.Module = "Staff";
            obj.Page_key = "deleteStaff";
            var json = {};
            json.StaffID = Staff.StaffID;
            obj.JSON = json;

            TransportCall(obj);
        }
    }
    function openProfile(StaffID){
        console.log(btoa(StaffID));
        localStorage.setItem("k1",btoa(StaffID));
        window.open("staff-profile","_blank"); 
    }
    
    function staffAttendanceDetail(StaffID,StaffName)
    { 
       localStorage.setItem("StaffID",StaffID);
       localStorage.setItem("StaffName",StaffName);
       window.location.href = "staff-staffAttendanceDetail";
       
    }

</script>