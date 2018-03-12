<?php

namespace Example\Service;

class Validate {

    public function clean($value) {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);

        return $value;
    }

    public function checkLength($value, $min, $max) {    // для проверки длинны строки ...
        $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
        return !$result;
    }

    public function isValid($email, $password) {
        $email = $this->clean($email);
        $password = $this->clean($password);

        if (empty($email) || empty($password)) {
            return 'Пустой Email или пароль';
        }

        if (!$this->checkLength($email, 3, 7) || !$this->checkLength($password, 3, 7)) {
            return 'Некоректная длинна Email или пароль';
        }

        return false;
    }
}