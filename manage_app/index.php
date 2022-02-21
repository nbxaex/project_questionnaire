<?php
ob_start();
session_start();
if ($_SESSION['session_icadmin'] == true or $_COOKIE['cookie_icadmin'] == true) {
    require 'lib/connect.php';
    require 'lib/mudule.php';
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/png" href="./img/ico/emoji.png" />

        <title>Survey | Admin</title>

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">

        <!-- Custom styles for this page -->
        <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

        <!--- For Select -->
        <link href="css/select2.min.css" rel="stylesheet">

        <!-- For Before Upload -->
        <link href="bootstrap-fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
        <link href="bootstrap-fileinput/themes/explorer-fas/theme.css" media="all" rel="stylesheet" type="text/css" />

        <!-- CSS FancyBox -->
        <link rel="stylesheet" type="text/css" href="fancybox/dist/jquery.fancybox.min.css">

        <!-- Css Summernote -->
        <link rel="stylesheet" type="text/css" href="summernote/summernote-bs4.css">

        <!-- Date picker -->
        <link href="css/bootstrap-datepicker.css" rel="stylesheet" />

    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            ​<?php require 'require_file/left-menu.php'; ?>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <!-- Topbar Search -->
                        <!--<form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">





                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <?php
                                if ($_SESSION['session_icadmin'] != "" and $_COOKIE['cookie_icadmin'] == "") {
                                    $sql_usersadmin = " SELECT * FROM users WHERE accesstokens = '" . $_SESSION['session_icadmin'] . "'";
                                }
                                if ($_SESSION['session_icadmin'] != "" and $_COOKIE['cookie_icadmin'] != "") {
                                    $sql_usersadmin = " SELECT * FROM users WHERE accesstokens = '" . $_COOKIE['cookie_icadmin'] . "'";
                                }
                                if ($_SESSION['session_icadmin'] == "" and $_COOKIE['cookie_icadmin'] != "") {
                                    $sql_usersadmin = " SELECT * FROM users WHERE accesstokens = '" . $_COOKIE['cookie_icadmin'] . "'";
                                }
                                $result_usersadmin = mysqli_query($conn, $sql_usersadmin);
                                $rs_usersadmin = mysqli_fetch_assoc($result_usersadmin);
                                ?>
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $rs_usersadmin['name'] ?></span>
                                    <?php if ($rs_usersadmin['picture'] != "") { ?>
                                        <img class="img-profile rounded-circle" src="../images/images_profile/<?= $rs_usersadmin['picture'] ?>">
                                    <?php } else { ?>
                                        <i class="far fa-user-circle fa-2x"></i>
                                    <?php } ?>
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="index.php?mn=users&file=users_list">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        บัญชีผู้ใช้
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        ออกจากระบบ
                                    </a>
                                </div>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <?php require 'content_topic.php'; ?>
                        <?php require 'file_request.php'; ?>
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span> </span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ยืนยัน ออกจากระบบ</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">เลือก "ออกจากระบบ" ที่ปุ่มด้านล่าง</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                        <a class="btn btn-primary" href="logout.php">ออกจากระบบ</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Switch alert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>


        <!-- Custom scripts for all pages-->

        <script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/datatables-demo.js"></script>

        <!-- Before Upload -->
        <script src="bootstrap-fileinput/js/plugins/piexif.js" type="text/javascript"></script>
        <script src="bootstrap-fileinput/js/plugins/sortable.js" type="text/javascript"></script>
        <script src="bootstrap-fileinput/js/fileinput.js" type="text/javascript"></script>
        <script src="bootstrap-fileinput/js/locales/fr.js" type="text/javascript"></script>
        <script src="bootstrap-fileinput/js/locales/es.js" type="text/javascript"></script>
        <script src="bootstrap-fileinput/js/locales/th.js" type="text/javascript"></script>
        <script src="bootstrap-fileinput/themes/fas/theme.js" type="text/javascript"></script>
        <script src="bootstrap-fileinput/themes/explorer-fas/theme.js" type="text/javascript"></script>

        <!-- Page Manage Users -->
        <script src="js/jquery-app-user.js"></script>

        <!-- Page Autocomplete Province Amphur Distict -->
        <script src="js/typeahead.js"></script>

        <!-- Fancy Box -->
        <script src="fancybox/dist/jquery.fancybox.js"></script>

        <!-- SummerNote -->
        <script src="summernote/summernote-bs4.min.js"></script>
        <script src="summernote/lang/summernote-th-TH.js"></script>

        <!-- Pgae Select Form -->
        <script src="js/select/select2.min.js"></script>

        <!-- Date picker -->
        <script src="js/bootstrap-datepicker-custom.js"></script>
        <script src="js/bootstrap-datepicker.th.min.js" charset="UTF-8"></script>
        <script>
            $('.file-name').on('change', function() {
                //get the file name
                var fileName = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            })
        </script>
    </body>

    </html>
<?php } else {
    header("Location: login.php");
} ?>