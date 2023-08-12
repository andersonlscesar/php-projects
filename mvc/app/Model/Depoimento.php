<?php
namespace App\Model;

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
        return (new Db('depoimentos'))->select($where, $order, $limit, $fields);
    }

    public static function get($where = null, $order = null, $limit = null, $fields = "*")
    {
        return (new Db('depoimentos'))->select($where, $order, $limit, $fields)->fetchObject(self::class);
    }

    /**
     * Retorna a quantidade de registros
     */

    public static function getAmount()
    {
        return (new Db('depoimentos'))->select(null, null, null, 'COUNT(*) as amount')->fetchObject()->amount;
    }

    public function update(): bool
    {
        $data = [
            'nome'      => $this->nome,
            'mensagem'  => $this->mensagem
        ];
        return (new Db('depoimentos'))->update('id = ' . $this->id, $data);
    }


    public function delete($depoimento)
    {
        return (new Db('depoimentos'))->delete('id = ' . $depoimento->id);
    }
}