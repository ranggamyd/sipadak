<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gejala_model extends CI_Model
{
    public function kode_gejala_auto()
    {
        $this->db->select('RIGHT(gejala.kode_gejala,2) as kode_gejala', FALSE);
        $this->db->order_by('kode_gejala', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('gejala');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kd = intval($data->kode_gejala) + 1;
        } else {
            $kd = 1;
        }
        $batas = str_pad($kd, 2, "0", STR_PAD_LEFT);
        $kodegejala = "G" . $batas;
        return $kodegejala;
    }

    public function get_gejala()
    {
        return $this->db->get('gejala')->result_array();
    }
    public function get_gejala1()
    {
        return $this->db->get('gejala');
    }
    public function readsatu($a)
    {
        $this->db->where('kode_gejala', $a);
        $this->db->limit(1);
        return $this->db->get('gejala')->result_array();
    }

    public function tambah($data)
    {
        if ($this->db->insert('gejala', $data)) {
            $this->session->set_flashdata('sukses', 'Berhasil menambah gejala !');
            redirect('gejala');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal menambah gejala !');
            redirect('gejala');
        }
    }

    public function edit($data, $id_gejala)
    {
        if ($this->db->update('gejala', $data, ['id_gejala' => $id_gejala])) {
            $this->session->set_flashdata('sukses', 'Berhasil mengubah gejala !');
            redirect('gejala');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal mengubah gejala !');
            redirect('gejala');
        }
    }

    public function hapus($id_gejala)
    {
        if ($this->db->delete('gejala', ['id_gejala' => $id_gejala])) {
            $this->session->set_flashdata('sukses', 'Berhasil Menghapus gejala !');
            redirect('gejala');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal Menghapus gejala !');
            redirect('gejala');
        }
    }
}
