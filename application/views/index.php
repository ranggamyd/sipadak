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

  <div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-6 align-self-center">
              <div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">
                <div class="row">
                  <div class="col-lg-12">
                    <h6>Sistem Pakar Diagnosa Penyakit</h6>
                    <h2>Domba & Kambing</h2>
                    <p>
                      This template is brought to you by TemplateMo website.
                      Feel free to use this for a commercial purpose. You are
                      not allowed to redistribute the template ZIP file on any
                      other template website. Thank you.
                    </p>
                  </div>
                  <div class="col-lg-12">
                    <div class="border-first-button scroll-to-section">
                      <a href="<?= base_url() ?>home/diagnosa">Mulai Diagnosa</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                <img src="<?= base_url() ?>assets/fe/assets/images/2.png" style="width: 500px" />
              </div>
            </div>
          </div>
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
</body>

</html>