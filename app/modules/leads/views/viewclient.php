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
                                Available Clients
                            </div>

                            <span class="float-right">
                                <button class="btn btn-success" data-toggle="modal" data-target="#modal-lg"> <i class="fa fa-circle-thin"> <i class="fa fa-plus"></i> </i>Add Client(s)</button>
                            </span>

                            <div class="modal fade" id="modal-lg">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                     <form method="post" >
                                        <div class="modal-header">
                                            <h4 class="modal-title"> Add Clients</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body text-center">

                                                <div class="row">
                                                   
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="client_name">Client Name</label>
                                                            <input type="text" id="client_name" class="form-control" maxlength="30" placeholder="Client Name" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="telephone_number">Telephone Number</label>
                                                            <input type="text" id="telephone_number" class="form-control" onkeypress="javascript:return isNum(event)" maxlength="10" placeholder="Telephone Number" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="mobile_no">Mobile Number</label>
                                                            <input type="text" id="mobile_no" class="form-control" onkeypress="javascript:return isNum(event)" maxlength="10" placeholder="Mobile Number"  autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">                                  
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
                                          
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="fax">Fax</label>
                                                            <input type="text" id="fax" class="form-control" placeholder="Fax" maxlength="15" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="contact_name">Contact Name</label>
                                                            <input type="text" id="contact_name" class="form-control" maxlength="30" placeholder="Contact Name"  autocomplete="off">
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="contact_number">Contact Number </label>
                                                            <input type="text" id="contact_number" class="form-control" onkeypress="javascript:return isNum(event)" placeholder="Mobile Number" maxlength="10" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="person_designation">Person Designation</label>
                                                            <input type="text" id="person_designation" class="form-control" maxlength="20" placeholder="Person Designation" autocomplete="off">
                                                        </div>
                                                    </div>            
                                                </div>
                                                                                      
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="state">State</label>
                                                            <select class="form-control" name="" id="state"> 
                                                            </select>
                                                         </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="district">District</label>
                                                            <select class="form-control" name="" id="district">
                                                            </select>
                                                            <!-- <input type="text" id="district" class="form-control" placeholder="District" autocomplete="off"> -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="city_name">City Name</label>
                                                            <input type="text" id="city_name" class="form-control" maxlength="15" placeholder="City" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="pincode">Pincode</label>
                                                            <input type="text" id="pincode" class="form-control" onkeypress="javascript:return isNum(event)" maxlength="6" placeholder="Pincode" autocomplete="off">
                                                        </div>
                                                    </div>

                                                </div>
                                                  
                                                <div class="row">
                                                   
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="landmark">Landmark </label>
                                                            <input type="text" id="landmark" class="form-control" placeholder="Landmark" autocomplete="off">
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="maxuser">Max User </label>
                                                            <input type="text" id="maxuser" class="form-control" placeholder="Max User" maxlength="3" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
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
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="table" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">Client Name</th>
                                    <th scope="col">Telephone Number</th>
                                    <th scope="col">Mobile Number</th>
                                    <th scope="col">Fax</th>
                                    <th scope="col">Person Name</th>
                                    <th scope="col">Person Mobile-No </th>
                                    <th scope="col">Person Designation</th>
                                    <th scope="col">State</th>
                                    <th scope="col">City</th>
                                    <th scope="col">Districts</th>
                                    <th scope="col">Pincode</th>
                                    <th scope="col">Landmark</th>
                                    <th scope="col">Max User</th>
                                    <th scope="col">Logo</th>
                                    <th scope="col">Actions</th>
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
<script>
    function isNum(evt){
                var charCode=(evt.which)?evt.which:event.keyCode
                if(charCode>31 && (charCode<48 || charCode>57)){
                    return false;
                }
                else{
                    return true;
                }
            }
</script>

<!-- Summernote -->
<script src="assets/admin/plugins/summernote/summernote-bs4.min.js"></script>

<script src="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.js"></script>
<script src="assets/admin/plugins/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>

<script>
      $(function() {
        getClients();
        getState();
        getAllDistrict();
    });

    function clearform() {
       $('#client_name').val('');
       $('#telephone_number').val('');
       $('#mobile_no').val('');
       $('#fax').val('');
       $('#contact_name').val('');
       $('#contact_number').val('');
       $('#person_designation').val('');
       $('#state').val('');
       $('#district').val('');
       $('#city_name').val('');
       $('#pincode').val('');
       $('#landmark').val('');
       $('#maxuser').val(''); 
       $('#logo').val('');
       code=null;       
    }

    // $('#state').change(function(){
    //     getDistrict($('#state').val());
    // });

    //get district based on state ID
    // function getDistrict(stateid){
    //     var obj=new Object();
    //     obj.Module = "Settings";
    //     obj.Page_key = "getDistrict";
    //     var json = new Object();
    //     json.StateID=stateid;
    //     obj.JSON = json;
    //     TransportCall(obj);
    // }

    //get all the district
   function  getAllDistrict()
    {
        var obj=new Object();
        obj.Module = "Settings";
        obj.Page_key = "getAllDistrict";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }


    function getState(){
        var obj=new Object();
        obj.Module = "Settings";
        obj.Page_key = "getState";
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
       // alert(JSON.stringify(args));
    }


    
    let Districts;
    function onSuccess(rc) {
    if (rc.return_code) {
        switch (rc.Page_key) {
            case "getClients":
                loaddata(rc.return_data);
                break;

            case "getState":
                loadSelect("#state", rc.return_data); 
                 break; 
            
            // case "getDistrict":
            //     //Districts = rc.return_data;
            //     loadSelect("#district", rc.return_data); 
            //      break; 

           case "getAllDistrict":
           // alert(JSON.stringify(rc.return_data));
                Districts = rc.return_data;
                loadSelect("#district", rc.return_data); 
                break; 

            case "addClient":
                $("#modal-lg").modal("hide");
                //alert(rc.return_data);
                //debugger;
                getClients(); 
                clearform();
                code=null;
                break;

            case "deleteClient":
                notify("success", rc.return_data); 
                getClients(); 
                //getBoard(); 
                //alert(rc.return_data); 
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
                text += '<td> ' + data[i].ClientName + '</td>';
                text += '<td> ' + data[i].TelephoneNo + '</td>';
                text += '<td> ' + data[i].MobileNo + '</td>';
                text += '<td> ' + data[i].Fax + '</td>';
                text += '<td> ' + data[i].ContactPersonName + '</td>';
                text += '<td> ' + data[i].ContactPersonMobileNo + '</td>';
                text += '<td> ' + data[i].ContactPersonDesignation + '</td>';
                text += '<td> ' + data[i].StateName + '</td>';
                text += '<td> ' + data[i].CityName + '</td>';
                text += '<td> ' + data[i].DistrictName + '</td>';
                text += '<td> ' + data[i].PinCode + '</td>';
                text += '<td> ' + data[i].Landmark + '</td>';
                text += '<td> ' + data[i].MaxUsers + '</td>';
                text += '<td> ' + data[i].Logo + '</td>';
                
                text += '<td class="btn-group btn-group-sm">';
                text += '   <a class="btn btn-info btn-sm text-white" onclick="onEdit(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fas fa-pencil-alt"> </i> </a>';
                text += '   <a class="btn btn-danger btn-sm text-white" onclick="onDelete(' + data[i].ClientID + ')"> <i class="fas fa-trash"> </i> </a>';
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

    $("#btnAddClient").click(function (){
        let obj = {};
        obj.Module = "Client";
        obj.Page_key = "addClient";
        let json = {};

        json.ClientName = $("#client_name").val();
        json.telephoneName = $("#telephone_number").val(); 
        json.MobileNo = $("#mobile_no").val();
        json.Fax = $("#fax").val();
        json.ContactName = $("#contact_name").val();
        json.ContactNumber = $("#contact_number").val(); 
        json.PersonDesignation = $("#person_designation").val();
        json.State = $("#state").val();
        json.District = $("#district").val();
        json.City = $("#city_name").val();
        json.Pincode = $("#pincode").val(); 
        json.Landmark = $("#landmark").val();
        json.Maxuser = $("#maxuser").val();
        json.Logo = $("#logo").val();

        if(code !=null){
            json.ClientID = code;
        }
        obj.JSON = json; 
        //console.log(JSON.stringify(obj));
        TransportCall(obj);    
    });

    var code=null;
    function onEdit(data){
        //alert(JSON.stringify(data));
        //debugger;
        data = JSON.parse(unescape(data));
        $("#client_name").val(data.ClientName);
        $("#telephone_number").val(data.TelephoneNo);
        $("#mobile_no").val(data.MobileNo);
        $("#fax").val(data.Fax);
        $("#contact_name").val(data.ContactPersonName);
        $("#contact_number").val(data.ContactPersonMobileNo);
        $("#person_designation").val(data.ContactPersonDesignation);
        $("#city_name").val(data.CityName);
        $("#pincode").val(data.PinCode);
        $("#landmark").val(data.Landmark);
        $("#maxuser").val(data.MaxUsers); 
        //$("#maxuser").val(data.StateID); 
        $("#logo").val(data.Logo); 
        // $("#state").val(data.MaxUsers);
       // $("#state").val(data.StateID).trigger('change');
       
        $("#state").val(data.StateID).change();

        //$("#district").val(data.DistrictName);
        $("#district").val(data.DistrictID).change();
        
        mode = 2;
        code = data.ClientID;

        $("#modal-lg").modal("show");
       
    }

    $("#state").change(function() {
        $("#district").html("");
        for (let i = 0; i < Districts.length; i++) {
            if ($("#state option:selected").val() === Districts[i].StateID) {
                $("#district").append('<option value="' + Districts[i].DistrictID + '">' + Districts[i].DistrictName + '</option>');
            }
        }
    });

    function onDelete(ClientID)
    {
        //alert(ClientID);
        if (confirm("Are you sure you want to delete")) 
        {
            let obj = {};
            obj.Module = "Client";
            let json = {};
            obj.Page_key = "deleteClient";
            json.ClientID = ClientID;
            obj.JSON = json;
            TransportCall(obj);
        }
    }
</script>


