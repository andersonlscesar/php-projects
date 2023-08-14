<?php
use App\Http\Response;
use App\Controller\Api;

$route->get('/api/v1', [
    fn($request) => new Response(200, Api\Api::details($request), 'application/json')
]);