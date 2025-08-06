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

    .staffs {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 20px;
        font-size: 16px;
        width: 200px;
        height: 45px;
        /* Adjust the width as needed */
        outline: none;
        /* Remove default outline */
        cursor: pointer;
        /* Show pointer cursor on hover */
    }

    .staffs:hover,
    .staffs:focus {
        border-color: #4CAF50;
        /* Change border color on hover or focus */
    }
</style>

<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                        <div class="card direct-chat direct-chat-primary" style="position: relative; left: 0px; top: 0px;">
                            <div class="card-header ui-sortable-handle" style="cursor: move;">
                                <h3 class="card-title">Daily Task Of </h3> &nbsp;
                                <select id="staffs" class="staffs"></select>&nbsp;&nbsp;&nbsp;
                                <span>From Date :</span>
                                <input type="date" class="staffs" id="fromdate" value="<?php echo date("Y-m-d"); ?>" max=<?php echo date("Y-m-d"); ?>>&nbsp;&nbsp;&nbsp;
                                <span>To Date :</span>
                                <input type="date" class="staffs" id="todate">


                                <!-- <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal" data-target="#viewtask-modal">
                                        View 
                                    </button> -->

                                <!-- <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#createtask-modal">Create
                                    </button>
                                    <button class="btn btn-secondary btn-xs" data-toggle="modal" data-target="#viewtask-modal">
                                        <i class="fas fa-search fa-fw"></i>
                                    </button> -->
                                <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button> -->
                                <!-- <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
                            <i class="fas fa-comments"></i>
                        </button> -->


                            </div>
                            <table id="Usertaskdata" class="table table-striped" style="display:none;">
                                <thead>
                                    <tr>
                                        <!-- <th>Task ID#</th> -->
                                        <th>Task Name</th>
                                        <th>Duration</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Created On</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                </div>
            </div>
        </div>  
    </section>
</div>

<!-- Summernote -->
<script src="assets/admin/plugins/summernote/summernote-bs4.min.js"></script>
<script>
    var selectedStaff = '';
    $('#staffs').on('change', function() {
        selectedStaff = $(this).val();
        var fromDate = $('#fromdate').val();
        var toDate = $('#todate').val();
        getUserTaskBasedOnDate(selectedStaff, fromDate, toDate);
        $("#Usertaskdata").show();
    });

    // Change event for the fromdate input
    $('#fromdate').on('change', function() {
        var StaffID = selectedStaff;
        var fromDate = $('#fromdate').val();
        var toDate = $('#todate').val();
        getUserTaskBasedOnDate(selectedStaff, fromDate, toDate);
        $("#Usertaskdata").show();
    });


    $('#todate').on('change', function() {
        var StaffID = selectedStaff;
        var fromDate = $('#fromdate').val();
        var toDate = $('#todate').val();
        getUserTaskBasedOnDate(selectedStaff, fromDate, toDate);
        $("#Usertaskdata").show();
    });

    // Function to load staff tasks
    function getUserTaskBasedOnDate(staffId, fromDate, toDate) {
        debugger;
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getUserTaskBasedOnDate";
        obj.JSON = {};
        obj.JSON.StaffID = staffId;
        obj.JSON.FromDate = fromDate;
        obj.JSON.ToDate = toDate;
        SilentTransportCall(obj);
    }


    $(function() {
        getallTaskBasedOnDate();
        getStaff();
    });






    function getallTaskBasedOnDate(FromDate, ToDate) {
        
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getallTaskBasedOnDate";

        // Initialize the JSON object
        obj.JSON = {};
        // Assign values to JSON properties
        obj.JSON.FromDate = FromDate;
        obj.JSON.ToDate = ToDate;
        //SilentTransportCall(obj);
    }

    function getStaff() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getStaff";
        SilentTransportCall(obj);
    }


    function onSuccess(rc) {
        if (rc.return_code) {
            switch (rc.Page_key) {


                case "getStaff":
                    loadSelect("#staffs", rc.return_data);
                    break;

                case "getUserTaskBasedOnDate":
                    loadUserDateData(rc.return_data);
                    break;

                default:
                    notify('warning', rc.Page_key);
            }
        } else {
            toastr.error(rc.return_data);
        }
    }


    // function loadUserDateData(data) {
    //     var table = $("#Usertaskdata").DataTable();

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

    //             // Add the 'completed-task' class to the row if the task is completed
    //             if (data[i].isCompleted == 2) {
    //                 text += ' class="completed-task"';
    //             }

    //             text += '>';
    //             text += '<td style="display:none;"> ' + data[i].Id + '</td>';
    //             text += '<td> ' + data[i].TaskName + '</td>';
    //             text += '<td> ' + data[i].Duration + ' mins</td>';
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
    //             text += '</td>';
    //             text += '</tr>';
    //         }
    //     }

    //     $("#Usertaskdata tbody").html("");
    //     $("#Usertaskdata tbody").append(text);

    //     $("#Usertaskdata").DataTable({
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
    function loadUserDateData(data) {
        // Clear the existing table content
        $("#Usertaskdata tbody").html("");

        var text = "";
        var statusid = "";

        if (data.length == 0) {
            text += "<tr><td colspan='4'>No Data Found</td></tr>";
        } else {
            for (let i = 0; i < data.length; i++) {
                text += "<tr";
                text += ">";
                text += "<td style='display:none;'> " + data[i].Id + "</td>";
                text += "<td> " + data[i].TaskName + "</td>";
                text += "<td> " + data[i].Duration + " mins</td>";
                text += "<td> " + data[i].Description + "</td>";
                text += "<td>";

                statusid = "status" + i;
                if (data[i].isCompleted == 0) {
                    text += "<span id='" + statusid + "' class='badge bg-danger'>To Do</span>";
                } else if (data[i].isCompleted == 1) {
                    text += "<span id='" + statusid + "' class='badge bg-secondary'>IN PROGRESS</span>";
                } else if (data[i].isCompleted == 2) {
                    // text += "<span class='badge bg-success'>DONE</span><br><span class="badge bg-primary">Updated on: </span>&nbsp;' + data[i].CompletedUpDatedTime;
                    text +='<span class="badge bg-success">DONE</span><br><span class="badge bg-primary">Completed on: </span>&nbsp;' + data[i].CompletedUpDatedTime;

                }
                text += "</td>";  
                //CreatedDate
                text += "<td> " + data[i].CreatedDate + "</td>";
                text += "</tr>";
            }
        }

        // Append the table content to the tbody
        $("#Usertaskdata tbody").append(text);
    }
</script>