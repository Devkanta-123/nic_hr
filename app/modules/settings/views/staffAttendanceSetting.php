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

                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="aboutToExpiredsubscription" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Designation</th>
                                        <th scope="col">Start time </th>                  
                                        <th scope="col"> End Time </th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <tr>
                                        <td>Office Staff</td>
                                        <td><input type="time" id="startTime" class="form-control "></td>
                                        <td><input type="time" id="endTime" class="form-control "></td> 
                                    </tr>
                                    <tr>
                                        <td>Teacher</td>
                                        <td><input type="time" id="" class="form-control "></td>
                                        <td><input type="time" id="endTime" class="form-control "></td> 
                                    </tr>
                                    <tr>
                                        <td>Intern</td>
                                        <td><input type="time" id="" class="form-control  "></td>
                                        <td><input type="time" id="endTime" class="form-control  "></td> 
                                    </tr>
                                    <tr>
                                        <td>Other Staff</td>
                                        <td><input type="time" id=""  class="form-control  "></td>
                                        <td><input type="time" id="endTime" class="form-control  "></td> 
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="text-primary">View All</a>                     
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

                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="aboutToExpiredsubscription" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Designation</th>
                                        <th scope="col">Mode </th>
                                        <th scope="col"> Start Time </th>
                                        <th scope="col"> End Time </th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                        <td>Office Staff</td>
                                        <td>
                                            <select name="" class="form-control" id="">
                                                <option value="">Direct</option>
                                                <option value="">QR code</option>
                                                <option value="">RFID</option>
                                            </select>
                                        </td>
                                        <td><input type="time" id="startTimeupdate" class="form-control  "></td>
                                        <td><input type="time" id="endTimeupdate" class="form-control  "></td> 
                                    </tr>
                                    <tr>
                                        <td>Teacher</td>
                                        <td>
                                            <select name="" class="form-control" id="">
                                                <option value="">Direct</option>
                                                <option value="">QR code</option>
                                                <option value="">RFID</option>
                                            </select>
                                        </td>
                                        <td><input type="time" id="" class="form-control  "></td>
                                        <td><input type="time" id="endTimeupdate" class="form-control  "></td> 
                                    </tr>
                                    <tr>
                                        <td>Intern</td>
                                        <td>
                                            <select name="" class="form-control" id="">
                                                <option value="">Direct</option>
                                                <option value="">QR code</option>
                                                <option value="">RFID</option>
                                            </select>
                                        </td>
                                        <td><input type="time" class="form-control  "></td>
                                        <td><input type="time" class="form-control  "></td> 
                                    </tr>
                                    <tr>
                                        <td>Other Staff</td>
                                        <td>
                                            <select name="" class="form-control" id="">
                                                <option value="">Direct</option>
                                                <option value="">QR code</option>
                                                <option value="">RFID</option>
                                            </select>
                                        </td>
                                        <td><input type="time" class="form-control  "></td>
                                        <td><input type="time" class="form-control  "></td> 
                                    </tr>

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


            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Taday Attendance
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="aboutToExpiredsubscription" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Staff</th>
                                        <th scope="col">Mode </th>
                                        <th scope="col"> Start Time </th>
                                        <th scope="col"> End Time </th>
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

            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Individual Attendance
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="aboutToExpiredsubscription" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Staff</th>
                                        <th scope="col">Mode </th>
                                        <th scope="col"> Start Time </th>
                                        <th scope="col"> End Time </th>
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

<script src="assets/admin/plugins/summernote/summernote-bs4.min.js"></script>
<script src="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.js"></script>
<script src="assets/admin/plugins/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>


<script>
$('#startTime').change(function(){
        $("#startTimeupdate").val($('#startTime').val()); //set manual
});

$('#endTime').change(function(){
        $("#endTimeupdate").val($('#endTime').val()); //set manual
});
</script>

     
