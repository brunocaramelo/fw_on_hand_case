<?php

namespace Core;

class RequestApi
{
    private $headers;
    private $body;
    private $routeParams;
    
    public function getHeaders()
    {
        $headers = array();
        foreach ($_SERVER as $key => $value) {
            if (substr($key, 0, 5) <> 'HTTP_') {
                continue;
            }
            $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
            $headers[$header] = $value;
        }
        return $this->headers = $headers;
    }

    public function getBody()
    {
        return $this->body = file_get_contents('php://input');
    }

    public function getBodyToArray()
    {
        return json_decode($this->getBody(), true);
    }

    public function getAuthorizationHeader()
    {
        $headers = null;

        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            /*
             * Server-side fix for bug in old Android versions (a nice side-effect of this
             * fix means we don't care about capitalization for Authorization)
             */
            $requestHeaders = array_combine(
                array_map(
                    'ucwords',
                    array_keys($requestHeaders)
                ),
                array_values($requestHeaders)
            );

            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }

        return $headers;
    }

    public function getBearerToken()
    {
        $headers = $this->getAuthorizationHeader();
        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
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
