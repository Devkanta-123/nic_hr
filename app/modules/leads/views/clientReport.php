<!-- summernote -->
<link rel="stylesheet" href="assets/admin/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.css">

<link rel="stylesheet" href="assets/admin/plugins/bootstrap-toggle-master/css/bootstrap-toggle.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="maincontent">
<section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Expired clients column-->
                <div class="col-4 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Expired Clients Subscription
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="table1" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Client Description </th>
                                        <th scope="col">Mobile Number</th>
                                        <th scope="col">Expired on</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="text-primary">View All</a>
                            
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

                <!-- Active clients -->
                <div class="col-5 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Active Clients
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="table2" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Client Name</th>
                                        <th scope="col">Subscribe Product</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Next Due Date</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <a href="" class="text-primary">View All</a>
                            
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

                <div class="col-3 mt-3">
                    <div class="card">
                      
                        <!-- /.card-header -->
                        <div class="card-body">
                           
                            <table id="table" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td> 
                                            <span class="float-left">
                                                <button class="btn btn-success" data-toggle="modal" data-target="#modal-lg"> <i class="fa fa-circle-thin"> </i>Unsubscribe Clients</button>
                                            </span>
                                        </td>
                                    </tr>                              
                                        <td> 
                                            <span class="float-left">
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#mostSubscribe"> <i class="fa fa-circle-thin"> </i>Most Subscribe Products</button>
                                            </span>
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td> 
                                            <span class="float-left">
                                                <button class="btn btn-danger" data-toggle="modal" data-target="#mostSubscribeClient"> <i class="fa fa-circle-thin"> </i>Most Subscribe clients</button>
                                            </span>
                                        </td>
                                        <!-- <td> <a href="#" class="text-success">Most Subscribe clients</a></td> -->
                                    </tr>
                                </thead>
                            </table>

                              <!-- ################################# MOST SUBSCRIBE CLIENT FIRST ########################## -->
                              <div class="modal fade" id="mostSubscribeClient">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form method="post">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Most subscribe Client</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" style=" overflow-x: auto;">
                                                <div class="card-body">
                                                    <table id="mostSubscribeClienttable" class="table table-bordered table-striped">
                                                        <thead>                                    
                                                            <tr>
                                                                <th scope="col">ClientName</th>   
                                                                <th scope="col">MobileNo</th>
                                                                <th scope="col">StateName</th>
                                                                <th scope="col">DistrictName</th>
                                                                <th scope="col">Number of Subscribe</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="modal-footer ">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" id="btnAddClient">Save </button>                                          
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- ################################# MOST SUBSCRIBE PRODUCT FIRST ########################## -->
                            <div class="modal fade" id="mostSubscribe">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form method="post">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Most subscribe Product</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" style=" overflow-x: auto;">
                                                <div class="card-body">
                                                    <table id="mostSubscribetable" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Product Name</th>   
                                                                <th scope="col">Product Code</th>
                                                                <th scope="col">Is Active</th>
                                                                <th scope="col">Website</th>
                                                                <th scope="col">No of Subscribe</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="modal-footer ">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" id="btnAddClient">Save </button>                                          
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>

                                         <!-- ##########################    UNSUBSCRIBE CLIENTS $$$$$$$$$$$$$$$$$$$-->

                            <div class="modal fade" id="modal-lg">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form method="post">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Unsubscribe Client Details</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" style=" overflow-x: auto;">
                                                <div class="card-body">
                                                    <table id="UnsubscribeClienttable" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Client Name</th>
                                                                <th scope="col">Product Name</th>
                                                                <th scope="col">Product Subscription</th>
                                                                <th scope="col">Max User</th>
                                                                <th scope="col">Remarks</th>
                                                                <th scope="col">Installment</th>
                                                                <th scope="col">Amount</th>
                                                                <th scope="col">Next due amount</th>
                                                                <th scope="col">Due date</th>
                                                                <th scope="col">Reason for unsubscribe</th>
                                                                <th scope="col">Ended dates</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="modal-footer ">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" id="btnAddClient">Save </button>                                          
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div><!--End row-->

            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Clients Subscription about to Expired 
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="aboutToExpiredsubscription" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Client Name</th>
                                        <th scope="col">Product Subscribe</th>
                                        <th scope="col"> Product Subscription</th>
                                        <th>End date</th>
                                        <th>Amount</th>
                                        <th>Installment</th>
                                        <th>days left</th>
                                        <th>Next Due Date</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="text-primary">View All</a>
                            
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

            </div>
        
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
        getExpiredClients();
        getActiveClients();
        getUnsubscribeClients();
        getMostSubscribeProduct();
        getMostSubscribeClients();
        clientAboutToExpired();
    });
    
    function clientAboutToExpired(){
        var obj=new Object();
        obj.Module = "Client";
        obj.Page_key = "clientAboutToExpired";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    function getMostSubscribeClients(){
        var obj=new Object();
        obj.Module = "Client";
        obj.Page_key = "getMostSubscribeClients";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    function getMostSubscribeProduct(){
        var obj=new Object();
        obj.Module = "Client";
        obj.Page_key = "getMostSubscribeProduct";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    function getMostSubscribeProduct(){
        var obj=new Object();
        obj.Module = "Client";
        obj.Page_key = "getMostSubscribeProduct";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }
    function getUnsubscribeClients(){
        var obj=new Object();
        obj.Module = "Client";
        obj.Page_key = "getUnsubscribeClients";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    function getExpiredClients(){
        var obj=new Object();
        obj.Module = "Client";
        obj.Page_key = "getExpiredClients";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    function getActiveClients(){
        var obj=new Object();
        obj.Module = "Client";
        obj.Page_key = "getActiveClients";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    function onSuccess(rc) {
    if (rc.return_code) {
        switch (rc.Page_key) {
            case "getExpiredClients":
                loaddata(rc.return_data);
                //notify("success", "Sucessfully loaded..");
                break;

            case "getActiveClients":
                loadActiveClientdata(rc.return_data);
                break;

            case "getUnsubscribeClients":
                loadUnsubscribeClient(rc.return_data);
                break;

            case "getMostSubscribeProduct":
                loadMostSubscribeProduct(rc.return_data);
                break;

            case "getMostSubscribeClients":
                loadMostSubscribeClients(rc.return_data);
                break;

            case "clientAboutToExpired":
                loadclientAboutToExpired(rc.return_data);
                break;
   
            default:
                alert(rc.Page_key);
        }
    } else {
        notify("error", rc.return_data);
       
    }
   
    }


    function loadclientAboutToExpired(data) 
    {
        var table = $("#aboutToExpiredsubscription");

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
                text += '<td> ' +data[i].ClientName  + '</td>';
                text += '<td> ' + data[i].Name + '</td>';
                text += '<td> ' + data[i].SubscriptionName + '</td>';
                text += '<td> ' +data[i].Enddate  + '</td>';
                text += '<td> ' + data[i].Amount + '</td>';
                text += '<td> ' + data[i].Installment + '</td>';
                text += '<td> ' + data[i].daysleft + '</td>';
                text += '<td> ' +data[i].NextDueDate  + '</td>';
                text += '</tr >';
            }
        }

        $("#aboutToExpiredsubscription tbody").html("");
        $("#aboutToExpiredsubscription tbody").append(text);

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

    function loadMostSubscribeClients(data) 
    {
        var table = $("#mostSubscribeClienttable");

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
                text += '<td> ' +data[i].ClientName  + '</td>';
                text += '<td> ' + data[i].MobileNo + '</td>';
                text += '<td> ' + data[i].StateName + '</td>';
                text += '<td> ' +data[i].DistrictName  + '</td>';
                text += '<td> ' + data[i].numberofsubscribe + '</td>';
                text += '</tr >';
            }
        }

        $("#mostSubscribeClienttable tbody").html("");
        $("#mostSubscribeClienttable tbody").append(text);

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

    function loadMostSubscribeProduct(data) 
    {
        var table = $("#mostSubscribetable");

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
                text += '<td> ' +data[i].Name  + '</td>';
                text += '<td> ' + data[i].Code + '</td>';
                text += '<td> ' + data[i].isActive + '</td>';
                text += '<td> ' +data[i].Website  + '</td>';
                text += '<td> ' + data[i].numberofsubscribe + '</td>';
                text += '</tr >';
            }
        }

        $("#mostSubscribetable tbody").html("");
        $("#mostSubscribetable tbody").append(text);

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

    function loadUnsubscribeClient(data) 
    {
        var table = $("#UnsubscribeClienttable");

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
                text += '<td> ' +data[i].ClientName  + '</td>';
                text += '<td> ' + data[i].Name + '</td>';
                text += '<td> ' + data[i].SubscriptionName + '</td>';
                text += '<td> ' +data[i].MaxUsers  + '</td>';
                text += '<td> ' + data[i].Remarks + '</td>';
                text += '<td> ' + data[i].Installment + '</td>';
                text += '<td> ' +data[i].Amount  + '</td>';
                text += '<td> ' + data[i].NextDueAmount + '</td>';
                text += '<td> ' + data[i].NextDueDate + '</td>';
                text += '<td> ' + data[i].SubscriptionEndReason + '</td>';
                text += '<td> ' + data[i].SubscriptionEndedDateTime + '</td>';
                text += '</tr >';
            }
        }

        $("#UnsubscribeClienttable tbody").html("");
        $("#UnsubscribeClienttable tbody").append(text);

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
    
    function loaddata(data) 
    {
        var table = $("#table1");

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
                text += '<td> ' +data[i].clientdescription  + '</td>';
                text += '<td> ' + data[i].MobileNo + '</td>';
                text += '<td> ' + data[i].EndDate + '</td>';
                text += '<td class="btn-group btn-group-sm">';
                text += '   <a class="btn btn-primary btn-sm text-white"> Remind </a>';
                text += '</td>';
                text += '</tr >';
            }
        }

        $("#table1 tbody").html("");
        $("#table1 tbody").append(text);

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

    function loadActiveClientdata(data) 
    {
        var table = $("#table2");

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
                text += '<td> ' +data[i].clientName  + '</td>';
                text += '<td> ' + data[i].ProductSubscriptionID + '</td>';
                text += '<td> ' + data[i].MobileNo + '</td>';
                text += '<td> ' + data[i].amount + '</td>';
                text += '<td> ' + data[i].NextDueDate + '</td>';
                text += '</tr >';
            }
        }

        $("#table2 tbody").html("");
        $("#table2 tbody").append(text);

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


