<?php

namespace App\Repositories\Interfaces;

interface ProductInterface
{
    public function create();
    public function update();
    public function find();
    public function delete();
}
