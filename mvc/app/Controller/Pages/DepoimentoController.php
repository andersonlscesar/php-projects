<?php
namespace App\Controller\Pages;

use App\Utils\View;
use App\Model\Depoimento;
use App\Controller\Traits\DepoimentoTrait;


class DepoimentoController extends Controller
{
    use DepoimentoTrait;

    /**
     * Retorna o conteúdo da página principal
     * @return string
     */

    public static function index(): string
    {               

        $amount = Depoimento::getAmount();
        $content = View::render('pages/depoimentos', [
            'depoimentos'   => empty(self::selectAllDepoimentos()) ? 'Ainda não há postagens' : self::selectAllDepoimentos()
        ]);        
        return parent::view('Depoimentos', $content);
    }

    /**
     * Armazena os dados no db
     * @param Request $request
     */

    public static function store($request)
    {
        $post = $request->getPostVars();
        $depoimento = new Depoimento;
        $depoimento->nome       = $post['nome'];
        $depoimento->mensagem   = $post['mensagem'];
        $depoimento->insert();
        header("Location: http://localhost/php-projects/mvc/depoimentos");
        exit;
    }
}