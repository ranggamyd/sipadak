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
  <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
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
            <h6>Mulai Diagnosa</h6>
            <h4>Silahkan isi formulir berikut.</h4>
            <div class="line-dec"></div>
          </div>
        </div>
        <div class="col-lg-10 offset-lg-1 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.25s">
          <form id="contact" action="<?= base_url('home/diagnosa') ?>" method="post">
            <input type="hidden" class="form-control main-form mb-3" id="id_pasien" value="<?= $idpasien ?>" name="id_pasien" readonly>
            <input type="hidden" class="form-control main-form" name="tgl_diagnosa" id="tgl_diagnosa" value="<?php
                                                                                                              date_default_timezone_set('Asia/Jakarta');
                                                                                                              echo date('Y-m-d H:i:s');
                                                                                                              ?>">
            <div class="row">
              <div class="col-lg-12">
                <div class="contact-dec">
                  <img src="<?= base_url() ?>assets/fe/assets/images/contact-dec.png" alt="">
                </div>
              </div>
              <div class="col-lg-12">
                <div class="fill-form">
                  <h6>
                    Silahkan isi data diri Anda.
                  </h6>
                  <div class="row">
                    <div class="col-lg-6">
                      <fieldset>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap" autocomplete="on" required>
                      </fieldset>
                      <fieldset>
                        <input type="text" class="form-control" name="umur" id="umur" placeholder="Umur" required>
                      </fieldset>
                      <fieldset>
                        <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No. HP" required>
                      </fieldset>
                    </div>
                    <div class="col-lg-6">
                      <fieldset>
                        <textarea name="alamat" type="text" class="form-control" id="alamat" placeholder="Alamat"></textarea>
                      </fieldset>
                    </div>
                  </div>
                  <div class="row mt-5">
                    <div class="col">
                      <h6>
                        Pilih kondisi sesuai dengan gejala-gejala yang dialami hewan.
                      </h6>
                      <div class="table-responsive mt-5">
                        <table class="table table-hover">
                          <tbody>
                            <?php
                            $no = 1;
                            foreach ($gejala as $item) : ?>
                              <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td style="text-align: left;">Apakah <?= $item['nama_gejala'] ?>?</td>
                                <td>
                                  <select name="kondisi[]" id="kondisi[]" class="form-control select-item">
                                    <option value="0" readonly>-- PILIH --</option>
                                    <?php foreach ($kondisi as $k) : ?>
                                      <option value="<?= $item['id_gejala'] . '_' . $k['id_kondisi']; ?>"><?= $k['nama_kondisi']; ?></option>
                                    <?php endforeach ?>
                                  </select>
                                </td>
                              </tr>
                            <?php endforeach ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <fieldset>
                        <button type="submit" id="form-submit" class="main-button">Mulai Diagnosa</button>
                      </fieldset>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <footer>
    <div class="container">
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

  <script>
    var form = document.getElementById('contact');
    var selectDropdowns = form.getElementsByClassName('select-item');

    form.addEventListener('submit', function(event) {
      let allZero = true;

      Array.from(selectDropdowns).forEach(function(selectDropdown) {
        if (selectDropdown.value !== '0') {
          allZero = false;
        }
      });

      if (allZero) {
        event.preventDefault();
        alert('Harap memilih salah satu gejala');
      } else {
        form.submit();
      }
    });
  </script>
</body>

</html>