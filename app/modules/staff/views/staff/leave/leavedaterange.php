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
                            <h3 class="card-title">Leave Data Of </h3> &nbsp;
                            <select id="staffs" class="staffs"></select>&nbsp;&nbsp;&nbsp;
                            <span>From Date :</span>
                            <input type="date" class="staffs" id="fromdate" value="<?php echo date("Y-m-d"); ?>">&nbsp;&nbsp;&nbsp;
                            <span>To Date :</span>
                            <input type="date" class="staffs" id="todate" value="<?php echo date("Y-m-d"); ?>">


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
                        <table id="StaffLeave" class="table table-striped" style="display:none;">
                            <thead>
                                <tr>
                                    <!-- <th>Task ID#</th> -->
                                    <th>Staff Name</th>
                                    <th>Leave Type</th>
                                    <th>Request Duration</th>
                                    <th>Purpose</th>
                                    <th>No of Days</th>
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
        getUserLeaveOnDate(selectedStaff, fromDate, toDate);
        $("#StaffLeave").show();
    });

    // Change event for the fromdate input
    $('#fromdate').on('change', function() {
        var StaffID = selectedStaff;
        var fromDate = $('#fromdate').val();
        var toDate = $('#todate').val();
        getUserLeaveOnDate(selectedStaff, fromDate, toDate);
        $("#StaffLeave").show();
    });


    $('#todate').on('change', function() {
        var StaffID = selectedStaff;
        var fromDate = $('#fromdate').val();
        var toDate = $('#todate').val();
        getUserLeaveOnDate(selectedStaff, fromDate, toDate);
        $("#StaffLeave").show();
    });

    // Function to load staff tasks
    function getUserLeaveOnDate(staffId, fromDate, toDate) {
        debugger;
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getUserLeaveOnDate";
        obj.JSON = {};
        obj.JSON.StaffID = staffId;
        obj.JSON.FromDate = fromDate;
        obj.JSON.ToDate = toDate;
        SilentTransportCall(obj);
    }


    $(function() {
        getStaff();
    });






  

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

                case "getUserLeaveOnDate":
                    loadUserDateData(rc.return_data);
                    break;

                default:
                    notify('warning', rc.Page_key);
            }
        } else {
            toastr.error(rc.return_data);
        }
    }



    function loadUserDateData(data) {
        // Clear the existing table content
        $("#StaffLeave tbody").html("");

        var text = "";
        var statusid = "";

        if (data.length == 0) {
            text += "<tr><td colspan='4'>No Data Found</td></tr>";
        } else {
            for (let i = 0; i < data.length; i++) {
                text += "<tr";
                text += ">";
                text += "<td style='display:none;'> " + data[i].Id + "</td>";
                text += "<td> " + data[i].StaffName + "</td>";
                text += "<td><span class='badge badge-success'>" + data[i].LeaveType + "</span></td>";
                text += "<td>";
                 text += data[i].RequestedDateFrom +  ' /  ' + data[i].RequestedDateTo + '';
               text +=  "</td>";
                text += "<td> " + data[i].LeaveRemarks + "</td>";
                text += "<td> " + data[i].NoOfDays + "</td>";
                text += "</tr>";
            }
        }

        // Append the table content to the tbody
        $("#StaffLeave tbody").append(text);
    }
</script>