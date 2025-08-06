<!-- <style>
    .custombtn {
        background: #5e72e4;
        border-radius: 25px;
        height: 80%;
        position: absolute;
        top: 10%;
        right: 10px;
    }
</style> -->

<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Client Subscription
                            </div>
                            <br>
                            <div class="row mt-3">
                                <div class="col-6 mt-3">
                                    <select class="form-control  form-control-lg" name="" id="ClientName">
                                        <select class="form-control select2" id="ClientName" multiple></select>
                                    </select>
                                </div>
                                
                                <div class="input-group col-6 mt-3">
                                    <input type="text" id="Contact"  class="form-control  form-control-lg" placeholder="Type Mobile No..." autocomplete="off" maxlength="10">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default" id="Searchbtn">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Category</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Class / Designation</th>
                                        <th scope="col">Action</th>
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



<script>
    //validation 
    $('#Contact').keypress(function(e) {
        var charCode = (e.which) ? e.which : event.keyCode
        if (String.fromCharCode(charCode).match(/[^0-9]/g))
            return false;
    });
    $(function() {
        getClient_subscriptionById();

    });

    function getClient_subscriptionById() {

        var obj = new Object();
        obj.Module = "Client";
        obj.Page_key = "getClient_subscriptionById";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }


    //Click  Button After Press Enter Key
    var input = document.getElementById("Contact");
    var button = document.getElementById("Searchbtn");
    input.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
            button.click();
        }
    });

    $("#Searchbtn").click(function() {
        var obj = new Object();
        obj.Module = "Client";
        obj.Page_key = "getDataFromAPI";
        let json = {};
        json.ClientSubscriptionID = $("#ClientName").val();
        json.PhoneNumber = $("#Contact").val();
        obj.JSON = json;
        if ($("#ClientName").val() == '' || $("#Contact").val() == '') {
            notify("error", "Please fill all of the required fields");
            return false;
        } else {
            TransportCall(obj);
        }
    });


    function onSuccess(rc) {

        if (rc.return_code) {
            switch (rc.Page_key) {

                case "getClient_subscriptionById":
                    loadSelect("#ClientName", rc.return_data);
                    break;

                case "getDataFromAPI":
                    console.log(rc.return_data);

                    loaddata(rc.return_data);
                    break;

                case "sendotp":
                    notify("success", rc.return_data)
                    // loaddata(rc.return_data);
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
            debugger;
            for (let i = 0; i < data.length; i++) {
                text += '<tr> ';
                text += '<td>';
                if (data[i].DesignationName == null) {
                    text += 'Staff';
                } else {
                    text += data[i].DesignationName;
                }
                // text += '<td> ' + data[i].Class+ '</td>';
                text += '<td> ' + data[i].Name + '</td>';
                text += '<td> ' + data[i].Class + '</td>';
                text += '<td>';
                text += '<button class="badge bg-primary resetBtn"  id="resetBtn_' + data[i].Class + '" onclick="resetPassword(this, \'' + data[i].Class + '\')">Reset Password</button>';


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

    function resetPassword() {
        debugger;
        var obj = new Object();
        obj.Module = "Client";
        obj.Page_key = "sendotp";
        let json = {};
        json.ClientSubscriptionID = $("#ClientName").val();
        json.PhoneNumber = $("#Contact").val();
        obj.JSON = json;
        TransportCall(obj);
        $('#table').on('click', '.resetBtn', function() {
            $(this).hide();
        });

    }
</script>