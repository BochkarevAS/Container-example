<?php

namespace Example\Service;

use Example\Core\Container;
use Example\Repository\MessageRepository;

class Message {

    private $container;

    public function __construct(Container $container) {
        $this->container = $container;
    }

    public function getMessage($sort) {
        $message = $this->container->make(MessageRepository::class);

        return $message->getMessage($sort);
    }

    public function addMessage($mess, $uid) {
        $message = $this->container->make(MessageRepository::class);
        $message->addMessage($mess, $uid);

        return;
    }
}