<?php 
require_once __DIR__ . '/vendor/autoload.php';

use App\Http\Route;
use App\Utils\View;
use App\Environment\Environment;

Environment::load(__DIR__ . '/.env');

define('URL', 'http://localhost/php-projects/mvc');



View::init([
    'URL'   => URL
]);

$route = new Route(URL);

include_once __DIR__ . '/routes/web.php';

$route->run()->sendResponse();