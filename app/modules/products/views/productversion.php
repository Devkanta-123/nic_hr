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
                                Products Version 
                            </div>
                        </div>
                      
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-12">
                                    <label for="productsIDs">Product Name</label>
                                    <select name="" class="form-control" id="productsIDs"></select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="AndroidVersion">Android version </label>
                                        <select name="" id="AndroidVersion" class="form-control">
                                            <option value="">Select here</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="IosVersion">IOS Version</label>
                                        <select name="" id="IosVersion" class="form-control">
                                            <option value="">Select here</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Title">Title</label>
                                        <input type="text" id="Title" class="form-control" placeholder="Title"  autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                               
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Description">Description</label>
                                        <input type="text" id="Description" class="form-control" placeholder="Description"  autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5 border-bottom ">
                                <div class="col-4">
                                    <div class="form-group">
                                        <input class="form-check-input" type="checkbox" value="" id="forceUpdate" style="margin-left:100px;">
                                        <label class="form-check-label" for="forceUpdate">Force Update</label>
                                    </div>
                                </div>
                                <div class="col-8 text-right">
                                    <button class="btn btn-primary" id="UpdateProductVersionbtn"> Update</button>
                                </div>
                            </div>
                           
                            <table id="table" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Android Version</th>       
                                    <th scope="col">IOS Version</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">IsForce</th>
                                    <th scope="col">Last Update</th>
                                    <!-- <th scope="col">Action</th> -->
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
        //getProducts();
        getAllProduct();
        getProductVersion();  
    });

    function getProductVersionBasedonProductID(ProductID)
    {
        let obj = {};
            obj.Module = "Products";
            let json = {};
            obj.Page_key = "getProductVersionBasedonProductID";
            json.ProductID = ProductID;
            obj.JSON = json;
            TransportCall(obj);
    }

    function getAllProduct()
    {
        var obj = new Object();
        obj.Module = "Products";
        obj.Page_key = "getAllProduct";
        var json = new Object();        
        obj.JSON = json;
        TransportCall(obj);
    }

    function getProductVersion(){
        var obj = new Object();
        obj.Module = "Products";
        obj.Page_key = "getProductVersion";
        var json = new Object();        
        obj.JSON = json;
        TransportCall(obj);
    }

      
    // function clearform() {
    //    $('#product_name').val('');
    //    $('#product_code').val('');
    //    $('#website').val('');
    //    $('#description').val('');
    // }

    function onSuccess(rc) {

        if (rc.return_code) {
            switch (rc.Page_key) {
                
                //for update 
                case "getProductVersionBasedonProductID": 
                    loadforupdate(rc.return_data);
                    break;

                case "getAllProduct":
                    loadSelect("#productsIDs", rc.return_data); 
                    break;

                //for view
                case "getProductVersion":
                    loaddata(rc.return_data);
                    break;
                case "updateProductVersion":
                    notify("success", rc.return_data);
                    break;

                default:
                    notify("error", rc.Page_key);
            }
        } else {
            notify("error", rc.return_data);
        }
      
    }

    //for edit
    function loadforupdate(data)
    {
        for (let i = 0; i < data.length; i++) {
        $("#AndroidVersion").val(data[i].AndroidVersionCode); 
        $("#IosVersion").val(data[i].iOSVersionCode); 
        $("#Title").val(data[i].Title); 
        $("#Description").val(data[i].Description); 
        $("#forceUpdate").val(data[i].isForced);  
       
        }
    }
//for view
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
                text += '<td> ' + data[i].AndroidVersionCode + '</td>';
                text += '<td> ' + data[i].iOSVersionCode + '</td>';
                text += '<td> ' + data[i].Title + '</td>';
                text += '<td> ' + data[i].Description + '</td>';
                if( data[i].isForced==0)
                {
                    text += '<td> <span class="btn btn-info"> NO </span></td>';
                }
                else{
                    text += '<td> <span class="btn btn-danger"> Yes </span></td>';
                }
               
                text += '<td> ' + new Date(data[i].UpdatedDate).toLocaleDateString() + '</td>';
                //text += '<td class="btn-group btn-group-sm">';
                // text += ' <a class="btn btn-info btn-sm text-white" onclick="onUpdateVersion(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fas fa-pencil-alt"> </i> </a>';
               // text += '</td>';
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

    // $("#UpdateProductVersion").click(function (){ 
    //     let obj = {};
    //     obj.Module = "Products";
    //     obj.Page_key = "addProduct";
    //     let json = {};    
    //     json.ProductCoode = $("#product_code").val();
    //     json.ProductName = $("#product_name").val(); 
    //     json.Website = $("#website").val();
    //     json.Description = $("#description").val(); 

    //     if(code !=null){
    //         json.ProductID = code;
    //     }

    //     obj.JSON = json; 
    //     console.log(JSON.stringify(obj));
    //     TransportCall(obj);
    // });

  
    // function onUpdateVersion(data){
    //     data = JSON.parse(unescape(data));

    //     $("#VersionControlID").val(data.VersionControlID); 
    //     $("#ProductName").val(data.ProductID);
    //     $("#AndroidVersion").val(data.AndroidVersionCode);
    //     $("#IosVersion").val(data.iOSVersionCode);
    //     $("#Title").val(data.Title); 
    //     $("#Description").val(data.Description);
    //     $("#forceUpdate").val(data.isForced);
    //     $("#modal-lg").modal("show");                                                                      
    // }

    $("#productsIDs").change(function (){
        getProductVersionBasedonProductID($("#productsIDs").val()); 
      });

      //update the version 
      $("#UpdateProductVersionbtn").click(function(){

        let obj = {};
        obj.Module = "Products";
        obj.Page_key = "updateProductVersion";
        let json = {}; 
        json.ProductID = $("#productsIDs").val();
        json.AndroidVersion = $("#AndroidVersion").val(); 
        json.IosVersion = $("#IosVersion").val();
        json.Title = $("#Title").val(); 
        json.Description = $("#Description").val();

        if ($('#forceUpdate').is(":checked")) {
           json.ForceUpdate = 1; 
        }
        else{
            json.ForceUpdate = 0; 
        }
        obj.JSON = json; 
        
        TransportCall(obj);
       // alert(JSON.stringify(obj));
      });
</script>