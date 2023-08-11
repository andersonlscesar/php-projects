<?php
namespace App\Session\Admin;


class Login 
{

    /**
     * Inicia a sessão
     */

    private static function init()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();       
    }

    /**
     * @param Usuario $usuario
     * @return boolean
     */

    public static function login($usuario)
    {
        self::init();
        $_SESSION['admin']['usuario'] = [
            'id'    => $usuario->id,
            'nome'  => $usuario->nome,
            'email' => $usuario->email
        ];
        return true;
    }


    public static function isLogged()
    {
        self::init();

        return isset($_SESSION['admin']['usuario']['id']);
    }

    public static function logout()
    {
        self::init();
        unset($_SESSION['admin']['usuario']);
        session_unset();
        session_destroy();
        return true;
    }
}