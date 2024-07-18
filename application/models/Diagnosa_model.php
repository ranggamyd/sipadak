<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Diagnosa_model extends CI_Model
{
    public function get_kondisi()
    {
        return $this->db->get('kondisi')->result_array();
    }
    public function get_bobot_kondisi()
    {
        $this->db->select('nilai');
        return $this->db->get('kondisi')->result_array();
    }
    public function get_where_rule($idpenyakit)
    {
        $this->db->join('gejala', 'gejala.id_gejala = rule.id_gejala', 'left');
        $this->db->join('penyakit', 'penyakit.id_penyakit = rule.id_penyakit', 'left');
        $this->db->where('rule.id_penyakit', $idpenyakit);
        return $this->db->get('rule')->result_array();
    }
    public function get_penyakit()
    {
        $this->db->order_by('id_penyakit');
        return $this->db->get('penyakit');
    }
    public function get_pasien_where($id_pasien1)
    {
        $this->db->where('id_pasien', $id_pasien1);
        return $this->db->get('pasien')->result_array();
    }
    public function get_rule_where($id_penyakit)
    {
        $this->db->where('id_penyakit', $id_penyakit);
        return $this->db->get('rule')->result_array();
    }

    public function get_hasil()
    {
        return $this->db->get('hasil')->result_array();
    }

    public function getGejala()
    {
        $query = $this->db->get('gejala');
        return $query->result_array();
    }

    public function getKondisi()
    {
        $query = $this->db->get('kondisi');
        return $query->result_array();
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

    public function simpanHasil($data)
    {
        $this->db->insert('hasil', $data);
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
