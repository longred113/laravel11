<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function register($name, $email, $password);
}
