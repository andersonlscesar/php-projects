<?php
namespace App\Controller\Admin;

use App\Utils\View;

class Controller 
{
    public static function view($title, $content)
    {
        return View::render('admin/main', [
            'title'     => $title, 
            'content'   => $content
        ]);
    }
    
}