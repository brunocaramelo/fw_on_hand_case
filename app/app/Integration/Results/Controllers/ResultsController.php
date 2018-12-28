<?php

namespace App\Integration\Results\Controllers;

use Core\RequestApi;

class ResultsController
{
    private $conteiner;

    public function __construct(\Core\Container $conteiner)
    {
        $this->conteiner = $conteiner;
    }

    public function showResults(RequestApi $request)
    {
        $response = $this->conteiner->get('response');
        $request->getBodyToArray();
        $response->json([
                            "foo" => "bar",
                            "bar" => "foo",
                        ]);
    }


}
