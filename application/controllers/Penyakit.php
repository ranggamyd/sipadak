<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyakit extends CI_Controller
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
        $data['title'] = 'Daftar Penyakit';
        $data['kode_penyakit_auto'] = $this->penyakit_model->kode_penyakit_auto();
        $data['penyakit'] = $this->penyakit_model->get_penyakit();

        $this->load->view('admin/penyakit', $data);
    }

    public function tambah()
    {
        $kode_penyakit  = $this->input->post('kode_penyakit');
        $nama_penyakit  = $this->input->post('nama_penyakit');
        $solusi         = $this->input->post('solusi');

        $data = [
            'kode_penyakit' => $kode_penyakit,
            'nama_penyakit' => $nama_penyakit,
            'solusi'        => $solusi,
        ];

        $this->penyakit_model->tambah($data);
    }

    public function edit()
    {
        $id_penyakit         = $this->input->post('id_penyakit');
        $kode_penyakit       = $this->input->post('kode_penyakit');
        $nama_penyakit       = $this->input->post('nama_penyakit');
        $solusi         = $this->input->post('solusi');

        $data = [
            'kode_penyakit' => $kode_penyakit,
            'nama_penyakit' => $nama_penyakit,
            'solusi'        => $solusi,
        ];

        $this->penyakit_model->edit($data, $id_penyakit);
    }

    public function hapus($id_penyakit)
    {
        $this->penyakit_model->hapus($id_penyakit);
    }
}
