<?php 
require_once __DIR__ . '/includes/app.php';

use App\Http\Route;

$route = new Route(URL);

include_once __DIR__ . '/routes/web.php';
include_once __DIR__ . '/routes/admin.php';
include_once __DIR__ . '/routes/api.php';

$route->run()->sendResponse();