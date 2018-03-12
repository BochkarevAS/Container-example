<?php

namespace Example\Middleware;

class AuthMiddleware {

    public function handle() {

        if (isset($_SESSION['user'])) {
            header('Location: /message/show');
            die();
        }

        if (isset($_SESSION['admin'])) {
            header('Location: /admin/show/1');
            die();
        }
    }
}