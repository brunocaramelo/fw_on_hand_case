<?php

namespace App\Integration\Contacts\Controllers;

use App\Integration\Contacts\Services\ContactsService;
use Vendor\HttpClient\HttpResponseException;
use App\Contacts\Repositories\ContactsRepository;
use Core\RequestApi as Request;


class ContactsController
{
    private $container;
    private $response;
    private $contactService;

    public function __construct(\Core\Container $container)
    {
        $this->container = $container;
        $this->response = $this->container->get('response');
        $this->contactService = new ContactsService(
            new ContactsRepository($container->get('connection')),
            $this->container->get('auth')
        );
    }

    public function listContacts(Request $request)
    {
        try {
            $code = $request->getRouteParams()['code'];
            $responseApi = $this->contactService->getAllContactsByList($code);
            return $this->response->json([ 'data' => $responseApi ]);
        } catch (HttpResponseException $error) {
            return $this->response->json(['error'=>$error->getMessage()], $error->getCode());
        }
    }
    
    public function getContactByCode(Request $request)
    {
        try {
            $code = $request->getRouteParams()['code'];
           
            $responseApi = $this->contactService->getByCode($code);
            return $this->response->json([ 'data' => $responseApi ]);
        } catch (HttpResponseException $error) {
            return $this->response->json(['error'=>$error->getMessage()], $error->getCode());
        }
    }

    public function createContact(Request $request)
    {
        try {
            $data = $request->getBodyToArray();

            $responseApi = $this->contactService->create($data);
            return $this->response->json([ 'data' => $responseApi, 'message' => 'Contato criado com sucesso' ]);
        } catch (HttpResponseException $error) {
            return $this->response->json(['error'=>$error->getMessage()], $error->getCode());
        }
    }
}
