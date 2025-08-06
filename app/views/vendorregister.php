<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">


<!-- Mirrored from themesbrand.com/velzon/html/master/auth-signin-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 14 Aug 2024 05:24:47 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Ongyi Vendor Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- dropzone css -->
    <link rel="stylesheet" href="assets/libs/dropzone/dropzone.css" type="text/css" />

    <!-- Filepond css -->
    <link rel="stylesheet" href="assets/libs/filepond/filepond.min.css" type="text/css" />
    <link rel="stylesheet" href="assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css">

    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="index.html" class="d-inline-block auth-logo">
                                    <img src="assets/images/logo-light.png" alt="" height="20">
                                </a>
                            </div>
                            <p class="mt-3 fs-15 fw-medium">Premium Admin & Dashboard Template</p>
                        </div> -->
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-8">
                        <div class="card mt-4 card-bg-fill">

                            <div class="card-body p-12">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Vendor Register</h5>
                                    <p class="text-muted">Sign in to continue to ongyi</p>
                                </div>
                                <div class="row gy-12">
                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" placeholder="Full Name" autocomplete="off">
                                        </div>

                                    </div>

                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <div>
                                                <label for="dob" class="form-label">Date of Birth</label>
                                                <input type="date" class="form-control" id="dob" placeholder="Date of Birth" autocomplete="off">
                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <div>
                                                <label for="dob" class="form-label">Address</label>
                                                <input type="text" class="form-control" id="address" placeholder="Address" autocomplete="off">
                                            </div>

                                        </div>

                                    </div>


                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="username" class="form-label">Account No</label>
                                            <input type="text" class="form-control" id="accountNo" placeholder="Account No" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="labelInput" class="form-label">Account Holder</label>
                                            <input type="text" class="form-control" id="accountholder" placeholder="The full name of the account holder" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="labelInput" class="form-label">Bank Name</label>
                                            <input type="text" class="form-control" id="bankName" placeholder="Enter username" autocomplete="off">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="labelInput" class="form-label">Bank Branch</label>
                                            <input type="text" class="form-control" id="bankBranch" placeholder="Bank Branch Name" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="labelInput" class="form-label"> IFSC code(11 digits)</label>
                                            <input type="text" class="form-control" id="ifsc" placeholder=" IFSC code" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="labelInput" class="form-label">Contact No</label>
                                            <input type="number" class="form-control" id="contactNo" placeholder="Contact No" autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <h5 class="fs-15 mb-3">Bussiness/Restaurant Registration Certificate</h5>
                                    <div class="row g-12">
                                        <div class="col-lg-12">
                                            <div class="input-group">
                                                <input type="file" class="form-control" id="rrc">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h5 class="fs-15 mb-3">FSSAI Licence</h5>

                                    <div class="row g-3">

                                        <div class="col-lg-12">
                                            <div class="input-group">
                                                <input type="file" class="form-control" id="fssailicence">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <br>
                                <br>
                                <br>
                                <br>
                                <button type="button" class="btn btn-success btn-label right ms-auto nexttab nexttab" data-nexttab="pills-experience-tab" id="save-vendor">Register</button>
                                <div class="mt-5 text-center">
                                    <p class="mb-0">Register as Delivery <a href="delivery" class="fw-semibold text-primary text-decoration-underline"> Signup</a> </p>
                                </div>

                            </div>

                            </form>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
            </div>
        </div>
        <!-- end card -->


    </div>
    </div>
    <!-- end row -->
    </div>
    <!-- end container -->
    </div>
    <!-- end auth page content -->

    <!-- footer -->


    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0 text-muted">&copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script> Velzon. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->

    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!-- dropzone min -->
    <script src="assets/libs/dropzone/dropzone-min.js"></script>
    <!-- filepond js -->
    <script src="assets/libs/filepond/filepond.min.js"></script>
    <script src="assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js"></script>
    <script src="assets/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js"></script>
    <script src="assets/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js"></script>
    <script src="assets/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js"></script>

    <script src="assets/js/pages/form-file-upload.init.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="assets/js/app.js"></script>
    <script src="assets/js/md5.js"></script>
    <script src="assets/js/CallService.js"></script>
    <script src="assets/js/commonfunctions.js"></script>
    <script src="assets/js/loader/loadingoverlay.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Block Right Click
            $(document).on('contextmenu', function(e) {
                e.preventDefault(); // Prevent the context menu from opening
            });

            // Block Ctrl + U (View Source) and Ctrl + S (Save) Keyboard Shortcuts
            $(document).on('keydown', function(e) {
                // Check if the user pressed Ctrl + U
                if (e.ctrlKey && e.key === 'u') {
                    e.preventDefault(); // Prevent the default action (View Source)
                }

                // Check if the user pressed Ctrl + S
                if (e.ctrlKey && e.key === 's') {
                    e.preventDefault(); // Prevent the default action (Save)
                }
            });
        });


        $("#save-vendor").click(function() {
            saveVendor();
        });

        async function saveVendor() {
            debugger;
            let obj = {};
            let json = {};
            var rccFile = {};
            obj.Module = "Vendor";
            obj.Page_key = "saveVendor";
            json.ContactNo = $("#contactNo").val();
            json.AccountNo = $("#accountNo  ").val();
            json.BankName = $("#bankName ").val();
            json.AccountHolder = $("#accountholder ").val();
            json.BankBranch = $("#bankBranch ").val();
            json.Name = $("#name").val();
            json.DOB = $("#dob").val();
            json.Address = $("#address").val();
            json.IFSC = $("#ifsc ").val();
            var files = $('#rrc')[0].files;
            var licencefiles = $('#fssailicence')[0].files;
            // Get base64 data for the first file only
            if (files.length > 0) {
                var base64Data = await getBase64(files[0]);
                // Add base64 data to rccFile
                rccFile = {
                    rccFile: base64Data,
                    filename: files[0].name
                };
            }
            if (licencefiles.length > 0) {
                var base64Data = await getBase64(licencefiles[0]);
                // Add base64 data to rccFile
                driver_licence_path = {
                    driver_licence_path: base64Data,
                    filename: licencefiles[0].name
                }
            }

            // Add rccFile to the JSON object
            json.rccFile = rccFile;
            json.DriverLicencePath = driver_licence_path;
            obj.JSON = json;
            TransportCall(obj);
            console.log(JSON.stringify(obj, null, 2));
        }

        function getBase64(file) {
            return new Promise((resolve, reject) => {
                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function() {
                    resolve(reader.result);
                };
                reader.onerror = function(error) {
                    reject(error);
                };
            });
        }

        function onSuccess(rc) {
            debugger;
            if (rc.return_code) {
                switch (rc.Page_key) {
                    case "saveVendor":
                        showSuccessNotification(rc.return_data);
                        break;

                    default:
                        notify("error", rc.Page_key);
                }
                rc.return_data
            } else {
                notify("warning", rc.return_data);
            }
        }

        function onError() {

        }

        function showSuccessNotification(message) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: message,
                showConfirmButton: false,
                timer: 3000,
                toast: true,
            });
        }

        function showWarningNotification() {
            const warningMessage = "This is a warning notification!";
            Swal.fire({
                position: 'top-end',
                icon: 'warning',
                title: warningMessage,
                showConfirmButton: false,
                timer: 3000,
                toast: true,
            });
        }

        // Function to show a danger notification
        function showDangerNotification() {
            const dangerMessage = "This is a danger notification!";
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: dangerMessage,
                showConfirmButton: false,
                timer: 3000,
                toast: true,
            });
        }
    </script>
</body>


<!-- Mirrored from themesbrand.com/velzon/html/master/auth-signin-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 14 Aug 2024 05:24:48 GMT -->

</html>