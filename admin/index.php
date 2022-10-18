<?php
require_once '../config/database.php';
require_once '../config/mail.php';
session_start();

$baseURL = base_url;
if (!isset($_SESSION['login_admin'])) {
    echo("<script>location.href='$baseURL/admin/login.php';</script>");
}

if (isset($_GET['logout_admin'])) {
    unset($_SESSION['login_admin']);
    unset($_SESSION['admin_id']);
    echo("<script>location.href='$baseURL/admin/login.php';</script>");
}

$db = new Database();
$db->select('menu', '*', 'status=1');
$result_menu = [];
while ($row = mysqli_fetch_array($db->result)) {
    $result_menu[] = $row;
}

$db = new Database();
$db->select('admin', '*', "id='{$_SESSION['admin_id']}'");
$adminLogin = mysqli_fetch_array($db->result);

$db = new Database();
$db->select_custom('website_info', '*', "LIMIT 1");
$info = mysqli_fetch_array($db->result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= $info['name'] ?></title>

    <link rel="shortcut icon" href="../assets/img/<?= $info['favicon'] ?>" type="image/png">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="../assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <?php
    if (isset($_GET['page'])) {
        $page = $_GET['page'];

        if ($page == 'articles' || $page == 'admin' || $page == 'users' || $page == 'banner' || $page == 'announcements') {
            echo '<link rel="stylesheet" href="../assets/modules/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="../assets/modules/chocolat/dist/css/chocolat.css">';
        } elseif ($page == 'article-form' || $page == 'admin-form' || $page == 'user-form' || $page == 'banner-form' || $page == 'announcement-form') {
            echo '<link rel="stylesheet" href="../assets/modules/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="../assets/modules/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="../assets/modules/chocolat/dist/css/chocolat.css">';
        } elseif ($page == 'home') {
            echo '<link rel="stylesheet" href="../assets/modules/bootstrap-social/bootstrap-social.css">
  <link rel="stylesheet" href="../assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="../assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">';
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

            if ($page == 'category-action') {
                include './pages/categories/action.php';
            } elseif ($page == 'home-action') {
                include './pages/home/action.php';
            } elseif ($page == 'article-action') {
                include './pages/articles/action.php';
            } elseif ($page == 'article-form') {
                include './pages/articles/form.php';
            } elseif ($page == 'admin-action') {
                include './pages/admin/action.php';
            } elseif ($page == 'admin-form') {
                include './pages/admin/form.php';
            } elseif ($page == 'user-action') {
                include './pages/users/action.php';
            } elseif ($page == 'user-form') {
                include './pages/users/form.php';
            } elseif ($page == 'banner-action') {
                include './pages/banner/action.php';
            } elseif ($page == 'banner-form') {
                include './pages/banner/form.php';
            } elseif ($page == 'announcement-action') {
                include './pages/announcements/action.php';
            } elseif ($page == 'announcement-form') {
                include './pages/announcements/form.php';
            }
        } else {
            include './pages/home/index.php';
        }
        ?>

        <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDeleteLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="bodyDelete">
                        <label id="deleteTitle"></label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                    class="fa fa-remove"></i> Batal
                        </button>
                        <a href="" class="btn btn-danger" id="linkDelete"><i class="fa fa-trash-o"></i> Hapus</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalLogout" tabindex="-1" role="dialog" aria-labelledby="modalLogoutLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLogoutLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="bodyLogout">
                        <label id="logoutTitle"></label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                    class="fa fa-remove"></i>
                            Batal
                        </button>
                        <a href="" class="btn btn-danger" id="linkLogout"><i class="fa fa-sign-out"></i> Keluar</a>
                    </div>
                </div>
            </div>
        </div>

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

<!-- JS Libraies -->
<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];

    if ($page == 'articles' || $page == 'admin' || $page == 'users' || $page == 'banner' || $page == 'announcements') {
        echo '<script src="../assets/modules/select2/dist/js/select2.full.min.js"></script>
<script src="../assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>';
    } elseif ($page == 'article-form' || $page == 'admin-form' || $page == 'user-form' || $page == 'banner-form' || $page == 'announcement-form') {
        echo '<script src="../assets/modules/summernote/summernote-bs4.js"></script>
          <script src="../assets/modules/select2/dist/js/select2.full.min.js"></script>
          <script src="../assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
          <script src="../assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js"></script>
          <script>
          "use strict";
        $.uploadPreview({
          input_field: "#image-upload",   // Default: .image-upload
          preview_box: "#image-preview",  // Default: .image-preview
          label_field: "#image-label",    // Default: .image-label
          label_default: "Choose File",   // Default: Choose File
          label_selected: "Change File",  // Default: Change File
          no_label: false,                // Default: false
          success_callback: null          // Default: null
        });
        </script>';
        echo "<script>
            $('.summernote').summernote({
                disableGrammar: true,
                spellCheck: false,
                width: '100%',
                height: '250',
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        </script>";
    } elseif ($page == 'home') {
        echo '<script src="../assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
  <script src="../assets/js/page/components-user.js"></script>';
    }
}
?>

<!-- Template JS File -->
<script src="../assets/js/scripts.js"></script>
<script src="../assets/js/custom.js"></script>
</body>
</html>