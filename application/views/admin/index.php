<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('_partials/header');
?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Penyakit</h4>
                        </div>
                        <div class="card-body">
                            <?= $this->db->count_all('penyakit') ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-temperature-high"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Gejala</h4>
                        </div>
                        <div class="card-body">
                            <?= $this->db->count_all('gejala') ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Riwayat</h4>
                        </div>
                        <div class="card-body">
                            <?= $this->db->count_all('hasil') ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Administrator</h4>
                        </div>
                        <div class="card-body">
                            <?= $this->db->count_all('admin') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('_partials/footer'); ?>