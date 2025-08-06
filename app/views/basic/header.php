<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/logo.png">
    <link rel="icon" type="image/png" href="assets/logo.png">
    <title>
        PrayagEdu
    </title>
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

<body>
    <nav class="navbar  navbar-top navbar-expand-lg navbar-dark bg-default  navbar-fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="javascript:;">
                <img src="assets/logo.png" alt="PrayagEdu"> PrayagEdu
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-default">
                <div class="navbar-collapse-header">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            <a href="home" class="nav-link">
                                <img src="assets/logo.png">
                            </a>
                        </div>
                        <div class="col-6 collapse-close">
                            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <ul class="navbar-nav ml-lg-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="home">
                            <i class="fa fa-home"></i>
                            <span class="nav-link-inner--text">Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Contactus">
                            <span class="nav-link-inner--text">Contact Us</span>
                        </a>
                    </li>
                    <?php if (isset($_SESSION['SessionKey']) && isset($_SESSION['UserID'])) {
                        echo    '<li class="nav-item dropdown">
                                    <a class="nav-link nav-link-icon dropdown-toggle" href="javascript:;" id="navbar-default_dropdown_2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ni ni-circle-08"></i>
                                        <span class="nav-link-inner--text d-lg-none">Profile</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-default_dropdown_2">
                                        <div class="dropdown-divider"></div>
                                        <a href="logout" class="dropdown-item">
                                            <i class="ni ni-user-run"></i>
                                            <span>Logout</span>
                                        </a>
                                    </div>
                                </li>';
                    } else {

                        echo    '<li class="nav-item">
                                    <a class="nav-link nav-link-icon" href="login">
                                        <span class="nav-link-inner--text">Login</span>
                                        <i class="ni ni-button-power"></i>
                                    </a>
                                </li>';
                    }
                    ?>

                </ul>
            </div>
        </div>
    </nav>

    <div style="min-height: 400px;">

        <div class="container">

            <?php
            if (isset($_SESSION["messagetype"]) && $_SESSION["messagetype"]) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                    <span class="alert-inner--text"><strong>Success!</strong> ' . $_SESSION["message"] . '</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>';
            } else if (isset($_SESSION["messagetype"]) && !$_SESSION["messagetype"]) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="alert-inner--icon"><i class="fa fa-times"></i></span>
                    <span class="alert-inner--text"><strong>Error!</strong> ' . $_SESSION["message"] . '</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>';
            }

            unset($_SESSION['messagetype']);
            unset($_SESSION['message']);
            ?>
        </div>