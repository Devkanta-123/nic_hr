<?php require_once(VIEWPATH . "/basic/header.php"); ?>
<?php require_once(VIEWPATH . "/basic/sidebar.php"); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="maincontent">
    <!-- DataTables -->
    <link rel="stylesheet" href="assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/admin/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css">
    <link href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css" rel="stylesheet" />

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                      
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-4">

                                    <input type="checkbox" id="usertype" style="width: 100%" checked data-bootstrap-switch data-on-text="Staff" data-off-text="Intern" data-off-color="success" data-on-color="info">
                                </div>
                                <div class="col-sm-4 d-none">
                                    <!-- <select id="Classes" class="form-control">
                                    </select> -->
                                </div>
                            </div>
                        </div>
                      
                        <br />
                        <div class="card-body">
                            <table id="table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Sl#</th>
                                        <!-- <th scope="col"></th> -->
                                        <th scope="col">Name & Type</th>
                                        <th scope="col">Contact Details</th>
                                        <!-- <th scope="col">Email</th> -->
                                        <th scope="col">Username</th>
                                        <th scope="col">isActive </th>
                                        <th scope="col">created Date </th>
                                        <th scope="col">Action </th>
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
    </section>
</div>


<?php require_once(VIEWPATH . "/basic/footer.php"); ?>

<!-- DataTables -->
<script src="assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="assets/admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/multiselect/2.2.9/js/multiselect.min.js" integrity="sha512-i74c9EwGHOqv7lac1ZzOUvb1eQsC97jmpnD2YHQOZET5Op8ZqJZIYuBFgGx5NWgDVTQ76qZ75MWhZJUnLDQPeQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdn.datatables.net/tabletools/2.2.2/swf/copy_csv_xls_pdf.swf"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js"></script>


<script>
    let UserID;
    let State;
    let Class;
    $(function() {
        document.title = "User(s) List";
        getUsersList(2);
        $("#usertype").bootstrapSwitch({
            onColor: "info",
            offColor: "success",
        });

        $('#multiselect').multiselect();

    });

    $("input[type=radio]").change(function() {
        //getTrainingList();
    });




    $("#usertype").bootstrapSwitch({
        onSwitchChange: function(e, state) {

            if (state) {
                State = 2;
                $('#Classes').parent().toggleClass('d-none d-block')
            } else {
                State = 3;
                $('#Classes').parent().toggleClass('d-none d-block')
            }
            getUsersList(State)
        }
    });

    // $(document).on('click', '#edit-account', function() {
    //     text = "";
    //     if ($(this).data('id') != null) {

    //         array = (String($(this).data('id'))).split(',');
    //         name = (String($(this).next().text())).split(',');
    //         if ($())
    //             for (let i = 0; i < array.length; i++) {
    //                 text += '<option value=' + array[i] + '>' + name[i] + '</option>';
    //             }
    //         $('#multiselect_to').html(text);
    //     } else if ($(this).data('id') != null) {
    //         array.push($(this).data('id'));
    //     }
    //     UserID = $(this).data('userid');
    //     $('#modal-lg').modal('show');

    // })

    var usertype = null;

    function getUsersList(id) {
        var obj = {};
        obj.Module = "Settings";
        obj.Page_key = "getUsersList";
        var json = new Object();
        usertype = id; // to use later 
        json.Usertype = id;  // pass as param 
        obj.JSON = json;
        TransportCall(obj);
    }

    function onSuccess(rc) {

        if (rc.return_code) {
            switch (rc.Page_key) {
                case "getUsersList":
                    loaddata(rc.return_data);
                    break;
                case "changeActiveStatus":
                    notify('success', rc.return_data);
                    break;
                case "onUserResetPassword":
                    notify('success', rc.return_data);
                    break;

                default:
                    notify('error', "Unable to process the request");
                    break;
            }
        } else {
            notify('error', rc.return_data);
        }
    }


    function loaddata(data) {
        var table = $("#table");
        var text = ""
        var status = 'off';
        var multipleApploginStatus = 'off';
        var multipleApploginStatusText = '';
        var statustext = '';

        var shg = 'off';
        var shgtext = '';

        for (let i = 0; i < data.length; i++) {
            text += '<tr> ';

            text += '<td> ' + (i + 1) + '</td>';
            if (data[i].UserType == 3) {
                text += '<td>  '+ data[i].Name +'<br> <span class="badge badge-info"> Intern </span> </td>';
            } else if (data[i].UserType == 2) {
                text += '<td>  '+ data[i].Name +'<br> <span class="badge badge-info"> Staff </span> </td>';
            } else {
                text += '<td> '+ data[i].Name +'<br>  <span class="badge badge-info">Admin </span> </td>';
            }

            // text +=' <td> '+  data[i].Name +' </td>';
            // text += '<td> ' + data[i].Name + (data[i].UserType == 3 && data[i].ClassSectionName != undefined ? '<br /> <i class="badge badge-warning"> ' + data[i].ClassSectionName + '</i>' : '') + '</td>';
            text += '<td> <span class="badge">' + data[i].ContactNo + '</span> <br> <span class="badge">'+  data[i].EmailID +' </span></td>';
            // text += '<td> ' + data[i].EmailID + '</td>';
            text += '<td> ' + data[i].Username + '</td>';
            // text += '<td class="text-dark"><button data-userid="' + data[i].UserID + '" data-id="' + data[i].ConnectedAccountsID + '" id="edit-account" class="btn btn-info btn-xs"><i class="fas fa-pencil"> </i></button> | <small>' + (data[i].ConnectedAccounts != null ? data[i].ConnectedAccounts : 'N/A') + '</small></td>';

            //isActive
            if (data[i].isActive == 0) {
                status = "off";
                statustext = ""
                text += '<td>   <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success"> <input type="checkbox" ' + statustext + '  class="custom-control-input" id="activestatus' + i + '" onclick="changeactivestatus(this.id,' + data[i].UserID + ')" value="' + status + '">  <label class="custom-control-label" for="activestatus' + i + '"></label> </div> </td>';
            } else {
                status = "on";
                statustext = "checked"
                text += '<td>   <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success"> <input type="checkbox" ' + statustext + '  class="custom-control-input" id="activestatus' + i + '" onclick="changeactivestatus(this.id,' + data[i].UserID + ')" value="' + status + '">  <label class="custom-control-label" for="activestatus' + i + '"></label> </div> </td>';
            }


            text += '<td> ' + new Date(data[i].CreatedDateTime).toLocaleDateString() + '</td>';
            text += ' <td class="btn-group btn-group-sm">';
            text += ' <a class="btn btn-info btn-sm text-white" title="Reset Password" onclick="onUserResetPassword(' + data[i].UserID + ',\'' + data[i].Username + '\')"> <i class="fas fa-undo"> </i> </a>';
            // text += '   <a class="btn btn-danger btn-sm text-white" onclick="onDelete(' + data[i].CallCenterID + ')"> <i class="fas fa-trash"> </i> </a>';
            // text+=' <a class="btn btn-info"  title="Update UserName" style="margin-left:5px;" onclick="onUsernameUpdate(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fas fa-edit"> </i> </a>';
            //Active login
            // text+=' <a class="btn btn-info" title="Active Login " style="margin-left:5px;" onclick="userActivity(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fas fa-eye"> </i> </a>';
            //Archive(not active login)
            // text+=' <a class="btn btn-info" title="Login Archive" style="margin-left:5px;" onclick="userArchiveLogin(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fa fa-archive"> </i> </a>';
            //send sms
            // text+='<a class="btn btn-info"  title="Sms" style="margin-left:5px;" onclick="OnsendMessage(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fa fa-envelope"> </i> </a>';

            //app Activity <i class="fa fa-tasks" aria-hidden="true"></i>
            // text+='<a class="btn btn-info"  title="App Activity Log" style="margin-left:5px;" onclick="appActivityLog(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fa fa-tasks"> </i> </a>';

            text += '</td>';

            text += '</tr >';
        }
      
        $(table).DataTable().clear();
        $(table).DataTable().destroy();
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

    var code = null;

    //change active status
    function changeactivestatus(id, UserID) {
        var status;
        if ($("#" + id).val() == "on") {
            $("#" + id).val('off');
            status = 0;
            $("#" + id).removeClass("custom-switch-off-success");
            $("#" + id).addClass("custom-switch-off-danger");
            $("#" + id).removeAttr("checked");
        } else {
            $("#" + id).val('on');
            status = 1;
            $("#" + id).removeClass("custom-switch-off-danger");
            $("#" + id).addClass("custom-switch-off-success");
            $("#" + id).attr("checked", "checked");

        }
        var obj = new Object();
        obj.Module = "Settings";
        obj.Page_key = "changeActiveStatus";
        var json = new Object();

        json.UserType = usertype;
        json.UserID = UserID;
        json.status = status;
        obj.JSON = json;
        TransportCall(obj);
    }

    function onUserResetPassword(id, u) {
        var obj = new Object();
        obj.Module = "Settings";
        obj.Page_key = "onUserResetPassword";
        var json = new Object();
        json.UserType = usertype;
        json.id = id;
        json.u = u;
        obj.JSON = json;
        TransportCall(obj);
    }

</script>