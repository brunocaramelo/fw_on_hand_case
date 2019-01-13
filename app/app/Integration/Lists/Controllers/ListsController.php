<?php

namespace App\Integration\Lists\Controllers;

use App\Integration\Lists\Services\ListsService;
use Vendor\HttpClient\HttpResponseException;
use Core\RequestApi as Request;

class ListsController
{
    private $container;
    private $response;
    private $listService;

    public function __construct(\Core\Container $container)
    {
        $this->container = $container;
        $this->response = $this->container->get('response');
        $this->listService = new ListsService();
    }

    public function getAll()
    {
        try {
            $responseApi = $this->listService->getAll();
            return $this->response->json([ 'data'=> $responseApi ]);
        } catch (HttpResponseException $error) {
            return $this->response->json(['error'=>$error->getMessage()], $error->getCode());
        }
    }

    public function createList(Request $request)
    {
        try {
            $data = $request->getBodyToArray();
            $responseApi = $this->listService->createList($data);
            return $this->response->json([ 'data'=> $responseApi, 'message' => 'Lista criada com sucesso' ]);
        } catch (HttpResponseException $error) {
            return $this->response->json(['error'=>$error->getMessage()], $error->getCode());
        }
    }
}
