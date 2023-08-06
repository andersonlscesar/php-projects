<?php
namespace App\Controller\Pages;

use App\Utils\View;

class Controller 
{
    public static function view($title, $content)
    {
        $layout = [
            'title'     => $title,
            'content'   => $content,
            'header'    => self::getHeader(),
            'footer'    => self::getFooter()
        ];
        return View::render('layout/main', $layout);
    }


    private static function getHeader()
    {
        return View::render('layout/header');
    }

    private static function getFooter()
    {
        return View::render('layout/footer');
    }
}