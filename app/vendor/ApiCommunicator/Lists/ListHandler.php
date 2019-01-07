<?php

namespace Vendor\ApiCommunicator\Lists;

use Vendor\ApiCommunicator\Abstracts\HandlerAbstract;
use Vendor\ApiCommunicator\Client\Client;

class ListHandler extends HandlerAbstract
{
    private $query;

    public function create($params)
    {
        $this->client->getApiClient()
            ->setUrlResource('lista/salvar')
            ->setMethod('POST')
            ->setData($params);
        return $this;
    }
    
    public function findByCode($codeContact)
    {
        $this->query = $this->client->getApiClient()
            ->setUrlResource('lista/cod/'.$codeContact)
            ->setMethod('GET');
        return $this;
    }

    public function findAll()
    {
        $this->query = $this->client->getApiClient()
            ->setUrlResource('lista/all')
            ->setMethod('GET');
        return $this;
    }
    
    public function get()
    {
        return $this->client->send();
    }

}



