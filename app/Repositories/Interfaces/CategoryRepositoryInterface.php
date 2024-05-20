<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface
{
    public function getAll();
    public function create($data);
    public function update();
    public function find($id);
    public function delete();
}
