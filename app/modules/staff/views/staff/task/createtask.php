<!-- summernote -->
<link rel="stylesheet" href="assets/admin/plugins/summernote/summernote-bs4.css">
<style>
    .input-validation-error~.select2 {
        border: 1px solid red;
        border-radius: 5px;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-50px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .slide-in {
        animation: slideIn 0.5s ease-in-out;
    }

    .custom-dropdown {
        min-width: 1;
        border: none;
    }

    .completed-task {
        text-decoration: line-through;
        color: #888;
    }

    .customtext {
        height: 40%;
        position: absolute;
        top: 20%;
        right: 35px;
        font-size: 12px;
    }

    .oval-select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-color: #f0f0f0;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 20px;
        /* Adjust this value for a more oval shape */
        width: 150px;
        height: 30px;
        /* Set a width for the select box */
        outline: none;
        cursor: pointer;
        font-size: 14px;
        /* Adjust the font size */
        color: #555;
        /* Text color */
    }

    .oval-select:focus {
        border-color: #007bff;
    }

    /* Add a little arrow indicator for the select */
    .oval-select::after {
        content: '\25BC';
        /* Unicode character for down arrow */
        position: absolute;
        top: 20%;
        right: 10px;
        transform: translateY(-50%);
        pointer-events: none;
        color: #555;
    }
</style>

<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                        <div class="card direct-chat direct-chat-primary" style="position: relative; left: 0px; top: 0px;">
                            <div class="card-header ui-sortable-handle" style="cursor: move;">
                                <h3 class="card-title"> Create  Daily Task</h3>
                                <div class="card-tools">
                         
                                    <!-- <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal" data-target="#viewtask-modal">
                                        View
                                    </button> -->

                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#createtask-modal">Create
                                    </button>
                                    <button class="btn btn-secondary btn-xs" data-toggle="modal" data-target="#viewtask-modal">
                                        <i class="fas fa-search fa-fw"></i>
                                    </button>
                                    <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button> -->
                                    <!-- <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
                            <i class="fas fa-comments"></i>
                        </button> -->

                                </div>
                            </div>
                            <table id="taskdata" class="table table-striped">
                                <thead>
                                    <tr>
                                        <!-- <th>Task ID#</th> -->
                                        <th>Task Name</th>
                                        <th>Duration</th>
                                        <th>Description</th>
                                        <th>Created On</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                            <!-- Message Box -->
                            <!-- <div class="direct-chat-contacts">
                                    <ul class="contacts-list">
                                        <li>
                                            <a href="#">
                                                <img class="contacts-list-img" src="dist/img/user1-128x128.jpg" alt="User Avatar">
                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">
                                                        Count Dracula
                                                        <small class="contacts-list-date float-right">2/28/2015</small>
                                                    </span>
                                                    <span class="contacts-list-msg">How have you been? I was...</span>
                                                </div>

                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <img class="contacts-list-img" src="dist/img/user7-128x128.jpg" alt="User Avatar">
                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">
                                                        Sarah Doe
                                                        <small class="contacts-list-date float-right">2/23/2015</small>
                                                    </span>
                                                    <span class="contacts-list-msg">I will be waiting for...</span>
                                                </div>

                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <img class="contacts-list-img" src="dist/img/user3-128x128.jpg" alt="User Avatar">
                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">
                                                        Nadia Jolie
                                                        <small class="contacts-list-date float-right">2/20/2015</small>
                                                    </span>
                                                    <span class="contacts-list-msg">I'll call you back at...</span>
                                                </div>

                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <img class="contacts-list-img" src="dist/img/user5-128x128.jpg" alt="User Avatar">
                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">
                                                        Nora S. Vans
                                                        <small class="contacts-list-date float-right">2/10/2015</small>
                                                    </span>
                                                    <span class="contacts-list-msg">Where is your new...</span>
                                                </div>

                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <img class="contacts-list-img" src="dist/img/user6-128x128.jpg" alt="User Avatar">
                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">
                                                        John K.
                                                        <small class="contacts-list-date float-right">1/27/2015</small>
                                                    </span>
                                                    <span class="contacts-list-msg">Can I take a look at...</span>
                                                </div>

                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <img class="contacts-list-img" src="dist/img/user8-128x128.jpg" alt="User Avatar">
                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">
                                                        Kenneth M.
                                                        <small class="contacts-list-date float-right">1/4/2015</small>
                                                    </span>
                                                    <span class="contacts-list-msg">Never mind I found...</span>
                                                </div>

                                            </a>
                                        </li>

                                    </ul>

                                </div> -->

                        </div>
                </div>
            </div>
        </div>

        <!-- Create Task Modal -->
        <div class="modal fade" id="createtask-modal" role="dialog" aria-labelledby="createtask-modalTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLongTitle">Create Daily Task</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="task_name">Task Name</label> <span style="color: red;">**<span>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-check"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control float-right" id="task_name" placeholder="Task name.." autocomplete="off">
                                            </div>
                                        </span></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="duration">Duration</label> <span style="color: red;">**<span>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-clock"></i>
                                                    </span>
                                                </div>
                                                <input type="number" class="form-control" id="duration" autocomplete="off" min="0" max="99">
                                                <span class="customtext">(in minutes)</span>
                                            </div>
                                        </span></span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Task Description</label>
                                        <textarea row=5 class="summernote" name="" id="description" class="form-control" autocomplete="off"></textarea>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-xs" id="createtask">Create</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Create Task Modal End here -->


        <div class="modal fade" id="viewtask-modal" role="dialog" aria-labelledby="viewtask-modalTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLongTitle">View Task</h6>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row mb-3">
                                <!-- <div class="col-md-4">
                                    <label for="from_date">Staff Name</label> <span style="color: red;">**<span>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-users"></i>
                                                    </span>
                                                </div>
                                                <select class="form-control" id="Staffs">
                                                </select>
                                            </div>
                                </div> -->
                                <div class="col-md-6">
                                    <label for="from_date">From Date </label> <span style="color: red;">**<span>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar"></i>
                                                    </span>
                                                </div>
                                                <input type="date" class="form-control float-right" id="from_date" max=<?php echo date("Y-m-d"); ?>>
                                            </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="to_date">To Date</label> <span style="color: red;">**<span>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar"></i>
                                                    </span>
                                                </div>
                                                <input type="date" class="form-control float-right" id="to_date" value="<?php echo date("Y-m-d"); ?>" max=<?php echo date("Y-m-d"); ?>>

                                            </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <table id="loadTaskBasedOnDate" class="table table-bordered table-striped dataTable dtr-inline" style="display: none;">
                                    <thead>
                                        <tr>
                                            <th scope="col">Created On</th>
                                            <th scope="col">Task Name</th>
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-xs" id="CloseModal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Summernote -->
<script src="assets/admin/plugins/summernote/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 100,
            tabsize: 3,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

    });



    // Duration Input Validations
    $("#duration").on('change', function() {
        
        if ($("#duration").val() < 0 || $("#duration").val() > 99) {
            notify("error", "Minutes Must be Only 2 digits !");
            $("#duration").val("");
        }

    });


    $(function() {
        getDailyTask();
        getUserTaskBetweenTwoDates();
        getStaff();
    });

    var FromDate, ToDate;
    var initialFromDate = true; // Flag to track the initial change of #from_date

    $(document).ready(function() {
        FromDate = $("#from_date").val();
        ToDate = $("#to_date").val();

        // $("#from_date").on('change', function() {
        //     if (initialFromDate) {
        //         // Update the FromDate variable with the selected value
        //         FromDate = $(this).val();
        //         initialFromDate = false; // Set the flag to false after the initial change
        //     } else {
        //         // Subsequent changes will call the function
        //         FromDate = $(this).val();
        //         OnChangeDate();
        //     }
        // });

        $("#from_date").on('change', function() {
            FromDate = $(this).val();
            OnChangeDate();

        });

        $("#to_date").on('change', function() {
            ToDate = $(this).val();
            getUserTaskBetweenTwoDates(FromDate, ToDate);
            $("#loadTaskBasedOnDate").modal('show');
        });
    });

    function OnChangeDate() {
        ToDate = $("#to_date").val();
        getUserTaskBetweenTwoDates(FromDate, ToDate);
        $("#loadTaskBasedOnDate").modal('show');
    }

    $("#CloseModal").click(function() {
        $("#viewtask-modal").modal("hide");
        $("#loadTaskBasedOnDate").modal("hide");
        // clearform();
    });


    function clearform() {
        $("#from_date").val("");
        $("#to_date").val("");
    }

    function getUserTaskBetweenTwoDates(FromDate, ToDate) {
        
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getUserTaskBetweenTwoDates";

        // Initialize the JSON object
        obj.JSON = {};
        // Assign values to JSON properties
        obj.JSON.FromDate = FromDate;
        obj.JSON.ToDate = ToDate;
        SilentTransportCall(obj);
    }


    function onSuccess(rc) {
        if (rc.return_code) {
            switch (rc.Page_key) {

                case "getDailyTask":
                    loaddata(rc.return_data)
                    break;
                case "createdailytask":
                    notify('success', rc.return_data);
                    location.reload();
                    break;

                case "updatedailytaskstatus":
                    
                    notify('success', rc.return_data);
                    break;

                case "getUserTaskBetweenTwoDates":
                    
                    loadAllTaskBasedOndate(rc.return_data);
                    break;


                default:
                    notify('warning', rc.Page_key);
            }
        } else {
            toastr.error(rc.return_data);
        }
    }




    function loaddata(data) {
        var table = $("#taskdata").DataTable();

        try {
            if (table) {
                table.clear().destroy();
            }
        } catch (ex) {}

        var text = "";
        var statusid = "";
        if (data.length == 0) {
            text += "No Data Found";
        } else {
            for (let i = 0; i < data.length; i++) {
                text += '<tr';

                // Add the 'completed-task' class to the row if the task is completed
                if (data[i].isCompleted == 2) {
                    text += ' class="completed-task"';
                }

                text += '>';
                text += '<td style="display:none;"> ' + data[i].Id + '</td>';
                text += '<td> ' + data[i].TaskName + '</td>';
                text += '<td> ' + data[i].Duration + ' mins</td>';
                text += '<td> ' + data[i].Description + '</td>';
                text += '<td> ' + data[i].CreatedDateTime + '</td>';
                text += '<td>';

                // Status Badge
                statusid = 'status' + i;
                if (data[i].isCompleted == 0) {
                    text += '<span id="' + statusid + '" class="badge bg-danger">To Do </span>';
                } else if (data[i].isCompleted == 1) {
                    text += '<span id="' + statusid + '" class="badge bg-secondary">IN PROGRESS </span>';
                } else if (data[i].isCompleted == 2) {
                    // Add 'completed-task' class to visually mark completed tasks
                    text += '<span id="' + statusid + '" class="badge bg-success">DONE </span>';
                }

                // Dropdown for updating status
                text += '<span class="dropdown">';
                text += '<a class="btn btn-tool"  id="statusDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                text += '<i class="fas fa-pen"></i></a>';
                text += '<div class="dropdown-menu custom-dropdown" aria-labelledby="statusDropdown">';
                text += '<a class="dropdown-item badge bg-primary"  href="#" onclick="updateStatus(' + data[i].Id + ', 0,\'' + statusid + '\')"  style="font-size: 10px; max-width: 50px;">TO DO</a>';
                text += '<br>';
                text += '<a class="dropdown-item badge bg-info"  href="#" onclick="updateStatus(' + data[i].Id + ', 1,\'' + statusid + '\')"  style="font-size: 10px; max-width: 80px;">IN PROGRESS</a>';
                text += '<br>';
                text += '<a class="dropdown-item badge bg-success"  onclick="updateStatus(' + data[i].Id + ', 2,\'' + statusid + '\')" style="font-size: 10px; max-width: 50px;">DONE</a>';
                text += '</span>';
                text += '</div>';
                text += '</td>';
                text += '</tr>';
            }
        }

        $("#taskdata tbody").html("");
        $("#taskdata tbody").append(text);

        $("#taskdata").DataTable({
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

    // function loadAllTaskBasedOndate(data) {
    //     var table = $("#loadTaskBasedOnDate").DataTable();

    //     try {
    //         if (table) {
    //             table.clear().destroy();
    //         }
    //     } catch (ex) {}

    //     var text = "";
    //     var statusid = "";
    //     if (data.length == 0) {
    //         text += "No Data Found";
    //     } else {
    //         for (let i = 0; i < data.length; i++) {
    //             text += '<tr';
    //             text += '>';
    //             text += '<td> ' + data[i].TaskName + '</td>';
    //             text += '<td> ' + data[i].Description + '</td>';
    //             text += '<td>';

    //             // Status Badge
    //             statusid = 'status' + i;
    //             if (data[i].isCompleted == 0) {
    //                 text += '<span id="' + statusid + '" class="badge bg-danger">To Do </span>';
    //             } else if (data[i].isCompleted == 1) {
    //                 text += '<span id="' + statusid + '" class="badge bg-secondary">IN PROGRESS </span>';
    //             } else if (data[i].isCompleted == 2) {
    //                 // Add 'completed-task' class to visually mark completed tasks
    //                 text += '<span id="' + statusid + '" class="badge bg-success">DONE </span>';
    //             }
    //             text += '</tr>';
    //         }
    //     }

    //     $("#loadTaskBasedOnDate tbody").html("");
    //     $("#loadTaskBasedOnDate tbody").append(text);

    //     $("#loadTaskBasedOnDate").DataTable({
    //         responsive: true,
    //         "order": [],
    //         dom: 'Bfrtip',
    //         "bInfo": true,
    //         exportOptions: {
    //             columns: ':not(.hidden-col)'
    //         },
    //         "deferRender": true,
    //         "pageLength": 10,
    //         buttons: [{
    //                 exportOptions: {
    //                     columns: ':not(.hidden-col)'
    //                 },
    //                 extend: 'excel',
    //                 orientation: 'landscape',
    //                 pageSize: 'A4'
    //             },
    //             {
    //                 exportOptions: {
    //                     columns: ':not(.hidden-col)'
    //                 },
    //                 extend: 'pdfHtml5',
    //                 orientation: 'landscape',
    //                 pageSize: 'A4'
    //             },
    //             {
    //                 exportOptions: {
    //                     columns: ':not(.hidden-col)'
    //                 },
    //                 extend: 'print',
    //                 orientation: 'landscape',
    //                 pageSize: 'A4'
    //             }
    //         ]
    //     });
    // }


    function loadAllTaskBasedOndate(data) {
        var table = $("#loadTaskBasedOnDate tbody");
        table.empty(); // Clear existing rows

        if (data.length === 0) {
            table.append("<tr><td colspan='10'>No Data Found</td></tr>");
        } else {
            for (let i = 0; i < data.length; i++) {

                var statusBadge = "";
                if (data[i].isCompleted == 0) {
                    statusBadge = '<span class="badge bg-danger">To Do</span>';
                } else if (data[i].isCompleted == 1) {
                    statusBadge = '<span class="badge bg-secondary">IN PROGRESS</span>';
                } else if (data[i].isCompleted == 2) {
                    statusBadge = '<span class="badge bg-success">DONE</span><br><span class="badge bg-primary">Updated on: </span>&nbsp;' + data[i].CompletedUpDatedTime;
                }

                var row = '<tr>' +
                    '<td>' + data[i].CreatedDate + '</td>' +
                    '<td>' + data[i].TaskName + '</td>' +
                    '<td>' + data[i].Description + '</td>' +
                    '<td>' + statusBadge + '</td>' +
                    '</tr>';
                table.append(row);
            }
        }
    }




    $("#createtask").click(function() {
        var obj = {};
        obj.Module = "Staff";
        obj.Page_key = "createdailytask";
        var json = {};
        json.TaskName = $("#task_name").val();
        json.Duration = $("#duration").val();
        json.Description = $("#description").val();
        obj.JSON = json;
        if ($("#task_name").val() == '' || $("#duration").val() == '' || $("#description").val() == '') {
            notify("error", "All Fields are required");
        } else {
            SilentTransportCall(obj);
        }

    });


    function getDailyTask() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getDailyTask";
        obj.JSON = {};
        SilentTransportCall(obj);
    }



    function updateStatus(taskID, status, statusID) {
        
        var obj = {};
        obj.Module = "Staff";
        obj.Page_key = "updatedailytaskstatus";
        var json = {};
        json.TaskID = taskID;
        json.Status = status;
        obj.JSON = json;
        if (status == 0) {
            $('#' + statusID).html('To Do');
            $('#' + statusID).attr('class', 'badge bg-danger');
        } else if (status == 1) {
            $('#' + statusID).html('IN PROGRESS');
            $('#' + statusID).attr('class', 'badge bg-secondary');
        } else if (status == 2) {
            $('#' + statusID).html('DONE');
            $('#' + statusID).attr('class', 'badge bg-primary');
        }
        SilentTransportCall(obj);
    }
    // Modal Animation
    $('#createtask-modal').on('show.bs.modal', function() {
        $(this).find('.modal-dialog').addClass('slide-in');
    });

    $('#createtask-modal').on('hidden.bs.modal', function() {
        // Reset the modal animation class when the modal is hidden
        $(this).find('.modal-dialog').removeClass('slide-in');
    });


    // Modal Animation
    $('#viewtask-modal').on('show.bs.modal', function() {
        $(this).find('.modal-dialog').addClass('slide-in');
    });

    $('#viewtask-modal').on('hidden.bs.modal', function() {
        // Reset the modal animation class when the modal is hidden
        $(this).find('.modal-dialog').removeClass('slide-in');
    });
</script>