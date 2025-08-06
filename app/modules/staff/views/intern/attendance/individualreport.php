<!-- summernote -->
<link rel="stylesheet" href="assets/admin/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.css">
<link rel="stylesheet" href="assets/admin/plugins/bootstrap-toggle-master/css/bootstrap-toggle.min.css">
<link rel="stylesheet" href="assets/admin/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.knob/1.2.13/css/jquery.knob.min.css">
<script src="https://cdn.jsdelivr.net/jquery.knob/1.2.13/jquery.knob.min.js"></script>
<style>
    .loading-animation {
        width: 100%;
        height: 200%;
        position: relative;
    }

    .loading-animation:before {
        content: "";
        position: absolute;
        top: 50%;
        left: 50%;
        width: 50px;
        height: 50px;
        margin-top: -25px;
        margin-left: -25px;
        border: 5px solid #3498db;
        /* Change the color as needed */
        border-radius: 50%;
        border-top: 5px solid #ecf0f1;
        /* Change the color as needed */
        animation: spin 1s linear infinite;
    }


    .percentage-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 14px;
        color: #3498db;
        /* Change the color as needed */
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <span id="InternName" class="text-info">-</span> <span style="margin-left:25px;"> Attendance</span>
                            </div>

                            <span class=" row">
                                <div class="col-md-3">
                                    <input type="checkbox" id="isAttendanceDate" style="width: 100%" checked data-bootstrap-switch data-on-text="Monthly" data-off-text="Yearly" data-off-color="danger" data-on-color="success">
                                </div>
                                <div class="col-md-3">
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
                                </div>


                                <div class="col-md-3" style="display:none">
                                    <select class="form-control" id="years">
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-primary" id="onGetAttendance">Load</button>
                                </div>
                            </span>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" id="loaddatabymonth">
                            <table id="table" class="table table-bordered table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">TimeIn/Out</th>
                                        <th scope="col">Location</th>
                                        <!-- <th scope="col">LocationOut</th> -->
                                        <th scope="col">Remarks (Time Spend)</th>
                                    </tr>

                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                        <!-- load data by year -->
                        <div class="card-body" id="loaddatabyyear" style="display:none;">
                            <table id="table1" class="table table-bordered table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">Month</th>
                                        <th scope="col">Total Working Days</th>
                                        <th scope="col">Present</th>
                                        <th scope="col">Absent</th>
                                        <th scope="col">Leaves</th>
                                        <th scope="col">Present Days in (%)</th>
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
<!-- /.content-wrapper -->

<!-- Summernote -->
<script src="assets/admin/plugins/summernote/summernote-bs4.min.js"></script>
<script src="assets/admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.js"></script>
<script src="assets/admin/plugins/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>
<script src="assets/admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

<!-- to get the diffence between two tlimes -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.28.0/moment.min.js"></script>

<script>
    id = localStorage.getItem("StaffInternID");
    StaffInternName = localStorage.getItem("StaffInternName");

    document.title = localStorage.getItem("StaffInternName") + " Attendance";
    $("#InternName").text(StaffInternName);

    $(function() {

        getInternAttendanceYear();

        $('.textarea').summernote();
        // getstaffAttendance();

        $("#isAttendanceDate").bootstrapSwitch({
            size: "small",
            onColor: "success",
            offColor: "danger",
        });

        $('#isAttendanceDate').on('switchChange.bootstrapSwitch', function(event, state) {
            if ($("#isAttendanceDate").is(':checked')) {
                $("#years").parent().hide();
                $("#months").parent().show();
                $("#loaddatabymonth").show();
                $("#loaddatabyyear").hide();
            } else {
                $("#years").parent().show();
                $("#months").parent().hide();
                $("#loaddatabymonth").hide();
                $("#loaddatabyyear").show();
            }
        });

        //set current month
        const d = new Date();
        let month = d.getMonth() + 1;
        $("#months").val(month);
        getInternAttendancebyMonth($("#months").val());
    });

    function getInternAttendanceYear() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getInternAttendanceYear";
        let json = {};
        obj.JSON = json;
        TransportCall(obj);
    }

    $("#onGetAttendance").click(function() {
        if ($("#isAttendanceDate").is(':checked')) {
            getInternAttendancebyMonth($("#months").val());
        } else {
            getInternAttendancebyYear($("#years").val());
        }
    });


    //by default get by month(january)

    //on change of month 
    $("#months").change(function() {
        getInternAttendancebyMonth($("#months").val());
    });

    //get the attendance based on selected month
    function getInternAttendancebyMonth(month) {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getInternAttendancebyMonth";
        let json = {};
        json.Month = month;
        json.StaffInternID = id;
        obj.JSON = json;
        TransportCall(obj);
    }


    //get by year
    function getInternAttendancebyYear(year) {
        debugger;
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getInternAttendancebyYear";
        let json = {};
        json.Year = year;
        json.StaffInternID = id;
        obj.JSON = json;
        TransportCall(obj);
    }


    function loadYear(data) {
        var table = $("#years");
        var text = ""

        if (data.length === 0) {
            text += "No Data Found";
        } else {

            for (let i = 0; i < data.length; i++) {
                text += '<option value=" ' + data[i].Year + ' "> ' + data[i].Year + ' </option>';
            }
        }

        $("#years").html("");
        $("#years").append(text);
    }


    function onSuccess(rc) {

        if (rc.return_code) {
            switch (rc.Page_key) {

                case "getInternAttendanceYear":
                    loadYear(rc.return_data);
                    break;
                case "getInternAttendancebyMonth":
                    loadData(rc.return_data);
                    break;
                case "getInternAttendancebyYear":
                    loadDatabyYear(rc.return_data);
                    break;

                default:
                    notify("error", rc.Page_key);
            }
        } else {
            notify("error", rc.return_data);
        }
    }

    function loadData(data) {
        var table = $("#table");
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
                text += '<td> ' + data[i].AttendanceDate + '</td>';
                text += '<td> ' + (data[i].Status == 0 ? "<span class='badge badge-sm badge-danger'>Absent</span>" : "<span class='badge badge-sm badge-success'>Present</span>") + '</td>';
                text += '<td>  In : ' + (data[i].StaffIn == null ? "<span class='badge badge-sm badge-danger'>NA</span>" : " <b> " + data[i].StaffIn + " </b>");
                text += "Out : " + (data[i].StaffOut == null ? "<span class='badge badge-sm badge-danger'>NA</span>" : "<b>" + data[i].StaffOut + "</b>") + '</td>';
                text += '<td>  <a  title ="In" href="https://www.google.com/maps/search/' + data[i].LatitudeIN + ',' + data[i].LongtitudeIN + '/" target="_blank"> <img style="width:40px;height:40px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFwAAABcCAMAAADUMSJqAAABKVBMVEX///80qFL6uwRChfTqQzUac+j/vAD6tgD6uAA+g/QufPMqpUsfo0UAaecRceg0f/TpOCgVoT9CguqtxfUAbedTjvTE1vvwh4AzqkGn1LB4wIhCg/nvenLqPS7+79LpOTf7wwDg8OT7xUkSp1bN2/l5pPFbkOxxn/CcufPz9/6nwvrm7f0hePPf6P2Rs/dpme65ZY7vNBPSTV/2t7PkRD5Eb9n97u10Z72cYKDyPx+9VXsnlZm33LrXSFVCmLlVbNA+j9LM5tE/iuGnWpHvJwDtyMs4pW384d/0nHU8oYnwcBX/++XznpnsWSn80F5PsWf94af3pRj1mBzyhSPvcSsulKZiuHb80HS+29eKx5f957xfqT36vy+Fqy6csDW/tjDeuSH81YZLqEbZKG0ZAAADcklEQVRoge2YaVfaQBSGk0wghCSEsIkiRqlikVhKtYtdbGmrrbUuXW3Rrv//RzQ7mQXJTeKXHp6v5Dze8847M4kcN2fOnP+A9epGt16pVLqbtxu9LMW9alfTtFrJo6Zpla1+Rur+hqaVchFKOaRbg/UM1L1NrZYjQDZysbud1l2tUWrX7ervpHMP8EBcZBSg11NE39fpsSNuZ/jEyfdz9Ng5HSHM3kjoZkRCuG2sZLPftSh1KUe6ESomKc3y8B49OO1GMoK7d4Ziefc+EYzMkCN9A+p+UBZFsV1+aM1028FAF3XBkYvi8JE1043kOnDwoeix9zhaFFlm/YHWk6ewwdtiYH8WtF3X64NBXS6S/tZ+kwcNXhZD2rvPbXuphqruMd5rdHF960WTV0cA+U5EbgdvL6u2Nfm1EQ1HfqnyvLIEkC+3o3Jx75WG7cM+Cu0y4l0AcpHg9QH+ey88BeRDxXEba7Hdb4a4u/yWfKJR9NzWUdMdXF2MLccjF813x9QjddkroeeGhP4ek5snp/QjVd0voc9ZbPkCvp7SOf3IdtErYUhsOV4WqbDCeKbolTBATSQ3PwgSUy6jMyWl3Py4ypZbrcOIGyCfZG5+WhWEAiPzvnUUCcWuS2x52Bbzs+0WBEZbtr40eYzY8qDn5ongUqB7vo+7la+x5Qd7/uSCL78gn/hm4HMr32PLg6tC8uWCNCaeUHE3rwKui12/hCF41Y95hZADDi63Lk4JJ0R36fiSdIOOXHtF3RJGKFz5+nHnxy1SDbosuLJfQkwvCZ3OlST9pNywa45bOCHVAflftBuUin1dSNPcvxluwFXhclqY4maMDdj7HitTRme5oYNz3AVr9PwlSw5L3IUhz9MltDFAVfEYU8HkGSWEdjyAXFN2CZOE4hCjhMlCccAak2cWhVfjn7UE51H7X5YbcElQTPqYv8wycI9O4boS8irgGGdwXQkTL2aAu6hTSph8MQPsvTSlhMl2D84fiV3CdIsZcMosYdrFDGC6Ddi351TWDNqdfjEDFim7Ev9LYiZL5IuKkk3gHsTrW1aBe4ywYNIcVyywYDINxSH6cQW+7WexGLFn7Y5spbRnIYtw9AwrPsFfUshHRHz8wkBfDOPhdT2LU5yFelPL6eDmYtyMmxtB/1UGwv5CvKlU7FtDMTLf+XPmzLmGf+vpVcp1B8AMAAAAAElFTkSuQmCC" /></a>';
                // text += '<td> ' + (data[i].StaffOut==null ? "<span class='badge badge-sm badge-danger'>NA</span>" : data[i].StaffOut ) + '</td>';
                text += '<a  title ="Out" href="https://www.google.com/maps/search/' + data[i].LatitudeOut + ',' + data[i].LongtitudeOut + ' /" target="_blank"> <img style="width:40px;height:40px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFwAAABcCAMAAADUMSJqAAABKVBMVEX///80qFL6uwRChfTqQzUac+j/vAD6tgD6uAA+g/QufPMqpUsfo0UAaecRceg0f/TpOCgVoT9CguqtxfUAbedTjvTE1vvwh4AzqkGn1LB4wIhCg/nvenLqPS7+79LpOTf7wwDg8OT7xUkSp1bN2/l5pPFbkOxxn/CcufPz9/6nwvrm7f0hePPf6P2Rs/dpme65ZY7vNBPSTV/2t7PkRD5Eb9n97u10Z72cYKDyPx+9VXsnlZm33LrXSFVCmLlVbNA+j9LM5tE/iuGnWpHvJwDtyMs4pW384d/0nHU8oYnwcBX/++XznpnsWSn80F5PsWf94af3pRj1mBzyhSPvcSsulKZiuHb80HS+29eKx5f957xfqT36vy+Fqy6csDW/tjDeuSH81YZLqEbZKG0ZAAADcklEQVRoge2YaVfaQBSGk0wghCSEsIkiRqlikVhKtYtdbGmrrbUuXW3Rrv//RzQ7mQXJTeKXHp6v5Dze8847M4kcN2fOnP+A9epGt16pVLqbtxu9LMW9alfTtFrJo6Zpla1+Rur+hqaVchFKOaRbg/UM1L1NrZYjQDZysbud1l2tUWrX7ervpHMP8EBcZBSg11NE39fpsSNuZ/jEyfdz9Ng5HSHM3kjoZkRCuG2sZLPftSh1KUe6ESomKc3y8B49OO1GMoK7d4Ziefc+EYzMkCN9A+p+UBZFsV1+aM1028FAF3XBkYvi8JE1043kOnDwoeix9zhaFFlm/YHWk6ewwdtiYH8WtF3X64NBXS6S/tZ+kwcNXhZD2rvPbXuphqruMd5rdHF960WTV0cA+U5EbgdvL6u2Nfm1EQ1HfqnyvLIEkC+3o3Jx75WG7cM+Cu0y4l0AcpHg9QH+ey88BeRDxXEba7Hdb4a4u/yWfKJR9NzWUdMdXF2MLccjF813x9QjddkroeeGhP4ek5snp/QjVd0voc9ZbPkCvp7SOf3IdtErYUhsOV4WqbDCeKbolTBATSQ3PwgSUy6jMyWl3Py4ypZbrcOIGyCfZG5+WhWEAiPzvnUUCcWuS2x52Bbzs+0WBEZbtr40eYzY8qDn5ongUqB7vo+7la+x5Qd7/uSCL78gn/hm4HMr32PLg6tC8uWCNCaeUHE3rwKui12/hCF41Y95hZADDi63Lk4JJ0R36fiSdIOOXHtF3RJGKFz5+nHnxy1SDbosuLJfQkwvCZ3OlST9pNywa45bOCHVAflftBuUin1dSNPcvxluwFXhclqY4maMDdj7HitTRme5oYNz3AVr9PwlSw5L3IUhz9MltDFAVfEYU8HkGSWEdjyAXFN2CZOE4hCjhMlCccAak2cWhVfjn7UE51H7X5YbcElQTPqYv8wycI9O4boS8irgGGdwXQkTL2aAu6hTSph8MQPsvTSlhMl2D84fiV3CdIsZcMosYdrFDGC6Ddi351TWDNqdfjEDFim7Ev9LYiZL5IuKkk3gHsTrW1aBe4ywYNIcVyywYDINxSH6cQW+7WexGLFn7Y5spbRnIYtw9AwrPsFfUshHRHz8wkBfDOPhdT2LU5yFelPL6eDmYtyMmxtB/1UGwv5CvKlU7FtDMTLf+XPmzLmGf+vpVcp1B8AMAAAAAElFTkSuQmCC" /></a> </td>';

                //to fine the differnce between two times
                var todayDate = moment(new Date()).format("MM-DD-YYYY");
                var startDate = new Date(`${todayDate} ${data[i].StaffIn}`);
                var endDate = new Date(`${todayDate } ${data[i].StaffOut}`);
                var timeDiff = Math.abs(startDate.getTime() - endDate.getTime());

                var hh = Math.floor(timeDiff / 1000 / 60 / 60);
                hh = ('0' + hh).slice(-2) //hour

                timeDiff -= hh * 1000 * 60 * 60;
                var mm = Math.floor(timeDiff / 1000 / 60);
                mm = ('0' + mm).slice(-2) //minute

                timeDiff -= mm * 1000 * 60;
                var ss = Math.floor(timeDiff / 1000);
                ss = ('0' + ss).slice(-2); //second


                timedif = hh + ":" + mm + ":" + ss;

                myArray = timedif.split(":");
                Htime = myArray[1];


                if (isNaN(Htime)) {
                    remarks = "<span class='badge badge-sm badge-danger'>NA</span> ";
                } else {
                    remarks = "<span class='badge bagde-sm badge-info'>" + timedif + '</span>';
                }
                text += '<td> ' + remarks + ' </td>';
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

    // function loadDatabyYear(data) {

    //     var table = $("#table1");
    //     try {
    //         if ($.fn.DataTable.isDataTable($(table))) {
    //             $(table).DataTable().destroy();
    //         }
    //     } catch (ex) {}

    //     var text = ""

    //     if (data.length === 0) {
    //         text += "No Data Found";
    //     } else {

    //         for (let i = 0; i < data.length; i++) {

    //             text += '<tr> ';
    //             if (data[i].Month == 1) {
    //                 month = "January";
    //             } else if (data[i].Month == 2) {
    //                 month = "February";
    //             } else if (data[i].Month == 3) {
    //                 month = "March";
    //             } else if (data[i].Month == 4) {
    //                 month = "April";
    //             } else if (data[i].Month == 5) {
    //                 month = "May";
    //             } else if (data[i].Month == 6) {
    //                 month = "June";
    //             } else if (data[i].Month == 7) {
    //                 month = "July";
    //             } else if (data[i].Month == 8) {
    //                 month = "August";
    //             } else if (data[i].Month == 9) {
    //                 month = "September";
    //             } else if (data[i].Month == 10) {
    //                 month = "October";
    //             } else if (data[i].Month == 11) {
    //                 month = "November";
    //             } else {
    //                 month = "December";
    //             }
    //             text += '<td>  <span class="badge badge-sm badge-primary">' + month + ' </span></td>';
    //             text += '<td> ' + data[i].All + '</td>';
    //             text += '<td> ' + data[i].Present + '</td>';
    //             text += '<td> ' + data[i].Absent + '</td>';
    //             text += '<td> ' + data[i].Onleave + '</td>';
    //             percent = data[i].Present / data[i].All * 100;
    //             text += '<td> ' + percent + '</td>';
    //             text += '</tr >';
    //         }
    //     }

    //     $("#table1 tbody").html("");
    //     $("#table1 tbody").append(text);

    //     $(table).DataTable({
    //         responsive: true,
    //         "order": [],
    //         dom: 'Bfrtip',
    //         "bInfo": true,
    //         exportOptions: {
    //             columns: ':not(.hidden-col)'
    //         },
    //         "deferRender": true,
    //         "pageLength": 10,
    //         buttons: [{
    //                 exportOptions: {
    //                     columns: ':not(.hidden-col)'
    //                 },
    //                 extend: 'excel',
    //                 orientation: 'landscape',
    //                 pageSize: 'A4'
    //             },
    //             {
    //                 exportOptions: {
    //                     columns: ':not(.hidden-col)'
    //                 },
    //                 extend: 'pdfHtml5',
    //                 orientation: 'landscape',
    //                 pageSize: 'A4'
    //             },
    //             {
    //                 exportOptions: {
    //                     columns: ':not(.hidden-col)'
    //                 },
    //                 extend: 'print',
    //                 orientation: 'landscape',
    //                 pageSize: 'A4'
    //             }
    //         ]
    //     });

    // }


    // function loadDatabyYear(data) {
    //     var table = $("#table1");

    //     try {
    //         if ($.fn.DataTable.isDataTable($(table))) {
    //             $(table).DataTable().destroy();
    //         }
    //     } catch (ex) {}

    //     var text = "";

    //     if (data.length === 0) {
    //         text += "No Data Found";
    //     } else {
    //         for (let i = 0; i < data.length; i++) {
    //             text += '<tr> ';
    //             // ... (omitting month conversion for brevity)
    //             text += '<td>  <span class="badge badge-sm badge-primary">' + convertMonthNumberToName(data[i].Month) + ' </span></td>';
    //             text += '<td> ' + data[i].All + '</td>';
    //             text += '<td> ' + data[i].Present + '</td>';
    //             text += '<td> ' + data[i].Absent + '</td>';
    //             text += '<td> ' + data[i].Onleave + '</td>';
    //             percent = data[i].Present / data[i].All * 100;
    //             // text += '<td> ' + percent + '</td>';

    //             text += '<td id="percentCell' + i + '" data-width="100" data-displayInput="true"></td>';
    //         simulatePercentageLoading(i, data[i].Present, data[i].All);

    //             text += '</tr>';
    //         }
    //     }

    //     $("#table1 tbody").html("");
    //     $("#table1 tbody").append(text);

    //     $(table).DataTable({
    //         responsive: true,
    //         "order": [],
    //         dom: 'Bfrtip',
    //         "bInfo": true,
    //         exportOptions: {
    //             columns: ':not(.hidden-col)'
    //         },
    //         "deferRender": true,
    //         "pageLength": 10,
    //         buttons: [{
    //                 exportOptions: {
    //                     columns: ':not(.hidden-col)'
    //                 },
    //                 extend: 'excel',
    //                 orientation: 'landscape',
    //                 pageSize: 'A4'
    //             },
    //             {
    //                 exportOptions: {
    //                     columns: ':not(.hidden-col)'
    //                 },
    //                 extend: 'pdfHtml5',
    //                 orientation: 'landscape',
    //                 pageSize: 'A4'
    //             },
    //             {
    //                 exportOptions: {
    //                     columns: ':not(.hidden-col)'
    //                 },
    //                 extend: 'print',
    //                 orientation: 'landscape',
    //                 pageSize: 'A4'
    //             }
    //         ]
    //     });

    //     // Function to simulate loading of percentage data
    //     function simulatePercentageLoading(index, present, all) {
    //         debugger;
    //         var currentPercentage = 0;
    //         var interval = setInterval(function() {
    //             var percent = currentPercentage / 100 * (present / all) * 100;
    //             // Update the percentage cell
    //             $("#percentCell" + index).text(percent.toFixed(2) + '%');

    //             if (currentPercentage >= 100) {
    //                 clearInterval(interval);
    //             } else {
    //                 currentPercentage += 1;
    //             }
    //         }, 50); // Adjust the interval as needed
    //     }
    //     // Helper function to convert month number to month name
    //     function convertMonthNumberToName(monthNumber) {
    //         var monthNames = [
    //             "January", "February", "March", "April", "May", "June",
    //             "July", "August", "September", "October", "November", "December"
    //         ];

    //         return monthNames[monthNumber - 1] || "";
    //     }

    // }
    // function loadDatabyYear(data) {
    //     var table = $("#table1");

    //     try {
    //         if ($.fn.DataTable.isDataTable($(table))) {
    //             $(table).DataTable().destroy();
    //         }
    //     } catch (ex) {}

    //     var text = "";

    //     if (data.length === 0) {
    //         text += "No Data Found";
    //     } else {
    //         for (let i = 0; i < data.length; i++) {
    //             text += '<tr> ';
    //             // ... (omitting month conversion for brevity)
    //             text += '<td>  <span class="badge badge-sm badge-primary">' + convertMonthNumberToName(data[i].Month) + ' </span></td>';
    //             text += '<td> ' + data[i].All + '</td>';
    //             text += '<td> ' + data[i].Present + '</td>';
    //             text += '<td> ' + data[i].Absent + '</td>';
    //             text += '<td> ' + data[i].Onleave + '</td>';

    //             // Add a placeholder for the percentage with jQuery Knob initialization
    //             text += '<td class="percent-cell" id="percentCell' + i + '" data-width="80" data-displayInput="true"><div class="loading-animation"></div></td>';
    //             simulatePercentageLoading(i, data[i].Present, data[i].All);

    //             text += '</tr>';
    //         }
    //     }

    //     $("#table1 tbody").html("");
    //     $("#table1 tbody").append(text);

    //     $(table).DataTable({
    //         responsive: true,
    //         "order": [],
    //         dom: 'Bfrtip',
    //         "bInfo": true,
    //         exportOptions: {
    //             columns: ':not(.hidden-col)'
    //         },
    //         "deferRender": true,
    //         "pageLength": 10,
    //         buttons: [{
    //                 exportOptions: {
    //                     columns: ':not(.hidden-col)'
    //                 },
    //                 extend: 'excel',
    //                 orientation: 'landscape',
    //                 pageSize: 'A4'
    //             },
    //             {
    //                 exportOptions: {
    //                     columns: ':not(.hidden-col)'
    //                 },
    //                 extend: 'pdfHtml5',
    //                 orientation: 'landscape',
    //                 pageSize: 'A4'
    //             },
    //             {
    //                 exportOptions: {
    //                     columns: ':not(.hidden-col)'
    //                 },
    //                 extend: 'print',
    //                 orientation: 'landscape',
    //                 pageSize: 'A4'
    //             }
    //         ]
    //     });

    //     // Function to simulate loading of percentage data
    //     function simulatePercentageLoading(index, present, all) {
    //         var currentPercentage = 0;
    //         var interval = setInterval(function() {
    //             var percent = currentPercentage / 100 * (present / all) * 100;
    //             // Initialize jQuery Knob for the percentage cell
    //             $("#percentCell" + index).knob({
    //                 readOnly: true,
    //                 displayPrevious: true,
    //                 thickness: 0.3,
    //                 fgColor: "#3498db", // Change the color as needed
    //                 bgColor: "#ecf0f1", // Change the color as needed
    //                 format: function(value) {
    //                     return value.toFixed(2) + '%';
    //                 }
    //             });
    //             // Update the percentage value and trigger a redraw
    //             $("#percentCell" + index).val(percent).trigger('change');

    //             if (currentPercentage >= 100) {
    //                 clearInterval(interval);
    //             } else {
    //                 currentPercentage += 1;
    //             }
    //         }, 50); // Adjust the interval as needed
    //     }

    //     // Helper function to convert month number to month name
    //     function convertMonthNumberToName(monthNumber) {
    //         var monthNames = [
    //             "January", "February", "March", "April", "May", "June",
    //             "July", "August", "September", "October", "November", "December"
    //         ];

    //         return monthNames[monthNumber - 1] || "";
    //     }
    // }

    function loadDatabyYear(data) {
        var table = $("#table1");

        try {
            if ($.fn.DataTable.isDataTable($(table))) {
                $(table).DataTable().destroy();
            }
        } catch (ex) {}

        var text = "";

        if (data.length === 0) {
            text += "No Data Found";
        } else {
            for (let i = 0; i < data.length; i++) {
                text += '<tr> ';
                // ... (omitting month conversion for brevity)
                text += '<td>  <span class="badge badge-sm badge-primary">' + convertMonthNumberToName(data[i].Month) + ' </span></td>';
                text += '<td> ' + data[i].All + '</td>';
                text += '<td> ' + data[i].Present + '</td>';
                text += '<td> ' + data[i].Absent + '</td>';
                text += '<td> ' + data[i].Onleave + '</td>';

                // Add a placeholder for the percentage with jQuery Knob initialization and styling
                text += '<td class="percent-cell" id="percentCell' + i + '" data-width="80" data-displayInput="true">';
                text += '<div class="loading-animation"><div class="percentage-text"></div></div>';
                text += '</td>';

                simulatePercentageLoading(i, data[i].Present, data[i].All);

                text += '</tr>';
            }
        }

        $("#table1 tbody").html("");
        $("#table1 tbody").append(text);

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




        // // Function to simulate loading of percentage data
        // function simulatePercentageLoading(index, present, all) {
        //     var currentPercentage = 0;
        //     var interval = setInterval(function() {
        //         var percent = currentPercentage / 100 * (present / all) * 100;
        //         // Initialize jQuery Knob for the percentage cell
        //         $("#percentCell" + index).knob({
        //             readOnly: true,
        //             displayPrevious: true,
        //             thickness: 0.1,
        //             fgColor: "#3498db", // Change the color as needed
        //             bgColor: "#ecf0f1", // Change the color as needed
        //             format: function(value) {
        //                 return value.toFixed(2) + '%';
        //             }
        //         });
        //         // Update the percentage value and trigger a redraw
        //         $("#percentCell" + index).val(percent).trigger('change');

        //         // Update the percentage text inside the loading animation
        //         $("#percentCell" + index + " .percentage-text").text(percent.toFixed(2) + '%');

        //         if (currentPercentage >= 100) {
        //             clearInterval(interval);
        //         } else {
        //             currentPercentage += 1;
        //         }
        //     }, 50); // Adjust the interval as needed
        // }

        // function simulatePercentageLoading(index, present, all) {
        //     var currentPercentage = 0;
        //     var interval = setInterval(function() {
        //         var percent = currentPercentage / 100 * (present / all) * 100;

        //         // Update the percentage text inside the loading animation
        //         var percentageText = percent.toFixed(2) + '%';
        //         $("#percentCell" + index + " .percentage-text").text(percentageText);

        //         // Initialize jQuery Knob for the percentage cell
        //         $("#percentCell" + index).knob({
        //             readOnly: true,
        //             displayPrevious: true,
        //             thickness: 0.1,
        //             fgColor: "#3498db", // Change the color as needed
        //             bgColor: "#ecf0f1", // Change the color as needed
        //             format: function(value) {
        //                 return value.toFixed(2) + '%';
        //             }
        //         });

        //         // Update the percentage value and trigger a redraw
        //         $("#percentCell" + index).val(percent).trigger('change');

        //         if (currentPercentage >= 100) {
        //             clearInterval(interval);
        //         } else {
        //             currentPercentage += 1;
        //         }
        //     }, 50); // Adjust the interval as needed
        // }
        function simulatePercentageLoading(index, present, all) {
            var currentPercentage = 0;
            var interval = setInterval(function() {
                var percent = currentPercentage / 100 * (present / all) * 100;

                // Update the percentage text inside the loading animation
                $("#percentCell" + index + " .percentage-text").text(percent.toFixed(2) + '%');

                if (currentPercentage >= 100) {
                    clearInterval(interval);
                    // Optionally, you can perform actions after the animation stops
                    console.log("Animation stopped!");
                } else {
                    currentPercentage += 1;
                }
            }, 50); // Adjust the interval as needed
        }


        // Helper function to convert month number to month name
        function convertMonthNumberToName(monthNumber) {
            var monthNames = [
                "January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];

            return monthNames[monthNumber - 1] || "";
        }
    }
</script>