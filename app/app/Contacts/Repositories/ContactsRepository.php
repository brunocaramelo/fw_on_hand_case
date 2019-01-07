<?php

namespace App\Contacts\Repositories;

class ContactsRepository
{
    private $conn;
    
    public function __construct(\PDO $conn)
    {
        $this->conn = $conn;
    }

    public function findByCode($code)
    {
        $query= $this->conn->prepare("SELECT * FROM contacts WHERE cod=:code");
        $query->bindParam(':code', $code);
        $query->execute();
        return $query->fetch();
    }

    public function getAll()
    {
        $query= $this->conn->prepare("SELECT * FROM contacts");
        $query->execute();
        return $query->fetchAll();
    }
    public function getAllByList($listId)
    {
        $query= $this->conn->prepare("SELECT * FROM contacts where list_cod=:list_cod");
        $query->bindParam(':list_cod', $listId);
        $query->execute();
        return $query->fetchAll();
    }
    
}
