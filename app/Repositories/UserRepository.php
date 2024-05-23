<?php

namespace App\Repositories;

use App\Models\PasswordResetToken;
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
            "role" => 2,
        ]);
    }

    public function findEmail($email)
    {
        return User::where("email", $email)->firstOrFail();
    }

    public function passwordReset($email, $token)
    {
        return PasswordResetToken::updateOrCreate([
            "email" => $email,
        ], [
            "token" => $token,
        ]);
    }
    public function updatePassword($email, $password)
    {
        $user = $this->findEmail($email);
        return $user->update(["password" => bcrypt($password)]);
    }
}
