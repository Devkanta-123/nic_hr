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
                            <h5 class="card-title mb-0">Wages Entry</h5>

                            <!-- Button group aligned right -->

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="work_title">Employee </label>
                                    <select class="form-control" id="emp_id">
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="work_title">Date of Joining</label>
                                    <input type="date" class="form-control" id="date_of_joining" name="date_of_joining"
                                        required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="adpayment">Increment Date</label>
                                    <input type="date" class="form-control" id="increment_date" name="increment_date"
                                        required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="adpayment">WagesPerDay (W)</label>
                                    <input type="number" class="form-control" id="wages_per_day" name="wages_per_day"
                                        placeholder="Wages Per Day" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="adpayment">HalfDay Amount in Percentage</label>
                                    <input type="text" class="form-control" id="halfdayamount" name="halfdayamount"
                                        required placeholder="HalfDay Amount in Percentage" maxlength="2">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="adpayment">MorningShift Amount in Percentage</label>
                                    <input type="text" class="form-control" id="morningshift_amount" name="morningshift_amount"
                                        placeholder="MorningShift Amount in Percentage" required  maxlength="2">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="adpayment">EveningShift Amount in Percentage</label>
                                    <input type="text" class="form-control" id="eveningshift_amount" name="eveningshift_amount"
                                        placeholder="EveningShift Amount in Percentage" required  maxlength="2">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6" id="incrementDiv" style="display:none;">
                                    <label for="increment_amount">Increment Amount</label>
                                    <input type="number" class="form-control" id="increment_amount" placeholder="Enter increment amount">
                                </div>
                               
                            </div>
                                <br>
     <button type="button" id="saveBtn" class="btn btn-primary">Save</button>

                        </div> 
                   
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
                    <table id="wagesMasterDataTable" class="table table-bordered nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">SL.NO</th>
                                <th scope="col">Emp Name</th>
                                <th scope="col">Date of Joining</th>
                                <th scope="col">Increment Date</th>
                                <th scope="col">Wages (W)</th>
                                <th scope="col">HalfDay</th>
                                <th scope="col">Morning Shift</th>
                                <th scope="col">Evening Shift</th>

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
    $(function() {
        getMasterWages();
        getActiveEmployeeList();
    });

    $('#launchModalBtn').click(function() {
        $('#addWorkModal').modal('show');
    });
    $('#closeModal').click(function() {
        $('#addWorkModal').modal('hide');
    });

    function assign(workId) {

        // Optional: Store the workId for later use (e.g. in hidden input)
        console.log("Assigned Work ID:", workId);
        WorkID = workId;
        $('#assignModal').modal('show'); // Show the modal
    }


    $('#saveAccountbtn').click(function() {
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



    function getMasterWages() {
        var obj = new Object();
        obj.Module = "Deo";
        obj.Page_key = "getMasterWages";
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



    let masterWagesData;

    function onSuccess(rc) {
        debugger;
        if (rc.return_code) {
            switch (rc.Page_key) {
                case "saveWagesData":
                    showSuccessNotification(rc.return_data);
                    getMasterWages();
                    break;
                case "getMasterWages":
                    console.log(rc.return_data);
                    masterWagesData = rc.return_data; // your fetched array
                    loaddata(rc.return_data);
                    break;

                case "getActiveEmployeeList":
                    populateEmployeeDropdown(rc.return_data);

                    break;

                default:
                    showWarningNotification(rc.return_data);
            }
        } else {
            showWarningNotification(rc.return_data);
        }
    }

    $('#emp_id').on('change', function() {
        const emp_id = $(this).val();
        if (!emp_id) return;

        // Ensure masterWagesData is an array
        const empData = Array.isArray(masterWagesData) ? masterWagesData : [];

        // Filter records for selected employee
        const empRecords = empData.filter(r => r.EmpID == emp_id);

        if (empRecords.length > 0) {
            // Show increment amount input
            $('#incrementDiv').show();

            // Find latest record by CreatedAt safely
            const latestRecord = empRecords.reduce((prev, current) => {
                return new Date(prev.CreatedAt) > new Date(current.CreatedAt) ? prev : current;
            });

            if (latestRecord) {
                $('#wages_per_day').val(latestRecord.WagesPerDay || '');
                $('#increment_date').val(new Date().toISOString().split('T')[0]);
                $('#date_of_joining').val(latestRecord.DateOfJoining || '');
            }
        } else {
            // Hide increment input for new employees
            $('#incrementDiv').hide();

            // Clear fields safely
            $('#date_of_joining').val('');
            $('#wages_per_day').val('');
            $('#increment_date').val('');
            $('#increment_amount').val('');
        }
    });



    function populateEmployeeDropdown(emp) {
        const $empselect = $('#emp_id');
        $empselect.empty(); // Clear previous options
        $empselect.append('<option value="">Select Employee</option>');

        emp.forEach(function(e) {
            $empselect.append(
                $('<option>', {
                    value: e.emp_id,
                    text: e.emp_name,
                    'data-doj': e.date_of_joining // store date_of_joining in data attribute
                })
            );
        });
    }

    $('#emp_id').on('change', function() {
        const selectedOption = $(this).find('option:selected');
        const doj = selectedOption.data('doj'); // get data-doj attribute
        $('#date_of_joining').val(doj || ''); // autofill input, or clear if none selected
    });




    $('#saveBtn').click(function() {
        saveWagesData();
    });

    async function saveWagesData() {
        debugger;
        const emp_id = $("#emp_id").val();
        const date_of_joining = $("#date_of_joining").val();
        const increment_date = $("#increment_date").val();
        let wages_per_day = parseFloat($("#wages_per_day").val());

        // Percentages entered by user
        const halfdayamount = parseFloat($("#halfdayamount").val()) || 0;
        const morningshift_amount = parseFloat($("#morningshift_amount").val()) || 0;
        const eveningshift_amount = parseFloat($("#eveningshift_amount").val()) || 0;

        const increment_amount = parseFloat($("#increment_amount").val()) || 0; // use 0 if empty

        if (!emp_id || !date_of_joining || !increment_date || !wages_per_day) {
            showWarningNotification("Please fill all required fields.");
            return;
        }

        // If increment_amount is entered, add it to wages_per_day
        if (increment_amount > 0) {
            wages_per_day += increment_amount;
        }

        // Calculate shift amounts using entered percentages
        const half_day = (wages_per_day * halfdayamount) / 100;
        const morning_shift = (wages_per_day * morningshift_amount) / 100;
        const evening_shift = (wages_per_day * eveningshift_amount) / 100;

        let obj = {
            Module: "Deo",
            Page_key: "saveWagesData",
            JSON: {
                emp_id,
                date_of_joining,
                increment_date,
                wages_per_day,
                half_day,
                morning_shift,
                evening_shift
            }
        };

        // Call API
        TransportCall(obj);

        console.log(JSON.stringify(obj, null, 2));
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
        if ($.fn.DataTable.isDataTable('#wagesMasterDataTable')) {
            $('#wagesMasterDataTable').DataTable().clear().destroy();
        }

        // ✅ Clear the table body
        $('#wagesMasterDataTable tbody').empty();

        // ✅ Populate the table with new data
        $.each(data, function(index, item) {
            var row = $('<tr>');
            row.append($('<td>').text(index + 1));
            row.append($('<td>').text(item.emp_name));
            row.append($('<td>').text(item.DateOfJoining));
            row.append($('<td>').text(item.IncrementDate));
            row.append($('<td>').text(item.WagesPerDay));
            row.append($('<td>').text(item.HalfDay));
            row.append($('<td>').text(item.MorningShift));
            row.append($('<td>').text(item.EveningShift));
            $('#wagesMasterDataTable tbody').append(row);
        });

        // ✅ Reinitialize DataTable
        $('#wagesMasterDataTable').DataTable({
            responsive: true
        });
    }




    function onError() {


    }
</script>