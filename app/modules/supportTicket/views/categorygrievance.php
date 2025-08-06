<!--   
       CreatedBy: Devkanta
       Created On: 05/12/2023
       Modified On:     
    -->
<link rel="stylesheet" href="assets/admin/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.css">
<link rel="stylesheet" href="assets/admin/plugins/bootstrap-toggle-master/css/bootstrap-toggle.min.css">
<style>
    .customtext {
        height: 40%;
        position: absolute;
        top: 50%;
        right: 35px;
        font-size: 12px;
    }

    .badge-extra {
        background-color: #007F73;
        /* Change to your desired background color */
        color: #fff;
        /* Change to your desired text color */
        border-radius: 10px;
        /* Adjust the border-radius for rounding */
        padding: 5px 10px;
    }


    .badge-danger {
        background-color: #F7418F;
        /* Change to your desired background color */
        color: #fff;
        /* Change to your desired text color */
        border-radius: 10px;
        /* Adjust the border-radius for rounding */
        padding: 5px 10px;
    }

    .badge-info {
        background-color: #7469B6;
        /* Change to your desired background color */
        color: #fff;
        /* Change to your desired text color */
        border-radius: 10px;
        /* Adjust the border-radius for rounding */
        padding: 5px 10px;
    }

    .btn-custom {
        /* Add rounded corners */
        border-radius: 30px;

        /* Add shadow */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);

        /* Set background color to white */
        background-color: #2D9596;

        border: none;
        color: #3498db;
        /* Change text color to a contrasting color */
        padding: 6px 12px;
        /* Adjust padding for a smaller button */
        color: white;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        /* Adjust font size for a smaller button */
        cursor: pointer;
    }

    .custom-form-control {
        border-radius: 20px;
        /* Adjust the value as needed for the desired roundness */
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        /* Adjust the values for shadow size and color as needed */
        padding: 10px;
        /* Adjust the value for padding as needed */
        font-size: 16px;
        /* Adjust the value for font size as needed */
        background-color: #f9f9f9;
        /* Adjust the background color as needed */
        border: 2px solid #ddd;
        /* Adjust the border properties as needed */
        width: 300px;
        /* Adjust the width as needed */
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
                                <button class="btn btn-success" data-toggle="modal" data-target="#modal-lg"> <i class="fa fa-circle-thin"> <i class="fa fa-plus"></i> </i>Add Grievance
                                    Category</button>
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
                                                            <select class="form-control" id="CategoryLevels">
                                                            </select>

                                                        </div>

                                                    </div>
                                                </div>


                                                <div class="row" id="subcategory">

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
                                            <button type="button" class="btn btn-primary" id="AddCategory">Save
                                            </button>
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
                                        <th scope="col">Category </th>
                                        <th scope="col">Sub Category </th>
                                        <th scope="col">Resolution Level 1</th>
                                        <th scope="col">Resolution Level 2</th>
                                        <th scope="col">Resolution Level 3</th>
                                        <th id="action">Action</th>
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
                        <!-- Assign Category Grievances to Department -->
                        <div class="modal fade" id="getdepartment-list">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <p class="modal-title" id="DisplayCategoryName"></p>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-body text-center">
                                            <div class="row">
                                                <div class="col-md-12">



                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="getdepartmentlist1">Resolution Level 1 Department</label>
                                                        <select id="getdepartmentlist1" class="custom-form-control">
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="getstaffsLevel1">Resolution Level 1 Staff:</label>
                                                        <select id="getstaffsLevel1" class="form-control js-example-basic-multiple" multiple>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="getdepartmentlist2">Resolution Level 2 Department</label>
                                                        <select id="getdepartmentlist2" class="custom-form-control">
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="getstaffsLevel2">Resolution Level 2 Staff:</label>
                                                        <select id="getstaffsLevel2" class="form-control js-example-basic-multiple" multiple>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="getdepartmentlist3">Resolution Level 3 Department</label>
                                                        <select id="getdepartmentlist3" class="custom-form-control">
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="getstaffsLevel3">Resolution Level 3 Staff:</label>
                                                        <select id="getstaffsLevel3" class="form-control js-example-basic-multiple" multiple>
                                                        </select>
                                                    </div>
                                                </div>
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
                            <!-- Assign Category Grievances to Department ends here -->
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
        getDepartmentForAssignGrievanceCategory();
    });

    function getCategoryLevel() {
        var obj = new Object();
        obj.Module = "SupportTicket";
        obj.Page_key = "getAllCategoryLevel";
        var json = new Object();
        obj.JSON = json;
        SilentTransportCall(obj);
    }
    var nextSelectID;

    function getNextLevelCategory(selectid, UnderCategoryID) {
        nextSelectID = selectid;
        var obj = new Object();
        obj.Module = "SupportTicket";
        obj.Page_key = "getNextLevelCategory";
        var json = new Object();
        json.UnderCategoryID = UnderCategoryID;
        json.NextSelectBoxID = selectid;
        obj.JSON = json;
        SilentTransportCall(obj);

    }

    function onSuccess(rc) {
        if (rc.return_code) {
            switch (rc.Page_key) {

                case "getAllCategoryLevel":
                    loadSelect("#CategoryLevels", rc.return_data);
                    break;

                case "getZeroLevelCategory":
                    var groupedData = {};
                    var GrievanceCategoryID, GrievanceCategory, CategoryLevel;
                    for (var j = 0; j < rc.return_data.length; j++) {
                        GrievanceCategoryID = rc.return_data[j].GrievanceCategoryID;
                        GrievanceCategory = rc.return_data[j].GrievanceCategory;
                        CategoryLevel = rc.return_data[j].CategoryLevel;

                        if (!groupedData[CategoryLevel]) {
                            groupedData[CategoryLevel] = [];
                        }
                        groupedData[CategoryLevel].push({
                            id: GrievanceCategoryID,
                            value: GrievanceCategory,
                            level: CategoryLevel
                        });
                    }

                    // Build dropdowns
                    var text = "";
                    for (var key in groupedData) {
                        if (groupedData.hasOwnProperty(key)) {
                            text += '<div class="col-md-6">';
                            text += ' <label for="server_name">Select Next Level Category:</label>'
                            text += '<select class="form-control categorySelect"  id="cat-' + groupedData[key][0].level + '" data-level="' + groupedData[key][0].level + '">';
                            text += '<option  value="-1"> Select Category</option>';
                            if (key == 0) {
                                for (var i = 0; i < groupedData[key].length; i++) {
                                    text += '<option   id = "GrievanceCategoryID"  value="' + groupedData[key][i].id + '">' + groupedData[key][i].value +
                                        '</option>';
                                }
                            }
                            text += '</select>';
                            text += '<br>';
                            text += '</div>';
                        }
                    }

                    // Append to the element with ID "subcategory"
                    $("#subcategory").empty().append(text);
                    $('.categorySelect').change(function() {
                        nextCat = parseInt($(this).attr("data-level")) + 1;
                        getNextLevelCategory('#cat-' + nextCat, this.value)
                    });
                    break;

                case "getNextLevelCategory":
                    loadSelect(nextSelectID, rc.return_data);
                    break;


                case "getCategoryList":
                    //console.log(rc.return_data);
                    loaddata(rc.return_data);
                    break;

                case "addGrievanceCategory":
                    $("#modal-lg").modal("hide");
                    notify("success", rc.return_data);
                    $("#getdepartment-list").modal("hide");
                    location.reload();
                    break;

                case "AssignCategory":
                    notify("success", rc.return_data);
                    //getCategoryList();
                    //$("#getdepartment-list").modal("hide");
                    break;

                case "getDepartment":
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

                    // Declare selectedDepartmentID in a broader scope
                case "getDepartmentForAssignGrievanceCategory":
                    var selectedDepartmentID;
                    loadSelect("#getdepartmentlist1", rc.return_data);
                    loadSelect("#getdepartmentlist2", rc.return_data);
                    loadSelect("#getdepartmentlist3", rc.return_data);
                    $('#getdepartmentlist1').on('change', function() {
                        selectedDepartmentID = $(this).val(); // Assign value to selectedDepartmentID
                        getEmployeeByDepartmentID(selectedDepartmentID, "#getstaffsLevel1");
                    });
                    $('#getdepartmentlist2').on('change', function() {
                        selectedDepartmentID = $(this).val(); // Assign value to selectedDepartmentID
                        getEmployeeByDepartmentID(selectedDepartmentID, "#getstaffsLevel2");
                    });
                    $('#getdepartmentlist3').on('change', function() {
                        selectedDepartmentID = $(this).val(); // Assign value to selectedDepartmentID
                        getEmployeeByDepartmentID(selectedDepartmentID, "#getstaffsLevel3");
                    });
                    break;

                case "getEmployeeByDepartmentID":
                    var selectedStaffsID = null;
                    // Here, you can use selectedDepartmentID
                    loadSelect(ResolutionLevelStaffLblID, rc.return_data);
                    $(ResolutionLevelStaffLblID).on('change', function() {
                        selectedStaffsID = $(this).val();

                    });
                    break;

                default:
                    notify("error", rc.Page_key);
            }
        } else {
            notify("error", rc.return_data);
        }
    }


    var selectedLevel = "";
    $('#CategoryLevels').on('change', function() {
        selectedLevel = $("#CategoryLevels").val();
        getZeroLevelCategory(selectedLevel);

    });

    $("#AddCategory").click(function() {
        debugger;
        underCategoryID = $("#cat-" + (parseInt($("#CategoryLevels").val()) - 1) + " :selected").val();
        let obj = {};
        obj.Module = "SupportTicket";
        obj.Page_key = "addGrievanceCategory";
        let json = {};
        json.GrievanceCategory = $("#GrievanceCategory").val();
        json.CategoryLevel = $("#CategoryLevels").val();
        json.UnderCategoryID = underCategoryID;
        json.ResolutionLevel1 = $("#ResolutionLevel1").val();
        json.ResolutionLevel2 = $("#ResolutionLevel2").val();
        json.ResolutionLevel3 = $("#ResolutionLevel3").val();
        obj.JSON = json;

        if (selectedLevel == 0) {
            if ($("#GrievanceCategory").val() == '' || $("#ResolutionLevel1").val() == '' || $("#ResolutionLevel2")
                .val() == '' || $("#ResolutionLevel3").val() == '' || $("#CategoryLevels").val() == '' || $(
                    "#UnderCategoryIds").val() == '') { //check empty fields
                notify("error", "All Fields are Required");
                return;
            } else {
                TransportCall(obj);
            }
        } else if ($("#GrievanceCategory").val() == '' || $("#ResolutionLevel1").val() == '' || $("#ResolutionLevel2")
            .val() == '' || $("#ResolutionLevel3").val() == '' || $("#CategoryLevels").val() == '' || $(
                "#UnderCategoryIds").val() == '') { //check empty fields
            notify("error", "All Fields are Required");

        } else if (underCategoryID == undefined || underCategoryID == -1) { //chances of under category -1 if there are no values or not selected
            notify("error", "Select the Under Category");
            return;
        } else {
           SilentTransportCall(obj);
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
        SilentTransportCall(obj);
    }

    function getZeroLevelCategory(selectedLevel) {
        let obj = {};
        obj.Module = "SupportTicket";
        let json = {};
        obj.Page_key = "getZeroLevelCategory";
        json.CategoryLevels = selectedLevel; // Pass the selectedLevel value
        obj.JSON = json;
        SilentTransportCall(obj);
    }


    function getDepartment() {
        var obj = new Object();
        obj.Module = "SupportTicket";
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
        obj.Module = "SupportTicket";
        obj.Page_key = "addDepartment";
        let data = {};
        data.DeptCode = $("#deptCode").val();
        data.DeptName = $("#deptName").val();
        obj.JSON = data;
        console.log(JSON.stringify(obj));
        TransportCall(obj);
    });

    var deptid_var = 0;

    function onDepartmentDelete(DepartmentID) //added by dev on 11/12/23
    {
        if (confirm("Are you sure you want to delete")) {
            deptid_var = DepartmentID;
            let obj = {};
            obj.Module = "SupportTicket";
            let json = {};
            obj.Page_key = "onDepartmentDelete";
            json.DepartmentID = DepartmentID;
            console.log(DepartmentID);
            obj.JSON = json;
            TransportCall(obj);
        }
    }


    var staffid_var = 0;

    function onUserDelete(StaffID) //added by dev on 11/12/23
    {
        if (confirm("Are you sure you want to delete")) {
            staffid_var = StaffID;
            let obj = {};
            obj.Module = "SupportTicket";
            let json = {};
            obj.Page_key = "onUserDelete";
            json.StaffID = StaffID;
            console.log(StaffID);
            obj.JSON = json;
            TransportCall(obj);
        }
    }


    function loaddata(data) {
        console.log(data);
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
                let staffIDParts1 = [];
                let staffIDParts2 = [];
                let staffIDParts3 = [];
                let staffNameParts = [];
                let StaffNameResolutionLevel1;
                let StaffNameResolutionLevel2;
                let StaffNameResolutionLevel3;
                if (data[i].StaffIDs !== null && data[i].StaffName !== null) {
                    staffIDParts1 = data[i].StaffIDResolutionLevel1;
                    // staffNameParts = data[i].StaffName.split(',');
                    StaffNameResolutionLevel1 = data[i].StaffNameResolutionLevel1;
                    StaffNameResolutionLevel2 = data[i].StaffNameResolutionLevel2;
                    StaffNameResolutionLevel3 = data[i].StaffNameResolutionLevel3;
                }
                text += '<tr> ';
                let mainCategoryWithArrows = '';
                for (let j = 0; j < data[i].SubCategoryLevelID; j++) {
                    mainCategoryWithArrows += '▶ ';
                }
                mainCategoryWithArrows += data[i].MainCategory;

                text += '<th>' + mainCategoryWithArrows + '</th>';
                if (data[i].SubCategory == null) {
                    text += '<td> <span class=" badge badge-success">No Sub Category </span></td>';
                } else {
                    text += '<th> ' + data[i].SubCategory + '</th>';
                }
                text += '<td> ' + data[i].ResolutionLevel1 + ' days<br><p style="font-size:13px;">Concern Staff : ';
                if (StaffNameResolutionLevel1 == null || StaffNameResolutionLevel1 == undefined) {
                    text += '<span class="badge badge-extra">No data</span>';
                } else {
                    text += '<span class="badge badge-extra">' + StaffNameResolutionLevel1 + '</span>';
                }
                text += '<td> ' + data[i].ResolutionLevel2 + ' days<br><p style="font-size:13px;">Concern Staff : ';
                if (StaffNameResolutionLevel2 == null || StaffNameResolutionLevel2 == undefined) {
                    text += '<span class="badge badge-info">No data</span>';
                } else {
                    text += '<span class="badge badge-info">' + StaffNameResolutionLevel2 + '</span>';
                }
                text += '<td> ' + data[i].ResolutionLevel3 + ' days<br><p style="font-size:13px;">Concern Staff : ';
                if (StaffNameResolutionLevel3 == null || StaffNameResolutionLevel3 == undefined) {
                    text += '<span class="badge badge-danger">No data</span>';
                } else {
                    text += '<span class="badge badge-danger">' + StaffNameResolutionLevel3 + '</span>';
                }
                // text += '<td> ' + data[i].ResolutionLevel3 + 'days<br><p>Manage By: <span class="badge badge-extra">'+staffNameParts[2]+'</span><p></td>';
                text += '<td><a  onclick="onAssign(\'' + escape(JSON.stringify(data[i])) + '\')"> <button class="btn btn-primary btn-xs ml-3">Assign</button></a></td>';
                text += '</td>';
                text += '</tr>';
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





    var ActiveGrievanceCategoryID;

    function onAssign(data) {
        data = JSON.parse(unescape(data));
        var CategoryName = data.CategoryName;
        ActiveGrievanceCategoryID = data.GrievanceCategoryID;
        $("#getdepartmentlist").val(data.DepartmentID);
        $("#DisplayCategoryName").text(CategoryName);
        // $("#getstaffsLevel1").val(data.StaffIDResolutionLevel1);
        // getEmployeeByDepartmentID(data.DepartmentID);
        $("#getdepartment-list").modal("show");
    }




    //OnChange Update Department and Staff List
    $("#ResolutionLevelStaffLblID").change(function() {
        AssignCategory("StaffIDResolutionLevel1", $("#ResolutionLevelStaffLblID").val(), ActiveGrievanceCategoryID)
    });
    $("#getstaffsLevel2").change(function() {
        AssignCategory("StaffIDResolutionLevel2", $("#getstaffsLevel2").val(), ActiveGrievanceCategoryID)
    });
    $("#getstaffsLevel3").change(function() {
        AssignCategory("StaffIDResolutionLevel3", $("#getstaffsLevel3").val(), ActiveGrievanceCategoryID)
    });

    $("#getstaffsLevel1").change(function() {
        AssignCategory("StaffIDResolutionLevel1", $("#getstaffsLevel1").val(), ActiveGrievanceCategoryID)
    });





    // loadSelect("#getstaffsLevel1,#getstaffsLevel2,#getstaffsLevel3", rc.return_data);


    function AssignCategory(Column, EditInput, GrievanceCategoryID) {
        debugger;
        var obj = {};
        obj.Module = "SupportTicket";
        var json = {};
        obj.Page_key = "AssignCategory";
        json.Column = Column;
        json.EditInput = EditInput;
        json.GrievanceCategoryID = GrievanceCategoryID;
        obj.JSON = json;
        SilentTransportCall(obj);
    }




    function getDepartmentForAssignGrievanceCategory() {
        let obj = {};
        obj.Module = "SupportTicket";
        let json = {};
        obj.Page_key = "getDepartmentForAssignGrievanceCategory";
        obj.JSON = json;
        TransportCall(obj);

    }

    var ResolutionLevelStaffLblID = "";

    function getEmployeeByDepartmentID(selectedDepartmentID, id) {
        debugger;
        ResolutionLevelStaffLblID = id;
        let obj = {}
        obj.Module = "SupportTicket";
        let json = {};
        obj.Page_key = "getEmployeeByDepartmentID";
        obj.JSON = json;
        json.DepartmentID = selectedDepartmentID;
        SilentTransportCall(obj);

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
            text += '<th><button class="btn btn-danger btn-sm " onclick="onDepartmentDelete(' + data[i].DepartmentID +
                ')"><i class="fa fa-trash"> </i></button> &nbsp;&nbsp;' + data[i].DepartmentName + '</th>';
            text += '<td>';

            // Loop through each part of the Staff ID
            for (let j = 0; j < staffIDParts.length; j++) {
                text += ' <span class="badge badge-info" id="delbtn' + staffIDParts[j] + '" >' + staffNameParts[j];
                text += '&nbsp;&nbsp;<span style="color:black; cursor:pointer;" onclick="onUserDelete(' + staffIDParts[j] +
                    ')">&times;</span> </span>';
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