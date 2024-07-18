<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('_partials/header');
?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title ?></h1>
        </div>

        <div class="card shadow-sm mb-3">
            <div class="card-header">

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped diagnosa" id="dataTable">
                        <thead class="text-center">
                            <th>No</th>
                            <th>Pengguna</th>
                            <th>Tgl Diagnosa</th>
                            <th>Penyakit</th>
                            <th>Nilai</th>
                            <th><i class="fas fa-cogs"></i></th>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($hasil as $item) {
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= $item['nama']; ?></td>
                                    <td><?= $item['tanggal']; ?></td>
                                    <td><?= $item['nama_penyakit']; ?></td>
                                    <td class="text-center">
                                        <span class="badge badge-light"><?= $item['hasil_nilai'] * 100; ?>%</span> -
                                        <span class="badge badge-dark"><?= round($item['hasil_nilai'], 3); ?></span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Opsi">
                                            <a href="<?= base_url('laporan/detail/' . $item['id_hasil']) ?>" class="btn btn-sm btn-success shadow-sm" data-toggle="tooltip" data-placement="right" title="Lihat detail"><i class="fa fa-fw fa-eye"></i></a>
                                            <?php if ($this->session->userdata('id_admin') == 1) : ?>
                                                <a href="<?= base_url('laporan/hapus/' . $item['id_hasil']) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus hasil ?')" class="btn btn-sm btn-danger shadow-sm" data-toggle="tooltip" data-placement="right" title="Hapus hasil"><i class="fas fa-trash-alt"></i></a>
                                            <?php endif ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('_partials/footer'); ?>