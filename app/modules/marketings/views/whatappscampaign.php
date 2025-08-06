<!-- summernote -->
<link rel="stylesheet" href="assets/admin/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.css">
<link rel="stylesheet" href="assets/admin/plugins/bootstrap-toggle-master/css/bootstrap-toggle.min.css">
<style>
    .ui-datepicker {
        width: 210px;
        height: auto;
        margin: 5px auto 0;
        font: 9pt Arial, sans-serif;
        -webkit-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, .5);
        -moz-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, .5);
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, .5);
    }

    .ui-datepicker table {
        width: 100%;
        background: #FFFBF5;
    }

    .ui-datepicker a {
        text-decoration: none;
    }

    .ui-datepicker-header {
        background: #FFFBF5;
        color: #0F0F0F;
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

    #logo {
        width: 80px;
        height: 60px;
        border-radius: 10px;
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
                                Marketing WhatsApp Campaign
                            </div>

                            <span class="float-right">
                                <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-lg"> <i class="fa fa-circle-thin"> <i class="fa fa-plus"></i> </i> Add Campaign</button>
                            </span>
                        </div>

                        <div class="card-body">
                            <table id="table" class="table table-border">
                                <thead>
                                    <tr>
                                        <th scope="col">Sl No</th>
                                        <th scope="col">Campaign Name</th>
                                        <th scope="col">Campaign Message</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">View Contact</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>



            <!-- ########################################################################### form to subscribe ################################################## -->

            <div class="modal fade" id="modal-lg">
                <div class="modal-dialog modal-xl">
                    <form id="clearFrom">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Marketing WhatsApp Campaign</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="ClientId">Campaign Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="" id="campaign_name">

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="productID">Campaign Message <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="" id="campaign_message">

                                                <!-- <input type="text" id="productID" class="form-control" placeholder="start Date"  autocomplete="off">   -->
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="endDate">Contact No's <span class="text-success" id="openContactModal" style="cursor:pointer;">+</span></label>
                                                <!-- <input type="text" id="ContactNos" class="form-control" autocomplete="off"> -->
                                                <div id="showFileInput">
                                                    <input type="file" id="csvFileInput" class="form-control" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" autocomplete="off">
                                                    <div id="preview"></div>
                                                    <table id="ContactTable" class="table table-bordered table-striped" style="display:none;">
                                                        <thead>

                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary btn-xs" id="btnSave">Save </button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                </div>
                </form>
                <!-- /.modal-dialog -->
            </div>


            <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="contactModalLabel">Add Contact</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Your form fields for adding contact numbers go here -->
                            <input type="number" maxlength="10" id="contactNumber" class="form-control" placeholder="Enter contact number">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Close</button>
                            <button type="button" id="saveContact" class="btn btn-primary btn-xs">Save </button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="Loadcontact" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xs" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="PrintCampaignName">Contact</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="loadContactTable"class="table table-bordered table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th scope="col">Contact No</th>
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

<!-- Summernote -->

<script src="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.js"></script>
<script src="assets/admin/plugins/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>

<script>
    $(function() {
        getAllWhatsappCampaign();
    });

    $('#openContactModal').click(function() {
        $('#contactModal').modal('show');
    });
    var ContactData;
    document.getElementById('csvFileInput').addEventListener('change', importFile);
    ContactData = [];

    function importFile(evt) {
        var f = evt.target.files[0];
        if (f) {
            var r = new FileReader();
            r.onload = e => {
                ContactData = csvJSON(e.target.result);
                // console.log(ContactData);
                $("#ContactTable").show();
                loadToContactTable(ContactData);
            }
            r.readAsBinaryString(f);
        } else {
            console.log("Failed to load file");
        }
    }

    $("#saveContact").click(function() {
        var contactNumber = $("#contactNumber").val();
        var contactNumber = $("#contactNumber").val().trim();
        if (contactNumber.length === 10 && /^\d+$/.test(contactNumber)) {
            // Add new contact to ContactData array
            ContactData.push({
                Contact: contactNumber
            });
            // Reload table
            $("#ContactTable").show();
            loadToContactTable(ContactData);
            $('#contactModal').modal('hide');
            // Clear input field
            $("#contactNumber").val('');
        } else {
            notify("error", "Please enter a valid 10-digit contact number.");
        }
    });

    function loadToContactTable(data) {
        var text = '';
        for (var i = 0; i < data.length; i++) {
            text += '<tr> ';
            text += '<td> ' + data[i].Contact + '</td>';
            text += '<td><button class="btn-danger btn-xs remove-btn" data-index="' + i + '">X</button></td>';
            text += '</tr >';
        }
        $("#ContactTable tbody").html(text);

        // Add event listener for remove buttons
        $(".remove-btn").click(function() {
            var index = $(this).data("index");
            removeRow(index);
        });
    }

    function removeRow(index) {
        // Remove row from ContactData array
        ContactData.splice(index, 1);

        // Reload table
        loadToContactTable(ContactData);
    }



    // });
    $("#btnSave").click(function() { //Add Forms Details to BackEnds

        let obj = {};
        obj.Module = "Marketings";
        obj.Page_key = "addWhatsappCampaign";
        obj.JSON = { // campaign_name  ,campaign_message , 
            CampaignName: $("#campaign_name").val(),
            CampaignMessage: $("#campaign_message").val(),
            ContactsData: ContactData
        };

        if ($("#campaign_name").val() == '' || $("#campaign_message").val() == '') {
            notify("error", "Please  fill the required fields");
        } else {
            console.log(JSON.stringify(obj));
            TransportCall(obj);
        }
    });

    function clearform() {
        $('#clearFrom').find('input[type=text], input[type=email], input[type=file], textarea').val('');
    }


    function onSuccess(rc) {

        if (rc.return_code) {
            switch (rc.Page_key) {
                case "addWhatsappCampaign":
                    notify("success", rc.return_data);
                    getAllWhatsappCampaign();
                    clearform();
                    $("#modal-lg").modal("hide");
                    $("#ContactTable tbody").html("");
                    ContactData = [];
                    break;

                case "changeactivestatus":
                    notify("success", rc.return_data);
                    getAllWhatsappCampaign();
                    break;

                case "getAllWhatsappCampaign":
                    loaddata(rc.return_data);
                    break;

                case "getAllContactsByCampaignID":
                    loadContact(rc.return_data);
                    break;




                default:
                    notify("error", rc.Page_key);

            }
        } else {
            notify("error", rc.return_data);
        }

    }




    function loaddata(data) {

        console.log(data);
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
                text += '<th> ' + (i + 1) + '</th>';
                text += '<td> ' + data[i].CampaignName + '</td>';
                text += '<td> ' + data[i].CampaignMessage + '</td>';
                text += '<td>';
                if (data[i].isActive == 1) {
                    status = "on";
                    statustext = "checked";
                    text += '<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success"> <input type="checkbox" ' + statustext + '  class="custom-control-input" id="activestatusPositive' + i + '" onclick="changeactivestatus(this.id,' + data[i].CampaignID + ')" value="' + status + '">  <label class="custom-control-label" for="activestatusPositive' + i + '"></label> </div>';
                } else if (data[i].isActive == 0 || data[i].isActive == null) {
                    status = "off";
                    statustext = "";
                    text += '<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success"> <input type="checkbox"   class="custom-control-input" id="activestatusPositive' + i + '" onclick="changeactivestatus(this.id,' + data[i].CampaignID + ')" value="' + status + '">  <label class="custom-control-label" for="activestatusPositive' + i + '"></label> </div>';
                }
                text += '<td class="btn-group btn-group-sm">';
                text += '<a class="btn btn-info btn-sm text-white" onclick="ViewContacts(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fas fa-eye"> </i> </a>';
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


    var CampaignID, CampaignName;

    function ViewContacts(data) {
        debugger;
        data = JSON.parse(unescape(data));
        CampaignID = data.CampaignID;
        CampaignName = data.CampaignName;
        var obj = new Object();
        obj.Module = "Marketings";
        obj.Page_key = "getAllContactsByCampaignID";
        var json = new Object();
        obj.JSON = json;
        obj.JSON.CampaignID = CampaignID;
        SilentTransportCall(obj);

        // alert(CampaignName);
    }

    function loadContact(data) {
        // Show the modal
        $("#PrintCampaignName").text(CampaignName);
        $("#Loadcontact").modal('show');
        var table = $("#loadContactTable");

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
                text += '<td> ' + data[i].ContactNo + '</td>';
                text += '</tr >';
            }
        }

        $("#loadContactTable tbody").html("");
        $("#loadContactTable tbody").append(text);

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





    function getAllWhatsappCampaign() {
        debugger
        var obj = new Object();
        obj.Module = "Marketings";
        obj.Page_key = "getAllWhatsappCampaign";
        var json = new Object();
        obj.JSON = json;
        SilentTransportCall(obj);
    }

    function changeactivestatus(id, CampaignID) {
        debugger;
        var status = "";
        if ($("#" + id).is(':checked')) {
            status = "1";
        } else {
            status = "0";
        }
        var obj = new Object();
        obj.Module = "Marketings";
        obj.Page_key = "changeactivestatus";
        var json = new Object();
        obj.JSON = json;
        json.CampaignID = CampaignID;
        json.isActive = status;
        SilentTransportCall(obj);
    }
</script>