<?php
namespace  App\Controller\Traits;

use App\Model\Usuario;
use App\Paginator\Paginator;
use App\Utils\View;

trait UsuarioTrait
{
    public static function selectAllUsers($request, &$paginator)
    {
        $amount = Usuario::getAmount();
        $paginator = new Paginator($amount, $request->getQueryParams()['pagina'] ?? 1, 3);
        $usuarios = Usuario::select(null, 'id DESC', $paginator->getLimit());
        $itens = '';

        while($ob = $usuarios->fetchObject( Usuario::class ) ) {
            $itens .= View::render('admin/modules/usuario/usuario', [
                'id'    => $ob->id,
                'nome'  => $ob->nome,
                'email' => $ob->email
            ]);
        }

        return $itens;
    }
}
