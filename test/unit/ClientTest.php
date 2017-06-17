<?php

namespace Test\Unit;

use PHPUnit\Framework\TestCase;
use Core\Client\Client;
use Core\Client\ClientMessage;

class ClientTest extends TestCase {
    
    private $client;
    
    protected function setUp() {
        $this->client = new Client();
    }
    
    public function testClassExists() {
        $this->assertNotNull($this->client);
    }
    
    public function testInitMessages() {
        $this->assertEmpty($this->client->getMessages());
    }
    
    public function testAddOneMessage() {
        $msg = ClientMessage::newClientMessage('dummy', 'chiave1', 'valore1');
        $this->client->addMessage($msg);
        $messages = $this->client->getMessages();
        $this->assertEquals(1, count($messages));
    }
    
    public function testAddTwoMessages() {
        $this->client->addMessages([
            ClientMessage::newClientMessage('dummy', 'chiave1', 'valore1'),
            ClientMessage::newClientMessage('dummy', 'chiave2', 'valore2')
        ]);
        $messages = $this->client->getMessages();
        $this->assertEquals(2, count($messages));
    }
    
    public function testClearMessagesAfterAddAMessage() {
        $msg = ClientMessage::newClientMessage('dummy', 'chiave1', 'valore1');
        $this->client->addMessage($msg);
        $this->client->clearMessage($msg);
        $messages = $this->client->getMessages();
        $this->assertEmpty($messages);
    }
    
}
