<?php

namespace App\Integration\Lists\Services;

use Core\RequestApi;
use Vendor\ApiCommunicator\Client\Communicator;
use App\Integration\Lists\Resources\In\ListListResource;
use App\Integration\Lists\Resources\In\ListItemResource;

class ListsService
{
    
    public function getAll()
    {
        $resultInteg = $this->getResource()
                       ->findAll()
                       ->get()
                       ->getResponse()
                       ->toArray();

        $resource = new ListListResource($resultInteg['result']);
        return $resource->toArray();
    }
    
    public function createList($params)
    {
        $params = [ 'nome'=> $params['name'] ];
        $resultInteg = $this->getResource()
                       ->create($params)
                       ->get()
                       ->getResponse()
                       ->toArray();
       
        $resource = new ListItemResource($resultInteg['result']);
        return $resource->toArray();
    }
    
    private function getResource()
    {
        return (new Communicator())->lists();
    }
    
}
