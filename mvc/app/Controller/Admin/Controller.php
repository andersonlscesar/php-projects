<?php
namespace App\Controller\Admin;

use App\Utils\View;

class Controller 
{
    private static $modules = [
        'home'  => [
            'label' => 'Home',
            'link'  => URL . '/admin'
        ],

        'depoimentos'  => [
            'label' => 'Depoimentos',
            'link'  => URL . '/admin/depoimentos'
        ],

        'usuarios'  => [
            'label' => 'Usuários',
            'link'  => URL . '/admin/usuarios'
        ]
    ];
    public static function view($title, $content)
    {
        return View::render('admin/main', [
            'title'     => $title, 
            'content'   => $content
        ]);
    }


    public static function renderPanel($title, $content, $currentModule)
    {
        $contentPanel = View::render('admin/panel', [
            'menu'      => self::renderMenu($currentModule),
            'content'   => $content
        ]);
        return self::view($title, $contentPanel);
    }

    private static function renderMenu($currentModule)
    {
        $links = '';
        foreach (self::$modules as $hash => $module) {
            $links .= View::render('admin/menu/link', [
                'label'     => $module['label'],
                'link'      => $module['link'],
                'current'   => $hash == $currentModule ? 'text-danger' : ''
            ]);
        }
        return View::render('admin/menu/box', [ 'links' => $links ]);
    }

    
}