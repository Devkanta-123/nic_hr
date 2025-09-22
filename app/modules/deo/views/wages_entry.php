<!-- summernote -->
<link rel="stylesheet" href="assets/admin/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet"
    href="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.css">

<link rel="stylesheet" href="assets/admin/plugins/bootstrap-toggle-master/css/bootstrap-toggle.min.css">
<!-- Bootstrap Switch -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap3/bootstrap-switch.min.css"
    rel="stylesheet" />
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
                                Wages Entry
                            </div>

                        </div>
                        <!-- Ends here  -->
                        <div class="card-body">
                            <form id="#">
                                <div class="row">

                                    <div class="form-group col-md-4">
                                        <label for="adpayment">Employee</label>
                                        <select class="form-control" id="emp_id">
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="adpayment">Date of Joining</label>
                                        <input type="date" class="form-control" id="date_of_joining" name="date_of_joining"
                                            required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="adpayment">Increment Date</label>
                                        <input type="date" class="form-control" id="increment_date" name="increment_date"
                                            required>
                                    </div>


                                    <div class="form-group col-md-4">
                                        <label for="adpayment">WagesPerDay (W)</label>
                                        <input type="number" class="form-control" id="wages_per_day" name="wages_per_day"
                                            placeholder="Wages Per Day" required>
                                    </div>

                                    <div class="form-group col-md-4" id="incrementDiv" style="display:none;">
                                        <label for="increment_amount">Increment Amount</label>
                                        <input type="number" class="form-control" id="increment_amount" placeholder="Enter increment amount">
                                    </div>



                                </div>
                                <button type="button" id="saveBtn" class="btn btn-primary">Save</button>

                            </form>
                        </div>




                        <!-- /.card-body -->
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <div class="card">
                        <!-- Ends here  -->
                        <div class="card-body">
                            <table id="advanceAmounttable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">SL.NO</th>
                                        <th scope="col">Emp Name</th>
                                        <th scope="col">Date of Joining</th>
                                        <th scope="col">Increment Date</th>
                                        <th scope="col">Wages (W)</th>
                                        <th scope="col">HalfDay 50% of (W)</th>
                                        <th scope="col">Morning Shift 25% of (W)</th>
                                        <th scope="col">Evening Shift 50 % of (W)</th>
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
    let WorkID = '';
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
        const emp_id = $("#emp_id").val();
        const date_of_joining = $("#date_of_joining").val();
        const increment_date = $("#increment_date").val();
        let wages_per_day = parseFloat($("#wages_per_day").val());
        const increment_amount = parseFloat($("#increment_amount").val()) || 0; // use 0 if empty

        if (!emp_id || !date_of_joining || !increment_date || !wages_per_day) {
            showWarningNotification("Please fill all required fields.");
            return;
        }

        // If increment_amount is entered, add it to wages_per_day
        if (increment_amount > 0) {
            wages_per_day += increment_amount;
        }

        // Calculate half/morning/evening shifts
        const half_day = wages_per_day * 0.5;
        const morning_shift = wages_per_day * 0.25;
        const evening_shift = wages_per_day * 0.25;

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
        if ($.fn.DataTable.isDataTable('#advanceAmounttable')) {
            $('#advanceAmounttable').DataTable().clear().destroy();
        }

        // ✅ Clear the table body
        $('#advanceAmounttable tbody').empty();

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
            $('#advanceAmounttable tbody').append(row);
        });

        // ✅ Reinitialize DataTable
        $('#advanceAmounttable').DataTable({
            responsive: true
        });
    }




    function onError() {


    }
</script>