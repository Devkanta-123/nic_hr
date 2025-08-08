<!-- summernote -->
<link rel="stylesheet" href="assets/admin/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet"
    href="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.css">

<link rel="stylesheet" href="assets/admin/plugins/bootstrap-toggle-master/css/bootstrap-toggle.min.css">
<!-- Bootstrap Switch -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                PaySlip Entry
                            </div>

                            <span class="float-right">
                                <a href="deodash" class="btn btn-primary btn-xs custom-btn">Back to lists</a>
                            </span>
                        </div>
                        <div class="card-body">

                            <table id="payslipempAttendance" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Emp Name</th>
                                        <th scope="col">Total days</th>
                                        <th scope="col">PresentDays/WorkingDays</th>
                                        <th scope="col">Action</th>
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

<div class="modal fade" id="entryFormModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pay Slip Entry</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <form id="entryForm">
                        <input type="hidden" id="modal-empid">

                        <div class="form-group">
                            <label>Employee Name</label>
                            <input type="text" class="form-control" id="modal-empname" readonly>
                        </div>

                        <div class="form-group">
                            <label>Present Days</label>
                            <input type="number" class="form-control" id="modal-presentdays" readonly>
                        </div>

                        <!-- Two-column row for Opening Balance & Advance -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Opening Balance</label>
                                <input type="number" class="form-control" id="modal-openingbalance">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Advance</label>
                                <input type="number" class="form-control" id="modal-advance">
                            </div>
                        </div>

                        <!-- Two-column row for Current Advance & Amount Paid -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Current Advance</label>
                                <input type="number" class="form-control" id="modal-currentadvance">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Amount Paid</label>
                                <input type="number" class="form-control" id="modal-amountpaid">
                            </div>
                        </div>

                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveEntry">Save Entry</button>
            </div>
        </div>
    </div>
</div>



<!-- /.content-wrapper -->
<!-- validating input -->

<!-- Summernote -->
<script src="assets/admin/plugins/summernote/summernote-bs4.min.js"></script>

<script src="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.js"></script>
<script src="assets/admin/plugins/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>

<script>
    $(function() {
        getEmployeesAttendanceForPaySlip()

    });

    function getEmployeesAttendanceForPaySlip() {
        var obj = new Object();
        obj.Module = "Employee";
        obj.Page_key = "getEmployeesAttendanceForPaySlip";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }
    let employeeAttendanceData = [];

    function onSuccess(rc) {
        debugger;
        if (rc.return_code) {
            switch (rc.Page_key) {
                case "getEmployeesAttendanceForPaySlip":
                    employeeAttendanceData = rc.return_data;
                    // loadTodayAttendance();
                    loaddata(rc.return_data)
                    // document.querySelector('input[type="date"]').value = getTodayDate();
                    break;
                case "savePaySlipEntry":
                    console.log(rc.return_data);
                    notify('success',rc.return_data);
                    getEmployeesAttendanceForPaySlip();
                    break;



                default:
                    alert(rc.Page_key);
            }
        } else {
            alert(rc.return_data);
        }
        // alert(JSON.stringify(args));
    }


    function searchOnDate() {
        const selectedDate = document.querySelector('input[type="date"]').value;
        if (!selectedDate) {
            loaddata(employeeAttendanceData); // If no date selected, show all
            return;
        }

        const filteredData = employeeAttendanceData.filter(emp => emp.attendance_date === selectedDate);
        loaddata(filteredData);
    }


    function    loaddata(data) {
        const table = $("#payslipempAttendance");
        try {
            if ($.fn.DataTable.isDataTable(table)) {
                table.DataTable().clear().draw();
                table.DataTable().destroy();
            }
        } catch (ex) {
            console.error("Error destroying DataTable:", ex);
        }

        let text = "";

        if (!data || data.length === 0) {
            text += "<tr><td colspan='6'>No Data Found</td></tr>";
        } else {
            for (let i = 0; i < data.length; i++) {
                const emp = data[i];
                text += `<tr>`;
                text += `<td>${emp.emp_name}</td>`;
                text += `<td>${emp.total_days}</td>`;
                text += `<td>${emp.present_days || 'N/A'}</td>`;

                if (emp.IsGenerated === 0) {
                    const encodedID = btoa(emp.emp_id); // Basic Base64 encoding
                    text += `<td>
        <button class="btn btn-sm btn-success generate-btn" 
            data-empid="${encodedID}">Generate</button>
    </td>`;
                } else {
                    text += `<td>
        <button class="btn btn-sm btn-primary entry-btn" 
            data-empid="${emp.emp_id}" 
            data-empname="${emp.emp_name}" 
            data-present="${emp.present_days}">Enter Data</button>
    </td>`;
                }

                text += `</tr>`;
            }
        }

        $("#payslipempAttendance tbody").html(text);

        if (data && data.length > 0) {
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
        }
    }


    $(document).on('click', '.entry-btn', function() {
        const emp_id = $(this).data('empid');
        const emp_name = $(this).data('empname');
        const present_days = $(this).data('present');

        $('#modal-empid').val(emp_id);
        $('#modal-empname').val(emp_name);
        $('#modal-presentdays').val(present_days);

        // Clear previous values
        $('#modal-openingbalance').val('');
        $('#modal-advance').val('');
        $('#modal-currentadvance').val('');
        $('#modal-amountpaid').val('');

        $('#entryFormModal').modal('show');
    });

    // Call reusable function on click
    $('#saveEntry').on('click', function() {
        submitPaySlipEntry();
    });

    // Reusable function
    function submitPaySlipEntry() {
        debugger;
        const emp_id = $('#modal-empid').val();
        const present_days = $('#modal-presentdays').val();
        const opening_balance = $('#modal-openingbalance').val();
        const advance = $('#modal-advance').val();
        const current_advance = $('#modal-currentadvance').val();
        const amount_paid = $('#modal-amountpaid').val();

        if (!emp_id) {
            alert("Employee ID missing!");
            return;
        }

        const dailyRate = 500;
        const total_pay = present_days * dailyRate;

        const obj = {
            Module: "Deo",
            Page_key: "savePaySlipEntry",
            JSON: {
                emp_id: emp_id,
                present_days: present_days,
                total_pay: total_pay, // ✅ Added this line
                opening_balance: opening_balance,
                advance: advance,
                current_advance: current_advance,
                amount_paid: amount_paid
            }
        };

        TransportCall(obj);
        $('#entryFormModal').modal('hide');
    }

 $(document).on('click', '.generate-btn', function () {
    const encodedEmpId = $(this).data('empid');
    const url = `deo-generatepayslip?emp=${encodedEmpId}`;
    window.open(url, '_blank');
});


</script>