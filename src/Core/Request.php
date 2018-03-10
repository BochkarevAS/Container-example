<?php

namespace Example\Core;

class Request {

    public function post($key) {

        if (isset($_POST[$key])) {
            return $_POST[$key];
        }

        return '';
    }

    public function get($key) {

        if (isset($_GET[$key])) {
            return $_GET[$key];
        }

        return '';
    }
}