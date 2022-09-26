<?php

if (isset($_POST['register'])) {
    $request = $_POST;
    unset($request['register']);

    $user = array();
    $user['id'] = getUUID();
    $user['name'] = cleanData($request['name']);
    $user['email'] = cleanData($request['email']);
    $user['username'] = cleanData($request['username']);
    $user['password'] = password_hash(cleanData($request['password']), PASSWORD_DEFAULT);
    $user['remember_token'] = randomString(64);

    // User Details
    $userDetail = array();
    $userDetail['user_id '] = $user['id'];
    $userDetail['categories'] = $request['categories'];
    $userDetail['nip'] = cleanData($request['nip']);
    $userDetail['gender'] = $request['gender'];
    $userDetail['birth_of_date'] = $request['birth_of_date'];
    $userDetail['handphone'] = cleanData($request['handphone']);
    $userDetail['address'] = cleanData($request['address']);
    $userDetail['city'] = cleanData($request['city']);

    // Check Duplicate
    $db = new Database();
    $db->select('user', '*', "username='{$user['username']}' OR email='{$user['email']}'");
    if ($db->mysqli->affected_rows >= 1) {
        $_SESSION['success_msg'] = '<div class="col-lg-12">
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check"></i> <strong>Gagal tersimpan!</strong> User ' . $request['name'] . ' sudah ada.
            </div>
        </div>';

        echo("<script>location.href='$baseURL/user/?halaman=daftar-akun';</script>");
    }


    // Insert Data
    $dbUser = new Database();
    $dbUser->insert('user', $user);

    $dbUserDetail = new Database();
    $dbUserDetail->insert('user_details', $userDetail);

    if ($dbUser->mysqli->affected_rows >= 1 && $dbUserDetail->mysqli->affected_rows >= 1) {
        $subject = 'E-Learning BKKBN NTT - Registration Verification';

        $message = file_get_contents('../template/email.html');

        $message = str_replace('%username%', $user['name'], $message);
        $message = str_replace('%office%', "BKKBN NTT", $message);
        $message = str_replace('%admin%', "Imanuel Pay", $message);
        $message = str_replace('%link%', "$baseURL/user/?halaman=action-auth&token={$user['remember_token']}&verified", $message);

        sendEmail($user['email'], $subject, $message);
        $_SESSION['success_msg'] = '<div class="col-lg-12">
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check"></i> <strong>Akun Berhasil dibuat!</strong> Mohon verifikasi email anda.
            </div>
        </div>';

        echo("<script>location.href='$baseURL/user/?halaman=daftar-akun';</script>");
    }
}

$url = base_url . '/user';
if (isset($_GET['token']) && isset($_GET['verified'])) {
    $token = $_GET['token'];

    $db = new Database();
    $db->select_custom('user', '*', "WHERE remember_token='$token'");
    $cek = mysqli_num_rows(result: $db->result);
    $data = mysqli_fetch_array($db->result);

    if ($cek > 0) {
        $user['verified_at'] = date('Y-m-d H:i:s');
        $user['is_verified'] = 1;
        $user['status'] = 1;
        $user['remember_token'] = "";

        $db = new Database();
        $db->update('user', $user, "id='{$data['id']}'");
        if ($db->mysqli->affected_rows >= 1) {
            $_SESSION['success_msg'] = '<div class="contact-address mt-30">
                        <ul>
                        <li>
                                <div class="singel-address">
                                    <div class="icon">
                                        <i class="fa fa-envelope-o"></i>
                                    </div>
                                    <div class="cont">
                                        <p>Hai ' . $user['name'] . ', email anda berhasil di verifikasi, silahkan masuk dengan mengklik tombol di bawah.</p>
                                    <p> <a href="' . $url . '" class="main-btn">Kembali ke Beranda</a></p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>';
            echo("<script>location.href='$baseURL/user/?halaman=verifikasi-akun';</script>");
        }
    } else {
        $_SESSION['success_msg'] = '<div class="contact-address mt-30">
                        <ul>
                        <li>
                                <div class="singel-address">
                                    <div class="icon">
                                        <i class="fa fa-times text-danger"></i>
                                    </div>
                                    <div class="cont">
                                        <p> Gagal melakukan verifikasi email, silahkan kembali ke beranda dengan mengklik tombol di bawah.</p>
                                    <p> <a href="' . $url . '" class="main-btn mt-2">Kembali ke Beranda</a></p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>';

        echo("<script>location.href='$baseURL/user/?halaman=verifikasi-akun';</script>");
    }
}