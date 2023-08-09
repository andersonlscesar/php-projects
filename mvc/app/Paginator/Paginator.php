<?php
namespace App\Paginator;

use App\Utils\View;

class Paginator
{
    private $itemPerPage; //  Número máximo de registro por página
    private $results; // Quantidade de itens no banco de dados
    private $pages; // Quantidade de páginas
    private $currentPage; // Página atual    
    private $maxLeft;
    private $maxRight;
    private $maxButtons = 5;


    public function __construct($results, $currentPage = 1, $itemPerPage = 10)
    {
        $this->results = $results;
        $this->itemPerPage = $itemPerPage;
        $this->currentPage = (is_numeric($currentPage) && $currentPage > 0) ? $currentPage : 1;  
        $this->totalPages();      
    }


    private function calculateMaxVisibleButtons()
    {
        $this->maxLeft = $this->currentPage - floor($this->maxButtons / 2);
        $this->maxRight = $this->currentPage + floor($this->maxButtons / 2);

        if ($this->maxLeft < 1 ) {
            $this->maxLeft = 1;
            $this->maxRight = $this->maxButtons;
        }

        if ($this->maxRight > $this->pages) {
            $this->maxLeft  = $this->pages - ($this->maxButtons - 1);
            $this->maxRight = $this->pages;

            if ($this->maxLeft < 1) $this->maxLeft = 1;
        }

    }


    private function totalPages()
    {
        $this->pages = $this->results > 0 ?  ceil($this->results / $this->itemPerPage) : 1;
        $this->currentPage = $this->currentPage <= $this->pages ? $this->currentPage : $this->pages;
    }
    
    public function getLimit()
    {
        $offset = ($this->itemPerPage * ($this->currentPage - 1));
        return $offset . ',' . $this->itemPerPage;
    }

    public function getLinks()
    {
        if ($this->pages == 1) return [];
        
        $this->calculateMaxVisibleButtons();

        $paginas = [];

        for ($i = $this->maxLeft; $i <= $this->maxRight; $i++) {
            $paginas[] = [
                'pagina'    => $i,
                'atual'     => $i == $this->currentPage
            ];
        }

        return $paginas;
    }

    /**
     * Renderiza o layout de paginação
     * @param Request $request     
     * @return string
     */

    public function paginate($request)
    {
        $pages = $this->getLinks();
        if (count($pages) <= 1) return '';
        $links = '';
        $url = $request->getRoute()->getCurrentUrl();
        $queryParams = $request->getQueryParams();
        
        foreach ($pages as $page)
        {
            $queryParams['pagina'] = $page['pagina'];
            $link = $url . '?' . http_build_query($queryParams);
            $links .= View::render('pages/pagination/link', [
                'page'  => $page['pagina'],
                'atual' => $page['atual'] ? 'active' : '',
                'link'  => $link
            ]);
        }        

        return View::render('pages/pagination/box', [
            'links' => $links
        ]);
    }



}