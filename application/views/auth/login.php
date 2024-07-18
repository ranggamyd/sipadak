<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('_partials/header');
?>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <img src="<?= base_url(); ?>assets/fe/assets/images/logo_light.png" alt="logo" width="200" class="shadow-light">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Masuk untuk melanjutkan!</h4>
                            </div>

                            <div class="card-body">
                                <form action="<?= base_url('auth/login') ?>" method="POST">
                                    <div class="form-group">
                                        <label for="credential">Username</label>
                                        <input id="credential" type="credential" value="<?= set_value('credential') ?>" class="form-control <?= form_error('credential') ? 'is-invalid' : '' ?>" name="credential" required autofocus>
                                        <div class="invalid-feedback">
                                            <?= form_error('credential') ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="control-label">Password</label>
                                        <input id="password" type="password" class="form-control" name="password" required>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Masuk
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="simple-footer">
                            &copy; Copyright <strong><span>SIPADAK</span></strong>. All Rights Reserved
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php $this->load->view('_partials/js'); ?>