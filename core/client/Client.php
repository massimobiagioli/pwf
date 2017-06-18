<?php

namespace Core\Client;

/**
 * Dialogo con il client
 */
class Client {
    
    /**
     * Array di messaggi
     * @var array
     */
    private $messages;
    
    public function __construct() {
        $this->clearMessage();
    }
    
    /**
     * Pulisce array messaggi
     */
    public function clearMessage() {
        $this->messages = [];
    }
    
    /**
     * Aggiunge messaggio all'array di messaggi
     * @param \Core\Client\ClientMessage $msg
     */
    public function addMessage(ClientMessage $msg) {
        $this->messages[] = $msg;
    }
    
    /**
     * Aggiunge messaggi all'array di messaggi
     * @param type $messages Array di messaggi da aggiungere
     */
    public function addMessages($messages) {
        foreach ($messages as $message) {
            $this->addMessage($message);
        }
    }
    
    /**
     * Restituisce array messaggi
     * @return array
     */
    public function getMessages() {
        return $this->messages;
    }
    
}