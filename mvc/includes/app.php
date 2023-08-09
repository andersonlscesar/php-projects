<?php
require_once __DIR__ . '/../vendor/autoload.php';

date_default_timezone_set("America/Sao_Paulo");


use App\Utils\View;
use App\Environment\Environment;
use App\Http\Middleware\Queue;

Environment::load(__DIR__ . '/../.env');

define('URL', getenv('URL'));

View::init([
    'URL'   => URL
]);

// Mapeando middlewares

Queue::setMap([
    'maintenance' => App\Http\Middleware\Maintenance::class
]);

Queue::setDefault([
    'maintenance'
]);