<?php

$app->get('/', App\Controllers\HomeController::class)
 ->setName('homepage');
$app->get('/{page:[0-9]+}', App\Controllers\HomeController::class)
    ->setName('homepage_page');

$app->get('/article_edit/{id:[0-9]+}', App\Controllers\ArticleEditController::class)
    ->setName('article_edit');
$app->post('/article_edit/{id:[0-9]+}', App\Controllers\ArticleEditController::class)
    ->setName('article_edit');

$app->get('/article_delete/{id:[0-9]+}', App\Controllers\ArticleDeleteController::class)
    ->setName('article_delete');
$app->post('/article_delete/{id:[0-9]+}', App\Controllers\ArticleDeleteController::class)
     ->setName('article_delete');

$app->get('/myArticles', App\Controllers\HomeController::class)
    ->setName('myArticles');

$app->get('/article_create', App\Controllers\ArticleCreateController::class)
    ->setName('article_create');
$app->post('/article_create',App\Controllers\ArticleCreateController::class)
    ->setName('article_create');

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
