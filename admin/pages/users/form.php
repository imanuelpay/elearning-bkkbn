<?php
if ((isset($_GET['edit']) && isset($_GET['id']))) {
    $id = $_GET['id'];

    $db = new Database();
    $db->select_custom('user', '*', "INNER JOIN user_details ON user.id=user_details.user_id WHERE id='$id'");
    $user = mysqli_fetch_array($db->result);
}
?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="?page=users" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1><?= (isset($_GET['edit']) && isset($_GET['id'])) ? 'Edit User' : 'Create New User ' ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="?page=users">Users</a></div>
                <div class="breadcrumb-item"><?= (isset($_GET['edit']) && isset($_GET['id'])) ? 'Edit ' : 'Add ' ?>
                    User
                </div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title"><?= (isset($_GET['edit']) && isset($_GET['id'])) ? 'Edit ' : 'Add ' ?>
                User</h2>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4><?= (isset($_GET['edit']) && isset($_GET['id'])) ? 'Edit ' : 'Add ' ?>
                                User <?= (isset($_GET['edit']) && isset($user)) ? ": {$user['name']}" : '' ?></h4>
                        </div>
                        <div class="card-body">
                            <form action="?page=user-action" method="post" enctype="multipart/form-data">
                                <?= (isset($_GET['edit']) && isset($user)) ? '<input type="hidden" name="id" value="' . $user['id'] . '">' : '' ?>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="name" class="form-control" required
                                               value="<?= (isset($_GET['edit']) && isset($user)) ? $user['name'] : '' ?>">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Birth of
                                        Date</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="date" name="birth_of_date" class="form-control"
                                               value="<?= (isset($_GET['edit']) && isset($user)) ? $user['birth_of_date'] : '' ?>">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gender</label>
                                    <div class="col-sm-12 col-md-7 mt-1">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="genderMale" name="gender" value="Male"
                                                   class="custom-control-input" <?= (isset($_GET['edit']) && isset($user) && $user['gender'] == 'Male') ? 'checked' : '' ?>
                                                   checked>
                                            <label class="custom-control-label" for="genderMale">Male</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="genderFemale" name="gender" value="Female"
                                                   class="custom-control-input" <?= (isset($_GET['edit']) && isset($user) && $user['gender'] == 'Female') ? 'checked' : '' ?>>
                                            <label class="custom-control-label"
                                                   for="genderFemale">Female</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Handphone</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="handphone" class="form-control"
                                               value="<?= (isset($_GET['edit']) && isset($user)) ? $user['handphone'] : '' ?>">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Address</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="address" class="form-control"
                                               value="<?= (isset($_GET['edit']) && isset($user)) ? $user['address'] : '' ?>">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">City</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="city" class="form-control"
                                               value="<?= (isset($_GET['edit']) && isset($user)) ? $user['city'] : '' ?>">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Photo</label>
                                    <div class="col-sm-12 col-md-3">
                                        <div id="image-preview" class="image-preview">
                                            <label for="image-upload" id="image-label">Choose File</label>
                                            <input type="file" name="photo" id="image-upload" accept="image/*"/>
                                        </div>
                                        <?= (isset($_GET['edit']) && isset($user)) ? '<div class="form-text text-muted">Kosongkan jika tidak ingin mengubah thumbnail.</div>' : '' ?>
                                    </div>

                                    <?= (isset($_GET['edit']) && isset($user)) ? '<div class="gallery gallery-fw col-sm-12 col-md-3" data-item-height="250">
                                        <div class="gallery-item" data-image="../public/images/user/' . $user['photo'] . '"
                                                     data-title="' . $user['username'] . '"></div>
                                    </div>' : '' ?>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="categories" class="form-control select2">
                                            <option value="PNS">PNS</option>
                                            <option value="PPPK">PPPK</option>
                                            <option value="PLKB/PKB">PLKB/PKB</option>
                                            <option value="Non PNS">Non PNS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">NIP</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="nip" class="form-control"
                                               value="<?= (isset($_GET['edit']) && isset($user)) ? $user['nip'] : '' ?>">
                                        <div class="form-text text-muted">Kosongkan jika Non PNS</div>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="email" name="email" class="form-control" required
                                               value="<?= (isset($_GET['edit']) && isset($user)) ? $user['email'] : '' ?>">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Username</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="username" class="form-control" required
                                               value="<?= (isset($_GET['edit']) && isset($user)) ? $user['username'] : '' ?>">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="password" name="password" class="form-control">
                                        <?= (isset($_GET['edit']) && isset($user)) ? '<div class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</div>' : '' ?>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                                    <div class="col-sm-12 col-md-7 mt-1">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="statusActive" name="status" value="1"
                                                   class="custom-control-input" <?= (isset($_GET['edit']) && isset($user) && $user['status'] == '1') ? 'checked' : '' ?>
                                                   checked>
                                            <label class="custom-control-label" for="statusActive">Active</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="statusInactive" name="status" value="0"
                                                   class="custom-control-input" <?= (isset($_GET['edit']) && isset($user) && $user['status'] == '0') ? 'checked' : '' ?>>
                                            <label class="custom-control-label"
                                                   for="statusInactive">Inactive</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Verified</label>
                                    <div class="col-sm-12 col-md-7 mt-1">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="isVerifiedYes" name="is_verified" value="1"
                                                   class="custom-control-input" <?= (isset($_GET['edit']) && isset($user) && $user['is_verified'] == '1') ? 'checked' : '' ?>
                                                   checked>
                                            <label class="custom-control-label" for="isVerifiedYes">Yes</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="isVerifiedNo" name="is_verified" value="0"
                                                   class="custom-control-input" <?= (isset($_GET['edit']) && isset($user) && $user['is_verified'] == '0') ? 'checked' : '' ?>>
                                            <label class="custom-control-label"
                                                   for="isVerifiedNo">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-success"
                                                name="<?= (isset($_GET['edit']) && isset($_GET['id'])) ? 'edit' : 'add' ?>">
                                            <?= (isset($_GET['edit']) && isset($_GET['id'])) ? 'Edit ' : 'Add ' ?>
                                            User
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