<?php
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\UsersController;

$app->get('/', HomeController::class)
    ->setName('homepage');

$app->get('/users', UsersController::class);

$app->get('/myArticles', App\Controllers\HomeController::class)
 ->setName('myArticles');
$app->get('/article_create', App\Controllers\HomeController::class)
 ->setName('article_create');
$app->get('/user_profile', App\Controllers\HomeController::class)
 ->setName('user_profile');

$app->get('/security_logout', App\Controllers\LogoutController::class)
 ->setName('security_logout');

$app->get('/security_login', App\Controllers\LoginController::class)
 ->setName('security_login');
$app->post('/security_login', App\Controllers\LoginController::class)
 ->setName('security_login');

$app->get('/user_register', App\Controllers\UserRegisterController::class)
 ->setName('user_register');
$app->post('/user_register', App\Controllers\UserRegisterController::class)
 ->setName('user_register');
$app->run();
