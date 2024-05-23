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
    public function delete($id)
    {
        return Role::destroy($id);
    }
    public function updateRole($name, $roleId)
    {
        $role = Role::where("roleId", $roleId)->first();
        if ($role === null) {
            return false;
        }
        return $role->update(["name" => $name]);
    }

    public function getRoleById($id)
    {
        return Role::where("roleId", $id)->first();
    }

    public function addPermission($roleId, $permissionId, $name)
    {
        $role = Role::where("roleId", $roleId)->first();
        if ($role === null) {
            return false;
        }
        return $role->permissions()->attach($permissionId, ["name" => $name]);
    }
}
