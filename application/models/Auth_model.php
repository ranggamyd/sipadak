<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
	public function login()
	{
		$credential = $this->input->post('credential');
		$password = $this->input->post('password');

		$this->db->where('admin.nama', $credential)->or_where('admin.username', $credential);
		$admin = $this->db->get('admin')->row();

		if (!$admin) return FALSE;
		if ($password != $admin->password) return FALSE;

		$this->session->set_userdata(['id_admin' => $admin->id_admin]);
		$this->session->set_userdata(['status' => 'login']);

		if ($this->session->has_userdata('id_admin')) return TRUE;
	}

	public function logout()
	{
		$this->session->sess_destroy();
	}

	public function update_pass($data, $email)
	{
		if ($this->db->update('admin', $data, ['email' => $email])) {
			$this->session->set_flashdata('sukses', 'Berhasil mengubah Password !');
			redirect('auth');
		} else {
			$this->session->set_flashdata('gagal', 'Gagal mengubah Password !');
			redirect('auth');
		}
	}

	public function isEmailExist($email)
	{
		$query = $this->db->get_where('admin', array('email' => $email));
		return ($query->num_rows() > 0);
	}

	public function checkValueExist($value)
	{
		$query = $this->db->get_where('admin', array('email' => $value));
		return $query->num_rows() > 0;
	}
}
