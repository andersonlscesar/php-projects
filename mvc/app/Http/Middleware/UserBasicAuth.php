<?php

namespace App\Http\Middleware;

use Exception;
use App\Model\Usuario;

class UserBasicAuth
{

    private function getBasicAuthUser()
    {
        //Verifica a existência das credenciais´
        if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) return false;

        //Buscando usuário por email
        $user = Usuario::getUserByEmail($_SERVER['PHP_AUTH_USER']);

        if (!$user instanceof Usuario) return false;

        //validando senha
        return password_verify($_SERVER['PHP_AUTH_PW'], $user->senha);
    }


    private function basicAuth($request)
    {
        // Verifica o usuário recebido
        if ($user = $this->getBasicAuthUser()) {
            $request->user = $user;
            return true;
        }
        throw new Exception("Usuário ou senha inválidos", 403);
    }


    public function handle($request, $next)
    {
        //Realiza a validação do acesso bia basic auth.
        $this->basicAuth($request);
        return $next($request);
    }
}
