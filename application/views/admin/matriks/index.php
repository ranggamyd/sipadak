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
                <h4>Analisa Kriteria(Gejala) Matriks AHP Berdasarkan Penyakit</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="dataTable">
                        <thead>
                            <th>#</th>
                            <th>Kode Penyakit</th>
                            <th>Nama Penyakit</th>
                            <th>Detail Gejala</th>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($penyakit as $item) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $item['kode_penyakit'] ?></td>
                                    <td><?= $item['nama_penyakit'] ?></td>
                                    <td><a href="<?= base_url('matriks/perbandingan/' . $item['id_penyakit']) ?>" class="btn btn-sm btn-outline-primary shadow-sm" data-toggle="tooltip" data-placement="right" title="Matriks perbandingan"><i class="fa fa-fw fa-eye mr-2"></i>Analisis Perbandingan Gejala</a></td>
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