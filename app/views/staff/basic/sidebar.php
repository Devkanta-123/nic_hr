<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="ITPLlogo.png" alt="Logo" class="brand-image" style="opacity: .8">
        <span class="brand-text font-weight-dark h5 text-info p-2 ">ITPL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="home" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Staff Dashboard</p>
                    </a>
                </li>

              



                <!-- Administration -->
                <!-- <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-user"></i>
                        <p>
                            Admintration
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="administration-notice" class="nav-link">
                                <i class="fa fa-list "></i>
                                <p>Notice</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-list "></i>
                                <p>Leave</p>
                            </a>
                        </li>
                        
                    </ul>
                </li> -->

                <!-- Leave li start here -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-calendar-plus"></i>
                        <p>
                            Leave
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="staff-staffleaverequest" class="nav-link">
                                <i class="fas fa-plus"></i>
                                <p>Request Leave</p>
                            </a>
                        </li>
                      
                    </ul>


                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="staff-userleavereport" class="nav-link">
                                <i class="fas fa-file"></i>
                                <p>My Leave Report</p>
                            </a>
                        </li>
                      
                    </ul>





                </li>
                <!-- Leave li ends here  -->


   <!-- Task li start here -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-check"></i>
                        <p>
                           Task
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="staff-createtask" class="nav-link">
                                <i class="fas fa-plus"></i>
                                <p>Create Task</p>
                            </a>
                        </li>
                      
                        <li class="nav-item">
                            <a href="staff-taskboard" class="nav-link">
                                <i class="fas fa-plus"></i>
                                <p>Task Board</p>
                            </a>
                        </li>
                      
                    </ul>
                </li>
  <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-check"></i>
                        <p>
                           Warning
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="staff-warnings" class="nav-link">
                                <i class="fas fa-plus"></i>
                                <p>Add Warning</p>
                            </a>
                        </li>
                      
                        <!-- <li class="nav-item">
                            <a href="staff-taskboard" class="nav-link">
                                <i class="fas fa-plus"></i>
                                <p>Task Board</p>
                            </a>
                        </li> -->
                      
                    </ul>
                </li>


                
                <!-- Task li ends here  -->
                



                <!-- logout -->
                <!-- <li>
                    <a href="logout" class="nav-link btn btn-danger text-white text-left">
                        <i class="fas fa-lock nav-icon"></i>
                        <p class="">Logout</p>
                    </a>
                </li> -->

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>


<!-- jQuery -->
<script src="assets/admin/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="assets/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/admin/js/adminlte.js"></script>
<!-- Select2 -->
<script src="assets/admin/plugins/select2/js/select2.full.min.js"></script>

<!-- SweetAlert2 -->
<script src="assets/admin/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="assets/admin/plugins/toastr/toastr.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<script src="assets/js/CallService.js"></script>

<script src="assets/js/commonfunctions.js"></script>
<script src="assets/js/md5.js"></script>
<!-- <script src="assets/js/index.js"></script> -->