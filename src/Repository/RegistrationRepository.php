<?php

namespace Example\Repository;

use Example\Core\Db;

class RegistrationRepository extends Db {

    public function createUser($password, $email, $code) {
        $sql = "INSERT INTO users (password, email, code) VALUES (:password, :email, :code) RETURNING id";
        $result = $this->query($sql, ['email' => $email, 'password' => $password, 'code' => $code,]);

        return $result->fetchColumn();
    }

    public function doesEmailAlreadyExist($email) {
        $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
        $result = $this->query($sql, ['email' => $email]);

        return $result->fetchColumn();
    }
}