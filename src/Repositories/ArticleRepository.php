<?php

namespace src\Repositories;

use src\Models\Article as Article;
use src\Models\User;

class ArticleRepository extends Repository {

	/**
	 * @return Article[]
	 */
	public function getAllArticles(): array {
		$pdoStatement = $this->pdo->query('SELECT * FROM articles;');
		$rows = $pdoStatement->fetchAll();
		$articles = [];
		foreach ($rows as $row) {
			$articles[] = new Article($row);
		}
		return $articles;
	}

	/**
	 * @param string $title
	 * @param string $url
	 * @param string $authorId
	 * @return Article|false
	 */
	public function saveArticle(string $title, string $url, string $authorId): Article|false {
		$createdAt = date('Y-m-d H:i:s');
		$pdoStatement = $this->pdo->prepare('INSERT INTO articles (title, url, created_at, updated_at, author_id) VALUES (?, ?, ?, ?, ?);');
		$success = $pdoStatement->execute([$title, $url, $createdAt, null, $authorId]);
		if ($success) {
			$id = $this->pdo->lastInsertId();
			$sqlStatement = "SELECT * FROM articles where id = $id";
			$result = $this->pdo->query($sqlStatement);
			return new Article($result->fetch());
		} else {
			return false;
		}
	}

	/**
	 * @param int $id
	 * @return Article|false Article object if it was found, false otherwise
	 */
	public function getArticleById(int $id): Article|false {
		$pdoStatement = $this->pdo->prepare('SELECT * FROM articles WHERE id = ?;');
		$pdoStatement->execute([$id]);
		$resultSet = $pdoStatement->fetch();
		return ($resultSet) ? new Article($resultSet) : false;
	}

	/**
	 * @param int $id
	 * @param string $title
	 * @param string $url
	 * @return bool true on success, false otherwise
	 */
	public function updateArticle(int $id, string $title, string $url): bool {
		$updatedAt = date('Y-m-d H:i:s');
		$pdoStatement = $this->pdo->prepare('UPDATE articles SET title = ?, url = ?, updated_at = ? WHERE id = ?;');
		$success = $pdoStatement->execute([$title, $url, $updatedAt, $id]);
		return $success;
	}

	/**
	 * @param int $id
	 * @return bool true on success, false otherwise
	 */
	public function deleteArticleById(int $id): bool {
		$pdoStatement = $this->pdo->prepare('DELETE FROM articles WHERE id = ?;');
		$deleted = $pdoStatement->execute([$id]);
		return $deleted;
	}

	/**
	 * @param string $articleId
	 * @return User|false
	 */
	public function getArticleAuthor(string $articleId): User|false {
		$pdoStatement = $this->pdo->prepare('SELECT u.* FROM articles AS a INNER JOIN users AS u ON a.author_id = u.id WHERE a.id = ?');
		$pdoStatement->execute([$articleId]);
		$resultSet = $pdoStatement->fetch();
		return ($resultSet) ? new User($resultSet) : false;
	}

}