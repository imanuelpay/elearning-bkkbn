<footer id="footer-part">
    <div class="footer-top pt-10 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-about mt-40">
                        <div class="logo">
                            <a href="?halaman=beranda"><img src="../assets/img/<?= $info['logo'] ?>" alt="Logo"
                                                            style="filter: brightness(0) invert(1);"></a>
                        </div>
                        <p><?= $info['description'] ?></p>
                        <ul class="mt-20">
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
                    </div> <!-- footer about -->
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="footer-link mt-40">
                        <div class="footer-title pb-25">
                            <h6>Sitemap</h6>
                        </div>
                        <ul>
                            <li><a href="?halaman=beranda"><i class="fa fa-angle-right"></i>Beranda</a></li>
                            <li><a href="?halaman=kontak"><i class="fa fa-angle-right"></i>Kontak</a></li>
                        </ul>
                        <ul>
                            <li><a href="?halaman=artikel"><i class="fa fa-angle-right"></i>Artikel</a></li>
                            <li><a href="?halaman=pengumuman"><i class="fa fa-angle-right"></i>Pengumuman</a></li>
                        </ul>
                    </div> <!-- footer link -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="footer-address mt-40">
                        <div class="footer-title pb-25">
                            <h6>Kontak Kami</h6>
                        </div>
                        <ul>
                            <li>
                                <div class="icon">
                                    <i class="fa fa-home"></i>
                                </div>
                                <div class="cont">
                                    <p><?= $info['address'] ?></p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="cont">
                                    <p><?= $info['phone'] ?></p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <i class="fa fa-envelope-o"></i>
                                </div>
                                <div class="cont">
                                    <p><?= $info['email'] ?></p>
                                </div>
                            </li>
                        </ul>
                    </div> <!-- footer address -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- footer top -->

    <div class="footer-copyright pt-10 pb-25">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="copyright text-md-left text-center pt-15">
                        <p>Copyright &copy; <?= date('Y') ?>. By Imanuel Pay</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="copyright text-md-right text-center pt-15">

                    </div>
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- footer copyright -->
</footer>