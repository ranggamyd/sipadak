<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
    public function get_hasil()
    {
        $this->db->join('penyakit', 'penyakit.id_penyakit=hasil.hasil_id');
        $this->db->join('pasien', 'pasien.id_pasien=hasil.id_pasien');
        $this->db->order_by('id_hasil', 'DESC');
        return $this->db->get('hasil')->result_array();
    }

    public function hapus($id_hasil)
    {
        if ($this->db->delete('hasil', ['id_hasil' => $id_hasil])) {
            $this->session->set_flashdata('sukses', 'Berhasil Menghapus hasil !');
            redirect('laporan');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal Menghapus hasil !');
            redirect('laporan');
        }
    }

    public function getHasilById($id)
    {
        $this->db->where('id_hasil', $id);
        $query = $this->db->get('hasil');
        return $query->row_array();
    }
    public function getPasienById($id)
    {
        $this->db->join('pasien', 'pasien.id_pasien=hasil.id_pasien');
        $this->db->where('id_hasil', $id);
        $query = $this->db->get('hasil');
        return $query->row_array();
    }

    public function getKondisiText()
    {
        $query = $this->db->get('kondisi');
        $kondisiText = array();
        foreach ($query->result_array() as $row) {
            $kondisiText[$row['id_kondisi']] = $row['nama_kondisi'];
        }
        return $kondisiText;
    }

    public function getPenyakit()
    {
        $query = $this->db->get('penyakit');
        $arpkt = array();
        foreach ($query->result_array() as $row) {
            $arpkt[$row['id_penyakit']] = $row['nama_penyakit'];
        }
        return $arpkt;
    }
    public function getPenyakit2()
    {
        $query = $this->db->get('penyakit');
        $arspkt = array();
        foreach ($query->result_array() as $row) {
            $arspkt[$row['id_penyakit']] = $row['solusi'];
        }
        return $arspkt;
    }
}
