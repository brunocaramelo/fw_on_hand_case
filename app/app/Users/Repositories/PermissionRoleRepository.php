<?php

namespace App\Users\Repositories;

class PermissionRoleRepository
{
    public function __construct(\PDO $conn)
    {
        $this->conn = $conn;
    }

    public function getCredentialsByRoleId($roleId)
    {
        $query= $this->conn->prepare("SELECT  
                                        per.slug,  
                                        per.name  
                                    FROM permissions per
                                    INNER JOIN permission_role prol ON prol.permission_id = per.id
                                    INNER JOIN roles rol ON prol.role_id = rol.id
                                    where rol.id = :role_id ");
        $query->bindParam(':role_id', $roleId);
        $query->execute();
        return $query->fetchAll();
    }

    public function getAllRoles()
    {
        $query= $this->conn->prepare("SELECT rol.* FROM roles rol");
        $query->execute();
        return $query->fetchAll();
    }
}
