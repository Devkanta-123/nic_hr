<?php require_once(VIEWPATH . "/basic/header.php"); ?>
<?php require_once(VIEWPATH . "/basic/sidebar.php"); ?>

<link href="assets/js/plugins/icheck-bootstrap/icheck-bootstrap.min.css" rel="stylesheet">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">

                    <div class="card-header">
                        <div class="card-title">
                            Warning Data
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <span class="float-right">
                                <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-lg"> <i class="fa fa-circle-thin"> <i class="fa fa-plus"></i> </i>New Warning Type</button>
                            </span>
                        </div>
                        <!-- Add Warning Type Modal  -->
                        <div class="modal fade" id="modal-lg">
                            <div class="modal-dialog modal-xs">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add Warning Type</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-body text-center">
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="district_name">Warning Name</label>
                                                        <input type="text" id="warning_name" class="form-control" placeholder="Warning Name" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary btn-xs" id="btnAddWarningType">Save </button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>




                        <!-- Edit Modal  -->

                        <div class="modal fade" id="EditwarningModal">
                            <div class="modal-dialog modal-xs">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Warning Type</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-body text-center">
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="editwarning_name">Warning Name</label>
                                                        <input type="text" id="editwarning_name" class="form-control" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>

                        <!-- card for table  -->
                        <div class="card-body">
                            <table id="table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Warning Type</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

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

<?php require_once(VIEWPATH . "/basic/footer.php"); ?>

<script src="assets/js/plugins/icheck-bootstrap/icheck.min.js"></script>
<!-- Jasny File -->
<script src="assets/js/plugins/jasny-bootstrap.min.js"></script>
<script>
    $(function() {
        getAllWarningTypes();
    });



    function getState() {
        var obj = new Object();
        obj.Module = "Settings";
        obj.Page_key = "getState";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }


    function getAllWarningTypes() {
        var obj = new Object();
        obj.Module = "Settings";
        obj.Page_key = "getAllWarningTypes";
        var json = new Object();
        obj.JSON = json;
        SilentTransportCall(obj);
    }



    function onSuccess(rc) {

        if (rc.return_code) {
            switch (rc.Page_key) {

                case "addWarningTypes":
                    notify("success", rc.return_data);
                    $("#modal-lg").modal("hide");
                    getAllWarningTypes();
                    break;
                case "getAllWarningTypes":
                    console.log(rc.return_data);
                    loaddata(rc.return_data);
                    break;

                case "editWarningType":
                    notify("success", rc.return_data);
                    getAllWarningTypes();
                    break;




                default:
                    notify("error", rc.Page_key);
            }
        } else {
            //alert(rc.return_data);
            notify("error", rc.return_data);
        }
        // alert(JSON.stringify(args));
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

                text += '<th> ' + (i + 1) + '</th>';
                text += '<td> ' + data[i].WarningType + '&nbsp;&nbsp;<span  style="cursor:pointer;" onClick="onEdit(\'' + escape(JSON.stringify(data[i])) + '\')"><i class="fas fa-edit"></span></i></td>';
                text += '<td>';
                if (data[i].isActive == 1) {
                    text += '<span class="badge badge-success">  Active </button>';
                } else {
                    text += '<span class="badge badge-danger">Not Active</button>';
                }
                text += '</td>';
                // text += '<td> ' + data[i].IsActive + '</td>';
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

    var WarningTypeID;

    function onEdit(data) {
        WarningData = JSON.parse(unescape(data));
        WarningTypeID = WarningData.WarningTypeID;
        $("#editwarning_name").val(WarningData.WarningType);
        $("#EditwarningModal").modal("show");
    }

    $("#editwarning_name").change(function() {
        debugger;
        var WarningType = $("#editwarning_name").val();
        var obj = new Object();
        obj.Module = "Settings";
        obj.Page_key = "editWarningType";
        var json = new Object();
        obj.JSON = json;
        json.WarningType = WarningType;
        json.WarningTypeID = WarningTypeID;
        SilentTransportCall(obj);
    });








    $("#btnAddWarningType").click(function() {
        debugger;
        let obj = {};
        obj.Module = "Settings";
        obj.Page_key = "addWarningTypes";
        let json = {};
        json.WarningType = $("#warning_name").val();
        obj.JSON = json;
        TransportCall(obj);
    });
</script>