<?php

namespace App\Http\Middleware;

use App\Session\Admin\Login;

class RequireAdminLogin
{
    public static function handle($request, $next)
    {
        if (!Login::isLogged()) $request->getRoute()->redirect('/admin/login');
        return $next($request);
    }
}