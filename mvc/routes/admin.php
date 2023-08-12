<?php
use App\Controller\Admin;
use App\Http\Response;


$route->get('/admin', [
    'middlewares' => ['require-admin-login'],
    fn($request) => new Response(200, Admin\HomeController::index($request))
]);

$route->get('/admin/login', [
    'middlewares' => ['require-admin-logout'],
    fn($request) => new Response(200, Admin\LoginController::index($request) )
]);

$route->post('/admin/login', [
    'middlewares' => ['require-admin-logout'],
    fn($request) => new Response(200, Admin\LoginController::login($request))
]);

$route->get('/admin/logout', [
    'middlewares' => ['require-admin-login'],
    fn($request) => new Response(200, Admin\LoginController::logout($request) )
]);




