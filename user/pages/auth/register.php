<section id="contact-page" class="pt-30 pb-50 gray-bg">
    <div class="container">
        <form method="post" action="?halaman=action-auth" data-toggle="validator">
            <div class="row">

                <?php
                if (isset($_SESSION['success_msg'])) {
                    echo $_SESSION['success_msg'];
                    unset($_SESSION['success_msg']);
                }
                ?>

                <div class="col-lg-6">
                    <div class="contact-from mt-20">
                        <div class="section-title">
                            <h5>Daftar Akun</h5>
                            <h2>Data Diri</h2>
                        </div> <!-- section title -->
                        <div class="main-form pt-20">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="singel-form form-group">
                                        <input name="name" type="text" placeholder="Nama Lengkap"
                                               data-error="Nama Lengkap harus di isi." required="required">
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- singel form -->
                                </div>
                                <div class="col-md-6">
                                    <div class="singel-form form-group">
                                        <input name="birth_of_date" type="date" placeholder="Tanggal Lahir"
                                               data-error="Tanggal Lahir harus di isi." required="required">
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- singel form -->
                                </div>
                                <div class="col-md-6">
                                    <div class="singel-form form-group d-inline-block">
                                        <select name="gender"
                                                data-error="Jenis Kelamin harus di isi."
                                                required="required">
                                            <option value="">-- Jenis Kelamin --</option>
                                            <option value="Male">Laki-Laki</option>
                                            <option value="Female">Perempuan</option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- singel form -->
                                </div>
                                <div class="col-md-6">
                                    <div class="singel-form form-group">
                                        <input name="handphone" type="text" placeholder="Telepon"
                                               data-error="Telepon harus di isi." required="required">
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- singel form -->
                                </div>
                                <div class="col-md-6">
                                    <div class="singel-form form-group">
                                        <input name="city" type="text" placeholder="Kota"
                                               data-error="Kota harus di isi." required="required">
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- singel form -->
                                </div>
                                <div class="col-md-12">
                                    <div class="singel-form form-group">
                                        <textarea name="address" placeholder="Alamat"
                                                  data-error="Alamat harus di isi."
                                                  required="required"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- singel form -->
                                </div>
                                <div class="col-md-6">
                                    <div class="singel-form form-group">
                                        <select name="categories" id=""
                                                data-error="Kategori Pengguna harus di isi."
                                                required="required">
                                            <option value="">-- Kategori Pengguna --</option>
                                            <option value="PNS">PNS</option>
                                            <option value="PPPK">PPPK</option>
                                            <option value="PLKB/PKB">PLKB/PKB</option>
                                            <option value="Non PNS">Non PNS</option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- singel form -->
                                </div>
                                <div class="col-md-6">
                                    <div class="singel-form form-group">
                                        <input name="nip" type="text" placeholder="NIP">
                                    </div> <!-- singel form -->
                                </div>
                            </div> <!-- row -->
                        </div> <!-- main form -->
                    </div> <!--  contact from -->
                </div>

                <div class="col-lg-6">
                    <div class="contact-from mt-20">
                        <div class="section-title">
                            <h5>Daftar Akun</h5>
                            <h2>Informasi Akun</h2>
                        </div> <!-- section title -->
                        <div class="main-form pt-20">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="singel-form form-group">
                                        <input name="username" type="text" placeholder="Nama Pengguna"
                                               data-error="Nama Pengguna harus di isi." required="required">
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- singel form -->
                                </div>
                                <div class="col-md-12">
                                    <div class="singel-form form-group">
                                        <input name="email" type="email" placeholder="Alamat Email"
                                               data-error="Alamat email harus di isi dengan benar." required="required">
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- singel form -->
                                </div>
                                <div class="col-md-12">
                                    <div class="singel-form form-group">
                                        <input name="password" type="password" placeholder="Kata Sandi"
                                               data-error="Kata Sandi harus di isi." required="required">
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- singel form -->
                                </div>
                                <div class="col-md-12">
                                    <div class="singel-form">
                                        <button type="submit" name="register" class="main-btn">Daftar Akun</button>
                                    </div> <!-- singel form -->
                                </div>
                            </div> <!-- row -->
                        </div> <!-- main form -->
                    </div> <!--  contact from -->
                </div>
            </div> <!-- row -->
        </form>
    </div> <!-- container -->
</section>