<?php
class Member extends Controller
{
	public function index() {}
	public function login() {

		if (Input::exists()) {

			if (Token::check(Input::get('token'))){

				$validate = new Validate();
				$validation = $validate->check($_POST, array(
					'username' => array('required' => true),
					'password' => array('required' => true)
				));

				if ($validation->passed()) {
					global $USER;
					$USER = new User();
					$remember = (Input::get('remember') === 'on') ? true : false;
					$login = $USER->login(	Input::get('username'),
											Input::get('password'),
											$remember);
					if ($login) {
						Redirect::to('/');
					} else {
						echo '<p>Sorry, logging in failed.</p>';
					}

				} else {
					foreach($validation->errors() as $error) {
						echo $error . "<br>";
					}
				}

			}
			
		}

		$this->view('member/login');

	}
	public function logout() {
		global $USER;
		$USER->logout();
		Redirect::to('/');
	}
	public function register() {

		if (Input::exists()) {

			if (Token::check(Input::get('token'))){

				$validate = new Validate();
				$validation = $validate->check($_POST, array(
					'username' => array(
						'required' => true,
						'min' => 4,
						'max' => 20,
						'unique' => 'users'
					),
					'password' => array(
						'required' => true,
						'min' => 4,
						'max' => 20
					),
					'password_again' => array(
						'required' => true,
						'matches' => 'password'
					),
					'name' => array(
						'min' => 4,
						'max' => 64
					)
				));

				if ($validation->passed()) {
					global $USER;
					$USER = new User();
					$salt = Hash::salt(32);

					try {
						$USER->create(array(
							'username' => Input::get('username'),
							'password' => User::generate_password(Input::get('password'), $salt),
							'salt' => $salt,
							'name' => Input::get('name'),
							'joined' => date('Y-m-d H:i:s'),
							'group' => 1
						));

						Session::flash('home', 'You have been registered and can now log in!');
						Redirect::to('/');

					} catch (Exception $e) {
						$e->getMessage();
					}

				} else {
					foreach($validation->errors() as $error) {
						echo $error . "<br>";
					}
				}

			}

		}

		$this->view('member/register');

	}
	public function update() {}
	public function profile() {}
}