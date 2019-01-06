<?php

namespace Core;

use PDO;
use PDOException;
use Core\ConfigParser;

class DataBase
{
    private $config = [];
    
    public function __construct()
    {
        $conf = (new ConfigParser())->get('database')['mysql'];
        
        $this->config['host'] = $conf['host'];
        $this->config['db'] = $conf['database'];
        $this->config['user'] = $conf['user'];
        $this->config['pass'] = $conf['pass'];
        $this->config['charset'] = $conf['charset'];
        $this->config['collation'] = $conf['collation'];
    }

    public function getConnection()
    {
        try {
            $pdo = new PDO(
                "mysql:host={$this->config['host']};dbname={$this->config['db']};charset={$this->config['charset']}",
                $this->config['user'],
                $this->config['pass']
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(
                PDO::MYSQL_ATTR_INIT_COMMAND,
                "SET NAMES '{$this->config['charset']}' COLLATE '{$this->config['collation']}'"
            );
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            return $pdo;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
