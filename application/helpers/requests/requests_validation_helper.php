<?php
if (!function_exists('validationRequests')) {
	function validationRequests()
	{
		return array(
			array(
				'field' => 'justification',
				'label' => 'Justificación',
				'rules' => 'required|min_length[1]|max_length[500]',
			),
			array(
				'field' => 'observation',
				'label' => 'Observaciones generales',
				'rules' => 'max_length[500]',
			),
			array(
				'field' => 'user_copy',
				'label' => 'Copia del usuario',
				'rules' => 'max_length[255]',
			),
			array(
				'field' => 'authorizations',
				'label' => 'Autorizaciones requeridas',
				'rules' => 'max_length[500]',
			),
			array(
				'field' => 'types_of_user',
				'label' => 'Tipo de usuario',
				'rules' => 'required|multiple_select',
				'errors' => array(
					'multiple_select' => 'El campo %s es obligatorio.'
				),
			),
			array(
				'field' => 'system',
				'label' => 'Sistema',
				'rules' => 'required|multiple_select',
				'errors' => array(
					'multiple_select' => 'El campo %s es obligatorio.'
				),
			)
		);
	}
}
