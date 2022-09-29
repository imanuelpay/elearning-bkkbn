<?php
// Paginate
$limit = 10;
$page = isset($_GET['hal']) ? (int)$_GET['hal'] : 1;
$page_start = ($page > 1) ? ($page * $limit) - $limit : 0;

$i = $page_start + 1;
$previous = $page - 1;
$next = $page + 1;

$query = "";

if (isset($_GET['kategori'])) {
    $kategori = $_GET['kategori'];
    $query .= "WHERE categories.slug='$kategori'";
}

// Search
if (isset($_POST['search'])) {
    $search = $_POST['q'];

    if (isset($kategori)) {
        $query .= " AND ";
    } else {
        $query .= "WHERE ";
    }

    $query .= "articles.title LIKE '%$search%'";
}

// Article List
$db = new Database();
$db->select_custom('articles LEFT JOIN categories ON articles.category_id=categories.id LEFT JOIN admin ON articles.created_by=admin.id', "articles.*", $query);
$total_data = mysqli_num_rows($db->result);
$total_page = ceil($total_data / $limit);

$db->select_custom(
    'articles LEFT JOIN categories ON articles.category_id=categories.id LEFT JOIN admin ON articles.created_by=admin.id',
    'articles.*, admin.name AS created_by, categories.name AS category',
    "$query AND articles.status=1 ORDER BY created_at DESC LIMIT $page_start, $limit"
);

$articles = $db->result;

$db = new Database();
$db->select_custom(
    'categories',
    '*',
    "WHERE status=1"
);
$categories = $db->result;
?>

<!--====== BLOG PART START ======-->
<section id="blog-page" class="pt-30 pb-50 gray-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="section-title mt-20 pb-10">
                    <h5>Artikel</h5>

                    <h3><?= (isset($search)) ? 'Cari ' : 'Daftar' ?>
                        Artikel <?= (isset($kategori)) ? "Kategori " . ucfirst($kategori) : '' ?> <?= (isset($search)) ? ": $search" : '' ?></h3>
                </div> <!-- section title -->
            </div>
        </div> <!-- row -->

        <div class="row">
            <div class="col-lg-8">

                <?php
                while ($article = mysqli_fetch_array($articles)) {
                    $created_at = date_create($article['created_at']);
                    ?>
                    <div class="singel-blog mt-30">
                        <div class="blog-thum">
                            <img src="../public/images/article/<?= $article['thumbnail'] ?>"
                                 alt="<?= $article['title'] ?>">
                        </div>
                        <div class="blog-cont">
                            <a href="?halaman=lihat-artikel&artikel=<?= $article['slug'] ?>">
                                <h3><?= $article['title'] ?></h3></a>
                            <ul>
                                <li><a href="#"><i
                                                class="fa fa-calendar"></i><?= date_format($created_at, "l, d F Y") ?>
                                    </a></li>
                                <li><a href="#"><i class="fa fa-user"></i><?= $article['created_by'] ?></a></li>
                                <li><a href="#"><i class="fa fa-tags"></i><?= $article['category'] ?></a></li>
                            </ul>
                            <p class="text-justify"><?php
                                if (strlen($article['content']) > 350) {
                                    echo substr(htmlspecialchars_decode($article['content']), 0, 350) . '.....';
                                } else {
                                    echo htmlspecialchars_decode($article['content']);
                                }
                                ?>
                            </p>
                        </div>
                    </div> <!-- singel blog -->
                <?php } ?>
                <nav class="courses-pagination mt-50">
                    <ul class="pagination justify-content-lg-end justify-content-center">
                        <li class="page-item" <?= ($page < 2) ? 'disabled' : '' ?>>
                            <a href="?halaman=<?= (isset($_GET['halaman'])) ? $_GET['halaman'] : '' ?><?= ($page > 1) ? '&hal=' . $previous : '' ?>"
                               aria-label="Sebelumnya">
                                <i class="fa fa-angle-left"></i>
                            </a>
                        </li>

                        <?php for ($x = 1; $x <= $total_page; $x++) { ?>
                            <li class="page-item"><a class="<?= ($page == $x) ? 'active' : '' ?>"
                                                     href="?halaman=<?= (isset($_GET['halaman'])) ? $_GET['halaman'] : '' ?>&hal=<?= $x ?>"><?= $x ?></a>
                            </li>
                        <?php } ?>

                        <li class="page-item" <?= ($page < 2) || ($page == $total_page) ? 'disabled' : '' ?>>
                            <a href="?halaman=<?= (isset($_GET['halaman'])) ? $_GET['halaman'] : '' ?><?= ($page > 1) ? '&hal=' . $next : '' ?>"
                               aria-label="Selanjutnya">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>  <!-- courses pagination -->
            </div>

            <div class="col-lg-4">
                <div class="saidbar">
                    <div class="row">
                        <div class="col-lg-12 col-md-6">
                            <div class="saidbar-search mt-30">
                                <form method="post">
                                    <input type="text" name="q" value="<?= (isset($search)) ? $search : '' ?>"
                                           placeholder="Search">
                                    <button type="submit" name="search"><i class="fa fa-search"></i></button>
                                </form>
                            </div> <!-- saidbar search -->
                            <div class="categories mt-30">
                                <h4>Kategori</h4>
                                <ul>
                                    <li>
                                        <a href="?halaman=<?= (isset($_GET['halaman'])) ? $_GET['halaman'] : '' ?>">Semua</a>
                                    </li>
                                    <?php
                                    while ($category = mysqli_fetch_array($categories)) {
                                        ?>
                                        <li>
                                            <a href="?halaman=<?= (isset($_GET['halaman'])) ? $_GET['halaman'] : '' ?>&kategori=<?= $category['slug'] ?>"><?= $category['name'] ?></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div> <!-- categories -->
                    </div> <!-- row -->
                </div> <!-- saidbar -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</section>

<!--====== BLOG PART ENDS ======-->