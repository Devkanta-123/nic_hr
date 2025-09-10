<!-- summernote -->
<link rel="stylesheet" href="assets/admin/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet"
    href="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.css">

<link rel="stylesheet" href="assets/admin/plugins/bootstrap-toggle-master/css/bootstrap-toggle.min.css">
<!-- Bootstrap Switch -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap3/bootstrap-switch.min.css"
    rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

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
        border-radius: 30px;
        background: linear-gradient(to right, #3498db, #e74c3c);
        color: #fff;
        padding: 5px 10px;
        display: inline-block;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
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
                            <div class="card-title">Attendance Date:</div>&nbsp;
                            <input type="date" id="attendance_date" autocomplete="off">
                            <button id="loadBtn" class="btn btn-success">Load Data</button>

                            <span class="float-right">
                                <a href="deodash" class="btn btn-primary btn-xs custom-btn">Back to lists</a>
                            </span>
                        </div>

                        <div class="card-body">
                            <table id="empAttendance" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Summernote -->
<script src="assets/admin/plugins/summernote/summernote-bs4.min.js"></script>
<script src="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.js"></script>
<script src="assets/admin/plugins/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>

<script>
    $(function() {
        getActiveEmployeesForAttendance();
        getLocations();
    });

    let allLocations = [];
    let employeeData = [];
    let isLocationLoaded = false;
    let isEmployeeLoaded = false;

    function getActiveEmployeesForAttendance() {
        var obj = {
            Module: "Employee",
            Page_key: "getActiveEmployeesForAttendance",
            JSON: {}
        };
        TransportCall(obj);
    }

    function getLocations() {
        var obj = {
            Module: "Work",
            Page_key: "getLocations",
            JSON: {}
        };
        TransportCall(obj);
    }

    let lastSelectedDate = null;

    $("#loadBtn").off("click").on("click", function() {
        lastSelectedDate = $("#attendance_date").val(); // store last selected date
        filterAndLoadData(lastSelectedDate);
    });


    function onSuccess(rc) {
        if (rc.return_code) {
            switch (rc.Page_key) {
                case "getActiveEmployeesForAttendance":
                    employeeData = rc.return_data;
                    isEmployeeLoaded = true;

                    if (allLocations.length > 0) {
                        // ✅ Always use last selected date if available
                        const dateToUse = lastSelectedDate || $("#attendance_date").val();
                        filterAndLoadData(dateToUse);
                    }
                    break;


                case "getLocations":
                    allLocations = rc.return_data;
                    isLocationLoaded = true;
                    if (isEmployeeLoaded) initAttendanceModule();
                    break;

                case "markAttendance":
                    notify('success', rc.return_data);
                    getActiveEmployeesForAttendance();
                    break;


                case "getAttendance":
                    employeeData = rc.return_data;
                    filterAndLoadData($("#attendance_date").val());
                    break;

                default:
                    alert(rc.Page_key);
            }
        } else {
            alert(rc.return_data);
        }
    }

    function initAttendanceModule() {
        const today = new Date().toISOString().split("T")[0];
        $("#attendance_date").attr("max", today).val(today);
        filterAndLoadData(today);
    }

    $("#loadBtn").off("click").on("click", function() {
        const selectedDate = $("#attendance_date").val();
        if ($.fn.DataTable.isDataTable("#empAttendance")) {
            $("#empAttendance").DataTable().clear().destroy();
        }
        filterAndLoadData(selectedDate);
    });

    // ✅ Load data (always show all employees, overlay attendance if exists)
    function filterAndLoadData(selectedDate) {
        const today = new Date().toISOString().split("T")[0];
        const isToday = (selectedDate === today);

        const existingForDate = employeeData.filter(item => item.attendance_date === selectedDate);
        loaddata(existingForDate, selectedDate, isToday);
    }

    // ✅ Build attendance table
    function loaddata(data, selectedDate, isToday = false) {
        const table = $("#empAttendance");
        if ($.fn.DataTable.isDataTable(table)) {
            table.DataTable().clear().destroy();
        }

        let employees = [];

        if (data && data.length > 0) {
            const byId = {};
            employeeData.forEach(emp => {
                byId[emp.emp_id] = {
                    ...emp,
                    attendance_status: "",
                    shift: "",
                    loc_id: ""
                };
            });
            data.forEach(att => {
                byId[att.emp_id] = {
                    ...byId[att.emp_id],
                    ...att
                };
            });
            employees = Object.values(byId);
        } else {
            const unique = {};
            employeeData.forEach(emp => {
                if (!unique[emp.emp_id]) {
                    unique[emp.emp_id] = {
                        ...emp,
                        attendance_status: "",
                        shift: "",
                        loc_id: ""
                    };
                }
            });
            employees = Object.values(unique);
        }

        let text = "";
        employees.forEach(emp => {
            const empId = emp.emp_id;
            const attendanceStatus = emp.attendance_status || "";
            const shiftValue = emp.shift || "";
            const empLocationId = emp.loc_id || "";
            const isExisting = attendanceStatus !== "";

            text += `<tr data-existing="${isExisting}">`;
            text += `<td>${emp.emp_name}</td>`;

            let locationOptions = `<option value="">Select Location</option>`;
            allLocations.forEach(loc => {
                const selected = empLocationId == loc.loc_id ? "selected" : "";
                locationOptions += `<option value="${loc.loc_id}" ${selected}>${loc.loc_name}</option>`;
            });

            text += `<td>
                <select class="form-control location-select" id="loc_id_${empId}" 
                        name="loc_id" data-empid="${empId}">
                    ${locationOptions}
                </select>
            </td>`;

            text += `<td style="min-width: 500px;">`;

            ["Present", "Halfday", "Absent"].forEach(status => {
                text += `
                    <div class="form-check form-check-inline">
                        <input class="form-check-input attendance-status-radio" type="radio" 
                            name="status_${empId}" id="status_${status.toLowerCase()}_${empId}" 
                            value="${status}" data-empid="${empId}" data-existing="${isExisting}"
                            ${attendanceStatus === status ? "checked" : ""}>
                        <label class="form-check-label" for="status_${status.toLowerCase()}_${empId}">
                            ${status}
                        </label>
                    </div>`;
            });

            let shiftOptions = `
                <option value="">Select Shift</option>
                <option value="Morning" ${shiftValue === "Morning" ? "selected" : ""}>Morning</option>
                <option value="Night" ${shiftValue === "Night" ? "selected" : ""}>Night</option>
                <option value="Morning + Night" ${shiftValue === "Morning + Night" ? "selected" : ""}>Morning + Night</option>
            `;

            text += `
                <div class="form-check form-check-inline ml-2" style="width: 150px;">
                    <select class="form-control form-control-sm shift-select" 
                            id="shift_${empId}" name="shift_${empId}" data-empid="${empId}">
                        ${shiftOptions}
                    </select>
                </div>
            </td></tr>`;
        });

        $("#empAttendance tbody").html(text);

        table.DataTable({
            responsive: true,
            order: [],
            dom: "Bfrtip",
            bInfo: true,
            deferRender: true,
            pageLength: 10,
            buttons: [{
                    extend: "excel",
                    exportOptions: {
                        columns: ":not(.hidden-col)"
                    }
                },
                {
                    extend: "pdfHtml5",
                    exportOptions: {
                        columns: ":not(.hidden-col)"
                    }
                },
                {
                    extend: "print",
                    exportOptions: {
                        columns: ":not(.hidden-col)"
                    }
                }
            ]
        });
    }

    $(document).on("change", ".attendance-status-radio", function() {
        const empId = $(this).data("empid");
        const attendanceDate = $("#attendance_date").val();
        saveAttendanceForEmployee(empId, attendanceDate);
    });

    $(document).on("change", ".location-select", function() {
        const empId = $(this).data("empid");
        const attendanceDate = $("#attendance_date").val();
        const status = $(`input[name='status_${empId}']:checked`).val();

        if (status) { // ✅ Only save if radio is already chosen
            saveAttendanceForEmployee(empId, attendanceDate);
        }
    });


    $(document).on("change", ".shift-select", function() {
        const empId = $(this).data("empid");
        const attendanceDate = $("#attendance_date").val();
        const status = $(`input[name='status_${empId}']:checked`).val();

        if (status) { // ✅ Only save if radio is already chosen
            saveAttendanceForEmployee(empId, attendanceDate);
        }
    });



    // ✅ Save all rows at once

    function saveAttendanceForEmployee(empId, attendanceDate) {
        debugger;
        const status = $(`input[name='status_${empId}']:checked`).val() || null;
        const shift = $(`#shift_${empId}`).val() || null;
        const loc_id = $(`.location-select[data-empid="${empId}"]`).val();

        if (!status) return false; // No status selected yet

        // ✅ Validation: Location mandatory for Present / Halfday
        if ((status === "Present" || status === "Halfday") && !loc_id) {
            notify("warning", `Select location for ${empId}`);
            return false;
        }

        const obj = {
            Module: "Deo",
            Page_key: "markAttendance",
            JSON: {
                emp_id: empId,
                status: status,
                shift: shift || null,
                location_id: status === "Absent" ? null : (loc_id || null),
                attendance_date: attendanceDate
            }
        };

        TransportCall(obj);
        return true;
    }


    function reloadEmployeeData(selectedDate) {
        const obj = {
            Module: "Deo",
            Page_key: "getAttendance",
            JSON: {
                date: selectedDate
            }
        };
        TransportCall(obj);
    }
</script>