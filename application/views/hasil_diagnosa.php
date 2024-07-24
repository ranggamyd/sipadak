<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="<?= base_url() ?>assets/fe/assets/images/logo_only_dark.png" type="image/x-icon" />

    <title>SIPADAK</title>

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url() ?>assets/fe/vendor//bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/fe/assets/css/fontawesome.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/fe/assets/css/templatemo-digimedia-v2.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/fe/assets/css/animated.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/fe/assets/css/owl.css" />
</head>

<body>
    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area d-print-none header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="<?= base_url() ?>" class="logo">
                            <img src="<?= base_url() ?>assets/fe/assets/images/logo_light.png" alt="" height="35" />
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <!-- <li class="scroll-to-section"><a href="#top" class="active">Home</a></li> -->
                            <!-- <li class="scroll-to-section"><a href="#about">About</a></li>
              <li class="scroll-to-section"><a href="#services">Services</a></li>
              <li class="scroll-to-section"><a href="#portfolio">Projects</a></li>
              <li class="scroll-to-section"><a href="#blog">Blog</a></li>
              <li class="scroll-to-section"><a href="#contact">Contact</a></li>  -->
                            <li>
                                <div class="border-first-button">
                                    <a href="<?= base_url() ?>auth/login">Login</a>
                                </div>
                            </li>
                        </ul>
                        <a class="menu-trigger">
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->
    <div class="contact-us mb-5 section wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                        <!-- <h6>Hasil Diagnosa</h6> -->
                        <h4>Hasil Diagnosa</h4>
                        <div class="line-dec"></div>
                    </div>
                </div>
                <div class="col-lg-12 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.25s">
                    <div class="row">
                        <div class="col-lg-12 d-print-none">
                            <div class="contact-dec">
                                <img src="<?= base_url() ?>assets/fe/assets/images/contact-dec.png" alt="">
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="card shadow-sm mb-3">
                                <div class="card-header">
                                    <h4 class="mb-0 text-gray-800">Data Pengguna</h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <?php foreach ($pasien as $item) { ?>
                                            <tr>
                                                <th>Nama:</th>
                                                <td><?= $item['nama'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Umur:</th>
                                                <td><?= $item['umur'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>No. HP:</th>
                                                <td><?= $item['no_hp'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Jenis Hewan:</th>
                                                <td><?= $item['jenis_hewan'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Alamat:</th>
                                                <td><?= $item['alamat'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Diagnosa:</th>
                                                <td><?= date('H:i - d-m-Y', strtotime($tanggal)) ?></td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="card shadow-sm mb-3">
                                <div class="card-header">
                                    <h4 class="mb-0 text-gray-800">Gejala yang di alami Pengguna</h4>
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
                                            echo '<td><span class="hasil text text-danger">' . $r4['nama_gejala'] . "</span></td>";
                                            echo '<td><span class="kondisipilih">' . $arkondisitext[$kondisi] . "</span></td></tr>";
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card shadow-sm mb-3 text-center">
                                <div class="card-header bg-danger">
                                    <h4 class="mb-0 text-white">Hasil Diagnosa</h4>
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
                                            <h4 class="text text-danger">
                                                <?php
                                                if ($arpkt[$idpkt1[1]] == NULL) {
                                                    echo 0;
                                                } else {
                                                    echo $arpkt[$idpkt1[1]];
                                                }
                                                ?>

                                        </b> / <?php echo $vlpkt1[1] * 100; ?> % (<?php echo round($vlpkt1[1], 3); ?>)<br></h4>
                                    <?php if ($key++ > 0) break;
                                    } ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
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
                        <div class="col-6">
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

                    <div class="row d-print-none">
                        <div class="col d-flex justify-content-center gap-3">
                            <a href="#" id="print" onClick="window.print();" class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Klik tombol ini untuk mencetak hasil diagnosa">Cetak Hasil</a>
                            <a href="<?= base_url() ?>home" class="btn btn-success">Kembali ke Halaman Utama</a>
                            <a href="<?= base_url() ?>home/diagnosa" class="btn btn-secondary">Diagnosa Ulang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class=" container">
            <div class="row">
                <div class="col-lg-12">
                    <p>
                        Copyright © 2024 SIPADAK. All Rights Reserved.
                        <!-- <br>Design: <a href="https://templatemo.com" target="_parent" title="free css templates">TemplateMo</a></p> -->
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="<?= base_url() ?>assets/fe/vendor//jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/fe/vendor//bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/fe/assets/js/owl-carousel.js"></script>
    <script src="<?= base_url() ?>assets/fe/assets/js/animation.js"></script>
    <script src="<?= base_url() ?>assets/fe/assets/js/imagesloaded.js"></script>
    <script src="<?= base_url() ?>assets/fe/assets/js/custom.js"></script>
</body>

</html>