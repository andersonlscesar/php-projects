<?php

namespace App\Db;

use PDO;
use PDOException;

class Db
{
    private $table;
    private $dbname;
    private $dbhost;
    private $dbuser;
    private $dbpass;
    private $conn;


    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }

    private function setConnection()
    {
        try {
            $this->dbname = getenv('DB_NAME');
            $this->dbhost = getenv('DB_HOST');
            $this->dbuser = getenv('DB_USER');
            $this->dbpass = getenv('DB_PASS');
            $this->conn = new PDO('mysql:host=' . $this->dbhost . ';dbname=' . $this->dbname, $this->dbuser, $this->dbpass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('error ' . $e->getMessage());
        }
    }


    private function execute($query, $params = [])
    {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            die('Error ' . $e->getMessage());
        }
    }


    public function insert($values)
    {
        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?');
        $query = 'INSERT INTO ' . $this->table . '(' . implode(', ', $fields) . ') VALUES (' . implode(', ', $binds) . ')';
        $this->execute($query, array_values($values));
        return $this->conn->lastInsertId();
    }

    /**
     * Método responsável por executar uma consulta no banco
     * @param  string $where
     * @param  string $order
     * @param  string $limit
     * @param  string $fields
     * @return PDOStatement
     */
    public function select($where = null, $order = null, $limit = null, $fields = '*')
    {
        $where = !is_null($where) ? 'WHERE ' . $where : '';
        $order = !is_null($order) ? 'ORDER BY ' . $order : '';
        $limit = !is_null($limit) ? 'LIMIT ' . $limit : '';

        $query = 'SELECT ' . $fields . ' FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;

        return $this->execute($query);
    }

    /**
     * Método responsável por executar atualizações no banco de dados
     * @param  string $where
     * @param  array $values [ field => value ]
     * @return boolean
     */
    public function update($where, $values)
    {
        $fields = array_keys($values);

        $query = 'UPDATE ' . $this->table . ' SET ' . implode('=?,', $fields) . '=? WHERE ' . $where;
        $this->execute($query, array_values($values));

        return true;
    }

    /**
     * Método responsável por excluir dados do banco
     * @param  string $where
     * @return boolean
     */
    public function delete($where)
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE ' . $where;

        $this->execute($query);

        return true;
    }
}
