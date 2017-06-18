<?php

namespace Core\Client;

/**
 * Messaggio da inviare al client
 */
class ClientMessage {
    
    /**
     * Tipo messaggio
     * @var type string
     */
    private $type;
    
    /**
     * Chiave messaggio
     * @var type  string
     */
    private $key;
    
    /**
     * Valore messaggio
     * @var type mixed
     */
    private $value;
    
    public function __construct() {
        $this->type = '';
        $this->key = '';
        $this->value = '';
    }
    
    /**
     * Crea nuovo messaggio
     * @param string $type Tipo
     * @param string $key Chiave
     * @param mixed $value Valore
     * @return \Core\Client\ClientMessage
     */
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
