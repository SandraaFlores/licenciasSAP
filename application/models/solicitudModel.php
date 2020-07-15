<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SolicitudModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();

	}

	public function save($data)
	{
		$this->db->insert('requests', $data);
	}

	public function ver($user_id, $page, $cantidad_pagina)
	{
		if ($page == 0) {
			$offset = 0;
		} else {
			$offset = $page * $cantidad_pagina;
		}

		$consulta = $this->db->query("SELECT r.id, u.name, u.first_name, u.last_name, r.create_time, r.status 
										FROM requests r, approvals a, users  u
										WHERE NOT (r.id IN (SELECT a2.REQUESTS_id FROM approvals a2 WHERE  a2.USERS_id = $user_id)) 
										AND r.USERS_id = u.id 
										AND r.status = 0 
										GROUP BY r.id LIMIT " . $cantidad_pagina . " OFFSET " . $offset . ";");
		return $consulta->result();
	}

	public function showCancel($user_id, $page, $cantidad_pagina)
	{
		if ($page == 0) {
			$offset = 0;
		} else {
			$offset = $page * $cantidad_pagina;
		}

		$consulta = $this->db->query("SELECT r.id, u.name, u.first_name, u.last_name, r.create_time , r.status FROM requests r, users  u
										WHERE   r.USERS_id = u.id AND r.status = 2 LIMIT " . $cantidad_pagina . " OFFSET " . $offset . ";");
		return $consulta->result();
	}

	public function showAccepted($user_id, $page, $cantidad_pagina)
	{
		if ($page == 0) {
			$offset = 0;
		} else {
			$offset = $page * $cantidad_pagina;
		}

		$consulta = $this->db->query("SELECT r.id, u.name, u.first_name, u.last_name, r.create_time , r.status FROM requests r, users  u
										WHERE   r.USERS_id = u.id AND r.status = 1 LIMIT " . $cantidad_pagina . " OFFSET " . $offset . ";");
		return $consulta->result();
	}

	public function getUser($id)
	{
		$consulta = $this->db->query("SELECT * FROM requests WHERE id = $id ");
		return $consulta->result();

	}

	public function getApprovals($solicitudId)
	{

		$consulta = $this->db->query("SELECT u.name, u.first_name, u.last_name
										FROM approvals a, users  u
										WHERE  ($solicitudId = a.REQUESTS_id ) 
										AND a.USERS_id = u.id  
										GROUP BY u.LEVELS_id;");
		return $consulta->result();
	}

	public function count_requests($user_id, $type = 0)
	{
		switch ($type) {
			case 0:
				$consulta = $this->db->query("SELECT r.id FROM requests r, approvals a, users  u
										WHERE NOT (r.id IN (SELECT a2.REQUESTS_id FROM approvals a2 WHERE  a2.USERS_id = $user_id)) 
										AND r.USERS_id = u.id 
										AND r.status = 0 
										GROUP BY r.id");
				break;
			case 1:
				$consulta = $this->db->query("SELECT r.id FROM requests r, users  u
										WHERE r.USERS_id = u.id AND r.status = 1 GROUP BY r.id;");
				break;
			case 2:
				$consulta = $this->db->query("SELECT r.id FROM requests r, users  u
										WHERE  r.USERS_id = u.id AND r.status = 2 GROUP BY r.id;");

				break;
		}

		return sizeof($consulta->result());
	}


	public function aprobarSolicitud($data)
	{
		$this->db->insert('approvals', $data);
	}

	public function aprobarSolicitudTodos($solicitudId)
	{
		$this->db->where('id', $solicitudId);
		$this->db->set('status', 1);
		return $this->db->update('requests');
	}

	public function rechazarSolicitud($solicitudId)
	{
		$this->db->where('id', $solicitudId);
		$this->db->set('status', 2);
		return $this->db->update('requests');
	}


}


