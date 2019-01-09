<?php

namespace App\Integration\Results\Services;

use Core\RequestApi;
use Vendor\ApiCommunicator\Client\Communicator;
use App\Integration\Results\Resources\In\ResultItemResource as MessageItemInternal;
use Core\AuthApi as Auth;

use App\Messages\Repositories\MessageRepository;

class ResultService
{
 
    public function getResultsByCode($code)
    {
        $resultApi = $this->getResource()
            ->getResult($code)
            ->get()
            ->getResponse()
            ->toArray();

        $resource = new MessageItemInternal($resultApi['result']['estat']);
        return $resource->toArray();
    }

    private function getResource()
    {
        return (new Communicator())->messages();
    }
}
