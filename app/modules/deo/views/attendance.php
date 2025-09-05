<!-- summernote -->
<link rel="stylesheet" href="assets/admin/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet"
    href="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.css">

<link rel="stylesheet" href="assets/admin/plugins/bootstrap-toggle-master/css/bootstrap-toggle.min.css">
<!-- Bootstrap Switch -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet" />
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
                                Attendance Date:
                            </div>&nbsp;
                            <input type="date" id="attendance_date" autocomplete="off">
                            <button id="loadBtn" class="btn btn-success">Load Data</button>
                            <span class="float-right">
                                <a href="deodash" class="btn btn-primary btn-xs custom-btn">Back to lists</a>
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
                                        <th scope="col">Location</th>
                                        <th scope="col">Action </th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <!-- <button type="button" id="saveAttendanceBtn" class="btn btn-primary">Save</button> -->
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
        getActiveEmployeesForAttendance();
        getLocations();
        // 1. Set default value of date input to today
    });

    let allLocations = [];
    let employeeData = [];

    let isLocationLoaded = false;
    let isEmployeeLoaded = false;

    function checkAndLoadTable() {
        if (isLocationLoaded && isEmployeeLoaded) {
            loaddata(employeeData);
        }
    }




    function getActiveEmployeesForAttendance() {
        var obj = new Object();
        obj.Module = "Employee";
        obj.Page_key = "getActiveEmployeesForAttendance";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }


    function getLocations() {
        var obj = new Object();
        obj.Module = "Work";
        obj.Page_key = "getLocations";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    function onSuccess(rc) {
        debugger;
        if (rc.return_code) {
            switch (rc.Page_key) {
                case "getActiveEmployeesForAttendance":
                    employeeData = rc.return_data;
                    isEmployeeLoaded = true;
                    console.log("Employees:", employeeData);
                    if (allLocations && allLocations.length > 0) {
                        initAttendanceModule();
                    }
                    break;

                case "getLocations":
                    populateLocationDropdown(rc.return_data);
                    allLocations = rc.return_data;

                    // only run if employees already loaded
                    if (isEmployeeLoaded) {
                        initAttendanceModule();
                    }
                    break;


                case "markAttendance":
                    notify('success', rc.return_data);
                    console.log(rc.return_data);
                    // optional: you might want to reset flags if reloading
                    isEmployeeLoaded = false;
                    //getActiveEmployeesForAttendance();
                    break;

                default:
                    alert(rc.Page_key);
            }
        } else {
            alert(rc.return_data);
        }
    }


    function populateLocationDropdown(locations) {
        if (!Array.isArray(locations)) {
            console.warn("populateLocationDropdown received invalid data:", locations);
            locations = [];
        }
        allLocations = locations;

        // 🔑 Refresh location dropdowns in already-rendered table
        $("#empAttendance tbody tr").each(function() {
            const empId = $(this).find("select.location-select").data("empid");
            let locationOptions = `<option value="">Select Location</option>`;

            allLocations.forEach(loc => {
                const selected = $(`#loc_id_${empId}`).val() == loc.loc_id ? "selected" : "";
                locationOptions += `<option value="${loc.loc_id}" ${selected}>${loc.loc_name}</option>`;
            });

            $(`#loc_id_${empId}`).html(locationOptions);
        });
    }

    function initAttendanceModule() {
        const today = new Date().toISOString().split("T")[0];

        // restrict date picker
        $("#attendance_date").attr("max", today);
        $("#attendance_date").val(today);

        // date validation
        $("#attendance_date").on("change", function() {
            const selectedDate = $(this).val();
            if (selectedDate > today) {
                $("#loadBtn").prop("disabled", true);
            } else {
                $("#loadBtn").prop("disabled", false);
            }
        });

        // load today's data on page load
        filterAndLoadData(today);

        // load on button click (rebind only once)
        $("#loadBtn").off("click").on("click", function() {
            const selectedDate = $("#attendance_date").val();
            filterAndLoadData(selectedDate);
        });
    }

    // ✅ Load data (always show all employees, overlay attendance if exists)
    function filterAndLoadData(selectedDate) {
        const today = new Date().toISOString().split("T")[0];
        const isToday = (selectedDate === today);

        // pick only records that match selectedDate
        const existingForDate = employeeData.filter(item => item.attendance_date === selectedDate);

        // build rows
        loaddata(existingForDate, selectedDate, isToday);
    }

    // ✅ Build attendance table
    function loaddata(data, selectedDate, isToday = false) {
    const table = $("#empAttendance");

    // Destroy old DataTable safely
    if ($.fn.DataTable.isDataTable(table)) {
        table.DataTable().clear().destroy();
    }

    let employees = [];

    if (data && data.length > 0) {
        // overlay data: start with all employees, then map attendance
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
        // no records → show default blank rows
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

    for (let i = 0; i < employees.length; i++) {
        const emp = employees[i];
        const empId = emp.emp_id;
        const attendanceStatus = emp.attendance_status || "";
        const shiftValue = emp.shift || "";
        const empLocationId = emp.loc_id || "";

        const isExisting = attendanceStatus !== "";

        text += `<tr data-existing="${isExisting}">`;

        // Col 1 - Name
        text += `<td>${emp.emp_name}</td>`;

        // Col 2 - Location
        let locationOptions = `<option value="">Select Location</option>`;
        allLocations.forEach(loc => {
            const selected = empLocationId == loc.loc_id ? "selected" : "";
            locationOptions += `<option value="${loc.loc_id}" ${selected}>${loc.loc_name}</option>`;
        });

        text += `<td>
            <select class="form-control location-select" 
                    id="loc_id_${empId}" 
                    name="loc_id" 
                    data-empid="${empId}">
                ${locationOptions}
            </select>
        </td>`;

        // Col 3 - Attendance + Shift dropdown
        text += `<td style="min-width: 500px;">`;

        text += `
            <div class="form-check form-check-inline">
                <input class="form-check-input attendance-status-radio" type="radio" 
                    name="status_${empId}" id="status_present_${empId}" value="Present" 
                    data-empid="${empId}" data-existing="${isExisting}"
                    ${attendanceStatus === "Present" ? "checked" : ""}>
                <label class="form-check-label" for="status_present_${empId}">Present</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input attendance-status-radio" type="radio" 
                    name="status_${empId}" id="status_halfday_${empId}" value="Halfday" 
                    data-empid="${empId}" data-existing="${isExisting}"
                    ${attendanceStatus === "Halfday" ? "checked" : ""}>
                <label class="form-check-label" for="status_halfday_${empId}">Halfday</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input attendance-status-radio" type="radio" 
                    name="status_${empId}" id="status_absent_${empId}" value="Absent" 
                    data-empid="${empId}" data-existing="${isExisting}"
                    ${attendanceStatus === "Absent" ? "checked" : ""}>
                <label class="form-check-label" for="status_absent_${empId}">Absent</label>
            </div>
        `;

        // Shift dropdown
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
        `;

        text += `</td>`;
        text += `</tr>`;
    }

    $("#empAttendance tbody").html(text);

    // Reinitialize DataTable
    table.DataTable({
        responsive: true,
        order: [],
        dom: "Bfrtip",
        bInfo: true,
        deferRender: true,
        pageLength: 10,
        buttons: [
            {
                extend: "excel",
                exportOptions: { columns: ":not(.hidden-col)" }
            },
            {
                extend: "pdfHtml5",
                exportOptions: { columns: ":not(.hidden-col)" }
            },
            {
                extend: "print",
                exportOptions: { columns: ":not(.hidden-col)" }
            }
        ]
    });

    // 🔹 Bind onchange events for auto-save
    $(".location-select").off("change").on("change", function() {
        const empId = $(this).data("empid");
        triggerSave(empId);
    });

    $(".attendance-status-radio").off("change").on("change", function() {
        const empId = $(this).data("empid");
        triggerSave(empId);
    });

    $(".shift-select").off("change").on("change", function() {
        const empId = $(this).data("empid");
        triggerSave(empId);
    });
}

// Manual Save Button (still works if needed)
$("#saveAttendanceBtn").on("click", function() {
    $("#empAttendance tbody tr").each(function() {
        const empId = $(this).find(".attendance-status-radio").data("empid");
        triggerSave(empId);
    });
});

// helper to collect values and call sendAttendance
function triggerSave(empId) {
debugger;
    const status = $(`input[name='status_${empId}']:checked`).val() || null;
    const shift = $(`#shift_${empId}`).val() || null;
    const isExisting = $(`#status_present_${empId}`).data("existing");
    const attendanceDate = $("#attendance_date").val();
    if (status) {
        sendAttendance(empId, status, shift, attendanceDate, isExisting);
    }
}

function sendAttendance(emp_id, status, shift, selectedDate, isExisting = false) {
    const loc_id = $(`.location-select[data-empid="${emp_id}"]`).val();
    if (!loc_id) {
        notify('warning', 'Select the location');
        return;
    }

    const attendance_date = $("#attendance_date").val();
    if (!attendance_date) {
        notify('error', 'Attendance date cannot be empty');
        return;
    }

    const obj = {
        Module: "Deo",
        Page_key: "markAttendance",
        JSON: {
            emp_id: emp_id,
            status: status,
            shift: shift || null,
            location_id: loc_id || null,
            attendance_date: attendance_date
        }
    };

    TransportCall(obj);
}

</script>