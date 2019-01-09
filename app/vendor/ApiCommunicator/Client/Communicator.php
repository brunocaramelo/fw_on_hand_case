<?php

namespace Vendor\ApiCommunicator\Client;

use Vendor\ApiCommunicator\Client\Client;
use Vendor\ApiCommunicator\Contacts\ContactHandler;
use Vendor\ApiCommunicator\Lists\ListHandler;
use Vendor\ApiCommunicator\Messages\MessageHandler;

use Core\ConfigParser;

class Communicator
{
    private $consumerKey;
    private $consumerSecret;
    private $consumerToken;
    private $consumerTokenSecret;
    private $client;

    private $contactHandler;
    private $listHandler;
    private $messagesHandler;

    public function __construct()
    {
        $config = (new ConfigParser())->get('integration');
        
        $this->consumerKey = $config['api_consumer_key'];
        $this->consumerSecret = $config['api_consumer_secret'];
        $this->consumerToken = $config['api_token'];
        $this->consumerTokenSecret = $config['api_token_secret'];
        
        $this->client = new Client(
            $this->consumerKey,
            $this->consumerSecret,
            $this->consumerToken,
            $this->consumerTokenSecret
        );
    }

    public function contacts()
    {
        if (!$this->contactHandler instanceof ContactHandler) {
            $this->contactHandler = new ContactHandler($this->client);
        }
        return $this->contactHandler;
    }
    
    public function lists()
    {
        if (!$this->listHandler instanceof ListHandler) {
            $this->listHandler = new ListHandler($this->client);
        }
        return $this->listHandler;
    }
    
    public function messages()
    {
        if (!$this->messagesHandler instanceof MessageHandler) {
            $this->messagesHandler = new MessageHandler($this->client);
        }
        return $this->messagesHandler;
    }


   

}
