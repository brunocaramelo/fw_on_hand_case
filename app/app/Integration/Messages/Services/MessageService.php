<?php

namespace App\Integration\Messages\Services;

use Core\RequestApi;
use Vendor\ApiCommunicator\Client\Communicator;
use App\Integration\Contacts\Resources\In\ContactsListResource;
use App\Integration\Messages\Resources\Out\MessageItemResource as MessageItemExternal;
use App\Integration\Messages\Resources\In\MessageItemResource as MessageItemInternal;
use Core\AuthApi as Auth;

use App\Messages\Repositories\MessageRepository;

class MessageService
{
    private $messageRepository;
    private $auth;

    public function __construct(MessageRepository $repository, Auth $auth)
    {
        $this->messageRepository = $repository;
        $this->auth = $auth;
    }

    public function getAll()
    {
        return $this->messageRepository->getAllByUser($this->auth->getId());
    }

    public function sendMessage($data)
    {
        $data = $data['send'];
        $this->getResource()
            ->sendMessage($data['code'], ['lista' => $data['list']])
            ->getResponse()
            ->toArray();

        $this->messageRepository->setToSended($data['code']);
        
        return $data;
    }

    public function create(array $data)
    {
        
        $resourceSender = new MessageItemExternal($data['message']);
        $resourceSender = $resourceSender->toArray();
        $resourceSenderApi = $resourceSender;
      
        unset($resourceSenderApi['cod']);
        
        $resultInteg =  $this->getResource()
                        ->create($resourceSender)
                        ->getResponse()
                        ->toArray();

        $dataPersist = $data['message'];
        
        $dataPersist['code'] = $resultInteg['result'][0]['cod'];
        $dataPersist['how_create'] = $this->auth->getId();
        $dataPersist['status'] = 'pending';
        
        $this->messageRepository->create($dataPersist);
        
        return $dataPersist;
    }

    private function getResource()
    {
        return (new Communicator())->messages();
    }

}
