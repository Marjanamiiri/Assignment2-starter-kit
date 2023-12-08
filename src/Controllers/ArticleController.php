<?php

namespace src\Controllers;

use core\Request;
use src\Repositories\ArticleRepository;
use src\Repositories\UserRepository;
use src\Models\Article;
class ArticleController extends Controller
{

	/**
	 * Display the page showing the articles.
	 * @return void
	 */
	public function index(): void
	{
		$articles = (new ArticleRepository)->getAllArticles();
		$this->render('index', ['articles' => $articles]);
	}

	/**
	 * Process the storing of a new article.
	 * @return void
	 */
	public function create(): void
	{
		if ($_SESSION['user_id']) {
			$this->render('new_article');
		} else {
			$this->redirect('/', true);
		}
	}

	public function store(Request $request)
	{
		$title = htmlspecialchars($request->input('title'));
		$url = htmlspecialchars($request->input('url'));

		$article = (new ArticleRepository)->saveArticle(
			title: $title,
			url: $url,
			authorId: $_SESSION['user_id']
		);

		$this->redirect('/', true);
	}

	/**
	 * Show the form for editing an article.
	 * @param Request $request
	 * @return void
	 */
	public function edit(Request $request): void
	{
		$articleId = (isset($_GET['id']) && is_numeric($_GET['id'])) ? $_GET['id'] : null;

		if ($_SESSION['user_id']) {
			if ($articleId) {
				$article = (new ArticleRepository)->getArticleById($_GET['id']);

				if ($article) {
					$contributor = (new ArticleRepository)->getArticleAuthor($article->id);

					if ($contributor->id === (int)$_SESSION['user_id']) {
						// happy path
						$this->render('update_article', ['article' => $article]);
					} else {
						// invalid contributor id
						$this->redirect('/', true);
					}
				} else {
					// invalid article id number
					$this->redirect('/', true);
				}
			} else {
				// invalid article id type
				$this->redirect('/', true);
			}
		} else {
			// not logged in
			$this->redirect('/login', true);
		}
	}

	/**
	 * Process the editing of an article.
	 * @param Request $request
	 * @return void
	 */
	public function update(Request $request): void
	{
		$articleId = (is_numeric($request->input('id'))) ? $request->input('id') : null;
		$article = (new ArticleRepository)->getArticleById($articleId);
		$title = htmlspecialchars($request->input('title'));
		$url = htmlspecialchars($request->input('url'));

		if ($article) {
			$contributor = (new ArticleRepository)->getArticleAuthor($article->id);

			if ($contributor->id === (int)$_SESSION['user_id']) {
				// happy path
				$article = (new ArticleRepository)->updateArticle(
					id: $articleId,
					title: $title,
					url: $url
				);
			}
		}

		$this->redirect('/', true);
	}

	/**
	 * Process the deleting of an article.
	 * @param Request $request
	 * @return void
	 */
	public function delete(Request $request): void
	{
		$articleId = ($request->input('id') && is_numeric($request->input('id'))) ? $request->input('id') : null;

		if ($_SESSION['user_id']) {
			if ($articleId) {
				$article = (new ArticleRepository)->getArticleById($articleId);

				if ($article) {
					$contributor = (new ArticleRepository)->getArticleAuthor($articleId);

					if ($contributor->id === (int)$_SESSION['user_id']) {
						// happy path
						(new ArticleRepository)->deleteArticleById(
							id: htmlspecialchars($articleId)
						);

						$this->redirect('/', true);
					} else {
						// invalid contributor id
						$this->redirect('/', true);
					}
				} else {
					// invalid article id number
					$this->redirect('/', true);
				}
			} else {
				// invalid article id type
				$this->redirect('/', true);
			}
		} else {
			// not logged in
			$this->redirect('/login', true);
		}
	}
}