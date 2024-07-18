<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="<?= base_url(); ?>assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
              <?php
              $admin = $this->db->get_where('admin', ['admin.id_admin' => $this->session->userdata('id_admin')])->row()
              ?>
              <div class="d-sm-none d-lg-inline-block">Hi, <?= $admin ? strtok($admin->nama, ' ') : 'Anonymous' ?></div>
              <!-- <div class="d-sm-none d-lg-inline-block">Hi, User</div> -->
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="<?= base_url() ?>auth/logout" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>