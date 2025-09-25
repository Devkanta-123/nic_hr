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
        position: absolute;
        /* removes it from normal layout */
        left: -9999px;
        /* move offscreen */
    }

    #closingLabel,
    #closingAmount {
        display: none;
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
                    <input type="date" id="Todate"> &nbsp;
                    <button id="loadBtn" class="btn btn-success">Load Data</button>
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
                                        <th scope="col">Present No of Days</th>
                                        <th scope="col">Wages Amount</th> <!-- ✅ New column -->
                                        <th scope="col">Due Advance</th>
                                        <th scope="col">Total Amount</th>
                                        <th scope="col">Advance</th>
                                        <th scope="col">Gross Amount</th>
                                        <th scope="col">Net Amount</th>
                                        <th scope="col">Amount Paid</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data will be loaded dynamically by JS -->
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
        <td><strong>Wages of Pay(WoP):</strong></td>
        <td id="WoP">000</td>
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
        <td><strong id="amountDueLabel">Amount Due:</strong></td>
        <td id="amountDue">0</td>
        <td><strong id="closingLabel">Closing Balance:</strong></td>
        <td id="closingAmount">0</td>
    </tr>

  <!-- Signature Row -->
<tr style="border: none;">
    <td colspan="2" style="border: none;"></td>
    <td colspan="2" style="border: none; text-align: right; padding-top: 40px;">
        <strong>Signature</strong><br>
    </td>
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
        getMasterWages();
        //getEmployeesAttendanceFilter();

    });


    function getMasterWages() {
        var obj = new Object();
        obj.Module = "Deo";
        obj.Page_key = "getMasterWages";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }



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

    function disableSundays(dateInput) {
        dateInput.on('input', function() {
            const dateStr = $(this).val();
            if (!dateStr) return;

            const selectedDate = new Date(dateStr);
            const day = selectedDate.getDay(); // 0 = Sunday, 1 = Monday, ..., 6 = Saturday

            if (day === 0) { // Sunday
                alert("Sundays are not allowed. Please select another date.");
                $(this).val('');
            } else if (day === 1) { // Monday
                // If Monday, auto-calculate Saturday
                const newDate = new Date(selectedDate);
                newDate.setDate(selectedDate.getDate() + 5); // Monday + 5 days = Saturday

                const formatted = newDate.toISOString().split('T')[0];
                $("#Todate").val(formatted);
                $("#Todate").prop('readonly', true); // prevent manual change
            } else {
                $("#Todate").val('');
                $("#Todate").prop('readonly', false);
            }
        });
    }

    disableSundays($('#fromDate'));
    disableSundays($('#Todate'));


    let masterwagesData = [];
    let rawAttendanceData = [];
    let AllowanceMasterdata = [];
    let allEmployees = []; // from backend (with IsGenerated)
    let allAttendance = []; // raw attendance
    let AdvanceMasterdata = {}; // just amount
    function onSuccess(rc) {
        debugger;
        if (rc.return_code) {
            switch (rc.Page_key) {
                case "getEmployeesAttendanceForPaySlip":
                    AdvanceMasterdata = rc.return_data.advance;
                    AllowanceMasterdata = rc.return_data.allowance;
                    allEmployees = rc.return_data.employees;
                    allAttendance = rc.return_data.attendance;
                    console.log(allEmployees);
                    console.log(allAttendance);
                    console.log(AdvanceMasterdata);
                    break;

                case "getEmployeesAttendanceFilter":
                    rawAttendanceData = rc.return_data;
                    // loadfilterdata(rc.return_data)
                    console.log(rc.return_data);
                    break;
                case "savePaySlipEntry":
                    debugger;
                    console.log(rc.return_data);
                    notify('success', rc.return_data);
                    const f = $("#fromDate").val();
                    const t = $("#Todate").val();
                    // You might want to refresh your employee list too
                    getEmployeesAttendanceForPaySlip();
                    filterAndLoad(); // or loaddata(...)
                    setTimeout(function() {
                        $("#loadBtn").trigger("click");
                    }, 1000); // 1000 ms = 1 sec
                    break;




                case "getPaySlipsDataByEmpIDandSlipID":
                    console.log("getPaySlipsDataByEmpIDandSlipID", rc.return_data);
                    loadPaySlipData(rc.return_data);
                    break;

                case "getMasterWages":
                    console.log("masterwages", rc.return_data);
                    masterwagesData = rc.return_data;
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
        debugger;
        // Fill table values
        $('#slipDate').text(new Date(data.CreatedAt).toLocaleDateString());
        $('#slipName').text(data.emp_name);
        $('#fromDateTable').text($("#fromDate").val());
        $('#todateTable').text($("#Todate").val());
        // Previous balance or advance
        let previousLabel = "Previous Balance";
        if (parseFloat(data.OpeningBalance) == 0 && parseFloat(data.CurrentAdvance) > 0) {
            previousLabel = "Previous Advance";
        }
        $('#previousLabel').text(previousLabel);
        $('#previousBalance').text(parseFloat(data.OpeningBalance || 0) || parseFloat(data.CurrentAdvance || 0));

        // Current week summary
        $('#presentDays').text(data.PresentDays);
        $('#totalAmount').text(data.TotalPay);
        $('#advance').text(data.Advance);
        $('#grossAmount').text(data.GrossAmount);
        $('#netAmount').text(data.NetPay);
        $('#amountPaid').text(data.AmountPaid);
        $('#WoP').text(data.WoP);

        // Amount Due / Current Advance (dynamic)
        let amtDue = parseFloat(data.AmountDue || 0);
        if (amtDue < 0) {
            $('#amountDueLabel').text("Current Advance");
            $('#amountDue').text(Math.abs(amtDue)); // show as positive advance
        } else {
            $('#amountDueLabel').text("Amount Due");
            $('#amountDue').text(amtDue);
        }

        // Closing balance or advance
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
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'mm',
                format: 'a4',
                orientation: 'portrait'
            }
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
    $("#loadBtn").on("click", function() {
        filterAndLoad();
    });


    // Filter employees and calculate present_days
    // function filterAndLoad() {
    //     debugger;
    //     const from = $("#fromDate").val();
    //     const to = $("#Todate").val();
    //     if (!from || !to) return;

    //     let filteredRows = [];

    //     allEmployees.forEach(emp => {
    //         // ✅ Ensure wages_amount is a number
    //         const empWage = parseFloat(emp.wages_amount) || 0;

    //         // ✅ Filter attendance for this employee in date range
    //         const empAttendance = allAttendance.filter(a =>
    //             a.emp_id == emp.emp_id &&
    //             a.attendance_date >= from &&
    //             a.attendance_date <= to
    //         );

    //         // ✅ Only "Present" and "HalfDay" count for wages
    //         const present_days = empAttendance.filter(a =>
    //             a.status.toLowerCase() === "present" || a.status.toLowerCase() === "halfday"
    //         ).length;

    //         // ✅ Calculate wages
    //         let totalWages = 0;
    //         empAttendance.forEach(a => {
    //             const status = a.status.toLowerCase();
    //             const shift = (a.shift || "").toLowerCase(); // ✅ safe handling

    //             if (status === "halfday") {
    //                 totalWages += (empWage / 2);
    //             } else if (status === "present") {
    //                 switch (shift) {
    //                     case "morning":
    //                         totalWages += (empWage / 4);
    //                         break;
    //                     case "night":
    //                         totalWages += (empWage / 2);
    //                         break;
    //                     case "day":
    //                         totalWages += empWage;
    //                         break;
    //                 }
    //             }
    //         });

    //         filteredRows.push({
    //             emp_id: emp.emp_id,
    //             emp_name: emp.emp_name,
    //             present_days: present_days,
    //             wages_amount: totalWages.toFixed(2), // ✅ final total for period
    //             AmountDue: emp.AmountDue || 0,
    //             TotalPay: emp.TotalPay || 0,
    //             Advance: emp.Advance || 0,
    //             GrossAmount: emp.GrossAmount || 0,
    //             NetPay: emp.NetPay || 0,
    //             AmountPaid: emp.AmountPaid || 0,
    //             FromDate: emp.FromDate,
    //             ToDate: emp.ToDate,
    //             IsGenerated: emp.IsGenerated || 0,
    //             PaySlipID: emp.PaySlipID || 0,
    //         });
    //     });

    //     loaddata(filteredRows, AdvanceMasterdata, from, to);
    // }

    let totalWages;

    function filterAndLoad() {
        debugger;
        const from = $("#fromDate").val();
        const to = $("#Todate").val();
        if (!from || !to) return;

        let filteredRows = [];

        allEmployees.forEach(emp => {
            // ✅ Get latest wages from masterwagesData
            let empWage = 0;
            const empWagesRecords = masterwagesData.filter(w => w.EmpID == emp.emp_id);

            if (empWagesRecords.length > 0) {
                // Sort by CreatedAt descending and take the latest
                empWagesRecords.sort((a, b) => new Date(b.CreatedAt) - new Date(a.CreatedAt));
                empWage = parseFloat(empWagesRecords[0].WagesPerDay) || 0;
            }

            // ✅ Filter attendance for this employee in date range
            const empAttendance = allAttendance.filter(a =>
                a.emp_id == emp.emp_id &&
                a.attendance_date >= from &&
                a.attendance_date <= to
            );

            // ✅ Only "Present" and "HalfDay" count for wages
            const present_days = empAttendance.filter(a =>
                a.status.toLowerCase() === "present" || a.status.toLowerCase() === "halfday"
            ).length;

            // ✅ Direct calculation (present days × latest wage per day)
            // let totalWages = present_days * empWage;
            totalWages = empWage;
            filteredRows.push({
                emp_id: emp.emp_id,
                emp_name: emp.emp_name,
                present_days: present_days,
                wages_amount: totalWages.toFixed(2), // ✅ direct wages
                AmountDue: emp.AmountDue || 0,
                TotalPay: emp.TotalPay || 0,
                Advance: emp.Advance || 0,
                GrossAmount: emp.GrossAmount || 0,
                NetPay: emp.NetPay || 0,
                AmountPaid: emp.AmountPaid || 0,
                FromDate: emp.FromDate,
                ToDate: emp.ToDate,
                IsGenerated: emp.IsGenerated || 0,
                PaySlipID: emp.PaySlipID || 0,
            });
        });

        loaddata(filteredRows, AdvanceMasterdata, from, to);
    }

    function loaddata(data, AdvanceMasterdata, selectedFrom, selectedTo) {
        debugger;
        const table = $("#payslipempAttendance");

        if ($.fn.DataTable.isDataTable(table)) {
            table.DataTable().clear().destroy();
        }
        table.find('tbody').empty();

        let text = "";

        if (!data || data.length === 0) {
            text = "<tr><td colspan='10' class='text-center'>No Data Found</td></tr>";
        } else {
            // 🔹 Group data by emp_id
            const grouped = {};
            data.forEach(emp => {
                if (!grouped[emp.emp_id]) grouped[emp.emp_id] = [];
                grouped[emp.emp_id].push(emp);
            });

            // 🔹 Build rows
            Object.values(grouped).forEach(empRecords => {
                let emp = empRecords.find(e => e.FromDate === selectedFrom && e.ToDate === selectedTo);
                if (!emp) {
                    emp = empRecords[empRecords.length - 1];
                }

                const isSameRange = (emp.FromDate === selectedFrom && emp.ToDate === selectedTo);

                text += `<tr>`;
                text += `<td>${emp.emp_name}</td>`;
                text += `<td>${emp.present_days || 0}</td>`;
                text += `<td>${emp.wages_amount || 0}</td>`; // ✅ New Column (Wages Amount)
                text += `<td>${emp.AmountDue || 0}</td>`;
                text += `<td>${emp.TotalPay || 0}</td>`;
                // ✅ Get advance amount(s) from AdvanceMasterdata
                const advanceEntries = AdvanceMasterdata.filter(a => a.EmpID == emp.emp_id);
                const advanceAmount = advanceEntries.length > 0 ?
                    advanceEntries.reduce((sum, a) => sum + parseFloat(a.Amount || 0), 0) :
                    0;
                text += `<td>${emp.Advance || advanceAmount.toFixed(2) || 0}</td>`;
                text += `<td>${emp.GrossAmount || 0}</td>`;
                text += `<td>${emp.NetPay || 0}</td>`;

                if (emp.IsGenerated == 1 && isSameRange) {
                    text += `<td>${emp.AmountPaid}</td>`;
                    text += `<td>
                    <button class="btn btn-sm btn-success generate-btn"
                        data-empid="${emp.emp_id}"
                        data-payslipid="${emp.PaySlipID}"
                        data-from="${emp.FromDate}"
                        data-to="${emp.ToDate}">Download PaySlip</button>
                </td>`;
                } else {
                    text += `<td>
                    <input type="number" class="form-control amount-input"
                        id="amount-${emp.emp_id}" placeholder="Enter Amount">
                </td>`;
                    text += `<td>
                    <button class="btn btn-sm btn-primary entry-btn"
                        data-empid="${emp.emp_id}"
                        data-empname="${emp.emp_name}"
                        data-present="${emp.present_days || 0}"
                        data-wages_amount="${emp.wages_amount || 0}"
                        data-inputid="amount-${emp.emp_id}">Generate PaySlip</button>
                </td>`;
                }

                text += `</tr>`;
            });
        }

        $("#payslipempAttendance tbody").html(text);

        table.DataTable({
            responsive: true,
            pageLength: 10,
            order: [],
            destroy: true
        });
    }



    // function loaddata(data, AdvanceMasterdata, selectedFrom, selectedTo) {
    //     debugger;
    //     const table = $("#payslipempAttendance");

    //     if ($.fn.DataTable.isDataTable(table)) {
    //         table.DataTable().clear().destroy();
    //     }
    //     table.find('tbody').empty();

    //     let text = "";

    //     if (!data || data.length === 0) {
    //         text = "<tr><td colspan='9' class='text-center'>No Data Found</td></tr>";
    //     } else {
    //         // 🔹 Group data by emp_id
    //         const grouped = {};
    //         data.forEach(emp => {
    //             if (!grouped[emp.emp_id]) grouped[emp.emp_id] = [];
    //             grouped[emp.emp_id].push(emp);
    //         });

    //         // 🔹 Build rows
    //         Object.values(grouped).forEach(empRecords => {
    //             // First try to find record with exact matching date range
    //             let emp = empRecords.find(e => e.FromDate === selectedFrom && e.ToDate === selectedTo);

    //             // If not found, fall back to the latest (or first) record
    //             if (!emp) {
    //                 emp = empRecords[empRecords.length - 1];
    //             }

    //             const isSameRange = (emp.FromDate === selectedFrom && emp.ToDate === selectedTo);

    //             text += `<tr>`;
    //             text += `<td>${emp.emp_name}</td>`;
    //             text += `<td>${emp.PresentDays || 0}</td>`;
    //             text += `<td>${emp.AmountDue || 0}</td>`;
    //             text += `<td>${emp.TotalPay || 0}</td>`;

    //             // ✅ Get advance amount(s) from AdvanceMasterdata
    //             const advanceEntries = AdvanceMasterdata.filter(a => a.EmpID == emp.emp_id);
    //             const advanceAmount = advanceEntries.length > 0 ?
    //                 advanceEntries.reduce((sum, a) => sum + parseFloat(a.Amount || 0), 0) :
    //                 0;

    //             text += `<td>${advanceAmount.toFixed(2)}</td>`;
    //             text += `<td>${emp.GrossAmount || 0}</td>`;
    //             text += `<td>${emp.NetPay || 0}</td>`;

    //             if (emp.IsGenerated == 1 && isSameRange) {
    //                 // ✅ Already generated for this selected range
    //                 text += `<td>${emp.AmountPaid}</td>`;
    //                 text += `<td>
    //                 <button class="btn btn-sm btn-success generate-btn"
    //                     data-empid="${emp.emp_id}"
    //                     data-payslipid="${emp.PaySlipID}"
    //                     data-from="${emp.FromDate}"
    //                     data-to="${emp.ToDate}">Generate PaySlip</button>
    //             </td>`;
    //             } else {
    //                 // ❌ Not generated for this range → allow entry
    //                 text += `<td>
    //                 <input type="number" class="form-control amount-input"
    //                     id="amount-${emp.emp_id}" placeholder="Enter Amount">
    //             </td>`;
    //                 text += `<td>
    //                 <button class="btn btn-sm btn-primary entry-btn"
    //                     data-empid="${emp.emp_id}"
    //                     data-empname="${emp.emp_name}"
    //                     data-present="${emp.PresentDays || 0}"
    //                     data-inputid="amount-${emp.emp_id}">Save</button>
    //             </td>`;
    //             }

    //             text += `</tr>`;
    //         });
    //     }

    //     $("#payslipempAttendance tbody").html(text);

    //     table.DataTable({
    //         responsive: true,
    //         pageLength: 10,
    //         order: [],
    //         destroy: true
    //     });
    // }






    let amountPaid, emp_id, emp_name, present_days;

    $(document).on('click', '.entry-btn', function() {
        debugger;
        emp_id = $(this).data('empid');
        emp_name = $(this).data('empname');
        present_days = $(this).data('present');
        wages_amount = $(this).data('wages_amount');

        // use unique input id
        const inputId = $(this).data('inputid');
        amountPaid = $("#" + inputId).val() || 0;

        $('#modal-amountpaid').val(amountPaid);

        // clear other fields
        $('#modal-openingbalance').val('');
        $('#modal-advance').val('');
        $('#modal-currentadvance').val('');

        // now call submit
        submitPaySlipEntry();
    });

    function submitPaySlipEntry() {
        debugger;
        // ✅ Get only the clicked employee’s advance amount
        const advanceEntries = AdvanceMasterdata.filter(a => a.EmpID == emp_id);
        const advance = advanceEntries.length > 0 ?
            advanceEntries.reduce((sum, a) => sum + parseFloat(a.Amount || 0), 0) :
            0;

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
                from_date: fromDate,
                to_date: toDate,
                total_pay: (parseFloat(total_pay) || 0) + (parseFloat(wages_amount) || 0),
                advance: advance, // ✅ only this employee’s advance
                amount_paid: amountPaid,
                wages_amount: wages_amount
            }
        };

        TransportCall(obj);
    }


    $(document).on('click', '.generate-btn', function() {
        debugger;
        const empId = $(this).data('empid');
        const payslipID = $(this).data('payslipid'); // lowercase
        console.log(empId, payslipID);
        getPaySlipsDataByEmpIDandSlipID(empId, payslipID)
    });

    function getPaySlipsDataByEmpIDandSlipID(empId, payslipID) {
        var obj = new Object();
        obj.Module = "Employee";
        obj.Page_key = "getPaySlipsDataByEmpIDandSlipID";
        var json = new Object();
        json.emp_id = empId;
        json.payslipID = payslipID;
        obj.JSON = json;
        TransportCall(obj);
    }
</script>