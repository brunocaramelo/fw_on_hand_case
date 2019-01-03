<?php

namespace App\Integration\Results\Controllers;

use Core\RequestApi;

class ResultsController
{
    private $container;

    public function __construct(\Core\Container $container)
    {
        $this->container = $container;
    }

    public function showResults(RequestApi $request)
    {
        $response = $this->container->get('response');
        $request->getBodyToArray();
        $response->json(
            [
                "foo" => "bar",
                "bar" => "foo",
            ]
        );
    }
}
