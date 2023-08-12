<?php

namespace App\Controller\Admin;

use App\Http\Request;
use App\Utils\View;
use App\Controller\Traits\UsuarioTrait;
use App\Model\Usuario;

class UsuarioController extends Controller
{
    use UsuarioTrait;

    /**
     * Retorna o conteúdo da página principal
     * @return string
     */

    public static function index($request): string
    {

        $content = View::render('admin/modules/usuario/index', [
            'usuario' => empty(self::selectAllUsers($request, $paginator)) ? 'Ainda não há usuários' : self::selectAllUsers($request, $paginator),
            'pagination'    => $paginator->paginate($request)
        ]);
        return parent::renderPanel('Usuários', $content, 'usuarios');
    }

    /**

     * Exibe o formulário de cadastro de depoimento*/
    public static function create()
    {
        $content = View::render('admin/modules/usuario/form', [
            'title'     => 'Cadastrar usuário',
            'nome'      => '',
            'email'     => '',
            'btn_title' => 'Cadastrar'
        ]);

        return parent::renderPanel('Usuarios', $content, 'usuarios');
    }

    /**
     * Armazena os dados no banco
     * @param Request $request
    */

    public static function store( Request $request )
    {
        $post = $request->getPostVars();
        $nome    = $post['nome'] ?? '';
        $email   = $post['email'] ?? '';
        $senha   = $post['senha'] ?? '';
        $usuario = new Usuario();
        $usuario->nome = $nome;
        $usuario->email = $email;
        $usuario->senha = password_hash($senha, PASSWORD_DEFAULT) ;
        $usuario->insert();
        $request->getRoute()->redirect('/admin/usuarios/' . $usuario->id . '/edit?status=created');
        return true;
    }


    public static function edit($request, $id)
    {
        $usuario = Usuario::get('id = ' . $id );
        $content = View::render('admin/modules/usuario/form', [
            'title'     => 'Editar usuário',
            'nome'      => $usuario->nome,
            'email'     => $usuario->email,
            'btn_title' => 'Atualizar'
        ]);
        return parent::renderPanel('Usuário - ' . $usuario->nome, $content, 'usuarios');
    }

    public static function update($request, $id)
    {
        $post = $request->getPostVars();
        $usuario = Usuario::get('id = ' . $id );
        $nome       = $post['nome'] ?? $usuario->nome;
        $email      = $post['email'] ?? $usuario->email;
        $senha      = password_hash($post['senha'], PASSWORD_DEFAULT)  ?? $usuario->senha;
        $usuario->nome = $nome;
        $usuario->email = $email;
        $usuario->senha = $senha;
        $usuario->update();
        $request->getRoute()->redirect('/admin/usuarios/' . $usuario->id . '/edit?status=updated');
        return true;
    }

    public static function delete($request, $id)
    {
        $usuario = Usuario::get('id = ' . $id);
        $obs = new Usuario();
        $obs->delete($usuario);
        $request->getRoute()->redirect('/admin/usuarios?status=deleted');
        return true;
    }


}