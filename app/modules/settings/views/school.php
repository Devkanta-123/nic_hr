<?php require_once(VIEWPATH . "/basic/header.php"); ?>
<?php require_once(VIEWPATH . "/basic/sidebar.php"); ?>

<link href="assets/js/plugins/icheck-bootstrap/icheck-bootstrap.min.css" rel="stylesheet">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                School Information
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="SchoolName">School Name</label>
                                        <input type="text" id="SchoolName" class="form-control" placeholder="School Name" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="max-width: 100px; max-height: 100px;">
                                            <!-- <img src="assets/img/image_placeholder.jpg" alt="..." style="max-width: 100px; max-height: 100px;"> -->
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail " style="max-width: 100px; max-height: 100px;">
                                            <img src="assets/img/image_placeholder.jpg" alt="..." style="max-width: 100px; max-height: 100px;">
                                        </div>
                                        <div>
                                            <span class="btn btn-round btn-file mt-2">
                                                <span class="fileinput-new"></span>
                                                <span class="fileinput-exists">Change logo</span>
                                                <input type="file" name="PassportPhoto" accept="image/x-png,image/jpeg,image/jpg" required>
                                            </span>
                                            <a href="javascript:;" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="State">State </label>
                                        <select class="form-control" name="" id="State"></select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="District">District </label>
                                        <select class="form-control" name="" id="District"></select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="CityName">City Name </label>
                                        <input type="text" id="CityName" class="form-control" placeholder="City Name" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="PinCode">PinCode</label>
                                        <input type="text" id="PinCode" class="form-control" placeholder="Pincode" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="State">Landmark </label>
                                        <input type="text" id="Landmark" class="form-control" placeholder="Landmark" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="TelephoneNo">TelephoneNo </label>
                                        <input type="text" id="TelephoneNo" class="form-control" placeholder="Telephone No" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="MobileNo">MobileNo</label>
                                        <input type="text" id="MobileNo" class="form-control" placeholder="Mobile No" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="Fax">Fax</label>
                                        <input type="text" id="Fax" class="form-control" placeholder="Fax" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="PrincipalName">Principal Name </label>
                                        <input type="text" id="PrincipalName" class="form-control" placeholder="Principal Name" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="PrincipalContactNo">PrincipalContactNo </label>
                                        <input type="text" id="PrincipalContactNo" class="form-control" placeholder="Principal ContactNo" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="SchoolContactPerson">School Contact Person</label>
                                        <input type="text" id="SchoolContactPerson" class="form-control" placeholder="School Contact Person" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="MaxStudentStrength">Max Student Strength</label>
                                        <input type="number" id="MaxStudentStrength" class="form-control" placeholder="Max Student Strength" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="State">Board</label>
                                        <select name="" id="BoardID" class="form-control"></select>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <label for="State">Available Classes</label>
                                    <div class="row" id="AvailableClasses">
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="button" class="btn btn-primary my-4" id="btnSave">Save Changes</button>
                            </div>
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

<?php require_once(VIEWPATH . "/basic/footer.php"); ?>

<script src="assets/js/plugins/icheck-bootstrap/icheck.min.js"></script>
<!-- Jasny File -->
<script src="assets/js/plugins/jasny-bootstrap.min.js"></script>
<script>
    $(function() {
        //getState();
        //getDistrict();
        //getBoard();
    });

    function getState() {
        var obj = new Object();
        obj.Module = "Settings";
        obj.Page_key = "getState";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    function getDistrict() {
        var obj = new Object();
        obj.Module = "Settings";
        obj.Page_key = "getDistrict";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    function getBoard() {
        var obj = new Object();
        obj.Module = "Settings";
        obj.Page_key = "getBoard";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    function getSchoolDetails() {
        var obj = new Object();
        obj.Module = "Settings";
        obj.Page_key = "getSchoolDetails";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    function onSuccess(rc) {

        if (rc.return_code) {
            switch (rc.Page_key) {
                case "getState":
                    loadSelect("#State", rc.return_data);
                    break;
                case "getDistrict":
                    loadSelect("#District", rc.return_data);
                    break;
                case "getBoard":
                    loadSelect("#BoardID", rc.return_data);

                    getSchoolDetails();
                    break;
                case "getSchoolDetails":
                    loaddata(rc.return_data);
                    break;
                default:
                    alert(rc.Page_key);
            }
        } else {
            alert("Error");
        }
        // alert(JSON.stringify(args));
    }

    function loaddata(data) {
        $("#SchoolName").val(data.SchoolName);
        $("#State").val(data.StateID);
        $("#District").val(data.DistrictID);
        $("#CityName").val(data.CityName);
        $("#PinCode").val(data.PinCode);
        $("#Landmark").val(data.Landmark);
        $("#TelephoneNo").val(data.TelephoneNo);
        $("#MobileNo").val(data.MobileNo);
        $("#Fax").val(data.Fax);
        $("#PrincipalName").val(data.PrincipalName);
        $("#PrincipalContactNo").val(data.PrincipalContactNo);
        $("#SchoolContactPerson").val(data.SchoolContactPerson);
        $("#MaxStudentStrength").val(data.MaxStudentStrength);
        $("#BoardID").val(data.BoardID);

        var availableClasses = (data.AvailableClasses).split(",");
        var text = "";
        for (let i = 0; i < availableClasses.length; i++) {
            text += '<div class="icheck-success pr-3"><input type="checkbox" checked id="cs' + i + '" disabled> <label for="cs' + i + '">' + availableClasses[i] + '</label></div>';
        }

        $("#AvailableClasses").html(text);
    }
</script>