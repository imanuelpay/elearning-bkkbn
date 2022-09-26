<?php
require_once '../config/database.php';
require_once '../config/mail.php';
session_start();

$baseURL = base_url;
?>
<!doctype html>
<html lang="en">

<head>

    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--====== Title ======-->
    <title>Edubin - LMS Education HTML Template</title>

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="../assets/user/images/favicon.png" type="image/png">

    <!--====== Slick css ======-->
    <link rel="stylesheet" href="../assets/user/css/slick.css">

    <!--====== Animate css ======-->
    <link rel="stylesheet" href="../assets/user/css/animate.css">

    <!--====== Nice Select css ======-->
    <link rel="stylesheet" href="../assets/user/css/nice-select.css">

    <!--====== Nice Number css ======-->
    <link rel="stylesheet" href="../assets/user/css/jquery.nice-number.min.css">

    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="../assets/user/css/magnific-popup.css">

    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="../assets/user/css/bootstrap.min.css">

    <!--====== Fontawesome css ======-->
    <link rel="stylesheet" href="../assets/user/css/font-awesome.min.css">

    <!--====== Default css ======-->
    <link rel="stylesheet" href="../assets/user/css/default.css">

    <!--====== Style css ======-->
    <link rel="stylesheet" href="../assets/user/css/style.css">

    <!--====== Responsive css ======-->
    <link rel="stylesheet" href="../assets/user/css/responsive.css">


</head>

<body>

<!--====== PRELOADER PART START ======-->

<?php require_once './layouts/loader.php' ?>

<!--====== PRELOADER PART ENDS ======-->

<!--====== HEADER PART START ======-->

<?php require_once './layouts/header.php' ?>

<!--====== HEADER PART ENDS ======-->

<?php
if (isset($_GET['halaman'])) {
    $page = $_GET['halaman'];

    if ($page == 'beranda') {
        include './pages/home/index.php';
    } elseif ($page == 'daftar-akun') {
        include './pages/auth/register.php';
    } elseif ($page == 'action-auth') {
        include './pages/auth/action.php';
    } elseif ($page == 'verifikasi-akun') {
        include './pages/auth/verify.php';
    }
} else {
    include './pages/home/index.php';
}
?>

<!--====== FOOTER PART START ======-->

<?php require_once './layouts/footer.php' ?>

<!--====== FOOTER PART ENDS ======-->

<!--====== BACK TO TP PART START ======-->

<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

<!--====== BACK TO TP PART ENDS ======-->


<!--====== jquery js ======-->
<script src="../assets/user/js/vendor/modernizr-3.6.0.min.js"></script>
<script src="../assets/user/js/vendor/jquery-1.12.4.min.js"></script>

<!--====== Bootstrap js ======-->
<script src="../assets/user/js/bootstrap.min.js"></script>

<!--====== Slick js ======-->
<script src="../assets/user/js/slick.min.js"></script>

<!--====== Magnific Popup js ======-->
<script src="../assets/user/js/jquery.magnific-popup.min.js"></script>

<!--====== Counter Up js ======-->
<script src="../assets/user/js/waypoints.min.js"></script>
<script src="../assets/user/js/jquery.counterup.min.js"></script>

<!--====== Nice Select js ======-->
<script src="../assets/user/js/jquery.nice-select.min.js"></script>

<!--====== Nice Number js ======-->
<script src="../assets/user/js/jquery.nice-number.min.js"></script>

<!--====== Count Down js ======-->
<script src="../assets/user/js/jquery.countdown.min.js"></script>

<!--====== Validator js ======-->
<script src="../assets/user/js/validator.min.js"></script>

<!--====== Ajax Contact js ======-->
<script src="../assets/user/js/ajax-contact.js"></script>

<!--====== Main js ======-->
<script src="../assets/user/js/main.js"></script>

<!--====== Map js ======-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDC3Ip9iVC0nIxC6V14CKLQ1HZNF_65qEQ"></script>
<script src="../assets/user/js/map-script.js"></script>

</body>

</html>
