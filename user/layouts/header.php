<header id="header-part">

    <div class="header-top d-none d-md-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="header-contact text-lg-left text-center">
                        <ul>
                            <li><img src="../assets/user/images/all-icon/call.png"
                                     alt="icon"
                                     style="filter: brightness(0) invert(1);"><span><?= $info['phone'] ?></span>
                            </li>
                            <li><img src="../assets/user/images/all-icon/email.png"
                                     alt="icon"
                                     style="filter: brightness(0) invert(1);"><span><?= $info['email'] ?></span>
                            </li>
                            <li><img src="../assets/user/images/all-icon/map.png" alt="icon"
                                     style="filter: brightness(0) invert(1);">
                                <span><?= $info['address'] ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="header-social text-lg-right text-center">
                        <ul>
                            <li><a href="https://facebook.com/<?= $info['facebook'] ?>"><i class="fa fa-facebook-f"></i></a>
                            </li>
                            <li><a href="https://twitter.com/<?= $info['twitter'] ?>"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="https://instagram.com/<?= $info['instagram'] ?>"><i
                                            class="fa fa-instagram"></i></a>
                            </li>
                            <li><a href="https://youtube.com/<?= $info['youtube'] ?>"><i class="fa fa-youtube-play"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- header top -->

    <div class="navigation navigation-2">
        <div class="container">
            <div class="no-gutters">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="?halaman=beranda">
                        <img src="../assets/img/<?= $info['logo'] ?>" alt="Logo" width="100">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a href="?halaman=beranda">Beranda</a>
                            </li>
                            <!--                                <li class="nav-item">-->
                            <!--                                    <a href="about.html">Pelatihan</a>-->
                            <!--                                </li>-->
                            <li class="nav-item">
                                <a href="?halaman=artikel">Artikel</a>
                            </li>
                            <li class="nav-item">
                                <a href="?halaman=pengumuman">Pengumuman</a>
                            </li>
                            <li class="nav-item">
                                <a href="?halaman=kontak">Kontak</a>
                            </li>

                            <?php if (isset($_SESSION['login_user'])) { ?>
                                <li class="nav-item">
                                    <a href="?halaman=akun-saya">Akun Saya</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#logout" data-toggle="modal" data-target="#modalLogout" onclick="
                        $('#modalLogout #linkLogout').attr('href', '?logout_user');
                        $('#modalLogout #modalLogoutLabel').text('Apakah anda yakin?');
                        $('#modalLogout #bodyLogout #logoutTitle').text('Anda ingin keluar?');">
                                        Keluar
                                    </a>
                                </li>
                            <?php } else { ?>
                                <li class="nav-item">
                                    <a href="?halaman=daftar-akun">Daftar Akun</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </nav> <!-- nav -->
            </div>
        </div> <!-- row -->
    </div>
</header>