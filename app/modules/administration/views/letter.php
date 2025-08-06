<!-- summernote -->
<link rel="stylesheet" href="assets/admin/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.css">
<link rel="stylesheet" href="assets/admin/plugins/bootstrap-toggle-master/css/bootstrap-toggle.min.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">


<!-- Content Wrapper. Contains page content -->
<style>
    .position-relative {
        position: relative;
    }

    .plus-sign {
        position: absolute;
        top: 5px;
        /* Adjust vertical position */
        right: -35px;
        /* Adjust horizontal position */
        transform: translate(-50%, -50%);
        font-size: 14px;
        /* Adjust the size as needed */
        color: white;
        /* Adjust color as needed */
        background-color: #007bff;
        /* Adjust background color as needed */
        border-radius: 50%;
        /* Makes the plus sign rounded */
        width: 25px;
        /* Adjust width of the plus sign */
        height: 25px;
        /* Adjust height of the plus sign */
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }

    .right.modal.fade .modal-dialog {
        -webkit-transform: translateX(100%);
        -moz-transform: translateX(100%);
        -ms-transform: translateX(100%);
        -o-transform: translateX(100%);
        transform: translateX(100%);
    }

    .right.modal.fade .modal-dialog {
        -webkit-transform: translate(-60%, 50%) translateX(100%);
        -moz-transform: translate(-60%, 50%) translateX(100%);
        -ms-transform: translate(-60%, 50%) translateX(100%);
        -o-transform: translate(-60%, 50%) translateX(100%);
        transform: translate(-60%, 50%) translateX(100%);
        animation: zoomIn 0.5s ease forwards;
    }

    @keyframes zoomIn {
        0% {
            transform: scale(0);
        }

        100% {
            transform: scale(1);
        }
    }
</style>
<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <span class="float-right">
                                <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#mdlAdd"><i class="fa fa-plus"></i>&nbsp;<strong>ADD</strong></button>
                                <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal-AllLetters"><i class="fa fa-archive text-white"></i>&nbsp;</button>
                                <!-- <a class="btn btn-xs btn-success"><i class="fa fa-archive text-white"></i>&nbsp;</a> -->
                                <!-- <a href="administration-archeivenotice" class="btn"> <i class="fa fa-archive" aria-hidden="true"></i></a> -->
                            </span>
                            <span class=" row">

                                <!-- <div class="col-md-3">
                                    <select class="form-control" id="months">
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div> -->



                            </span>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="loadletterstable" class="table table-bordered table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">Letter Type</th>
                                        <!-- <th scope="col">To/From</th> -->
                                        <!-- <th scope="col">For Whom</th> -->
                                        <th scope="col">Docs</th>
                                        <th scope="col">Letter No</th>
                                        <th scope="col">Action</th>
                                    </tr>

                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                   


                        <!-- Modal -->

                        <div class="modal fade" id="mdlAdd">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="col-md-3"> Letter :
                                            <input type="checkbox" id="isLetter" style="width: 70%" checked data-bootstrap-switch data-on-text="IN" data-off-text="OUT" data-off-color="danger" data-on-color="success">
                                        </div>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <form id="frmAdd">
                                        <div class="modal-body">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-3 col-md-4 col-lg-4">
                                                        <div class="form-group row">
                                                            <!-- Added button with Bootstrap classes for styling -->

                                                            <label class="col-sm-4 col-form-label required">Letter Type</label>
                                                            <div class="col-sm-7">
                                                                <select class="form-control" name="letterTypeID" id="letterTypeID">
                                                                </select>
                                                                <span class="plus-sign" onClick="showModal()">&#43;</span> <!-- Plus sign icon -->
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3 col-md-4 col-lg-4">
                                                        <div class="form-group row" id="titleContainer">
                                                            <label class="col-sm-4 col-form-label required" id="titleLabel">From :</label>
                                                            <div class="col-sm-8">
                                                                <input id="title" name="title" class="form-control" type="text">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3 col-md-4 col-lg-4">
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 col-form-label required">Place :</label>
                                                            <div class="col-sm-8">
                                                                <input id="Place" name="" class="form-control" type="text" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3 col-md-4 col-lg-4">
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 col-form-label required">Letter No :</label>
                                                            <div class="col-sm-8">
                                                                <input id="LetterNo" name="LetterNo" class="form-control" type="text" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 col-md-4 col-lg-4">
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 col-form-label required">Letter Date :</label>
                                                            <div class="col-sm-8">
                                                                <input id="LetterDate" value=<?php echo date("Y-m-d");?>  name="LetterDate" class="form-control" type="date" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3 col-md-4 col-lg-4">
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 col-form-label required">For Whom :</label>
                                                            <div class="col-sm-8">
                                                                <input id="ForWhom" name="" class="form-control" type="text" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                                        <div class="form-group">
                                                            <label class="required" for="Remarks">Remarks</label>
                                                            <input id="Remarks" name="Remarks" class="form-control" type="text" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 pr-4">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <input type="file" id="input-files" class="dropify" data-height="100" style="width: 2000px;" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success btn-xs">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal fade right" id="addLetterTypeModal"  tabindex="-1" aria-labelledby="addLetterTypeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addLetterTypeModalLabel">Add Letter Types</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="letterType" class="col-form-label">Letter Type:</label>
                                                    <input type="text" class="form-control" id="letterTypeName">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-xs" onclick="closeModal()">Close</button>
                                                <button type="button" class="btn btn-primary btn-xs" id="btn-addLetterType">Save </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <div class="modal fade" id="modal-AllLetters">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="col-md-3">Archive Letters
                                        </div>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="card-body">
                                            <table id="loadArchieveLetters" class="table table-bordered table-striped mt-3" width=100%>
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Letter Type</th>
                                                        <th scope="col">Docs</th>
                                                        <th scope="col">Letter No</th>
                                                        <!-- <th scope="col">Action</th> -->
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
<script src="assets/admin/plugins/summernote/summernote-bs4.min.js"></script>
<script src="assets/admin/plugins/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>
<script src="assets/admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

<script>
    function showModal() {
        $("#addLetterTypeModal").modal("show");
        // $("#mdlAdd").modal("hide");
    }
    function closeModal()
    {
        $("#addLetterTypeModal").modal("hide");
    }


    $(document).ready(function() {
        $('.dropify').dropify();
    });

    $(function() {
        getAllLetterType();
        getAllActiveLetters();
        getAllArchivedLetters();
        $("#isLetter").bootstrapSwitch({
            size: "small",
            onColor: "success",
            offColor: "danger",
        });
        // $('#isAll').on('change', function() {}
        $('#isLetter').on('switchChange.bootstrapSwitch', function(event, state) {
            var titleLabel = $("#titleLabel");
            if ($("#isLetter").is(':checked')) {
                titleLabel.text("From :"); // Change title to "From"
            } else {
                titleLabel.text("To :"); // Change title to "To"
            }
        });

    });


    $("#btn-addLetterType").click(function() {
        debugger;
        let obj = {};
        let json = {};
        obj.Module = "Administration";
        obj.Page_key = "addLetterType";
        var letterTypeName = $("#letterTypeName").val();
        json.LetterTypeName = letterTypeName;
        obj.JSON = json;
        if (letterTypeName == '') {
            notify("error", "Please Enter Letter Type");
        } else {

            SilentTransportCall(obj);
        }


    });

    $('#frmAdd').submit(function() {
        saveAddFormData();
        return false;
    });




    async function saveAddFormData() {
        debugger;
        let obj = {};
        let json = {};
        var fileData = {};
        obj.Module = "Administration";
        obj.Page_key = "addLetter";
        json.LetterTypeID = $("#letterTypeID").val();
        json.From = $("#title").val();
        json.To = $("#title").val();
        json.Place = $("#Place").val();
        json.LetterNo = $("#LetterNo").val();
        json.LetterDate = $("#LetterDate").val();
        json.ForWhom = $("#ForWhom").val();
        json.Remarks = $("#Remarks").val();
        var files = $('#input-files')[0].files;

        // Get base64 data for the first file only
        if (files.length > 0) {
            var base64Data = await getBase64(files[0]);
            // Add base64 data to fileData
            fileData = {
                filedata: base64Data,
                filename: files[0].name
            };
        }

        // Add fileData to the JSON object
        json.File = fileData;
        obj.JSON = json;
        TransportCall(obj);

        // Now you can use the JSON object as needed
    }

    // Function to convert file to base64
    function getBase64(file) {
        return new Promise((resolve, reject) => {
            let reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function() {
                resolve(reader.result);
            };
            reader.onerror = function(error) {
                reject(error);
            };
        });
    }




    function getAttendanceYear() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getAttendanceYear";
        let json = {};
        obj.JSON = json;
        TransportCall(obj);
    }

    $("#onGetAttendance").click(function() {
        if ($("#isLetter").is(':checked')) {
            getIndividualStaffAttendancebyMonth($("#months").val());
        } else {
            getIndividualStaffAttendancebyYear($("#years").val());
        }
    });


    //by default get by month(january)

    //on change of month 
    $("#months").change(function() {
        getIndividualStaffAttendancebyMonth($("#months").val());
    });

    //get the attendance based on selected month
    function getAllLetterType() {
        let obj = {};
        obj.Module = "Administration";
        obj.Page_key = "getAllLetterType";
        let json = {};
        obj.JSON = json;
        SilentTransportCall(obj);
    }

    function getAllActiveLetters() {
        let obj = {};
        obj.Module = "Administration";
        obj.Page_key = "getAllActiveLetters";
        let json = {};
        obj.JSON = json;
        SilentTransportCall(obj);
    }

    function getAllArchivedLetters() {
        debugger;
        let obj = {};
        obj.Module = "Administration";
        obj.Page_key = "getAllArchivedLetters";
        let json = {};
        obj.JSON = json;
        SilentTransportCall(obj);
    }


    //get by year
    function getIndividualStaffAttendancebyYear(year) {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getIndividualStaffAttendancebyYear";
        let json = {};
        json.Year = year;
        json.StaffID = id;
        obj.JSON = json;
        TransportCall(obj);
    }




    function onSuccess(rc) {

        if (rc.return_code) {
            switch (rc.Page_key) {

                case "addLetter":
                    notify("success", rc.return_data);
                    getAllActiveLetters();
                    $("#mdlAdd").modal('hide');
                    break;
                case "addLetterType":
                    notify("success", rc.return_data);
                    getAllLetterType();
                    $("#addLetterTypeModal").modal('hide');
                    break;
                case "getAllLetterType":
                    loadSelect("#letterTypeID", rc.return_data);
                    break;
                case "getAllActiveLetters":
                    loadLetters(rc.return_data);
                    break;

                case "getAllArchivedLetters":
                    loadArchiveLetters(rc.return_data);
                    break;


                case "archieveLetter":
                    notify("success", rc.return_data);
                    getAllActiveLetters();
                    break;

                default:
                    notify("error", rc.Page_key);
            }
        } else {
            notify("error", rc.return_data);
        }
    }

    function loadLetters(data) {
        var table = $("#loadletterstable");
        try {
            if ($.fn.DataTable.isDataTable($(table))) {
                $(table).DataTable().destroy();
            }
        } catch (ex) {}

        var text = ""

        if (data.length === 0) {
            text += "No Data Found";
        } else {

            for (let i = 0; i < data.length; i++) {

                text += '<tr> ';
                text += '<td> ' + data[i].LetterType + '</td>';
                // text += '<td> ' + (data[i].Status == 0 ? "<span class='badge badge-sm badge-danger'>Absent</span>" : "<span class='badge badge-sm badge-success'>Present</span>") + '</td>';
                // text += '<td>  To : ' + (data[i].To == null ? "<span class='badge badge-sm badge-danger'>NA</span>" : " <b> " + data[i].To + " </b>");
                // text += "From : " + (data[i].From == null ? "<span class='badge badge-sm badge-danger'>NA</span>" : "<b>" + data[i].From + "</b>") + '</td>';
                if (data[i].LetterDocumentID==null){
                    text += '<td> <span class="badge badge-danger">No Document</span> </td>';
                }
                else{
                    // text += '<td> <a href="' + data[i].LetterDocumentID + '" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-download"></i> Download</a> </td>';
                    text += '<td><a href=file?type=letters&name=' + data[i].DocumentPath + ' target="_blank" title="VIEW DOCUMENT" class="link-black text-sm mr-4"><i class="fas fa-file-pdf text-danger"></i></a></i>';

                }
                text += '<td> ' + data[i].LetterNo + ' </td>';
                text += '<td class="btn-group btn-group-sm">';
                text += ' <a class="btn btn-info btn-sm text-white" onclick="Archived(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fa fa-trash" aria-hidden="true"></i> </a>';
                // text += ' <a class="btn btn-danger btn-sm text-white" onclick="onDecline(' + data[i].LeaveID + ')"> <i class="fa fa-times" aria-hidden="true"></i> </a>';
                text += '</td>';
                text += '</tr >';
            }
        }

        $("#loadletterstable tbody").html("");
        $("#loadletterstable tbody").append(text);

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


    function loadArchiveLetters(data) {
        var table = $("#loadArchieveLetters");
        try {
            if ($.fn.DataTable.isDataTable($(table))) {
                $(table).DataTable().destroy();
            }
        } catch (ex) {}

        var text = ""

        if (data.length === 0) {
            text += "No Data Found";
        } else {

            for (let i = 0; i < data.length; i++) {

                text += '<tr> ';
                text += '<td> ' + data[i].LetterType + '</td>';
                // text += '<td> ' + (data[i].Status == 0 ? "<span class='badge badge-sm badge-danger'>Absent</span>" : "<span class='badge badge-sm badge-success'>Present</span>") + '</td>';
                // text += '<td>  To : ' + (data[i].To == null ? "<span class='badge badge-sm badge-danger'>NA</span>" : " <b> " + data[i].To + " </b>");
                // text += "From : " + (data[i].From == null ? "<span class='badge badge-sm badge-danger'>NA</span>" : "<b>" + data[i].From + "</b>") + '</td>';
                // text += '<td> ' + data[i].ForWhom + ' </td>';
                text += '<td> ' + data[i].ForWhom + ' </td>';
                text += '<td> ' + data[i].LetterNo + ' </td>';
                // text += '<td class="btn-group btn-group-sm">';
                // text += ' <a class="btn btn-info btn-sm text-white" onclick="Archived(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fa fa-trash" aria-hidden="true"></i> </a>';
                // text += ' <a class="btn btn-danger btn-sm text-white" onclick="onDecline(' + data[i].LeaveID + ')"> <i class="fa fa-times" aria-hidden="true"></i> </a>';
                // text += '</td>';
                text += '</tr >';
            }
        }

        $("#loadArchieveLetters tbody").html("");
        $("#loadArchieveLetters tbody").append(text);

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


    function Archived(data) {
        debugger;
        data = JSON.parse(unescape(data));
        var LetterID = data.LetterID;
        var obj = {};
        obj.Module = "Administration";
        obj.Page_key = "archieveLetter";
        var json = {};
        json.LetterID = LetterID;
        obj.JSON = json;
        SilentTransportCall(obj);

    }
</script>