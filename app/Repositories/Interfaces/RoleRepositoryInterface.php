<?php

namespace App\Repositories\Interfaces;

interface RoleRepositoryInterface
{
    public function getAllRoles();
    public function createRole($name);
    public function delete($id);
    public function updateRole($name, $roleId);
    public function getRoleById($id);
    public function addPermission($roleId, $permissionId, $name);
}
