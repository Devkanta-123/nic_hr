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
                                Staff Salary Settings

                            </div>
                            <!-- <span class="float-right">
                                <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-lg"> <i class="fa fa-circle-thin"> <i class="fa fa-plus"></i> </i> Staff Salary Settings</button>
                            </span> -->
                        </div>
                        <!-- Add Training Type Modal -->
                        <div class="modal fade" id="modal-lg">
                            <div class="modal-dialog modal-xs">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Staff Salary Settings</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-body text-center">
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="training_name">Staff</label>
                                                        <select class="form-control" id="staffs">
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="net_amount">Net Amount</label>
                                                        <input type="number" id="net_amount" class="form-control" placeholder="Net Amount" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="earning">Earning </label>
                                                        <input type="number" id="earning" class="form-control" placeholder="Earning" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="deduction">Deduction </label>
                                                        <input type="number" id="deduction" class="form-control" placeholder="Deduction" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary btn-xs" id="btnAddStaffSalarySettings">Save </button>
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
                                        <h4 class="modal-title">Edit Salary Settings</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-body text-center">
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="editnetamount">Net Amount</label>
                                                        <input type="text" id="editnetamount" class="form-control" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="editearning">Earning</label>
                                                        <input type="text" id="editearning" class="form-control" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="editdeduction">Deduction</label>
                                                        <input type="text" id="editdeduction" class="form-control" autocomplete="off">
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
                                        <th scope="col">Staff Name</th>
                                        <th scope="col">Net Amount</th>
                                        <th scope="col">Earning </th>
                                        <th scope="col">Deduction</th>
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
        getStaff();
        getAllStaffSalary();
    });


    function getStaff() {
        var obj = new Object();
        obj.Module = "Staff";
        obj.Page_key = "getStaff";
        var json = new Object();
        obj.JSON = json;
        SilentTransportCall(obj);
    }


    function getAllStaffSalary() {
        var obj = new Object();
        obj.Module = "Staff";
        obj.Page_key = "getAllStaffSalary";
        var json = new Object();
        obj.JSON = json;
        SilentTransportCall(obj);
    }


    function onSuccess(rc) {

        if (rc.return_code) {
            switch (rc.Page_key) {

                case "addStaffSalarySettings":
                    notify("success", rc.return_data);
                    $("#modal-lg").modal("hide");
                    getAllStaffSalary();
                    break;
                case "getAllStaffSalary":
                    loaddata(rc.return_data);
                    break;

                case "editSalaryHead":
                    notify("success", rc.return_data);
                    getAllStaffSalary();
                    $("#EditModal").modal("hide");
                    break;

                case "getStaff":
                    loadSelect("#staffs", rc.return_data);
                    break;

                case "updateSalarySettings":
                    notify("success", rc.return_data);
                    getAllStaffSalary();
                    $("#EditModal").modal("hide");
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
        console.log(data);
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
                text += '<td> ' + data[i].StaffName + '</td>';
                text += '<td> ' + data[i].NetAmount + '</td>';
                text += '<td> ' + data[i].Earning + '</td>';
                text += '<td style="color:red;"> ' + data[i].Deduction + '</td>';
                // text += '<td>';
                // if (data[i].isActive == 1) {
                //     text += '<span class="badge badge-success">  Active </button>';
                // } else {
                //     text += '<span class="badge badge-danger">Not Active</button>';
                // }
                text += '</td>';
                text += '<td class="btn-group btn-group-sm">';
                // text += ' <a class="btn btn-info btn-sm text-white" title="Edit Staff" onclick="onEdit(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fas fa-pen"> </i> </a>';
                text += ' <a   class="btn btn-danger btn-sm text-white" title="GenerateSlip" onclick="Redirect(' + data[i].StaffID + ',' + data[i].Payroll_StaffSalaryID + ')"> <i class="fas fa-print"></i></a>';
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

    var Payroll_Settings_StaffSalaryID, StaffID;

    function onEdit(data) {
        debugger;
        Data = JSON.parse(unescape(data));
        $("#editnetamount").val(Data.NetAmount);
        $("#editearning").val(Data.Earning);
        $("#editdeduction").val(Data.Deduction);
        Payroll_Settings_StaffSalaryID = Data.Payroll_Settings_StaffSalaryID;
        StaffID = Data.StaffID;
        $("#EditModal").modal('show');
    }

    function Redirect(staffId, SlipID) {
        debugger;
        window.location = "staff-salaryslip?staff=" + btoa(staffId) + "&SlipID=" + btoa(SlipID);
        debugger;

    }

    $("#editnetamount").change(function() {
        updateSalarySettings("NetAmount", $("#editnetamount").val(), Payroll_Settings_StaffSalaryID, StaffID);
    });


    $("#editearning").change(function() {
        updateSalarySettings("Earning", $("#editearning").val(), Payroll_Settings_StaffSalaryID, StaffID)
    });

    $("#editdeduction").change(function() {
        updateSalarySettings("Deduction", $("#editdeduction").val(), Payroll_Settings_StaffSalaryID, StaffID)
    });




    function updateSalarySettings(column, data, ID, StaffID) {
        debugger;
        var obj = {};
        obj.Module = "Staff";
        var json = {};
        obj.Page_key = "updateSalarySettings";
        json.Column = column;
        json.Data = data;
        json.Payroll_Settings_StaffSalaryID = ID;
        json.StaffID = StaffID;
        obj.JSON = json;
        SilentTransportCall(obj);
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



    $("#btnAddStaffSalarySettings").click(function() {
        debugger;
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "addStaffSalarySettings";
        let json = {};
        json.StaffID = $("#staffs").val();
        json.NetAmount = $("#net_amount").val();
        json.Earning = $("#earning").val();
        json.Deduction = $("#deduction").val();
        obj.JSON = json;
        SilentTransportCall(obj);
    });
</script>