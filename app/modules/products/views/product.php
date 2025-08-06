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
                                Products
                            </div>

                            <span class="float-right">
                                <button class="btn btn-success" data-toggle="modal" data-target="#modal-lg" onclick="clearForm()"> <i class="fa fa-circle-thin"> <i class="fa fa-plus"></i> </i>Add Product(s)</button>
                            </span>

                            <div class="modal fade" id="modal-lg">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Products</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="product_name">Product Name </label>
                                                            <input type="text" id="product_name" class="form-control" placeholder="Product Name" autocomplete="off">
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="product_code">Product Code </label>
                                                            <input type="text" id="product_code" class="form-control" placeholder="Product Code "  autocomplete="off">
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="website">Website</label>
                                                            <input type="text" id="website" class="form-control" placeholder="Website"  autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="description">Description</label>
                                                            <textarea name="" id="description" class="form-control" autocomplete="off"></textarea>
                                                            <!-- <input type="text" id="description" class="form-control" placeholder=" Description"  autocomplete="off"> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="btnSave">Save </button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="table" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Product Code</th>       
                                    <th scope="col">Website</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Created On</th>
                                    <th scope="col"> Action</th>

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

<!-- Summernote -->
 
<script src="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.js"></script>
<script src="assets/admin/plugins/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>

<script>
    $(function() {
        getProducts();  
    });

    function getProducts() {
        var obj = new Object();
        obj.Module = "Products";
        obj.Page_key = "getProducts";
        var json = new Object();        
        obj.JSON = json;
        TransportCall(obj);
    }
      
    function clearform() {
       $('#product_name').val('');
       $('#product_code').val('');
       $('#website').val('');
       $('#description').val('');
    }

    function onSuccess(rc) {

        if (rc.return_code) {
            switch (rc.Page_key) {
             
                case "deleteProduct":
                    notify("success", rc.return_data); 
                    getProducts(); 
                    
                case "addProduct":
                    $("#modal-lg").modal("hide");
                    //alert(rc.return_data);
                    getProducts(); 
                    clearform();
                    break;

                case "getProducts":
                    debugger;
                    loaddata(rc.return_data);
                    break;
                default:
                    notify("error", rc.Page_key);
            }
        } else {
            notify("error", rc.return_data);
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
            text += "No Data Found";
        } else {

            for (let i = 0; i < data.length; i++) {
                text += '<tr> ';
                text += '<th> ' + data[i].Name + '</th>';
                text += '<td> ' + data[i].Code + '</td>';
                text += '<td> ' + data[i].Website + '</td>';
                text += '<td> ' + data[i].Description + '</td>';
                text += '<td> ' + new Date(data[i].CreatedDateTime).toLocaleDateString() + '</td>';
                text += '<td class="btn-group btn-group-sm">';
                text += ' <a class="btn btn-info btn-sm text-white" onclick="onEdit(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fas fa-pencil-alt"> </i> </a>';
                text += ' <a class="btn btn-danger btn-sm text-white" onclick="onDelete(' + data[i].ProductID + ')"> <i class="fas fa-trash"> </i> </a>';
                text += '</td>';
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

    $("#btnSave").click(function (){ 
        let obj = {};
        obj.Module = "Products";
        obj.Page_key = "addProduct";
        let json = {};    
        json.ProductCoode = $("#product_code").val();
        json.ProductName = $("#product_name").val(); 
        json.Website = $("#website").val();
        json.Description = $("#description").val(); 

        if(code !=null){
            json.ProductID = code;
        }

        obj.JSON = json; 
        console.log(JSON.stringify(obj));
        TransportCall(obj);
    });

    var code=null;
    function onEdit(data){
        data = JSON.parse(unescape(data));
        $("#product_code").val(data.Code);
        $("#product_name").val(data.Name);
        $("#description").val(data.Description);
        $("#website").val(data.Website);   
        mode = 2;
        code = data.ProductID;
        $("#modal-lg").modal("show");                                                                      
    }

    function onDelete(ProductID)
    {
        //alert(ProductID);
        if (confirm("Are you sure you want to delete")) 
        {
            let obj = {};
            obj.Module = "Products";
            let json = {};
            obj.Page_key = "deleteProduct";
            json.ProductID = ProductID;
            obj.JSON = json;
            TransportCall(obj);
       }
    }

</script>