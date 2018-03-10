<?php

namespace Example\Repository;

use Example\Core\Db;

class SecurityRepository extends Db {

    public function createUser($email, $password, $code) {
        $sql = "INSERT INTO users (password, email, code) VALUES (:password, :email, :code) RETURNING id";
        $result = $this->query($sql, ['email' => $email, 'password' => $password, 'code' => $code,]);

        return $result->fetchColumn();
    }

    public function doesEmailAlreadyExist($email) {
        $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
        $result = $this->query($sql, ['email' => $email]);

        return $result->fetchColumn();
    }

    public function getEmail($email) {
        $sql = "SELECT id FROM users WHERE email = :email";
        $result = $this->query($sql, ['email' => $email]);

        return $result->fetchColumn();
    }

    public function doesHashEmailExist($email) {
        $sql = "SELECT password FROM users WHERE email = :email";
        $result = $this->query($sql, ['email' => $email]);

        return $result->fetchColumn();
    }
}