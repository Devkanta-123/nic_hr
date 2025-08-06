<!--   
       CreatedBy: Devkanta
       Created On: 19/02/2024
       Modified On: 
    -->

<link rel="stylesheet" href="assets/admin/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.css">

<link rel="stylesheet" href="assets/admin/plugins/bootstrap-toggle-master/css/bootstrap-toggle.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card ">
                        <div class="card-header">
                            <div class="card-title">
                                Intern List </div>

                            <span class="float-right">
                                <button class="btn btn-success" data-toggle="modal" data-target="#modal-addIntern" onclick="clearForm()">
                                    <i class="fa fa-circle-thin"></i> <i class="fa fa-plus"></i> Add Intern
                                </button>
                            </span>
                            <div class="modal fade" id="edit-modal">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"> Intern</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body">
                                                <div class="row mb-3">
                                                    <div class="col-md-4">
                                                        <label for="staff_name">Staff Intern Name</label> <span style="color: red;">**<span>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="far fa-user-alt"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input type="text" class="form-control float-right" id="EditInternName" placeholder="Enter staff Intern name.." autocomplete="off">
                                                                </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="contact">Contact Number</label> <span style="color: red;">**<span>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="far fa-phone"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input type="number" class="form-control float-right" id="EditContact" placeholder="Enter contact number.." autocomplete="off">
                                                                </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="EditReligion">Religion</label> <span style="color: red;">**<span>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="fas fa-users"></i>
                                                                        </span>
                                                                    </div>
                                                                    <select class="form-control" id="EditReligion"></select>
                                                                </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-4">
                                                        <label for="email">Email</label> <span style="color: red;">**<span>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="fas fa-envelope"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input type="text" class="form-control float-right" id="EditEmail" placeholder="Enter email.." autocomplete="off">
                                                                </div>
                                                    </div>


                                                    <div class="col-md-4">
                                                        <label for="gender">Gender</label> <span style="color: red;">**<span>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="fas fa-mars"></i>
                                                                        </span>
                                                                    </div>
                                                                    <!-- Replace the input with a select dropdown -->
                                                                    <select id="EditGender" autocomplete="off" class="form-control js-example-basic-multiple">
                                                                        <!-- Add blood group options here -->
                                                                        <option value="M">Male</option>
                                                                        <option value="F">Female</option>
                                                                    </select>
                                                                </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="Caste">Caste</label> <span style="color: red;">**<span>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="fas fa-globe"></i>
                                                                        </span>
                                                                    </div>
                                                                    <select class="form-control" id="EditCaste"></select>
                                                                </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-4">
                                                        <label for="dob">Date of Birth</label> <span style="color: red;">**<span>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="far fa-calendar"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input type="date" class="form-control float-right" id="EditDOB">
                                                                </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="contact_gender">Address</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="far fa-map-marker-alt"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" class="form-control float-right" id="EditAddress" placeholder="Enter address.." autocomplete="off">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="Community">Community</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="far fa-user"></i>
                                                                </span>
                                                            </div>
                                                            <select class="form-control" id="EditCommunity"></select>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-4">
                                                        <label for="joining_date">Joining Date</label> <span style="color: red;">**<span>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="far fa-calendar"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input type="date" class="form-control float-right" id="EditJoiningDate">
                                                                </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="blood_group">Blood Group</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="fas fa-tint"></i>
                                                                </span>
                                                            </div>
                                                            <!-- Replace the input with a select dropdown -->
                                                            <select id="EditBloodGroup" autocomplete="off" class="form-control js-example-basic-multiple">
                                                                <!-- Add blood group options here -->
                                                                <option value="A+">A+</option>
                                                                <option value="A-">A-</option>
                                                                <option value="B+">B+</option>
                                                                <option value="B-">B-</option>
                                                                <option value="O+">O+</option>
                                                                <option value="O-">O-</option>
                                                                <option value="AB+">AB+</option>
                                                                <option value="AB-">AB-</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="Nationality">Nationality</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="fas fa-users"></i>
                                                                </span>
                                                            </div>
                                                            <select class="form-control" id="EditNationality">

                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-4">
                                                        <label for="rfid_no">RFID No</label> <span style="color: red;">**<span>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="fas fa-credit-card"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input type="text" class="form-control float-right" id="EditRfidNo" placeholder="Enter RFID No .." autocomplete="off">
                                                                </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="Photo">Profile </label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="fas fa-user"></i>
                                                                </span>
                                                            </div>
                                                            <input type="file" class="form-control float-right" id="EditPhoto">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="EditInternCategory">Category</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="fas fa-building"></i>
                                                                </span>
                                                            </div>
                                                            <select class="form-control" id="EditInternCategory">
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <!-- <button type="button" class="btn btn-primary" id="btnSave">Save </button> -->
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>

                            <div class="modal fade" id="modal-addIntern">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"> Add Intern</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body">
                                                <div class="row mb-3">
                                                    <div class="col-md-4">
                                                        <label for="staff_name">Staff Intern Name</label> <span style="color: red;">**<span>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="far fa-user-alt"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input type="text" class="form-control float-right" id="staff_name" placeholder="Enter staff Intern name.." autocomplete="off">
                                                                </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="contact">Contact Number</label> <span style="color: red;">**<span>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="far fa-phone"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input type="number" class="form-control float-right" id="contact" placeholder="Enter contact number.." autocomplete="off">
                                                                </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="Religion">Religion</label> <span style="color: red;">**<span>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="fas fa-users"></i>
                                                                        </span>
                                                                    </div>
                                                                    <select class="form-control" id="Religion"></select>
                                                                </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-4">
                                                        <label for="email">Email</label> <span style="color: red;">**<span>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="fas fa-envelope"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input type="text" class="form-control float-right" id="email" placeholder="Enter email.." autocomplete="off">
                                                                </div>
                                                    </div>


                                                    <div class="col-md-4">
                                                        <label for="gender">Gender</label> <span style="color: red;">**<span>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="fas fa-mars"></i>
                                                                        </span>
                                                                    </div>
                                                                    <!-- Replace the input with a select dropdown -->
                                                                    <select id="gender" autocomplete="off" class="form-control js-example-basic-multiple">
                                                                        <!-- Add blood group options here -->
                                                                        <option value="M">Male</option>
                                                                        <option value="F">Female</option>
                                                                    </select>
                                                                </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="Caste">Caste</label> <span style="color: red;">**<span>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="fas fa-globe"></i>
                                                                        </span>
                                                                    </div>
                                                                    <select class="form-control" id="Caste"></select>
                                                                </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-4">
                                                        <label for="dob">Date of Birth</label> <span style="color: red;">**<span>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="far fa-calendar"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input type="date" class="form-control float-right" id="dob">
                                                                </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="contact_gender">Address</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="far fa-map-marker-alt"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" class="form-control float-right" id="address" placeholder="Enter address.." autocomplete="off">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="Community">Community</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="far fa-user"></i>
                                                                </span>
                                                            </div>
                                                            <select class="form-control" id="Community"></select>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-4">
                                                        <label for="joining_date">Joining Date</label> <span style="color: red;">**<span>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="far fa-calendar"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input type="date" class="form-control float-right" id="joining_date">
                                                                </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="blood_group">Blood Group</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="fas fa-tint"></i>
                                                                </span>
                                                            </div>
                                                            <!-- Replace the input with a select dropdown -->
                                                            <select id="blood_group" autocomplete="off" class="form-control js-example-basic-multiple">
                                                                <!-- Add blood group options here -->
                                                                <option value="A+">A+</option>
                                                                <option value="A-">A-</option>
                                                                <option value="B+">B+</option>
                                                                <option value="B-">B-</option>
                                                                <option value="O+">O+</option>
                                                                <option value="O-">O-</option>
                                                                <option value="AB+">AB+</option>
                                                                <option value="AB-">AB-</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="Nationality">Nationality</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="fas fa-users"></i>
                                                                </span>
                                                            </div>
                                                            <select class="form-control" id="Nationality">

                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-4">
                                                        <label for="rfid_no">RFID No</label> <span style="color: red;">**<span>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="fas fa-credit-card"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input type="text" class="form-control float-right" id="rfid_no" placeholder="Enter RFID No .." autocomplete="off">
                                                                </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="Photo">Profile </label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="fas fa-user"></i>
                                                                </span>
                                                            </div>
                                                            <input type="file" class="form-control float-right" id="Photo">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="blood_group">Category </label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="fas fa-building"></i>
                                                                </span>
                                                            </div>
                                                            <select class="form-control" id="InternCategory">
                                                            </select>
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



                            <div class="modal fade" id="viewprofile-modal">
                                <div class="modal-dialog modal-lg">

                                    <!-- <div class="modal-header">
                                            <h4 class="modal-title">Profile</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div> -->

                                    <div class="col-md-10">
                                        <div class="card card-widget widget-user shadow">
                                            <div class="widget-user-header" style="color: white; background-color: #37B5B6;">
                                                <h3 class="widget-user-username" id="profile_staff_name"> </h3>
                                                <p class="widget-user-desc">Intern</p>
                                            </div>
                                            <div class="widget-user-image">
                                                <img class="img-circle elevation-2" alt="User Avatar" id="profile_photo">
                                            </div>
                                            <div class="card-footer">
                                                <div class="row">
                                                    <div class="col-sm-4 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header"><i class="fas fa-phone" style="color: #9DBC98;"></i></h5>
                                                            <span class="description-text" id="profile_tel"></span>
                                                        </div>

                                                    </div>

                                                    <div class="col-sm-3 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header"><i class="fas fa-map-marker" style="color: #5C5470;"></i></h5>
                                                            <span] id="profile_address"></span>
                                                        </div>

                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="description-block">
                                                            <h5 class="description-header"><i class="fas fa-envelope" style="color: #FBD85D;"></i></h5>
                                                            <span id="profile_email"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="btnSave">Save </button>
                                        </div> -->

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
                                        <th scope="col">Profile</th>
                                        <th scope="col">Intern Name</th>
                                        <th scope="col">Contact <Noscript></Noscript></th>
                                        <th scope="col">Email ID</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Joined On</th>
                                        <th scope="col">Religion</th>
                                        <th scope="col">Nationality</th>
                                        <th scope="col"> Action</th>
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
    $(function() {
        getInternCategories();
        getInternList();
        getReligion();
        getCaste();
        getCommunity();
        getNationality();

    });

    function getReligion() {
        let obj = {};
        obj.Module = "Settings";
        obj.Page_key = "getReligion";
        obj.JSON = {};
        TransportCall(obj);
    }

    function getCaste() {
        let obj = {};
        obj.Module = "Settings";
        obj.Page_key = "getCaste";
        obj.JSON = {};
        TransportCall(obj);
    }

    function getCommunity() {
        let obj = {};
        obj.Module = "Settings";
        obj.Page_key = "getCommunity";
        obj.JSON = {};
        TransportCall(obj);
    }

    function getInternCategories() {
        var obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getInternCategories";
        obj.JSON = {};
        TransportCall(obj);
    }



    function getNationality() {
        let obj = {};
        obj.Module = "Settings";
        obj.Page_key = "getNationality";
        obj.JSON = {};
        TransportCall(obj);
    }

    function clearForm() {
        $('#staff_name').val('');
        $('#contact').val('');
        $('#email').val('');
        $('#dob').val('');
        $('#address').val('');
        $('#joining_date').val('');
        $('#rfid_no').val('');
        $('#Photo').val('');

    }

    function getInternList() {
        var obj = new Object();
        obj.Module = "Staff";
        obj.Page_key = "getInternList";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }




    function onSuccess(rc) {
        debugger;

        if (rc.return_code) {
            switch (rc.Page_key) {

                case "getNationality":
                    loadSelect("#Nationality", rc.return_data);
                    loadSelect("#EditNationality", rc.return_data);
                    break;

                case "getReligion":
                    loadSelect("#Religion", rc.return_data);
                    loadSelect("#EditReligion", rc.return_data);
                    break;
                case "getCaste":
                    loadSelect("#Caste", rc.return_data);
                    loadSelect("#EditCaste", rc.return_data);
                    break;
                case "getCommunity":
                    loadSelect("#Community", rc.return_data);
                    loadSelect("#EditCommunity", rc.return_data);
                    break;

                case "getInternCategories":
                    
                    loadSelect("#InternCategory", rc.return_data);
                    console.log(rc.return_data);
                    loadSelect("#EditInternCategory", rc.return_data);
                    break;

                case "deleteStaffIntern":
                    notify("sucess", rc.return_data);
                    break;


                case "updateInternInfo":
                    notify("success", rc.return_data);
                    getInternList();
                    break;


                case "addIntern":
                    $("#modal-lg").modal("hide");
                    notify("success", rc.return_data);
                    location.reload();
                    // getInternList();
                    //clearForm();
                    break;

                case "getInternList":
                    // debugger;
                    loaddata(rc.return_data);
                    break;

                default:
                    notify("error", rc.Page_key);
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
                if (data[i].Photo == null) {
                    text += '<td> <img src="../app/data/temp/default.png" alt="Profile Photo" class="img-circle elevation-2" style="width: 50px; height: auto;"> </td>';
                } else {
                    text += '<td> <img src="../app/data/temp/' + data[i].Photo + '" alt="Profile Photo" class="img-circle elevation-2" style="width: 50px; height: auto;"> </td>';

                }
                text += '<td> ' + data[i].StaffInternName + '</td>';
                text += '<td> ' + data[i].ContactNo + '</td>';
                text += '<td> ' + data[i].EmailID + '</td>';
                text += '<td> ' + data[i].Address + '</td>';
                text += '<td> ' + data[i].StartDate + '</td>';
                text += '<td> <span class=" badge badge-success">' + data[i].Religion + '</span></td>';
                text += '<td> ' + data[i].NationalityName + '</td>';
                // text += '<td> ' + new Date(data[i].CreatedDateTime).toLocaleDateString() + '</td>';
                text += '<td class="btn-group btn-group-sm">';
                text += ' <a class="btn btn-info btn-sm text-white" onclick="onEdit(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fas fa-pencil-alt"> </i> </a>';
                text += ' <a class="btn btn-danger btn-sm text-white" onclick="onDelete(' + data[i].StaffInternID + ')"> <i class="fas fa-trash"> </i> </a>';
                text += ' <a class="btn btn-primary btn-sm text-white" onclick="viewProfile(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fas fa-eye"> </i> </a>';
                text += ' <a class="btn btn-info btn-sm text-white" title="Attendance" onclick="internAttendanceDetail(' + data[i].StaffInternID + ',\'' + data[i].StaffInternName + '\')"> <i class="fas fa-clock"> </i> </a>';
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


    let data;
    $("#Photo").change(function() {
        getBase64($(this).prop('files')[0]);
    });

    function getBase64(file) {
        let reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function() {
            console.log(reader.result);
            // callback(reader.result.split(',')[1]);
            data = reader.result;
        };
        reader.onerror = function(error) {
            console.log('Error: ', error);
        };
    }


    //On change of particular fields uodated happening

    $("#EditInternName").change(function() {
        updateInternInfo("StaffInternName", $("#EditInternName").val(), StaffInternID)
    });

    $("#EditContact").change(function() {
        updateInternInfo("ContactNo", $("#EditContact").val(), StaffInternID)
    });

    $("#EditEmail").change(function() {
        updateInternInfo("EmailID", $("#EditEmail").val(), StaffInternID)
    });

    $("#EditDOB").change(function() {
        updateInternInfo("DOB", $("#EditEmail").val(), StaffInternID)
    });

    $("#Editaddress").change(function() {
        updateInternInfo("Address", $("#Editaddress").val(), StaffInternID)
    });

    $("#EditJoiningDate").change(function() {
        updateInternInfo("StartDate", $("#EditJoiningDate").val(), StaffInternID)
    });

    $("#EditRfidNo").change(function() {
        updateInternInfo("RFIDcardNo", $("#EditRfidNo").val(), StaffInternID)
    });
    $("#EditReligion").change(function() {
        updateInternInfo("ReligionID", $("#EditReligion").val(), StaffInternID)
    });

    $("#EditPhoto").change(function() {
        debugger;
        updateInternInfo("Photo", data, StaffInternID)
    });
    $("#EditCaste").change(function() {
        updateInternInfo("CasteCode", $("#EditCaste").val(), StaffInternID)
    });

    $("#EditCommunity").change(function() {
        updateInternInfo("CommunityID", $("#EditCommunity").val(), StaffInternID)
    });

    $("#EditNationality").change(function() {
        updateInternInfo("NationalityID", $("#EditNationality").val(), StaffInternID)
    });

    $("#EditInternCategory").change(function() {
        updateInternInfo("CategoryID", $("#EditInternCategory").val(), StaffInternID)
    });


    function internAttendanceDetail(StaffInternID, StaffInternName) {
        debugger;
        localStorage.setItem("StaffInternID", StaffInternID);
        localStorage.setItem("StaffInternName", StaffInternName);
        window.location.href = "staff-individualreport";
    }

    $("#btnSave").click(function() {
        debugger;
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "addIntern";
        let json = {};
        json.StaffInternName = $("#staff_name").val();
        // json.Contact = $("#contact").val();
        // Validate Contact Number
        let contactNumber = $("#contact").val();
        if (!isValidContactNumber(contactNumber)) {
            notify("error", "Please enter a valid Contact Number (must be 10 digits).");
            return;
        }
        json.Contact = contactNumber;
        json.Email = $("#email").val();
        json.Gender = $("#gender").val();

        // Validate Date of Birth
        let dob = $("#dob").val();
        if (!isValidDateOfBirth(dob)) {
            notify("error", " Invalid DOB !  (must be at least 10 years ago from Current Year)");
            return;
        }

        json.Dob = dob;

        // Validate Joining Date
        let joiningDate = $("#joining_date").val();
        if (!isValidJoiningDate(joiningDate)) {
            notify("error", "Please enter a valid Joining Date");
            return;
        }

        json.JoiningDate = joiningDate;
        json.Address = $("#address").val();
        json.BloodGroup = $("#blood_group").val();
        json.RfidNo = $("#rfid_no").val();
        json.Photo = data;

        if (code != null) {
            json.StaffInternID = code;
        }
        json.ReligionID = $("#Religion option:selected").val();
        json.CasteCode = $("#Caste option:selected").val();
        json.CommunityID = $("#Community option:selected").val();
        json.NationalityID = $("#Nationality option:selected").val();
        json.CategoryID = $("#InternCategory option:selected ").val();
        obj.JSON = json;
        console.log(JSON.stringify(obj));
        console.log(obj);
        if ($("#staff_name").val() == '' || $("#contact").val() == '') {
            notify("error", "All fields are required")
        } else {
            TransportCall(obj);
        }

    });


    // Function to validate Joining Date
    function isValidJoiningDate(joiningDate) {
        // Convert Joining Date string to Date object
        let joiningDateObj = new Date(joiningDate);

        // Get the current date
        let currentDate = new Date();

        // Compare Joining Date with current date (excluding tomorrow and any future date)
        return joiningDateObj <= currentDate;
    }

    // Function to validate Date of Birth
    function isValidDateOfBirth(dob) {
        // Convert DOB string to Date object
        let dobDate = new Date(dob);

        // Get the current date
        let currentDate = new Date();

        // Get the date one year ago
        let tenYearAgo = new Date();
        tenYearAgo.setFullYear(tenYearAgo.getFullYear() - 10);

        // Compare DOB with current date and at least one year ago
        return dobDate < currentDate && dobDate < tenYearAgo;
    }
    // Function to validate Contact Number
    // function isValidContactNumber(contactNumber) {
    //     // Remove non-digit characters and check if the length is exactly 10
    //     return /^\d{10}$/.test(contactNumber);
    // }

    function isValidContactNumber(contactNumber) {
        // Check if the contact number contains only digits
        if (/^\d+$/.test(contactNumber)) {
            // Check if the length is exactly 10 digits
            return contactNumber.length === 10;
        }

        // Return false if the contact number contains non-digit characters
        return false;
    }



    var code = null;
    var StaffInternID;

    function onEdit(data) {
        data = JSON.parse(unescape(data));
        StaffInternID = data.StaffInternID;
        $("#EditInternName").val(data.StaffInternName);
        $("#EditContact").val(data.ContactNo);
        $("#EditEmail").val(data.EmailID);
        $("#EditDOB").val(data.DOB);
        $("#EditAddress").val(data.Address);
        $("#EditJoiningDate").val(data.StartDate);
        $("#EditRfidNo").val(data.RFIDcardNo);
        $("#EditReligion").val(data.ReligionID);
        $("#EditCaste").val(data.CasteCode);
        $("#EditCommunity").val(data.CommunityID);
        $("#EditNationality").val(data.NationalityID);
        $("#EditInternCategory").val(data.InternCategoryID);
        $("#edit-modal").modal("show");
        $("#btnSave").hide();
    }

    function onDelete(StaffInternID) {
        // alert(StaffInternID);
        if (confirm("Are you sure you want to delete")) {
            let obj = {};
            obj.Module = "Staff";
            let json = {};
            obj.Page_key = "deleteStaffIntern";
            json.StaffInternID = StaffInternID;
            obj.JSON = json;
            TransportCall(obj);
        }

    }

    function viewProfile(data) {
        debugger;
        data = JSON.parse(unescape(data));
        //document.getElementById("profile_staff_name").innerText = data.StaffInternName;
        $('#profile_staff_name').text(data.StaffInternName);
        $('#profile_tel').text(data.ContactNo);
        $('#profile_address').text(data.Address);
        $('#profile_email').text(data.EmailID);
        // $('#profile_photo').text(data.Photo);
        //if image exist then load img else load default
        var photoPath = data.Photo ? '../app/data/temp/' + data.Photo : '../app/data/temp/default.png';
        $('#profile_photo').attr('src', photoPath);
        $("#viewprofile-modal").modal("show");

    }


    function updateInternInfo(field, data, StaffInternID) {
        debugger;
        var obj = {};
        obj.Module = "Staff";
        var json = {};
        obj.Page_key = "updateInternInfo";
        json.Field = field;
        json.Data = data;
        json.StaffInternID = StaffInternID;
        obj.JSON = json;
        console.log(obj);
        TransportCall(obj);

    }
</script>