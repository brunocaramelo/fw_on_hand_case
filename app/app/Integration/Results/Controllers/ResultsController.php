<?php

namespace App\Integration\Results\Controllers;

use Core\RequestApi;
use Vendor\ApiCommunicator\Client\Communicator;

use App\Integration\Results\Services\ResultService;
use Vendor\HttpClient\HttpResponseException;

class ResultsController
{
    private $container;

    public function __construct(\Core\Container $container)
    {
        $this->container = $container;
        $this->response = $this->container->get('response');
        $this->messageService = new ResultService();
    }

    public function showResults(RequestApi $request)
    {
        try {
            $code = $request->getRouteParams()['code'];
           
            $responseApi = $this->messageService->getResultsByCode($code);
            return $this->response->json([ 'data' => $responseApi ]);
        } catch (HttpResponseException $error) {
            return $this->response->json(['error'=>$error->getMessage()], $error->getCode());
        }
    }
}
