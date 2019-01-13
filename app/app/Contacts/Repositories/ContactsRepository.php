<?php

namespace App\Contacts\Repositories;

class ContactsRepository
{
    private $conn;
    
    public function __construct(\PDO $conn)
    {
        $this->conn = $conn;
    }

    public function getByCode($code)
    {
        $query = $this->conn->prepare("SELECT * FROM contacts WHERE code=:code");
        $query->bindParam(':code', $code);
        $query->execute();
        return $query->fetch();
    }

    public function getAll()
    {
        $query = $this->conn->prepare("SELECT * FROM contacts");
        $query->execute();
        return $query->fetchAll();
    }

    public function getAllByList($listId)
    {
        $query = $this->conn->prepare("SELECT * FROM contacts where list_cod=:list_cod");
        $query->bindParam(':list_cod', $listId);
        $query->execute();
        return $query->fetchAll();
    }

    public function create($params)
    {
        $query = $this->conn->prepare("
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
        $query->bindParam(':how_create', $params['how_create']);
        return $query->execute();
    }

    public function update($params)
    {
        
        $query = $this->conn->prepare("
                                    UPDATE contacts 
                                        SET name = :name,
                                        free1 = :free1,
                                        free2 = :free2,
                                        employee = :employee,
                                        branch_activity = :branch_activity,
                                        address = :address,
                                        phone = :phone,
                                        note = :note
                                WHERE code =:code
                                        
                                ");
        $query->bindParam(':code', $params['code']);
        $query->bindParam(':name', $params['name']);
        $query->bindParam(':free1', $params['free1']);
        $query->bindParam(':free2', $params['free2']);
        $query->bindParam(':employee', $params['employee']);
        $query->bindParam(':branch_activity', $params['branch_activity']);
        $query->bindParam(':address', $params['address']);
        $query->bindParam(':phone', $params['phone']);
        $query->bindParam(':note', $params['note']);
       
        return $query->execute();
    }
}
