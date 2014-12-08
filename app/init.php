<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

session_start();

spl_autoload_register(function($class){
	require_once 'core/' . $class . '.php';
});

require_once 'configs/globals.php';
require_once 'helpers/sanitize.php';

// Remember Me
if (Cookie::exists(Config::get('remember/cookie_name')) &&
	!Session::exists(Config::get('session/session_name')))
{
	$hash = Cookie::get(Config::get('remember/cookie_name'));
	$hashCheck = DB::getInstance()->get('users_session', array('hash', '=', $hash));

	if ($hashCheck) {
		$USER = new User($hashCheck->first()->user_id);
		$USER->login();
	} else {
		$USER = new User();	
	}
} else {
	$USER = new User();
}