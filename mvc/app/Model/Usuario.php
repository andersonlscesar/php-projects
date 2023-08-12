<?php
namespace App\Model;

use App\Db\Db;

use PDO;

class Usuario 
{
    public $id;
    public $nome;
    public $email;
    public $senha;


    public static function getUserByEmail($email)
    {
        return ( new Db('usuarios') )->select( 'email = "' . $email . '"' )->fetchObject( self::class );
    }

    public static function select($where = null, $order = null, $limit = null, $fields = "*")
    {
        return (new Db('usuarios'))->select($where, $order, $limit, $fields);
    }

    public static function get($where = null, $order = null, $limit = null, $fields = '*')
    {
        return (new Db('usuarios'))->select($where, $order, $limit, $fields)->fetchObject( self::class);
    }

    public function insert()
    {
        $data = [
            'nome'  => $this->nome,
            'email' => $this->email,
            'senha' => $this->senha
        ];
        $this->id = (new Db('usuarios'))->insert($data);
        return true;
    }


    public function update(): bool
    {
        return (new Db('usuarios'))->update(' id = ' . $this->id, [
            'nome'  => $this->nome,
            'email' => $this->email,
            'senha' => $this->senha
        ]);
    }


    public static function getAmount()
    {
        return (new Db('usuarios'))->select(null, null, null, 'COUNT(*) as amount')->fetchObject()->amount;
    }


    public function delete($obj)
    {
        return (new Db('usuarios'))->delete('id = ' . $obj->id);
    }

}