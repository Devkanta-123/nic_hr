<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="maincontent">
    <!-- DataTables -->
    <link rel="stylesheet" href="assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css" rel="stylesheet" />

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <!-- statisics Card -->
                        <div class="card-header">
                            <h1 class="card-title">
                                <h2>Staff</h2>
                            </h1>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body"> 

                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="importfile" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <a href="assets/staff.csv" id="processfile" class="btn btn-block btn-warning text-white text-sm"> Download Template</a>
                                </div>
                            </div>

                            <div class="row">

                                <table id="table" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                         <th scope="col">Name</th>
                                         <th scope="col">DOB </th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">Date of Joining</th>
                                        <th scope="col">Mobile No</th> 
                                        <th scope="col">email</th>
                                        <th scope="col">Address</th> 
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-center">
                            <button type="button" class="btn btn-primary px-5" id="btnUpload">Save </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.14.3/xlsx.full.min.js"></script>
<script src="assets/js/jquery.csv.min.js"></script>

</div>
<!-- /.content-wrapper -->
<script> 
document.title="Uplading Staff";
    function onSuccess(rc) {

        if (rc.return_code) {
            switch (rc.Page_key) {
               
                case "uploadStaff":
                    notify('Success',rc.return_data);
                    $("#table tbody").html("");
                    // getExamination();
                    StaffData=[];
                    break;
                default:
                    notify('error',"Unable to process the request");

            }
        }
        else{
             notify('error',rc.return_data); 
            $("#table tbody").html("");
        }
    } 
    document.getElementById('importfile').addEventListener('change', importFile);
    var StaffData=[];
    function importFile(evt) {
        var f = evt.target.files[0];
        if (f) {
            var r = new FileReader();
            r.onload = e => {
                debugger;

                // StaffData = $.csv.toArrays(e.target.result);
                StaffData = csvJSON(e.target.result);
                console.log(StaffData);
                loadToStaffTable(StaffData);
            }
            r.readAsBinaryString(f);
        } else {
            console.log("Failed to load file");
        }
    }

    function loadToStaffTable(list){
        debugger;
        var text='';
        for(var i=0;i<list.length;i++){
            text += '<tr> ';
             text += '<td> ' +  list[i].StaffName + '</td>';
            text += '<td> ' +  list[i].DOB + '</td>';
            text += '<td> ' +  list[i].GenderCode + '</td>';
             text += '<td> ' +  list[i].JoinedDate + '</td>';
            text += '<td> ' +  list[i].ContactNo + '</td>';
            text += '<td> ' +  list[i].EmailID + '</td>';
            text += '<td> ' +  list[i].Address + '</td>'; 
            text += '</tr >';
        }
        $("#table tbody").html(text);
    } 
    $("#btnUpload").click(function(){ 
         if ($("#Sections option:selected").val()=="-1" || StaffData.length==0){
            notify("warning","Please check everything");
            return;
        } 
        var obj = {};
        obj.Module = "Staff";
        obj.Page_key = "uploadStaff";
        obj.JSON = { 
            StaffData:StaffData
        };
        TransportCall(obj);
    });
</script>