<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="assets/logo.png">
    <title>PrayagEdu</title>
    <!-- Canonical SEO -->
    <link rel="canonical" href="https://techz.in" />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="//use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Nucleo Icons -->
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="assets/css/argon-design-system.min.css?v=1.0.2" rel="stylesheet" />

</head>

<body class="register-page">
    <noscript>
        Please enable javascript support
    </noscript>
    <div class="wrapper">
        <div class="page-header bg-default">
            <div class="page-header-image" style="background-image: url('assets/img/ill/register_bg.png');"></div>
            <div class="container" id="container">
                <div class="form-container sign-up-container">
                    <form action="javascript:;">
                        <h2 class="mb-4">Create Account</h2>
                        <div class="form-group mb-3">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                </div>
                                <input class="form-control" placeholder="Name" type="text">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                </div>
                                <input class="form-control" placeholder="Email" type="email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input class="form-control" placeholder="Password" type="password" required>
                            </div>
                        </div>
                        <button class="btn btn-primary">Sign Up</button>
                    </form>
                </div>
                <div class="form-container sign-in-container">
                    <?php
                    if (isset($_SESSION['messagetype'])) {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <span class="alert-inner--icon"><i class="ni ni-support-16"></i></span>
                                <span class="alert-inner--text"><strong>Error!</strong> ' . $_SESSION['message'] . '</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                </button>
                            </div>';

                        unset($_SESSION['messagetype']);
                    }
                    ?>
                    <form action="" id="login-form" role="form" method="POST">
                        <h2 class="mb-4">Sign in</h2>
                        <div class="form-group mb-3">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                </div>
                                <input class="form-control" placeholder="Username" type="text" id="Username" name="Username" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input class="form-control" placeholder="Password" type="password" id="Password" name="Password" required>
                            </div>
                        </div>
                        <a href="javascript:;">Forgot your password?</a>
                        <button class="btn btn-primary mt-3">Sign In</button>
                    </form>
                </div>
                <div class="overlay-container">
                    <div class="overlay">
                        <div class="overlay-panel overlay-left">
                            <h1 class="text-white">Welcome Back!</h1>
                            <p>
                                To keep connected with us please login with your personal info
                            </p>
                            <button class="btn btn-neutral btn-sm" id="signIn">Sign In</button>
                        </div>
                        <div class="overlay-panel overlay-right">
                            <h1 class="text-white h2">Welcome to PrayagEdu e-Learning Portal 2020</h1>
                            <p>Enter your details and start journey with us</p>
                            <!-- <button class="btn btn-neutral btn-sm" id="signUp">Sign Up</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // The SignUp/SignIn form

            const signUpButton = document.getElementById('signUp');
            const signInButton = document.getElementById('signIn');
            const container = document.getElementById('container');

            signUpButton.addEventListener('click', () => {
                container.classList.add('right-panel-active');
            });

            signInButton.addEventListener('click', () => {
                container.classList.remove('right-panel-active');
            });
        </script>
        <footer class="footer">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-6">
                        <div class="copyright">
                            &copy; <?php echo date("Y"); ?> <a href="https://techz.in/" target="_blank">NIC HRPrivate Limited</a>.
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!--   Core JS Files   -->
    <script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="//buttons.github.io/buttons.js"></script>
    <script src="assets/js/argon-design-system.min.js?v=1.0.2" type="text/javascript"></script>
    <script src="assets/js/md5.js"></script>
    <script src="assets/js/loader/loadingoverlay.js"></script>

</body>

<script>
    $('#Password').on('keypress', function(e) {
        if (e.which == 13) {
            AuthCall();
        }
    });

    $(document).on('keypress', 'input', function(e) {
        if (e.which == 13) {
            e.preventDefault();
            var $next = $('[tabIndex=' + (+this.tabIndex + 1) + ']');
            console.log($next.length);
            if (!$next.length) {
                $next = $('[tabIndex=1]');
            }
            $next.focus();
        }
    });

    $("#login-form").on('submit', function(e) {

        e.preventDefault();
        AuthCall();
    });


    function AuthCall() {

        try {

            var json = new Object();
            json.Username = $("#Username")[0].value;
            json.Password = $("#Password")[0].value;

            var svcdta = new Object();
            svcdta.Module = "auth";
            svcdta.Page_key = "Login";
            svcdta.JSON = json;

            Authenticate(svcdta);
        } catch (ex) {
            console.log(ex.stack);
            alert(ex.stack);
        }

    }

    var ipaddress;
    $(document).ready(function() {
        sessionStorage.clear();
        localStorage.clear();

        $("#Username")[0].focus();
    });
    var msgToDisplay;



    function clearForm() {
        $("#Username")[0].value = "";
        $("#Password")[0].value = "";
        $("#Username")[0].focus();
    }

    function Authenticate(svcdta) {

        $.LoadingOverlay("show");
        svcdta.MSC = $.md5(new Date().getDate().toString().padStart(2, "0"));
        var data = JSON.stringify(svcdta);
        $.ajax({
            data: data,
            type: 'POST',
            dataType: 'json',
            contentType: 'application/json',
            async: false,
            url: "index.php",
            success: function showData(arg) {
                onSuccess(arg);
            },
            error: function err(arg) {
                $.LoadingOverlay("hide");

                console.log(JSON.stringify(arg));

                if (arg.status == 404)
                    alert(arg.statusText);
                else if (arg.status == 0) {
                    alert(arg.statusText);
                } else {

                }
            }
        });
    }


    //on success call
    function onSuccess(rc) {

        $.LoadingOverlay("hide");
        console.log(JSON.stringify(rc));

        if (rc.return_code) // data was recieved successfully 
        {
            var f = rc.return_data;
            sessionStorage.setItem("PrayagEdu_user", f.username);
            sessionStorage.setItem("PrayagEdu_session", f.sessionkey);
            window.open(f["nextPage"], '_self');
        } else //data was recieved successfully but was returned by service with error code
        {
            try {
                alert(rc.return_data);
                clearForm();
            } catch (ex) {
                alert(ex.stack);
            }
        }
        //Hideloadingpanle();

    }
</script>

</html>