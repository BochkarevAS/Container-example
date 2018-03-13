<?php

namespace Example\Controller;

use Example\Core\Controller;
use Example\Core\Request;
use Example\Service\Message;

class MessageController extends Controller {

    public function showAction() {
        return $this->render('user/show');
    }

    public function showAjaxAction(Request $request) {
        $sort = $request->post('sort');

        $message = $this->container->make(Message::class);
        $message = $message->getMessage($sort);

        echo json_encode($message);
        die();
    }

    public function addAction(Request $request) {
        $mess = $request->post('message');
        $uid = $_SESSION['user'];

        $message = $this->container->make(Message::class);
        $message->addMessage($mess, $uid);

        header('Location: /message/show');
        die();
    }
}