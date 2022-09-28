<?php

if (isset($_POST['add'])) {
    $request = $_POST;
    unset($request['add']);

    $request['id'] = getUUID();
    $request['title'] = cleanData($request['title']);
    $request['link'] = cleanData($request['link']);

    if ($_FILES['photo']['name'] != '') {
        $file_name = $_FILES['photo']['name'];
        $file_temp = $_FILES['photo']['tmp_name'];
        $file_slug = textToSlug($request['title']);

        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $file = $file_slug . '-' . time() . '.' . $ext;
        move_uploaded_file($file_temp, '../public/images/banner/' . $file);
        $request['photo'] = $file;
    }

    // Check Duplicate
    $db = new Database();
    $db->select('banner', '*', "title='{$request['title']}'");
    if ($db->mysqli->affected_rows >= 1) {
        $_SESSION['success_msg'] = '<div class="col-lg-12">
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check"></i> <strong>Gagal tersimpan!</strong> Banner ' . $request['title'] . ' sudah ada.
            </div>
        </div>';

        echo("<script>location.href='$baseURL/admin/?page=banner';</script>");
    }

    $db = new Database();
    $db->insert('banner', $request);

    if ($db->mysqli->affected_rows >= 1) {
        $_SESSION['success_msg'] = '<div class="col-lg-12">
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check"></i> <strong>Berhasil tersimpan!</strong> Banner ' . $request['title'] . ' berhasil ditambahkan.
            </div>
        </div>';

        echo("<script>location.href='$baseURL/admin/?page=banner';</script>");
    }
}

if (isset($_POST['edit'])) {
    $request = $_POST;
    $id = $request['id'];
    unset($request['edit']);
    unset($request['id']);

    $request['title'] = cleanData($request['title']);
    $request['link'] = cleanData($request['link']);

    $db = new Database();
    $db->select('banner', '*', "id='$id'");
    $banner = mysqli_fetch_array($db->result);

    $file = $banner['photo'];
    if ($_FILES['photo']['name'] != '') {
        $file_name = $_FILES['photo']['name'];
        $file_temp = $_FILES['photo']['tmp_name'];
        $file_slug = textToSlug($request['title']);

        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        if (is_writable('../public/images/banner/' . $file)) {
            unlink('../public/images/banner/' . $file);
        }

        $file = $file_slug . '-' . time() . '.' . $ext;
        move_uploaded_file($file_temp, '../public/images/banner/' . $file);
        $request['photo'] = $file;
    }

    $db = new Database();
    $db->update('banner', $request, "id='$id'");

    if ($db->mysqli->affected_rows >= 0) {
        $_SESSION['success_msg'] = '<div class="col-lg-12">
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check"></i> <strong>Berhasil tersimpan!</strong> Banner ' . $request['title'] . ' berhasil diubah.
            </div>
        </div>';

        echo("<script>location.href='$baseURL/admin/?page=banner';</script>");
    }
}

if (isset($_GET['delete']) && isset($_GET['id'])) {
    $id = $_GET['id'];

    $db = new Database();
    $db->select('banner', '*', "id='$id'");
    $result = mysqli_fetch_array($db->result);

    $db->delete('banner', "id='$id'");

    if (is_writable('../public/images/banner/' . $result['thumbnail'])) {
        unlink('../public/images/banner/' . $result['thumbnail']);
    }

    if ($db->mysqli->affected_rows >= 1) {
        $_SESSION['success_msg'] = '<div class="col-lg-12">
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check"></i> <strong>Berhasil terhapus!</strong> Banner ' . $result['title'] . ' berhasil dihapus.
            </div>
        </div>';

        echo("<script>location.href='$baseURL/admin/?page=banner';</script>");
    }
}