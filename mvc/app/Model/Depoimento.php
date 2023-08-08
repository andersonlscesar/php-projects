<?php
namespace App\Model;

use PDO;
use App\Db\Db;

class Depoimento
{
    public $id;
    public $nome;
    public $mensagem;
    public $data;

    public function insert()
    {   
        $this->data = date('Y-m-d H:i:s');
        $data = [
            'nome'      => $this->nome,
            'mensagem'  => $this->mensagem,
            'data'      => $this->data
        ];
        $this->id = (new Db('depoimentos'))->insert($data);
        return true;
    }

    /**
     * Projeta os dados do banco
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $fields
     * @return PDOStatement
     */


    public static function select($where = null, $order = null, $limit = null, $fields = "*") 
    {
        return (new Db('depoimentos'))->select($where, $order, $limit);
    }
}