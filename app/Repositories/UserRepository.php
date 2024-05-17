<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;


class UserRepository implements UserRepositoryInterface
{
    public function register($name, $email, $password)
    {
        return User::create([
            "name" => $name,
            "email" => $email,
            "password" => bcrypt($password),
        ]);
    }
}
