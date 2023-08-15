<?php
namespace App\Controller\Api;

use App\Model\Depoimento as ModelDepoimento;
use App\Paginator\Paginator;
use Exception;

class Depoimento extends Api
{
    public static function index($request): array
    {
        $itens = [];
        $amount = ModelDepoimento::select(null, null, null, 'COUNT(*) AS qtd')->fetchObject()->qtd;
        $currentPage = $request->getQueryParams()['pagina'] ?? 1;
        $paginator = new Paginator($amount, $currentPage, 20);
        $depoimentos = ModelDepoimento::select(null, 'id DESC', $paginator->getLimit());

        while ($res = $depoimentos->fetchObject( ModelDepoimento::class ) ) {
            $itens[] = [
                'id'        => (int) $res->id, 
                'nome'      => $res->nome,
                'mensagem'  => $res->mensagem,
                'data'      => $res->data
            ];
   
        }

        return [
            'depoimentos'   => $itens,
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


    public static function getDepoimento($request, $id): array
    {
        if (!is_numeric($id)) throw new Exception("Identificador inválido", 400);

        $depoimento = ModelDepoimento::select(' id = ' . $id)->fetchObject( ModelDepoimento::class );

        if (!$depoimento instanceof ModelDepoimento) throw new Exception("Depoimento não foi encontrado", 404);        

        return [
            'id'        => $depoimento->id,
            'nome'      => $depoimento->nome,
            'mensagem'  => $depoimento->mensagem,
            'data'      => $depoimento->data
        ];
    }


    public static function store($request): array
    {
        $post = $request->getPostVars();
        if (!isset($post['nome']) || !isset($post['mensagem'])) throw new Exception("Prencha todos os campos", 400);

        $depoimento = new ModelDepoimento;
        $depoimento->nome = $post['nome'];
        $depoimento->mensagem = $post['mensagem'];
        $depoimento->insert();

        return [
            'id'        => (int) $depoimento->id,
            'nome'      => $depoimento->nome,
            'mensagem'  => $depoimento->mensagem,
            'data'      => $depoimento->data
        ];
    }



    public static function update($request, $id): array
    {
        $post = $request->getPostVars();
        if (!isset($post['nome']) || !isset($post['mensagem'])) throw new Exception("Prencha todos os campos", 400);

        $depoimento = ModelDepoimento::select(' id = ' . $id )->fetchObject( ModelDepoimento::class );

        if (!$depoimento instanceof ModelDepoimento) throw new Exception("Depoimento não encontrado", 404);

        $depoimento->nome = $post['nome'];
        $depoimento->mensagem = $post['mensagem'];
        $depoimento->update();

        return [
            'id'        => (int) $depoimento->id,
            'nome'      => $depoimento->nome,
            'mensagem'  => $depoimento->mensagem,
            'data'      => $depoimento->data
        ];
    }


    public static function delete($id)
    {
        $depoimento = ModelDepoimento::select( 'id = ' . $id )->fetchObject( ModelDepoimento::class );

        if (!$depoimento instanceof ModelDepoimento ) throw new Exception("Depoimento não encontrado", 404);
        $depoimento->delete($depoimento);
    }
}