<!-- summernote -->
<link rel="stylesheet" href="assets/admin/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.css">

<link rel="stylesheet" href="assets/admin/plugins/bootstrap-toggle-master/css/bootstrap-toggle.min.css">
<style>
.ui-datepicker {
  width: 216px;
  height: auto;
  margin: 5px auto 0;
  font: 9pt Arial, sans-serif;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, .5);
  -moz-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, .5);
  box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, .5);
}
.ui-datepicker table {
  width: 100%;
  background:black;
}
.ui-datepicker a {
  text-decoration: none;
}

.ui-datepicker-header {
  background: url('../img/dark_leather.png') repeat 0 0 #000;
  color: #e0e0e0;
  font-weight: bold;
  -webkit-box-shadow: inset 0px 1px 1px 0px rgba(250, 250, 250, 2);
  -moz-box-shadow: inset 0px 1px 1px 0px rgba(250, 250, 250, .2);
  box-shadow: inset 0px 1px 1px 0px rgba(250, 250, 250, .2);
  text-shadow: 1px -1px 0px #000;
  filter: dropshadow(color=#000, offx=1, offy=-1);
  line-height: 30px;
  border-width: 1px 0 0 0;
  border-style: solid;
  border-color: #111;
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
                            <div class="card-title">
                                Client Subscription
                            </div>

                            <span class="float-right">
                                <button class="btn btn-success" data-toggle="modal" data-target="#modal-lg"> <i class="fa fa-circle-thin"> <i class="fa fa-plus"></i> </i>Subscription(s)</button>
                            </span>

                             <!-- ########################################################################### form to UNsubscribe ################################################## -->
                            <div class="modal fade" id="modal-unsubscribe">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Unsubscribe </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body text-center">                                                                                   
                                                <div class="row">        
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="unsubscribereason">Why do You want to unsubscribe?</label>
                                                           <textarea name="" id="unsubscribereason" class="form-control"></textarea> 
                                                        </div>
                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="btnUnsubscribe">Save </button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                
                            <!-- ########################################################################### form to subscribe ################################################## -->

                            <div class="modal fade" id="modal-lg">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Client Subscription </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body text-center">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                        <label for="ClientId">Client</label>                                  
                                                            <select class="form-control" name="" id="ClientId">
                                                            </select>
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="productID">Product</label>
                                                            <select class="form-control" name="" id="productID">
                                                            </select> 
                                                            <!-- <input type="text" id="productID" class="form-control" placeholder="start Date"  autocomplete="off">   -->
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="subscriptionId">Product Subscription</label>
                                                            <select class="form-control" name="" id="subscriptionId">
                                                            </select> 
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="startDate">Start Date</label>
                                                            <input type="text" id="startDate" class="form-control" placeholder="start Date"  autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                <input type="text" name="" class="form-control" maxlength="6" style="display:none" id="productamount"> 
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="endDate">End date</label>
                                                            <input type="text" id="endDate" class="form-control" placeholder="End Date"  autocomplete="off">
                                                        </div>
                                                    </div>
                                                      <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="maxUser">Max User</label>
                                                            <input type="text" name="" class="form-control" placeholder="Max User" maxlength="3" id="maxUser">  
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="amount">Amount</label>
                                                            <input type="text" name="" class="form-control" Placeholder="Amount" maxlength="6" id="amount">  
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="remark">Remarks</label>
                                                            <input type="text" id="remark" class="form-control" placeholder="Remarks"  autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">        
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="installment">Installment</label>
                                                            <input type="text" name="" class="form-control" Placeholder="InstallMent"  id="installment">  
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="nextDueDate"> Next Due Date</label>
                                                            <input type="text" name="" class="form-control" placeholder="Next Due date"  id="nextDueDate">  
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="nextDueAmount">Next Due Amount </label>
                                                            <input type="text" name="" class="form-control" placeholder="Next Due Amount"  id="nextDueAmount">  
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="api">API</label>
                                                            <input type="text" id="api" class="form-control" placeholder="API"  autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="terms"> Terms</label>
                                                            <input type="file" id="terms" class="form-control" accept="image/x-png,image/jpeg,image/jpg" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail" style="max-width: 50px; max-height: 50px;">
                                                               
                                                            </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail " style="max-width:50px; max-height: 50px;">
                                                                <img src="assets/img/image_placeholder.jpg" alt="..." style="max-width: 100px; max-height: 100px;">
                                                            </div>
                                                            <div>
                                                                <span class="btn btn-round btn-file mt-3">    
                                                                    <span class="">Add logo</span>
                                                                    <input type="file" id="logo" name="PassportPhoto" accept="image/x-png,image/jpeg,image/jpg" required>
                                                                </span>
                                                               
                                                            </div>
                                                        </div>
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
                                    <th scope="col">Client Name</th>
                                    <th scope="col">Product Name </th>
                                    <th scope="col">Subscription ID</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Max User</th>
                                    <th scope="col">Transaction Id</th>
                                    <th scope="col">Remarks</th>
                                    <th scope="col">InstallMent</th>
                                    <th scope="col">Next Due Date</th>
                                    <th scope="col">Next Due Amount</th>
                                    <th scope="col">API</th>
                                    <th scope="col">Product Logo</th>
                                    <th scope="col">Terms</th>
                                    <th scope="col">Action</th>

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
    $("#startDate").datepicker({
        
    dateFormat: 'yy-mm-dd',
    onSelect: function (selectedDate) {
        if (this.id == 'startDate') {
            //console.log(selectedDate);//2014-12-30
            var arr = selectedDate.split("-");
            var date = new Date(arr[0]+"-"+arr[1]+"-"+arr[2]);
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            var minDate = new Date(y, m, d + 31);
            var nextduedate = new Date(y, m, d + 62);
            //var mdate=;
            //var mdate= minDate;
            
            $("#endDate").datepicker('setDate', minDate);
            $("#nextDueDate").datepicker('setDate', nextduedate);

        }
    }
});
$("#endDate").datepicker({dateFormat: 'yy-mm-dd'});
$("#nextDueDate").datepicker({dateFormat: 'yy-mm-dd'});

//############################## CHANGE AMOUNT(TO BE GET FROM THE PRODUCT SUBSCRIPTION) BASED ON MAXUSER ################################
    $('#maxUser').change(function(){
        var maxuser=($('#maxUser').val());
        var productAmount=($('#productamount').val());
        var totalAmount=maxuser*productAmount;
        $('#amount').val(totalAmount);
        $('#nextDueAmount').val(totalAmount);
    });

    $(function() {
        getClient_subscription(); 
        getClients();
        getProducts(); 
        getActiveProductSubscription();    
    });
    function getClient_subscription()
        {
            var obj = new Object();
            obj.Module = "Client";
            obj.Page_key = "getClient_subscription";
            var json = new Object();        
            obj.JSON = json;
            TransportCall(obj);
        }

    function getClients(){
        var obj=new Object();
        obj.Module = "Client";
        obj.Page_key = "getClients";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
        }

        //get all active
        function getActiveProductSubscription()
        {
            var obj=new Object();
            obj.Module="Products";
            obj.Page_key="getActiveProductSubscription";
            var json=new Object();
            obj.JSON=json;
            TransportCall(obj);
        }
    // function getProductsubscription(productID) {  
    //     var obj = new Object();
    //     obj.Module = "Products";
    //     obj.Page_key = "getProductsubscription";
    //     var json = new Object(); 
    //     json.ProductID=productID;          
    //     obj.JSON = json;
    //     TransportCall(obj);
    // }

    function getProducts() {
        var obj = new Object();
        obj.Module = "Products";
        obj.Page_key = "getProducts";
        var json = new Object();        
        obj.JSON = json;
        TransportCall(obj);
    }                                                                                                                                
    function clearform() {
        $('#ClientId').val('');
        $('#productID').val('');
        $('#subscriptionId').val('');
        $('#startDate').val('');
        $('#endDate').val('');
        $('#amount').val('');
        $('#maxUser').val('');
        $('#remark').val('');
        $('#installment').val('');
        $('#nextDueDate').val('');
        $('#nextDueAmount').val('');
        $('#api').val('');
        $('#unsubscribereason').val('');                                                                                                
    }

    let ProductSubscription;
    function onSuccess(rc) {

        if (rc.return_code) {
            switch (rc.Page_key) {

                case "getActiveProductSubscription":
                    ProductSubscription=rc.return_data;
                    loadSelect("#subscriptionId", rc.return_data); 
                    break;
                    
                case "Unsubscribe":
                    $("#modal-unsubscribe").modal("hide");
                    alert(rc.return_data);
                    getClient_subscription();
                    clearform(); 
                    break;

             
                case "addClientSubscription":
                    $("#modal-lg").modal("hide");
                    getClient_subscription(); 
                    clearform();
                    break;

                case "getClient_subscription":
                    loaddata(rc.return_data);
                    break;
                    
                case "getClients":
                    loadSelect("#ClientId", rc.return_data); 
                    break;

                case "getProducts":

                    loadSelect("#productID", rc.return_data); 
                    break;

                case "deleteClientSubscription":
                    notify("success", rc.return_data); 
                    getClient_subscription(); 
                    break;

                ///case "getProductsubscription":
                    //debugger;
                    //alert(JSON.stringify(rc.return_data));
                    //ProductSubscription=rc.return_data;
                    //loadSelect("#subscriptionId", rc.return_data); 
                    //break;

                default:
                    notify("error", rc.Page_key);
                    //alert(rc.Page_key);
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
                text += '<th> ' + data[i].ClientName + '</th>';
                text += '<td> ' + data[i].Name + '</td>';
                text += '<td> ' + data[i].SubscriptionName + '</td>';
                text += '<td> ' + data[i].StartDate + '</td>';
                text += '<td> ' + data[i].EndDate + '</td>';
                text += '<td> ' + data[i].Amount + '</td>';
                text += '<td> ' + data[i].MaxUsers + '</td>';
                text += '<td> ' + data[i].TransectionID + '</td>';
                text += '<td> ' + data[i].Remarks + '</td>';
                text += '<td> ' + data[i].Installment + '</td>';
                text += '<td> ' + data[i].NextDueDate + '</td>';
                text += '<td> ' + data[i].NextDueAmount + '</td>';
                text += '<td> ' + data[i].API + '</td>';
                text += '<td> ' + data[i].ProductLogoPath + '</td>';
                text += '<td> ' + data[i].TermsPath + '</td>';           
                text += '<td class="btn-group btn-group-sm">';
                text += '    <a class="btn btn-info btn-sm text-white" onclick="onUnsubscribe(\'' + escape(JSON.stringify(data[i])) + '\')"> Unsubscribe </a>';
                text += '   <a class="btn btn-info btn-sm text-white" onclick="onEdit(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fas fa-pencil-alt"> </i> </a>';
                text += '   <a class="btn btn-danger btn-sm text-white" onclick="onDelete(' + data[i].ClientSubscriptionID + ')"> <i class="fas fa-trash"> </i> </a>';
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

    $("#btnUnsubscribe").click(function (){ 
        let obj = {};
        obj.Module = "Client";
        obj.Page_key = "Unsubscribe";
        let json = {};
        json.unsubscribereason = $("#unsubscribereason").val();

        if(code !=null){
            json.ClientSubscriptionID = code;
        }
        obj.JSON = json; 
        //alert(JSON.stringify(obj));
        TransportCall(obj);
        //console.log(JSON.stringify(obj));
    });
    
    $("#btnSave").click(function (){ 
        let obj = {};
        obj.Module = "Client";
        obj.Page_key = "addClientSubscription";
        let json = {};
        json.clientId = $("#ClientId").val();
        json.ProductId = $("#productID").val(); 
        json.SubscriptionId = $("#subscriptionId").val();
        json.StartDate = $("#startDate").val();
        json.Enddate = $("#endDate").val();
        json.Amount = $("#amount").val(); 
        json.MaxUser = $("#maxUser").val();
        json.TransactionId = $("#transactionId").val();
        json.Remarks = $("#remark").val();
        json.Installment = $("#installment").val();
        json.NextDueDate = $("#nextDueDate").val();
        json.nextDueAmount = $("#nextDueAmount").val(); 
        json.aPi = $("#api").val();
        json.Terms = $("#terms").val();
        json.Logo = $("#logo").val();

        if(code !=null){
            json.ClientSubscriptionID = code;
        }

        obj.JSON = json; 
        //alert(JSON.stringify(obj));
        TransportCall(obj);
        //console.log(JSON.stringify(obj));
    });

    var code=null;
    function onEdit(data){
         //alert(JSON.stringify(data));
         data = JSON.parse(unescape(data));
         //ClientID
         $('#ClientId').val(data.ClientID);
         $("#productID").val(data.ProductID).change();
         $("#productamount").val(data.productAmount);
         
         //ProductSubscriptionID
         $("#subscriptionId").val(data.ProductSubscriptionID).change();
        // $("#subscriptionId").val(data.SubscriptionName);
         $("#startDate").val(data.StartDate);
         $("#endDate").val(data.EndDate);
         $("#amount").val(data.Amount);
         $("#maxUser").val(data.MaxUsers);
         $("#remark").val(data.Remarks);
         $("#installment").val(data.Installment);
         $("#nextDueDate").val(data.NextDueDate);
         $("#nextDueAmount").val(data.NextDueAmount);   
         $("#api").val(data.API);
        
        mode = 2;
        code = data.ClientSubscriptionID;

        $("#modal-lg").modal("show");   
    }

    function onDelete(subscriptionId)
    {
        if (confirm("Are you sure you want to delete")) 
        {
            let obj = {};
            obj.Module = "Client";
            let json = {};
            obj.Page_key = "deleteClientSubscription";
            json.subscriptionId = subscriptionId;
            obj.JSON = json;
            TransportCall(obj);
        }
    }
   var code = null; 
    function onUnsubscribe(data)
    { 
        data = JSON.parse(unescape(data));  
        mode = 2;
        code = data.ClientSubscriptionID;
        $("#modal-unsubscribe").modal("show");      
    }

    //$("#").val(data.ProductID).change();
    $("#productID").change(function() {
        $("#subscriptionId").html("");
        for (let i = 0; i < ProductSubscription.length; i++) {
            if ($("#productID option:selected").val() === ProductSubscription[i].ProductID) {
                $("#subscriptionId").append('<option value="' + ProductSubscription[i].ProductSubscriptionID + '">' + ProductSubscription[i].SubscriptionName + '</option>');
            }
        }
    });

</script>