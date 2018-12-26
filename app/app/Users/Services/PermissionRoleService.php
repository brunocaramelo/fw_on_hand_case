<?php

namespace App\Users\Services;

use App\Users\Repositories\PermissionRoleRepository;

class PermissionRoleService
{
    private $permissionRepository;
    
    public function __construct(PermissionRoleRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function listAll()
    {
        return $this->permissionRepository->getAllRoles();
    }
}
