<!--====== TEACHERS PART START ======-->

<section id="teachers-singel" class="pt-30 pb-50 gray-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="section-title mt-20 pb-10">
                    <h5>Akun</h5>

                    <h3>Akun Saya</h3>
                </div> <!-- section title -->
            </div>
        </div> <!-- row -->
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-8">
                <div class="teachers-left mt-20">
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
                        <span><?= isset($userLogin) ? $userLogin['email'] : '' ?></span>
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
                </div> <!-- teachers left -->
            </div>
            <div class="col-lg-8">
                <div class="teachers-right mt-20">
                    <ul class="nav nav-justified" id="myTab" role="tablist">
                        <!--                        <li class="nav-item">-->
                        <!--                            <a class="active" id="dashboard-tab" data-toggle="tab" href="#dashboard" role="tab"-->
                        <!--                               aria-controls="dashboard" aria-selected="true">Pelatihan</a>-->
                        <!--                        </li>-->
                        <li class="nav-item">
                            <a class="active" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                               aria-controls="profile"
                               aria-selected="false">Ubah Profil</a>
                        </li>
                        <li class="nav-item">
                            <a id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews"
                               aria-selected="false">Ubah Password</a>
                        </li>
                    </ul> <!-- nav -->
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="profile" role="tabpanel"
                             aria-labelledby="profile-tab">
                            <div class="reviews-cont">

                                <div class="title pt-15">
                                    <h6>Ubah Profil</h6>
                                </div>
                                <div class="reviews-form">
                                    <form action="#">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-singel">
                                                    <input type="text" placeholder="Fast name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-singel">
                                                    <input type="text" placeholder="Last Name">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-singel">
                                                    <textarea placeholder="Comment"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-singel">
                                                    <button type="button" class="main-btn">Post Comment</button>
                                                </div>
                                            </div>
                                        </div> <!-- row -->
                                    </form>
                                </div>
                            </div> <!-- dashboard cont -->
                        </div>

                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <div class="reviews-cont">

                                <div class="title pt-15">
                                    <h6>Leave A Comment</h6>
                                </div>
                                <div class="reviews-form">
                                    <form action="#">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-singel">
                                                    <input type="text" placeholder="Fast name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-singel">
                                                    <input type="text" placeholder="Last Name">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-singel">
                                                    <div class="rate-wrapper">
                                                        <div class="rate-label">Your Rating:</div>
                                                        <div class="rate">
                                                            <div class="rate-item"><i class="fa fa-star"
                                                                                      aria-hidden="true"></i></div>
                                                            <div class="rate-item"><i class="fa fa-star"
                                                                                      aria-hidden="true"></i></div>
                                                            <div class="rate-item"><i class="fa fa-star"
                                                                                      aria-hidden="true"></i></div>
                                                            <div class="rate-item"><i class="fa fa-star"
                                                                                      aria-hidden="true"></i></div>
                                                            <div class="rate-item"><i class="fa fa-star"
                                                                                      aria-hidden="true"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-singel">
                                                    <textarea placeholder="Comment"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-singel">
                                                    <button type="button" class="main-btn">Post Comment</button>
                                                </div>
                                            </div>
                                        </div> <!-- row -->
                                    </form>
                                </div>
                            </div> <!-- reviews cont -->
                        </div>
                    </div> <!-- tab content -->
                </div> <!-- teachers right -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</section>

<!--====== EVENTS PART ENDS ======-->