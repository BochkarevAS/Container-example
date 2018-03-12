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
        $valid = false;

        if ($submit) {
            $registration = $this->container->make(SecurityRepository::class);
            $validate = $this->container->make(Validate::class);
            $valid = $validate->isValid($email, $password);

            if (!$registration->doesEmailAlreadyExist($email) && !$valid) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $uid = $registration->createUser($email, $hash);
                $_SESSION['user'] = $uid;
            }
        }

        return $valid;
    }

    public function login($email, $password, $submit) {

        if ($submit) {
            $login = $this->container->make(SecurityRepository::class);

            if (password_verify($password, $login->doesHashEmailExist($email))) {
                $uid = $login->getEmail($email);
            } else {
                return false;
            }

            if ($uid == 1) {    // Значит админ
                $_SESSION['admin'] = $uid;
                // $this->container->make(RoleRepository::class)->getRolePerms($uid);
            } else {
                $_SESSION['user'] = $uid;
            }

            return true;
        }

        return false;
    }
}