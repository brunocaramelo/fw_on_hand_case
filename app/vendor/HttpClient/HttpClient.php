<?php

namespace Vendor\HttpClient;

use Vendor\HttpClient\HttpClientException;

class HttpClient
{
    protected $ch;
    private $method ='GET';
    protected $defaultHeaders = [];
    protected $defaultOptions = [];
    private $encode = 'json';
    private $urlBase;
    private $urlResource;

    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }
    
    public function getMethod()
    {
        return strtoupper($this->method);
    }

    public function send()
    {
        $this->prepareRequest($request);

        $result = curl_exec($this->ch);

        if ($result === false) {
            $errno = curl_errno($this->ch);
            $errmsg = curl_error($this->ch);
            $msg = "cURL request failed with error [$errno]: $errmsg";
            curl_close($this->ch);
            throw new HttpClientException(json_encode([$this->getUrl(),$request, $msg, $errno]));
        }

        $this->setResponse($result);

        curl_close($this->ch);
        return $this;
    }

    public function prepareRequest()
    {
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_HEADER, true);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->ch, CURLOPT_URL, $this->getUrl());

        $options = $this->getOptions();
        if (!empty($options)) {
            curl_setopt_array($this->ch, $options);
        }

        $method = $this->getMethod();
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, $this->getMethod());
        if (!empty($this->headers)) {
            curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->formatHeaders());
        }
        if (!empty($this->data)) {
            curl_setopt($this->ch, CURLOPT_POSTFIELDS, $this->encodeData());
        }
    }
    
    public function setUrlBase($url)
    {
        $this->urlBase = $url;
        return $this;
    }

    public function getUrlBase()
    {
        return $this->urlBase;
    }
    public function setUrlResource($url)
    {
        $this->urlResource = $url;
        return $this;
    }

    public function getUrlResource()
    {
        return $this->urlResource;
    }
    
    public function getUrl()
    {
        return $this->urlBase.$this->urlResource;
    }

    public function getHeaders()
    {
        return $this->headers;
    }
    
    public function setHeader($key, $value = null)
    {
        if ($value === null) {
            list($key, $value) = explode(':', $value, 2);
        }
        $key = trim($key);
        $this->headers[$key] = trim($value);

        return $this;
    }

    public function setOption($key, $value)
    {
        $this->options[$key] = $value;
        return $this;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function encodeData()
    {
        if ($this->encoding) {
            return json_encode($this->data);
        }
        return (!is_null($this->data) ? http_build_query($this->data) : '');
    }

    public function setEncoding($encoding)
    {
        if ($encoding =='json') {
            $this->setHeader('Content-Type', 'application/json');
        }
        $this->encoding = $encoding;
        return $this;
    }

    public function formatHeaders()
    {
        $headers = [];
        if (empty($this->headers)) {
            return;
        }

        foreach ($this->headers as $key => $val) {
            $headers[] = $key . ': ' . $val;
        }
        return $headers;
    }
    
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
    
    public function getData()
    {
        return $this->data;
    }

    private function setResponse($response)
    {
        $headerSize = curl_getinfo($this->ch, CURLINFO_HEADER_SIZE);
        $this->infoReponse = curl_getinfo($this->ch);
        $this->headersReponse = substr($response, 0, $headerSize);
        $this->bodyReponse = substr($response, $headerSize);
    }

    public function getResponse()
    {
        return ['body' => $this->getBodyResponse(),
                'header'=> $this->getHeadersReponse(),
                'info'=> $this->getInfoReponse()];
    }
    
    public function getBodyResponse()
    {
        return  $this->bodyReponse;
    }

    public function getHeadersReponse()
    {
        return  $this->bodyReponse;
    }

    public function getInfoReponse()
    {
        return  $this->infoReponse;
    }

}
