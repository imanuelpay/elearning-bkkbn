<?php
// Paginate
$limit = 10;
$page = isset($_GET['hal']) ? (int)$_GET['hal'] : 1;
$page_start = ($page > 1) ? ($page * $limit) - $limit : 0;

$i = $page_start + 1;
$previous = $page - 1;
$next = $page + 1;

$query = "INNER JOIN user_details ON user.id=user_details.user_id ";

// Search
if (isset($_POST['search'])) {
    $search = $_POST['q'];
    $query .= "WHERE name LIKE '%$search%' OR username LIKE '%$search%' OR email LIKE '%$search%'";
}

// Article List
$db = new Database();
$db->select_custom('user', "id", $query);
$total_data = mysqli_num_rows($db->result);
$total_page = ceil($total_data / $limit);

$db->select_custom(
    'user',
    '*',
    "$query ORDER BY created_at DESC LIMIT $page_start, $limit"
);

$user_data = $db->result;
?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Users</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Users</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Users</h2>

            <?php
            if (isset($_SESSION['success_msg'])) {
                echo $_SESSION['success_msg'];
                unset($_SESSION['success_msg']);
            }
            ?>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header row">
                            <h4 class="col-md-5"><?= (isset($search)) ? 'Search ' : 'All' ?>
                                Users <?= (isset($search)) ? ": $search" : '' ?></h4>

                            <div class="col-md-4 float-right">
                                <form method="post">
                                    <div class="input-group">
                                        <input type="text" name="q" value="<?= (isset($search)) ? $search : '' ?>"
                                               class="form-control" placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit" name="search" class="btn btn-primary"><i
                                                        class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-3 float-right">
                                <a href="?page=users" class="btn btn-sm btn-outline-success">
                                    <i class="fa fa-rotate"></i>
                                    Refresh
                                </a>

                                <a href="?page=user-form&add" class="btn btn-sm btn-outline-primary float-right">
                                    <i class="fa fa-rotate"></i>
                                    Add User
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Verified</th>
                                        <th>Status</th>
                                    </tr>
                                    <?php

                                    $no = 1;
                                    if ($total_data < 1) {
                                        echo '<td class="text-center" colspan="15"><i>Data tidak ditemukan...</i></td>';
                                    }

                                    while ($user = mysqli_fetch_array($user_data)) {
                                    $time = strtotime($user['created_at']);
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <div class="gallery circle">
                                                <?php if ($user['gender'] == 'Male' && $user['photo'] == 'avatar.png') { ?>
                                                    <div class="gallery-item"
                                                         data-image="../public/images/user/avatar_male.png"
                                                         data-title="<?= $user['username'] ?>"></div>
                                                <?php } else if ($user['gender'] == 'Female' && $user['photo'] == 'avatar.png') { ?>
                                                    <div class="gallery-item"
                                                         data-image="../public/images/user/avatar_female.png"
                                                         data-title="<?= $user['username'] ?>"></div>
                                                <?php } else { ?>
                                                    <div class="gallery-item"
                                                         data-image="../public/images/user/<?= $user['photo'] ?>"
                                                         data-title="<?= $user['username'] ?>"></div>
                                                <?php } ?>
                                            </div>
                                        </td>
                                        <td><?= $user['name'] ?>
                                            <div class="table-links">
                                                <a href="?page=user-form&id=<?= $user['id'] ?>&edit"
                                                   class="text-warning mr-3"> <i
                                                            class="fa fa-edit"></i>Edit</a>
                                                <a href="#modalDelete" class="text-danger" data-toggle="modal"
                                                   data-target="#modalDelete" onclick="
                                                        $('#modalDelete #linkDelete').attr('href', '<?= $baseURL ?>/admin/?page=user-action&id=<?= $user['id'] ?>&delete');
                                                        $('#modalDelete #modalDeleteLabel').text('Apakah anda yakin?');
                                                        $('#modalDelete #bodyDelete #deleteTitle').text('Anda ingin menghapus User <?= $user['name'] ?> secara permanen?');">
                                                    <i class="fa fa-trash"></i>
                                                    Trash</a>
                                            </div>
                                        </td>
                                        <td>
                                            <?= $user['email'] ?>
                                        </td>
                                        <td>
                                            <?= $user['username'] ?>
                                        </td>
                                        <td>
                                            <?= ($user['is_verified'] == 1) ? '<div class="badge badge-success">Yes</div>' : '<span class="badge badge-danger">No</span>' ?>
                                        </td>
                                        <td>
                                            <?= ($user['status'] == 1) ? '<div class="badge badge-success">Active</div>' : '<span class="badge badge-danger">Inactive</span>' ?>
                                        </td>
                                    <tr>
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