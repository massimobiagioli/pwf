<?php

namespace Core\Client;

class ClientMessage {
    
    private $type;
    private $key;
    private $value;
    
    public function __construct() {
        $this->type = '';
        $this->key = '';
        $this->value = '';
    }
    
    public static function newClientMessage($type, $key, $value) {
        $clientMessage = new ClientMessage();
        $clientMessage->setType($type);
        $clientMessage->setKey($key);
        $clientMessage->setValue($value);
        return $clientMessage;
    }
    
    public function getType() {
        return $this->type;
    }

    public function getKey() {
        return $this->key;
    }

    public function getValue() {
        return $this->value;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function setKey($key) {
        $this->key = $key;
    }

    public function setValue($value) {
        $this->value = $value;
    }

}
