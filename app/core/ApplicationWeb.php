<?php

namespace Core;

use Core\Redirect;
use Core\DataBase;
use Core\Session;
use Core\Auth;
use Core\Request;
use Core\Container;
use Core\ViewModel;

class ApplicationWeb
{
    private $dependences = [];
    private $setedSetup = false;
    
    public function __construct(array $dependences)
    {
        $this->dependences = $dependences;
    }

    private function makeDefaultApplication()
    {
        $sessionInjetc = new Session();
        $authInjetc = new Auth($sessionInjetc);
        $templateInject = new ViewModel($authInjetc, $sessionInjetc);

        $conteiner  = new Container();
        $conteiner->register('connection', (new DataBase)->getConnection())
                  ->register('request', new Request())
                  ->register('session', $sessionInjetc)
                  ->register('redirect', new Redirect($sessionInjetc))
                  ->register('template', $templateInject)
                  ->register('auth', $authInjetc);
                  
        $routes = require_once __DIR__ . "/../app/routes.php";
        $route = new \Core\Route($routes, $conteiner);
    }

    public function run()
    {
        if ($this->setedSetup === false) {
            $this->makeDefaultApplication();
        }
    }
}
