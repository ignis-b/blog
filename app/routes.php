<?php
use App\Controllers\HomeAction;
use App\Controllers\UserController;
    use App\Controllers\UsersController;

$app->get('/', App\Controllers\HomeAction::class)
    ->setName('homepage');

$app->get('/users', UsersController::class);

$app->get('/user/login', UserController::class);
//$app->post('/user/login', [UserController::class, 'actionLogin']);

$app->get('/myArticles', App\Controllers\HomeAction::class)
 ->setName('myArticles');
$app->get('/article_create', App\Controllers\HomeAction::class)
 ->setName('article_create');
$app->get('/user_profile', App\Controllers\HomeAction::class)
 ->setName('user_profile');
$app->get('/security_logout', App\Controllers\HomeAction::class)
 ->setName('security_logout');
$app->get('/security_login', App\Controllers\HomeAction::class)
 ->setName('security_login');
$app->get('/user_register', App\Controllers\HomeAction::class)
 ->setName('user_register');
$app->run();
