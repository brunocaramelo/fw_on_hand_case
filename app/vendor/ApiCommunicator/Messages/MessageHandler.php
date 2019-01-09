<?php

namespace Vendor\ApiCommunicator\Messages;

use Vendor\ApiCommunicator\Abstracts\HandlerAbstract;
use Vendor\ApiCommunicator\Client\Client;

class MessageHandler extends HandlerAbstract
{
    private $listContact;
   
    public function add(array $data)
    {
        $this->listContact[] = $data;
        return $this;
    }

    public function create($data)
    {
        $this->client->getApiClient()
            ->setUrlResource('mensagem/salvar')
            ->setEncoding('json')
            ->setMethod('PUT')
            ->setData($data);
        return $this->get();
    }
    
    public function sendMessage($codeMessage, $data)
    {
        $this->client->getApiClient()
            ->setUrlResource('envio/cod/'.$codeMessage)
            ->setEncoding('json')
            ->setMethod('PUT')
            ->setData($data);
        return $this->get();
    }

    public function getResult($codeMessage)
    {
        $this->client->getApiClient()
            ->setUrlResource('resultado/cod/'.$codeMessage)
            ->setEncoding('json')
            ->setMethod('GET');
        return $this;
    }

    public function get()
    {
        return $this->client->send();
    }

}