<?php

namespace Core;

use Core\DataBase;
use Core\AuthApi;
use Core\RequestApi;
use Core\Response;
use Core\Container;
use Core\ConfigParser;

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
        $routes = (new ConfigParser())->get('api');
        
        $requestApi = new RequestApi();
        $databaseInstance = (new DataBase)->getConnection();
        $authInjetc = new AuthApi($requestApi->getBearerToken(), $databaseInstance);
        
        $container  = new Container();
        $container->register('connection', $databaseInstance)
                  ->register('request', $requestApi)
                  ->register('response', new Response())
                  ->register('auth', $authInjetc);
                  
        
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
