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
    <button class="btn btn-primary btn-sm" id="loadBtn">Load</button>
                    <br>
                    <br>
                    <div class="card"  >
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


                <div class="col-12 mt-3"  style="display: none;">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                PaySlip Entry ByFilter
                            </div>
                            <span class="float-right">
                                <a href="deodash" class="btn btn-primary btn-xs custom-btn">Back to lists</a>
                            </span>
                        </div>
                        <div class="card-body">
                            <table id="payslipempAttendanceFilter" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Emp Name</th>
                                        <th scope="col">Attendance Date</th>
                                        <th scope="col">Amount Paid</th>
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

<!-- pay slip table with data  -->

<table id="payslipDataTable" style="display:none;">
    <tr>
        <th class="center-text" colspan="4">Pay Slip</th>
    </tr>

    <!-- Date & Name side by side -->
    <tr>
        <td><strong>Date:</strong></td>
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



     let rawAttendanceData = [];
    let AllowanceMasterdata = [];
    let allEmployees = [];   // from backend (with IsGenerated)
let allAttendance = [];  // raw attendance
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
                    //loaddata(rc.return_data.attendance,AdvanceMasterdata)
                    console.log(allEmployees);
                    console.log(allAttendance);
                    break;

                case "getEmployeesAttendanceFilter":
                    rawAttendanceData=rc.return_data;
                    // loadfilterdata(rc.return_data)
                    console.log(rc.return_data);
                    break;


                case "savePaySlipEntry":
                    console.log(rc.return_data);
                    notify('success', rc.return_data);
                    getEmployeesAttendanceForPaySlip();
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

//   $('#fromDate, #Todate').on('change', function() {
//         loadFilteredData();
   
//     });
     function loadFilteredData() {
        const fromDate = $('#fromDate').val();
        const toDate   = $('#Todate').val();

        if (fromDate && toDate) {
            const from = new Date(fromDate);
            const to   = new Date(toDate);

            const filtered = rawAttendanceData.filter(item => {
                const adate = new Date(item.attendance_date);
                return adate >= from && adate <= to;
            });

            $('#mainCard').hide();
            $('#filterCard').show();

            loadfilterdata(filtered);
        } else {
            $('#filterCard').hide();
            $('#mainCard').show();
        }
    }
   function loadPaySlipData(data) {
    $('#slipDate').text(new Date(data.CreatedAt).toLocaleDateString());
    $('#slipName').text(data.emp_name);

    // Determine previous header label
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

    // Amount Due (inserted in DB now)
    $('#amountDue').text(data.AmountDue);

    // Closing label
    let closingLabel = "Closing Balance";
    if (parseFloat(data.NewCurrentAdvance) > 0) {
        closingLabel = "Closing Advance";
    }
    $('#closingLabel').text(closingLabel);
    $('#closingAmount').text(data.NewBalance);

    // Show table
    $('#payslipDataTable').css('display', 'block');

    setTimeout(function() {
        printPayslip();
    }, 200);
}


    function printPayslip() {
        const element = document.getElementById('payslipDataTable');

        var opt = {
            margin: 10,
            filename: 'payslip.pdf',
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

        // this will open Save As automatically
        html2pdf().set(opt).from(element).save();
    }


  $("#loadBtn").on("click", function () {
    const from = $("#fromDate").val();
    const to = $("#Todate").val();
    if (!from || !to) {
        alert("Select both dates");
        return;
    }
    // Build filtered array used by existing loaddata
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
});
/* Re-use your original load function to render table */
function loaddata(data, AdvanceMasterdata) {
    debugger;
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
            text += `<td>${emp.present_days || 'N/A'}</td>`;
            text += `<td>${AdvanceMasterdata.advanceamount || 0}</td>`;

            // If IsGenerated = 0 → show input field
            if (emp.IsGenerated == 0) {
                text += `<td>
                    <input type="number" class="form-control amount-input"
                        data-empid="${emp.emp_id}" placeholder="Enter Amount">
                    </td>`;
            } else {  // Already generated → no input
                text += `<td></td>`;
            }

            // Action button
            if (emp.IsGenerated == 0) {
                // Show Save button
                text += `
                <td>
                    <button class="btn btn-sm btn-primary entry-btn"
                         data-empid="${emp.emp_id}"
                         data-empname="${emp.emp_name}"
                         data-present="${emp.present_days}">Save</button>
                </td>`;
            } else {
                // Show Generate PaySlip (re-generate/print)
                text += `
                <td>
                    <button class="btn btn-sm btn-success generate-btn"
                        data-empid="${emp.emp_id}">Generate PaySlip</button>
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
            pageLength: 10
        });
    }
}


    function loadfilterdata(data) {
        const table = $("#payslipempAttendanceFilter");
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
                text += `<td>${emp.attendance_date}</td>`;
                // New Amount Paid column (input field)
                if (emp.IsGenerated === 0) {
                    text += `<td>
                 </td>`
                } else {
                    text += `<td><input type="number" class="form-control amount-input" 
                data-empid="${emp.emp_id}" placeholder="Enter Amount"></td>`;;
                }
                if (emp.IsGenerated === 0) {
                    const encodedID = btoa(emp.emp_id);
                    text += `<td>
                    <button class="btn btn-sm btn-success generate-btn" 
                        data-empid="${emp.emp_id}">Print PaySlip</button>
                 </td>`;
                } else {
                    text += `<td>
                    <button class="btn btn-sm btn-primary entry-btn" 
                        data-empid="${emp.emp_id}" 
                        data-empname="${emp.emp_name}" 
                        data-present="${emp.present_days}">Save</button>
                 </td>`;
                }

                text += `</tr>`;
            }

        }

        $("#payslipempAttendanceFilter tbody").html(text);

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



 let amountPaid,emp_id,present_days;
    $(document).on('click', '.entry-btn', function () {
        debugger;
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
    $('#saveEntry').on('click', function () {

    });



//     advanceamount
// : 
// "2000.00"
// allowanceamount
// : 
// "3000.00"
    // Reusable function
    function submitPaySlipEntry() {
        debugger;
        const opening_balance = 500;
        const  advance = AdvanceMasterdata.advanceamount;
        const current_advance = 0;
        if (!emp_id) {
            alert("Employee ID missing!");
            return;
        }
        if (!amountPaid) {
            alert("Enter the Amount");
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
                amount_paid: amountPaid
            }
        };

        TransportCall(obj);
        $('#entryFormModal').modal('hide');
    }

    $(document).on('click', '.generate-btn', function() {
        debugger;
        const empId = $(this).data('empid');
        // const url = `deo-generatepayslip?emp=${encodedEmpId}`;
        // window.open(url, '_blank');
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