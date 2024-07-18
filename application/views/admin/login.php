<div class="container">
    <div class="row">
        <div class="col-12 col-md-10 offset-md-1">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block justify-content-end align-self-center">
                            <a class="mt-5" href="<?= base_url('landing_page') ?>"><img src="<?= base_url('assets') ?>/img/gratisography-duck-doctor-free-stock-photo.jpg" class="rounded" style="width: 100%; height: 100%; object-fit: cover; margin-left: 30px" alt=""></a>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center w-100">
                            <div class="p-5 flex-grow-1">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-1">Selamat Datang !</h1>
                                    <h1 class="h6 text-gray-900 mb-4">Sistem Pakar Diagnosa Penyakit Pada ITIK Menggunakan Metode AHP -CF</h1>
                                </div>
                                <form action="<?= base_url('auth/login') ?>" method="POST" class="user">
                                    <div class="form-group">
                                        <input type="text" name="credential" value="<?= set_value('credential') ?>" class="form-control form-control-user <?= form_error('credential') ? 'is-invalid' : '' ?>" id="credential" placeholder="Masukkan Nama / Username" required>
                                        <div id="credential" class="invalid-feedback">
                                            <?= form_error('credential') ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user <?= form_error('password') ? 'is-invalid' : '' ?>" id="password" placeholder="Masukkan Password" required>
                                        <div id="password" class="invalid-feedback">
                                            <?= form_error('password') ?>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-user btn-block">Masuk</button>
                                    <!-- <hr>
                                    <div class="text-center">
                                        <small><a href="<?= base_url('auth/forgot_password') ?>">Lupa Kata Sandi</a></small>
                                    </div> -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>