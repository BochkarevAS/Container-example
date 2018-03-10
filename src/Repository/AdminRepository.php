<?php

namespace Example\Repository;

use Example\Core\Db;

class AdminRepository extends Db {

    public function updateAction($message, $id) {
        $sql = "UPDATE message.mess SET message=:message WHERE id=:id";
        $this->query($sql, ['message' => $message, 'id' => $id]);
    }

    public function deleteAction($id) {
        $sql = "DELETE FROM message.mess WHERE id=:id";
        $this->query($sql, ['id' => $id]);
    }

    public function addImageAction($id, $makeSeed) {
        $file = $_FILES['file'];
        $uploaddir = dirname($_SERVER['SCRIPT_FILENAME']) . "/UploadedFiles/";

        $year = date("Y");
        $month = date("m");
        $day = date("d");

        if (!file_exists("$uploaddir$year/")) {
            mkdir("$uploaddir$year/", 0777, true);
        }
        if (!file_exists("$uploaddir/$year/$month/")) {
            mkdir("$uploaddir$year/$month/", 0777, true);
        }
        if (!file_exists("$uploaddir$year/$month/$day/")) {
            mkdir("$uploaddir$year/$month/$day/", 0777, true);
        }

        $info = pathinfo($file['name']);
        $ext = empty($info['extension']) ? "" : "." . $info['extension'];
        $uploadfile = "$year/$month/$day/" . $makeSeed . $ext;

        if (move_uploaded_file($file['tmp_name'], $uploaddir . $uploadfile)) {
            $sql = "INSERT INTO image (img, uid) VALUES (:img, :uid)";
            $this->query($sql, ['img' => $uploadfile, 'uid' => $id]);
        }
    }

}