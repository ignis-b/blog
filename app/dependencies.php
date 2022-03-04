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
$container[App\Controllers\HomeAction::class] = function ($c) {
    return new App\Controllers\HomeAction($c->get('view'), $c->get('logger'));
};
$container[App\Controllers\UsersController::class] = function ($c) {
    return new App\Controllers\UsersController($c->get('view'), $c->get('logger'));
};
$container[App\Controllers\UserController::class] = function ($c) {
    return new App\Controllers\UserController($c->get('view'), $c->get('logger'), $c->get('service'));
};