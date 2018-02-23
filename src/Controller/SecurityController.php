<?php

namespace Example\Controller;

use Example\Core\Controller;

class SecurityController extends Controller {

    public function loginAction() {

    }

    public function logoutAction() {
        unset($_SESSION['user']);
        header('Location: /user/registration');
        return;
    }
}