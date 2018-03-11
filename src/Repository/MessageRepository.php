<?php

namespace Example\Repository;

use Example\Core\Db;

class MessageRepository extends Db {

    public function getMessage($sort) {
        $list['admin'] = isset($_SESSION['admin']) ? $_SESSION['admin'] : false;

        $sql = "
            SELECT m.id, m.message, u.email, m.date::date dt, i.img, m.upadmin, m.isadmin
            FROM message.mess m
            JOIN users u ON (u.id=m.uid)
            LEFT JOIN image i ON (i.uid=m.id)
            ORDER BY $sort ASC";
        $result = $this->query($sql);

        while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
            $list[] = $row;
        }

        return $list;
    }

    public function addMessage($message, $uid) {
        $sql = "INSERT INTO message.mess(message, uid) VALUES (:message, :uid)";
        $this->query($sql, ['message' => $message, 'uid' => $uid]);

        return;
    }
}