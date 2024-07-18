<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gejala extends CI_Controller
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
            'title' => "Daftar Gejala",
            'kode_gejala_auto' => $this->gejala_model->kode_gejala_auto(),
            'gejala' => $this->gejala_model->get_gejala(),
        );

        $this->load->view('admin/gejala', $data);
    }

    public function tambah()
    {
        $kode_gejala = $this->input->post('kode_gejala');
        $nama_gejala = $this->input->post('nama_gejala');

        $data = [
            'kode_gejala' => $kode_gejala,
            'nama_gejala' => $nama_gejala,
        ];

        $this->gejala_model->tambah($data);
    }

    public function edit()
    {
        $id_gejala         = $this->input->post('id_gejala');
        $kode_gejala       = $this->input->post('kode_gejala');
        $nama_gejala       = $this->input->post('nama_gejala');

        $data = [
            'kode_gejala' => $kode_gejala,
            'nama_gejala' => $nama_gejala,
        ];

        $this->gejala_model->edit($data, $id_gejala);
    }

    public function hapus($id_gejala)
    {
        $this->gejala_model->hapus($id_gejala);
    }
}
