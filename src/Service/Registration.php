<?php

namespace Example\Service;

use Example\Core\Container;
use Example\Repository\RegistrationRepository;

class Registration {

    private $container;

    public function __construct(Container $container) {
        $this->container = $container;
    }

    public function registration($email, $password, $submit) {

        if ($submit) {
            $registration = $this->container->autoResolve(RegistrationRepository::class);
            $hash = password_hash($password, PASSWORD_DEFAULT);

            if (!$registration->doesEmailAlreadyExist($email)) {
                $uid = $registration->createUser($email, $hash, $submit);
                $_SESSION['user'] = $uid;

                return '';
            }

            return 'Такой email существует';
        }
    }
}