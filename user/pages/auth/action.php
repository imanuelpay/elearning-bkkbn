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

        echo("<script>location.href='$baseURL/?halaman=daftar-akun';</script>");
    }

    // Insert Data
    $dbUser = new Database();
    $dbUser->insert('user', $user);

    $dbUserDetail = new Database();
    $dbUserDetail->insert('user_details', $userDetail);

    if ($dbUser->mysqli->affected_rows >= 1 && $dbUserDetail->mysqli->affected_rows >= 1) {
        $subject = 'E-Learning BKKBN NTT - Registration Verification';

        $body = '
			<p>Thank you for registering.</p>
			<p>This is a verification eMail, please click the link to verify your eMail address by clicking this <a href="' . $baseURL . 'verify_email.php?type=user&code=' . $user['remember_token'] . '" target="_blank"><b>link</b></a>.</p>
			<p>In case if you have any difficulty please eMail us.</p>
			<p>Thank you,</p>
			<p>E-Learning BKKBN NTT</p>
			';

        sendEmail($user['email'], $subject, $body);
        $_SESSION['success_msg'] = '<div class="col-lg-12">
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check"></i> <strong>Akun Berhasil dibuat!</strong> Mohon verifikasi email anda.
            </div>
        </div>';

        echo("<script>location.href='$baseURL/?halaman=daftar-akun';</script>");
    }
}