<?php
// Paginate
$limit = 10;
$page = isset($_GET['hal']) ? (int)$_GET['hal'] : 1;
$page_start = ($page > 1) ? ($page * $limit) - $limit : 0;

$i = $page_start + 1;
$previous = $page - 1;
$next = $page + 1;

// Article List
$db = new Database();
$db->select_custom('announcements LEFT JOIN admin ON announcements.created_by=admin.id', "announcements.*", "WHERE announcements.status=1");
$total_data = mysqli_num_rows($db->result);
$total_page = ceil($total_data / $limit);

$db->select_custom(
    'announcements LEFT JOIN admin ON announcements.created_by=admin.id',
    'announcements.*, admin.name AS created_by',
    "WHERE announcements.status=1 ORDER BY announcements.created_at DESC LIMIT $page_start, $limit"
);

$announcements = $db->result;
?>
<!--====== EVENTS PART START ======-->

<section id="event-page" class="pt-30 pb-50 gray-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="section-title mt-20 pb-10">
                    <h5>Pengumuman</h5>

                    <h3>Daftar Pengumuman</h3>
                </div> <!-- section title -->
            </div>
        </div> <!-- row -->
        <div class="row">
            <?php
            while ($announcement = mysqli_fetch_array($announcements)) {
                $created_at = date_create($announcement['created_at']);
                ?>
                <div class="col-lg-6">
                    <div class="singel-event-list mt-30">
                        <div class="events-left">
                            <h3><?= $announcement['title'] ?></h3>
                            <a href="#"><span><i
                                            class="fa fa-calendar"></i> <?= date_format($created_at, "l, d F Y") ?></span></a>
                            <a href="#"><span><i
                                            class="fa fa-clock-o"></i> <?= date_format($created_at, "h:i:s A") ?></span></a>
                            <a href="#"><span><i class="fa fa-user"></i> Oleh <?= $announcement['created_by'] ?></span></a>
                            <img src="../public/images/announcement/<?= $announcement['photo'] ?>"
                                 alt="<?= $announcement['slug'] ?>">
                            <?= htmlspecialchars_decode($announcement['content']) ?>
                        </div> <!-- events left -->
                    </div>
                </div>
            <?php } ?>

        </div> <!-- row -->
        <div class=" row">
            <div class="col-lg-12">
                <nav class="courses-pagination mt-50">
                    <ul class="pagination justify-content-center">
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
        </div>  <!-- row -->
    </div> <!-- container -->
</section>

<!--====== EVENTS PART ENDS ======-->