<?php
namespace App\Controller\Traits;

use App\Model\Depoimento;
use App\Utils\View;
use App\Paginator\Paginator;

trait DepoimentoTrait
{

    /**
     * Seleciona todos os depoimentos
     * Esta trait é chamada na DepoimentoController
     */

    public static function selectAllDepoimentos($request, &$paginator)
    {
        $amount = Depoimento::getAmount();
        $currentPage = $request->getQueryParams()['pagina'] ?? 1;  
        $paginator = new Paginator($amount, $currentPage, 5);
        $res = Depoimento::select(null, 'id DESC', $paginator->getLimit());       
        
        $itens = '';

            while ($ob = $res->fetchObject(Depoimento::class)) {
                $itens .= View::render('pages/depoimento/depoimento_card', [
                    'nome'      => $ob->nome,
                    'mensagem'  => $ob->mensagem,
                    'data'      => date('d/m/Y H:i:s',strtotime($ob->data))
                ]);
            }
        

        return $itens;
    }


    public static function selectAllDepoimentosAdmin($request, &$paginator)
    {
        $amount = Depoimento::getAmount();
        $currentPage = $request->getQueryParams()['pagina'] ?? 1;
        $paginator = new Paginator($amount, $currentPage, 5);
        $res = Depoimento::select(null, 'id DESC', $paginator->getLimit());

        $itens = '';

        while ($ob = $res->fetchObject(Depoimento::class)) {
            $itens .= View::render('admin/modules/depoimento/item', [
                'id'            => $ob->id,
                'nome'          => $ob->nome,
                'depoimento'    => $ob->mensagem,
                'data'          => date('d/m/Y H:i:s',strtotime($ob->data))
            ]);
        }


        return $itens;
    }

}