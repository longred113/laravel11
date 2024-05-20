<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $request;
    protected $categoryRepository;
    public function __construct(Request $request, CategoryRepositoryInterface $categoryRepository)
    {
        $this->request = $request;
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->categoryRepository->getAll();
        return response()->json([
            "status" => true,
            "data" => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $this->request->validate([
            'name' => 'string|required',
        ]);

        $params = [
            "name" => $this->request["name"],
            "active" => 1,
        ];

        $newCategory = $this->categoryRepository->create($params);

        return response()->json([
            "status" => true,
            "message" => "Create new category successfully",
            "data" => $newCategory,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $this->request->validate([
            'id' => 'int|required',
        ]);
        $data = $this->categoryRepository->find($this->request->id);
        return response()->json([
            "status" => true,
            "data" => $data,
        ]);
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
