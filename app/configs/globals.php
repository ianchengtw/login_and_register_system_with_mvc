<?php
$GLOBALS['config'] = array(
	'mysql' => array(
		'host' => 'localhost',
		'username' => 'ian',
		'password' => '1234',
		'db' => 'lrmvc'
	),
	'remember' => array(
		'cookie_name' => 'hash',
		'cookie_expiry' => 604800
	),
	'session' => array(
		'session_name' => 'user',
		'token_name' => 'token'
	),
	'page' =>array(
		'home' => '/',
		'login' => '/'
	)
);