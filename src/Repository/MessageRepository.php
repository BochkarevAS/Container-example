<?php

namespace Example\Repository;

use Example\Core\Db;

class MessageRepository extends Db {

    public function getMessage($sort) {
        $sql = "
            SELECT m.id, m.message, u.email, m.date::date dt, i.img, m.upadmin, m.isadmin
            FROM message.mess m
            JOIN users u ON (u.id=m.uid)
            LEFT JOIN image i ON (i.uid=m.id)
            ORDER BY $sort ASC";
        $result = $this->query($sql);

        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function addMessage($message, $uid) {
        $sql = "INSERT INTO message.mess(message, uid) VALUES (:message, :uid)";
        $this->query($sql, ['message' => $message, 'uid' => $uid]);

        return;
    }
}