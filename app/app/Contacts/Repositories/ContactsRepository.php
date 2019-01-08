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

    public function create($params)
    {
        $howCreate = 99;
        $query= $this->conn->prepare("
                                    INSERT INTO contacts (code,uidcli,name,free1,free2,email,list_cod,how_create)
                                    VALUES(:code,:uidcli,:name,:free1,:free2,:email,:list_cod,:how_create)
                                ");
        $query->bindParam(':code', $params['code']);
        $query->bindParam(':uidcli', $params['uidcli']);
        $query->bindParam(':name', $params['name']);
        $query->bindParam(':free1', $params['free1']);
        $query->bindParam(':free2', $params['free2']);
        $query->bindParam(':email', $params['email']);
        $query->bindParam(':list_cod', $params['list_cod']);
        $query->bindParam(':how_create', $howCreate);
        return $query->execute();
    }
    
}
