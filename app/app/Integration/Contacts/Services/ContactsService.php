<?php

namespace App\Integration\Contacts\Services;

use Core\RequestApi;
use Vendor\ApiCommunicator\Client\Communicator;
use App\Integration\Contacts\Resources\In\ContactsListResource;

class ContactsService
{
    private $container;

    public function __construct(\Core\Container $container)
    {
        $this->container = $container;
    }

    public function getByList(array $list)
    {
        $resultInteg = (new Communicator())
                       ->contacts()
                       ->findByListMail($list)
                       ->get()
                       ->getResponse()
                       ->toArray();

        $resource = new ContactsListResource($resultInteg['result']);
        return $resource->toArray();
    }
}
