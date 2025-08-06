<!--   
       CreatedBy: Devkanta
       Created On: 08/12/2023
       Modified On:  
    -->
<link rel="stylesheet" href="assets/admin/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.css">
<link rel="stylesheet" href="assets/admin/plugins/bootstrap-toggle-master/css/bootstrap-toggle.min.css">
<style>
    /* Target the input element by its ID and remove margins */
    #CreatedDateTime,
    #Concern_Staff,
    #remark,
    #Concern_Department {
        border: none;
        /* Remove the border */
        outline: none;
        /* Remove the outline */
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
                                Lodge Grievance List
                            </div>
                            <span class="float-right">
                                <button class="btn btn-success" data-toggle="modal" data-target="#modal-lg"> <i class="fa fa-circle-thin"> <i class="fa fa-plus"></i> </i>Lodge Grievance </button>
                            </span>
                            <div class="modal fade" id="modal-lg">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Lodge Grievance </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="CategoryLevels">Select Main Category</label>
                                                            <select id="CategoryLevels" class="form-control js-example-basic-multiple" name="">
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- inputField -->
                                                </div>
                                                <!-- <div class="row" > -->
                                                <div id="subcategory">

                                                </div>



                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="remarks">Grievance Descriptions</label>
                                                            <textarea name="" id="remarks" class="form-control" autocomplete="off" col="10" placeholder="Grievance Descriptions..."></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group clearfix">
                                                            <span>Priority</span>
                                                            <!-- <label for="priority">Priority:</label> -->
                                                            <br>
                                                            <div class="icheck-success d-inline">
                                                                <input type="radio" name="r3" id="radioSuccess1" value="2">
                                                                <label for="radioSuccess1">
                                                                    Low
                                                                </label>
                                                            </div>
                                                            <div class="icheck-danger d-inline">
                                                                <input type="radio" name="r3" id="radioSuccess2" value="1">
                                                                <label for="radioSuccess2">
                                                                    High
                                                                </label>
                                                            </div>
                                                            <div class="icheck-warning d-inline">
                                                                <input type="radio" name="r3" id="radioSuccess3" value="3">
                                                                <label for="radioSuccess3">
                                                                    Urgent
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="documents">Attached Relevant Documents</label>
                                                            <input type="file" id="document">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="LodgeGrievances">Save </button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </div>
                        <!-- /.card-header -->


                        <!-- Start-modal-readgrievance -->

                        <div class="modal fade" id="modal-readgrievance">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Grievance Details</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-body w-100 h-80">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Concern Department</th>
                                                        <th>Grievance Descriptions</th>
                                                        <th>Received Date/Time</th>
                                                        <th><span style="color: red;"> * </span>Descriptions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td> <textarea type="text" id="Concern_Department" readonly></textarea></td>
                                                        <td> <textarea id="remark" readonly rows="4" cols="30"></textarea></td>
                                                        <td>
                                                            <input type="text" id="CreatedDateTime" readonly>

                                                        </td>
                                                        <td> <textarea id="Description" rows="4" cols="30" placeholder=" Descriptions..."></textarea></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="onView()">Save </button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- End-modal-readgrievance -->
                        <div class="card-body">
                            <table id="table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Registration ID</th>
                                        <th scope="col">Received On</i></th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Grievance Description</th>
                                        <th scope="col">Priority</th>
                                        <!-- <th scope="col">Concerns Department To</th>
                                        <th scope="col">Concerns Staff To</th> -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
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
        getMainCategories();
        getLodgeGrievancesList();
    });

    function getMainCategories() {

        var obj = new Object();
        obj.Module = "SupportTicket";
        obj.Page_key = "getMainCategories";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    function getLodgeGrievancesList() {
        var obj = new Object();
        obj.Module = "SupportTicket";
        obj.Page_key = "getLodgeGrievancesList";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    //getSubCategories
    function getSubCategories(selectedLevel) {
        let obj = {};
        obj.Module = "SupportTicket";
        let json = {};
        obj.Page_key = "getSubCategories";
        json.CategoryLevels = selectedLevel; // Pass the selectedLevel value
        obj.JSON = json;
        TransportCall(obj);
    }

    // function getNextLevelCategories(selectedNextLevel) {
    //    
    //     let obj = {};
    //     obj.Module = "SupportTicket";
    //     let json = {};
    //     obj.Page_key = "getNextLevelCategories";
    //     json.GrievanceNextLevel = selectedNextLevel; // Pass the selectedNextLevel value
    //     obj.JSON = json;
    //     TransportCall(obj);
    // }

    function clearform() {
        $('#Description').val('');
    }

    function onSuccess(rc) {
        if (rc.return_code) {
            switch (rc.Page_key) {

                case "getMainCategories":

                    loadSelect("#CategoryLevels", rc.return_data);
                    // for (i = 0; i < rc.return_data.length; i++) {
                    //     if (rc.return_data[i].ID == 0) {
                    //         loadMainCategory(rc.return_data[i].ID, rc.return_data[i].GrievanceCategory);
                    //     }
                    // }

                    break;

                case "getNextLevelCategory":
                    console.log(rc.return_data);
                    loadnextlevel(rc.return_data);
                    break;


                case "LodgeGrievances":
                    $("#modal-lg").modal("hide");
                    notify("success", rc.return_data);
                    location.reload();
                    break;

                case "getLodgeGrievancesList":
                    console.log(rc.return_data);
                    loaddata(rc.return_data);
                    break;

                case "onView":
                    getLodgeGrievancesList();
                    $("#modal-readgrievance").modal("hide");
                    clearform();
                    break;

                default:
                    notify("error", rc.Page_key);

            }
        } else {
            notify("error", rc.return_data);
        }
    }


    var lastSelectedCategoryId;

    function loadnextlevel(data) {

        // Create a new column within the existing row with ID "subcategory"
        var newCol = $('<div class="col-md-12">');

        // Add label for the select element
        newCol.append('<label for="select_next_level">Select Next Level:</label>');

        // Create a select element with a default option
        var selectElement = $('<select class="form-control categorySelect" id="cat-' + data.GrievanceCategoryID + '"> ' + data.GrievanceCategory + '</select>');


        // Check if there is any data to populate
        if (data.length == 0) {
            selectElement.append('<option value="-1">No Sub Level  Found</option>');
        } else {
            // Iterate through the data and add options to the select element
            selectElement.append('<option value="-1">Select Level</option>');
            for (let i = 0; i < data.length; i++) {
                selectElement.append('<option value="' + data[i].GrievanceCategoryID + '"> ' + data[i].GrievanceCategory + '</option>');
            }
        }

        // Close the select element
        newCol.append(selectElement);

        // Append the column to the existing row with ID "subcategory"
        $("#subcategory").append(newCol);
        //$("#subcategory").empty().append(text);
        // Add a change event listener to the select element
        $('.categorySelect').change(function() {
            lastSelectedCategoryId = $(this).val();
            getNextLevelCategory(1, lastSelectedCategoryId);
        });
    }



    function loadMainCategory(ID, Category) {

        var table = $("#CategoryLevels");
        var text = ""
        text += '<option value ="-1"> Select Category ';
        text += '</option>';
        text += '<option value ="' + ID + '">' + Category;
        text += '</option>';
        $("#CategoryLevels").html("");
        $("#CategoryLevels").append(text);
    }

    $('#CategoryLevels').on('change', function() {
        var selectedLevel = $("#CategoryLevels").val();
        selectid = 1;
        getNextLevelCategory(selectid, selectedLevel);
    });


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


    $("#LodgeGrievances").click(function() {
        // var underCategoryID = $("#cat-" + (parseInt($("#CategoryLevels").val()) - 1)).val();
        if (!$('#radioSuccess1')[0].checked && !$('#radioSuccess2')[0].checked && !$('#radioSuccess3')[0].checked) {
            notify("warning", "Select Priority");
            return false;
        }

        if ($('#radioSuccess1')[0].checked) {
            Priority = $("#radioSuccess1").val();
        } else if ($('#radioSuccess2')[0].checked) {
            Priority = $("#radioSuccess2").val();
        } else if ($('#radioSuccess3')[0].checked) {
            Priority = $("#radioSuccess3").val();
        } else {
            notify("warning", "Please Select Priority");
            return false;
        }

        let obj = {};

        obj.Module = "SupportTicket";
        obj.Page_key = "LodgeGrievances";
        let json = {};
        json.CategoryID = lastSelectedCategoryId;
        json.Remarks = $("#remarks").val();
        json.Document = $("#document").val();
        json.Priority = Priority;
        obj.JSON = json;
        console.log(obj);
        if ($("#remarks").val() == '') {

            notify("error", "All Fields are Required");
        } else {
            SilentTransportCall(obj);
        }

    });

    var code = null;

    function onView(data) {
        try {
            if (data !== undefined && data !== null) {
                data = JSON.parse(unescape(data));
                $("#remark").val(data.Remarks);
                $("#CreatedDateTime").val(data.CreatedDateTime);
                $("#Concern_Department").val(data.Concern_Department);
                $("#Concern_Staff").val(data.Concern_Staff);
                code = data.LodgeID;
                // flag = 1;
                $("#modal-readgrievance").modal("show");
                let flag = 1; // Or fetch the flag value as needed
                let obj = {};
                obj.Module = "SupportTicket";
                obj.Page_key = "onView";
                let json = {};
                json.LodgeID = code;
                obj.JSON = json;
                json.flag = flag;
                SilentTransportCall(obj);
            } else {
                let flag = 2; // Or fetch the flag value as needed
                let obj = {};
                obj.Module = "SupportTicket";
                obj.Page_key = "onView";
                let json = {};
                json.Description = $("#Description").val();
                json.LodgeID = code;
                obj.JSON = json;
                json.flag = flag;
                if ($("#Description").val() == '') {
                    notify("info", "Required fields Can't be Empty");
                } else {
                    SilentTransportCall(obj);
                }

            }
        } catch (error) {
            console.error("Error occurred ", error);
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

        var text = ""

        if (data.length == 0) {
            text += "No Data Found";
        } else {

            for (let i = 0; i < data.length; i++) {
                text += '<tr> ';

                // text += '<td> ' + (i+1) + '</td>';
                text += '<th> # ' + data[i].LodgeID + '</th>';
                // $createdDateTime = data[i].CreatedDateTime;
                var timestampStr = data[i].CreatedDateTime;
                var timestamp = new Date(timestampStr); // Convert string to Date object
                var timeAgo = jQuery.timeago(timestamp); // Assign calculated time ago to the global variable
                // text += '<td><small class="badge badge-success">  <i class="far fa-clock"></i>'  + timeAgo + ' </small></td>';
                text += '<td style="font-size: smaller;">' + timeAgo + '  <i class="far fa-clock"></td>';
                if (data[i].Status == 1) {
                    text += '<td> <span class="badge bg-danger"> Unseen </span></td>';
                } else if (data[i].Status == 2) {
                    text += '<td> <span class=" badge badge-success">Seen & No Response</span> </td>';
                } else if (data[i].Status == 3) {
                    text += '<td> <span class=" badge badge-warning"> Response </span> </td>';
                } else if (data[i].Status == 4) {
                    text += '<td> <span class=" badge badge-info"> Closed </span> </td>';
                }
                text += '<td> ' + data[i].Remarks + '<button class="btn btn-primary btn-xs ml-3"   onclick="onView(\'' + escape(JSON.stringify(data[i])) + '\')">More..</button></td>';
                if (data[i].Priority == 1) {
                    text += '<td> <span class=" badge badge-warning"> High </span></td>';
                } else if (data[i].Priority == 2) {
                    text += '<td> <span class="badge badge-info"> Low </span> </td>';
                } else {
                    text += '<td> <span class=" badge badge-danger"> Urgent </span> </td>';
                }
                // text += '<td> ' + data[i].Concern_Department + '</td>';
                // text += '<td> <span class=" badge badge-info">' + data[i].Concern_Staff + '</span></td>';

                if (data[i].Status == 4) {
                    text += '<td></td>'; // If Status is 4 means close status, add an empty table cell to hide the button
                } else {
                    text += '<td><a href="#" onclick="onCloseGrievenace(' + data[i].LodgeID + ')"><button class="btn btn-danger btn-xs ml-3">close</button></a></td>';
                }
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


    function clearform() {
        $('#CategoryLevels').val('');
        $('#remarks').val('');
        $('#document').val('');
        $('#priority').val('');
    }


    function onCloseGrievenace(LodgeID) {
        if (confirm("Are you sure to close this Grievance")) {
            let flag = 4; // 4 is the status ID for Closed Grievance
            let obj = {};
            obj.Module = "SupportTicket";
            obj.Page_key = "onView";
            let json = {};
            json.LodgeID = LodgeID;
            obj.JSON = json;
            json.flag = flag;
            SilentTransportCall(obj);
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timeago/1.6.7/jquery.timeago.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>