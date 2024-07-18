<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyakit_model extends CI_Model
{
    public function kode_penyakit_auto()
    {
        $this->db->select('RIGHT(penyakit.kode_penyakit,2) as kode_penyakit', FALSE);
        $this->db->order_by('kode_penyakit', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('penyakit');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kd = intval($data->kode_penyakit) + 1;
        } else {
            $kd = 1;
        }
        $batas = str_pad($kd, 2, "0", STR_PAD_LEFT);
        $kodepenyakit = "P" . $batas;
        return $kodepenyakit;
    }

    public function get_penyakit()
    {
        return $this->db->get('penyakit')->result_array();
    }

    public function get_penyakit_where($id_penyakit)
    {
        $this->db->where('id_penyakit', $id_penyakit);
        return $this->db->get('penyakit')->result_array();
    }

    public function get_penyakit1()
    {
        $this->db->order_by('id_penyakit');
        return $this->db->get('penyakit')->result_array();
    }

    public function tambah($data)
    {
        if ($this->db->insert('penyakit', $data)) {
            $this->session->set_flashdata('sukses', 'Berhasil menambah data penyakit !');
            redirect('penyakit');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal menambah data penyakit !');
            redirect('penyakit');
        }
    }

    public function edit($data, $id_penyakit)
    {
        if ($this->db->update('penyakit', $data, ['id_penyakit' => $id_penyakit])) {
            $this->session->set_flashdata('sukses', 'Berhasil mengubah penyakit !');
            redirect('penyakit');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal mengubah penyakit !');
            redirect('penyakit');
        }
    }

    public function hapus($id_penyakit)
    {
        if ($this->db->delete('penyakit', ['id_penyakit' => $id_penyakit])) {
            $this->session->set_flashdata('sukses', 'Berhasil Menghapus penyakit !');
            redirect('penyakit');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal Menghapus penyakit !');
            redirect('penyakit');
        }
    }
}
