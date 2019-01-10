<?php

namespace Vendor\ApiCommunicator\Client;

use Vendor\ApiCommunicator\OAuth\OAuthBuilder;
use Vendor\HttpClient\HttpClient;
use Core\ConfigParser;

class Client
{
    private $consumerKey;
    private $consumerSecret;
    private $consumerToken;
    private $consumerTokenSecret;
    private $baseUrl;
    public $client;

    public function __construct(
        $consumerKey,
        $consumerSecret,
        $consumerToken,
        $consumerTokenSecret
    ) {
        $config = (new ConfigParser())->get('integration');
        
        $this->baseUrl = $config['api_base_url'];
        $this->consumerKey = $consumerKey;
        $this->consumerSecret = $consumerSecret;
        $this->consumerToken = $consumerToken;
        $this->consumerTokenSecret = $consumerTokenSecret;

        $this->client = (new HttpClient())
            ->setUrlBase($this->baseUrl);
    }
    
    protected function setOauthRequestHeaders(HttpClient $client)
    {
        $oauth = new OAuthBuilder(
            $this->consumerKey,
            $this->consumerSecret,
            $this->consumerToken,
            $this->consumerTokenSecret,
            $client
        );

        $oauth->build();
      
        $this->client->setHeader('Accept', 'application/json');
        $this->client->setHeader('Expect', '');
        $this->client->setHeader('Authorization', $oauth->__toString());
    }

    public function send()
    {
        $this->setOauthRequestHeaders($this->client);
        return $this->client->send();
    }

    public function getApiClient()
    {
        return $this->client;
    }

}
