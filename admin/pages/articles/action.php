<?php

if (isset($_POST['add'])) {
    $request = $_POST;
    unset($request['add']);

    $request['id'] = getUUID();
    $request['title'] = cleanData($request['title']);
    $request['content'] = cleanData($request['content']);
    $request['slug'] = textToSlug($request['title']);
    $request['created_by'] = $_SESSION['admin_id'];

    if ($_FILES['thumbnail']['name'] != '') {
        $file_name = $_FILES['thumbnail']['name'];
        $file_temp = $_FILES['thumbnail']['tmp_name'];
        $file_slug = textToSlug($request['title']);

        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $file = $file_slug . '-' . time() . '.' . $ext;
        move_uploaded_file($file_temp, '../public/images/article/' . $file);
        $request['thumbnail'] = $file;
    }

    // Check Duplicate
    $db = new Database();
    $db->select('articles', '*', "title='{$request['title']}' OR slug='{$request['slug']}'");
    if ($db->mysqli->affected_rows >= 1) {
        $_SESSION['success_msg'] = '<div class="col-lg-12">
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check"></i> <strong>Gagal tersimpan!</strong> Article ' . $request['title'] . ' sudah ada.
            </div>
        </div>';

        echo("<script>location.href='$baseURL/admin/?page=articles';</script>");
    }

    $db = new Database();
    $db->insert('articles', $request);

    if ($db->mysqli->affected_rows >= 1) {
        $_SESSION['success_msg'] = '<div class="col-lg-12">
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check"></i> <strong>Berhasil tersimpan!</strong> Article ' . $request['title'] . ' berhasil ditambahkan.
            </div>
        </div>';

        echo("<script>location.href='$baseURL/admin/?page=articles';</script>");
    }
}

if (isset($_POST['edit'])) {
    $request = $_POST;
    $id = $request['id'];
    unset($request['edit']);
    unset($request['id']);

    $request['title'] = cleanData($request['title']);
    $request['content'] = cleanData($request['content']);
    $request['slug'] = textToSlug($request['title']);
    $request['updated_by'] = $_SESSION['admin_id'];

    $db = new Database();
    $db->select('articles', '*', "id='$id'");
    $article = mysqli_fetch_array($db->result);

    $file = $article['thumbnail'];
    if ($_FILES['thumbnail']['name'] != '') {
        $file_name = $_FILES['thumbnail']['name'];
        $file_temp = $_FILES['thumbnail']['tmp_name'];
        $file_slug = textToSlug($request['title']);

        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        if (is_writable('../public/images/article/' . $file)) {
            unlink('../public/images/article/' . $file);
        }

        $file = $file_slug . '-' . time() . '.' . $ext;
        move_uploaded_file($file_temp, '../public/images/article/' . $file);
        $request['thumbnail'] = $file;
    }

    // Check Duplicate
    $db = new Database();
    $db->select('articles', '*', "title='{$request['title']}' OR slug='{$request['slug']}'");
    if ($db->mysqli->affected_rows >= 1) {
        $_SESSION['success_msg'] = '<div class="col-lg-12">
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check"></i> <strong>Gagal tersimpan!</strong> Article ' . $request['title'] . ' sudah ada.
            </div>
        </div>';

        echo("<script>location.href='$baseURL/admin/?page=articles';</script>");
    }

    $db = new Database();
    $db->update('articles', $request, "id='$id'");

    if ($db->mysqli->affected_rows >= 1) {
        $_SESSION['success_msg'] = '<div class="col-lg-12">
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check"></i> <strong>Berhasil tersimpan!</strong> Article ' . $request['title'] . ' berhasil diubah.
            </div>
        </div>';

        echo("<script>location.href='$baseURL/admin/?page=articles';</script>");
    }
}

if (isset($_GET['delete']) && isset($_GET['id'])) {
    $id = $_GET['id'];

    $db = new Database();
    $db->select('articles', '*', "id='$id'");
    $result = mysqli_fetch_array($db->result);

    $db->delete('articles', "id='$id'");

    if (is_writable('../public/images/article/' . $result['thumbnail'])) {
        unlink('../public/images/article/' . $result['thumbnail']);
    }

    if ($db->mysqli->affected_rows >= 1) {
        $_SESSION['success_msg'] = '<div class="col-lg-12">
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check"></i> <strong>Berhasil terhapus!</strong> Article ' . $result['title'] . ' berhasil dihapus.
            </div>
        </div>';

        echo("<script>location.href='$baseURL/admin/?page=articles';</script>");
    }
}