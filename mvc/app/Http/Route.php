<?php
namespace App\Http;

use Closure;
use Exception;
use ReflectionFunction;

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

        $params['variables'] = [];
        $patternVariables = '/{(.*?)}/';

        if (preg_match_all($patternVariables, $route, $matches)) {
            $route = preg_replace($patternVariables, '(.*?)', $route);
            $params['variables'] = $matches[1];
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
            if ( preg_match($pattern, $uri, $matches)) {
                if( isset($method[$httpMethod]) ) {
                    unset($matches[0]);
                    $keys = $method[$httpMethod]['variables'];
                    $method[$httpMethod]['variables'] = array_combine($keys, $matches);
                    $method[$httpMethod]['variables']['request'] = $this->request;
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
            $reflection = new ReflectionFunction($route['controller']);

            foreach ($reflection->getParameters() as $parameter) {
                $name = $parameter->getName();
                $args[$name] = $route['variables'][$name] ?? [];
            }
            return call_user_func_array($route['controller'], $args);
            

        } catch (Exception $e) {
            return new Response($e->getCode(), $e->getMessage());
        }
    }
}