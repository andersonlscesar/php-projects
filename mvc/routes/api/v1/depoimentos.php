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

//Rota de cadastro

$route->post('/api/v1/depoimentos', [
    'middlewares' => ['api', 'user-basic-auth'],
    fn($request) => new Response(201, Api\Depoimento::store($request), 'application/json')
]);


$route->put('/api/v1/depoimentos/{id}', [
    'middlewares' => ['api', 'user-basic-auth'],
    fn($request, $id) => new Response(200, Api\Depoimento::update($request, $id), 'application/json')
]);


$route->delete('/api/v1/depoimentos/{id}', [
    'middlewares' => ['api', 'user-basic-auth'],
    fn($id) => new Response(200, Api\Depoimento::delete($id), 'application/json')
]);