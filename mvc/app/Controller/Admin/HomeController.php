<?php
namespace App\Controller\Admin;

use App\Utils\View;
use App\Model\Usuario;
use App\Session\Admin\Login;

class HomeController extends Controller
{
    public static function index($request): string
    {
        $content = View::render('admin/modules/home/index');
        return parent::renderPanel('Home', $content, 'home');
    }
}