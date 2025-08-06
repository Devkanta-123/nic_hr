<!-- summernote -->
<link rel="stylesheet" href="assets/admin/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.css">
<link rel="stylesheet" href="assets/admin/plugins/bootstrap-toggle-master/css/bootstrap-toggle.min.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">


<style>
    .input-validation-error~.select2 {
        border: 1px solid red;
        border-radius: 5px;
    }
</style>

<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <strong>Leave List</strong>
                            </div>
                            
                            <!-- modal approved -->
                            <!-- <div class="modal fade" id="mdlAdd">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title d-flex justify-content-center">Approved Leave</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form id="frmAdd">
                                            <div class="modal-body">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <div class="form-group">
                                                                <label class="required" for="title">Remarks <span class="text-danger">*</span></label>
                                                                <input id="title" name="title" class="form-control" type="text" maxlength="999" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                                            <div class="form-group">
                                                                <label class="required" for="sdate">From Date</label>
                                                                <input type="text" id="sdate" class="form-control" autocomplete="off" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                                            <div class="form-group">
                                                                <label class="required" for="edate">To Date</label> 
                                                                <input type="text" id="edate" class="form-control" autocomplete="off" required>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-12 col-lg-12 pr-4">
                                                            <div class="row">
                                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                                    <div class="form-group">
                                                                        <label>Add File(s)</label>
                                                                        <input class="form-control bootstrapToggle" id="add_files" type="checkbox" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="light" />
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
                                                                                    <th style="vertical-align:middle; width:40%;">Title<b style="color:red;">*</b></th>
                                                                                    <th style="vertical-align:middle; width:50%; text-align:center;">File<b style="color:red;">*</b></th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="vertical-align:middle; width:10%; text-align:center;"><input type="checkbox" /></td>
                                                                                    <td style="vertical-align:middle; width:40%;"><input type="text" id="file_title1" class="form-control file_title" placeholder="Eg. LEAVE REPORT" maxlength="99" autocomplete="off" /></td>
                                                                                    <td style="vertical-align:middle; width:50%; text-align:center;"><input type="file" id="file1" accept="image/*,.pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx" class="dropify file" data-height="100" /></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br />
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> -->

                            <!-- modal decline -->
                            <!-- <div class="modal fade" id="mdDecline">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title d-flex justify-content-center">Decline Leave</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                    
                                            <div class="modal-body">
                                                <div class="card-body">
                                                    <div class="row"> 
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <div class="form-group">
                                                                <label class="required" for="declineRemarks">Remarks <span class="text-danger">*</span></label>
                                                                <input id="declineRemarks" name="declineRemarks" class="form-control" type="text" maxlength="" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                
                                                <button  id="Declinerequest" class="btn btn-success">Submit</button>
                                            </div>
                                       
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        
                        <div class="card-body">
                            
                            <div style="overflow:auto; width:100%">
                                <table id="tblData" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">Request</th>
                                        <!-- <th scope="col">Requested Date</th> -->
                                        <th scope="col">Replied</th>
                                        <!-- <th scope="col">Documents</th> -->
                                        <!-- <th scope="col"></th> -->
                                    </tr>
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
    </section>
</div>

<!-- Summernote -->
<script src="assets/admin/plugins/summernote/summernote-bs4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.js"></script>
<script src="assets/admin/plugins/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="assets/js/commonfunctions.js"></script>
<script>
    var  notice_details, notice_id, title, sdate, edate, type;
    var add_files = 0;

    var  StaffID,LeaveID,DepartmentID;

    $("#sdate, #sdate1, #edate, #edate1").datepicker({
        minDate: "-0D",
        maxDate: "+1Y",
        changeMonth: true,
        changeYear: true
    });

    $('.dropify').dropify();
    $('.bootstrapToggle').bootstrapToggle();

    $(function() {
        getallLeaveList(); //both reject/approved
       
    });
    
    //
    function getallLeaveList()
    {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getallLeaveList";
        obj.JSON = {};
        TransportCall(obj);
    }

    $("#sdate").on('change', function() {
        $('#edate').datepicker('option', 'minDate', new Date($("#sdate").val()));
    });
    $("#sdate1").on('change', function() {
        $('#edate1').datepicker('option', 'minDate', new Date($("#sdate1").val()));
    });

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

    $('#frmAdd').submit(function() {
        saveAddFormData();
        return false;
    });


    // $('#mdlAdd').on('hidden.bs.modal', async function() {
    //     $("input").val("");
    //     $('.select2').val(null).trigger('change');
    //     $('.dropify-clear').click();
    // });


    //show description when click on  a link
    // $('#tblData').on('click', 'a', function() {
    //     $("#detail").show();
    // });

    // $('#tblData').on('click', '#detail', function() {
    //     $("#detail").hide();
    // });


    function addRowFiles() {
        if ($('#tblFiles tbody tr').length < 5) {
            $("#tblFiles").append($('#tblFiles tbody tr:last').clone());
            $('#tblFiles tbody tr:last').each(function(row, tr) {
                $(tr).find('td').eq(1).prop('innerHTML', '');
                $(tr).find('td').eq(1).append('<input type="text" id="file_title' + $('#tblFiles tbody tr').length + '" class="form-control file_title" placeholder="Eg. ACADEMIC CALENDAR" maxlength="99" autocomplete="off"/>');
                $(tr).find('td').eq(2).prop('innerHTML', '');
                $(tr).find('td').eq(2).append('<input type="file" id="file' + $('#tblFiles tbody tr').length + '" accept="image/*,.pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx" class="dropify file" data-height="100"/>');
                $('.dropify').dropify();
            });
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
            notify('warning',e);
        }
    }

    //add notice
    async function saveAddFormData() 
    {
        let obj = {};
        let json = {};
        var fileData = {};
        var totalFileSize = 0;
        for (var j = 1; j <= $('#tblFiles tbody tr').length; j++) {
            var files = $('#file' + j)[0].files;
            var file_title = $('#file_title' + j).val();

            for (var i = 0; i < files.length; i++) {
                const fsize = files[i].size;
                const file = Math.round((fsize / 1024));
                totalFileSize += file;
                if (file > (1024 * 20)) {
                    toastr.error("Attached Document at Row-" + j + " is more than 20 MB !!");
                    return false;
                }
                await getBase64(files[i]).then(
                    data => fileData[j] = {
                        filedata: data,
                        filename: files[i]['name'],
                        file_title: file_title
                    });
            }
        }
        obj.Module = "Staff";
        obj.Page_key = "onLeaveApproved";
        json.Remarks = $("#title").val();
        json.FromDate = $("#sdate").val();
        json.ToDate = $("#edate").val();
        json.LeaveID = LeaveID;
        json.DepartmentID = DepartmentID;
        json.File = fileData;
        obj.JSON = json;
        TransportCall(obj);
    }

    function getBase64(file) 
    {
        return new Promise(function(resolve) {
        var reader = new FileReader();
        reader.onloadend = function() {
            resolve(reader.result)
        }
        reader.readAsDataURL(file);
        });
    }


    function onSuccess(rc) 
    {
        if (rc.return_code) {
            switch (rc.Page_key) {
                case "getallLeaveList":
                    loaddata(rc.return_data);
                    break;
                default:
                    notify('warning',rc.Page_key);
            }
        } else {
            toastr.error(rc.return_data);
        }
    }


    function loaddata(data) 
    {
        console.log(data);

        var table = $("#tblData");
        try {
            if ($.fn.DataTable.isDataTable($(table))) {
                $(table).DataTable().destroy();
            }
        } catch (ex) {}
        var text = "";
        if (data.length == 0) {
            text += "No Data Found";
        } else {
            for (let i = 0; i < data.length; i++) {
                text += '<tr> ';
                
                text += '<td>  '+(data[i].isApproved == 1 ? "<span class='badge badge-success'>Approved</span>" : "<span class='badge badge-danger'>Not Approved</span>") +' '+ (data[i].isRejected==1 ? "<span class='badge badge-danger'>Rejected</span>" : "<span class='badge badge-success'>Accept</span>") +' <span style="float:right;">'+ (data[i].isUrgent == 1 ? " <span class='badge badge-danger'>Urgent </span>" : " <span class='badge badge-info'>Not Urgent</span>")+'</span> <br>';
                // text +=  (data[i].isRejected==1 ? "<span class='badge badge-danger'>Rejected</span>" : "<span class='badge badge-info'>Accept</span>" ) + ' </span> <br></b>';
                text +=  'Requested By : &nbsp; <b>'+ data[i].StaffName + ' <small class="badge badge-info" >' + data[i].CreatedDateTime + ' </small></b>';
                text += ' <small> <br> From : <b>' + data[i].RequestedDateFrom + ' </b> To : <b>' + data[i].RequestedDateTo + '</b></small>';
                text +='<br>  <u>Reason : </u> <br> <span>  '+ data[i].LeaveRemarks+' </span>';
                //check for Leave request doc
                // data[i].LeaveDocumentIDs!=null || data[i].LeaveDocumentIDs!=''

                if(data[i].LeaveDocumentIDs==null || data[i].LeaveDocumentIDs=='')
                {
                    
                }
                else
                {
                    leaverequestPath=data[i].LeaveRequestPath.split(',');
                    for(k=0;k<leaverequestPath.length;k++)
                    {
                        if(leaverequestPath[k])
                        text += ' <br><a href=file?type=document&name=' + leaverequestPath[k] + ' target="_blank" title="VIEW DOCUMENT" class="link-black text-sm mr-4"><i class="fas fa-paperclip mr-1"></i>View Document</a>';
                    }
                }
                text += '</td>';
                text += '<td>';
                text += (data[i].isApproved == 1 ? "<span class='badge badge-success'>Approved</span>" : "<span class='badge badge-danger'>Not Approved</span>");
                text += "&nbsp; "+ (data[i].isRejected == 1 ? "<span class='badge badge-danger'>Rejected</span>" : "<span class='badge badge-success'>Not Rejected</span>");
                text +='<br> Process By :  &nbsp; <b>' + data[i].ProcessByName + '</b> <small class="badge badge-info">' + data[i].ProcessDateTime +'</small>';
                text +='<br> <small> Approved From : <b>' + data[i].ApprovedDateFrom + '</b> To : <b>' + data[i].ApprovedDateTo + '</b></small>';
                text +='<br> <u>Remarks : </u> <br>' + data[i].Remarks;
                // if(data[i].ProcessDocumentIDs!=null ||  data[i].LeaveDocumentIDs!='')
                if(data[i].ProcessDocumentIDs==null ||  data[i].ProcessDocumentIDs=='')
                {

                }
                else
                {
                    //split based on , into array then view
                    DocPath=data[i].DocumentPath.split(',');
                    for(j=0;j<DocPath.length;j++)
                    {
                        text += ' <br><a href=file?type=document&name=' + DocPath[j] + ' target="_blank" title="VIEW DOCUMENT" class="link-black text-sm mr-4"><i class="fas fa-paperclip mr-1"></i>View Document</a>';
                    }
                }
                text += '</td>';
                text += '</tr >';
            }
        }
        $("#tblData tbody").html("");
        $("#tblData tbody").append(text);

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

    function onApproved(data)
    {
        data = JSON.parse(unescape(data));
        $("#sdate").val(data.RequestedDateFrom);
        $("#edate").val(data.RequestedDateTo);
        StaffID=data.StaffID; 
        LeaveID=data.LeaveID;
        DepartmentID=data.DepartmentID;
        $("#mdlAdd").modal('show');
    }

    function onDecline(data)
    {
        LeaveID=data;
        $("#mdDecline").modal('show');
    }

    $("#Declinerequest").click(function(){
        var obj = {};
        obj.Module = "Staff";
        obj.Page_key = "declineleaveRequest"; 
        var json = {};
        json.Remarks =$("#declineRemarks").val();
        json.LeaveID =LeaveID;
        obj.JSON = json;
        TransportCall(obj); 
    });

   


</script>