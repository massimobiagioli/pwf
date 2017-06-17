<?php

namespace Core\Client;

class Client {
    
    private $messages;
    
    public function __construct() {
        $this->clearMessage();
    }
    
    public function clearMessage() {
        $this->messages = [];
    }
    
    public function addMessage(ClientMessage $msg) {
        $this->messages[] = $msg;
    }
    
    public function addMessages($messages) {
        foreach ($messages as $message) {
            $this->addMessage($message);
        }
    }
    
    public function getMessages() {
        return $this->messages;
    }
    
}