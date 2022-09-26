<?php
if ((isset($_GET['edit']) && isset($_GET['id']))) {
    $id = $_GET['id'];

    $db = new Database();
    $db->select('announcements', '*', "id='$id'");
    $announcement = mysqli_fetch_array($db->result);
}
?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="?page=announcements" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1><?= (isset($_GET['edit']) && isset($_GET['id'])) ? 'Edit Announcement' : 'Create New Announcement ' ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="?page=announcements">Announcements</a></div>
                <div class="breadcrumb-item"><?= (isset($_GET['edit']) && isset($_GET['id'])) ? 'Edit ' : 'Add ' ?>
                    Announcement
                </div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title"><?= (isset($_GET['edit']) && isset($_GET['id'])) ? 'Edit ' : 'Add ' ?>
                Announcement</h2>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4><?= (isset($_GET['edit']) && isset($_GET['id'])) ? 'Edit ' : 'Add ' ?> Your
                                Announcement <?= (isset($_GET['edit']) && isset($_GET['id'])) ? ": {$announcement['title']}" : '' ?></h4>
                        </div>
                        <div class="card-body">
                            <form action="?page=announcement-action" method="post" enctype="multipart/form-data">
                                <?= (isset($_GET['edit']) && isset($announcement)) ? '<input type="hidden" name="id" value="' . $announcement['id'] . '">' : '' ?>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="title" class="form-control"
                                               value="<?= (isset($_GET['edit']) && isset($announcement)) ? $announcement['title'] : '' ?>">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea name="content"
                                                  class="summernote-simple"><?= (isset($_GET['edit']) && isset($announcement)) ? $announcement['content'] : '' ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                                    <div class="col-sm-12 col-md-7 mt-1">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline1" name="status" value="1"
                                                   class="custom-control-input" <?= (isset($_GET['edit']) && isset($announcement) && $announcement['status'] == '1') ? 'checked' : '' ?>
                                                   checked>
                                            <label class="custom-control-label" for="customRadioInline1">Active</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline2" name="status" value="0"
                                                   class="custom-control-input" <?= (isset($_GET['edit']) && isset($announcement) && $announcement['status'] == '0') ? 'checked' : '' ?>>
                                            <label class="custom-control-label"
                                                   for="customRadioInline2">Inactive</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-success"
                                                name="<?= (isset($_GET['edit']) && isset($_GET['id'])) ? 'edit' : 'add' ?>">
                                            <?= (isset($_GET['edit']) && isset($_GET['id'])) ? 'Edit ' : 'Add ' ?>
                                            Announcement
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>