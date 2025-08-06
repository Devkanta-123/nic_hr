<!--   
       CreatedBy: Devkanta
       Created On: 19/12/2023
       Modified On: 
    -->

<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<div class="content-wrapper" style="min-height: 392px;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Grievance Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Grievance Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">

                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3 id="TotalGrievances"></h3>
                            <p>Total Grievance</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-clipboard mr-1"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3 id="ClosedGrievance"></h3>
                            <p>Closed Grievance</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3 id="UnderProcessGrievance"></h3>
                            <p>Under Process Grievance</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-cog"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3 id="NoresponseGrievance" style="color: white;"></h3>
                            <p style="color: white;">No Response Grievances</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <section class="col-lg-7 connectedSortable ui-sortable">
                    <div class="card">
                        <div class="card-header ui-sortable-handle" style="cursor: move;">
                            <h3 class="card-title">
                                <i class="ion ion-clipboard mr-1"></i>
                                Recently Lodge Grievances
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body">
                            <table id="table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Registration ID</i></th>
                                        <th scope="col">Received On</i></th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Grievance Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <div class="card-footer text-center">
                                <a href="supportTicket-lodgegrievance" class="uppercase">View All Grievances</a>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="col-lg-5 connectedSortable ui-sortable">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Grievances By Status</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
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
                                        <div id="pie_chart" style="width:600px; height: 300px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timeago/1.6.7/jquery.timeago.min.js"></script>
</script>
<script>
    $(function() {

        getTotalGrievances();
        getRecentLodgeGrievances();
        loadPieChart();
    });

    function getRecentLodgeGrievances() {
        var obj = new Object();
        obj.Module = "SupportTicket";
        obj.Page_key = "getRecentLodgeGrievances";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }


    function loadPieChart() {
        var obj = new Object();
        obj.Module = "SupportTicket";
        obj.Page_key = "loadPieChart";
        var json = new Object();
        obj.JSON = json;
        TransportCall(obj);
    }



    function onSuccess(rc) {
        debugger;
        if (rc.return_code) {
            switch (rc.Page_key) {

                case "getTotalGrievances":
                    $("#TotalGrievances").text(rc.TotalGrievances['totalgrievances']);
                    $("#UnderProcessGrievance").text(rc.UnderProcessGrievance['underprocessgrievance']);
                    $("#ClosedGrievance").text(rc.ClosedGrievance['closedgrievances']);
                    $("#NoresponseGrievance").text(rc.NoresponseGrievance['noresponsegrievance']);
                    break;

                case "getRecentLodgeGrievances":
                    loaddata(rc.return_data);
                    break;

                case "loadPieChart":
                    console.log(rc.return_data);

                    google.charts.load('current', {
                        'packages': ['corechart']
                    });

                    // Set a callback to run when the Google Visualization API is loaded
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var jsonData = rc.return_data;
                        // Create data table from JSON data
                        var data = new google.visualization.DataTable();
                        data.addColumn('string', 'Status');
                        data.addColumn('number', 'Count');

                        for (var i = 0; i < jsonData.length; i++) {
                            data.addRow([jsonData[i].status, parseInt(jsonData[i].count)]);
                        }

                        // Set chart options
                        var options = {
                            title: '', //text inside PieChart
                            is3D: true, // Enable 3D view
                            pieSliceText: 'percentage', // Display percentage
                            slices: {
                                0: {
                                    offset: 0.1
                                }
                            }, // Offset the 1st slice
                        };

                        // Instantiate and draw the chart, passing in options
                        var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
                        chart.draw(data, options);
                    }
                    break;


                default:
                    notify('error', "Unable to process the request");
                    break;
            }
        } else {

            notify('error', rc.return_data);

        }
    }

    function getTotalGrievances() {
        let obj = {};
        obj.Module = "SupportTicket";
        obj.Page_key = "getTotalGrievances";
        obj.JSON = {};
        TransportCall(obj);
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

            for (let i = 0; i < data.length; i++) {
                text += '<tr> ';

                // text += '<td> ' + (i+1) + '</td>';
                text += '<th> # ' + data[i].LodgeID + '</th>';
                // $createdDateTime = data[i].CreatedDateTime;
                var timestampStr = data[i].CreatedDateTime;
                var timestamp = new Date(timestampStr); // Convert string to Date object
                var timeAgo = jQuery.timeago(timestamp); // Assign calculated time ago to the global variable
                text += '<td><small class="badge badge-info"><i class="far fa-clock"></i>' + timeAgo + '</small></td>';
                if (data[i].Status == 1) {
                    text += '<td> <span class="badge bg-danger"> Unseen </span></td>';
                } else if (data[i].Status == 2) {
                    text += '<td> <span class=" badge badge-success">Seen & No Response</span> </td>';
                } else if (data[i].Status == 3) {
                    text += '<td> <span class=" badge badge-warning"> Response </span> </td>';
                } else if (data[i].Status == 4) {
                    text += '<td> <span class=" badge badge-info"> Closed </span> </td>';
                }
                text += '<td> ' + data[i].Remarks + '</td>';
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
</script>