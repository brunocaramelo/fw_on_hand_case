<?php

namespace Core;

class RouteApi
{
    private $routes;
    private $conteiner;

    public function __construct(array $routes, $conteiner)
    {
        $this->conteiner = $conteiner;
        $this->setRoutes($routes);
        $this->run();
    }

    private function setRoutes($routes)
    {
        foreach ($routes as $route){
            $explode = explode('@', $route[1]);
            $r = [$route[0], $explode[0], $explode[1]];
            if(isset($route[2])){
                $r = [$route[0], $explode[0], $explode[1], $route[2]];
            }
            if(isset($route[3])){
                $r = [$route[0], $explode[0], $explode[1], $route[2], $route[3]];
            }
            $newRoutes[] = $r;
        }
        $this->routes = $newRoutes;
    }

    private function getUrl()
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    private function run()
    {
        $url = $this->getUrl();
        $urlArray = explode('/', $url);
        
        if (in_array('api',$urlArray)===false) {
            return false;
        }

        foreach ($this->routes as $route) {
            $routeArray = explode('/', $route[0]);
            $param = $paramAlias = [];
            for ($i = 0; $i < count($routeArray); $i++) {
                if ((strpos($routeArray[$i], "{") !==false) && (count($urlArray) == count($routeArray))) {
                    $paramAlias[str_replace(['{','}'], '', $routeArray[$i]) ] = $urlArray[$i];
                    $routeArray[$i] = $urlArray[$i];
                    $param[] = $urlArray[$i];
                }
                $route[0] = implode($routeArray, '/');
            }
            if ($url == $route[0]) {
                $found = true;
                $controller = $route[1];
                $action = $route[2];
                $auth = $this->conteiner->get('auth');
                if (isset($route[3]) && $route[3] == 'auth' && $auth->check() === false) {
                    die($this->conteiner->get('response')->json(['error'=>'Token Invalido'], 401));
                }
                if (isset($route[4]) && $auth->can($route[4]) === false && $auth->check() === true ) {
                    die($this->conteiner->get('response')->json(['error'=>'Voce nao tem permissao para este recurso'], 403));
                }
                break;
            }
        }
        
        if (isset($found)) {
            $controller = new $controller($this->conteiner);
            $controller->$action($this->conteiner->get('request'));
        }

        if (!isset($found)) {
            $this->conteiner->get('response')->json(['error'=>'Recurso nao encontrado'], 404);
        }
        
    }
}