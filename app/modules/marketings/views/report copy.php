<!-- summernote -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.3.0/raphael.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<style>
    @keyframes wave {
        0% {
            transform: scale(1);
            opacity: 1;
        }

        50% {
            transform: scale(1.2);
            opacity: 0.5;
        }

        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    .heartbeat {
        position: absolute;
        top: 10px;
        /* Adjust the positioning as needed */
        left: 50%;
        transform: translateX(-50%);
        display: inline-block;
        width: 10px;
        /* Adjust the width as needed */
        height: 10px;
        /* Adjust the height as needed */
        background-color: green;
        /* Adjust the color as needed */
        border-radius: 50%;
        animation: wave 1.5s infinite;
        /* Adjust the duration as needed */
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Marketing Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                                <i class="far fa-bell"></i>
                                <span class="navbar-badge heartbeat"></span>
                                <!-- <span class="badge badge-warning navbar-badge">15</span> -->
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                                <span class="dropdown-item dropdown-header">15 Notifications</span>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                                    <span class="float-right text-muted text-sm">3 mins</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-users mr-2"></i> 8 friend requests
                                    <span class="float-right text-muted text-sm">12 hours</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-file mr-2"></i> 3 new reports
                                    <span class="float-right text-muted text-sm">2 days</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                            </div>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- modal -->
            <div class="modal fade" id="addFeedback">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Marketing Clients</h4>
                            <button type="button" class="close btn-danger btn-sm" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body" style=" overflow-x: auto;">
                            <div class="card-body">
                                <div class="row">
                                    <table class="table table-bordered table-striped" id="ClientData" width="100%" style="width:120%;">
                                        <thead>
                                            <th scope="col">Name</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Contact</th>
                                            <th scope="col">Enrollment</th>
                                            <th scope="col">Contact Person</th>
                                            <!-- <th scope="col">Remarks</th> -->
                                            <th scope="col">Price</th>
                                            <th scope="col">-</th>
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
            <!-- modal end -->

            <!-- Close Deal modal -->
            <div class="modal fade" id="CloseDeal">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">User who has Close the Deal</h4>
                            <button type="button" class="close btn-danger btn-sm" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body" style=" overflow-x: auto;">
                            <div class="card-body">
                                <div class="row">
                                    <table class="table table-bordered table-striped" id="ClosedealTable" width="100%" style="width:120%;">
                                        <thead>
                                            <th scope="col">Name</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Contact</th>
                                            <th scope="col">-</th>
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
            <!-- Close deal modal end -->



            <div class="row">
                <div class="col-lg-3 col-6 p-2">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3 id="LeadClose">-</h3>
                            <p>Close Deal</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-handshake"></i>
                            <!-- <i class="ion ion-bag"></i> -->
                        </div>
                        <!-- onclick="closeDealData();" -->
                        <a onclick="ShowModal(4)" class="small-box-footer">view <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6 p-2">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3 id="initialClient">-</h3>
                            <p>Initial</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" onclick="ShowModal(8)" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6 p-2">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3 id="followupClient">-</h3>
                            <p>FollowUp</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" onclick="ShowModal(3)" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6 p-2">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3 id="leadclient">-</h3>
                            <p>Lead</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" onclick="ShowModal(6)" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- today task -->
                <div class="col-md-6 p-2">
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Today Task</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" fdprocessedid="ayyf1s">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" fdprocessedid="jawyaa">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-1">
                            <div class="table-responsive">
                                <table id="TodayTask" class="table table-border m-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Client Name</th>
                                            <th scope="col">Contact</th>
                                            <th>Status</th>
                                            <th>Remarks</th>
                                            <!-- <th>Discussion</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- today visit -->
                <div class="col-md-6 p-2">
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Today Visited / Contacted Client</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" fdprocessedid="ayyf1s">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" fdprocessedid="jawyaa">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-1">
                            <div class="table-responsive">
                                <table id="TodayVisited" class="table table-border m-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Client Name</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Remarks</th>
                                            <th scope="col">Discussion</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Next FollowUp</th>
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

            <div class="row">
                <!-- reminder for staff 7 day before -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Task Reminder </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" fdprocessedid="ayyf1s">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" fdprocessedid="jawyaa">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-1">
                            <div class="table-responsive">
                                <table id="taskReminderTable" class="table m-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Contact</th>
                                            <th>Remarks</th>
                                            <th>FollowUp on</th>
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
            <div class="row p-2">
                <!-- data based on status -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Marketing Status Overview</h3>
                            <div id="StatusChart">
                                    </div>
                        </div>
                        <!-- <div class="card-body p-1">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th>Status</th>
                                            <th>TotalNumber</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><span class="badge badge-primary" onclick="ShowModal(8)">Initial</span></td>
                                            <td>
                                                <div class="sparkbar" data-color="#00a65a" data-height="20"> <span class="justaddedClient"></span></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge badge-success" onclick="ShowModal(1)">Called</span></td>
                                            <td>
                                                <div class="sparkbar" data-color="#00a65a" data-height="20"> <span class="calledclient">-</span></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge badge-info" onclick="ShowModal(2)">Appointment</span></td>
                                            <td>
                                                <div class="sparkbar" data-color="#f39c12" data-height="20"><span class="Appointment">-</span> </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge badge-info" onclick="ShowModal(3)">FollowUp</span></td>
                                            <td>
                                                <div class="sparkbar" data-color="#f56954" data-height="20"> <span class="followUp">-</span></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge badge-warning" onclick="ShowModal(5)">Canceled</span></td>
                                            <td>
                                                <div class="sparkbar" data-color="#f39c12" data-height="20"> <span class="cancelclient">-</span></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge badge-success" onclick="ShowModal(6)">Lead</span></td>
                                            <td>
                                                <div class="sparkbar" data-color="#f56954" data-height="20"><span class="LeadClient">-</span> </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="badge badge-danger" onclick="ShowModal(4)">Lead Close</span></td>
                                            <td>
                                                <div class="sparkbar" data-color="#00c0ef" data-height="20"> <span class="leadClose">-</span></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> -->
                        
                    </div>
                </div>

                <!-- product and total client -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> Client who are interested in Product </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" fdprocessedid="noqnz2">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" fdprocessedid="9elcuc">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="chart-responsive">
                                        <div class="chartjs-size-monitor">
                                            <div class="chartjs-size-monitor-expand">
                                                <div class=""></div>
                                            </div>
                                            <div class="chartjs-size-monitor-shrink">
                                                <div class=""></div>
                                            </div>
                                        </div>
                                        <canvas id="pieChart" height="154" width="310" style="display: block; height: 77px; width: 155px;" class="chartjs-render-monitor"></canvas>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <ul class="chart-legend clearfix" id="ProductchartData">

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<script src="assets/admin/plugins/summernote/summernote-bs4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>

<script src="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.js"></script>
<script src="assets/admin/plugins/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>

<script src="assets/admin/plugins/chart.js/Chart.js"></script>

<script>
    $(function() {
        getMarketingStatusandTotalNumber();
        getAllTodaystask();
        getTaskFor7daybefore();
        getAllMarketingStatusesForChart();
    });

    function getTaskFor7daybefore() {
        var obj = new Object();
        obj.Module = "Marketings";
        obj.Page_key = "getTaskFor7daybefore";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    function closeDealData() {
        getallCloseDeal();
    }

    function getallCloseDeal() {
        var obj = new Object();
        obj.Module = "Marketings";
        obj.Page_key = "getallCloseDeal";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    // ClosedealTable
    function getMarketingStatusandTotalNumber() {
        var obj = new Object();
        obj.Module = "Marketings";
        obj.Page_key = "getMarketingStatusandTotalNumber";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }


    function getAllMarketingStatusesForChart() {
        var obj = new Object();
        obj.Module = "Marketings";
        obj.Page_key = "getAllMarketingStatusesForChart";
        var json = new Object();
        obj.JSON = json;
        SilentTransportCall(obj);
    }





    function getAllTodaystask() {
        var obj = new Object();
        obj.Module = "Marketings";
        obj.Page_key = "getAllTodaystask";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }

    function onSuccess(rc) {
        if (rc.return_code) {
            switch (rc.Page_key) {

                case "getMarketingStatusandTotalNumber":
                    loadTotalClientandProductname(rc.return_data['TotalClientandProductName']); //chart & data

                    loadTodayVisited(rc.return_data['TodayVisited']);

                    $("#LeadClose").text(rc.return_data['LeadClose']);
                    $("#initialClient").text(rc.return_data['JustAdded']); //at the top 
                    $(".justaddedClient").text(rc.return_data['JustAdded']);
                    $(".calledclient").text(rc.return_data['Called']);
                    $(".Appointment").text(rc.return_data['Appointment']);
                    $("#followupClient").text(rc.return_data['FollowUp']); //header                 
                    $(".followUp").text(rc.return_data['FollowUp']);
                    $(".cancelclient").text(rc.return_data['Canceled']);
                    $("#leadclient").text(rc.return_data['Lead']); //header
                    $('.LeadClient').text(rc.return_data['Lead']);
                    $(".leadClose").text(rc.return_data['LeadClose']);
                    break;

                case "getAllTodaystask":
                    loadTodayTask(rc.return_data);
                    break;

                case "getAllMarketingStatusesForChart":
                    debugger;
                    console.log(rc.return_data);
                    loadchart(rc.return_data);
                    break;


                case "getClientBasedOnStatusID":
                    $("#addFeedback").modal('show');
                    loaddata(rc.return_data);
                    break;

                case "getTaskFor7daybefore":
                    loadTaskReminder(rc.return_data);
                    break;

                case "getallCloseDeal":

                    loadCloseDealData(rc.return_data);
                    break;

                default:
                    notify("warning", rc.Page_key);
            }
        } else {
            notify("error", rc.return_data);
        }
    }

    function loadCloseDealData(data) {
        var table = $("#ClosedealTable");
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
                text += '<td> ' + data[i].ClientName + '</td>';
                text += '<td> ' + data[i].Address + ' <br>  ' + data[i].StateName + ', ' + data[i].CityName + '-' + data[i].Pincode + '</td>';
                text += '<td> ' + data[i].MobileNos + ' <br>  ' + data[i].EmailIDs + '</td>';
                text += '<td>-</td>';
                // text += '<td> ' + data[i].Enrollments + ' </td>';
                // text += '<td> ' + data[i].ContactPersons + '(' + data[i].ContactPersonDesignation + ') <br>' + data[i].ContactPersonNumber + ' </td>';
                // text += '<td> <span  onclick="onviewMore(' + data[i].ClientID + ')" class="badge badge-info">Details</span> </td>';
                text += '</tr >';
            }
        }
        $("#ClosedealTable tbody").html("");
        $("#ClosedealTable tbody").append(text);

        $("#CloseDeal").modal('show');
    }


    function ShowModal(data) {
        var obj = new Object();
        obj.Module = "Marketings";
        obj.Page_key = "getClientBasedOnStatusID";
        var json = new Object();
        json.Status = data
        obj.JSON = json;
        TransportCall(obj);
    }

    function loaddata(data) {
        console.log(data);
        var table = $("#ClientData");
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
                text += '<td> ' + data[i].ClientName + '</td>';
                text += '<td> ' + data[i].Address + ' <br>  ' + data[i].StateName + ', ' + data[i].CityName + '-' + data[i].Pincode + '</td>';
                text += '<td>';

                //phone number
                if (data[i].MobileNos == '' || data[i].MobileNos == '0' || data[i].MobileNos == '-') {

                } else {
                    text += '<i class="fa fa-phone"></i> &nbsp; ';
                    myarray = data[i].MobileNos.split(",");
                    for (let j = 0; j < myarray.length; j++) {
                        if (myarray[j] == '') {

                        } else {
                            text += '<span class="badge badge-success"> ' + myarray[j] + '</span> &nbsp;';
                        }
                    }
                }


                //email
                if (data[i].EmailIDs == '' || data[i].EmailIDs == '-' || data[i].EmailIDs == null || data[i].EmailIDs == '0') {

                } else {
                    text += '<br> <i class="fa fa-envelope" aria-hidden="true"></i> &nbsp;';
                    emails = data[i].EmailIDs.split(",");
                    for (let j = 0; j < emails.length; j++) {
                        if (emails[j] == '') {

                        } else {
                            text += '<span class="badge badge-warning"> ' + emails[j] + '</span> &nbsp;';
                        }
                    }
                    // text += ' <br> <i class="fa fa-envelope" aria-hidden="true"></i> &nbsp; <span class="badge badge-success">' + data[i].EmailIDs + '</span>';
                }
                text += '</td>';

                // text += '<td> ' + data[i].MobileNos + ' <br>  ' + data[i].EmailIDs + '</td>';
                text += '<td> ' + data[i].Enrollments + ' </td>';
                text += '<td> ' + data[i].ContactPersons + '(' + data[i].ContactPersonDesignation + ') <br>' + data[i].ContactPersonNumber + ' </td>';
                text += '<td> ' + (data[i].CurrentPrice == null ? "<span class='badge badge-danger'>NA</span>" : data[i].CurrentPrice) + ' </td>';
                // text += '<td> ' + data[i].Enrollments + ' </td>';

                text += '<td> <span  onclick="onviewMore(' + data[i].ClientID + ')" class="badge badge-info">Details</span> </td>';

                text += '</tr >';
            }
        }
        $("#ClientData tbody").html("");
        $("#ClientData tbody").append(text);

        // $(table).DataTable({
        //     responsive: false,
        //     "order": [],
        //     dom: 'Bfrtip',
        //     "bInfo": false,
        //     exportOptions: {
        //         columns: ':not(.hidden-col)'
        //     },
        //     "deferRender": false,
        //     "pageLength": 10,
        //     buttons: [{
        //             exportOptions: {
        //                 columns: ':not(.hidden-col)'
        //             },
        //             extend: 'excel',
        //             orientation: 'landscape',
        //             pageSize: 'A4'
        //         },
        //         {
        //             exportOptions: {
        //                 columns: ':not(.hidden-col)'
        //             },
        //             extend: 'pdfHtml5',
        //             orientation: 'landscape',
        //             pageSize: 'A4'
        //         },
        //         {
        //             exportOptions: {
        //                 columns: ':not(.hidden-col)'
        //             },
        //             extend: 'print',
        //             orientation: 'landscape',
        //             pageSize: 'A4'
        //         }
        //     ]
        // });
    }

    function onviewMore(data) {
        window.location = "marketings-status?client=" + btoa(data);
    }


    //today task
    function loadTodayTask(data) {
        var table = $("#TodayTask");
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
                text += '<td> ' + data[i].ClientName;
                // school email

                if (data[i].EmailIDs == '' || data[i].EmailIDs == '-' || data[i].EmailIDs == null) {

                } else {
                    text += ' <br> <i class="fa fa-envelope" aria-hidden="true"></i> <span class="badge badge-success">' + data[i].EmailIDs + '</span>';
                }

                text += '</td>';

                // for phone number
                if (data[i].MobileNos == '' || data[i].MobileNos == 0) {

                } else {
                    text += '<td>';
                    myarray = data[i].MobileNos.split(",");
                    for (let j = 0; j < myarray.length; j++) {
                        if (myarray[j] == '') {

                        } else {
                            text += '<br> <i class="fa fa-phone"></i> <span class="badge badge-success"> ' + myarray[j] + '</span>';
                        }
                    }
                    text += '</td>';
                }

                // text += '<td> <i class="fa fa-phone"></i> ' + data[i].MobileNos + ' <br> <i class="fa fa-envelope" aria-hidden="true"></i> ' + data[i].EmailIDs + '</td>';
                text += '<td> <span class="badge badge-info">' + data[i].Status + ' </span></td>';
                text += '<td> ' + data[i].Remarks + ' </td>';
                text += '</tr >';
            }
        }
        $("#TodayTask tbody").html("");
        $("#TodayTask tbody").append(text);
    }


    // function loadTotalClientandProductname(data) {
    //     var table = $("#interestedclientandProductTable");
    //     try {
    //         if ($.fn.DataTable.isDataTable($(table))) {
    //             $(table).DataTable().destroy();
    //         }
    //     } catch (ex) {}

    //     var text = ""

    //     if (data.length == 0) {
    //         text += "No Data Found";
    //     } else {
    //         for (let i = 0; i < data.length; i++) {
    //             text += '<tr> ';
    //             text += '<td> ' + data[i].Name + '</td>';
    //             text += '<td>  <span class="badge badge-info">' + data[i].total + '</span> </td>';
    //             text += '</tr >';
    //         }
    //     }
    //     $("#interestedclientandProductTable tbody").html("");
    //     $("#interestedclientandProductTable tbody").append(text);
    // }

    //tak reminder
    function loadTaskReminder(data) {
        var table = $("#taskReminderTable");
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
                text += '<td> ' + data[i].ClientName + '</td>';

                text += '<td>';
                if (data[i].MobileNos == '' || data[i].MobileNos == 0 || data[i].MobileNos == '-') {

                } else {
                    // phone number
                    text += '<i class="fa fa-phone"></i>';
                    myarray = data[i].MobileNos.split(",");
                    for (let j = 0; j < myarray.length; j++) {
                        if (myarray[j] == '') {

                        } else {
                            text += ' &nbsp; <span class="badge badge-success"> ' + myarray[j] + '</span> &nbsp;';
                        }
                    }

                    // for email
                    if (data[i].EmailIDs == '' || data[i].EmailIDs == null || data[i].EmailIDs == '-' || data[i].EmailIDs == 0) {

                    } else {
                        text += ' <br> <i class="fa fa-envelope" aria-hidden="true"></i> &nbsp; <span class="badge badge-success">' + data[i].EmailIDs + '</span>';
                    }
                    //   text +='<i class="fa fa-phone"></i>' +  data[i].MobileNos ;
                }

                text += '</td>'

                // text += '<td> <i class="fa fa-phone"></i> ' + data[i].MobileNos + ' <br> <i class="fa fa-envelope" aria-hidden="true"></i> ' + data[i].EmailIDs + '</td>';
                text += '<td>  <span class="badge badge-info">' + data[i].Status + '</span> <br> ' + data[i].Remarks + ' </td>';
                text += '<td> LastVisited :  <span class="badge badge-primary"> <b>' + data[i].addedOn + '</b> </span> <br> FollowUp Date :  <span class="badge  badge-warning"> <b>' + data[i].FollowUpDateTime + ' </b> </span></td>';
                text += '</tr >';
            }
        }
        $("#taskReminderTable tbody").html("");
        $("#taskReminderTable tbody").append(text);
    }

    function loadTodayVisited(data) {
        // console.log(data);
        var table = $("#TodayVisited");
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
                text += '<td> ' + data[i].ClientName + '</td>';
                text += '<td> ' + data[i].Status + '</td>';
                //remarks and discussion
                text += '<td> ' + data[i].Remarks;
                text += '</td>';

                text += '<td> ' + data[i].NextFollowUp_Discussion + '</td>';
                text += '<td> ' + (data[i].Price == null ? "<span class='badge badge-danger'>NA</span>" : data[i].Price) + '</td>';

                let followupdate;
                if (data[i].FollowUpDateTime == '0000-00-00') {
                    followupdate = '-';
                } else {
                    followupdate = data[i].FollowUpDateTime;

                }
                text += '<td> ' + followupdate + ' </td>';
                text += '</tr>';
            }
        }
        $("#TodayVisited tbody").html("");
        $("#TodayVisited tbody").append(text);
    }


    // function loadchart(data) {
    //     debugger;
    //     var colors = [];
    //     var leaveData = [];

    //     // Iterate over the keys in the data object
    //     for (var type in data) {
    //         if (data.hasOwnProperty(type)) {
    //             colors.push(getRandomColor());
    //             var formattedLabel = type.replace(/([a-z])([A-Z])/g, '$1 $2');
    //             leaveData.push({
    //                 label: formattedLabel,
    //                 value: parseInt(data[type])
    //             });
    //         }
    //     }

    //     // Morris.js Donut Pie Chart
    //     new Morris.Donut({
    //         element: 'StatusChart',
    //         data: leaveData,
    //         colors: colors,
    //         resize: true,
    //         labelTextSize: '10px',
    //         labelFont: 'normal 400 10px Arial'
    //     });
    // }
    function loadchart(data) {
        debugger
        var colors = [];
        var leaveData = [];

        // Iterate over the keys in the data object
        for (var type in data) {
            if (data.hasOwnProperty(type)) {
                colors.push(getRandomColor());
                var formattedLabel = type.replace(/([a-z])([A-Z])/g, '$1 $2');
                leaveData.push({
                    label: formattedLabel,
                    value: parseInt(data[type])
                });
            }
        }

        // Morris.js Donut Pie Chart
        new Morris.Donut({
            element: 'StatusChart',
            data: leaveData,
            colors: colors,
            resize: true,
            labelColor: '#333', // Add this line to set label color
            formatter: function(value, data) {
                return value; // Add this line to show the actual numeric value on the chart
            }
        });
    }


    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    // load data to chart
    function loadTotalClientandProductname(data) {
        loadProductAndClientData(data); //load data in table format
        let pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        let pieChart = new Chart(pieChartCanvas)
        let PieData = [];
        let colors = [{
            color: '#f56954',
            highlight: '#f56954'
        }, {
            color: '#00a65a',
            highlight: '#00a65a'
        }, {
            color: '#f39c12',
            highlight: '#f39c12'
        }, {
            color: '#00c0ef',
            highlight: '#00c0ef'
        }, {
            color: '#3c8dbc',
            highlight: '#3c8dbc'
        }, {
            color: '#d2d6de',
            highlight: '#d2d6de'
        }];

        for (let i = 0; i < data.length; i++) {
            PieData.push({
                value: data[i].total,
                color: colors[i].color,
                highlight: colors[i].highlight,
                label: data[i].Name
            })
        }
        let pieOptions = {
            //Boolean - Whether we should show a stroke on each segment
            segmentShowStroke: true,
            //String - The colour of each segment stroke
            segmentStrokeColor: '#fff',
            //Number - The width of each segment stroke
            segmentStrokeWidth: 2,
            //Number - The percentage of the chart that we cut out of the middle
            percentageInnerCutout: 50, // This is 0 for Pie charts
            //Number - Amount of animation steps
            animationSteps: 100,
            //String - Animation easing effect
            animationEasing: 'easeOutBounce',
            //Boolean - Whether we animate the rotation of the Doughnut
            animateRotate: true,
            //Boolean - Whether we animate scaling the Doughnut from the centre
            animateScale: false,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: true,
            // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: true,
            //String - A legend template
            legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
        }

        pieChart.Doughnut(PieData, pieOptions)
    }

    function loadProductAndClientData(data) {
        var table = $("#ProductchartData");
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
                // text += '';
                // text += '<td> ' + data[i].Name + '</td>';
                text += '<li> <span class="text-bold"> ' + data[i].Name + '</span>  - <span class="">' + data[i].total + '</span> </li>';
                // text += '</tr >';
            }
        }
        $("#ProductchartData").html("");
        $("#ProductchartData").append(text);
    }
</script>