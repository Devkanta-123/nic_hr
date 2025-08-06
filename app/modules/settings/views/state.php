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
                            <div class="card-title">
                               State Data
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <span class="float-right">
                                    <button class="btn btn-success" data-toggle="modal" data-target="#modal-lg"> <i class="fa fa-circle-thin"> <i class="fa fa-plus"></i> </i>New State(s)</button>
                                </span>
                            </div>

                            <div class="modal fade" id="modal-lg">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">State</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body text-center">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="state_name">State Name </label>
                                                            <input type="text" id="state_name" class="form-control" placeholder="State Name" maxlength="50" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="state_id">State Id </label>
                                                                <input type="text" id="state_id" class="form-control" placeholder="State Id" maxlength="2" autocomplete="off">
                                                            </div>
                                                        </div>  -->
                                                </div>                                                                  
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="btnAddState">Save </button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <script  type="text/javascript">
                                $("#btnAddState").click(function()        
                                    {
                                        function check_number(num)
                                        {
                                            if (isNaN(num))
                                            {
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
                                        <th scope="col">State Id</th>
                                        <th scope="col">State Name</th>
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
        getState();
       
    });
    function clearform() {
       $('#state_name').val('');
      
    }

    function getState(){
        var obj=new Object();
        obj.Module = "Settings";
        obj.Page_key = "getState";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

 

    function onSuccess(rc) {

        if (rc.return_code) {
            switch (rc.Page_key) {
                case "getState":
                    //debugger;
                    loaddata(rc.return_data);
                    break;
                    
                case "addState":
                    $("#modal-lg").modal("hide");
                    alert(rc.return_data);
                    getState(); 
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
                
                text += '<th> ' + data[i].StateID + '</th>';
                text += '<td> ' + data[i].StateName + '</td>';
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

    $("#btnAddState").click(function (){ 
        let obj = {};
        obj.Module = "Settings";
        obj.Page_key = "addState";
        let json = {};
        // if(ProductID!==undefined){
        //     json.ProductID = ProductID;
        // }     
        //json.StateID = $("#state_id").val();
        json.StateName = $("#state_name").val(); 
        obj.JSON = json; 
        console.log(JSON.stringify(obj));
        TransportCall(obj);
    });
</script>