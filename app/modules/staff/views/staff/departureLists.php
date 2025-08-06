<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="maincontent">
    <!-- DataTables -->
    <link rel="stylesheet" href="assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="assets/admin/plugins/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.css">

    <link rel="stylesheet" href="assets/admin/plugins/bootstrap-toggle-master/css/bootstrap-toggle.min.css">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <!-- statisics Card -->
                        <div class="card-header">
                            <h1 class="card-title">Departure Staff</h1>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="table" class="table table-bordered table-striped table-responsive">
                                <thead>
                                    <tr>
                                        <th scope="col">Sl#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Contact</th>
                                        <th scope="col">Date Of Birth</th>
                                        <th scope="col">Date Of Joining</th>
                                        <th scope="col">Departure Type</th>
                                        <th scope="col">Departure on </th>

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
            <!-- /.col -->
        </div>
        <!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.14.3/xlsx.full.min.js"></script>
<!-- Summernote -->
<script src="assets/admin/plugins/summernote/summernote-bs4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.js"></script>
<script src="assets/admin/plugins/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>
</div>
<!-- /.content-wrapper -->
<script>
    $(function() {
        getDepartureStaff();
    });


    function getDepartureStaff() {
        var obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getDepartureStaff";
        obj.JSON = {};
        TransportCall(obj);
    }

    function onSuccess(rc) {

        if (rc.return_code) {
            switch (rc.Page_key) {
                case "getDepartureStaff":
                 
                    loaddata(rc.return_data);
                    break;
                default:
                    notify('error', "Unable to process the request");
            }
        } else {
            notify('error', rc.return_data);
            try {
                if ($.fn.DataTable.isDataTable($(table))) {
                    $(table).DataTable().destroy();
                }
            } catch (ex) {}
            $("#table tbody").html("");
        }
    }

    function loaddata(data) {
        var table = $("#table");

        try {
            if ($.fn.DataTable.isDataTable($(table))) {
                $(table).DataTable().destroy();
            }
        } catch (ex) {}

        var text = ""

        if (data.length == 0) {
            text += "<tr><td colspan=6>No Data Found</td></tr>";
        } else {
            for (let i = 0; i < data.length; i++) {
                text += '<tr> ';
                text += '<td> ' + (i + 1) + '</td>';
                text += '<td> ' + data[i].StaffName + ' <br>  <span class="badge badge-info">' + data[i].DesignationName + '</span> </td>';
                text += '<td> ' + data[i].ContactNo + ' <br> <span class="badge badge-secondary"> ' + data[i].EmailID + ' </span></td>';
                text += '<td> ' + (new Date(data[i].DOB)).toLocaleDateString("en-in") + '</td>';
                text += '<td> ' + (new Date(data[i].JoinedDate)).toLocaleDateString("en-in") + '</td>';
                text += '<td> ' + data[i].DepartureType + '</td>';
                text += '<td> ' + data[i].SeparatedDateTime + '</td>';
                text += '</tr>';
            }
        }

        $("#table tbody").html(text);

        $(table).DataTable({
            responsive: true,
            "order": [],
            dom: 'Bfrtip',
            "bInfo": true,
            exportOptions: {
                columns: ':not(.hidden-col)'
            },
            "deferRender": true,
            "pageLength": 20,
            buttons: [{
                    exportOptions: {
                        columns: ':not(.hidden-col)'
                    },
                    extend: 'excel',
                    orientation: 'landscape',
                    pageSize: 'A4'
                },
                {
                    exportOptions: {
                        columns: ':not(.hidden-col)'
                    },
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'A4'
                },
                {
                    exportOptions: {
                        columns: ':not(.hidden-col)'
                    },
                    extend: 'print',
                    orientation: 'landscape',
                    pageSize: 'A4'
                }
            ]

        });
    }
</script>