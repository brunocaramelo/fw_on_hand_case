<?php

namespace Core;

class Response
{
    public function json(array $response, $httpCode = 200)
    {
        http_response_code($httpCode);
        header('Content-Type: application/json');
        echo json_encode($response);
        return;
    }
}
