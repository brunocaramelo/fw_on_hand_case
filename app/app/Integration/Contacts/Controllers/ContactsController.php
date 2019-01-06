<?php

namespace App\Integration\Contacts\Controllers;

use App\Integration\Contacts\Services\ContactsService;

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
        $responseApi = $this->contactService->getByList($lista);
        $response = $this->container->get('response');
        $response->json($responseApi);
    }
}
