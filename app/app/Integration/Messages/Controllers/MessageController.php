<?php

namespace App\Integration\Messages\Controllers;

use App\Integration\Messages\Services\MessageService;
use Vendor\HttpClient\HttpResponseException;
use App\Messages\Repositories\MessageRepository;
use Core\RequestApi as Request;

class MessageController
{
    private $container;
    private $response;
    private $messageService;

    public function __construct(\Core\Container $container)
    {
        $this->container = $container;
        $this->response = $this->container->get('response');
        $this->messageService = new MessageService(
            new MessageRepository($container->get('connection')),
            $this->container->get('auth')
        );
    }

    public function listMessages()
    {
        try {
            $responseApi = $this->messageService->getAll();
            return $this->response->json([ 'data' => (array) $responseApi ]);
        } catch (HttpResponseException $error) {
            return $this->response->json(['error'=>$error->getMessage()], $error->getCode());
        }
    }
    
    public function getMessageByCode(Request $request)
    {
        try {
            $code = $request->getRouteParams()['code'];
           
            $responseApi = $this->messageService->getByCode($code);
            return $this->response->json([ 'data' => $responseApi ]);
        } catch (HttpResponseException $error) {
            return $this->response->json(['error'=>$error->getMessage()], $error->getCode());
        }
    }

    public function createMessage(Request $request)
    {
        try {
            $data = $request->getBodyToArray();
            $responseApi = $this->messageService->create($data);
            return $this->response->json([ 'data' => $responseApi, 'message' => 'Mensagem criada com sucesso' ]);
        } catch (HttpResponseException $error) {
            return $this->response->json(['error'=>$error->getMessage()], $error->getCode());
        }
    }
    public function updateMessage(Request $request)
    {
        try {
            $data = $request->getBodyToArray();
            $responseApi = $this->messageService->update($data);
            return $this->response->json([ 'data' => $responseApi, 'message' => 'Mensagem editada com sucesso' ]);
        } catch (HttpResponseException $error) {
            return $this->response->json(['error'=>$error->getMessage()], $error->getCode());
        }
    }
    
    public function sendMessage(Request $request)
    {
        try {
            $data = $request->getBodyToArray();
            $responseApi = $this->messageService->sendMessage($data);
            return $this->response->json([ 'data' => $responseApi, 'message' => 'Mensagem enviada com sucesso' ]);
        } catch (HttpResponseException $error) {
            return $this->response->json(['error'=>$error->getMessage()], $error->getCode());
        }
    }
}
