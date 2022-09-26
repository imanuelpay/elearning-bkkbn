<section id="contact-page" class="pt-30 pb-50 gray-bg">
    <div class="container">
        <?php
        if (isset($_SESSION['success_msg'])) {
            echo $_SESSION['success_msg'];
            unset($_SESSION['success_msg']);
        } else {
            ?>

            <div class="contact-address mt-30">
                <ul>
                    <li>
                        <div class="singel-address">
                            <div class="icon">
                                <i class="fa fa-times text-danger"></i>
                            </div>
                            <div class="cont">
                                <p> Token verifikasi invalid, silahkan kembali ke beranda dengan mengklik tombol di
                                    bawah.</p>
                                <p><a href="<?= base_url . '/user' ?>" class="main-btn mt-2">Kembali ke Beranda</a></p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

        <?php } ?>
    </div>
</section>
