<?php
namespace App\Http;

use Closure;
use Exception;

class Route 
{
    private $url;
    private $prefix;
    private $routes = [];
    private $request;

    public function __construct($url)
    {
        $this->request  = new Request;
        $this->url      = $url;    
        $this->setPrefix();            
    }


    private function setPrefix()
    {
        $parseUrl = parse_url($this->url);
        $this->prefix = $parseUrl['path'] ?? '';
    }

    private function addRoute($method, $route, $params = [])
    {
        foreach ($params as $key => $value) {
            if ($value instanceof Closure) {
                unset($params[$key]);
                $params['controller'] = $value;
            }
        }
    
        $patterRoute = '/^' . str_replace('/', '\/', $route) . '$/';
        $this->routes[$patterRoute][$method] = $params;
    }

    
    public function get($route, $params = []) 
    {
        return $this->addRoute('GET', $route, $params);
    }

    public function post($route, $params = []) 
    {
        return $this->addRoute('POST', $route, $params);
    }

    private function getUri()
    {
        $uri = $this->request->getUri();
        $uri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];
        return end($uri);
    }

    private function getRoute()
    {
        $uri = $this->getUri();
        $httpMethod = $this->request->getHttpMethod();
        
        foreach ($this->routes as $pattern => $method) {
            if ( preg_match($pattern, $uri)) {
                if( isset($method[$httpMethod]) ) {
                    return $method[$httpMethod];
                }

                throw new Exception('Método não permitido', 405);
            }
        }

        throw new Exception('Página não encontrada', 404);
    }
    
    public function run()
    {
        try {
            $route = $this->getRoute();

            if (!isset($route['controller'])) throw new Exception('Erro interno', 500);
            $args = [];
            return call_user_func_array($route['controller'], $args);
            

        } catch (Exception $e) {
            return new Response($e->getCode(), $e->getMessage());
        }
    }
}