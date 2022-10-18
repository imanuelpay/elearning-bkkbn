<?php
$db = new Database();

// Banner Data
$db->select_custom(
    'banner',
    '*',
    "WHERE status=1 ORDER BY created_at DESC"
);
$data_banner = $db->result;

// Announcement Data
$db->select_custom(
    'announcements LEFT JOIN admin ON announcements.created_by=admin.id',
    'announcements.*, admin.name AS created_by, admin.photo AS avatar',
    "WHERE announcements.status=1 ORDER BY announcements.created_at DESC LIMIT 3"
);
$data_announcement = $db->result;

// Total Announcement
$db->select_custom(
    'announcements',
    '*',
    "WHERE status=1"
);
$total_announcement = mysqli_num_rows($db->result);

// Course Data
$db->select_custom(
    'courses',
    '*',
    "WHERE status=1 ORDER BY created_at DESC LIMIT 5"
);
$data_course = $db->result;

// Total Course
$db->select_custom(
    'courses',
    '*',
    "WHERE status=1"
);
$total_course = mysqli_num_rows($db->result);

// Article Data
$db->select_custom(
    'articles LEFT JOIN categories ON articles.category_id=categories.id LEFT JOIN admin ON articles.created_by=admin.id',
    'articles.*, admin.name AS created_by, admin.photo AS avatar',
    "WHERE articles.status=1 ORDER BY articles.created_at DESC LIMIT 1"
);
$data_article1 = $db->result;

$db->select_custom(
    'articles LEFT JOIN categories ON articles.category_id=categories.id LEFT JOIN admin ON articles.created_by=admin.id',
    'articles.*, admin.name AS created_by, admin.photo AS avatar',
    "WHERE articles.status=1 ORDER BY articles.created_at DESC LIMIT 3 OFFSET 1"
);
$data_article2 = $db->result;

// Total Article
$db->select_custom(
    'articles',
    '*',
    "WHERE status=1"
);
$total_article = mysqli_num_rows($db->result);

// Total User
$db->select_custom(
    'user',
    '*',
    "WHERE status=1"
);
$total_user = mysqli_num_rows($db->result);
?>
<!--====== SLIDER PART START ======-->

<section id="slider-part" class="slider-active">
    <?php
    while ($banner = mysqli_fetch_array($data_banner)) {
        ?>
        <div class="single-slider slider-2 bg_cover"
             style="background-image: url(../public/images/banner/<?= $banner['photo'] ?>)"
             data-overlay="4">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-lg-10">
                        <div class="slider-cont">
                            <h1 data-animation="bounceInLeft" data-delay="1s"><?= $banner['title'] ?></h1>
                            <a data-animation="fadeInUp" data-delay="1.3s" href="<?= $banner['link'] ?>"
                               class="main-btn">Baca selanjutnya</a>
                        </div>
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- single slider -->
    <?php } ?>
</section>

<!--====== SLIDER PART ENDS ======-->

<!--====== CATEGORY PART START ======-->

<section id="category-2-part" class="gray-bg pb-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="section-title mt-50">
                    <h5>Pengumuman</h5>
                    <h3>Pengumuman Terbaru</h3>
                </div>

                <?php
                while ($announcement = mysqli_fetch_array($data_announcement)) {
                    $created_at = date_create($announcement['created_at']);
                    ?>
                    <div class="singel-event-list mt-30">
                        <div class="event-thum">
                            <img src="../public/images/announcement/<?= $announcement['photo'] ?>"
                                 alt="<?= $announcement['slug'] ?>">
                        </div>
                        <div class="event-cont">
                            <span><i class="fa fa-calendar"></i> <?= date_format($created_at, "l, d F Y") ?></span>
                            <h4><?= $announcement['title'] ?></h4>
                            <span><i class="fa fa-clock-o"></i> <?= date_format($created_at, "h:i:s A") ?></span>
                            <span><i class="fa fa-user"></i> Oleh <?= $announcement['created_by'] ?></span>
                            <?php
                            if (strlen($announcement['content']) > 80) {
                                echo substr(htmlspecialchars_decode($announcement['content']), 0, 80) . '.....';
                            } else {
                                echo htmlspecialchars_decode($announcement['content']);
                            } ?>
                        </div>
                    </div>
                <?php } ?>

            </div>

            <div class="col-lg-5">
                <?php if (!isset($_SESSION['login_user'])) { ?>
                    <div class="category-form">
                        <div class="form-title text-center">
                            <h3>Masuk Sekarang!</h3>
                            <span>Isi formulir dibawah. </span>
                        </div>
                        <div class="main-form">
                            <form method="post" action="?halaman=action-auth" data-toggle="validator">
                                <div class="singel-form">
                                    <?php
                                    if (isset($_GET['redirect'])) {
                                        echo $_SESSION['success_msg'];
                                    } else {
                                        unset($_SESSION['redirect_login']);
                                        unset($_SESSION['success_msg']);
                                    }
                                    ?>
                                </div>
                                <div class="singel-form">
                                    <input type="email" name="email"
                                           placeholder="Email anda" <?= (isset($_GET['redirect'])) ? 'autofocus' : '' ?>>
                                </div>
                                <div class="singel-form">
                                    <input type="password" name="password" placeholder="Kata sandi anda">
                                </div>
                                <div class="singel-form">
                                    <button class="main-btn" type="submit" name="login">Masuk</button>
                                </div>
                                <div class="singel-form">
                                    <a class="main-btn" href="?halaman=daftar-akun">Belum punya akun? Daftar Akun</a>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="category-form">
                        <div class="form-title text-center">
                            <h3>Selamat Datang</h3>
                            <span><?= isset($userLogin) ? $userLogin['name'] : '' ?></span>
                        </div>
                        <div class="teachers-left">
                            <div class="hero">
                                <?php if (isset($userLogin) && $userLogin['gender'] == 'Male' && $userLogin['photo'] == 'avatar.png') { ?>
                                    <img src="../public/images/user/avatar_male.png"
                                         alt="<?= isset($userLogin) ? $userLogin['name'] : '' ?>" width="50">
                                <?php } else if (isset($userLogin) && $userLogin['gender'] == 'Female' && $userLogin['photo'] == 'avatar.png') { ?>
                                    <img src="../public/images/user/avatar_female.png"
                                         alt="<?= isset($userLogin) ? $userLogin['name'] : '' ?>">
                                <?php } else { ?>
                                    <img src="../public/images/user/<?= isset($userLogin) ? $userLogin['photo'] : '' ?>"
                                         alt="<?= isset($userLogin) ? $userLogin['name'] : '' ?>">
                                <?php } ?>
                            </div>
                            <div class="name">
                                <h6><?= isset($userLogin) ? $userLogin['name'] : '' ?></h6>
                                <span><?= isset($userLogin) ? $userLogin['username'] : '' ?> / <?= isset($userLogin) ? $userLogin['email'] : '' ?></span>
                            </div>
                            <div class="description">
                                <table>
                                    <tr>
                                        <td width="125">Jenis Kelamin</td>
                                        <td>:</td>
                                        <td><?= isset($userLogin) && $userLogin['gender'] == 'Male' ? 'Laki-laki' : 'Perempuan' ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Lahir</td>
                                        <td>:</td>
                                        <td>Aku</td>
                                    </tr>
                                    <tr>
                                        <td>Nomor HP</td>
                                        <td>:</td>
                                        <td><?= isset($userLogin) ? $userLogin['handphone'] : '' ?></td>
                                    </tr>
                                    <tr>
                                        <td>Kota</td>
                                        <td>:</td>
                                        <td><?= isset($userLogin) ? $userLogin['city'] : '' ?></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td><?= isset($userLogin) ? $userLogin['address'] : '' ?></td>
                                    </tr>
                                    <tr>
                                        <td>Kategori</td>
                                        <td>:</td>
                                        <td><?= isset($userLogin) ? $userLogin['categories'] : '' ?></td>
                                    </tr>
                                    <tr>
                                        <td>NIP</td>
                                        <td>:</td>
                                        <td><?= isset($userLogin) && !is_null($userLogin['nip']) ? $userLogin['nip'] : '-' ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</section>

<!--====== CATEGORY PART ENDS ======-->
<?php if ($total_course > 3) { ?>

    <!--====== COURSE PART START ======-->

    <section id="course-part" class="pt-30 pb-10">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title pb-10">
                        <h5>Pelatihan</h5>
                        <h2>Pelatihan Terbaru </h2>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="row course-slied mt-10">
                <?php
                while ($course = mysqli_fetch_array($data_course)) {
                    ?>
                    <div class="col-lg-4">
                        <div class="singel-course-2">
                            <div class="thum">
                                <div class="image">
                                    <img src="../public/images/course/<?= $course['thumbnail'] ?>" alt="Course">
                                </div>
                                <div class="price">
                                    <span>Free</span>
                                </div>
                                <div class="course-teacher">
                                    <div class="thum">
                                        <a href="courses-singel.html"><img
                                                    src="./assets/user/images/course/teacher/t-1.jpg"
                                                    alt="teacher"></a>
                                    </div>
                                    <div class="name">
                                        <a href="#"><h6>Mark anthem</h6></a>
                                    </div>
                                    <div class="review">
                                        <ul>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="cont">
                                <a href="#"><h4>Learn basis javascirpt from start for beginner</h4></a>
                            </div>
                        </div> <!-- singel course -->
                    </div>
                <?php } ?>
            </div> <!-- course slied -->
        </div> <!-- container -->
    </section>

    <!--====== COURSE PART ENDS ======-->

<?php } ?>
<!--====== NEWS PART START ======-->

<section id="news-part" class="pt-30 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-title pb-10">
                    <h5>Artikel</h5>
                    <h2>Artikel Terbaru</h2>
                </div> <!-- section title -->
            </div>
        </div> <!-- row -->
        <div class="row">
            <div class="col-lg-6">
                <?php
                while ($article = mysqli_fetch_array($data_article1)) {
                    $created_at = date_create($article['created_at']);
                    ?>
                    <div class="singel-news mt-30">
                        <div class="news-thum pb-25">
                            <img src="../public/images/article/<?= $article['thumbnail'] ?>" alt="News">
                        </div>
                        <div class="news-cont">
                            <ul>
                                <li><a href="#"><i
                                                class="fa fa-calendar"></i><?= date_format($created_at, "d F Y") ?>
                                    </a></li>
                                <li><a href="#"> <span>By</span> <?= $article['created_by'] ?></a></li>
                            </ul>
                            <a href="?halaman=lihat-artikel&artikel=<?= $article['slug'] ?>">
                                <h3><?= $article['title'] ?></h3></a>

                            <p class="text-justify">
                                <?php
                                if (strlen($article['content']) > 300) {
                                    echo substr(htmlspecialchars_decode($article['content']), 0, 300) . '.....';
                                } else {
                                    echo htmlspecialchars_decode($article['content']);
                                }
                                ?>
                            </p>
                        </div>
                    </div> <!-- singel news -->
                <?php } ?>
            </div>
            <div class="col-lg-6">
                <?php
                while ($article = mysqli_fetch_array($data_article2)) {
                    $created_at = date_create($article['created_at']);
                    ?>
                    <div class="singel-news news-list">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="news-thum mt-30">
                                    <img src="../public/images/article/<?= $article['thumbnail'] ?>" alt="News">
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="news-cont mt-30">
                                    <ul>
                                        <li><a href="#"><i
                                                        class="fa fa-calendar"></i><?= date_format($created_at, "d F Y") ?>
                                            </a></li>
                                        <li><a href="#"> <span>By</span> <?= $article['created_by'] ?></a></li>
                                    </ul>
                                    <a href="?halaman=lihat-artikel&artikel=<?= $article['slug'] ?>">
                                        <h3><?= $article['title'] ?></h3></a>
                                    <p class="text-justify">
                                        <?php
                                        if (strlen($article['content']) > 250) {
                                            echo substr(htmlspecialchars_decode($article['content']), 0, 250) . '.....';
                                        } else {
                                            echo htmlspecialchars_decode($article['content']);
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div> <!-- row -->
                    </div> <!-- singel news -->
                <?php } ?>
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</section>

<!--====== NEWS PART ENDS ======-->

<!--====== COUNTER PART START ======-->

<div id="counter-part" class="bg_cover pt-10 pb-50" data-overlay="8"
     style="background-image: url(./assets/user/images/bg-2.jpg)">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <div class="singel-counter text-center mt-40">
                    <span class="counter"><?= $total_user ?></span>
                    <p>PENGGUNA</p>
                </div> <!-- singel counter -->
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="singel-counter text-center mt-40">
                    <span class="counter"><?= $total_course ?></span>
                    <p>PELATIHAN</p>
                </div> <!-- singel counter -->
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="singel-counter text-center mt-40">
                    <span class="counter"><?= $total_article ?></span>
                    <p>ARTIKEL</p>
                </div> <!-- singel counter -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</div>

<!--====== COUNTER PART ENDS ======-->