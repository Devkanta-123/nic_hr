<?php require_once(VIEWPATH . "/basic/header.php"); ?>
<?php require_once(VIEWPATH . "/basic/sidebar.php"); ?>

<link href="assets/js/plugins/icheck-bootstrap/icheck-bootstrap.min.css" rel="stylesheet">
<style>
    /* Custom CSS for smaller buttons */
    .custom-smaller-btn {
        padding: 0.1rem 0.5rem;
        font-size: 0.76rem;
        border-radius: 6px;
        background-color: #F3F3F3; 
        color: black; 
        display: inline-block; 
        border: none;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Server data
                        </div>
                            <span class="float-right">
                                <button class="btn btn-success" data-toggle="modal" data-target="#modal-lg"> <i class="fa fa-circle-thin"> <i class="fa fa-plus"></i> </i>Add Department</button>
                            </span>
                        <div class="modal fade" id="modal-lg">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add New Department </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-body text-center">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="server_name">Department Code:</label>
                                                        <input type="text" id="deptCode" class="form-control" placeholder="Department Code.." autocomplete="off" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="ip_address">Department Name:</label>

                                                        <input type="text" id="deptName" class="form-control" placeholder="Department Name.." autocomplete="off" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body text-center">

                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="btnAddDept">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <script type="text/javascript">
                        $("#btnAddServer").click(function() {
                            function check_number(num) {
                                if (isNaN(num)) {
                                    alert("Error !! Please enter a number");
                                    Exit();
                                }

                            }
                        });
                    </script>
                    <!-- card for table  -->
                    <div class="card-body">
                        <table id="table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Department Name</th>
                                    <th scope="col">Employee Name</th>
                                    <!-- <th scope="col">Action</th> -->

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
        getDepartment();

    });

    // function clearform() {
    //     $('#server_name').val('');

    // }

    function getDepartment() {
        var obj = new Object();
        obj.Module = "Settings";
        obj.Page_key = "getDepartment";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }



    function onSuccess(rc) {

        if (rc.return_code) {
            switch (rc.Page_key) {
                case "getDepartment":
                    loaddata(rc.return_data);
                    console.log(rc.return_data);
                    break;

                case "addDepartment":
                    notify('success', rc.return_data);
                    location.reload();
                    break;

                case "onDepartmentDelete":
                    notify('success', rc.return_data);
                    $('#deldept'+deptid_var).remove();

                    break;

                case "onUserDelete":
                    notify('success', rc.return_data);
                   $('#delbtn'+staffid_var).remove();
                    break;

                default:
                    alert(rc.Page_key);
            }
        } else {
            alert(rc.return_data);
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
        for (let i = 0; i < data.length; i++) {
            let staffIDParts = data[i].StaffID.split(',');
            let staffNameParts = data[i].StaffName.split(',');
            text += '<tr>';
            text += '<th><button class="btn btn-danger btn-sm " onclick="onDepartmentDelete(' + data[i].DepartmentID + ')"><i class="fa fa-trash"> </i></button> &nbsp;&nbsp;' + data[i].DepartmentName + '</th>';
            text += '<td>';

            // Loop through each part of the Staff ID
            for (let j = 0; j < staffIDParts.length; j++) {
                text += ' <span class="badge badge-info" id="delbtn' + staffIDParts[j] + '" >' + staffNameParts[j];
                text += '&nbsp;&nbsp;<span style="color:black; cursor:pointer;" onclick="onUserDelete(' + staffIDParts[j] + ')">&times;</span> </span>';
            }
            text += '</td>';
            text += '</tr>';
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

    $("#btnAddDept").click(function() {
        let obj = {};
        obj.Module = "Settings";
        obj.Page_key = "addDepartment";
        let data = {};
        data.DeptCode = $("#deptCode").val();
        data.DeptName = $("#deptName").val();
        obj.JSON = data;
        console.log(JSON.stringify(obj));
        TransportCall(obj);
    });



    var deptid_var=0;
    function onDepartmentDelete(DepartmentID) //added by dev on 5/12/23
    {
        if (confirm("Are you sure you want to delete")) {
            deptid_var = DepartmentID;
            let obj = {};
            obj.Module = "Settings";
            let json = {};
            obj.Page_key = "onDepartmentDelete";
            json.DepartmentID = DepartmentID;
            console.log(DepartmentID);
            obj.JSON = json;
            TransportCall(obj);
        }
    }


    var staffid_var=0;
    function onUserDelete(StaffID) //added by dev on 5/12/23
    {
        if (confirm("Are you sure you want to delete")) {
            staffid_var=StaffID;
            let obj = {};
            obj.Module = "Settings";
            let json = {};
            obj.Page_key = "onUserDelete";
            json.StaffID = StaffID;
            console.log(StaffID);
            obj.JSON = json;
            TransportCall(obj);
        }
    }
</script>