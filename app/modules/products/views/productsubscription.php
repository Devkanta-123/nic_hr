    <!-- summernote -->
    <link rel="stylesheet" href="assets/admin/plugins/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.css">

    <link rel="stylesheet" href="assets/admin/plugins/bootstrap-toggle-master/css/bootstrap-toggle.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="maincontent">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 mt-3">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    Products Subscription
                                </div>

                                <span class="float-right">
                                    <button class="btn btn-success" data-toggle="modal" data-target="#modal-lg"> <i class="fa fa-circle-thin"> <i class="fa fa-plus"></i> </i>Subscribe Product(s)</button>
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
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                            <label for="productName">Product Name</label>
                                                                <select class="form-control" name="" id="productName">
                                                                </select>
                                                            </div>
                                                        </div> 
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="productModule">Product Module</label>
                                                                <!-- <select class="form-control " name="productModule[]" id="productModule">
                                                                </select> -->
                                                                <select class="form-control js-example-basic-multiple" name="productModule[]" id="productModule"   multiple="multiple">
                                                                </select>
                                                            </div>
                                                        </div> 
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="min_user">MIn User</label>
                                                                <input type="text" maxlength="3" id="min_user" class="form-control" placeholder="Min user"  autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="max_user">Max User</label>
                                                                <input type="text" maxlength="3" id="max_user" class="form-control" placeholder="Max user"  autocomplete="off">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="SubscriptionName">Subscription Name</label>
                                                                <input type="text" id="SubscriptionName" class="form-control" placeholder="Subscription Name"  autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="amount">Amount</label>
                                                                <input type="text" id="amount" class="form-control" placeholder="Amount" maxlength="6"  autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="validity">Validity</label>
                                                                <input type="date" id="validity" class="form-control" placeholder="Validity"  autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <!-- <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="isactive">Is Active</label>
                                                                <select class="form-control" name="" id="isactive"> 
                                                                    <option value="1">Yes</option>
                                                                    <option value="0">No</option>
                                                                </select>
                                                            </div>
                                                        </div> -->  
                                                    </div>
                                                    <div class="row">

                                                            <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="description">Description</label>
                                                                <textarea name="" id="description" class="form-control" autocomplete="off" col=4></textarea>
                                                            
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
                                        <th scope="col">Subscription Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Min user</th>
                                        <th scope="col">Max User</th>
                                        <th scope="col">Product Module</th>
                                        <th scope="col">Ispaid user</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Validity</th>
                                        <th scope="col">Active</th>
                                        <!-- <th scope="col">Created On</th> -->
                                        <th>Action</th>

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
    <script  type="text/javascript">

    $("#btnSave").click(function() 
            {
                function check_for_number(num)
                    {
                        if (isNaN(num))
                        {
                            alert("Error!! Please Enter a number");
                            Exit()  
                        }   
                    }

                var minUser=document.getElementById('min_user').value;
                var maxUser=document.getElementById('max_user').value; //done
                var amt=document.getElementById('amount').value;
                
                check_for_number(minUser); 
                check_for_number(maxUser);
                check_for_number(amt);         
                
            });

    </script>
    <script>
        $(function() {
            getProducts_subscription(); 
            getProducts();
            getProductModule()
        });


        $('#productName').change(function(){
            //alert($('#productName').val());
        });

    

        function getProductModule(){
            var obj=new Object();
            obj.Module = "Products";
            obj.Page_key = "getProductModule";
            var json = new Object();
            obj.JSON = json;
            TransportCall(obj);
        }

        function getProducts_subscription() {
            var obj = new Object();
            obj.Module = "Products";
            obj.Page_key = "getProducts_subscription";
            var json = new Object();        
            obj.JSON = json;
            TransportCall(obj);
        }

        function getProducts(){
            var obj=new Object();
            obj.Module = "Products";
            obj.Page_key = "getProducts";
            var json = new Object();
            obj.JSON = json;
            TransportCall(obj);
        }
                                                                                    
        function clearform() {
        $('#productName').val('');
        $('#productModule').val('');
        $('#min_user').val('');
        $('#max_user').val('');
        $('#amount').val('');
        $('#validity').val('');
        $('#description').val('');
        }

        function onSuccess(rc) {
            if (rc.return_code) {
                switch (rc.Page_key) {
                
                    case "addProductSubscription":
                        $("#modal-lg").modal("hide");
                        getProducts_subscription();
                        clearform();

                        break;
                    case "getProducts_subscription":
                        loaddata(rc.return_data);
                        break;
                    case "getProducts":

                        loadSelect("#productName", rc.return_data); 
                        break; 

                    case "getProductModule":
                        loadSelect("#productModule", rc.return_data); 
                        break; 

                    default:
                        notify("error",rc.Page_key);
                        
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
                    
                    // text += '<td> ' + (i+1) + '</td>';
                    text += '<th> ' + data[i].Name + '</th>';
                    text += '<td> ' + data[i].SubscriptionName + '</td>';
                    text += '<td> ' + data[i].Description + '</td>';
                    text += '<td> ' + data[i].MinUsers + '</td>';
                    text += '<td> ' + data[i].MaxUsers + '</td>';
                    text += '<td> ' + data[i].Modulename + '</td>';
                    if(data[i].isPayPerUser==1)
                    {
                        text +='<td> <span class="badge badge-success"> Paid</span></td>';
                    }
                    else{
                        text +='<td> <span class="badge badge-danger"> Not Paid</span></td>';
                    }
                    text += '<td> ' + data[i].Amount + '</td>';
                    text += '<td> ' + data[i].ValidityDate + '</td>';
                    if(data[i].isActive==1)
                    {
                        text += '<td> <span class=" badge badge-success"> Active </span></td>';    
                    }
                    else
                    {
                        text += '<td> <span class=" badge badge-danger"> Not Active </span> </td>';  
                    }
                        
                    // text += '<td> ' + new Date(data[i].CreatedDateTime).toLocaleDateString() + '</td>';
                    text += '<td class="btn-group btn-group-sm">';
                    // text += '   <a class="btn btn-primary btn-sm" href="#"> <i class="fas fa-folder"> </i> View </a>';
                    text += '   <a class="btn btn-info btn-sm text-white" onclick="onEdit(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fas fa-pencil-alt"> </i> </a>';
                    text += '   <a class="btn btn-danger btn-sm text-white" onclick="onDelete(' + data[i].ProductSubscriptionID + ')"> <i class="fas fa-trash"> </i> </a>';
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
            arrayproductModuless=$("#productModule").val();
            strProductModule=arrayproductModuless.toString();

            let obj = {};
            obj.Module = "Products";
            obj.Page_key = "addProductSubscription";
            let json = {};

        
            json.Productname = $("#productName").val();
            //json.module = $("#productModule").val();  //we got array
            json.module = strProductModule;
            
            json.min_user = $("#min_user").val();
            json.maxUser = $("#max_user").val();
            json.SubscriptionName = $("#SubscriptionName").val();
            json.amount = $("#amount").val();
            json.validity = $("#validity").val();
            json.isActive = $("#isactive").val();
            json.Description = $("#description").val(); 
            if(code !=null){
                json.ProductSubscriptionID = code;
            } 

            obj.JSON = json; 
        // alert(JSON.stringify(obj));
            TransportCall(obj);
        }); 

        var code=null;
        function onEdit(data){
            //alert(JSON.stringify(data));
            data = JSON.parse(unescape(data));

            //$("#Subjects").select2();

            $("#productName").val(data.ProductID).trigger("change");

            // $("#productName").val(data.Name);  //product Name(working)
            //$("#productName").val(data.Name);
            //$("#productModule").val(); //product module(working)

            alert(data.Modulename);

            $("#min_user").val(data.MinUsers);
            $("#max_user").val(data.MaxUsers); 
            $("#SubscriptionName").val(data.SubscriptionName); 
            $("#amount").val(data.Amount); 
            $("#validity").val(data.ValidityDate); 
            $("#isactive").val(data.isActive); 
            $("#description").val(data.Description); 

            mode = 2;
            code = data.ProductSubscriptionID;
            $("#modal-lg").modal("show");                                                                         
        }

        function onDelete(ProductSubscriptionID)
        {
            alert(ProductSubscriptionID);
            if (confirm("Are you sure you want to delete")) 
            {
                let obj = {};
                obj.Module = "Products";
                let json = {};
                obj.Page_key = "deleteProductSubscription";
                json.ProductSubscriptionID = ProductSubscriptionID;
                obj.JSON = json;
                TransportCall(obj);
            }
        }

        //to load Product_module
    // function loadSubject(data) {
    //     var text = "";
    //     if (data.length == 0) {
    //         text += "<option disabled>No Data</option>";
    //     } else {
    //         text += "<option value=-1> Select </option>";
    //         for (let i = 0; i < data.length; i++) {
    //             text += '<option value="' + data[i].AcademicSubjectID + '" >' + data[i].SubjectName + '</option>';
    //         }
    //     }
    //     $("#Subjects").html(text);
    //     $("#AllSubjects").html(text);
    // }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });

    </script>
