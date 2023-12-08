<?php

namespace src\Controllers;

use core\Request;
use src\Repositories\UserRepository;

class LoginController extends Controller
{

	/**
	 * Show the login page.
	 * @return void
	 */
	public function index(): void
	{
		$this->render('login');
	}

	/**
	 * Process the login attempt.
	 * @param Request $request
	 * @return void
	 */
	public function login(Request $request): void
	{
		$email = htmlspecialchars($request->input('email'));
		$password = $request->input('password');
		$digest = password_hash($password, PASSWORD_BCRYPT, [ 'cost' => 12 ]);
		$user = (new UserRepository)->getUserByEmail($email);

		if ($user && password_verify($password, $user->__get('password_digest'))) {
			$this->setSessionData('user_id', $user->__get('id'));
			$this->redirect('/', true);
		} else {
			$this->render('login', [
				'email' => $email,
				'error' => 'Incorrect email address or password.'
			]);
		}
	}
}