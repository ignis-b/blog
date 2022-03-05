<?php
// DIC configuration

$container = $app->getContainer();

// -----------------------------------------------------------------------------
// Service providers
// -----------------------------------------------------------------------------

// Twig
$container['view'] = function ($c) {
    $settings = $c->get('settings');
    $view = new Slim\Views\Twig($settings['view']['template_path'], $settings['view']['twig']);

    // Add extensions
    $view->addExtension(new Slim\Views\TwigExtension($c->get('router'), $c->get('request')->getUri()));
//    $view->addExtension(new Twig_Extension_Debug());

    return $view;
};

// Flash messages
$container['flash'] = function ($c) {
    return new Slim\Flash\Messages;
};

// -----------------------------------------------------------------------------
// Service factories
// -----------------------------------------------------------------------------

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings');
    $logger = new Monolog\Logger($settings['logger']['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['logger']['path'], Monolog\Logger::DEBUG));
    return $logger;
};

// -----------------------------------------------------------------------------
// Action factories
// -----------------------------------------------------------------------------

$container['service'] = function ($c) {
    return new App\Services\AuthService;
};
$container['user_register_service'] = function ($c) {
    return new App\Services\UserRegisterService;
};
$container['logout_service'] = function ($c) {
    return new App\Services\LogoutService;
};

$container[App\Controllers\HomeController::class] = function ($c) {
    return new App\Controllers\HomeController($c->get('view'), $c->get('logger'));
};
$container[App\Controllers\LoginController::class] = function ($c) {
    return new App\Controllers\LoginController($c->get('view'), $c->get('logger'), $c->get('service'));
};
$container[App\Controllers\UserRegisterController::class] = function ($c) {
    return new App\Controllers\UserRegisterController($c->get('view'), $c->get('logger'), $c->get('user_register_service'));
};
$container[App\Controllers\LogoutController::class] = function ($c) {
    return new App\Controllers\LogoutController($c->get('view'), $c->get('logger'), $c->get('logout_service'));
};