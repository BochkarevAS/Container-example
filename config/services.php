<?php

// Core
$container->bind(\Example\Core\Router::class, function ($c) {
    return new \Example\Core\Router($c, include(ROOT . '/config/routes.php'));
});
$container->bind(\Example\Core\Controller::class, function ($c) {
    return new \Example\Core\Controller($c);
});
$container->bind(\Example\Core\View::class, function ($c) {
    return new \Example\Core\View();
});
$container->bind(\Example\Core\Request::class, function ($c) {
    return new \Example\Core\Request();
});
// Controller
$container->bind(\Example\Controller\SecurityController::class, function ($c) {
    return new \Example\Controller\SecurityController($c);
});
$container->bind(\Example\Controller\MessageController::class, function ($c) {
    return new \Example\Controller\MessageController($c);
});
// Repository
$container->bind(\Example\Repository\SecurityRepository::class, function ($c) {
    return new \Example\Repository\SecurityRepository();
});
$container->bind(\Example\Repository\RoleRepository::class, function ($c) {
    return new \Example\Repository\RoleRepository();
});
// Service
$container->bind(\Example\Service\Security::class, function ($c) {
    return new \Example\Service\Security($c);
});
$container->bind(\Example\Service\Message::class, function ($c) {
    return new \Example\Service\Message($c);
});
// Middleware
$container->instance(\Example\Middleware\AuthMiddleware::class,
    new \Example\Middleware\AuthMiddleware()
);
