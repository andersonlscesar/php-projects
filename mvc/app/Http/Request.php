<?php
namespace App\Http;

class Request
{
    private $httpMethod;
    private $uri;
    private $queryParams = [];
    private $postVars = [];
    private $headers = [];
    private Route $route;


    public function __construct($route)
    {
        $this->queryParams  = $_GET ?? [];
        $this->postVars     = $_POST ?? [];
        $this->headers      = getallheaders();
        $this->httpMethod   = $_SERVER['REQUEST_METHOD'] ?? '';        
        $this->route        = $route;
        $this->setUri();
    }

    private function setUri()
    {
        $this->uri = $_SERVER['REQUEST_URI'] ?? '';
        //Remove gets
        $uriWithoutGets = explode('?', $this->uri);
        $this->uri = $uriWithoutGets[0];
    }

    public function getRoute()
    {
        return $this->route;
    }


    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getQueryParams()
    {
        return $this->queryParams;
    }

    public function getPostVars()
    {
        return $this->postVars;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

}