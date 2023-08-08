<?php
namespace App\Controller\Traits;

use App\Model\Depoimento;
use App\Utils\View;

trait DepoimentoTrait
{

    /**
     * Seleciona todos os depoimentos
     * Esta trait é chamada na DepoimentoController
     */

    public static function selectAllDepoimentos()
    {
        $res = Depoimento::select(null, 'id DESC');
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
}