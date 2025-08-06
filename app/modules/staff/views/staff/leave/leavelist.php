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

    .small {
        font-size: 10px;
        /* Adjust the font size as needed */
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
</style>
<div class="content-wrapper" id="maincontent">
    <br>
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <!-- <h1>Widgets</h1> -->
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                    <li class="breadcrumb-item active">All Staff Leaves</li>
                </ol>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div id="cardContainer" class="row">
                <!-- Cards will be dynamically appended here -->
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
    var notice_details, notice_id, title, sdate, edate, type;
    var add_files = 0;

    var StaffID, LeaveID, DepartmentID;

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
    function getallLeaveList() {
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
            notify('warning', e);
        }
    }

    //add notice
    async function saveAddFormData() {
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

    function getBase64(file) {
        return new Promise(function(resolve) {
            var reader = new FileReader();
            reader.onloadend = function() {
                resolve(reader.result)
            }
            reader.readAsDataURL(file);
        });
    }


    function onSuccess(rc) {
        if (rc.return_code) {
            switch (rc.Page_key) {
                case "getallLeaveList":
                    loaddata(rc.return_data);
                    console.log(rc.return_data);
                    break;
                default:
                    notify('warning', rc.Page_key);
            }
        } else {
            toastr.error(rc.return_data);
        }
    }

    function loaddata(data) {
        var container = $("#cardContainer");

        // Clear existing content in the container
        container.html("");

        if (data.length === 0) {
            container.append("No Data Found");
        } else {
            for (let i = 0; i < data.length; i++) {
                var randomColor = getRandomGradientColor();
                // Create a card for each record
                var card = $('<div class="col-md-4">' +
                    '<div class="card card-widget widget-user shadow">' +
                    '<div class="widget-user-header" style="background: ' + randomColor + ';">' +
                    '<p class="widget-user-username" style="color:white;">' + data[i].StaffName + '</p>' +
                    '</div>' +
                    '<div class="widget-user-image">' +
                    '<img class="img-circle elevation-2" src="https://img.freepik.com/free-psd/young-businessman-3d-cartoon-avatar-portrait_627936-22.jpg?t=st=1711449005~exp=1711452605~hmac=65079543c8b5b0dec3a4f8938e66b3ca7f38e501f481cc1cae01c2ad45acd9e7&w=740" alt="User Avatar">' +
                    // '<i class="fas fa-globe"></i><br>'+
                    '<br>' +
                    // '<p>Staff Name: ' + data[i].StaffName + '</p>' +
                    '<br>' +
                    '</div>' +
                    '<div class="card-footer">' +
                    '<div class="row">' +
                    '<div class="col-sm-4 border-right">' +
                    '<div class="description">' +
                    '<i>Status</i>&nbsp;' +
                    '<span class="description-text small">' + (data[i].isApproved == 1 ? '<i class="fas fa-check-circle text-success fa-2x"></i>' : (data[i].isApproved == 0 ? '<i class="fas fa-times-circle text-danger fa-2x"></i>' : '<i class="fas fa-exclamation-circle text-warning fa-2x"></i>')) + '</span>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-sm-4 border-right">' +
                    '<div class="description-block">' +
                    '<i class="fas fa-user"></i>&nbsp;&nbsp;' +
                    '<p style="font-size: 13px;">' + (data[i].ProcessByName == null ? '<p>Not Found</p>' : data[i].ProcessByName) + '</p>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-sm-4">' +
                    '<div class="description-block">' +
                    '<i class="fas fa-comment text-info"></i><br>' +
                    '<p style="font-size: 13px;">' + (data[i].Remarks == null ? '<p>Not Found</p>' : data[i].Remarks) + '</p>' +
                    '</div>' +
                    '</div>' +
                    '<i class="far fa-calendar-alt text-success"></i>&nbsp;&nbsp;' +
                    '<p style="font-size: 13px;color:black;">' + data[i].RequestedDateFrom + '</p>&nbsp;&nbsp;' +
                    '<i class="far fa-calendar-times text-warning"></i>&nbsp;&nbsp;' +
                    '<p style="font-size: 13px;color:black;">' + data[i].RequestedDateTo + '</p>' +
                    '</div>' +
                    '<i class="fas fa-file-pdf text-danger"></i>&nbsp;&nbsp;' +
                    '<span class="description-text small">' +
                    (data[i].LeaveDocumentIDs == null ?
                        '' :
                        (data[i].LeaveDocumentIDs == '' ?
                            '' :
                            (function() {
                                let text = '';
                                let leaverequestPath = data[i].LeaveRequestPath.split(',');
                                for (let k = 0; k < leaverequestPath.length; k++) {
                                    if (leaverequestPath[k]) {
                                        text += ' <br><a href=file?type=document&name=' + leaverequestPath[k] + ' target="_blank" title="VIEW DOCUMENT" class="link-black text-sm mr-4">View Document</a>';
                                    }
                                }
                                return text;
                            })()
                        )
                    ) +
                    '</span>' +
                    '</div>' +
                    '</div>' +
                    '<div class="card-footer text-center">' +
                    // '<a href="#"  class="custom-btn1" title="Move to leads" onclick="onEdit(\'' + escape(JSON.stringify(data[i])) + '\')">Move To Leads</a>&nbsp;&nbsp;' +
                    // '<a href="#" class="custom-btn" target="_blank" onclick="onviewResponse(' + data[i].ClientID + ' ,' + flag + ')">Read more</a>' +
                    '</div>' +
                    '</div>' +
                    '</div>');

                // Append the card to the container
                container.append(card);
            }
            // Show the hidden table and initialize DataTables on it
            // $('#dataTable').show().DataTable({
            //     paging: true,
            //     pageLength: 10,
            //     searching: false,
            //     info: false
            // });
        }
    }


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


    function onApproved(data) {
        data = JSON.parse(unescape(data));
        $("#sdate").val(data.RequestedDateFrom);
        $("#edate").val(data.RequestedDateTo);
        StaffID = data.StaffID;
        LeaveID = data.LeaveID;
        DepartmentID = data.DepartmentID;
        $("#mdlAdd").modal('show');
    }

    function onDecline(data) {
        LeaveID = data;
        $("#mdDecline").modal('show');
    }

    $("#Declinerequest").click(function() {
        var obj = {};
        obj.Module = "Staff";
        obj.Page_key = "declineleaveRequest";
        var json = {};
        json.Remarks = $("#declineRemarks").val();
        json.LeaveID = LeaveID;
        obj.JSON = json;
        TransportCall(obj);
    });
</script>