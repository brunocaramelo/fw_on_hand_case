<?php

namespace Core;

class Request
{
    protected $routeParams;

    public function getRequest()
    {
        $objPost = $this->getPost();
        $objGet = $this->getGet();

        $obRequest = (object) array_merge((array)$objGet, (array)$objPost);

        return $obRequest;
    }

    public function getPost()
    {
        $obj = new \stdClass();
        $objPost = new \stdClass();
        
        foreach ($_POST as $key => $value) {
            $obj->$key = $value;
        }
        
        $objPost->post = $obj;
        
        return $objPost;
    }
    
    public function getGet()
    {
        $obj = new \stdClass();
        $objGet = new \stdClass();
        
        foreach ($_GET as $key => $value) {
            if (!empty($obj->get->$key)) {
                $obj->get->$key = $value;
            }
        }

        $objGet->get = $obj;
       
        return $objGet;
    }

    public function setRouteParams($routeParams)
    {
        $this->routeParams = $routeParams;
    }

    public function getRouteParams()
    {
        return $this->routeParams;
    }
    

}