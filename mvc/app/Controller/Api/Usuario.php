<?php
namespace App\Controller\Api;

use App\Model\Usuario as ModelUsuario;
use App\Paginator\Paginator;
use Exception;

class Usuario extends Api
{
    public static function index($request): array
    {
        $itens = [];
        $amount = ModelUsuario::select(null, null, null, 'COUNT(*) AS qtd')->fetchObject()->qtd;
        $currentPage = $request->getQueryParams()['pagina'] ?? 1;
        $paginator = new Paginator($amount, $currentPage, 20);
        $usuarios = ModelUsuario::select(null, 'id DESC', $paginator->getLimit());

        while ($res = $usuarios->fetchObject( ModelUsuario::class ) ) {
            $itens[] = [
                'id'        => (int) $res->id, 
                'nome'      => $res->nome,
                'email'     => $res->email,
            ];
   
        }

        return [
            'usuarios'      => $itens,
            'paginacao'     => self::pageDetails($request, $paginator)
        ];
    }

    private static function pageDetails($request, $paginator)
    {   
        $gets = $request->getQueryParams();
        $pages = $paginator->getLinks($request);
        return [
            'currentPage'   => isset($gets['pagina']) ? (int) $gets['pagina'] : 1,
            'paginas'       => !empty($pages) ? count($pages) : 1
        ];
    }


    public static function getUsuario($request, $id): array
    {
        if (!is_numeric($id)) throw new Exception("Identificador inválido", 400);

        $usuario = ModelUsuario::select(' id = ' . $id)->fetchObject( ModelUsuario::class );

        if (!$usuario instanceof ModelUsuario) throw new Exception("Usuário não foi encontrado", 404);        

        return [
            'id'        => $usuario->id,
            'nome'      => $usuario->nome,
            'email'     => $usuario->email,
    
        ];
    }


    public static function store($request): array
    {
        $post = $request->getPostVars();
        if (!isset($post['nome']) || !isset($post['email']) || !isset($post['senha'])) throw new Exception("Prencha todos os campos", 400);

        $email = ModelUsuario::getUserByEmail( $post['email'] );
        if ( $email instanceof ModelUsuario ) throw new Exception("Esse e-mail já está em uso");

        $usuario = new ModelUsuario;
        $usuario->nome  = $post['nome'];
        $usuario->email = $post['email'];
        $usuario->senha = password_hash($post['senha'], PASSWORD_DEFAULT);
        $usuario->insert();

        return [
            'id'        => (int) $usuario->id,
            'nome'      => $usuario->nome,
            'email'     => $usuario->email,
        ];
    }



    public static function update($request, $id): array
    {
        $post = $request->getPostVars();

        if (!isset($post['nome']) || !isset($post['email'])) throw new Exception("Prencha todos os campos", 400);

        $usuario = ModelUsuario::select(' id = ' . $id )->fetchObject( ModelUsuario::class );

        if (!$usuario instanceof ModelUsuario) throw new Exception("Depoimento não encontrado", 404);

        $email = ModelUsuario::getUserByEmail($post['email']);

        if ($email instanceof ModelUsuario && $usuario->id != $email->id) throw new Exception("E-mail em uso", 400);

        $usuario->nome  = $post['nome'];
        $usuario->email = $post['email'];
        $usuario->update();

        return [
            'id'        => (int) $usuario->id,
            'nome'      => $usuario->nome,
            'email'     => $usuario->email,
            
        ];
    }


    public static function delete($id)
    {
        $usuario = ModelUsuario::select( 'id = ' . $id )->fetchObject( ModelUsuario::class );
        if (!$usuario instanceof ModelUsuario ) throw new Exception("Depoimento não encontrado", 404);
        $usuario->delete($usuario);
    }
}