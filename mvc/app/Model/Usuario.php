<?php
namespace App\Model;

use App\Db\Db;

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
}