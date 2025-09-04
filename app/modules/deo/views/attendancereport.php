<!-- summernote -->
<link rel="stylesheet" href="assets/admin/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet"
  href="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.css">

<link rel="stylesheet" href="assets/admin/plugins/bootstrap-toggle-master/css/bootstrap-toggle.min.css">
<!-- Bootstrap Switch -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap3/bootstrap-switch.min.css"
  rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">



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
              <div class="row align-items-center">
                <!-- From Date -->
                <div class="col-md-3">
                  <label for="from_date" class="mb-0">From Date:</label>
                  <input type="date" id="from_date" class="form-control" autocomplete="off">
                </div>

                <!-- To Date -->
                <div class="col-md-3">
                  <label for="to_date" class="mb-0">To Date:</label>
                  <input type="date" id="to_date" class="form-control" autocomplete="off">
                </div>

                <!-- Employee Select -->
                <div class="col-md-4">
                  <label for="emp_id" class="mb-0">Employee:</label>
                  <select class="form-control" id="emp_id" name="emp_id">
                    <option value="">Select Employee</option>
                  </select>
                </div>

                <!-- Button -->
                <div class="col-md-2">
                  <button id="loadBtn" class="btn btn-success btn-block">Load Data</button>
                </div>
              </div>
            </div>





            <!-- Ends here  -->


            <div class="card-body">
              <p id="summary">Total Present: 0 | Absent: 0 | Halfday: 0</p>
              <table id="empAttendance" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th scope="col">Emp Name</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody></tbody>
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

<!-- /.content-wrapper -->
<!-- validating input -->

<!-- Summernote -->
<script src="assets/admin/plugins/summernote/summernote-bs4.min.js"></script>

<script src="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.js"></script>
<script src="assets/admin/plugins/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>

<script>
  $(function () {
    getActiveEmployeesForAttendance();
    getActiveEmployeeList();
  });

  let allLocations = [];
  let employeeData = [];

  let isLocationLoaded = false;
  let isEmployeeLoaded = false;

  function checkAndLoadTable() {
    if (isLocationLoaded && isEmployeeLoaded) {
      loaddata(employeeData);
    }
  }
  $("#loadBtn").on("click", function () {
    loaddata();
  });



  function getActiveEmployeesForAttendance() {
    var obj = new Object();
    obj.Module = "Employee";
    obj.Page_key = "getActiveEmployeesForAttendance";
    var json = new Object();
    obj.JSON = json;
    TransportCall(obj);
  }


  function getActiveEmployeeList() {
    var obj = new Object();
    obj.Module = "Employee";
    obj.Page_key = "getActiveEmployeeList";
    var json = new Object();
    obj.JSON = json;
    TransportCall(obj);
  }



  function onSuccess(rc) {
    debugger;
    if (rc.return_code) {
      switch (rc.Page_key) {
        case "getActiveEmployeesForAttendance":
          employeeData = rc.return_data;
          isEmployeeLoaded = true;
          console.log("Employees:", employeeData);
          break;

        case "getActiveEmployeeList":
          populateEmployeeDropdown(rc.return_data);
          break;


        case "markAttendance":
          notify('success', rc.return_data);
          console.log(rc.return_data);
          // optional: you might want to reset flags if reloading
          isEmployeeLoaded = false;
          //getActiveEmployeesForAttendance();
          break;

        default:
          alert(rc.Page_key);
      }
    } else {
      alert(rc.return_data);
    }
  }


  function populateEmployeeDropdown(emp) {
    const $empselect = $('#emp_id');
    $empselect.empty(); // Clear previous options
    $empselect.append('<option value="">Select Employee</option>');
    emp.forEach(function (emp) {
      $empselect.append(
        $('<option>', {
          value: emp.emp_id,
          text: emp.emp_name
        })
      );
    });
  }

  const today = new Date().toISOString().split("T")[0];
  // restrict date picker
  $("#to_date").attr("max", today);
  $("#from_date").attr("max", today);
  $("#to_date").val(today);


  // ✅ Load data (always show all employees, overlay attendance if exists)
  function filterAndLoadData(selectedDate) {
    const today = new Date().toISOString().split("T")[0];
    const isToday = (selectedDate === today);

    // pick only records that match selectedDate
    const existingForDate = employeeData.filter(item => item.attendance_date === selectedDate);

    // build rows
    loaddata(existingForDate, selectedDate, isToday);
  }

  function loaddata() {
    const table = $("#empAttendance");

    // Destroy old DataTable safely
    if ($.fn.DataTable.isDataTable(table)) {
      table.DataTable().clear().destroy();
    }

    // Get filters
    const fromDate = $("#from_date").val();
    const toDate = $("#to_date").val();
    const empId = $("#emp_id").val();

    if (!fromDate || !toDate || !empId) {
      notify("warning","Please select From Date, To Date, and Employee.");
      return;
    }

    // Filter employeeData
    const filteredData = employeeData.filter(emp => {
      return (
        emp.emp_id == empId &&
        emp.attendance_date >= fromDate &&
        emp.attendance_date <= toDate
      );
    });

    let text = "";
    let presentCount = 0,
      absentCount = 0,
      halfdayCount = 0;

    filteredData.forEach(emp => {
      const status = emp.attendance_status || "Absent"; // Default Absent if not found

      // Count summary
      if (status === "Present") presentCount++;
      else if (status === "Halfday") halfdayCount++;
      else absentCount++;

      text += `
      <tr>
        <td>${emp.emp_name}</td>
        <td>${emp.attendance_date}</td>
        <td>${status}</td>
      </tr>`;
    });

    $("#empAttendance tbody").html(text);

    // Update summary
    $("#summary").text(
      `Total Present: ${presentCount} | Absent: ${absentCount} | Halfday: ${halfdayCount}`
    );

    // Reinitialize DataTable
    table.DataTable({
      responsive: true,
      order: [],
      dom: "Bfrtip",
      bInfo: true,
      deferRender: true,
      pageLength: 10,
      buttons: [
        {
          extend: "excel",
          exportOptions: { columns: ":not(.hidden-col)" }
        },
        {
          extend: "pdfHtml5",
          exportOptions: { columns: ":not(.hidden-col)" }
        },
        {
          extend: "print",
          exportOptions: { columns: ":not(.hidden-col)" }
        }
      ]
    });
  }



  $("#saveAttendanceBtn").on("click", function () {
    $("#empAttendance tbody tr").each(function () {
      const empId = $(this).find(".attendance-status-radio").data("empid");
      const status = $(`input[name='status_${empId}']:checked`).val() || null;
      const shift = $(`#shift_${empId}`).val() || null;
      const isExisting = $(`#status_present_${empId}`).data("existing");
      const attendanceDate = $("#attendance_date").val();
      // Only call if user has selected something
      if (status) {
        sendAttendance(empId, status, shift, attendanceDate, isExisting);
      }
    });
  });


  //saveAttendanceBtn

  function sendAttendance(emp_id, status, shift, selectedDate, isExisting = false) {
    debugger;
    const loc_id = $(`.location-select[data-empid="${emp_id}"]`).val();
    if (!loc_id) {
      notify('warning', ' Select the location');
      return;
    }

    const attendance_date = $("#attendance_date").val();
    if (!attendance_date) {
      notify('error', 'Attendance date cannot be empty');
      return;
    }

    const obj = {
      Module: "Deo",
      Page_key: "markAttendance",
      JSON: {
        emp_id: emp_id,
        status: status,
        shift: shift || null,
        location_id: loc_id || null,
        attendance_date: attendance_date
      }
    };

    TransportCall(obj);
  }
</script>