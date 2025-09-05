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
                                Journal Entries
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <form id="journalForm">

                                    <!-- Row 1 -->
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="type">Entry Type</label>
                                            <select class="form-control" id="type">
                                                <option value="Payment">Payment</option>
                                                <option value="Receipt">Receipt</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="account_name">Account Name</label>
                                            <select id="account_name" class="form-control">
                                                <!-- example static options -->

                                            </select>
                                        </div>
                                    </div>

                                    <!-- Row 2 -->
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="particulars">Particulars</label>
                                            <input type="text" class="form-control" id="particulars" placeholder="Enter particulars">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="qty">Qty</label>
                                            <input type="number" class="form-control" id="qty" placeholder="Enter qty" min="0">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="rate">Rate</label>
                                            <input type="number" class="form-control" id="rate" placeholder="Enter rate" min="0">
                                        </div>
                                    </div>

                                    <!-- Row 3 -->
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="amount">Amount</label>
                                            <input type="number" class="form-control" id="amount" readonly>
                                        </div>
                                        <div class="form-group col-md-6 d-flex align-items-end">
                                            <button type="button" id="addEntryBtn" class="btn btn-primary">Add Entry</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body" id="ledgerContent">
                                <table id="journalentries" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Account</th>
                                            <th>Particulars</th>
                                            <th>Qty</th>
                                            <th>Rate</th>
                                            <th class="text-right">Payment (Dr)</th>
                                            <th class="text-right">Receipt (Cr)</th> <!-- ✅ Renamed -->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="ledgerBody"></tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4" class="text-right">Total</th>
                                            <th class="text-right" id="totalPayment">0.00</th>
                                            <th class="text-right" id="totalReceipt">0.00</th>
                                            <th></th>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

<script>
    $(function() {
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



    $("#qty, #rate").on('input', function() {
        let qty = parseFloat($('#qty').val()) || 0;
        let rate = parseFloat($('#rate').val()) || 0;
        $('#amount').val(qty * rate);
    });

    $('#addEntryBtn').click(function() {
        const type = $('#type').val();
        const accountId = $('#account_name').val();
        const accountName = $('#account_name option:selected').text();
        const qty = $('#qty').val();
        const rate = $('#rate').val();
        const particulars = $('#particulars').val();
        const amount = parseFloat($('#amount').val()) || 0;

        if (accountId === '' || particulars === '' || amount === 0) {
            alert("Please select account and enter particulars/amount");
            return;
        }

        let paymentCol = '';
        let receiptCol = '';
        if (type === "Payment") paymentCol = amount.toFixed(2);
        else receiptCol = amount.toFixed(2);

        let row = `
        <tr data-account-id="${accountId}">
            <td>${accountName}</td>
            <td>${particulars}</td>
            <td>${qty}</td>
            <td>${rate}</td>
            <td class="text-right paymentVal">${paymentCol}</td>
            <td class="text-right receiptVal">${receiptCol}</td>
            <td><button class="btn btn-sm btn-danger deleteRowBtn">Remove</button></td>
        </tr>
    `;
        $('#ledgerBody').append(row);

        updateTotals();

        $('#journalForm')[0].reset();
    });

    // Delete row on click
    $(document).on('click', '.deleteRowBtn', function() {
        $(this).closest('tr').remove();
        updateTotals();
    });

    // ✅ Function to calculate totals
    function updateTotals() {
        let totalPayment = 0,
            totalReceipt = 0;

        $('#ledgerBody tr').each(function() {
            totalPayment += parseFloat($(this).find('.paymentVal').text()) || 0;
            totalReceipt += parseFloat($(this).find('.receiptVal').text()) || 0;
        });

        $('#totalPayment').text(totalPayment.toFixed(2));
        $('#totalReceipt').text(totalReceipt.toFixed(2));
    }




    function saveLedgerEntry() {
        const entries = [];

        $('#ledgerBody tr').each(function() {
            const drDate = $(this).find('td:eq(0)').text().trim();
            const drParticulars = $(this).find('td:eq(1)').text().trim();
            const drJF = $(this).find('td:eq(2)').text().trim();
            const drAmount = $(this).find('td:eq(3)').text().trim();

            const crDate = $(this).find('td:eq(4)').text().trim();
            const crParticulars = $(this).find('td:eq(5)').text().trim();
            const crJF = $(this).find('td:eq(6)').text().trim();
            const crAmount = $(this).find('td:eq(7)').text().trim();

            if (drDate || drParticulars || drAmount) {
                entries.push({
                    type: 'Dr',
                    date: drDate,
                    particulars: drParticulars,
                    jf: drJF,
                    amount: parseFloat(drAmount) || 0
                });
            }

            if (crDate || crParticulars || crAmount) {
                entries.push({
                    type: 'Cr',
                    date: crDate,
                    particulars: crParticulars,
                    jf: crJF,
                    amount: parseFloat(crAmount) || 0
                });
            }
        });

        const payload = {
            Module: "Deo",
            Page_key: "saveLedgerEntry",
            JSON: {
                entries: entries
            }
        };

        console.log("Saved Entries:", payload);
        TransportCall(payload);
    }

    function generatePDF() {
        // Temporarily hide the Action column
        $('#journalentries th:last-child, #journalentries td:last-child').hide();

        // Create a wrapper with title + table cloned
        const printable = document.createElement('div');
        printable.innerHTML = `
        <h3 class="text-center mb-3">Journal Entry</h3>
        ${document.getElementById('journalentries').outerHTML}
    `;

        var opt = {
            margin: 0.5,
            filename: 'Journal_Entry.pdf',
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'in',
                format: 'letter',
                orientation: 'portrait'
            }
        };

        html2pdf().from(printable).set(opt).save().then(() => {
            // show the column back after generating
            $('#journalentries th:last-child, #journalentries td:last-child').show();
        });
    }



    function buildjournalentriesBody() {
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
        $('#ledgerBody tr').each(function() {
            const row = [];
            $(this).find('td').each(function() {
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

    function populateAccounts(data) {
        const $account_datas = $('#account_name');
        $account_datas.empty(); // Clear previous options
        $account_datas.append('<option value="">Select Account</option>');
        data.forEach(function(data) {
            $account_datas.append(
                $('<option>', {
                    value: data.id,
                    text: data.account_name
                })
            );
        });
    }

    function loaddata(data) {
        var table = $("#empAttendance");

        try {
            if ($.fn.DataTable.isDataTable(table)) {
                table.DataTable().destroy();
            }
        } catch (ex) {}

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
        $(".attendance-bootstrap-switch").on("switchChange.bootstrapSwitch", function(event, state) {
            const empId = $(this).data("empid");

            if (state) {
                $(`#shifts_${empId}`).slideDown();
            } else {
                $(`#shifts_${empId}`).slideUp();
                sendAttendance(empId, "Absent", null);
            }
        });

        // Shift radio change
        $(".shift-radio").on("change", function() {
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
    $('#RestoreLeadModal').on('show.bs.modal', function() {
        $(this).find('.modal-dialog').addClass('slide-in');
    });

    $('#RestoreLeadModal').on('hidden.bs.modal', function() {
        // Reset the modal animation class when the modal is hidden
        $(this).find('.modal-dialog').removeClass('slide-in');
    });
</script>