<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InicioController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("UsuariosModel");
		$this->load->library(array('form_validation','email','pagination', 'session'));
	}

	public function index()
	{
		if (!is_logged_in()) {
			redirect('InicioController/login');
		}else{
			$this->load->view('templates/header');
			$this->load->view('login/bienvenido');
			$this->load->view('templates/footer');
		}
	}

	public function login(){
		$this->load->view('login/login');
	}
}
