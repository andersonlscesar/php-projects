<?php
use App\Controller\Pages;
use App\Http\Response;

$route->get('/', [
    fn() => new Response(200, Pages\HomeController::index())
]);

$route->get('/sobre', [
    fn() => new Response(200, Pages\SobreController::index())
]);