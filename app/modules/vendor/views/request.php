<!-- Begin page -->
<!-- removeNotificationModal -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="NotificationModalbtn-close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                        colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Are you sure ?</h4>
                        <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!</button>
                </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- sidebar laod form include file -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->

            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Employee List</h5>
                            <!-- Button aligned right -->
                            <button type="button" id="launchModalBtn" class="btn btn-primary">
                                Create Employee
                            </button>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="getEmployeeLists"
                                    class="table table-bordered nowrap table-striped align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>SL No.</th>
                                            <th>Name</th>
                                            <th>Contact</th>
                                            <th>Address</th>
                                            <th>Email</th>
                                            <th>Sector</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="empregisterModal" tabindex="-1" role="dialog"
                aria-labelledby="empregisterModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document"><!-- Added modal-lg -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="empregisterModalTitle">Register Employee</h5>

                        </div>

                        <div class="modal-body">
                            <form id="employeeForm">
                                <div class="row"><!-- Changed from form-row to row -->
                                    <div class="form-group col-md-6">
                                        <label for="emp_name">Name</label>
                                        <input type="text" class="form-control" id="emp_name" name="emp_name" required
                                            placeholder="Name..">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="emp_contact">Contact</label>
                                        <input type="text" class="form-control" id="emp_contact" name="emp_contact"
                                            placeholder="Contact No.." required>
                                    </div>
                                </div>

                                <div class="row"><!-- Changed from form-row to row -->
                                    <div class="form-group col-md-6">
                                        <label for="emp_address">Address</label>
                                        <input type="text" class="form-control" id="emp_address" name="emp_address"
                                            placeholder="Address...">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="emp_email">Email</label>
                                        <input type="email" class="form-control" id="emp_email" name="emp_email"
                                            placeholder="Email..">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="sector_id">Sector</label>
                                        <select class="form-control" id="sector_id" name="sector_id">
                                            <option value="">Select Sector</option>
                                        </select>
                                    </div>

                                </div>

                            </form>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="closeModal" on>Close</button>
                            <button type="button" id="saveEmployeeBtn" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>





        </div>
        <!-- container-fluid -->
    </div>
    <!-- Modal -->


    <!-- End Page-content -->

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>
                        document.write(new Date().getFullYear())
                    </script> © NIC.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        <!-- Design & Develop by 2 Brothers -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<!-- end main content-->

</div>
<!-- END layout-wrapper -->



<!--start back-to-top-->
<button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
</button>

<!-- JAVASCRIPT -->
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>
<script src="assets/libs/feather-icons/feather.min.js"></script>
<script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
<script src="assets/js/plugins.js"></script>
<!-- apexcharts -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- Dashboard init -->
<script src="assets/js/pages/dashboard-Ongyi.init.js"></script>

<!-- App js -->
<script src="assets/js/app.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(function() {
        getEmployeeList();
        getSectors();

    });
    $('#launchModalBtn').click(function() {
        $('#empregisterModal').modal('show');
    });
    $('#closeModal').click(function() {
        $('#empregisterModal').modal('hide');
    });



    function getEmployeeList() {
        var obj = new Object();
        obj.Module = "Employee";
        obj.Page_key = "getEmployeeList";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    function getSectors() {
        var obj = new Object();
        obj.Module = "Employee";
        obj.Page_key = "getSectors";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    function onSuccess(rc) {
        debugger;
        if (rc.return_code) {
            switch (rc.Page_key) {
                case "getEmployeeList":
                    loaddata(rc.return_data);
                    break;
                case "getSectors":
                    populateSectorsDropdown(rc.return_data);
                    break;
                case "saveEmployee":
                    showSuccessNotification(rc.return_data);
                    $('#empregisterModal').modal('hide');
                    getEmployeeList();
                    break;
                case "changeStatus":
                    showSuccessNotification(rc.return_data);
                    getEmployeeList();
                    break;

                default:
                    showWarningNotification(rc.Page_key);
            }
        } else {
            showWarningNotification(return_data);
        }
    }


    function populateSectorsDropdown(sectors) {
        const $sectorSelect = $('#sector_id');
        $sectorSelect.empty(); // Clear previous options
        $sectorSelect.append('<option value="">Select Sector</option>');

        sectors.forEach(function(sector) {
            $sectorSelect.append(
                $('<option>', {
                    value: sector.sector_id,
                    text: sector.sector_name
                })
            );
        });
    }

    $('#saveEmployeeBtn').click(function() {
        saveEmployee();
    });

    async function saveEmployee() {
        // Get values from inputs
        const emp_name = $("#emp_name").val().trim();
        const emp_contact = $("#emp_contact").val().trim();
        const emp_address = $("#emp_address").val().trim();
        const emp_email = $("#emp_email").val().trim();
        const sector_id = $("#sector_id").val().trim();

        // Validation regex patterns
        const phonePattern = /^[0-9]{10}$/;
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Validation checks
        if (!emp_name) {
            showWarningNotification("Please enter the employee name.");
            return;
        }

        if (!emp_contact || !phonePattern.test(emp_contact)) {
            showWarningNotification("Please enter a valid 10-digit contact number.");
            return;
        }

        if (!emp_email || !emailPattern.test(emp_email)) {
            showWarningNotification("Please enter a valid email address.");
            return;
        }

        if (!sector_id || isNaN(sector_id) || parseInt(sector_id) <= 0) {
            showWarningNotification("Please enter  Sector .");
            return;
        }

        // Build data object
        let obj = {
            Module: "Employee",
            Page_key: "saveEmployee",
            JSON: {
                emp_name: emp_name,
                emp_contact: emp_contact,
                emp_address: emp_address,
                emp_email: emp_email,
                sector_id: sector_id
            }
        };

        // Call your API
        TransportCall(obj);

        // Debug output
        console.log(JSON.stringify(obj, null, 2));
        resetEmployeeForm(); // ✅ Clear form here
    }



    function resetEmployeeForm() {
        $('#employeeForm')[0].reset(); // Resets all form fields to default
        $('#sector_id').val('').trigger('change'); // Reset select2 if used, or just clear the select
    }

    function showSuccessNotification(message) {
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: message,
            showConfirmButton: false,
            timer: 3000,
            toast: true,
        });
    }

    function showWarningNotification(message) {
        Swal.fire({
            position: 'top-end',
            icon: 'warning',
            title: message,
            showConfirmButton: false,
            timer: 3000,
            toast: true,
        });

    }

    // Function to show a danger notification
    function showDangerNotification() {
        const dangerMessage = "This is a danger notification!";
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: dangerMessage,
            showConfirmButton: false,
            timer: 3000,
            toast: true,
        });
    }


    function loaddata(data) {
        // Check if DataTable is already initialized
        if ($.fn.DataTable.isDataTable('#getEmployeeLists')) {
            $('#getEmployeeLists').DataTable().clear().destroy();
        }

        // Clear the tbody
        $('#getEmployeeLists tbody').empty();

        // Loop through each item
        $.each(data, function(index, item) {
            var row = $('<tr>');
            row.append($('<td>').text(index + 1)); // SL No.
            row.append($('<td>').text(item.emp_name)); // Name
            row.append($('<td>').text(item.emp_contact)); // Contact
            row.append($('<td>').text(item.emp_address)); // Address
            row.append($('<td>').text(item.emp_email)); // Email
            row.append($('<td>').text((item.sector !== undefined && item.sector !== null && item.sector !== '') ? item.sector : 'N/A')); // Sector
            row.append($('<td>').text(item.status)); // Status as text

            // Action buttons (Edit / Delete / Approve)
            row.append($('<td>').html(`
            <div class="dropdown d-inline-block">
                <button class="btn btn-soft-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-more-fill align-middle"></i>
                </button>
              <ul class="dropdown-menu dropdown-menu-end">
    <li>
        <button class="dropdown-item" onclick="approved('${item.emp_id}')">
            <i class="ri-eye-fill align-bottom me-2 text-muted"></i> Approved
        </button>
    </li>
    <li>
        <a class="dropdown-item edit-item-btn">
            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit
        </a>
    </li>
  
    <li>
        <button class="dropdown-item ${item.status === 'active' ? 'text-success' : 'text-danger'}"
                onclick="changeStatus('${item.emp_id}', '${item.status === 'active' ? 'inactive' : 'active'}')">
            <i class="${item.status === 'active' ? 'ri-toggle-line' : 'ri-toggle-fill'} align-bottom me-2"></i>
            ${item.status === 'active' ? 'Set Inactive' : 'Set Active'}
        </button>
    </li>
</ul>

            </div>
        `));
            // Append row to table body
            $('#getEmployeeLists tbody').append(row);
        });

        // Reinitialize DataTable
        $('#getEmployeeLists').DataTable({
            responsive: true,
            destroy: true
        });
    }



    function onError() {

    }

    // function approved(ID) {
    //     var obj = new Object();
    //     obj.Module = "Vendor";
    //     obj.Page_key = "approvedVendor";
    //     var json = new Object();
    //     json.VendorID = ID;
    //     obj.JSON = json;
    //     TransportCall(obj);
    // }

    function changeStatus(emp_id, newStatus) {
        var obj = new Object();
        obj.Module = "Employee"; // or change to "Vendor" or "Location" as needed
        obj.Page_key = "changeStatus";
        var json = new Object();
        json.emp_id = emp_id;
        json.status = newStatus;

        obj.JSON = json;

        TransportCall(obj);
    }
</script>
</body>


</html>