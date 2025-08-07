<!-- summernote -->
<link rel="stylesheet" href="assets/admin/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet"
    href="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.css">

<link rel="stylesheet" href="assets/admin/plugins/bootstrap-toggle-master/css/bootstrap-toggle.min.css">
<!-- Bootstrap Switch -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js"></script>




<div class="content-wrapper" id="maincontent">
    <br>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
            </div>


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> AdminLTE, Inc.
                    <small class="float-right">Date: 2/10/2014</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>Admin, Inc.</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    Phone: (804) 123-5432<br>
                    Email: info@almasaeedstudio.com
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong>John Doe</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    Phone: (555) 539-1037<br>
                    Email: john.doe@example.com
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice #007612</b><br>
                  <br>
                  <b>Order ID:</b> 4F3S8J<br>
                  <b>Payment Due:</b> 2/22/2014<br>
                  <b>Account:</b> 968-34567
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Qty</th>
                      <th>Product</th>
                      <th>Serial #</th>
                      <th>Description</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>1</td>
                      <td>Call of Duty</td>
                      <td>455-981-221</td>
                      <td>El snort testosterone trophy driving gloves handsome</td>
                      <td>$64.50</td>
                    </tr>
                    <tr>
                      <td>1</td>
                      <td>Need for Speed IV</td>
                      <td>247-925-726</td>
                      <td>Wes Anderson umami biodiesel</td>
                      <td>$50.00</td>
                    </tr>
                    <tr>
                      <td>1</td>
                      <td>Monsters DVD</td>
                      <td>735-845-642</td>
                      <td>Terry Richardson helvetica tousled street art master</td>
                      <td>$10.70</td>
                    </tr>
                    <tr>
                      <td>1</td>
                      <td>Grown Ups Blue Ray</td>
                      <td>422-568-642</td>
                      <td>Tousled lomo letterpress</td>
                      <td>$25.99</td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Methods:</p>
                  <img src="../../dist/img/credit/visa.png" alt="Visa">
                  <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                  <img src="../../dist/img/credit/american-express.png" alt="American Express">
                  <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                    plugg
                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Amount Due 2/22/2014</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tbody><tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>$250.30</td>
                      </tr>
                      <tr>
                        <th>Tax (9.3%)</th>
                        <td>$10.34</td>
                      </tr>
                      <tr>
                        <th>Shipping:</th>
                        <td>$5.80</td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>$265.24</td>
                      </tr>
                    </tbody></table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
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

      // Function to get query string value
        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        const encryptedEmpId = getQueryParam('emp');

        if (encryptedEmpId) {
            debugger;
            try {
                const empId = atob(encryptedEmpId); // JS decrypt (Base64)
                document.getElementById('emp').innerText = `Decrypted Employee ID: ${empId}`;
                // Use empId for further API calls or UI display
            } catch (error) {
                document.getElementById('emp').innerText = "Invalid or corrupted employee ID.";
            }
        } else {
            document.getElementById('emp').innerText = "No employee ID provided.";
        }
    $(function() {
        getAttendanceReport()
        var today = new Date().toISOString().split('T')[0];
        // Set max attribute to today
        $('#dateInput').attr('max', today);
    });

    function getAttendanceReport() {
        var obj = new Object();
        obj.Module = "Employee";
        obj.Page_key = "getAttendanceReport";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }
    let employeeAttendanceData = [];

    function onSuccess(rc) {
        debugger;
        if (rc.return_code) {
            switch (rc.Page_key) {
                case "getAttendanceReport":
                    employeeAttendanceData = rc.return_data;
                    // loadTodayAttendance();
                    loaddata(rc.return_data)
                    // document.querySelector('input[type="date"]').value = getTodayDate();
                    break;
                case "markAttendance":
                    notify('success', rc.return_data);
                    console.log(rc.return_data);
                    getAttendanceReport();
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


    function loaddata(data) {
        const table = $("#empAttendance");

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
                const attendanceStatus = emp.attendance_status || "Absent";

                // ✅ Show shift if status is Present or Halfday
                const showShift =
                    attendanceStatus.toLowerCase() === "present" ||
                    attendanceStatus.toLowerCase() === "halfday";

                const shiftValue = showShift ? (emp.shift || "") : "";

                // Badge color
                let badgeClass = "danger";
                if (attendanceStatus.toLowerCase() === "present") {
                    badgeClass = "success";
                } else if (attendanceStatus.toLowerCase() === "halfday") {
                    badgeClass = "primary";
                }

                text += `<tr>`;
                text += `<td>${emp.emp_name}</td>`;
                text += `<td>${emp.emp_contact}</td>`;
                text += `<td>${emp.sector || 'N/A'}</td>`;
                text += `<td>${emp.attendance_date || 'N/A'}</td>`;
                text += `<td>${emp.in_time || 'N/A'}</td>`;
                text += `<td>
                        <small class="badge badge-${badgeClass}">
                            ${attendanceStatus}
                        </small>
                          <small>
                            ${shiftValue ? " (" + shiftValue + ")" : ""}
                        </small>
                    </td>`;
                text += `</tr>`;
            }
        }

        $("#empAttendance tbody").html(text);

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


    function getTodayDate() {
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        return `${yyyy}-${mm}-${dd}`;
    }

    function loadTodayAttendance() {
        const today = getTodayDate();
        const todaysData = employeeAttendanceData.filter(emp => emp.attendance_date === today);
        loaddata(todaysData);
    }
</script>

   
</body>
</html>
