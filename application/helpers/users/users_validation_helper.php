<?php
if (!function_exists('validationUser')) {
	function validationUser()
	{
		return array(
			array(
				'field' => 'name',
				'label' => 'Nombre',
				'rules' => 'required',
				'errors' => array(
					'required' => 'El campo nombre es requerido'
				)
			)
		);
	}
}
