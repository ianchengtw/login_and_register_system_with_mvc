<?php

class Home extends Controller
{
	public function index()
	{
		global $USER;
		$username = $USER->isLoggedIn() ? $USER->data()->username : '';

		$data = array(	'home'=> '',
						'isLoggedIn' => $USER->isLoggedIn(),
						'username' => $username);

		if (Session::exists('home')) {
			$data['home'] = Session::flash('home');
		}

		$this->view('home', $data);
	}
}