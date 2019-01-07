<?php

namespace App\Lists\Controllers;

use Core\BaseController;
use Core\Request;

class ListController extends BaseController
{
    public function index()
    {
        return $this->get('template')
            ->setup([], 'lists/index', 'Listas de Contatos')
            ->setUseLayout(true)
            ->render();
    }
    
    public function newList()
    {
        return $this->get('template')
            ->setup([], 'lists/list-new', 'Nova Lista de Contatos')
            ->setUseLayout(false)
            ->render();
    }

    public function getContactsFromListId(Request $request)
    {
        $listId = $request->getRouteParams()['id'];
        return $this->get('template')
            ->setup([ 'codeList' => $listId ], 'lists/list-contacts', 'Listas de Contatos')
            ->setUseLayout(false)
            ->render();
    }

}
