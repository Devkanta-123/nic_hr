<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.3.0/raphael.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
<style>
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-50px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .slide-in {
        animation: slideIn 0.5s ease-in-out;
    }

    .custom-dropdown {
        min-width: 1;
        border: none;
    }

    .camera-icon {
        position: absolute;
        bottom: 0;
        right: 0;
        background-color: #0D9276;
        border-radius: 50%;
        padding: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
    }




    #fileInput {
        display: none;
        /* Hide the file input initially */
    }

    .camera-icon {
        cursor: pointer;
        /* Set cursor to pointer for the camera icon, indicating it's clickable */
    }


    .months {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 20px;
        font-size: 16px;
        width: 160px;
        height: 43px;
        /* Adjust the width as needed */
        outline: none;
        /* Remove default outline */
        cursor: pointer;
        /* Show pointer cursor on hover */
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        /* Add a subtle box shadow */

    }

    .custom-btn {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 20px;
        font-size: 16px;
        width: 100px;
        height: 43px;
        /* Adjust the width as needed */
        outline: none;
        /* Remove default outline */
        cursor: pointer;
        /* Show pointer cursor on hover */
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        /* Add a subtle box shadow */
        background-color: #3498db;
        /* Example color - adjust as per your design */
        color: #fff;
        /* Text color - white in this example */

    }



    .staffs:hover,
    .staffs:focus {
        border-color: #4CAF50;
        /* Change border color on hover or focus */
    }

    /* Add animation to icons */
    .icon-animation {
        animation: spin 2s infinite linear;
        /* You can replace 'spin' with your preferred animation */
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* Set font size for icons */
    .icon-size {
        font-size: 24px;
        /* You can adjust the value to change the size */
    }

    /* Set colors for icons */
    .icon-color {
        color: #3498db;
        /* You can replace '#3498db' with your preferred color code */
    }

    .card-title {
        margin-top: 10px;
        /* Adjust the value as needed */
    }

    /* CSS to set font-weight to normal for all labels */
    #leaveChart text {
        font-weight: normal;
    }

    .stylish-card {
        background: rgba(255, 255, 255, 0.8);
        /* White background with transparency */
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* Soft shadow */
    }

    .stylish-card .main {
        padding: 20px;
    }

    .stylish-card .name {
        font-size: 18px;
        font-weight: bold;
        color: #333;
    }

    .stylish-card .account {
        font-size: 14px;
        color: #666;
    }

    .stylish-card .link {
        display: block;
        margin-top: 10px;
        font-weight: bold;
        color: #007bff;
    }

    .stylish-card .comment {
        display: block;
        margin-top: 10px;
        font-weight: bold;
        color: #28a745;
        /* Green color for approved */
    }

    .stylish-card p {
        margin-top: 10px;
        font-size: 14px;
        color: #666;
    }

    .stylish-card .icon img {
        width: 100px;
        /* Set width of the image */
        height: 100px;
        /* Set height of the image */
        border-radius: 50px;
        /* Apply rounded corners */

    }

    .stylish-card {
        display: flex;
        /* Use flexbox for layout */
        background: rgba(255, 255, 255, 0.8);
        /* White background with transparency */
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* Soft shadow */
    }

    .stylish-card .main {
        display: flex;
        /* Use flexbox for layout within main */
        padding: 20px;
    }

    .stylish-card .left {
        flex: 1;
        /* Take up half of the available space */
    }

    .stylish-card .right {
        flex: 1;
        /* Take up half of the available space */
        /* Add styling for the content on the right side */
    }

    .custom-badge {
        padding: 5px 8px;
        line-height: 7px;
        border: 1px solid;
        font-weight: 300;
        font-size: 13px;
        border-radius: 20px;
    }

    .col-orange {
        color: #ff9800 !important;
    }

    .col-red {
        color: #EE4E4E !important;
    }

    .col-green {
        color: #4CCD99 !important;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="../index3.html" class="nav-link">DEO Section  </a>
        </li>

    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                <i class="far fa-user"></i>

            </a>
            <div class="dropdown-menu dropdown-menu-xs dropdown-menu-right" style="left: inherit; right: 0px;">

                <div class="dropdown-divider"></div>
                <a href="changepassword" class="dropdown-item">
                    <i class="fas fa-key"> Change Password</i>
                </a>
                <div class="dropdown-divider"></div>
                <a data-target="#LogoutModal" data-toggle="modal" class="dropdown-item">
                    <i class="fas fa-sign-out-alt"> Logout</i>

                </a>

            </div>
        </li>


    </ul>
</nav>
<!-- /.navbar -->


<div class="content-wrapper" style="min-height: 504px;">
    <div class="content-header">
        <div class="container-fluid">
           
        </div>
    </div>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-widget widget-user stylish-card">
                    <div class="main">
                        <div>
                            <div class="icon" id="userImageContainer">
                                <img id="userImage" class="img" alt="User Image">
                            </div>

                            <span class="name" id="StaffName">John Doe</span> - <span id="Designation">UI/UX Designer</span>
                            <p>Phone : <span id="ContactNo"> </span></p>
                            <p>Email ID : <span id="EmailID"></span></p>
                            <p> Address : <span id="Address"> </span></p>

                            <!-- <span class="link text">TOTAL LEAVES : <span id="totalStaffLeaves"></span></span>
                    <span class="comment text">TOTAL HALFDAY : <span id="totalStaffHalfDays"> </span></span> -->
                            <i class="fa fa-clock"> &nbsp;</i><span>Check In : <span id="EntryDateTime"> </span> , <span id="StaffINTime"></span></span>
                            <!-- <span >Check In <p ></p></span> -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Leave </h3> &nbsp;
                        <div id="leaveChart" style="height: 200px;"></div>

                        <!-- Legend container -->
                        <div id="legendContainer"></div>

                    </div>



                </div>


            </div>
        </div>




        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">For The Month of : </h3> &nbsp;
                        <select class="months" id="getMonths">
                        </select>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <ul class="products-list product-list-in-card pl-2 pr-2">
                            <li class="item">
                                <div class="product-img">
                                    <i class="fas icon-size icon-color fa-user-check"></i>
                                </div>

                                <div class="product-info">
                                    <a href="javascript:void(0)" class="product-title">Present
                                        <span class="badge badge-success float-right" id="TotalPresents"></span></a>
                                </div>
                            </li>

                            <li class="item">
                                <div class="product-img">
                                    <i class="fas  icon-size icon-color fa-times-circle"></i>
                                </div>

                                <div class="product-info">
                                    <a href="javascript:void(0)" class="product-title">Absent
                                        <span class="badge badge-danger float-right" id="TotalAbsents">0</span></a>
                                </div>
                            </li>

                        </ul>
                    </div>

                </div>


            </div>



            <!-- <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <p class="card-title">Leave Types Overview</p>
                        <div id="leaveChart">
                        </div>


                    </div>
                </div>


            </div> -->
            <div class="col-md-6">

                <div class="card direct-chat direct-chat-warning">
                    <div class="card-header">
                        <h3 class="card-title">Warning</h3>

                    </div>

                    <div class="card-body">
                        <div class="direct-chat-messages">
                            <!-- Staff warning messages will be dynamically inserted here -->
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-md-12">

                <div class="card direct-chat direct-chat-warning">
                    <div class="card-header">
                        <h3 class="card-title" id="CurrentMonth"></h3>

                    </div>

                    <div class="card-body">
                        <div class="card-body table-responsive p-0" style="height: 200px;">
                            <table class="table table-head-fixed text-nowrap" id="loadStaffAttendance">
                                <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>Date/Intime<span id="inTimeForSTaff" style="font-size:10px;"></span></th>
                                        <th>Late</th>
                                        <th>OutTime<span id="outTimeForSTaff" style="font-size:10px;"></span></th>
                                        <th>OverWork</th>
                                        <th>Status</th>
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

    </section>

</div>
</div>

<!-- Profile Modal -->


<!-- End Here -->


<!-- logout Modal -->

<div class="modal fade" id="LogoutModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center" id="output"></p>
                <p class="text-center">Click Yes If You Are Sure.</p>
            </div>
            <div class="modal-footer justify-content-between border-0">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                <a href="logout" type="button" class="btn btn-info btn-sm">Yes</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- End Here -->


<script>
   
</script>