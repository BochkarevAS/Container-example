<?php

namespace Example\Repository;

use Example\Core\Db;

class AdminRepository extends Db {

    public function updateAction($message, $id) {
        $sql = "UPDATE message.mess SET message=:message, upadmin=true WHERE id=:id";
        $this->query($sql, ['message' => $message, 'id' => $id]);
    }

    public function deleteAction($id) {
        $sql = "DELETE FROM message.mess WHERE id=:id";
        $this->query($sql, ['id' => $id]);
    }

    public function isAdminAction($id) {
        $sql = "UPDATE message.mess SET isadmin=true WHERE id=:id";
        $this->query($sql, ['id' => $id]);
    }

    public function addImageAction($id, $makeSeed) {
        $file = $_FILES['file'];
        $uploaddir = dirname($_SERVER['SCRIPT_FILENAME']) . "/UploadedFiles/";
        list ($width, $height, $type, $attr) = getimagesize($file['tmp_name']);

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

        if (!in_array($type, ['GIF' => 1, 'JPG' => 2, 'PNG' => 3])) { // Допустимые форматы ...
            echo 'Недопустимый формат';
            die;
        }

        $newWidth = (100 < $width) ? 100 : $width;
        $newHeight = (100 < $height) ? 100 : $height;

        // ресэмплирование
        $newImage = imagecreatetruecolor($newWidth, $newHeight);
        $image = imagecreatefromjpeg($file['tmp_name']);
        imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        $info = pathinfo($file['name']);
        $ext = empty($info['extension']) ? "" : "." . $info['extension'];
        $uploadfile = "$year/$month/$day/" . $makeSeed . $ext;

        if (move_uploaded_file($file['tmp_name'], $uploaddir . $uploadfile)) {
            $sql = "INSERT INTO image (img, uid) VALUES (:img, :uid)";
            $this->query($sql, ['img' => $uploadfile, 'uid' => $id]);
        }
    }

}