<header id="header-part">

    <div class="header-top d-none d-md-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="header-contact text-lg-left text-center">
                        <ul>
                            <li><img src="../assets/user/images/all-icon/call.png"
                                     alt="icon"><span><?= $info['phone'] ?></span></li>
                            <li><img src="../assets/user/images/all-icon/email.png"
                                     alt="icon"><span><?= $info['email'] ?></span></li>
                            <li><img src="../assets/user/images/all-icon/map.png" alt="icon">
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
            <div class="row no-gutters">
                <div class="col-lg-11 col-md-11 col-sm-10 col-10">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="index-3.html">
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
                                    <a class="active" href="index-2.html">Beranda</a>
                                </li>
                                <li class="nav-item">
                                    <a href="about.html">Pelatihan</a>
                                </li>
                                <li class="nav-item">
                                    <a href="about.html">Artikel</a>
                                </li>
                                <li class="nav-item">
                                    <a href="about.html">Pengumuman</a>
                                </li>
                                <li class="nav-item">
                                    <a href="about.html">Kontak</a>
                                </li>
                                <li class="nav-item">
                                    <a href="about.html">Akun Saya</a>
                                </li>
                            </ul>
                        </div>
                    </nav> <!-- nav -->
                </div>
                <div class="col-lg-1 col-md-1 col-sm-2 col-2">
                    <div class="right-icon text-right">
                        <ul>
                            <li><a href="#"><i class="fa fa-md fa-user"></i></a></li>
                        </ul>
                    </div> <!-- right icon -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div>

</header>