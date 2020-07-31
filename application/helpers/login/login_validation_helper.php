<?php
if (!function_exists('loginValidation')) {
	function loginValidation()
	{
		return array(
			array(
				'field' => 'user',
				'label' => 'Usuario',
				'rules' => 'required|min_length[1]|max_length[255]',
			),
			array(
				'field' => 'password',
				'label' => 'Contraseña',
				'rules' => 'required|min_length[8]|max_length[255]',
			)
		);
	}
}
