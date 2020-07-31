<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsuariosController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UsuariosModel');
		$this->load->library(array('form_validation', 'email', 'pagination', 'session'));
		$this->load->helper(array('form', 'url', 'users/update_validation', 'login/login_validation'));

	}

	public function index()
	{

	}

	public function nuevo()
	{
		$this->load->view('templates/header');
		$this->load->view('usuarios/crear');
		$success = $this->session->flashdata("success");
		$this->load->view('templates/footer', array('success' => $success));

	}

	public function inicio()
	{
		$this->load->view('login/login');
		$error = $this->session->flashdata("error");
		$this->load->view('templates/footer', array('error' => $error));

	}

	public function listar()
	{
		$this->load->view('templates/header');
		$data = array('usuarios' => $this->UsuariosModel->ver());
		$this->load->view('usuarios/listar', $data);
		$this->load->view('templates/footer');
	}

	public function insertar()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'user' => $this->input->post('user'),
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'role' => $this->input->post('role'),
			'create_time' => date('Y-m-d H:i:s'),
			'departments_id' => $this->input->post('departments'),
			'levels_id' => $this->input->post('levels')
		);

		$this->form_validation->set_rules(validationUser());

		if ($this->form_validation->run() == FALSE) {
			$this->nuevo();
		} else {
			if (empty($data)) {
				$this->output->set_status_header(400);
			} else {
				$this->UsuariosModel->save($data);
				$this->session->set_flashdata("success", true);
				redirect('UsuariosController/nuevo');
			}
		}
	}

	public function delete()
	{
		$idUsuario = $this->input->post('id', true);
		if (empty($idUsuario)) {
			$this->output
				->set_status_header(400)
				->set_output(json_encode(array('msg' => 'El id no puede estar vacío')));
		} else {
			$this->UsuariosModel->delete($idUsuario);
			$this->output
				->set_status_header(200);
		}
	}

	public function verifica()
	{
		$user = $this->input->post('user');
		$password = $this->input->post('password');

		$this->form_validation->set_rules(loginValidation());

		if ($this->form_validation->run() == FALSE) {
			$this->inicio();
		} else {
			if ($this->UsuariosModel->login($user, $password))
				redirect('InicioController');
			else {
				$this->session->set_flashdata("error", true);
				$this->inicio();
			}
		}

	}

	public function logout()
	{
		$this->session->unset_userdata('user_data');
		$this->session->sess_destroy();
		redirect('/login');
	}

	public function update($id = 0)
	{
		$this->load->view('templates/header');
		$user = array('usuario' => $this->UsuariosModel->getUser($id)[0]);
		$this->load->view('usuarios/actualizar', $user);
		$this->load->view('templates/footer');


	}

	public function edit()
	{
		$id2 = $this->input->post('id2');
		$data = array(
			'name' => $this->input->post('name'),
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'user' => $this->input->post('user'),
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'role' => $this->input->post('role'),
			'create_time' => date('Y-m-d H:i:s'),
			'departments_id' => $this->input->post('departments'),
			'levels_id' => $this->input->post('levels')
		);

		$this->form_validation->set_rules(updateValidationUser());

		if ($this->form_validation->run() == FALSE) {
			$this->update($id2);
		} else {
			if (empty($data)) {
				$this->output->set_status_header(400);
			} else {
				$this->UsuariosModel->edit($id2, $data);
				redirect('UsuariosController/listar');


			}
		}


	}

}

