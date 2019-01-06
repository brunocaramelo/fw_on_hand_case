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
        
        $container  = new Container();
        $container->register('connection', $databaseInstance)
                  ->register('request', $requestApi)
                  ->register('response', new Response())
                  ->register('auth', $authInjetc);
                  
        
        $routes = require_once __DIR__ . "/../config/api.php";
        $router = new \Core\RouteApi($routes, $container);
        $router->run();
        $this->isValid = $router->isValid();

    }

    public function run()
    {
        if ($this->setedSetup === false) {
            $this->makeDefaultApplication();
        }
    }

    public function isValid()
    {
        return $this->isValid;
    }

}
