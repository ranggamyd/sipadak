<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rule_model extends CI_Model
{
    public function get_rule()
    {
        $this->db->join('penyakit', 'penyakit.id_penyakit = rule.id_penyakit', 'left');
        $this->db->join('gejala', 'gejala.id_gejala = rule.id_gejala', 'left');
        return $this->db->get('rule')->result_array();
    }
    public function get_rule_where($id_penyakit)
    {
        $this->db->join('penyakit', 'penyakit.id_penyakit = rule.id_penyakit', 'left');
        $this->db->join('gejala', 'gejala.id_gejala = rule.id_gejala', 'left');
        $this->db->where('rule.id_penyakit', $id_penyakit);
        $this->db->order_by('id_gejala', 'DESC');
        $this->db->limit(1);
        return $this->db->get('rule')->result_array();
    }

    public function getDataByPenyakitGejala($id_penyakit, $id_gejala)
    {
        $this->db->where('id_penyakit', $id_penyakit);
        $this->db->where('id_gejala', $id_gejala);
        $query = $this->db->get('rule');
        return $query->row();
    }

    public function tambah($data)
    {
        $this->db->insert('rule', $data);
    }

    public function edit($data, $id_rule)
    {
        $this->db->update('rule', $data, ['id_rule' => $id_rule]);
    }

    public function hapus($id_rule)
    {
        if ($this->db->delete('rule', ['id_rule' => $id_rule])) {
            $this->session->set_flashdata('sukses', 'Berhasil Menghapus rule !');
            redirect('rule');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal Menghapus rule !');
            redirect('rule');
        }
    }
}
