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
                                <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-lg"> <i class="fa fa-circle-thin"> <i class="fa fa-plus"></i> </i>Add New Warning </button>
                            </span>
                        </div>

                        <div class="modal fade" id="modal-lg">
                            <div class="modal-dialog modal-xs">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add Warning</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-body text-center">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="staffid"> Staff</label>
                                                        <select id="staffid" class="form-control">
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="warningtypesid">Warning Types</label>
                                                        <select id="warningtypesid" class="form-control">

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="warning_date">Warning Date</label>
                                                        <input type="date" id="warning_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">


                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="remarks">Warning By :  </label>
                                                        <select id="warnedbystaffid" class="form-control">
                                                        </select>
                                                    </div>
                                                </div> -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="remarks">Remarks </label>
                                                        <textarea id="remarks" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="row">
                                           
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary btn-xs" id="btnAddWarningStaff">Save </button>
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
                                        <th scope="col">Staff</th>
                                        <th scope="col">Warning Type</th>
                                        <th scope="col">Warning Date</th>
                                        <th scope="col">Description</th>
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
        getAllStaffs();
        getAllWarnings();
    });



    function getAllStaffs() {
        var obj = new Object();
        obj.Module = "Staff";
        obj.Page_key = "getStaff";
        var json = new Object();
        obj.JSON = json;
        SilentTransportCall(obj);
    }


    function getAllWarningTypes() {
        var obj = new Object();
        obj.Module = "Settings";
        obj.Page_key = "getAllWarningTypes";
        var json = new Object();
        obj.JSON = json;
        SilentTransportCall(obj);
    }

    function getAllWarnings() {
        debugger;
        var obj = new Object();
        obj.Module = "Staff";
        obj.Page_key = "getAllWarnings";
        var json = new Object();
        obj.JSON = json;
        SilentTransportCall(obj);
    }



    function onSuccess(rc) {

        if (rc.return_code) {
            switch (rc.Page_key) {

                case "addWarningStaff":
                    notify("success", rc.return_data);
                    $("#modal-lg").modal("hide");
                    getAllWarnings();
                    break;

                case "getAllWarningTypes":
                    loadSelect("#warningtypesid", rc.return_data);
                    break;

                case "getStaff":
                    loadSelect("#staffid,#warnedbystaffid", rc.return_data);
                    break;

                case "getAllWarnings":
                    loaddata(rc.return_data);
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



    $("#btnAddWarningStaff").click(function() {
        debugger;
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "addWarningStaff";
        let json = {};
        json.WarningForStaffID = $("#staffid").val();
        json.WarningTypeID = $("#warningtypesid").val();
        json.WarningDate = $("#warning_date").val();
        json.Remarks = $("#remarks").val();
        json.WarningByStaffID = $("#warnedbystaffid").val();
        obj.JSON = json;
        TransportCall(obj);
    });


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
                text += '<td> ' + data[i].StaffName + '</td>';
                text += '<td> ' + data[i].WarningType + '</td>';
                text += '<td> ' + data[i].WarningDate + '</td>';
                text += '<td> ' + data[i].Remarks + '</td>';

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
</script>