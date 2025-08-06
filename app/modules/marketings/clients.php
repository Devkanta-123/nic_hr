<!-- summernote -->
<link rel="stylesheet" href="assets/admin/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.css">

<link rel="stylesheet" href="assets/admin/plugins/bootstrap-toggle-master/css/bootstrap-toggle.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- modal to add marketing -->
                <div class="modal fade" id="AddnewClient">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add New Marketing Clients</h4>
                                <button type="button" class="close btn-danger btn-sm" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body" style=" overflow-x: auto;">
                                <div class="card-body">
                                    <!-- clients detais -->
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <span> <b class="text-danger">*</b>Contact Person and email you can enter multiple and seperated by comas ',' <b class="text-danger">*</b></span>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="Name">Name<b class="text-danger">*</b></label>
                                            <input type="text" class="form-control" id="Name" maxlength="100" placeholder="eg: John Deo">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="phoneNumbers">Contact<b class="text-danger">*</b></label>
                                            <input type="text" class="form-control" id="phoneNumbers" maxlength="55" placeholder=" eg: 9876543210,0987654321">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="EmailIDs">EmailIDs<b class="text-danger">*</b></label>
                                            <input type="text" class="form-control" id="EmailIDs" maxlength="200" placeholder="eg: test@gmail.com,test1@gmail.com">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="LandlineNo">LandlineNo</label>
                                            <input type="text" id="LandlineNo" class="form-control" placeholder="eg: 123456" maxlength="10">
                                        </div>
                                    </div>
                                    <!-- address -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="Address">Address<b class="text-danger">*</b></label>
                                            <input type="text" id="Address" placeholder=" eg: Abc tower" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="CountryID">Country<b class="text-danger">*</b></label>
                                            <select name="" id="CountryID" class="form-control">
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="stateID">State<b class="text-danger">*</b></label>
                                            <select id="stateID" class="form-control">
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="city">City<b class="text-danger">*</b></label>
                                            <select id="city" class="form-control">
                                            </select>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="Landmark">Landmark<b class="text-danger">*</b></label>
                                            <input type="text" id="Landmark" placeholder=" eg: Near Post Office" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="pincode">Pincode<b class="text-danger">*</b></label>
                                            <input type="text" id="pincode" maxlength="7" placeholder="790987" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="enrollment"> Students Enrollment <b class="text-danger">*</b></label>
                                            <input type="text" id="enrollment" maxlength="5" placeholder="1000" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="website">Website</label>
                                            <input type="text" id="website" placeholder="website.ac.in" maxlength="100" class="form-control">
                                        </div>
                                    </div>
                                    <hr>

                                    <!-- contact person -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="ContactpersonName">Contact Person Name<b class="text-danger">*</b></label>
                                            <input type="text" id="ContactpersonName" placeholder="eg: John Doe" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="ContactPersonDesignation">Designation<b class="text-danger">*</b></label>
                                            <input type="text" id="ContactPersonDesignation" placeholder="eg: Teacher" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="ContactPersonNumber">Phone-Number<b class="text-danger">*</b></label>
                                            <input type="text" id="ContactPersonNumber" placeholder="eg: 1231231231" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="InterestedProductIDs">Interested Product<b class="text-danger">*</b></label>
                                            <select name="" id="InterestedProductIDs" class="form-control">
                                            </select>
                                        </div>
                                    </div>

                                    <!-- lat long of the place -->
                                    <div class="row">

                                        <div class="col-md-2">
                                            <label for="lat">Latitude</label>
                                            <input type="text" class="form-control" id="lat" placeholder="eg: 25.740639" maxlength="15">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="long" class="required">Longitude</label>
                                            <input type="text" class="form-control" id="long" placeholder="eg: 89.983667" maxlength="15">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="discussion">Discussion<b class="text-danger">*</b></label>
                                            <textarea id="discussion" class="form-control" maxlength="500" placeholder="Not more than 500 words"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer ">
                                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                                <button type="button" class="btn btn-primary" id="btnAddClient">Save </button>
                            </div>

                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- end modal -->

                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-title">
                                        Marketing Details
                                    </div>
                                    <button class="btn btn-sm btn-primary" id="addNewClientBtn" style="float:right;"> <i class="fa fa-plus" aria-hidden="true"></i> &nbsp; Add New </button>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <!-- to upload multiple data -->
                            <!-- <div class="col-md-12 mb-3">
                                <input type="file" name="" id="fileInput">
                            </div> -->

                            <table id="MarketingData" class="table table-border">
                                <thead>
                                    <tr>
                                        <th scope="col">Name & Contact </th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Contact Person Details</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">MAP</th>
                                        <th scope="col">-</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Summernote -->
<script src="assets/admin/plugins/summernote/summernote-bs4.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>

<script src="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.js"></script>
<script src="assets/admin/plugins/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>

<script>
    $(function() {
        getAllMarketingList();
        getAllState();
        getProducts();
        getNationality();
        getallCity();
    });

    let MarketingClientID;

    $("#addNewClientBtn").click(function() {
        $("#AddnewClient").modal('show');
    });

    // Input validation
    //multiple phone number
    $('#phoneNumbers,#pincode,#ContactPersonNumber,#enrollment,#LandlineNo').keypress(function(e) {
        var charCode = (e.which) ? e.which : event.keyCode
        if (String.fromCharCode(charCode).match(/[^0-9,]/g))
            return false;
    });

    // email
    $('#EmailIDs').keypress(function(e) {
        var charCode = (e.which) ? e.which : event.keyCode
        if (String.fromCharCode(charCode).match(/[^A-Za-z0-9.,@'_\- ]/g))
            return false;
    });

    $('#Address,#Landmark,#Name,#website,#ContactpersonName,#ContactPersonDesignation,#discussion,#lat,#long').keypress(function(e) {
        var charCode = (e.which) ? e.which : event.keyCode
        if (String.fromCharCode(charCode).match(/[^A-Za-z0-9.'_\- ]/g))
            return false;
    });

    $("#btnAddClient").click(function() {
        var obj = new Object();
        obj.Module = "Marketings";
        obj.Page_key = "AddMarketingClients";
        var json = new Object();
        json.ClientID = MarketingClientID;
        json.Name = $("#Name").val();
        json.PhoneNumbers = $("#phoneNumbers").val(); //coma seperated value
        json.EmailIDs = $("#EmailIDs").val(); //coma seperated value
        json.CountryID = $("#CountryID").val();
        json.stateID = $("#stateID").val();
        json.city = $("#city").val();
        json.Address = $("#Address").val();
        json.Landmark = $("#Landmark").val();
        json.pincode = $("#pincode").val();
        json.website = $("#website").val();
        json.ContactpersonName = $("#ContactpersonName").val();
        json.ContactPersonNumber = $("#ContactPersonNumber").val();
        json.ContactPersonDesignation = $("#ContactPersonDesignation").val();
        json.InterestedProductIDs = $("#InterestedProductIDs").val(); // coma separated value
        json.enrollment = $("#enrollment").val();
        json.discussion = $("#discussion").val();
        json.lat = $("#lat").val();
        json.long = $("#long").val();
        json.LandlineNo = $("#LandlineNo").val();
        obj.JSON = json;
        if ($("#Name").val() == '' || $("#phoneNumbers").val() == '' || $("#EmailIDs").val() == '' || $("#CountryID").val() == -1 || $("#stateID").val() == -1 || $("#city").val() == -1 || $("#Address").val() == '' || $("#Landmark").val() == '' || $("#pincode").val() == '' || $("#ContactpersonName").val() == '' || $("#ContactPersonNumber").val() == '' || $("#ContactPersonDesignation").val() == '' || $("#InterestedProductIDs").val() == '' || $("#discussion").val() == '') {
            notify("warning", "Important Fields Cannot be empty");
        } else {
            TransportCall(obj);
        }
    });



    //to delete after done
    $("#fileInput").change(function() {
        const file = document.getElementById('fileInput').files[0];
        excelFileToJSON(file);
    });

    //to delete
    function excelFileToJSON(file) {
        try {
            var reader = new FileReader();
            reader.readAsBinaryString(file);
            reader.onload = function(e) {

                var data = e.target.result;
                var workbook = XLSX.read(data, {
                    type: 'binary'
                });
                var result = {};
                workbook.SheetNames.forEach(function(sheetName) {
                    var roa = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
                    if (roa.length > 0) {
                        result[sheetName] = roa;
                    }
                });

                var obj = new Object();
                obj.Module = "Marketings";
                obj.Page_key = "AddAllMarketingClients";
                var json = new Object();
                json.Clientdata = result;
                obj.JSON = json;
                TransportCall(obj);
            }
        } catch (e) {
            console.log("error");
        }
    }


    function getAllMarketingList() {
        var obj = new Object();
        obj.Module = "Marketings";
        obj.Page_key = "getAllMarketingClients";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    function getAllState() {
        var obj = new Object();
        obj.Module = "Settings";
        obj.Page_key = "getState";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    function getallCity() {
        var obj = new Object();
        obj.Module = "Settings";
        obj.Page_key = "getallCity";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    function getNationality() {
        var obj = new Object();
        obj.Module = "Settings";
        obj.Page_key = "getNationality";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    function getProducts() {
        var obj = new Object();
        obj.Module = "Products";
        obj.Page_key = "getProducts";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }


    function onSuccess(rc) {
        if (rc.return_code) {
            switch (rc.Page_key) {
                case "AddMarketingClients":
                    notify("success", rc.return_data);
                    $("#AddnewClient").modal('hide');
                    getAllMarketingList();
                    break;
                case "getAllMarketingClients":
                    loaddata(rc.return_data);
                    break;
                case "getState":
                    loadSelect("#stateID", rc.return_data);
                    break;
                case "getallCity":
                    loadSelect("#city", rc.return_data);
                    break;
                case "getProducts":
                    loadSelect("#InterestedProductIDs", rc.return_data);
                    break;
                case "getNationality":
                    loadSelect("#CountryID", rc.return_data);
                    break;
                case "UpdateMarketingClient":
                    notify("success", rc.return_data);
                    break;
                default:
                    notify("warning", rc.Page_key);
            }
        } else {
            notify("error", rc.return_data);

        }

    }

    function loaddata(data) {
        var table = $("#MarketingData");
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
                text += '<tr>';
                text += '<td> &nbsp; <b>' + data[i].ClientName + '</b> <br> &nbsp; <b>' + (data[i].MobileNos ? '<i class="fa fa-phone"></i> &nbsp; ' + data[i].MobileNos : '') + ' </b> <br>   <b>' + (data[i].EmailIDs == "-" ? '' : '<i class="fa fa-envelope"></i>  &nbsp; ' + data[i].EmailIDs + '') + '</b> </td> ';
                //address
                text += '<td>';
                text += '<b> ' + data[i].Address + ' </b> <br>';
                text += '<b> ' + data[i].NationalityName + ' </b><br>';
                text += '<b> ' + data[i].StateName + ', ' + data[i].CityName + ',Pin- ' + data[i].Pincode + ' </b><br>';
                text += 'LandMark : <b> ' + data[i].LandMark + ' </b>';
                text += '</td>';
                text += '<td>  <b>' + data[i].ContactPersons + ' (' + data[i].ContactPersonDesignation + ')</b> <br> <i class="fa fa-phone"></i> &nbsp; <b>' + data[i].ContactPersonNumber + ' </b><br> </td>';
                text += '<td> Service : <b>' + data[i].productName + '. </b><br>' + data[i].Description + ' </td>';
                text += '<td><a href="https://www.google.com/maps/search/<?php echo $school['Latitude'] ?>,<?php echo $school['Longitude'] ?>/" target="_blank"> <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFwAAABcCAMAAADUMSJqAAABKVBMVEX///80qFL6uwRChfTqQzUac+j/vAD6tgD6uAA+g/QufPMqpUsfo0UAaecRceg0f/TpOCgVoT9CguqtxfUAbedTjvTE1vvwh4AzqkGn1LB4wIhCg/nvenLqPS7+79LpOTf7wwDg8OT7xUkSp1bN2/l5pPFbkOxxn/CcufPz9/6nwvrm7f0hePPf6P2Rs/dpme65ZY7vNBPSTV/2t7PkRD5Eb9n97u10Z72cYKDyPx+9VXsnlZm33LrXSFVCmLlVbNA+j9LM5tE/iuGnWpHvJwDtyMs4pW384d/0nHU8oYnwcBX/++XznpnsWSn80F5PsWf94af3pRj1mBzyhSPvcSsulKZiuHb80HS+29eKx5f957xfqT36vy+Fqy6csDW/tjDeuSH81YZLqEbZKG0ZAAADcklEQVRoge2YaVfaQBSGk0wghCSEsIkiRqlikVhKtYtdbGmrrbUuXW3Rrv//RzQ7mQXJTeKXHp6v5Dze8847M4kcN2fOnP+A9epGt16pVLqbtxu9LMW9alfTtFrJo6Zpla1+Rur+hqaVchFKOaRbg/UM1L1NrZYjQDZysbud1l2tUWrX7ervpHMP8EBcZBSg11NE39fpsSNuZ/jEyfdz9Ng5HSHM3kjoZkRCuG2sZLPftSh1KUe6ESomKc3y8B49OO1GMoK7d4Ziefc+EYzMkCN9A+p+UBZFsV1+aM1028FAF3XBkYvi8JE1043kOnDwoeix9zhaFFlm/YHWk6ewwdtiYH8WtF3X64NBXS6S/tZ+kwcNXhZD2rvPbXuphqruMd5rdHF960WTV0cA+U5EbgdvL6u2Nfm1EQ1HfqnyvLIEkC+3o3Jx75WG7cM+Cu0y4l0AcpHg9QH+ey88BeRDxXEba7Hdb4a4u/yWfKJR9NzWUdMdXF2MLccjF813x9QjddkroeeGhP4ek5snp/QjVd0voc9ZbPkCvp7SOf3IdtErYUhsOV4WqbDCeKbolTBATSQ3PwgSUy6jMyWl3Py4ypZbrcOIGyCfZG5+WhWEAiPzvnUUCcWuS2x52Bbzs+0WBEZbtr40eYzY8qDn5ongUqB7vo+7la+x5Qd7/uSCL78gn/hm4HMr32PLg6tC8uWCNCaeUHE3rwKui12/hCF41Y95hZADDi63Lk4JJ0R36fiSdIOOXHtF3RJGKFz5+nHnxy1SDbosuLJfQkwvCZ3OlST9pNywa45bOCHVAflftBuUin1dSNPcvxluwFXhclqY4maMDdj7HitTRme5oYNz3AVr9PwlSw5L3IUhz9MltDFAVfEYU8HkGSWEdjyAXFN2CZOE4hCjhMlCccAak2cWhVfjn7UE51H7X5YbcElQTPqYv8wycI9O4boS8irgGGdwXQkTL2aAu6hTSph8MQPsvTSlhMl2D84fiV3CdIsZcMosYdrFDGC6Ddi351TWDNqdfjEDFim7Ev9LYiZL5IuKkk3gHsTrW1aBe4ywYNIcVyywYDINxSH6cQW+7WexGLFn7Y5spbRnIYtw9AwrPsFfUshHRHz8wkBfDOPhdT2LU5yFelPL6eDmYtyMmxtB/1UGwv5CvKlU7FtDMTLf+XPmzLmGf+vpVcp1B8AMAAAAAElFTkSuQmCC" style="width:10px" /></a> </td>';
                text += '<td >';
                text += '<a class="badge badge-info badge-sm text-white"  title="Edit" onclick="onEdit(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fas fa-pencil-alt"> </i> </a>';
                text += '  &nbsp; <a class=" badge badge-info badge-sm text-white" title="View more" target="_blank" onclick="onviewResponse(' + data[i].ClientID + ')"> More.. </a>';
                text += '</td>';
                text += '</tr>';
            }
        }

        $("#MarketingData tbody").html("");
        $("#MarketingData tbody").append(text);

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

    function onviewResponse(ClientID) {
        window.location = "marketings-status?client=" + btoa(ClientID);
    }

    function onEdit(data) {

        $("#btnAddClient").hide();
        data = JSON.parse(unescape(data));
        MarketingClientID = data.ClientID;
        $("#Name").val(data.ClientName);
        $("#phoneNumbers").val(data.MobileNos);
        $("#EmailIDs").val(data.EmailIDs);
        $("#LandlineNo").val(data.LandLineNo);
        $("#Address").val(data.Address);
        $("#CountryID").val(data.countryid);
        $("#stateID").val(data.StateID);
        $("#city").val(data.CityID);
        $("#Landmark").val(data.LandMark);
        $("#pincode").val(data.Pincode);
        $("#enrollment").val(data.Enrollments);
        $("#website").val(data.Website);
        $("#ContactpersonName").val(data.ContactPersons);
        $("#ContactPersonDesignation").val(data.ContactPersonDesignation);
        $("#ContactPersonNumber").val(data.ContactPersonNumber);
        $("#InterestedProductIDs").val(data.InterestedProjectIDs);
        $("#lat").val(data.Lat);
        $("#long").val(data.Longitute);
        $("#discussion").val(data.Description);
        $("#AddnewClient").modal('show');
    }

    $("#Name").change(function() {
        updateMarketingClient("ClientName", $("#Name").val(), MarketingClientID);
    });

    $("#phoneNumbers").change(function() {
        updateMarketingClient("MobileNos", $("#phoneNumbers").val(), MarketingClientID);
    });

    $("#EmailIDs").change(function() {
        updateMarketingClient("EmailIDs", $("#EmailIDs").val(), MarketingClientID);
    });

    $("#LandlineNo").change(function() {
        updateMarketingClient("LandLineNo", $("#LandlineNo").val(), MarketingClientID);
    });

    $("#Address").change(function() {
        updateMarketingClient("Address", $("#Address").val(), MarketingClientID);
    });

    $("#CountryID").change(function() {
        updateMarketingClient("CountryID", $("#CountryID").val(), MarketingClientID);
    });

    $("#stateID").change(function() {
        updateMarketingClient("StateID", $("#stateID").val(), MarketingClientID);
    });

    $("#city").change(function() {
        updateMarketingClient("CityID", $("#city").val(), MarketingClientID);
    });

    $("#Landmark").change(function() {
        updateMarketingClient("LandMark", $("#Landmark").val(), MarketingClientID);
    });

    $("#pincode").change(function() {
        updateMarketingClient("Pincode", $("#pincode").val(), MarketingClientID);
    });

    $("#enrollment").change(function() {
        updateMarketingClient("Enrollments", $("#enrollment").val(), MarketingClientID);
    });

    $("#website").change(function() {
        updateMarketingClient("Website", $("#website").val(), MarketingClientID);
    });

    $("#ContactpersonName").change(function() {
        updateMarketingClient("ContactPersons", $("#ContactpersonName").val(), MarketingClientID);
    });
    $("#ContactPersonDesignation").change(function() {
        updateMarketingClient("ContactPersonDesignation", $("#ContactPersonDesignation").val(), MarketingClientID);
    });

    $("#ContactPersonNumber").change(function() {
        updateMarketingClient("ContactPersonNumber", $("#ContactPersonNumber").val(), MarketingClientID);
    });
    $("#InterestedProductIDs").change(function() {
        updateMarketingClient("InterestedProjectIDs", $("#InterestedProductIDs").val(), MarketingClientID);
    });
    $("#lat").change(function() {
        updateMarketingClient("Lat", $("#lat").val(), MarketingClientID);
    });
    $("#long").change(function() {
        updateMarketingClient("Longitute", $("#long").val(), MarketingClientID);
    });
    $("#discussion").change(function() {
        updateMarketingClient("Description", $("#discussion").val(), MarketingClientID);
    });

    //update on change of data
    function updateMarketingClient(Field, value, ID) {
        var obj = new Object();
        obj.Module = "Marketings";
        obj.Page_key = "UpdateMarketingClient";
        var json = new Object();
        json.Field = Field;
        json.Value = value;
        json.ID = ID;
        obj.JSON = json;
        TransportCall(obj);
    }
</script>