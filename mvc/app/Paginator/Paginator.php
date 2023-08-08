<?php
namespace App\Paginator;

abstract class Paginator
{
    private $itemPerPage; //  Número máximo de registro por página
    private $results; // Quantidade de itens no banco de dados
    private $pages; // Quantidade de páginas
    private $currentPage; // Página atual    

    public static function paginate($itemPerPage)
    {
        if (is_numeric($itemPerPage) && $itemPerPage > 0) {
            self::$itemPerPage = $itemPerPage;
        }
    }


}