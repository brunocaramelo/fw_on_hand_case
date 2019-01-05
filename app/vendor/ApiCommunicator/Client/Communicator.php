<?php

namespace Vendor\ApiCommunicator\Client;

use Vendor\ApiCommunicator\Client\Client;

class Communicator
{
    private $consumerKey;
    private $consumerSecret;
    private $consumerToken;
    private $consumerTokenSecret;
    private $client;

    public function __construct()
    {
        $this->consumerKey = getenv('API_CONSUMER_KEY');
        $this->consumerSecret = getenv('API_CONSUMER_SECRET');
        $this->consumerToken = getenv('API_TOKEN');
        $this->consumerTokenSecret = getenv('API_TOKEN_SECRET');
        
        $this->client = new Client(
            $this->consumerKey,
            $this->consumerSecret,
            $this->consumerToken,
            $this->consumerTokenSecret
        );
                   
    }

   

}
