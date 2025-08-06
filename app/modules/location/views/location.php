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

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Location</h5>

                            <!-- Button group aligned right -->
                            <div>
                                <button type="button" id="addLocationModal" class="btn btn-primary">
                                    Add Location
                                </button>

                            </div>
                        </div>


                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="locationlists" class="table table-bordered nowrap table-striped align-middle"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>SL No.</th>
                                            <th>Location Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="addLocationModalForm" tabindex="-1" role="dialog" aria-labelledby="addLocationModalFormTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <!-- modal-lg for wider layout -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addLocationModalFormTitle">Add New Location</h5>
                        </div>
                        <div class="modal-body">
                            <form id="locationForm">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="loc_name">Location Name</label>
                                        <textarea class="form-control" id="loc_name" name="loc_name" rows="5" cols="50" required></textarea>


                                    </div>

                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="closeModal"
                                data-dismiss="modal">Close</button>
                            <button type="button" id="saveLocationBtn" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>



        </div>


        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>
                        document.write(new Date().getFullYear())
                    </script> © NIC HR.
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
    let WorkID = '';
    $(function() {
        getLocations();
    });

    $('#addLocationModal').click(function() {
        $('#addLocationModalForm').modal('show');
    });
    $('#closeModal').click(function() {
        $('#addLocationModalForm').modal('hide');
    });

    function assign(workId) {

        // Optional: Store the workId for later use (e.g. in hidden input)
        console.log("Assigned Work ID:", workId);
        WorkID = workId;
        $('#assignModal').modal('show'); // Show the modal
    }





    function getLocations() {
        var obj = new Object();
        obj.Module = "Work";
        obj.Page_key = "getLocations";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    function getWorks() {
        var obj = new Object();
        obj.Module = "Work";
        obj.Page_key = "getWorks";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }







    function onSuccess(rc) {
        debugger;
        if (rc.return_code) {
            switch (rc.Page_key) {
                case "addLocation":
                    showSuccessNotification(rc.return_data);
                    $('#addLocationModalForm').modal('hide');
                    break;
                case "getLocations":
                    populateLocationDropdown(rc.return_data);
                    loaddata(rc.return_data);
                    break;
                case "getEmployeeList":
                    populateEmployeeDropdown(rc.return_data);
                    break;


                case "getWorks":
                    loaddata(rc.return_data);
                    break;

                case "assignWork":
                    showSuccessNotification(rc.return_data);
                    break;

                default:
                    showWarningNotification(rc.return_data);
            }
        } else {
            showWarningNotification(rc.return_data);
        }
    }


    function populateLocationDropdown(locs) {
        const $locationselect = $('#loc_id');
        $locationselect.empty(); // Clear previous options
        $locationselect.append('<option value="">Select Location</option>');
        locs.forEach(function(locs) {
            $locationselect.append(
                $('<option>', {
                    value: locs.loc_id,
                    text: locs.loc_name
                })
            );
        });
    }

    function populateEmployeeDropdown(emp) {
        const $empselect = $('#emp_id');
        $empselect.empty(); // Clear previous options
        $empselect.append('<option value="">Select Employee</option>');
        emp.forEach(function(emp) {
            $empselect.append(
                $('<option>', {
                    value: emp.emp_id,
                    text: emp.emp_name
                })
            );
        });
    }

    $('#saveLocationBtn').click(function() {
        addLocation();
    });

    async function addLocation() {
        // Get values from form
        const loc_name = $("#loc_name").val().trim();

        // Validation
        if (!loc_name) {
            showWarningNotification("Please enter location name.");
            return;
        }

        // Prepare request
        let obj = {
            Module: "Location", // This should route to PHP addLocation function
            Page_key: "addLocation", // This should match router or handler logic in backend
            JSON: {
                loc_name: loc_name
            }
        };

        // Call API (assuming TransportCall handles your API call)
        TransportCall(obj);

        // Reset form
        resetAssignForm();
         getLocations();
    }


    async function assignWork() {

        // Get values from modal form fields (make sure these inputs exist inside your modal)
        const work_id = WorkID; // Stored when modal opened
        const emp_id = $('#emp_id').val().trim();
        // Validation
        if (!work_id) {
            showWarningNotification("Invalid work selected for assignment.");
            return;
        }
        if (!emp_id) {
            showWarningNotification("Please select a Employee to assign.");
            return;
        }

        // Prepare payload object matching your API structure
        let obj = {
            Module: "Work",
            Page_key: "assignWork", // You can set this key as needed in your API
            JSON: {
                work_id: work_id,
                emp_id: emp_id
            }
        };

        // Call API (assuming TransportCall is async or handles promise internally)
        TransportCall(obj);

        console.log("Assign API payload:", JSON.stringify(obj, null, 2));

        // Close modal & reset form fields
        $('#assignModal').modal('hide');
        getWorks();
        resetAssignForm();

    }

    function assignModalClose() {
        $('#assignModal').modal('hide');
    }




    function resetAssignForm() {
        $('#locationForm')[0].reset(); // Resets all form fields to default
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

    function showWarningNotification(warningMessage) {
        Swal.fire({
            position: 'top-end',
            icon: 'warning',
            title: warningMessage,
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
        // ✅ Destroy existing DataTable if already initialized
        if ($.fn.DataTable.isDataTable('#locationlists')) {
            $('#locationlists').DataTable().clear().destroy();
        }

        // ✅ Clear the table body
        $('#locationlists tbody').empty();

        // ✅ Populate the table with new data
        $.each(data, function(index, item) {
            var row = $('<tr>');
            row.append($('<td>').text(index + 1));
            row.append($('<td>').text(item.loc_name));
          

            // Determine status badge class based on status value
            let statusClass = 'badge bg-info-subtle text-info'; // default
            if (item.status === 'active') {
                statusClass = 'badge bg-success'; // green
            } else if (item.status === 'inactive') {
                statusClass = 'badge bg-warning text-dark'; // yellow
            } // Add more conditions if needed

            // Create status cell with badge span
            var statusTd = $('<td>');
            var statusSpan = $('<span>').addClass(statusClass).text(item.status);
            statusTd.append(statusSpan);
            row.append(statusTd);

            // Conditionally add dropdown or placeholder based on status
            if (item.status !== 'assigned') {
                row.append($('<td>').html(`
                <div class="dropdown d-inline-block">
                    <button class="btn btn-soft-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ri-more-fill align-middle"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><button class="dropdown-item" onclick="assign('${item.work_id}')">
                            <i class="ri-eye-fill align-bottom me-2 text-muted"></i>Edit
                        </button></li>
                    </ul>
                </div>
            `));
            } else {
                // Show placeholder for assigned status
                row.append($('<td>').text('—'));
            }

            $('#locationlists tbody').append(row);
        });

        // ✅ Reinitialize DataTable
        $('#locationlists').DataTable({
            responsive: true
        });
    }




    function onError() {


    }

   
</script>
</body>


</html>