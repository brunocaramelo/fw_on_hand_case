<?php

namespace Vendor\ApiCommunicator\Client;

class Client
{
    private $consumerKey;
    private $consumerSecret;
    private $consumerToken;
    private $consumerTokenSecret;
    private $baseUrl;

    public function __construct(
        $consumerKey,
        $consumerSecret,
        $consumerToken,
        $consumerTokenSecret
    ) {
        $this->consumerKey = $consumerKey;
        $this->consumerSecret = $consumerSecret;
        $this->consumerToken = $consumerToken;
        $this->consumerTokenSecret = $consumerTokenSecret;
        $this->baseUrl = getenv('API_BASE_URL');
    }

}
