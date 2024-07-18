<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('_partials/header');
?>

<!-- Begin Page Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title ?></h1>
        </div>

        <div class="card shadow-sm">
            <div class="card-header">
                <a href="#" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambah_penyakit"><i class=" fas fa-plus-circle mr-2"></i>Tambah data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataTable">
                        <thead class="text-center">
                            <th>#</th>
                            <th>Kode Penyakit</th>
                            <th>Nama Penyakit</th>
                            <th>Solusi</th>
                            <th><i class="fas fa-cogs"></i></th>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($penyakit as $item) : ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= $item['kode_penyakit']; ?></span></td>
                                    <td><?= $item['nama_penyakit']; ?></span></td>
                                    <td><?= $item['solusi']; ?></span></td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Opsi">
                                            <a href="#" class="btn btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#edit_penyakit<?= $item['id_penyakit'] ?>" data-toggle="tooltip" data-placement="right" title="Edit penyakit"><i class="fa fa-fw fa-edit"></i></a>
                                            <a href="<?= base_url('penyakit/hapus/' . $item['id_penyakit']) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus penyakit ?')" class="btn btn-sm btn-danger shadow-sm" data-toggle="tooltip" data-placement="right" title="Hapus penyakit"><i class="fas fa-trash-alt"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal tambah penyakit -->
    <div class="modal fade" id="tambah_penyakit" tabindex="-1" role="dialog" aria-labelledby="tambah_penyakitLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambah_penyakitLabel">Tambah penyakit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('penyakit/tambah') ?>" method="post">
                        <label for="kode_penyakit">Kode penyakit :</label>
                        <input type="text" class="form-control mb-3" id="kode_penyakit" name="kode_penyakit" value="<?= $kode_penyakit_auto ?>" readonly required>
                        <label for="nama_penyakit">Nama penyakit :</label>
                        <input type="text" class="form-control mb-3" id="nama_penyakit" name="nama_penyakit" required>
                        <label for="solusi">Solusi :</label>
                        <textarea name="solusi" id="solusi" cols="12" rows="5" class="form-control"></textarea>
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

    <!-- Modal edit penyakit -->
    <?php foreach ($penyakit as $item) { ?>
        <div class="modal fade" id="edit_penyakit<?= $item['id_penyakit'] ?>" tabindex="-1" role="dialog" aria-labelledby="edit_penyakitLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit_penyakitLabel">Edit penyakit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('penyakit/edit') ?>" method="post">
                            <label for="kode_penyakit">Kode penyakit :</label>
                            <input type="hidden" class="form-control mb-3" id="id_penyakit" name="id_penyakit" value="<?= $item['id_penyakit'] ?>" required readonly>
                            <input type="text" class="form-control mb-3" id="kode_penyakit" name="kode_penyakit" value="<?= $item['kode_penyakit'] ?>" required readonly>
                            <label for="nama_penyakit">Nama penyakit :</label>
                            <input type="text" class="form-control mb-3" id="nama_penyakit" name="nama_penyakit" value="<?= $item['nama_penyakit'] ?>" required>
                            <label for="solusi">Solusi :</label>
                            <textarea name="solusi" id="solusi" cols="12" rows="5" class="form-control"><?= $item['solusi'] ?></textarea>
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