    <!-- summernote -->
    <link rel="stylesheet" href="assets/admin/plugins/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.css">

    <link rel="stylesheet" href="assets/admin/plugins/bootstrap-toggle-master/css/bootstrap-toggle.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .customtext {
            height: 40%;
            position: absolute;
            top: 50%;
            right: 35px;
            font-size: 12px;
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
                                    Grievance Category
                                </div>
                                <span class="float-right">
                                    <button class="btn btn-success" data-toggle="modal" data-target="#modal-lg"> <i class="fa fa-circle-thin"> <i class="fa fa-plus"></i> </i>Add Grievance Category</button>
                                </span>
                                <div class="modal fade" id="modal-lg">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"> Add Grievance Category</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="productModule">Grievance Category</label>
                                                                <input type="text" id="GrievanceCategory" class="form-control" placeholder="Grievance Category" autocomplete="off">
                                                            </div>


                                                        </div>

                                                        <!-- inputField -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="CategoryLevels">Category Level</label>
                                                                <select id="CategoryLevels" class="form-control" name="">
                                                                </select>

                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="row" id="divgrievancecategorylevels">
                                                        <!-- Load Dropdown depend on Selected Value of Category -->

                                                    </div>



                                                    <div class="form-group" id="subcategoryDiv" style="display: none;">
                                                        <label for="subscategory">Select Category :</label>
                                                        <select id="subscategory" class="form-control" name="">
                                                        </select>

                                                    </div>


                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="ResolutionLevel1">Resolution Level 1</label>
                                                                <input type="number" id="ResolutionLevel1" class="form-control" autocomplete="off">
                                                                <span class="customtext">(in days)</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="ResolutionLevel2">Resolution Level 2</label>
                                                                <input type="number" id="ResolutionLevel2" class="form-control" autocomplete="off">
                                                                <span class="customtext">(in days)</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="ResolutionLevel3">Resolution Level 3</label>
                                                                <input type="number" id="ResolutionLevel3" class="form-control" autocomplete="off">
                                                                <span class="customtext">(in days)</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" id="AddCategory">Save </button>
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
                                            <th scope="col">Category Name</th>
                                            <th scope="col">Resolution Level 1</th>
                                            <th scope="col">Resolution Level 2</th>
                                            <th scope="col">Resolution Level 3</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->

                       
                            <div class="modal fade" id="showdepartment-list">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"> Department List </h4>
                                            <span class="float-right">
                                                <button class="btn btn-success" data-toggle="modal" data-target="#add-department"> <i class="fa fa-circle-thin"> <i class="fa fa-plus"></i> </i>Add Department</button>
                                            </span>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body text-center">
                                                <div class="row">
                                                    <div class="card-body">
                                                        <table id="departmenttable" class="table table-bordered table-striped" style="width: 100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Department Name</th>
                                                                    <th scope="col">Employee Name</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                                <div class="card-body text-center">
                                                </div>
                                              
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                            </div>


                                 <!-- add department form -->
                                 <div class="modal fade" id="add-department">
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
                            <!-- /add department form ends here -->
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
    <script type="text/javascript">
    </script>
    <script>
        $(function() {
            getCategoryLevel();
            getCategoryList();
            getDepartment();
        });

        function getCategoryLevel() {
            var obj = new Object();
            obj.Module = "SupportTicket";
            obj.Page_key = "getAllCategoryLevel";
            var json = new Object();
            obj.JSON = json;
            TransportCall(obj);
        }


        function onSuccess(rc) {
            if (rc.return_code) {
                switch (rc.Page_key) {

                    case "getAllCategoryLevel":
                        loadSelect("#CategoryLevels", rc.return_data);
                        break;

                    case "getZeroLevelCategory":
                        var selectedLevel = $("#CategoryLevels").val();
                        var loadSelectBasedOnLevelID = '<div class="col-md-4"><label>Select Category:</label></div>';
                        $('#divgrievancecategorylevels').append(loadSelectBasedOnLevelID);
                        var subcategories = rc.return_data;
                        var selectDropdown = $('<select>').addClass('form-control');
                        selectDropdown.append($('<option>').text('Select Category'));

                        $.each(subcategories, function(index, subcategory) {
                            selectDropdown.append($('<option id="UnderCategoryIds">').text(subcategory.CategoryLevelName).val(subcategory.CategoryLevelIDs));

                        });

                        $('#divgrievancecategorylevels').append(selectDropdown);

                        selectDropdown.on('change', function() {
                            debugger;
                            var selectedSubcategoryId = $(this).val();
                            if (selectedSubcategoryId == "0") {
                                $('#subcategoryDiv').hide();
                            }
                            else{
                                getLevelOneCategory(selectedSubcategoryId);
                            }
                        });

                        break;

                    case "getLevelOneCategory":
                        loadSelect("#subscategory", rc.return_data);
                        $('#subcategoryDiv').show();
                        break;

                    case "getCategoryList":
                        loaddata(rc.return_data);
                        break;

                    case "addGrievanceCategory":
                        $("#modal-lg").modal("hide");
                        getCategoryList();
                        clearform();
                        break;

                    case "getDepartment":
                        console.log(rc.return_data);
                        loaddepartmentdata(rc.return_data);
                        break;

                    case "addDepartment":
                        notify('success', rc.return_data);
                        location.reload();
                        break;

                    case "onDepartmentDelete":
                        notify('success', rc.return_data);
                        $('#deldept' + deptid_var).remove();

                        break;

                    case "onUserDelete":
                        notify('success', rc.return_data);
                        $('#delbtn' + staffid_var).remove();
                        break;

                    default:
                        notify("error", rc.Page_key);
                }
            } else {
                notify("error", rc.return_data);
            }
        }


        $('#CategoryLevels').on('change', function() {
            var selectedLevel = $("#CategoryLevels").val();
            $('#divgrievancecategorylevels').empty();
            getZeroLevelCategory(selectedLevel);

        });


        $("#AddCategory").click(function() {
            debugger;
            let obj = {};
            obj.Module = "SupportTicket";
            obj.Page_key = "addGrievanceCategory";
            let json = {};
            json.GrievanceCategory = $("#GrievanceCategory").val();
            json.CategoryLevel = $("#CategoryLevels").val();
            json.UnderCategoryID = $("#UnderCategoryIds").val();
            json.ResolutionLevel1 = $("#ResolutionLevel1").val();
            json.ResolutionLevel2 = $("#ResolutionLevel2").val();
            json.ResolutionLevel3 = $("#ResolutionLevel3").val();
            obj.JSON = json;
            if ($("#GrievanceCategory").val() == '' || $("#ResolutionLevel1").val() == '' || $("#ResolutionLevel2").val() == '' || $("#ResolutionLevel3").val() == '' || $("#CategoryLevels").val() == '' || $("#UnderCategoryIds").val() == '') { //check empty fields
                notify("error", "All Fields are Required");
            } else {
                TransportCall(obj);
            }

        });



        function clearform() {
            $('#GrievanceCategory').val('');
            $('#CategoryLevels').val('');
            $('#UnderCategoryIds').val('');
            $('#ResolutionLevel1').val('');
            $('#ResolutionLevel2').val('');
            $('#ResolutionLevel3').val('');
        }


        function getCategoryList() {

            var obj = new Object();
            obj.Module = "SupportTicket";
            obj.Page_key = "getCategoryList";
            var json = new Object();
            obj.JSON = json;
            TransportCall(obj);
        }

        function getZeroLevelCategory(selectedLevel) {
            debugger;
            let obj = {};
            obj.Module = "SupportTicket";
            let json = {};
            obj.Page_key = "getZeroLevelCategory";
            json.CategoryLevels = selectedLevel; // Pass the selectedLevel value
            // console.log(selectedLevel);
            obj.JSON = json;
            TransportCall(obj);
        }

        function getLevelOneCategory(selectedSubcategoryId) {
            debugger;
            let obj = {};
            obj.Module = "SupportTicket";
            let json = {};
            obj.Page_key = "getLevelOneCategory";
            json.SubCategoryLevels = selectedSubcategoryId; // Pass the selectedLevel value
            obj.JSON = json;
            TransportCall(obj);
        }

        function getDepartment() {
            var obj = new Object();
            obj.Module = "Settings";
            obj.Page_key = "getDepartment";
            var json = new Object();
            obj.JSON = json;
            TransportCall(obj);
        }



        function onLoadDepartment() //added by dev on 11/12/23
        {
            $("#showdepartment-list").modal("show");
          
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
    function onDepartmentDelete(DepartmentID) //added by dev on 11/12/23
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
    function onUserDelete(StaffID) //added by dev on 11/12/23
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
                text += "No Data Found";
            } else {

                for (let i = 0; i < data.length; i++) {
                    text += '<tr> ';
                    text += '<th> ' + data[i].GrievanceCategory + '</th>';
                    text += '<td> ' + data[i].ResolutionLevel1 + ' days</td>';
                    text += '<td>' + data[i].ResolutionLevel2 + ' days</td>';
                    text += '<td> ' + data[i].ResolutionLevel3 + ' days</td>';
                    text += '<td class="btn-group btn-group-sm">';
                    text += '   <a  onclick="onLoadDepartment(' + data[i].GrievanceCategoryID + ')"> <i class="fas fa-building"> </i> </a>';
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


        function loaddepartmentdata(data) {
            var table = $("#departmenttable");

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


            $("#departmenttable tbody").html("");
            $("#departmenttable tbody").append(text);

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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>