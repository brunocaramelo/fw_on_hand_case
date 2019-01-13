<?php

namespace App\Messages\Repositories;

class MessageRepository
{
    private $conn;
    
    public function __construct(\PDO $conn)
    {
        $this->conn = $conn;
    }

    public function findByCode($code)
    {
        $query = $this->conn->prepare("SELECT * FROM messages WHERE code=:code");
        $query->bindParam(':code', $code);
        $query->execute();
        return $query->fetch();
    }

    public function getAll()
    {
        $query = $this->conn->prepare("SELECT * FROM messages");
        $query->execute();
        return $query->fetchAll();
    }

    public function getAllByUser($userId)
    {
        $query = $this->conn->prepare("SELECT * FROM messages where how_create =:how_create");
        $query->bindParam(':how_create', $userId);
        $query->execute();
        return $query->fetchAll();
    }

    public function getAllByList($listId)
    {
        $query = $this->conn->prepare("SELECT * FROM messages where list_cod=:list_cod");
        $query->bindParam(':list_cod', $listId);
        $query->execute();
        return $query->fetchAll();
    }

    public function create($params)
    {
        $query = $this->conn->prepare("
                                    INSERT INTO messages (code,sender_name,sender_email,subject,body,folder,status,how_create)
                                    VALUES(:code,:sender_name,:sender_email,:subject,:body,:folder,:status,:how_create)
                                ");
        $query->bindParam(':code', $params['code']);
        $query->bindParam(':sender_name', $params['sender_name']);
        $query->bindParam(':sender_email', $params['sender_email']);
        $query->bindParam(':subject', $params['subject']);
        $query->bindParam(':body', $params['body']);
        $query->bindParam(':folder', $params['folder']);
        $query->bindParam(':status', $params['status']);
        $query->bindParam(':how_create', $params['how_create']);
            
        return $query->execute();
    }

    public function setToSended($code)
    {
        $query = $this->conn->prepare("
                                    UPDATE messages 
                                    SET status='sended'
                                    WHERE code=:code
                                ");
        $query->bindParam(':code', $code);
        
        return $query->execute();
    }

    public function update($data)
    {
        $query = $this->conn->prepare("
                                    UPDATE messages 
                                        SET body=:body,
                                        subject=:subject,
                                        sender_name=:sender_name,
                                        sender_email=:sender_email,
                                        folder=:folder
                                    WHERE code=:code
                                ");
        $query->bindParam(':body', $data['body']);
        $query->bindParam(':subject', $data['subject']);
        $query->bindParam(':sender_name', $data['sender_name']);
        $query->bindParam(':sender_email', $data['sender_email']);
        $query->bindParam(':folder', $data['folder']);
        $query->bindParam(':code', $data['code']);
        
        return $query->execute();
    }
    
}
