<?php
if (isset($_GET['artikel'])) {
    $db = new Database();
    $db->select_custom(
        'articles LEFT JOIN categories ON articles.category_id=categories.id LEFT JOIN admin ON articles.created_by=admin.id',
        'articles.*, admin.name AS created_by, categories.name AS category',
        "WHERE articles.slug='{$_GET['artikel']}'"
    );

    $article = mysqli_fetch_array($db->result);
    $created_at = date_create($article['created_at']);
}

if (!isset($_SESSION['login_user'])) {
    $_SESSION['redirect_login'] = "lihat-artikel&artikel={$article['slug']}";
    $_SESSION['success_msg'] = '<div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-info"></i> <strong>Silahkan Login!</strong> Login untuk lanjutkan membaca artikel.
                </div>';

    echo("<script>location.href='$baseURL/user/?halaman=beranda&redirect={$_SESSION['redirect_login']}';</script>");
}

$db = new Database();
$db->select_custom(
    'categories',
    '*',
    "WHERE status=1"
);
$categories = $db->result;
?>
<!--====== BLOG PART START ======-->

<section id="blog-singel" class="pt-30 pb-50 gray-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="section-title mt-20 pb-10">
                    <h5>Artikel</h5>

                    <h3>Baca Artikel</h3>
                </div> <!-- section title -->
            </div>
        </div> <!-- row -->
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-details mt-30">
                    <div class="thum">
                        <img src="../public/images/article/<?= $article['thumbnail'] ?>"
                             alt="<?= $article['title'] ?>">
                    </div>
                    <div class="cont">
                        <h3><?= $article['title'] ?></h3>
                        <ul>
                            <li><a href="#"><i
                                            class="fa fa-calendar"></i><?= date_format($created_at, "l, d F Y") ?>
                                </a></li>
                            <li><a href="#"><i class="fa fa-user"></i><?= $article['created_by'] ?></a></li>
                            <li><a href="#"><i class="fa fa-tags"></i><?= $article['category'] ?></a></li>
                        </ul>
                        <p class="text-justify"><?= htmlspecialchars_decode($article['content'])
                            ?>
                        </p>
                    </div> <!-- cont -->
                </div> <!-- blog details -->
            </div>
            <div class="col-lg-4">
                <div class="saidbar">
                    <div class="row">
                        <div class="col-lg-12 col-md-6">
                            <div class="saidbar-search mt-30">
                                <form method="post" action="?halaman=artikel">
                                    <input type="text" name="q" value="<?= (isset($search)) ? $search : '' ?>"
                                           placeholder="Search">
                                    <button type="submit" name="search"><i class="fa fa-search"></i></button>
                                </form>
                            </div> <!-- saidbar search -->
                            <div class="categories mt-30">
                                <h4>Kategori</h4>
                                <ul>
                                    <li>
                                        <a href="?halaman=artikel">Semua</a>
                                    </li>
                                    <?php
                                    while ($category = mysqli_fetch_array($categories)) {
                                        ?>
                                        <li>
                                            <a href="?halaman=artikel&kategori=<?= $category['slug'] ?>"><?= $category['name'] ?></a>
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