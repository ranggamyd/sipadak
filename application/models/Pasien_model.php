<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien_model extends CI_Model
{
    public function get_id_pasien_baru()
    {
        $this->db->select('RIGHT(pasien.id_pasien,3) as id_pasien', FALSE);
        $this->db->order_by('id_pasien', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('pasien');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kd = intval($data->id_pasien) + 1;
        } else {
            $kd = 1;
        }
        return $kd;
    }

    public function get_pasien()
    {
        return $this->db->get('pasien')->result_array();
    }
    public function tambah($data)
    {
        if ($this->db->insert('pasien', $data)) {
            $this->session->set_flashdata('sukses', 'Registrasi Pasien Berhasil !');
            redirect('pasien');
        } else {
            $this->session->set_flashdata('gagal', 'Registrasi Pasien Gagal !');
            redirect('pasien/registrasi');
        }
    }
    public function tambah2($data)
    {
        $this->db->insert('pasien', $data);
    }
    public function tambah1($data)
    {
        if ($this->db->insert('pasien', $data)) {
            $this->session->set_flashdata('sukses', 'Berhasil Tambah Pasien !');
            redirect('pasien');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal Tambah Pasien !');
            redirect('pasien');
        }
    }
    public function edit($data, $id_pasien)
    {
        if ($this->db->update('pasien', $data, ['id_pasien' => $id_pasien])) {
            $this->session->set_flashdata('sukses', 'Berhasil mengubah data pasien !');
            redirect('pasien');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal mengubah data pasien !');
            redirect('pasien');
        }
    }

    public function hapus($id_pasien)
    {
        if ($this->db->delete('pasien', ['id_pasien' => $id_pasien])) {
            $this->session->set_flashdata('sukses', 'Berhasil Menghapus Pasien !');
            redirect('pasien');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal Menghapus Pasien !');
            redirect('pasien');
        }
    }

    public function cariNama($nama)
    {
        $query = $this->db->get_where('pasien', array('nama' => $nama));

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }
}
