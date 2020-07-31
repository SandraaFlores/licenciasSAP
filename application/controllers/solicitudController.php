<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SolicitudController extends CI_Controller
{
	const PAGES =3;
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'requests/requests_validation'));
		$this->load->model("SolicitudModel");
		$this->load->library(array('form_validation', 'email', 'pagination', 'session'));


	}

	public function index()
	{

	}

	public function cargarVistas()
	{
		$this->load->view('templates/header');
		$this->load->view('solicitud/crear');
		$success = $this->session->flashdata("success");
		$this->load->view('templates/footer', array('success' => $success));
	}

	public function correo()
	{
		$this->load->view('solicitud/correo');
	}


	public function insertar($id = null)
	{
		$data = array(
			'create_time' => date('Y-m-d H:i:s'),
			'justification' => $this->input->post('justification'),
			'observation' => $this->input->post('observation'),
			'status' => 0,
			'user_copy' => $this->input->post('user_copy'),
			'authorization' => $this->input->post('authorizations'),
			'users_id' => intval(getId()),
			'types_of_users_id' => $this->input->post('types_of_user'),
			'systems_id' => $this->input->post('system'),
		);

		$this->form_validation->set_rules(validationRequests());

		if ($this->form_validation->run() == FALSE) {
			$this->cargarVistas();
		} else {
			if (empty($data)) {
				$this->output->set_status_header(400);
			} else {
				$this->SolicitudModel->save($data);
				$this->session->set_flashdata("success", true);
				$this->sendEmail();
				redirect('SolicitudController/cargarVistas');
			}
		}
	}

	public function getConfigPaginator($user_id, $registros_pagina, $url, $total_rows)
	{
		$config ['base_url'] = $url;
		$config ['total_rows'] = $total_rows;
		$config ['per_page'] = $registros_pagina;
		$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
		$config['full_tag_close'] = '</ul></nav></div>';
		$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close'] = '</span></li>';
		$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close'] = '</span></li>';
		$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close'] = '</span></li>';

		return $config;
	}

	public function listar($pagina_actual = 0)
	{
		$user_id = $this->session->userdata('user_data')['id'];
		$registros_pagina = self::PAGES;
		$data = array('solicitudes' => $this->SolicitudModel->ver($user_id, ($pagina_actual * 1), $registros_pagina),
						"title" => "Lista de solicitudes pendientes");


		$config = $this->getConfigPaginator($user_id, $registros_pagina, base_url('solicitudes/list'), $this->SolicitudModel->count_requests($user_id));
		$this->pagination->initialize($config);

		$this->load->view('templates/header');

		foreach ($data['solicitudes'] as  $solicitud) {
			$solicitud->approvals = $this->SolicitudModel->getApprovals($solicitud->id);
		}

		$this->load->view('solicitud/listar', $data);
		$this->load->view('templates/footer');
	}

	public function listCancel($pagina_actual = 0)
	{
		$user_id = $this->session->userdata('user_data')['id'];
		$registros_pagina = self::PAGES;
		$data = array('solicitudes' => $this->SolicitudModel->showCancel($user_id, ($pagina_actual * 1), $registros_pagina), "title" => "Lista de solicitudes canceladas");


		$config = $this->getConfigPaginator($user_id, $registros_pagina, base_url('solicitudes/list/cancel'), $this->SolicitudModel->count_requests($user_id, 2));
		$this->pagination->initialize($config);

		$this->load->view('templates/header');
		foreach ($data['solicitudes'] as $solicitud) {
			$solicitud->approvals = $this->SolicitudModel->getApprovals($solicitud->id);
		}
		$this->load->view('solicitud/listar', $data);
		$this->load->view('templates/footer');
	}

	public function listAccepted($pagina_actual = 0)
	{
		$user_id = $this->session->userdata('user_data')['id'];
		$registros_pagina = self::PAGES;
		$data = array('solicitudes' => $this->SolicitudModel->showAccepted($user_id, ($pagina_actual * 1), $registros_pagina), "title" => "Lista de solicitudes aceptadas");


		$config = $this->getConfigPaginator($user_id, $registros_pagina, base_url('solicitudes/list/accepted'), $this->SolicitudModel->count_requests($user_id, 1));
		$this->pagination->initialize($config);

		$this->load->view('templates/header');
		foreach ($data['solicitudes'] as $solicitud) {
			$solicitud->approvals = $this->SolicitudModel->getApprovals($solicitud->id);
		}
		$this->load->view('solicitud/listar', $data);
		$this->load->view('templates/footer');
	}

	public function accept($solicitudId)
	{
		$data = array('users_id' => $this->session->userdata('user_data')['id'], 'requests_id' => $solicitudId);
		$this->SolicitudModel->aprobarSolicitud($data);
		$approvals = $this->SolicitudModel->getApprovals($solicitudId);
		echo sizeof($approvals);
		if(sizeof($approvals) >= 3){
			$this->SolicitudModel->aprobarSolicitudTodos($solicitudId);
		}
	}

	public function cancel($solicitudId)
	{
		$data = array('users_id' => $this->session->userdata('user_data')['id'], 'requests_id' => $solicitudId);
		$this->SolicitudModel->rechazarSolicitud($solicitudId);
	}


	public function show($id = 0)
	{
		$data = array('vista' => $this->SolicitudModel->getUser($id)[0]);
		$this->load->view('solicitud/show', $data);
	}

	public function sendEmail()
	{
		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.googlemail.com',
			'smtp_user' => 'sandraa.flores.c@gmail.com',
			'smtp_pass' => 'Ellie8181',
			'smtp_port' => 587,
			'smtp_crypto' => 'tls',
			'mailtype' => 'html',
			'wordwrap' => TRUE,
			'charset' => 'utf-8'
		);
		$this->load->library('email');
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
		$this->email->from('sandraa.flores.c@gmail.com', 'Sandra Flores');
		$this->email->subject('Email Test');
		$vista = $this->load->view('solicitud/correo', '', true);
		$this->email->message($vista);
		$this->email->to('san.florees@gmail.com');
		$this->email->cc('leojfl999@gmail.com');

		if ($this->email->send()) {
			echo "enviado<br/>";
			echo $this->email->print_debugger(array('headers'));
		} else {
			echo "fallo <br/>";
			echo "error: " . $this->email->print_debugger(array('headers'));
		}
	}
}

