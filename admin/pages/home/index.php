<?php
$db = new Database();
$db->select_custom(
    'website_info',
    '*',
    "WHERE status=1 LIMIT 1"
);

if ($db->mysqli->affected_rows >= 1) {
    $website_info = mysqli_fetch_array($db->result);
}

$db = new Database();
$db->select_custom('user', "id", "WHERE status=1");
$total_user = mysqli_num_rows($db->result);

$db = new Database();
$db->select_custom('articles', "id", "WHERE status=1");
$total_article = mysqli_num_rows($db->result);

$db = new Database();
$db->select_custom('courses', "id", "WHERE status=1");
$total_course = mysqli_num_rows($db->result);
?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>General Settings</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">All About General Settings</h2>
            <p class="section-lead">
                You can adjust all general settings here
            </p>

            <div class="row">
                <div class="col-12 mb-4">
                    <div class="hero bg-primary text-white">
                        <div class="hero-inner">
                            <h2>Welcome Back, <?= $adminLogin['name'] ?>!</h2>
                            <p class="lead">This page is a place to manage posts, articles and more.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div id="output-status"></div>
            <div class="row">
                <?php
                if (isset($_SESSION['success_msg'])) {
                    echo $_SESSION['success_msg'];
                    unset($_SESSION['success_msg']);
                }
                ?>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="far fa-user"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Total User</h4>
                                    </div>
                                    <div class="card-body">
                                        <?= $total_user ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-danger">
                                    <i class="far fa-newspaper"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Total Article</h4>
                                    </div>
                                    <div class="card-body">
                                        <?= $total_article ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-warning">
                                    <i class="far fa-file"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Total Course</h4>
                                    </div>
                                    <div class="card-body">
                                        <?= $total_course ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card author-box card-primary">
                        <div class="card-body">
                            <div class="author-box-left">
                                <img alt="image" src="../assets/img/<?= $website_info['favicon'] ?>"
                                     class="author-box-picture rounded-circle">
                                <div class="clearfix"></div>
                                <img alt="image" src="../assets/img/<?= $website_info['logo'] ?>"
                                     class=" author-box-picture mt-3">
                            </div>
                            <div class="author-box-details">
                                <div class="author-box-name">
                                    <a href="#"><?= $website_info['name'] ?></a>
                                </div>
                                <div class="author-box-job"><?= $website_info['address'] ?></div>
                                <div class="author-box-description">
                                    <p><?= $website_info['description'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <form id="setting-form" action="?page=home-action" enctype="multipart/form-data" method="post">
                        <div class="card" id="settings-card">
                            <div class="card-header">
                                <h4>General Settings</h4>
                            </div>
                            <div class="card-body">
                                <?= (isset($website_info)) ? '<input type="hidden" name="id" value="' . $website_info['id'] . '">' : '' ?>
                                <div class="form-group row align-items-center">
                                    <label class="form-control-label col-sm-3 text-md-right">Site
                                        Name</label>
                                    <div class="col-sm-6 col-md-9">
                                        <input type="text" name="name" class="form-control"
                                               value="<?= (isset($website_info)) ? $website_info['name'] : '' ?>">
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="form-control-label col-sm-3 text-md-right">Site
                                        Description</label>
                                    <div class="col-sm-6 col-md-9">
                                        <textarea class="form-control"
                                                  name="description"><?= (isset($website_info)) ? $website_info['description'] : '' ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="form-control-label col-sm-3 text-md-right">Site Logo</label>
                                    <div class="col-sm-6 col-md-9">
                                        <div class="custom-file">
                                            <input type="file" name="logo" class="custom-file-input">
                                            <label class="custom-file-label">Choose File</label>
                                        </div>
                                        <div class="form-text text-muted">The image must have a maximum size of 1MB
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="form-control-label col-sm-3 text-md-right">Site Favicon</label>
                                    <div class="col-sm-6 col-md-9">
                                        <div class="custom-file">
                                            <input type="file" name="favicon" class="custom-file-input">
                                            <label class="custom-file-label">Choose File</label>
                                        </div>
                                        <div class="form-text text-muted">The image must have a maximum size of 1MB
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="form-control-label col-sm-3 text-md-right">Address</label>
                                    <div class="col-sm-6 col-md-9">
                                        <textarea class="form-control"
                                                  name="address"><?= (isset($website_info)) ? $website_info['address'] : '' ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="form-control-label col-sm-3 text-md-right">
                                        Phone</label>
                                    <div class="col-sm-6 col-md-9">
                                        <input type="text" name="phone" class="form-control"
                                               value="<?= (isset($website_info)) ? $website_info['phone'] : '' ?>">
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="form-control-label col-sm-3 text-md-right">
                                        Email</label>
                                    <div class="col-sm-6 col-md-9">
                                        <input type="email" name="email" class="form-control"
                                               value="<?= (isset($website_info)) ? $website_info['email'] : '' ?>">
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="form-control-label col-sm-3 text-md-right">
                                        Facebook</label>
                                    <div class="col-sm-6 col-md-9">
                                        <input type="text" name="facebook" class="form-control"
                                               value="<?= (isset($website_info)) ? $website_info['facebook'] : '' ?>">
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="form-control-label col-sm-3 text-md-right">
                                        Instagram</label>
                                    <div class="col-sm-6 col-md-9">
                                        <input type="text" name="instagram" class="form-control"
                                               value="<?= (isset($website_info)) ? $website_info['instagram'] : '' ?>">
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="form-control-label col-sm-3 text-md-right">
                                        Twitter</label>
                                    <div class="col-sm-6 col-md-9">
                                        <input type="text" name="twitter" class="form-control"
                                               value="<?= (isset($website_info)) ? $website_info['twitter'] : '' ?>">
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="form-control-label col-sm-3 text-md-right">
                                        Youtube</label>
                                    <div class="col-sm-6 col-md-9">
                                        <input type="text" name="youtube" class="form-control"
                                               value="<?= (isset($website_info)) ? $website_info['youtube'] : '' ?>">
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="form-control-label col-sm-3 text-md-right">
                                        Tiktok</label>
                                    <div class="col-sm-6 col-md-9">
                                        <input type="text" name="tiktok" class="form-control"
                                               value="<?= (isset($website_info)) ? $website_info['tiktok'] : '' ?>">
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="form-control-label col-sm-3 text-md-right">
                                        User Display</label>
                                    <div class="col-sm-6 col-md-9">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline1" name="user_display" value="1"
                                                   class="custom-control-input" <?= (isset($website_info) && $website_info['user_display'] == '1') ? 'checked' : '' ?>
                                                   checked>
                                            <label class="custom-control-label" for="customRadioInline1">On</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline2" name="user_display" value="0"
                                                   class="custom-control-input" <?= (isset($website_info) && $website_info['user_display'] == '0') ? 'checked' : '' ?>>
                                            <label class="custom-control-label"
                                                   for="customRadioInline2">Off</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-whitesmoke text-md-right">
                                <button class="btn btn-primary" type="submit" name="save">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>