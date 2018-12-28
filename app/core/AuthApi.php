<?php

namespace Core;

use App\Users\Repositories\UserRepository;
use App\Users\Repositories\PermissionRoleRepository;

class AuthApi
{
    private $id = null;
    private $name = null;
    private $email = null;
    private $dataInstance = null;
    private $credentials = [];

    public function __construct($token, \PDO $pdo)
    {
        $this->dataInstance = $pdo;
        $this->checkUserUser($token, $pdo);
    }
    
    private function checkUserUser($token)
    {
        $user = new UserRepository($this->dataInstance);
        $userData = $user->findByToken($token);
        if (!is_object($userData)) {
            return false;
        }
        $this->setUserData($userData);
        return true;
    }

    private function setUserData($userData)
    {
        $this->name = $userData->name;
        $this->id = $userData->id;
        $this->email = $userData->email;
        $this->setPermissions($this->id);
    }
    
    private function setPermissions($userId)
    {
        $permissions = new PermissionRoleRepository($this->dataInstance);
        $persm = $permissions->getCredentialsByRoleId($userId);
        foreach ($persm as $perm) {
            $this->credentials[] = $perm->slug;
        }
    }

    public function id()
    {
        return $this->id;
    }

    public function name()
    {
        return $this->name;
    }

    public function email()
    {
        return $this->email;
    }

    public function check()
    {
        return (!($this->id == null &&
                $this->name == null &&
                $this->email == null));
    }

    public function can($permission)
    {
        return in_array($permission, $this->credentials);
    }
    
    public function getCredentials()
    {
        return $this->credentials;
    }
}
