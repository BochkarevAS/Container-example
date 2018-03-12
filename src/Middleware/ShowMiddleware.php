<?php

namespace Example\Middleware;

class ShowMiddleware {

    public function handle() {

        if (isset($_SESSION['user'])) {
            header('Location: /message/show');
            die();
        }
    }

}