<?php
use App\Http\Response;
use App\Controller\Api;

$route->get('/api/v1/usuarios', [
    'middlewares' => ['api'],
    fn($request) => new Response(200, Api\Usuario::index($request), 'application/json')
]);

$route->get('/api/v1/usuarios/{id}', [
    'middlewares' => ['api'],
    fn($request, $id) => new Response(200, Api\Usuario::getUsuario($request, $id), 'application/json')
]);

//Rota de cadastro

$route->post('/api/v1/usuarios', [
    'middlewares' => ['api', 'user-basic-auth'],
    fn($request) => new Response(201, Api\Usuario::store($request), 'application/json')
]);


$route->put('/api/v1/usuarios/{id}', [
    'middlewares' => ['api', 'user-basic-auth'],
    fn($request, $id) => new Response(200, Api\Usuario::update($request, $id), 'application/json')
]);


$route->delete('/api/v1/usuarios/{id}', [
    'middlewares' => ['api', 'user-basic-auth'],
    fn($id) => new Response(200, Api\Usuario::delete($id), 'application/json')
]);