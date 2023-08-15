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
    public  $user;


    public function __construct($route)
    {
        $this->queryParams  = $_GET ?? [];        
        $this->headers      = getallheaders();
        $this->httpMethod   = $_SERVER['REQUEST_METHOD'] ?? '';        
        $this->route        = $route;
        $this->setUri();
        $this->setPostVars();
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


    private function setPostVars()
    {
        if ($this->httpMethod == 'GET') return false;
        $this->postVars = $_POST ?? [];
        $inputRaw = file_get_contents('php://input');
        $this->postVars = (strlen($inputRaw) && empty($_POST)) ? json_decode($inputRaw, true) : $this->postVars;
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