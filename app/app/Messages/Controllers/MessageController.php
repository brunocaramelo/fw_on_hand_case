<?php

namespace App\Messages\Controllers;

use Core\BaseController;
use Core\Request;

class MessageController extends BaseController
{
    public function index()
    {
        return $this->get('template')
            ->setup([], 'messages/index', 'Listas de Mensagens')
            ->setUseLayout(true)
            ->render();
    }
    
    public function newMessage()
    {
        return $this->get('template')
            ->setup([], 'messages/list-new', 'Nova Mensagem')
            ->setUseLayout(false)
            ->render();
    }
    
    public function editMessage(Request $request)
    {
        $code = $request->getRouteParams('code');
        return $this->get('template')
            ->setup([ 'code'=> $code ], 'messages/edit', 'Editar Mensagem')
            ->setUseLayout(false)
            ->render();
    }

    public function sendMessage(Request $request)
    {
        $code = $request->getRouteParams('code');
        return $this->get('template')
            ->setup([ 'code'=> $code ], 'messages/send-message', 'Enviar Mensagem')
            ->setUseLayout(false)
            ->render();
    }

    public function showResults(Request $request)
    {
        $code = $request->getRouteParams('code');
        return $this->get('template')
            ->setup([ 'code'=> $code ], 'messages/show-result', 'Enviar Mensagem')
            ->setUseLayout(false)
            ->render();
    }
}
