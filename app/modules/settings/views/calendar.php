<!-- summernote -->
<link rel="stylesheet" href="assets/admin/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.css">
<link rel="stylesheet" href="assets/admin/plugins/bootstrap-toggle-master/css/bootstrap-toggle.min.css">
<link rel="stylesheet" href="assets/admin/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css">

<!-- DataTables -->
<link rel="stylesheet" href="assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css" rel="stylesheet" />

<!-- Attendance Summary -->
<!-- <div class="attendance-summary-float" id="summary" >
      <a href="#" class="summaryP"><i class="fa-solid fa-p text-sm"></i>   <span id="countP">P:0</span></a>
      <a href="#" class="summaryA"><i class="fa-solid fa-a text-sm"></i>   <span id="countA">A:0</span></a>
      <a href="#" class="summaryTotal"><i class="fa-solid fa-t text-sm"></i>  <span id="countTotal">T:0</span></a>
</div> -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Company Calendars
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                    <div class="col-md-3">
                                    <input type="text" id="calledarText" class="form-control" placeholder="Your text here" autocomplete="off">
                                    </div>

                                    <div class="col-md-3">
                                        <input type="date" class="form-control " id="CalendarDate" value="<?php  echo date("Y-m-d"); ?>">
                                    </div>
                                    <div class="col-md-3">
                                    <select class="form-control" id="calendarTextType"></select>
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-primary" id="addCalendar">Add Calendar</button>
                                    </div>
                           </div>
                                <br />
                                <div class="row">
                                    <div class="col-md-12">
                                    <table id="table" class="table table-bordered" >
                                    <thead>
                                    <tr>
                                        <th scope="col" >Date</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">IsHoliday</th>
                                        <th scope="col" >-</th>
                                    </tr>

                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                                </div>

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

<!-- Summernote -->
  <script src="assets/admin/plugins/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>
<script src="assets/admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>

<script>
    $(function() {
        getCompanyCalendar(); 
        getCalendarTextType();
    });

    //validation for the text input
    let msg= new RegExp('^[A-Za-z0-9-._ ]*$')
    // let text = new RegExp('^[A-Za-z0-9\ ]$');

    $("#calledarText").change(function(){
        if(msg.test($("#calledarText").val())==false)
            {
                notify("warning","Error! Invalid input encounter.")
                $("#calledarText").val('');
                return;
            }
    });

   function getCalendarTextType()
        {
            let obj = {};
            obj.Module = "Settings";
            obj.Page_key = "getCalendarTextType";
            obj.JSON = {};
            TransportCall(obj);
        }

    function getCompanyCalendar() {
        let obj = {};
        obj.Module = "Settings";
        obj.Page_key = "getCompanyCalendar";
        obj.JSON = {};
        TransportCall(obj);
    } 
    function onSuccess(rc) {
       
         if (rc.return_code) {
            switch (rc.Page_key) {

                case "getCalendarTextType":
                    loadSelect("#calendarTextType", rc.return_data);
                    break;
                
                case "getCompanyCalendar":
                    loaddata(rc.return_data); 
                    break;

                case "addCalendar":
                    notify("success",rc.return_data);
                    $('#calledarText').val('');
                    code=null;
                    getCompanyCalendar(); 
                    break;

                case "deleteCalendar":
                    notify("success", rc.return_data); 
                    getCompanyCalendar(); 
                    break;
                default:
                    notify("error",rc.Page_key);
            }
        } else {
            notify("error",rc.return_data);
            //clear table
             var table = $("#table");
             try {
                 if ($.fn.DataTable.isDataTable($(table))) {
                     $(table).DataTable().destroy();
                 }
             } catch (ex) {}
             $("#table tbody").html("");
         }
       
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
                text += '<td> ' + data[i].CalendarDate + '</td>';
                text += '<td> ' + data[i].CalendarText + '</td>'; 
                text += '<td> ' + data[i].CalendarTextType + '</td>';    
                text += '<td class="btn-group btn-group-sm">';
                text += '   <a class="btn btn-info btn-sm text-white" onclick="onEdit(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fas fa-pencil-alt"> </i> </a>';
                text += '   <a class="btn btn-danger btn-sm text-white" onclick="onDelete(' + data[i].AcademicsCalendarID + ')"> <i class="fas fa-trash"> </i> </a>';
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

    function onDelete(AcademicsCalendarID)
    {
        if (confirm("Are you sure you want to delete")) 
        {
            let obj = {};
            obj.Module = "Settings";
            let json = {};
            obj.Page_key = "deleteCalendar";
            json.AcademicsCalendarID = AcademicsCalendarID;
            obj.JSON = json;
            TransportCall(obj);
        }
    }

    $("#addCalendar").click(function (){
        if($("#calendarTextType").val()==-1){
            notify("warning","Please Select Type");
            return;
        }
        let obj = {};
        obj.Module = "Settings";
        obj.Page_key = "addCalendar";
        let json = {};
        json.CalendarText = $("#calledarText").val();
        json.CalendarDate = $("#CalendarDate").val(); 
        json.calendarTextType = $("#calendarTextType").val();

        if(code !=null){
            json.AcademicsCalendarID = code;
        }
        obj.JSON = json; 
        TransportCall(obj);   
         
    });



    var code=null;
    function onEdit(data){
        data = JSON.parse(unescape(data));
        $("#calledarText").val(data.CalendarText);
        $("#CalendarDate").val(data.CalendarDate);
        $("#calendarTextType").val(data.CalendarTextTypeID);
        $('#addAcademicCalendar').text("Save");
        mode = 2;
        code = data.AcademicsCalendarID;  
    }

</script>