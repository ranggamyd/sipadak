<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function get_admin()
    {
        return $this->db->get('admin')->result_array();
    }

    public function tambah($data)
    {
        if ($this->db->insert('admin', $data)) {
            $this->session->set_flashdata('sukses', 'Berhasil menambah Admin !');
            redirect('admin');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal menambah Admin !');
            redirect('admin');
        }
    }

    public function edit($data, $id_admin)
    {
        if ($this->db->update('admin', $data, ['id_admin' => $id_admin])) {
            $this->session->set_flashdata('sukses', 'Berhasil mengubah Admin !');
            redirect('admin');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal mengubah Admin !');
            redirect('admin');
        }
    }

    public function hapus($id_admin)
    {
        if ($this->db->delete('admin', ['id_admin' => $id_admin])) {
            $this->session->set_flashdata('sukses', 'Berhasil Menghapus Admin !');
            redirect('admin');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal Menghapus Admin !');
            redirect('admin');
        }
    }
}
