<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="maincontent">
    <section class="content">
        <div class="container-fluid">
            <div class="card col-md-5 mx-auto mt-5">

                <div class="card-header">

                    <div class="h2 text-center mb-4">
                        Change Password
                    </div>
                </div>

                <div class="card-body px-lg-4 py-lg-4">
                    <form role="form">
                        <div class="form-group mb-3">
                            <input type="password" id="oldpassword" class="form-control" placeholder="Old Password" autocomplete="off">
                        </div>

                        <div class="form-group mb-3">
                            <input type="password" id="newpassword" class="form-control" placeholder="New Password" autocomplete="off">
                        </div>

                        <div class="form-group mb-3">
                            <input type="password" id="confirmpassword" class="form-control" placeholder="Confirm Password" autocomplete="off">
                        </div>

                        <div class="text-center">
                            <button type="button" class="btn btn-primary my-4" id="btnChangePassword">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
    $("#btnChangePassword").click(function() {

        if ($("#oldpassword").val() == $("#newpassword").val()) {
            notify("error","You cannot set this password");
            return;
        } else if ($("#newpassword").val() != $("#confirmpassword").val()) {
            notify("error","New Password and Confirm Password doesn't match");
            return;
        }

        var obj = new Object();
        obj.Module = "Auth";
        obj.Page_key = "ChangePassword";
        var json = new Object();
        json.oldpassword = $("#oldpassword").val();
        json.newpassword = $("#newpassword").val();
        json.confirmpassword = $("#confirmpassword").val();

        obj.JSON = json;
        SilentTransportCall(obj);
    });

    function onSuccess(rc) {

        if (rc.return_code) {
            switch (rc.Page_key) {
                case "ChangePassword":
                    debugger;
                    alert(rc.return_data)
                    // notification("success", rc.return_data);
                    break;
            }
        } else {
            alert( "Error");
        }
        // alert(JSON.stringify(args));
    }

    function onError(args) {
        alert(JSON.stringify(args));
    }
</script>