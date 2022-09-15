<?php
$a = new Database();

$limit = 10;
$page = isset($_GET['hal']) ? (int)$_GET['hal'] : 1;
$page_start = ($page > 1) ? ($page * $limit) - $limit : 0;

$i = $page_start + 1;
$previous = $page - 1;
$next = $page + 1;

$a->select('categories');
$total_data = mysqli_num_rows($a->sql);
$total_page = ceil($total_data / $limit);

$a->select_custom(
    'categories',
    '*',
    "ORDER BY name LIMIT $page_start, $limit"
);

$result = $a->sql;


if ((isset($_GET['edit']) && isset($_GET['id']))) {
    $id = $_GET['id'];

    $db = new Database();
    $db->select('categories', '*', "id='$id'");
    $category = mysqli_fetch_array($db->sql);
}
?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Categories</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Categories</a></div>
                <div class="breadcrumb-item">All Category</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Categories</h2>

            <?php
            if (isset($_SESSION['success_msg'])) {
                echo $_SESSION['success_msg'];
                unset($_SESSION['success_msg']);
            }
            ?>

            <div class="row mt-4">
                <div class="card col-md-4 col-sm-12">
                    <form action="?page=category-action" method="post">
                        <div class="card-header">
                            <h4><?= (isset($_GET['edit']) && isset($_GET['id'])) ? 'Edit ' : 'Add ' ?> Category</h4>
                        </div>
                        <div class="card-body">
                            <?= (isset($_GET['edit'])) ? '<input type="hidden" name="id" value="' . $id . '">' : '' ?>
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" name="name"
                                       value="<?= (isset($_GET['edit'])) ? $category['name'] : '' ?>"
                                       class="form-control" required="">
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" name="status"
                                           class="custom-control-input"
                                           value="1" <?= (isset($_GET['edit']) && $category['status'] == '1') ? 'checked' : '' ?>
                                           checked>
                                    <label class="custom-control-label" for="customRadio1">Active</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="status"
                                           class="custom-control-input"
                                           value="0" <?= (isset($_GET['edit']) && $category['status'] == '0') ? 'checked' : '' ?>>
                                    <label class="custom-control-label" for="customRadio2">Inactive</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit"
                                    name="<?= (isset($_GET['edit']) && isset($_GET['id'])) ? 'edit' : 'save' ?>"
                                    class="btn btn-primary"><?= (isset($_GET['edit']) && isset($_GET['id'])) ? 'Edit ' : 'Add ' ?></button>
                        </div>
                    </form>
                </div>

                <div class="col-md-8 col-sm-12">
                    <div class="card">
                        <div class="card-header row">
                            <h4 class="col-md-10">All Category</h4>

                            <div class="col-md-2 float-right">
                                <a href="?page=categories" class="btn btn-sm btn-outline-success float-right">
                                    <i class="fa fa-rotate"></i>
                                    Refresh
                                </a>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Status</th>
                                    </tr>
                                    <?php

                                    $no = 1;
                                    if ($total_data < 1) {
                                        echo '<td class="text-center" colspan="15"><i>Data tidak ditemukan...</i></td>';
                                    }

                                    while ($category = mysqli_fetch_array($result)) {
                                        ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $category['name'] ?>
                                                <div class="table-links">
                                                    <a href="?page=categories&id=<?= $category['id'] ?>&edit"
                                                       class="text-warning mr-3"> <i
                                                                class="fa fa-edit"></i>Edit</a>
                                                    <a href="#modalDelete" class="text-danger" data-toggle="modal"
                                                       data-target="#modalDelete" onclick="
                                                            $('#modalDelete #linkDelete').attr('href', '<?= $baseURL ?>/admin/?page=category-action&id=<?= $category['id'] ?>&delete');
                                                            $('#modalDelete #modalDeleteLabel').text('Apakah anda yakin?');
                                                            $('#modalDelete #bodyDelete #deleteTitle').text('Anda ingin menghapus Category <?= $category['name'] ?> secara permanen?');">
                                                        <i class="fa fa-trash"></i>
                                                        Trash</a>
                                                </div>
                                            </td>
                                            <td><?= $category['slug'] ?></td>
                                            <td>
                                                <?= ($category['status'] == 1) ? '<div class="badge badge-success">Active</div>' : '<span class="badge badge-danger">Inactive</span>' ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                            <div class="float-right">
                                <nav>
                                    <ul class="pagination">
                                        <li class="page-item <?= ($page < 2) ? 'disabled' : '' ?>">
                                            <a class="page-link"
                                               href="?page=<?= (isset($_GET['page'])) ? $_GET['page'] : '' ?><?= ($page > 1) ? '&hal=' . $previous : '' ?>"
                                               aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </li>

                                        <?php for ($x = 1; $x <= $total_page; $x++) { ?>
                                            <li class="page-item <?= ($page == $x) ? 'active' : '' ?>">
                                                <a class="page-link"
                                                   href="?page=<?= (isset($_GET['page'])) ? $_GET['page'] : '' ?>&hal=<?= $x ?>"><?= $x ?></a>
                                            </li>
                                        <?php } ?>
                                        <li class="page-item <?= ($page < 2) || ($page == $total_page) ? 'disabled' : '' ?>">
                                            <a class="page-link"
                                               href="?page=<?= (isset($_GET['page'])) ? $_GET['page'] : '' ?><?= ($page > 1) ? '&hal=' . $next : '' ?>"
                                               aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
