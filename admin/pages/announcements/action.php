<?php

if (isset($_POST['add'])) {
    $request = $_POST;
    unset($request['add']);

    $request['id'] = getUUID();
    $request['title'] = cleanData($request['title']);
    $request['content'] = cleanData($request['content']);
    $request['slug'] = textToSlug($request['title']);
    $request['created_by'] = $_SESSION['admin_id'];

    // Check Duplicate
    $db = new Database();
    $db->select('announcements', '*', "title='{$request['title']}' OR slug='{$request['slug']}'");
    if ($db->mysqli->affected_rows >= 1) {
        $_SESSION['success_msg'] = '<div class="col-lg-12">
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check"></i> <strong>Gagal tersimpan!</strong> Announcement ' . $request['title'] . ' sudah ada.
            </div>
        </div>';

        echo("<script>location.href='$baseURL/admin/?page=announcements';</script>");
    }

    $db = new Database();
    $db->insert('announcements', $request);

    if ($db->mysqli->affected_rows >= 1) {
        $_SESSION['success_msg'] = '<div class="col-lg-12">
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check"></i> <strong>Berhasil tersimpan!</strong> Announcement ' . $request['title'] . ' berhasil ditambahkan.
            </div>
        </div>';

        echo("<script>location.href='$baseURL/admin/?page=announcements';</script>");
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

    // Check Duplicate
    $db = new Database();
    $db->select('announcements', '*', "title='{$request['title']}' OR slug='{$request['slug']}'");
    if ($db->mysqli->affected_rows >= 1) {
        $_SESSION['success_msg'] = '<div class="col-lg-12">
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check"></i> <strong>Gagal tersimpan!</strong> Announcement ' . $request['title'] . ' sudah ada.
            </div>
        </div>';

        echo("<script>location.href='$baseURL/admin/?page=announcements';</script>");
    }

    $db = new Database();
    $db->update('announcements', $request, "id='$id'");

    if ($db->mysqli->affected_rows >= 1) {
        $_SESSION['success_msg'] = '<div class="col-lg-12">
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check"></i> <strong>Berhasil tersimpan!</strong> Announcement ' . $request['title'] . ' berhasil diubah.
            </div>
        </div>';

        echo("<script>location.href='$baseURL/admin/?page=announcements';</script>");
    }
}

if (isset($_GET['delete']) && isset($_GET['id'])) {
    $id = $_GET['id'];

    $db = new Database();
    $db->select('announcements', '*', "id='$id'");
    $result = mysqli_fetch_array($db->result);

    $db->delete('announcements', "id='$id'");
    if ($db->mysqli->affected_rows >= 1) {
        $_SESSION['success_msg'] = '<div class="col-lg-12">
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check"></i> <strong>Berhasil terhapus!</strong> Announcement ' . $result['title'] . ' berhasil dihapus.
            </div>
        </div>';

        echo("<script>location.href='$baseURL/admin/?page=announcements';</script>");
    }
}