<?php

class Admin_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function m_login($user,$pass)
	{
		$this->db->where('usernm',$user);
		$this->db->where('pass',$pass);
		$query = $this->db->get('userlog',1);
		return $query->num_rows();
	}

	public function tambah_debet()
	{
	$now = date('Y-m-d H:i:s');
		$data = [
					'id_debet' => $this->input->post('id_debet'),	
					'ket' => $this->input->post('ket'),
					'tgl_debet' => $now,
					'jml' => $this->input->post('jml')
				];

		$this->db->insert('debet', $data);
	}

	public function tambah_kredit()
	{
	$now = date('Y-m-d H:i:s');
		$data = [
					'id_kredit' => $this->input->post('id_kredit'),	
					'ket' => $this->input->post('ket'),
					'tgl_kredit' => $now,
					'jml' => $this->input->post('jml')
				];

		$this->db->insert('kredit', $data);
	}



	public function get_datadebet()
	{
		$query = $this->db->get('debet');
		return $query->result();
	}

	public function get_datakredit()
	{
		$query = $this->db->get('kredit');
		return $query->result();
	}

	public function hapus_debet($id)
	{
		$this->db->delete('debet', ['id_debet' => $id]);
	}

	public function hapus_kredit($id)
	{
		$this->db->delete('kredit', ['id_kredit' => $id]);
	}

	public function select_debet($id)
	{
		$query = $this->db->get_where('debet', ['id_debet' => $id]);
		return $query->row();
	}

	public function select_kredit($id)
	{
		$query = $this->db->get_where('kredit', ['id_kredit' => $id]);
		return $query->row();
	}

	public function update_debet()
	{
		$now = date('Y-m-d H:i:s');
		$kondisi = ['id_kredit' => $this->input->post('id_kredit')];
	
		$data = [
					'id_kredit' => $this->input->post('id_kredit'),	
					'ket' => $this->input->post('ket'),
					'tgl_kredit' => $now,
					'jml' => $this->input->post('jml')
				];

		$this->db->update('kredit', $data, $kondisi);
	}

}

?>