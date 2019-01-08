<?php

namespace Vendor\ApiCommunicator\Contacts;

use Vendor\ApiCommunicator\Abstracts\HandlerAbstract;
use Vendor\ApiCommunicator\Client\Client;

class ContactHandler extends HandlerAbstract
{
    private $listContact;
    private $query;

    public function add(array $data)
    {
        $this->listContact[] = $data;
        return $this;
    }

    public function create($data)
    {
        $this->client->getApiClient()
            ->setUrlResource('contato/salvar')
            ->setEncoding('json')
            ->setMethod('PUT')
            ->setData($data);
        return $this->get();
    }
    
    public function findByCode($codeContact)
    {
        $this->query = $this->client->getApiClient()
            ->setUrlResource('contato/cod/'.$codeContact)
            ->setMethod('GET');
        return $this;
    }

    public function findByListMail(array $listMail)
    {
        $emailList = ['email' => http_build_query($listMail, '', '&')];
        $this->query = $this->client->getApiClient()
            ->setUrlResource('contato/fetch')
            ->setMethod('POST')
            ->setData($emailList);
        return $this;
    }
    
    public function get()
    {
        return $this->client->send();
    }

}



