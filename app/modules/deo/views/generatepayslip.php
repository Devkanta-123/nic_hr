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
  @media print {
    body * {
      visibility: hidden;
    }

    .invoice, .invoice * {
      visibility: visible;
    }

    .invoice {
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
    }

    .no-print {
      display: none !important;
    }
    @media print {
  .no-print {
    display: none !important;
  }
}

  }
</style>



<div class="content-wrapper" id="maincontent">
  <br>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="callout callout-info no-print">
            <h5><i class="fas fa-info"></i> Note:</h5>
            This page has been enhanced for printing. Click the print button at the bottom of the payslip to test.
          </div>


          <!-- Main content -->
          <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
              <div class="col-12">
                <h4>
                  <i class="fas fa-globe"></i> Test Inc
                  <small class="float-right" id="today-date">Date: </small>

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
                  Test Location<br>
                  <!-- San Francisco, CA 94107<br>
                    Phone: (804) 123-5432<br>
                    Email: test@gmail.com -->
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                To
                <address>
                  <strong id="emp-name"></strong><br>
                  Address: <span id="emp-address"></span><br>
                  Phone: <span id="emp-contact"></span><br>
                  Email: <span id="emp-email"></span>
                </address>
              </div>
              <!-- /.col -->
              <!-- <div class="col-sm-4 invoice-col">
                <b>Invoice #007612</b><br>
                <br>
                <b>Order ID:</b> 4F3S8J<br>
                <b>Payment Due:</b> 2/22/2014<br>
                <b>Account:</b> 968-34567
              </div> -->
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Total Pay</th> <!-- ✅ Added -->
                      <th>Opening Balance</th>
                      <th>Advance</th>
                      <th>Current Advance</th>
                      <th>Amount Paid</th>
                      <th>Gross Amount (T + OB - CA)</th>
                    </tr>
                  </thead>
                  <tbody id="payslip-summary">
                    <!-- Dynamic row will be injected here -->
                  </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-6">
                <!-- <p class="lead">Payment Methods:</p>
                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                  Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                  plugg
                  dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                </p> -->
              </div>
              <div class="col-6">
                <div class="table-responsive">
                  <table class="table">
                    <tbody id="payslip-summary-details">
                      <tr>
                        <th style="width:50%">New Opening Balance:</th>
                        <td></td>
                      </tr>
                      <tr>
                        <th>New Balance :</th>
                        <td></td>
                      </tr>
                      <tr>
                        <th>Net Pay :</th>
                        <td></td>
                      </tr>
                      <tr>
                        <th>New CurrentAdvance:</th>
                        <td></td>
                      </tr>
                    </tbody>

                  </table>
                </div>
              </div>
            </div>

            <div class="row no-print">
              <div class="col-12">
                <button type="button" class="btn btn-success float-right" id="print-invoice"><i class="fas fa-print"></i> Print
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

  $(function () {
     $('#print-invoice').on('click', function () {
      window.print();
    });
    function printTodayDate() {
      const today = new Date();
      const formattedDate = today.toLocaleDateString('en-GB'); // DD/MM/YYYY
      $('#today-date').text(`Date: ${formattedDate}`);
    }

    // Call the function on page load
    printTodayDate();

    let empId;
    const encryptedEmpId = getQueryParam('emp');
    empId = atob(encryptedEmpId);
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

  function onSuccess(rc) {
    debugger;
    if (rc.return_code) {
      switch (rc.Page_key) {
        case "getPaySlipsDataByEmpID":
          loadEmployeeInfo(rc.return_data);
          loadPaySlipSummary(rc.return_data);
          break;
        default:
          alert(rc.Page_key);
      }
    } else {
      alert(rc.return_data);
    }
    // alert(JSON.stringify(args));
  }



  function loadEmployeeInfo(emp) {
    if (!emp) return;

    $('#emp-name').text(emp.emp_name || 'N/A');
    $('#emp-contact').text(emp.emp_contact || 'N/A');
    $('#emp-email').text(emp.emp_email || 'N/A');
    $('#emp-address').text(emp.emp_address || 'Address not available');
  }


  function loadPaySlipSummary(emp) {
    if (!emp) return;

    // First Table Values
    const openingBalance = emp.OpeningBalance || '0.00';
    const advance = emp.Advance || '0.00';
    const currentAdvance = emp.CurrentAdvance || '0.00';
    const amountPaid = emp.AmountPaid || '0.00';
    const totalPay = emp.TotalPay || '0.00';
    const grossAmount = parseFloat(totalPay) + parseFloat(openingBalance) - parseFloat(currentAdvance);

    // First Table Row
    const rowHtml = `
    <tr>
      <td>&#8377; ${totalPay}</td>
      <td>&#8377; ${openingBalance}</td>
      <td>&#8377; ${advance}</td>
      <td>&#8377; ${currentAdvance}</td>
      <td>&#8377; ${amountPaid}</td>
      <td>&#8377; ${grossAmount.toFixed(2)}</td>
    </tr>
  `;
    $('#payslip-summary').html(rowHtml);

    // Second Table Details
    const newOpeningBalance = emp.NewOpeningBalance || '0.00';
    const newBalance = emp.NewBalance || '0.00';
    const netPay = emp.NetPay || '0.00';
    const newCurrentAdvance = emp.NewCurrentAdvance || '0.00';

    const detailsHtml = `
    <tr>
      <th style="width:50%">New Opening Balance:</th>
      <td>&#8377; ${newOpeningBalance}</td>
    </tr>
    <tr>
      <th>New Balance :</th>
      <td>&#8377; ${newBalance}</td>
    </tr>
    <tr>
      <th>NetPay :</th>
      <td>&#8377; ${netPay}</td>
    </tr>
    <tr>
      <th>NewCurrentAdvance:</th>
      <td>&#8377; ${newCurrentAdvance}</td>
    </tr>
  `;
    $('#payslip-summary-details').html(detailsHtml);
  }



  function searchOnDate() {
    const selectedDate = document.querySelector('input[type="date"]').value;
    if (!selectedDate) {
      loaddata(empPaySlipdata); // If no date selected, show all
      return;
    }

    const filteredData = empPaySlipdata.filter(emp => emp.attendance_date === selectedDate);
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
    const todaysData = empPaySlipdata.filter(emp => emp.attendance_date === today);
    loaddata(todaysData);
  }
</script>


</body>

</html>