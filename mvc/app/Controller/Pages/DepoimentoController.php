<?php
namespace App\Controller\Pages;

use App\Utils\View;

class DepoimentoController extends Controller
{

    /**
     * Retorna o conteúdo da página principal
     * @return string
     */

    public static function index(): string
    {
        $content = View::render('pages/depoimentos');
        return parent::view('Depoimentos', $content);
    }
}