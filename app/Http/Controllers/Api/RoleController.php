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
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
