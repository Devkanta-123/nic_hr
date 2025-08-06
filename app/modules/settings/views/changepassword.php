<style>
    .custombtn {
        background: white;
        border-radius: 15px;
        aspect-ratio: 1;
        height: 80%;
        position: absolute;
        top: 10%;
        right: 10px;
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
                                Client Subscription
                            </div>
                            <br>
                            <div class="row mt-3">
                                <div class="col-5 mt-3">
                                    <select class="form-control" name="" id="ClientName">
                                    </select>
                                </div>
                                <div class="col-5 mt-3">
                                    <input type="text" id="Contact" class="form-control" placeholder="Enter Contact No.." autocomplete="off" maxlength="10">
                                    <button class="custombtn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M5 12l14 0"></path>
                                            <path d="M13 18l6 -6"></path>
                                            <path d="M13 6l6 6"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="col-md-2 mt-3">
                                    <button type="button" class="btn btn-primary" id="Searchbtn">Search</button>
                                </div>
                                <!-- <div class="col-md-2 mt-3">
                                    <button type="button" class="btn btn-primary"   id="resetBtn" onclick="resetPassword()">Hide</button>
                                </div> -->

                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Class</th>
                                        <th scope="col">FatherName</th>
                                        <th scope="col">MotherName</th>
                                        <th scope="col">GuardianName</th>
                                        <th scope="col">StaffName</th>
                                        <th scope="col">DesignationName</th>
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
        TransportCall(obj);
    });

    function onSuccess(rc) {

        if (rc.return_code) {
            switch (rc.Page_key) {


                case "getClient_subscriptionById":
                    loadSelect("#ClientName", rc.return_data);

                    break;

                case "getDataFromAPI":
                    loaddata(rc.return_data);
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
                text += '<th> ' + data[i].Name + '</th>';
                text += '<td> ' + data[i].Class + '</td>';
                text += '<td> ' + data[i].FatherName + '</td>';
                text += '<td> ' + data[i].MotherName + '</td>';
                text += '<td> ' + data[i].GuardianName + '</td>';
                text += '<td> ' + data[i].StaffName + '</td>';
                text += '<td> ' + data[i].DesignationName + '</td>';
                text += '<td>';
                // text += '<button  class="btn btn-warning btn-sm text-white" id="resetBtn"  onclick="resetPassword()">Reset Password</button>';
                //  text += '<button class="btn btn-warning btn-sm text-white resetBtn" onclick="resetPassword(this)">Reset Password</button>';
                text += '<button class="btn btn-warning btn-sm text-white resetBtn" id="resetBtn_' + data[i].Class + '" onclick="resetPassword(this, \'' + data[i].Class + '\')">Reset Password</button>';

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
        obj.Page_key = "getDataFromAPI";
        let json = {};
        json.ClientSubscriptionID = $("#ClientName").val();
        json.PhoneNumber = $("#Contact").val();
        // obj.JSON = json;
        // TransportCall(obj);
        $('#table').on('click', '.resetBtn', function() {
            // Retrieve the ID associated with the clicked button
            // var rowId = $(this).closest('tr').find('td:nth-child(8)').text(); // Get the content from the 8th <td> in the row
            $(this).hide();


        });

        // $('#table').on('click', '.resetBtn', function() {
        //     $(this).hide();
        // });


    }
</script>