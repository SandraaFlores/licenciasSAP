<?php

function is_logged_in()
{
	$CI =& get_instance();
	$user = $CI->session->userdata('user_data');
	if (!isset($user))
		return false;
	else
		return true;
}

function getLevel()
{
	$CI =& get_instance();
	$user = $CI->session->userdata('user_data');
	if (empty($user))
		return null;
	else
		return $user["levels_id"]*1;
}

function getName()
{
	$CI =& get_instance();
	$user = $CI->session->userdata('user_data');
	if (!isset($user))
		return null;
	else
	return $user["name"];
}

function getId()
{
	$CI =& get_instance();
	$user = $CI->session->userdata('user_data');
	if (!isset($user))
		return null;
	else
		return $user["id"];
}
