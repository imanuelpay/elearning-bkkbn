<?php
if (isset($_POST['add'])) {
    $request = $_POST;
    unset($request['add']);

    $request['id'] = getUUID();
    $request['name'] = cleanData($request['name']);
    $request['email'] = cleanData($request['email']);
    $request['username'] = cleanData($request['username']);
    $request['password'] = password_hash(cleanData($request['password']), PASSWORD_DEFAULT);

    if ($_FILES['photo']['name'] != '') {
        $file_name = $_FILES['photo']['name'];
        $file_temp = $_FILES['photo']['tmp_name'];
        $file_slug = textToSlug($request['name']);

        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $file = $file_slug . '-' . time() . '.' . $ext;
        move_uploaded_file($file_temp, '../public/images/admin/' . $file);
        $request['photo'] = $file;
    }

    // Check Duplicate
    $db = new Database();
    $db->select('admin', '*', "username='{$request['username']}' OR email='{$request['email']}'");
    if ($db->mysqli->affected_rows >= 1) {
        $_SESSION['success_msg'] = '<div class="col-lg-12">
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check"></i> <strong>Gagal tersimpan!</strong> Administrator ' . $request['name'] . ' sudah ada.
            </div>
        </div>';

        echo("<script>location.href='$baseURL/admin/?page=admin';</script>");
    }

    // Insert Data
    $db = new Database();
    $db->insert('admin', $request);
    if ($db->mysqli->affected_rows >= 1) {
        $_SESSION['success_msg'] = '<div class="col-lg-12">
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check"></i> <strong>Berhasil tersimpan!</strong> Administrator ' . $request['name'] . ' berhasil ditambahkan.
            </div>
        </div>';

        echo("<script>location.href='$baseURL/admin/?page=admin';</script>");
    }
}

if (isset($_POST['edit'])) {
    $request = $_POST;
    $id = $request['id'];
    unset($request['edit']);
    unset($request['id']);

    $request['name'] = cleanData($request['name']);
    $request['email'] = cleanData($request['email']);
    $request['username'] = cleanData($request['username']);


    $db = new Database();
    $db->select('admin', '*', "id='$id'");
    $admin = mysqli_fetch_array($db->result);

    if ($request['password'] != '') {
        $request['password'] = password_hash(cleanData($request['password']), PASSWORD_DEFAULT);
    } else {
        $request['password'] = $admin['password'];
    }

    $file = $admin['photo'];
    if ($_FILES['photo']['name'] != '') {
        $file_name = $_FILES['photo']['name'];
        $file_temp = $_FILES['photo']['tmp_name'];
        $file_slug = textToSlug($request['name']);

        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        if (is_writable('../public/images/admin/' . $file)) {
            unlink('../public/images/admin/' . $file);
        }

        $file = $file_slug . '-' . time() . '.' . $ext;
        move_uploaded_file($file_temp, '../public/images/admin/' . $file);
        $request['photo'] = $file;
    }

    // Check Duplicate
    $db = new Database();
    $db->select('admin', '*', "username='{$request['username']}' OR email='{$request['email']}'");
    if ($db->mysqli->affected_rows >= 1) {
        $_SESSION['success_msg'] = '<div class="col-lg-12">
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check"></i> <strong>Gagal tersimpan!</strong> Administrator ' . $request['name'] . ' sudah ada.
            </div>
        </div>';

        echo("<script>location.href='$baseURL/admin/?page=admin';</script>");
    }

    // Update Data
    $db = new Database();
    $db->update('admin', $request, "id='$id'");

    if ($db->mysqli->affected_rows >= 1) {
        $_SESSION['success_msg'] = '<div class="col-lg-12">
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check"></i> <strong>Berhasil tersimpan!</strong> Administrator ' . $request['name'] . ' berhasil diubah.
            </div>
        </div>';

        echo("<script>location.href='$baseURL/admin/?page=admin';</script>");
    }
}

if (isset($_GET['delete']) && isset($_GET['id'])) {
    $id = $_GET['id'];

    $db = new Database();
    $db->select('admin', '*', "id='$id'");
    $result = mysqli_fetch_array($db->result);

    $db->delete('admin', "id='$id'");

    if (is_writable('../public/images/admin/' . $result['photo'])) {
        unlink('../public/images/admin/' . $result['photo']);
    }

    if ($db->mysqli->affected_rows >= 1) {
        $_SESSION['success_msg'] = '<div class="col-lg-12">
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check"></i> <strong>Berhasil terhapus!</strong> Administrator ' . $result['name'] . ' berhasil dihapus.
            </div>
        </div>';

        echo("<script>location.href='$baseURL/admin/?page=admin';</script>");
    }
}