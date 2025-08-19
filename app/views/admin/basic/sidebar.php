<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->


        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div class="dropdown sidebar-user m-1 rounded">
        <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="d-flex align-items-center gap-2">
                <img class="rounded header-profile-user" src="assets/images/users/avatar-1.jpg" alt="Header Avatar">
                <span class="text-start">
                    <span class="d-block fw-medium sidebar-user-name-text">Anna Adame</span>
                    <span class="d-block fs-14 sidebar-user-name-sub-text"><i class="ri ri-circle-fill fs-10 text-success align-baseline"></i> <span class="align-middle">Online</span></span>
                </span>
            </span>
        </button>

    </div>
    <div id="scrollbar">
        <div class="container-fluid">


            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">NIC HR</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="dashboard" role="button">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                    </a>

                </li> <!-- end Dashboard Menu -->


                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Pages</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#vendor" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="vendor">
                        <i class="ri-account-circle-line"></i></i> <span data-key="vendor">Employee</span>
                    </a>
                    <div class="collapse menu-dropdown" id="vendor">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="employee-list" class="nav-link" data-key="t-basic-tables">List</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a href="vendor-approved" class="nav-link" data-key="t-grid-js">Approved</a>
                            </li>
                            <li class="nav-item">
                                <a href="vendor-rejected" class="nav-link" data-key="t-list-js">Rejected</a>
                            </li> -->

                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#Work" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="Work">
                        <i class="ri-account-circle-line"></i></i> <span data-key="Delivery">Work</span>
                    </a>
                    <div class="collapse menu-dropdown" id="Work">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="work-add" class="nav-link" data-key="t-grid-js">Add</a>
                            </li>
                            <li class="nav-item">
                                <a href="work-assign" class="nav-link" data-key="t-basic-tables">Assign</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#Location" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="Work">
                        <i class="ri-account-circle-line"></i></i> <span data-key="Delivery">Location</span>
                    </a>
                    <div class="collapse menu-dropdown" id="Location">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="location-add" class="nav-link" data-key="t-grid-js">Add</a>
                            </li>

                        </ul>
                    </div>
                </li>


                <li class="nav-item">
                    <a class="nav-link menu-link" href="#Allowance" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="Work">
                        <i class="ri-account-circle-line"></i></i> <span data-key="Delivery">Allowance</span>
                    </a>
                    <div class="collapse menu-dropdown" id="Allowance">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="deo-allowancemaster" class="nav-link" data-key="t-grid-js">Master Entry</a>
                            </li>

                        </ul>
                    </div>
                </li>






            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<script src="assets/admin/plugins/jquery/jquery.min.js"></script>
<script src="assets/js/CallService.js"></script>
<script src="assets/js/commonfunctions.js"></script>
<script src="assets/js/md5.js"></script>