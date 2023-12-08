<?php

namespace src\Controllers;

class LogoutController extends Controller
{

	/**
	 * Destroy the authenticating session variable.
	 * @return void
	 */
	public function logout(): void
	{
		unset($_SESSION['user_id']);
		$this->redirect('/', true);
	}
}