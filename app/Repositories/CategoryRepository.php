<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;


class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAll()
    {
        return Category::all();
    }
    public function create($data)
    {
        return Category::create($data);
    }
    public function update()
    {
    }
    public function find($id)
    {
        return Category::find($id);
    }
    public function delete()
    {
    }
}
