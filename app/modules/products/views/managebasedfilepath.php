<?php require_once(VIEWPATH . "/basic/header.php"); ?>
<?php require_once(VIEWPATH . "/basic/sidebar.php"); ?>

<link href="assets/js/plugins/icheck-bootstrap/icheck-bootstrap.min.css" rel="stylesheet">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card-header">
                       
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <span class="float-right">
                                <button class="btn btn-success" data-toggle="modal" data-target="#modal-lg"> <i class="fa fa-circle-thin"> <i class="fa fa-plus"></i> </i>Add Product URL</button>
                            </span>
                        </div>
                        <div class="modal fade" id="modal-lg">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add Product URL</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-body text-center">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="server_name">Products</label>
                                                        <select class="form-control" name="" id="product_name">
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="ip_address">DataBase Source </label> <span style="color:red;">(must be a .sql file extensions)</span>

                                                        <input type="text" id="db_base_source" class="form-control" placeholder="DataBase Source" autocomplete="off" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body text-center">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="server_domain_name">File Source URL </label> <span style="color:red;">(must be a .zip file extensions)</span>
                                                        <input type="text" id="file_source_url" class="form-control" placeholder="File Source URL" autocomplete="off" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="btnSave">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                   
                <script type="text/javascript">
                    $("#btnSave").click(function() {
                        function check_number(num) {
                            if (isNaN(num)) {
                                alert("Error !! Please enter a number");
                                Exit();
                            }

                        }
                    });
                </script>
                <!-- card for table  -->
                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Product Name</th>
                                <th scope="col">Data Base Source </th>
                                <th scope="col">File Source URL</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

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
        getProducts();
        getProductBasedURL();

    });

    function clearform() {

    }


    function getProducts() {
        var obj = new Object();
        obj.Module = "Products";
        obj.Page_key = "getProducts";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    function getProductBasedURL() {
        var obj = new Object();
        obj.Module = "Products";
        obj.Page_key = "getProductBasedURL";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }


    function onSuccess(rc) {

        if (rc.return_code) {
            switch (rc.Page_key) {
                case "getProductBasedURL":
                    //debugger;
                    loaddata(rc.return_data);
                    break;
                case "deleteProductURL":
                    notify("success", rc.return_data);
                    getProductBasedURL();
                    break;

                case "addproductbasedfiles":
                    notify("success", rc.return_data);
                    $("#modal-lg").modal("hide");
                    getProductBasedURL();
                    break;
                case "getProducts":
                    loadSelect("#product_name", rc.return_data);
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
            text += '<th> ' + data[i].Name + '</th>';
            text += '<td> ' + data[i].DBBasedSource + '</td>';
            text += '<td> ' + data[i].FileSourceURL + '</td>';
            text += '<td class="btn-group btn-group-sm">';
            text += ' <a class="btn btn-info btn-sm text-white" onclick="onEdit(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fas fa-pencil-alt"> </i> </a>';
            text += ' <a class="btn btn-danger btn-sm text-white" onclick="onDelete(' + data[i].ProductID + ')"> <i class="fas fa-trash"> </i> </a>';
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

    $("#btnSave").click(function() { //added by dev on 06/11/23
        let dbfile = $("#db_base_source").val(); //checking for valid .sql file extensions
        if (!isSqlFile(dbfile)) {
            notify("error", "Please enter a valid .sql file name");
            return;
        }
        let zipfile = $("#file_source_url").val(); //checking for valid .zip file extensions
        if (!isZipFile(zipfile)) {
            notify("error", "Please enter a valid .zip file name");
            return;
        }

        let obj = {};
        obj.Module = "Products";
        obj.Page_key = "addproductbasedfiles";
        let data = {};
        data.product_id = $("#product_name").val();
        data.db_base_source = $("#db_base_source").val();
        data.file_source_url = $("#file_source_url").val();
        if (code != null) {
            data.ProductID = code;
        }
        obj.JSON = data;
        console.log(JSON.stringify(obj));
        console.log(data.product_id);
        TransportCall(obj);
    });

    function isZipFile(zipfile) { //added by dev on 06/11/23
        if (zipfile) {
            var fileExtension = zipfile.split('.').pop().toLowerCase(); //pop() is used with arrays to remove and return the last element of the array.
            return fileExtension === "zip";
        }
        return false;
    }

    function isSqlFile(dbfile) { //added by dev on 06/11/23
        if (dbfile) {
            var fileExtension = dbfile.split('.').pop().toLowerCase();
            return fileExtension === "sql";
        }
        return false;
    }
    var code = null;

    function onEdit(data) { //added by dev on 06/11/23
        data = JSON.parse(unescape(data));
        console.log(data.ProductID);
        // $("#product_code").val(data.Code);
        $("#product_name").val(data.Name);
        $("#db_base_source").val(data.DBBasedSource);
        $("#file_source_url").val(data.FileSourceURL);
        mode = 2;
        code = data.ProductID;
        $("#modal-lg").modal("show");
    }

    function onDelete(ProductID) //added by dev on 06/11/23
    {
        if (confirm("Are you sure you want to delete")) {
            let obj = {};
            obj.Module = "Products";
            let json = {};
            obj.Page_key = "deleteProductURL";
            json.ProductID = ProductID;
            obj.JSON = json;
            TransportCall(obj);
        }
    }
</script>