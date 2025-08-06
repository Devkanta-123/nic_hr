<!-- summernote -->
<link rel="stylesheet" href="assets/admin/plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" href="assets/admin/plugins/multi-select-dropdown-list-with-checkbox-jquery/jquery.multiselect.css">
<link rel="stylesheet" href="assets/admin/plugins/bootstrap-toggle-master/css/bootstrap-toggle.min.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">

<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-md-3">All Letters
                            </div>
                        </div>
                        <div class="card-body">

                            <table id="loadletterstable" class="table table-bordered table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">Letter Type</th>
                                        <th scope="col">Letter Date</th>
                                        <!-- <th scope="col">For Whom</th> -->
                                        <th scope="col">Docs</th>
                                        <th scope="col">Letter No</th>
                                    </tr>

                                </thead>
                                <tbody>

                                </tbody>
                            </table>
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
        getAllLetters();
    });


    function getAllLetters() {
        let obj = {};
        obj.Module = "Administration";
        obj.Page_key = "getAllLetters";
        obj.JSON = {};
        SilentTransportCall(obj);
    }


    function onSuccess(rc) {

        if (rc.return_code) {
            switch (rc.Page_key) {

                case "getAllLetters":
                    console.log(rc.return_data);
                    loadLetters(rc.return_data);
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
                text += '<td> ' + data[i].LetterDate + '</td>';
                if (data[i].LetterDocumentID==null){
                    text += '<td> <span class="badge badge-danger">No Document</span> </td>';
                }
                else{
                    // text += '<td> <a href="' + data[i].LetterDocumentID + '" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-download"></i> Download</a> </td>';
                    text += '<td><a href=file?type=letters&name=' + data[i].DocumentPath + ' target="_blank" title="VIEW DOCUMENT" class="link-black text-sm mr-4"><i class="fas fa-file-pdf text-danger"></i></a></i>';

                }
                // text += '<td> ' + data[i].ForWhom + ' </td>';
                text += '<td> ' + data[i].LetterNo + ' </td>';
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
</script>