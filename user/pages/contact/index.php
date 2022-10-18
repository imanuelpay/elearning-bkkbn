<!--====== CONTACT PART START ======-->

<section id="contact-page" class="pt-30 pb-50 gray-bg">
    <div class="container">
        <div class="row">
            <?php
            if (isset($_SESSION['success_msg'])) {
                echo $_SESSION['success_msg'];
                unset($_SESSION['success_msg']);
            }
            ?>
            
            <div class="col-lg-8">
                <div class="contact-from">
                    <div class="section-title">
                        <h5>Kontak Kami</h5>
                        <h2>Kritik dan Saran</h2>
                    </div> <!-- section title -->
                    <div class="main-form pt-10">
                        <form action="?halaman=action-kontak" method="post" data-toggle="validator">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="singel-form form-group">
                                        <input name="name" type="text" placeholder="Nama anda"
                                               value="<?= isset($userLogin) ? $userLogin['name'] : '' ?>"
                                               data-error="Name is required." required="required">
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- singel form -->
                                </div>
                                <div class="col-md-6">
                                    <div class="singel-form form-group">
                                        <input name="email" type="email" placeholder="Email"
                                               value="<?= isset($userLogin) ? $userLogin['email'] : '' ?>"
                                               data-error="Valid email is required." required="required">
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- singel form -->
                                </div>
                                <div class="col-md-12">
                                    <div class="singel-form form-group">
                                        <input name="subject" type="text" placeholder="Judul"
                                               data-error="Subject is required." required="required">
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- singel form -->
                                </div>
                                <div class="col-md-12">
                                    <div class="singel-form form-group">
                                        <textarea name="message" placeholder="Pesan dan Kesan"
                                                  data-error="Please,leave us a message."
                                                  required="required"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- singel form -->
                                </div>
                                <p class="form-message"></p>
                                <div class="col-md-12">
                                    <div class="singel-form">
                                        <button type="submit" name="send" class="main-btn">Kirim</button>
                                    </div> <!-- singel form -->
                                </div>
                            </div> <!-- row -->
                        </form>
                    </div> <!-- main form -->
                </div> <!--  contact from -->
            </div>
            <div class="col-lg-4">
                <div class="contact-address">
                    <div class="contact-heading">
                        <h5>Alamat</h5>
                        <p>Jika Anda memiliki pertanyaan lebih lanjut, jangan ragu untuk menghubungi kami.</p>
                    </div>
                    <ul>
                        <li>
                            <div class="singel-address">
                                <div class="icon">
                                    <i class="fa fa-home"></i>
                                </div>
                                <div class="cont">
                                    <p><?= $info['address'] ?></p>
                                </div>
                            </div> <!-- singel address -->
                        </li>
                        <li>
                            <div class="singel-address">
                                <div class="icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="cont">
                                    <p><?= $info['phone'] ?></p>
                                </div>
                            </div> <!-- singel address -->
                        </li>
                        <li>
                            <div class="singel-address">
                                <div class="icon">
                                    <i class="fa fa-envelope-o"></i>
                                </div>
                                <div class="cont">
                                    <p><?= $info['email'] ?></p>
                                </div>
                            </div> <!-- singel address -->
                        </li>
                    </ul>
                </div> <!-- contact address -->

            </div>
        </div> <!-- row -->
    </div> <!-- container -->

</section>

<!--====== CONTACT PART ENDS ======-->