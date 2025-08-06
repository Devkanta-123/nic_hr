<!--<link href="assets/js/plugins/icheck-bootstrap/icheck-bootstrap.min.css" rel="stylesheet">-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-4 card-title"> Logs</div>
                                <div class="col-sm-4 text-center"><a href="file?type=log" target="_blank">view in full screen</a></div>
                                <div class="col-sm-4 text-right"><button type="button" id="test" class="btn btn-primary">Test Function</button></div>

                                <div class="col-sm-4 text-right"><button type="button" id="clear-logs" class="btn btn-primary">Clear log</button>
                                <button class="btn btn-sx btn-warning" onclick="newappnotice()"> New Notice</button>

                                    </div>

                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <object data="file?type=log" style="width:100%; height:75vh !important;">
                                Not supported
                            </object>
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

<script>

function newappnotice() {
        let obj = {};
        obj.Module = "Administration";
        obj.Page_key = "getNoticeForApp";
        obj.JSON = {};
        TransportCall(obj);
    }
    
    document.title="Logs";
    $('#clear-logs').click(function() {
        if (confirm("Clear logs?")) {
            let obj = {};
            obj.Module = "Settings";
            obj.Page_key = "clearLog";
            obj.JSON = {};
            TransportCall(obj);
        }
    })
 $('#test').click(function() { 
            let obj = {};
            obj.Module = "Settings";
            obj.Page_key = "testFunction";
            obj.JSON = {};
            TransportCall(obj);
    
    })
    function onSuccess(rc) {
        if (rc.return_code) {
            switch (rc.Page_key) {
                case "clearLog":
                    notify("success", rc.return_data);
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                    break;
                default:
                    notify("error", rc.return_data);
            }
        } else {
            notify("error", rc.return_data);
        }
    }
</script>