<?php

use core\Router;

use src\Controllers\ArticleController;
use src\Controllers\LoginController;
use src\Controllers\LogoutController;
use src\Controllers\RegistrationController;
use src\Controllers\SettingsController;

// articles
Router::get('/', [ArticleController::class, 'index']);
Router::get('/articles/create', [ArticleController::class, 'create']);
Router::get('/articles/delete', [ArticleController::class, 'delete']);
Router::get('/articles/edit', [ArticleController::class, 'edit']);
Router::post('/articles/store', [ArticleController::class, 'store']);
Router::post('/articles/update', [ArticleController::class, 'update']);

// user
Router::get('/login', [LoginController::class, 'index']);
Router::post('/login', [LoginController::class, 'login']);
Router::post('/logout', [LogoutController::class, 'logout']);
Router::get('/register', [RegistrationController::class, 'index']);
Router::post('/register', [RegistrationController::class, 'register']);
Router::get('/settings', [SettingsController::class, 'index']);
Router::post('/settings', [SettingsController::class, 'update']);