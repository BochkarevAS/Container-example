<?php

namespace Example\Service;

use Example\Core\Container;
use Example\Repository\RoleRepository;
use Example\Repository\SecurityRepository;

class Security {

    private $container;

    public function __construct(Container $container) {
        $this->container = $container;
    }

    public function registration($email, $password, $submit) {

        if ($submit) {
            $registration = $this->container->make(SecurityRepository::class);
            $hash = password_hash($password, PASSWORD_DEFAULT);

            if (!$registration->doesEmailAlreadyExist($email)) {
                $uid = $registration->createUser($email, $hash, $submit);
                $_SESSION['user'] = $uid;

                return false;
            }

            return 'Такой email существует';
        }

        return 'Регестрация';
    }

    public function login($email, $password, $submit) {

        if ($submit) {
            $uid = 0;
            $login = $this->container->make(SecurityRepository::class);
            $hash = $login->doesHashEmailExist($email);

            if (password_verify($password, $hash)) {
                $uid = $login->getEmail($email);
            }

            if ($uid == 1) { // Значит админ
                $_SESSION['admin'] = $uid;

                return $this->container->make(RoleRepository::class)->getRolePerms($uid);
            }

            if ($uid) {
                $_SESSION['user'] = $uid;
                return false;
            }

            return 'Не верный email или пароль';
        }

        return 'Авторизация';
    }
}