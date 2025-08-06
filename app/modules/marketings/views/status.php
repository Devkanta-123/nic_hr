<!-- 
    CreatedBy: Angelbert Riahtam
    Created On: 
    Modified on : 12/01-2024 (Adding the price),28-02-2024 (Modified the UI)
    By : Devkanta Singh
    -->

<!-- summernote -->
<link rel="stylesheet" href="assets/admin/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.css">
<link rel="stylesheet" href="assets/admin/plugins/bootstrap-toggle-master/css/bootstrap-toggle.min.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">


<style>
    #imagedialogcontainer {
        background: #FFF;
        padding: 20px;
        margin: 20px;
    }

    #imgdialogcontent {
        width: 400px;
        height: 400px;
    }

    .custom-toggle {
        border-radius: 20px;
        /* Adjust the value for the desired roundness */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Add a slight box shadow */
        background-color: #fff;
        /* Set the background color */
        border: 1px solid #ccc;
        /* Set a border */
        padding: 3px;
        /* Add some padding */
    }

    /* Style for the toggle handle */
    .custom-toggle .toggle-handle {
        border-radius: 50%;
        /* Make the handle round */
        background-color: #fff;
        /* Set the handle background color */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        /* Add a slight shadow to the handle */
    }

    .custom-img {
        border-radius: 50%;
        /* Makes the image a perfect circle */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Adjust the values for the shadow effect */
        transition: transform 0.3s ease-in-out;
        /* Add a smooth transition effect on hover */
        width: 100px;
        /* Adjust the width to control the size of the circle */
        height: 100px;
        /* Adjust the height to control the size of the circle */
        object-fit: cover;
        /* Ensures the image covers the entire circle */

        /* Optional: Add a hover effect */
        cursor: pointer;
    }

    .custom-img:hover {
        transform: scale(1.05);
        /* Adjust the value to control the scale on hover */
    }

    .widget-user-header {
        background: linear-gradient(to right, #ff69b4, #87ceeb);
        /* Adjust colors as needed */
    }

    .product-img {
        display: inline-block;
        /* Ensures the div only takes the necessary width */
    }

    .custom-icon {
        margin-right: 20px;
        /* Adjust the right margin as needed */
        font-size: 24px;
        /* Adjust the font size as needed */
    }

    .custom-color {
        color: #2D9596;
        /* Adjust the color as needed */
    }

    .input-validation-error~.select2 {
        border: 1px solid red;
        border-radius: 5px;
    }
</style>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card card-widget widget-user-2">
                        <div class="widget-user-header">
                            <div class="row">
                                <div class="col-md-1">
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="max-width: 100px; max-height: 100px;">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail " style="max-width: 100px; max-height: 100px;">
                                            <img onclick="openimagedialog();" id="logopic" src="assets/img/image_placeholder.jpg" alt="..." class="custom-img">
                                        </div>
                                        <div>
                                            <span class="btn btn-round btn-file mt-2">
                                                <span class="fileinput-new"></span>
                                                <input type="file" accept="image/*" id="uploadimg" style="display:none" />
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-5 text-white">
                                    <h3 class="widget-user-username text-white font-weight-bold" id="ITPL_Client">-</h3>
                                    <h6 class="widget-user-desc text-white"> </h6> <!-- <i class='fas fa-phone'></i>  <span id="PhnNo"></span> -->
                                    <h6 class="widget-user-desc text-white"> </h6> <!-- <i class='fas fa-envelope'></i> <span id="ClientEmail"></span> -->
                                </div>
                                <div class="col-md-6 text-right text-white">
                                    <!-- LastUpdated-On :   <span>  test  </span><br> -->
                                    Current Status : <span id="ClientCurrentStatus" class="badge badge-info">-</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">

                            <div class="card direct-chat direct-chat-warning">
                                <div class="card-header">
                                    <h3 class="card-title">About</h3>

                                </div>

                                <div class="card-body p-0">

                                    <ul class="products-list product-list-in-card">
                                        <li class="item">
                                            <div class="product-img">&nbsp;&nbsp;
                                                <i class="fa fa-school custom-icon"></i>
                                            </div>
                                            <div class="product-info">
                                                <a href="javascript:void(0)" class="product-title custom-color"> School/Organization Name:
                                                    <p class="product-description" id="ClientName">

                                                    </p>
                                            </div>
                                        </li>

                                        <li class="item">
                                            <div class="product-img">&nbsp;&nbsp;
                                                <i class="fas fa-rotate-90 fa-phone custom-icon"></i>
                                            </div>
                                            <div class="product-info">
                                                <a href="javascript:void(0)" class="product-title custom-color">Contact No:
                                                    <p id="PhnNo" class="product-description">

                                                    </p>
                                            </div>
                                        </li>

                                        <li class="item">
                                            <div class="product-img">&nbsp;&nbsp;
                                                <i class="fas fa-envelope custom-icon"></i>
                                            </div>
                                            <div class="product-info">
                                                <a href="javascript:void(0)" class="product-title custom-color">Email ID:
                                                    <p id="ClientEmail" class="product-description">

                                                    </p>
                                            </div>
                                        </li>

                                        <li class="item">
                                            <div class="product-img">&nbsp;&nbsp;
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                            <div class="product-info">
                                                <a href="javascript:void(0)" class="product-title custom-color">Address
                                                </a>
                                                <span id="Address" class="product-description">

                                                </span>
                                            </div>
                                        </li>
                                        <li class="item">
                                            <div class="product-img">&nbsp;&nbsp;
                                                <i class="fas fa-users"></i>
                                            </div>
                                            <div class="product-info">
                                                <a href="javascript:void(0)" class="product-title custom-color">Enrollments
                                                </a>
                                                <span id="Enrollments" class="product-description">

                                                </span>
                                            </div>
                                        </li>

                                    </ul>


                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Contacted Person Info</h3>

                                </div>

                                <div class="card-body p-0">
                                    <ul class="products-list product-list-in-card">
                                        <li class="item">
                                            <div class="product-img">&nbsp;&nbsp;
                                                <i class="fa fa-user custom-icon"></i>
                                            </div>
                                            <div class="product-info">
                                                <a href="javascript:void(0)">Name:
                                                    <p class="product-description" id="ContactPersons">

                                                    </p>
                                            </div>
                                        </li>

                                        <li class="item">
                                            <div class="product-img">&nbsp;&nbsp;
                                                <i class="fas fa-user-tie custom-icon"></i>
                                            </div>
                                            <div class="product-info">
                                                <a href="javascript:void(0)" class="product-title custom-color">Designation:
                                                    <p id="ContactPersonDesignation" class="product-description">

                                                    </p>
                                            </div>
                                        </li>

                                        <li class="item">
                                            <div class="product-img">&nbsp;&nbsp;
                                                <i class="fas fa-rotate-90 fa-phone  custom-icon"></i>
                                            </div>
                                            <div class="product-info">
                                                <a href="javascript:void(0)" class="product-title custom-color">Contact No:
                                                    <p id="ContactPersonNumber" class="product-description">

                                                    </p>
                                            </div>
                                        </li>

                                        <li class="item">
                                            <div class="product-img">&nbsp;&nbsp;
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                            <div class="product-info">
                                                <a href="javascript:void(0)" class="product-title custom-color">Address
                                                </a>
                                                <span id="Address" class="product-description">

                                                </span>
                                            </div>
                                        </li>


                                        <li class="item">
                                            <!-- <div class="product-img">&nbsp;&nbsp;
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div> -->
                                            <div class="product-info">
                                                <a href="javascript:void(0)" class="product-title custom-color">Interest Product
                                                </a>
                                                <span id="Interestedproducts" class="product-description">

                                                </span>
                                            </div>

                                        </li>









                                    </ul>

                                </div>


                            </div>

                        </div>

                    </div>

                    <div class="p-0">
                        <!-- feedback -->
                        <div class="card mt-2">
                            <div class="card-header">
                                <h3 class="card-title">Feedback</h3>
                                <div class="card-tools">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <button style="float:right;" class="btn-sm btn-primary btn-xs" id="AddnewFeedback"> <i class="fa fa-plus" aria-hidden="true"></i> Add Feedback</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                <table id="Marketingfeedback" class="table table-bordered">
                                    <thead>
                                        <!-- <th scope="col">FollowUpDateTime</th> -->
                                        <th scope="col">Remarks</th>
                                        <th scope="col">Discussion</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">isPositive</th>
                                        <!-- <th scope="col">Discussion</th> -->
                                        <!-- <th scope="col">Created Date</th>
                                            <th scope="col">Created By</th> -->
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- client info -->
                        <!-- <div class="card mt-2">
                            <div class="card-header">

                                <h3 class="card-title">Client Info</h3> &nbsp; <span>(Created-On : <b id="addedDate"></b> )</span>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body" style="display: none;">
                                <table id="ClientData" class="table">
                                    <thead>
                                        <tr>
                                            <td scope="col"> <i class="fa fa-address-card" aria-hidden="true"></i> </td>
                                            <td scope="col"> <i class="fa fa-server" aria-hidden="true"></i> </td>
                                            <td scope="col"> <i class="fa fa-list" aria-hidden="true"></i> </td>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div> -->

                    </div>
                </div>
            </div>
        </div>

        <!-- modal to add feedback -->
        <div class="row">
            <div class="modal fade" id="addFeedback">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Feedback</h4>
                            <button type="button" class="close btn-danger btn-sm" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body" style=" overflow-x: auto;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="ITPLClientName">Client Name <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control" id="ITPLClientName" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="MarketingStatusID">Status <b class="text-danger">*</b></label>
                                        <select name="" class="form-control" id="MarketingStatusID"></select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Has Custom Field</label>&nbsp;
                                            <div class="toggle btn btn-success" data-toggle="toggle" style="width: 0px; height: 0px;"><input class="form-control bootstrapToggle" id="add_files" type="checkbox" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="light" value="">
                                                <div class="toggle-group"><label class="btn btn-success toggle-on">Yes</label><label class="btn btn-light active toggle-off">No</label><span class="toggle-handle btn btn-default"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="div_files" style="display:none;">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="row">
                                            <div class="col-sm-12" style="text-align:right">
                                                <a class="text-warning" onclick="deleteRowFiles()" title="Delete Selected File(s)" style="font-size:25px; cursor:pointer"><i class="fas fa-minus-hexagon"></i></a>
                                                <a class="text-teal" onclick="addRowFiles()" title="Add New File" style="font-size:25px; cursor:pointer"><i class="fas fa-plus-hexagon"></i></a>
                                            </div>
                                        </div>
                                        <div class="row" style="height:auto; overflow:auto">
                                            <table id="tblFiles" class="table table-hover" style="width:100%; text-align:left;">
                                                <thead>
                                                    <tr>
                                                        <th style="vertical-align:middle; width:10%; text-align:center;"></th>
                                                        <th style="vertical-align:middle; width:40%;">Type<b style="color:red;">*</b></th>
                                                        <th style="vertical-align:middle; width:40%;">Data Fields<b style="color:red;">*</b></th>
                                                        <th style="vertical-align:middle; width:50%; text-align:center;">Descriptions<b style="color:red;">*</b></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="vertical-align:middle; width:10%; text-align:center;"><input type="checkbox" /></td>
                                                        <td style="vertical-align:middle; width:40%;"><select class="form-control" id="staff" data-placeholder="All Types" style="width: 100%;"></select></td>
                                                        <td style="vertical-align:middle; width:50%; text-align:center;"><input type="text" id="fields" class="form-control" /></td>
                                                        <td style="vertical-align:middle; width:50%; text-align:center;"><input type="test" id="data" class="form-control" /></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="price">Pricing</label>
                                        <input type="text" class="form-control" id="price" maxlength="4">
                                    </div>
                                    <div class="col-md-6" id="FollowUpDate" style="display: none;">
                                        <label for="FollowUpdateTime">FollowUpDateTime </label>
                                        <input type="datetime-local" id="FollowUpdateTime" class="form-control">
                                    </div>

                                    <div class="col-md-6" id="AppointmentDateDiv" style="display: none;">
                                        <label for="AppointentDate">Appoinment Date </label>
                                        <input type="datetime-local" id="AppointmentDate" class="form-control">
                                    </div>

                                </div>


                                <div class="row">


                                    <div class="col-md-6" id="talkDiv" style="display: none;">
                                        <label for="isPositive">How was the talk?</label>
                                        <br>
                                        <input type="checkbox" name="isPositive" id="isPositive" checked data-toggle="toggle" data-on="Positive" data-off="Negative" data-onstyle="success" data-offstyle="danger" data-width="40%">
                                    </div>


                                    <div class="col-md-6" id="followUpDiv" style="display: none;">
                                        <label for="question1">Have you met with the owner of the organization?</label>
                                        <input type="checkbox" name="question1" id="question1" checked data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="30%">
                                    </div>
                                </div>
                                <!-- question row -->
                                <div class="row">

                                    <div class="col-md-6" id="Leads1Div" style="display: none;">
                                        <label for="question2">Did you met the right person?</label>
                                        <br>
                                        <input type="checkbox" name="question2" id="question2" checked data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="30%">
                                    </div>

                                    <div class="col-md-6" id="Leads2Div" style="display: none;">
                                        <label for="question3">Do you think they can afford the product?</label>
                                        <input type="checkbox" name="question3" id="question3" checked data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="30%">
                                        <!-- <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success"> <input type="checkbox"  class="custom-control-input" id="isPositive">  <label class="custom-control-label" for="isPositive"></label> </div>   -->
                                    </div>


                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="Discussion">Discussion <b class="text-danger">*</b></label>
                                        <textarea name="" class="form-control" id="Discussion" placeholder="Discussion"></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="Remarks">Remarks <b class="text-danger">*</b> </label>
                                        <textarea name="" id="Remarks" placeholder="Remarks" class="form-control"></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-primary" style="float:right;" id="btnAddFeedBack">Save </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>

<!-- upload photo modal -->
<div class="modal fade" id="uploadimagedialog" tabindex="-1" role="dialog" aria-labelledby="uploadimagedialogLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="imagedialogcontainer">
                            <div id="imgdialogcontent">
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="modal-footer">
                <div id="newphoto" class="btn btn-warning"> <i class=" mdi mdi-access-point-network"></i> New Photo</div>
                <div id="btnuploadphoto" class="btn btn-primary"> <i class=" mdi mdi-access-point-network"></i> Update</div>
            </div>
        </div>
    </div>
</div>

<!-- Summernote -->
<script src="assets/admin/plugins/summernote/summernote-bs4.min.js"></script>

<script src="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.js"></script>
<script src="assets/admin/plugins/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" integrity="sha512-zxBiDORGDEAYDdKLuYU9X/JaJo/DPzE42UubfBw9yg8Qvb2YRRIQ8v4KsGHOx2H1/+sdSXyXxLXv5r7tHc9ygg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js" integrity="sha512-Gs+PsXsGkmr+15rqObPJbenQ2wB3qYvTHuJO6YJzPe/dTLvhy0fmae2BcnaozxDo5iaF8emzmCZWbQ1XXiX2Ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    let url = new URL(window.location.href);
    let ClientID = atob(url.searchParams.get("client"));
    let flag = atob(url.searchParams.get("flag"));
    let ITPLMarketingID;
    let ProjectResponseID;


    // //load Div on change of the status ID
    $('#MarketingStatusID').change(function() {
        var selectedValue = $(this).val();

        // Hide all divs initially
        $('#talkDiv,#FollowUpDate,#Leads1Div,#Leads2Div,#AppointmentDateDiv').hide();

        // Show the corresponding div based on the selected option
        if (selectedValue === '1') { //called 
            $('#talkDiv').show();
        } else if (selectedValue === '2') { //Apppointment
            $('#AppointmentDateDiv').show();
        } else if (selectedValue === '3') { //FollowUp
            $('#FollowUpDate').show();
        } else if (selectedValue === '4') { //LeadsClosed
            $('#Leads1Div').show();
            $('#Leads2Div').show();
            //$('#Leads1Div').show();
        }
    });


    $(function() {
        getMarketingClientInfo(ClientID, flag);
        getAllMarketingStatus();
        getMarketingStatusFeedbackByID(ClientID, flag);
        getMonths();
    });


    function getMonths() {
        let obj = {};
        obj.Module = "Settings";
        obj.Page_key = "getMonths";
        obj.JSON = {};
        SilentTransportCall(obj);
    }

    function getMarketingClientInfo(data, flag) {
        var obj = new Object();
        obj.Module = "Marketings";
        obj.Page_key = "getMarketingClientInfo";
        var json = new Object();
        json.MarketingClientID = ClientID;
        json.flag = flag;
        obj.JSON = json;
        TransportCall(obj);
    }

    // function addRowFiles() {
    //     if ($('#tblFiles tbody tr').length < 5) {
    //         $("#tblFiles").append($('#tblFiles tbody tr:last').clone());
    //         $('#tblFiles tbody tr:last').each(function(row, tr) {
    //             $(tr).find('td').eq(1).prop('innerHTML', '');
    //             $(tr).find('td').eq(1).append('<select class="form-control" id="' + $('#tblFiles tbody tr').length + '" multiple="multiple" data-placeholder="All Types"></select>');

    //             // $(tr).find('td').eq(1).append('<input type="text" id="file_title' + $('#tblFiles tbody tr').length + '" class="form-control file_title" placeholder="Eg. ACADEMIC CALENDAR" maxlength="99" autocomplete="off"/>');
    //             $(tr).find('td').eq(2).prop('innerHTML', '');
    //             $(tr).find('td').eq(2).append('<input type="file" id="file' + $('#tblFiles tbody tr').length + '" accept="image/*,.pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx" class="dropify file" data-height="100"/>');
    //             $('.dropify').dropify();
    //         });
    //     } else {
    //         toastr.info('Only 5 Files can be attached !!');
    //     }
    // }
    function addRowFiles() {
        if ($('#tblFiles tbody tr').length < 5) {
            // Clone the last row
            var newRow = $('#tblFiles tbody tr:last').clone();

            // Increment the index for unique IDs
            var newIndex = $('#tblFiles tbody tr').length + 1;

            // Update IDs and clear values
            newRow.find('select').attr('id', 'staff' + newIndex).val('');

            // Remove extra select2 containers and reinitialize select2
            newRow.find('select').siblings('.select2-container').remove();
            newRow.find('select').select2({
                // Select2 options if needed
            });

            newRow.find('input.file_title').attr('id', 'file_title' + newIndex).val('');
            newRow.find('input.dropify').attr('id', 'file' + newIndex).val('');

            // Append the new row
            $("#tblFiles").append(newRow);
        } else {
            toastr.info('Only 5 Files can be attached !!');
        }
    }


    function deleteRowFiles() {
        try {

            var table = document.getElementById('tblFiles');
            var rowCount = table.rows.length;
            for (var i = 0; i < rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if (null != chkbox && true == chkbox.checked) {
                    if (rowCount <= 2) {
                        break;
                    }
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }
            }
        } catch (e) {
            alert(e);
        }
    }


    //for cropie

    var croppieimage = null;

    function openimagedialog() {
        $('#uploadimagedialog').modal('show');
    }
    $('#newphoto').click(function() {
        $('#uploadimg').trigger('click');
    });
    $("#uploadimg").change(function() {
        getBase64($(this).prop('files')[0]);

    });

    let logodata;

    function getBase64(file) {
        let reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function() {
            logodata = reader.result;
            reloadImageForCrop();
        };
        reader.onerror = function(error) {
            console.log('Error :', 'Please check the photo')
        };
    }

    function reloadImageForCrop() {
        debugger;
        if (croppieimage != null) {
            croppieimage.destroy();
            croppieimage = null;
        }
        var el = document.getElementById('imgdialogcontent');
        croppieimage = new Croppie(el, {
            viewport: {
                width: 200,
                height: 200
            },
            boundary: {
                width: 400,
                height: 400
            },
            showZoomer: true,
            enableOrientation: false,
        });
        croppieimage.bind({
            url: logodata,
            orientation: 1
        });
    }

    $('#btnuploadphoto').click(function() {
        croppieimage.result({
            type: 'base64',
            format: 'png'
        }).then(function(data) {
            logodata = data;
            updatelogo();
            $('#logopic').attr('src', data);
            $('#uploadimagedialog').modal('hide');
        });
    });

    function updatelogo() {
        let obj = {};
        obj.Module = "Marketings";
        obj.Page_key = "uploadLogo";
        obj.JSON = {
            Logo: logodata,
            ClientID: ClientID
        };
        TransportCall(obj);
    }

    function getAllMarketingStatus() {
        var obj = new Object();
        obj.Module = "Marketings";
        obj.Page_key = "getAllMarketingStatus";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    $('#add_files').on('change', function() {
        if ($('#add_files').prop('checked')) {
            add_files = 1;
            $('.file_title').val('');
            $('.dropify-clear').click();
            $('#div_files').show();
        } else {
            add_files = 0;
            $('#div_files').hide();
        }
    });

    //validation
    $('#Discussion,#Remarks').keypress(function(e) {
        var charCode = (e.which) ? e.which : event.keyCode
        if (String.fromCharCode(charCode).match(/[^A-Za-z0-9.'_\- ]/g))
            return false;
    });

    //price
    $('#price').keypress(function(e) {
        var charCode = (e.which) ? e.which : event.keyCode
        if (String.fromCharCode(charCode).match(/[^0-9.]/g))
            return false;
    });


    $("#price").val()

    function onSuccess(rc) {
        if (rc.return_code) {
            switch (rc.Page_key) {

                case "getMarketingClientInfo":
                    loadClientInfo(rc.return_data);
                    console.log(rc.return_data);
                    break;
                case "getMonths":
                    loadSelect("#staff", rc.return_data);
                    break;
                case "getAllMarketingStatus":
                    loadSelect("#MarketingStatusID", rc.return_data);
                    break;

                case "addMarketingFeedback":
                    $("#addFeedback").modal('hide');
                    notify("success", rc.return_data);
                    break;

                case "getMarketingStatusFeedbackByID":
                    loadFeedback(rc.return_data);
                    break;

                case "uploadLogo":
                    notify("success", rc.return_data);
                    break;

                default:
                    notify("warning", rc.Page_key);
            }
        } else {
            notify("error", rc.return_data);
        }
    }


    $("#AddnewFeedback").click(function() {
        $("#addFeedback").modal('show');
    });

    $("#btnAddFeedBack").click(function() {
        if ($("#MarketingStatusID").val() == -1) {
            notify("warning", "Please select the  Feedback Status");
            return false;
        }

        // $("#FollowUpdateTime").val()=='' || followUp date

        if ($("#Remarks").val() == '' || $("#Discussion").val() == '') {
            notify("warning", "Important fields cannot be empty");
            return false;
        }

        var obj = new Object();
        debugger;
        obj.Module = "Marketings";
        obj.Page_key = "addMarketingFeedback";
        var json = new Object();
        json.ClientID = ClientID;
        json.flag = flag;
        json.ProjectResponseID = ProjectResponseID;
        json.Remarks = $("#Remarks").val();
        json.isPositive = ($('#isPositive').is(':checked') == true ? 1 : 0);
        json.StatusID = $("#MarketingStatusID").val();
        json.FollowUpDateTime = $("#FollowUpdateTime").val();
        json.AppointmentDate = $("#AppointmentDate").val();
        json.NextFollowUp_Discussion = $("#Discussion").val();
        json.Price = $("#price").val();
        json.Question1 = ($('#question1').is(':checked') == true ? 1 : 0);
        json.Question2 = ($('#question2').is(':checked') == true ? 1 : 0);
        json.Question3 = ($('#question3').is(':checked') == true ? 1 : 0);

        obj.JSON = json;
       TransportCall(obj);
    });

    function getMarketingStatusFeedbackByID(data, flag) {
        debugger;
        var obj = new Object();
        obj.Module = "Marketings";
        obj.Page_key = "getMarketingStatusFeedbackByID";
        var json = new Object();
        json.ClientID = data;
        json.flag = flag;
        obj.JSON = json;
        TransportCall(obj);
    }

    //load feedback data
    function loadFeedback(data) {
    var table = $("#Marketingfeedback");
    try {
        if ($.fn.DataTable.isDataTable(table)) {
            table.DataTable().destroy();
        }
    } catch (ex) {
        console.error("Error destroying DataTable:", ex);
    }

    var text = "";

    if (data.length === 0) {
        text += "No Data Found";
    } else {
        for (let i = 0; i < data.length; i++) {
            text += '<tr>';
            
            const dateString = data[i].FollowUpDateTime;
            if (dateString) {
                const dateObject = new Date(Date.parse(dateString));
                const formattedDate = dateObject.toLocaleDateString("en-US", {
                    year: "numeric",
                    month: "long",
                    day: "numeric",
                });

                const formattedTime = dateObject.toLocaleTimeString("en-US", {
                    hour: "numeric",
                    minute: "numeric",
                    second: "numeric",
                });

                text += '<td>' + `${formattedDate} ${formattedTime}` + '</td>';
            } else {
                // text += '<td>N/A</td>';
            }

            text += '<td>' + (data[i].Remarks || 'N/A') + '</td>';
            text += '<td>' + (data[i].NextFollowUp_Discussion || 'N/A') + '</td>';
            text += '<td>' + (data[i].Price == null ? "<span class='badge badge-warning'>NA</span>" : data[i].Price) + '</td>';
            text += '<td>' + (data[i].Status || 'N/A') + '</td>';
            text += '<td>' + (data[i].isPositive == 1 ? "<span class='badge badge-success'>Yes</span>" : "<span class='badge badge-warning'>No</span>") + '</td>';
            text += '</tr>';
        }
    }

    $("#Marketingfeedback tbody").html("");
    $("#Marketingfeedback tbody").append(text);

    table.DataTable(); // Reinitialize DataTable if necessary
}


    // load client information
    function loadClientInfo(data) {
        //school Logo / Photo
        if (data.Logo != null) {
            logodata = "file?type=marketing&name=" + data.Logo;
            $("#logopic").attr("src", logodata);
        } else {
            $("#logopic").attr("src", 'assets/img/image_placeholder.jpg');
        }

        ProjectResponseID = data.ProjectResponseID;
        //load in feeback form
        $("#ClientCurrentStatus").text(data.Status);
        $("#ITPLClientName").val(data.ClientName);
        $("#addedDate").text(data.CreatedDateTime);
        $("#ITPL_Client").text(data.ClientName);
        $("#ClientName").text(data.ClientName);
        $("#Address").text(data.Address);
        $("#ContactPersonDesignation").text(data.ContactPersonDesignation);
        $("#ContactPersonNumber").text(data.ContactPersonNumber);
        $("#ContactPersons").text(data.ContactPersons);
        $("#Enrollments").text(data.Enrollments);
        $("#Interestedproducts").text(data.Interestedproducts);
        if (data.MobileNos != null) {
            // let phoneno = data.MobileNos;
            $("#PhnNo").text(data.MobileNos);
        }
        // else{
        //     $("#PhnNo").text(data.MobileNos); 
        // }

        $("#ClientEmail").text(data.EmailIDs);
        var table = $("#ClientData");
        var text = "";
        // text += '<tr>';
        // text += '<td> <i class="fa fa-address-card" style="font-size:30px;" aria-hidden="true"></i>  <br> <br> <div style="margin-left:0px;">' + data.Address + ' <br> ' + data.NationalityName + '<br> ' + data.StateName + ', ' + data.CityName + ', Pin - ' + data.Pincode + ' <br> LandMark : ' + data.LandMark + '  </div> </td> ';
        // text += '<td> <i class="fa fa-server"  style="font-size:30px;"  aria-hidden="true"></i>  <br> <br> <div style="margin-left:0px;"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> &nbsp; ' + data.Interestedproducts + ' <br> <i class="fa fa-user" aria-hidden="true"></i> &nbsp; ' + data.ContactPersons + ' (' + data.ContactPersonDesignation + ') <br> <i class="fa fa-phone" aria-hidden="true"></i> &nbsp; ' + data.ContactPersonNumber + ' <br> </div> </td>';
        // text += '<td>  <i class="fa fa-list" style="font-size:30px;"  aria-hidden="true"></i>  <br> <br> <div  style="margin-left:0px;"> <i class="fa fa-phone" aria-hidden="true"></i>  ' + data.LandLineNo + ' <br> <i class="fa fa-globe" aria-hidden="true"></i> ' + data.Website + '  <br> Enrollment : ' + data.Enrollments + ' </div> </td>';
        // text += '</tr>';
        $("#ClientData tbody").html("");
        $("#ClientData tbody").append(text);
    }
</script>