<?php
use App\Http\Response;
use App\Controller\Admin;

$route->get('/admin/usuarios', [
    'middlewares'   => ['require-admin-login'],
    fn($request) => new Response(200, Admin\UsuarioController::index($request))
]);

$route->get('/admin/usuarios/create', [
    'middlewares'   => ['require-admin-login'],
    fn() => new Response(200, Admin\UsuarioController::create())
]);

$route->post('/admin/usuarios/create', [
    'middlewares'   => ['require-admin-login'],
    fn($request) => new Response(200, Admin\UsuarioController::store($request))
]);

$route->get('/admin/usuarios/{id}/edit', [
    'middlewares'   => ['require-admin-login'],
    fn($request, $id) => new Response(200, Admin\UsuarioController::edit($request, $id))
]);

$route->post('/admin/usuarios/{id}/edit', [
    'middlewares'   => ['require-admin-login'],
    fn($request, $id) => new Response(200, Admin\UsuarioController::update($request, $id))
]);

$route->post('/admin/usuarios/{id}/delete', [
    'middlewares'   => ['require-admin-login'],
    fn($request, $id) => new Response(200, Admin\UsuarioController::delete($request, $id))
]);



