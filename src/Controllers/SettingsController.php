<?php

namespace src\Controllers;

use core\Request;
use src\Repositories\UserRepository;

class SettingsController extends Controller
{

	/**
	 * @param Request $request
	 * @return void
	 */
	public function index(Request $request): void
	{
		if ($_SESSION['user_id']) {
			$this->render('settings', [
				'user' => (new UserRepository)->getUserById($_SESSION['user_id'])
			]);
		} else {
			$this->redirect('/', true);
		}
	}

	/**
	 * @param Request $request
	 * @return void
	 */
	public function update(Request $request): void
	{
		$name = htmlspecialchars($request->input('name'));
		$profilePicture = null;

		if ($_FILES) {
			$profilePicture = $_FILES['profile_picture']['name'];
			move_uploaded_file($_FILES['profile_picture']['tmp_name'], "images/$profilePicture");
		}

		$user = (new UserRepository)->updateUser(
			id: $_SESSION['user_id'],
			name: $name,
			profilePicture: htmlspecialchars($profilePicture)
		);

		$this->redirect('/', true);
	}
}