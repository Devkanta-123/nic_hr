<!-- Begin page -->
<!-- removeNotificationModal -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
                            <h5 class="card-title mb-0">Master Account</h5>

                            <!-- Button group aligned right -->

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="work_title">Account Name:</label>
                                    <input type="text" class="form-control" id="account_name"
                                        name="account_name" placeholder="Account Name..." required>
                                </div>
                            </div>
                            <br>
                            <button type="button" id="saveAccountbtn" class="btn btn-primary">Save</button>
                        </div>
                    </div>


                </div>
            </div>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                    </div>


                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="allowanceMasterdata" class="table table-bordered nowrap table-striped align-middle"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>SL No.</th>
                                        <th>Amount Name</th>
                                        
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
    $(function () {
        getAccountName();
    });

    $('#launchModalBtn').click(function () {
        $('#addWorkModal').modal('show');
    });
    $('#closeModal').click(function () {
        $('#addWorkModal').modal('hide');
    });
    function assign(workId) {

        // Optional: Store the workId for later use (e.g. in hidden input)
        console.log("Assigned Work ID:", workId);
        WorkID = workId;
        $('#assignModal').modal('show'); // Show the modal
    }


  $('#saveAccountbtn').click(function () {
        saveAccountName();
    });

    async function saveAccountName() {
        // Get values from form
        const account_name = $("#account_name").val();
        // Validation
        if (!account_name) {
            showWarningNotification("Please enter  account name.");
            return;
        }

        let obj = {
            Module: "Deo",
            Page_key: "saveAccountName",
            JSON: {
                account_name: account_name               
            }
        };
        TransportCall(obj);
    }



    function getAccountName() {
        var obj = new Object();
        obj.Module = "Deo";
        obj.Page_key = "getAccountName";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }




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
                case "saveAccountName":
                    showSuccessNotification(rc.return_data);
                    getAccountName();
                    break;
                case "getAccountName":
                    loaddata(rc.return_data);
                    break;
                default:
                    showWarningNotification("warning");
            }
        } else {
            showWarningNotification("warning");
        }
    }


    function populateLocationDropdown(locs) {
        const $locationselect = $('#loc_id');
        $locationselect.empty(); // Clear previous options
        $locationselect.append('<option value="">Select Location</option>');
        locs.forEach(function (locs) {
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
        emp.forEach(function (emp) {
            $empselect.append(
                $('<option>', {
                    value: emp.emp_id,
                    text: emp.emp_name
                })
            );
        });
    }

    $('#saveBtn').click(function () {
        saveAccountName();
    });

   


    async function assignWork() {

        // Get values from modal form fields (make sure these inputs exist inside your modal)
        const work_id = WorkID;  // Stored when modal opened
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
            Page_key: "assignWork",   // You can set this key as needed in your API
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

    }

    function assignModalClose() {
        $('#assignModal').modal('hide');
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
        if ($.fn.DataTable.isDataTable('#allowanceMasterdata')) {
            $('#allowanceMasterdata').DataTable().clear().destroy();
        }

        // ✅ Clear the table body
        $('#allowanceMasterdata tbody').empty();

        // ✅ Populate the table with new data
        $.each(data, function (index, item) {
            var row = $('<tr>');
            row.append($('<td>').text(index + 1));
            row.append($('<td>').text(item.account_name));
            $('#allowanceMasterdata tbody').append(row);
        });

        // ✅ Reinitialize DataTable
        $('#allowanceMasterdata').DataTable({
            responsive: true
        });
    }




    function onError() {


    }





</script>