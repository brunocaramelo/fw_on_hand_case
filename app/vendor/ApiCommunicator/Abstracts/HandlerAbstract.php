<?php

namespace Vendor\ApiCommunicator\Abstracts;

use Vendor\ApiCommunicator\Client\Client;

abstract class HandlerAbstract
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
