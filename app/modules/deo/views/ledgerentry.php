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
                                Ledger Entry
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <form id="ledgerForm">

                                    <!-- Row 1: Type and Date -->
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="type">Entry Type</label>
                                            <select class="form-control" id="type">
                                                <option value="debit">Debit</option>
                                                <option value="credit">Credit</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="entryDate">Date</label>
                                            <input type="date" class="form-control" id="entryDate"
                                                value="<?php echo date('Y-m-d'); ?>">
                                        </div>

                                    </div>

                                    <!-- Row 2: Particulars and J.F. -->
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="particulars">Particulars</label>
                                            <input type="text" class="form-control" id="particulars"
                                                placeholder="Enter particulars">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="account_name">Account Name</label>
                                            <select id="account_name" class="form-control">
                                                <!-- example static options -->

                                            </select>
                                        </div>
                                    </div>

                                    <!-- Row 3: Amount and Button -->
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="amount">Amount</label>
                                            <input type="number" class="form-control" id="amount"
                                                placeholder="Enter amount" min="0" step="0.01">
                                        </div>
                                        <div class="form-group col-md-6 d-flex align-items-end">
                                            <button type="button" id="addEntryBtn" class="btn btn-primary">Add
                                                Entry</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body" id="ledgerContent">
                                <table id="ledgerTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            <th colspan="4">Dr.</th>
                                            <th colspan="4">Cr.</th>
                                        </tr>
                                        <tr>
                                            <th>Date</th>
                                            <th>Particulars</th>
                                            <th>Account</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Particulars</th>
                                            <th>Account</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody id="ledgerBody"></tbody>
                                    <tfoot>
                                        <tr class="font-weight-bold bg-light">
                                            <td colspan="3" class="text-right">Total Debit</td>
                                            <td id="totalDebit">0.00</td>
                                            <td colspan="3" class="text-right">Total Credit</td>
                                            <td id="totalCredit">0.00</td>
                                        </tr>
                                    </tfoot>
                                </table>

                                <div class="text-right mt-3">
                                    <button class="btn btn-primary mr-2" onclick="saveLedgerEntry()">Save</button>
                                    <button class="btn btn-danger" onclick="generatePDF()">Export to PDF</button>
                                </div>
                            </div>
                        </div>


                    </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>


<script>
    $(function () {
        getAccountName();
    });

    function getAccountName() {
        var obj = new Object();
        obj.Module = "Deo";
        obj.Page_key = "getAccountName";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    let totalDebit = 0;
    let totalCredit = 0;

    $('#addEntryBtn').click(function () {
        const type = $('#type').val();
        const date = $('#entryDate').val();
        const particulars = $('#particulars').val();
        const accountId = $('#account_name').val();
        const accountName = $('#account_name option:selected').text();
        const amount = parseFloat($('#amount').val());

        if (!date || !particulars || !accountId || isNaN(amount) || amount <= 0) {
            alert('Please fill all fields correctly.');
            return;
        }

        let matchedRow = null;

        $('#ledgerBody tr').each(function () {
            const drDate = $(this).find('td:eq(0)').text();
            const crDate = $(this).find('td:eq(4)').text();

            if (type === 'debit' && crDate === date && drDate === '') {
                matchedRow = $(this);
                return false;
            } else if (type === 'credit' && drDate === date && crDate === '') {
                matchedRow = $(this);
                return false;
            }
        });

        if (matchedRow) {
            if (type === 'debit') {
                matchedRow.find('td:eq(0)').text(date);
                matchedRow.find('td:eq(1)').text('To ' + particulars);
                matchedRow.find('td:eq(2)')
                    .text(accountName)
                    .attr('data-accountid', accountId);
                matchedRow.find('td:eq(3)').text(amount.toFixed(2));
                totalDebit += amount;
            } else {
                matchedRow.find('td:eq(4)').text(date);
                matchedRow.find('td:eq(5)').text('By ' + particulars);
                matchedRow.find('td:eq(6)')
                    .text(accountName)
                    .attr('data-accountid', accountId);
                matchedRow.find('td:eq(7)').text(amount.toFixed(2));
                totalCredit += amount;
            }
        } else {
            const newRow = $('<tr></tr>');
            if (type === 'debit') {
                newRow.html(`
        <td>${date}</td>
        <td>To ${particulars}</td>
        <td data-accountid="${accountId}">${accountName}</td>
        <td>${amount.toFixed(2)}</td>
        <td></td><td></td><td></td><td></td>
      `);
                totalDebit += amount;
            } else {
                newRow.html(`
        <td></td><td></td><td></td><td></td>
        <td>${date}</td>
        <td>By ${particulars}</td>
        <td data-accountid="${accountId}">${accountName}</td>
        <td>${amount.toFixed(2)}</td>
      `);
                totalCredit += amount;
            }
            $('#ledgerBody').append(newRow);
        }

        $('#totalDebit').text(totalDebit.toFixed(2));
        $('#totalCredit').text(totalCredit.toFixed(2));

        $('#ledgerForm')[0].reset();
    });


    function populateAccounts(data) {
        const $account_datas = $('#account_name');
        $account_datas.empty(); // Clear previous options
        $account_datas.append('<option value="">Select Account</option>');
        data.forEach(function (data) {
            $account_datas.append(
                $('<option>', {
                    value: data.id,
                    text: data.account_name
                })
            );
        });
    }



    function saveLedgerEntry() {
        debugger;
        const entries = [];

        $('#ledgerBody tr').each(function () {
            const drDate = $(this).find('td:eq(0)').text().trim();
            const drParticulars = $(this).find('td:eq(1)').text().trim();
            const drAccountId = $(this).find('td:eq(2)').attr('data-accountid');
            const drAccountName = $(this).find('td:eq(2)').text().trim();
            const drAmount = $(this).find('td:eq(3)').text().trim();

            const crDate = $(this).find('td:eq(4)').text().trim();
            const crParticulars = $(this).find('td:eq(5)').text().trim();
            const crAccountId = $(this).find('td:eq(6)').attr('data-accountid');
            const crAccountName = $(this).find('td:eq(6)').text().trim();
            const crAmount = $(this).find('td:eq(7)').text().trim();

            if (drDate || drParticulars || drAmount) {
                entries.push({
                    type: 'Dr',
                    date: drDate,
                    particulars: drParticulars,
                    account_id: drAccountId,
                    account_name: drAccountName,
                    amount: parseFloat(drAmount) || 0
                });
            }

            if (crDate || crParticulars || crAmount) {
                entries.push({
                    type: 'Cr',
                    date: crDate,
                    particulars: crParticulars,
                    account_id: crAccountId,
                    account_name: crAccountName,
                    amount: parseFloat(crAmount) || 0
                });
            }
        });

        const payload = {
            Module: "Deo",
            Page_key: "saveLedgerEntry",
            JSON: { entries: entries }
        };

        console.log("Saved Entries:", payload);
        TransportCall(payload);
    }

    function generatePDF() {
        const docDefinition = {
            content: [{
                text: 'Ledger Report',
                style: 'header',
                alignment: 'center',
                margin: [0, 0, 0, 10]
            },
            {
                table: {
                    headerRows: 2,
                    widths: ['*', '*', '*', '*', '*', '*', '*', '*'],
                    body: buildLedgerTableBody()
                },
                layout: {
                    fillColor: function (rowIndex) {
                        return rowIndex === 0 || rowIndex === 1 ? '#eeeeee' : null;
                    }
                }
            },
            {
                columns: [{
                    width: '*',
                    text: ''
                },
                {
                    width: 'auto',
                    table: {
                        body: [
                            [{
                                text: 'Total Debit',
                                bold: true,
                                alignment: 'right'
                            },
                            {
                                text: $('#totalDebit').text(),
                                alignment: 'right'
                            }
                            ],
                            [{
                                text: 'Total Credit',
                                bold: true,
                                alignment: 'right'
                            },
                            {
                                text: $('#totalCredit').text(),
                                alignment: 'right'
                            }
                            ]
                        ]
                    },
                    layout: 'noBorders'
                }
                ],
                margin: [0, 20, 0, 0]
            }
            ],
            styles: {
                header: {
                    fontSize: 16,
                    bold: true
                }
            },
            pageOrientation: 'landscape'
        };

        pdfMake.createPdf(docDefinition).download('Ledger_Report.pdf');
    }


    function buildLedgerTableBody() {
        const body = [];

        // Headers
        body.push([{
            text: 'Dr.',
            colSpan: 4,
            alignment: 'center',
            bold: true
        }, {}, {}, {},
        {
            text: 'Cr.',
            colSpan: 4,
            alignment: 'center',
            bold: true
        }, {}, {}, {}
        ]);

        body.push([{
            text: 'Date',
            bold: true
        },
        {
            text: 'Particulars',
            bold: true
        },
        {
            text: 'J.F.',
            bold: true
        },
        {
            text: 'Amount',
            bold: true
        },
        {
            text: 'Date',
            bold: true
        },
        {
            text: 'Particulars',
            bold: true
        },
        {
            text: 'J.F.',
            bold: true
        },
        {
            text: 'Amount',
            bold: true
        }
        ]);

        // Data Rows
        $('#ledgerBody tr').each(function () {
            const row = [];
            $(this).find('td').each(function () {
                row.push({
                    text: $(this).text(),
                    alignment: 'left'
                });
            });
            body.push(row);
        });

        return body;
    }

    function getActiveEmployeesForAttendance() {
        var obj = new Object();
        obj.Module = "Employee";
        obj.Page_key = "getActiveEmployeesForAttendance";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    function onSuccess(rc) {
        debugger;
        if (rc.return_code) {
            switch (rc.Page_key) {
                case "saveLedgerEntry":
                    notify('success', rc.return_data);
                    break;
                case "getAccountName":
                    console.log(rc.return_data)
                    populateAccounts(rc.return_data);
                    break;


                default:
                    alert(rc.Page_key);
            }
        } else {
            alert(rc.return_data);
        }
        // alert(JSON.stringify(args));
    }

    function loaddata(data) {
        var table = $("#empAttendance");

        try {
            if ($.fn.DataTable.isDataTable(table)) {
                table.DataTable().destroy();
            }
        } catch (ex) { }

        let text = "";

        if (data.length === 0) {
            text += "<tr><td colspan='7'>No Data Found</td></tr>";
        } else {
            for (let i = 0; i < data.length; i++) {
                const emp = data[i];
                const empId = emp.emp_id;

                const isPresent = emp.attendance_status === "Present";
                const shiftValue = emp.shift || "";

                text += `<tr>`;
                text += `<td>${emp.emp_name}</td>`;
                text += `<td>${emp.emp_contact}</td>`;
                text += `<td>${emp.emp_email}</td>`;
                text += `<td>${emp.emp_address}</td>`;
                text += `<td>${emp.sector || 'N/A'}</td>`;

                // Action (attendance toggle and shift radios)
                text += `<td style="min-width: 180px;">`;

                // Attendance checkbox (set checked if Present)
                text += `
                <input 
                    type="checkbox" 
                    class="attendance-bootstrap-switch" 
                    data-bootstrap-switch 
                    data-empid="${empId}" 
                    id="toggle_${empId}" 
                    name="attendance_${empId}" 
                    data-on-text="Present"
                    data-off-text="Absent"
                    data-on-color="primary"
                    data-off-color="secondary"
                    ${isPresent ? "checked" : ""}
                />
            `;

                // Shift options (conditionally check based on shift value)
                text += `
                <div class="shift-options mt-2" id="shifts_${empId}" style="display: ${isPresent ? 'block' : 'none'};">
                    <div class="form-check">
                        <input class="form-check-input shift-radio" type="radio" name="shift_${empId}" id="morning_${empId}" value="Morning" data-empid="${empId}" ${shiftValue === "Morning" ? "checked" : ""}>
                        <label class="form-check-label" for="morning_${empId}">Morning</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input shift-radio" type="radio" name="shift_${empId}" id="night_${empId}" value="Night" data-empid="${empId}" ${shiftValue === "Night" ? "checked" : ""}>
                        <label class="form-check-label" for="night_${empId}">Night</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input shift-radio" type="radio" name="shift_${empId}" id="both_${empId}" value="Morning + Night" data-empid="${empId}" ${shiftValue === "Morning + Night" ? "checked" : ""}>
                        <label class="form-check-label" for="both_${empId}">Morning + Night</label>
                    </div>
                </div>
            `;

                text += `</td>`;
                text += `</tr>`;
            }
        }

        $("#empAttendance tbody").html(text);

        // Reinitialize DataTable
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

        // Initialize Bootstrap Switch
        $("[data-bootstrap-switch]").bootstrapSwitch();

        // Toggle switch event
        $(".attendance-bootstrap-switch").on("switchChange.bootstrapSwitch", function (event, state) {
            const empId = $(this).data("empid");

            if (state) {
                $(`#shifts_${empId}`).slideDown();
            } else {
                $(`#shifts_${empId}`).slideUp();
                sendAttendance(empId, "Absent", null);
            }
        });

        // Shift radio change
        $(".shift-radio").on("change", function () {
            const empId = $(this).data("empid");
            const shift = $(this).val();
            sendAttendance(empId, "Present", shift);
        });
    }





    function onRestoreLeads(data) {
        debugger;
        data = JSON.parse(unescape(data));
        $("#LeadsID").val(data.LeadsID);
        var LeadsName = data.Name;
        $("#RestoreLeadModal").modal('show');
        var outputElement = document.getElementById("output");
        outputElement.innerHTML = "Are You Sure to Restore  " + LeadsName + " Leads ? ";
    }

    function RestoreLeads() {
        debugger;
        var LeadID = $("#LeadsID").val();

        var obj = new Object();
        obj.Module = "Client";
        obj.Page_key = "restorePrayageduLeads";
        var json = new Object();
        obj.JSON = json;
        json.LeadsID = LeadID;
        SilentTransportCall(obj);
    }

    // Modal Animation For Delete Lead Modal 
    $('#RestoreLeadModal').on('show.bs.modal', function () {
        $(this).find('.modal-dialog').addClass('slide-in');
    });

    $('#RestoreLeadModal').on('hidden.bs.modal', function () {
        // Reset the modal animation class when the modal is hidden
        $(this).find('.modal-dialog').removeClass('slide-in');
    });
</script>