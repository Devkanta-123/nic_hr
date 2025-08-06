<link href="assets/js/plugins/icheck-bootstrap/icheck-bootstrap.min.css" rel="stylesheet">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">


                    <div class="card">
                        <div class="card-header">

                            <div class="card-title">
                                Salary Head

                            </div>
                            <span class="float-right">
                                <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-lg"> <i class="fa fa-circle-thin"> <i class="fa fa-plus"></i> </i>New Salary Head </button>
                            </span>
                        </div>
                        <!-- Add Training Type Modal -->
                        <div class="modal fade" id="modal-lg">
                            <div class="modal-dialog modal-xs">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add Salary Head </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-body text-center">
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="salary_head">Salary Head <span style="color:red;">*</span></label>
                                                        <input type="text" id="salary_head" class="form-control" placeholder="Salary Head" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="salary_head_alias">Salary Head Alias <span style="color:red;">*</span> </label>
                                                        <input type="text" id="salary_head_alias" class="form-control" placeholder="Salary Head Alias" autocomplete="off" maxlength="5">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="training_name">Salary Head Type <span style="color:red;">*</span> </label>
                                                        <select class="form-control" id="salary_head_type">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary btn-xs" id="btnAddSalaryHead">Save </button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>


                        <!-- Edit Training Type Modal -->
                        <div class="modal fade" id="EditModal">
                            <div class="modal-dialog modal-xs">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Salary Head Type</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-body text-center">
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edithead_name">Salary Head Name</label>
                                                        <input type="text" id="edithead_name" class="form-control" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edithead_aliasname">Salary Head Alais Name</label>
                                                        <input type="text" id="edithead_aliasname" class="form-control" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary btn-xs" id="SaveChanges">Save Changes </button>
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
                                        <th scope="col">Salary Head</th>
                                        <th scope="col">Salary Head Alias</th>
                                        <th scope="col">Status </th>
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
        getSalaryHeadType();
        getAllSalaryHeads();
    });


    function getSalaryHeadType() {
        var obj = new Object();
        obj.Module = "Settings";
        obj.Page_key = "getSalaryHeadType";
        var json = new Object();
        obj.JSON = json;
        SilentTransportCall(obj);
    }


    function getAllSalaryHeads() {
        var obj = new Object();
        obj.Module = "Staff";
        obj.Page_key = "getAllSalaryHeads";
        var json = new Object();
        obj.JSON = json;
        SilentTransportCall(obj);
    }











    function onSuccess(rc) {

        if (rc.return_code) {
            switch (rc.Page_key) {

                case "addSalaryHead":
                    notify("success", rc.return_data);
                    $("#modal-lg").modal("hide");
                    getAllSalaryHeads();
                    break;
                case "getAllSalaryHeads":
                    console.log(rc.return_data);
                    loaddata(rc.return_data);
                    break;

                case "editSalaryHead":
                    notify("success", rc.return_data);
                    getAllSalaryHeads();
                    $("#EditModal").modal("hide");
                    break;




                case "getSalaryHeadType":
                    loadSelect("#salary_head_type", rc.return_data);
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

                text += '<th> ' + (i + 1) + '</th>'; //\'' + escape(JSON.stringify(data[i])) + '\'
                // text += '<td> ' + data[i].Salary_Head + '&nbsp;&nbsp;<span onClick="onEdit(\'' + escape(JSON.stringify(data[i])) + '\')"><i style="cursor:pointer;" class="fas fa-edit"></i></span></td>';
                text += '<td> ' + data[i].Salary_Head + '</td>';
                text += '<td> ' + data[i].Salary_HeadAlias + '</td>';
                text += '<td>';
                if (data[i].isActive == 1) {
                    text += '<span class="badge badge-success">  Active </button>';
                } else {
                    text += '<span class="badge badge-danger">Not Active</button>';
                }
                text += '</td>';
                text += '<td class="btn-group btn-group-sm">';
                text += ' <a class="btn btn-info btn-sm text-white" title="Edit Staff" onclick="onEdit(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fas fa-pen"> </i> </a>';
                // text += '   <a class="btn btn-danger btn-sm text-white" title="Delete Staff"  onclick="onDelete(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fas fa-trash-alt"> </i> </a>';
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

    var SalaryHeadID;

    function onEdit(data) {

        Data = JSON.parse(unescape(data));
        $("#edithead_name").val(Data.Salary_Head);
        $("#edithead_aliasname").val(Data.Salary_HeadAlias);
        SalaryHeadID = Data.Salary_HeadID;
        $("#EditModal").modal('show');
    }

    $("#SaveChanges").click(function() {
        debugger;
        var obj = new Object();
        obj.Module = "Staff";
        obj.Page_key = "editSalaryHead";
        var json = new Object();
        json.SalaryHead = $("#edithead_name").val();
        json.SalaryHeadAlias = $("#edithead_aliasname").val();
        json.SalaryHeadID = SalaryHeadID;
        obj.JSON = json;
        SilentTransportCall(obj);
    });



    $("#btnAddSalaryHead").click(function() {
        debugger;
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "addSalaryHead";
        let json = {};
        json.SalaryHead = $("#salary_head").val();
        json.SalaryHeadAlias = $("#salary_head_alias").val();
        json.SalaryHeadType = $("#salary_head_type").val();
        obj.JSON = json;
        if ($("#salary_head_alias").val() == '' || $("#salary_head_type").val() == '') {
            notify("error", "Please fill all the fields");
            return;
        } else {
            TransportCall(obj);
        }

    });
</script>