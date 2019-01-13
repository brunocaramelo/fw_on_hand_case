<?php

namespace App\Integration\Contacts\Services;

use Core\RequestApi;
use Vendor\ApiCommunicator\Client\Communicator;
use App\Integration\Contacts\Resources\In\ContactsListResource;
use App\Integration\Contacts\Resources\Out\ContactsItemResource as ContactItemExternal;
use App\Integration\Contacts\Resources\Out\ContactsItemCompleteResource as ContactItemCompleteExternal;
use App\Integration\Contacts\Resources\In\ContactsItemResource as ContactItemInternal;
use Core\AuthApi as Auth;

use App\Contacts\Repositories\ContactsRepository;

class ContactsService
{
    private $contactRepository;
    private $auth;

    public function __construct(ContactsRepository $repository, Auth $auth)
    {
        $this->contactRepository = $repository;
        $this->auth = $auth;
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

    public function getByCode($code)
    {
        return  $this->contactRepository->getByCode($code);
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
        
        $recevedData[0]['free1'] = $data['contact']['free1'];
        $recevedData[0]['free2'] = $data['contact']['free2'];
        $recevedData[0]['list_cod'] = $data['list'];
        $recevedData[0]['how_create'] = $this->auth->getId();
        
        $this->contactRepository->create($recevedData[0]);
        
        return $recevedData[0];
    }

    public function update(array $data)
    {
        
        $resourceSender = new ContactItemCompleteExternal($data['contact']);
        $resourceSender = $resourceSender->toArray();
        $resourceSenderApi = $resourceSender;
        
        $listSend = [
            'lista' => $data['contact']['list'],
            'contato' => [ $resourceSenderApi ]
        ];
        
        $this->getResource()
            ->create($listSend)
            ->getResponse()
            ->toArray();

        $this->contactRepository->update($data);
        
        return $data;
    }

    private function getResource()
    {
        return (new Communicator())->contacts();
    }
}
