<?php

namespace App\Users\Repositories;

class UserRepository
{
    private $conn;
    
    public function __construct(\PDO $conn)
    {
        $this->conn = $conn;
    }

    public function findByEmail($mail)
    {
        $query= $this->conn->prepare("SELECT * FROM users WHERE email=:email");
        $query->bindParam(':email', $mail);
        $query->execute();
        return $query->fetch();
    }
    
    public function findById($userId)
    {
        $query= $this->conn->prepare("SELECT * FROM users WHERE id=:id");
        $query->bindParam(':id', $userId);
        $query->execute();
        return $query->fetch();
    }
    
    public function create($params)
    {
        $now = new \DateTime();
        $query= $this->conn->prepare("
                                    INSERT INTO users (name,email,password,api_token,created_at,updated_at,role_id)
                                    VALUES(:name,:email,:password,:api_token,:created_at,:updated_at,:role_id)
                                ");
        $query->bindParam(':name', $params['name']);
        $query->bindParam(':email', $params['email']);
        $query->bindParam(':password', $params['password']);
        $query->bindParam(':api_token', $params['api_token']);
        $query->bindParam(':role_id', $params['role_id']);
        $query->bindParam(':created_at', $now->format('Y-m-d H:i:s'));
        $query->bindParam(':updated_at', $now->format('Y-m-d H:i:s'));
        return $query->execute();
    }

    public function update($params)
    {
        $now = new \DateTime();
        $passwordSet = (!empty($params['password']) === true ? 'password=:password,' : null );
        $query = $this->conn->prepare("
                                    UPDATE users 
                                    SET name=:name,
                                    email=:email,
                                    $passwordSet
                                    role_id=:role_id,
                                    updated_at=:updated_at
                                    WHERE id=:id
                                ");
        $query->bindParam(':id', $params['id']);
        $query->bindParam(':name', $params['name']);
        $query->bindParam(':email', $params['email']);
        $query->bindParam(':role_id', $params['role_id']);
        $query->bindParam(':updated_at', $now->format('Y-m-d H:i:s'));
        
        if (!empty($params['password']) === true) {
            $query->bindParam(':password', $params['password']);
        }

        return $query->execute();
    }

    public function listAll()
    {
        $query = $this->conn->prepare("SELECT
                                        usu.id as id,
                                        usu.name as name,
                                        usu.email as email,
                                        rol.name as role_name
                                    FROM users usu
                                    INNER JOIN roles rol ON rol.id = usu.role_id"
                                    );
        $query->execute();
        return $query->fetchAll();
    }
    
}

