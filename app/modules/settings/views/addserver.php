<?php require_once(VIEWPATH . "/basic/header.php"); ?>
<?php require_once(VIEWPATH . "/basic/sidebar.php"); ?>

<link href="assets/js/plugins/icheck-bootstrap/icheck-bootstrap.min.css" rel="stylesheet">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <span class="float-right">
                                <button class="btn btn-success" data-toggle="modal" data-target="#modal-lg"> <i class="fa fa-circle-thin"> <i class="fa fa-plus"></i> </i>Add Server</button>
                            </span>
                        </div>
                        <div class="modal fade" id="modal-lg">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add Server</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-body text-center">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="server_name">Server Name:</label>
                                                        <input type="text" id="server_name" class="form-control" placeholder="Server Name" autocomplete="off" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="ip_address">IP Address:</label>

                                                        <input type="text" id="ip_address" class="form-control" placeholder="IP Address" autocomplete="off" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body text-center">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="server_domain_name">Server Domain Name:</label>
                                                        <input type="text" id="server_domain_name" class="form-control" placeholder="Server Domain Name" autocomplete="off" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="descriptions">Descriptions:</label>
                                                        <input type="text" id="descriptions" class="form-control" placeholder="Descriptions" autocomplete="off" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="btnAddServer">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Server Name</th>
                                        <th scope="col">Ip Address</th>
                                        <th scope="col">Server Domain Name</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>


                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                    <!-- /.modal-dialog -->
                </div>
                <script type="text/javascript">
                    $("#btnAddServer").click(function() {
                        function check_number(num) {
                            if (isNaN(num)) {
                                alert("Error !! Please enter a number");
                                Exit();
                            }

                        }
                    });
                </script>
                <!-- card for table  -->


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

<?php require_once(VIEWPATH . "/basic/footer.php"); ?>

<script src="assets/js/plugins/icheck-bootstrap/icheck.min.js"></script>
<!-- Jasny File -->
<script src="assets/js/plugins/jasny-bootstrap.min.js"></script>
<script>
    $(function() {
        getServer();

    });

    function clearform() {
        $('#server_name').val('');

    }

    function getServer() {
        var obj = new Object();
        obj.Module = "Settings";
        obj.Page_key = "getServer";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }



    function onSuccess(rc) {

        if (rc.return_code) {
            switch (rc.Page_key) {
                case "getServer":
                    //debugger;
                    loaddata(rc.return_data);
                    break;

                case "addServer":
                    $("#modal-lg").modal("hide");
                    alert(rc.return_data);
                    getServer();
                    clearform();
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
        var table = $("#table");

        try {
            if ($.fn.DataTable.isDataTable($(table))) {
                $(table).DataTable().destroy();
            }
        } catch (ex) {}

        var text = ""



        for (let i = 0; i < data.length; i++) {
            text += '<tr> ';
            text += '<th> ' + data[i].ServerName + '</th>';
            text += '<td> ' + data[i].IPAddress + '</td>';
            text += '<td> ' + data[i].ServerDomainName + '</td>';
            text += '<td class="btn-group btn-group-sm">';
            text += ' <a class="btn btn-info btn-sm text-white" onclick="onEdit(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fas fa-pencil-alt"> </i> </a>';
            text += ' <a class="btn btn-danger btn-sm text-white" onclick="onDelete(' + data[i].ServerID + ')"> <i class="fas fa-trash"> </i> </a>';
            text += '</tr >';
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

    $("#btnAddServer").click(function() {
        var ipAddress = $("#ip_address").val();
        var ipAddressPattern = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
        if (!ipAddress.match(ipAddressPattern)) {
            notify("error", "Invalid IP address");
            return;
        }
        let obj = {};
        obj.Module = "Settings";
        obj.Page_key = "addServer";
        let data = {};
        data.server_name = $("#server_name").val();
        data.ip_address = $("#ip_address").val();
        data.server_domain_name = $("#server_domain_name").val();
        data.descriptions = $("#descriptions").val();
        if (code != null) {
            data.ServerID = code;
        }
        obj.JSON = data;
        console.log(JSON.stringify(obj));
        TransportCall(obj);
    });
    var code = null;

    function onEdit(data) { //added by dev on 06/11/23
        data = JSON.parse(unescape(data));
        // $("#product_code").val(data.Code);
        $("#server_name").val(data.ServerName);
        $("#ip_address").val(data.IPAddress);
        $("#server_domain_name").val(data.ServerDomainName);
        $("#descriptions").val(data.Descriptions);
        mode = 2;
        code = data.ServerID;
        console.log(data.ServerID);
        $("#modal-lg").modal("show");
    }

    function onDelete(ServerID) //added by dev on 06/11/23
    {
        if (confirm("Are you sure you want to delete")) {
            let obj = {};
            obj.Module = "Settings";
            let json = {};
            obj.Page_key = "deleteServer";
            json.ServerID = ServerID;
            //console.log(ServerID);
            obj.JSON = json;
            TransportCall(obj);
        }
    }
</script>