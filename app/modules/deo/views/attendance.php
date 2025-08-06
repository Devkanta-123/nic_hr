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
                            <!-- <div class="modal fade" id="modal-lg">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                     <form method="post" >
                                        <div class="modal-header">
                                            <h4 class="modal-title"> Add Clients</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body text-center">

                                                <div class="row">
                                                   
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="client_name">Client Name</label>
                                                            <input type="text" id="client_name" class="form-control" maxlength="30" placeholder="Client Name" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="telephone_number">Telephone Number</label>
                                                            <input type="text" id="telephone_number" class="form-control" onkeypress="javascript:return isNum(event)" maxlength="10" placeholder="Telephone Number" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="mobile_no">Mobile Number</label>
                                                            <input type="text" id="mobile_no" class="form-control" onkeypress="javascript:return isNum(event)" maxlength="10" placeholder="Mobile Number"  autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">                                  
                                                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail" style="max-width: 50px; max-height: 50px;">
                                                               
                                                            </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail " style="max-width:50px; max-height: 50px;">
                                                                <img src="assets/img/image_placeholder.jpg" alt="..." style="max-width: 100px; max-height: 100px;">
                                                            </div>
                                                            <div>
                                                                <span class="btn btn-round btn-file mt-3">
                                                                   
                                                                    <span class="">Add logo</span>
                                                                    <input type="file" id="logo" name="PassportPhoto" accept="image/x-png,image/jpeg,image/jpg" required>
                                                                </span>
                                                               
                                                            </div>
                                                        </div> 
                                                    </div>
                                                   
                                                </div>
                                          
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="fax">Fax</label>
                                                            <input type="text" id="fax" class="form-control" placeholder="Fax" maxlength="15" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="contact_name">Contact Name</label>
                                                            <input type="text" id="contact_name" class="form-control" maxlength="30" placeholder="Contact Name"  autocomplete="off">
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="contact_number">Contact Number </label>
                                                            <input type="text" id="contact_number" class="form-control" onkeypress="javascript:return isNum(event)" placeholder="Mobile Number" maxlength="10" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="person_designation">Person Designation</label>
                                                            <input type="text" id="person_designation" class="form-control" maxlength="20" placeholder="Person Designation" autocomplete="off">
                                                        </div>
                                                    </div>            
                                                </div>
                                                                                      
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="state">State</label>
                                                            <select class="form-control" name="" id="state"> 
                                                            </select>
                                                         </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="district">District</label>
                                                            <select class="form-control" name="" id="district">
                                                            </select>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="city_name">City Name</label>
                                                            <input type="text" id="city_name" class="form-control" maxlength="15" placeholder="City" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="pincode">Pincode</label>
                                                            <input type="text" id="pincode" class="form-control" onkeypress="javascript:return isNum(event)" maxlength="6" placeholder="Pincode" autocomplete="off">
                                                        </div>
                                                    </div>

                                                </div>
                                                  
                                                <div class="row">
                                                   
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="landmark">Landmark </label>
                                                            <input type="text" id="landmark" class="form-control" placeholder="Landmark" autocomplete="off">
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="maxuser">Max User </label>
                                                            <input type="text" id="maxuser" class="form-control" placeholder="Max User" maxlength="3" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer ">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="btnAddClient">Save </button>                                          
                                        </div>
                                     </form>
                                    </div>
                                   
                                </div>
                               
                            </div> -->


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
                                        <th scope="col">Email</th>
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
        getActiveEmployeeList()

    });

    function getActiveEmployeeList() {
        var obj = new Object();
        obj.Module = "Employee";
        obj.Page_key = "getActiveEmployeeList";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    function onSuccess(rc) {
        debugger;
        if (rc.return_code) {
            switch (rc.Page_key) {
                case "getActiveEmployeeList":
                    loaddata(rc.return_data);
                    break;
                case "markAttendance":
                    console.log(rc.return_data);
                 getActiveEmployeeList();
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

                text += `<tr>`;
                text += `<td>${emp.emp_name}</td>`;
                text += `<td>${emp.emp_contact}</td>`;
                text += `<td>${emp.emp_email}</td>`;
                text += `<td>${emp.emp_address}</td>`;
                text += `<td>${emp.sector || 'N/A'}</td>`;

                // Action (attendance toggle and shift radios)
                text += `<td style="min-width: 180px;">`;

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
/>

        <div class="shift-options mt-2" id="shifts_${empId}">
            <div class="form-check">
                <input class="form-check-input shift-radio" type="radio" name="shift_${empId}" id="morning_${empId}" value="Morning" data-empid="${empId}">
                <label class="form-check-label" for="morning_${empId}">Morning</label>
            </div>
            <div class="form-check">
                <input class="form-check-input shift-radio" type="radio" name="shift_${empId}" id="night_${empId}" value="Night" data-empid="${empId}">
                <label class="form-check-label" for="night_${empId}">Night</label>
            </div>
            <div class="form-check">
                <input class="form-check-input shift-radio" type="radio" name="shift_${empId}" id="both_${empId}" value="Morning + Night" data-empid="${empId}">
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

        // Initialize Bootstrap Switch
        $("[data-bootstrap-switch]").bootstrapSwitch();
        $("[data-bootstrap-switch]").bootstrapSwitch();

        // Toggle switch event
        $(".attendance-bootstrap-switch").on("switchChange.bootstrapSwitch", function(event, state) {
            const empId = $(this).data("empid");

            if (state) {
                $(`#shifts_${empId}`).slideDown();
            } else {
                $(`#shifts_${empId}`).slideUp();
                sendAttendance(empId, "Absent", null);
            }
        });

        // Shift radio change
        $(".shift-radio").on("change", function() {
            const empId = $(this).data("empid");
            const shift = $(this).val();
            sendAttendance(empId, "Present", shift);
        });
        // After populating table
        data.forEach(emp => {
            $(`#shifts_${emp.emp_id}`).hide(); // Hide shifts by default
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



    function onRestoreLeads(data) {
        debugger;
        data = JSON.parse(unescape(data));
        $("#LeadsID").val(data.LeadsID);
        var LeadsName = data.Name;
        $("#RestoreLeadModal").modal('show');
        var outputElement = document.getElementById("output");
        outputElement.innerHTML = "Are You Sure to Restore  " + LeadsName + " Leads ? ";
    }

    function RestoreLeads() {
        debugger;
        var LeadID = $("#LeadsID").val();

        var obj = new Object();
        obj.Module = "Client";
        obj.Page_key = "restorePrayageduLeads";
        var json = new Object();
        obj.JSON = json;
        json.LeadsID = LeadID;
        SilentTransportCall(obj);
    }

    // Modal Animation For Delete Lead Modal 
    $('#RestoreLeadModal').on('show.bs.modal', function() {
        $(this).find('.modal-dialog').addClass('slide-in');
    });

    $('#RestoreLeadModal').on('hidden.bs.modal', function() {
        // Reset the modal animation class when the modal is hidden
        $(this).find('.modal-dialog').removeClass('slide-in');
    });
</script>