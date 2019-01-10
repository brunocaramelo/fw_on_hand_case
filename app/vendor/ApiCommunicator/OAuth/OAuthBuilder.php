<?php

namespace Vendor\ApiCommunicator\Oauth;

use Vendor\ApiCommunicator\Oauth\OAuthConsumer;
use Vendor\ApiCommunicator\Oauth\OAuthToken;
use Vendor\ApiCommunicator\Oauth\OAuthRequest;
use Vendor\ApiCommunicator\Oauth\OAuthSignatureMethod_HMAC_SHA1;

class OAuthBuilder
{
    private $consumerKey;
    private $consumerSecret;
    private $consumerToken;
    private $consumerTokenSecret;
    private $client;
    private $request;

    public function __construct(
        $consumerKey,
        $consumerSecret,
        $consumerToken,
        $consumerTokenSecret,
        $client
    ) {
        $this->consumerKey = $consumerKey;
        $this->consumerSecret = $consumerSecret;
        $this->consumerToken = $consumerToken;
        $this->consumerTokenSecret = $consumerTokenSecret;
        $this->client = $client;
    }

    public function build()
    {
        require __DIR__ . '/OAuth.php';
        
        $consumer = new \Vendor\ApiCommunicator\Oauth\OAuthConsumer($this->consumerKey, $this->consumerSecret);
        $token = new OAuthToken($this->consumerToken, $this->consumerTokenSecret);

        $request = OAuthRequest::from_consumer_and_token(
            $consumer,
            $token,
            $this->client->getMethod(),
            $this->client->getUrl()
        );
        
        $params = $this->client->getPostData() ?? [];
        
        foreach ($params as $name => $value) {
            $request->set_parameter($name, $value);
        }
        
        $request->sign_request(new OAuthSignatureMethod_HMAC_SHA1(), $consumer, $token);
        $this->request = $request;
    }

    public function __toString()
    {
        return $this->request->to_header();
    }

}


