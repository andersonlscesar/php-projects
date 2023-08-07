<?php
require_once __DIR__ . '/../vendor/autoload.php';


use App\Utils\View;
use App\Environment\Environment;

Environment::load(__DIR__ . '/../.env');

define('URL', getenv('URL'));

View::init([
    'URL'   => URL
]);