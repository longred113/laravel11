<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\User;
use App\Repositories\Interfaces\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{

    public function createRole($roleName)
    {
        return Role::create($roleName);
    }
    public function getAllRoles()
    {
        return Role::all();
    }
}
