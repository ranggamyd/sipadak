<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != 'login') {
            $this->session->set_userdata('referred_from', current_url());
            $this->session->set_flashdata('gagal', 'Gagal mengakses, Silahkan login kembali !');
            redirect('auth');
        }
    }

    public function index()
    {
        $data = array(
            'title' => "Daftar Admin",
            'admin' => $this->admin_model->get_admin()
        );

        $this->load->view('admin/admin', $data);
    }

    public function tambah()
    {
        $nama       = $this->input->post('nama');
        $username   = $this->input->post('username');
        $password   = $this->input->post('password');
        $email      = $this->input->post('email');

        $data = [
            'nama'      => $nama,
            'username'  => $username,
            'password'  => $password,
            'email'     => $email
        ];

        $this->admin_model->tambah($data);
    }

    public function edit()
    {
        $id_admin   = $this->input->post('id_admin');
        $nama       = $this->input->post('nama');
        $username   = $this->input->post('username');
        $password   = $this->input->post('password');
        $email      = $this->input->post('email');

        $data = [
            'nama'      => $nama,
            'username'  => $username,
            'password'  => $password,
            'email'     => $email
        ];

        $this->admin_model->edit($data, $id_admin);
    }

    public function hapus($id_admin)
    {
        $this->admin_model->hapus($id_admin);
    }
}
