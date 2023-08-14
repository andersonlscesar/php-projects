<?php

namespace App\Http\Middleware;

use Exception;

class Api
{
    public function handle($request, $next)
    {
        $request->getRoute()->setContentType('application/json');
        return $next($request);
    }
}
