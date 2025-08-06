<!-- summernote -->
<link rel="stylesheet" href="assets/admin/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.css">

<link rel="stylesheet" href="assets/admin/plugins/bootstrap-toggle-master/css/bootstrap-toggle.min.css">

<style>
    .custom-btn {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 25px;
        /* Adjust the value as needed for more or less rounded corners */
        background-color: #00b0e4;
        /* Set your desired background color */
        color: #fff;
        /* Set the text color */
        text-decoration: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Adjust the shadow as needed */
        transition: background-color 0.3s, color 0.3s, transform 0.3s;
    }

    .custom-btn:hover {
        background-color: #00b0e4;
        /* Set the hover background color */
        color: #fff;
        /* Set the hover text color */
        transform: scale(1.05);
        /* Optional: Increase the button size on hover */
    }

    .custom-btn1 {
        display: inline-block;
        padding: 3px 8px;
        /* Adjust the padding for a smaller size */
        border-radius: 15px;
        /* Adjust the value as needed for rounded corners */
        background: linear-gradient(to right, #00b0e4, #0094cc);
        /* Set gradient colors */
        color: #fff;
        text-decoration: none;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        /* Adjust the shadow as needed */
    }

    .custom-btn1:hover {
        background: linear-gradient(to right, #0094cc, #0077a8);
        /* Set gradient colors for hover effect */
        color: #fff;
        /* Set the hover text color */
        transform: scale(1.05);
    }





    .custom-text {
        font-size: 11px;
        position: absolute;
        top: 30px;
        /* Adjust as needed for the desired vertical position */
        left: 95px;
        /* Adjust as needed for the desired horizontal position */
        color: white;
        /* Set the color to white */
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-50px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .slide-in {
        animation: slideIn 0.5s ease-in-out;
    }

    #searchInput {
        border-radius: 20px;
        /* Adjust the border-radius for more rounded corners */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        /* Add a subtle shadow */
        margin-top: 10px;
        /* Adjust the margin-top to move the input down */
        padding: 8px;
        /* Adjust the padding for a smaller size */
        font-size: 14px;
        /* Adjust the font size for smaller text */
        width: 150px; /* Adjust the width for a smaller size */
    }
</style>


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
                                        <div class="col-md-4">
                                            <label for="Name">Name<b class="text-danger">*</b></label>
                                            <input type="text" class="form-control" id="Name" maxlength="100" placeholder="eg: John Deo">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="phoneNumbers">Contact<b class="text-danger">*</b></label>
                                            <input type="text" class="form-control" id="phoneNumbers" maxlength="55" placeholder=" eg: 9876543210,0987654321">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="EmailIDs">EmailIDs<b class="text-danger">*</b></label>
                                            <input type="text" class="form-control" id="EmailIDs" maxlength="200" placeholder="eg: test@gmail.com,test1@gmail.com">
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-4">
                                            <label for="LandlineNo">LandlineNo</label>
                                            <input type="text" id="LandlineNo" class="form-control" placeholder="eg: 123456" maxlength="10">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="Address">Address<b class="text-danger">*</b></label>
                                            <input type="text" id="Address" placeholder=" eg: Abc tower" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="CountryID">Country<b class="text-danger">*</b></label>
                                            <select name="" id="CountryID" class="form-control">
                                            </select>
                                        </div>
                                    </div>
                                    <!-- address -->
                                    <div class="row">

                                        <div class="col-md-4">
                                            <label for="stateID">State<b class="text-danger">*</b></label>
                                            <select id="stateID" class="form-control">
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="city">City<b class="text-danger">*</b></label>
                                            <select id="city" class="form-control">
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="Landmark">Landmark<b class="text-danger">*</b></label>
                                            <input type="text" id="Landmark" placeholder=" eg: Near Post Office" class="form-control">
                                        </div>

                                    </div>
                                    <div class="row">

                                        <div class="col-md-4">
                                            <label for="pincode">Pincode<b class="text-danger">*</b></label>
                                            <input type="text" id="pincode" maxlength="7" placeholder="790987" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="enrollment"> Students Enrollment <b class="text-danger">*</b></label>
                                            <input type="text" id="enrollment" maxlength="5" placeholder="1000" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="website">Website</label>
                                            <input type="text" id="website" placeholder="website.ac.in" maxlength="100" class="form-control">
                                        </div>
                                    </div>
                                    <!-- contact person -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="ContactpersonName">Contact Person Name<b class="text-danger">*</b></label>
                                            <input type="text" id="ContactpersonName" placeholder="eg: John Doe" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="ContactPersonDesignation">Designation<b class="text-danger">*</b></label>
                                            <input type="text" id="ContactPersonDesignation" placeholder="eg: Teacher" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="ContactPersonNumber">Phone-Number<b class="text-danger">*</b></label>
                                            <input type="text" id="ContactPersonNumber" placeholder="eg: 1231231231" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="InterestedProductIDs">Interested Product<b class="text-danger">*</b></label>
                                            <select name="" id="InterestedProductIDs" class="form-control">
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="lat">Latitude</label>
                                            <input type="text" class="form-control" id="lat" placeholder="eg: 25.740639" maxlength="15">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="long" class="required">Longitude</label>
                                            <input type="text" class="form-control" id="long" placeholder="eg: 89.983667" maxlength="15">
                                        </div>
                                    </div>


                                    <!-- lat long of the place -->
                                    <div class="row">


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
                <br>
                <br>
                <br>
                <!-- end modal -->


                <!-- <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div> -->
                <br>

                <div class="input-group">
                    <input type="search" class="form-control" placeholder="Type your keywords here" id="searchInput">
                    <div class="input-group-append">
                    </div>
                </div>
                <br>
                <br>
                <br>
                <div id="cardContainer" class="row">
                </div>

                <!-- <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-title">
                                        Marketing Details
                                    </div>
                                    <button class="btn btn-xs btn-primary" id="addNewClientBtn" style="float:right;"> <i class="fa fa-plus" aria-hidden="true"></i></button>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="col-md-12 mb-3">
                                <input type="file" name="" id="fileInput">
                            </div>

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
                </div> -->
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
                    loadOriginalData(rc.return_data);
                    //loaddata(rc.return_data);
                    filterData(rc.return_data);
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
    var flag = 2;

    // function loaddata(data) {
    //     var table = $("#MarketingData");
    //     try {
    //         if ($.fn.DataTable.isDataTable($(table))) {
    //             $(table).DataTable().destroy();
    //         }
    //     } catch (ex) {}

    //     var text = ""

    //     if (data.length == 0) {
    //         text += "No Data Found";
    //     } else {

    //         for (let i = 0; i < data.length; i++) {
    //             text += '<tr>';
    //             text += '<td> &nbsp; <b>' + data[i].ClientName + '</b> <br> &nbsp; <b>' + (data[i].MobileNos ? '<i class="fa fa-phone"></i> &nbsp; ' + data[i].MobileNos : '') + ' </b> <br>   <b>' + (data[i].EmailIDs == "-" ? '' : '<i class="fa fa-envelope"></i>  &nbsp; ' + data[i].EmailIDs + '') + '</b> </td> ';
    //             //address
    //             text += '<td>';
    //             text += '<b> ' + data[i].Address + ' </b> <br>';
    //             text += '<b> ' + data[i].NationalityName + ' </b><br>';
    //             text += '<b> ' + data[i].StateName + ', ' + data[i].CityName + ',Pin- ' + data[i].Pincode + ' </b><br>';
    //             text += 'LandMark : <b> ' + data[i].LandMark + ' </b>';
    //             text += '</td>';
    //             text += '<td>  <b>' + data[i].ContactPersons + ' (' + data[i].ContactPersonDesignation + ')</b> <br> <i class="fa fa-phone"></i> &nbsp; <b>' + data[i].ContactPersonNumber + ' </b><br> </td>';
    //             text += '<td> Service : <b>' + data[i].productName + '. </b><br>' + data[i].Description + ' </td>';
    //             text += '<td><a href="https://www.google.com/maps/search/<?php echo $school['Latitude'] ?>,<?php echo $school['Longitude'] ?>/" target="_blank"> <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFwAAABcCAMAAADUMSJqAAABKVBMVEX///80qFL6uwRChfTqQzUac+j/vAD6tgD6uAA+g/QufPMqpUsfo0UAaecRceg0f/TpOCgVoT9CguqtxfUAbedTjvTE1vvwh4AzqkGn1LB4wIhCg/nvenLqPS7+79LpOTf7wwDg8OT7xUkSp1bN2/l5pPFbkOxxn/CcufPz9/6nwvrm7f0hePPf6P2Rs/dpme65ZY7vNBPSTV/2t7PkRD5Eb9n97u10Z72cYKDyPx+9VXsnlZm33LrXSFVCmLlVbNA+j9LM5tE/iuGnWpHvJwDtyMs4pW384d/0nHU8oYnwcBX/++XznpnsWSn80F5PsWf94af3pRj1mBzyhSPvcSsulKZiuHb80HS+29eKx5f957xfqT36vy+Fqy6csDW/tjDeuSH81YZLqEbZKG0ZAAADcklEQVRoge2YaVfaQBSGk0wghCSEsIkiRqlikVhKtYtdbGmrrbUuXW3Rrv//RzQ7mQXJTeKXHp6v5Dze8847M4kcN2fOnP+A9epGt16pVLqbtxu9LMW9alfTtFrJo6Zpla1+Rur+hqaVchFKOaRbg/UM1L1NrZYjQDZysbud1l2tUWrX7ervpHMP8EBcZBSg11NE39fpsSNuZ/jEyfdz9Ng5HSHM3kjoZkRCuG2sZLPftSh1KUe6ESomKc3y8B49OO1GMoK7d4Ziefc+EYzMkCN9A+p+UBZFsV1+aM1028FAF3XBkYvi8JE1043kOnDwoeix9zhaFFlm/YHWk6ewwdtiYH8WtF3X64NBXS6S/tZ+kwcNXhZD2rvPbXuphqruMd5rdHF960WTV0cA+U5EbgdvL6u2Nfm1EQ1HfqnyvLIEkC+3o3Jx75WG7cM+Cu0y4l0AcpHg9QH+ey88BeRDxXEba7Hdb4a4u/yWfKJR9NzWUdMdXF2MLccjF813x9QjddkroeeGhP4ek5snp/QjVd0voc9ZbPkCvp7SOf3IdtErYUhsOV4WqbDCeKbolTBATSQ3PwgSUy6jMyWl3Py4ypZbrcOIGyCfZG5+WhWEAiPzvnUUCcWuS2x52Bbzs+0WBEZbtr40eYzY8qDn5ongUqB7vo+7la+x5Qd7/uSCL78gn/hm4HMr32PLg6tC8uWCNCaeUHE3rwKui12/hCF41Y95hZADDi63Lk4JJ0R36fiSdIOOXHtF3RJGKFz5+nHnxy1SDbosuLJfQkwvCZ3OlST9pNywa45bOCHVAflftBuUin1dSNPcvxluwFXhclqY4maMDdj7HitTRme5oYNz3AVr9PwlSw5L3IUhz9MltDFAVfEYU8HkGSWEdjyAXFN2CZOE4hCjhMlCccAak2cWhVfjn7UE51H7X5YbcElQTPqYv8wycI9O4boS8irgGGdwXQkTL2aAu6hTSph8MQPsvTSlhMl2D84fiV3CdIsZcMosYdrFDGC6Ddi351TWDNqdfjEDFim7Ev9LYiZL5IuKkk3gHsTrW1aBe4ywYNIcVyywYDINxSH6cQW+7WexGLFn7Y5spbRnIYtw9AwrPsFfUshHRHz8wkBfDOPhdT2LU5yFelPL6eDmYtyMmxtB/1UGwv5CvKlU7FtDMTLf+XPmzLmGf+vpVcp1B8AMAAAAAElFTkSuQmCC" style="width:10px" /></a> </td>';
    //             text += '<td >';
    //             text += '<a class="badge badge-info badge-sm text-white"  title="Edit" onclick="onEdit(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fas fa-pencil-alt"> </i> </a>';
    //             text += '  &nbsp; <a class=" badge badge-info badge-sm text-white" title="View more" target="_blank" onclick="onviewResponse(' + data[i].ClientID + ',' + flag + ')"> More.. </a>';
    //             text += '</td>';
    //             text += '</tr>';
    //         }
    //     }

    //     $("#MarketingData tbody").html("");
    //     $("#MarketingData tbody").append(text);

    //     $(table).DataTable({
    //         responsive: true,
    //         "order": [],
    //         dom: 'Bfrtip',
    //         "bInfo": true,
    //         exportOptions: {
    //             columns: ':not(.hidden-col)'
    //         },
    //         "deferRender": true,
    //         "pageLength": 10,
    //         buttons: [{
    //                 exportOptions: {
    //                     columns: ':not(.hidden-col)'
    //                 },
    //                 extend: 'excel',
    //                 orientation: 'landscape',
    //                 pageSize: 'A4'
    //             },
    //             {
    //                 exportOptions: {
    //                     columns: ':not(.hidden-col)'
    //                 },
    //                 extend: 'pdfHtml5',
    //                 orientation: 'landscape',
    //                 pageSize: 'A4'
    //             },
    //             {
    //                 exportOptions: {
    //                     columns: ':not(.hidden-col)'
    //                 },
    //                 extend: 'print',
    //                 orientation: 'landscape',
    //                 pageSize: 'A4'
    //             }
    //         ]
    //     });
    // }

    var mockData;

    function filterData(data) {
        mockData = data;

    }

    var originalData; // Variable to store the original data

    // Function to load original data
    function loadOriginalData(data) {
        // Assume your data is loaded via AJAX or some other method
        originalData = data;

        // Initial load with original data
        loaddata(originalData);
    }

    // Function to load data and apply search filter
    function loaddata(data) {
        var container = $("#cardContainer");

        // Clear existing content in the container
       // container.html("");
        container.empty();
        if (data.length === 0) {
            container.append("No Data Found");
        } else {
            var card="";
            var randomColor;
            for (let i = 0; i < data.length; i++) {
                // Your existing code for creating cards
                randomColor = getRandomGradientColor();
                card += '<div class="col-md-4">' +
                    '<div class="card card-widget widget-user shadow">' +
                    '<div class="widget-user-header" style="background: ' + randomColor + ';">' +
                    '<p class="widget-user-username" style="color:white;font-size: 20px;">' + data[i].ClientName + '</p>' +
                    // '<p class="widget-user-desc" style="color:white;">' + data[i].Address + '</p>' +

                    '</div>' +
                    '<div class="widget-user-image">' +
                    '<img class="img-circle elevation-2" src="https://img.freepik.com/free-psd/3d-illustration-school-building_23-2150932839.jpg?t=st=1709187662~exp=1709191262~hmac=03d48511f7ef87a630faec468389d92808e14613d44c42ce6e18f3a2bacf2b8c&w=740" alt="User Avatar">' +
                    // '<i class="fas fa-globe"></i><br>'+
                    '<p class="custom-text">Landline:' + data[i].LandLineNo + '</p>' +
                    '</div>' +
                    '<div class="card-footer">' +
                    '<div class="row">' +
                    '<div class="col-sm-4 border-right">' +
                    '<div class="description-block">' +
                    '<p>Enrollments</p>' +
                    '<i class="fas fa-users"></i>&nbsp;' +
                    '<span class="description-text">' + data[i].Enrollment + '</span>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-sm-4 border-right">' +
                    '<div class="description-block">' +
                    '<i class="fas fa-rotate-90 fa-phone custom-icon"></i>&nbsp;' +
                    '<p style="font-size: 13px;">' + data[i].MobileNos + '</p>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-sm-4">' +
                    '<div class="description-block">' +
                    '<i class="fas fa-shopping-cart"></i><br>' +
                    '<span style="font-size: 13px;">' + data[i].productName + '</span>' +
                    '</div>' +
                    '</div>' +
                    '<i class="fas fa-globe"></i>&nbsp;&nbsp;' +
                    '<p style="font-size: 13px;color:black;">' + data[i].Website + '</p>&nbsp;&nbsp;' +
                    // '<i class="fas fa-envelope"></i>&nbsp;&nbsp;'+
                    // '<p style="font-size: 13px;color:black;">'+data[i].EmailIDs+'</p>' +
                    '</div>' +
                    '</div>' +
                    '<div class="card-footer text-center">' +
                    '<a href="#"  title="edits" onclick="onEdit(\'' + escape(JSON.stringify(data[i])) + '\')"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;' +
                    '<a href="#" class="custom-btn" target="_blank" onclick="onviewResponse(' + data[i].ClientID + ' ,' + flag + ')">Read more</a>' +
                    '</div>' +
                    '</div>' +
                    '</div>';

            } 
            // Append the card to the container
                container.append(card);
        }
    }

    // Attach an event listener to the search input
    $("#searchInput").on("input", function() {
        debugger;
        var searchTerm = $("#searchInput").val().toLowerCase();

        if (searchTerm === "") {
            // Reload the original data if the search box is empty
            loaddata(originalData);
        } else {
            // Filter data based on the search input
            var filteredData = originalData.filter(item =>
                item.ClientName.toLowerCase().includes(searchTerm) ||
                item.Address.toLowerCase().includes(searchTerm) ||
                item.LandLineNo.includes(searchTerm) ||
                item.MobileNos.includes(searchTerm) ||
                item.productName.toLowerCase().includes(searchTerm) ||
                item.Website.toLowerCase().includes(searchTerm)
            );

            // Call the loaddata function with the filtered data
            loaddata(filteredData);
        }
    });




    // Function to generate a random gradient color
    function getRandomGradientColor() {
        // Define an array of possible colors
        var possibleColors = [
            '#FF5733', '#33FF57', '#5733FF', '#FF3399', '#33FFFF', '#FFCC33', '#9966FF', '#FF9933'
            // Add more colors as needed
        ];

        // Select two random colors from the array
        var colorIndex = Math.floor(Math.random() * possibleColors.length);
        var secondColorIndex = (colorIndex + 1) % possibleColors.length; // Ensure different second color

        // Get the selected colors
        var color = possibleColors[colorIndex];
        var secondColor = possibleColors[secondColorIndex];

        // Create a linear gradient with the random colors
        return 'linear-gradient(45deg, ' + color + ' 0%, ' + secondColor + ' 100%)';
    }

    function onviewResponse(ClientID, flag) {
        debugger;
        window.location = "marketings-status?client=" + btoa(ClientID) + "&flag=" + btoa(flag);
        console.log(flag);
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