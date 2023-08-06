<?php
namespace App\Utils;

class View 
{

    /**
     * Valida o conteúdo da view
     * @param string $view
     * @return string
     */

    private static function getContentView(string $view): string
    {
        $file = __DIR__ . '/../../src/view/' . $view . '.html';
        return file_exists($file) ? file_get_contents($file) : '';
    }

    /**
     * Renderiza o conteúdo 
     * @param string $view
     * @param array $params
     * @return string
     */

    public static function render(string $view, array $params = []): string
    {
        $contentView = self::getContentView($view); 
        $keys = array_keys($params);
        $keys = array_map(fn($item) => '{{' . $item . '}}', $keys);
        return str_replace($keys, array_values($params), $contentView);       
    }
}