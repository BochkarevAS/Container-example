<?php

namespace Example\Core;

class Router {

    private $routes = [
        'user/registration' => ['Example\Controller\RegistrationController', 'indexAction'],
        'user/logout' => ['Example\Controller\SecurityController', 'logoutAction'],
        'user/login' => ['Example\Controller\SecurityController', 'loginAction']
    ];

    private $container;

    public function __construct(Container $container) {
        $this->container = $container;
    }

    public function run($uri = 'user/registration') {
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        $val = 0;

        foreach ($this->routes as $route => $value) {

            if (preg_match("~$route~", $uri, $matches)) {
                $object = $this->container->make($value[0]);
                $method = $value[1];
                $val = $object->$method();
            }
        }

        return $val;
    }
}