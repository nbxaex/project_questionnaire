<?php
ob_start();
session_start();
require "lib/connect.php";

if ($_SESSION['session_icadmin'] == true or $_COOKIE['cookie_icadmin'] == true) {
    header('Location:index.php');
}
?>
<?php
if (isset($_SESSION['qaptcha_key']) && !empty($_SESSION['qaptcha_key'])) {
    $nipajoy_user1 = trim($_POST['username']);
    $nipajoy_pass1 = $_POST['userpassword'];
    $nipajoy_user = mysqli_real_escape_string($conn, $nipajoy_user1);
    $nipajoy_pass = mysqli_real_escape_string($conn, $nipajoy_pass1);
    if ($nipajoy_user && $nipajoy_pass) {
        $sql = " SELECT * FROM users 
        WHERE name = '$nipajoy_user' ";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $rs = mysqli_fetch_assoc($result);
        if (password_verify($nipajoy_pass, $rs['password']) == true) {
            $_SESSION['session_icadmin'] = $rs['accesstokens'];
            if ($_POST['member_me'] == 1) {
                setcookie('cookie_icadmin', $rs['accesstokens'], time() + 525600);
            }
            header('Location: index.php');
        } else {
            $no_pass = "<span class='text-danger'>รหัสผ่านไม่ถูกต้อง</span>";
            if ($rs['name'] == $nipajoy_user) {
                $old_user = $nipajoy_user;
            }
        }
        if ($rs['name'] != $nipajoy_user) {
            $no_user = "<span class='text-danger'>ชื่อผู้ใช้ไม่ถูกต้อง</span>";
        }
    } else {
        $sql_user = " SELECT name FROM users WHERE name = '$nipajoy_user' ";
        $result_user = mysqli_query($conn, $sql_user);
        $nums_user = mysqli_num_rows($result_user);
        if ($nums_user == 0) {
            $no_user = "<span class='text-danger'>กรุณากรอกชื่อผู้ใช้</span>";
        }

        $sql_pass = " SELECT password FROM users WHERE name = '$nipajoy_user' ";
        $result_pass = mysqli_query($conn, $sql_pass);
        $rs_pass = mysqli_fetch_assoc($result_pass);
        if (password_verify($nipajoy_pass, $rs_pass['password']) == false) {
            $no_pass = "<span class='text-danger'>กรุณากรอกรหัสผ่าน</span>";
        }
    }
}
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
    <title>Survey - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/QapTcha.jquery.css">
    <!-- Slide Button And Load page -->
    <link rel="stylesheet" type="text/css" href="css/controller-login.css">

</head>

<body class="bg-gradient-dark">
    <div class="se-pre-con"></div>
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-3 d-none d-lg-block bg-while"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">
                                            <div class="sidebar-brand-icon rotate-n-0">
                                                <a class="text-dark" href="../index.php"><i class="fas fa-poll"></i></a> SURVEY<sup></sup>
                                            </div>
                                        </h1>
                                    </div>
                                    <form class="user" action="" method="POST">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="ชื่อผู้ใช้ ..." name="username" value="<?= $old_user ?>">
                                            <?= $no_user ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="รหัสผ่าน" name=userpassword>
                                            <?= $no_pass ?>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck" name="member_me" value="1">
                                                <label class="custom-control-label" for="customCheck">
                                                    จดจำข้อมูลไว้</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="QapTcha"></div>
                                        </div>
                                        <input type="submit" value="Login" class="btn btn-primary btn-user btn-block d-none">
                                        <div class="clr"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Slide Login js -->
    <script type="text/javascript" src="js/slide-login/jquery-1.8.2.js"></script>
    <script type="text/javascript" src="js/slide-login/jquery-ui.js"></script>
    <script type="text/javascript" src="js/slide-login/jquery.ui.touch.js"></script>
    <script type="text/javascript" src="js/slide-login/QapTcha.jquery.js"></script>
    <script type="text/javascript" src="js/modernizr.js"></script>
    <script type="text/javascript" src="js/preslidebutton.js"></script>
</body>

</html>
<?php
unset($_SESSION['qaptcha_key']);
ob_end_flush();
?>