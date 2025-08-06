<!-- Begin page -->
<!-- removeNotificationModal -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Are you sure ?</h4>
                        <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!</button>
                </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- sidebar laod form include file -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->

            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Assign Work</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="assignWorkList" class="table table-bordered nowrap table-striped align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>SL.NO</th>
                                           <th>Work Title</th>
                                           <th>Handle By</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Location</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end row-->


        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>
                        document.write(new Date().getFullYear())
                    </script> © Velzon.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Design & Develop by 2 Brothers
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<!-- end main content-->

</div>
<!-- END layout-wrapper -->



<!--start back-to-top-->
<button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
</button>

<!-- JAVASCRIPT -->
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>
<script src="assets/libs/feather-icons/feather.min.js"></script>
<script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
<script src="assets/js/plugins.js"></script>
<!-- apexcharts -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- Dashboard init -->
<script src="assets/js/pages/dashboard-Ongyi.init.js"></script>

<!-- App js -->
<script src="assets/js/app.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(function() {
        getAssignWork();
    });

    function getAssignWork() {
        debugger;
        var obj = new Object();
        obj.Module = "Work";
        obj.Page_key = "getAssignWork";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    function onSuccess(rc) {
        debugger;
        if (rc.return_code) {
            switch (rc.Page_key) {
                case "getAssignWork":
                    console.log(rc.return_data);
                    loaddata(rc.return_data);
                    break;
                case "approvedDelivery":
                    debugger;
                    showSuccessNotification(rc.return_data);
                    break;
                default:
                    notify("warning", rc.Page_key);
            }
        } else {
            notify("warning", rc.return_data);
        }
    }

    function showSuccessNotification(message) {
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: message,
            showConfirmButton: false,
            timer: 3000,
            toast: true,
        });
    }

    function showWarningNotification() {
        const warningMessage = "This is a warning notification!";
        Swal.fire({
            position: 'top-end',
            icon: 'warning',
            title: warningMessage,
            showConfirmButton: false,
            timer: 3000,
            toast: true,
        });
    }

    // Function to show a danger notification
    function showDangerNotification() {
        const dangerMessage = "This is a danger notification!";
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: dangerMessage,
            showConfirmButton: false,
            timer: 3000,
            toast: true,
        });
    }

   
function loaddata(data) {
    // ✅ Destroy existing DataTable if already initialized
    if ($.fn.DataTable.isDataTable('#assignWorkList')) {
        $('#assignWorkList').DataTable().clear().destroy();
    }

    // ✅ Clear the table body
    $('#assignWorkList tbody').empty();

    // ✅ Populate the table with new data
    $.each(data, function (index, item) {
        var row = $('<tr>');
        row.append($('<td>').text(index + 1));
        row.append($('<td>').text(item.work_title));
        row.append($('<td>').text(item.emp_name));
        row.append($('<td>').text(new Date(item.start_date).toLocaleDateString()));
        row.append($('<td>').text(new Date(item.end_date).toLocaleDateString()));
        row.append($('<td>').text(item.loc_name));

        // Determine status badge class based on status value
        let statusClass = 'badge bg-info-subtle text-info'; // default
        if (item.status === 'assigned') {
            statusClass = 'badge bg-success'; // green
        } else if (item.status === 'pending') {
            statusClass = 'badge bg-warning text-dark'; // yellow
        } // Add more conditions if needed

        // Create status cell with badge span
        var statusTd = $('<td>');
        var statusSpan = $('<span>').addClass(statusClass).text(item.status);
        statusTd.append(statusSpan);
        row.append(statusTd);

        // Conditionally add dropdown or placeholder based on status
        if (item.status !== 'assigned') {
            row.append($('<td>').html(`
                <div class="dropdown d-inline-block">
                    <button class="btn btn-soft-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ri-more-fill align-middle"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><button class="dropdown-item" onclick="assign('${item.work_id}')">
                            <i class="ri-eye-fill align-bottom me-2 text-muted"></i>onHold
                        </button></li>
                    </ul>
                </div>
            `));
        } else {
            // Show placeholder for assigned status
            row.append($('<td>').text('—'));
        }

        $('#assignWorkList tbody').append(row);
    });

    // ✅ Reinitialize DataTable
    $('#assignWorkList').DataTable({
        responsive: true
    });
}


    function onError() {


    }

    function approved(ID) {
        var obj = new Object();
        obj.Module = "Delivery";
        obj.Page_key = "approvedDelivery";
        var json = new Object();
        json.PersonalID = ID;
        obj.JSON = json;
        TransportCall(obj);
    }
</script>
</body>


</html>