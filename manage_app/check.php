<?php session_start();
ob_start();
?>
<html>

<head>
    <meta charset="utf-8" />
    <title>ตรวจสอบความถูกต้องก่อนเข้าสู่ระบบ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="57x57" href="img/ico/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="img/ico/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/ico/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="img/ico/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/ico/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="img/ico/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="img/ico/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/ico/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/ico/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="img/ico/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/ico/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="img/ico/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/ico/favicon-16x16.png">
    <link rel="shortcut icon" href="img/ico/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/ico/favicon.ico" type="image/x-icon">
    <link rel="manifest" href="img/ico/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="img/ico/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">


    <link href="bootstrap/css/boot3.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/login-css.css">
    <!--<script src="bootstrap/js/jq1.1.2.js"></script> -->
    <script src="bootstrap/js/boot3.js"></script>
    <script src="themes/js/jquery-1.9.1.min.js"></script>
    <script src="themes/js/modernizr.js"></script>
    <script>
    //paste this code under the head tag or in a separate js file.
    // Wait for window load
    $(window).load(function() {
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");;
    });
    </script>
    <style>
    /* Paste this css to your style sheet file or under head tag */
    /* This only works with JavaScript,
if it's not present, don't show loader */
    .no-js #loader {
        display: none;
    }

    .js #loader {
        display: block;
        position: absolute;
        left: 100px;
        top: 0;
    }

    .se-pre-con {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('images_tool/Preloader_2.gif') center no-repeat #fff;
    }
    </style>
</head>

<body>
    <div class="se-pre-con"></div>
    <?php
if (isset($_SESSION['qaptcha_key']) && !empty($_SESSION['qaptcha_key'])) {
    $QaptChaInput = $_SESSION['qaptcha_key'];
    include 'analy_config/connect.php';
    $kuma_user1 = trim($_POST['nptuser']);
    $kuma_pass1 = $_POST['nptpassword'];
    $kuma_user = mysqli_real_escape_string($c, $kuma_user1);
    $kuma_pass = mysqli_real_escape_string($c, $kuma_pass1);
    

    if (!empty($kuma_user) && !empty($kuma_pass)) {
        $sql = " SELECT * FROM members WHERE username = '$kuma_user'
	and passcode = '$kuma_pass' ";
        //$result = mysqli_query($sql);
        $result = mysqli_query($c, $sql) or die(mysqli_error($c));
        $r = mysqli_fetch_assoc($result);
        // for USER
        if ($r['status'] == 'ADMIN') {
            $_SESSION['adminkuma_names'] = $r['username'];
            $_SESSION['adminkuma_passs'] = $r['passcode'];
            if ($_POST['member_me'] == '1') {
                setcookie('cookie_kumaus_admin', $kuma_user, time() + 525600);
                setcookie('cookie_kumapass_admin', $kuma_pass, time() + 525600);
        }?>
    <div class="container">
        <div class="row">
        </div>
    </div>
    <?php
// destroy for user
            /*setcookie("cookie_kumaus");
            setcookie("cookie_kumapass"); */

            // end  destroy for user

            echo '<meta http-equiv="Refresh" content="0;url=index.php">';
            exit();
        }
        // End for USER
        if (!$r) {
            echo '<meta http-equiv="Refresh" content="0;url=login.php?not=up">';
        } else {
            $_SESSION['adminkuma_names'] = $r['username'];
            $_SESSION['adminkuma_passs'] = $r['passcode']; ?>
    <?php
echo '<meta http-equiv="Refresh" content="0;url=index.php">';
        }
    } else {
        echo '<meta http-equiv="Refresh" content="0;url=login.php?not=up">';
    }
} else {
    header('Location:login.php');
}
?>
</body>

</html>
<?php
unset($_SESSION['qaptcha_key']);
ob_end_flush();
?>