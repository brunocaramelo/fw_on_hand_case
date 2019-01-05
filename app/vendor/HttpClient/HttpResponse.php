<?php

namespace Vendor\HttpClient;

class HttpResponse
{
    private $headers;
    private $body;
    private $info;

    public function __construct($headers, $body, $info)
    {
        $this->headers = $this->formatHeaders($headers);
        $this->body = $body;
        $this->info = $info;
    }
    
    public function toJson()
    {
        if ($this->isJson($this->body) === true) {
            return $this->__toString();
        }
        return json_encode($this->body);
    }
    
    public function toJsonDecode()
    {
        if ($this->isJson($this->body) === true) {
            return json_decode($this->body);
        }
        return $this->__toString();
    }

    public function toArray()
    {
        if ($this->isJson($this->body) === true) {
            return json_decode($this->body, 1);
        }
        return $this->__toString();
    }

    public function __toString()
    {
        return $this->body;
    }
    
    private function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    public function getInfo()
    {
        return $this->info;
    }
    
    public function getHeaders()
    {
        return $this->headers;
    }

    public function formatHeaders($headersParam)
    {
        $headers = [];
        foreach (explode(PHP_EOL, $headersParam) as $val) {
            if (empty(trim($val))) {
                continue;
            }
            $headers[] = $val;
        }
        return $headers;
    }
}

