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
        $_SESSION['success_msg'] = '<div class="col-lg-12">
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check"></i> <strong>Berhasil tersimpan!</strong> User ' . $request['name'] . ' berhasil ditambahkan.
            </div>
        </div>';

        echo("<script>location.href='$baseURL/admin/?page=users';</script>");
    }
}