<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $request;
    protected $roleRepository;
    public function __construct(RoleRepositoryInterface $roleRepository, Request $request)
    {
        $this->request = $request;
        $this->roleRepository = $roleRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->roleRepository->getAllRoles();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $this->request->validate([
            'name' => 'required',
        ]);

        $newRole = $this->roleRepository->createRole($this->request->all());
        return response()->json([
            "status" => true,
            "message" => "role create successfully",
            "data" => $newRole
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $data = $this->roleRepository->getRoleById($this->request->id);
        $a = $data->load('permissions');
        return response()->json([
            "data" => $a
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        $this->request->validate([
            'roleId' => "required",
            'name' => 'required',
        ]);

        $data = $this->roleRepository->updateRole($this->request->name, $this->request->roleId);
        if ($data === true) {
            return response()->json([
                "status" => true,
                "message" => "role updated successfully",
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "role not found",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->roleRepository->delete($id);
        if ($data === 1) {
            return response()->json([
                "status" => true,
                "message" => "role deleted successfully",
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "role not found",
            ]);
        }
    }

    public function addPermission()
    {
        $this->request->validate([
            'roleId' => "required",
            'permissionId' => "required",
            'name' => "required",
        ]);

        $data = $this->roleRepository->addPermission($this->request->roleId, $this->request->permissionId, $this->request->name);
    }
}
