<?php

namespace src\Controllers;

use core\Request;
use PDOException;
use src\Repositories\UserRepository;

class RegistrationController extends Controller
{

	/**
	 * @return void
	 */
	public function index(): void
	{
		$this->render('register');
	}

	public function register(Request $request): void
	{
		$errors = [];
		$email = htmlspecialchars($request->input('email'));
		$name = htmlspecialchars($request->input('name'));
		$password = $request->input('password');

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors['email'] = 'Invalid email address.';
		}

		if ((new UserRepository)->getUserByEmail($email)) {
			$errors['email'] = 'This user already exists. <a href="/login">Log in</a> instead.';
		}

		// THIS PATTERN MATCHES INVALID PASSWORDS. Ideally, it should as follows to ensure that numbers, upper- and
		// lowercased letters, as well as symbols are included: /^(.{0,7}|[^0-9]*|[^A-Z]*|[^a-z]*|[a-zA-Z0-9]*)$/
		if (preg_match("/^(.{0,7}|[^a-zA-Z]*|[a-zA-Z0-9]*)$/", $password)) {
			$errors['password'] = 'A password must be 8+ characters long and must contain a letter and a symbol.';
		}

		if (!count($errors)) {
			$digest = password_hash($password, PASSWORD_BCRYPT, [ 'cost' => 12 ]);

			$user = (new UserRepository)->saveUser(
				email: $email,
				name: $name,
				passwordDigest: $digest
			);

			$this->setSessionData('user_id', $user->__get('id'));
			$this->redirect('/', true);
		} else {
			$this->render('register', [
				'errors' => $errors,
				'email' => $email,
				'name' => $name
			]);
		}
	}
}