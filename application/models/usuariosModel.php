<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsuariosModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function save($data)
	{
		$this->db->insert('users', $data);
	}

	public function getUsers()
	{
		$sql = $this->db->get('users');
		return $sql->result();
	}

	public function ver()
	{
		$consulta = $this->db->query("SELECT u.id, u.name, u.first_name, u.last_name, d.name as departamento, u.role FROM users u INNER JOIN departments d ON (u.DEPARTMENTS_id = d.id);");
		return $consulta->result();
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('users');
	}

	public function login($nombre, $password)
	{
		$query = $this->db->get_where('users', array('user' => $nombre));
		if ($query->num_rows() == 1) {
			$row = $query->row();
			if (password_verify($password, $row->password)) {
				$data = array('user_data' => array(
					'user' => $row->user,
					'name' => $row->name . " " . $row->first_name . " " . $row->last_name,
					'levels_id' => $row-> LEVELS_id,
					'id' => $row->id
				)
				);
				$this->session->set_userdata($data);
				return true;

			}
		}
		$this->session->unset_userdata('user_data');
		return false;
	}

	public function getUser($id)
	{
		$consulta = $this->db->query("SELECT * FROM users WHERE id = $id");
		return $consulta->result();
	}

	public function edit($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('users', $data);
	}

}

?>
