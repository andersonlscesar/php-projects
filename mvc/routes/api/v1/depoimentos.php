<?php
use App\Http\Response;
use App\Controller\Api;

$route->get('/api/v1/depoimentos', [
    'middlewares' => ['api'],
    fn($request) => new Response(200, Api\Depoimento::index($request), 'application/json')
]);

$route->get('/api/v1/depoimentos/{id}', [
    'middlewares' => ['api'],
    fn($request, $id) => new Response(200, Api\Depoimento::getDepoimento($request, $id), 'application/json')
]);