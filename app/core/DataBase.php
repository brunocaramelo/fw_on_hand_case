<?php

namespace Core;

use PDO;
use PDOException;

class DataBase
{
    private $config = [];
    
    public function __construct()
    {
        $conf = include_once __DIR__ . "/../app/database.php";

        $this->config['host'] = $conf['mysql']['host'];
        $this->config['db'] = $conf['mysql']['database'];
        $this->config['user'] = $conf['mysql']['user'];
        $this->config['pass'] = $conf['mysql']['pass'];
        $this->config['charset'] = $conf['mysql']['charset'];
        $this->config['collation'] = $conf['mysql']['collation'];
    }

    public function getConnection()
    {
        try {
            $pdo = new PDO("mysql:host={$this->config['host']};dbname={$this->config['db']};charset={$this->config['charset']}", $this->config['user'], $this->config['pass']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES '{$this->config['charset']}' COLLATE '{$this->config['collation']}'");
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            return $pdo;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
