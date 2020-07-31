<?php
if (!function_exists('validationUser')) {
	function validationUser()
	{
		return array(
			array(
				'field' => 'name',
				'label' => 'Nombre(s)',
				'rules' => 'required|min_length[1]|max_length[255]',
			),
			array(
				'field' => 'first_name',
				'label' => 'Primer apellido',
				'rules' => 'required|min_length[1]|max_length[255]',
			),
			array(
				'field' => 'last_name',
				'label' => 'Segundo apellido',
				'rules' => 'required|min_length[1]|max_length[255]',
				),
			array(
				'field' => 'user',
				'label' => 'Usuario',
				'rules' => 'required',
			),
			array(
				'field' => 'password',
				'label' => 'Contraseña',
				'rules' => 'required|min_length[8]|max_length[255]',
			),
			array(
				'field' => 'departments',
				'label' => 'Departamento',
				'rules' => 'required',
			),
			array(
				'field' => 'role',
				'label' => 'Función del usuario',
				'rules' => 'required|min_length[1]|max_length[255]',
			),
			array(
				'field' => 'levels',
				'label' => 'Nivel de usuario',
				'rules' => 'required',
			)
		);
	}
}
