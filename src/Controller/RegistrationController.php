<?php

namespace Example\Controller;

use Example\Core\Controller;
use Example\Service\Registration;

class RegistrationController extends Controller {

    public function indexAction() {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $submit = $_POST['submit'];

        $regist = $this->container->autoResolve(Registration::class);
        $error = $regist->registration($email, $password, $submit);

        return $this->render('user/registration', [
            'error' => $error
        ]);
    }

}