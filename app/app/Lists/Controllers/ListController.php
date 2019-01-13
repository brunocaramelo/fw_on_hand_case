<?php

namespace App\Lists\Controllers;

use Core\BaseController;

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
}
