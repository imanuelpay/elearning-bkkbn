<?php
require_once '../config/database.php';
session_start();

$db = new Database();
$db->select('menu', '*', 'status=1');
$result_menu = [];
while ($row = mysqli_fetch_array($db->sql)) {
    $result_menu[] = $row;
}

$baseURL = base_url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Blank Page &mdash; Stisla</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="../assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/modules/fontawesome/css/all.min.css">

    <?php
    if (isset($_GET['page'])) {
        $page = $_GET['page'];

        if ($page == 'article') {
            echo '  <!-- CSS Libraries -->
  <link rel="stylesheet" href="assets/modules/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="assets/modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="assets/modules/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="assets/modules/jquery-selectric/selectric.css">
  <link rel="stylesheet" href="assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">';
        }
    }
    ?>

    <!-- Template CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/components.css">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA --></head>

<body>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <?php
        require_once './layouts/navbar.php';
        require_once './layouts/sidebar.php';
        ?>

        <!-- Main Content -->
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];

            foreach ($result_menu as $menu) {
                if ($page == $menu['slug']) {
                    $path = './pages/' . $menu['slug'] . '/index.php';
                    include $path;
                }
            }
        } else {
            include './pages/home/index.php';
        }
        ?>

        <?php require_once './layouts/footer.php' ?>
    </div>
</div>

<!-- General JS Scripts -->
<script src="../assets/modules/jquery.min.js"></script>
<script src="../assets/modules/popper.js"></script>
<script src="../assets/modules/tooltip.js"></script>
<script src="../assets/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="../assets/modules/moment.min.js"></script>
<script src="../assets/js/stisla.js"></script>

<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];

    if ($page == 'article') {
        echo '  <!-- JS Libraies -->
  <script src="../assets/modules/cleave-js/dist/cleave.min.js"></script>
  <script src="../assets/modules/cleave-js/dist/addons/cleave-phone.us.js"></script>
  <script src="../assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="../assets/modules/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="../assets/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
  <script src="../assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
  <script src="../assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
  <script src="../assets/modules/select2/dist/js/select2.full.min.js"></script>
  <script src="../assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
  <script src="../assets/modules/sweetalert/sweetalert.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="../assets/js/page/forms-advanced-forms.js"></script>
  ';
    }
}
?>

<!-- Template JS File -->
<script src="../assets/js/scripts.js"></script>
<script src="../assets/js/custom.js"></script>
</body>
</html>