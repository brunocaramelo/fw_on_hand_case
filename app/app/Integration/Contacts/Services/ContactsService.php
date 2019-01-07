<?php

namespace App\Integration\Contacts\Services;

use Core\RequestApi;
use Vendor\ApiCommunicator\Client\Communicator;
use App\Integration\Contacts\Resources\In\ContactsListResource;
use App\Contacts\Repositories\ContactsRepository;

class ContactsService
{
    private $contactRepository;

    public function __construct(ContactsRepository $repository)
    {
        $this->contactRepository = $repository;
    }

    public function getByList(array $list)
    {
        $resultInteg =  $this->getResource()
                       ->findByListMail($list)
                       ->get()
                       ->getResponse()
                       ->toArray();

        $resource = new ContactsListResource($resultInteg['result']);
        return $resource->toArray();
    }

    public function getAllContactsByList($code)
    {
        $emailList = [];
        $all = $this->contactRepository->getAllByList($code);
        foreach ($all as $item) {
            $emailList[] = $item->email;
        }
        return $this->getByList($emailList);
    }

    private function getResource()
    {
        return (new Communicator())->contacts();
    }
}
