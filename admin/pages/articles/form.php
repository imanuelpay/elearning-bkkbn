<?php
// Category List
$db = new Database();
$db->select_custom(
    'categories',
    '*',
    "WHERE status=1"
);
$categories = $db->sql;

if ((isset($_GET['edit']) && isset($_GET['id']))) {
    $id = $_GET['id'];

    $db = new Database();
    $db->select('articles', '*', "id='$id'");
    $article = mysqli_fetch_array($db->sql);
}
?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="?page=articles" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1><?= (isset($_GET['edit']) && isset($_GET['id'])) ? 'Edit Article' : 'Create New Article ' ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="?page=articles">Articles</a></div>
                <div class="breadcrumb-item"><?= (isset($_GET['edit']) && isset($_GET['id'])) ? 'Edit ' : 'Add ' ?>
                    Article
                </div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title"><?= (isset($_GET['edit']) && isset($_GET['id'])) ? 'Edit ' : 'Add ' ?>
                Article</h2>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4><?= (isset($_GET['edit']) && isset($_GET['id'])) ? 'Edit ' : 'Add ' ?> Your
                                Article <?= (isset($_GET['edit']) && isset($_GET['id'])) ? ": {$article['title']}" : '' ?></h4>
                        </div>
                        <div class="card-body">
                            <form action="?page=article-action" method="post" enctype="multipart/form-data">
                                <?= (isset($_GET['edit']) && isset($article)) ? '<input type="hidden" name="id" value="' . $article['id'] . '">' : '' ?>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="title" class="form-control"
                                               value="<?= (isset($_GET['edit']) && isset($article)) ? $article['title'] : '' ?>">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="category_id" class="form-control select2">
                                            <?php while ($category = mysqli_fetch_array($categories)) { ?>
                                                <option value="<?= $category['id'] ?>" <?= (isset($_GET['edit']) && isset($article) && $article['category_id'] == $category['id']) ? 'selected' : '' ?>><?= $category['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea name="content"
                                                  class="summernote-simple"><?= (isset($_GET['edit']) && isset($article)) ? $article['content'] : '' ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                                    <div class="col-sm-12 col-md-3">
                                        <div id="image-preview" class="image-preview">
                                            <label for="image-upload" id="image-label">Choose File</label>
                                            <input type="file" name="thumbnail" id="image-upload" accept="image/*"/>
                                        </div>
                                        <?= (isset($_GET['edit']) && isset($article)) ? '<div class="form-text text-muted">Kosongkan jika tidak ingin mengubah thumbnail.</div>' : '' ?>
                                    </div>

                                    <?= (isset($_GET['edit']) && isset($article)) ? '<div class="gallery gallery-fw col-sm-12 col-md-3" data-item-height="250">
                                        <div class="gallery-item" data-image="../public/images/article/' . $article['thumbnail'] . '"
                                                     data-title="' . $article['slug'] . '"></div>
                                    </div>' : '' ?>

                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                                    <div class="col-sm-12 col-md-7 mt-1">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline1" name="status" value="1"
                                                   class="custom-control-input" <?= (isset($_GET['edit']) && isset($article) && $article['status'] == '1') ? 'checked' : '' ?>
                                                   checked>
                                            <label class="custom-control-label" for="customRadioInline1">Active</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline2" name="status" value="0"
                                                   class="custom-control-input" <?= (isset($_GET['edit']) && isset($article) && $article['status'] == '0') ? 'checked' : '' ?>>
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
                                            Article
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