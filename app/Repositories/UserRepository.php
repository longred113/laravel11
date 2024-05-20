<?php

namespace App\Repositories;

use App\Models\PasswordReset;
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

    public function findEmail($email)
    {
        return User::where("email", $email)->firstOrFail();
    }

    public function passwordReset($email, $token)
    {
        return PasswordReset::updateOrCreate([
            "email" => $email,
        ], [
            "token" => $token,
        ]);
    }
}
