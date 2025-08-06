<link href="assets/js/plugins/icheck-bootstrap/icheck-bootstrap.min.css" rel="stylesheet">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Subjects
                            </div>

                            <span class="float-right">
                                <button class="btn btn-success" data-toggle="modal" data-target="#modal-lg"> <i class="fa fa-circle-thin"> <i class="fa fa-plus"></i> </i>Add subject Combination</button>
                            </span>

                            <div class="modal fade" id="modal-lg">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add Class Subject</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="Class">Class</label>
                                                        <select class="form-control" id="Class"></select>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label for="Subject">Subject</label>
                                                        <select class="form-control select2" id="Subject"  multiple="multiple" data-placeholder="Select Subject"
                                                        style="width: 100%;"></select>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <button class="btn btn-success btn-sm mt-4" data-toggle="modal" data-target="#modal-md" onclick=""> <i class="fa fa-circle-thin"> <i class="fa fa-plus"></i> </i></button>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="icheck-success">
                                                            <input type="checkbox" checked id="isCompulsory">
                                                            <label for="isCompulsory">isCompulsory</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="icheck-success">
                                                            <input type="checkbox" checked id="isPreferredSubject">
                                                            <label for="isPreferredSubject">isPreferredSubject</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="btnAddClassSubject">Save </button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>

                            <div class="modal fade" id="modal-md">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add Subject</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body">
                                                <div class="col-md-12">
                                                    <label for="SubjectName">Subject Name</label>
                                                    <input type="text" class="form-control" id="SubjectName" placeholder="Subject Name">
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="SubjectAlias">Subject Alias</label>
                                                    <input type="text" class="form-control" id="SubjectAlias" placeholder="Subject Alias"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="btnAddSubject">Save </button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="table" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">Sl#</th>
                                    <th scope="col">Class</th>
                                    <th scope="col">Subject Combination</th>
                                    <th scope="col"></th>
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

<?php require_once(VIEWPATH . "/basic/footer.php"); ?>

<script src="assets/js/plugins/icheck-bootstrap/icheck.min.js"></script>
<!-- Jasny File -->
<script src="assets/js/plugins/jasny-bootstrap.min.js"></script>
<script>
    $(function() {
        getSubjects();
        getClassSection();
        getClassSubjects();
    });

    function getSubjects() {
        let obj = {};
        obj.Module = "Settings";
        obj.Page_key = "getSubjects";
        obj.JSON = {};
        TransportCall(obj);
    }

    function getClassSection() {
        let obj = {};
        obj.Module = "Settings";
        obj.Page_key = "getClassSection";
        obj.JSON = {};
        TransportCall(obj);
    }

    function getAcademicSubject() {
        let obj = {};
        obj.Module = "Settings";
        obj.Page_key = "getAcademicSubject";
        obj.JSON = {};
        TransportCall(obj);
    }

    function getClassSubjects() {
        let obj = {};
        obj.Module = "Settings";
        obj.Page_key = "getClassSubjects";
        obj.JSON = {};
        TransportCall(obj);
    }

    function onSuccess(rc) {

        if (rc.return_code) {
            switch (rc.Page_key) {
                case "getSubjects":
                    loadSelect("#Subject", rc.return_data);
                    break;
                case "getClassSection":
                    loadSelect("#Class", rc.return_data);
                    break;
                case "getClassSubjects":
                    loadtable(rc.return_data);
                    break;
                case "addClassSubject":
                    console.log(rc.return_data);
                    $("#modal-lg").modal("hide");
                    getClassSubjects();
                    break;
                case "addSubject":
                    console.log(rc.return_data);
                    $("#modal-md").modal("hide");
                    getSubjects();
                    break;
                default:
                    alert(rc.Page_key);
            }
        } else {
            alert("Error");
        }
        // alert(JSON.stringify(args));
    }

    function loadtable(data) {

        let table = $("#table");

        try {
            if ($.fn.DataTable.isDataTable($(table))) {
                $(table).DataTable().destroy();
            }
        } catch (ex) {}

        let text = "";

        $("#table tbody").html("");
        if (data.length === 0) {
            text += "<tr><td>No Data Found</td></tr>";
        } else {
            for (let i = 0; i < data.length; i++) {
                text += '<tr> ';

                text += '<td> ' +  (i + 1) + '</td>';
                if (data[i].isCompulsory == 1 && data[i].isPreferredSubject == 1)
                    text += '<th class="text-primary">';
                else if (data[i].isCompulsory == 1 && data[i].isPreferredSubject == 0)
                    text += '<th class="text-warning">';
                else if (data[i].isCompulsory == 0 && data[i].isPreferredSubject == 0)
                    text += '<th class="text-danger">';
                else
                    text += '<th>';
                text += $("#Class option[value='" +data[i].ClassID + "']").text() + '</th>';
                text += '<td> ' + data[i].SubjectAlias + '</td>';
                text += '<td class="btn-group btn-group-sm">';
                // text += '   <a class="btn btn-primary btn-sm" href="#"> <i class="fas fa-folder"> </i> View </a>';
                text += '   <a class="btn btn-info btn-sm text-white" onclick="onEdit(\'' + escape(JSON.stringify(data[i])) + '\')"> <i class="fas fa-pencil-alt"> </i> </a>';
                text += '   <a class="btn btn-danger btn-sm text-white" onclick="onDelete(' + data[i].AcademicSubjectID + ')"> <i class="fas fa-trash"> </i> </a>';
                text += '</td>';
                text += '</tr >';
            }
        }

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

    $("#btnAddSubject").click(function () {
        let obj = {};
        obj.Module = "Settings";
        obj.Page_key = "addSubject";
        let json = {};
        json.SubjectName = $("#SubjectName").val();
        json.SubjectAlias = $("#SubjectAlias").val();
        obj.JSON = json;
        TransportCall(obj);
    });

    $("#btnAddClassSubject").click(function () {
        let obj = {};
        obj.Module = "Settings";
        obj.Page_key = "addClassSubject";
        let json = {};
        json.ClassID = $("#Class option:selected").val();
        json.SubjectID = $("#Subject").val();
        json.isCompulsory = $("#isCompulsory").prop("checked");
        json.isPreferredSubject = $("#isPreferredSubject").prop("checked");
        obj.JSON = json;
        TransportCall(obj);
    });


    function onEdit(Subjects) {
        debugger;
        Subjects = JSON.parse(unescape(Subjects));
        console.log(Subjects);
        $("#Class option:selected").val(Subjects.ClassID);
        $("#Subject option:selected").val((Subjects.SubjectID).split(","));
        $("#modal-lg").modal("show");
    }
</script>