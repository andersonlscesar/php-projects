<?php

namespace App\Controller\Admin;

use App\Controller\Traits\DepoimentoTrait;
use App\Http\Request;
use App\Utils\View;
use App\Model\Depoimento;
class DepoimentoController extends Controller
{
    use DepoimentoTrait;

    /**
     * Retorna o conteúdo da página principal
     * @return string
     */

    public static function index($request): string
    {
        $content = View::render('admin/modules/depoimento/index', [
            'items'   => empty(self::selectAllDepoimentosAdmin($request, $paginator)) ? 'Ainda não há postagens' : self::selectAllDepoimentosAdmin($request, $paginator),
            'pagination'    => $paginator->paginate($request)
        ]);
        return parent::renderPanel('Depoimentos', $content, 'depoimentos');
    }

    /**

     * Exibe o formulário de cadastro de depoimento*/
    public static function create()
    {
        $content = View::render('admin/modules/depoimento/form', [
            'title'     => 'Cadastrar depoimento',
            'nome'      => '',
            'mensagem'  => ''
        ]);

        return parent::renderPanel('Depoimentos', $content, 'depoimentos');
    }

    /**
     * Armazena os dados no banco
     * @param Request $request
    */

    public static function store( Request $request )
    {
        $post = $request->getPostVars();
        $nome       = $post['nome'] ?? '';
        $mensagem   = $post['mensagem'] ?? '';
        $depoimento = new Depoimento();
        $depoimento->nome = $nome;
        $depoimento->mensagem = $mensagem;
        $depoimento->insert();
        $request->getRoute()->redirect('/admin/depoimentos/' . $depoimento->id . '/edit?status=created');
        return true;
    }


    public static function edit($request, $id)
    {
        $depoimento = Depoimento::get('id = ' . $id );
        $content = View::render('admin/modules/depoimento/form', [
            'title'     => 'Editar depoimento',
            'nome'      => $depoimento->nome,
            'mensagem'  => $depoimento->mensagem
        ]);
        return parent::renderPanel('Depoimento - ' . $depoimento->nome, $content, 'depoimento');
    }

    public static function update($request, $id)
    {
        $post = $request->getPostVars();
        $depoimento = Depoimento::get('id = ' . $id );
        $nome       = $post['nome'] ?? $depoimento->nome;
        $mensagem   = $post['mensagem'] ?? $depoimento->mensagem;
        $depoimento->nome = $nome;
        $depoimento->mensagem = $mensagem;
        $depoimento->update();
        $request->getRoute()->redirect('/admin/depoimentos/' . $depoimento->id . '/edit?status=updated');
        return true;
    }

    public static function delete($request, $id)
    {
        $depoimento = Depoimento::get('id = ' . $id);
        $obDepoimento = new Depoimento();
        $obDepoimento->delete($depoimento);
        $request->getRoute()->redirect('/admin/depoimentos?status=deleted');
        return true;
    }


}