<!-- summernote -->
<link rel="stylesheet" href="assets/admin/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet"
    href="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.css">

<link rel="stylesheet" href="assets/admin/plugins/bootstrap-toggle-master/css/bootstrap-toggle.min.css">
<!-- Bootstrap Switch -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js"></script>



<style>
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

    .custom-btn {
        border: 2px solid #fff;
        /* White border */
        border-radius: 30px;
        /* Adjust the value to control the roundness of the button */
        background: linear-gradient(to right, #3498db, #e74c3c);
        /* Adjust the colors as desired */
        color: #fff;
        /* Text color */
        padding: 5px 10px;
        /* Adjust padding as needed */
        display: inline-block;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        /* Adjust shadow as needed */
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
                                Attendance
                            </div>



                            <span class="float-right">
                                <a href="deodash" class="btn btn-primary btn-xs custom-btn">Back to lists</a>
                            </span>
                            <span class="float-right">
                                <input class="form-control form-control-sidebar" type="date" onchange="searchOnDate()" id="dateInput">
                            </span>

                        </div>

                        <!-- Delete Lead  Confirmation  Modal   -->
                        <div class="modal fade" id="RestoreLeadModal">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <button type="button" class="close text-white" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="text-center" id="output"></p>
                                        <!-- <input type="text" id="LeadsName"> -->
                                        <input type="hidden" id="LeadsID">
                                        <p class="text-center">Click Yes If You Are Sure.</p>
                                    </div>
                                    <div class="modal-footer justify-content-between border-0">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-info btn-sm"
                                            onclick="RestoreLeads()">Yes</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>



                        <!-- Ends here  -->


                        <div class="card-body">

                            <table id="empAttendance" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Contact</th>
                                        <th scope="col">Sector</th>
                                        <th scope="col">Attendance Date</th>
                                        <th scope="col">Entry Time</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
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
<!-- validating input -->

<!-- Summernote -->
<script src="assets/admin/plugins/summernote/summernote-bs4.min.js"></script>

<script src="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.js"></script>
<script src="assets/admin/plugins/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>

<script>
    $(function() {
        getAttendanceReport()
        var today = new Date().toISOString().split('T')[0];
        // Set max attribute to today
        $('#dateInput').attr('max', today);
    });

    function getAttendanceReport() {
        var obj = new Object();
        obj.Module = "Employee";
        obj.Page_key = "getAttendanceReport";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }
    let employeeAttendanceData = [];

    function onSuccess(rc) {
        debugger;
        if (rc.return_code) {
            switch (rc.Page_key) {
                case "getAttendanceReport":
                    employeeAttendanceData = rc.return_data;
                    // loadTodayAttendance();
                    loaddata(rc.return_data)
                    // document.querySelector('input[type="date"]').value = getTodayDate();
                    break;
                case "markAttendance":
                    notify('success', rc.return_data);
                    console.log(rc.return_data);
                    getAttendanceReport();
                    break;


                default:
                    alert(rc.Page_key);
            }
        } else {
            alert(rc.return_data);
        }
        // alert(JSON.stringify(args));
    }


    function searchOnDate() {
        const selectedDate = document.querySelector('input[type="date"]').value;
        if (!selectedDate) {
            loaddata(employeeAttendanceData); // If no date selected, show all
            return;
        }

        const filteredData = employeeAttendanceData.filter(emp => emp.attendance_date === selectedDate);
        loaddata(filteredData);
    }


    function loaddata(data) {
        const table = $("#empAttendance");

        try {
            if ($.fn.DataTable.isDataTable(table)) {
                table.DataTable().clear().draw();
                table.DataTable().destroy();
            }
        } catch (ex) {
            console.error("Error destroying DataTable:", ex);
        }

        let text = "";

        if (!data || data.length === 0) {
            text += "<tr><td colspan='6'>No Data Found</td></tr>";
        } else {
            for (let i = 0; i < data.length; i++) {
                const emp = data[i];
                const attendanceStatus = emp.attendance_status || "Absent";

                // ✅ Show shift if status is Present or Halfday
                const showShift =
                    attendanceStatus.toLowerCase() === "present" ||
                    attendanceStatus.toLowerCase() === "halfday";

                const shiftValue = showShift ? (emp.shift || "") : "";

                // Badge color
                let badgeClass = "danger";
                if (attendanceStatus.toLowerCase() === "present") {
                    badgeClass = "success";
                } else if (attendanceStatus.toLowerCase() === "halfday") {
                    badgeClass = "primary";
                }

                text += `<tr>`;
                text += `<td>${emp.emp_name}</td>`;
                text += `<td>${emp.emp_contact}</td>`;
                text += `<td>${emp.sector || 'N/A'}</td>`;
                text += `<td>${emp.attendance_date || 'N/A'}</td>`;
                text += `<td>${emp.in_time || 'N/A'}</td>`;
                text += `<td>
                        <small class="badge badge-${badgeClass}">
                            ${attendanceStatus}
                        </small>
                          <small>
                            ${shiftValue ? " (" + shiftValue + ")" : ""}
                        </small>
                    </td>`;
                text += `</tr>`;
            }
        }

        $("#empAttendance tbody").html(text);

        if (data && data.length > 0) {
            table.DataTable({
                responsive: true,
                order: [],
                dom: 'Bfrtip',
                bInfo: true,
                deferRender: true,
                pageLength: 10,
                buttons: [{
                        extend: 'excel',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        exportOptions: {
                            columns: ':not(.hidden-col)'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        exportOptions: {
                            columns: ':not(.hidden-col)'
                        }
                    },
                    {
                        extend: 'print',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        exportOptions: {
                            columns: ':not(.hidden-col)'
                        }
                    }
                ]
            });
        }
    }


    function getTodayDate() {
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        return `${yyyy}-${mm}-${dd}`;
    }

    function loadTodayAttendance() {
        const today = getTodayDate();
        const todaysData = employeeAttendanceData.filter(emp => emp.attendance_date === today);
        loaddata(todaysData);
    }
</script>