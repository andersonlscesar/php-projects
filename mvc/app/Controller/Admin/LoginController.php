<?php
namespace App\Controller\Admin;

use App\Utils\View;
use App\Model\Usuario;
use App\Session\Admin\Login;

class LoginController extends Controller
{

    /**
     * Retorna o conteúdo da página principal
     * @return string
     */

    public static function index($request): string
    {        
        $content = View::render('admin/login');
        return parent::view('Sobre', $content);
    }


    public static function login($request)
    {
        $post = $request->getPostVars();
        $email = $post['email'] ?? '';
        $senha = $post['senha'] ?? '';
        $usuario = Usuario::getUserByEmail($email);

        if (!$usuario instanceof Usuario) {
            header("Location: " . getenv('URL') . '/admin/login?status=email-incorreto');
            exit;
        }

        if (!password_verify($senha, $usuario->senha)) {
            header("Location: " . getenv('URL') . '/admin/login?status=senha-incorreta');
            exit;
        } 


        Login::login($usuario);

        $request->getRoute()->redirect('/admin');

    }
}