<?php

if (isset($_POST['send'])) {
    $request = $_POST;
    unset($request['send']);

    $request['id'] = getUUID();
    $request['name'] = cleanData($request['name']);
    $request['email'] = cleanData($request['email']);
    $request['subject'] = textToSlug($request['subject']);
    $request['message'] = cleanData($request['message']);

    $db = new Database();
    $db->insert('contact', $request);

    if ($db->mysqli->affected_rows >= 1) {
        $_SESSION['success_msg'] = '<div class="col-lg-12">
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check"></i> <strong>Berhasil!</strong> Terima kasih atas kritik dan sarannya.
            </div>
        </div>';

        echo("<script>location.href='$baseURL/user/?halaman=kontak';</script>");
    }
}