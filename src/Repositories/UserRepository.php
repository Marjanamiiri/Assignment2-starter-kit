<?php

namespace src\Repositories;

use src\Models\User;

class UserRepository extends Repository {

	/**
	 * @param string $id
	 * @return User|false
	 */
	public function getUserById(string $id): User|false {
		$pdoStatement = $this->pdo->prepare('SELECT * FROM users WHERE id = ?;');
		$pdoStatement->execute([$id]);
		$resultSet = $pdoStatement->fetch();
		return ($resultSet) ? new User($resultSet) : false;
	}

	/**
	 * @param string $email
	 * @return User|false
	 */
	public function getUserByEmail(string $email): User|false {
		$pdoStatement = $this->pdo->prepare('SELECT * FROM users WHERE email = ?;');
		$pdoStatement->execute([$email]);
		$resultSet = $pdoStatement->fetch();
		return ($resultSet) ? new User($resultSet) : false;
	}

	/**
	 * @param string $passwordDigest
	 * @param string $email
	 * @param string $name
	 * @return User|false
	 */
	public function saveUser(string $name, string $email, string $passwordDigest): User|false {
		$pdoStatement = $this->pdo->prepare('INSERT INTO users (email, name, password_digest) VALUES (?, ?, ?);');
		$success = $pdoStatement->execute([$email, $name, $passwordDigest]);
		if ($success) {
			$id = $this->pdo->lastInsertId();
			$sqlStatement = "SELECT * FROM users where id = $id";
			$result = $this->pdo->query($sqlStatement);
			return new User($result->fetch());
		} else {
			return false;
		}
	}

	/**
	 * @param int $id
	 * @param string $name
	 * @param string|null $profilePicture
	 * @return bool
	 */
	public function updateUser(int $id, string $name, ?string $profilePicture = null): bool {
		if ($profilePicture) {
			$pdoStatement = $this->pdo->prepare('UPDATE users SET name = ?, profile_picture = ? WHERE id = ?;');
			$success = $pdoStatement->execute([$name, $profilePicture, $id]);
		} else {
			$pdoStatement = $this->pdo->prepare('UPDATE users SET name = ? WHERE id = ?;');
			$success = $pdoStatement->execute([$name, $id]);
		}
		return $success;
	}

}