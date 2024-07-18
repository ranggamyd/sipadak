<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
  public function index()
  {
    $data = array(
      'title' => "Masuk",
    );

    $this->load->view('auth/login', $data);
  }

  public function login()
  {
    $this->form_validation->set_rules('credential', 'Kredensial', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() == FALSE) {
      // $this->session->set_flashdata('gagal', 'Gagal Masuk !');
      $this->index();
    } else {
      if ($this->auth_model->login()) {
        if ($this->session->userdata('referred_from')) {
          $referred_from = $this->session->userdata('referred_from');
          $this->session->set_flashdata('sukses', 'Berhasil Masuk !');
          redirect($referred_from);
        } else {
          $this->session->set_flashdata('sukses', 'Berhasil Masuk !');
          redirect('dashboard');
        }
      } else {
        $this->session->set_flashdata('gagal', 'Pastikan Username dan Password Anda sesuai !');
        $this->index();
      }
    }
  }

  public function logout()
  {
    $this->auth_model->logout();
    $this->session->set_flashdata('sukses', 'Berhasil Keluar !');
    redirect('home');
  }
}
