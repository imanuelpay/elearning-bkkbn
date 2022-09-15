<?php
require '../config/database.php';

session_start();
$baseURL = base_url;
if (isset($_SESSION['login_admin'])) {
    echo("<script>location.href='$baseURL/admin/';</script>");
}

if (isset($_POST['login'])) {
    $db = new Database();
    $email = $db->mysqli->real_escape_string(cleanData($_POST['email']));
    $password = $db->mysqli->real_escape_string(cleanData($_POST['password']));

    $db->select_custom('admin', '*', "WHERE email='$email'");
    $cek = mysqli_num_rows($db->sql);
    $data = mysqli_fetch_array($db->sql);

    if ($cek > 0) {
        if (password_verify($password, $data['password']) && $data['status'] == 1) {
            $_SESSION['login_admin'] = true;
            $_SESSION['admin_id'] = $data['id'];

            echo("<script>location.href='$baseURL/admin';</script>");
        } elseif ($data['status'] != 1) {
            $_SESSION['error_msg'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-remove"></i> <strong>Login Gagal!</strong> Akun tidak aktif, mohon hubungi admin.
                </div>';

            echo("<script>location.href='$baseURL/admin/login.php';</script>");
        } else {
            $_SESSION['error_msg'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-remove"></i> <strong>Login Gagal!</strong> Mohon mengisi email dan password dengan benar.
                </div>';

            echo("<script>location.href='$baseURL/admin/login.php';</script>");
        }
    } else {
        $_SESSION['error_msg'] = '<div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-remove"></i> <strong>Login Gagal!</strong> Mohon mengisi email dan password dengan benar.
                </div>';

        echo("<script>location.href='$baseURL/admin/login.php';</script>");
    }
}