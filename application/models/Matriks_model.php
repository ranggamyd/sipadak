<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Matriks_model extends CI_Model
{
    public function get_nilai()
    {
        return $this->db->get('nilai')->result_array();
    }
    public function get_nilai1()
    {
        return $this->db->get('nilai');
    }

    public function get_data()
    {
        $this->db->select('*');
        $this->db->from('analisa_krit');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return "Impossible";
        }
    }
    public function clearTB($id_penyakit)
    {
        $this->db->where('id_penyakit', $id_penyakit);
        $this->db->empty_table('analisa_krit');
    }
    public function insertArray($data)
    {
        $this->db->insert('analisa_krit', $data);
        return $this->db->insert_id();
    }

    public function updateRule($where, $data)
    {
        $this->db->update('rule', $data, $where);
        return $this->db->affected_rows();
    }
}
