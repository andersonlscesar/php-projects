<?php
namespace App\Controller\Pages;

use App\Utils\View;

class SobreController extends Controller
{

    /**
     * Retorna o conteúdo da página principal
     * @return string
     */

    public static function index(): string
    {
        $content = View::render('pages/sobre');
        return parent::view('Sobre', $content);
    }
}