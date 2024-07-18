<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rule extends CI_Controller
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
        $data['title'] = 'Rule Penyakit';
        $data['rule'] = $this->rule_model->get_rule();
        $data['penyakit'] = $this->penyakit_model->get_penyakit();
        $data['gejala'] = $this->gejala_model->get_gejala();
        
        $this->load->view('admin/rule', $data);
    }

    public function tambah()
    {
        $id_penyakit = $this->input->post('id_penyakit');
        $id_gejala = $this->input->post('id_gejala');

        $existingData = $this->rule_model->getDataByPenyakitGejala($id_penyakit, $id_gejala);
        if (!$existingData) {
            $data = [
                'id_penyakit' => $id_penyakit,
                'id_gejala' => $id_gejala,
            ];

            $this->rule_model->tambah($data);

            $this->session->set_flashdata('sukses', 'Berhasil menambah rule !');
            redirect('rule');
        } else {
            $this->session->set_flashdata('gagal', 'Data Sudah Ada !');
            redirect('rule');
        }
    }

    public function edit()
    {
        $id_rule        = $this->input->post('id_rule');
        $id_penyakit    = $this->input->post('id_penyakit');
        $id_gejala      = $this->input->post('id_gejala');

        $existingData = $this->rule_model->getDataByPenyakitGejala($id_penyakit, $id_gejala);
        if (!$existingData) {
            $data = [
                'id_penyakit' => $id_penyakit,
                'id_gejala' => $id_gejala,
            ];

            $this->rule_model->edit($data, $id_rule);

            $this->session->set_flashdata('sukses', 'Berhasil menambah rule !');
            redirect('rule');
        } else {
            $this->session->set_flashdata('gagal', 'Data Sudah Ada !');
            redirect('rule');
        }
    }

    public function hapus($id_rule)
    {
        $this->rule_model->hapus($id_rule);
    }
}
