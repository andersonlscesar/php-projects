<?php
namespace App\Controller\Pages;

use App\Utils\View;

class HomeController extends Controller
{

    /**
     * Retorna o conteúdo da página principal
     * @return string
     */

    public static function index(): string
    {
        $content = View::render('pages/home', ['nome' => 'Anderson', 'goal' => 'Master php']);
        return parent::view('home', $content);
    }
}