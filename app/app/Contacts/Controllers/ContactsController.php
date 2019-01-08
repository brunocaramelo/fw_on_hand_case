<?php

namespace App\Contacts\Controllers;

use Core\BaseController;
use Core\Request;

class ContactsController extends BaseController
{
    public function createContactsFromListId(Request $request)
    {
        $listId = $request->getRouteParams()['id'];
        return $this->get('template')
            ->setup([ 'codeList' => $listId ],'contacts/new-contact', 'Criar de Contatos')
            ->setUseLayout(false)
            ->render();
    }

    public function getContactsFromListId(Request $request)
    {
        $listId = $request->getRouteParams()['id'];
        return $this->get('template')
            ->setup([ 'codeList' => $listId ], 'contacts/list-contacts', 'Listas de Contatos')
            ->setUseLayout(false)
            ->render();
    }
}