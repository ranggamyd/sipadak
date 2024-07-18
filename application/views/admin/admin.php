<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('_partials/header');
?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title ?></h1>
        </div>

        <div class="card shadow-sm">
            <div class="card-header">
                <?php if ($this->session->userdata('id_admin') == 1) : ?>
                    <a href="#" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambah_admin"><i class="fas fa-plus-circle mr-2"></i>Tambah data</a>
                <?php endif ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataTable">
                        <thead class="text-center">
                            <th>#</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>E-mail</th>
                            <th><i class="fas fa-cogs"></i></th>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($admin as $item) : ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= $item['nama']; ?></span></td>
                                    <td><?= $item['username'] ?></td>
                                    <td><?= $item['password'] ?></td>
                                    <td><?= $item['email'] ?></td>
                                    <td class="text-center">
                                        <?php if ($this->session->userdata('id_admin') == 1) : ?>
                                            <?php if ($item['id_admin'] != 1) : ?>
                                                <div class="btn-group" role="group" aria-label="Opsi">
                                                    <a href="#" class="btn btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#edit_admin<?= $item['id_admin'] ?>" data-toggle="tooltip" data-placement="right" title="Edit Admin"><i class="fa fa-fw fa-edit"></i></a>
                                                    <a href="<?= base_url('admin/hapus/' . $item['id_admin']) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus Admin ?')" class="btn btn-sm btn-danger shadow-sm" data-toggle="tooltip" data-placement="right" title="Hapus Admin"><i class="fas fa-trash-alt"></i></a>
                                                </div>
                                            <?php endif ?>
                                        <?php endif ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal tambah admin -->
    <div class="modal fade" id="tambah_admin" tabindex="-1" role="dialog" aria-labelledby="tambah_adminLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambah_adminLabel">Tambah Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('admin/tambah') ?>" method="post">
                        <label for="nama">Nama :</label>
                        <input type="text" class="form-control mb-3" id="nama" name="nama" required>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="username">Username :</label>
                                <input type="text" class="form-control mb-3" id="username" name="username" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="password">Password :</label>
                                <div class="input-group mb-3" id="show_hide_password">
                                    <input type="password" class="form-control" aria-label="password" aria-describedby="basic-addon1" id="password" name="password" required>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <a href=""><i class="fa fa-eye-slash text-dark" aria-hidden="true"></i></a>
                                        </span>
                                    </div>
                                </div>
                                <!-- <div class="input-group" id="show_hide_password">
                                        <div class="input-group-addon">
                                            <input class="form-control" type="password" id="password" name="password" required>
                                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                        </div>
                                    </div> -->
                                <!-- <input type="text" class="form-control mb-3" id="password" name="password" required> -->
                            </div>
                        </div>
                        <label for="email">Email :</label>
                        <input type="email" class="form-control mb-3" id="email" name="email" required>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-outline-secondary"><i class="fas fa-undo mr-1"></i>
                        Reset</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal edit admin -->
    <?php foreach ($admin as $item) { ?>
        <div class="modal fade" id="edit_admin<?= $item['id_admin'] ?>" tabindex="-1" role="dialog" aria-labelledby="edit_adminLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit_adminLabel">Edit Admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('admin/edit') ?>" method="post">
                            <label for="nama">Nama :</label>
                            <input type="hidden" class="form-control mb-3" id="id_admin" name="id_admin" value="<?= $item['id_admin'] ?>" required>
                            <input type="text" class="form-control mb-3" id="nama" name="nama" value="<?= set_value('nama', $item['nama']) ?>" required>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="username">Username :</label>
                                    <input type="text" class="form-control mb-3" id="username" name="username" value="<?= set_value('username', $item['username']) ?>" required>
                                </div>
                                <div class="col-sm-6">
                                    <label for="password">Password :</label>
                                    <div class="input-group mb-3" id="show_hide_password">
                                        <input type="password" class="form-control" aria-label="password" aria-describedby="basic-addon1" id="password" name="password" value="<?= set_value('password', $item['password']) ?>" required>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <a href=""><i class="fa fa-eye-slash text-dark" aria-hidden="true"></i></a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <label for="email">Email :</label>
                            <input type="text" class="form-control mb-3" id="email" name="email" value="<?= set_value('email', $item['email']) ?>" required>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-outline-secondary"><i class="fas fa-undo mr-1"></i>
                            Reset</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<?php $this->load->view('_partials/footer'); ?>