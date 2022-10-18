<?php
if (isset($_POST['add'])) {
    $request = $_POST;
    unset($request['add']);

    $user = array();
    $user['id'] = getUUID();
    $user['name'] = cleanData($request['name']);
    $user['email'] = cleanData($request['email']);
    $user['username'] = cleanData($request['username']);
    $user['password'] = password_hash(cleanData($request['password']), PASSWORD_DEFAULT);
    $user['is_verified'] = $request['is_verified'];
    $user['status'] = $request['status'];

    if ($user['is_verified'] == 1) {
        $user['verified_at'] = date('Y-m-d H:i:s');
    } else {
        $user['remember_token'] = randomString(64);
    }

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

    if ($_FILES['photo']['name'] != '') {
        $file_name = $_FILES['photo']['name'];
        $file_temp = $_FILES['photo']['tmp_name'];
        $file_slug = textToSlug($user['name']);

        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $file = $file_slug . '-' . time() . '.' . $ext;
        move_uploaded_file($file_temp, '../public/images/user/' . $file);
        $userDetail['photo'] = $file;
    }

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

        echo("<script>location.href='$baseURL/admin/?page=users';</script>");
    }

    // Insert Data
    $dbUser = new Database();
    $dbUser->insert('user', $user);

    $dbUserDetail = new Database();
    $dbUserDetail->insert('user_details', $userDetail);

    if ($dbUser->mysqli->affected_rows >= 1 && $dbUserDetail->mysqli->affected_rows >= 1) {
        if ($user['is_verified'] == 0) {
            $subject = 'E-Learning BKKBN NTT - Registration Verification';

            $message = file_get_contents('../template/email.html');

            $message = str_replace('%username%', $user['name'], $message);
            $message = str_replace('%office%', "BKKBN NTT", $message);
            $message = str_replace('%admin%', "Imanuel Pay", $message);
            $message = str_replace('%link%', "$baseURL/user/?halaman=action-auth&token={$user['remember_token']}&verified", $message);

            sendEmail($user['email'], $subject, $message);
        }

        $_SESSION['success_msg'] = '<div class="col-lg-12">
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check"></i> <strong>Berhasil tersimpan!</strong> User ' . $request['name'] . ' berhasil ditambahkan.
            </div>
        </div>';

        echo("<script>location.href='$baseURL/admin/?page=users';</script>");
    }
}

if (isset($_POST['edit'])) {
    $request = $_POST;
    $id = $request['id'];
    unset($request['edit']);
    unset($request['id']);

    $user = array();
    $user['name'] = cleanData($request['name']);
    $user['email'] = cleanData($request['email']);
    $user['username'] = cleanData($request['username']);
    $user['is_verified'] = $request['is_verified'];
    $user['status'] = $request['status'];

    $db = new Database();
    $db->select('user', '*', "id='$id'");
    $result_user = mysqli_fetch_array($db->result);

    if ($request['password'] != '') {
        $request['password'] = password_hash(cleanData($request['password']), PASSWORD_DEFAULT);
    } else {
        $request['password'] = $result_user['password'];
    }

    if ($user['is_verified'] == 1 && $result_user['is_verified'] == 0) {
        $user['verified_at'] = date('Y-m-d H:i:s');
    } else if ($result_user['remember_token'] != "") {
        $user['remember_token'] = $result_user['remember_token'];
    } else {
        $user['remember_token'] = randomString(64);
    }

    // User Details
    $userDetail = array();
    $userDetail['categories'] = $request['categories'];
    $userDetail['nip'] = cleanData($request['nip']);
    $userDetail['gender'] = $request['gender'];
    $userDetail['birth_of_date'] = $request['birth_of_date'];
    $userDetail['handphone'] = cleanData($request['handphone']);
    $userDetail['address'] = cleanData($request['address']);
    $userDetail['city'] = cleanData($request['city']);

    $db = new Database();
    $db->select('user_details', '*', "user_id='$id'");
    $result_userDetail = mysqli_fetch_array($db->result);

    $file = $result_userDetail['photo'];
    if ($_FILES['photo']['name'] != '') {
        $file_name = $_FILES['photo']['name'];
        $file_temp = $_FILES['photo']['tmp_name'];
        $file_slug = textToSlug($user['name']);

        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        if (is_writable('../public/images/user/' . $file)) {
            unlink('../public/images/user/' . $file);
        }

        $file = $file_slug . '-' . time() . '.' . $ext;
        move_uploaded_file($file_temp, '../public/images/user/' . $file);
        $userDetail['photo'] = $file;
    }

    // Insert Data
    $dbUser = new Database();
    $dbUser->update('user', $user, "id='$id'");

    $dbUserDetail = new Database();
    $dbUserDetail->update('user_details', $userDetail, "user_id='$id'");

    if ($dbUser->mysqli->affected_rows >= 0 && $dbUserDetail->mysqli->affected_rows >= 0) {
        if ($user['is_verified'] == 0 && $user['remember_token'] == $result_user['remember_token']) {
            $subject = 'E-Learning BKKBN NTT - Registration Verification';

            $message = file_get_contents('../template/email.html');

            $message = str_replace('%username%', $user['name'], $message);
            $message = str_replace('%office%', "BKKBN NTT", $message);
            $message = str_replace('%admin%', "Imanuel Pay", $message);
            $message = str_replace('%link%', "$baseURL/user/?halaman=action-auth&token={$user['remember_token']}&verified", $message);

            sendEmail($user['email'], $subject, $message);
        }

        $_SESSION['success_msg'] = '<div class="col-lg-12">
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check"></i> <strong>Berhasil tersimpan!</strong> User ' . $request['name'] . ' berhasil diubah.
            </div>
        </div>';

        echo("<script>location.href='$baseURL/admin/?page=users';</script>");
    }
}

if (isset($_GET['delete']) && isset($_GET['id'])) {
    $id = $_GET['id'];

    $db = new Database();
    $db->select('user', '*', "id='$id'");
    $result = mysqli_fetch_array($db->result);

    $db->delete('user', "id='$id'");

    if ($result['photo'] != 'avatar.png' && is_writable('../public/images/user/' . $result['photo'])) {
        unlink('../public/images/user/' . $result['photo']);
    }

    if ($db->mysqli->affected_rows >= 1) {
        $_SESSION['success_msg'] = '<div class="col-lg-12">
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check"></i> <strong>Berhasil terhapus!</strong> User ' . $result['name'] . ' berhasil dihapus.
            </div>
        </div>';

        echo("<script>location.href='$baseURL/admin/?page=user';</script>");
    }
}