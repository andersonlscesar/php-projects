<?php
namespace App\Http\Middleware;

class Queue
{
    private $middlewares = []; // Fila de middlewares a serem executados
    private $controller; // A função Closure
    private $controllerArgs = [];// Os possíveis argumentos da closure
    private static $map = []; // Mapeamento de middlewares
    private static $default = []; // Mapeamento de middlewares para todas as rotas


    public function __construct($middlewares, $controller, $controllerArgs)
    {
        $this->middlewares = array_merge(self::$default, $middlewares);
        $this->controller = $controller;
        $this->controllerArgs = $controllerArgs;
    }


    public function next($request)
    {
        if (empty($this->middlewares)) return call_user_func_array($this->controller, $this->controllerArgs);
        $middleware = array_shift($this->middlewares);
        if (!isset(self::$map[$middleware])) throw new \Exception('Problemas ao processar a requisição', 500);

        $queue = $this;
        $next = function ($request) use ($queue) {
            return $queue->next($request);
        };
        return (new self::$map[$middleware])->handle($request, $next);
    }

    public static function setMap($map)
    {
        self::$map = $map;
    }

    public static function setDefault($default)
    {
        self::$default = $default;
    }
}