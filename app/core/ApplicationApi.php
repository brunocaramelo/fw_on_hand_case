<?php

namespace Core;

use Core\DataBase;
use Core\AuthApi;
use Core\RequestApi;
use Core\Response;
use Core\Container;

class ApplicationApi
{
    private $dependences = [];
    private $setedSetup = false;
    
    public function __construct(array $dependences)
    {
        $this->dependences = $dependences;
    }

    private function makeDefaultApplication()
    {
        $requestApi = new RequestApi();
        $databaseInstance = (new DataBase)->getConnection();
        $authInjetc = new AuthApi($requestApi->getBearerToken(), $databaseInstance);
        
        $conteiner  = new Container();
        $conteiner->register('connection', $databaseInstance)
                  ->register('request', $requestApi)
                  ->register('response', new Response())
                  ->register('auth', $authInjetc);
                  
        
        $routes = require_once __DIR__ . "/../app/api.php";
        new \Core\RouteApi($routes, $conteiner);
    }

    public function run()
    {
        if ($this->setedSetup === false) {
            $this->makeDefaultApplication();
        }
    }
}
