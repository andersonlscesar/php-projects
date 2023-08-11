<?php
use App\Controller\Admin;
use App\Http\Response;


$route->get('/admin', [
    fn() => new Response(200, 'Admin')
]);

$route->get('/admin/login', [
    fn($request) => new Response(200, Admin\LoginController::index($request) )
]);

$route->post('/admin/login', [
    fn($request) => new Response(200, Admin\LoginController::login($request))
]);





