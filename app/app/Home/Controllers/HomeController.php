<?php

namespace App\Home\Controllers;

use Core\BaseController;
use Core\Request;

class HomeController extends BaseController
{
    public function index(Request $request)
    {
        return $this->get('template')
            ->setup(['errors' => $this->errors], 'home/index', 'Bem Vindo')
            ->setUseLayout(true)
            ->render();
    }

    public function home(Request $request)
    {
        $messages = [
            'errors' => $this->errors,
            'success' => $this->success,
            'inputs' => $this->inputs,
        ];

        return $this->get('template')
            ->setup($messages, 'home/index', 'Bem Vindo')
            ->setUseLayout(true)
            ->render();
    }
}
