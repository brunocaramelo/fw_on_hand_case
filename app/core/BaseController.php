<?php

namespace Core;

use Core\Container;

abstract class BaseController
{
    protected $view;
    protected $auth;
    protected $errors;
    protected $inputs;
    protected $success;
    protected $conteiner;

    public function __construct(Container $conteiner)
    {

        $this->conteiner = $conteiner;
        $this->view = new \stdClass;
        $this->auth = $this->get('auth');
        $session = $this->get('session');
        $this->setupFlashMessages($session);
    }

    public function forbiden()
    {
        $this->get('session')->set('errors', ['Sessao expirada']);
        return $this->get('redirect')->route('/login');
    }
    
    public function unautorized()
    {
        $this->get('session')->set('errors', ['Voce nao pode acessar este recurso']);
        return $this->get('redirect')->route('/');
    }
    
    public function get($conteinerName)
    {
        return $this->conteiner->get($conteinerName);
    }

    public function setupFlashMessages($session)
    {
        if ($session->get('errors')) {
            $this->errors = $session->get('errors');
            $session->destroy('errors');
        }
        if ($session->get('inputs')) {
            $this->inputs = $session->get('inputs');
            $session->destroy('inputs');
        }
        if ($session->get('success')) {
            $this->success = $session->get('success');
            $session->destroy('success');
        }
    }
}
