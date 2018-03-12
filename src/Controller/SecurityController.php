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

        if (!$error) {
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

        $security = $this->container->make(Security::class); // Не забыть уточнить !!!
        $message = $security->login($email, $password, $submit);

        if (!$message && !is_array($message)) {
            return $this->render('user/show');
        }

        if (is_array($message)) {
            header('Location: /admin/show/1');
            die();
        }

        return $this->render('user/login', [
            'message' => $message
        ]);
    }

    public function logoutAction() {
        unset($_SESSION['user']);
        unset($_SESSION['admin']);

        header('Location: /security/registration');
        die();
    }
}