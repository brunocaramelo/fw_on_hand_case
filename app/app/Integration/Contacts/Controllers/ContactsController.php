<?php

namespace App\Integration\Contacts\Controllers;

use App\Integration\Contacts\Services\ContactsService;
use Vendor\HttpClient\HttpResponseException;

class ContactsController
{
    private $container;
    private $contactService;

    public function __construct(\Core\Container $container)
    {
        $this->container = $container;
        $this->contactService = new ContactsService($container);
    }

    public function listContacts()
    {
       
        $lista = ['emaildois@exemplo.com','emailtres@exemplo.com','email@exemplo.com'];
        try {
            $response = $this->container->get('response');
            $responseApi = $this->contactService->getByList($lista);
            $response->json($responseApi);
        } catch(HttpResponseException $error) {
            $response->json(['error'=>$error->getMessage()], $error->getCode());
        }
    }
    
    public function getContactByCode(Request $request)
    {
        try {
            $code = $request->getRouteParams()['code'];
           
            $responseApi = $this->contactService->getByCode($code);
            $response = $this->container->get('response');
            $response->json($responseApi);
        } catch(HttpResponseException $error) {
            $response->json(['error'=>$error->getMessage()], $error->getCode());
        }
    }
}
