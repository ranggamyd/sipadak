<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('_partials/header');
?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title ?></h1>
        </div>

        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Laporan Hasil Diagnosa</h1>
                <a target="_blank" href="<?= base_url('laporan/cetak_detail/' . $id) ?>" id="print" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="tooltip" data-placement="right" title="Klik tombol ini untuk mencetak hasil diagnosa"><i class="fas fa-print fa-sm text-white-50"></i> Print</a>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="card shadow-sm mb-3">
                        <div class="card-header">
                            <h4 class="mb-0 text-gray-800">Data Pengguna</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <tr>
                                    <th>Nama:</th>
                                    <td><?= $pasien['nama'] ?></td>
                                </tr>
                                <!-- <tr>
                            <th>Jenis Kelamin:</th>
                            <td><?= $pasien['jenis_kelamin'] ?></td>
                        </tr> -->
                                <tr>
                                    <th>Umur:</th>
                                    <td><?= $pasien['umur'] ?></td>
                                </tr>
                                <tr>
                                    <th>No. HP:</th>
                                    <td><?= $pasien['no_hp'] ?></td>
                                </tr>
                                <tr>
                                    <th>Jenis Hewan:</th>
                                    <td><?= $item['jenis_hewwan'] ?></td>
                                </tr>
                                <tr>
                                    <th>Alamat:</th>
                                    <td><?= $pasien['alamat'] ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Diagnosa:</th>
                                    <td><?= $pasien['tanggal'] ?></td>
                                </tr>
                            </table>

                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card shadow-sm mb-3">
                        <div class="card-header">
                            <h4 class="mb-0 text-gray-800">Gejala yang di alami pasien</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped diagnosa">
                                <tr>
                                    <th width="8%">No</th>
                                    <th width="10%">Kode</th>
                                    <th>Gejala yang dialami (keluhan)</th>
                                    <th width="20%">Pilihan</th>
                                </tr>
                                <?php
                                $ig = 0;
                                foreach ($argejala as $key => $value) {
                                    $kondisi = $value;
                                    $ig++;
                                    $gejala = $key;
                                    $r4 = $this->db->where('id_gejala', $key)->get('gejala')->row_array();
                                    echo '<tr><td>' . $ig . '</td>';
                                    echo '<td>' . str_pad($r4['kode_gejala'], 3, '0', STR_PAD_LEFT) . '</td>';
                                    echo '<td><span class="hasil text text-primary">' . $r4['nama_gejala'] . "</span></td>";
                                    echo '<td><span class="kondisipilih">' . $arkondisitext[$kondisi] . "</span></td></tr>";
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-top-primary shadow-sm mb-3 text-center">
                <div class="card-header">
                    <h4 class="mb-0 text-gray-800">Hasil Diagnosa</h4>
                </div>
                <div class="card-body">
                    <h5>Jenis penyakit yang disebabkan oleh gejala tersebut adalah : </h5>
                    <?php
                    $key = 0;
                    foreach ($arpenyakit as $key => $value) {
                        $idpkt1[1] = $key;
                        $vlpkt1[1] = $value;
                    ?>
                        <b>
                            <h4 class="text text-primary"><?php echo $arpkt[$idpkt1[1]]; ?>
                        </b> / <?php echo $vlpkt1[1] * 100; ?> % (<?php echo round($vlpkt1[1], 3); ?>)<br></h4>
                    <?php if ($key++ > 0) break;
                    } ?>

                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card shadow-sm mb-3">
                        <div class="card-header">
                            <h4 class="mb-0 text-gray-800">Solusi</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            $key = 0;
                            foreach ($arpenyakit as $key => $value) {
                                $idpkt1[1] = $key;
                            ?>
                                <h4><?php echo nl2br($arspkt[$idpkt1[1]]); ?></h4>

                            <?php if ($key++ > 1) break;
                            } ?>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm mb-3">
                        <div class="card-header">
                            <h4 class="mb-0 text-gray-800">Kemungkinan lain</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            $i = 0;
                            foreach ($arpenyakit as $key => $value) {
                                // var_dump($i);
                                if ($i++ > 0) {
                                    $idpkt[1] = $key;
                                    $vlpkt[1] = $value;

                            ?>
                                    <b>
                                        <h4 class="text text-info"> -
                                            <?php
                                            if ($arpkt[$idpkt[1]] == NULL) {
                                                echo 0;
                                            } else {
                                                echo $arpkt[$idpkt[1]];
                                            }
                                            ?>

                                    </b> / <?php echo $vlpkt[1] * 100; ?> % (<?php echo round($vlpkt[1], 3); ?>)<br></h4>
                            <?php if ($i++ > 5) break;
                                }
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('_partials/footer'); ?>