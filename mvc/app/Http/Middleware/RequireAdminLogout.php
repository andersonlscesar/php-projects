<?php

namespace App\Http\Middleware;

use App\Session\Admin\Login;

class RequireAdminLogout
{
    public static function handle($request, $next)
    {
        if (Login::isLogged()) $request->getRoute()->redirect('/admin');
        return $next($request);
    }
}