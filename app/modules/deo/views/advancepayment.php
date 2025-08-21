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
                                Advance Payment
                            </div>

                        </div>
                        <!-- Ends here  -->
                        <div class="card-body">
                            <form id="#">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="adpayment">Types Of Payment</label>
                                        <input type="text" class="form-control" id="typesofpayment" name="typesofpayment"
                                            placeholder="Types Of Payment" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="adpayment">Employee</label>
                                        <select class="form-control" id="emp_id">
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="adpayment">Amount</label>
                                        <input type="number" class="form-control" id="amount" name="amount"
                                            placeholder="Amount" required>
                                    </div>


                                    <button type="button" id="saveBtn" class="btn btn-primary">Save</button>
                                </div>

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
                                        <th scope="col">Amount</th>
                                        <th scope="col">Emp Name</th>
                                        <th scope="col">Types Of Payment</th>
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
        getPaymentsData();
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





    function getPaymentsData() {
        var obj = new Object();
        obj.Module = "Deo";
        obj.Page_key = "getPaymentsData";
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
                case "savePaymentData":
                    showSuccessNotification(rc.return_data);
                    getPaymentsData();
                    break;
                case "getPaymentsData":
                    loaddata(rc.return_data);
                    break;

                case "getActiveEmployeeList":
                    populateEmployeeDropdown(rc.return_data);
                    break;

                default:
                    showWarningNotification("warning");
            }
        } else {
            showWarningNotification("warning");
        }
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

    $('#saveBtn').click(function() {
        savePaymentData();
    });

    async function savePaymentData() {
        debugger;
        // Get values from form
        const typesofpayment = $("#typesofpayment").val();
        const emp_id = $("#emp_id").val();
        const amount = $("#amount").val();
        // Validation
        if (!typesofpayment) {
            showWarningNotification("Please enter types of payment.");
            return;
        }
        if (!emp_id) {
            showWarningNotification("Please Select the employee");
            return;
        }


        if (!amount) {
            showWarningNotification("Please enter the amount");
            return;
        }



        let obj = {
            Module: "Deo",
            Page_key: "savePaymentData",
            JSON: {
                typesofpayment: typesofpayment,
                emp_id: emp_id,
                amount: amount
            }
        };

        // Call API
        TransportCall(obj);

        console.log(JSON.stringify(obj, null, 2));

        // Clear form after saving
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
            row.append($('<td>').text(item.Amount));
            row.append($('<td>').text(item.emp_name));
            row.append($('<td>').text(item.TypesOfPayment));
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