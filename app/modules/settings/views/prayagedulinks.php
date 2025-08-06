<!-- summernote -->
<link rel="stylesheet" href="assets/admin/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.css">

<link rel="stylesheet" href="assets/admin/plugins/bootstrap-toggle-master/css/bootstrap-toggle.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Prayagedu Links
                            </div>

                            <span class="float-right">
                                <button class="btn btn-info" id="generateLinks">Generate Links</button>
                                <!-- <button class="btn btn-success" data-toggle="modal" data-target="#modal-lg"> <i class="fa fa-circle-thin"> <i class="fa fa-plus"></i> </i>Add Client(s)</button> -->
                            </span>

                           
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="table" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">City Name</th>
                                    <th scope="col">State Name</th>
                                    <th scope="col">Link</th>
                                    <th scope="col">-</th>
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

<!-- /.content-wrapper -->
<!-- validating input -->


<!-- Summernote -->
<script src="assets/admin/plugins/summernote/summernote-bs4.min.js"></script>

<script src="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.js"></script>
<script src="assets/admin/plugins/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>

<script>
      $(function() {
        getPrayageduLinks();
    });

    function getPrayageduLinks(stateid){
        var obj=new Object();
        obj.Module = "Settings";
        obj.Page_key = "getPrayageduLinks";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    $("#generateLinks").click(function(){
        alert();
        var obj=new Object();
        obj.Module = "Settings";
        obj.Page_key = "generatePrayageduLinks";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);

    });

    function onSuccess(rc) {
    if (rc.return_code) {
        switch (rc.Page_key) {
            case "getPrayageduLinks":
                loaddata(rc.return_data);
                break;
            case "generatePrayageduLinks":
                notify("success",rc.return_data);
                break;
            default:
                notify("warning",rc.Page_key);
                // alert(rc.Page_key);
        }
    } else {
        notify("warning",rc.return_data);
        // alert(rc.return_data);
    }
   
    }
    
    function loaddata(data) 
    {
        var table = $("#table");

        try {
            if ($.fn.DataTable.isDataTable($(table))) {
                $(table).DataTable().destroy();
            }
        } catch (ex) {}

        var text = ""

        if (data.length == 0) {
            text += "No Data Found";
        } else {

            for (let i = 0; i < data.length; i++) {
                text += '<tr> ';
                text += '<td> ' + data[i].CityName + '</td>';
                text += '<td> ' + data[i].StateName + '</td>';
                text += '<td> ' + data[i].Link + '</td>';
                text += '<td>  </td>';
                text += '</tr >';
            }
        }

        $("#table tbody").html("");
        $("#table tbody").append(text);

        $(table).DataTable({
            responsive: true,
            "order": [],
            dom: 'Bfrtip',
            "bInfo": true,
            exportOptions: {
                columns: ':not(.hidden-col)'
            },
            "deferRender": true,
            "pageLength": 10,
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


