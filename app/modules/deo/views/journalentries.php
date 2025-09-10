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

    /* Autocomplete dropdown */
    /* Autocomplete dropdown menu */
    .ui-autocomplete {
        max-height: 250px;
        overflow-y: auto;
        overflow-x: hidden;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: #fff;
        padding: 5px 0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        font-family: 'Segoe UI', Tahoma, sans-serif;
        font-size: 14px;
        z-index: 2000 !important;

        /* 👇 Width control */
        min-width: 200px;
        /* must be at least input size */
        max-width: 400px;
        /* prevent it from being 1906px */
        width: auto !important;
        white-space: nowrap;
        /* keep text inline */
    }

    /* Each item */
    .ui-menu-item {
        list-style: none;
    }

    /* Item wrapper */
    .ui-menu-item-wrapper {
        padding: 10px 14px;
        cursor: pointer;
        border-radius: 6px;
        transition: background 0.2s, color 0.2s;
    }

    /* Hover / active */
    .ui-menu-item-wrapper:hover,
    .ui-state-active {
        background: #007bff;
        color: #fff;
        font-weight: 500;
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
                                Journal Entry
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <form id="journalForm">
                                    <!-- Row 1 -->
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="entry_date">Date</label>
                                            <input type="date" class="form-control" id="entry_date" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="type">Entry Type</label>
                                            <select class="form-control" id="type">
                                                <option value="Payment">Payment/Purchase</option>
                                                <option value="Receipt">Receipt/Sales</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="account_name">Account Name</label>
                                            <select id="account_name" class="form-control"></select>
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
                                            <input type="number" class="form-control" id="qty" placeholder="Enter qty" min="1" value="1">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="rate">Rate</label>
                                            <input type="number" class="form-control" id="rate" placeholder="Enter rate" min="0">
                                        </div>
                                    </div>

                                    <!-- Row 3 -->
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="amount">Amount</label>
                                            <input type="number" class="form-control" id="amount" readonly>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="description">Description</label>
                                            <input type="text" class="form-control" id="description" placeholder="Enter description">
                                        </div>
                                        <div class="form-group col-md-3 d-flex align-items-end">
                                            <button type="button" id="addEntryBtn" class="btn btn-primary w-100">Add Entry</button>
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
                                            <th>Date</th>
                                            <th>Account</th>
                                            <th>Particulars</th>
                                            <th>Qty</th>
                                            <th>Rate</th>
                                            <th>Description</th>
                                            <th class="text-right">Payment/Purchase</th>
                                            <th class="text-right">Receipt/Sales</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="ledgerBody"></tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="6" class="text-right">Total</th>
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
        getMasterItems();
    });

    function getAccountName() {
        var obj = new Object();
        obj.Module = "Deo";
        obj.Page_key = "getAccountName";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    function getMasterItems() {
        var obj = new Object();
        obj.Module = "Deo";
        obj.Page_key = "getMasterItems";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }






    $("#qty, #rate").on('input', function() {
        let qty = parseFloat($('#qty').val()) || 0;
        let rate = parseFloat($('#rate').val()) || 0;
        $('#amount').val(qty * rate);
    });

    $("#particulars").on("blur", function() {
        const entered = $(this).val().trim();
        const match = masterItems.find(item =>
            item.Name.toLowerCase() === entered.toLowerCase()
        );

        if (match) {
            // Auto-fill Rate
            $("#rate").val(match.Rate);

            // Auto-calculate Amount
            let qty = parseFloat($('#qty').val()) || 0;
            $('#amount').val(qty * match.Rate);
        }
    });

    $('#addEntryBtn').click(function() {
        const entryDate = $('#entry_date').val();
        const type = $('#type').val();
        const accountId = $('#account_name').val();
        const accountName = $('#account_name option:selected').text();
        const qty = $('#qty').val();
        const rate = $('#rate').val();
        const particulars = $('#particulars').val();
        const description = $('#description').val();
        const amount = parseFloat($('#amount').val()) || 0;

        if (!entryDate || accountId === '' || particulars === '' || amount === 0) {
            alert("Please enter Date, Account, Particulars, and Amount");
            return;
        }

        let paymentCol = '';
        let receiptCol = '';
        if (type === "Payment") paymentCol = amount.toFixed(2);
        else receiptCol = amount.toFixed(2);

        let row = `
        <tr data-account-id="${accountId}">
            <td>${entryDate}</td>
            <td>${accountName}</td>
            <td>${particulars}</td>
            <td>${qty}</td>
            <td>${rate}</td>
            <td>${description}</td>
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





    function generatePDF() {
        // Hide the Action column temporarily
        $('#journalentries th:last-child, #journalentries td:last-child').hide();

        // Clone the table with styles preserved
        const tableClone = document.getElementById('journalentries').cloneNode(true);

        // Apply inline styles for better alignment
        tableClone.style.width = "100%";
        tableClone.style.borderCollapse = "collapse";
        tableClone.querySelectorAll("th, td").forEach(cell => {
            cell.style.border = "1px solid #000";
            cell.style.padding = "6px";
            cell.style.textAlign = "center";
            cell.style.fontSize = "12px";
        });

        // Wrapper for PDF
        const printable = document.createElement('div');
        printable.innerHTML = `
        <h2 style="text-align:center; margin-bottom:15px;">Journal Entry</h2>
    `;
        printable.appendChild(tableClone);

        // Options
        const opt = {
            margin: 0.5,
            filename: 'Journal_Entry.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 2,
                useCORS: true
            },
            jsPDF: {
                unit: 'in',
                format: 'a4',
                orientation: 'landscape' // ✅ landscape for better fit
            }
        };

        // Generate PDF
        html2pdf().from(printable).set(opt).save().then(() => {
            // Show Action column back
            $('#journalentries th:last-child, #journalentries td:last-child').show();
        });
    }


    function saveLedgerEntry() {
        const entries = [];

        $('#ledgerBody tr').each(function() {
            const entryDate = $(this).find('td:eq(0)').text().trim();
            const account = $(this).find('td:eq(1)').text().trim();
            const particulars = $(this).find('td:eq(2)').text().trim();
            const qty = $(this).find('td:eq(3)').text().trim();
            const rate = $(this).find('td:eq(4)').text().trim();
            const description = $(this).find('td:eq(5)').text().trim();
            const payment = $(this).find('td:eq(6)').text().trim();
            const receipt = $(this).find('td:eq(7)').text().trim();

            if (payment && parseFloat(payment) > 0) {
                entries.push({
                    type: 'Payment',
                    date: entryDate,
                    account: account,
                    particulars: particulars,
                    qty: qty,
                    rate: rate,
                    description: description,
                    amount: parseFloat(payment) || 0
                });
            }
            if (receipt && parseFloat(receipt) > 0) {
                entries.push({
                    type: 'Receipt',
                    date: entryDate,
                    account: account,
                    particulars: particulars,
                    qty: qty,
                    rate: rate,
                    description: description,
                    amount: parseFloat(receipt) || 0
                });
            }
        });

        const payload = {
            Module: "Deo",
            Page_key: "saveJournalEntries",
            JSON: {
                entries: entries
            }
        };

        console.log("Saved Entries:", payload);
        TransportCall(payload);
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
    let masterItems;

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
                case "getMasterItems":
                    console.log("MasterItems", rc.return_data);
                    masterItems = rc.return_data;
                    break;

                case "saveJournalEntries":
                    notify('success', rc.return_data);
                    break;


                default:
                    alert(rc.Page_key);
            }
        } else {
            alert(rc.return_data);
        }
        // alert(JSON.stringify(args));
    }


    // Attach autocomplete to particulars input
    $("#particulars").autocomplete({
        minLength: 1, // start searching after typing 1 character
        source: function(request, response) {
            // Filter masterItems based on input
            const term = request.term.toLowerCase();
            const matches = masterItems.filter(item =>
                item.Name.toLowerCase().includes(term)
            ).map(item => ({
                label: item.Name, // what to show in suggestions
                value: item.Name, // what goes into input
                rate: item.Rate // extra field for rate
            }));

            response(matches); // send results to autocomplete
        },
        select: function(event, ui) {
            // Auto fill rate when user picks an item
            $("#rate").val(ui.item.rate);
        }
    });

    // Also handle if user types full name and tabs away


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
</script>