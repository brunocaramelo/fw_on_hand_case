<?php

namespace App\Integration\Contacts\Services;

use Core\RequestApi;
use Vendor\ApiCommunicator\Client\Communicator;
use App\Integration\Contacts\Resources\In\ContactsListResource;
use App\Integration\Contacts\Resources\Out\ContactsItemResource as ContactItemExternal;
use App\Integration\Contacts\Resources\In\ContactsItemResource as ContactItemInternal;

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
    public function create(array $data)
    {
        
        $resourceSender = new ContactItemExternal($data['contact']);
        $resourceSender = $resourceSender->toArray();
        $resourceSenderApi = $resourceSender;
        
        unset($resourceSenderApi['cod']);
        $resourceSenderApi['uidcli'] = uniqid();

        $listSend = [
            'lista' => $data['list'],
            'contato' => [ $resourceSenderApi ]
        ];
        
        $resultInteg =  $this->getResource()
                        ->create($listSend)
                        ->getResponse()
                        ->toArray();

        $resource = new ContactsListResource($resultInteg['result']);
        $recevedData = $resource->toArray();
        
        $recevedData['0']['free1'] = $data['contact']['free1'];
        $recevedData['0']['free2'] = $data['contact']['free2'];
        $recevedData['0']['list_cod'] = $data['list'];
        
        $this->contactRepository->create($recevedData[0]);
        
        return $recevedData;
    }

    private function getResource()
    {
        return (new Communicator())->contacts();
    }
}
