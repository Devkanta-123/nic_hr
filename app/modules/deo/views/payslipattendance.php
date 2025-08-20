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
    #payslipDataTable {
        width: 80%;
        margin: 0 auto;
        border-collapse: collapse;
        margin-top: 20px;
        font-family: Arial, sans-serif;
        font-size: 14px;
    }

    #payslipDataTable th,
    #payslipDataTable td {
        border: 1px solid #000;
        padding: 8px 12px;
        text-align: left;
        vertical-align: top;
    }

    #payslipDataTable .center-text {
        text-align: center;
        font-weight: bold;
    }

    .payslip-hide {
    visibility: hidden;
    position: absolute; /* removes it from normal layout */
    left: -9999px;      /* move offscreen */
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    &nbsp;
                    From date:
                    <input type="date" id="fromDate">
                    To date:
                    <input type="date" id="Todate">
                    <br>
                    <br>
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
                                        <th scope="col">PresentDays</th>
                                        <th scope="col">Advance</th>
                                        <th scope="col">Amount Paid</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- pay slip table with data  -->

<table id="payslipDataTable" class="payslip-hide">
    <tr>
        <th class="center-text" colspan="4">Pay Slip</th>
    </tr>

    <!-- Date & Name side by side -->
    <tr>
        <td><strong>From Date:</strong></td>
        <td id="fromDateTable">xx/xx/xxxx</td>
        <td><strong>To Date:</strong></td>
        <td id="todateTable">XXXXX</td>
    </tr>

    <tr>
        <td><strong>Generated On:</strong></td>
        <td id="slipDate">xx/xx/xxxx</td>
        <td><strong>Name:</strong></td>
        <td id="slipName">XXXXX</td>
    </tr>

    <!-- Previous balance/advance -->
    <tr>
        <td><strong id="previousLabel">Previous Balance</strong></td>
        <td id="previousBalance">0</td>
        <td colspan="2"></td>
    </tr>

    <!-- Current Week Summary Title -->
    <tr>
        <td colspan="4" class="center-text"><strong>Current Week</strong></td>
    </tr>

    <!-- Present Days & Total Pay -->
    <tr>
        <td><strong>Present Days:</strong></td>
        <td id="presentDays">0</td>
        <td><strong>Total Pay:</strong></td>
        <td id="totalAmount">0</td>
    </tr>

    <!-- Advance & Gross Amount -->
    <tr>
        <td><strong>Advance:</strong></td>
        <td id="advance">0</td>
        <td><strong>Gross Amount:</strong></td>
        <td id="grossAmount">0</td>
    </tr>

    <!-- Net Amount & Amount Paid -->
    <tr>
        <td><strong>Net Amount:</strong></td>
        <td id="netAmount">0</td>
        <td><strong>Amount Paid:</strong></td>
        <td id="amountPaid">0</td>
    </tr>

    <!-- Amount Due & Closing -->
    <tr>
        <td><strong>Amount Due:</strong></td>
        <td id="amountDue">0</td>
        <td><strong id="closingLabel">Closing Balance:</strong></td>
        <td id="closingAmount">0</td>
    </tr>
</table>




<!-- /.content-wrapper -->
<!-- validating input -->

<!-- Summernote -->
<script src="assets/admin/plugins/summernote/summernote-bs4.min.js"></script>
<script src="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.js"></script>
<script src="assets/admin/plugins/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
    $(function() {
        getEmployeesAttendanceForPaySlip();
        //getEmployeesAttendanceFilter();

    });




    function getEmployeesAttendanceForPaySlip() {
        var obj = new Object();
        obj.Module = "Employee";
        obj.Page_key = "getEmployeesAttendanceForPaySlip";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }


    function getEmployeesAttendanceFilter() {
        var obj = new Object();
        obj.Module = "Employee";
        obj.Page_key = "getEmployeesAttendanceFilter";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

// Disable Sundays in the datepicker
function disableSundays(dateInput) {
    dateInput.on('input', function() {
        const dateStr = $(this).val();
        if (!dateStr) return;

        const selectedDate = new Date(dateStr);
        const day = selectedDate.getDay(); // 0 = Sunday, 6 = Saturday

        if (day === 0) {
            alert("Sundays are not allowed. Please select another date.");
            $(this).val(''); // Clear the selected date
        }
    });
}

// Apply to both FromDate and ToDate
disableSundays($('#fromDate'));
disableSundays($('#Todate'));


    let rawAttendanceData = [];
    let AllowanceMasterdata = [];
    let allEmployees = []; // from backend (with IsGenerated)
    let allAttendance = []; // raw attendance
    let AdvanceMasterdata = {}; // just amount
    function onSuccess(rc) {
        if (rc.return_code) {
            switch (rc.Page_key) {
                case "getEmployeesAttendanceForPaySlip":
                    AdvanceMasterdata = rc.return_data.advance;
                    AllowanceMasterdata = rc.return_data.allowance;
                    allEmployees = rc.return_data.employees;
                    allAttendance = rc.return_data.attendance;
                    console.log(allEmployees);
                    console.log(allAttendance);
                    break;

                case "getEmployeesAttendanceFilter":
                    rawAttendanceData = rc.return_data;
                    // loadfilterdata(rc.return_data)
                    console.log(rc.return_data);
                    break;


                case "savePaySlipEntry":
                    console.log(rc.return_data);
                    notify('success', rc.return_data);
                    loaddata();
                    break;
                case "getPaySlipsDataByEmpID":
                    console.log(rc.return_data);
                    loadPaySlipData(rc.return_data);
                    break;


                default:
                    alert(rc.Page_key);
            }
        } else {
            alert(rc.return_data);
        }
        // alert(JSON.stringify(args));
    }


  function loadPaySlipData(data) {
    // Fill table values
    $('#slipDate').text(new Date(data.CreatedAt).toLocaleDateString());
    $('#slipName').text(data.emp_name);
    $('#fromDateTable').text($("#fromDate").val());
    $('#todateTable').text($("#Todate").val());

    let previousLabel = "Previous Balance";
    if (parseFloat(data.OpeningBalance) == 0 && parseFloat(data.CurrentAdvance) > 0) {
        previousLabel = "Previous Advance";
    }
    $('#previousLabel').text(previousLabel);
    $('#previousBalance').text(parseFloat(data.OpeningBalance || 0) || parseFloat(data.CurrentAdvance || 0));

    $('#presentDays').text(data.PresentDays);
    $('#totalAmount').text(data.TotalPay);
    $('#advance').text(data.Advance);
    $('#grossAmount').text(data.GrossAmount);
    $('#netAmount').text(data.NetPay);
    $('#amountPaid').text(data.AmountPaid);
    $('#amountDue').text(data.AmountDue);

    let closingLabel = "Closing Balance";
    if (parseFloat(data.NewCurrentAdvance) > 0) {
        closingLabel = "Closing Advance";
    }
    $('#closingLabel').text(closingLabel);
    $('#closingAmount').text(data.NewBalance);

    // Show table temporarily for PDF
    $('#payslipDataTable').removeClass('payslip-hide');

    setTimeout(function() {
        printPayslip();
    }, 200);
}

function printPayslip() {
    const element = document.getElementById('payslipDataTable');

    // Get employee name and dates
    const empName = $('#slipName').text().replace(/\s+/g, '_'); // replace spaces with underscores
    const fromDate = $('#fromDateTable').text().replace(/\//g, '-'); // replace slashes
    const toDate = $('#todateTable').text().replace(/\//g, '-');

    // Construct filename
    const filename = `payslip_${empName}_${fromDate}_${toDate}.pdf`;

    var opt = {
        margin: 10,
        filename: filename,
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
    };

    // Temporarily show table for PDF
    $('#payslipDataTable').removeClass('payslip-hide');

    html2pdf().set(opt).from(element).save().then(() => {
        // Hide table again after PDF generation
        $('#payslipDataTable').addClass('payslip-hide');
    });
}


    // new common function

    // Event binding on date change
    $("#fromDate, #Todate").on("change", function() {
        filterAndLoad();
    });


    function filterAndLoad() {
        const from = $("#fromDate").val();
        const to = $("#Todate").val();
        if (!from || !to) {
            return; // only run when both are selected
        }

        let filteredRows = [];
        allEmployees.forEach(emp => {
            const count = allAttendance.filter(a =>
                a.emp_id == emp.emp_id &&
                a.status.toLowerCase() === 'present' &&
                a.attendance_date >= from &&
                a.attendance_date <= to
            ).length;

            filteredRows.push({
                emp_id: emp.emp_id,
                emp_name: emp.emp_name,
                present_days: count,
                IsGenerated: emp.IsGenerated
            });
        });

        loaddata(filteredRows, AdvanceMasterdata);
    }


    function loaddata(data, AdvanceMasterdata) {
        const table = $("#payslipempAttendance");

        // Properly destroy existing DataTable
        if ($.fn.DataTable.isDataTable(table)) {
            table.DataTable().clear().destroy();
        }

        // Remove any leftover wrapper from DataTable
        table.find('tbody').empty(); // clear tbody

        let text = "";

        if (!data || data.length === 0) {
            text = "<tr><td colspan='6' class='text-center'>No Data Found</td></tr>";
        } else {
            for (let i = 0; i < data.length; i++) {
                const emp = data[i];
                text += `<tr>`;
                text += `<td>${emp.emp_name}</td>`;
                text += `<td>${emp.present_days || 'N/A'}</td>`;
                text += `<td>${AdvanceMasterdata.advanceamount || 0}</td>`;

                if (emp.IsGenerated == 0) {
                    text += `<td>
            <input type="number" class="form-control amount-input"
                data-empid="${emp.emp_id}" placeholder="Enter Amount">
            </td>`;
                } else {
                    text += `<td></td>`;
                }
                // Now logic: If already generated and same date range
                const selectedFrom = $("#fromDate").val();
                const selectedTo = $("#Todate").val();
                // Check matching date range
                const isSameRange = emp.FromDate == selectedFrom && emp.ToDate == selectedTo;
                if (emp.IsGenerated == 0) {
                    // show "Save" btn
                    text += `<td>
                 <button class="btn btn-sm btn-primary entry-btn"
                 data-empid="${emp.emp_id}"
                 data-empname="${emp.emp_name}"
                 data-present="${emp.present_days}">Save</button>
                 </td>`;
                } else {
                    if (isSameRange) {
                        // Already generated in same selected range:
                        text += `<td><span class="text-danger">Generated for this range</span></td>`;
                    } else {
                        text += `<td>
                     <button class="btn btn-sm btn-success generate-btn"
                     data-empid="${emp.emp_id}"
                     data-from="${emp.FromDate}"
                     data-to="${emp.ToDate}">Generate PaySlip</button>
                     </td>`;
                    }
                }
                text += `</tr>`;
            }

            $("#payslipempAttendance tbody").html(text);

            // Re-initialize DataTable
            if (data && data.length > 0) {
                table.DataTable({
                    responsive: true,
                    pageLength: 10,
                    destroy: true, // ADD THIS LINE TO SAFELY REINIT EVERYTIME
                    order: []
                });
            }
        }
    }








    let amountPaid, emp_id, present_days;
    $(document).on('click', '.entry-btn', function() {
        emp_id = $(this).data('empid');
        emp_name = $(this).data('empname');
        present_days = $(this).data('present');
        // Get Amount Paid from the same row
        amountPaid = $(this).closest('tr').find('.amount-input').val() || 0;
        $('#modal-amountpaid').val(amountPaid);

        // Clear other fields
        $('#modal-openingbalance').val('');
        $('#modal-advance').val('');
        $('#modal-currentadvance').val('');

        // Now call your submit or any next function
        submitPaySlipEntry();
    });


    // Call reusable function on click
    $('#saveEntry').on('click', function() {

    });



    //     advanceamount
    // : 
    // "2000.00"
    // allowanceamount
    // : 
    // "3000.00"
    // Reusable function
    function submitPaySlipEntry() {
        const opening_balance = 500;
        const advance = AdvanceMasterdata.advanceamount;
        const current_advance = 0;

        // Also fetch from/to date from inputs
        const fromDate = $("#fromDate").val();
        const toDate = $("#Todate").val();

        if (!emp_id) {
            alert("Employee ID missing!");
            return;
        }
        if (!amountPaid) {
            alert("Enter the Amount");
            return;
        }
        if (!fromDate || !toDate) {
            alert("Please select both From Date and To Date");
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
                from_date: fromDate, // ✅ added
                to_date: toDate, // ✅ added
                total_pay: total_pay,
                opening_balance: opening_balance,
                advance: advance,
                current_advance: current_advance,
                amount_paid: amountPaid
            }
        };

        TransportCall(obj);
    }


    $(document).on('click', '.generate-btn', function() {
        debugger;
        const empId = $(this).data('empid');
        getPaySlipsDataByEmpID(empId)
    });

    function getPaySlipsDataByEmpID(empId) {
        var obj = new Object();
        obj.Module = "Employee";
        obj.Page_key = "getPaySlipsDataByEmpID";
        var json = new Object();
        json.emp_id = empId;
        obj.JSON = json;
        TransportCall(obj);
    }
</script>