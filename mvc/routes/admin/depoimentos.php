<?php
use App\Http\Response;
use App\Controller\Admin;

$route->get('/admin/depoimentos', [
    'middlewares'   => ['require-admin-login'],
    fn($request) => new Response(200, Admin\DepoimentoController::index($request))
]);

$route->get('/admin/depoimentos/create', [
    'middlewares'   => ['require-admin-login'],
    fn() => new Response(200, Admin\DepoimentoController::create())
]);

$route->post('/admin/depoimentos/create', [
    'middlewares'   => ['require-admin-login'],
    fn($request) => new Response(200, Admin\DepoimentoController::store($request))
]);

$route->get('/admin/depoimentos/{id}/edit', [
    'middlewares'   => ['require-admin-login'],
    fn($request, $id) => new Response(200, Admin\DepoimentoController::edit($request, $id))
]);

$route->post('/admin/depoimentos/{id}/edit', [
    'middlewares'   => ['require-admin-login'],
    fn($request, $id) => new Response(200, Admin\DepoimentoController::update($request, $id))
]);

$route->post('/admin/depoimentos/{id}/delete', [
    'middlewares'   => ['require-admin-login'],
    fn($request, $id) => new Response(200, Admin\DepoimentoController::delete($request, $id))
]);



