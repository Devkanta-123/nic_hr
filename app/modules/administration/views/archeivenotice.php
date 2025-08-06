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
                                <strong>Archeive</strong>
                            </div>
                            <div class="modal fade" id="mdlView">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title d-flex justify-content-center">News Details</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form id="frmEdit">
                                            <div class="modal-body">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-4 col-lg-4">
                                                            <div class="form-group">
                                                                <label for="title1">Title</label>
                                                                <input id="title1" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 col-lg-4">
                                                            <div class="form-group">
                                                                <label for="sdate1">Start Date</label>
                                                                <input id="sdate1" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 col-lg-4">
                                                            <div class="form-group">
                                                                <label for="edate1">End Date</label>
                                                                <input id="edate1" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style="overflow:auto; width:100%">
                                                        <table id="tblNewsDetails" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Type</th>
                                                                    <th scope="col">Title</th>
                                                                    <th scope="col">Access</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="row" id="div_notices" style="display:none;">
                                <div class="col-6">
                                    <div class="info-box" style="background-color:#edfbfd;">
                                        <div class="info-box-content">
                                        <span class="info-box-number text-left text-muted mb-2">Independence Day Celeration in the School Campus</span>
                                        <!-- <span class="info-box-text text-left text-muted mb-2">Added By - Mr. Khanna</span> -->
                                        <p class="mb-2">
                                            <a href="#" class="link-black text-sm mr-4"><i class="fas fa-paperclip mr-1"></i>File 1</a>
                                            <a href="#" class="link-black text-sm mr-4"><i class="fas fa-paperclip mr-1"></i>File 2</a>
                                        </p>
                                        <p class="mb-0">
                                            <a href="#" class="link-black text-sm mr-4"><i class="fas fa-external-link mr-1"></i>Link</a>
                                        </p>
                                        <span class="info-box-text text-right text-muted text-sm"><i>Added By - Mr. Khanna</i></span>
                                        <span class="info-box-text text-right text-muted text-sm"><i>Added On - 05/08/2022</i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="overflow:auto; width:100%">
                                <table id="tblData" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Title</th>
                                            <th scope="col">Start Date</th>
                                            <th scope="col">End Date</th>
                                            <th scope="col">File(s)/ Link(s)</th>
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

<script>

    
    var students, notice_details, notice_id, title, sdate, edate, type;

    var add_files=add_links=0;

    var applicable=2, is_all=1, cls = [];

    $('.bootstrapToggle').bootstrapToggle();

    $(function() {
        getArcheiveNotice();
    });

    $("#sdate").on('change', function()
    {
        $('#edate').datepicker('option', 'minDate', new Date($("#sdate").val()));
    });
    $("#sdate1").on('change', function()
    {
        $('#edate1').datepicker('option', 'minDate', new Date($("#sdate1").val()));
    });

    $('#applicable').on('change', function(){
        applicable = $('#applicable').val();
        if(applicable=='3'){
            $('#div_notify').hide();
            $('#isAll').prop('checked', 'true').change();
        }
        else{
            $('#div_notify').show();
            $('#isAll').prop('checked', 'true').change();
        }
    });

    $('#add_files').on('change', function ()
    {
        if ($('#add_files').prop('checked'))
        {
            add_files = 1;
            $('.file_title').val('');
            $('.dropify-clear').click();
            $('#div_files').show();
        }
        else
        {
            add_files = 0;
            $('#div_files').hide();
        }
    });

    $('#add_links').on('change', function ()
    {
        if ($('#add_links').prop('checked'))
        {
            add_links = 1;
            $('.link_title').val('');
            $('.link').val('');
            $('#div_links').show();
        }
        else
        {
            add_links = 0;
            $('#div_links').hide();
        }
    });
    
    $('#tblData').on('click', 'tbody tr td button', function ()
    {
        notice_id = $(this).attr('data-notice_id');
        title = $(this).attr('data-title');
        sdate = $(this).attr('data-sdate');
        edate = $(this).attr('data-edate');

        $("#title1").val(title);
        $("#sdate1").val(sdate);
        $("#edate1").val(edate);

        let obj = {};
        let json = {};

        obj.Module = "Administration";
        obj.Page_key = "getNoticeDetails";

        json.NoticeID = notice_id;

        obj.JSON = json;
        TransportCall(obj);
        $("#mdlView").modal("show");
    });

    function addRowFiles() 
    {
        if ($('#tblFiles tbody tr').length < 5)
        {
        $("#tblFiles").append($('#tblFiles tbody tr:last').clone());
        $('#tblFiles tbody tr:last').each(function(row, tr)
        {
            $(tr).find('td').eq(1).prop('innerHTML', '');
            $(tr).find('td').eq(1).append('<input type="text" id="file_title'+$('#tblFiles tbody tr').length+'" class="form-control file_title" placeholder="Eg. ACADEMIC CALENDAR" maxlength="99" autocomplete="off"/>');
            $(tr).find('td').eq(2).prop('innerHTML', '');
            $(tr).find('td').eq(2).append('<input type="file" id="file'+$('#tblFiles tbody tr').length+'" accept="image/*,.pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx" class="dropify file" data-height="100"/>');
            $('.dropify').dropify();
        });
        }
        else
        {
            toastr.info('Only 5 Files can be attached !!');
        }
    }
    function deleteRowFiles() 
    {
        try 
        {
            var table = document.getElementById('tblFiles');
            var rowCount = table.rows.length;
            for(var i=0; i<rowCount; i++) 
            {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if(null != chkbox && true == chkbox.checked) 
                {
                    if(rowCount <= 2) 
                    {					
                        break;
                    }
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }
            }
        }
        catch(e) 
        {
            notify('warning',e);
        }
    }
    function addRowLinks() 
    {
        if ($('#tblLinks tbody tr').length < 5)
        {
            $("#tblLinks").append($('#tblLinks tbody tr:last').clone());
            $('#tblLinks tbody tr:last').each(function(row, tr)
            {
                $(tr).find('td').eq(1).prop('innerHTML', '');
                $(tr).find('td').eq(1).append('<input type="text" id="link_title'+$('#tblLinks tbody tr').length+'" class="form-control link_title" placeholder="Eg. SCHOOL WEBSITE" maxlength="99" autocomplete="off"/>');
                $(tr).find('td').eq(2).prop('innerHTML', '');
                $(tr).find('td').eq(2).append('<input type="text" id="link'+$('#tblLinks tbody tr').length+'" class="form-control link" placeholder="Eg. http://www.anthonianshillong.org/" maxlength="99" autocomplete="off"/>');
                $('.dropify').dropify();
            });
        }
        else
        {
            toastr.info('Only 5 Links can be attached !!');
        }
    }
    function deleteRowLinks() 
    {
        try 
        { 
            var table = document.getElementById('tblLinks');
            var rowCount = table.rows.length;
            for(var i=0; i<rowCount; i++) 
            {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if(null != chkbox && true == chkbox.checked) 
                {
                    if(rowCount <= 2) 
                    {					
                        break;
                    }
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }
            }
        }
        catch(e) 
        {
            notify('warning',e);
        }
    }

    function getArcheiveNotice()
    {
        let obj = {};
        obj.Module = "Administration";
        obj.Page_key = "getArcheiveNotice";
        obj.JSON = {};
        TransportCall(obj);
    }

    function onSuccess(rc) 
    {
        if (rc.return_code) {
            switch (rc.Page_key) 
            {
                case "getArcheiveNotice":
                    notice_details = rc.return_data.notice_details;
                    loaddata(rc.return_data.notices);
                    break;

                case "getNoticeDetails":
                    if(rc.return_data.length>0)
                        loaddata1(rc.return_data);
                    else
                        $('#tblNewsDetails').hide();
                    break;

                default:
                    notify('warning',rc.Page_key);
            }
        } else {
            toastr.error(rc.return_data);
        }
    }

    function loaddata(data) {
        var table = $("#tblData");
        var div_notices = '';

        try {
            if ($.fn.DataTable.isDataTable($(table))) {
                $(table).DataTable().destroy();
            }
        } catch (ex) {}

        var text = ""
        if (data.length > 0) 
        {
            for (let i = 0; i < data.length; i++) 
            {
                div_notices += '<div class="col-6">';
                div_notices += '<div class="info-box" style="background-color:#edfbfd;">';
                div_notices += '<div class="info-box-content">';
                div_notices += '<span class="info-box-number text-left text-muted mb-2">'+data[i].Title+'</span>';
                if(data[i].hasFiles==1){
                    div_notices += '<p class="mb-2">';
                    for(let j=0; j<notice_details.length; j++)
                    {
                        if(notice_details[j].NoticeID==data[i].NoticeID && notice_details[j].TypeID=='1'){
                            div_notices += '<a href=' + notice_details[j].FileLink + ' target="_blank" title="VIEW DOCUMENT" class="link-black text-sm mr-4"><i class="fas fa-paperclip mr-1"></i>'+notice_details[j].Title+'</a>';
                        }
                    }
                    div_notices += '</p>';
                }
                if(data[i].hasLinks==1)
                {
                    div_notices += '<p class="mb-0">';
                    for(let j=0; j<notice_details.length; j++)
                    {
                        if(notice_details[j].NoticeID==data[i].NoticeID && notice_details[j].TypeID=='2')
                        {
                            var lnk = url ='';
                            if(notice_details[j].FileLink.substring(0, 8)=='https://'){
                                lnk=notice_details[j].FileLink.split('https://');
                                url = lnk[1];
                            }
                            else if(notice_details[j].FileLink.substring(0, 7)=='http://'){
                                lnk=notice_details[j].FileLink.split('http://');
                                url = lnk[1];
                            }
                            else{
                                url=notice_details[j].FileLink;
                            }

                            div_notices += '<a href="//' + url + '" target="_blank" title="VIEW DOCUMENT" class="link-black text-sm mr-4"><i class="fas fa-external-link mr-1"></i>'+notice_details[j].Title+'</a>';
                        }
                    }
                    div_notices += '</p>';
                }
                div_notices += '<span class="info-box-text text-right text-muted text-sm"><i>Added By - '+data[i].Name+'</i></span>';
                div_notices += '<span class="info-box-text text-right text-muted text-sm"><i>Added On - '+data[i].StartDate+'</i></span>';
                div_notices += '</div>';
                div_notices += '</div>';
                div_notices += '</div>';

                text += '<tr>'; 
                text += '<td>' + data[i].Title;
                if(data[i].Description == 0)
                {
                   
                }
                else{
                    text+=' <a href="#" id="ShowDiv"> ...</a>';
                    text+=' <div id="detail" style="Display:none"> '+ data[i].Description +'</div>  ';
                }     
                text += '</td>';
                text += '<td>' + data[i].StartDate ;
                text +='</td>';
                text += '<td>' + data[i].EndDate + '</td>';
                text += '<td>';
                text += '<a href="administration-seennotice" class="btn btn-sm btn-success"> <span class="">'+data[i].isRead+' </span>  </a>';
                text += ' &nbsp; <a href="administration-notseennotice" class="btn btn-sm btn-danger"> <span class="">'+data[i].notRead+'</span>  </a>';
                text += ' &nbsp; <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#mdlView" data-notice_id="'+data[i].NoticeID+'" data-title="'+data[i].Title+'" data-sdate="'+data[i].StartDate+'" data-edate="'+data[i].EndDate+'"><i class="fa fa-eye"></i>&nbsp;<strong>VIEW</strong></button>';
                text += '</td>';
                text += '</tr >';
            }
        }
        $("#tblData tbody").html(text);
        $("#div_notices").html(div_notices);

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
                    title: document.title,
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
    
    function loaddata1(data) 
    {
        $('#tblNewsDetails').show();
        var table = $("#tblNewsDetails");

        try {
            if ($.fn.DataTable.isDataTable($(table))) {
                $(table).DataTable().destroy();
            }
        } catch (ex) {}

        var text = ""
        if (data.length > 0) {
            for (let i = 0; i < data.length; i++) 
            {
                var url;
                var lnk;
                
                text += '<tr>';

                if(data[i].TypeID=="1"){
                    text += '<td><strong>File</strong></td>';
                    text += '<td>' + data[i].Title + '</td>';
                    text += '<td><a href=' + data[i].FileLink + ' target="_blank">View/Download</a></td>';
                }
                else{
                    if(data[i].FileLink.substring(0, 8)=='https://'){
                        lnk=data[i].FileLink.split('https://');
                        url = lnk[1];
                    }
                    else if(data[i].FileLink.substring(0, 7)=='http://'){
                        lnk=data[i].FileLink.split('http://');
                        url = lnk[1];
                    }
                    else{
                        url=data[i].FileLink;
                    }
                    text += '<td><strong>Link</strong></td>';
                    text += '<td>' + data[i].Title + '</td>';
                    text += '<td><a href="//' + url + '" target="_blank">Open Link</a></td>';
                }
                
                text += '</tr >';
            }
        }
        $("#tblNewsDetails tbody").html(text);
    }  

   
</script>