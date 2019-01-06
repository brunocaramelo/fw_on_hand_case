<?php

namespace Vendor\ApiCommunicator\Client;

use Vendor\ApiCommunicator\Oauth\OAuthConsumer;
use Vendor\ApiCommunicator\Oauth\OAuthToken;
use Vendor\ApiCommunicator\Oauth\OAuthRequest;
use Vendor\ApiCommunicator\Oauth\OAuthSignatureMethod_HMAC_SHA1;

use Vendor\HttpClient\HttpClient;
use Core\ConfigParser;

class Client
{
    private $consumerKey;
    private $consumerSecret;
    private $consumerToken;
    private $consumerTokenSecret;
    private $baseUrl;
    public $client;

    public function __construct(
        $consumerKey,
        $consumerSecret,
        $consumerToken,
        $consumerTokenSecret
    ) {
        $config = (new ConfigParser())->get('integration');
        
        $this->baseUrl = $config['api_base_url'];
        $this->consumerKey = $consumerKey;
        $this->consumerSecret = $consumerSecret;
        $this->consumerToken = $consumerToken;
        $this->consumerTokenSecret = $consumerTokenSecret;

        $this->client = (new HttpClient())
            ->setUrlBase($this->baseUrl);
        
        //     $this->client = (new HttpClient())
        //     ->setUrlBase($this->baseUrl)
        //     ->setUrlResource('resultado/cod/2')
        //     ->setEncoding('json');
            
        // $this->setOauthRequestHeaders($this->client);
        
        // $this->client = (new HttpClient())
        //     ->setUrlBase($this->baseUrl)
        //     ->setUrlResource('lista/salvar')
        //     ->setMethod('POST')
        //     ->setData(['nome' => 'Olha lista vindo da api oi','uidcli'=> uniqid()]);
        // $this->setOauthRequestHeaders($this->client);
        
        // $arrMensagem = [
        //    'uidcli' => 9887,
        //     'cod' => 0,
        //     'remetente' => [
        //         'nome' => 'Meu remetente',
        //         'email' => 'marketing@meusite.com.br'
        //     ],
        //     'pasta' => 'Pasta padrao',
        //    'mensagem' => [
        //         'ganalytics' => 'CampanhaAPI',
        //         'assunto'    => 'TESTE API Acentos a ' . time(),
        //         'html'       => 'Corpo da mensagem',
        //         'texto'      => 'Mensagem em TXT'
        //     ]
        // ];
        
        // $this->client = (new HttpClient())
        //     ->setUrlBase($this->baseUrl)
        //     ->setUrlResource('mensagem/salvar')
        //     ->setEncoding('json')
        //     ->setMethod('PUT')
        //     ->setData($arrMensagem);
        // $this->setOauthRequestHeaders($this->client);

        // $this->client->send();
        
        // die(
        //     print_r(
        //         ['<pre>',
        //                 $this->client->getResponse()->getHeaders(),
        //                 $this->client->getResponse()->getInfo(),
        //                 $this->client->getResponse()->toArray(),
        //                 ])
        //     );
    }
    
    protected function setOauthRequestHeaders(HttpClient $client)
    {
        require __DIR__ . '/../OAuth/OAuth.php';
        
        $consumer = new \Vendor\ApiCommunicator\Oauth\OAuthConsumer($this->consumerKey, $this->consumerSecret);
        $token = new OAuthToken($this->consumerToken, $this->consumerTokenSecret);

        $request = OAuthRequest::from_consumer_and_token($consumer, $token, $client->getMethod(), $client->getUrl());
        
        $params = $client->getPostData() ?? [];
       
        foreach ($params as $name => $value) {
            $request->set_parameter($name, $value);
        }

        $request->sign_request(new OAuthSignatureMethod_HMAC_SHA1(), $consumer, $token);
        $this->client->setHeader('Accept', 'application/json');
        $this->client->setHeader('Expect', '');
        $this->client->setHeader('Authorization', $request->to_header());
        
        return $request->to_header();
    }

    public function send()
    {
        $this->setOauthRequestHeaders($this->client);
        return $this->client->send();
    }

    public function getApiClient()
    {
        return $this->client;
    }

}