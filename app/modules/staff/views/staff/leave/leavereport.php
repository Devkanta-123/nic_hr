<!-- summernote -->
<link rel="stylesheet" href="assets/admin/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.css">
<link rel="stylesheet" href="assets/admin/plugins/bootstrap-toggle-master/css/bootstrap-toggle.min.css">
<link rel="stylesheet" href="assets/admin/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <span id="UserName" class="text-info">-</span> <span style="margin-left:25px;"></span>
                            </div>
                        </div>
                        <!-- /.card-header -->


                        <!-- load data by year -->
                        <div class="card-body">
                            <table id="table1" class="table table-bordered table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">Leave Type</th>
                                        <th scope="col">Requested Duration</th>
                                        <th scope="col">Approved Date</th>
                                        <th scope="col">Supervisor1</th>
                                        <th scope="col">Supervisor2</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Entitled</th>
                                        <th scope="col">Utilized</th>
                                        <th scope="col">Balanced</th>
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
    id = localStorage.getItem("StaffID");
    StaffName = localStorage.getItem("StaffName");
    document.title = localStorage.getItem("StaffName") + " Attendance";
    $("#UserName").text(StaffName);

    $(function() {

        getAttendanceYear();
        getStaffLeaveReports();

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
        getIndividualStaffAttendancebyMonth($("#months").val());
    });

    function getAttendanceYear() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getAttendanceYear";
        let json = {};
        obj.JSON = json;
        TransportCall(obj);
    }

    $("#onGetAttendance").click(function() {
        if ($("#isAttendanceDate").is(':checked')) {
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
    function getIndividualStaffAttendancebyMonth(month) {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getIndividualStaffAttendancebyMonth";
        let json = {};
        json.Month = month;
        json.StaffID = id;
        obj.JSON = json;
        TransportCall(obj);
    }

    function getStaffLeaveReports() {
        let obj = {};
        obj.Module = "Staff";
        obj.Page_key = "getStaffLeaveBalanced";
        let json = {};
        json.StaffID = id;
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

                case "getAttendanceYear":
                    loadYear(rc.return_data);
                    break;
                case "getIndividualStaffAttendancebyMonth":
                    loadData(rc.return_data);
                    break;
                case "getStaffLeaveBalanced":
                    console.log(rc.return_data);
                    loadStaffLeaveReport(rc.return_data);
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

    function loadStaffLeaveReport(data) {

        var table = $("#table1");
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
                text += '<td> ' + data[i].LeaveType + '</td>';
                if (data[i].isHalfDay == 1) {
                    text += '<td> <span style="color:#FF204E;"> Half Day</span><br>' + data[i].RequestedDateFrom + '</td>';
                } else {
                    text += '<td><span style="color:#DD5746;">' + data[i].RequestedDateFrom + '</span> to <span style="color:#77B0AA;">' + data[i].RequestedDateTo + '</span></td>';

                }
            
                text += '<td>' + (data[i].ApprovedDate !== null ? data[i].ApprovedDate : '<span class="text-danger">N/A</span>') + '</td>';

                text += '<td> ' + data[i].Supervisor1Name + '</td>';
                text += '<td> ' + data[i].Supervisor2Name + '</td>';
                if (data[i].status == null) {
                    text += '<td> <span class="badge badge-danger">Requested</span> </td>';
                } else if (data[i].status == 0) {
                    text += '<td> <span class="badge badge-danger">Rejected</span> Remarks:  ' + data[i].Remarks + '</td>';
                } else if (data[i].status == 1) {
                    text += '<td> <span class="badge badge-danger">Waiting for approval</span> </td>';
                } else if (data[i].status == 2) {
                    text += '<td> <span class="badge badge-success">Approved</span> Remarks:  ' + data[i].Remarks + '</td>';

                }


                text += '<td>' + (data[i].Entitled !== null ? data[i].Entitled : '<span class="text-danger">N/A</span>') + '</td>';
                // Utilized
                text += '<td>' + (data[i].Utilized !== null ? data[i].Utilized : '<span class="text-danger">N/A</span>') + '</td>';
                // Balanced
                text += '<td>' + (data[i].Balanced !== null ? data[i].Balanced : '<span class="text-danger">N/A</span>') + '</td>';
                text += '</tr >';
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

    }
</script>