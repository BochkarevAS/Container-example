<?php

namespace Example\Controller;

use Example\Core\Controller;
use Example\Core\Request;
use Example\Service\Security;

class SecurityController extends Controller {

    public function registrationAction(Request $request) {
        $email = $request->post('email');
        $password = $request->post('password');
        $submit = $request->post('submit');

        $security = $this->container->make(Security::class);
        $error = $security->registration($email, $password, $submit);

        if (isset($_SESSION['user'])) {
            header('Location: /message/show');
            die();
        }

        return $this->render('user/registration', [
            'error' => $error
        ]);
    }

    public function loginAction(Request $request) {
        $email = $request->post('email');
        $password = $request->post('password');
        $submit = $request->post('submit');

        $security = $this->container->make(Security::class);
        $error = $security->login($email, $password, $submit);

        if (isset($_SESSION['user'])) {
            return $this->render('user/show');
        }

        if (isset($_SESSION['admin'])) {
            header('Location: /admin/show/1');
            die();
        }

        return $this->render('user/login', [
            'error' => $error
        ]);
    }

    public function logoutAction() {
        unset($_SESSION['user']);
        unset($_SESSION['admin']);

        header('Location: /security/registration');
        die();
    }
}