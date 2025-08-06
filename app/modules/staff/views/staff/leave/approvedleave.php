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
                                <strong>Approved Leave List</strong>
                            </div>
                        </div>
                        <div class="card-body">
                            <div style="overflow:auto; width:100%">
                                <table id="tblData" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Staff Name</th>
                                            <th scope="col">Approved From Date</th>
                                            <th scope="col">Approved To Date</th>
                                            <th scope="col">No of Days</th>
                                            <th scope="col">Actions</th>
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

<script>
    $(function() {
        getAllApprovedLeaves(); //both reject/approved

    });

    //
    function getAllApprovedLeaves() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getAllApprovedLeaves";
        obj.JSON = {};
        TransportCall(obj);
    }

    function onSuccess(rc) {
        if (rc.return_code) {
            switch (rc.Page_key) {
                case "getAllApprovedLeaves":
                    loaddata(rc.return_data);
                    break;
                case "onCancelApprovedLeave":
                    notify("success", rc.return_data);
                    getAllApprovedLeaves();
                    break;

                default:
                    notify('warning', rc.Page_key);
            }
        } else {
            toastr.error(rc.return_data);
        }
    }


    function loaddata(data) {
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

                text += '<td> ' + data[i].StaffName + '</td>';
                text += '<td> ' + data[i].ApprovedDateFrom + '</td>';
                text += '<td> ' + data[i].ApprovedDateTo + '</td>';
                text += '<td> ' + data[i].NoOfDays + '</td>';
                text += '<td class="btn-group btn-group-sm">';
                text += ' <a class="btn btn-info btn-sm text-white" onclick="onCancel(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fa fa-times" aria-hidden="true"></i> </a>';
                // text += ' <a class="btn btn-danger btn-sm text-white" onclick="onDecline(' + data[i].LeaveID + ')"> <i class="fa fa-times" aria-hidden="true"></i> </a>';
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

    function onCancel(data) {
        debugger;
        data = JSON.parse(unescape(data));
        console.log(data);
        var LeaveApprovedID = data.LeaveApprovedID;
        var LeaveID = data.LeaveID;
        let obj = {};
        var json = {};
        obj.Module = "Staff";
        obj.Page_key = "onCancelApprovedLeave";
        json.LeaveApprovedID = LeaveApprovedID;
        json.LeaveID = LeaveID;
        obj.JSON = json;
        TransportCall(obj);
    }



    function onApproved(data) {
        data = JSON.parse(unescape(data));
        $("#sdate").val(data.RequestedDateFrom);
        $("#edate").val(data.RequestedDateTo);
        StaffID = data.StaffID;
        LeaveID = data.LeaveID;
        LeaveTypeID = data.LeaveTypeID;
        DepartmentID = data.DepartmentID;
        NoOfDaysByLeaveTypeID = data.NoOfDaysByLeaveTypeID;
        $("#mdlAdd").modal('show');
    }
</script>