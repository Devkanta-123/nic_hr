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
                                        <th scope="col">Address</th>
                                        <th scope="col">Sector</th>
                                        <th scope="col">Action </th>
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
        getActiveEmployeesForAttendance()

    });

    function getActiveEmployeesForAttendance() {
        var obj = new Object();
        obj.Module = "Employee";
        obj.Page_key = "getActiveEmployeesForAttendance";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    function onSuccess(rc) {
        debugger;
        if (rc.return_code) {
            switch (rc.Page_key) {
                case "getActiveEmployeesForAttendance":
                    loaddata(rc.return_data);
                    break;
                case "markAttendance":
                    notify('success',rc.return_data);
                    console.log(rc.return_data);
                     getActiveEmployeesForAttendance();
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
    var table = $("#empAttendance");

    try {
        if ($.fn.DataTable.isDataTable(table)) {
            table.DataTable().destroy();
        }
    } catch (ex) {}

    let text = "";

    if (data.length === 0) {
        text += "<tr><td colspan='7'>No Data Found</td></tr>";
    } else {
        for (let i = 0; i < data.length; i++) {
            const emp = data[i];
            const empId = emp.emp_id;

            const isPresent = emp.attendance_status === "Present";
            const shiftValue = emp.shift || "";

            text += `<tr>`;
            text += `<td>${emp.emp_name}</td>`;
            text += `<td>${emp.emp_contact}</td>`;
            text += `<td>${emp.emp_address}</td>`;
            text += `<td>${emp.sector || 'N/A'}</td>`;

            // Action (attendance toggle and shift radios)
            text += `<td style="min-width: 180px;">`;

            // Attendance checkbox (set checked if Present)
            text += `
                <input 
                    type="checkbox" 
                    class="attendance-bootstrap-switch" 
                    data-bootstrap-switch 
                    data-empid="${empId}" 
                    id="toggle_${empId}" 
                    name="attendance_${empId}" 
                    data-on-text="Present"
                    data-off-text="Absent"
                    data-on-color="primary"
                    data-off-color="secondary"
                    ${isPresent ? "checked" : ""}
                />
            `;

            // Shift options (conditionally check based on shift value)
            text += `
                <div class="shift-options mt-2" id="shifts_${empId}" style="display: ${isPresent ? 'block' : 'none'};">
                    <div class="form-check">
                        <input class="form-check-input shift-radio" type="radio" name="shift_${empId}" id="morning_${empId}" value="Morning" data-empid="${empId}" ${shiftValue === "Morning" ? "checked" : ""}>
                        <label class="form-check-label" for="morning_${empId}">Morning</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input shift-radio" type="radio" name="shift_${empId}" id="night_${empId}" value="Night" data-empid="${empId}" ${shiftValue === "Night" ? "checked" : ""}>
                        <label class="form-check-label" for="night_${empId}">Night</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input shift-radio" type="radio" name="shift_${empId}" id="both_${empId}" value="Morning + Night" data-empid="${empId}" ${shiftValue === "Morning + Night" ? "checked" : ""}>
                        <label class="form-check-label" for="both_${empId}">Morning + Night</label>
                    </div>
                </div>
            `;

            text += `</td>`;
            text += `</tr>`;
        }
    }

    $("#empAttendance tbody").html(text);

    // Reinitialize DataTable
    table.DataTable({
        responsive: true,
        order: [],
        dom: 'Bfrtip',
        bInfo: true,
        deferRender: true,
        pageLength: 10,
        buttons: [
            {
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

    // Initialize Bootstrap Switch
    $("[data-bootstrap-switch]").bootstrapSwitch();

    // Toggle switch event
    $(".attendance-bootstrap-switch").on("switchChange.bootstrapSwitch", function (event, state) {
        const empId = $(this).data("empid");

        if (state) {
            $(`#shifts_${empId}`).slideDown();
        } else {
            $(`#shifts_${empId}`).slideUp();
            sendAttendance(empId, "Absent", null);
        }
    });

    // Shift radio change
    $(".shift-radio").on("change", function () {
        const empId = $(this).data("empid");
        const shift = $(this).val();
        sendAttendance(empId, "Present", shift);
    });
}


    function sendAttendance(emp_id, status, shift) {
        debugger;
        if (!shift && status === "Present") return; // Don't send if shift is null for Present
        const obj = {
            Module: "Deo",
            Page_key: "markAttendance",
            JSON: {
                emp_id: emp_id,
                status: status, // "Present" or "Absent"
                shift: shift || null // Shift or null if absent
            }
        };

        TransportCall(obj);
    }




</script>