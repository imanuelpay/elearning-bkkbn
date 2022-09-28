<?php

if (isset($_POST['save'])) {
    $request = $_POST;
    $id = $request['id'];
    unset($request['save']);
    unset($request['id']);

    $db = new Database();
    $db->select('website_info', '*', "id=$id");
    $website_info = mysqli_fetch_array($db->result);

    $logo = $website_info['logo'];
    if ($_FILES['logo']['name'] != '') {
        $file_name = $_FILES['logo']['name'];
        $file_temp = $_FILES['logo']['tmp_name'];

        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        if (is_writable('../assets/img/' . $logo)) {
            unlink('../assets/img/' . $logo);
        }

        $file = 'logo.' . $ext;
        move_uploaded_file($file_temp, '../assets/img/' . $file);
        $request['logo'] = $file;
    }

    $favicon = $website_info['favicon'];
    if ($_FILES['favicon']['name'] != '') {
        $file_name = $_FILES['favicon']['name'];
        $file_temp = $_FILES['favicon']['tmp_name'];

        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        if (is_writable('../assets/img/' . $favicon)) {
            unlink('../assets/img/' . $favicon);
        }

        $file = 'favicon.' . $ext;
        move_uploaded_file($file_temp, '../assets/img/' . $file);
        $request['favicon'] = $file;
    }

    $request['name'] = cleanData($request['name']);
    $request['description'] = cleanData($request['description']);
    $request['phone'] = cleanData($request['phone']);
    $request['email'] = cleanData($request['email']);
    $request['address'] = cleanData($request['address']);
    $request['facebook'] = cleanData($request['facebook']);
    $request['instagram'] = cleanData($request['instagram']);
    $request['twitter'] = cleanData($request['twitter']);
    $request['youtube'] = cleanData($request['youtube']);
    $request['tiktok'] = cleanData($request['tiktok']);

    $db = new Database();
    $db->update('website_info', $request, "id=$id");

    $_SESSION['success_msg'] = '<div class="col-lg-12">
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check"></i> <strong>Berhasil tersimpan!</strong> Website ' . $request['name'] . ' berhasil diubah.
            </div>
        </div>';

    echo("<script>location.href='$baseURL/admin/';</script>");
}