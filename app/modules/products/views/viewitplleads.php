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
                                View ITPL Leads
                            </div>
                        </div>
                        <div class="modal fade" id="modal-lg">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">View  ITPL Leads</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="Name">Name </label>
                                                        <input type="text" id="Name" class="form-control" placeholder="Person Name" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="SchoolGroupName">School /GroupName </label>
                                                        <input type="text" id="SchoolGroupName" class="form-control" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="ContactNo">Contact no</label>
                                                        <input type="text" id="ContactNo" class="form-control" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="Email">Email</label>
                                                        <input type="text" id="Email" class="form-control" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="Role">Role</label>
                                                        <input type="text" id="Role" class="form-control" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="IPAddress">IPAddress</label>
                                                        <input type="text" id="IPAddress" class="form-control" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="DeviceInfo">DeviceInfo</label>
                                                        <textarea name="" id="DeviceInfo" class="form-control" autocomplete="off"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="btnSave">Save </button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Contact</th>
                                        <th scope="col">EmailID</th>
                                        <th scope="col">Title Name</th>
                                        <th scope="col">Description</th>

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
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Summernote -->

<script src="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.js"></script>
<script src="assets/admin/plugins/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>

<script>
    $(function() {
        //getProducts();  
        getProductItplViewLeads();
    });


    function getProductItplViewLeads() {
        var obj = new Object();
        obj.Module = "Products";
        obj.Page_key = "getProductItplViewLeads";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }


    function clearform() {
        $('#product_name').val('');
        $('#product_code').val('');
        $('#website').val('');
        $('#description').val('');
    }

    function onSuccess(rc) {
        debugger;

        if (rc.return_code) {
            switch (rc.Page_key) {

                case "updateViewLeads":
                    notify("success", rc.return_data);
                    break;

                case "deleteProducViewLeads":
                    notify("success", rc.return_data);
                    break;

                case "getProductItplViewLeads":
                    debugger;
                    loaddata(rc.return_data);
                    break;

                default:
                    notify("error", rc.Page_key);
            }
        } else {
            notify("error", rc.return_data);
        }

    }

    function loaddata(data) {

        var table = $("#table");

        try {
            if ($.fn.DataTable.isDataTable($(table))) {
                $(table).DataTable().destroy();
            }
        } catch (ex) {}

        var text = ""

        if (data.length == 0) {
            text += "No Data Found";
        } else {

            for (let i = 0; i < data.length; i++) {
                text += '<tr> ';
                text += '<th> ' + data[i].Name + '</th>';
                text += '<td> ' + data[i].Contact + '</td>';
                text += '<td> ' + data[i].EmailID + '</td>';
                text += '<td> ' + data[i].TitleName + '</td>';
                text += '<td> ' + data[i].Description + '</td>';

                // //text += '<td> ' + new Date(data[i].CreatedDateTime).toLocaleDateString() + '</td>';
                // text += '<td class="btn-group btn-group-sm">';
                // text += ' <a class="btn btn-info btn-sm text-white" onclick="onEdit(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fas fa-pencil-alt"> </i> </a>';
                // text += ' <a class="btn btn-danger btn-sm text-white" onclick="onDelete(' + data[i].LeadsID + ')"> <i class="fas fa-trash"> </i> </a>';
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

    $("#btnSave").click(function() {
        let obj = {};
        obj.Module = "Products";
        obj.Page_key = "updateViewLeads";
        let json = {};
        json.Name = $("#Name").val();
        json.SchoolGroupName = $("#SchoolGroupName").val();
        json.ContactNo = $("#ContactNo").val();
        json.Email = $("#Email").val();
        json.Role = $("#Role").val();
        json.IPAddress = $("#IPAddress").val();
        if (code != null) {
            json.LeadsID = code;
        }
        obj.JSON = json;
        console.log(JSON.stringify(obj));
        console.log(json.LeadsID);
        TransportCall(obj);
    });

    var code = null;

    function onEdit(data) {
        data = JSON.parse(unescape(data));
        $("#SchoolGroupName").val(data.SchoolGroupName);
        $("#Name").val(data.Name);
        $("#ContactNo").val(data.ContactNo);
        $("#Email").val(data.Email);
        $("#Role").val(data.Role);
        $("#IPAddress").val(data.IPAddress);
        $("#DeviceInfo").val(data.DeviceInfo);
        mode = 2;
        code = data.LeadsID;
        $("#modal-lg").modal("show");
    }

    function onDelete(LeadsID) { //added  by dev on 07/11/23
        if (confirm("Are you sure you want to delete")) {
            let obj = {};
            obj.Module = "Products";
            let json = {};
            obj.Page_key = "deleteProducViewLeads";
            json.LeadsID = LeadsID;
            obj.JSON = json;
            TransportCall(obj);
        }
    }
</script>