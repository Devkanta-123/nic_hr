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
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        font-family: Arial, sans-serif;
    }

    #payslipDataTable th,
    #payslipDataTable td {
        border: 1px solid #000;
        padding: 6px 10px;
        vertical-align: top;
    }

    #payslipDataTable .no-border {
        border: none;
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
                    From date: <input type="date" id="fromDate">
                    &nbsp; &nbsp;
                    To date: <input type="date" id="Todate">
                    <br>
                    <br>
                    <div class="card"  id="mainCard">
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


                <div class="col-12 mt-3"   id="filterCard" style="display: none;">
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
        <th class="center-text" colspan="4">Pay slip</th>
    </tr>

    <tr>
        <td><strong>Date:</strong></td>
        <td colspan="3" id="slipDate">xx/xx/xxxx</td>
    </tr>
    <tr>
        <td><strong>Name:</strong></td>
        <td colspan="3" id="slipName">XXXXXX</td>
    </tr>

    <!-- Previous Opening Balance -->
    <tr>
        <td colspan="3"><strong>Previous [Balance/Advance]</strong></td>
        <td id="previousBalance">0</td>
    </tr>

    <tr>
        <td class="no-border" colspan="4"><strong>Current Week</strong></td>
    </tr>

    <!-- Present Days and Total Pay -->
    <tr>
        <td><strong>No of days Present:</strong></td>
        <td id="presentDays">0</td>
        <td><strong>Total amount</strong></td>
        <td id="totalAmount">0</td>
    </tr>

    <!-- These rows now stretch across full width -->
    <tr>
        <td><strong>Advance</strong></td>
        <td colspan="3" id="advance">0</td>
    </tr>

    <tr>
        <td><strong>Gross Amount</strong></td>
        <td colspan="3" id="grossAmount">0</td>
    </tr>

    <tr>
        <td><strong>Net Amount</strong></td>
        <td colspan="3" id="netAmount">0</td>
    </tr>

    <tr>
        <td><strong>Amount Paid</strong></td>
        <td colspan="3" id="amountPaid">0</td>
    </tr>

    <!-- Closing -->
    <tr>
        <td><strong>Closing Amount</strong></td>
        <td id="closingAmount">0</td>
        <td colspan="2" id="closingBalanceText"><strong>[Balance/Advance]</strong></td>
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
        getEmployeesAttendanceFilter();
     
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
      let AdvanceMasterdata = [];
    let AllowanceMasterdata = [];
    function onSuccess(rc) {
        debugger;
        if (rc.return_code) {
            switch (rc.Page_key) {
                case "getEmployeesAttendanceForPaySlip":
                    AdvanceMasterdata = rc.return_data.advance;
                    AllowanceMasterdata = rc.return_data.allowance;
                    loaddata(rc.return_data.attendance,AdvanceMasterdata)
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

  $('#fromDate, #Todate').on('change', function() {
        loadFilteredData();
   
    });
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
        // Fill values first
        $('#slipDate').text(new Date(data.CreatedAt).toLocaleDateString());
        $('#slipName').text(data.emp_name);
        $('#previousBalance').text(data.OpeningBalance);

        $('#presentDays').text(data.PresentDays);
        $('#totalAmount').text(data.TotalPay);
        $('#advance').text(data.Advance);

        $('#grossAmount').text(data.GrossAmount);
        $('#netAmount').text(data.NetPay);
        $('#amountPaid').text(data.AmountPaid);

        $('#closingAmount').text(data.NewBalance);
        $('#closingBalanceText').text(data.NewCurrentAdvance);

        // Make sure table is visible before PDF
        $('#payslipDataTable').css('display', 'block');

        // Give little delay to render values
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


   function loaddata(data,AdvanceMasterdata) {
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
        const opening_balance = 12;
        const  advance = AdvanceMasterdata.advanceamount;
        const current_advance = 24;
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